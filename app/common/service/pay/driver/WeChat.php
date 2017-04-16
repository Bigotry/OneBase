<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service\pay\driver;

use app\common\service\pay\Driver;
use app\common\service\Pay;

/**
 * 微信支付
 */
class WeChat extends Pay implements Driver
{
    
    /**
     * 微信支付基本信息
     */
    public function driverInfo()
    {
        
        return ['driver_name' => '微信支付驱动', 'driver_class' => 'WeChat', 'driver_describe' => '微信支付', 'author' => 'Bigotry', 'version' => '1.0'];
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
