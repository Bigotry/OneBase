<?php

namespace app\admin\logic;

/**
* 权限模型
*/
class AuthRule extends AdminBase
{
    
    /**
    * 权限检测
    * @return boolean
    */
    public static function check($member_id = 0, $url = '')
    {

        $auth_rule_list = self::getAuthList($member_id);
        
        $auth_rule_url_list = array_extract($auth_rule_list, 'url');
        
        $url = strtolower($url);
        
        return in_array($url, $auth_rule_url_list) ? true : false;
    }
    
    
    /**
    * 获得权限列表
    * @return boolean
    */
    public static function getAuthList($member_id = 0)
    {

        //获取用户组列表
        $group_list = self::getGroupList($member_id);
        
        //用于保存权限节点id
        $rules_ids = array();
        
        foreach ($group_list as $group_info) {
            
            //合并多个分组的权限节点并去重
            $rules_ids = array_unique(array_merge($rules_ids, explode(',', trim($group_info['rules'], ','))));
        }
        
        //若没有权限节点则返回
        if (empty($rules_ids)) {
            
            return $rules_ids;
        }
        
        //查询条件
        $map = array('id'=>array('in',$rules_ids), 'status'=>1);
        
        //获取权限规则列表
        $rule_list = \think\Db::name('auth_rule')->where($map)->field('url,name')->select();
        
        return $rule_list;
    }
    
    /**
    * 获得用户组列表
    * @return boolean
    */
    public static function getGroupList($member_id = 0)
    {
        
        $list = \think\Db::name('auth_group_access')
                        ->alias('a')
                        ->join("auth_group g", "g.id = a.group_id")
                        ->where("a.member_id = $member_id and g.status = 1")
                        ->field('a.member_id,a.group_id,g.name,g.rules,g.status')
                        ->select();
        return $list;
    }
    
}
