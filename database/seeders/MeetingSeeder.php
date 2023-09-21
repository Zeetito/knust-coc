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
        $meetings = [
            ['name' => 'Sunday Morning Service', 'description' => 'Sunday Meeting for Worship', 'is_active' => 1],
            ['name' => 'Gents Training', 'description' => 'A training session for the gents', 'is_active' => 1],
            ['name' => 'Ladies Training', 'description' => 'A training session for the ladies', 'is_active' => 1],
            ['name' => 'Tuesday Evening', 'description' => 'A meeting for worship', 'is_active' => 1],
            ['name' => 'Friday Evening', 'description' => 'A meeting for worship', 'is_active' => 1],
            ['name' => 'Time Of Concecration', 'description' => 'A meeting for worship', 'is_active' => 1],
            ['name' => 'Dawn Broadcast', 'description' => 'Preaching the gosple at some designated zones at dawn.'],
            ['name' => 'Morning Devotion', 'description' => 'A dawn meeting for worship'],
        ];

        foreach ($meetings as $meeting) {
            Meeting::create($meeting);
        }
    }
}
