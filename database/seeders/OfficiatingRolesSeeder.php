<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficiatingRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $OfficiatingRoles = [
            ['name' => 'Songs Leader (MC)'],
            ['name' => 'Bible Class Teacher'],
            ['name' => 'Sermonist'],
            ['name' => "Lord's Supper Leader"],
            ['name' => 'Bible Reader'],
            ['name' => 'Scripture Reader'],
            ['name' => 'Panelist'],
            ['name' => 'Prayer Leader'],

        ];

        foreach ($OfficiatingRoles as $OfficiatingRole) {
            DB::table('officiating_roles')->insert(
                [
                    'name' => $OfficiatingRole['name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

    }
}
