<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\Swap;



use Lin\Okex\Request;

class Position extends Request
{
    public function getAll(){
        $this->type='GET';
        $this->path='/api/swap/v3/position';
        
        return $this->exec();
    }
    
    /**
     * GET /api/swap/v3/BTC-USD-SWAP/position
     * */
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/'.$data['instrument_id'].'/position';
        
        $this->data=$data;
        
        return $this->exec();
    }
}