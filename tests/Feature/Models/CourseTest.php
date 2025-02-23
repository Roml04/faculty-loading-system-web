<?php

namespace Tests\Feature\Models;

use App\Models\Course;
use App\Models\Program;
use App\Models\TertiarySectionClass;
use Database\Seeders\CourseSeeder;
use Database\Seeders\TertiarySectionClassSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{

    use RefreshDatabase;
    
    public function test_course_has_many_tertiary_section_class() {
        $this->seed(CourseSeeder::class);
        $this->seed(TertiarySectionClassSeeder::class);

        $course = Course::first();

        $this->assertNotNull($course);
        $relatedClasses = $course->tertiarysectionclass;

        $this->assertGreaterThan(0, $relatedClasses->count());
        $this->assertInstanceOf(TertiarySectionClass::class, $relatedClasses->first());
    }
}
