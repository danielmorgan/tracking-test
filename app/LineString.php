<?php

namespace App;

use Illuminate\Support\Collection;

class LineString
{
    /** @var \Illuminate\Support\Collection */
    public $points;

    public function __construct($points = null)
    {
        $this->points = new Collection;

        foreach ($points as $point) {
            $this->addPoint($point);
        }
    }

    public function addPoint(Point $point)
    {
        $this->points->push($point);

        return $this;
    }

    public function addPoints(\ArrayAccess $points)
    {
        foreach ($points as $point) {
            $this->addPoint($point);
        }

        return $this;
    }

    public function toArray()
    {
        return $this->points->map(function ($point) {
            return [(float) $point->lon, (float) $point->lat];
        })->toArray();
    }

    public function toGeojson()
    {
        return json_encode([
            'type' => 'FeatureCollection',
            'features' => [
                [
                    'type' => 'Feature',
                    'properties' => [],
                    'geometry' => [
                        'type' => 'LineString',
                        'coordinates' => $this->toArray()
                    ]
                ]
            ]
        ]);
    }
}
