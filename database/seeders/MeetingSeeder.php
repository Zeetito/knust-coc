<?php

namespace Database\Seeders;

use App\Models\Meeting;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meetings = [
            ['name' => 'Sunday Morning Service', 'description' => 'Sunday Meeting for Worship'],
            ['name' => 'Tuesday Evening', 'description' => 'A meeting for worship'],
            ['name' => 'Friday Evening', 'description' => 'A meeting for worship'],
            ['name' => 'Gents Training', 'description' => 'A training session for the gents'],
            ['name' => 'Ladies Training', 'description' => 'A training session for the ladies'],
            ['name' => 'Dawn Broadcast', 'description' => 'Preaching the gosple at some designated zones at dawn.'],
            ['name' => 'Morning Devotion', 'description' => 'A dawn meeting for worship'],
            ['name' => 'Joses Project', 'description' => 'Joeses Week'],
            ['name' => 'Time Of Concecration', 'description' => 'A meeting for worship'],
            ['name' => 'Youth Awakening Lectureship', 'description' => 'Lectureship'],
        ];

        foreach ($meetings as $meeting) {
            Meeting::create($meeting);
        }
    }
}
