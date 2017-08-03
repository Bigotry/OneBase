<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

use app\common\logic\LogicBase;

/**
 * Admin基础逻辑
 */
class AdminBase extends LogicBase
{

    /**
     * 权限检测
     */
    public function authCheck($url = '', $url_list = [])
    {

        $pass_data = [RESULT_SUCCESS, '权限检查通过'];
        
        $allow_url = config('allow_url');
        
        $allow_url_list  = parse_config_attr($allow_url);
        
        if (IS_ROOT) {
            
            return $pass_data;
        }
        
        if (!empty($allow_url_list)) {
            
            foreach ($allow_url_list as $v) {
                
                if (strpos(strtolower($url), strtolower($v)) !== false) {
                    
                    return $pass_data;
                }
            }
        }
        
        $result = in_array(strtolower($url), $url_list) ? true : false;
        
        return $result ? $pass_data : [RESULT_ERROR, '未授权操作'];
    }
    
    /**
     * 获取过滤后的菜单树
     */
    public function getMenuTree($menu_list = [], $url_list = [])
    {
        
        foreach ($menu_list as $key => $menu_info) {
            
            list($status, $message) = $this->authCheck(MODULE_NAME.'/'.$menu_info['url'], $url_list);
            
            [$message];
            
            if ((!IS_ROOT && RESULT_ERROR == $status) || !empty($menu_info['is_hide'])) {

                unset($menu_list[$key]);
            }
        }
        
        return $this->getListTree($menu_list);
    }
    
    /**
     * 获取列表树结构
     */
    public function getListTree($list = [])
    {
        
        return list_to_tree(array_values($list), 'id', 'pid', 'child');
    }
    
}
