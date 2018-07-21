<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Short File Description
 *
 * PHP version 5
 *
 * @category   aCategory
 * @package    aPackage
 * @subpackage aSubPackage
 * @author     anAuthor
 * @copyright  2014 a Copyright
 * @license    a License
 * @link       http://www.aLink.com
 */
namespace Blockchain\Explorer;

/**
 * Short Class Description
 *
 * PHP version 5
 *
 * @category   aCategory
 * @package    aPackage
 * @subpackage aSubPackage
 * @author     anAuthor
 * @copyright  2014 a Copyright
 * @license    a License
 * @link       http://www.aLink.com
 */
class Transaction
{
    /**
     * Properties
     */
    public $double_spend = false;       // bool
    public $block_height;               // int
    public $time;                       // int
    public $lock_time;                  // int
    public $relayed_by;                 // string
    public $hash;                       // string
    public $tx_index;                   // int
    public $version;                    // int
    public $size;                       // int
    public $inputs = array();           // Array of Input objects
    public $outputs = array();          // Array of Output objects

    /**
     * Methods
     */
    public function __construct($json)
    {
        if (array_key_exists('double_spend', $json)) {
            $this->double_spend = $json['double_spend'];
        }
        if (array_key_exists('block_height', $json)) {
            $this->block_height = $json['block_height'];
        }
        if (array_key_exists('time', $json)) {
            $this->time = $json['time'];
        }
        if (array_key_exists('lock_time', $json)) {
            $this->lock_time = $json['lock_time'];
        }
        if (array_key_exists('relayed_by', $json)) {
            $this->relayed_by = $json['relayed_by'];
        }
        if (array_key_exists('hash', $json)) {
            $this->hash = $json['hash'];
        }
        if (array_key_exists('tx_index', $json)) {
            $this->tx_index = $json['tx_index'];
        }
        if (array_key_exists('ver', $json)) {
            $this->version = $json['ver'];
        }
        if (array_key_exists('size', $json)) {
            $this->size = $json['size'];
        }
        if (array_key_exists('inputs', $json)) {
            foreach ($json['inputs'] as $input) {
                $this->inputs[] = new Input($input);
            }
        }
        if (array_key_exists('out', $json)) {
            foreach ($json['out'] as $output) {
                $this->outputs[] = new Output($output);
            }
        }
    }
}
