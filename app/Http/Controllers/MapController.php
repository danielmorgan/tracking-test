<?php

namespace App\Http\Controllers;

use App\LineString;
use App\Point;
use Illuminate\Http\Request;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class MapController extends Controller
{
    public function mockup()
    {
        $points = Point::all()->sortBy('recorded_at')->values();
        $lineString = new LineString($points);

        JavaScriptFacade::put(['points' => $lineString->points]);

        return view('mockups.map', ['points' => $lineString->points]);
    }

    public function contentMockup()
    {
        $points = Point::all()->sortBy('recorded_at')->values();
        $lineString = new LineString($points);

        JavaScriptFacade::put(['points' => $lineString->points]);

        return view('mockups.content', ['points' => $lineString->points]);
    }
}
