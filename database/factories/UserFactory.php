<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rand_gend = rand(1, 2);
        if ($rand_gend === 1) {
            $gender = 'm';
        } else {
            $gender = 'f';
        }

        return [
            'username' => fake()->unique()->username(),
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'othername' => fake()->lastName(),
            'gender' => $gender,
            'dob' => fake()->date(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'is_student' => rand(0, 1),
            'is_member' => rand(0, 1),
            'is_activated' => rand(0, 1),
            'is_available' => rand(0, 1),
            'is_baptized' => rand(0, 1),
            'is_member' => rand(0, 1),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
