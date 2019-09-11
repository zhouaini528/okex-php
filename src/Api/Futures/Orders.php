<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\Futures;



use Lin\Okex\Request;

class Orders extends Request
{
    /**
        OKEx token trading only supports limit and market orders (more order types will become available in the future). You can place an order only if you have enough funds.
        Once your order is placed, the amount will be put on hold.
        
        Parameters	Parameters Types	Required	Description
        client_oid	string	No	the order ID customized by yourself , The client_oid type should be comprised of alphabets + numbers or only alphabets within 1 – 32 characters， both uppercase and lowercase letters are supported
        instrument_id	String	Yes	Contract ID,e.g. “TC-USD-180213”
        type	String	Yes	1:open long 2:open short 3:close long 4:close short
        price	price	Yes	Price of each contract
        size	Number	Yes	The buying or selling quantity
        match_price	String	No	Order at best counter party price? (0:no 1:yes) the parameter is defaulted as 0. If it is set as 1, the price parameter will be ignored
        leverage	Number	Yes	10x or 20x leverage
        order_type	string	No	Fill in number for parameter，0: Normal limit order (Unfilled and 0 represent normal limit order) 1: Post only 2: Fill Or Kill 3: Immediatel Or Cancel
     * */
    public function post(array $data){
        $this->type='POST';
        $this->path='/api/futures/v3/order';
        
        $data['leverage']=$data['leverage']??10;
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    /**
     * POST /api/futures/v3/orders
     * */
    public function postBatch(array $data){
        $this->type='POST';
        $this->path='/api/futures/v3/orders';
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    /**
     * Cancelling an unfilled order.

        Parameters	Parameters Types	Required	Description
        order_id	String	Yes	Order ID
        instrument_id	String	Yes	Contract ID,e.g. “BTC-USD-180213”
        client_oid	string	Yes	the order ID created by yourself, The client_oid type should be comprised of alphabets + numbers or only alphabets within 1 – 32 characters， both uppercase and lowercase letters are supported

     * */
    public function postCancel(array $data){
        $id=$data['order_id'] ?? $data['client_oid'];
        unset($data['order_id']);
        unset($data['client_oid']);
        
        $this->type='POST';
        $this->path='/api/futures/v3/cancel_order/'.$data['instrument_id'].'/'.$id;
        $this->data=$data;
        return $this->exec();
    }
    
    /**
     * POST /api/futures/v3/cancel_batch_orders/<instrument_id>
     * */
    public function postCancelBatch(array $data){
        $this->type='POST';
        $this->path='/api/futures/v3/cancel_batch_orders/'.$data['instrument_id'];
        $this->data=$data;
        return $this->exec();
    }
    
    /**
     *GET /api/futures/v3/orders/<instrument_id>
     * */
    public function getAll(array $data){
        $this->type='GET';
        $this->path='/api/futures/v3/orders/'.$data['instrument_id'];
        $this->data=$data;
        return $this->exec();
    }
    
    /**
     * Get order details
     
        Parameters	Parameters Types	Required	Description
        order_id	String	Yes	Order ID
        instrument_id	String	Yes	Contract ID,e.g.“BTC-USD-180213”
        client_oid	string	Yes	The client_oid type should be comprised of alphabets + numbers or only alphabets within 1 – 32 characters， both uppercase and lowercase letters are supported

     * */
    public function get(array $data){
        $id=$data['order_id'] ?? $data['client_oid'];
        unset($data['order_id']);
        unset($data['client_oid']);
        
        $this->type='GET';
        $this->path='/api/futures/v3/orders/'.$data['instrument_id'].'/'.$id;
        
        $this->data=$data;
        
        return $this->exec();
    }
}