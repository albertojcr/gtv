<?php

namespace Database\Factories;

use App\Models\PointOfInterest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'hour' => $this->faker->dateTime(),
            'deviceid' => $this->faker->uuid,
            'appversion' => $this->faker->numberBetween(1, 10),
            'useragent' => $this->faker->word,
            'ssoo' => $this->faker->word,
            'ssooversion' => $this->faker->numberBetween(1, 10),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'point_of_interest_id' => $this->faker->randomElement(PointOfInterest::all()->pluck('id')->toArray())
        ];
    }
}
