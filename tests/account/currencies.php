<?php


/**
 * @author lin <465382251@qq.com>
 * 
 * Fill in your key and secret and pass can be directly run
 * 
 * Most of them are unfinished and need your help
 * https://github.com/zhouaini528/okex-php.git
 * */
use Lin\Okex\OkexAccount;

require __DIR__ .'../../../vendor/autoload.php';

include 'key_secret.php';

$okex=new OkexAccount($key,$secret,$passphrase);

//If you are developing locally and need an agent, you can set this
$okex->setProxy();

//Set the request timeout to 60 seconds by default
$okex->setTimeOut(10);

//
try {
    $result=$okex->currencies()->get();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}




