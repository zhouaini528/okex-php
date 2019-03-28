<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\Spot;

use Lin\Okex\Request;

class Orders extends Request
{
    /**
    Parameters	Parameters Types	Required	Description
    client_oid	string	No	the order ID customized by yourself , The client_oid type should be comprised of alphabets + numbers or only alphabets within 1 – 32 characters， both uppercase and lowercase letters are supported
    type	string	No	limit / market(default: limit)
    side	string	Yes	buy or sell
    instrument_id	string	Yes	trading pair
    margin_trading	byte	Yes	order type (The request value is 1)
    order_type	string	No	Fill in number for parameter，0: Normal limit order (Unfilled and 0 represent normal limit order) 1: Post only 2: Fill Or Kill 3: Immediatel Or Cancel
    *
    Parameters	Parameters Types	Required	Description
    price	string	Yes	price
    size	string	Yes	quantity bought or sold
    *
    Market Order Parameters
    Parameters	Parameters Types	Required	Description
    size	string	Yes	quantity sold. (for orders sold at market price only)
    notional	string	Yes	amount bought. (for orders bought at market price only)
    */
    public function post(array $data){
        $this->type='POST';
        $this->path='/api/spot/v3/orders';
        
        $data['margin_trading']=1;
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function postBatch(){
        
    }
    
    /**
     * Cancelling an unfilled order.
     * 
        Parameters	Parameters Types	Required	Description
        instrument_id	string	Yes	By providing this parameter, the corresponding order of a designated trading pair will be cancelled. If not providing this parameter, it will be back to error code.
        client_oid	string	Yes	the order ID created by yourself, The client_oid type should be comprised of alphabets + numbers or only alphabets within 1 – 32 characters， both uppercase and lowercase letters are supported
        order_id	string	Yes	order ID
     * */
    public function postCancel(array $data){
        $id=$data['order_id'] ?? $data['client_oid'];
        unset($data['order_id']);
        unset($data['client_oid']);
        
        $this->type='POST';
        $this->path='/api/spot/v3/cancel_orders/'.$id;
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function postCancelBatch(){
        
    }
    
    public function getAll(){
        
    }
    
    public function getPending(){
        
    }
    
    /**
     * Get order details by order ID.
     * 
        Parameters	Parameters Types	Description
        instrument_id	string	[required]trading pair
        order_id	string	[ required] order ID
        client_oid	string	[ required ] The client_oid type should be comprised of alphabets + numbers or only alphabets within 1 – 32 characters， both uppercase and lowercase letters are supported
     * */
    public function get(array $data){
        $id=$data['order_id'] ?? $data['client_oid'];
        unset($data['order_id']);
        unset($data['client_oid']);
        
        $this->type='GET';
        $this->path='/api/spot/v3/orders/'.$id;
        
        $this->data=$data;
        
        return $this->exec();
    }
}