<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */


namespace Blockchain\Explorer;

class Block
{
    /**
     * Properties
     */
    public $hash;                       // string
    public $version;                    // int
    public $previous_block;             // string
    public $merkle_root;                // string
    public $time;                       // int
    public $bits;                       // int
    public $fee;                        // string
    public $nonce;                      // int
    public $n_tx;                       // int
    public $size;                       // int
    public $block_index;                // int
    public $main_chain;                 // bool
    public $height;                     // int
    public $received_time;              // int
    public $relayed_by;                 // string
    public $transactions = array();     // Array of Transaction objects

    /**
     * Methods
     */
    public function __construct($json) {
        if(array_key_exists('hash', $json))
            $this->hash = $json['hash'];
        if(array_key_exists('ver', $json))
            $this->version = $json['ver'];
        if(array_key_exists('prev_block', $json))
            $this->previous_block = $json['prev_block'];
        if(array_key_exists('mrkl_root', $json))
            $this->merkle_root = $json['mrkl_root'];
        if(array_key_exists('time', $json))
            $this->time = $json['time'];
        if(array_key_exists('bits', $json))
            $this->bits = $json['bits'];
        if(array_key_exists('fee', $json))
            $this->fee = \Blockchain\Conversion\Conversion::BTC_int2str($json['fee']);
        if(array_key_exists('nonce', $json))
            $this->nonce = $json['nonce'];
        if(array_key_exists('n_tx', $json))
            $this->n_tx = $json['n_tx'];
        if(array_key_exists('size', $json))
            $this->size = $json['size'];
        if(array_key_exists('block_index', $json))
            $this->block_index = $json['block_index'];
        if(array_key_exists('main_chain', $json))
            $this->main_chain = $json['main_chain'];
        if(array_key_exists('height', $json))
            $this->height = $json['height'];
        if(array_key_exists('received_time', $json))
            $this->received_time = $json['received_time'];
        if(array_key_exists('relayed_by', $json))
            $this->relayed_by = $json['relayed_by'];
        if(array_key_exists('tx', $json)) {
            foreach ($json['tx'] as $tx) {
                $this->transactions[] = new Transaction($tx);
            }
        }
    }
}