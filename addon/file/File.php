<?php

namespace addon\file;

use app\common\controller\AddonBase;

use addon\AddonInterface;

/**
 * 文件上传插件
 * @author     Jack YanTC <yanshixin.com>
 * @version    1.0
 */
class File extends AddonBase implements AddonInterface
{

    /**
     * 实现钩子
     * @param $param array
     */
    public function File($param = [])
    {

        $this->assign('addons_data', $param);

        $this->assign('addons_config', $this->addonConfig($param));

        $this->addonTemplate('index/' . $param['type']);
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

        return ['name' => 'File', 'title' => '文件上传', 'describe' => '文件上传插件', 'author' => 'Jack', 'version' => '1.0'];
    }

    /**
     * 插件配置信息
     * @param $param array
     * @return array
     */
    public function addonConfig($param)
    {

        $addons_config['maxwidth'] = '150px';

        $addons_config['allow_postfix'] = $param['type'] == 'img' ? '*.jpg; *.png; *.gif;' : '*.jpg; *.png; *.gif; *.zip; *.rar; *.tar; *.gz; *.7z; *.doc; *.docx; *.txt; *.xml; *.xlsx; *.xls;*.mp4;';

        $addons_config['max_size'] = 50 * 1024;

        return $addons_config;
    }
}
