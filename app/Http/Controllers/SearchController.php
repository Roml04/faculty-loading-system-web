<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        
        // Database
        // Fetch section name and id based on the search query

        $mockdb = [
            ['section_name' => 'BSCS601'], 
            ['section_name' => 'BSCS602'], 
            ['section_name' => 'BSCS801'],
            ['section_name' => 'BSCS802'],
        ];

        $search_results = [];

        $search_query = $request['search_query'];

        $search_results = array_filter($mockdb, function($item) use ($search_query) {
            return stripos($item['section_name'], $search_query) !== false;
        });

        return view('pages.search-result', ['search_results' => $search_results, 'search_query' => $request['search_query']]);

    }
}
