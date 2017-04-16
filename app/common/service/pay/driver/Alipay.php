<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service\pay\driver;

use app\common\service\pay\Driver;
use app\common\service\Pay;

/**
 * 支付宝
 */
class Alipay extends Pay implements Driver
{
    
    /**
     * 支付宝基本信息
     */
    public function driverInfo()
    {
        
        return ['driver_name' => '支付宝驱动', 'driver_class' => 'Alipay', 'driver_describe' => '支付宝支付', 'author' => 'Bigotry', 'version' => '1.0'];
    }
    
    /**
     * 获取配置信息
     */
    public function driverConfig()
    {
        
    }
    
    /**
     * 支付回调
     */
    public function callback()
    {
        
    }
    
}
