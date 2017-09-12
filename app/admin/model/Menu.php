<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\model;

/**
 * 菜单模型
 */
class Menu extends AdminBase
{
    
    /**
     * 隐藏状态获取器
     */
    public function getIsHideTextAttr()
    {
        
        $is_hide = [DATA_DISABLE => '否', DATA_NORMAL => '是'];
        
        return $is_hide[$this->data['is_hide']];
    }
}
