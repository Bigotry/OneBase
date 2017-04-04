<?php

namespace app\admin\controller;

class Menu extends AdminBase
{
    
    public static $menuLogic = null;
    
    //基类初始化
    public function _initialize()
    {
        
        parent::_initialize();
        
        !isset(self::$menuLogic) && self::$menuLogic = load_model('Menu');
    }
    
    /**
     * 菜单列表
     */
    public function menuList()
    {
        
        $this->setTitle('菜单管理');
        
        $this->assign('list', self::$menuLogic->getMenuList());
        
        return $this->fetch('menu_list');
    }
    
    /**
     * 菜单添加
     */
    public function menuAdd()
    {
        
        $this->setTitle('菜单添加');
        
        IS_POST && $this->jump(self::$menuLogic->menuAdd($this->param));
        
        return  $this->fetch('menu_edit');
    }
    
    /**
     * 菜单编辑
     */
    public function menuEdit()
    {
        
        $this->setTitle('菜单编辑');
        
        IS_POST && $this->jump(self::$menuLogic->menuEdit($this->param));
        
        $info = self::$menuLogic->getMenuInfo(array('id' => $this->param['id']));
        
        $this->assign('info', $info);
        
        return $this->fetch('menu_edit');
    }
    
    /**
     * 菜单删除
     */
    public function menuDel($id = 0)
    {
        
        $this->jump(self::$menuLogic->menuDel(array('id' => $id)));
    }
}
