<?php

/**
 * Admin控制器基类
 */

namespace app\admin\controller;

use app\common\controller\ControllerBase;

class AdminBase extends ControllerBase
{
    
    protected $AdminBaseLogic = null;
    
    protected $MenuLogic      = null;
    
    //基类初始化
    public function _initialize()
    {
        
        //执行父类构造方法
        parent::_initialize();
        
        //会员ID
        defined('MEMBER_ID') or define('MEMBER_ID', is_login());
        
        //未登录则跳转登录
        !MEMBER_ID && $this->redirect('Login/login');
        
        //是否为超级管理员
        defined('IS_ROOT') or define('IS_ROOT', is_administrator());
        
        //实例化后台基础模型
        $this->AdminBaseLogic = load_model('AdminBase'); 
        
        //检查权限
        list($status, $message) = $this->AdminBaseLogic->checkAuth(URL_MODULE);
        
        //验证不通过则提示无权限访问
        RESULT_SUCCESS == $status ?: $this->jump($status, $message);
        
        //获取权限验证通过的菜单列表
        $menu_list = $this->AdminBaseLogic->getMenuList();
        
        //获取菜单逻辑模型
        $this->MenuLogic = load_model('Menu');
        
        //菜单转换为视图，支持无限级
        $menu_view = $this->MenuLogic->menuToView($menu_list);
        
        //菜单自动选择
        $menu_data = $this->MenuLogic->selectMenu($menu_view);
        
        //获取面包屑支持无限级
        $crumbs_view = $this->MenuLogic->getCrumbsView();
        
        $this->assign('menu_view', $menu_data);
        
        $this->assign('crumbs_view', $crumbs_view);
    }
    
    //设置页面标题及描述
    public function setTitle($title = '', $describe = '')
    {
        
        $this->assign('ob_title', $title);
        $this->assign('ob_describe', $describe);
    }
}
