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
namespace Blockchain\Create;

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
class WalletResponse
{
    /**
     * Properties
     */
    /**
     * @var string
     */
    public $guid;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $label;

    /**
     * Methods
     */
    /**
     * __construct
     *
     * @param $json
     */
    public function __construct($json)
    {
        if (array_key_exists('guid', $json)) {
            $this->guid = $json['guid'];
        }

        if (array_key_exists('address', $json)) {
            $this->address = $json['address'];
        }

        if (array_key_exists('label', $json)) {
            $this->link = $json['label'];
        }
    }
}
