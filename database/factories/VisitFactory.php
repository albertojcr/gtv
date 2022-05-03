<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\PointOfInterest;
use App\Models\Visit;
use Faker\Generator as Faker;

$factory->define(Visit::class, function (Faker $faker) {
    return [
        'hour' => $faker->dateTime(),
        'deviceid' => $faker->uuid,
        'appversion' => $faker->numberBetween(1, 10),
        'useragent' => $faker->word,
        'ssoo' => $faker->word,
        'ssooversion' => $faker->word,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'point_of_interest_id' => $faker->randomElement(PointOfInterest::all()->pluck('id')->toArray())
    ];
});
