<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex;

use Lin\Okex\Api\OkexV5\Account;
use Lin\Okex\Api\OkexV5\Asset;
use Lin\Okex\Api\OkexV5\Market;
use Lin\Okex\Api\OkexV5\Publics;
use Lin\Okex\Api\OkexV5\SubAccount;
use Lin\Okex\Api\OkexV5\System;
use Lin\Okex\Api\OkexV5\Trade;

class OkexV5
{
    protected $key;
    protected $secret;
    protected $passphrase;
    protected $host;

    protected $options=[];

    function __construct(string $key='',string $secret='',string $passphrase='',string $host='https://www.okx.com'){
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

            'platform'=>'okex',
            'version'=>'v5',
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
    public function account(){
       return new Account($this->init());
    }

    /**
     *
     * */
    public function asset(){
        return new Asset($this->init());
    }

    /**
     *
     * */
    public function market(){
        return new Market($this->init());
    }

    /**
     *
     * */
    public function publics(){
        return new Publics($this->init());
    }

    /**
     *
     * */
    public function subaccount(){
        return new SubAccount($this->init());
    }

    /**
     *
     * */
    public function trade(){
        return new Trade($this->init());
    }

    /**
     *
     * */
    public function system(){
        return new System($this->init());
    }
}
