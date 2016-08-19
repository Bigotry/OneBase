<?php

namespace app\admin\logic;

/**
* 菜单模型
*/
class Menu extends AdminBase
{
    
    public function getMenuList($data = array(), $field = true, $order = '')
    {
        
        return $this->getList($data, $field, $order);
    }

    public function getMenuInfo($data = array(), $field = true)
    {
        
        return $this->getInfo($data, $field);
    }
    
    public function getFieldSingleMenu($data = array(), $field = 'id', $default = null)
    {
        
        return $this->getFieldSingle($data, $field, $default);
    }
    
    public function getFieldMultiMenu($data = array(), $field = 'id', $key = '', $distinct = false)
    {
        
        return $this->getFieldMulti($data, $field, $key, $distinct);
    }
}
