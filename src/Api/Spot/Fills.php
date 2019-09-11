<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\Spot;

use Lin\Okex\Request;

class Fills extends Request
{
    /**
     * GET /api/spot/v3/fills
     * */
    public function get(){
        $this->type='GET';
        $this->path='/api/spot/v3/fills';
        return $this->exec();
    }
}