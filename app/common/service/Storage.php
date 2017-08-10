<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service;

/**
 * 云存储服务
 */
class Storage extends ServiceBase implements BaseInterface
{
    
    /**
     * 服务基本信息
     */
    public function serviceInfo()
    {
        
        return ['service_name' => '云存储服务', 'service_class' => 'Storage', 'service_describe' => '系统云存储服务，用于整合多个云储存平台', 'author' => 'Bigotry', 'version' => '1.0'];
    }
    
    /**
     * 驱动参数
     */
    public function driverParam($driver_class = '')
    {
        
        $model = model(ucfirst($driver_class), LAYER_SERVICE_NAME . DS . 'storage' . DS . 'driver');
        
        return $model->driverParam();
    }
    
    /**
     * 驱动配置信息
     */
    public function driverConfig($driver_name = '')
    {
        
        return parent::driverConfig($driver_name);
    }
}
