<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\OkexV5;

use Lin\Okex\Request;

class Account extends Request
{
    /**
     *GET /api/v5/account/balance
     * */
    public function getBalance(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/account/balance';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/account/positions
     * */
    public function getPositions(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/account/positions';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/account/bills
     * */
    public function getBills(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/account/bills';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/account/bills-archive
     * */
    public function getBillsArchive(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/account/bills-archive';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/account/config
     * */
    public function getConfig(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/account/config';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/account/set-position-mode
     * */
    public function postSetPositionMode(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/account/set-position-mode';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/account/set-leverage
     * */
    public function postSetLeverage(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/account/set-leverage';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/account/max-size
     * */
    public function getMaxSize(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/account/max-size';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/account/max-avail-size
     * */
    public function getMaxAvailSize(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/account/max-avail-size';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/account/position/margin-balance
     * */
    public function postPositionMarginBalance(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/account/position/margin-balance';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/account/leverage-info
     * */
    public function getLeverageInfo(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/account/leverage-info';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/account/max-loan
     * */
    public function getMaxLoan(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/account/max-loan';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/account/trade-fee
     * */
    public function getTradeFee(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/account/trade-fee';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/account/interest-accrued
     * */
    public function getInterestAccrued(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/account/interest-accrued';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/account/set-greeks
     * */
    public function postSetGreeks(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/account/set-greeks';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/account/max-withdrawal
     * */
    public function getMaxWithdrawal(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/account/max-withdrawal';

        $this->data=$data;
        return $this->exec();
    }
}
