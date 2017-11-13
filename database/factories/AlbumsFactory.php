<?php

use App\Album;
use App\Artist;
use App\Genre;
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

$factory->define(Album::class, function (Faker $faker) {

    $artist_id = $faker->numberBetween(1, Artist::count());

    return [
        'artist_id' => $artist_id,
        'title' => $faker->company,
        'alt_title' => $faker->company,
        'type' => 'f', // todo: not sure what to do with this -mike 11/13/2017
        'year' => $faker->year('now'),
        'genre_id' => $faker->numberBetween(1, Genre::count()),
        'description' => $faker->sentence(10),
        'has_explicit_lyrics' => $faker->boolean(75),
        'is_active' => $faker->boolean(80)
    ];
});
