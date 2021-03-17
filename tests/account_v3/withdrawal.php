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
    //'proxy'=>true,
    //More flexible Settings
    /* 'proxy'=>[
     'http'  => 'http://127.0.0.1:12333',
     'https' => 'http://127.0.0.1:12333',
     'no'    =>  ['.cn']
     ], */
    //Close the certificate
    //'verify'=>false,
]);

//Withdrawal
try {
    $result=$okex->withdrawal()->post([
        //currency	String	Yes	token
        //amount	String	Yes	withdrawal amount
        //destination	String	Yes	withdrawal address(2:OKCoin International 3:OKEx 4:others)
        //to_address	String	Yes	verified digital asset address, email or mobile String,some digital asset address format is address+tag , eg: "ARDOR-7JF3-8F2E-QUWZ-CAN7F：123456"
        //trade_pwd	String	Yes	fund password
        //fee	String	Yes	Network transaction fee≥0. Withdrawals to OKCoin or OKEx are fee-free, please set as 0. Withdrawal to external digital asset address requires network transaction fee.
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}

try {
    $result=$okex->withdrawal()->getFee();
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}




