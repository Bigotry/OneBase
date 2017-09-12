<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\controller;

/**
 * 插件控制器基类
 */
class AddonBase extends ControllerBase
{
    
    /**
     * 插件模板渲染
     */
    public function addonTemplate($template_name = '')
    {
        
        $class = get_class($this);
        
        $addon_name = strtolower(substr($class, DATA_NORMAL + strrpos($class, SYS_DS_CONS)));
        
        $addon_path = PATH_ADDON . $addon_name . DS;
        
        $view_path = $addon_path . LAYER_VIEW_NAME . DS;
        
        $static_path =  SYS_DS_PROS .SYS_ADDON_DIR_NAME. SYS_DS_PROS . $addon_name . SYS_DS_PROS . SYS_STATIC_DIR_NAME . SYS_DS_PROS;
        
        $this->assign('static_path', $static_path);
        
        $this->view->engine(['view_path' => $view_path]);
        
        echo $this->fetch($template_name);
    }
    
    /**
     * 插件缓存数据更新
     */
    public function addonCacheUpdate()
    {
        
        set_cache_version(SYS_HOOK_DIR_NAME);
        set_cache_version(SYS_ADDON_DIR_NAME);
    }
}
