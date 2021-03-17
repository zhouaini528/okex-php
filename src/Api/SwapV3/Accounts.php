<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\SwapV3;

use Lin\Okex\Request;

class Accounts extends Request
{
    /*
     * GET/api/swap/v3/accounts
     * */
    public function getAll(){
        $this->type='GET';
        $this->path='/api/swap/v3/accounts';

        return $this->exec();
    }

    /**
     * GET GET /api/swap/v3/<instrument_id>/accounts
     * */
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/'.$data['instrument_id'].'/accounts';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/swap/v3/accounts/<instrument_id>/settings
     * */
    public function getSettings(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/accounts/'.$data['instrument_id'].'/settings';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * POST /api/swap/v3/accounts/<instrument_id>/leverage
     * */
    public function postLeverage(array $data=[]){
        $this->type='POST';
        $this->path='/api/swap/v3/accounts/'.$data['instrument_id'].'/leverage';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/swap/v3/accounts/<instrument_id>/ledger
     * */
    public function getLedger(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/accounts/'.$data['instrument_id'].'/ledger';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/swap/v3/accounts/<instrument_id>/holds
     * */
    public function getHolds(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/accounts/'.$data['instrument_id'].'/holds';

        $this->data=$data;

        return $this->exec();
    }

    /*
     * GET/api/swap/v3/trade_fee
     * */
    public function getRradeFee(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/trade_fee';

        $this->data=$data;

        return $this->exec();
    }


}
