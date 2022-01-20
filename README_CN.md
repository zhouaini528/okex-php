### 建议您先阅读官方文档

Okex 文档地址 [https://www.okex.com/docs/en](https://www.okex.com/docs/en/#README)

Okex 模拟交易API [https://www.okex.com/docs/zh/#change-20200630](https://www.okex.com/docs/zh/#change-20200630)，点击查看[演示用例](https://github.com/zhouaini528/okex-php/blob/master/README_CN.md#%E6%A8%A1%E6%8B%9F%E4%BA%A4%E6%98%93api)

所有接口方法的初始化都与okex提供的方法相同。更多细节 [src/api](https://github.com/zhouaini528/okex-php/tree/master/src/Api)

支持[Websocket v3 v5](https://github.com/zhouaini528/okex-php/blob/master/README_CN.md#Websocket)

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

[点击查看](https://github.com/zhouaini528/okex-php/blob/master/tests/okex_v5)

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

[websocket_v5 用例查看](https://github.com/zhouaini528/okex-php/blob/master/tests/websocket_v5)

Websocket有两个服务server和client，server负责处理交易所新连接、数据接收、认证登陆等等。client负责获取数据、处理数据。

Server端初始化，必须在Linux CLI模式下开启。[Websocket行情应用举例](https://github.com/zhouaini528/websocket-market)
```php
use Lin\Okex\OkexWebSocketV5;
require __DIR__ .'./vendor/autoload.php';

$okex=new OkexWebSocketV5();

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
$okex=new OkexWebSocketV5();

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
    ["channel"=>"instruments","instType"=>"SPOT"],
    ["channel"=>"instruments","instType"=>"SWAP"],
    ["channel"=>"instruments","instType"=>"FUTURES"],
    ["channel"=>"instruments","instType"=>"OPTION"],
]);

//你也可以私人频道与公共频道混合订阅
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

频道订阅取消
```php
//取消订阅公共频道
$okex->unsubscribe([
    ["channel"=>"instruments","instType"=>"SPOT"],
    ["channel"=>"instruments","instType"=>"SWAP"],
    ["channel"=>"instruments","instType"=>"FUTURES"],
    ["channel"=>"instruments","instType"=>"OPTION"],
]);

//取消私人频道与公共频道混合订阅
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

获取部分私有频道订阅数据
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

重新链接websocket公共行情数据、私有数据
```php
$okex->reconPublic();//重新链接全部共行情

$okex->reconPrivate($key);//重新订阅私有数据
```

[更多用例请查看](https://github.com/zhouaini528/okex-php/tree/master/tests/websocket_v5/client.php)

**如果你觉得对你有帮助，谢谢你的打赏**

![zhifubao](https://user-images.githubusercontent.com/5442664/122150914-303fcf00-ce91-11eb-91bd-7f7a24c9ab03.jpg)

![weixin](https://user-images.githubusercontent.com/5442664/122150967-4a79ad00-ce91-11eb-866f-4e5f6c859269.jpg)


