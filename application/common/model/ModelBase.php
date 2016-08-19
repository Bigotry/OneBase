<?php

namespace app\common\model;

use think\Model;

/**
* 逻辑基础模型
*/
class ModelBase extends Model
{
    
    /**
    * 通用时间更新修改器
    */
    public function setUpdateTimeAttr()
    {
        
        return time();
    }
    
    public function __call($method, $args)
    {
        
        $logic_model = model($this->name, 'logic');
        
        return call_user_func_array(array($logic_model, $method), $args);
    }
    
}
