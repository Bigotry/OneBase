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
        
        $addon_name = strtolower(substr($class, 1 + strrpos($class, '\\')));
        
        $view_path = ADDON_DIR_NAME.'/'.$addon_name.'/view/';
        
        $this->assign('static_path', '/' .ADDON_DIR_NAME . '/' . $addon_name.'/static');
        
        $this->view->engine(['view_path' => $view_path]);
        
        echo $this->fetch($template_name);
    }
}
