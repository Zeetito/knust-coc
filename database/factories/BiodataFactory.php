<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Biodata>
 */
class BiodataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => User::all()->random()->id,
            'firstname' => fake()->firstName(),
            'othername'=> fake()->firstName(),
            'lastname' => fake()->lastName(),
            'zone_id' => rand(1,8),
            'residence_id' => rand(1,100),
            'room' => fake()->buildingNumber(),
            'program_id' => rand(1,100),

        ];
    }
}
