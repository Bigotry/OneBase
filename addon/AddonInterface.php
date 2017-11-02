<?php

namespace addon;

/**
 * 插件接口
 * @author     Bigotry <3162875@qq.com>
 * @version    1.0
 */
interface AddonInterface
{
    
    /**
     * 插件安装
     */
    public function addonInstall();
    
    /**
     * 插件卸载
     */
    public function addonUninstall();
    
    /**
     * 插件信息
     */
    public function addonInfo();
    
    /**
     * 插件配置信息
     */
    public function addonConfig($param);
}
