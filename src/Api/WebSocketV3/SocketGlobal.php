<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\WebSocketV3;

use GlobalData\Server;
use GlobalData\Client;

trait SocketGlobal
{
    protected $server;
    protected $client;

    private $config=[];

    protected function server(){
        $address=isset($this->config['global']) ? explode(':',$this->config['global']) : ['0.0.0.0','2207'];
        $this->server=new Server($address[0],$address[1]);
        return $this;
    }

    protected function client(){
        $address=isset($this->config['global']) ? $this->config['global'] : '0.0.0.0:2207';
        $this->client=new Client($address);
        return $this;
    }

    protected function add($key,$value){
        $this->client->add($key,$value);

        $this->saveGlobalKey($key);
    }

    protected function get($key){
        if(!isset($this->client->$key) || empty($this->client->$key)) return [];
        return $this->client->$key;
    }

    protected function save($key,$value){
        if(!isset($this->client->$key)) $this->add($key,$value);
        else $this->client->$key=$value;
    }

    /**
     * 对了获取数据
     * @param $key
     * @return array
     */
    protected function getQueue($key){
        if(!isset($this->client->$key) || empty($this->client->$key)) return [];

        do{
            $old_value=$new_value=$this->client->$key;

            if(empty($new_value)) return [];
            //队列先进先出。
            $value=array_shift($new_value);
        }
        while(!$this->client->cas($key, $old_value, $new_value));

        return $value;
    }

    /**
     * 队列保存数据
     * @param $key
     * @param $value
     */
    protected function saveQueue($key,$value){
        //最大存储数据量，超过后保留一条最新的数据，其余数据全部删除。
        $max= isset($this->config['queue_count']) ? $this->config['queue_count'] : 100;

        if(!isset($this->client->$key)) $this->add($key,[$value]);
        else {
            do{
                $old_value=$new_value=$this->client->$key;

                //超过最大数据量，保留最新数据
                if(count($new_value)>$max){
                    $new_value=[$value];
                }else{
                    array_push($new_value,$value);
                }
            }
            while(!$this->client->cas($key, $old_value, $new_value));
        }
    }

    protected function addSubUpdate($type='public',$data=[]){
        do{
            $old_value=$new_value=$this->client->add_sub;
            foreach ($new_value as $k=>$v){
                if($type=='public' && count($v)==1) unset($new_value[$k]);
                if($type=='private') {
                    //添加的频道必须当前用户
                    $key=$v[1]['key'];
                    if(count($v)>1 && $key==$data['user_key']) unset($new_value[$k]);
                }
            }
        }
        while(!$this->client->cas('add_sub', $old_value, $new_value));
    }

    protected function delSubUpdate($type='public',$data=[]){
        do{
            $old_value=$new_value=$this->client->del_sub;
            foreach ($new_value as $k=>$v){
                if($type=='public' && count($v)==1) unset($new_value[$k]);
                if($type=='private') {
                    //添加的频道必须当前用户
                    $key=$v[1]['key'];
                    if(count($v)>1 && $key==$data['user_key']) unset($new_value[$k]);
                }
            }
        }
        while(!$this->client->cas('del_sub', $old_value, $new_value));
    }

    protected function allSubUpdate($type='public',$data=[]){
        do{
            $old_value=$new_value=$this->client->all_sub;
            foreach ($data['sub'] as $v){
                if($type=='public') $key=$v;
                if($type=='private') $key=$v[1]['key'].self::$USER_DELIMITER.$v[0];
                $new_value[$key]=$v;
            }
        }
        while(!$this->client->cas('all_sub', $old_value, $new_value));
    }

    protected function unAllSubUpdate($type='public',$data=[]){
        do{
            $old_value=$new_value=$this->client->all_sub;
            foreach ($data['sub'] as $v){
                if($type=='public') unset($new_value[$v]);
                if($type=='private') unset($new_value[$v[1]['key'].$v[0]]);
            }
        }
        while(!$this->client->cas('all_sub', $old_value, $new_value));
    }

    protected function keysecretUpdate($key,$login=0){
        do{
            $old_client_keysecret=$new_client_keysecret=$this->client->keysecret;
            $new_client_keysecret[$key]['login']=$login;
        }
        while(!$this->client->cas('keysecret', $old_client_keysecret, $new_client_keysecret));
    }

    protected function keysecretInit($keysecret){
        do {
            $old_value = $new_value = $this->client->keysecret;

            if(!isset($new_value[$keysecret['key']])) {
                $new_value[$keysecret['key']]=$keysecret;
                $new_value[$keysecret['key']]['login']=0;
            }
        }
        while(!$this->client->cas('keysecret', $old_value, $new_value));
    }

    protected function saveGlobalKey($key){
        do {
            $old_value = $new_value = $this->client->global_key;
            $new_value[$key]=$key;
        }
        while(!$this->client->cas('global_key', $old_value, $new_value));
    }
}
