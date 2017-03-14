<?php

namespace App\Http\Controllers;

use App\Point;
use Illuminate\Http\Request;

class TrackerController extends Controller
{
    public function track(Request $request)
    {
        Point::createFromTracker($request->all());

        return response()->json(['success' => true], 201);
    }
}
