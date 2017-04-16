<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service;

/**
 * 缓存服务
 */
class Cache extends ServiceBase implements BaseInterface
{
    
    /**
     * 服务基本信息
     */
    public function serviceInfo()
    {
        
        return ['service_name' => '缓存服务', 'service_class' => 'Cache', 'service_describe' => '系统缓存服务，用于整合多个缓存类型', 'author' => 'Bigotry', 'version' => '1.0'];
    }
    
    /**
     * 服务配置信息
     */
    public function serviceConfig()
    {
        
    }
}
