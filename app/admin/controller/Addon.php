<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * 插件站控制器
 */
class Addon extends AdminBase
{
    
    // 插件逻辑
    private static $addonLogic = null;
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        
        parent::_initialize();
        
        !isset(self::$addonLogic) && self::$addonLogic = load_model('Addon');
    }
    
    /**
     * 插件列表
     */
    public function addonList()
    {
        
        $this->setTitle('插件列表');
        
        $this->assign('list', self::$addonLogic->getAddonList());
        
        return $this->fetch('addon_list');
    }
    
    /**
     * 钩子列表
     */
    public function hookList()
    {
        
        $this->setTitle('钩子列表');
        
        $this->assign('list', self::$addonLogic->getHookList());
        
        return $this->fetch('hook_list');
    }
}
