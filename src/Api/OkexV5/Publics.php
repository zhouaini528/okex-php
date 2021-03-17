<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\OkexV5;

use Lin\Okex\Request;

class Publics extends Request
{
    /**
     *GET /api/v5/public/instruments
     * */
    public function getInstruments(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/public/instruments';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/public/delivery-exercise-history
     * */
    public function getDeliveryExerciseHistory(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/public/delivery-exercise-history';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/public/open-interest
     * */
    public function getOpenInterest(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/public/open-interest';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/public/funding-rate
     * */
    public function getFundingRate(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/public/funding-rate';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/public/funding-rate-history
     * */
    public function getFundingRateHistory(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/public/funding-rate-history';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/public/price-limit
     * */
    public function getPriceLimit(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/public/price-limit';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/public/opt-summary
     * */
    public function getOptSummary(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/public/opt-summary';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/public/estimated-price
     * */
    public function getEstimatedPrice(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/public/estimated-price';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/public/discount-rate-interest-free-quota
     * */
    public function getDiscountRateInterestFreeQuota(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/public/discount-rate-interest-free-quota';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/public/time
     * */
    public function getTime(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/public/time';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/public/liquidation-orders
     * */
    public function getLiquidationOrders(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/public/liquidation-orders';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/public/mark-price
     * */
    public function getMarkPrice(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/public/mark-price';

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
