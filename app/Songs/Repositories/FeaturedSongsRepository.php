<?php

namespace App\Songs\Repositories;

use App\Songs\Contracts\FeaturedSongsInterface;
use App\Songs\Contracts\SongsInterface;
use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;

class FeaturedSongsRepository implements FeaturedSongsInterface
{
    /**
     * The Featured Songs Table
     *
     * @var string
     */
    protected $table = 'featured_songs';

    /**
     * The Featured Songs Cooldown Table
     *
     * @var string
     */
    protected $cooldown_table = 'featured_songs_cooldown';

    /**
     * @var SongsInterface
     */
    private $song;

    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * @var Carbon
     */
    private $carbon;

    /**
     * FeaturedSongsRepository constructor.
     *
     * @param SongsInterface $song
     * @param DatabaseManager $db
     * @param Carbon $carbon
     */
    public function __construct(SongsInterface $song, DatabaseManager $db, Carbon $carbon)
    {
        $this->song = $song;
        $this->db = $db;
        $this->carbon = $carbon;
    }

    /**
     * Gets all the Song objects
     *
     * @return mixed
     */
    public function getSongs()
    {
        return $this->song->getSongsByIds($this->getSongIds());
    }

    /**
     * Handles featured songs and their rotation
     *
     * @return array The array of song id's after processing rotations
     */
    public function getSongIds()
    {
        // starts a database transaction
        $this->db->transaction(function () {

            // lets get the currently featured songs
            $featured = $this->db->table($this->table)
                ->select('song_id as id', 'expires')
                ->get();

            if (count($featured) > 0) {
                // If we have songs already being featured
                foreach ($featured as $song) {
                    // lets check to see if they have expired
                    if ($this->hasExpired($song->expires)) {

                        // lets add the artist to the cooldown
                        $artist_id = $this->song->getArtistBySongId($song->id)->id;
                        $this->addArtistToCooldown($artist_id);

                        // lets get the rank for the new featured song
                        $rank = $this->getRank($song->id);

                        // then remove it from the featured table
                        $this->removeSong($song->id);

                        // and add a new random song taking the expired songs rank!
                        $this->addRandomSong($rank);
                    }
                }
            } else {
                // if we don't have songs featured
                for ($i = 1; $i <= 5; $i++) {
                    $rank = $i;
                    // lets randomly populate some to get us started
                    // the rank is determined by the iteration number
                    // the first pulled is ranked #1
                    $this->addRandomSong($rank);
                }
            }
        });

        // and finally, lets return all the updated featured song id's
        return $this->db->table($this->table)->pluck('song_id')->toArray();
    }

    /**
     * Determines the rank (placement) for the new song
     *
     * @param $song_id
     * @return int|mixed|string
     */
    public function getRank($song_id)
    {
        $ids = $this->db->table($this->table)->pluck('id');

        foreach($ids as $index => $id) {
            if($id == $song_id) {
                return $index;
            }
        }

        return $ids->count();
    }

    /**
     * Checks if the artist is currently in cooldown
     *
     * @param $artist_id
     * @return bool
     */
    public function isArtistInCooldown($artist_id)
    {
        $cooldowns = $this->db->table($this->cooldown_table)
            ->select('artist_id', 'expires')
            ->get();

        foreach ($cooldowns as $cooldown) {
            if($cooldown->artist_id == $artist_id) {

                if($this->hasExpired($cooldown->expires)) {
                    // if the cooldown has expired, the artist can be featured again
                    // so lets remove them from the cooldown
                    $this->removeArtistFromCooldown($cooldown->artist_id);

                    return false;
                }

                return true;
            }
        }

        return false;
    }

    /**
     * Checks if expired
     *
     * @param $expires
     * @return bool
     */
    public function hasExpired($expires)
    {
        if ($this->carbon->parse($expires) <= $this->carbon->now()) {
            return false;
        }

        return true;
    }

    /**
     * Adds a random song to the featured songs table
     *
     * @param int $rank
     * @return string
     */
    public function addRandomSong($rank = 1)
    {
        switch ($rank) {
            case 1:
                $expires = $this->carbon->now()->addWeek(4);
                break;
            case 2:
                $expires = $this->carbon->now()->addWeek(3);
                break;
            case 3:
                $expires = $this->carbon->now()->addWeek(2);
                break;
            case 4:
                $expires = $this->carbon->now()->addWeek(1);
                break;
            case 5:
                $expires = $this->carbon->now()->addDays(2);
                break;
            default:
                $expires = $this->carbon->now()->addDays(2);
                break;
        }

        // Need to get a random song by an artist thats NOT in cooldown
        // cooldown table has artist_id
        // releationship is song->album->artist

        $random_id = $this->db->table('songs')
            ->select('songs.id')
            ->whereIn('songs.id', function($q) {
                $q->select('songs.id')->from('songs')
                    ->join('albums', function($j) {
                        $j->on('songs.album_id', '=', 'albums.id');
                    })
                    ->join('artists', function($j) {
                        $j->on('albums.artist_id', '=', 'artists.id');
                    })
                    ->whereNotIn('artists.id', $this->getCooldownArtistIds());
            })
            ->inRandomOrder()
            ->first()->id;

        $this->db->table($this->table)->insert([
            'song_id' => $random_id,
            'expires' => $expires
        ]);

        return $random_id;
    }

    /**
     * Removes a song from the featured songs table by its id
     *
     * @param $song_id
     */
    public function removeSong($song_id)
    {
        $this->db->table($this->table)->where('song_id', $song_id)->delete();
    }


    /**
     * Gets all the artists ids from the featured songs cooldown table
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCooldownArtistIds()
    {
        return $this->db->table($this->cooldown_table)
            ->pluck('artist_id');
    }

    /**
     * Adds a artist to the featured songs cooldown table by its id
     *
     * @param $artist_id
     * @return void
     */
    public function addArtistToCooldown($artist_id)
    {
        if(!$this->isArtistInCooldown($artist_id)) {
            $this->db->table($this->cooldown_table)->insert([
                'artist_id' => $artist_id
            ]);
        }
    }

    /**
     * Removes an artist from the featured songs cooldown table
     *
     * @param $artist_id
     */
    public function removeArtistFromCooldown($artist_id)
    {
        $this->db->table($this->cooldown_table)->where('artist_id', $artist_id)->delete();
    }


}