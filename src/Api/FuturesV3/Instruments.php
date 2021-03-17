<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\FuturesV3;


use Lin\Okex\Request;

class Instruments extends Request
{
    /**
     * GET/api/futures/v3/instruments
     */
    public function get(){
        $this->type='GET';
        $this->path='/api/futures/v3/instruments';

        return $this->exec();
    }

    /**
     * GET/api/futures/v3/instruments/<instrument_id>/book
     */
    public function getBook(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/instruments/'.$data['instrument_id'].'/book';
        unset($data['instrument_id']);

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/futures/v3/instruments/ticker
     * */
    public function getTickerAll(){
        $this->type='GET';
        $this->path='/api/futures/v3/instruments/ticker';
        return $this->exec();
    }

    /**
     * GET /api/futures/v3/instruments/<instrument_id>/ticker
     * */
    public function getTicker(array $data=[]){
        $this->type='GET';
        $this->path='GET /api/futures/v3/instruments/'.$data['instrument_id'].'/ticker';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/futures/v3/instruments/<instrument_id>/trades
     * */
    public function getTrades(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/instruments/'.$data['instrument_id'].'/trades';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/futures/v3/instruments/<instrument-id>/candles
     * */
    public function getCandles(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/instruments/'.$data['instrument_id'].'/candles';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET/api/futures/v3/instruments/<instrument_id>/index
     * */
    public function getIndex(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/instruments/'.$data['instrument_id'].'/index';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/futures/v3/instruments/<instrument_id>/estimated_price
     * */
    public function getEstimatedPrice(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/instruments/'.$data['instrument_id'].'/estimated_price';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/futures/v3/instruments/<instrument_id>/open_interest
     * */
    public function getOpenInterest(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/instruments/'.$data['instrument_id'].'/open_interest';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/futures/v3/instruments/<instrument_id>/price_limit
     * */
    public function getPriceLimit(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/instruments/'.$data['instrument_id'].'/price_limit';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET/api/futures/v3/instruments/<instrument_id>/mark_price
     * */
    public function getMarkPrice(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/instruments/'.$data['instrument_id'].'/mark_price';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/futures/v3/instruments/<instrument_id>/liquidation
     * */
    public function getLiquidation(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/instruments/'.$data['instrument_id'].'/liquidation';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/futures/v3/instruments/<instrument_id>/history/candles
     * */
    public function getHistoryCandles(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/instruments/'.$data['instrument_id'].'/history/candles';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/futures/v3/rate
     * */
    public function getRate(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/rate';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/futures/v3/settlement/history
     * */
    public function getSettlementHistory(array $data=[]){
        $this->type='GET';
        $this->path='/api/futures/v3/settlement/history';
        $this->data=$data;
        return $this->exec();
    }
}
