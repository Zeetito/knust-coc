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
        $zones = [
            ['name' => 'BOADI'],
            ['name' => 'BOMSO'],
            ['name' => 'CAMPUS'],
            ['name' => 'FORD-NYBERG-SPLENDOR'],
            ['name' => 'GAZA-DEDUAKO'],
            ['name' => 'KOTEI'],
            ['name' => 'NEWSITE'],
            ['name' => 'SHALOM'],
            ['name' => 'WESTEND'],
            ['name' => 'OTHERS'],
        ];

        foreach ($zones as $zone) {
            Zone::create($zone);
        }
    }
}
