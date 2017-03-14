<?php

namespace Tests\Feature;

use App\FakeTracker;
use App\Point;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TrackingTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function tracking_data_can_be_uploaded_and_saved_as_points()
    {
        $this->disableExceptionHandling();
        $payload = (new FakeTracker)->createTestPayload();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->postJson('/api/v1/track', $payload);

        $response->assertStatus(201);
        $this->assertCount(1, Point::all());
    }

    /** @test */
    public function invalid_tracking_data_is_not_saved()
    {
        $this->disableExceptionHandling();
        $payload = ['foo' => 'bar'];
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->postJson('/api/v1/track', $payload);

        $response->assertStatus(422);
        $this->assertEmpty(Point::all());
    }
}
