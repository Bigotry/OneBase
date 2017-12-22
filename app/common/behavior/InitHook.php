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
        
        $hook  = model(SYS_COMMON_DIR_NAME . SYS_DS_PROS . ucwords(SYS_HOOK_DIR_NAME));

        $list = $hook->column('id,name,addon_list');
            
        while(list($k, $v) = each($list)) : $addon_list[$v['name']] = get_addon_class($v['addon_list']); endwhile;
        
        Hook::import($addon_list);
    }
}
