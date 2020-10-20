<?php


/**
 * @author lin <465382251@qq.com>
 *
 * Fill in your key and secret and pass can be directly run
 *
 * Most of them are unfinished and need your help
 * https://github.com/zhouaini528/okex-php.git
 * */
use Lin\Okex\OkexWebSocket;

require __DIR__ .'../../../vendor/autoload.php';

include 'key_secret.php';

$okex=new OkexWebSocket();

$action=intval($_GET['action'] ?? 0);//http pattern
if(empty($action)) $action=intval($argv[1]);//cli pattern

switch ($action){
    //**************public

    //subscribe
    case 1:{
        $okex->client()->subscribe([
            'spot/depth5:BCH-USDT',
            'futures/depth5:BCH-USD-210326',
            'swap/depth5:BCH-USD-SWAP',
            'option/depth5:BTCUSD-20201021-11750-C',
        ]);

        break;
    }

    //unsubscribe
    case 2:{
        $okex->client()->unsubscribe([
            'spot/depth5:BCH-USDT',
            'futures/depth5:BCH-USD-210326',
            'swap/depth5:BCH-USD-SWAP',
            'option/depth5:BTCUSD-20201021-11750-C',
        ]);

        break;
    }

    case 10:{
        //****Three ways to get data

        //The first way
        $data=$okex->client()->getSubscribeData();
        print_r(json_encode($data));

        //The second way callback
        $okex->client()->getSubscribeData(function($data){
            print_r(json_encode($data));
        });

        //The third way is to guard the process
        $okex->client()->getSubscribeData(function($data){
            print_r(json_encode($data));
        },true);

        break;
    }

    case 99:{
        $okex->client()->test();
        break;
    }
}

