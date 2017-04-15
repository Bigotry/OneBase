<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\ControllerBase;

/**
 * 登录控制器
 */
class Login extends ControllerBase
{
    
    // 登录逻辑
    private static $loginLogic = null;
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        // 执行父类构造方法
        parent::_initialize();
        
        !isset(self::$loginLogic) && self::$loginLogic = load_model('Login');
    }
    
    /**
     * 登录
     */
    public function login()
    {
        
        is_login() && $this->jump(RESULT_REDIRECT, '已经登录跳转主页', 'Index/index');
        
        // 关闭布局
        $this->view->engine->layout(false);
        
        return $this->fetch('login');
    }
    
    /**
     * 登录处理
     */
    public function loginHandle($username = '', $password = '', $verify = '')
    {
        
        list($status, $message, $url) = self::$loginLogic->loginHandle($username, $password, $verify);
        
        $this->jump($status, $message, $url);
    }
    
    /**
     * 注销登录
     */
    public function logout()
    {
        
        list($status, $message, $url) = self::$loginLogic->logout();
        
        $this->jump($status, $message, $url);
    }
    
}
