<?php

namespace app\admin\controller;

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

        //获取授权所需数据
        $data = $this->model->getAccessData();
        
        $this->assign('main_rules', $data['main_rules']);
        $this->assign('auth_rules', $data['child_rules']);
        $this->assign('node_list',  $data['node_list']);
        $this->assign('auth_group', $data['auth_group']);
        $this->assign('this_group', $data['auth_group'][(int)$this->param['group_id']]);
        $this->assign('group_id',   $this->param['group_id']);
        $this->assign('group_name', $this->param['group_name']);
        $this->assign('meta_title', '访问授权');
        
        return $this->fetch('manager_group');
    }
    
    /**
     * 写入用户组权限
     */
    public function setGroupRules()
    {
        
        //设置用户组权限节点
        $this->model->setGroupRules($this->param);
    }
    
    /**
     * 会员授权
     */
    public function memberAccess()
    {
        
        //获取会员授权所需数据
        $data = $this->model->getMemberAccessData($this->param);
  
        $this->assign('list', $data['list']);
        $this->assign('auth_group', $data['auth_group']);
        $this->assign('this_group', $data['auth_group'][(int)$this->param['group_id']]);
        $this->assign('group_id',   $this->param['group_id']);
        $this->assign('group_name', $this->param['group_name']);
        $this->assign('meta_title', '成员授权');
        
        return $this->fetch('member_access');
    }
    
    /**
     * 将用户从用户组中移除  入参:member_id,group_id
     */
    public function delMemberAccess()
    {
        
        $this->model->delMemberAccess($this->param);
    }
    
    /**
     * 将会员添加到权限组,入参member_id,group_id
     */
    public function setMemberToGroup()
    {
        
        $this->model->setMemberToGroup($this->param);
    }
    
    /**
     * 将会员添加到权限组
     */
    public function group()
    {
        
        $data = $this->model->getGroupData($this->param);
        
        $this->assign('nickname', $data['nickname']);
        $this->assign('auth_groups', $data['auth_groups']);
        $this->assign('user_groups', implode(',', $data['ids']));
        $this->assign('meta_title', '用户组授权');
        $this->assign('member_id', $this->param['member_id']);
        
        return $this->fetch();
    }
}
