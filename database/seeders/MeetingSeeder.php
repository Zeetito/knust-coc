<?php

namespace Database\Seeders;

use App\Models\Meeting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Meeting::create([
            'name' => 'Sunday Morning Service',
            'description' => 'Sunday Meeting for Worship',
            'is_active' => 1
        ]);

        Meeting::create([
            'name' => 'Gents Training',
            'description' => 'A training session for the gents',
            'is_active' => 1
        ]);

        Meeting::create([
            'name' => 'Ladies Training',
            'description' => 'A training session for the ladies',
            'is_active' => 1
        ]);

        Meeting::create([
            'name' => 'Tuesday Evening',
            'description' => 'A meeting for worship',
            'is_active' => 1
        ]);

        Meeting::create([
            'name' => 'Friday Evening',
            'description' => 'A meeting for worship',
            'is_active' => 1
        ]);

        Meeting::create([
            'name' => 'Time Of Concecration',
            'description' => 'A meeting for worship',
            'is_active' => 1
        ]);


        Meeting::create([
            'name' => 'Dawn Broadcast',
            'description' => 'Preaching the gosple at some designated zones at dawn.',
            'is_active' => 0
        ]);

        Meeting::create([
            'name' => 'Morning Devotion',
            'description' => 'A dawn meeting for worship',
            'is_active' => 0
        ]);


    }
}
