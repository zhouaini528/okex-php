<?php


/**
 * @author lin <465382251@qq.com>
 * 
 * Fill in your key and secret and pass can be directly run
 * 
 * Most of them are unfinished and need your help
 * https://github.com/zhouaini528/okex-php.git
 * */
use Lin\Okex\OkexSpot;

require __DIR__ .'../../../vendor/autoload.php';

include 'key_secret.php';

$okex=new OkexSpot($key,$secret,$passphrase);

//OKEx token trading only supports limit and market orders (more order types will become available in the future). You can place an order only if you have enough funds.
//Once your order is placed, the amount will be put on hold.
/*
Parameters	Parameters Types	Required	Description
client_oid	string	No	the order ID customized by yourself , The client_oid type should be comprised of alphabets + numbers or only alphabets within 1 – 32 characters， both uppercase and lowercase letters are supported
type	string	No	limit / market(default: limit)
side	string	Yes	buy or sell
instrument_id	string	Yes	trading pair
order_type	string	No	Fill in number for parameter，0: Normal limit order (Unfilled and 0 represent normal limit order) 1: Post only 2: Fill Or Kill 3: Immediatel Or Cancel
*
Parameters	Parameters Types	Required	Description
price	string	Yes	price
size	string	Yes	quantity bought or sold
*
Market Order Parameters
Parameters	Parameters Types	Required	Description
size	string	Yes	quantity sold. (for orders sold at market price only)
notional	string	Yes	amount bought. (for orders bought at market price only)
*/
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



