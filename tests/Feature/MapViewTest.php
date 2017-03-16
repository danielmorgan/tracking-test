<?php

namespace Tests\Feature;

use App\LineString;
use App\Point;
use Carbon\Carbon;
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
        factory(Point::class, 3)->create();

        $response = $this->get('/');

        $lineString = new LineString(Point::all());
        $this->assertCount(3, $lineString->points);
        $response->assertViewHas('points', $lineString->points);
    }

    /** @test */
    public function track_contains_points_in_order_they_were_recorded_at()
    {
        factory(Point::class)->create(['recorded_at' => Carbon::parse('16 March 2017, 13:30:00')]);
        factory(Point::class)->create(['recorded_at' => Carbon::parse('16 March 2017, 13:29:00')]);
        factory(Point::class)->create(['recorded_at' => Carbon::parse('16 March 2017, 13:31:00')]);

        $response = $this->get('/');

        $this->assertEquals('2017-03-16 13:29:00', $response->original->points->first()->recorded_at);
        $this->assertEquals('2017-03-16 13:31:00', $response->original->points->last()->recorded_at);
    }
}
