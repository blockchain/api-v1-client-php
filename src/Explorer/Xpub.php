<?php

namespace Blockchain\Explorer;

class Xpub extends Address
{

    /**
    * Properties
    */
    public $change_index;             // int
    public $account_index;            // int
    public $gap_limit;                // int

    /**
    * Methods
    */
    public function __construct($json)
    {
        if (array_key_exists('change_index', $json)) {
            $this->change_index = $json['change_index'];
        }
        if (array_key_exists('account_index', $json)) {
            $this->change_index = $json['account_index'];
        }
        if (array_key_exists('gap_limit', $json)) {
            $this->change_index = $json['gap_limit'];
        }
        Address::__construct($json);
    }
}
