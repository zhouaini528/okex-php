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

        $this->init();
    }

    protected function init(){
        //初始化全局变量
        $this->add('global_key',[]);//保存全局变量key

        $this->add('all_sub',[]);//目前总共订阅的频道

        $this->add('add_sub',[]);//正在订阅的频道

        $this->add('del_sub',[]);//正在删除的频道

        $this->add('keysecret',[]);//目前总共key
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
        $this->save('add_sub',$this->resub($sub));
    }

    /**
     * @param array $sub
     */
    public function unsubscribe(array $sub=[]){
        $this->save('del_sub',$this->resub($sub));
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

            $time=isset($this->config['data_time']) ? $this->config['data_time'] : 0.1 ;

            Timer::add($time, function() use ($global,$callback){
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
        print_r($this->client->global_key);
    }

    function test2(){
        //print_r($this->client->global_key);
        $global_key=$this->client->global_key;
        foreach ($global_key as $k=>$v){
            echo $k.PHP_EOL;
            print_r($this->client->$v);

        }
    }
}
