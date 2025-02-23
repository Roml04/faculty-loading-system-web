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
            'Computer Science',
            'Information Technology',
            'Business Administration',
            'Hospitality Management',
            'Accountancy',
            'Tourism Management',
            'Computer Engineering'
        ];
        
        foreach($programs as $program) {
            Program::create([
                'program_name' => $program
            ]);
        }
    }
}
