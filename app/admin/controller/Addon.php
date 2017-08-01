<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * 插件控制器
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
     * 执行插件控制器
     */
    public function execute($addon_name = null, $controller_name = null, $action_name = null)
    {
        
        $class_path = "\\".SYS_ADDON_DIR_NAME."\\".$addon_name."\controller\\".$controller_name;
        
        $controller = new $class_path();
        
        $controller->$action_name();
    }
    
    /**
     * 执行插件安装
     */
    public function addonInstall($name = null)
    {
        
        $strtolower_name = strtolower($name);

        $class_path = "\\".SYS_ADDON_DIR_NAME."\\".$strtolower_name."\\".$name;
        
        self::$addonLogic->executeSql($strtolower_name, 'install');
        
        $controller = new $class_path();
        
        list($status, $message) = $controller->addonInstall();
        
        $this->jump($status, $message);
    }
    
    /**
     * 执行插件卸载
     */
    public function addonUninstall($name = null)
    {
        
        $strtolower_name = strtolower($name);

        $class_path = "\\".SYS_ADDON_DIR_NAME."\\".$strtolower_name."\\".$name;
        
        self::$addonLogic->executeSql($strtolower_name, 'uninstall');
        
        $controller = new $class_path();
        
        list($status, $message) = $controller->addonUninstall();
        
        $this->jump($status, $message);
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
