<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Teacher;

class ClassTimeSlotController extends Controller
{
    public function sectionTimeSlots($id) {
        // $section = Section::whereId($id)->first();

        $section = Section::with([
            "classtimeslot.sections"
        ])->findOrFail($id);
        
        $classtimeslots = $section->classtimeslot;

        $events = [];

        
        foreach($classtimeslots as $classtimeslot) {
        
            $sections = '';

            foreach($classtimeslot->sections as $section) {
                $section->section_name = ', ' . $section->section_name;
                $sections .= $section->section_name;
            }

            $sections = trim(substr($sections, 1));

            $events[] = [
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
            ];

        }

        $schedules = collect($events);

        $schedules = $schedules->sortBy(function($item) {
            return strtotime($item['startTime']);
        })->values()->all();
        
        return response()->json($schedules);

    }

    public function teacherTimeSlots($id) {
        $teacher = Teacher::with([
            'tertiarysectionclass.sections',
            'tertiarysectionclass.courses',
            'tertiarysectionclass.rooms',
            'tertiarysectionclass.teachers'
        ])->findOrFail($id);

        $timeslots = $teacher->tertiarysectionclass ?? collect();

        // Group timeslots by time and teacher
        $groupedTimeslots = $timeslots->groupBy(function($slot) {
            return $slot->start . '_' . 
                $slot->end . '_' . 
                $slot->teachers_id;
        });

        $events = $groupedTimeslots->map(function($group) {
            $firstSlot = $group->first();
            $course = $firstSlot->courses ?? null;
            $room = $firstSlot->rooms ?? null;
            $teacher = $firstSlot->teachers ?? null;

            // Combine all sections from the grouped timeslots
            $sectionNames = $group->flatMap(function($slot) {
                return $slot->sections->pluck('section_name');
            })->unique()->implode(', ');

            return [
                "title" => $course->course_name ?? '',
                "startTime" => $firstSlot->start,
                "endTime" => $firstSlot->end,
                "daysOfWeek" => [$firstSlot->day_of_week],
                "extendedProps" => [
                    "sections" => $sectionNames,
                    "teacherName" => $teacher->teacher_name ?? '',
                    "roomNumber" => $room->room_name ?? '',
                    "roomType" => ucfirst($room->room_type ?? ''),
                ]
            ];
        })->sortBy(fn($item) => strtotime($item['startTime']))->values()->all();

        return response()->json($events);
        
        // $teacher = Teacher::with([
        //         'tertiarysectionclass.sections',
        //         'tertiarysectionclass.courses',
        //         'tertiarysectionclass.rooms',
        //         'tertiarysectionclass.teachers'
        //     ])->findOrFail($id);

        // $timeslots = $teacher->tertiarysectionclass ?? collect();

        // $events = $timeslots->flatMap(function($slot) {
        //     $course = $slot->courses ?? null;
        //     $room   = $slot->rooms ?? null;

        //     $sections = $slot->sections instanceof \Illuminate\Support\Collection
        //         ? $slot->sections
        //         : collect([$slot->sections]);

        //     return $sections->map(function($section) use ($slot, $course, $room) {
        //         return [
        //             "title" => $course->course_name ?? '',
        //             "startTime" => $slot->start,
        //             "endTime" => $slot->end,
        //             "daysOfWeek" => [$slot->day_of_week],
        //             "extendedProps" => [
        //                 "sections" => $section->section_name ?? '',
        //                 "roomNumber" => $room->room_name ?? '',
        //                 "roomType" => ucfirst($room->room_type ?? ''),
        //             ]
        //         ];
        //     });
        // })->sortBy(fn($item) => strtotime($item['startTime']))->values()->all();

        return response()->json($events);
    }
}