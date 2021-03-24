### 建议您先阅读官方文档

Okex 文档地址 [https://www.okex.com/docs/en](https://www.okex.com/docs/en/#README)

Okex 模拟交易API [https://www.okex.com/docs/zh/#change-20200630](https://www.okex.com/docs/zh/#change-20200630)，点击查看[演示用例](https://github.com/zhouaini528/okex-php/blob/master/README_CN.md#%E6%A8%A1%E6%8B%9F%E4%BA%A4%E6%98%93api)

所有接口方法的初始化都与okex提供的方法相同。更多细节 [src/api](https://github.com/zhouaini528/okex-php/tree/master/src/Api)

支持[Websocket](https://github.com/zhouaini528/okex-php/blob/master/README_CN.md#Websocket)

支持V3 V5 API

[English Document](https://github.com/zhouaini528/okex-php/blob/master/README.md)

QQ交流群：668421169

### 其他交易所API

[Exchanges](https://github.com/zhouaini528/exchanges-php) 它包含以下所有交易所，强烈推荐使用该SDK。

[Bitmex](https://github.com/zhouaini528/bitmex-php) 支持[Websocket](https://github.com/zhouaini528/bitmex-php/blob/master/README_CN.md#Websocket)

[Okex](https://github.com/zhouaini528/okex-php) 支持[Websocket](https://github.com/zhouaini528/okex-php/blob/master/README_CN.md#Websocket)

[Huobi](https://github.com/zhouaini528/huobi-php) 支持[Websocket](https://github.com/zhouaini528/huobi-php/blob/master/README_CN.md#Websocket)

[Binance](https://github.com/zhouaini528/binance-php) 支持[Websocket](https://github.com/zhouaini528/binance-php/blob/master/README_CN.md#Websocket)

[Kucoin](https://github.com/zhouaini528/kucoin-php)

[Mxc](https://github.com/zhouaini528/mxc-php)

[Coinbase](https://github.com/zhouaini528/coinbase-php)

[ZB](https://github.com/zhouaini528/zb-php)

[Bitfinex](https://github.com/zhouaini528/zb-php)

[Bittrex](https://github.com/zhouaini528/bittrex-php)

[Kraken](https://github.com/zhouaini528/kraken-php)

[Gate](https://github.com/zhouaini528/gate-php)   

[Bigone](https://github.com/zhouaini528/bigone-php)   

[Crex24](https://github.com/zhouaini528/crex24-php)   

[Bybit](https://github.com/zhouaini528/bybit-php)  

[Coinbene](https://github.com/zhouaini528/coinbene-php)   

[Bitget](https://github.com/zhouaini528/bitget-php)   

[Poloniex](https://github.com/zhouaini528/poloniex-php)

#### 安装方式
```
composer require linwj/okex
```

支持本地开发代理设置 [More](https://github.com/zhouaini528/okex-php/blob/master/tests/spot/proxy.php#L21)
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

### 现货交易 API

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

### 模拟交易API
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

[更多用例请查看](https://github.com/zhouaini528/okex-php/tree/master/tests/spot)

[更多API请查看](https://github.com/zhouaini528/okex-php/tree/master/src/Api/Spot)

### 期货交割 API

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

### 期货永续 API

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


[更多用例请查看](https://github.com/zhouaini528/okex-php/tree/master/tests/future)

[更多API请查看](https://github.com/zhouaini528/okex-php/tree/master/src/Api/Futures)


### Websocket

Websocket有两个服务server和client，server负责处理交易所新连接、数据接收、认证登陆等等。client负责获取数据、处理数据。

Server端初始化，必须在Linux CLI模式下开启。[Websocket行情应用举例](https://github.com/zhouaini528/websocket-market)
```php
use Lin\Okex\OkexWebSocket;
require __DIR__ .'./vendor/autoload.php';

$okex=new OkexWebSocket();

$okex->config([
    //是否开启日志,默认未开启 false
    'log'=>true,
    //或者设置日志名称，默认按照日期保存
    //'log'=>['filename'=>'okex'],

    //进程服务端口地址,默认 0.0.0.0:2207
    //'global'=>'127.0.0.1:2208',

    //心跳时间,默认 20 秒
    //'ping_time'=>20,

    //订阅新的频道监控时间, 默认 2 秒
    //'listen_time'=>2,

    //频道数据更新时间,默认 0.1 秒
    //'data_time'=>0.1,

    //私有数据队列默认保存100条
    //'queue_count'=>100,
]);

$okex->start();
```

如果你要测试，你可以 php server.php start 可以在终端即时输出日志。

如果你要部署，你可以 php server.php start -d  开启常驻进程模式，并开启'log'=>true 查看日志。

[更多用例请查看](https://github.com/zhouaini528/okex-php/tree/master/tests/websocket/server.php)


Client端初始化。
```php
$okex=new OkexWebSocket();

$okex->config([
    //是否开启日志,默认未开启 false
    'log'=>true,
    //或者设置日志名称，默认按照日期保存
    //'log'=>['filename'=>'okex'],

    //进程服务端口地址,默认 0.0.0.0:2207
    //'global'=>'127.0.0.1:2208',

    //心跳时间,默认 20 秒
    //'ping_time'=>20,

    //订阅新的频道监控时间, 默认 2 秒
    //'listen_time'=>2,

    //频道数据更新时间,默认 0.1 秒
    //'data_time'=>0.1,

    //私有数据队列默认保存100条
    //'queue_count'=>100,
]);
```

频道订阅
```php
//你可以只订阅公共频道
$okex->subscribe([
    'spot/depth5:BCH-USDT',
    'futures/depth5:BCH-USD-210326',
    'swap/depth5:BCH-USD-SWAP',
    'option/depth5:BTCUSD-20201021-11750-C',
]);

//你也可以私人频道与公共频道混合订阅
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

频道订阅取消
```php
//取消订阅公共频道
$okex->unsubscribe([
    'spot/depth5:BCH-USDT',
    'futures/depth5:BCH-USD-210326',
    'swap/depth5:BCH-USD-SWAP',
    'option/depth5:BTCUSD-20201021-11750-C',
]);

//取消私人频道与公共频道混合订阅
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

获取全部频道订阅数据
```php
//第一种方式，直接获取当前最新数据
$data=$okex->getSubscribes();
print_r(json_encode($data));


//第二种方式，通过回调函数，获取当前最新数据
$okex->getSubscribes(function($data){
    print_r(json_encode($data));
});

//第二种方式，通过回调函数并开启常驻进程，获取当前最新数据
$okex->getSubscribes(function($data){
    print_r(json_encode($data));
},true);
```

获取部分频道订阅数据
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

获取部分私有频道订阅数据
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

[更多用例请查看](https://github.com/zhouaini528/okex-php/tree/master/tests/websocket/client.php)


