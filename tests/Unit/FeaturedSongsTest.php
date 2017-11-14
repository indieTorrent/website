<?php

namespace Tests\Unit;

use App\Songs\Repositories\FeaturedSongsRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\CreatesApplication;
use Tests\TestCase;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeaturedSongsTest extends TestCase
{
    use DatabaseMigrations, CreatesApplication;

    protected $faker;

    protected $repo;

    public function setUp()
    {
        parent::setUp();

        $this->faker = Faker::create();

        $this->repo = $this->createMock(FeaturedSongsRepository::class);

        $this->seed();
    }

    public function tearDown()
    {
        $this->artisan('migrate:reset');

        parent::tearDown();
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_responds_with_status_code_200()
    {
        $code = $this->get('api/featured/songs')->status();
        $this->assertTrue(($code == 200), 'Result: ' . $code);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_artist_in_cooldown()
    {
        $this->assertTrue($this->repo->isArtistInCooldown(5));
    }

}
