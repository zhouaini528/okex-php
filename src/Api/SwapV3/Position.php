<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\SwapV3;



use Lin\Okex\Request;

class Position extends Request
{
    /*
     * GET/api/swap/v3/position
     * */
    public function getAll(){
        $this->type='GET';
        $this->path='/api/swap/v3/position';

        return $this->exec();
    }

    /*
     * GET/api/swap/v3/<instrument_id>/position
     * */
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/'.$data['instrument_id'].'/position';

        $this->data=$data;

        return $this->exec();
    }

    /*
     * POST/api/swap/v3/close_position
     * */
    public function postClose(array $data=[]){
        $this->type='POST';
        $this->path='/api/swap/v3/close_position';

        $this->data=$data;

        return $this->exec();
    }
}
