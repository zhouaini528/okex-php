<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\Futures;


use Lin\Okex\Request;

class Instruments extends Request
{
    /**
     * Get market data. This endpoint provides the snapshots of market data and can be used without verifications.
     * */
    public function get(){
        $this->type='GET';
        $this->path='/api/futures/v3/instruments';
        
        return $this->exec();
    }
    
    /**
     * List all contracts. This request does not support pagination. The full list will be returned for a request.
     * 
        Parameters	Parameters Types	Required	Description
        instrument_id	String	Yes	Contract ID,e.g. “BTC-USD-180213”
        size	Int	No	The size of the price range (max: 200)
     * */
    public function getBook(array $data){
        $this->type='GET';
        $this->path='/api/futures/v3/instruments/'.$data['instrument_id'].'/book';
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

    public function getIndex(array $data){
        $this->type='GET';
        $this->path='';
        $this->data=$data;
        return $this->exec();
    }
    
    public function getEstimatedPrice(array $data){
        $this->type='GET';
        $this->path='';
        $this->data=$data;
        return $this->exec();
    }
    
    public function getOpenInterest(array $data){
        $this->type='GET';
        $this->path='';
        $this->data=$data;
        return $this->exec();
    }
    
    public function getPriceLimit(array $data){
        $this->type='GET';
        $this->path='';
        $this->data=$data;
        return $this->exec();
    }
    
    public function getMarkPrice(array $data){
        $this->type='GET';
        $this->path='';
        $this->data=$data;
        return $this->exec();
    }
    
    public function getLiquidation(array $data){
        $this->type='GET';
        $this->path='';
        $this->data=$data;
        return $this->exec();
    }
}