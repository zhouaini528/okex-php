<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\SpotV3;

use Lin\Okex\Request;

class Trade extends Request
{
    /**
     * GET /api/spot/v3/trade_fee
     * */
    public function getFee(array $data=[]){
        $this->type='GET';
        $this->path='/api/spot/v3/trade_fee';
        $this->data=$data;

        return $this->exec();
    }
}
