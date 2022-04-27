<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\PointOfInterest;
use App\ThematicArea;
use App\User;
use App\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'name'  =>  $faker->sentence,
        'order'=> $faker->randomDigit,
        'published' => $faker->boolean,
        'thematic_area_id' => $faker->randomElement(ThematicArea::all()->pluck('id')->toArray()),
        'creator' => $faker->randomElement(User::all()->pluck('id')->toArray()),
        'updater' => $faker->randomElement(User::all()->pluck('id')->toArray()),
        'point_of_interest_id' => $faker->randomElement(PointOfInterest::all()->pluck('id')->toArray()),
        'date_create' => $faker->dateTimeThisMonth,
        'last_update' => $faker->dateTimeThisMonth,
    ];
});
