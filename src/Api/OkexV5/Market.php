<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\OkexV5;

use Lin\Okex\Request;

class Market extends Request
{
    /**
     *GET /api/v5/market/tickers
     * */
    public function getTickers(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/market/tickers';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/market/ticker
     * */
    public function getTicker(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/market/ticker';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/market/index-tickers
     * */
    public function getIndexTickers(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/market/index-tickers';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/market/books
     * */
    public function getBooks(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/market/books';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/market/candles
     * */
    public function getCandles(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/market/candles';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/market/history-candles
     * */
    public function getHistoryCandles(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/market/history-candles';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/market/index-candles
     * */
    public function getIndexCandles(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/market/index-candles';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/market/mark-price-candles
     * */
    public function getMarkPriceCandles(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/market/mark-price-candles';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/market/trades
     * */
    public function getTrades(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/market/trades';

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
