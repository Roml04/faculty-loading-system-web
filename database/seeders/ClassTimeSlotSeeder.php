<?php

namespace Database\Seeders;

use App\Models\ClassTimeSlot;
use App\Models\Course;
use App\Models\Room;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassTimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 20; $i++) {            
            $teacher = Teacher::inRandomOrder()->first();
            $course = Course::inRandomOrder()->first();
            $room = Room::inRandomOrder()->first();
            
            ClassTimeSlot::create([
                'teachers_id' => $teacher->id,
                'courses_id' => $course->id,
                'rooms_id' => $room->id,
                // seeder for column class time start
                // seeder for column class time end
                'day_of_week' => fake()->randomElement([
                    'monday', 
                    'tuesday', 
                    'wednesday', 
                    'thursday', 
                    'friday', 
                    'saturday', 
                    'sunday'
                ])
            ]);

        }
    }
}
