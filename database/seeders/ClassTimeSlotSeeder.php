<?php

namespace Database\Seeders;

use App\Models\ClassTimeSlot;
use App\Models\Course;
use App\Models\Room;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassTimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 100; $i++) {            
            $teacher = Teacher::inRandomOrder()->first();
            $course = Course::inRandomOrder()->first();
            $room = Room::inRandomOrder()->first();

            $startHours = rand(6, 16);
            $minutes = rand(0, 1) * 30;
            $seconds = '00';
            $duration = rand(1, 4);
            
            ClassTimeSlot::create([
                'teachers_id' => $teacher->id,
                'courses_id' => $course->id,
                'rooms_id' => $room->id,
                'day_of_week' => rand(1, 6),
                'start' => Carbon::createFromTime($startHours, $minutes, $seconds)->format('H:i:s'),
                'end' => Carbon::createFromTime($startHours + $duration, $minutes, $seconds)->format('H:i:s'),
            ]);

        }
    }
}
