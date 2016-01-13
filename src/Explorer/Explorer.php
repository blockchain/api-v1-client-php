<?php

namespace Blockchain\Explorer;

use \Blockchain\Blockchain;
use \Blockchain\Exception\FormatError;

class Explorer {
    public function __construct(Blockchain $blockchain) {
        $this->blockchain = $blockchain;
    }

    public function getBlockCount()
    {
        return $this->blockchain->get('q/getblockcount');
    }

    public function getBlock($hash) {
        return new Block($this->blockchain->get('rawblock/' . $hash, array('format'=>'json')));
    }

    public function getBlocksAtHeight($height) {
        if(!is_integer($height)) {
            throw new FormatError('Block height must be iteger.');
        }
        $blocks = array();
        $json = $this->blockchain->get('block-height/' . $height, array('format'=>'json'));
        if(array_key_exists('blocks', $json)) {
            foreach ($json['blocks'] as $block) {
                $blocks[] = new Block($block);
            }
        }

        return $blocks;
    }

    public function getBlockByIndex($index) {
        if(!is_integer($index)) {
            throw new FormatError('Block index must be iteger.');
        }
        return new Block($this->blockchain->get('block-index/' . $index, array('format'=>'json')));
    }

    public function getTransaction($txid) {
        return new Transaction($this->blockchain->get('rawtx/' . $txid, array('format'=>'json')));
    }

    public function getTransactionByIndex($index) {
        return new Transaction($this->blockchain->get('rawtx/' . intval($index), array('format'=>'json')));
    }

    /*     Get details about a single address, listing up to $limit transactions
         starting at $offset.
    */
    public function getAddress($address, $limit=50, $offset=0) {
        $params = array(
            'format'=>'json',
            'limit'=>intval($limit),
            'offset'=>intval($offset)
        );
        return new Address($this->blockchain->get('address/' . $address, $params));
    }

    /* Get a list of unspent outputs for an array of addresses

    */
    public function getUnspentOutputs($addresses) {
        if(!is_array($addresses))
            throw new FormatError('Must pass array argument.');
        $params = array(
            'format'=>'json',
            'active'=>implode('|', $addresses)
        );
        $json = $this->blockchain->get('unspent', $params);
        $outputs = Array();
        if(array_key_exists('unspent_outputs', $json)) {
            foreach ($json['unspent_outputs'] as $output) {
                $outputs[] = new UnspentOutput($output);
            }
        }
        return $outputs;
    }

    public function getLatestBlock() {
        return new LatestBlock($this->blockchain->get('latestblock', array('format'=>'json')));
    }

    public function getUnconfirmedTransactions() {
        $json = $this->blockchain->get('unconfirmed-transactions', array('format'=>'json'));
        $txn = array();
        if(array_key_exists('txs', $json)) {
            foreach ($json['txs'] as $tx) {
                $txn[] = new Transaction($tx);
            }
        }
        return $txn;
    }

    /* Get blocks for a specific day, provided UNIX timestamp, in seconds.
    */
    public function getBlocksForDay($unix_time=0) {
        $time_ms = strval($unix_time) . '000';
        return $this->processSimpleBlockJSON($this->blockchain->get('blocks/'.$time_ms, array('format'=>'json')));
    }

    /* Get blocks for a specific mining pool.
    */
    public function getBlocksByPool($pool) {
        return $this->processSimpleBlockJSON($this->blockchain->get('blocks/'.$pool, array('format'=>'json')));
    }

    private function processSimpleBlockJSON($json) {
        $blocks = array();
        if(array_key_exists('blocks', $json)) {
            foreach ($json['blocks'] as $block) {
                $blocks[] = new SimpleBlock($block);
            }
        }
        return $blocks;
    }

    public function getInventoryData($hash) {
        return new InventoryData($this->blockchain->get('inv/'.$hash, array('format'=>'json')));
    }
}