<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service;

/**
 * 支付服务
 */


/**
 * 支付服务使用示例代码
 * 
 * 
 *     $PayModel = model('Pay', 'service');
        
        $PayModel->setDriver('Alipay');
        
        $test_order['order_sn'] =  date('ymdhis', time()) . rand(10000, 99999);
        $test_order['body'] =  '测试';
        $test_order['order_amount'] =  0.01;
        
        echo $PayModel->pay($test_order);
 * 
 */

class Pay extends ServiceBase implements BaseInterface
{
    
    protected $driver = null;
    
    const NOTIFY_URL    = 'http://xxx/payment/notify';
    const CALLBACK_URL  = 'http://xxx/payment/notify';
    
    /**
     * 设置驱动
     */
    public function setDriver($driver_class = '')
    {
        
        $this->driver = model(ucfirst($driver_class), LAYER_SERVICE_NAME . '\\' . 'pay' . '\\' . 'driver');
    }
    
    /**
     * 服务基本信息
     */
    public function serviceInfo()
    {
        
        return ['service_name' => '支付服务', 'service_class' => 'Pay', 'service_describe' => '系统支付服务，用于整合多个支付平台', 'author' => 'Bigotry', 'version' => '1.0'];
    }
    
    /**
     * 驱动参数
     */
    public function driverParam()
    {
        
        return $this->driver->driverParam();
    }
    
    /**
     * 支付
     */
    public function pay($order)
    {
        
        return $this->driver->pay($order);
    }
    
    /**
     * 驱动配置信息
     */
    public function driverConfig($driver_name = '')
    {
        
        return parent::driverConfig($driver_name);
    }
}
