<?php

namespace app\admin\model;

/**
 * 会员模型
 */
class Member extends AdminBase
{
    
    public function getStatusTextAttr()
    {
        
        $status = [-1=>'删除', 0=>'禁用',1=>'启用'];
        
        return $status[$this->data['status']];
    }
    
    
    public function setPasswordAttr($value)
    {
        
        return data_md5($value, DATA_ENCRYPT_KEY);
    }
}
