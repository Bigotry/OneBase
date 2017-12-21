<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\logic;

/**
 * 会员逻辑
 */
class Member extends LogicBase
{
    
    /**
     * 获取会员信息
     */
    public function getMemberInfo($where = [], $field = true)
    {
        
        return $this->modelMember->getInfo($where, $field);
    }
}
