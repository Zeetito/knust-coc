<?php

namespace Database\Factories;

use App\Models\Meeting;
use App\Models\Semester;
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
        $sem_id = Semester::findByDate($start_date)->id;
        $meeting = Meeting::all()->random();

        return [
            'name' => $meeting->name." - ".fake()->streetName(),
            'venue' => fake()->randomElement(['Basement', 'ProvidenceHostel']),
            'related_ministry' => fake()->randomElement(['welfare', 'finance', 'edification', 'organising', 'evangelism', 'all']),
            'meeting_id' => $meeting->id,
            'semester_id' => $sem_id,
            'start_date' => $start_date,
            'end_date' => $start_date,
        ];
    }
}
