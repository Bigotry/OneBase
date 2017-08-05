<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

/**
 * 测试逻辑
 */
class Test extends AdminBase
{
    
    /**
     * 测试逻辑默认方法
     */
    public function index()
    {
        
        $menu = model('menu');
        
        return $menu->getList();
    }
}
