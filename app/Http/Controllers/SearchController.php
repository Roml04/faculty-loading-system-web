<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        
        $search_query = $request['search_query'];
        $section_results = Section::where('section_name', 'LIKE', sprintf('%%%s%%', $search_query))->get();
        $teacher_results = Teacher::where('teacher_name', 'LIKE', sprintf('%%%s%%', $search_query))->get();

        $pagetitle = "Search results for " . $search_query;

        $has_section = count($section_results) > 0;
        $has_teacher = count($teacher_results) > 0;

        return view('pages.search-result', ['pagetitle' => $pagetitle, 'section_results' => $section_results, 'teacher_results' => $teacher_results, 'has_section' => $has_section, 'has_teacher' => $has_teacher, 'search_query' => $search_query]);

    }
}
