<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SongResource;
use App\Songs\Contracts\FeaturedSongsInterface;

class FeaturedApiController extends Controller
{
    /**
     * @var FeaturedSongsInterface
     */
    private $songs;

    // todo: add Albums and Artists -mike
    public function __construct(FeaturedSongsInterface $songs)
    {
        $this->songs = $songs;
    }

    public function songs()
    {
        $songs = $this->songs->getSongs();
        return response(SongResource::collection($songs), 200);
    }

    public function artists()
    {
        return response(['message' => 'Not Yet Implemented'], 400);
    }

    public function albums()
    {
        return response(['message' => 'Not Yet Implmented'], 400);
    }
}