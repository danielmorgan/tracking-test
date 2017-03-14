<?php

namespace Tests\Unit;

use App\Point;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PointTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function create_from_tracker_payload()
    {
        $dateTime = Carbon::parse('14 March 2017, 19:00:00');

        $point = Point::createFromTracker([
            'lat'   => 53.4825950,
            'lon'   => -2.2337500,
            'tst'   => $dateTime->timestamp,
        ]);

        $this->assertEquals($point->lat, 53.4825950);
        $this->assertEquals($point->lon, -2.2337500);
        $this->assertEquals($point->recorded_at, $dateTime);
    }
}
