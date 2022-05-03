<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\Video;
use App\Models\VideoItem;
use Faker\Generator as Faker;

$factory->define(VideoItem::class, function (Faker $faker) {
    $qualities = array('360p', '480p', '720p', '1080p', '4K');
    $formats = array('avi', 'mp4', 'ogg');
    $orientations = array('horizontal', 'vertical');
    return [
        'video_id' => $faker->randomElement(Video::all()->pluck('id')->toArray()),
        'quality' => $faker->randomElement($qualities),
        'format' => $faker->randomElement($formats),
        'orientation' => $faker->randomElement($orientations),
        'language' => $faker->languageCode
    ];
});
