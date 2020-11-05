### It is recommended that you read the official document first

Okex docs [https://www.okex.com/docs/en](https://www.okex.com/docs/en/#README)

Okex Simulation Test API [https://www.okex.com/docs/en/#change-20200630](https://www.okex.com/docs/en/#change-20200630),Click to view [Demo](https://github.com/zhouaini528/okex-php#simulation-test-api)

All interface methods are initialized the same as those provided by okex. See details [src/api](https://github.com/zhouaini528/okex-php/tree/master/src/Api)

Support [Websocket](https://github.com/zhouaini528/okex-php/blob/master/README.md#Websocket)

[中文文档](https://github.com/zhouaini528/okex-php/blob/master/README_CN.md)

### Other exchanges API

[Exchanges](https://github.com/zhouaini528/exchanges-php) It includes all of the following exchanges and is highly recommended.

[Bitmex](https://github.com/zhouaini528/bitmex-php)

[Okex](https://github.com/zhouaini528/okex-php) Support [Websocket](https://github.com/zhouaini528/okex-php/blob/master/README.md#Websocket)

[Huobi](https://github.com/zhouaini528/huobi-php)

[Binance](https://github.com/zhouaini528/binance-php) Support [Websocket](https://github.com/zhouaini528/binance-php/blob/master/README.md#Websocket)

[Kucoin](https://github.com/zhouaini528/kucoin-php)

[Mxc](https://github.com/zhouaini528/Mxc-php)

[Coinbase](https://github.com/zhouaini528/coinbase-php)

[ZB](https://github.com/zhouaini528/zb-php)

[Bitfinex](https://github.com/zhouaini528/bitfinex-php)

[Bittrex](https://github.com/zhouaini528/bittrex-php)

[Gate](https://github.com/zhouaini528/gate-php)

[Bigone](https://github.com/zhouaini528/bigone-php)   

[Crex24](https://github.com/zhouaini528/crex24-php)   

#### Installation
```
composer require linwj/okex
```

Support for more request Settings [More](https://github.com/zhouaini528/okex-php/blob/master/tests/spot/proxy.php#L21)
```php
$okex=new OkexSpot();
//You can set special needs
$okex->setOptions([
    //Set the request timeout to 60 seconds by default
    'timeout'=>10,
    
    //If you are developing locally and need an agent, you can set this
    'proxy'=>true,
    //More flexible Settings
    /* 'proxy'=>[
     'http'  => 'http://127.0.0.1:12333',
     'https' => 'http://127.0.0.1:12333',
     'no'    =>  ['.cn']
     ], */
    //Close the certificate
    //'verify'=>false,
]);
```

### Spot Trading API

Instrument related API [More](https://github.com/zhouaini528/okex-php/blob/master/tests/spot/instrument.php)

```php
use Lin\Okex\OkexSpot;
$okex=new OkexSpot();

//Getting the order book of a trading pair. Pagination is not supported here. 
//The whole book will be returned for one request. WebSocket is recommended here.
try {
    $result=$okex->instrument()->getBook([
        'instrument_id'=>'BTC-USDT',
        'size'=>20
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}

//Get market data. This endpoint provides the snapshots of market data and can be used without verifications.
//List trading pairs and get the trading limit, price, and more information of different trading pairs.
try {
    $result=$okex->instrument()->get();
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
```

Order related API [More](https://github.com/zhouaini528/okex-php/blob/master/tests/spot/order.php)

```php
$okex=new OkexSpot($key,$secret,$passphrase);
//Place an Order
try {
    $result=$okex->order()->post([
        'instrument_id'=>'btc-usdt',
        'side'=>'buy',
        'price'=>'100',
        'size'=>'0.001',
        
        //'type'=>'market',
        //'notional'=>'100'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
sleep(1);

//Get order details by order ID.
try {
    $result=$okex->order()->get([
        'instrument_id'=>'btc-usdt',
        'order_id'=>$result['order_id'],
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
sleep(1);

//Cancelling an unfilled order.
try {
    $result=$okex->order()->postCancel([
        'instrument_id'=>'btc-usdt',
        'order_id'=>$result['order_id'],
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
```

Accounts related API [More](https://github.com/zhouaini528/okex-php/blob/master/tests/spot/accounts.php)

```php
$okex=new OkexSpot($key,$secret,$passphrase);

//This endpoint supports getting the list of assets(only show pairs with balance larger than 0), 
//The balances, amount available/on hold in spot accounts.
try {
    $result=$okex->account()->getAll();
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}

//This endpoint supports getting the balance, amount available/on hold of a token in spot account.
try {
    $result=$okex->account()->get([
        'currency'=>'BTC'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}

//All paginated requests return the latest information (newest) as the first page sorted by newest (in chronological time) first.
try {
    $result=$okex->account()->getLedger([
        'currency'=>'btc',
        'limit'=>2,
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}

```

### Simulation Test API
```php
$key = "09d4ed9e-6c2b-4652-9119-5c8eea078904";
$secret = "AE06CAA53CAB76CACDEE6001ACDABB11";
$passphrase = "test123";

$okex=new OkexSpot($key,$secret,$passphrase);

//You can set special needs
$okex->setOptions([
    'timeout'=>10,
    'headers'=>['x-simulated-trading'=>1],
]);

try {
    $result=$okex->instrument()->get();
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

//Place an Order
try {
    $result=$okex->order()->post([
        'instrument_id'=>'MNBTC-MNUSDT',
        'side'=>'buy',
        'price'=>'100',
        'size'=>'0.001',

        //'type'=>'market',
        //'notional'=>'100'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}
sleep(1);

//Get order details by order ID.
try {
    $result=$okex->order()->get([
        'instrument_id'=>'MNBTC-MNUSDT',
        'order_id'=>$result['order_id'],
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}
sleep(1);

//Cancelling an unfilled order.
try {
    $result=$okex->order()->postCancel([
        'instrument_id'=>'MNBTC-MNUSDT',
        'order_id'=>$result['order_id'],
    ]);
    print_r($result);
}catch (\Exception $e) {
    print_r(json_decode($e->getMessage(), true));
}
```

[More use cases](https://github.com/zhouaini528/okex-php/tree/master/tests/spot)

[More API](https://github.com/zhouaini528/okex-php/tree/master/src/Api/Spot)

### Futures Trading API

Instrument related API [More](https://github.com/zhouaini528/okex-php/blob/master/tests/future/instrument.php)

```php
$okex=new OkexFuture();

//List all contracts. This request does not support pagination. The full list will be returned for a request.
try {
    $result=$okex->instrument()->getBook([
        'instrument_id'=>'BTC-USD-190628',
        'size'=>20,
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}

//Get market data. This endpoint provides the snapshots of market data and can be used without verifications.
try {
    $result=$okex->instrument()->get();
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
```

Order related API [More](https://github.com/zhouaini528/okex-php/blob/master/tests/future/order.php)

```php
$okex=new OkexFuture($key,$secret,$passphrase);

//Place an Order
try {
    $result=$okex->order()->post([
        'instrument_id'=>'btc-usd-190628',
        'type'=>'1',
        'price'=>'100',
        'size'=>'1',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
sleep(1);

//Get order details by order ID.
try {
    $result=$okex->order()->get([
        'instrument_id'=>'btc-usd-190628',
        'order_id'=>$result['order_id'],
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
sleep(1);

//Cancelling an unfilled order.
try {
    $result=$okex->order()->postCancel([
        'instrument_id'=>'btc-usd-190628',
        'order_id'=>$result['order_id'],
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
```

Accounts related API [More](https://github.com/zhouaini528/okex-php/blob/master/tests/future/accounts.php)

```php
$okex=new OkexSpot($key,$secret,$passphrase);
//This endpoint supports getting the list of assets(only show pairs with balance larger than 0), the balances, amount available/on hold in spot accounts.
try {
    $result=$okex->account()->getAll();
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}

//This endpoint supports getting the balance, amount available/on hold of a token in spot account.
try {
    $result=$okex->account()->get([
        'currency'=>'BTC'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}

//All paginated requests return the latest information (newest) as the first page sorted by newest (in chronological time) first.
try {
    $result=$okex->account()->getLedger([
        'currency'=>'btc',
        'limit'=>2,
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
```

Position related API [More](https://github.com/zhouaini528/okex-php/blob/master/tests/future/position.php)
```php
$okex=new OkexFuture($key,$secret,$passphrase);

//Get the information of holding positions of a contract.
try {
    $result=$okex->position()->get([
        'instrument_id'=>'BTC-USD-190628',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}

//Get the information of all holding positions in futures trading.Due to high energy consumption,
//You are advised to capture data with the "Futures Account of a Currency" API instead.
try {
    $result=$okex->position()->getAll();
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
```

### Swap Trading API

Instrument related API [More](https://github.com/zhouaini528/okex-php/blob/master/tests/swap/instrument.php)
```php
$okex=new OkexFuture();

//List all contracts. This request does not support pagination. The full list will be returned for a request.
try {
    $result=$okex->instrument()->getDepth([
        'instrument_id'=>'BTC-USD-SWAP',
        'size'=>10,
    ]);
    
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}

//Get market data. This endpoint provides the snapshots of market data and can be used without verifications.
try {
    $result=$okex->instrument()->get();
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
```

Order related API [More](https://github.com/zhouaini528/okex-php/blob/master/tests/swap/order.php)
```php
$okex=new OkexFuture($key,$secret,$passphrase);

//Place an Order
try {
    $result=$okex->order()->post([
        'instrument_id'=>'BTC-USD-SWAP',
        'type'=>'1',
        'price'=>'5000',
        'size'=>'1',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
sleep(1);

//Get order details by order ID.
try {
    $result=$okex->order()->get([
        'instrument_id'=>'BTC-USD-SWAP',
        'order_id'=>$result['order_id'],
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
sleep(1);

//Cancelling an unfilled order.
try {
    $result=$okex->order()->postCancel([
        'instrument_id'=>'BTC-USD-SWAP',
        'order_id'=>$result['order_id'],
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
```

Accounts related API [More](https://github.com/zhouaini528/okex-php/blob/master/tests/swap/accounts.php)
```php
$okex=new OkexSpot($key,$secret,$passphrase);
//This endpoint supports getting the list of assets(only show pairs with balance larger than 0), the balances, amount available/on hold in spot accounts.
try {
    $result=$okex->account()->getAll();
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}

//This endpoint supports getting the balance, amount available/on hold of a token in spot account.
try {
    $result=$okex->account()->get([
        'instrument_id'=>'BTC-USD-SWAP'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}

//All paginated requests return the latest information (newest) as the first page sorted by newest (in chronological time) first.
try {
    $result=$okex->account()->getLedger([
        'instrument_id'=>'BTC-USD-SWAP',
        'limit'=>2,
        //'type'=>'1',
        //'from'=>'',
        //'to'=>'',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
```

Position related API [More](https://github.com/zhouaini528/okex-php/blob/master/tests/swap/position.php)
```php
$okex=new OkexFuture($key,$secret,$passphrase);

//Get the information of holding positions of a contract.
try {
    $result=$okex->position()->get([
        'instrument_id'=>'BTC-USD-SWAP',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}

//Get the information of all holding positions in futures trading.Due to high energy consumption, you are advised to capture data with the "Futures Account of a Currency" API instead.
try {
    $result=$okex->position()->getAll();
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
```

[More Test](https://github.com/zhouaini528/okex-php/tree/master/tests/future)

[More API](https://github.com/zhouaini528/okex-php/tree/master/src/Api/Futures)

### Websocket

Websocket has two services, server and client. The server is responsible for dealing with the new connection of the exchange, data receiving, authentication and login, etc. Client is responsible for obtaining and processing data.

Server initialization must be started in cli mode.
```php
use Lin\Okex\OkexWebSocket;
require __DIR__ .'./vendor/autoload.php';

$okex=new OkexWebSocket();

$okex->config([
    //Do you want to enable local logging,default false
    'log'=>true,

    //Daemons address and port,default 0.0.0.0:2207
    //'global'=>'127.0.0.1:2208',

    //Heartbeat time,default 20 seconds
    //'ping_time'=>20,

    //Channel subscription monitoring time,2 seconds
    //'listen_time'=>2,

    //Channel data update time,0.1 seconds
    //'data_time'=>0.1,
]);

$okex->start();
```

If you want to test, you can "php server.php start" immediately outputs the log at the terminal.

If you want to deploy, you can "php server.php start -d" enables resident process mode, and enables "log=>true" to view logs.

[More Test](https://github.com/zhouaini528/okex-php/tree/master/tests/websocket/server.php)

Client side initialization.
```php
$okex=new OkexWebSocket();

$okex->config([
    //Do you want to enable local logging,default false
    'log'=>true,

    //Daemons address and port,default 0.0.0.0:2207
    //'global'=>'127.0.0.1:2208',

    //Heartbeat time,default 20 seconds
    //'ping_time'=>20,

    //Channel subscription monitoring time,2 seconds
    //'listen_time'=>2,

    //Channel data update time,0.1 seconds
    //'data_time'=>0.1,
]);
```

Subscribe
```php
//You can only subscribe to public channels
$okex->subscribe([
    'spot/depth5:BCH-USDT',
    'futures/depth5:BCH-USD-210326',
    'swap/depth5:BCH-USD-SWAP',
    'option/depth5:BTCUSD-20201021-11750-C',
]);

//You can also subscribe to both private and public channels
$okex->keysecret([
    'key'=>'xxxxxxxxx',
    'secret'=>'xxxxxxxxx',
    'passphrase'=>'xxxxxxxxx',
]);
$okex->subscribe([
    //public
    'spot/depth5:BCH-USDT',
    'futures/depth5:BCH-USD-210326',
    'swap/depth5:BCH-USD-SWAP',
    'option/depth5:BTCUSD-20201021-11750-C',
    
    //private
    'futures/position:BCH-USD-210326',
    'futures/account:BCH-USDT',
    'swap/position:BCH-USD-SWAP',
]);
```

unSubscribe
```php
//Unsubscribe from public channels
$okex->unsubscribe([
    'spot/depth5:BCH-USDT',
    'futures/depth5:BCH-USD-210326',
    'swap/depth5:BCH-USD-SWAP',
    'option/depth5:BTCUSD-20201021-11750-C',
]);

//Unsubscribe from public and private channels
$okex->keysecret([
    'key'=>'xxxxxxxxx',
    'secret'=>'xxxxxxxxx',
    'passphrase'=>'xxxxxxxxx',
]);
$okex->unsubscribe([
    //public
    'spot/depth5:BCH-USDT',
    'futures/depth5:BCH-USD-210326',
    'swap/depth5:BCH-USD-SWAP',
    'option/depth5:BTCUSD-20201021-11750-C',
    
    //private
    'futures/position:BCH-USD-210326',
    'futures/account:BCH-USDT',
    'swap/position:BCH-USD-SWAP',
]);
```

Get all channel subscription data
```php

//The first way
$data=$okex->getSubscribe();
print_r(json_encode($data));

//The second way callback
$okex->getSubscribe(function($data){
    print_r(json_encode($data));
});

//The third way is to guard the process
$okex->getSubscribe(function($data){
    print_r(json_encode($data));
},true);
```

Get partial channel subscription data
```php
//The first way
$data=$okex->getSubscribe([
    'spot/depth5:BCH-USDT',
    'futures/depth5:BCH-USD-210326',
]);
print_r(json_encode($data));

//The second way callback
$okex->getSubscribe([
    'spot/depth5:BCH-USDT',
    'futures/depth5:BCH-USD-210326',
],function($data){
    print_r(json_encode($data));
});

//The third way is to guard the process
$okex->getSubscribe([
    'spot/depth5:BCH-USDT',
    'futures/depth5:BCH-USD-210326',
],function($data){
    print_r(json_encode($data));
},true);
```

Get partial private channel subscription data
```php
//The first way
$okex->keysecret($key_secret);
$data=$okex->getSubscribe([
    'futures/depth5:BCH-USD-210326',
    'futures/position:BCH-USD-210326',//If there are private channels, $okex->keysecret() must be set
]);
print_r(json_encode($data));

//The second way callback
$okex->keysecret($key_secret);
$okex->getSubscribe([
    'futures/depth5:BCH-USD-210326',
    'futures/position:BCH-USD-210326',//If there are private channels, $okex->keysecret() must be set
],function($data){
    print_r(json_encode($data));
});

//The third way is to guard the process
$okex->keysecret($key_secret);
$okex->getSubscribe([
    'futures/depth5:BCH-USD-210326',
    'futures/position:BCH-USD-210326',//If there are private channels, $okex->keysecret() must be set
],function($data){
    print_r(json_encode($data));
},true);
```
[More Test](https://github.com/zhouaini528/okex-php/tree/master/tests/websocket/client.php)
