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
        
        // 自动缓存回收
        $this->cacheRecycle();
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
        
        if (is_array($jump_type)):
            
        switch (count($jump_type))
        {
            case 2  : list($jump_type, $message)       = $jump_type; break;
            case 3  : list($jump_type, $message, $url) = $jump_type; break;
            default : die(RESULT_ERROR);
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
            default        : die(RESULT_ERROR);
        }
    }
    
    /**
     * 缓存回收
     */
    final protected function cacheRecycle()
    {
        
        $auto_cache_info = cache(AUTO_CACHE_KEY);
      
        $recycle_number = 0;
        
        foreach ($auto_cache_info[CACHE_TABLE_KEY] as $key => $table) :
        
            if (!empty($table[CACHE_LAST_GET_TIME_KEY]) && (($table[CACHE_LAST_GET_TIME_KEY] + SYS_CACHE_CLEAR_INTERVAL_TIME) < TIME_NOW)) :
                
            \think\Cache::clear($key);

            !empty($table[CACHE_NUMBER_KEY]) && $recycle_number += $table[CACHE_NUMBER_KEY];
            
            $auto_cache_info[CACHE_TABLE_KEY][$key][CACHE_NUMBER_KEY] = null;
            
            endif;
            
        endforeach;
        
        !empty($recycle_number) && $auto_cache_info[CACHE_NUMBER_KEY] -= $recycle_number;
        
        cache(AUTO_CACHE_KEY, $auto_cache_info, DATA_DISABLE);
    }
}
