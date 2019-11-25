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

//Funds Transfer
try {
    $result=$okex->transfer()->post([
        //currency	String	Yes	Token
        //amount	String	Yes	Transfer amount
        //from	String	Yes	the remitting account (0: sub account 1: spot 3: futures 4:C2C 5: margin 6: Funding Account 8:PiggyBank 9：swap)
        //to	String	Yes	the beneficiary account(0: sub account 1:spot 3: futures 4:C2C 5: margin 6: Funding Account 8:PiggyBank 9 :swap)
        //sub_account	String	No	sub account name
        //instrument_id	String	No	Margin trading pair transferred out, for supported pairs only
        //to_instrument_id	String	No	Margin trading pair transferred in, for supported pairs only
        
        'currency'=>'btc',
        'amount'=>'0.001',
        'from'=>'1',
        'to'=>'3',
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}




