<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\FuturesV3;



use Lin\Okex\Request;

class Accounts extends Request
{
    /**
     * GET/api/futures/v3/account
     * */
    public function getAll(){
        $this->type='GET';
        $this->path='/api/futures/v3/accounts';

        return $this->exec();
    }

    /*
     * GET/api/futures/v3/accounts/<underlying>
     * */
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/accounts/'.$data['underlying'];

        $this->data=$data;

        return $this->exec();
    }

    /*
     * GET/api/futures/v3/accounts/<underlying>/leverage
     * */
    public function getLeverage(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/accounts/'.$data['underlying'].'/leverage';

        $this->data=$data;

        return $this->exec();
    }

    /*
     * POST /api/futures/v3/accounts/<underlying>/leverage
     * */
    public function postLeverage(array $data=[]){
        $this->type='POST';
        $this->path='/api/futures/v3/accounts/'.$data['underlying'].'/leverage';
        $this->data=$data;
        return $this->exec();
    }

    /*
     * GET/api/futures/v3/accounts/<underlying>/ledger
     * */
    public function getLedger(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/accounts/'.$data['underlying'].'/ledger';
        $this->data=$data;
        return $this->exec();
    }

    /**
     * GET/api/futures/v3/accounts/<instrument_id>/holds
     * */
    public function getHolds(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/accounts/'.$data['instrument_id'].'/holds';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * POST /api/futures/v3/accounts/margin_mode
     * */
    public function postMarginMode(array $data=[]){
        $this->type='POST';
        $this->path='/api/futures/v3/accounts/margin_mode';
        $this->data=$data;
        return $this->exec();
    }

    /*
     * POST /api/futures/v3/accounts/auto_margin
     * */
    public function postAutoMargin(array $data=[]){
        $this->type='POST';
        $this->path='/api/futures/v3/accounts/auto_margin';
        $this->data=$data;
        return $this->exec();
    }

    /*
     * GET/api/futures/v3/trade_fee
     * */
    public function getTradeFee(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/trade_fee';
        $this->data=$data;
        return $this->exec();
    }
}
