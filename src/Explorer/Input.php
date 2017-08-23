<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */


namespace Blockchain\Explorer;

class Input
{
    /**
     * Properties
     */
    public $sequence;                   // int
    public $script_sig;                 // string
    public $coinbase = true;            // bool

    /**
     * Methods
     */
    public function __construct($json) {
        if(array_key_exists('sequence', $json))
            $this->sequence = $json['sequence'];
        if(array_key_exists('script', $json))
            $this->script_sig = $json['script'];

        if(array_key_exists('prev_out', $json)) {
            $this->coinbase = false;

            $P = $json['prev_out'];
            if(array_key_exists('n', $P))
                $this->n = $P['n'];
            if(array_key_exists('value', $P))
                $this->value = \Blockchain\Conversion\Conversion::BTC_int2str($P['value']);
            if(array_key_exists('addr', $P))
                $this->address = $P['addr'];
            if(array_key_exists('tx_index', $P))
                $this->tx_index = $P['tx_index'];
            if(array_key_exists('type', $P))
                $this->type = $P['type'];
            if(array_key_exists('script', $P))
                $this->script = $P['script'];
            if(array_key_exists('addr_tag', $P))
                $this->address_tag = $P['addr_tag'];
            if(array_key_exists('addr_tag_link', $P))
                $this->address_tag_link = $P['addr_tag_link'];
        }
    }
}