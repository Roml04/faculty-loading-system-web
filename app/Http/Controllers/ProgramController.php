<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request): never
    {
        abort(404);
    }

    /**
     * Display the resource.
     */
    public function show()
    {
        $programs = Program::orderBy('program_name', 'asc')->get();
        $teachers = Teacher::orderBy('teacher_name', 'asc')->get();

        $courses = [];
        $strands = [];

        foreach ($programs as $program) {

            if (!(file_exists(public_path($program->path)))) {
                $program->path = 'assets/images/no-img.webp';
            }

            switch ($program->level) {
                case "tertiary":
                    $courses[] = $program;
                    break;
                case "shs":
                    $strands[] = $program;
                    break;
                default:
                    break;
            }
        }

        if (session('role') === 'Student') {
            return view('pages.program-selection', ['title' => 'Programs', 'role' => session('role'), 'courses' => $courses, 'strands' => $strands, 'teachers' => []]);
        }

        return view('pages.program-selection', ['title' => 'Programs', 'courses' => $courses, 'strands' => $strands, 'teachers' => $teachers]);
    }
}
