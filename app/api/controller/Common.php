<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\api\controller;

use app\api\logic\Common as logicCommon;

/**
 * 公共基础接口控制器
 */
class Common extends ApiBase
{
    
    /**
     * 登录接口
     */
    public function login()
    {
        
        return $this->apiReturn(logicCommon::login($this->param));
    }
    
    /**
     * 修改密码接口
     */
    public function changePassword()
    {
        
        return $this->apiReturn(logicCommon::changePassword($this->param));
    }
    
    /**
     * 友情链接接口
     */
    public function getBlogrollList()
    {
        
        return $this->apiReturn(logicCommon::getBlogrollList($this->param));
    }
}
