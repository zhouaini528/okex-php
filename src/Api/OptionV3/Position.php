<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\OptionV3;



use Lin\Okex\Request;

class Position extends Request
{
    /**
     * GET /api/option/v3/<underlying>/position
     * */
    public function get(array $data=[]){
        $this->type='GET';
        $this->path='/api/option/v3/'.$data['underlying'].'/position';

        $this->data=$data;

        return $this->exec();
    }
}
