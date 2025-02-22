<?php

namespace Tests\Feature\Models;

use App\Models\Teacher;
use App\Models\TertiarySectionClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeacherTest extends TestCase
{
    public function test_teacher_has_many_classes()
{
    $teacher = Teacher::factory()->create();
    $classes = TertiarySectionClass::factory()->count(3)->create([
        'teacher_id' => $teacher->id,
    ]);

    $this->assertCount(3, $teacher->classes); // Ensures teacher has 3 classes
}
}
