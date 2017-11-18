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
        
        if(BIND_MODULE == 'install') : goto begin; endif;
        
        $HookModel  = model(SYS_COMMON_DIR_NAME . SYS_DS_PROS . ucwords(SYS_HOOK_DIR_NAME));
        
        $AddonModel = model(SYS_COMMON_DIR_NAME . SYS_DS_PROS . ucwords(SYS_ADDON_DIR_NAME));
        
        $hook_list = cache('cache_hook_list');
        
        if (empty($hook_list)) :
            
            $hook_list = $HookModel->column('name,addon_list');
            
            !empty($hook_list) && cache('cache_hook_list', $hook_list);
        endif;

        foreach ($hook_list as $k => $v)
        {
            
            if(empty($v)) : continue; endif;
                
            $where[DATA_STATUS_NAME] = DATA_NORMAL;
            $name_list = explode(',', $v);
            $where['name'] = ['in', $name_list];

            $cache_key = 'cache_' . md5(serialize($where));

            $data = cache($cache_key);

            if (empty($data)) : $data = $AddonModel->where($where)->column('id,name'); !empty($data) && cache($cache_key, $data); endif;

            !empty($data) && Hook::add($k, array_map('get_addon_class', array_intersect($name_list, $data)));
        }
        
        begin:
    }
}
