<?php

namespace Database\Seeders;

use App\Models\College;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        College::create([
            'name' => 'COLLEGE OF AGRICULTURE AND NATURAL RESOURCES',
        ]);
        College::create([
            'name' => 'COLLEGE OF HUMANITY AND SOCIAL SCIENCES',
        ]);
        College::create([
            'name' => 'COLLEGE OF ENGINEERING',
        ]);
        College::create([
            'name' => 'COLLEGE OF ART AND BUILT ENVIRONMENT',
        ]);
        College::create([
            'name' => 'COLLEGE OF SCIENCE',
        ]);
        College::create([
            'name' => 'COLLEGE OF HEALTH SCIENCES',
        ]);
    }
}
