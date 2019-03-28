<?php


/**
 * @author lin <465382251@qq.com>
 * 
 * Your can be directly run
 * 
 * Most of them are unfinished and need your help
 * https://github.com/zhouaini528/okex-php.git
 * */
use Lin\Okex\OkexSpot;

require __DIR__ .'../../../vendor/autoload.php';

$okex=new OkexSpot();

//Getting the order book of a trading pair. Pagination is not supported here. The whole book will be returned for one request. WebSocket is recommended here.
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

