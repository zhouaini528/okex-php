<?php


/**
 * @author lin <465382251@qq.com>
 * 
 * Fill in your key and secret and pass can be directly run
 * 
 * Most of them are unfinished and need your help
 * https://github.com/zhouaini528/okex-php.git
 * */
use Lin\Okex\OkexSwap;

require __DIR__ .'../../../vendor/autoload.php';

include 'key_secret.php';

$okex=new OkexSwap($key,$secret,$passphrase);
$okex->setProxy();

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



