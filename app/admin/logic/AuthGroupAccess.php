<?php

namespace app\admin\logic;

/**
* 会员授权逻辑模型
*/
class AuthGroupAccess extends AdminBase
{
    
    //删除
    public function delAuthGroupAccessInfo($data = array())
    {
        
        return $this->deleteInfo($data);
    }
    
    //单条保存
    public function setAuthGroupAccess($data = array(), $where = array(), $getId = true, $replace = false)
    {
        
        return $this->save($data, $where, $getId, $replace);
    }
    
    //批量保存
    public function setAllAuthGroupAccess($data = array(), $replace = false)
    {
        
        return $this->saveAll($data, $replace);
    }
    
    //获取信息
    public function getAuthGroupAccessInfo($data = array(), $field = true)
    {
        
        return $this->getInfo($data, $field);
    }
    
    
    //返回会员所属权限组信息
    public function getMemberGroupInfo($member_id = 0)
    {
        
        $model = load_model($this->name);
        
        $model->alias('a');

        $where['a.member_id'] = $member_id;
        
        $field = 'a.member_id, a.group_id, g.name, g.describe, g.rules';
        
        $join = [
                    [DB_PREFIX.'auth_group g', 'a.group_id = g.id'],
                ];
        
        return $model->getList($where, $field, '', null, array('join' => $join));
    }
    
    
    
}
