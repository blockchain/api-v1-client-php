<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Blockchain\Stats;

use Blockchain\Conversion\Conversion;

class StatsResponse
{
    /**
     * Properties
     */
    public $blocks_size;                        // int
    public $difficulty;                         // float
    public $estimated_btc_sent;                 // string - Bitcoin value
    public $estimated_transaction_volume_usd;   // float
    public $hash_rate;                          // float
    public $market_cap;                         // string
    public $market_price_usd;                   // float
    public $miners_revenue_btc;                 // int
    public $miners_revenue_usd;                 // float
    public $minutes_between_blocks;             // float
    public $n_blocks_mined;                     // int
    public $n_blocks_total;                     // int
    public $n_btc_mined;                        // string - Bitcoin value
    public $n_tx;                               // int
    public $nextretarget;                       // int
    public $timestamp;                          // float, seconds.milliseconds
    public $total_btc_sent;                     // string - Bitcoin value
    public $total_fees_btc;                     // string - Bitcoin value
    public $totalbc;                            // string - Bitcoin value
    public $trade_volume_btc;                   // float
    public $trade_volume_usd;                   // float

    /**
     * Methods
     */
    public function __construct($json)
    {
        if (array_key_exists('blocks_size', $json)) {
            $this->blocks_size = $json['blocks_size'];
        }
        if (array_key_exists('difficulty', $json)) {
            $this->difficulty = $json['difficulty'];
        }
        if (array_key_exists('estimated_btc_sent', $json)) {
            $this->estimated_btc_sent = Conversion::btcInt2Str(Conversion::bcconv($json['estimated_btc_sent']));
        }
        if (array_key_exists('estimated_transaction_volume_usd', $json)) {
            $this->estimated_transaction_volume_usd = $json['estimated_transaction_volume_usd'];
        }
        if (array_key_exists('hash_rate', $json)) {
            $this->hash_rate = $json['hash_rate'];
        }
        if (array_key_exists('market_price_usd', $json)) {
            $this->market_price_usd = $json['market_price_usd'];
        }
        if (array_key_exists('miners_revenue_btc', $json)) {
            $this->miners_revenue_btc = $json['miners_revenue_btc'];
        }
        if (array_key_exists('miners_revenue_usd', $json)) {
            $this->miners_revenue_usd = $json['miners_revenue_usd'];
        }
        if (array_key_exists('minutes_between_blocks', $json)) {
            $this->minutes_between_blocks = $json['minutes_between_blocks'];
        }
        if (array_key_exists('n_blocks_mined', $json)) {
            $this->n_blocks_mined = $json['n_blocks_mined'];
        }
        if (array_key_exists('n_blocks_total', $json)) {
            $this->n_blocks_total = $json['n_blocks_total'];
        }
        if (array_key_exists('n_btc_mined', $json)) {
            $this->n_btc_mined = Conversion::btcInt2Str(Conversion::bcconv($json['n_btc_mined']));
        }
        if (array_key_exists('n_tx', $json)) {
            $this->n_tx = $json['n_tx'];
        }
        if (array_key_exists('nextretarget', $json)) {
            $this->nextretarget = $json['nextretarget'];
        }
        if (array_key_exists('timestamp', $json)) {
            $this->timestamp = $json['timestamp']/1000.0;
        }
        if (array_key_exists('total_btc_sent', $json)) {
            $this->total_btc_sent = Conversion::btcInt2Str(Conversion::bcconv($json['total_btc_sent']));
        }
        if (array_key_exists('total_fees_btc', $json)) {
            $this->total_fees_btc = Conversion::btcInt2Str(Conversion::bcconv($json['total_fees_btc']));
        }
        if (array_key_exists('totalbc', $json)) {
            $this->totalbc = Conversion::btcInt2Str(Conversion::bcconv($json['totalbc']));
        }
        if (array_key_exists('trade_volume_btc', $json)) {
            $this->trade_volume_btc = $json['trade_volume_btc'];
        }
        if (array_key_exists('trade_volume_usd', $json)) {
            $this->trade_volume_usd = $json['trade_volume_usd'];
        }

        if (array_key_exists('market_cap', $json)) {
            $this->market_cap = $json['market_cap'];
        } else {
            $this->market_cap = bcmul($this->totalbc, $this->market_price_usd, 2);
        }
    }
}
