<?php

/**
 * Install基类
 */

namespace app\install\controller;

use app\common\controller\CommonBase;

class InstallBase extends CommonBase
{
    //基类初始化
    public function _initialize()
    {
        parent::_initialize();
        
        $is_exist_file = is_file(ROOT_PATH.'/data/install.lock');
        
        //已经安装过 执行更新程序
        if ($is_exist_file) {
           $this->error('已经成功安装OneBase，请不要重复安装!');
        }
    }
    
}
