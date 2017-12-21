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
        
        // 获取首页数据
        $index_data = $this->logicAdminBase->getIndexData();
        
        $this->assign('info', $index_data);
        
        return $this->fetch('index');
    }
}
