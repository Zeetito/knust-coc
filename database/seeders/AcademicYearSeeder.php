<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        AcademicYear::create([
            'name' => '2021-2022',
            'started_at' => '2022-02-24 15:53:08',
            'ended_at' => '2022-10-18 15:53:08',
            
        ]);
        AcademicYear::create([
            'name' => '2022-2023',
            'started_at' => '2023-01-14 15:53:08',
            
        ]);

    }
}
