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
     * 测试事务控制
     */
    public function testTransaction()
    {
        
        $func1 = function()
                {
                    $this->modelMember->setFieldValue(['username' => 'demo'], 'nickname', 'demo_test');
                };
                
        $func2 = function()
                {
                    $a = 1/0;
                };
        
        closure_list_exe([$func1, $func2]);
    }
    
    /**
     * 测试支付服务
     */
    public function pay()
    {
        
        $this->servicePay->setDriver('Alipay');
        
        $test_order['order_sn'] =  date('ymdhis', time()) . rand(10000, 99999);
        $test_order['body'] =  '测试';
        $test_order['order_amount'] =  0.01;
        
        exit($this->servicePay->pay($test_order));
    }
    
    /**
     * 测试云存储服务
     */
    public function storage()
    {
        
        $this->serviceStorage->setDriver('Qiniu');
        
        return $this->serviceStorage->upload(130);
    }
    
    /**
     * 测试短信服务
     */
    public function sendSms()
    {
        
        $this->serviceSms->setDriver('Alidy');
        
        $parameter['sign_name']      = 'OneBase架构';
        $parameter['template_code']  = 'SMS_113455309';
        $parameter['phone_number']   = '18555550710';
        $parameter['template_param'] = ['code' => '123456'];
        
        return $this->serviceSms->sendSms($parameter);
    }
}
