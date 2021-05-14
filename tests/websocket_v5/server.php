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

$okex->start();

