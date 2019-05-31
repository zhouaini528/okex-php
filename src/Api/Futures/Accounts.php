<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\Futures;



use Lin\Okex\Request;

class Accounts extends Request
{
    /**
     * Futures Account of all Currency
     * 
     * */
    public function getAll(){
        $this->type='GET';
        $this->path='/api/futures/v3/accounts';
        
        return $this->exec();
    }
    
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/accounts/'.$data['currency'];
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function getLeverage(array $data){
        $this->type='GET';
        $this->path='/api/futures/v3/accounts/'.$data['currency'].'/leverage';
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function postLeverage(array $data){
        $this->type='POST';
        $this->path='/api/futures/v3/accounts/'.$data['currency'].'/leverage';
        $this->data=$data;
        return $this->exec();
    }
    
    public function getLedger(array $data){
        $this->type='GET';
        $this->path='/api/futures/v3/accounts/'.$data['currency'].'/ledger';
        $this->data=$data;
        return $this->exec();
    }
    
    public function getHolds(array $data=[]){
        $this->type='GET';
        $this->path='';
        
        $this->data=$data;
        
        return $this->exec();
    }
}