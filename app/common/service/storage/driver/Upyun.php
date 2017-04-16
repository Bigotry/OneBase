<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service\storage\driver;

use app\common\service\storage\Driver;
use app\common\service\Storage;

/**
 * 又拍云
 */
class Upyun extends Storage implements Driver
{
    
    /**
     * 驱动基本信息
     */
    public function driverInfo()
    {
        
        return ['driver_name' => '又拍云驱动', 'driver_class' => 'Upyun', 'driver_describe' => '又拍云存储', 'author' => 'Bigotry', 'version' => '1.0'];
    }
    
    /**
     * 获取配置信息
     */
    public function driverConfig()
    {
        
    }
    
}
