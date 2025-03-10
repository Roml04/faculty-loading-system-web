<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        
        // Database
        // Fetch section name and id based on the search query

        $mockdb = collect([
            ["id" => 0, 'level' => 'ter', "programname" => "Computer Science", "pathtopic" => 'assets/images/cs.jpg', 
                "sections" => [
                    ["name" => 'BSCS101',],
                    ["name" => 'BSCS301',],
                    ["name" => 'BSCS302',],
                    ["name" => 'BSCS501',],
                    ["name" => 'BSCS502',],
                    ["name" => 'BSCS701',],
                ]
            ], 
            ["id" => 1, 'level' => 'ter', "programname" => "Information Technology", "pathtopic" => 'assets/images/it.jpg',
                "sections" => [
                    ["name" => 'BSIT101',],
                    ["name" => 'BSIT102',],
                    ["name" => 'BSIT103',],
                    ["name" => 'BSIT301',],
                    ["name" => 'BSIT502',],
                    ["name" => 'BSIT701',],
                ]
            ], 
            ["id" => 2, 'level' => 'ter', "programname" => "Computer Engineering", "pathtopic" => 'assets/images/cpe.jpg',
                "sections" => [
                    ["name" => 'BSCpE101',],
                    ["name" => 'BSCpE301',],
                    ["name" => 'BSCpE302',],
                    ["name" => 'BSCpE303',],
                    ["name" => 'BSCpE501',],
                    ["name" => 'BSCpE502',],
                    ["name" => 'BSCpE503',],
                    ["name" => 'BSCpE701',],
                ]
            ], 
            ["id" => 3, 'level' => 'ter', "programname" => "Multimedia Arts", "pathtopic" => 'assets/images/mma.jpg',
                "sections" => [
                    ["name" => 'BMMA101',],
                    ["name" => 'BMMA501',],
                    ["name" => 'BMMA502',],
                    ["name" => 'BMMA503',],
                    ["name" => 'BMMA502',],
                    ["name" => 'BMMA701',],
                ]
            ],
            ["id" => 4, 'level' => 'ter', "programname" => "Tourism Management", "pathtopic" => 'assets/images/tm.jpg',
                "sections" => [
                    ["name" => 'BSTM101',],
                    ["name" => 'BSTM501',],
                    ["name" => 'BSTM502',],
                    ["name" => 'BSTM503',],
                    ["name" => 'BSTM502',],
                    ["name" => 'BSTM701',],
                ]
            ],
            ["id" => 5, 'level' => 'shs', "programname" => "ABM", "pathtopic" => 'assets/images/abm.jpg',
                "sections" => [
                    ["name" => 'ABM101',],
                    ["name" => 'ABM301',],
                    ["name" => 'ABM302',],
                ]
            ], 
            ["id" => 6, 'level' => 'shs', "programname" => "STEM", "pathtopic" => 'assets/images/stem.jpg',
                "sections" => [
                    ["name" => 'STEM101',],
                    ["name" => 'STEM201',],
                    ["name" => 'STEM202',],
                    ["name" => 'STEM203',],
                ]
            ], 
            ["id" => 7, 'level' => 'shs', "programname" => "Culinary Arts", "pathtopic" => 'assets/images/cularts.jpg',
                "sections" => [
                    ["name" => 'CA101',],
                    ["name" => 'CA201',],
                    ["name" => 'CA202',],
                    ["name" => 'CA203',],
                ]
            ], 
            ["id" => 8, 'level' => 'shs', "programname" => "ITMAWD", "pathtopic" => 'assets/images/itmawd.jpg',
                "sections" => [
                    ["name" => 'ITMAWD101',],
                    ["name" => 'ITMAWD201',],
                    ["name" => 'ITMAWD202',],
                    ["name" => 'ITMAWD203',],
                ]
            ]
        ]);

        $search_results = [];
        $search_query = $request['search_query'];
        foreach($mockdb as $program) {
            foreach($program['sections'] as $section) {
                if (stripos($section['name'], strtoupper($search_query)) !== false) {
                    $search_results[] = $section['name'];
                }
            }
        }

        return view('pages.search-result', ['search_results' => $search_results, 'search_query' => $request['search_query']]);

    }
}
