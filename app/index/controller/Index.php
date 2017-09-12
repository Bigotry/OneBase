<?php

namespace app\index\controller;

class Index extends IndexBase
{
    
    // 首页
    public function index()
    {
        
        empty(session('cid')) && session('cid', 0);
        
        !empty($this->param['cid']) && session('cid', $this->param['cid']);
        
        $this->assign('cid', session('cid'));
        
        return empty($this->param['act']) ? $this->fetch('index') : $this->fetch('details');
    }
    
    // 登录
    public function login()
    {
        
        return $this->fetch();
    }
    
    // 修改密码
    public function changePassword()
    {
        
        return $this->fetch('change_password');
    }
}
