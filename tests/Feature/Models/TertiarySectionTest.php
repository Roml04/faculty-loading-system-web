<?php

namespace Tests\Feature\Models;

use App\Models\Program;
use App\Models\TertiarySection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TertiarySectionTest extends TestCase
{
    public function test_tertiary_section_belongs_to_program() {
        $program = Program::factory()->create();
        $tertiarysection = TertiarySection::factory()->create([
            'program_id' => $program->id,
        ]);

        $this->assertTrue($tertiarysection->program->is($program));
    }
}
