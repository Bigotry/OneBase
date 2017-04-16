<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service\storage\driver;

use app\common\service\storage\Driver;
use app\common\service\Storage;

/**
 * 七牛云
 */
class Qiniu extends Storage implements Driver
{
    
    /**
     * 驱动基本信息
     */
    public function driverInfo()
    {
        
        return ['driver_name' => '七牛云驱动', 'driver_class' => 'Qiniu', 'driver_describe' => '七牛云存储', 'author' => 'Bigotry', 'version' => '1.0'];
    }
    
    /**
     * 获取配置信息
     */
    public function driverConfig()
    {
        
    }
    
}
