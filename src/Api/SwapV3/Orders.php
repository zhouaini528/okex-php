<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\SwapV3;



use Lin\Okex\Request;

class Orders extends Request
{
    /*
     * POST /api/swap/v3/order
     * */
    public function post(array $data=[]){
        $this->type='POST';
        $this->path='/api/swap/v3/order';

        $this->data=$data;

        return $this->exec();
    }

    /*
     * POST /api/swap/v3/orders
     * */
    public function postBatch(array $data=[]){
        $this->type='POST';
        $this->path='/api/swap/v3/orders';

        $this->data=$data;

        return $this->exec();
    }

    /*
     * POST /api/swap/v3/cancel_order/<instrument_id>/<order_id> or <client_oid>
     * */
    public function postCancel(array $data=[]){
        $id=$data['order_id'] ?? $data['client_oid'];
        unset($data['order_id']);
        unset($data['client_oid']);

        $this->type='POST';
        $this->path='/api/swap/v3/cancel_order/'.$data['instrument_id'].'/'.$id;

        $this->data=$data;

        return $this->exec();
    }

    /*
     * POST /api/swap/v3/cancel_batch_orders/<instrument_id>
     * */
    public function postCancelBatch(array $data=[]){
        $this->type='POST';
        $this->path='/api/swap/v3/cancel_batch_orders/'.$data['instrument_id'];

        $this->data=$data;

        return $this->exec();
    }

    /*
     *POST/api/swap/v3/amend_order/<instrument_id>
     * */
    public function postAmend(array $data=[]){
        $this->type='POST';
        $this->path='/api/swap/v3/amend_order/'.$data['instrument_id'];

        $this->data=$data;

        return $this->exec();
    }

    /*
     *POST/api/swap/v3/amend_batch_orders/<instrument_id>
     * */
    public function postAmendBatch(array $data=[]){
        $this->type='POST';
        $this->path='/api/swap/v3/amend_batch_orders/'.$data['instrument_id'];

        $this->data=$data;

        return $this->exec();
    }

    /*
     * GET/api/swap/v3/orders/<instrument_id>
     * */
    public function getAll(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/orders/'.$data['instrument_id'];

        $this->data=$data;

        return $this->exec();
    }

    /*
     * GET/api/swap/v3/orders/<instrument_id>/<order_id>
     * GET/api/swap/v3/orders/<instrument_id>/<client_oid>
     * */
    public function get(array $data=[]){
        $id=$data['order_id'] ?? $data['client_oid'];
        unset($data['order_id']);
        unset($data['client_oid']);

        $this->type='GET';
        $this->path='/api/swap/v3/orders/'.$data['instrument_id'].'/'.$id;

        $this->data=$data;

        return $this->exec();
    }

    /**
     *POST /api/swap/v3/order_algo
     * */
    public function postOrderAlgo(array $data=[]){
        $this->type='POST';
        $this->path='/api/swap/v3/order_algo';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/swap/v3/cancel_algos
     * */
    public function postCancelAlgos(array $data=[]){
        $this->type='POST';
        $this->path='/api/swap/v3/cancel_algos';
        $this->data=$data;
        return $this->exec();
    }

    /**
     *GET/api/swap/v3/order_algo/<instrument_id>
     * */
    public function getOrderAlgo(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/order_algo/'.$data['instrument_id'];
        $this->data=$data;
        return $this->exec();
    }

    /**
     *POST /api/swap/v3/cancel_all
     * */
    public function postCancelAll(array $data=[]){
        $this->type='POST';
        $this->path='/api/swap/v3/cancel_all';
        $this->data=$data;
        return $this->exec();
    }
}
