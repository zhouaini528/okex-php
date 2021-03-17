<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\MarginV3;



use Lin\Okex\Request;

class Orders extends Request
{
    /**
     * POST /api/margin/v3/orders
     * */
    public function post(array $data=[]){
        $this->type='POST';
        $this->path='/api/margin/v3/orders';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * POST /api/margin/v3/batch_orders
     * */
    public function postBatch(array $data=[]){
        $this->type='POST';
        $this->path='/api/margin/v3/batch_orders';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * POST /api/margin/v3/cancel_orders/<order_id>
     * POST /api/margin/v3/cancel_orders/<client_oid>
     * */
    public function postCancel(array $data=[]){
        $id=$data['order_id'] ?? $data['client_oid'];
        unset($data['order_id']);
        unset($data['client_oid']);

        $this->type='POST';
        $this->path='/api/margin/v3/cancel_orders/'.$id;

        $this->data=$data;

        return $this->exec();
    }

    /**
     * POST /api/margin/v3/cancel_batch_orders
     * */
    public function postCancelBatch(array $data=[]){
        $this->type='POST';
        $this->path='/api/margin/v3/cancel_batch_orders/';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/margin/v3/orders
     * */
    public function getAll(array $data=[]){
        $this->type='GET';
        $this->path='/api/margin/v3/orders';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/margin/v3/orders/<order_id>
     * GET /api/margin/v3/orders/<client_oid>
     * */
    public function get(array $data=[]){
        $id=$data['order_id'] ?? $data['client_oid'];
        unset($data['order_id']);
        unset($data['client_oid']);

        $this->type='GET';
        $this->path='/api/margin/v3/orders/'.$id;

        $this->data=$data;

        return $this->exec();
    }

    /**
    * GET /api/margin/v3/orders_pending
    * */
    public function getPending(array $data=[]){
        $this->type='GET';
        $this->path=' /api/margin/v3/orders_pending';

        $this->data=$data;

        return $this->exec();
    }
}
