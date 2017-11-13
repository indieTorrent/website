<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Songs\Contracts\SongsInterface;

class FeaturedApiController extends Controller
{
    /**
     * @var SongsInterface
     */
    private $songs;

    // todo: add Albums and Artists -mike 11/12/2017
    public function __construct(SongsInterface $songs)
    {
        $this->songs = $songs;
    }

    public function songs()
    {
        // todo: how can we make this more dynamic? -mike 11/12/2017
        $ids = [
            1,
            5,
            10,
            20,
            40,
            80
        ];

        $songs = $this->songs->getSongsByIds($ids);

        // todo: change static data to dynamic (will need the relationships) -mike 11/12/2017
        // todo: add migration for table `unq_file_data_flac` -mike 11/12/2017
        // todo: maybe clean this up with an Laravel Api Resource Collection ? -mike 11/12/2017
        $response = [];

        foreach($songs as $key => $song) {
            $response[$key] = [
                'id' => $song->id,
                'name' => $song->name,
                // 'fileData' => $song->fileData, todo: add relationship -mike 11/12/2017
                'playTimeString' => '$song->fileData->playTimeString',
                // 'sku' => $song->sku todo: add relationship -mike 11/12/2017
                'sku' => '$song->sku->id'
            ];
        }

        return response($response, 200);
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