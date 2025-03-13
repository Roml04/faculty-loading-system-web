<?php

namespace Tests\Feature\Models;

use App\Models\Course;
use App\Models\Section;
use Database\Seeders\ClassTimeSlotSeeder;
use Database\Seeders\CourseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{

    use RefreshDatabase;
    
    public function test_course_has_many_tertiary_section_class() {
        $this->seed(CourseSeeder::class);
        $this->seed(ClassTimeSlotSeeder::class);

        $course = Course::first();

        $this->assertNotNull($course);
        $relatedClasses = $course->tertiarysectionclass;

        $this->assertGreaterThan(0, $relatedClasses->count());
        $this->assertInstanceOf(Section::class, $relatedClasses->first());
    }
}
