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
    
    protected $options=[];
    
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
            'options'=>$this->options,
        ];
    }
    
    /**
     *
     * */
    function setOptions(array $options=[]){
        $this->options=$options;
    }
    
    
    /**
     *
     * */
    public function currencies(){
       return new Currencies($this->init());
    }
    
    /**
     *
     * */
    public function deposit(){
        return  new Deposit($this->init());
    }
    
    /**
     *
     * */
    public function ledger(){
        return new Ledger($this->init());
    }
    
    /**
     *
     * */
    public function transfer(){
        return  new Transfer($this->init());
    }
    
    /**
     *
     * */
    public function wallet(){
        return  new Wallet($this->init());
    }
    
    /**
     *
     * */
    public function withdrawal(){
        return  new Withdrawal($this->init());
    }
}