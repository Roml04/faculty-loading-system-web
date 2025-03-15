<?php

namespace App\Http\Controllers;

use App\Models\ClassTimeSlot;
use Illuminate\Http\Request;

class ClassTimeSlotController extends Controller
{
    public function get_classtimeslots() {
        $classtimeslots = ClassTimeSlot::all();

        $events = [];

        foreach($classtimeslots as $timeslot) {

            $events[] = [
                "title" => $timeslot->course->course_name,
                "startTime" => $timeslot->start,
                "endTime" => $timeslot->end,
                "daysOfWeek" => [$timeslot->day_of_week]
            ];
        }

        return response()->json($events);
    }
}
