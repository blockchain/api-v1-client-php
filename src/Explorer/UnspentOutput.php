<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Blockchain\Explorer;

use Blockchain\Conversion\Conversion;

class UnspentOutput
{
    /**
     * Properties
     */
    public $tx_hash;                    // string
    public $tx_hash_le;                 // string
    public $tx_index;                   // int
    public $tx_output_n;                // int
    public $script;                     // string
    public $value;                      // string, e.g. "12.64952835"
    public $value_hex;                  // string
    public $confirmations;              // int

    /**
     * Methods
     */
    public function __construct($json)
    {
        if (array_key_exists('tx_hash', $json)) {
            $this->tx_hash_le = $json['tx_hash'];
        }
        if (array_key_exists('tx_hash_big_endian', $json)) {
            $this->tx_hash = $json['tx_hash_big_endian'];
        }
        if (array_key_exists('tx_index', $json)) {
            $this->tx_index = $json['tx_index'];
        }
        if (array_key_exists('tx_output_n', $json)) {
            $this->tx_output_n = $json['tx_output_n'];
        }
        if (array_key_exists('script', $json)) {
            $this->script = $json['script'];
        }
        if (array_key_exists('value', $json)) {
            $this->value = Conversion::btcInt2Str($json['value']);
        }
        if (array_key_exists('value_hex', $json)) {
            $this->value_hex = $json['value_hex'];
        }
        if (array_key_exists('confirmations', $json)) {
            $this->confirmations = $json['confirmations'];
        }
    }
}
