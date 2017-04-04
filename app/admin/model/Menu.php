<?php

namespace app\admin\model;


/**
* 菜单模型
*/
class Menu extends AdminBase
{
    
    public function getStatusAttr($value)
    {
        
        $status = [-1=>'删除', 0=>'禁用',1=>'启用'];
        
        return $status[$value];
    }
    
    public function getIsHideAttr($value)
    {
        
        $is_hide = [0=>'否', 1=>'是'];
        
        return $is_hide[$value];
    }
}
