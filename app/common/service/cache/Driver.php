<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service\cache;

use app\common\service\BaseInterface;

/**
 * 缓存服务驱动
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
    
    /**
     * 写入缓存
     */
    public function cacheSet($name, $value, $expire = null);
    
    /**
     * 读取缓存
     */
    public function cacheGet($name, $default = false);
    
    /**
     * 清除缓存
     */
    public function cacheClear($tag = null);
    
    /**
     * 删除缓存
     */
    public function cacheRm($name);
    
    /**
     * 判断缓存是否存在
     */
    public function cacheHas($name);
}
