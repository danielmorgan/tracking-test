<?php

namespace App;

use Carbon\Carbon;
use Faker\Factory as FakerFactory;

class FakeTracker
{
    public function createTestPayload()
    {
        $faker = FakerFactory::create();

        return [
            '_type' => 'location',
            'lat' => $faker->latitude,
            'lng' => $faker->longitude,
            'tst' => Carbon::now()->timestamp,
        ];
    }
}
