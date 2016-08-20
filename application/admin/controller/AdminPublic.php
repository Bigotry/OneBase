<?php

namespace app\admin\controller;

use app\common\controller\CommonBase;

class AdminPublic extends CommonBase
{
    
    public $model;
    
    //基类初始化
    public function _initialize()
    {
        
        parent::_initialize();
        
        $this->model =  model('Member');
    }
    
    /**
     * 后台用户登录
     */
    public function login($username = '', $password = '', $verify = '')
    {
        
        $this->model->login($username, $password, $verify);
        
        return $this->fetch('public/login');
    }
    
    /* 退出登录 */
    public function logout()
    {
        
        $this->model->logout();
    }
    
    /**
     * 验证码
     */
    public function verify($id = 1, $length = 5)
    {
        
        $verify = new \org\Verify(array('length'=>$length));
        $verify->entry($id);
    }
    
}
