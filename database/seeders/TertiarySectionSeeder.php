<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\TertiarySection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TertiarySectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = Program::doesntHave('tertiarysection')->inRandomOrder()->get();

        $programArr = [];

        foreach($programs as $program) {
            $programArr[] = $program;
        }

        $sections = [];

        for($i = 1; $i <= 4; $i++) {
            for($j = 1; $j <= 5; $j++) {
                $sections[] = 100 * $i + $j;
            }
        }

        for($i = 0; $i < 20; $i++) {
            TertiarySection::create([
                'section_name' => 'ABC' . array_shift($sections),
                'year' => fake()->randomElement(['first_year', 'second_year', 'third_year', 'fourth_year']),
                'term' => fake()->randomElement(['first_term', 'second_term']),
                'programs_id' => $programArr[fake()->numberBetween(0, ($programs->count() - 1))]->id
            ]);
        }
    }
}
