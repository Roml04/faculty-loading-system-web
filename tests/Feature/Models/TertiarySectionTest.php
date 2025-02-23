<?php

namespace Tests\Feature\Models;

use App\Models\Program;
use App\Models\TertiarySection;
use Database\Seeders\ProgramSeeder;
use Database\Seeders\TertiarySectionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TertiarySectionTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_tertiary_section_belongs_to_program() {
        $this->seed(TertiarySectionSeeder::class);
        $this->seed(ProgramSeeder::class);
        
        
        $section = TertiarySection::first();
        $this->assertNotNull($section);
        
        $this->assertInstanceOf(Program::class, $section->program);
    }
}
