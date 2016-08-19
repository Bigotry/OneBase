<?php

namespace app\common\model;

/**
 * 会员模型
 */
class Member extends ModelBase
{
    
    //新增自动完成
    protected $insert = ['create_ip', 'status'];
    
    //修改器
    protected function setCreateIpAttr()
    {
        
        $this->status = 1;
        $this->create_time = time();
        return get_client_ip(1);
    }
    
    //密码修改器
    public function setPasswordAttr($value)
    {
        
        return data_md5($value, DATA_ENCRYPT_KEY);
    }
    
    // 定义关联方法
    public function memberInfo()
    {
        
        return $this->hasOne('MemberInfo', 'member_id', 'id');
    }
    
}
