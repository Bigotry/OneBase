<?php

/**
 * 应用控制器基类
 */

namespace app\common\controller;

use think\Controller;

class CommonBase extends Controller
{
    
    protected $request;
    protected $param;
    protected $url;
    
    //公共基类初始化
    protected function _initialize()
    {
        
        $this->getRequestInfo();
    }
    
    //公共基类析构方法
    public function __destruct()
    {
        
        $after_operate = config('after_operate');
        
        eval($after_operate);
    }
    
    protected function getRequestInfo()
    {
        
        $this->request    = \think\Request::instance();
        $this->param = $this->request->param();
        
        defined('MODULE_NAME')      or define('MODULE_NAME', strtolower($this->request->module()));
        defined('CONTROLLER_NAME')  or define('CONTROLLER_NAME', strtolower($this->request->controller()));
        defined('ACTION_NAME')      or define('ACTION_NAME', strtolower($this->request->action()));
        
        $this->url = MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME;

        defined('IS_POST')          or define('IS_POST', $this->request->isPost());
        defined('IS_GET')           or define('IS_GET', $this->request->isGet());
    }
    
}
