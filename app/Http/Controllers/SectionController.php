<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SectionController extends Controller
{
    public function indexSections($id, Request $request)
    {
        $program = Program::where('id', $id)->first();

        $sections = $program->section->sortBy(function ($section) {
            preg_match('/\d+/', $section->section_name, $matches);
            return isset($matches[0]) ? (int)$matches[0] : 0;
        })->values();

        return view('pages.section-schedules', [
            'sections' => $sections,
            'programname' => $program->program_name,
            'return_to' => $request->return_to,
        ]);
    }

    public function viewSection($id, Request $request) {

        $section = Section::with([
            "classtimeslot.sections"
        ])->findOrFail($id);
        
        $sectionName = $section->section_name;

        $classtimeslots = $section->classtimeslot;

        $events = [];
        foreach($classtimeslots as $classtimeslot) {

            $sections = '';

            foreach($classtimeslot->sections as $section) {
                $section->section_name = ', ' . $section->section_name;
                $sections .= $section->section_name;
            }

            $sections = trim(substr($sections, 1));

            array_push($events, [
                "title" => $classtimeslot->courses->course_name,
                "startTime" => $classtimeslot->start,
                "endTime" => $classtimeslot->end,
                "daysOfWeek" => [$classtimeslot->day_of_week],
                "extendedProps" => [
                    "sections" => $sections,
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
                    try {
                        // Add seconds if missing from time format
                        $startTime = $schedule['startTime'];
                        $endTime = $schedule['endTime'];
                        
                        if (substr_count($startTime, ':') === 1) {
                            $startTime .= ':00';
                            $endTime .= ':00';
                        }
                        
                        array_push($formattedSchedules[$key], [
                            "title" => $schedule['title'],
                            "startTime" => Carbon::createFromFormat('H:i:s', $startTime)->format('g:i A'),
                            "endTime" => Carbon::createFromFormat('H:i:s', $endTime)->format('g:i A'),
                            "daysOfWeek" => $schedule['daysOfWeek'][0],
                            "extendedProps" => [
                                "sections" => $schedule['extendedProps']['sections'],
                                "teacherName" => $schedule['extendedProps']['teacherName'],
                                "roomNumber" => $schedule['extendedProps']['roomNumber'],
                                "roomType" => $schedule['extendedProps']['roomType'],
                            ]
                        ]);
                    } catch (\Exception $e) {
                        // Fallback to original values if parsing fails
                        array_push($formattedSchedules[$key], [
                            "title" => $schedule['title'],
                            "startTime" => $schedule['startTime'],
                            "endTime" => $schedule['endTime'],
                            "daysOfWeek" => $schedule['daysOfWeek'][0],
                            "extendedProps" => [
                                "sections" => $schedule['extendedProps']['sections'],
                                "teacherName" => $schedule['extendedProps']['teacherName'],
                                "roomNumber" => $schedule['extendedProps']['roomNumber'],
                                "roomType" => $schedule['extendedProps']['roomType'],
                            ]
                        ]);
                    }
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


        return view('pages.view-schedule', ['id' => $id, 'uri' => 'sections', 'pagetitle' => $sectionName, 'return_to' => $request->return_to, 'formattedSchedules' => $formattedSchedules]);
    }
}
    