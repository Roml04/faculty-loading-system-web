<?php

namespace Tests\Feature\Models;

use App\Models\Course;
use App\Models\Room;
use App\Models\Teacher;
use App\Models\TertiarySection;
use App\Models\TertiarySectionClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TertiarySectionClassTest extends TestCase
{
    public function test_tertiary_section_class_belongs_to_many_tertiary_section(): void
    {
        $tertiarysection = TertiarySection::factory()->create();
        $tertiarysectionclass = TertiarySectionClass::factory()->count(2)->create();

        $tertiarysection->tertiarysectionclass()->attach($tertiarysectionclass->pluck('id'));

        $this->assertCount(2, $tertiarysection->tertiarysectionclass); // Ensures section is linked to 2 schedules
    }

    public function test_tertiary_section_class_belongs_to_teacher()
    {
        $teacher = Teacher::factory()->create();
        $tertiarysectionclass = TertiarySectionClass::factory()->create([
            'teacher_id' => $teacher->id,
        ]);

        $this->assertTrue($tertiarysectionclass->teacher->is($teacher)); // Ensures class belongs to the correct teacher
    }

    public function test_tertiary_section_class_belongs_to_course()
    {
        $course = Course::factory()->create();
        $tertiarysectionclass = TertiarySectionClass::factory()->create([
            'course_id' => $course->id,
        ]);

        $this->assertTrue($tertiarysectionclass->course->is($course)); // Ensures class belongs to the correct course
    }

    public function test_tertiary_section_class_belongs_to_room()
    {
        $room = Room::factory()->create();
        $tertiarysectionclass = TertiarySectionClass::factory()->create([
            'room_id' => $room->id,
        ]);
    
        $this->assertTrue($tertiarysectionclass->room->is($room)); // Ensures class is assigned to the correct room
    }
}
