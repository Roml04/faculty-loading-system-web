<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function show($id) {
        $program = Program::where('id', $id)->first();

        $sections = $program->section;

        return view('pages.section-schedules', ['sections' => $sections, 'program_name' => $program->program_name]);
    }
}
