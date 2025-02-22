<?php

namespace Tests\Feature\Models;

use App\Models\Room;
use App\Models\TertiarySectionClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomTest extends TestCase
{
    public function test_rooms_has_many_tertiary_section_class() {
        $room = Room::factory()->create();
        $tertiarysectionclass = TertiarySectionClass::factory()->count(4)->create([
            'room_id' => $room->id,
        ]);

        $this->assertCount(4, $room->tertiarysectionclass);
    }
}
