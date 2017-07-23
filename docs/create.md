Create Wallet Documetation
==========================
Create a new Blockchain wallet from this API endpoint. Offical documentation [here](https://blockchain.info/api/create_wallet).

Basic Usage
-----------
Make calls on the `Create` member object within the `Blockchain` object. Please note than an `api_code` is required with Create Wallet permissions. You may request an API code [here](https://blockchain.info/api/api_create_code).
In order to use Wallet and CreateWallet functionality, you must provide an URL to an instance of [service-my-wallet-v3](https://github.com/blockchain/service-my-wallet-v3).

```php
$Blockchain = new \Blockchain\Blockchain($api_code);
$Blockchain->setServiceUrl("http://localhost:3000");
$Blockchain->Create->function(...)
```

Create Wallets
--------------
There are two ways to create wallets: provide an existing private key or let Blockchain generate a private key for you. Both methods allow you to specify an `email` address to be associated with the wallet and a `label` for the first address in the wallet. You must provide a `password` for the new wallet.

Please read the [offical documentation](https://blockchain.info/api/create_wallet) for important details.

### Create with Key
Create a new wallet with a known private key. Returns a `WalletResponse` object.

```php
$wallet = $Blockchain->Create->createWithKey($password, $privKey, $email=null, $label=null);
```

### Create HD with Key
Create a new HD wallet with a known private key. Returns a `WalletResponse` object.

```php
$wallet = $Blockchain->Create->createWithKey($password, $privKey, $email=null, $label=null, $hd='true');
```


### Create without Key
Create a new wallet, letting Blockchain generate a new private key. Returns a `WalletResponse` object.

```php
$wallet = $Blockchain->Create->create($password, $email=null, $label=null);
```

### Create HD
Create a new HD wallet, letting Blockchain generate a new private key. Returns a `WalletResponse` object.

```php
$wallet = $Blockchain->Create->create($password, $email=null, $label=null, $hd='true');
```



Response Object Properties
--------------------------

### WalletResponse
The `WalletResponse` object contains fields for the wallet identifier (`guid`), the `address` for receiving Bitcoin, and a `label` for the first account of the wallet.

```php
class WalletResponse {
    public $guid;                       // string
    public $address;                    // string
    public $label;                      // string
}
```