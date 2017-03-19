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
        $points = Point::all()->sortBy('recorded_at', SORT_REGULAR, true)->values();
        $lineString = new LineString($points);

        JavaScriptFacade::put(['fixture' => json_decode($lineString->toGeojson())]);

        return view('mockups.map');
    }

    public function contentMockup()
    {
        return view('mockups.content');
    }
}
