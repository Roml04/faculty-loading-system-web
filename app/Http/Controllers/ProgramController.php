<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        $courses = [];
        $strands = [];

        foreach($programs as $program) {

            if(!(file_exists(public_path($program->path)))) {
                $program->path = 'assets/images/no-img.jpg';
            }

            switch ($program->level) {
                case "ter":
                    $courses[] = $program;
                    break;
                case "shs":
                    $strands[] = $program;
                    break;
                default:
                    dd('Unkown level'); // replace with a better error
            }
        }

        return view('pages.program-selection', ['title' => 'Programs', 'courses' => $courses, 'strands' => $strands]);
    }
}
