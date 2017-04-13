<?php

namespace app\admin\logic;

/**
* 权限分组模型
*/
class AuthGroup extends AdminBase
{
    
    /**
     * 获取权限分组列表
     */
    public function getAuthGroupList($where = [], $field = true, $order = '', $paginate = 10)
    {
        
        return load_model($this->name)->getList($where, $field, $order, array('rows' => $paginate));
    }
    
    /**
     * 权限组添加
     */
    public function groupAdd($data = [])
    {
        
        $validate = validate($this->name);
        
        $validate_result = $validate->scene('add')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $validate->getError(), null];
        }
        
        $model = load_model($this->name);
        
        $url = url('groupList');
        
        return $model->setInfo($data) ? [RESULT_SUCCESS, '权限组添加成功', $url] : [RESULT_ERROR, $model->getError(), null];
    }
    
    /**
     * 权限组编辑
     */
    public function groupEdit($data = [])
    {
        
        $validate = validate($this->name);
        
        $validate_result = $validate->scene('edit')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $validate->getError(), null];
        }
        
        $model = load_model($this->name);
        
        $url = url('groupList');
        
        return $model->setInfo($data) ? [RESULT_SUCCESS, '权限组编辑成功', $url] : [RESULT_ERROR, $model->getError(), null];
    }
    
    //权限组删除
    public function groupDel($where = [])
    {
        
        $model = load_model($this->name);
        
        return $model->deleteInfo($where) ? [RESULT_SUCCESS, '权限组删除成功', null] : [RESULT_ERROR, $model->getError(), null];
    }
    
    //获取权限组信息
    public function getGroupInfo($where = [], $field = true)
    {
        
        return load_model($this->name)->getInfo($where, $field);
    }

    //设置用户组权限节点
    public function setGroupRules($data = [])
    {
        
        $data['rules'] = !empty($data['rules']) ? implode(',', array_unique($data['rules'])) : '';
        
        $model = load_model($this->name);

        $url = url('groupList');
        
        return $model->setInfo($data) ? [RESULT_SUCCESS, '权限设置成功', $url] : [RESULT_ERROR, $model->getError(), null];
    }
    

    //选择权限组
    public function selectAuthGroupList($group_list = [], $member_group_list = [])
    {
        
        $member_group_ids = array_extract($member_group_list, 'group_id');
        
        foreach ($group_list as &$info) {
            
            in_array($info['id'], $member_group_ids) ? $info['tag'] = 'active' :  $info['tag'] = '';
        }
            
        return $group_list;
    }
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //将会员添加到权限组
    public function setMemberToGroup($data = array())
    {
        
        if (empty($data['member_id']) || empty($data['group_id'])) {
            
            return createJump('error', '参数错误！');
        }
        
            
        if (is_administrator($data['member_id'])) {

            return createJump('error', '该用户为超级管理员！');
        }
            
        $member_info_model = model('MemberInfo');

        $member_info = $member_info_model->getMemberInfo($data['member_id']);
        
        if (!$member_info) {
            
            return createJump('error', '会员不存在！');
        }
        
        if (!$this->checkGroupId($data['group_id'])){
            
            return createJump('error', '请检查用户组是否存在！');
        }
        
        
        $auth_group_access_model = model('AuthGroupAccess');
        
        if (is_array($data['group_id'])) {
            
            $is_del = $auth_group_access_model->delAuthGroupAccessInfo(array('member_id' => array('in', $data['member_id'])));
        
            $add_all = array();
            
            foreach ($data['group_id'] as $v) {
                
                $access_data['member_id'] = $data['member_id'];
                $access_data['group_id'] = $v;
                $add_all[] = $access_data;
            }
            
            if ($is_del) {
                
                $auth_group_access_model->setAllAuthGroupAccess($add_all);
            }
            
        } else {
        
            $access_info = $auth_group_access_model->getAuthGroupAccessInfo(array('member_id' => $data['member_id'], 'group_id' => $data['group_id']));

            if ($access_info) {

                return createJump('error', '该会员已在权限组！');
            }
            
            $auth_group_access_model->setAuthGroupAccess(array('member_id' => $data['member_id'], 'group_id' => $data['group_id']));
        }
            
        return createJump('success', '操作成功！');
    }
    
    //删除会员授权
    public function delMemberAccess($data = array())
    {
        
        if (MEMBER_ID == $data['member_id']) {
            
            return createJump('error', '不允许解除自身授权！');
        }
        
        if (empty($data['member_id']) || empty($data['group_id'])) {
            
            return createJump('error', '参数错误！');
        }
        
        $auth_group_access_model = model('AuthGroupAccess');
        
        
        $res = $auth_group_access_model->delAuthGroupAccessInfo(array('member_id' => $data['member_id'], 'group_id' => $data['group_id']));
        
        if ($res) {
            
            return createJump('success', '操作成功！');
        } else {
            
            return createJump('error', '操作失败！');
        }
    }
    
    //获取会员添加到权限组所需数据
    public function getGroupData($member_id = 0)
    {
         
        $auth_groups = $this->getAuthGroupList(array(), true, '', false);
        
        $user_groups = $this->getMemberGroupInfo($member_id);
        
        $ids = array();
        
        foreach ($user_groups as $value) {
            
            $ids[] = $value['group_id'];
        }
        
        $member_info_model = model('MemberInfo');
        
        $member_info = $member_info_model->getMemberInfo($member_id);
        
        $nickname = $member_info['nickname'];
        
        return compact('auth_groups', 'user_groups', 'ids', 'nickname');
    }

    
    //获取会员授权所需数据
    public function getMemberAccessData($data = array())
    {
        
        if (empty($data['group_id'])) {
            
            return createJump('error', '参数错误！');
        }
        
        $auth_group_model = model('AuthGroup');
        
        $map['status'] = array('egt', 0);
        $map['module'] = 'admin';
        $map['type']   = $auth_group_model::TYPE_ADMIN;
        
        $auth_group = $this->getGroupFieldMulti($map, 'id, title, rules');
        
        $database_config = config('database');
        $prefix  = $database_config['prefix'];
        
        $member_info_model = model('MemberInfo');
 
        $Db = new \think\Db;
        $table = $Db::table($prefix.'member_info')->alias('m');

        $join = [
                    [$prefix.'auth_group_access a', 'm.member_id = a.member_id'],
                ];
        
        $list = $member_info_model->getMemberInfoList($table, $join, 'm.member_id, m.nickname', '', array('a.group_id' => $data['group_id']));
        
        return compact('auth_group', 'list');
    }
    
    public function getAccessData()
    {
        
        $auth_group_model = model('AuthGroup');
        
        $map['status'] = array('egt', 0);
        $map['module'] = 'admin';
        $map['type']   = $auth_group_model::TYPE_ADMIN;
        
        $auth_group = $this->getGroupFieldMulti($map, 'id, title, rules');
        
        $node_list  = $this->getReturnNodes();

        $auth_rule_model = model('AuthRule');
        
        $rule_map['status'] = array('gt', 0);
        $rule_map['module'] = 'admin';
        $rule_map['type']   = $auth_rule_model::RULE_MAIN;
        
        $main_rules = $auth_rule_model->getGroupFieldMulti($rule_map, 'name, id');

        $rule_map['type']   = $auth_rule_model::RULE_URL;
        
        $child_rules = $auth_rule_model->getGroupFieldMulti($rule_map, 'name, id');
        
        return compact('auth_group', 'node_list', 'main_rules', 'child_rules');
    }

    
    /**
     * 后台节点配置的url作为规则存入auth_rule
     * 执行新节点的插入,已有节点的更新,无效规则的删除三项任务
     */
    public function updateRules()
    {
        
        //需要新增的节点必然位于$nodes
        $nodes = $this->returnNodes(false);
        
        $auth_rule_model = model('AuthRule', 'logic');
        
        $map  = array('module'=>'admin', 'type'=>array('in', array(AuthRule::RULE_URL, AuthRule::RULE_MAIN)));//status全部取出,以进行更新
        
        //需要更新和删除的节点必然位于$rules
        $rules = $auth_rule_model->getList($map, true, 'name');
            
        //构建insert数据
        $data = array();//保存需要插入和更新的新节点
        
        foreach ($nodes as $value) {
            
            $temp['name']   = $value['url'];
            $temp['title']  = $value['title'];
            $temp['module'] = 'admin';
            
            if ($value['pid'] > 0) {
                
                $temp['type'] = AuthRule::RULE_URL;
            }else{
                
                $temp['type'] = AuthRule::RULE_MAIN;
            }
            
            $temp['status']   = 1;
            
            $data[strtolower($temp['name'].$temp['module'].$temp['type'])] = $temp;//去除重复项
        }

        $update = array();//保存需要更新的节点
        $ids    = array();//保存需要删除的节点的id
        
        foreach ($rules as $index => $rule) {
            
            $key = strtolower($rule['name'].$rule['module'].$rule['type']);
            
            //如果数据库中的规则与配置的节点匹配,说明是需要更新的节点
            if (isset($data[$key])) {
                
                //为需要更新的节点补充id值
                $data[$key]['id'] = $rule['id'];
                $update[] = $data[$key];
                
                unset($data[$key]);
                unset($rules[$index]);
                unset($rule['condition']);
                
                $diff[$rule['id']]=$rule;
            } elseif ($rule['status'] == 1) {
                
                $ids[] = $rule['id'];
            }
        }

        if (count($update)) {
            foreach ($update as $k => $row) {
                if ($row != $diff[$row['id']]) {
                    
                    $auth_rule_model->setInfo($row, array('id' => $row['id']));
                }
            }
        }
        
        if (count($ids)) {
            
            
            $update_map['id'] = array('in', $ids);
            
            $auth_rule_model->updateInfo(array('status' => -1), $update_map);
            //删除规则是否需要从每个用户组的访问授权表中移除该规则?
        }
        

        
        if (count($data)) {
            
            $auth_rule_model->setList(array_values($data));
        }
        
        if ($auth_rule_model->getError()) {
            
            trace('['.ACTION_NAME.']:'.$auth_rule_model->getError());
            
            return false;
        } else {
            
            return true;
        }
    }
}
