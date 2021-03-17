<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\AccountV3;

use Lin\Okex\Request;

class Deposit extends Request
{
    /**
     * GET /api/account/v3/deposit/address
     * */
    public function getAddress(array $data=[]){
        $this->type='GET';
        $this->path='/api/account/v3/deposit/address';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/account/v3/deposit/history/<currency>
     * */
    public function getHistory(array $data=[]){
        $this->type='GET';
        $this->path='/api/account/v3/deposit/history/'.$data['currency'];

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/account/v3/deposit/history
     * */
    public function getHistoryAll(array $data=[]){
        $this->type='GET';
        $this->path='/api/account/v3/deposit/history';

        $this->data=$data;

        return $this->exec();
    }
}
