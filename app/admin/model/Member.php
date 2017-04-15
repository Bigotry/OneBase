<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\model;

/**
 * 会员模型
 */
class Member extends AdminBase
{
    
    /**
     * 状态获取器
     */
    public function getStatusTextAttr()
    {
        
        $status = [-1 => '删除', 0 => '禁用', 1 => '启用'];
        
        return $status[$this->data['status']];
    }
    
    /**
     * 密码修改器
     */
    public function setPasswordAttr($value)
    {
        
        return data_md5($value, DATA_ENCRYPT_KEY);
    }
}
