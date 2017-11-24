<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

/**
 * 测试逻辑
 */
class Test extends AdminBase
{
    
    /**
     * 测试支付服务
     */
    public function pay()
    {
        
        $PayModel = model('Pay', 'service');
        
        $PayModel->setDriver('Alipay');
        
        $test_order['order_sn'] =  date('ymdhis', time()) . rand(10000, 99999);
        $test_order['body'] =  '测试';
        $test_order['order_amount'] =  0.01;
        
        exit($PayModel->pay($test_order));
    }
    
    /**
     * 测试云存储服务
     */
    public function storage()
    {
        
        $StorageModel = model('Storage', 'service');
        
        $StorageModel->setDriver('Qiniu');
        
        return $StorageModel->upload(130);
    }
    
    /**
     * 测试短信服务
     */
    public function sendSms()
    {
        
        $SmsModel = model('Sms', 'service');
        
        $SmsModel->setDriver('Alidy');
        
        $parameter['sign_name']     = 'OneBase架构';
        $parameter['template_code'] = 'SMS_113455309';
        $parameter['phone_number']  = '18555550710';
        $parameter['code']          = '123456';
        
        return $SmsModel->sendSms($parameter);
    }
}
