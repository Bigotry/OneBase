<?php

namespace app\admin\validate;

/**
 * 会员验证器
 */
class Member extends AdminBase
{
    
    // 验证规则
    protected $rule =   [
        'username'  => 'require|unique:member',
        'password'  => 'require|confirm|length:6,20',
        'email'     => 'require|email|unique:member',
    ];
    
    // 验证提示
    protected $message  =   [
        'username.require'    => '用户名不能为空',
        'username.unique'     => '用户名已存在',
        'password.require'    => '密码不能为空',
        'password.confirm'    => '两次密码不一致',
        'password.length'     => '密码长度为6-20字符',
        'email.require'       => '邮箱不能为空',
        'email.email'         => '邮箱格式不正确',
        'email.unique'        => '邮箱已存在',
    ];

    // 应用场景
    protected $scene = [
        
        'add'  =>  ['username','password','email'],
    ];
    
}
