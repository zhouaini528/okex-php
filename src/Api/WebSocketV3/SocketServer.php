<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\WebSocketV3;

use Lin\Okex\Api\WebSocketV3\SocketGlobal;
use Lin\Okex\Api\WebSocketV3\SocketFunction;
use Workerman\Lib\Timer;
use Workerman\Worker;
use Workerman\Connection\AsyncTcpConnection;

class SocketServer
{
    use SocketGlobal;
    use SocketFunction;

    private $worker;

    private $connection=[];
    private $connectionIndex=0;
    private $config=[];

    private $local_global=['public'=>[],'private'=>[]];

    function __construct(array $config=[])
    {
        $this->config=$config;
    }

    public function start(){
        $this->worker = new Worker();
        $this->server();

        $this->worker->onWorkerStart = function() {
            $this->addConnection('public');
        };

        Worker::runAll();
    }

    private function addConnection(string $tag,array $keysecret=[]){
        $this->newConnection()($tag,$keysecret);
    }

    private function newConnection(){
        return function($tag,$keysecret){
            $baseurl='ws://real.okex.com:8443/ws/v3';

            $global=$this->client();

            $this->connection[$this->connectionIndex] = new AsyncTcpConnection($baseurl);
            $this->connection[$this->connectionIndex]->transport = 'ssl';

            $this->log('Connection '.$baseurl);

            //自定义属性
            $this->connection[$this->connectionIndex]->tag=$tag;//标记公共连接还是私有连接
            $this->connection[$this->connectionIndex]->tag_reconnection_num=0;//标记当前已重连次数
            if(!empty($keysecret)) $this->connection[$this->connectionIndex]->tag_keysecret=$keysecret;//标记私有连接

            $this->connection[$this->connectionIndex]->onConnect=$this->onConnect($keysecret);
            $this->connection[$this->connectionIndex]->onMessage=$this->onMessage($global);
            $this->connection[$this->connectionIndex]->onClose=$this->onClose($global);
            $this->connection[$this->connectionIndex]->onError=$this->onError();

            $this->connect($this->connection[$this->connectionIndex]);
            $this->ping($this->connection[$this->connectionIndex]);
            $this->other($this->connection[$this->connectionIndex],$global);

            $this->connectionIndex++;
        };
    }

    private function onConnect(array $keysecret){
        return function($con) use($keysecret){
            if(empty($keysecret)) return;

            $timestamp=round(microtime(true)*1000)/1000;

            $message = $timestamp.'GET/users/self/verify';
            $sign=base64_encode(hash_hmac('sha256', $message, $keysecret['secret'], true));
            $data = json_encode([
                'op' => "login",
                'args' => [$keysecret['key'], $keysecret['passphrase'], $timestamp, $sign]
            ]);

            $con->send($data);

            $this->log($keysecret['key'].' new connect send');
        };
    }

    private function onMessage($global){
        return function($con,$data) use($global){
            // 解压数据
            $data = gzinflate($data);
            $data=json_decode($data,true);

            if(isset($data['table'])) {
                /*$debug=$global->get('debug2');
                if($debug==1){
                    $con->tag_data_time='1619149751';
                    return;
                }*/

                $table=$data['table'].':'.$this->getInstrumentId($data);
                $table=strtolower($table);

                if($con->tag != 'public') {
                    $table=$this->userKey($con->tag_keysecret,$table);
                    $global->saveQueue($table,$data);
                }else{
                    //$global->save($table,$data);
                    $this->local_global['public'][$table]=$data;

                    //最后数据更新时间
                    $con->tag_data_time=time();
                    //成功接收数据重连次数回归0
                    $con->tag_reconnection_num=0;
                }

                return;
            }

            if(isset($data['event'])) {
                $this->log($data);
                $this->log('event '.$data['event']);

                if($data['event']=='error') {
                    $this->errorMessage($global,$con->tag,$data,isset($con->tag_keysecret)?$con->tag_keysecret:'');
                    return ;
                }

                if($data['event']=='subscribe'){
                    return;
                }
                if($data['event']=='event unsubscribe'){
                    return;
                }
            }

            if(isset($data['success'])) {
                $this->log($data);

                //******登陆成功后，keysecret  private 状态
                $keysecret=$con->tag_keysecret;
                $global->keysecretUpdate($keysecret['key'],1);

                return ;
            }
        };
    }

    private function onClose($global){
        return function($con) use($global){
            if($con->tag=='public'){
                $this->log($con->tag.' reconnection');

                //Clear public cached data
                foreach ($this->local_global['public'] as $k=>$v) unset($this->local_global['public'][$k]);

                $this->reconnection($global,'public');
            }else{
                $this->log('private connection close,ready to reconnect '.$con->tag_keysecret['key']);

                //更改登录状态
                $global->keysecretUpdate($con->tag_keysecret['key'],2);

                //重新订阅私有频道
                $this->reconnection($global,'private',$con->tag_keysecret);
                //Timer::del($con->timer_other);
            }

            $con->reConnect(10);
        };
    }

    private function onError(){
        return function($con, $code, $msg){
            $this->log('onerror code:'.$code.' msg:'.$msg);
        };
    }

    private function connect($con){
        $con->connect();
    }

    private function ping($con){
        $time=isset($this->config['ping_time']) ? $this->config['ping_time'] : 20 ;

        Timer::add($time, function() use ($con) {
            $con->send("ping");

            $this->log($con->tag.' send ping');
        });
    }

    private function other($con,$global){
        $time=isset($this->config['listen_time']) ? $this->config['listen_time'] : 2 ;

        $con->timer_other=Timer::add($time, function() use($con,$global) {
            $this->subscribe($con,$global);

            $this->unsubscribe($con,$global);

            $this->debug($con,$global);

            $this->log('listen '.$con->tag);

            //公共数据如果60秒内无数据更新，则断开连接重新订阅，重试次数不超过10次
            if($con->tag=='public'){
                /*if(isset($con->tag_data_time)){
                    //debug
                    echo time() - $con->tag_data_time;
                    echo PHP_EOL;
                }*/

                //public
                if (isset($con->tag_data_time) && time() - $con->tag_data_time > 60 * ($con->tag_reconnection_num + 1) && $con->tag_reconnection_num <= 10) {
                    $con->close();

                    $con->tag_reconnection_num++;

                    $this->log('listen ' . $con->tag . ' reconnection_num:' . $con->tag_reconnection_num . ' tag_data_time:' . $con->tag_data_time);
                }
            }else{
                //private
            }
        });

        //异步保存数据，不然会有阻塞问题。 0.2秒保存一次
        Timer::add(0.2, function() use($global) {
            $global->save('global_local',$this->local_global);
        });
    }

    /**
     * 调试用
     * @param $con
     * @param $global
     */
    private function debug($con,$global){
        $debug=$global->get('debug');
        if($con->tag=='public'){
            //public
            if(isset($debug['public']) && $debug['public'][$con->tag]=='close'){
                $this->log($con->tag.' debug '.json_encode($debug));

                $debug['public'][$con->tag]='recon';
                $global->save('debug',$debug);

                $con->close();
            }
        }else{
            //private
            if(isset($debug['private'][$con->tag_keysecret['key']]) && $debug['private'][$con->tag_keysecret['key']]==$con->tag_keysecret['key']){
                $this->log($con->tag_keysecret['key'].' debug '.json_encode($debug));

                unset($debug['private'][$con->tag_keysecret['key']]);
                $global->save('debug',$debug);

                //更改登录状态
                $global->keysecretUpdate($con->tag_keysecret['key'],2);

                $con->close();
            }
        }
    }

    private function subscribe($con,$global){
        if(empty($global->get('add_sub'))) return;

        if($con->tag=='public'){
            //公共订阅 并 触发私有连接
            $this->subscribePublic($con,$global);
        }else{
            $this->subscribePrivate($con,$global);
        }

        return;
    }

    private function subscribePublic($con,$global){
        $sub=[
            'public'=>[],
            'private'=>[],
        ];

        $temp=$global->get('add_sub');
        foreach ($temp as $v){
            if(count($v)>1) $sub['private'][$v[1]['key']]=$v[1];
            else array_push($sub['public'],$v[0]);
        }

        //有私有频道先去建立新连接 即登陆
        foreach ($sub['private'] as $v){
            $this->login($global,$v);
        }

        //公共连接 标记订阅频道是否有改变。
        if(empty($sub['public'])) {
            $this->log('public dont change return');
            return;
        }


        //判断当前是否已经重复订阅。可以无所谓。
        $data=[
            'op' => "subscribe",
            'args' => $sub['public'],
        ];

        $data=json_encode($data);
        $con->send($data);

        $this->log($data);
        $this->log('public subscribe send');

        //*******订阅成功后，删除add_sub  public 值
        $global->addSubUpdate('public');

        //*******订阅成功后 更改 all_sub  public 值
        $global->allSubUpdate('public',['sub'=>$sub['public']]);
    }

    private function subscribePrivate($con,$global){
        $sub=[];
        $keysecret=$con->tag_keysecret;
        $temp=$global->get('add_sub');
        //判断是否是私有连接，并判断该私有连接是否是  当前用户。
        foreach ($temp as $v){
            if(!isset($v[1])) continue;
            $key=$v[1]['key'];
            if(count($v)>1 && $key==$keysecret['key']) $sub[]=$v[0];
        }

        if(empty($sub)) {
            $this->log('subscribe private return');
            return;
        }

        //**********判断是否已经登陆
        $client_keysecret=$global->get('keysecret');
        $keysecret=$con->tag_keysecret;

        if($client_keysecret[$keysecret['key']]['login']!=1 || $client_keysecret[$keysecret['key']]['key']!=$con->tag_keysecret['key']) {
            $this->log('subscribe private dont login return '.$keysecret['key']);
            return;
        }

        $data=[
            'op' => "subscribe",
            'args' => $sub,
        ];

        $data=json_encode($data);
        $con->send($data);

        $this->log($data);
        $this->log('private subscribe send '.$keysecret['key']);

        //*******订阅成功后，删除add_sub   值
        $global->addSubUpdate('private',['user_key'=>$keysecret['key']]);


        //*******订阅成功后 更改 all_sub   值
        $global->allSubUpdate('private',['sub'=>$temp]);

        return;
    }

    private function unsubscribe($con,$global){
        if(empty($this->get('del_sub'))) return;

        if($con->tag=='public'){
            //公共订阅 并 触发私有连接
            $this->unsubscribePublic($con,$global);
        }else{
            $this->unsubscribePrivate($con,$global);
        }

        return;
    }

    private function unsubscribePublic($con,$global){
        $unsub=[];
        $temp=$this->get('del_sub');
        foreach ($temp as $v){
            if(count($v)==1) $unsub[]=$v[0];
        }

        if(empty($unsub)) {
            $this->log('unsubscribe public return');
            return;
        }

        //判断当前是否已经重复订阅。可以无所谓。
        $data=[
            'op' => "unsubscribe",
            'args' => $unsub,
        ];

        $data=json_encode($data);
        $con->send($data);

        $this->log($data);
        $this->log('public unsubscribe send');

        //*******订阅成功后，删除del_sub  public 值
        $global->delSubUpdate('public');


        //*******订阅成功后 更改 all_sub  public 值
        $global->unAllSubUpdate('public',['sub'=>$unsub]);

    }

    private function unsubscribePrivate($con,$global){
        $unsub=[];
        $keysecret=$con->tag_keysecret;
        $temp=$global->get('del_sub');
        //判断是否是私有连接，并判断该私有连接是否是  当前用户。
        foreach ($temp as $v){
            $key=$v[1]['key'];
            if(count($v)>1 && $key==$keysecret['key']) $unsub[]=$v[0];
        }

        if(empty($unsub)) {
            $this->log('unsubscribe private return');
            return;
        }

        $data=[
            'op' => "unsubscribe",
            'args' => $unsub,
        ];

        $data=json_encode($data);
        $con->send($data);

        $this->log($data);
        $this->log('private unsubscribe send '.$keysecret['key']);

        //*******订阅成功后，删除add_sub   值
        $global->delSubUpdate('private',['user_key'=>$keysecret['key']]);

        //*******订阅成功后 更改 all_sub   值
        $global->unAllSubUpdate('private',['sub'=>$temp]);
    }

    private function login($global,$keysecret){
        //判断是否已经登陆
        $old_client_keysecret=$global->get('keysecret');
        if(empty($old_client_keysecret)) {
            $this->log('private no value keysecret return ');
            return;
        }

        if($old_client_keysecret[$keysecret['key']]['login']==1) {
            //$this->log('private already login return '.$keysecret['key']);
            return;
        }

        if($old_client_keysecret[$keysecret['key']]['login']==2) {
            $this->log('private doing return '.$keysecret['key']);
            return;
        }

        $this->log('private new connection '.$keysecret['key']);

        //**********如果登陆失败，事件监听会再次 执行轮询 创建新连接，所以必须要有正在登陆中的状态标记
        $global->keysecretUpdate($keysecret['key'],2);

        //当前连接是公共连接才允许建立新的私有连接
        $this->addConnection($keysecret['key'],$keysecret);
    }
}
