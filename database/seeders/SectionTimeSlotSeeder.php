<?php

namespace Database\Seeders;

use App\Models\ClassTimeSlot;
use App\Models\Section;
use App\Models\SectionTimeSlot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionTimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 100; $i++) {
            $section = Section::inRandomOrder()->first();
            $classtimeslot = ClassTimeSlot::inRandomOrder()->first();

            SectionTimeSlot::create([
                'sections_id' => $section->id,
                'class_time_slots_id' => $classtimeslot->id
            ]);
        }
    }
}
