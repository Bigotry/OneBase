<?php

namespace app\api\error;

class CodeBase
{
    
    public static $success              = ['code' => 0,         'msg' => '操作成功'];
    
    public static $accessTokenError     = ['code' => 1000001,   'msg' => '访问Toekn错误'];
    
    public static $userTokenError       = ['code' => 1000002,   'msg' => '用户Toekn错误'];
    
    public static $apiUrlError          = ['code' => 1000003,   'msg' => '接口路径错误'];
    
}
