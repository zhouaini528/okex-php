<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\Swap;

use Lin\Okex\Request;

class Instruments extends Request
{
    /**
     * GET /api/swap/v3/instruments
     * */
    public function get(){
        $this->type='GET';
        $this->path='/api/swap/v3/instruments';
        
        return $this->exec();
    }
    
    /**
     * /api/swap/v3/instruments/<instrument_id>/depth
     * */
    public function getDepth(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/instruments/'.$data['instrument_id'].'/depth';
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function getTickerAll(){
        $this->type='GET';
        $this->path='/api/swap/v3/instruments/ticker';
        
        return $this->exec();
    }
    
    public function getTicker(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/instruments/'.$data['instrument_id'].'/ticker';
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function getTrades(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/instruments/'.$data['instrument_id'].'/trades';
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function getCandles(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/instruments/'.$data['instrument_id'].'/candles';
        
        $this->data=$data;
        
        return $this->exec();
    }

    public function getIndex(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/instruments/'.$data['instrument_id'].'/index';
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function getOpenInterest(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/instruments/'.$data['instrument_id'].'/open_interest';
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function getPriceLimit(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/instruments/'.$data['instrument_id'].'/price_limit';
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function getLiquidation(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/instruments/'.$data['instrument_id'].'/liquidation';
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function getHolds(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/accounts/'.$data['instrument_id'].'/holds';
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function getFundingTime(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/instruments/'.$data['instrument_id'].'/funding_time';
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function getMarkPrice(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/instruments/'.$data['instrument_id'].'/mark_price';
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function getHistoricalFundingRate(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/instruments/'.$data['instrument_id'].'/historical_funding_rate';
        
        $this->data=$data;
        
        return $this->exec();
    }
}