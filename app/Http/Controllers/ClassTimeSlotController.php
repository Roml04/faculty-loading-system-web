<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Teacher;

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
        // eager-load related models to avoid N+1
        $teacher = Teacher::with([
                'tertiarysectionclass.sections',
                'tertiarysectionclass.courses',
                'tertiarysectionclass.rooms',
                'tertiarysectionclass.teachers' // ensure teacher relation is loaded if needed
            ])->findOrFail($id);

        $timeslots = $teacher->tertiarysectionclass ?? collect();

        $events = $timeslots->flatMap(function($slot) {
            $course = $slot->courses ?? null;
            $room   = $slot->rooms ?? null;
            $teacherName = $slot->teachers->teacher_name ?? '';

            // If a timeslot has multiple sections, return one event per section.
            $sections = $slot->sections instanceof \Illuminate\Support\Collection
                ? $slot->sections
                : collect([$slot->sections]);

            return $sections->map(function($section) use ($slot, $course, $room, $teacherName) {
                return [
                    "title" => $course->course_name ?? '',
                    "startTime" => $slot->start,
                    "endTime" => $slot->end,
                    "daysOfWeek" => [$slot->day_of_week],
                    "extendedProps" => [
                        // "sectionName" => $section->section_name ?? '',
                        "teacherName" => $section->section_name ?? '',
                        "roomNumber" => $room->room_name ?? '',
                        "roomType" => ucfirst($room->room_type ?? ''),
                    ]
                ];
            });
        })->sortBy(fn($item) => strtotime($item['startTime']))->values()->all();

        return response()->json($events);
    }
}