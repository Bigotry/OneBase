<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service\cache\driver;

use app\common\service\cache\Driver;
use app\common\service\Cache;

/**
 * 文件类型缓存类
 */
class File extends Cache implements Driver
{
    
    /**
     * 缓存基本信息
     */
    public function driverInfo()
    {
        
        return ['driver_name' => '文件缓存驱动', 'driver_class' => 'File', 'driver_describe' => '请确保服务器缓存目录有可写权限', 'author' => 'Bigotry', 'version' => '1.0'];
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
