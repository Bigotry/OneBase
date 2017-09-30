<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace addon\imgs;

use app\common\controller\AddonBase;

use addon\AddonInterface;

/**
 * 多图上传插件
 */
class Imgs extends AddonBase implements AddonInterface
{
    
    /**
     * 实现钩子
     */
    public function Imgs($param = [])
    {
     
        $this->assign('addons_data', $param);
        
        $this->assign('addons_config', $this->addonConfig($param));
        
        $this->addonTemplate('index/index');
    }
    
    /**
     * 插件安装
     */
    public function addonInstall()
    {
        
        $this->addonCacheUpdate();
        
        return [RESULT_SUCCESS, '安装成功'];
    }
    
    /**
     * 插件卸载
     */
    public function addonUninstall()
    {
        
        $this->addonCacheUpdate();
        
        return [RESULT_SUCCESS, '卸载成功'];
    }
    
    /**
     * 插件基本信息
     */
    public function addonInfo()
    {
        
        return ['name' => 'Imgs', 'title' => '多图上传', 'describe' => '多图上传插件', 'author' => 'Bigotry', 'version' => '1.0'];
    }
    
    /**
     * 插件配置信息
     */
    public function addonConfig($param)
    {
        
        $addons_config['maxwidth']      = '150px';
        
        $addons_config['allow_postfix'] = '*.jpg; *.png; *.gif;';
        
        [$param];
        
        return $addons_config;
    }
}