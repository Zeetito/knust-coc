<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SemesterProgram>
 */
class SemesterProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $minDate = '2022-01-14'; // Set your desired minimum date
        $maxDate = '2023-12-31'; // Set your desired maximum date
        $start_date = fake()->dateTimeBetween($minDate, $maxDate)->format('Y-m-d');

        return [
            'name' => fake()->streetName(),
            'venue' => fake()->randomElement(['Basement', 'ProvidenceHostel']),
            'related_ministry' => fake()->randomElement(['welfare', 'finance', 'edification', 'organising', 'evangelism', 'all']),
            'start_date' => $start_date,
            'end_date' => $start_date,
        ];
    }
    
}
