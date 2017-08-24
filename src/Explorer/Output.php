<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */


namespace Blockchain\Explorer;

class Output
{
    /**
     * Properties
     */
    public $n;                          // int
    public $value;                      // string, e.g. "12.64952835"
    public $address;                    // string
    public $tx_index;                   // int
    public $script;                     // string
    public $spent;                      // bool

    /**
     * Methods
     */
    public function __construct($json)
    {
        if (array_key_exists('n', $json)) {
            $this->n = $json['n'];
        }
        if (array_key_exists('value', $json)) {
            $this->value = \Blockchain\Conversion\Conversion::btcInt2Str($json['value']);
        }
        if (array_key_exists('addr', $json)) {
            $this->address = $json['addr'];
        }
        if (array_key_exists('tx_index', $json)) {
            $this->tx_index = $json['tx_index'];
        }
        if (array_key_exists('script', $json)) {
            $this->script = $json['script'];
        }
        if (array_key_exists('spent', $json)) {
            $this->spent = $json['spent'];
        }
        if (array_key_exists('addr_tag', $json)) {
            $this->address_tag = $json['addr_tag'];
        }
        if (array_key_exists('addr_tag_link', $json)) {
            $this->address_tag_link = $json['addr_tag_link'];
        }
    }
}
