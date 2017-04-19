<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\behavior;

use think\Hook;

/**
 * 初始化钩子信息行为
 */
class InitHook
{

    /**
     * 行为入口
     */
    public function run()
    {
        
        $HookModel  = model(MODULE_COMMON_NAME.'/Hook');
        
        $AddonModel = model(MODULE_COMMON_NAME.'/Addon');
        
        $hook_list = $HookModel->column('name,addon_list');

        foreach ($hook_list as $k => $v) {
            
            if (empty($v)) {
                
                continue;
            }
                
            $where[DATA_STATUS] = DATA_NORMAL;
            $name_list = explode(',', $v);
            $where['name'] = ['in', $name_list];

            $data = $AddonModel->where($where)->column('id,name'); 
            
            !empty($data) && Hook::add($k, array_map('get_addon_class', array_intersect($name_list, $data)));
        }
    }
}
