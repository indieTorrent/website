<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SongResource;
use App\Songs\Contracts\SongsInterface;

class FeaturedApiController extends Controller
{
    /**
     * @var SongsInterface
     */
    private $songs;

    // todo: add Albums and Artists -mike
    public function __construct(SongsInterface $songs)
    {
        $this->songs = $songs;
    }

    public function songs()
    {
        // todo: how can we make this more dynamic? -mike
        $ids = [1, 5, 10, 20, 40, 80];

        $songs = $this->songs->getSongsByIds($ids);

        // todo: add migration for table `unq_file_data_flac` -mike
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