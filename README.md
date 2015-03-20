Blockchain API library (PHP, v1)
================================

An official PHP library for interacting with the blockchain.info API.


Getting Started
---------------

Download the source or clone the repository. Copy the `lib/` folder into your project and add:
```php
require('lib/Blockchain.php');

$Blockchain = new \Blockchain\Blockchain();
```

All functionality is provided through the `Blockchain` object. 

###Call Limits

The [official documentation](https://blockchain.info/api) lists API call limits, which may be bypassed with an API code. If you use a code, enter it when you create the `Blockchain` object:

```php
$Blockchain = new Blockchain($my_api_code);
```

If you need an API code, you may request one [here](https://blockchain.info/api/api_create_code).

###Network Timeouts

Set the `cURL` timeout, in seconds, with the `setTimeout` member function:

```php
$Blockchain->setTimeout($timeout_seconds);
```

The default network timeout is `60` seconds.


A Note about Bitcoin Values
---------------------------

All Bitcoin values returned by the API are in string float format, in order to preserve full value precision. It is recommended that all arithmetic operations performed on Bitcoin values within PHP utilize the `bcmath` functions as follows:

#####`bcadd` Add Two Numbers

 ```php
 $result = bcadd("101.234115", "34.92834753", 8); // "136.16246253"
 ```

#####`bcsub` Subtract Two Numbers

```php
$result = bcsub("101.234115", "34.92834753", 8); // "66.30576747"
```

#####`bcmul` Multiply Two Numbers

```php
$result = bcmul("101.234115", "34.92834753", 8); // "3535.940350613"
```

#####`bcdiv` Divide Two Numbers

```php
$result = bcdiv("101.234115", "34.92834753", 8); // "2.89833679"
```

The `8` in the final parameter of each `bcmath` function call represents the numerical precision to keep in the result.

More help on the `bcmath` functions can be found in the [PHP BC Math documentation](http://php.net/manual/en/ref.bc.php).


Documentation
-------------

[Block explorer](docs/blockexplorer.md) - Access details of the Bitcoin blockchain

[Create Wallets](docs/create.md) - Create new Blockchain wallets

[Exchange Rates](docs/rates.md) - See the value of Bitcoin relative to world currencies

[Push Transaction](docs/pushtx.md) - Push raw transactions to the Bitcoin network

[Receive](docs/receive.md) - The easiest way to accept Bitcoin payments

[Statistics](docs/stats.md) - Bitcoin network statistics

[Wallet](docs/wallet.md) - Send and receive Bitcoin programmatically



Dependencies
------------

The library depends on having the `curl` and `bcmath` modules enabled in your PHP installation.
