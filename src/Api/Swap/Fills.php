<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\Swap;

use Lin\Okex\Request;

class Fills extends Request
{
    /**
     * GET /api/swap/v3/fills
     * */
    public function get(){
        $this->type='GET';
        $this->path='/api/swap/v3/fills';
        
        return $this->exec();
    }
}