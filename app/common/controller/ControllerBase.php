<?php

/**
 * 系统通用控制器基类
 * 控制器层负责调用逻辑层实现业务逻辑
 */

namespace app\common\controller;

use think\Controller;

class ControllerBase extends Controller
{
    //基类初始化
    public function _initialize()
    {
        
        defined('IS_POST')          or define('IS_POST',         $this->request->isPost());
        defined('IS_GET')           or define('IS_GET',          $this->request->isGet());
        defined('MODULE_NAME')      or define('MODULE_NAME',     $this->request->module());
        defined('CONTROLLER_NAME')  or define('CONTROLLER_NAME', $this->request->controller());
        defined('ACTION_NAME')      or define('ACTION_NAME',     $this->request->action());
        defined('URL')              or define('URL',             strtolower($this->request->controller() . '/' . $this->request->action()));
        defined('URL_MODULE')       or define('URL_MODULE',      strtolower($this->request->module()) . '/' . URL);
        
        $this->param = $this->request->param();
    }
    
    /**
     * 系统通用跳转
     */
    public function jump($status = '', $message = '', $url = null, $data = '')
    {
        
        is_array($status) && list($status, $message, $url) = $status;
        
        $success  = RESULT_SUCCESS;
        $error    = RESULT_ERROR;
        $redirect = RESULT_REDIRECT;
        
        //分配跳转类型
        switch ($status) {

            case $success  : $this->$success($message, $url, $data);
            case $error    : $this->$error($message, $url, $data);
            case $redirect : $this->$redirect($url, $data);
            default        : return $data;
        }
    }
}
