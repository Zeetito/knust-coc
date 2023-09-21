<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Semester::create([
            'name' => 'First Semester',
            'started_at' => '2022-01-14 15:53:08',
            'ended_at' => '2022-04-28 15:53:08',
            'status' => 1,
        ]);

        Semester::create([
            'name' => 'Second Semester',
            'started_at' => '2022-05-18 15:53:08',
            'ended_at' => '2022-09-24 15:53:08',
            'status' => 2,
        ]);
        Semester::create([
            'name' => 'First Semester',
            'started_at' => '2023-01-14 15:53:08',
            'ended_at' => '2023-04-28 15:53:08',
            'status' => 1,
        ]);

        Semester::create([
            'name' => 'Second Semester',
            'started_at' => '2023-05-18 15:53:08',
            'ended_at' => '2023-09-24 15:53:08',
            'status' => 2,
        ]);
    }
}
