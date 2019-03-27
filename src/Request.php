<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex;

use GuzzleHttp\Exception\RequestException;
use Lin\Okex\Exceptions\Exception;

class Request
{
    protected $key='';
    
    protected $secret='';
    
    protected $host='';
    
    protected $passphrase='';
    
    
    
    protected $nonce='';
    
    protected $signature='';
    
    protected $headers=[];
    
    protected $type='';
    
    protected $path='';
    
    protected $data=[];
    
    
    
    protected $timeout=10;
    
    public function __construct(array $data)
    {
        $this->key=$data['key'] ?? '';
        $this->secret=$data['secret'] ?? '';
        $this->passphrase = $data['passphrase'] ?? '';
        $this->host=$data['host'] ?? 'https://www.okex.com/';
    }
    
    /**
     * 认证
     * */
    protected function auth(){
        $this->nonce();
        
        $this->signature();
        
        $this->headers();
    }
    
    /**
     * 过期时间
     * */
    protected function nonce(){
        $this->nonce=gmdate('Y-m-d\TH:i:s\.000\Z');
    }
    
    /**
     * 签名
     * */
    protected function signature(){
        $endata=http_build_query($this->data);
        $this->signature = base64_encode(hash_hmac('sha256', $this->nonce.$this->type.$this->path.$endata, $this->secret, true));
    }
    
    /**
     * 默认头部信息
     * */
    protected function headers(){
        $this->headers=[
            'accept' => 'application/json',
        ];
        
        if(!empty($this->key) && !empty($this->secret)) {
            $this->headers=array_merge($this->headers,[
                'OK-ACCESS-KEY'=> $this->key,
                'OK-ACCESS-TIMESTAMP'=>$this->nonce,
                'OK-ACCESS-PASSPHRASE' =>$this->passphrase,
                'OK-ACCESS-SIGN' => $this->signature,
            ]);
        }
    }
    
    /**
     * 发送http
     * */
    protected function send(){
        $client = new \GuzzleHttp\Client();
        
        $data=[
            'headers'=>$this->headers,
            'timeout'=>$this->timeout
        ];
        
        if(!empty($this->data)) $data['form_params']=$this->data;
        
        $response = $client->request($this->type, $this->host.$this->path, $data);
        
        return $response->getBody()->getContents();
    }
    
    /*
     * 执行流程
     * */
    protected function exec(){
        $this->auth();
        
        //可以记录日志
        try {
            return json_decode($this->send(),true);
        }catch (RequestException $e){
            if(method_exists($e->getResponse(),'getBody')){
                $contents=$e->getResponse()->getBody()->getContents();
                
                $temp=json_decode($contents,true);
                if(!empty($temp)) {
                    $temp['method']=$this->type;
                    $temp['url']=$this->host.$this->path;
                }else{
                    $temp['message']=$e->getMessage();
                }
            }else{
                $temp['message']=$e->getMessage();
            }
            
            $temp['httpcode']=$e->getCode();
            
            //TODO  该流程可以记录各种日志
            throw new Exception(json_encode($temp));
        }
    }
}