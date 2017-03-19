<?php

namespace Tests\Unit;

use App\LineString;
use App\Point;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LineStringTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_store_a_point()
    {
        $point = factory(Point::class)->create();
        $lineString = new LineString;

        $lineString->addPoint($point);

        $this->assertCount(1, $lineString->points);
        $this->assertEquals($point, $lineString->points->first());
    }

    /** @test */
    public function can_store_points()
    {
        $point1 = factory(Point::class)->create();
        $point2 = factory(Point::class)->create();
        $lineString = new LineString;

        $lineString->addPoints(collect([$point1, $point2]));

        $this->assertCount(2, $lineString->points);
    }

    /** @test */
    public function returning_geojson_feature_collection()
    {
        $lineString = factory(LineString::class)->make();

        $geojson = $lineString->toGeojson();

        $this->assertStringStartsWith('{', $geojson);
        $this->assertStringEndsWith('}', $geojson);
    }
}
