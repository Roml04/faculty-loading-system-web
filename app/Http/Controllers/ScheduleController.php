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
                'programs.*.program_name' => 'string',
                'programs.*.level' => ['string', 'in:ter,shs'],
                'programs.*.path' => ['string', 'nullable'],
                'teachers' => 'array',
                'teachers.*.teacher_name' => 'string',
                'courses' => 'array',
                'courses.*.course_name' => 'string',
                'rooms' => 'array',
                'rooms.*.room_name' => 'string',
                'rooms.*.room_type' => ['string', 'in:laboratory,lecture'],
                'sections' => 'array',
                'sections.*.section_name' => 'string',
                'sections.*.year' => 'in:shs_first,shs_second,first_year,second_year,third_year,fourth_year',
                'sections.*.term' => 'in:first_term,second_term',
                'sections.*.programs_id' => ['numeric'],
                'classtimeslots' => 'array',
                'classtimeslots.*.teachers_id' => 'numeric',
                'classtimeslots.*.courses_id' => 'numeric',
                'classtimeslots.*.rooms_id' => 'numeric',
                'classtimeslots.*.start' => ['date_format:H:i', 'after:05:59', 'before:19:01'],
                'classtimeslots.*.end' => ['date_format:H:i', 'after:06:00', 'before:19:01'],
                'classtimeslots.*.day_of_week' => ['numeric', 'between:1,6'],
                'sectiontimeslots' => 'array',
                'sectiontimeslots.*.sections_id' => 'numeric',
                'sectiontimeslots.*.class_time_slots_id' => 'numeric',
            ]);
    
            
            $programs = $validated['programs'];
            
            foreach($programs as $program) {
                
                Program::create([
                    'program_name' => $program['program_name'],
                    'level' => $program['level'],
                    'path' => $program['path']
                ]);
                
            }
            
            $teachers = $validated['teachers'];
            
            foreach($teachers as $teacher) {
                
                Teacher::create([
                    'teacher_name' => $teacher['teacher_name']
                ]);
                
            }
            
            $courses = $validated['courses'];
            
            foreach($courses as $course) {
                
                Course::create([
                    'course_name' => $course['course_name']
                ]);
                
            }
            
            $rooms = $validated['rooms'];
            
            foreach($rooms as $room) {
                
                Room::create([
                    'room_name' => $room['room_name'],
                    'room_type' => $room['room_type']
                ]);
                
            }
            
            $sections = $validated['sections'];
            
            foreach($sections as $section) {
                
                Section::create([
                    'section_name' => $section['section_name'],
                    'year' => $section['year'],
                    'term' => $section['term'],
                    'programs_id' => $section['programs_id']
                ]);
                
            }
    
            $classtimeslots = $validated['classtimeslots'];
            
            foreach($classtimeslots as $classtimeslot) {
                
                ClassTimeSlot::create([
                    'teachers_id' => $classtimeslot['teachers_id'],
                    'courses_id' => $classtimeslot['courses_id'],
                    'rooms_id' => $classtimeslot['rooms_id'],
                    'start' => $classtimeslot['start'],
                    'end' => $classtimeslot['end'],
                    'day_of_week' => $classtimeslot['day_of_week']
                ]);
                
            }
            
            $sectiontimeslots = $validated['sectiontimeslots'];
            
            foreach($sectiontimeslots as $sectiontimeslot) {
                
                SectionTimeSlot::create([
                    'sections_id' => $sectiontimeslot['sections_id'],
                    'class_time_slots_id' => $sectiontimeslot['class_time_slots_id']
                ]);
                
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
