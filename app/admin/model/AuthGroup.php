<?php

namespace app\admin\model;

/**
* 权限分组模型
*/
class AuthGroup extends AdminBase
{
    
    const TYPE_ADMIN = 1;  // 管理员用户组类型标识
    const AUTH_GROUP_ACCESS = 'auth_group_access'; // 关系表表名
    const AUTH_GROUP        = 'auth_group';        // 用户组表名

    
// 修改器
    public function setTitleAttr($value)
    {
        
        $this->data['module'] = 'admin';
        $this->data['type']   = AuthGroup::TYPE_ADMIN;
        
        return $value;
    }

}
