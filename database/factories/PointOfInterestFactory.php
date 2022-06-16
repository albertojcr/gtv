<?php

namespace Database\Factories;

use App\Models\Place;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PointOfInterestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'qr' => Str::random(35),
            'distance' => $this->faker->randomNumber(2),
            'latitude' => $this->faker->latitude(3, 20),
            'longitude' => $this->faker->longitude(3, 20),
            'creator'=> $this->faker->randomElement(User::all()->pluck('id')->toArray()),
            'updater' => $this->faker->randomElement(User::all()->pluck('id')->toArray()),
            'place_id'=>$this->faker->randomElement(Place::all()->pluck('id')->toArray()),
        ];
    }
}
