<?php

namespace App\Http\Controllers;

use App\Point;
use Illuminate\Http\Request;

class TrackerController extends Controller
{
    public function track(Request $request)
    {
        try {
            Point::createFromTracker($request->all());
        } catch (\Exception $e) {
            return response()->json(['success' => false], 422);
        }

        return response()->json(['success' => true], 201);
    }
}
