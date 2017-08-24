<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Blockchain\Explorer;

class Address
{
    /**
     * Properties
     */
    public $hash160;                    // string
    public $address;                    // string
    public $n_tx;                       // int
    public $total_received;             // string, e.g. "12.64952835"
    public $total_sent;                 // string, e.g. "12.64952835"
    public $final_balance;              // string, e.g. "12.64952835"
    public $transactions = array();     // Array of Transaction objects

    /**
     * Methods
     */
    public function __construct($json)
    {
        if (array_key_exists('hash160', $json)) {
            $this->hash160 = $json['hash160'];
        }
        if (array_key_exists('address', $json)) {
            $this->address = $json['address'];
        }
        if (array_key_exists('n_tx', $json)) {
            $this->n_tx = $json['n_tx'];
        }
        if (array_key_exists('total_received', $json)) {
            $this->total_received = \Blockchain\Conversion\Conversion::btcInt2Str($json['total_received']);
        }
        if (array_key_exists('total_sent', $json)) {
            $this->total_sent = \Blockchain\Conversion\Conversion::btcInt2Str($json['total_sent']);
        }
        if (array_key_exists('final_balance', $json)) {
            $this->final_balance = \Blockchain\Conversion\Conversion::btcInt2Str($json['final_balance']);
        }
        if (array_key_exists('txs', $json)) {
            foreach ($json['txs'] as $txn) {
                $this->transactions[] = new Transaction($txn);
            }
        }
    }
}
