<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\Futures;

use Lin\Okex\Request;

class Position extends Request
{
    /**
     * Get the information of all holding positions in futures trading.Due to high energy consumption, you are advised to capture data with the "Futures Account of a Currency" API instead.
     * 
     * */
    public function getAll(){
        $this->type='GET';
        $this->path='/api/futures/v3/position';
        
        return $this->exec();
    }
    
    /**
     * Get the information of holding positions of a contract.
     * 
        Parameters	Parameters Types	Required	Description
        instrument_id	String	Yes	Contract ID, e.g.“BTC-USD-180213”
     * */
    public function get(array $data){
        $this->type='GET';
        $this->path='/api/futures/v3/'.$data['instrument_id'].'/position';
        
        $this->data=$data;
        
        return $this->exec();
    }
}