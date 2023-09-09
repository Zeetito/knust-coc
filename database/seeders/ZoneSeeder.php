<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Zone::create([
            'name' => 'BOADI',
            'boundaries'=>'no description',
            // 'rep_id'=>'Agyare',
        ]);

        Zone::create([
            'name' => 'BOMSO',
            'boundaries'=>'no description',
        ]);

        Zone::create([
            'name' => 'CAMPUS',
            'boundaries'=>'no description',
        ]);

        Zone::create([
            'name' => 'FORD_NYBERG_SPLENDOR',
            'boundaries'=>'no description',
        ]);

        Zone::create([
            'name' => 'GAZA_DEDUAKO',
            'boundaries'=>'no description',
        ]);

        Zone::create([
            'name' => 'KOTEI',
            'boundaries'=>'no description',
        ]);

        Zone::create([
            'name' => 'NEWSITE',
            'boundaries'=>'no description',
        ]);

        Zone::create([
            'name' => 'SHALOM',
            'boundaries'=>'no description',
        ]);

        Zone::create([
            'name' => 'WESTEND',
            'boundaries'=>'no description',
        ]);

        Zone::create([
            'name' => 'OTHERS',
            'boundaries'=>'no description',
        ]);


    }
}
