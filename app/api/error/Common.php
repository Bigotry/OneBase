<?php

namespace app\api\error;

class Common
{
    
    public static $passwordError            = ['code' => 1010001, 'msg' => '登录密码错误'];
    public static $usernameOrPasswordEmpty  = ['code' => 1010002, 'msg' => '用户名或密码不能为空'];
    public static $registerFail             = ['code' => 1010003, 'msg' => '注册失败'];
    public static $oldOrNewPassword         = ['code' => 1010004, 'msg' => '旧密码或新密码不能为空'];
    public static $changePasswordFail       = ['code' => 1010005, 'msg' => '密码修改失败'];
}
