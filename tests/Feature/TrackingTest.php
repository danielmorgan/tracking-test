<?php

namespace Tests\Feature;

use App\FakeTracker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TrackingTest extends TestCase
{
    /** @test */
    public function gps_coordinates_can_be_uploaded_and_saved_as_points()
    {
        // create a gps coord object
        $coords = (new FakeTracker)->createTestPayload();

        dd($coords);

        // post to endpoint
        $this->postJson('/api/v1/track', json_encode($coords));

        // assert DB not empty
        // assert data matches
    }
}
