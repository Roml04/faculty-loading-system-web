<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        
        $search_query = $request['search_query'];
        $search_results = Section::where('section_name', 'LIKE', sprintf('%%%s%%', $search_query))->get();

        $pagetitle = "Search results for " . $search_query;

        return view('pages.search-result', ['pagetitle' => $pagetitle, 'search_results' => $search_results, 'search_query' => $search_query]);

    }
}
