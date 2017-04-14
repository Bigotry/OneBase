<?php

namespace app\admin\logic;

use app\common\logic\LogicBase;

/**
* admin模型逻辑基类
*/
class AdminBase extends LogicBase
{

    /**
    * 权限检测
    * @return boolean
    */
    public function authCheck($member_id = 0, $url = '')
    {

        $pass_data = [RESULT_SUCCESS, '权限检查通过'];
        
        if (IS_ROOT) {
            
            return $pass_data;
        }
        
        $model = model('AuthGroupAccess', 'logic');
        
        $url_list = $model->getAuthList($member_id);
        
        $result = in_array(strtolower($url), $url_list) ? true : false;
        
        return $result ? $pass_data : [RESULT_ERROR, '未授权操作'];
    }
    
    
    // 获取后台菜单
    public function getMenuList()
    {
    
        $where['is_hide']  =   0;
        $where['module']   =  MODULE_NAME;
        
        $model = model('Menu', 'logic');
        
        $menu_list = $model->getMenuList($where, true, '', false);
        
        foreach ($menu_list as $key => $menu_info) {
            
            
            list($status, $message) = $this->authCheck(MEMBER_ID, MODULE_NAME.'/'.$menu_info['url']);
            
            [$message];
            
            if (!IS_ROOT && RESULT_ERROR == $status) {

                unset($menu_list[$key]);
                
                continue;
            }
        }
        
        return list_to_tree(array_values($menu_list), 'id', 'pid', 'child');
    }
    
}
