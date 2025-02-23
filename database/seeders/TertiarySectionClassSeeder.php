<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Room;
use App\Models\Teacher;
use App\Models\TertiarySectionClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TertiarySectionClassSeeder extends Seeder
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
            
            TertiarySectionClass::create([
                'teachers_id' => $teacher->id,
                'courses_id' => $course->id,
                'rooms_id' => $room->id,
                'time_range' => DB::raw("'[2025-02-23 10:00, 2025-02-23 12:00]'::tsrange"),
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
