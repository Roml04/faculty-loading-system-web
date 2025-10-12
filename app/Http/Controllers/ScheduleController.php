<?php

namespace App\Http\Controllers;

use App\Models\ClassTimeSlot;
use App\Models\Course;
use App\Models\Program;
use App\Models\Room;
use App\Models\Section;
use App\Models\SectionTimeSlot;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'programs' => 'array',
            'programs.*.programId' => 'numeric',
            'programs.*.programName' => 'string',
            'programs.*.educLevel' => ['string', 'in:tertiary,shs'],
            'programs.*.path' => ['string', 'nullable'],
            'teachers' => 'array',
            'teachers.*.teacherId' => 'numeric',
            'teachers.*.firstName' => 'string',
            'teachers.*.lastName' => 'string',
            'teachers.*.middleInitial' => ['string', 'nullable'],
            'courses' => 'array',
            'courses.*.courseId' => 'numeric',
            'courses.*.courseName' => 'string',
            'rooms' => 'array',
            'rooms.*.roomId' => 'numeric',
            'rooms.*.roomName' => 'string',
            'rooms.*.roomType' => 'string',
            'sections' => 'array',
            'sections.*.sectionId' => 'numeric',
            'sections.*.sectionName' => 'string',
            'sections.*.year' => 'in:11,12,1,2,3,4',
            'sections.*.term' => 'in:1,2',
            'sections.*.level' => 'string',
            'sections.*.programId' => ['numeric'],
            'classtimeslots' => 'array',
            'classtimeslots.*.classTimeId' => 'numeric',
            'classtimeslots.*.teacherId' => 'numeric',
            'classtimeslots.*.courseId' => 'numeric',
            'classtimeslots.*.roomId' => 'numeric',
            'classtimeslots.*.day' => ['numeric', 'between:1,6'],
            'classtimeslots.*.startTime' => ['date_format:H:i', 'after:05:59', 'before:19:01'],
            'classtimeslots.*.endTime' => ['date_format:H:i', 'after:06:00', 'before:19:01'],
            'sectiontimeslots' => 'array',
            'sectiontimeslots.*.sectionId' => 'numeric',
            'sectiontimeslots.*.classTimeId' => 'numeric',
            'semester' => 'array',
            'semester.term' => ['required', 'numeric'],
            'semester.termName' => ['required', 'string']
        ]);

        try {

            SectionTimeSlot::query()->delete();
            ClassTimeSlot::query()->delete();
            Section::query()->delete();
            Room::query()->delete();
            Course::query()->delete();
            Teacher::query()->delete();
            Program::query()->delete();
                            
            $programs = $validated['programs'];
            
            foreach($programs as $program) {
                
                Program::upsert([
                    'id' => $program['programId'],
                    'program_name' => $program['programName'],
                    'level' => $program['educLevel'],
                    // 'path' => $program['path']
                ],
                uniqueBy: ['id'],
                // update: ['programName', 'educLevel', 'path']
                update: ['program_name', 'level']
                );
                
            }

            $teachers = $validated['teachers'];

            foreach($teachers as $teacher) {
                
                Teacher::upsert([
                        'id' => $teacher['teacherId'],
                        'teacher_name' => $teacher['lastName'] . " " . $teacher['firstName'] . " " . $teacher['middleInitial'] . "."
                    ],
                    uniqueBy: ['id'],
                    update: ['teacher_name']
                );
                
            }
            
            $courses = $validated['courses'];
            
            foreach($courses as $course) {
                
                Course::upsert([
                        'id' => $course['courseId'],
                        'course_name' => $course['courseName']
                    ],
                    uniqueBy: ['id'],
                    update: ['course_name']
                );
                
            }
            
            $rooms = $validated['rooms'];
            
            foreach($rooms as $room) {
                
                Room::upsert([
                        'id' => $room['roomId'],
                        'room_name' => $room['roomName'],
                        'room_type' => $room['roomType']
                    ],
                    uniqueBy: ['id'],
                    update: ['room_name', 'room_type']
                );
                
            }
            
            $sections = $validated['sections'];
            $semester = $validated['semester'];
            
            foreach($sections as $section) {

                if($section['term'] === $semester['term']) {
                    Section::upsert([
                            'id' => $section['sectionId'],
                            'section_name' => $section['sectionName'],
                            'year' => $section['year'],
                            'term' => $section['term'],
                            'level' => $section['level'],
                            'programs_id' => $section['programId']
                        ],
                        uniqueBy: ['id'],
                        update: ['section_name', 'year', 'term', 'programs_id']
                    );
                    
                }
    
            }
    
            $classtimeslots = $validated['classtimeslots'];
            
            foreach($classtimeslots as $classtimeslot) {
                
                ClassTimeSlot::upsert([
                        'id' => $classtimeslot['classTimeId'],
                        'teachers_id' => $classtimeslot['teacherId'],
                        'courses_id' => $classtimeslot['courseId'],
                        'rooms_id' => $classtimeslot['roomId'],
                        'day_of_week' => $classtimeslot['day'],
                        'start' => $classtimeslot['startTime'],
                        'end' => $classtimeslot['endTime']
                    ],
                    uniqueBy: ['id'],
                    update: ['teachers_id', 'courses_id', 'rooms_id', 'start', 'end', 'day_of_week']
                );
                
            }
            
            $sectiontimeslots = $validated['sectiontimeslots'];
            
            foreach($sectiontimeslots as $sectiontimeslot) {
                
                SectionTimeSlot::upsert([
                        // 'id' => $sectiontimeslot['sectionid'],
                        'sections_id' => $sectiontimeslot['sectionId'],
                        'class_time_slots_id' => $sectiontimeslot['classTimeId']
                    ],
                    uniqueBy: ['id'],
                    update: ['sections_id', 'class_time_slots_id']            
                );
                
            }

            return ['message' => 'Success!', 'validated' => $validated];            

        }
        
        catch(Exception $error) {
    
            return ['message' => $error->getMessage()];
        
        }
    }

    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
