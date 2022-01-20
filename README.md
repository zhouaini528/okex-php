### It is recommended that you read the official document first

Okex docs [https://www.okex.com/docs/en](https://www.okex.com/docs/en/#README)

Okex Simulation Test API [https://www.okex.com/docs/en/#change-20200630](https://www.okex.com/docs/en/#change-20200630),Click to view [Demo](https://github.com/zhouaini528/okex-php#simulation-test-api)

All interface methods are initialized the same as those provided by okex. See details [src/api](https://github.com/zhouaini528/okex-php/tree/master/src/Api)

Support [Websocket v3 v5](https://github.com/zhouaini528/okex-php/blob/master/README.md#Websocket)

Support V3 V5 API

[中文文档](https://github.com/zhouaini528/okex-php/blob/master/README_CN.md)

### Other exchanges API

[Exchanges](https://github.com/zhouaini528/exchanges-php) It includes all of the following exchanges and is highly recommended.

[Bitmex](https://github.com/zhouaini528/bitmex-php) Support [Websocket](https://github.com/zhouaini528/bitmex-php/blob/master/README.md#Websocket)

[Okex](https://github.com/zhouaini528/okex-php) Support [Websocket](https://github.com/zhouaini528/okex-php/blob/master/README.md#Websocket)

[Huobi](https://github.com/zhouaini528/huobi-php) Support [Websocket](https://github.com/zhouaini528/huobi-php/blob/master/README.md#Websocket)

[Binance](https://github.com/zhouaini528/binance-php) Support [Websocket](https://github.com/zhouaini528/binance-php/blob/master/README.md#Websocket)

[Kucoin](https://github.com/zhouaini528/kucoin-php)

[Mxc](https://github.com/zhouaini528/Mxc-php)

[Coinbase](https://github.com/zhouaini528/coinbase-php)

[ZB](https://github.com/zhouaini528/zb-php)

[Bitfinex](https://github.com/zhouaini528/bitfinex-php)

[Bittrex](https://github.com/zhouaini528/bittrex-php)

[Kraken](https://github.com/zhouaini528/kraken-php)

[Gate](https://github.com/zhouaini528/gate-php)   

[Bigone](https://github.com/zhouaini528/bigone-php)   

[Crex24](https://github.com/zhouaini528/crex24-php)   

[Bybit](https://github.com/zhouaini528/bybit-php)  

[Coinbene](https://github.com/zhouaini528/coinbene-php)   

[Bitget](https://github.com/zhouaini528/bitget-php)   

[Poloniex](https://github.com/zhouaini528/poloniex-php)

#### Installation
```
composer require linwj/okex
```

Support for more request Settings [More](https://github.com/zhouaini528/okex-php/blob/master/tests/spot/proxy.php#L21)
```php
$okex=new OkexSpot();
//or
$okex=new OkexSpot($key,$secret,$passphrase);

//You can set special needs
$okex->setOptions([
    //Set the request timeout to 60 seconds by default
    'timeout'=>10,
    //https://github.com/guzzle/guzzle
    'proxy'=>[],
    //https://www.php.net/manual/en/book.curl.php
    'curl'=>[],
    
    //Set Demo Trading
    'headers'=>['x-simulated-trading'=>1]
]);
```

### Okex V5 API

[Click to view](https://github.com/zhouaini528/okex-php/blob/master/tests/okex_v5)


Market API [More](https://github.com/zhouaini528/okex-php/blob/master/tests/okex_v5/market.php)
```php
use Lin\Okex\OkexV5;
$okex=new OkexV5();

try {
    $result=$okex->market()->getTickers([
        'instType'=>'SPOT',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->market()->getTicker([
        'instId'=>'BTC-USD-SWAP',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->market()->getIndexTickers([
        'instId'=>'BTC-USD',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->market()->getCandles([
        'instId'=>'BTC-USD',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->market()->getIndexCandles([
        'instId'=>'BTC-USD',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}
```

Order related API [More](https://github.com/zhouaini528/okex-php/blob/master/tests/okex_v5/trade.php)
```php
use Lin\Okex\OkexV5;

$okex=new OkexV5($key,$secret,$passphrase);

try {
    $result=$okex->trade()->postOrder([
        'instId'=>'BTC-USDT',
        'tdMode'=>'cross',
        'clOrdId'=>'xxxxxxxxxxx',
        'side'=>'buy',
        'ordType'=>'limit',
        'sz'=>'0.01',
        'px'=>'10000',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->trade()->postCancelOrder([
        'instId'=>'BTC-USDT',
        'ordId'=>'xxxxxxxxx',
        //'clOrdId'=>'xxxxxxxxxxx',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}


try {
    $result=$okex->trade()->postAmendOrder([
        'instId'=>'BTC-USDT',
        'ordId'=>'xxxxxxxxx',
        //'clOrdId'=>'xxxxxxxxxxx',
        'newSz'=>'0.012',
        'newPx'=>'11000',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->trade()->getOrder([
        'instId'=>'BTC-USDT',
        'ordId'=>'xxxxxxxxx',
        //'clOrdId'=>'xxxxxxxxxxx',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}


try {
    $result=$okex->trade()->postOrderAlgo([
        'instId'=>'BTC-USDT',
        'tdMode'=>'cross',
        'clOrdId'=>'xxxxxxxxxxx',
        'side'=>'buy',
        'ordType'=>'trigger',
        'sz'=>'0.01',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

```

Accounts related API [More](https://github.com/zhouaini528/okex-php/blob/master/tests/okex_v5/account.php)
```php
use Lin\Okex\OkexV5;

$okex=new OkexV5($key,$secret,$passphrase);

try {
    $result=$okex->account()->getBalance();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->account()->getPositions();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->account()->getBills();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->account()->getBillsArchive();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->account()->getConfig();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->account()->postSetPositionMode([
        'posMode'=>'long_short_mode'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->account()->postSetLeverage([
        'instId'=>'BTC-USDT',
        //'ccy'=>'',
        'lever'=>'5',
        'mgnMode'=>'cross',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->account()->getMaxSize([
        'instId'=>'BTC-USDT',
        'tdMode'=>'cross',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}
```

[More Test](https://github.com/zhouaini528/okex-php/tree/master/tests/okex_v5)

[More API](https://github.com/zhouaini528/okex-php/tree/master/src/Api/OkexV5)

### Websocket

[Websocket_v5 Click to view](https://github.com/zhouaini528/okex-php/blob/master/tests/websocket_v5)

Websocket has two services, server and client. The server is responsible for dealing with the new connection of the exchange, data receiving, authentication and login. Client is responsible for obtaining and processing data.

Server initialization must be started in Linux CLI mode.
```php
use Lin\Okex\OkexWebSocketV5;
require __DIR__ .'./vendor/autoload.php';

$okex=new OkexWebSocketV5();

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

    //Number of messages WS queue shuold hold, default 100
    //'queue_count'=>100,
]);

$okex->start();
```

If you want to test, you can "php server.php start" immediately outputs the log at the terminal.

If you want to deploy, you can "php server.php start -d" enables resident process mode, and enables "log=>true" to view logs.

[More Test](https://github.com/zhouaini528/okex-php/tree/master/tests/websocket/server.php)

Client side initialization.
```php
$okex=new OkexWebSocketV5();

$okex->config([
    //Do you want to enable local logging,default false
    'log'=>true,
    //Or set the log name
    //'log'=>['filename'=>'okex'],

    //Daemons address and port,default 0.0.0.0:2207
    //'global'=>'127.0.0.1:2208',

    //Heartbeat time,default 20 seconds
    //'ping_time'=>20,

    //Channel subscription monitoring time,2 seconds
    //'listen_time'=>2,

    //Channel data update time,0.1 seconds
    //'data_time'=>0.1,

    //Number of messages WS queue shuold hold, default 100
    //'queue_count'=>100,
]);
```

Subscribe
```php
//You can only subscribe to public channels
$okex->subscribe([
    ["channel"=>"instruments","instType"=>"SPOT"],
    ["channel"=>"instruments","instType"=>"SWAP"],
    ["channel"=>"instruments","instType"=>"FUTURES"],
    ["channel"=>"instruments","instType"=>"OPTION"],
]);

//You can also subscribe to both private and public channels
$okex->keysecret([
    'key'=>'xxxxxxxxx',
    'secret'=>'xxxxxxxxx',
    'passphrase'=>'xxxxxxxxx',
]);
$okex->subscribe([
    //public
    ["channel"=>"tickers","instId"=>"BTC-USDT"],
    ["channel"=>"tickers","instId"=>"BTC-USD-SWAP"],
    ["channel"=>"tickers","instId"=>"BTC-USD-210924"],

    ["channel"=>"books","instId"=>"BTC-USDT"],
    ["channel"=>"books","instId"=>"BTC-USD-SWAP"],
    ["channel"=>"books","instId"=>"BTC-USD-210924"],

    ["channel"=>"candle5m","instId"=>"BTC-USDT"],
    ["channel"=>"candle15m","instId"=>"BTC-USD-SWAP"],
    ["channel"=>"candle30m","instId"=>"BTC-USD-210924"],

    //private
    ["channel"=>"account","ccy"=>"BTC"],
    ["channel"=>"positions","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
    ["channel"=>"balance_and_position"],
    ["channel"=>"orders","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
    ["channel"=>"orders-algo","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
]);
```

unSubscribe
```php
//Unsubscribe from public channels
$okex->unsubscribe([
    ["channel"=>"instruments","instType"=>"SPOT"],
    ["channel"=>"instruments","instType"=>"SWAP"],
    ["channel"=>"instruments","instType"=>"FUTURES"],
    ["channel"=>"instruments","instType"=>"OPTION"],
]);

//Unsubscribe from public and private channels
$okex->keysecret([
    'key'=>'xxxxxxxxx',
    'secret'=>'xxxxxxxxx',
    'passphrase'=>'xxxxxxxxx',
]);
$okex->unsubscribe([
    //public
    ["channel"=>"tickers","instId"=>"BTC-USDT"],
    ["channel"=>"tickers","instId"=>"BTC-USD-SWAP"],
    ["channel"=>"tickers","instId"=>"BTC-USD-210924"],

    ["channel"=>"books","instId"=>"BTC-USDT"],
    ["channel"=>"books","instId"=>"BTC-USD-SWAP"],
    ["channel"=>"books","instId"=>"BTC-USD-210924"],

    ["channel"=>"candle5m","instId"=>"BTC-USDT"],
    ["channel"=>"candle15m","instId"=>"BTC-USD-SWAP"],
    ["channel"=>"candle30m","instId"=>"BTC-USD-210924"],

    //private
    ["channel"=>"account","ccy"=>"BTC"],
    ["channel"=>"positions","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
    ["channel"=>"balance_and_position"],
    ["channel"=>"orders","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
    ["channel"=>"orders-algo","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
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
    ["channel"=>"tickers","instId"=>"BTC-USDT"],
    ["channel"=>"tickers","instId"=>"BTC-USD-SWAP"],
    ["channel"=>"tickers","instId"=>"BTC-USD-210924"],
]);
print_r(json_encode($data));

//The second way callback
$okex->getSubscribe([
    ["channel"=>"tickers","instId"=>"BTC-USDT"],
    ["channel"=>"tickers","instId"=>"BTC-USD-SWAP"],
    ["channel"=>"tickers","instId"=>"BTC-USD-210924"],
],function($data){
    print_r(json_encode($data));
});

//The third way is to guard the process
$okex->getSubscribe([
    ["channel"=>"tickers","instId"=>"BTC-USDT"],
    ["channel"=>"tickers","instId"=>"BTC-USD-SWAP"],
    ["channel"=>"tickers","instId"=>"BTC-USD-210924"],
],function($data){
    print_r(json_encode($data));
},true);
```

Get partial private channel subscription data
```php
//The first way
$okex->keysecret($key_secret);
$data=$okex->getSubscribe([
    ["channel"=>"books","instId"=>"BTC-USDT"],
    ["channel"=>"books","instId"=>"BTC-USD-SWAP"],

    ["channel"=>"account","ccy"=>"BTC"],
    ["channel"=>"positions","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
]);
print_r(json_encode($data));

//The second way callback
$okex->keysecret($key_secret);
$okex->getSubscribe([
    ["channel"=>"books","instId"=>"BTC-USDT"],
    ["channel"=>"books","instId"=>"BTC-USD-SWAP"],

    ["channel"=>"account","ccy"=>"BTC"],
    ["channel"=>"positions","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
],function($data){
    print_r(json_encode($data));
});

//The third way is to guard the process
$okex->keysecret($key_secret);
$okex->getSubscribe([
    ["channel"=>"books","instId"=>"BTC-USDT"],
    ["channel"=>"books","instId"=>"BTC-USD-SWAP"],

    ["channel"=>"account","ccy"=>"BTC"],
    ["channel"=>"positions","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
],function($data){
    print_r(json_encode($data));
},true);
```

Re link websocket public quotation data and private data
```php
$okex->reconPublic();

$okex->reconPrivate($key);
```


[More Test](https://github.com/zhouaini528/okex-php/tree/master/tests/websocket_v5/client.php)
