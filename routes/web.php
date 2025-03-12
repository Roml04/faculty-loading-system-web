<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {

    $programs = collect([
        ["id" => 0, 'level' => 'ter', "programname" => "Computer Science", "pathtopic" => 'assets/images/cs.webp', 
            "sections" => [
                ["name" => 'BSCS101',],
                ["name" => 'BSCS301',],
                ["name" => 'BSCS302',],
                ["name" => 'BSCS501',],
                ["name" => 'BSCS502',],
                ["name" => 'BSCS701',],
            ]
        ], 
        ["id" => 1, 'level' => 'ter', "programname" => "Information Technology", "pathtopic" => 'assets/images/it.webp',
            "sections" => [
                ["name" => 'BSIT101',],
                ["name" => 'BSIT102',],
                ["name" => 'BSIT103',],
                ["name" => 'BSIT301',],
                ["name" => 'BSIT502',],
                ["name" => 'BSIT701',],
            ]
        ], 
        ["id" => 2, 'level' => 'ter', "programname" => "Computer Engineering", "pathtopic" => 'assets/images/cpe.webp',
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
        ["id" => 3, 'level' => 'ter', "programname" => "Multimedia Arts", "pathtopic" => 'assets/images/mma.webp',
            "sections" => [
                ["name" => 'BMMA101',],
                ["name" => 'BMMA501',],
                ["name" => 'BMMA502',],
                ["name" => 'BMMA503',],
                ["name" => 'BMMA502',],
                ["name" => 'BMMA701',],
            ]
        ],
        ["id" => 4, 'level' => 'ter', "programname" => "Tourism Management", "pathtopic" => 'assets/images/tm.webp',
            "sections" => [
                ["name" => 'BSTM101',],
                ["name" => 'BSTM501',],
                ["name" => 'BSTM502',],
                ["name" => 'BSTM503',],
                ["name" => 'BSTM502',],
                ["name" => 'BSTM701',],
            ]
        ],
        ["id" => 5, 'level' => 'shs', "programname" => "ABM", "pathtopic" => 'assets/images/abm.webp',
            "sections" => [
                ["name" => 'ABM101',],
                ["name" => 'ABM301',],
                ["name" => 'ABM302',],
            ]
        ], 
        ["id" => 6, 'level' => 'shs', "programname" => "STEM", "pathtopic" => 'assets/images/stem.webp',
            "sections" => [
                ["name" => 'STEM101',],
                ["name" => 'STEM201',],
                ["name" => 'STEM202',],
                ["name" => 'STEM203',],
            ]
        ], 
        ["id" => 7, 'level' => 'shs', "programname" => "Culinary Arts", "pathtopic" => 'assets/images/cularts.webp',
            "sections" => [
                ["name" => 'CA101',],
                ["name" => 'CA201',],
                ["name" => 'CA202',],
                ["name" => 'CA203',],
            ]
        ], 
        ["id" => 8, 'level' => 'shs', "programname" => "ITMAWD", "pathtopic" => 'assets/images/itmawd.webp',
            "sections" => [
                ["name" => 'ITMAWD101',],
                ["name" => 'ITMAWD201',],
                ["name" => 'ITMAWD202',],
                ["name" => 'ITMAWD203',],
            ]
        ]
    ]);

    $courses = [];
    $strands = [];

    foreach($programs as $program) {

        switch ($program['level']) {
            case "ter":
                $courses[] = $program;
                break;
            case "shs":
                $strands[] = $program;
                break;
            default:
                dd('unkown level');
        }
    }

    return view('pages.program-selection', ['title' => 'Programs', 'courses' => $courses, 'strands' => $strands]);
})->name('home');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/sections/{itemid}', function($itemid) {

    $programs = collect([
        ["id" => 0, 'level' => 'ter', "programname" => "Computer Science", "pathtopic" => 'assets/images/cs.webp', 
            "sections" => [
                ["name" => 'BSCS101',],
                ["name" => 'BSCS301',],
                ["name" => 'BSCS302',],
                ["name" => 'BSCS501',],
                ["name" => 'BSCS502',],
                ["name" => 'BSCS701',],
            ]
        ], 
        ["id" => 1, 'level' => 'ter', "programname" => "Information Technology", "pathtopic" => 'assets/images/it.webp',
            "sections" => [
                ["name" => 'BSIT101',],
                ["name" => 'BSIT102',],
                ["name" => 'BSIT103',],
                ["name" => 'BSIT301',],
                ["name" => 'BSIT502',],
                ["name" => 'BSIT701',],
            ]
        ], 
        ["id" => 2, 'level' => 'ter', "programname" => "Computer Engineering", "pathtopic" => 'assets/images/cpe.webp',
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
        ["id" => 3, 'level' => 'ter', "programname" => "Multimedia Arts", "pathtopic" => 'assets/images/mma.webp',
            "sections" => [
                ["name" => 'BMMA101',],
                ["name" => 'BMMA501',],
                ["name" => 'BMMA502',],
                ["name" => 'BMMA503',],
                ["name" => 'BMMA502',],
                ["name" => 'BMMA701',],
            ]
        ],
        ["id" => 4, 'level' => 'ter', "programname" => "Tourism Management", "pathtopic" => 'assets/images/tm.webp',
            "sections" => [
                ["name" => 'BSTM101',],
                ["name" => 'BSTM501',],
                ["name" => 'BSTM502',],
                ["name" => 'BSTM503',],
                ["name" => 'BSTM502',],
                ["name" => 'BSTM701',],
            ]
        ],
        ["id" => 5, 'level' => 'shs', "programname" => "ABM", "pathtopic" => 'assets/images/abm.webp',
            "sections" => [
                ["name" => 'ABM101',],
                ["name" => 'ABM301',],
                ["name" => 'ABM302',],
            ]
        ], 
        ["id" => 6, 'level' => 'shs', "programname" => "STEM", "pathtopic" => 'assets/images/stem.webp',
            "sections" => [
                ["name" => 'STEM101',],
                ["name" => 'STEM201',],
                ["name" => 'STEM202',],
                ["name" => 'STEM203',],
            ]
        ], 
        ["id" => 7, 'level' => 'shs', "programname" => "Culinary Arts", "pathtopic" => 'assets/images/cularts.webp',
            "sections" => [
                ["name" => 'CA101',],
                ["name" => 'CA201',],
                ["name" => 'CA202',],
                ["name" => 'CA203',],
            ]
        ], 
        ["id" => 8, 'level' => 'shs', "programname" => "ITMAWD", "pathtopic" => 'assets/images/itmawd.webp',
            "sections" => [
                ["name" => 'ITMAWD101',],
                ["name" => 'ITMAWD201',],
                ["name" => 'ITMAWD202',],
                ["name" => 'ITMAWD203',],
            ]
        ]
    ]);

    return view('pages.section-schedules', ['program' => $programs[$itemid]]);

})->name('sections'); 