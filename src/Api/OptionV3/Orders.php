<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\OptionV3;



use Lin\Okex\Request;

class Orders extends Request
{
    /**
     * POST /api/option/v3/order
     * */
    public function post(array $data=[]){
        $this->type='POST';
        $this->path='/api/option/v3/order';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * POST /api/option/v3/orders
     * */
    public function postBatch(array $data=[]){
        $this->type='POST';
        $this->path='/api/option/v3/orders';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * POST /api/option/v3/cancel_order/<underlying>/<order_id or client_oid>
     * */
    public function postCancel(array $data=[]){
        $id=$data['order_id'] ?? $data['client_oid'];
        unset($data['order_id']);
        unset($data['client_oid']);

        $this->type='POST';
        $this->path='/api/option/v3/cancel_order/'.$data['underlying'].'/'.$id;

        $this->data=$data;

        return $this->exec();
    }

    /**
     * POST /api/option/v3/cancel_batch_orders/<underlying>
     * */
    public function postCancelBatch(array $data=[]){
        $this->type='POST';
        $this->path='/api/option/v3/cancel_batch_orders/'.$data['underlying'];

        $this->data=$data;

        return $this->exec();
    }

    /**
     *
     * POST /api/option/v3/amend_order/<underlying>
     * @param array $data
     * @return mixed*/
    public function postAmendOrder(array $data=[]){
        $this->type='POST';
        $this->path='/api/option/v3/amend_order/'.$data['underlying'];

        $this->data=$data;

        return $this->exec();
    }

    /**
     * POST /api/option/v3/amend_batch_orders/<underlying>
     * */
    public function postAmendBatchOrders(array $data=[]){
        $this->type='POST';
        $this->path='/api/option/v3/amend_batch_orders/'.$data['underlying'];

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/option/v3/orders/<underlying>/<order_id or client_oid>
     * */
    public function get(array $data=[]){
        $id=$data['order_id'] ?? $data['client_oid'];
        unset($data['order_id']);
        unset($data['client_oid']);

        $this->type='GET';
        $this->path='/api/option/v3/orders/'.$data['underlying'].'/'.$id;

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/option/v3/orders/<underlying>
     * */
    public function getAll(array $data=[]){
        $this->type='GET';
        $this->path='/api/option/v3/orders/'.$data['underlying'];

        $this->data=$data;

        return $this->exec();
    }
}
