<?php

namespace Blockchain\V2\Receive;

/**
 * The ReceiveResponse from the Receive API
 *
 * @author George Robinson <george.robinson@blockchain.com>
 */
class ReceiveResponse
{

    /**
     * @var string
     */
    private $address;

    /**
     * @var int
     */
    private $index;

    /**
     * @var string
     */
    private $callback;

    /**
     *
     * @param string $address  The receive address.
     * @param int    $index    The index of the receive address.
     * @param string $callback The callback URL.
     */
    public function __construct($address, $index, $callback)
    {
        $this->address = $address;
        $this->index = $index;
        $this->callback = $callback;
    }

    /**
     * Gets the receive address.
     *
     * @return string
     */
    public function getReceiveAddress()
    {
        return $this->address;
    }

    /**
     * Gets the index of the receive address.
     *
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Gets the callback URL.
     *
     * @return string
     */
    public function getCallback()
    {
        return $this->callback;
    }
}
