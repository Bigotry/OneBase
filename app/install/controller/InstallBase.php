<?php

/**
 * Install基类
 */

namespace app\install\controller;

use think\Controller;

class InstallBase extends Controller
{
    
    //基类初始化
    public function _initialize()
    {
        
        parent::_initialize();
        
        file_exists(APP_PATH . 'database.php') && $this->error('OneBase已经成功安装，请勿重复安装!');
    }
    
}
