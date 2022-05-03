<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\PointOfInterest;
use App\Models\ThematicArea;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoItem;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

$factory->define(Video::class, function (Faker $faker) {

        $description = $faker->sentence(5);
        $slug = Str::slug($description);

        return [
            'route' => $slug . '.mp4',
            'point_of_interest_id' => $faker->randomElement(PointOfInterest::all()->pluck('id')->toArray()),
            'order'=> $faker->randomDigit,
            'date_create' => Carbon::now(),
            'last_update' => Carbon::now(),
            'creator' => $faker->randomElement(User::all()->pluck('id')->toArray()),
            'updater' => $faker->randomElement(User::all()->pluck('id')->toArray()),
            'code_id' => $faker->randomDigitNotZero(),
            'thematic_area_id' => $faker->randomElement(ThematicArea::all()->pluck('id')->toArray()),
            'description' => $description,
            'url' => $slug,
        ];
});
