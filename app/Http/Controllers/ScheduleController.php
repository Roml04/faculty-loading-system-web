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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'programs' => 'array',
                'programs.*.id' => 'numeric',
                'programs.*.program_name' => 'string',
                'programs.*.level' => ['string', 'in:ter,shs'],
                'programs.*.path' => ['string', 'nullable'],
                'teachers' => 'array',
                'teachers.*.id' => 'numeric',
                'teachers.*.teacher_name' => 'string',
                'courses' => 'array',
                'courses.*.id' => 'numeric',
                'courses.*.course_name' => 'string',
                'rooms' => 'array',
                'rooms.*.id' => 'numeric',
                'rooms.*.room_name' => 'string',
                'rooms.*.room_type' => ['string', 'in:laboratory,lecture'],
                'sections' => 'array',
                'sections.*.id' => 'numeric',
                'sections.*.section_name' => 'string',
                'sections.*.year' => 'in:shs_first,shs_second,first_year,second_year,third_year,fourth_year',
                'sections.*.term' => 'in:first_term,second_term',
                'sections.*.programs_id' => ['numeric'],
                'classtimeslots' => 'array',
                'classtimeslots.*.id' => 'numeric',
                'classtimeslots.*.teachers_id' => 'numeric',
                'classtimeslots.*.courses_id' => 'numeric',
                'classtimeslots.*.rooms_id' => 'numeric',
                'classtimeslots.*.start' => ['date_format:H:i', 'after:05:59', 'before:19:01'],
                'classtimeslots.*.end' => ['date_format:H:i', 'after:06:00', 'before:19:01'],
                'classtimeslots.*.day_of_week' => ['numeric', 'between:1,6'],
                'sectiontimeslots' => 'array',
                'sectiontimeslots.*.id' => 'numeric',
                'sectiontimeslots.*.sections_id' => 'numeric',
                'sectiontimeslots.*.class_time_slots_id' => 'numeric',
            ]);
    
            $programs = $validated['programs'];
            
            foreach($programs as $program) {
                
                Program::upsert([
                        'id' => $program['id'],
                        'program_name' => $program['program_name'],
                        'level' => $program['level'],
                        'path' => $program['path']
                    ],
                    uniqueBy: ['id'],
                    update: ['program_name', 'level', 'path']
                );
                
            }

            $teachers = $validated['teachers'];
            
            foreach($teachers as $teacher) {
                
                Teacher::upsert([
                        'id' => $teacher['id'],
                        'teacher_name' => $teacher['teacher_name']
                    ],
                    uniqueBy: ['id'],
                    update: ['teacher_name']
                );
                
            }
            
            $courses = $validated['courses'];
            
            foreach($courses as $course) {
                
                Course::upsert([
                        'id' => $course['id'],
                        'course_name' => $course['course_name']
                    ],
                    uniqueBy: ['id'],
                    update: ['course_name']
                );
                
            }
            
            $rooms = $validated['rooms'];
            
            foreach($rooms as $room) {
                
                Room::upsert([
                        'id' => $room['id'],
                        'room_name' => $room['room_name'],
                        'room_type' => $room['room_type']
                    ],
                    uniqueBy: ['id'],
                    update: ['room_name', 'room_type']
                );
                
            }
            
            $sections = $validated['sections'];
            
            foreach($sections as $section) {
                
                Section::upsert([
                        'id' => $section['id'],
                        'section_name' => $section['section_name'],
                        'year' => $section['year'],
                        'term' => $section['term'],
                        'programs_id' => $section['programs_id']
                    ],
                    uniqueBy: ['id'],
                    update: ['section_name', 'year', 'term', 'programs_id']
                );    
            }
    
            $classtimeslots = $validated['classtimeslots'];
            
            foreach($classtimeslots as $classtimeslot) {
                
                ClassTimeSlot::upsert([
                        'id' => $classtimeslot['id'],
                        'teachers_id' => $classtimeslot['teachers_id'],
                        'courses_id' => $classtimeslot['courses_id'],
                        'rooms_id' => $classtimeslot['rooms_id'],
                        'start' => $classtimeslot['start'],
                        'end' => $classtimeslot['end'],
                        'day_of_week' => $classtimeslot['day_of_week']
                    ],
                    uniqueBy: ['id'],
                    update: ['teachers_id', 'courses_id', 'rooms_id', 'start', 'end', 'day_of_week']
                );
                
            }
            
            $sectiontimeslots = $validated['sectiontimeslots'];
            
            foreach($sectiontimeslots as $sectiontimeslot) {
                
                SectionTimeSlot::upsert([
                        'id' => $sectiontimeslot['id'],
                        'sections_id' => $sectiontimeslot['sections_id'],
                        'class_time_slots_id' => $sectiontimeslot['class_time_slots_id']
                    ],
                    uniqueBy: ['id'],
                    update: ['sections_id', 'class_time_slots_id']            
                );
                
            }
            
            return ['message' => "Publication Successful"];
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
