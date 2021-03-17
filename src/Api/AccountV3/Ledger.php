<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\AccountV3;

use Lin\Okex\Request;

class Ledger  extends Request
{
    /**
     *
     * */
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/account/v3/ledger';

        $this->data=$data;

        return $this->exec();
    }
}
