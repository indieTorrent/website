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

        $featured = $this->db->table($table)->select('song_id as id', 'expires')->get();

        if (count($featured) > 0) {
            foreach ($featured as $song) {
                if ($this->carbon->parse($song->expires) <= $this->carbon->now()) {

                    $this->removeFeaturedSong($song->id);

                    $this->addRandomFeaturedSong();
                }
            }
        } else {
            for ($i = 1; $i <= 6; $i++) {
                $this->addRandomFeaturedSong();
            }
        }

        return $this->db->table($table)->select('song_id')->pluck('song_id')->toArray();
    }

    public function isSongOrArtistInCooldown($song_id, $artist_id)
    {
        $table = 'featured_songs_cooldown';
        $cooldowns = $this->db->table($table)->select('song_id', 'artist_id')->get();

        foreach ($cooldowns as $cooldown) {
            if($cooldown['song_id'] == $song_id || $cooldown['artist_id'] == $artist_id) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return integer
     */
    public function addRandomFeaturedSong()
    {
        $table = 'featured_songs';

        $song_count = $this->song->count();

        do {
            $random_id = rand(1, $song_count);
            $artist = $this->song->find($random_id)->album->artist;
        } while ($this->isSongOrArtistInCooldown($random_id, $artist->id));

        $this->db->table($table)->insert([
            'song_id' => $random_id
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