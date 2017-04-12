<?php

namespace app\admin\logic;

use app\common\logic\LogicBase;
use app\admin\logic\AuthRule;

/**
* admin模型逻辑基类
*/
class AdminBase extends LogicBase
{

    //检查权限
    public function checkAuth()
    {
        
        $request = request();
        
        // 检测系统权限
        if (!IS_ROOT && !AuthRule::check(MEMBER_ID, $request->module().'/'.$request->controller().'/'.$request->action())) {
                
            return [RESULT_ERROR, '访问未授权'];
        }
        
        return [RESULT_SUCCESS, '权限验证通过'];
    }
    

    
    //admin模块初始化操作
    public function AdminInit()
    {
        
        // 检测系统权限
        if (!IS_ROOT) {
                
            if (!$this->checkRule($this->url)) {

                return createJump('error', '未授权访问!');
            }
        }
        
        return $this->getMenus();
    }
    
    // 获取后台菜单
    public function getMenuList()
    {
        
        $module = request()->module();
    
        $where['is_hide']  =   0;
        $where['module']  =  $module;
        
        $menu_list = \think\Db::name('menu')->where($where)->field(true)->order('sort asc')->select();
        
        foreach ($menu_list as $key => $menu_info) {
            
            if (!IS_ROOT && !AuthRule::check(MEMBER_ID, $module.'/'.$menu_info['url'])) {

                unset($menu_list[$key]);
                continue;
            }
        }
        
        return list_to_tree(array_values($menu_list), 'id', 'pid', 'child');
    }
    
}
