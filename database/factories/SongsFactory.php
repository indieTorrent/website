<?php

use App\Album;
use App\Sku;
use App\Song;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Song::class, function (Faker $faker) {

    $album_id = $faker->numberBetween(1, Album::count());

    return [
        'name' => $faker->company,
        'alt_name' => $faker->company,
        'album_id' => $album_id,
        'song_order' => songOrder($album_id),
        'sku_id' => function() {
            return factory(Sku::class)->create()->id;
        },
        'preview_start' => $faker->numberBetween(0, 60),
        'is_active' => $faker->boolean(85),
        'is_in_back_catalog' => $faker->boolean(15),
    ];
});

function songOrder($album_id)
{
    $count = Song::where('album_id', $album_id)->count();
    return $count + 1;
}
