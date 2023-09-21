<?php

namespace Database\Seeders;

use App\Models\Othername;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OthernameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Othername::factory(150)->create();
    }
}
