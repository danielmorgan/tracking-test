<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Point::class, function (Faker\Generator $faker) {
    return [
        'lat'         => $faker->latitude,
        'lon'         => $faker->longitude,
        'recorded_at' => Carbon\Carbon::now(),
    ];
});

$factory->define(App\LineString::class, function (Faker\Generator $faker) {
    $points = [];

    foreach (range(1, 10) as $i) {
        $lat = $faker->latitude;
        $lon = $faker->longitude;
        $points[] = factory(App\Point::class)->make(['lat' => $lat, 'lon' => $lon]);
    }

    return $points;
});
