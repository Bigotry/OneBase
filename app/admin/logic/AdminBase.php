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
    

    
    
    
    
    /**
     * 返回后台节点数据
     * @param boolean $tree    是否返回多维数组结构(生成菜单时用到),为false返回一维数组(生成权限节点时用到)
     * @retrun array
     *
     * 注意,返回的主菜单节点数组中有'controller'元素,以供区分子节点和主节点
     *
     */
    protected function returnNodes($tree = true)
    {
        static $tree_nodes = array();
        
        if ($tree && !empty($tree_nodes[(int)$tree])) {
            
            return $tree_nodes[$tree];
        }
        
        $menu_model = model('Menu');
        
        if ((int)$tree) {
            
            $list = $menu_model->getMenuList([], 'id,pid,title,url,tip,hide', 'sort asc');
            
            foreach ($list as $key => $value) {
                
                if (stripos($value['url'], MODULE_NAME) !== 0) {
                    
                    $list[$key]['url'] = MODULE_NAME.'/'.$value['url'];
                }
            }
            
            $nodes = list_to_tree($list, $pk = 'id', $pid = 'pid', $child = 'operator', $root = 0);
            
            foreach ($nodes as $key => $value) {
                if (!empty($value['operator'])) {
                    
                    $nodes[$key]['child'] = $value['operator'];
                    unset($nodes[$key]['operator']);
                }
            }
        } else {
            
            $nodes = $menu_model->getMenuList([], 'title,url,tip,pid', 'sort asc');
            
            foreach ($nodes as $key => $value) {
                
                if(stripos($value['url'], MODULE_NAME) !== 0){
                    
                    $nodes[$key]['url'] = MODULE_NAME.'/'.$value['url'];
                }
            }
        }
        
        $tree_nodes[(int)$tree]   = $nodes;
        
        return $nodes;
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
