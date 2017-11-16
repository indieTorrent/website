<?php

namespace Tests\Unit;

use App\Song;
use App\Songs\Contracts\FeaturedSongsInterface;
use App\Songs\Contracts\SongsInterface;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/*
 * We should always follow a contract for unit tests.
 * This will insure that we test every unit in the repository
 * thats being tested.
 *
 * Note the naming convention I chosen for the test_methods.
 * -mike
 */
class FeaturedSongsTest extends TestCase implements FeaturedSongsInterface
{
    /*
     * All Tests that interact with the DB should use these traits
     */
    use RefreshDatabase, DatabaseMigrations;

    protected $table;

    protected $cooldown_table;

    protected $repo;

    public function setUp()
    {
        /*
         * Do not change
         */
        parent::setUp();

        /*
         * Should always get the Interface instance from the container
         *
         * Note: this is why it is so important to "Code To An Interface"
         * -mike
         */
        $this->repo = $this->app->make(FeaturedSongsInterface::class);

        /*
         * We use this Database Seeder when testing DB interactions.
         * It seeds a much smaller amount of data just enough for testing purposes.
         * This reduces testing times.
         * -mike
         */
        $this->seed('TestsDatabaseSeeder');

        /*
         * FYI: you can get any property from the repo as long as the repository
         * extends App\Repositories\BaseRepository
         */
        $this->table = $this->repo->getProperty('table');
        $this->cooldown_table = $this->repo->getProperty('cooldown_table');
    }

    /*
     * STARTS TESTS
     *
     * Take note to the method naming convention test_theMethodThatsBeingTested()
     */

    public function test_getSongs()
    {
        $collection = $this->getSongs();
        $song = $this->app->make(SongsInterface::class)->instance();

        $this->assertInstanceOfCollection($collection);
        $this->assertInstanceOf(get_class($song), $collection->first());
    }

    public function test_getSongIds()
    {
        $array = $this->getSongIds();

        $key = DB::table($this->table)
            ->first()
            ->song_id;

        $this->assertTrue(is_array($array), 'getSongIds');
        $this->assertTrue(in_array($key, $array), 'getSongIds');
    }

    public function test_getCooldownArtistIds()
    {
        $a = [1,2,3,4,5];
        foreach($a as $b) {$this->addArtistToCooldown($b);}

        $collection = $this->getCooldownArtistIds();

        $this->assertInstanceOfCollection($collection);
        $this->assertTrue(($collection->count() === 5));
        $this->assertTrue(is_int($collection->first()));
    }

    public function test_addArtistToCooldown()
    {
        $this->addArtistToCooldown(1);

        $result = DB::table($this->cooldown_table)
            ->where('entity_id', 1)
            ->first()
            ->entity_id;

        $this->assertTrue(($result == 1), 'addArtistToCooldown');
    }

    public function test_isArtistInCooldown()
    {
        $this->addArtistToCooldown(1);

        $result = $this->isArtistInCooldown(1);
        $this->assertTrue($result, 'isArtistInCooldown');
    }

    /*
     * ENDS TESTS
     */

    /*
     * METHOD WRAPPERS FOLLOWING CONTRACT (INSURES WE TEST EVERY UNIT)
     */


    public function getSongs()
    {
        return $this->repo->getSongs();
    }

    public function getSongIds()
    {
        return $this->repo->getSongIds();
    }

    public function getCooldownArtistIds()
    {
        return $this->repo->getCooldownArtistIds();
    }

    public function isArtistInCooldown($artist_id)
    {
        return $this->repo->isArtistInCooldown($artist_id);
    }

    public function addArtistToCooldown($artist_id)
    {
        return $this->repo->addArtistToCooldown($artist_id);
    }

    public function removeArtistFromCooldown($artist_id)
    {
        return $this->repo->removeArtistFromCooldown($artist_id);
    }

    public function addRandomSong($rank = 1)
    {
        $this->repo->addRandomSong($rank = 1);
    }

    public function removeSong($song_id)
    {
        return $this->repo->removeSong($song_id);
    }

    public function getRank($song_id)
    {
        $this->repo->getRank($song_id);
    }

    public function hasExpired($expires)
    {
        $this->repo->hasExpired($expires);
    }
}
