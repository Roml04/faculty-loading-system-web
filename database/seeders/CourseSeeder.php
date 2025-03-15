<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            'Soft Eng II', 
            'Mode Sim', 
            'Adv Web Prog', 
            'Game Prog', 
            'Thesis I', 
            'Com Org', 
            'Pro Lans',
            'Data Struct',
            'HCI',
            'AI'
        ];

        foreach($courses as $course) {
            Course::create([
                'course_name' => $course
            ]);
        }
    }
}
