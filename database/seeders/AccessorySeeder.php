<?php

namespace Database\Seeders;

use App\Models\Accessory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccessorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $Accessories = [
            ['name' => 'system_online', 'value'=>1],
            ['name' => 'pic_per_user', 'value'=>5],
           
        ];

        foreach ($Accessories as $Accessory) {
            Accessory::create($Accessory);
        }

    }
}
