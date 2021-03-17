<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\SpotV3;



use Lin\Okex\Request;

class Accounts extends Request
{
    public function getAll(array $data=[]){
        $this->type='GET';
        $this->path='/api/spot/v3/accounts';
        $this->data=$data;

        return $this->exec();
    }

    /**
     'currency'=>'BTC',   required
     * */
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/spot/v3/accounts/'.$data['currency'];
        unset($data['currency']);

        $this->data=$data;

        return $this->exec();
    }

    /**
     *  'currency'=>'BTC',   required
     *  'limit'=>2,             optional
     *  'form'                    optional
     *  'to'                        optional
     * */
    public function getLedger(array $data=[]){
        $this->type='GET';
        $this->path='/api/spot/v3/accounts/'.$data['currency'].'/ledger';
        unset($data['currency']);

        $this->data=$data;

        return $this->exec();
    }

}
