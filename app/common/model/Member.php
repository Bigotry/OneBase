<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\model;

/**
 * 会员模型
 */
class Member extends ModelBase
{
    
    /**
     * 密码修改器
     */
    public function setPasswordAttr($value)
    {
        
        return data_md5($value, SYS_ENCRYPT_KEY);
    }
}
