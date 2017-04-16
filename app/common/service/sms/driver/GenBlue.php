<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service\sms\driver;

use app\common\service\sms\Driver;
use app\common\service\Sms;

/**
 * 创蓝短信平台
 */
class GenBlue extends Sms implements Driver
{
    
    /**
     * 创蓝基本信息
     */
    public function driverInfo()
    {
        
        return ['driver_name' => '创蓝短信驱动', 'driver_class' => 'GenBlue', 'driver_describe' => '创蓝短信平台', 'author' => 'Bigotry', 'version' => '1.0'];
    }
    
    /**
     * 获取配置信息
     */
    public function driverConfig()
    {
        
    }
    
    /**
     * 发送短信
     */
    public function send()
    {
        
    }
    
}
