<?php
// +----------------------------------------------------------------------
// | Author: Jack YanTC <yanshixin.com>
// +----------------------------------------------------------------------

namespace addon\file;

use app\common\controller\AddonBase;

use addon\AddonInterface;

/**
 * 文件上传插件
 */
class File extends AddonBase implements AddonInterface {

    /**
     * 实现钩子
     */
    public function File($param = []) {

        $this->assign('addons_data', $param);

        $this->assign('addons_config', $this->addonConfig($param));

        $this->addonTemplate('index/' . $param['type']);
    }

    /**
     * 插件安装
     */
    public function addonInstall() {

        $this->addonCacheUpdate();

        return [RESULT_SUCCESS, '安装成功'];
    }

    /**
     * 插件卸载
     */
    public function addonUninstall() {

        $this->addonCacheUpdate();

        return [RESULT_SUCCESS, '卸载成功'];
    }

    /**
     * 插件基本信息
     */
    public function addonInfo() {

        return ['name' => 'File', 'title' => '文件上传', 'describe' => '文件上传插件', 'author' => 'Jack', 'version' => '1.0'];
    }

    /**
     * 插件配置信息
     */
    public function addonConfig($param) {

        $addons_config['maxwidth'] = '150px';

        $addons_config['allow_postfix'] = $param['type'] == 'img' ? '*.jpg; *.png; *.gif;' : '*.jpg; *.png; *.gif; *.zip; *.rar; *.tar; *.gz; *.7z; *.doc; *.docx; *.txt; *.xml; *.xlsx; *.xls;*.mp4;';

        $addons_config['max_size'] = 50 * 1024;

        return $addons_config;
    }
}
