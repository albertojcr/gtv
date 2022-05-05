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

$factory->define(User::class, function (Faker $faker) { // TODO corregir factory, tira Array to string conversion
    return [
        'login' => $faker->userName,
        'password' => '123456',
        'salt' => 'salt-here',
        'email' => $faker->unique()->safeEmail,
        'profile' => $faker->words(2),
    ];
});
