<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\WebSocketV5;

use Lin\Okex\Api\WebSocketV5\SocketGlobal;
use Lin\Okex\Api\WebSocketV5\SocketFunction;

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

        $this->add('global_local',[]);//临时存储数据

        $this->add('debug',[]);
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
        $add_sub=$this->get('add_sub');
        if(empty($add_sub)) $this->save('add_sub',$this->resub($sub));
        else $this->save('add_sub',array_merge($this->resub($sub),$add_sub));
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
    public function getSubscribe(array $sub,$callback=null,$daemon=false){
        if($daemon) $this->daemon($callback,$sub);

        $sub=$this->resub($sub);

        return $this->getData($this,$callback,$sub);
    }

    /**
     * 返回订阅的所有数据
     * @param null $callback
     * @param bool $daemon
     * @return array
     */
    public function getSubscribes($callback=null,$daemon=false){
        if($daemon) $this->daemon($callback);

        return $this->getData($this,$callback);
    }

    protected function daemon($callback=null,$sub=[]){
        $worker = new Worker();
        $worker->onWorkerStart = function() use($callback,$sub) {
            $global = $this->client();

            $time=isset($this->config['data_time']) ? $this->config['data_time'] : 0.1 ;

            $sub=$this->resub($sub);

            Timer::add($time, function() use ($global,$callback,$sub){
                $this->getData($global,$callback,$sub);
            });
        };
        Worker::runAll();
    }

    /**
     * @param $global
     * @param null $callback
     * @param array $sub 返回规定的频道
     * @return array
     */
    protected function getData($global,$callback=null,$sub=[]){
        $all_sub=$global->get('all_sub');
        if(empty($all_sub)) return [];

        $global_local=$global->get('global_local');
        $temp=[];

        //默认返回所有数据
        if(empty($sub)){
            foreach ($all_sub as $k=>$v){
                $is_array=explode(self::$USER_DELIMITER,$k);
                if(count($is_array)>1){
                    /*[xxxxx-xxxxx-xxxxx==={"channel":"orders-algo","instType":"FUTURES","uly":"BTC-USD","instId":"BTC-USD-210924"}] => Array
                                (
                                    [channel] => orders-algo
                                        [instType] => FUTURES
                                [uly] => BTC-USD
                                [instId] => BTC-USD-210924
                    )*/
                    //是否是当前用户获取数据
                    if(empty($this->keysecret) || $this->keysecret['key']!=$is_array[0]) continue;

                    $data=$global->getQueue($k);
                    $temp[$k]=$data;
                }else{
                    /*[{"channel":"candle5m","instId":"BTC-USDT"}] => Array
                                (
                                    [channel] => candle5m
                                    [instId] => BTC-USDT
                    )*/

                    //$data=$global->get($k);
                    if(!isset($global_local['public'][$k])) continue;
                    
                    $data=$global_local['public'][$k];
                    $temp[$k]=$data;
                }
            }
        }else{
            //print_r($sub);
            foreach ($sub as $k=>$v){
                if(!array_key_exists('key',$v)){
                    $table=json_encode($v);
                    //$data=$global->get($table);
                    $data=$global_local['public'][$table];
                } else {
                    $keysecret=[
                        'key'=>$v['key'],
                    ];
                    unset($v['key']);
                    $table=$this->userKey($keysecret,json_encode($v));
                    $data=$global->getQueue($table);
                }

                if(empty($data)) continue;
                $temp[$table]=$data;
            }
        }

        if($callback!==null){
            call_user_func_array($callback, array($temp));
        }

        return $temp;
    }

    /*
     *
     * */
    function reconPrivate(string $key){
        $debug=$this->client->debug;
        if(empty($debug)){
            $this->client->debug=[
                'private'=>[$key=>$key],
            ];
        }else{
            $this->client->debug=['private'=>array_merge($this->client->debug['private'],[$key=>$key])];
        }
    }

    function reconPublic(){
        $this->client->debug=[
            'public'=>['public'=>'close'],
        ];
    }

    function test(){
        echo 'all_sub'.PHP_EOL;
        print_r($this->client->all_sub);
        echo 'add_sub'.PHP_EOL;
        print_r($this->client->add_sub);
        echo 'del_sub'.PHP_EOL;
        print_r($this->client->del_sub);
        echo 'keysecret'.PHP_EOL;
        print_r($this->client->keysecret);
        echo 'global_key'.PHP_EOL;
        print_r($this->client->global_key);
    }

    function test2(){
        $global_key=$this->client->global_key;
        foreach ($global_key as $k=>$v){
            echo count($this->client->$v).'----'.$k.PHP_EOL;
            echo json_encode($this->client->$v).PHP_EOL;
        }
    }

    function test_reconnection2(){
        $this->client->debug2=1;
    }
}
