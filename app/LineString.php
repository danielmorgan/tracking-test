<?php

namespace App;

use Illuminate\Support\Collection;

class LineString
{
    /** @var \Illuminate\Support\Collection */
    public $points;

    public function __construct(\ArrayAccess $points = null)
    {
        $this->points = $points ?: new Collection;
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
}
