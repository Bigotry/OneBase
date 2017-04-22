<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\ControllerBase;

/**
 * Admin控制器基类
 */
class AdminBase extends ControllerBase
{
    
    // 后台基础逻辑
    protected $adminBaseLogic       = null;
    
    // 菜单逻辑
    protected $menuLogic            = null;
    
    // 授权逻辑
    protected $authGroupAccessLogic = null;
    
    // 授权过的菜单列表
    protected $authMenuList         = [];
    
    // 授权过的菜单url列表
    protected $authMenuUrlList      = [];
    
    // 授权过的菜单树
    protected $authMenuTree         = [];
    
    // 菜单视图
    protected $menuView             = '';
    
    // 面包屑视图
    protected $crumbsView           = '';
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        
        // 执行父类构造方法
        parent::_initialize();
        
        // 初始化后台模块常量
        $this->initAdminConst();
        
        // 初始化后台模块信息
        $this->initAdminInfo();
    }
    
    /**
     * 初始化后台模块信息
     */
    final private function initAdminInfo()
    {
        
        // 验证登录
        !MEMBER_ID && $this->redirect('Login/login');
        
        // 实例化后台逻辑
        $this->adminBaseLogic = load_model('AdminBase'); 
        
        // 实例化菜单逻辑
        $this->menuLogic = load_model('Menu');
        
        // 实例化授权逻辑
        $this->authGroupAccessLogic = load_model('AuthGroupAccess');
        
        // 获取授权菜单列表
        $this->authMenuList = $this->authGroupAccessLogic->getAuthMenuList(MEMBER_ID);
        
        // 获得权限菜单URL列表
        $this->authMenuUrlList = $this->authGroupAccessLogic->getAuthMenuUrlList($this->authMenuList);
        
        // 检查菜单权限
        list($status, $message) = $this->adminBaseLogic->authCheck(URL_MODULE, $this->authMenuUrlList);
        
        // 权限验证不通过则跳转提示
        RESULT_SUCCESS == $status ?: $this->jump($status, $message);
        
        // 获取过滤后的菜单树
        $this->authMenuTree = $this->adminBaseLogic->getMenuTree($this->authMenuList, $this->authMenuUrlList);
       
        // 菜单转换为视图
        $this->menuView = $this->menuLogic->menuToView($this->authMenuTree);
        
        // 菜单自动选择
        $this->menuView = $this->menuLogic->selectMenu($this->menuView);
        
        // 获取面包屑
        $this->crumbsView = $this->menuLogic->getCrumbsView();
        
        // 菜单视图
        $this->assign('menu_view', $this->menuView);
        
        // 面包屑视图
        $this->assign('crumbs_view', $this->crumbsView);
    }
    
    /**
     * 初始化后台模块常量
     */
    final private function initAdminConst()
    {
        
        // 会员ID
        defined('MEMBER_ID') or define('MEMBER_ID', is_login());
        
        // 是否为超级管理员
        defined('IS_ROOT') or define('IS_ROOT', is_administrator());
    }
    
    /**
     * 设置页面标题及描述
     */
    final protected function setTitle($title = '', $describe = '')
    {
        
        $this->assign('ob_title', $title);
        
        $this->assign('ob_describe', $describe);
    }
}
