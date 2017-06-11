Statistics Documentation
========================

Provides data found on the [Blockchain stats page](https://blockchain.info/stats), representing Bitcoin network statistics for the past 24 hours.

Get Stats
---------
Get a snapshot of the network statistics. Returns a `StatsResponse` object.

```php
$Blockchain = new \Blockchain\Blockchain($api_code);

$stats = $Blockchain->Stats->get();
```

### StatsReponse

```php
class StatsResponse {
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
}
```
