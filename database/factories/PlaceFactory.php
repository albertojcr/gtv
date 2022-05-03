<?php



namespace Database\Factories;

use App\Models\Place;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(\App\Models\Place::class, function (Faker $faker) {
    $user = User::all()->pluck('id')->toArray();
    return [
        'name'=> $faker->city,
        'description'=> $faker->word,
        'place_id'=> $faker->randomElement(Place::all()->pluck('id')->toArray()),
        'creator' => $faker->randomElement($user),
        'updater' => $faker->randomElement($user),
        'date_create'=> $faker->dateTimeThisMonth,
        'last_update' => $faker->dateTimeThisMonth,
    ];
});
