<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Section;

class SectionController extends Controller
{
    public function indexSections($id) {
        $program = Program::where('id', $id)->first();

        $sections = [];

        foreach($program->section as $section) {
            if(count($section->classtimeslot) > 0) {
                $sections[] = $section;
            }
        }

        return view('pages.section-schedules', ['sections' => $sections, 'program_name' => $program->program_name]);
    }

    public function viewSection($id) {

        $section = Section::whereId($id)->first();

        return view('pages.view-schedule', ['id' => $id, 'sectionname' => $section->section_name]);
    }
}
