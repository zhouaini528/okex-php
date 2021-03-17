<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\OkexV5;

use Lin\Okex\Request;

class SubAccount extends Request
{
    /**
     *GET /api/v5/account/subaccount/balances
     * */
    public function getBalances(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/account/subaccount/balances';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/asset/subaccount/bills
     * */
    public function getBills(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/asset/subaccount/bills';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/users/subaccount/delete-apikey
     * */
    public function postDeleteApiKey(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/users/subaccount/delete-apikey';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/users/subaccount/modify-apikey
     * */
    public function postModifyApiKey(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/users/subaccount/modify-apikey';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/users/subaccount/apikey
     * */
    public function postApiKey(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/users/subaccount/apikey';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/users/subaccount/list
     * */
    public function getList(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/users/subaccount/list';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/asset/subaccount/transfer
     * */
    public function postTransfer(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/asset/subaccount/transfer';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *
     * */
    /*public function get(array $data=[]){
        $this->type='GET';
        $this->path='';

        $this->data=$data;
        return $this->exec();
    }*/
}
