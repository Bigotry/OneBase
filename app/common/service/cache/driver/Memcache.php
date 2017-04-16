<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service\cache\driver;

use app\common\service\cache\Driver;
use app\common\service\Cache;

/**
 * Memcache类型缓存类
 */
class Memcache extends Cache implements Driver
{
    
    /**
     * 缓存基本信息
     */
    public function cacheInfo()
    {
        
        return ['cache_type' => 'Memcache', 'cache_describe' => 'Memcache缓存，请确保服务器装有Memcache服务', 'author' => 'Bigotry'];
    }
    
    /**
     * 获取配置信息
     */
    public function cacheConfig()
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
