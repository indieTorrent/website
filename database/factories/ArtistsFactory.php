<?php

use App\MusicEntity;
use App\Country;
use App\User;
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

$factory->define(MusicEntity::class, function (Faker $faker) {

    $faker->addProvider(new \Faker\Provider\en_US\Address($faker));

    return [
        'moniker' => $faker->company,
        'alt_moniker' => $faker->company,
        'city' => $faker->city,
        'territory' => $faker->state,
        'country_code' => 'US',
        'official_url' => $faker->url,
        'profile_url' => $faker->url,
        'is_active' => $faker->boolean(80),
        'approved_at' => $faker->dateTimeThisYear('now', $faker->timezone),
        'approver_id' => $faker->numberBetween(1, User::count()),
        'owner_id' => function() {
            return factory(User::class)->create()->id;
        },
    ];
});
