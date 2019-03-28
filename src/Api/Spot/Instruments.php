<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\Spot;

use Lin\Okex\Request;

class Instruments extends Request
{
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/spot/v3/instruments';
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function getBook(array $data){
        $this->type='GET';
        $this->path='/api/spot/v3/instruments/'.$data['instrument_id'].'/book';
        unset($data['instrument_id']);
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function getTickerAll(array $data){
        $this->type='GET';
        $this->path='';
        $this->data=$data;
        return $this->exec();
    }
    
    public function getTicker(array $data){
        $this->type='GET';
        $this->path='';
        $this->data=$data;
        return $this->exec();
    }
    
    public function getTrades(array $data){
        $this->type='GET';
        $this->path='';
        $this->data=$data;
        return $this->exec();
    }
    
    public function getCandles(array $data){
        $this->type='GET';
        $this->path='';
        $this->data=$data;
        return $this->exec();
    }
}