<?php

namespace Blockchain\Rates;

use Blockchain\Blockchain;

class Rates
{
    public function __construct(Blockchain $blockchain)
    {
        $this->blockchain = $blockchain;
    }

    public function get()
    {
        $rates = array();

        $json = $this->blockchain->get('ticker', array('format' => 'json'));
        foreach ($json as $cur => $data) {
            $rates[$cur] = new Ticker($cur, $data);
        }

        return $rates;
    }

    public function toBTC($amount, $symbol)
    {
        $params = array(
            'currency' => $symbol,
            'value'    => $amount,
            'format'   => 'json'
        );

        return $this->blockchain->get('tobtc', $params);
    }

    public function fromBTC($amount, $symbol = '')
    {
        $params = array(
            'currency' => $symbol,
            'value' => $amount,
            'format' => 'json'
        );

        return $this->blockchain->get('frombtc', $params);
    }
}
