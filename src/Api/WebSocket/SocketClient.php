<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\WebSocket;

use Lin\Okex\Api\WebSocket\SocketGlobal;
use Lin\Okex\Api\WebSocket\SocketFunction;

use Workerman\Lib\Timer;
use Workerman\Worker;

class SocketClient
{
    use SocketGlobal;
    use SocketFunction;

    private $config=[];


    function __construct(array $config=[])
    {
        $this->config=$config;

        $this->client();

        //初始化全局变量
        $this->client->add('all_sub',[]);//目前总共订阅的频道

        $this->client->add('add_sub',[]);//正在订阅的频道

        $this->client->add('del_sub',[]);//正在删除的频道

        $this->client->add('keysecret',[]);//目前总共key
    }

    function keysecret(array $keysecret=[]){
        $this->keysecret=$keysecret;

        $this->keysecretInit($this->keysecret);

        return $this;
    }

    /**
     * @param array $sub
     */
    public function subscribe(array $sub=[]){
        $this->client->add_sub=$this->resub($sub);
    }

    /**
     * @param array $sub
     */
    public function unsubscribe(array $sub=[]){
        $this->client->del_sub=$this->resub($sub);
    }

    /**
     * @param array $sub    默认获取所有public订阅的数据，private数据需要设置keysecret
     * @param null $callback
     * @param bool $daemon
     * @return mixed
     */
    public function getSubscribe($callback=null,$daemon=false){
        if($daemon) $this->daemon($callback);

        return $this->getData($this,$callback);
    }

    protected function daemon($callback=null){
        $worker = new Worker();
        $worker->onWorkerStart = function() use($callback) {
            $global = $this->client();

            Timer::add(0.1, function() use ($global,$callback){
                $this->getData($global,$callback);
            });
        };
        Worker::runAll();
    }

    protected function getData($global,$callback=null){
        $all_sub=$global->get('all_sub');
        if(empty($all_sub)) return [];

        $temp=[];
        foreach ($all_sub as $k=>$v){
            if(is_array($v)) $table=$k;
            else $table=$v;

            $data=$global->get(strtolower($table));
            if(empty($data)) continue;

            $temp[$table]=$data;
        }

        if($callback!==null){
            call_user_func_array($callback, array($temp));
        }

        return $temp;
    }

    function test(){
        print_r($this->client->all_sub);
        print_r($this->client->add_sub);
        print_r($this->client->del_sub);
        print_r($this->client->keysecret);
    }
}