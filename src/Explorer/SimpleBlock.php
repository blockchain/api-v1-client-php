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
class SimpleBlock
{
    /**
     * Properties
     */
    public $height;                     // int
    public $hash;                       // string
    public $time;                       // int
    public $main_chain;                 // bool

    /**
     * Methods
     */
    public function __construct($json)
    {
        if (array_key_exists('height', $json)) {
            $this->height = $json['height'];
        }
        if (array_key_exists('hash', $json)) {
            $this->hash = $json['hash'];
        }
        if (array_key_exists('time', $json)) {
            $this->time = $json['time'];
        }
        if (array_key_exists('main_chain', $json)) {
            $this->main_chain = $json['main_chain'];
        }
    }
}
