<?php

namespace app\admin\model;

/**
* 权限分组模型
*/
class AuthGroup extends AdminModelBase
{
    const TYPE_ADMIN = 1;  // 管理员用户组类型标识
    const AUTH_GROUP_ACCESS = 'auth_group_access'; // 关系表表名
    const AUTH_GROUP        = 'auth_group';        // 用户组表名
    //
    // 修改器
    public function setTitleAttr($value)
    {
        
        $this->data['module'] = 'admin';
        $this->data['type']   = AuthGroup::TYPE_ADMIN;
        
        return $value;
    }
    
    
    
    /**
     * 检查id是否全部存在
     * @param array|string $gid  用户组id列表
     */
    public function checkGroupId($gid)
    {
        if (is_array($gid)) {
            
            $ids   = implode(',', $gid);
        } else {
            
            $ids   = explode(',', $gid);
        }
        
        $count = count($gid);
        
        $s = $this->where('id', 'in', $ids)->column('id');
        
        if (count($s) === $count) {
            
            return true;
        }
        
        return false;
    }
    
    
    /**
     * 把用户添加到用户组,支持批量添加用户到用户组
     */
    public function addToGroup($uid, $gid)
    {
        
        $access_model = db(self::AUTH_GROUP_ACCESS);
        
        if (is_array($gid)) {
            
            if (empty($gid)) {

                return false;
            }
            
            $is_del = $access_model->where(array('uid' => array('in', $uid)))->delete();
            
            $add_all = array();
            foreach ($gid as $v) {
                
                $data['uid'] = $uid;
                $data['group_id'] = $v;
                $add_all[] = $data;
            }
            
            if ($is_del) {
                
                $is_del =  $access_model->insertAll($add_all);
            }
            
            return $is_del;
            
        } else {
        
            $access_info = $access_model->where('uid', $uid)->where('group_id', $gid)->find();

            if ($access_info) {

                return false;
            }
            
            return $access_model->insert(array('uid' => $uid, 'group_id' => $gid));
        }
    }
    
    
    /**
     * 将用户从用户组中移除
     */
    public function removeGroupUser($uid, $gid)
    {
        
        $access_model = db(self::AUTH_GROUP_ACCESS);
        
        return $access_model->where('uid', $uid)->where('group_id', $gid)->delete();
    }
    
    /**
     * 返回用户组列表
     * 默认返回正常状态的管理员用户组列表
     * @param array $where   查询条件,供where()方法使用
     */
    public function getGroups($where = array())
    {
        
        $map = array('status'=>1,'type'=>self::TYPE_ADMIN,'module'=>'admin');
        
        return $this->where(array_merge($map, $where))->select();
    }
    
    
    /**
     * 返回用户所属用户组信息
     * @param  int    $uid 用户id
     * @return array  用户所属的用户组 array(
     *                                         array('uid'=>'用户id','group_id'=>'用户组id','title'=>'用户组名称','rules'=>'用户组拥有的规则id,多个,号隔开'),
     *                                         ...)
     */
    static public function getUserGroup($uid)
    {
        static $groups = array();
        
        if (isset($groups[$uid])) {
            
            dump($groups[$uid]);
            return $groups[$uid];
        }
        
        $database_config = config('database');
        
        $prefix  = $database_config['prefix'];
        
        $auth_group_model = model('AuthGroup');
        
        $list   = $auth_group_model->table($prefix.self::AUTH_GROUP_ACCESS)
                ->alias('a')
                ->join($prefix.self::AUTH_GROUP.' g', 'a.group_id = g.id')
                ->field('a.uid, a.group_id, g.title, g.description, g.rules')
                ->where(array('a.uid' => $uid, 'g.status' => 1))
                ->select();
        
        $groups[$uid] = $list ? $list : array();
        
        return $groups[$uid];
    }

}
