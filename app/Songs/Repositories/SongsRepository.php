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

    /**
     * SongsRepository constructor.
     *
     * @param Song $song
     * @param DatabaseManager $db
     * @param Carbon $carbon
     */
    public function __construct(Song $song, DatabaseManager $db, Carbon $carbon)
    {
        $this->song = $song;
        $this->db = $db;
        $this->carbon = $carbon;
    }

    /**
     * @return Song
     */
    public function instance()
    {
        return $this->song;
    }

    /**
     * @return mixed
     */
    public function count()
    {
        return $this->song->count();
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

    /**
     * @param $id
     * @return mixed
     */
    public function getSongById($id)
    {
        return $this->song->find($id);
    }

    /**
     * @param $song_id
     * @return mixed
     */
    public function getArtistBySongId($song_id)
    {
        return $this->song->find($song_id)->album->artist;
    }
}