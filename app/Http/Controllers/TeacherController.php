<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TeacherController extends Controller
{
    public function show($id) {
        $teacher = Teacher::whereId($id)->first();

        return view('pages.view-schedule', ['id' => $id, 'uri' => 'teachers', 'pagetitle' => $teacher->teacher_name]);
    }
}
