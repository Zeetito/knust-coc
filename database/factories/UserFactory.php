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
        $rand = rand(1,2);
        if ($rand === 1) {
            $gender ="m";
        }else{
            $gender ="f";
        }

        return [
            'username' => fake()->unique()->username(),
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'gender' => $gender,
            'is_activated'=>1,
            'is_student'=> rand(0,1),
            'is_member'=> rand(0,1),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
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
