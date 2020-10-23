<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex;

use Lin\Okex\Api\WebSocket\SocketServer;
use Lin\Okex\Api\WebSocket\SocketClient;


class OkexWebSocket
{
    private $server=null;
    private $client=null;
    private $config=[];

    public function config(array $config=[]){
        $this->config=$config;
    }

    public function server(){
        return $this->server = new SocketServer($this->config);
    }

    public function client(){
        if($this->client!==null) return $this->client;
        return $this->client = new SocketClient($this->config);
    }

    public function start(){
        $this->server()->start();
    }

    function keysecret(array $keysecret=[]){
        $this->client()->keysecret($keysecret);
    }

    public function subscribe(array $sub=[]){
        $this->client()->subscribe($sub);
    }

    public function unsubscribe(array $sub=[]){
        $this->client()->unsubscribe($sub);
    }

    public function getSubscribe(array $sub,$callback=null,$daemon=false){
        return $this->client()->getSubscribe($sub,$callback,$daemon);
    }

    public function getSubscribes($callback=null,$daemon=false){
        return $this->client()->getSubscribes($callback,$daemon);
    }
}
