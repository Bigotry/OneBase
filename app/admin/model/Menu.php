<?php

namespace app\admin\model;


/**
* 菜单模型
*/
class Menu extends AdminBase
{
    
    public function getStatusTextAttr()
    {
        
        $status = [-1=>'删除', 0=>'禁用',1=>'启用'];
        
        return $status[$this->data['status']];
    }
    
    
    public function getIsHideTextAttr()
    {
        
        $is_hide = [0=>'否', 1=>'是'];
        
        return $is_hide[$this->data['is_hide']];
    }
}
