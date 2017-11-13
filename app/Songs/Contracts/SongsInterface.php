<?php

namespace App\Songs\Contracts;

interface SongsInterface
{
    public function getSongsByIds(array $ids);
    public function getSongById($id);
}