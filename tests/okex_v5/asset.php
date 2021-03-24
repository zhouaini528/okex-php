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

    //set Demo Trading
    'headers'=>['x-simulated-trading'=>1]
]);


try {
    $result=$okex->asset()->getDepositAddress([
        'ccy'=>'btc',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->asset()->getBalances([
        'ccy'=>'btc',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->asset()->getDepositHistory();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->asset()->getWithdrawalHistory();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->asset()->postTransfer([
        'ccy'=>'btc',
        'amt'=>'0.01',
        'from'=>'1',
        'to'=>'3',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}







