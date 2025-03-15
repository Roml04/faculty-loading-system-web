<?php

namespace Tests\Feature\Models;

use App\Models\ClassTimeSlot;
use App\Models\Teacher;
use Database\Seeders\ClassTimeSlotSeeder;
use Database\Seeders\TeacherSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeacherTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_teacher_has_many_classes()
    {
        $this->seed(TeacherSeeder::class);
        $this->seed(ClassTimeSlotSeeder::class);

        $teacher = Teacher::first();

        $this->assertNotNull($teacher);
        $relatedClasses = $teacher->tertiarysectionclass;

        $this->assertGreaterThan(0, $relatedClasses->count());
        $this->assertInstanceOf(ClassTimeSlot::class, $relatedClasses->first());
    }
}
