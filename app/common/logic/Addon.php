<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\logic;

/**
 * 插件逻辑
 */
class Addon extends LogicBase
{
    
    /**
     * 获取插件列表
     */
    public function getAddonList($where = [], $field = true, $order = '', $is_paginate = true)
    {
        
        $paginate_data = $is_paginate ? ['rows' => DB_LIST_ROWS] : false;
        
        return load_model($this->name)->getList($where, $field, $order, $paginate_data);
    }
    
    /**
     * 获取钩子列表
     */
    public function getHookList($where = [], $field = true, $order = '', $is_paginate = true)
    {
        
        $paginate_data = $is_paginate ? ['rows' => DB_LIST_ROWS] : false;
        
        return load_model('Hook')->getList($where, $field, $order, $paginate_data);
    }
}
