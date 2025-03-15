<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [];

        for($i = 1; $i <= 2; $i++) {
            for($j = 1; $j <= 11; $j++) {
                $rooms[] = $i === 1 ? 200 + $j : 300 + $j;
            }
        }

        for($i = 0; $i < 22; $i++) {
            Room::create([
                'room_name' => 'RM ' . array_shift($rooms),
                'room_type' => fake()->randomElement(['lecture', 'laboratory'])
            ]);
        }
    }
}
