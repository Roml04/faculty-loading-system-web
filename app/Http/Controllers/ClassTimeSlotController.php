<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Teacher;
use Carbon\Carbon;

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

    public function exportTimeSlots($id) {

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

        $formattedSchedules = [];

        foreach ($schedules as $schedule) {
   
            array_push($formattedSchedules, [
                "title" => $schedule['title'],
                "startTime" => Carbon::createFromFormat('H:i:s', $schedule['startTime'])->format('g:i A'),
                "endTime" => Carbon::createFromFormat('H:i:s', $schedule['endTime'])->format('g:i A'),
                "daysOfWeek" => $schedule['daysOfWeek'],
                "extendedProps" => [
                    "teacherName" => $schedule['extendedProps']['teacherName'],
                    "roomNumber" => $schedule['extendedProps']['roomNumber'],
                    "roomType" => $schedule['extendedProps']['roomType'],
                ]
            ]);

        }

        $days = [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday'
        ];

        return view('components.timetable-layout', ['id' => $id, 'schedules' => $formattedSchedules, 'days' => $days]);
    }
}
