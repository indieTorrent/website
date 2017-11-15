<?php

namespace Tests\Unit;

use App\Songs\Contracts\FeaturedSongsInterface;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeaturedSongsTest extends TestCase
{
    use RefreshDatabase;

    protected $table = 'featured_songs';

    protected $cooldown_table = 'featured_songs_cooldown';

    protected $db_connection = 'sqlite';

    protected $repo;

    protected $db;

    public function setUp()
    {
        parent::setUp();

        $this->repo = $this->app->make(FeaturedSongsInterface::class);
        $this->db = DB::connection($this->db_connection);

    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function test_can_add_artist_to_cooldown()
    {
        $this->repo->addArtistToCooldown(1);

        $result = $this->db->table($this->cooldown_table)
            ->where('artist_id', 1)
            ->first()
            ->artist_id;

        $this->assertTrue(($result == 1), 'Artist was NOT added to cooldown');
    }

    public function test_artist_in_cooldown()
    {
        $this->repo->addArtistToCooldown(1);

        $result = $this->repo->isArtistInCooldown(1);
        $this->assertTrue($result, 'Artist is NOT in cooldown');
    }

}
