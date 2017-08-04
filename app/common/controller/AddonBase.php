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
     * 插件基类构造方法
     */
    public function _initialize()
    {
        
    }
    
    /**
     * 插件模板渲染
     */
    public function addonTemplate($template_name = '')
    {
        
        $class = get_class($this);
        
        $addon_name = strtolower(substr($class, DATA_NORMAL + strrpos($class, '\\')));
        
        $addon_path = PATH_ADDON . $addon_name . DS;
        
        $view_path = $addon_path . 'view' . DS;
        
        $static_path =  SYS_DSS .SYS_ADDON_DIR_NAME. SYS_DSS . $addon_name . SYS_DSS . 'static' . SYS_DSS;
        
        $this->assign('static_path', $static_path);
        
        $this->view->engine(['view_path' => $view_path]);
        
        echo $this->fetch($template_name);
    }
}
