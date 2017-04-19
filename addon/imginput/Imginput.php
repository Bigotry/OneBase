<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace addon\imginput;

use app\common\controller\AddonBase;

use addon\AddonInterface;

/**
 * 图片上传插件
 */
class Imginput extends AddonBase implements AddonInterface
{
    
    /**
     * 实现钩子
     */
    public function ImgUpload($param = [])
    {
        
        return $this->addonTemplate('index/index');
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
