<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Blockchain\Wallet;

use Blockchain\Conversion\Conversion;

class WalletAddress
{
    /**
     * Properties
     */
    public $balance;                    // string, e.g. "12.64952835"
    public $address;                    // string
    public $label;                      // string
    public $total_received;             // string, e.g. "12.64952835"

    /**
     * Methods
     */
    public function __construct($json)
    {
        if (array_key_exists('balance', $json)) {
            $this->balance = Conversion::btcInt2Str($json['balance']);
        }
        if (array_key_exists('address', $json)) {
            $this->address = $json['address'];
        }
        if (array_key_exists('label', $json)) {
            $this->label = $json['label'];
        }
        if (array_key_exists('total_received', $json)) {
            $this->total_received = $json['total_received'];
        }
    }
}
