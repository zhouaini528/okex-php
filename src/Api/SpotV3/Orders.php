<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\SpotV3;

use Lin\Okex\Request;

class Orders extends Request
{
    /**
     * POST /api/spot/v3/orders
    */
    public function post(array $data=[]){
        $this->type='POST';
        $this->path='/api/spot/v3/orders';

        $data['margin_trading']=1;
        $this->data=$data;

        return $this->exec();
    }

    /**
     * POST /api/spot/v3/batch_orders
     * */
    public function postBatch(array $data=[]){
        $this->type='POST';
        $this->path='/api/spot/v3/batch_orders';
        $this->data=$data;
        return $this->exec();
    }

    /**
     * POST /api/spot/v3/cancel_orders/<order_id> or <client_oid>
     * */
    public function postCancel(array $data=[]){
        $id=$data['order_id'] ?? $data['client_oid'];
        unset($data['order_id']);
        unset($data['client_oid']);

        $this->type='POST';
        $this->path='/api/spot/v3/cancel_orders/'.$id;

        $this->data=$data;

        return $this->exec();
    }

    /**
     * POST /api/spot/v3/cancel_batch_orders
     * */
    public function postCancelBatch(array $data=[]){
        $this->type='POST';
        $this->path='/api/spot/v3/cancel_batch_orders';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET /api/spot/v3/orders
     * */
    public function getAll(array $data=[]){
        $this->type='GET';
        $this->path='/api/spot/v3/orders';
        $this->data=$data;
        return $this->exec();
    }

    /**
     * GET/api/spot/v3/orders_pending
     * */
    public function getPending(array $data=[]){
        $this->type='GET';
        $this->path='/api/spot/v3/orders_pending';
        $this->data=$data;
        return $this->exec();
    }

    /**
     * GET/api/spot/v3/orders/<order_id> or /api/spot/v3/orders/<client_oid>
     * */
    public function get(array $data=[]){
        $id=$data['order_id'] ?? ($data['client_oid'] ?? '');
        unset($data['order_id']);
        unset($data['client_oid']);

        if(empty($id) && !isset($data['state'])) $data['state']=2;

        $this->type='GET';
        $this->path='/api/spot/v3/orders/'.$id;

        $this->data=$data;

        return $this->exec();
    }

    /**
     *POST /api/spot/v3/order_algo
     * */
    public function postOrderAlgo(array $data=[]){
        $this->type='POST';
        $this->path='/api/spot/v3/order_algo';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/spot/v3/cancel_batch_algos
     * */
    public function postCancelBatchAlgos(array $data=[]){
        $this->type='POST';
        $this->path='/api/spot/v3/cancel_batch_algos';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET/api/spot/v3/algo
     * */
    public function getAlgo(array $data=[]){
        $this->type='GET';
        $this->path='/api/spot/v3/algo';
        $this->data=$data;
        return $this->exec();
    }
}
