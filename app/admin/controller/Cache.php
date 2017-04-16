<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * 缓存控制器
 */
class Cache extends AdminBase
{
    
    // 缓存逻辑
    private static $cacheLogic = null;
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        
        parent::_initialize();
        
        !isset(self::$cacheLogic) && self::$cacheLogic = load_model('Cache');
    }
    
    /**
     * 缓存列表
     */
    public function cacheList()
    {
        
        $this->setTitle('缓存驱动列表');
        
        $this->assign('list', self::$cacheLogic->getCacheList());
        
        return $this->fetch('cache_list');
    }
}
