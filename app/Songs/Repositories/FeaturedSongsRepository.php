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
                    if ($this->carbon->parse($song->expires) <= $this->carbon->now()) {

                        // lets add the artist to the cooldown
                        $artist_id = $this->song->getArtistBySongId($song->id)->id;
                        $this->addArtistToCooldown($artist_id);

                        // then remove it from the featured table
                        $this->removeSong($song->id);

                        // lets get the rank for the new featured song
                        $rank = $this->db->table($this->table)->count() + 1;

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

        // and finally, lets return all the update featured song id's
        return $this->db->table($this->table)->pluck('song_id')->toArray();
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
            if($cooldown->id == $artist_id) {

                if ($this->carbon->parse($cooldown->expires) <= $this->carbon->now()) {
                    // if the cooldown has expired, the artist can be featured again
                    // so lets remove them from the cooldown
                    $this->removeArtistFromCooldown($cooldown->id);
                    return false;
                }

                // the artist IS in cooldown
                return true;
            }
        }

        return false;
    }

    /**
     * Adds a random song to the featured songs table
     *
     * @param int $rank
     * @return string
     */
    public function addRandomSong($rank = 1)
    {
        $song_count = $this->song->count();

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

        // Lets get a random song by an artist thats NOT in cooldown
        $random_id = $this->song->instance()
            ->whereNotIn('artist_id', $this->getCooldownArtistIds())
            ->inRandomOrder()
            ->first()
            ->id;

        // then we will add that song
        $this->db->table($this->table)->insert([
            'song_id' => $random_id,
            'expires' => $expires
        ]);

        return (string)$random_id;
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