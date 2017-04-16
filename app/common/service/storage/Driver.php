<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service\storage;

use app\common\service\BaseInterface;

/**
 * 云存储服务驱动
 */
interface Driver extends BaseInterface
{
    
    /**
     * 获取基本信息
     */
    public function driverInfo();
    
    /**
     * 获取配置信息
     */
    public function driverConfig();
    
}
