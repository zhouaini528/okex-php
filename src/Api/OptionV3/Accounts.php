<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\OptionV3;

use Lin\Okex\Request;

class Accounts extends Request
{
    /**
     * GET /api/option/v3/accounts/<underlying>
     * */
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/option/v3/accounts/'.$data['underlying'];

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/option/v3/accounts/<underlying>/ledger
     * */
    public function getLedger(array $data=[]){
        $this->type='GET';
        $this->path='/api/option/v3/accounts/'.$data['underlying'].'/ledger';

        $this->data=$data;

        return $this->exec();
    }
}
