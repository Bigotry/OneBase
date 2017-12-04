<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\logic\Addon as LogicAddon;

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
        
        self::$addonLogic = get_sington_object('addonLogic', LogicAddon::class);
    }
    
    /**
     * 执行插件控制器
     */
    public function execute($addon_name = null, $controller_name = null, $action_name = null)
    {
        
        $class_path = SYS_DS_CONS . SYS_ADDON_DIR_NAME . SYS_DS_CONS . $addon_name . SYS_DS_CONS . LAYER_CONTROLLER_NAME . SYS_DS_CONS . $controller_name;
        
        $controller = new $class_path();
        
        $controller->$action_name();
    }
    
    /**
     * 执行插件安装
     */
    public function addonInstall($name = null)
    {
        
        $strtolower_name = strtolower($name);

        $class_path = SYS_DS_CONS . SYS_ADDON_DIR_NAME . SYS_DS_CONS . $strtolower_name . SYS_DS_CONS . $name;
        
        self::$addonLogic->executeSql($strtolower_name, 'install');
        
        $controller = new $class_path();
        
        action_log('安装', '插件安装，name：' . $strtolower_name);
        
        $this->jump($controller->addonInstall());
    }
    
    /**
     * 执行插件卸载
     */
    public function addonUninstall($name = null)
    {
        
        $strtolower_name = strtolower($name);

        $class_path = SYS_DS_CONS . SYS_ADDON_DIR_NAME . SYS_DS_CONS . $strtolower_name . SYS_DS_CONS . $name;
        
        self::$addonLogic->executeSql($strtolower_name, 'uninstall');
        
        $controller = new $class_path();
        
        action_log('卸载', '插件卸载，name：' . $strtolower_name);
        
        $this->jump($controller->addonUninstall());
    }
    
    /**
     * 插件列表
     */
    public function addonList()
    {
        
        $this->assign('list', self::$addonLogic->getAddonList());
        
        tag();
        
        return $this->fetch('addon_list');
    }
    
    /**
     * 钩子列表
     */
    public function hookList()
    {
        
        $this->assign('list', self::$addonLogic->getHookList());
        
        tag();
        
        return $this->fetch('hook_list');
    }
}
