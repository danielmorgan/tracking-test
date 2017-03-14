<?php

namespace Tests\Unit;

use App\FakeTracker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FakeTrackerTest extends TestCase
{
    /** @test */
    function create_test_payload()
    {
        $payload = (new FakeTracker)->createTestPayload();

        $this->assertArrayHasKey('_type', $payload);
        $this->assertEquals('location', $payload['_type']);
        $this->assertArrayHasKey('lat', $payload);
        $this->assertArrayHasKey('lng', $payload);
        $this->assertArrayHasKey('tst', $payload);
    }
}
