<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\MarginV3;

use Lin\Okex\Request;

class Fills extends Request
{
    /**
     * GET /api/margin/v3/fills
     * */
    public function get(){
        $this->type='GET';
        $this->path='/api/margin/v3/fills';

        return $this->exec();
    }
}
