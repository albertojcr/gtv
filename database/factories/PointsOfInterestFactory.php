<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\Place;
use App\Models\PointOfInterest;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(PointOfInterest::class, function (Faker $faker) {
    return [
        'qr' => Str::random(35),
        'distance' => $faker->randomNumber(2),
        'latitude' => $faker->latitude($min = 3, $max = 20),
        'longitude' => $faker->longitude($min = 3, $max = 20),
        'creator'=> $faker->randomElement(User::all()->pluck('id')->toArray()),
        'updater' => $faker->randomElement(User::all()->pluck('id')->toArray()),
        'place_id'=>$faker->randomElement(Place::all()->pluck('id')->toArray()),
        'creation_date' => $faker->dateTimeThisMonth,
        'last_update_date' => $faker->dateTimeThisMonth,
    ];
});
