<?php

namespace app\admin\model;

/**
* 权限分组模型
*/
class AuthGroup extends AdminBase
{
    

    public function getStatusTextAttr()
    {
        
        $status = [-1=>'删除', 0=>'禁用',1=>'启用'];
        
        return $status[$this->data['status']];
    }

}
