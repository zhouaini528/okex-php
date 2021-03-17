<?php
/**
 * @author lin <465382251@qq.com>
 * */

namespace Lin\Okex\Api\AccountV3;

use Lin\Okex\Request;

class Transfer extends Request
{
    /**
     * POST /api/account/v3/transfer
     *
     * currency	String	是	币种，如eos
        amount	String	是	划转数量
        from	String	是	转出账户(0:子账户 1:币币 3:合约 4:C2C 5:币币杠杆 6:资金账户 8:余币宝 9 永续合约)
        to	String	是	转入账户(0:子账户 1:币币 3:合约 4:C2C 5:币币杠杆 6:资金账户 8:余币宝 9 永续合约)
        sub_account	String	否	子账号登录名，from或to指定为0时，sub_account为必填项，
        instrument_id	String	否	杠杆转出币对，如：eos-usdt，仅限已开通杠杆的币对
        to_instrument_id	String	否	杠杆转入币对，如：eos-btc，仅限已开通杠杆的币对
     * */
    public function post(array $data=[]){
        $this->type='POST';
        $this->path='/api/account/v3/transfer';

        $this->data=$data;

        return $this->exec();
    }
}
