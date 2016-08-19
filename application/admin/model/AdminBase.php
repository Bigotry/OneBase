<?php

namespace app\admin\model;

use think\Model;

/**
* admin模型基类
*/
class AdminBase extends Model
{
    
    final public function AdminInit()
    {
        
        return parent::AdminInit();
    }
    
    final public function getMenus()
    {
        
        return parent::getMenus();
    }
    
    
    public function __call($method, $args)
    {

        $logic_model = model($this->name, 'logic');
        
        return call_user_func_array(array($logic_model, $method), $args);
    }
    
    
}
