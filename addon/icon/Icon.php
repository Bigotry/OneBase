<?php

namespace addon\icon;

use app\common\controller\AddonBase;

use addon\AddonInterface;

/**
 * 小图标选择插件
 * @author     Bigotry <3162875@qq.com>
 * @version    1.0
 */
class Icon extends AddonBase implements AddonInterface
{
    
    /**
     * 实现钩子
     * @param $param array
     */
    public function Icon($param = [])
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
        
        return ['name' => 'Icon', 'title' => '图标选择', 'describe' => '图标选择插件', 'author' => 'Bigotry', 'version' => '1.0'];
    }

    /**
     * 插件配置信息
     * @return array
     */
    public function addonConfig($param)
    {
        
        return $param;
    }
}
