<?php

namespace Tests\Feature\Models;

use App\Models\Room;
use App\Models\TertiarySectionClass;
use Database\Seeders\RoomSeeder;
use Database\Seeders\TertiarySectionClassSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_rooms_has_many_tertiary_section_class() {
        $this->seed(RoomSeeder::class);
        $this->seed(TertiarySectionClassSeeder::class);

        $room = Room::first();

        $this->assertNotNull($room);
        $relatedClasses = $room->tertiarysectionclass;

        $this->assertGreaterThan(0, $relatedClasses->count());
        $this->assertInstanceOf(TertiarySectionClass::class, $relatedClasses->first());
    }
}
