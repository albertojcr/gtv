<?php



namespace Database\Factories;

use App\Models\Place;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(\App\Models\Place::class, function (Faker $faker) {
    $users = User::all()->pluck('id')->toArray();
    return [
        'name'=> $faker->city,
        'description'=> $faker->word,
        'place_id'=> $faker->randomElement(Place::all()->pluck('id')->toArray()),
        'creator' => $faker->randomElement($users),
        'updater' => $faker->randomElement($users),
    ];
});
