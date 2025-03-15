<?php

namespace Tests\Feature\Models;

use App\Models\Program;
use App\Models\Section;
use Database\Seeders\ProgramSeeder;
use Database\Seeders\SectionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProgramTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_program_has_many_tertiary_sections() {
        $this->seed(ProgramSeeder::class);
        $this->seed(SectionSeeder::class);

        $program = Program::first();

        $this->assertNotNull($program);
        $relatedSections = $program->tertiarysection;

        $this->assertGreaterThan(0, $relatedSections->count());
        $this->assertInstanceOf(Section::class, $relatedSections->first());
    }
}
