<?php

namespace Tests\Feature\Models;

use App\Models\Course;
use App\Models\TertiarySectionClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    public function test_course_has_many_tertiary_section_class() {
        $course = Course::factory()->create();
        $tertiarysectionclass = TertiarySectionClass::factory()->create([
            'course_id' => $course->id,
        ]);

        $this->assertTrue($tertiarysectionclass->course->is($course));
    }
}
