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
        $okex->subscribe([
            'spot/depth5:BCH-USDT',
            'futures/depth5:BCH-USD-210326',
            'swap/depth5:BCH-USD-SWAP',
            'option/depth5:BTCUSD-20201021-11750-C',
        ]);

        break;
    }

    //unsubscribe
    case 2:{
        $okex->unsubscribe([
            'spot/depth5:BCH-USDT',
            'futures/depth5:BCH-USD-210326',
            'swap/depth5:BCH-USD-SWAP',
            'option/depth5:BTCUSD-20201021-11750-C',
        ]);

        break;
    }

    //**************private
    case 10:{
        $okex->keysecret($key_secret[0]);
        $okex->subscribe([
            'spot/depth5:BCH-USDT',
            'futures/depth5:BCH-USD-210326',
            'swap/depth5:BCH-USD-SWAP',

            'futures/position:BCH-USD-210326',
            'futures/account:BCH-USDT',
            'swap/position:BCH-USD-SWAP',
        ]);
        break;
    }

    case 11:{
        $okex->keysecret([
            'key'=>'xxxxxxxxx',
            'secret'=>'xxxxxxxxx',
            'passphrase'=>'xxxxxxxxx',
        ]);
        $okex->subscribe([
            'spot/depth5:BTC-USDT',
            'futures/depth5:BTC-USD-210326',
            'swap/depth5:BTC-USD-SWAP',

            'futures/position:BTC-USD-210326',
            'swap/position:BTC-USD-SWAP',
        ]);
        break;
    }

    case 20:{
        //****Three ways to get data,Specified channel acquisition

        //The first way
        $data=$okex->getSubscribe();
        print_r(json_encode($data));

        die('222');


        //The second way callback
        $okex->getSubscribe(function($data){
            print_r(json_encode($data));
        });

        //The third way is to guard the process
        $okex->getSubscribe(function($data){
            print_r(json_encode($data));
        },[],true);

        break;
    }

    case 99:{
        $okex->client()->test();
        break;
    }
}

