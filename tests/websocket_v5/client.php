<?php


/**
 * @author lin <465382251@qq.com>
 *
 * Fill in your key and secret and pass can be directly run
 *
 * Most of them are unfinished and need your help
 * https://github.com/zhouaini528/okex-php.git
 * */
use Lin\Okex\OkexWebSocketV5;

require __DIR__ .'../../../vendor/autoload.php';

include 'key_secret.php';

$okex=new OkexWebSocketV5();

$okex->config([
    //Do you want to enable local logging,default false
    'log'=>true,
    //Or set the log name
    //'log'=>['filename'=>'okex'],

    //Daemons address and port,default 0.0.0.0:22075
    'global'=>'127.0.0.1:22075',

    //Heartbeat time,default 20 seconds
    //'ping_time'=>20,

    //Channel subscription monitoring time,2 seconds
    //'listen_time'=>2,

    //Channel data update time,0.1 seconds
    //'data_time'=>0.1,

    //Set Demo Trading Services
    /*'baseurl'=>[
        'public'=>'ws://wspap.okex.com:8443/ws/v5/public?brokerId=9999',
        'private'=>'ws://wspap.okex.com:8443/ws/v5/private?brokerId=9999',
    ],*/
]);

$action=intval($_GET['action'] ?? 0);//http pattern
if(empty($action)) $action=intval($argv[1]);//cli pattern

switch ($action){
    //**************public

    case 0:{
        $okex->subscribe([
            ["channel"=>"instruments","instType"=>"SPOT"],
            ["channel"=>"instruments","instType"=>"SWAP"],
            ["channel"=>"instruments","instType"=>"FUTURES"],
            ["channel"=>"instruments","instType"=>"OPTION"],
        ]);
        break;
    }

    //subscribe
    case 1:{
        $okex->subscribe([
            ["channel"=>"tickers","instId"=>"BTC-USDT"],
            ["channel"=>"tickers","instId"=>"BTC-USD-SWAP"],
            ["channel"=>"tickers","instId"=>"BTC-USD-210924"],

            ["channel"=>"books","instId"=>"BTC-USDT"],
            ["channel"=>"books","instId"=>"BTC-USD-SWAP"],
            ["channel"=>"books","instId"=>"BTC-USD-210924"],

            ["channel"=>"candle5m","instId"=>"BTC-USDT"],
            ["channel"=>"candle15m","instId"=>"BTC-USD-SWAP"],
            ["channel"=>"candle30m","instId"=>"BTC-USD-210924"],
        ]);
        break;
    }

    //unsubscribe
    case 2:{
        $okex->unsubscribe([
            ["channel"=>"tickers","instId"=>"BTC-USDT"],
            ["channel"=>"tickers","instId"=>"BTC-USD-SWAP"],
            ["channel"=>"tickers","instId"=>"BTC-USD-210924"],

            ["channel"=>"books","instId"=>"BTC-USDT"],
            ["channel"=>"books","instId"=>"BTC-USD-SWAP"],
            ["channel"=>"books","instId"=>"BTC-USD-210924"],

            ["channel"=>"candle5m","instId"=>"BTC-USDT"],
            ["channel"=>"candle15m","instId"=>"BTC-USD-SWAP"],
            ["channel"=>"candle30m","instId"=>"BTC-USD-210924"],
        ]);

        break;
    }

    //**************private
    //subscribe
    case 10:{
        $okex->keysecret($key_secret[0]);
        $okex->subscribe([
            //public
            ["channel"=>"tickers","instId"=>"BTC-USDT"],
            ["channel"=>"tickers","instId"=>"BTC-USD-SWAP"],
            ["channel"=>"tickers","instId"=>"BTC-USD-210924"],

            ["channel"=>"books","instId"=>"BTC-USDT"],
            ["channel"=>"books","instId"=>"BTC-USD-SWAP"],
            ["channel"=>"books","instId"=>"BTC-USD-210924"],

            ["channel"=>"candle5m","instId"=>"BTC-USDT"],
            ["channel"=>"candle15m","instId"=>"BTC-USD-SWAP"],
            ["channel"=>"candle30m","instId"=>"BTC-USD-210924"],

            //private
            ["channel"=>"account","ccy"=>"BTC"],
            ["channel"=>"positions","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
            ["channel"=>"balance_and_position"],
            ["channel"=>"orders","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
            ["channel"=>"orders-algo","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
        ]);
        break;
    }

    //unsubscribe
    case 11:{
        $okex->keysecret($key_secret[0]);
        $okex->unsubscribe([
            //public
            ["channel"=>"tickers","instId"=>"BTC-USDT"],
            ["channel"=>"tickers","instId"=>"BTC-USD-SWAP"],
            ["channel"=>"tickers","instId"=>"BTC-USD-210924"],

            ["channel"=>"books","instId"=>"BTC-USDT"],
            ["channel"=>"books","instId"=>"BTC-USD-SWAP"],
            ["channel"=>"books","instId"=>"BTC-USD-210924"],

            ["channel"=>"candle5m","instId"=>"BTC-USDT"],
            ["channel"=>"candle15m","instId"=>"BTC-USD-SWAP"],
            ["channel"=>"candle30m","instId"=>"BTC-USD-210924"],

            //private
            ["channel"=>"account","ccy"=>"BTC"],
            ["channel"=>"positions","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
            ["channel"=>"balance_and_position"],
            ["channel"=>"orders","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
            ["channel"=>"orders-algo","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
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
            ["channel"=>"tickers","instId"=>"BTC-USDT"],
            ["channel"=>"tickers","instId"=>"BTC-USD-SWAP"],
            ["channel"=>"tickers","instId"=>"BTC-USD-210924"],
        ]);

        //The second way callback
        $okex->getSubscribe([
            ["channel"=>"books","instId"=>"BTC-USDT"],
            ["channel"=>"books","instId"=>"BTC-USD-SWAP"],
            ["channel"=>"books","instId"=>"BTC-USD-210924"],
        ],function($data){
            print_r(json_encode($data));
        });

        //The third way is to guard the process
        $okex->getSubscribe([
            ["channel"=>"candle5m","instId"=>"BTC-USDT"],
            ["channel"=>"candle15m","instId"=>"BTC-USD-SWAP"],
            ["channel"=>"candle30m","instId"=>"BTC-USD-210924"],
        ],function($data){
            print_r(json_encode($data));
        },true);

        break;
    }

    case 22:{
        //****Three ways return to the specified channel data

        //The first way
        $okex->keysecret($key_secret[0]);
        $data=$okex->getSubscribes();
        print_r(json_encode($data));
        die;

        //The second way callback
        $okex->keysecret($key_secret[0]);
        $okex->getSubscribe([
            ["channel"=>"books","instId"=>"BTC-USDT"],
            ["channel"=>"books","instId"=>"BTC-USD-SWAP"],

            ["channel"=>"account","ccy"=>"BTC"],
            ["channel"=>"positions","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
        ],function($data){
            print_r(json_encode($data));
        });

        //The third way is to guard the process
        $okex->keysecret($key_secret[0]);
        $okex->getSubscribe([
            ["channel"=>"books","instId"=>"BTC-USDT"],
            ["channel"=>"books","instId"=>"BTC-USD-SWAP"],

            ["channel"=>"account","ccy"=>"BTC"],
            ["channel"=>"positions","instType"=>"FUTURES","uly"=>"BTC-USD","instId"=>"BTC-USD-210924"],
        ],function($data){
            print_r(json_encode($data));
        },true);

        break;
    }

    case 99:{
        $okex->client()->test();
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


