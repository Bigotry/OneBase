<?php

/**
 * Admin基类
 */

namespace app\admin\controller;

use app\common\controller\CommonBase;

class AdminBase extends CommonBase
{
    
    //基类初始化
    public function _initialize()
    {
        
        //执行父类构造函数
        parent::_initialize();
        
        //会员ID
        defined('MEMBER_ID') or define('MEMBER_ID', is_login());

        //是否为超级管理员
        defined('IS_ROOT') or define('IS_ROOT', is_administrator());

        //实例化后台基础模型
        $admin_base_model = model('AdminBase');
        
        //后台初始化
        $menu = $admin_base_model->AdminInit();

        $after_operate = config('after_operate');
        
        empty($after_operate) || eval($after_operate);
        
        $this->assign('__menu__', $menu);
    }
}
