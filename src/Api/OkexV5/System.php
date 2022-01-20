<?php
namespace Lin\Okex\Api\OkexV5;

use Lin\Okex\Request;

class System extends Request{

    /**
     * GET /api/v5/system/status
     * */
    public function getStatus(array $data=[]){
        $this->type='GET';
        $this->path='/api/v5/system/status';

        $this->data=$data;
        return $this->exec();
    }
}