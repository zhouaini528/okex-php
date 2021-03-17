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

//
try {
    $result=$okex->ledger()->get([
        //currency	String	否	币种，如btc ，不填时返回所有的账单流水
        //type	String	否	填写相应数字：1:充值2:提现13:撤销提现18:转入合约账户19:合约账户转出20:转入子账户21:子账户转出28:领取29:转入指数交易区30:指数交易区转出 31:转入点对点账户32:点对点账户转出 33:转入币币杠杆账户 34:币币杠杆账户转出 37:转入币币账户 38:币币账户转出
        //from	String	否	请求此id之前(更旧的数据)的分页内容，传的值为对应接口的order_id、ledger_id或trade_id等；
        //to	String	否	请求此id之后(更新的数据)的分页内容，传的值为对应接口的order_id、ledger_id或trade_id等；
        //limit	String	否	分页返回的结果集数量，最大为100，不填默认返回100条

        'currency'=>'btc'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r(json_decode($e->getMessage(),true));
}




