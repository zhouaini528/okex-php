<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\Spot;



use Lin\Okex\Request;

class Accounts extends Request
{
    public function getAll(array $data=[]){
        $this->type='GET';
        $this->path='/api/spot/v3/accounts';
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/spot/v3/accounts/'.$data['currency'];
        unset($data['currency']);
        
        $this->data=$data;
        
        return $this->exec();
    }
    
    public function getLedger(){
        
    }
}