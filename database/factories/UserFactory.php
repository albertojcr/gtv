<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\ThematicArea;
use App\Models\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'login' => $faker->userName,
        'name' => $faker->firstName,
        'surnames' => $faker->lastName . ' ' . $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => '123456', // password
        'thematic_area_id' => $faker->randomElement(ThematicArea::all()->pluck('id')->toArray()),
        'active' => $faker->boolean()
    ];
});
