<?php

namespace App\Songs\Repositories;

use App\Song;
use App\Songs\Contracts\SongsInterface;

class SongsRepository implements SongsInterface
{

    /**
     * @var Song
     */
    private $songs;

    public function __construct(Song $songs)
    {
        $this->songs = $songs;
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getSongsByIds(array $ids)
    {
        $songs = [];

        foreach ($ids as $id) {
            array_push($songs, $this->getSongById($id));
        }

        return $songs;
    }

    public function getSongById($id)
    {
        return $this->songs->find($id);
    }
}