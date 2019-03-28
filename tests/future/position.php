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

include 'key_secret.php';

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

//Get the information of all holding positions in futures trading.Due to high energy consumption, you are advised to capture data with the "Futures Account of a Currency" API instead.
try {
    $result=$okex->position()->getAll();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}