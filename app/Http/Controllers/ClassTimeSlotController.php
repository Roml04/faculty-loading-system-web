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

        $formattedSchedules = [
            1 => [],
            2 => [],
            3 => [],
            4 => [],
            5 => [],
            6 => []
        ];
        

        foreach ($formattedSchedules as $key => $array) {
            
            foreach ($schedules as $schedule) {
                if ($schedule['daysOfWeek'][0] === $key) {
                    array_push($formattedSchedules[$key], [
                        "title" => $schedule['title'],
                        "startTime" => Carbon::createFromFormat('H:i:s', $schedule['startTime'])->format('g:i A'),
                        "endTime" => Carbon::createFromFormat('H:i:s', $schedule['endTime'])->format('g:i A'),
                        "daysOfWeek" => $schedule['daysOfWeek'][0],
                        "extendedProps" => [
                            "teacherName" => $schedule['extendedProps']['teacherName'],
                            "roomNumber" => $schedule['extendedProps']['roomNumber'],
                            "roomType" => $schedule['extendedProps']['roomType'],
                        ]
                    ]);
                }

            }

        }

        $days = [
            'Monday' => count($formattedSchedules[1]),
            'Tuesday' => count($formattedSchedules[2]),
            'Wednesday' => count($formattedSchedules[3]),
            'Thursday' => count($formattedSchedules[4]),
            'Friday' => count($formattedSchedules[5]), 
            'Saturday' => count($formattedSchedules[6])
        ];

        $formattedSchedules = array_combine(array_keys($days), array_values($formattedSchedules));

        return view('components.timetable-layout', ['id' => $id, 'days' => $formattedSchedules, 'rowCount' => max(array_values($days))]);
    }
}