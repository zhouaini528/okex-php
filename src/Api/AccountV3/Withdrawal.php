<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\AccountV3;

use Lin\Okex\Request;

class Withdrawal extends Request
{
    /**
     * POST /api/account/v3/withdrawal
     *
     * currency	String	是	币种
        amount	String	是	数量
        destination	String	是	提币到(2:OKCoin国际 3:OKEx 4:数字货币地址)
        to_address	String	是	认证过的数字货币地址、邮箱或手机号。某些数字货币地址格式为:地址+标签，例："ARDOR-7JF3-8F2E-QUWZ-CAN7F：123456"
        trade_pwd	String	是	交易密码
        fee	String	是	网络手续费≥0.提币到OKCoin国际或OKEx免手续费，请设置为0.提币到数字货币地址所需网络手续费可通过提币手续费接口查询
     * */
    public function post(array $data=[]){
        $this->type='POST';
        $this->path='/api/account/v3/withdrawal';

        $this->data=$data;

        return $this->exec();
    }

    /**
     * GET /api/account/v3/withdrawal/fee
     * */
    public function getFee(array $data=[]){
        $this->type='GET';
        $this->path='/api/account/v3/withdrawal/fee';

        $this->data=$data;

        return $this->exec();
    }

    /**
     *GET /api/account/v3/withdrawal/history
     * */
    public function getHistoryAll(array $data=[]){
        $this->type='GET';
        $this->path='/api/account/v3/withdrawal/history';

        $this->data=$data;

        return $this->exec();
    }

    /**
     *GET /api/account/v3/withdrawal/history/<currency>
     * */
    public function getHistory(array $data=[]){
        $this->type='GET';
        $this->path='/api/account/v3/withdrawal/history/'.$data['currency'];

        $this->data=$data;

        return $this->exec();
    }
}
