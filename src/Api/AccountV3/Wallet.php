<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\AccountV3;

use Lin\Okex\Request;

class Wallet extends Request
{
    /**
     * GET /api/account/v3/wallet
     * */
    public function getAll(){
        $this->type='GET';
        $this->path='/api/account/v3/wallet';

        return $this->exec();
    }

    /**
     * GET /api/account/v3/wallet/<currency>
     * */
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/account/v3/wallet/'.$data['currency'];

        $this->data=$data;

        return $this->exec();
    }
}
