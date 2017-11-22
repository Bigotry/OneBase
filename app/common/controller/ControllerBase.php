<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\controller;

use think\Controller;

/**
 * 系统通用控制器基类
 */
class ControllerBase extends Controller
{
    
    // 请求参数
    protected $param;
    
    /**
     * 基类初始化
     */
    public function _initialize()
    {
        
        // 初始化请求信息
        $this->initRequestInfo();
        
        // 初始化全局静态资源
        $this->initCommonStatic();
    }
    
    /**
     * 初始化请求信息
     */
    final private function initRequestInfo()
    {
        
        defined('IS_POST')          or define('IS_POST',         $this->request->isPost());
        defined('IS_GET')           or define('IS_GET',          $this->request->isGet());
        defined('IS_AJAX')          or define('IS_AJAX',         $this->request->isAjax());
        defined('MODULE_NAME')      or define('MODULE_NAME',     $this->request->module());
        defined('CONTROLLER_NAME')  or define('CONTROLLER_NAME', $this->request->controller());
        defined('ACTION_NAME')      or define('ACTION_NAME',     $this->request->action());
        defined('URL')              or define('URL',             strtolower($this->request->controller() . SYS_DS_PROS . $this->request->action()));
        defined('URL_MODULE')       or define('URL_MODULE',      strtolower($this->request->module()) . SYS_DS_PROS . URL);
        
        $this->param = $this->request->param();
    }
    
    /**
     * 系统通用跳转
     */
    final protected function jump($jump_type = null, $message = null, $url = null)
    {
        
        $err_msg = "系统跳转失败";
        
        if (is_array($jump_type)):
            
        switch (count($jump_type))
        {
            case 2  : list($jump_type, $message)       = $jump_type; break;
            case 3  : list($jump_type, $message, $url) = $jump_type; break;
            default : $this->error($err_msg);
        }
        
        endif;
        
        $success  = RESULT_SUCCESS;
        $error    = RESULT_ERROR;
        $redirect = RESULT_REDIRECT;

        switch ($jump_type)
        {
            case $success  : $this->$success($message, $url); break;
            case $error    : $this->$error($message, $url);   break;
            case $redirect : $this->$redirect($message);      break;
            default        : $this->error($err_msg);
        }
    }
    
    /**
     * 初始化全局静态资源
     */
    final protected function initCommonStatic()
    {
        
        $this->assign('loading_icon', config('loading_icon'));
    }
}
