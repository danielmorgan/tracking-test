<?php

namespace Tests\Feature;

use App\LineString;
use App\Point;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MapViewTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_show_a_users_points_on_map()
    {
        // ARRANGE
        // create some points
        factory(Point::class, 3)->create();
        // format as LineString
        $lineString = new LineString(Point::all());

        // ACT
        // visit map page
        $response = $this->get('/');

        // ASSERT
        // linestring variable available
        $this->assertCount(3, $lineString->points);
        $response->assertViewHas('points', $lineString->points);
    }
}
