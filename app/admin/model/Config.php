<?php

namespace app\admin\model;


/**
* 配置模型
*/
class Config extends AdminBase
{
    
    public function getStatusTextAttr()
    {
        
        $status = [-1=>'删除', 0=>'禁用',1=>'启用'];
        
        return $status[$this->data['status']];
    }
    

}
