<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex;

use Lin\Okex\Api\WebSocketV3\SocketServer;
use Lin\Okex\Api\WebSocketV3\SocketClient;


class OkexWebSocket
{
    private $server=null;
    private $client=null;
    private $config=[];

    /**
     * @param array $config
     */
    public function config(array $config=[]){
        $this->config=$config;
    }

    /**
     * @return SocketServer
     */
    public function server(){
        return $this->server = new SocketServer($this->config);
    }

    /**
     * @return SocketClient|null
     */
    public function client(){
        if($this->client!==null) return $this->client;
        return $this->client = new SocketClient($this->config);
    }

    /**
     *
     */
    public function start(){
        $this->server()->start();
    }

    /**
     * @param array $keysecret
     */
    function keysecret(array $keysecret=[]){
        $this->client()->keysecret($keysecret);
    }

    /**
     * @param array $sub
     */
    public function subscribe(array $sub=[]){
        $this->client()->subscribe($sub);
    }

    /**
     * @param array $sub
     */
    public function unsubscribe(array $sub=[]){
        $this->client()->unsubscribe($sub);
    }

    /**
     * @param array $sub
     * @param null $callback
     * @param bool $daemon
     * @return array
     */
    public function getSubscribe(array $sub,$callback=null,$daemon=false){
        return $this->client()->getSubscribe($sub,$callback,$daemon);
    }

    /**
     * @param null $callback
     * @param bool $daemon
     * @return array
     */
    public function getSubscribes($callback=null,$daemon=false){
        return $this->client()->getSubscribes($callback,$daemon);
    }

    /**
     * Private channel reconnect
     * @param string $key
     */
    public function reconPrivate(string $key){
        $this->client()->reconPrivate($key);
    }

    /**
     * Public channel reconnect
     */
    public function reconPublic(){
        $this->client()->reconPublic();
    }
}
