<?php

use App\Http\Controllers\ClassTimeSlotController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {

    $programs = collect([
        ["id" => 0, 'level' => 'ter', "programname" => "Computer Science", "pathtopic" => 'assets/images/cs.webp', 
            "sections" => [
                ["id" => 0, "name" => 'BSCS101',],
                ["id" => 1, "name" => 'BSCS301',],
                ["id" => 2, "name" => 'BSCS302',],
                ["id" => 3, "name" => 'BSCS501',],
                ["id" => 4, "name" => 'BSCS502',],
                ["id" => 5, "name" => 'BSCS701',],
            ]
        ], 
        ["id" => 1, 'level' => 'ter', "programname" => "Information Technology", "pathtopic" => 'assets/images/it.webp',
            "sections" => [
                ["id" => 0, "name" => 'BSIT101',],
                ["id" => 1, "name" => 'BSIT102',],
                ["id" => 2, "name" => 'BSIT103',],
                ["id" => 3, "name" => 'BSIT301',],
                ["id" => 4, "name" => 'BSIT502',],
                ["id" => 5, "name" => 'BSIT701',],
            ]
        ], 
        ["id" => 2, 'level' => 'ter', "programname" => "Computer Engineering", "pathtopic" => 'assets/images/cpe.webp',
            "sections" => [
                ["id" => 0, "name" => 'BSCpE101',],
                ["id" => 1, "name" => 'BSCpE301',],
                ["id" => 2, "name" => 'BSCpE302',],
                ["id" => 3, "name" => 'BSCpE303',],
                ["id" => 4, "name" => 'BSCpE501',],
                ["id" => 5, "name" => 'BSCpE502',],
                ["id" => 6, "name" => 'BSCpE503',],
                ["id" => 7, "name" => 'BSCpE701',],
            ]
        ], 
        ["id" => 3, 'level' => 'ter', "programname" => "Multimedia Arts", "pathtopic" => 'assets/images/mma.webp',
            "sections" => [
                ["id" => 0, "name" => 'BMMA101',],
                ["id" => 1, "name" => 'BMMA501',],
                ["id" => 2, "name" => 'BMMA502',],
                ["id" => 3, "name" => 'BMMA503',],
                ["id" => 4, "name" => 'BMMA502',],
                ["id" => 5, "name" => 'BMMA701',],
            ]
        ],
        ["id" => 4, 'level' => 'ter', "programname" => "Tourism Management", "pathtopic" => 'assets/images/tm.webp',
            "sections" => [
                ["id" => 0, "name" => 'BSTM101',],
                ["id" => 1, "name" => 'BSTM501',],
                ["id" => 2, "name" => 'BSTM502',],
                ["id" => 3, "name" => 'BSTM503',],
                ["id" => 4, "name" => 'BSTM502',],
                ["id" => 5, "name" => 'BSTM701',],
            ]
        ],
        ["id" => 5, 'level' => 'shs', "programname" => "ABM", "pathtopic" => 'assets/images/abm.webp',
            "sections" => [
                ["id" => 0, "name" => 'ABM101',],
                ["id" => 1, "name" => 'ABM301',],
                ["id" => 2, "name" => 'ABM302',],
            ]
        ], 
        ["id" => 6, 'level' => 'shs', "programname" => "STEM", "pathtopic" => 'assets/images/stem.webp',
            "sections" => [
                ["id" => 0, "name" => 'STEM101',],
                ["id" => 1, "name" => 'STEM201',],
                ["id" => 2, "name" => 'STEM202',],
                ["id" => 3, "name" => 'STEM203',],
            ]
        ], 
        ["id" => 7, 'level' => 'shs', "programname" => "Culinary Arts", "pathtopic" => 'assets/images/cularts.webp',
            "sections" => [
                ["id" => 0, "name" => 'CA101',],
                ["id" => 1, "name" => 'CA201',],
                ["id" => 2, "name" => 'CA202',],
                ["id" => 3, "name" => 'CA203',],
            ]
        ], 
        ["id" => 8, 'level' => 'shs', "programname" => "ITMAWD", "pathtopic" => 'assets/images/itmawd.webp',
            "sections" => [
                ["id" => 0, "name" => 'ITMAWD101',],
                ["id" => 1, "name" => 'ITMAWD201',],
                ["id" => 2, "name" => 'ITMAWD202',],
                ["id" => 3, "name" => 'ITMAWD203',],
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
                ["id" => 0, "name" => 'BSCS101',],
                ["id" => 1, "name" => 'BSCS301',],
                ["id" => 2, "name" => 'BSCS302',],
                ["id" => 3, "name" => 'BSCS501',],
                ["id" => 4, "name" => 'BSCS502',],
                ["id" => 5, "name" => 'BSCS701',],
            ]
        ], 
        ["id" => 1, 'level' => 'ter', "programname" => "Information Technology", "pathtopic" => 'assets/images/it.webp',
            "sections" => [
                ["id" => 0, "name" => 'BSIT101',],
                ["id" => 1, "name" => 'BSIT102',],
                ["id" => 2, "name" => 'BSIT103',],
                ["id" => 3, "name" => 'BSIT301',],
                ["id" => 4, "name" => 'BSIT502',],
                ["id" => 5, "name" => 'BSIT701',],
            ]
        ], 
        ["id" => 2, 'level' => 'ter', "programname" => "Computer Engineering", "pathtopic" => 'assets/images/cpe.webp',
            "sections" => [
                ["id" => 0, "name" => 'BSCpE101',],
                ["id" => 1, "name" => 'BSCpE301',],
                ["id" => 2, "name" => 'BSCpE302',],
                ["id" => 3, "name" => 'BSCpE303',],
                ["id" => 4, "name" => 'BSCpE501',],
                ["id" => 5, "name" => 'BSCpE502',],
                ["id" => 6, "name" => 'BSCpE503',],
                ["id" => 7, "name" => 'BSCpE701',],
            ]
        ], 
        ["id" => 3, 'level' => 'ter', "programname" => "Multimedia Arts", "pathtopic" => 'assets/images/mma.webp',
            "sections" => [
                ["id" => 0, "name" => 'BMMA101',],
                ["id" => 1, "name" => 'BMMA501',],
                ["id" => 2, "name" => 'BMMA502',],
                ["id" => 3, "name" => 'BMMA503',],
                ["id" => 4, "name" => 'BMMA502',],
                ["id" => 5, "name" => 'BMMA701',],
            ]
        ],
        ["id" => 4, 'level' => 'ter', "programname" => "Tourism Management", "pathtopic" => 'assets/images/tm.webp',
            "sections" => [
                ["id" => 0, "name" => 'BSTM101',],
                ["id" => 1, "name" => 'BSTM501',],
                ["id" => 2, "name" => 'BSTM502',],
                ["id" => 3, "name" => 'BSTM503',],
                ["id" => 4, "name" => 'BSTM502',],
                ["id" => 5, "name" => 'BSTM701',],
            ]
        ],
        ["id" => 5, 'level' => 'shs', "programname" => "ABM", "pathtopic" => 'assets/images/abm.webp',
            "sections" => [
                ["id" => 0, "name" => 'ABM101',],
                ["id" => 1, "name" => 'ABM301',],
                ["id" => 2, "name" => 'ABM302',],
            ]
        ], 
        ["id" => 6, 'level' => 'shs', "programname" => "STEM", "pathtopic" => 'assets/images/stem.webp',
            "sections" => [
                ["id" => 0, "name" => 'STEM101',],
                ["id" => 1, "name" => 'STEM201',],
                ["id" => 2, "name" => 'STEM202',],
                ["id" => 3, "name" => 'STEM203',],
            ]
        ], 
        ["id" => 7, 'level' => 'shs', "programname" => "Culinary Arts", "pathtopic" => 'assets/images/cularts.webp',
            "sections" => [
                ["id" => 0, "name" => 'CA101',],
                ["id" => 1, "name" => 'CA201',],
                ["id" => 2, "name" => 'CA202',],
                ["id" => 3, "name" => 'CA203',],
            ]
        ], 
        ["id" => 8, 'level' => 'shs', "programname" => "ITMAWD", "pathtopic" => 'assets/images/itmawd.webp',
            "sections" => [
                ["id" => 0, "name" => 'ITMAWD101',],
                ["id" => 1, "name" => 'ITMAWD201',],
                ["id" => 2, "name" => 'ITMAWD202',],
                ["id" => 3, "name" => 'ITMAWD203',],
            ]
        ]
    ]);

    return view('pages.section-schedules', ['program' => $programs[$itemid]]);

})->name('sections'); 

Route::get('/view-schedule/{sectionid}', function($sectionid) {

    $programs = collect([
        ["id" => 0, 'level' => 'ter', "programname" => "Computer Science", "pathtopic" => 'assets/images/cs.jpg', 
            "sections" => [
                ["id" => 0, "name" => 'BSCS101',],
                ["id" => 1, "name" => 'BSCS301',],
                ["id" => 2, "name" => 'BSCS302',],
                ["id" => 3, "name" => 'BSCS501',],
                ["id" => 4, "name" => 'BSCS502',],
                ["id" => 5, "name" => 'BSCS701',],
            ]
        ], 
        ["id" => 1, 'level' => 'ter', "programname" => "Information Technology", "pathtopic" => 'assets/images/it.jpg',
            "sections" => [
                ["id" => 0, "name" => 'BSIT101',],
                ["id" => 1, "name" => 'BSIT102',],
                ["id" => 2, "name" => 'BSIT103',],
                ["id" => 3, "name" => 'BSIT301',],
                ["id" => 4, "name" => 'BSIT502',],
                ["id" => 5, "name" => 'BSIT701',],
            ]
        ], 
        ["id" => 2, 'level' => 'ter', "programname" => "Computer Engineering", "pathtopic" => 'assets/images/cpe.jpg',
            "sections" => [
                ["id" => 0, "name" => 'BSCpE101',],
                ["id" => 1, "name" => 'BSCpE301',],
                ["id" => 2, "name" => 'BSCpE302',],
                ["id" => 3, "name" => 'BSCpE303',],
                ["id" => 4, "name" => 'BSCpE501',],
                ["id" => 5, "name" => 'BSCpE502',],
                ["id" => 6, "name" => 'BSCpE503',],
                ["id" => 7, "name" => 'BSCpE701',],
            ]
        ], 
        ["id" => 3, 'level' => 'ter', "programname" => "Multimedia Arts", "pathtopic" => 'assets/images/mma.jpg',
            "sections" => [
                ["id" => 0, "name" => 'BMMA101',],
                ["id" => 1, "name" => 'BMMA501',],
                ["id" => 2, "name" => 'BMMA502',],
                ["id" => 3, "name" => 'BMMA503',],
                ["id" => 4, "name" => 'BMMA502',],
                ["id" => 5, "name" => 'BMMA701',],
            ]
        ],
        ["id" => 4, 'level' => 'ter', "programname" => "Tourism Management", "pathtopic" => 'assets/images/tm.jpg',
            "sections" => [
                ["id" => 0, "name" => 'BSTM101',],
                ["id" => 1, "name" => 'BSTM501',],
                ["id" => 2, "name" => 'BSTM502',],
                ["id" => 3, "name" => 'BSTM503',],
                ["id" => 4, "name" => 'BSTM502',],
                ["id" => 5, "name" => 'BSTM701',],
            ]
        ],
        ["id" => 5, 'level' => 'shs', "programname" => "ABM", "pathtopic" => 'assets/images/abm.jpg',
            "sections" => [
                ["id" => 0, "name" => 'ABM101',],
                ["id" => 1, "name" => 'ABM301',],
                ["id" => 2, "name" => 'ABM302',],
            ]
        ], 
        ["id" => 6, 'level' => 'shs', "programname" => "STEM", "pathtopic" => 'assets/images/stem.jpg',
            "sections" => [
                ["id" => 0, "name" => 'STEM101',],
                ["id" => 1, "name" => 'STEM201',],
                ["id" => 2, "name" => 'STEM202',],
                ["id" => 3, "name" => 'STEM203',],
            ]
        ], 
        ["id" => 7, 'level' => 'shs', "programname" => "Culinary Arts", "pathtopic" => 'assets/images/cularts.jpg',
            "sections" => [
                ["id" => 0, "name" => 'CA101',],
                ["id" => 1, "name" => 'CA201',],
                ["id" => 2, "name" => 'CA202',],
                ["id" => 3, "name" => 'CA203',],
            ]
        ], 
        ["id" => 8, 'level' => 'shs', "programname" => "ITMAWD", "pathtopic" => 'assets/images/itmawd.jpg',
            "sections" => [
                ["id" => 0, "name" => 'ITMAWD101',],
                ["id" => 1, "name" => 'ITMAWD201',],
                ["id" => 2, "name" => 'ITMAWD202',],
                ["id" => 3, "name" => 'ITMAWD203',],
            ]
        ]
    ]);

    $sectionname = 'BSCS601';

    return view('pages.view-schedule', ['sectionname' => $sectionname]);
})->name('view.schedule');

Route::get('/schedule/getclasstimeslots', [ClassTimeSlotController::class, 'get_classtimeslots'])->name('get.schedule');