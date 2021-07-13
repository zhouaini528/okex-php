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

$okex->config([
    //Do you want to enable local logging,default false
    'log'=>true,
    //Or set the log name
    //'log'=>['filename'=>'okex'],

    //Daemons address and port,default 0.0.0.0:2207
    //'global'=>'127.0.0.1:22080',

    //Heartbeat time,default 20 seconds
    //'ping_time'=>20,

    //Channel subscription monitoring time,2 seconds
    //'listen_time'=>2,

    //Channel data update time,0.1 seconds
    //'data_time'=>0.1,
]);

$action=intval($_GET['action'] ?? 0);//http pattern
if(empty($action)) $action=intval($argv[1]);//cli pattern

switch ($action){
    //**************public

    //subscribe
    case 1:{
        $okex->subscribe([
            'spot/depth5:BCH-USDT',
            'futures/depth5:BCH-USD-210924',
            'swap/depth5:BCH-USD-SWAP',
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
    //subscribe
    case 10:{
        $okex->keysecret($key_secret[0]);
        $okex->subscribe([
            /*'spot/depth5:BCH-USDT',
            'futures/depth5:BCH-USD-210924',
            'swap/depth5:BCH-USD-SWAP',*/

            'futures/position:BCH-USD-210924',
            'futures/account:BCH-USDT',
            'swap/position:BCH-USD-SWAP',
        ]);
        break;
    }

    //unsubscribe
    case 11:{
        $okex->keysecret($key_secret[0]);
        $okex->unsubscribe([
            'spot/depth5:BCH-USDT',
            'futures/depth5:BCH-USD-210326',
            'swap/depth5:BCH-USD-SWAP',

            'futures/position:BCH-USD-210326',
            'futures/account:BCH-USDT',
            'swap/position:BCH-USD-SWAP',
        ]);

        break;
    }

    case 15:{
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
        //****Three ways to get all data

        //The first way
        $data=$okex->getSubscribes();
        print_r(json_encode($data));


        //The second way callback
        $okex->getSubscribes(function($data){
            print_r(json_encode($data));
        });

        //The third way is to guard the process
        $okex->getSubscribes(function($data){
            print_r(json_encode($data));
        },true);

        break;
    }

    case 21:{
        //****Three ways return to the specified channel data

        //The first way
        $data=$okex->getSubscribe([
            'spot/depth5:BCH-USDT',
            'futures/depth5:BCH-USD-210326',
        ]);
        print_r(json_encode($data));

        //The second way callback
        $okex->getSubscribe([
            'spot/depth5:BCH-USDT',
            'futures/depth5:BCH-USD-210326',
        ],function($data){
            print_r(json_encode($data));
        });

        //The third way is to guard the process
        $okex->getSubscribe([
            'spot/depth5:BCH-USDT',
            'futures/depth5:BCH-USD-210326',
        ],function($data){
            print_r(json_encode($data));
        },true);

        break;
    }

    case 22:{
        //****Three ways return to the specified channel data

        //The first way
        $okex->keysecret($key_secret[0]);
        $data=$okex->getSubscribe([
            'futures/depth5:BCH-USD-210326',
            'futures/position:BCH-USD-210326',//If there are private channels, $okex->keysecret() must be set
        ]);
        print_r(json_encode($data));
        die;

        //The second way callback
        $okex->keysecret($key_secret[0]);
        $okex->getSubscribe([
            'futures/depth5:BCH-USD-210326',
            'futures/position:BCH-USD-210326',//If there are private channels, $okex->keysecret() must be set
        ],function($data){
            print_r(json_encode($data));
        });

        //The third way is to guard the process
        $okex->keysecret($key_secret[0]);
        $okex->getSubscribe([
            'futures/depth5:BCH-USD-210326',
            'futures/position:BCH-USD-210326',//If there are private channels, $okex->keysecret() must be set
        ],function($data){
            print_r(json_encode($data));
        },true);

        break;
    }

    case 99:{
        $okex->client()->test();
        break;
    }

    //Simulation error message
    case 10001:{
        $okex->subscribe([
            'spot/depth5:BCH-USDT-xx',
        ]);
        break;
    }

    case 10002:{
        $okex->keysecret([
            'key'=>'xxxxxxxxx',
            'secret'=>'xxxxxxxxx',
            'passphrase'=>'xxxxxxxxx',
        ]);
        $okex->subscribe([
            'swap/depth5:BTC-USD-SWAP-xxx',

            'futures/position:BTC-USD-210326',
            'swap/position:BTC-USD-SWAP',
        ]);
        break;
    }

    case 10003:{
        $okex->subscribe([
            'spot/depth5:BCH-USDT',
            'futures/depth5:BCH-USD-210326',
            'swap/depth5:BCH-USD-SWAP',
            'option/depth5:BTCUSD-20201021-11750-C',

            'futures/position:BTC-USD-210326',
            'swap/position:BTC-USD-SWAP',
        ]);
        break;
    }

    case 10004:{
        $okex->client()->test2();
        break;
    }

    case 10005:{
        $okex->client()->test_reconnection();
        break;
    }

    case 10006:{
        $okex->reconPublic();
        break;
    }

    case 10007:{
        //private
        //print_r($key_secret[0]);
        $okex->reconPrivate($key_secret[0]['key']);
        break;
    }
}


