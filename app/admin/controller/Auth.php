<?php

namespace app\admin\controller;

class Auth extends AdminBase
{
    
    public static $authGroupLogic = null;
    
    //基类初始化
    public function _initialize()
    {
        
        parent::_initialize();
        
        !isset(self::$authGroupLogic) && self::$authGroupLogic = load_model('AuthGroup');
    }
    
    /**
     * 权限组列表
     */
    public function groupList()
    {
        
        $this->setTitle('权限管理');
        
        $this->assign('list', self::$authGroupLogic->getAuthGroupList());
        
        return $this->fetch('group_list');
    }
    
    /**
     * 权限组添加
     */
    public function groupAdd()
    {
        
        $this->setTitle('权限组添加');
        
        IS_POST && $this->jump(self::$authGroupLogic->groupAdd($this->param));
        
        return  $this->fetch('group_edit');
    }
    
    /**
     * 权限组编辑
     */
    public function groupEdit()
    {
        
        $this->setTitle('权限组编辑');
        
        IS_POST && $this->jump(self::$authGroupLogic->groupEdit($this->param));
        
        $info = self::$authGroupLogic->getGroupInfo(array('id' => $this->param['id']));
        
        $this->assign('info', $info);
        
        return $this->fetch('group_edit');
    }
    
    /**
     * 权限组删除
     */
    public function groupDel($id = 0)
    {
        
        $this->jump(self::$authGroupLogic->groupDel(array('id' => $id)));
    }
    
    /**
     * 菜单授权
     */
    public function menuAuth()
    {
        
        $AdminBaseLogic = load_model('AdminBase');
        
        //获取权限验证通过的菜单列表
        $list = $AdminBaseLogic->getMenuList();
        
        //获取菜单逻辑模型
        $MenuLogic = load_model('Menu');
        
        //菜单转换为节点视图，支持无限级
        $menu_view = $MenuLogic->menuToNode($list);
        
        //节点自动选择
//        $menu_data = $MenuLogic->selectMenu($menu_view);
        
        $this->assign('list', $menu_view);
        
        return $this->fetch('menu_auth');
    }
}
