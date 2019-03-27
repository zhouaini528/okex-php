<?php


/**
 * @author lin <465382251@qq.com>
 *
 * Most of them are unfinished and need your help
 * https://github.com/zhouaini528/okex-php.git
 * */
use Lin\Okex\OkexSpot;

require __DIR__ .'../../../vendor/autoload.php';

$key='ca0906fb-0aff-4601-8937-53a8c61d75c0';
$secret='36732C6381E82A76F3B9D13B3E177E5F';
$passphrase='5960451';

$okex=new OkexSpot($key,$secret,$passphrase);


try {
    $result=$okex->account()->getAll();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}


try {
    $result=$okex->account()->get([
        'currency'=>'BTC'
    ]);
    
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}
