<?php

namespace Blockchain\V2\Receive;

use Blockchain\Exception\Error;
use Blockchain\Exception\HttpError;

use DateTime;
use DateTimeZone;

/**
 * The V2 Receive API client.
 *
 * @author George Robinson <george.robinson@blockchain.com>
 */
class Receive
{
    /**
     * @var string
     */
    const URL = 'https://api.blockchain.info/v2/receive';

    /**
     * @var resource
     */
    private $ch;

    /**
     * Instantiates a receive API client.
     *
     * @param resource $ch The cURL resource.
     */
    public function __construct($ch)
    {
        $this->ch = $ch;
    }

    /**
     * Generates a receive adddress.
     *
     * @param string $key The API key.
     * @param string $xpub The public key.
     * @param string $callback The callback URL.
     * @param int    $gap_limit How many unused addresses are allowed.
     * @return \Blockchain\V2\Receive\ReceiveResponse
     * @throws \Blockchain\Exception\Error
     * @throws \Blockchain\Exception\HttpError
     */
    public function generate($key, $xpub, $callback, $gap_limit = null)
    {
        $p = compact('key', 'xpub', 'callback');
        if(!is_null($gap_limit))
            $p['gap_limit'] = $gap_limit;
        $q = http_build_query($p, null, '&');

        curl_setopt($this->ch, CURLOPT_POST, false);
        curl_setopt($this->ch, CURLOPT_URL, static::URL.'?'.$q);

        if (($resp = curl_exec($this->ch)) === false) {
            throw new HttpError(curl_error($this->ch));
        }

        if (($data = json_decode($resp, true)) === NULL) {
            throw new Error("Unable to decode JSON response from Blockchain: $resp");
        }

        $info = curl_getinfo($this->ch);

        if ($info['http_code'] == 200) {
            return new ReceiveResponse($data['address'], $data['index'], $data['callback']);
        }

        throw new Error(implode(', ', $data));
    }

    /**
    * Get the index gap bewteen the last address
    * paid to and the last address generated
    *
    * @param string $key The API key.
    * @param string $xpub The public key.
    * @return int The address gap.
    * @throws \Blockchain\Exception\Error
    * @throws \Blockchain\Exception\HttpError
    */
    public function checkAddressGap($key, $xpub)
    {
        $p = compact('key', 'xpub');
        $q = http_build_query($p, null, '&');

        curl_setopt($this->ch, CURLOPT_POST, false);
        curl_setopt($this->ch, CURLOPT_URL, static::URL.'/checkgap?'.$q);

        if (($resp = curl_exec($this->ch)) === false) {
            throw new HttpError(curl_error($this->ch));
        }

        if (($data = json_decode($resp, true)) === NULL) {
            throw new Error("Unable to decode JSON response from Blockchain: $resp");
        }

        $info = curl_getinfo($this->ch);

        if ($info['http_code'] == 200) {
            return $data['gap'];
        }

        throw new Error(implode(', ', $data));
    }

    /**
     * Gets the callback logs.
     *
     * @param string $key The API key.
     * @param string $callback The callback URL.
     * @return \Blockchain\V2\Receive\CallbackLogEntry[]
     * @throws \Blochchain\Exception\Error
     * @throws \Blockchain\Exception\HttpError
     */
    public function callbackLogs($key, $callback)
    {
        $p = compact('key', 'callback');
        $q = http_build_query($p, null, '&');

        curl_setopt($this->ch, CURLOPT_POST, false);
        curl_setopt($this->ch, CURLOPT_URL, static::URL.'/callback_log?'.$q);

        if (($resp = curl_exec($this->ch)) === false) {
            throw new HttpError(curl_error($this->ch));
        }

        if (($data = json_decode($resp, true)) === NULL) {
            throw new Error("Unable to decode JSON response from Blockchain: $resp");
        }

        $info = curl_getinfo($this->ch);

        if ($info['http_code'] == 200) {
            return array_map([$this, 'createCallbackLogEntry'], (array) $data);
        }

        throw new Error(implode(', ', $data));
    }

    /**
     * Creates a callback log entry.
     *
     * @param string[mixed] $data
     * @return \Blockchain\V2\Receive\CallbackLogEntry
     */
    private function createCallbackLogEntry($data)
    {
        return new CallbackLogEntry($data['callback'],
                                    new DateTime($data['called_at']),
                                    $data['raw_response'],
                                    $data['response_code']);
    }
}
