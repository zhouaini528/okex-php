<?php


/**
 * @author lin <465382251@qq.com>
 *
 * Fill in your key and secret and pass can be directly run
 *
 * Most of them are unfinished and need your help
 * https://github.com/zhouaini528/okex-php.git
 * */
use Lin\Okex\OkexFuture;

require __DIR__ .'../../../vendor/autoload.php';

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