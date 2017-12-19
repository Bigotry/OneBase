<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * 会员控制器
 */
class Member extends AdminBase
{

    /**
     * 会员授权
     */
    public function memberAuth()
    {
        
        IS_POST && $this->jump($this->request->logicMember->addToGroup($this->param));
        
        // 所有的权限组
        $group_list = $this->request->logicAuthGroup->getAuthGroupList(['member_id' => MEMBER_ID]);
        
        // 会员当前权限组
        $member_group_list = $this->authGroupAccessLogic->getMemberGroupInfo($this->param['id']);

        // 选择权限组
        $list = $this->request->logicAuthGroup->selectAuthGroupList($group_list, $member_group_list);
        
        $this->assign('list', $list);
        
        $this->assign('id', $this->param['id']);
        
        return $this->fetch('member_auth');
    }
    
    /**
     * 会员列表
     */
    public function memberList()
    {
        
        $where = $this->request->logicMember->getWhere($this->param);
        
        !empty($this->param['mark']) && $this->request->logicMember->exportMemberList($where, true, 'id desc');
        
        $this->assign('list', $this->request->logicMember->getMemberList($where, true, 'id desc'));
        
        return $this->fetch('member_list');
    }
    
    /**
     * 会员添加
     */
    public function memberAdd()
    {
        
        IS_POST && $this->jump($this->request->logicMember->memberAdd($this->param));
        
        return $this->fetch('member_edit');
    }
    
    /**
     * 会员删除
     */
    public function memberDel($id = 0)
    {
        
        return $this->jump($this->request->logicMember->memberDel(['id' => $id]));
    }
}
