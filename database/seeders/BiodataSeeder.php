<?php

namespace Database\Seeders;

use App\Models\Biodata;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BiodataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Biodata::factory(501)->create();
    }
}
