<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex;



class Okex
{
    protected $key;
    protected $secret;
    protected $host;
    
    function __construct(string $key='',string $secret='',string $host='https://www.bitmex.com'){
        $this->key=$key;
        $this->secret=$secret;
        $this->host=$host;
    }
    
    
}