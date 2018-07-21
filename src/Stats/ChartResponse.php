<?php

namespace Blockchain\Stats;

class ChartResponse
{
    /*
    * Properties
    */
    public $chart_name;          // string
    public $unit;                // string
    public $timespan;            // string
    public $description;         // string
    public $values = array();    // array of ChartValue objects

    /*
    * Methods
    */
    public function __construct($json)
    {
        if (array_key_exists('name', $json)) {
            $this->chart_name = $json['name'];
        }
        if (array_key_exists('unit', $json)) {
            $this->unit = $json['unit'];
        }
        if (array_key_exists('timespan', $json)) {
            $this->timespan = $json['timespan'];
        }
        if (array_key_exists('description', $json)) {
            $this->description = $json['description'];
        }
        if (array_key_exists('values', $json)) {
            foreach ($json['values'] as $value) {
                $this->values[] = new ChartValue($value);
            }
        }
    }
}
