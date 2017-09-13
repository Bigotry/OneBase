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
        
        return data_md5_key($value);
    }
    
    /**
     * 上级获取器
     */
    public function getLeaderNicknameAttr()
    {
        
        return model('Member')->getValue(['id' => $this->data['leader_id']], 'nickname', '无');
    }
}
