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
namespace Blockchain\Rates;

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
class Ticker
{
    /**
     * Properties
     */
    public $m15;                                // float
    public $last;                               // float
    public $buy;                                // float
    public $sell;                               // float
    public $cur;                                // string
    public $symbol;                             // string

    /**
     * Methods
     */
    public function __construct($cur, $json)
    {
        $this->cur = $cur;

        if (array_key_exists('15m', $json)) {
            $this->m15 = $json['15m'];
        }
        if (array_key_exists('last', $json)) {
            $this->last = $json['last'];
        }
        if (array_key_exists('buy', $json)) {
            $this->buy = $json['buy'];
        }
        if (array_key_exists('sell', $json)) {
            $this->sell = $json['sell'];
        }
        if (array_key_exists('symbol', $json)) {
            $this->symbol = $json['symbol'];
        }
    }
}
