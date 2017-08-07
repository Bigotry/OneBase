<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\ControllerBase;
use app\admin\logic\Login as LogicLogin;

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
        
        self::$loginLogic = get_sington_object('loginLogic', LogicLogin::class);
    }
    
    /**
     * 登录
     */
    public function login()
    {
        
        is_login() && $this->jump(RESULT_REDIRECT, 'Index/index');
        
        // 关闭布局
        $this->view->engine->layout(false);
        
        return $this->fetch('login');
    }
    
    /**
     * 登录处理
     */
    public function loginHandle($username = '', $password = '', $verify = '')
    {
        
        $this->jump(self::$loginLogic->loginHandle($username, $password, $verify));
    }
    
    /**
     * 注销登录
     */
    public function logout()
    {
        
        $this->jump(self::$loginLogic->logout());
    }
    
    /**
     * 清理缓存
     */
    public function clearCache()
    {
        
        $this->jump(self::$loginLogic->clearCache());
    }
    
}
