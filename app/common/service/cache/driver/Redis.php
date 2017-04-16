<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service\cache\driver;

use app\common\service\cache\Driver;
use app\common\service\Cache;

/**
 * Redis类型缓存类
 */
class Redis extends Cache implements Driver
{
    
    /**
     * 缓存基本信息
     */
    public function driverInfo()
    {
        
        return ['driver_name' => 'Redis缓存驱动', 'driver_class' => 'Redis', 'driver_describe' => '请确保服务器装有Redis服务', 'author' => 'Bigotry', 'version' => '1.0'];
    }
    
    /**
     * 获取配置信息
     */
    public function driverConfig()
    {
        
    }
    
    /**
     * 写入缓存
     */
    public function cacheSet($name, $value, $expire = null)
    {
        
    }
    
    /**
     * 读取缓存
     */
    public function cacheGet($name, $default = false)
    {
        
    }
    
    /**
     * 清除缓存
     */
    public function cacheClear($tag = null)
    {
        
    }
    
    /**
     * 删除缓存
     */
    public function cacheRm($name)
    {
        
    }
    
    /**
     * 判断缓存是否存在
     */
    public function cacheHas($name)
    {
        
    }
    
}
