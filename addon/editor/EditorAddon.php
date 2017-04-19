<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace addon\editor;

use app\common\controller\AddonBase;

use addon\AddonInterface;

/**
 * 富文本编辑器插件
 */
class EditorAddon extends AddonBase implements AddonInterface
{
    
    /**
     * 测试插件
     */
    public function ArticleEdit($param = [])
    {
        
        dump('testdddddddddd');
    }
    
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
