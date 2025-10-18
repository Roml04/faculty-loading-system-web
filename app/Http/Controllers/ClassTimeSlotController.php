<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\Browsershot\Browsershot;

use function Spatie\LaravelPdf\Support\pdf;

class ClassTimeSlotController extends Controller
{
    public function sectionTimeSlots($id) {
        $section = Section::whereId($id)->first();
        
        $classtimeslots = $section->classtimeslot;

        foreach($classtimeslots as $classtimeslot) {

            $events[] = [
                "title" => $classtimeslot->courses->course_name,
                "startTime" => $classtimeslot->start,
                "endTime" => $classtimeslot->end,
                "daysOfWeek" => [$classtimeslot->day_of_week],
                "extendedProps" => [
                    "teacherName" => $classtimeslot->teachers->teacher_name,
                    "roomNumber" => $classtimeslot->rooms->room_name,
                    "roomType" => ucfirst($classtimeslot->rooms->room_type),
                ]
            ];
        }

        $schedules = collect($events);

        $schedules = $schedules->sortBy(function($item) {
            return strtotime($item['startTime']);
        })->values()->all();
        
        return response()->json($schedules);

    }

    public function teacherTimeSlots($id) {
        $teacher = Teacher::whereId($id)->first();

        $teachertimeslots = $teacher->tertiarysectionclass;

        foreach($teachertimeslots as $teachertimeslots) {

            $events[] = [
                "title" => $teachertimeslots->courses->course_name,
                "startTime" => $teachertimeslots->start,
                "endTime" => $teachertimeslots->end,
                "daysOfWeek" => [$teachertimeslots->day_of_week],
                "extendedProps" => [
                    "teacherName" => $teachertimeslots->teachers->teacher_name,
                    "roomNumber" => $teachertimeslots->rooms->room_name,
                    "roomType" => ucfirst($teachertimeslots->rooms->room_type),
                ]
            ];
        }

        return response()->json($events);
    }
}