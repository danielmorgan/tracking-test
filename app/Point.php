<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public static function createFromTracker($payload)
    {
        return self::create([
            'lat'         => $payload['lat'],
            'lon'         => $payload['lon'],
            'recorded_at' => Carbon::createFromTimestamp($payload['tst']),
        ]);
    }
}
