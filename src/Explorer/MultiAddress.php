<?php

namespace Blockchain\Explorer;

class MultiAddress
{
    /**
    * Properties
    */
    public $addresses = array();       // Array of Address objects
    public $transactions = array();    // Array of Transaction objects

    /**
    * Methods
    */
    public function __construct($json)
    {
        if (array_key_exists('addresses', $json)) {
            foreach ($json['addresses'] as $addr) {
                $this->addresses[] = new Address($addr);
            }
        }
        if (array_key_exists('txs', $json)) {
            foreach ($json['txs'] as $txn) {
                $this->transactions[] = new Transaction($txn);
            }
        }
    }
}
