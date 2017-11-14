<?php

namespace App\Songs\Contracts;

interface SongsInterface
{
    public function instance();
    public function getSongsByIds(array $ids);
    public function getSongById($id);
    public function getArtistBySongId($song_id);
    public function count();
}