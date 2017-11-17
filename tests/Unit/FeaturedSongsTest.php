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

    public function test_removeArtistFromCooldown()
    {
        $this->addArtistToCooldown(5);
        $this->removeArtistFromCooldown(5);

        $get = DB::table($this->cooldown_table)->where('entity_id', 5)->get();

        $this->assertCount(0, $get);
    }

    public function test_addRandomSong()
    {
        $rid = $this->addRandomSong(1);

        $this->assertTrue(is_int($rid));

        $countable = DB::table($this->table)->where('song_id', $rid)->get();

        $this->assertCount(1, $countable);
    }

    public function test_removeSong()
    {
        $rid = $this->addRandomSong(1);
        $this->removeSong($rid);

        $countable = DB::table($this->table)->where('song_id', $rid)->get();

        $this->assertCount(0, $countable);
    }

    public function test_getRank()
    {
        $ranks = [1,2,3,4,5];

        $rid = $this->addRandomSong(1);
        $rank = $this->getRank($rid);

        $this->assertArrayHasKey($rank, $ranks);
    }

    public function test_hasExpired()
    {
        $expired = $this->hasExpired(\Carbon\Carbon::now()->subDays(5));

        $this->assertTrue($expired);
    }

    /*
     * ENDS TESTS
     */

    /*
     * METHOD WRAPPERS FOLLOWING CONTRACT (INSURES WE TEST EVERY UNIT)
     */


    public function getSongs(): collection
    {
        return $this->repo->getSongs();
    }

    public function getSongIds(): array
    {
        return $this->repo->getSongIds();
    }

    public function getCooldownArtistIds(): collection
    {
        return $this->repo->getCooldownArtistIds();
    }

    public function isArtistInCooldown($artist_id): bool
    {
        return $this->repo->isArtistInCooldown($artist_id);
    }

    public function addArtistToCooldown($artist_id): void
    {
        $this->repo->addArtistToCooldown($artist_id);
    }

    public function removeArtistFromCooldown($artist_id): void
    {
        $this->repo->removeArtistFromCooldown($artist_id);
    }

    public function addRandomSong($rank): int
    {
        return $this->repo->addRandomSong($rank);
    }

    public function removeSong($song_id): void
    {
        $this->repo->removeSong($song_id);
    }

    public function getRank($song_id): int
    {
        return $this->repo->getRank($song_id);
    }

    public function hasExpired($expires): bool
    {
        return $this->repo->hasExpired($expires);
    }
}
