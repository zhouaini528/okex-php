### 建议您先阅读官方文档

Okex 文档地址 [https://www.okex.com/docs/en](https://www.okex.com/docs/en/#README)

所有接口方法的初始化都与okex提供的方法相同。更多细节 [src/api](https://github.com/zhouaini528/okex-php/tree/master/src/Api)

很多接口还未完善，使用者可以根据我的设计方案继续扩展，欢迎与我一起迭代它。

[中文文档](https://github.com/zhouaini528/okex-php/blob/master/README_CN.md)

### 其他交易所API

[Exchanges](https://github.com/zhouaini528/exchanges-php) 它包含以下所有交易所，强烈推荐使用该SDK。

[Bitmex](https://github.com/zhouaini528/bitmex-php)

[Okex](https://github.com/zhouaini528/okex-php)

[Huobi](https://github.com/zhouaini528/huobi-php)

[Binance](https://github.com/zhouaini528/binance-php)

#### 安装方式
```
composer require "linwj/okex dev-master"
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
    print_r(json_decode($e->getMessage(),true));
}

//Get market data. This endpoint provides the snapshots of market data and can be used without verifications.
//List trading pairs and get the trading limit, price, and more information of different trading pairs.
try {
    $result=$okex->instrument()->get();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
}

//This endpoint supports getting the balance, amount available/on hold of a token in spot account.
try {
    $result=$okex->account()->get([
        'currency'=>'BTC'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

//All paginated requests return the latest information (newest) as the first page sorted by newest (in chronological time) first.
try {
    $result=$okex->account()->getLedger([
        'currency'=>'btc',
        'limit'=>2,
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
}

//Get market data. This endpoint provides the snapshots of market data and can be used without verifications.
try {
    $result=$okex->instrument()->get();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
}

//This endpoint supports getting the balance, amount available/on hold of a token in spot account.
try {
    $result=$okex->account()->get([
        'currency'=>'BTC'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

//All paginated requests return the latest information (newest) as the first page sorted by newest (in chronological time) first.
try {
    $result=$okex->account()->getLedger([
        'currency'=>'btc',
        'limit'=>2,
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
}

//Get the information of all holding positions in futures trading.Due to high energy consumption,
//You are advised to capture data with the "Futures Account of a Currency" API instead.
try {
    $result=$okex->position()->getAll();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
}

//Get market data. This endpoint provides the snapshots of market data and can be used without verifications.
try {
    $result=$okex->instrument()->get();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
}

//This endpoint supports getting the balance, amount available/on hold of a token in spot account.
try {
    $result=$okex->account()->get([
        'instrument_id'=>'BTC-USD-SWAP'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
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
    print_r(json_decode($e->getMessage(),true));
}

//Get the information of all holding positions in futures trading.Due to high energy consumption, you are advised to capture data with the "Futures Account of a Currency" API instead.
try {
    $result=$okex->position()->getAll();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}
```




[更多用例请查看](https://github.com/zhouaini528/okex-php/tree/master/tests/future)

[更多API请查看](https://github.com/zhouaini528/okex-php/tree/master/src/Api/Futures)
