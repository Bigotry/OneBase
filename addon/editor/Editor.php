<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\addon\editor;

use app\common\controller\Addon;

use app\addon\AddonInterface;

/**
 * 富文本编辑器插件
 */
class Editor extends Addon implements AddonInterface
{
    
    /**
     * 插件安装
     */
    public function addonInstall()
    {
        
        return [];
    }
    
    /**
     * 插件卸载
     */
    public function addonUninstall()
    {
        
        return [];
    }
    
    /**
     * 插件基本信息
     */
    public function addonInfo()
    {
        
        return [];
    }
    
    /**
     * 插件配置信息
     */
    public function addonConfig()
    {
        
        return [];
    }
}
