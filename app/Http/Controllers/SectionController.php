<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Section;
use Illuminate\Http\Request;

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

        return view('pages.view-schedule', ['id' => $id, 'uri' => 'sections', 'pagetitle' => $section->section_name, 'return_to' => $request->return_to]);
    }
}
    