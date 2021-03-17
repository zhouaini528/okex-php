<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\SpotV3;

use Lin\Okex\Request;

class Fills extends Request
{
    /**
     * GET /api/spot/v3/fills
     * */
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/spot/v3/fills';
        $this->data=$data;

        return $this->exec();
    }
}
