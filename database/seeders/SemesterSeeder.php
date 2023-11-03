<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Semester::create([
            'academic_year_id' => 1,
            'name' => 1,
            'started_at' => '2022-01-14 00:00:00',
            'ended_at' => '2022-04-28 23:59:59',
        ]);

        Semester::create([
            'academic_year_id' => 1,
            'name' => 2,
            'started_at' => '2022-05-18 00:00:00',
            'ended_at' => '2022-09-24 23:59:59',
        ]);
        Semester::create([
            'academic_year_id' => 2,
            'name' => 1,
            'started_at' => '2023-01-14 00:00:00',
            'ended_at' => '2023-04-28 23:59:59',
        ]);

        Semester::create([
            'academic_year_id' => 2,
            'name' => 2,
            'started_at' => '2023-05-18 00:00:00',
            'ended_at' => '2023-09-24 23:59:59',
            'is_active' => 1,
        ]);
    }
}
