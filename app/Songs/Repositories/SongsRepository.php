<?php

namespace App\Songs\Repositories;

use App\Songs;
use App\Songs\Contracts\SongsInterface;

class SongsRepository implements SongsInterface
{

    /**
     * @var Songs
     */
    private $songs;

    public function __construct(Songs $songs)
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