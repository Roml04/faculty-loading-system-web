<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            ['Accountancy', 'ter'],
            ['Computer Engineering', 'ter'],
            ['Computer Science', 'ter'],
            ['Business Administration', 'ter'],
            ['Hospitality Management', 'ter'],
            ['Information Technology', 'ter'],
            ['Tourism Management', 'ter'],
            ['ABM', 'shs'],
            ['Culinary Arts', 'shs'],
            ['ITMAWD', 'shs'],
            ['STEM', 'shs'],
        ];
        
        foreach($programs as $program) {
            Program::create([
                'program_name' => $program[0],
                'level' => $program[1],
                'path' => 'assets/images/' . str_replace(" ", "", strtolower($program[0])) . '.webp'
            ]);
        }
    }
}
