<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\Futures;



class Fills
{
    public function get(array $data){
        $this->type='GET';
        $this->path='';
        $this->data=$data;
        return $this->exec();
    }
}