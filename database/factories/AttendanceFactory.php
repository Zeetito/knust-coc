<?php

namespace Database\Factories;

use App\Models\Meeting;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
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
            'meeting_type' => Meeting::all()->random()->id,
            'venue' => fake()->name(),
            'is_active' => 0,
            'semester_id' => Semester::all()->random()->id,

        ];
    }
}
