<?php

namespace app\admin\logic;

/**
* 权限规则模型
*/
class AuthRule extends AdminBase
{
    const RULE_URL  = 1;
    const RULE_MAIN = 2;
    
    
 
    public function getGroupFieldMulti($data = array(), $field = 'id', $key = '', $distinct = false)
    {
        
        return $this->getFieldMulti($data, $field, $key, $distinct);
    }
    
}
