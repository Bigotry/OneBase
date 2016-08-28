<?php

namespace app\common\logic;

/**
* 会员模型
*/
class MemberInfo extends LogicBase
{
    
    //获取会员信息
    public function getMemberInfo($data = array(), $field = true)
    {
        
        return $this->getInfo($data, $field);
    }
    
    /**
     * 获取会员信息
     */
    public function getMemberInfoList($table = null, $join = array(), $field = true, $order = '', $data = array(), $listRows = 15, $simple = false, $config = array())
    {
        
        return $this->getListJoin($table, $join, $field, $order, $data, $listRows, $simple, $config);
    }
    
}