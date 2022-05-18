<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'login' => $this->faker->userName,
            'password' => '123456',
            'salt' => 'salt-here',
            'email' => $this->faker->unique()->safeEmail,
            'profile' => $this->faker->words(2),
        ];
    }
}
