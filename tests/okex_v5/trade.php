<?php


/**
 * @author lin <465382251@qq.com>
 *
 * Fill in your key and secret and pass can be directly run
 *
 * Most of them are unfinished and need your help
 * https://github.com/zhouaini528/okex-php.git
 * */
use Lin\Okex\OkexV5;

require __DIR__ .'../../../vendor/autoload.php';

include 'key_secret.php';

$okex=new OkexV5($key,$secret,$passphrase);

//You can set special needs
$okex->setOptions([
    //Set the request timeout to 60 seconds by default
    'timeout'=>10,

    //If you are developing locally and need an agent, you can set this
    //'proxy'=>true,
    //More flexible Settings
    /* 'proxy'=>[
     'http'  => 'http://127.0.0.1:12333',
     'https' => 'http://127.0.0.1:12333',
     'no'    =>  ['.cn']
     ], */
    //Close the certificate
    //'verify'=>false,

    //Set Demo Trading
    'headers'=>['x-simulated-trading'=>1]
]);

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


