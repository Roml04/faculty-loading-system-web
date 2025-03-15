<?php

namespace Tests\Feature\Models;

use App\Models\ClassTimeSlot;
use App\Models\Room;
use Database\Seeders\ClassTimeSlotSeeder;
use Database\Seeders\RoomSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_rooms_has_many_tertiary_section_class() {
        $this->seed(RoomSeeder::class);
        $this->seed(ClassTimeSlotSeeder::class);

        $room = Room::first();

        $this->assertNotNull($room);
        $relatedClasses = $room->tertiarysectionclass;

        $this->assertGreaterThan(0, $relatedClasses->count());
        $this->assertInstanceOf(ClassTimeSlot::class, $relatedClasses->first());
    }
}
