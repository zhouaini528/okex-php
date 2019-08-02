<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex;

use Lin\Okex\Api\Account\Currencies;
use Lin\Okex\Api\Account\Deposit;
use Lin\Okex\Api\Account\Ledger;
use Lin\Okex\Api\Account\Transfer;
use Lin\Okex\Api\Account\Wallet;
use Lin\Okex\Api\Account\Withdrawal;

class OkexAccount
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
    public function currencies(){
        $currencies= new Currencies($this->init());
        $currencies->proxy($this->proxy);
        return $currencies;
    }
    
    /**
     *
     * */
    public function deposit(){
        $deposit= new Deposit($this->init());
        $deposit->proxy($this->proxy);
        return $deposit;
    }
    
    /**
     *
     * */
    public function ledger(){
        $ledger= new Ledger($this->init());
        $ledger->proxy($this->proxy);
        return $ledger;
    }
    
    /**
     *
     * */
    public function transfer(){
        $transfer= new Transfer($this->init());
        $transfer->proxy($this->proxy);
        return $transfer;
    }
    
    /**
     *
     * */
    public function wallet(){
        $wallet= new Wallet($this->init());
        $wallet->proxy($this->proxy);
        return $wallet;
    }
    
    /**
     *
     * */
    public function withdrawal(){
        $withdrawal= new Withdrawal($this->init());
        $withdrawal->proxy($this->proxy);
        return $withdrawal;
    }
}