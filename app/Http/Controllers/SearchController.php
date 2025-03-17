<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        
        // Database
        // Fetch section name and id based on the search query

        $sections = Section::get();

        $search_results = [];
        $search_query = $request['search_query'];
        foreach($sections as $section) {
            if (stripos($section->section_name, strtoupper($search_query)) !== false) {
                $search_results[] = $section->section_name;
            }
        }

        return view('pages.search-result', ['search_results' => $search_results, 'search_query' => $request['search_query']]);

    }
}
