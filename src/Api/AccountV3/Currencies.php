<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\AccountV3;

use Lin\Okex\Request;

class Currencies extends Request
{
    /**
     * GET /api/account/v3/currencies
     * */
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/account/v3/currencies';

        $this->data=$data;

        return $this->exec();
    }
}
