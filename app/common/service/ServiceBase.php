<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service;

use app\common\model\ModelBase;

/**
 * 基础服务
 */
class ServiceBase extends ModelBase
{
    
    /**
     * 驱动配置信息
     */
    public function driverConfig($driver_name = '')
    {
        
        $driver_info = model('Driver')->getInfo(['driver_name' => $driver_name]);
        
        empty($driver_info) && die('未安装此驱动，请先安装');
        
        $driver_info_arr = $driver_info->toArray();
        
        return unserialize($driver_info_arr['config']);
    }
    
}
