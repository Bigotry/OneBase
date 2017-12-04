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
        
        // 初始化响应类型
        $this->initResponseType();
    }
    
    /**
     * 初始化请求信息
     */
    final private function initRequestInfo()
    {
        
        defined('IS_POST')          or define('IS_POST',         $this->request->isPost());
        defined('IS_GET')           or define('IS_GET',          $this->request->isGet());
        defined('IS_AJAX')          or define('IS_AJAX',         $this->request->isAjax());
        defined('IS_PJAX')          or define('IS_PJAX',         $this->request->isPjax());
        defined('MODULE_NAME')      or define('MODULE_NAME',     $this->request->module());
        defined('CONTROLLER_NAME')  or define('CONTROLLER_NAME', $this->request->controller());
        defined('ACTION_NAME')      or define('ACTION_NAME',     $this->request->action());
        defined('URL')              or define('URL',             strtolower($this->request->controller() . SYS_DS_PROS . $this->request->action()));
        defined('URL_MODULE')       or define('URL_MODULE',      strtolower($this->request->module()) . SYS_DS_PROS . URL);
        defined('URL_TRUE')         or define('URL_TRUE',        $this->request->url(true));
        
        $this->param = $this->request->param();
    }
    
    /**
     * 初始化响应类型
     */
    final private function initResponseType()
    {
        
        IS_AJAX && !IS_PJAX  ? config('default_ajax_return', 'json') : config('default_ajax_return', 'html');
    }
    
    /**
     * 系统通用跳转
     */
    final protected function jump($jump_type = null, $message = null, $url = null)
    {
        
        $data = is_array($jump_type) ? $this->parseJumpArray($jump_type) : $this->parseJumpArray([$jump_type, $message, $url]);
        
        return !IS_PJAX ? $this->defaultJump($data) : $this->pjaxJump($data);
    }
    
    /**
     * 默认系统跳转处理
     */
    final protected function defaultJump($data)
    {
        
        $success  = RESULT_SUCCESS;
        $error    = RESULT_ERROR;
        $redirect = RESULT_REDIRECT;

        switch ($data['jump_type'])
        {
            case $success  : $this->$success($data['message'],  $data['url']);      break;
            case $error    : $this->$error($data['message'],    $data['url']);      break;
            case $redirect : $this->$redirect($data['url']);                        break;
            default        : exception('System jump failure');
        }
    }
    
    /**
     * PJAX系统跳转处理
     */
    final protected function pjaxJump($data)
    {
        
        $success  = RESULT_SUCCESS;
        $error    = RESULT_ERROR;
        
        $html = "<script type='text/javascript'>";
        
        switch ($data['jump_type'])
        {
            case $success  : $html .= "toast.success('" . $data['message'] . "');";    break;
            case $error    : $html .= "toast.error('"   . $data['message'] . "');";    break;
            default        : exception('System jump failure');
        }
        
        !isset($data['url']) && $html .= "$.pjax({url: '". tag(false)."',container: '.content'});";
        
        !empty($data['url']) && is_string($data['url']) && $html .= "$.pjax({url: '".$data['url']."',container: '.content'});";
        
        is_bool($data['url']) && $html .= "javascript:history.back(-1);$('.content').html(backups_content);";
        
        $html .= "</script>";
        
        response_html($html);
    }
    
    /**
     * 解析跳转数组
     */
    final protected function  parseJumpArray($jump_array = [])
    {
        
        !isset($jump_array[2]) && $jump_array[2] = null;
       
        return ['jump_type' => $jump_array[0], 'message' => $jump_array[1], 'url' => $jump_array[2]];
    }
    
    /**
     * 初始化全局静态资源
     */
    final protected function initCommonStatic()
    {
        
        $this->assign('loading_icon', config('loading_icon'));
        $this->assign('pjax_mode',    config('pjax_mode'));
    }
}
