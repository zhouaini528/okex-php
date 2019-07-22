<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex;


use Lin\Okex\Api\Futures\Accounts;
use Lin\Okex\Api\Futures\Fills;
use Lin\Okex\Api\Futures\Instruments;
use Lin\Okex\Api\Futures\Orders;
use Lin\Okex\Api\Futures\Position;

class OkexFuture
{
    protected $key;
    protected $secret;
    protected $passphrase;
    protected $host;
    
    protected $proxy=false;
    protected $timeout=60;
    
    function __construct(string $key='',string $secret='',string $passphrase='',string $host='https://www.okex.com'){
        $this->key=$key;
        $this->secret=$secret;
        $this->host=$host;
        $this->passphrase=$passphrase;
    }
    
    /**
     *
     * */
    private function init(){
        return [
            'key'=>$this->key,
            'secret'=>$this->secret,
            'passphrase'=>$this->passphrase,
            'host'=>$this->host,
            'timeout'=>$this->timeout,
        ];
    }
    
    /**
     * Local development sets the proxy
     * @param bool|array
     * $proxy=false Default
     * $proxy=true  Local proxy http://127.0.0.1:12333
     *
     * Manual proxy
     * $proxy=[
     'http'  => 'http://127.0.0.1:12333',
     'https' => 'http://127.0.0.1:12333',
     'no'    =>  ['.cn']
     * ]
     * */
    function setProxy($proxy=true){
        $this->proxy=$proxy;
    }
    
    /**
     * Set the request timeout to 60 seconds by default
     * */
    function setTimeOut($timeout=60){
        $this->timeout=$timeout;
    }
    
    /**
     *
     * */
    public function account(){
        $account= new Accounts($this->init());
        $account->proxy($this->proxy);
        return $account;
    }
    
    /**
     *
     * */
    public function fill(){
        $fill= new Fills($this->init());
        $fill->proxy($this->proxy);
        return $fill;
    }
    
    /**
     *
     * */
    public function instrument(){
        $instrument= new Instruments($this->init());
        $instrument->proxy($this->proxy);
        return $instrument;
    }
    
    /**
     *
     * */
    public function order(){
        $order= new Orders($this->init());
        $order->proxy($this->proxy);
        return $order;
    }
    
    /**
     *
     * */
    public function position(){
        $position= new Position($this->init());
        $position->proxy($this->proxy);
        return $position;
    }
}