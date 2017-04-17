Wallet Documentation
===================
Access a Blockchain wallet programmatically. Official documentation [here](https://blockchain.info/api/blockchain_wallet_api).

Basic Usage
-----------
The `Blockchain` object contains a single member `Wallet` object. The wallet credentials must be set before any functionality may be used. Accessing multiple wallets is as simple as setting the credentials before making wallet calls.
In order to use Wallet and CreateWallet functionality, you must provide an URL to an instance of [service-my-wallet-v3](https://github.com/blockchain/service-my-wallet-v3).


```php
$Blockchain = new \Blockchain\Blockchain($api_code);
$Blockchain->setServiceUrl("http://localhost:3000");
$Blockchain->Wallet->credentials('wallet-id-1', 'password-1', 'optional 2nd password');

// Operations on "wallet-id-1"
// ...

// Switch to another wallet
$Blockchain->Wallet->credentials('wallet-id-2', 'password-2', 'optional 2nd password');

// Operations on "wallet-id-2"
// ...
```

### A Note About Bitcoin Values

Values returned by this API are `string` representations of the floating point Bitcoin value, with 8 decimal places of precision, like this: `"105.62774000"`.

Functions that send Bitcoin accept `float` and `string` Bitcoin amounts, NOT Satoshi amounts.

Read more about string values on the [main documentation](../README.md).


### Get Current Identifier
Use the `getIdentifier` function to check which wallet is active, without having to enter additional credentials. Returns a string.

```php
$active_id = $Blockchain->Wallet->getIdentifier();
```


Balances
--------
Functions for fetching the balance of a whole wallet or of a particular address.


### Wallet Balance
Get the balance of the whole wallet. Returns a `string` representing the floating point balance, e.g. `"12.64952835"`.

```php
$balance = $Blockchain->Wallet->getBalance();
```


### Address Balance
Get the balance of a single wallet address. Returns a `WalletAddress` object.

```php
$balance = $Blockchain->Wallet->getAddressBalance($address);
```


Transactions
------------
Functions for making outgoing Bitcoin transactions from the wallet.

### Send
Send Bitcoin to a single recipient address. The `$amount` field is either a `float` or `string` representation of the floating point value. See above note on Bitcoin values.

The optional `$from_address` field specifies which wallet address from which to send the funds. An optional `$fee` amount (`float`) may be specified but must be more than the default fee listed on the [official documentation](https://blockchain.info/api/blockchain_wallet_api).

The `$public_note` parameter is a message that will appear alongside this transaction on the blockchain.info block explorer. A minimum transaction size of 0.005 BTC is required for public notes.

Returns a `PaymentResponse` object on success and throws a `Blockchain_ApiError` exception for insufficient funds, etc.

```php
$response = $Blockchain->Wallet->send($to_address, $amount, $from_address=null, $fee=null, $public_note=null);

// Example: Send 0.005 BTC to the Genesis of Bitcoin address, with a 0.0001 BTC fee and a public note
$response = $Blockchain->Wallet->send("1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa", "0.005", null, "0.0001", "Here you go, Satoshi!");
```

### SendMany
Send a multi-recipient transaction to many addresses at once. The `$recipients` parameter is an associative array with `address` keys and `amount` values (see example). Optional parameters are the same as with the `send` call. Returns `PaymentResponse` object and throws a `Blockchain_ApiError` exception for insufficient funds, etc.
```php
$response = $Blockchain->Wallet->sendMany($recipients, $from_address=null, $fee=null, $public_note=null);

// Example: the following produces the same transaction as the previous example.
$recipients = array(
    "1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa" => "0.005"
);
$response = $Blockchain->Wallet->sendMany($recipients, null, "0.0001", "Here you go, Satoshi!");
```


Address Management
------------------
A wallet may contain many addresses, not all of which must be active at all times. Active addresses are monitored for activity, while archived addresses are not. It is recommended that addresses be archived when it is reasonable to assume that there will not be further activity to that address. For instance, after an invoice is filled, the payment address may be archived once the received coins are moved.


### List Active Addresses
Call `getAddresses` to return a list of the active addresses within the wallet. Returns an array of `WalletAddress` objects.

```php
$addresses = $Blockchain->Wallet->getAddresses();
```


### Get New Address
Generate a new Bitcoin address, with an optional label, less than 255 characters in length. Returns a `WalletAddress` object.

```php
$address = $Blockchain->Wallet->getNewAddress($label=null);
```


### Archive Address
Move an address to the archive. Returns `true` on success and `false` on failure.

```php
$result = $Blockchain->Wallet->archiveAddress($address);
```


### Unrchive Address
Move an address from the archive to the active address list. Returns `true` on success and `false` on failure.

```php
$result = $Blockchain->Wallet->unarchiveAddress($address);
```


Return Objects
--------------

Calls to the API usually return first-class objects.

### PaymentResponse

```php
class PaymentResponse {
    public $message;                    // string
    public $tx_hash;                    // string
    public $notice;                     // string
}
```

### WalletAddress

```php
class WalletAddress {
    public $balance;                    // string, e.g. "12.64952835"
    public $address;                    // string
    public $label;                      // string
    public $total_received;             // string, e.g. "12.64952835"
}
```

