<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\PointOfInterest;
use App\Models\User;
use App\Models\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    $pointOfInterest = $faker->randomElement(PointOfInterest::all()->pluck('id')->toArray());
    $thematicAreas = PointOfInterest::find($pointOfInterest)->thematicAreas->pluck('id')->toArray();
    $description = $faker->sentence(5);

    $foundVideos = PointOfInterest::find($pointOfInterest)->videos;

    \count($foundVideos) > 0
        ? $order = \count($foundVideos) + 1
        : $order = 1;

    return [
        'route' => 'videos/' . $faker->uuid() . '.mp4',
        'point_of_interest_id' => $pointOfInterest,
        'order' => $order,
        'creator' => $faker->randomElement(User::all()->pluck('id')->toArray()),
        'updater' => null,
        'thematic_area_id' => $faker->randomElement($thematicAreas),
        'description' => $description,
    ];
});
