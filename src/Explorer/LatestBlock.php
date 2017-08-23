<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */


namespace Blockchain\Explorer;

class LatestBlock
{
    /**
     * Properties
     */
    public $hash;                       // string
    public $time;                       // int
    public $block_index;                // int
    public $height;                     // int
    public $tx_indexes = array();       // Array of integer transaction indexes

    /**
     * Methods
     */
    public function __construct($json) {
        if(array_key_exists('hash', $json))
            $this->hash = $json['hash'];
        if(array_key_exists('time', $json))
            $this->time = $json['time'];
        if(array_key_exists('block_index', $json))
            $this->block_index = $json['block_index'];
        if(array_key_exists('height', $json))
            $this->height = $json['height'];
        if(array_key_exists('txIndexes', $json))
            $this->tx_indexes[] = $json['txIndexes'];
    }
}