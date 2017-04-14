<?php

namespace app\admin\logic;

/**
* 会员授权逻辑模型
*/
class AuthGroupAccess extends AdminBase
{
    
    /**
    * 获得权限菜单列表
    * @return boolean
    */
    public function getAuthList($member_id = 0)
    {
        
        //获取用户组列表
        $group_list = $this->getMemberGroupInfo($member_id);
        
        $menu_ids = array();
        
        foreach ($group_list as $group_info) {
            
            //合并多个分组的权限节点并去重
            !empty($group_info['rules']) && $menu_ids = array_unique(array_merge($menu_ids, explode(',', trim($group_info['rules'], ','))));
        }
        
        //若没有权限节点则返回
        if (empty($menu_ids)) {
            
            return $menu_ids;
        }
        
        //查询条件
        $where = ['id' => ['in', $menu_ids]];
        
        $model = model('Menu', 'logic');
        
        $menu_list = $model->getMenuList($where, true, '', false);
        
        $auth_list = [];
        
        foreach ($menu_list as $info) {
            
            $auth_list[] = $info['module'].'/'.$info['url'];
        }

        return $auth_list;
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
