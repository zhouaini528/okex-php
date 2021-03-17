<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\OptionV3;

use Lin\Okex\Request;

class Instruments extends Request
{
    /**
     * GET /api/option/v3/instruments/<underlying>
     * */
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/option/v3/instruments/'.$data['underlying'];

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/option/v3/instruments/<underlying>/summary
     * */
    public function getSummaryAll(array $data=[]){
        $this->type='GET';
        $this->path='/api/option/v3/instruments/'.$data['underlying'].'/summary';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/option/v3/instruments/<underlying>/summary/<instrument_id>
     * */
    public function getAummary(array $data=[]){
        $this->type='GET';
        $this->path='/api/option/v3/instruments/'.$data['underlying'].'/summary/'.$data['instrument_id'];

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/option/v3/instruments/<instrument_id>/book
     * */
    public function getBook(array $data=[]){
        $this->type='GET';
        $this->path='/api/option/v3/instruments/'.$data['instrument_id'].'/book';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/option/v3/instruments/<instrument_id>/trades
     * */
    public function getTrades(array $data=[]){
        $this->type='GET';
        $this->path='/api/option/v3/instruments/'.$data['instrument_id'].'/trades';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/option/v3/instruments/<instrument_id>/ticker
     * */
    public function getTicker(array $data=[]){
        $this->type='GET';
        $this->path='/api/option/v3/instruments/'.$data['instrument_id'].'/ticker';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/option/v3/instruments/<instrument_id>/candles
     * */
    public function getCandles(array $data=[]){
        $this->type='GET';
        $this->path='/api/option/v3/instruments/'.$data['instrument_id'].'/candles';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/option/v3/trade_fee
     * */
    public function getTradeFee(){
        $this->type='GET';
        $this->path='/api/option/v3/trade_fee';

        return $this->exec();
    }

    /**
     * GET /api/option/v3/underlying
     * */
    public function getUnderlying(){
        $this->type='GET';
        $this->path='/api/option/v3/underlying';

        return $this->exec();
    }
}
