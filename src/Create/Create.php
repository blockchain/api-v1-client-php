<?php

namespace Blockchain\Create;

use \Blockchain\Blockchain;
use \Blockchain\Exception\ParameterError;

class Create
{
    public function __construct(Blockchain $blockchain)
    {
        $this->blockchain = $blockchain;
    }

    public function create($password, $email = null, $label = null)
    {
        return $this->doCreate($password, null, $email, $label);
    }

    public function createWithKey($password, $privKey, $email = null, $label = null)
    {
        if (!isset($privKey) || is_null($privKey)) {
            throw new ParameterError("Private Key required.");
        }

        return $this->doCreate($password, $privKey, $email, $label);
    }

    public function doCreate($password, $priv = null, $email = null, $label = null)
    {
        if (!isset($password) || is_null($password)) {
            throw new ParameterError("Password required.");
        }
        
        $params = array(
            'password'=>$password,
            'format'=>'json'
        );
        if (!is_null($priv)) {
            $params['priv'] = $priv;
        }
        if (!is_null($email)) {
            $params['email'] = $email;
        }
        if (!is_null($label)) {
            $params['label'] = $label;
        }

        return new WalletResponse($this->blockchain->post('api/v2/create', $params));
    }
}
