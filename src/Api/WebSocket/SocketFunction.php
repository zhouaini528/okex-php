<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\WebSocket;


trait SocketFunction
{
    //对数据轮询 获取当前数据的订阅ID
    protected function getInstrumentId(array $array){
        if(isset($array['currency'])) return $array['currency'];
        if(isset($array['instrument_id'])) return $array['instrument_id'];

        foreach ($array as $v){
            if(is_array($v)) {
                $rlt=$this->getInstrumentId($v);
                if(!empty($rlt)) return $rlt;
            }
        }

        return ;
    }

    /**
     * 标记订阅的频道是否需要有登陆的KEY
     */
    protected function resub(array $sub=[]){
        $new_sub=[];
        $temp1=['account','position','order'];
        foreach ($sub as $v) {
            $temp2=[$v];
            foreach ($temp1 as $tv){
                if(strpos($v, $tv) !== false){
                    array_push($temp2,$this->keysecret);
                }
            }
            array_push($new_sub,$temp2);
        }

        return $new_sub;
    }

    /**
     * @param $global
     * @param $tag
     * @param $data
     * @param string $keysecret
     */
    protected function errorMessage($global,$tag,$data,$keysecret=''){
        $all_sub=$global->get('all_sub');

        if($tag=='public') {
            //查询 message 是否包含了关键词。并把错误信息写入频道记录
            foreach ($all_sub as $k=>$v){
                $sub=strtolower($v);
                if(stristr(strtolower($data['message']),$v)!==false) $global->add($sub,$data);
            }
        }else{
            foreach ($all_sub as $k=>$v){
                if(count($v)==1) continue;
                $sub=strtolower($v[0]);
                if(stristr(strtolower($data['message']),$v)!==false) $global->add($keysecret['key'].$sub,$data);
            }
        }
    }
}
