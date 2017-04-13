<?php

namespace app\admin\controller;

class Member extends AdminBase
{
    
    public static $memberLogic = null;
    
    //基类初始化
    public function _initialize()
    {
        
        parent::_initialize();
        
        !isset(self::$memberLogic) && self::$memberLogic = load_model('Member');
    }

    /**
     * 会员授权
     */
    public function memberAuth()
    {
        
        IS_POST && $this->jump(self::$memberLogic->addToGroup($this->param));
        
        $this->setTitle('会员授权');
        
        $AuthGroupLogic = load_model('AuthGroup');
        
        $AuthGroupAccessLogic = load_model('AuthGroupAccess');
        
        //所有的权限组
        $group_list = $AuthGroupLogic->getAuthGroupList(array(), true, '', false);
        
        //会员当前权限组
        $member_group_list = $AuthGroupAccessLogic->getMemberGroupInfo($this->param['id']);
        
        //选择权限组
        $list = $AuthGroupLogic->selectAuthGroupList($group_list, $member_group_list);
        
        $this->assign('list', $list);
        
        $this->assign('id', $this->param['id']);
        
        return $this->fetch('member_auth');
    }
    
    /**
     * 会员列表
     */
    public function memberList()
    {
        
        $this->setTitle('会员列表');
        
        $this->assign('list', self::$memberLogic->getMemberList());
        
        return $this->fetch('member_list');
    }
    
    /**
     * 会员添加
     */
    public function memberAdd()
    {
        
        $this->setTitle('会员添加');
        
        IS_POST && $this->jump(self::$memberLogic->memberAdd($this->param));
        
        return  $this->fetch('member_edit');
    }
    
    /**
     * 会员删除
     */
    public function memberDel($id = 0)
    {
        
        $this->jump(self::$memberLogic->memberDel(array('id' => $id)));
    }
}
