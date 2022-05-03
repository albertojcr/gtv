<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\Photography;
use App\Models\PointOfInterest;
use App\Models\ThematicArea;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Photography::class, function (Faker $faker) {
    return [
        'name'  =>  $faker->sentence,
        'point_of_interest_id' => $faker->randomElement(PointOfInterest::all()->pluck('id')->toArray()),
        'order' => $faker->randomDigit,
        'published' => $faker->boolean,
        'creator' => $faker->randomElement(User::all()->pluck('id')->toArray()),
        'updater' => $faker->randomElement(User::all()->pluck('id')->toArray()),
        'thematic_area_id' => $faker->randomElement(ThematicArea::all()->pluck('id')->toArray()),
        'date_create' => $faker->dateTimeThisMonth,
        'last_update' => $faker->dateTimeThisMonth,
    ];
});
