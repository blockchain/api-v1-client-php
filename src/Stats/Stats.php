<?php

namespace Blockchain\Stats;

use \Blockchain\Blockchain;

class Stats
{
    public function __construct(Blockchain $blockchain)
    {
        $this->blockchain = $blockchain;
    }

    public function get()
    {
        return new StatsResponse($this->blockchain->get('stats', array('format'=>'json')));
    }

    public function getChart($chart_type, $timespan = null, $rolling_average = null)
    {
        $params = array('format' => 'json');
        if (!is_null($timespan)) {
            $params['timespan'] = $timespan;
        }
        if (!is_null($rolling_average)) {
            $params['rollingAverage'] = $rolling_average;
        }

        return new ChartResponse($this->blockchain->get('charts/' . $chart_type, $params));
    }

    public function getPools($timespan = 4)
    {
        $params  = array(
            'format' => 'json',
            'timespan' => $timespan . 'days'
        );

        return $this->blockchain->get('pools', $params);
    }
}
