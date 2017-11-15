<?php

namespace Tests\Unit;

use App\Song;
use App\Songs\Contracts\FeaturedSongsInterface;
use App\Songs\Contracts\SongsInterface;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class FeaturedSongsTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    protected $table = 'featured_songs';

    protected $cooldown_table = 'featured_songs_cooldown';

    protected $repo;

    public function setUp()
    {
        parent::setUp();

        $this->repo = $this->app->make(FeaturedSongsInterface::class);

        $this->seed();
    }

    public function test_add_artist_to_cooldown()
    {
        $this->repo->addArtistToCooldown(1);

        $result = DB::table($this->cooldown_table)
            ->where('artist_id', 1)
            ->first()
            ->artist_id;

        $this->assertTrue(($result == 1), 'addArtistToCooldown');
    }

    public function test_returns_array_of_all_song_ids_in_featured_songs_table()
    {
        $array = $this->repo->getSongIds();

        $key = DB::table($this->table)
            ->first()
            ->song_id;

        $this->assertTrue(is_array($array), 'getSongIds');
        $this->assertTrue(in_array($key, $array), 'getSongIds');
    }

    public function test_returns_collection_of_song_objects()
    {
        $expected = Song::class; // todo: want a way to check this using the Interface -mike
        $actual = $this->repo->getSongs($this->repo->getSongIds());

        $this->assertInstanceOf($expected, $actual[0], 'getSongs');
    }

    public function test_is_artist_in_cooldown()
    {
        $this->repo->addArtistToCooldown(1);

        $result = $this->repo->isArtistInCooldown(1);
        $this->assertTrue($result, 'isArtistInCooldown');
    }

}
