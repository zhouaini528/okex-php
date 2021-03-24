<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\OkexV5;

use Lin\Okex\Request;

class Asset extends Request
{
    /**
     * GET /api/v5/asset/deposit-address
     * */
    public function getDepositAddress(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/asset/deposit-address';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/asset/balances
     * */
    public function getBalances(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/asset/balances';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/asset/transfer
     * */
    public function postTransfer(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/asset/transfer';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/asset/withdrawal
     * */
    public function postWithdrawal(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/asset/withdrawal';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/asset/deposit-history
     * */
    public function getDepositHistory(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/asset/deposit-history';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/asset/withdrawal-history
     * */
    public function getWithdrawalHistory(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/asset/withdrawal-history';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/asset/currencies
     * */
    public function getCurrencies(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/asset/currencies';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/asset/purchase_redempt
     * */
    public function postPurchaseRedempt(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/asset/purchase_redempt';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/asset/bills
     * */
    public function getBills(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/asset/bills';

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
