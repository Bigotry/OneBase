<?php

namespace app\admin\controller;

use app\common\controller\ControllerBase;

class Login extends ControllerBase
{
    
    private static $loginLogic = null;
    
    //基类初始化
    public function _initialize()
    {
        
        !isset(self::$loginLogic) && self::$loginLogic = load_model('Login');
    }
    
    /**
     * 后台用户登录
     */
    public function login()
    {
        
        is_login() && $this->jump(RESULT_REDIRECT, '已经登录跳转主页', 'Index/index');
        
        //关闭布局
        $this->view->engine->layout(false);
        
        return $this->fetch('login');
    }
    
    /**
     * 后台用户登录处理
     */
    public function loginHandle($username = '', $password = '', $verify = '')
    {
        
        list($status, $message, $url) = self::$loginLogic->loginHandle($username, $password, $verify);
        
        $this->jump($status, $message, $url);
    }
    
    /**
     * 注销当前用户
     */
    public function logout()
    {
        
        list($status, $message, $url) = self::$loginLogic->logout();
        
        $this->jump($status, $message, $url);
    }
    
}
