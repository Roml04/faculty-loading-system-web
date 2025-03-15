<?php

namespace Tests\Feature\Models;

use App\Models\ClassTimeSlot;
use App\Models\Course;
use App\Models\Room;
use App\Models\Teacher;
use App\Models\TertiarySection;
use App\Models\TertiarySectionClass;
use Database\Seeders\ClassTimeSlotSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\RoomSeeder;
use Database\Seeders\TeacherSeeder;
use Database\Seeders\TertiarySectionClassSeeder;
use Database\Seeders\TertiarySectionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TertiarySectionClassTest extends TestCase
{
    // use RefreshDatabase;
    
    public function test_tertiary_section_class_belongs_to_many_tertiary_section(): void
    {
        // $this->seed(TertiarySectionClassSeeder::class);
        // $this->seed(TertiarySectionSeeder::class);
    }

    public function test_tertiary_section_class_belongs_to_teacher()
    {
        $this->seed(ClassTimeSlotSeeder::class);
        $this->seed(TeacherSeeder::class);

        $class = ClassTimeSlot::first();
        $this->assertNotNull($class);

        $this->assertInstanceOf(Teacher::class, $class->teacher);
    }

    public function test_tertiary_section_class_belongs_to_course()
    {
        $this->seed(ClassTimeSlotSeeder::class);
        $this->seed(CourseSeeder::class);

        $class = ClassTimeSlot::first();
        $this->assertNotNull($class);

        $this->assertInstanceOf(Course::class, $class->course);
    }

    public function test_tertiary_section_class_belongs_to_room()
    {
        $this->seed(ClassTimeSlotSeeder::class);
        $this->seed(RoomSeeder::class);

        $class = ClassTimeSlot::first();
        $this->assertNotNull($class);

        $this->assertInstanceOf(Room::class, $class->room);
    }
}
