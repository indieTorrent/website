<?php

namespace App\Songs\Repositories;

use App\Song;
use App\Songs\Contracts\SongsInterface;
use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;

class SongsRepository implements SongsInterface
{

    /**
     * @var Song
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

    public function __construct(Song $song, DatabaseManager $db, Carbon $carbon)
    {
        $this->song = $song;
        $this->db = $db;
        $this->carbon = $carbon;
    }

    /**
     * @param array $ids
     * @return Collection
     */
    public function getSongsByIds(array $ids)
    {
        $songs = [];

        foreach ($ids as $id) {
            array_push($songs, $this->getSongById($id));
        }

        return collect($songs);
    }

    public function getSongById($id)
    {
        return $this->song->find($id);
    }

    // todo: maybe we put the featured songs stuff in a dedicated class ? -mike
    public function getFeaturedSongIds()
    {
        $table = 'featured_songs';

        $this->db->transaction(function () use ($table) {

            $featured = $this->db->table($table)->select('song_id as id', 'expires')->get();

            if (count($featured) > 0) {
                foreach ($featured as $song) {
                    if ($this->carbon->parse($song->expires) <= $this->carbon->now()) {

                        $this->removeFeaturedSong($song->id);

                        $rank = $this->db->table($table)->count() + 1;

                        $this->addRandomFeaturedSong($rank);
                    }
                }
            } else {
                for ($i = 1; $i <= 5; $i++) {
                    $rank = $i;
                    $this->addRandomFeaturedSong($rank);
                }
            }
        });

        return $this->db->table($table)->pluck('song_id')->toArray();
    }

    public function isArtistInCooldown($artist_id)
    {
        $table = 'featured_songs_cooldown';
        $cooldowns = $this->db->table($table)->pluck('artist_id');

        foreach ($cooldowns as $cooldown) {
            if($cooldown['artist_id'] == $artist_id) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return integer
     */
    public function addRandomFeaturedSong($rank)
    {
        $table = 'featured_songs';

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

        do {
            $random_id = rand(1, $song_count);
            $artist = $this->song->find($random_id)->album->artist;
        } while ($this->isArtistInCooldown($artist->id));

        $this->db->table($table)->insert([
            'song_id' => $random_id,
            'expires' => $expires
        ]);

        return $random_id;
    }

    /**
     * @param $song
     * @return void
     */
    public function removeFeaturedSong($song_id)
    {
        $this->db->table('featured_songs')->where('song_id', $song_id)->delete();

        $this->addFeaturedSongToCooldown($song_id);
    }

    /**
     * @param $song
     * @return void
     */
    public function addFeaturedSongToCooldown($song_id)
    {
        $this->db->table('featured_songs_cooldown')->insert([
            'song_id' => $song_id
        ]);
    }
}