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
        $lineString = new LineString(Point::all());

        JavaScriptFacade::put(['points' => $lineString->points]);

        return view('mockups.map', ['points' => $lineString->points]);
    }
}
