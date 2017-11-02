<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\install\controller;

use think\Controller;

/**
 * Install基类
 */
class InstallBase extends Controller
{
    
    //基类初始化
    public function _initialize()
    {
        
        parent::_initialize();
        
        file_exists(APP_PATH . 'database.php') && $this->error('OneBase已经成功安装，请勿重复安装!');
    }
    
}
