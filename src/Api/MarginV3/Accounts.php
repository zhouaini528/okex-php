<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\MarginV3;

use Lin\Okex\Request;

class Accounts extends Request
{
    public function getAll(){
        $this->type='GET';
        $this->path='/api/margin/v3/accounts';

        return $this->exec();
    }

    /**
     * GET /api/margin/v3/accounts/<instrument_id>
     * */
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/margin/v3/accounts/'.$data['instrument_id'];

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/margin/v3/accounts/<instrument_id>/ledger
     * */
    public function getLedger(array $data=[]){
        $this->type='GET';
        $this->path='/api/margin/v3/accounts/'.$data['instrument_id'].'/ledger';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/margin/v3/accounts/availability
     * */
    public function getAvailabilityAll(){
        $this->type='GET';
        $this->path='/api/margin/v3/accounts/availability';

        return $this->exec();
    }

    /**
     * GET /api/margin/v3/accounts/<instrument_id>/availability
     * */
    public function getAvailability(array $data=[]){
        $this->type='GET';
        $this->path='/api/margin/v3/accounts/'.$data['instrument_id'].'/availability';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/margin/v3/accounts/borrowed
     * */
    public function getBorrowedAll(){
        $this->type='GET';
        $this->path='/api/margin/v3/accounts/borrowed';

        return $this->exec();
    }

    /**
     * GET /api/margin/v3/accounts/<instrument_id>/borrowed
     * */
    public function getBorrowed(array $data=[]){
        $this->type='GET';
        $this->path='/api/margin/v3/accounts/'.$data['instrument_id'].'/borrowed';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * POST /api/margin/v3/accounts/borrow
     * */
    public function postBorrow(array $data=[]){
        $this->type='POST';
        $this->path='/api/margin/v3/accounts/borrow';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * POST /api/margin/v3/accounts/repayment
     * */
    public function postRepayment(array $data=[]){
        $this->type='POST';
        $this->path='/api/margin/v3/accounts/repayment';

        $this->data=$data;

        return $this->exec();
    }
}
