<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppSnapshot;
use Illuminate\Http\Request;

class AppSnapshotContoller extends Controller
{
    public function index() {
        $snapshot = AppSnapshot::latest()->get();

        if(!$snapshot) {
            return response()->json(['message' => 'No records found.'], 404);
        }

        return response()->json($snapshot);
    }
}
