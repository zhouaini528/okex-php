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

    public function server(){
        return $this->server = new SocketServer();
    }

    public function client(){
        if($this->client!==null) return $this->client;
        return $this->client = new SocketClient();
    }
}
