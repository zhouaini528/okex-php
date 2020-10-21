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

    function __construct()
    {
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
    public function getSubscribe($callback=null,$sub=[],$daemon=false){
        if($daemon) $this->daemon($callback,$sub);

        return $this->getData($this,$callback,$sub);
    }

    protected function daemon($callback=null,$sub=[]){
        $worker = new Worker();
        $worker->onWorkerStart = function() use($callback,$sub) {
            $global = $this->client();

            Timer::add(0.1, function() use ($global,$callback,$sub){
                $this->getData($global,$callback,$sub);
            });
        };
        Worker::runAll();
    }

    protected function getData($global,$callback=null,$sub=[]){
        $all_sub=$global->get('all_sub');
        print_r($all_sub);

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
