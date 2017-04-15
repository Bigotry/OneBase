<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * 首页控制器
 */
class Index extends AdminBase
{
    
    /**
     * 首页方法
     */
    public function index()
    {
        
        $this->setTitle('首页');
        
        return $this->fetch('index');
    }
}
