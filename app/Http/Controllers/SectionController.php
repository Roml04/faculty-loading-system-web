<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SectionController extends Controller
{
    public function indexSections($id, Request $request) {
        $program = Program::where('id', $id)->first();

        $sections = [];

        foreach($program->section as $section) {
            // if(count($section->classtimeslot) > 0) {
                $sections[] = $section;
            // }
        }

        return view('pages.section-schedules', ['sections' => $sections, 'programname' => $program->program_name, 'return_to' => $request->return_to]);
    }

    public function viewSection($id, Request $request) {

        $section = Section::whereId($id)->first();

        $classtimeslots = $section->classtimeslot;

        $events = [];

        foreach($classtimeslots as $classtimeslot) {

            array_push($events, [
                "title" => $classtimeslot->courses->course_name,
                "startTime" => $classtimeslot->start,
                "endTime" => $classtimeslot->end,
                "daysOfWeek" => [$classtimeslot->day_of_week],
                "extendedProps" => [
                    "teacherName" => $classtimeslot->teachers->teacher_name,
                    "roomNumber" => $classtimeslot->rooms->room_name,
                    "roomType" => ucfirst($classtimeslot->rooms->room_type),
                ]
            ]);
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

        return view('pages.view-schedule', ['id' => $id, 'uri' => 'sections', 'pagetitle' => $section->section_name, 'return_to' => $request->return_to, 'formattedSchedules' => $formattedSchedules]);
    }
}
    