<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\WebSocket;

use Lin\Okex\Api\WebSocket\SocketGlobal;
use Workerman\Lib\Timer;
use Workerman\Worker;

class SocketClient
{
    use SocketGlobal;

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

    public function subscribe(array $sub=[]){
        $this->client->add_sub=$this->resub($sub);
    }

    public function unsubscribe(array $sub=[]){
        $this->client->del_sub=$this->resub($sub);
    }

    public function getSubscribeData($callback=null,$daemon=false){
        if($daemon) $this->daemon($callback);

        return $this->getData($this->client,$callback);
    }

    protected function daemon($callback=null){
        $worker = new Worker();
        $worker->onWorkerStart = function() use($callback) {
            $client = $this->client()->client;
            Timer::add(0.1, function() use ($client,$callback){
                $this->getData($client,$callback);
            });
        };
        Worker::runAll();
    }

    protected function getData($client,$callback=null){
        $all_sub=$client->all_sub;

        foreach ($all_sub as $k=>$v){
            if(is_array($v)) $table=$k;
            else $table=$v;
            $table=strtolower($table);

            $data=$client->$table;

            if(empty($data)) continue;

            if($callback!==null){
                call_user_func_array($callback, array($data));
            }else{
                return $data;
            }
        }
    }

    /**
     * 标记订阅的频道是否需要有登陆的KEY
     */
    protected function resub(array $sub=[]){
        $new_sub=[];
        $temp1=['account','position','order'];
        foreach ($sub as $v) {
            $temp2=[$v];
            foreach ($temp1 as $tv){
                if(strpos($v, $tv) !== false){
                    array_push($temp2,$this->keysecret);
                }
            }
            array_push($new_sub,$temp2);
        }

        return $new_sub;
    }

    function test(){
        print_r($this->client->all_sub);
        print_r($this->client->add_sub);
        print_r($this->client->del_sub);
        print_r($this->client->keysecret);
    }
}
