<?php

namespace addon\editor;

use app\common\controller\AddonBase;

use addon\AddonInterface;

/**
 * 富文本编辑器插件
 * @author     Bigotry <3162875@qq.com>
 * @version    1.0
 */
class Editor extends AddonBase implements AddonInterface
{
    
    /**
     * 实现钩子
     * @param $param array
     */
    public function ArticleEditor($param = [])
    {
        
        $this->assign('addons_data', $param);
        
        $this->assign('addons_config', $this->addonConfig($param));
        
        $this->addonTemplate('index/index');
    }
    
    /**
     * 插件安装
     * @return array
     */
    public function addonInstall()
    {
        
        $this->addonCacheUpdate();
        
        return [RESULT_SUCCESS, '安装成功'];
    }
    
    /**
     * 插件卸载
     * @return array
     */
    public function addonUninstall()
    {
        
        $this->addonCacheUpdate();
        
        return [RESULT_SUCCESS, '卸载成功'];
    }
    
    /**
     * 插件基本信息
     * @return array
     */
    public function addonInfo()
    {
        
        return ['name' => 'Editor', 'title' => '文本编辑器', 'describe' => '富文本编辑器', 'author' => 'Bigotry', 'version' => '1.0'];
    }
    
    /**
     * 插件配置信息
     * @return array
     */
    public function addonConfig($param)
    {
        
        $addons_config['editor_height'] = '300px';
        $addons_config['editor_resize_type'] = 1;
        
        [$param];
        
        return $addons_config;
    }
}
