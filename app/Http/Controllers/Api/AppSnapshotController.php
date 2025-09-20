<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppSnapshot;
use Exception;
use Illuminate\Http\Request;

class AppSnapshotController extends Controller
{
    public function index()
    {
        try {
            $snapshot = AppSnapshot::latest()->get();

            if (!$snapshot) {
                return response()->json(['message' => 'No records found.'], 404);
            }

            return response()->json($snapshot);
        } catch (Exception $error) {
            return response()->json([
                'message' => $error->getMessage(),
                'statusCode' => $error->getCode()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'deviceId' => 'required',
                'snapshot' => 'required|array'
            ]);

            AppSnapshot::create([
                'snapshot' => $validated['snapshot'],
                'device_id' => $validated['deviceId']
            ]);

            return response()->json([
                'message' => 'Snapshot successfully recorded',
            ]);
        } catch (Exception $error) {
            return response()->json([
                'message' => $error->getMessage(),
                'statusCode' => $error->getCode()
            ]);
        }
    }
}
