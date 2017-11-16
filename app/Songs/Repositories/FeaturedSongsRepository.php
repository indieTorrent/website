<?php

namespace App\Songs\Repositories;

use App\Repositories\BaseRepository;
use App\Songs\Contracts\FeaturedSongsInterface;
use App\Songs\Contracts\SongsInterface;
use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;

class FeaturedSongsRepository extends BaseRepository implements FeaturedSongsInterface
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
    private $songs;

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
     * @param SongsInterface $songs
     * @param DatabaseManager $db
     * @param Carbon $carbon
     */
    public function __construct(SongsInterface $songs, DatabaseManager $db, Carbon $carbon)
    {
        $this->songs = $songs;
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
        return $this->songs->getSongsByIds($this->getSongIds());
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
                        $entity_id = $this->songs->getArtistBySongId($song->id)->id;
                        $this->addArtistToCooldown($entity_id);

                        // we get the rank of the expired song so
                        // that we can assign it to the new song
                        $rank = $this->getRank($song->id);

                        // then remove it from the featured table
                        $this->removeSong($song->id);

                        // and add a new random song with the expired songs rank!
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
        return $this->db->table($this->table)
            ->pluck('song_id')
            ->sortBy('rank')
            ->toArray();
    }

    /**
     * Determines the rank (placement) for the new song
     *
     * @param $song_id
     * @return int|mixed|string
     */
    public function getRank($song_id)
    {
        return $this->db->table($this->table)
            ->where('song_id', $song_id)
            ->first()
            ->rank;
    }

    /**
     * Checks if the artist is currently in cooldown
     *
     * @param $entity_id
     * @return bool
     */
    public function isArtistInCooldown($entity_id)
    {
        $cooldowns = $this->db->table($this->cooldown_table)
            ->select('entity_id', 'expires')
            ->get();

        foreach ($cooldowns as $cooldown) {
            if($cooldown->entity_id == $entity_id) {

                if($this->hasExpired($cooldown->expires)) {
                    // if the cooldown has expired, the artist can be featured again
                    // so lets remove them from the cooldown
                    $this->removeArtistFromCooldown($cooldown->entity_id);

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
        return ($this->carbon->parse($expires) <= $this->carbon->now());
    }

    /**
     * Adds a random song to the featured songs table
     *
     * @param int $rank
     * @return string
     */
    public function addRandomSong($rank)
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
        // cooldown table has entity_id
        // releationship is song->album->artist

        $random_id = $this->db->table('songs')
            ->select('songs.id')
            ->whereIn('songs.id', function($q) {
                $q->select('songs.id')->from('songs')
                    ->join('albums', function($j) {
                        $j->on('songs.album_id', '=', 'albums.id');
                    })
                    ->join('music_entities', function($j) {
                        $j->on('albums.entity_id', '=', 'music_entities.id');
                    })
                    ->whereNotIn('music_entities.id', $this->getCooldownArtistIds());
            })
            ->inRandomOrder()
            ->first()->id;

        $this->db->table($this->table)->insert([
            'song_id' => $random_id,
            'rank' => $rank,
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
            ->pluck('entity_id');
    }

    /**
     * Adds a artist to the featured songs cooldown table by its id
     *
     * @param $entity_id
     * @return void
     */
    public function addArtistToCooldown($entity_id)
    {
        if(!$this->isArtistInCooldown($entity_id)) {
            $this->db->table($this->cooldown_table)->insert([
                'entity_id' => $entity_id
            ]);
        }
    }

    /**
     * Removes an artist from the featured songs cooldown table
     *
     * @param $entity_id
     */
    public function removeArtistFromCooldown($entity_id)
    {
        $this->db->table($this->cooldown_table)->where('entity_id', $entity_id)->delete();
    }


}