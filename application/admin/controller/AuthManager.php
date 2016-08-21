<?php

namespace app\admin\controller;

use think\Db;
use app\admin\model\AuthRule;
use app\admin\model\AuthGroup;

class AuthManager extends AdminBase
{
    
    public $model;
    
    //基类初始化
    public function _initialize()
    {
        
        parent::_initialize();
        
        $this->model =  model('AuthGroup');
    }
    
    
    //权限管理
    public function index()
    {
        
        $condition['status'] = 1;
        $condition['module'] = 'admin';
        
        $list = $this->model->getAuthGroupList($condition);
        
        $this->assign('list', $list);
        
        $this->assign('meta_title', '权限管理');
        
        return $this->fetch();
    }
    
    
    //编辑权限组
    public function editGroup($id = 0)
    {
        
        $this->model->editGroup($this->param);
        
        $this->assign('meta_title', '编辑权限组');
        
        $group_info = $this->model->getGroupInfo($id);

        $this->assign('info', $group_info);
        
        return $this->fetch('edit_group');
    }
    
    
    /**
     * 访问授权页面
     */
    public function access()
    {

        //更新权限节点
        $this->model->updateRules();

        $map['status'] = array('egt', 0);
        $map['module'] = 'admin';
        $map['type']   = AuthGroup::TYPE_ADMIN;
        
        $auth_group = $this->model->getGroupFieldMulti($map, 'id, title, rules');
        
        
        $node_list  = $this->model->getReturnNodes();
        
        
        dump($node_list);
        die;
        
        
        $auth_rule_model = model('AuthRule');
        
        $main_rules = $auth_rule_model->where('status', 'gt', 0)->where('module', 'admin')->where('type', AuthRule::RULE_MAIN)->column('name, id');
        
        $child_rules = $auth_rule_model->where('status', 'gt', 0)->where('module', 'admin')->where('type', AuthRule::RULE_URL)->column('name, id');

        $this->assign('main_rules', $main_rules);
        $this->assign('auth_rules', $child_rules);
        $this->assign('node_list',  $node_list);
        $this->assign('auth_group', $auth_group);
        $this->assign('this_group', $auth_group[(int)$this->param['group_id']]);
        $this->assign('group_id',   $this->param['group_id']);
        $this->assign('group_name', $this->param['group_name']);
        $this->assign('meta_title', '访问授权');
        
        // 渲染模板输出
        return $this->fetch('manager_group');
    }
    
    /**
     * 写入用户组权限
     */
    public function writeGroup()
    {
        
        if (isset($this->param['rules'])) {
            
            sort($this->param['rules']);
            $this->param['rules']  = implode(',', array_unique($this->param['rules']));
        } else {
            $this->param['rules'] = '';
        }
        
        $this->param['module'] =  'admin';
        $this->param['type']   =  AuthGroup::TYPE_ADMIN;
        
        $auth_group_model = model('AuthGroup');

        if (!empty($this->param['id'])) {

            $res = $auth_group_model->allowField(true)->save($this->param, array('id' => $this->param['id']));
        } else {

            $res = $auth_group_model->allowField(true)->save($this->param);
        }

        if ($res) {

            $this->success('操作成功!', url('index'));
        } else {

            $this->error('操作失败!');
        }
        
    }
    
    
    
    /**
     * 用户组授权用户列表
     */
    public function user($group_id)
    {
        if (empty($group_id)) {
            
            $this->error('参数错误');
        }

        $auth_group_model = model('AuthGroup');
        
        $auth_group = $auth_group_model->where('status', 'egt', 0)->where('module', 'admin')->where('type', AuthGroup::TYPE_ADMIN)->column('id, title, rules');
        
        $database_config = config('database');
        
        $prefix  = $database_config['prefix'];
        
        
        $list   = Db::table($prefix.'member')
                ->alias('m')
                ->join($prefix.'auth_group_access a', 'm.uid = a.uid')
                ->field('m.uid, m.nickname, m.last_login_time, m.last_login_ip, m.status')
                ->where(array('group_id' => $group_id))
                ->paginate(10);
        
        $this->assign('list', $list);
        $this->assign('auth_group', $auth_group);
        $this->assign('this_group', $auth_group[(int)$this->param['group_id']]);
        $this->assign('group_id',   $this->param['group_id']);
        $this->assign('group_name', $this->param['group_name']);
        $this->assign('meta_title', '成员授权');
        
        return $this->fetch();
    }
    
    
    /**
     * 将用户从用户组中移除  入参:uid,group_id
     */
    public function removeGroupUser()
    {
        
        if (UID == $this->param['uid']) {
            
            $this->error('不允许解除自身授权');
        }
        
        if (empty($this->param['uid']) || empty($this->param['group_id'])) {
            
            $this->error('参数错误');
        }
        
        
        $auth_group_model = model('AuthGroup');
        
        if ($auth_group_model->removeGroupUser($this->param['uid'], $this->param['group_id'])) {
            
            $this->success('操作成功');
        }else{
            
            $this->error('操作失败');
        }
    }
    
    
    
    
    /**
     * 将用户添加到用户组,入参uid,group_id
     */
    public function addToGroup()
    {
        
        if (empty($this->param['uid']) || empty($this->param['group_id'])) {
            
            $this->error('参数错误');
        }
        
        $auth_group_model = model('AuthGroup');
        
        if (is_numeric($this->param['uid'])) {
            
            if (is_administrator($this->param['uid'])) {
                
                $this->error('该用户为超级管理员');
            }
            
            $member_model = model('Member');
            
            if (!$member_model->get($this->param['uid'])) {
                $this->error('用户不存在');
            }
        }

        
        if ($this->param['group_id'] && !$auth_group_model->checkGroupId($this->param['group_id'])){
            
            $this->error('请检查用户组是否存在');
        }
        
        if ($auth_group_model->addToGroup($this->param['uid'], $this->param['group_id'])) {
            
            $this->success('操作成功');
        } else {
            
            $this->error('操作失败');
        }
    }
    
    
    
    
    /**
     * 将用户添加到用户组的编辑页面
     */
    public function group()
    {
        
        $auth_group_model = model('AuthGroup');
        
        $auth_groups    =   $auth_group_model->getGroups();
        $user_groups    =   $auth_group_model::getUserGroup($this->param['uid']);
        
        $ids = array();
        
        foreach ($user_groups as $value) {
            
            $ids[] = $value['group_id'];
        }
        
        $nickname = db('member')->where('uid', $this->param['uid'])->value('nickname');
        
        $this->assign('nickname', $nickname);
        $this->assign('auth_groups', $auth_groups);
        $this->assign('user_groups', implode(',',$ids));
        $this->assign('meta_title', '用户组授权');
        $this->assign('uid', $this->param['uid']);
        
        return $this->fetch();
    }
    
    


}
