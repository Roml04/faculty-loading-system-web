<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class ClassTimeSlotController extends Controller
{
    public function fetchTimeslots($id) {
        $section = Section::whereId($id)->first();
        
        $classtimeslots = $section->classtimeslot;

        foreach($classtimeslots as $classtimeslot) {

            $events[] = [
                "title" => $classtimeslot->course->course_name,
                "startTime" => $classtimeslot->start,
                "endTime" => $classtimeslot->end,
                "daysOfWeek" => [$classtimeslot->day_of_week]
            ];
        }

        return response()->json($events);
    }
}
