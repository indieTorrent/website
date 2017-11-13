<?php

use App\Http\Controllers\Controller;
use App\Songs\Api\v1\Contracts\SongsApiInterface;

class SongsApiController extends controller
{
    /**
     * @var SongsApiInterface
     */
    private $songs;

    public function __construct(SongsApiInterface $songs)
    {
        $this->songs = $songs;
    }
}