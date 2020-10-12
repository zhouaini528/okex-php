<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\WebSocket;

use Workerman\Lib\Timer;
use Workerman\Worker;
use Workerman\Connection\AsyncTcpConnection;


class Socket
{
    private $worker;

    public $connection=[];

    public $connectionIndex=0;

    public function workerStart(){
        $this->worker = new Worker();

        $this->worker->onWorkerStart = function($worker) {
            $this->addConnection();

            Timer::add(6, function() {
                $this->addConnection();

                echo $this->connectionIndex;
                echo ' child '.count($this->connection).PHP_EOL;
            },[]);
        };

        Worker::runAll();
    }

    public function addConnection(){
        $this->newConnection()();
    }

    private function newConnection(){
        return function(){
            $this->connection[$this->connectionIndex] = new AsyncTcpConnection('ws://echo.websocket.org:443');
            $this->connection[$this->connectionIndex]->transport = 'ssl';

            $this->connection[$this->connectionIndex]->onConnect=$this->onConnect($this->connection[$this->connectionIndex]);
            $this->connection[$this->connectionIndex]->onMessage=$this->onMessage();

            $this->connect($this->connection[$this->connectionIndex]);
            $this->connectionIndex++;
        };
    }

    private function onConnect($con){
        $con->send('start');

        // 定时器
        $timer_id=Timer::add(2, function() use ($con,&$timer_id)
        {
            $con->send("Timer ".$timer_id.' '.date('Y-m-d H:i:s',time()));
        });
    }

    private function onMessage(){
        return function($con,$data){
            echo $data.PHP_EOL;
        };
    }

    private function onClose(){
        return function($con){

        };
    }

    private function onError(){
        return function($con, $code, $msg){

        };
    }

    public function connect($con){
        $con->connect();
    }
}
