<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;

class TeacherController extends Controller
{
    public function show($id) {
        $teacher = Teacher::with([
            'tertiarysectionclass.sections',
            'tertiarysectionclass.courses',
            'tertiarysectionclass.rooms',
            'tertiarysectionclass.teachers'
        ])->findOrFail($id);

        $classtimeslots = $teacher->tertiarysectionclass;

        // Group timeslots by time and teacher
        $groupedTimeslots = $classtimeslots->groupBy(function($slot) {
            return $slot->start . '_' . 
                $slot->end . '_' . 
                $slot->teachers_id;
        });

        $events = [];

        foreach($groupedTimeslots as $group) {
            $firstSlot = $group->first();
            $course = $firstSlot->courses ?? null;
            $room = $firstSlot->rooms ?? null;

            // Combine all sections from the grouped timeslots
            $sections = $group->flatMap(function($slot) {
                return $slot->sections->pluck('section_name');
            })->unique()->implode(', ');

            $events[] = [
                "title" => $course->course_name ?? '',
                "startTime" => $firstSlot->start,
                "endTime" => $firstSlot->end,
                "daysOfWeek" => [$firstSlot->day_of_week],
                "extendedProps" => [
                    "sections" => $sections,
                    "teacherName" => $firstSlot->teachers->teacher_name ?? '',
                    "roomNumber" => $room->room_name ?? '',
                    "roomType" => ucfirst($room->room_type ?? ''),
                ]
            ];
        }

        $schedules = collect($events)->sortBy(function($item) {
            return strtotime($item['startTime']);
        })->values()->all();

        // Initialize formattedSchedules array
        $formattedSchedules = [
            1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => []
        ];
        
        // Format schedules by day
        foreach ($formattedSchedules as $key => $array) {
            foreach ($schedules as $schedule) {
                if ($schedule['daysOfWeek'][0] === $key) {
                    try {
                        // Try to parse the time, fallback to original value if it fails
                        $startTime = $schedule['startTime'];
                        $endTime = $schedule['endTime'];
                        
                        // Check if times include seconds
                        if (substr_count($startTime, ':') === 1) {
                            $startTime .= ':00';
                            $endTime .= ':00';
                        }
                        
                        array_push($formattedSchedules[$key], [
                            "title" => $schedule['title'],
                            "startTime" => Carbon::createFromFormat('H:i:s', $startTime)->format('g:i A'),
                            "endTime" => Carbon::createFromFormat('H:i:s', $endTime)->format('g:i A'),
                            "daysOfWeek" => $schedule['daysOfWeek'][0],
                            "extendedProps" => $schedule['extendedProps']
                        ]);
                    } catch (\Exception $e) {
                        // Fallback to original values if parsing fails
                        array_push($formattedSchedules[$key], [
                            "title" => $schedule['title'],
                            "startTime" => $schedule['startTime'],
                            "endTime" => $schedule['endTime'],
                            "daysOfWeek" => $schedule['daysOfWeek'][0],
                            "extendedProps" => $schedule['extendedProps']
                        ]);
                    }
                }
            }
        }

        // Map days to their counts
        $days = [
            'Monday' => count($formattedSchedules[1]),
            'Tuesday' => count($formattedSchedules[2]),
            'Wednesday' => count($formattedSchedules[3]),
            'Thursday' => count($formattedSchedules[4]),
            'Friday' => count($formattedSchedules[5]), 
            'Saturday' => count($formattedSchedules[6])
        ];

        // Combine day names with schedules
        $formattedSchedules = array_combine(array_keys($days), array_values($formattedSchedules));

        return view('pages.view-schedule', [
            'id' => $id, 
            'uri' => 'teachers', 
            'pagetitle' => $teacher->teacher_name, 
            'formattedSchedules' => $formattedSchedules
        ]);
        
        // $teacher = Teacher::with([
        //         'tertiarysectionclass.sections',
        //         'tertiarysectionclass.courses',
        //         'tertiarysectionclass.rooms',
        //         'tertiarysectionclass.teachers'
        //     ])->findOrFail($id);

        // $classtimeslots = $teacher->tertiarysectionclass;

        // $events = [];

        // foreach($classtimeslots as $classtimeslot) {

        //     $sections = '';

        //     foreach($classtimeslot->sections as $section) {
        //         $section->section_name = ', ' . $section->section_name;
        //         $sections .= $section->section_name;
        //     }

        //     $sections = trim(substr($sections, 1));

        //     $events[] = [
        //         "title" => $classtimeslot->courses->course_name,
        //         "startTime" => $classtimeslot->start,
        //         "endTime" => $classtimeslot->end,
        //         "daysOfWeek" => [$classtimeslot->day_of_week],
        //         "extendedProps" => [
        //             "sections" => $sections,
        //             "teacherName" => $classtimeslot->teachers->teacher_name,
        //             "roomNumber" => $classtimeslot->rooms->room_name,
        //             "roomType" => ucfirst($classtimeslot->rooms->room_type),
        //         ]
        //     ];
        // }

        // $schedules = collect($events);

        // $schedules = $schedules->sortBy(function($item) {
        //     return strtotime($item['startTime']);
        // })->values()->all();

        // $formattedSchedules = [
        //     1 => [],
        //     2 => [],
        //     3 => [],
        //     4 => [],
        //     5 => [],
        //     6 => []
        // ];
        
        // foreach ($formattedSchedules as $key => $array) {
            
        //     foreach ($schedules as $schedule) {
        //         if ($schedule['daysOfWeek'][0] === $key) {
        //             array_push($formattedSchedules[$key], [
        //                 "title" => $schedule['title'],
        //                 "startTime" => Carbon::createFromFormat('H:i:s', $schedule['startTime'])->format('g:i A'),
        //                 "endTime" => Carbon::createFromFormat('H:i:s', $schedule['endTime'])->format('g:i A'),
        //                 "daysOfWeek" => $schedule['daysOfWeek'][0],
        //                 "extendedProps" => [
        //                     "sections" => $schedule['extendedProps']['sections'],
        //                     "teacherName" => $schedule['extendedProps']['teacherName'],
        //                     "roomNumber" => $schedule['extendedProps']['roomNumber'],
        //                     "roomType" => $schedule['extendedProps']['roomType'],
        //                 ]
        //             ]);
        //         }

        //     }

        // }

        // $days = [
        //     'Monday' => count($formattedSchedules[1]),
        //     'Tuesday' => count($formattedSchedules[2]),
        //     'Wednesday' => count($formattedSchedules[3]),
        //     'Thursday' => count($formattedSchedules[4]),
        //     'Friday' => count($formattedSchedules[5]), 
        //     'Saturday' => count($formattedSchedules[6])
        // ];

        // $formattedSchedules = array_combine(array_keys($days), array_values($formattedSchedules));

        // return view('pages.view-schedule', ['id' => $id, 'uri' => 'teachers', 'pagetitle' => $teacher->teacher_name, 'formattedSchedules' => $formattedSchedules]);
    }
}
