<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\api\controller;

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
        
        return $this->apiReturn($this->logicCommon->login($this->param));
    }
    
    /**
     * 修改密码接口
     */
    public function changePassword()
    {
        
        return $this->apiReturn($this->logicCommon->changePassword($this->param));
    }
    
    /**
     * 友情链接
     */
    public function getBlogrollList()
    {
        
        return $this->apiReturn($this->logicCommon->getBlogrollList($this->param));
    }
}
