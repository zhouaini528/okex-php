<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\OptionV3;

use Lin\Okex\Request;

class Fills extends Request
{
    /**
     * GET /api/option/v3/fills/<underlying>
     * */
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/option/v3/fills/'.$data['underlying'];

        $this->data=$data;

        return $this->exec();
    }
}
