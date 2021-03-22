<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\AccountV3;

use Lin\Okex\Request;

class Account extends Request
{
    /**
     * GET /api/account/v3/uid
     * */
    public function getUid(array $data=[]){
        $this->type='GET';
        $this->path='/api/account/v3/uid';
        $this->data=$data;
        return $this->exec();
    }

    /**
     * POST/api/account/v3/purchase_redempt
     * */
    public function postPurchaseRedempt(array $data=[]){
        $this->type='POST';
        $this->path='/api/account/v3/purchase_redempt';
        $this->data=$data;
        return $this->exec();
    }
}
