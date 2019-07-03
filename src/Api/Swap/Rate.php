<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\Swap;



use Lin\Okex\Request;

class Rate extends Request
{
    public function get(){
        $this->type='GET';
        $this->path='/api/swap/v3/rate';
        
        return $this->exec();
    }
}