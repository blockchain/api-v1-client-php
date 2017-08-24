<?php

namespace Blockchain\PushTX;

use Blockchain\Blockchain;

class Push
{
    public function __construct(Blockchain $blockchain)
    {
        $this->blockchain = $blockchain;
    }

    public function TX($hex)
    {
        $this->blockchain->post('pushtx', array('tx'=>$hex));

        return true;
    }
}
