<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\Swap;



use Lin\Okex\Request;

class Orders extends Request
{
    public function post(array $data=[]){
        $this->type='POST';
        $this->path='/api/swap/v3/order';
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function postBatch(array $data=[]){
        $this->type='POST';
        $this->path='/api/swap/v3/orders';
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function postCancel(array $data=[]){
        $id=$data['order_id'] ?? $data['client_oid'];
        unset($data['order_id']);
        unset($data['client_oid']);
        
        $this->type='POST';
        $this->path='/api/swap/v3/cancel_order/'.$data['instrument_id'].'/'.$id;
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function postCancelBatch(array $data=[]){
        $this->type='POST';
        $this->path='/api/swap/v3/cancel_batch_orders/'.$data['instrument_id'];
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function getAll(array $data=[]){
        $this->type='GET';
        $this->path='/api/swap/v3/orders/'.$data['instrument_id'];
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function get(array $data=[]){
        $id=$data['order_id'] ?? $data['client_oid'];
        unset($data['order_id']);
        unset($data['client_oid']);
        
        $this->type='GET';
        $this->path='/api/swap/v3/orders/'.$data['instrument_id'].'/'.$id;
        
        $this->data=$data;
        
        return $this->exec();
    }
}