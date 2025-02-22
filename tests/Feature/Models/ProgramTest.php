<?php

namespace Tests\Feature\Models;

use App\Models\Program;
use App\Models\TertiarySection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProgramTest extends TestCase
{
    public function test_program_has_many_tertiary_sections()
    {
        $program = Program::factory()->create();
        $tertiarysection = TertiarySection::factory()->count(3)->create([
            'program_id' => $program->id,
        ]);

        $this->assertCount(3, $program->tertiarysections);
    }
}
