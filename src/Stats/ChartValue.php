<?php

namespace Blockchain\Stats;

class ChartValue
{
    /*
    * Properties
    */
    public $x;           // float
    public $y;           // float

    /*
    * Methods
    */
    public function __construct($json)
    {
        if (array_key_exists('x', $json)) {
            $this->x = $json['x'];
        }
        if (array_key_exists('y', $json)) {
            $this->y = $json['y'];
        }
    }
}
