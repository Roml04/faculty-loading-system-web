<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [];

        for($i = 1; $i <= 4; $i++) {
            for($j = 1; $j <= 5; $j++) {
                $sections[] = 100 * $i + $j;
            }
        }
        
        for($i = 0; $i < 20; $i++) {

            $year = fake()->randomElement([1, 2, 3, 4, 11, 12]);
            $level = in_array($year, [1, 2, 3, 4]) ? 'ter': 'shs';

            Section::create([
                'section_name' => 'ABC' . array_shift($sections),
                'year' => $year,
                'term' => fake()->randomElement([1, 2]),
                'level' => $level,
                'programs_id' => Program::inRandomOrder()->first()->id
            ]);
        }
    }
}
