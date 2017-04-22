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
        
        $this->addonTemplate('index/index');
    }
    
    /**
     * 插件安装
     */
    public function addonInstall()
    {
        
        return [RESULT_SUCCESS, '编辑器安装成功'];
    }
    
    /**
     * 插件卸载
     */
    public function addonUninstall()
    {
        
        return [RESULT_SUCCESS, '编辑器卸载成功'];
    }
    
    /**
     * 插件基本信息
     */
    public function addonInfo()
    {
        
        return ['name' => 'Imginput', 'title' => '图片上传', 'describe' => '图片上传插件，可支持拖动图片及批量上传', 'author' => 'Bigotry', 'version' => '1.0'];
    }
    
    /**
     * 插件配置信息
     */
    public function addonConfig()
    {
        
        return [];
    }
}
