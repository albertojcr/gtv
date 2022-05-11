<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\PointOfInterest;
use App\Models\ThematicArea;
use App\Models\User;
use App\Models\Video;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Video::class, function (Faker $faker) {

        $description = $faker->sentence(5);
        $slug = Str::slug($description);

        return [
            'route' => $slug . '.mp4', // TODO reemplazar por video de verdad en el seeder
            'point_of_interest_id' => $faker->randomElement(PointOfInterest::all()->pluck('id')->toArray()),
            'order'=> $faker->randomDigit,
            'creator' => $faker->randomElement(User::all()->pluck('id')->toArray()),
            'updater' => $faker->randomElement(User::all()->pluck('id')->toArray()),
            'code_id' => $faker->randomDigitNotZero(),
            'thematic_area_id' => $faker->randomElement(ThematicArea::all()->pluck('id')->toArray()),
            'description' => $description,
        ];
});
