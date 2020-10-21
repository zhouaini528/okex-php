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

$okex=new OkexWebSocket();

$okex->config([
    'global'=>'127.0.0.1:2208',
    'log'=>true,
]);

$okex->start();

