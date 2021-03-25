<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\OkexV5;

use Lin\Okex\Request;

class Trade extends Request
{
    /**
     *POST /api/v5/trade/order
     * */
    public function postOrder(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/trade/order';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/trade/batch-orders
     * */
    public function postBatchOrders(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/trade/batch-orders';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/trade/cancel-order
     * */
    public function postCancelOrder(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/trade/cancel-order';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/trade/cancel-batch-orders
     * */
    public function postCancelBatchOrders(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/trade/cancel-batch-orders';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/trade/amend-order
     * */
    public function postAmendOrder(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/trade/amend-order';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/trade/amend-batch-orders
     * */
    public function postAmendBatchOrders(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/trade/amend-batch-orders';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/trade/close-position
     * */
    public function postClosePosition(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/trade/close-position';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/trade/order
     * */
    public function getOrder(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/trade/order';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/trade/orders-pending
     * */
    public function getOrdersPending(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/trade/orders-pending';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/trade/orders-history
     * */
    public function getOrdersHistory(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/trade/orders-history';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/trade/orders-history-archive
     * */
    public function getOrdersHistoryArchive(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/trade/orders-history-archive';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/trade/fills
     * */
    public function getFills(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/trade/fills';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/trade/order-algo
     * */
    public function postOrderAlgo(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/trade/order-algo';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/v5/trade/cancel-algos
     * */
    public function postCancelAlgos(array $data=[]){
        $this->type='POST';
        $this->path='/api/v5/trade/cancel-algos';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/trade/orders-algo-pending
     * */
    public function getOrdersAlgoPending(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/trade/orders-algo-pending';

        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/v5/trade/orders-algo-history
     * */
    public function getOrdersAlgoHistory(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/trade/orders-algo-history';

        $this->data=$data;
        return $this->exec();
    }

}
