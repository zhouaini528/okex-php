<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\SwapV3;

use Lin\Okex\Request;

class Fills extends Request
{
    /**
     * GET /api/swap/v3/fills
     * */
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/fills';

        return $this->exec();
    }
}
