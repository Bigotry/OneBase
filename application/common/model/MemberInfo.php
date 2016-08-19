<?php

namespace app\common\model;

/**
 * 会员模型
 */
class MemberInfo extends ModelBase
{
    
    public function member()
    {
        
        return $this->belongsTo('Member');
    }
    
}
