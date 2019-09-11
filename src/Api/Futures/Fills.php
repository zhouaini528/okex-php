<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\Futures;

use Lin\Okex\Request;

class Fills extends Request
{
    /**
     * GET /api/futures/v3/fills
     * */
    public function get(array $data){
        $this->type='GET';
        $this->path='/api/futures/v3/fills';
        $this->data=$data;
        return $this->exec();
    }
}