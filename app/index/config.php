<?php
// +---------------------------------------------------------------------+
// | OneBase    | [ WE CAN DO IT JUST THINK ]                            |
// +---------------------------------------------------------------------+
// | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )           |
// +---------------------------------------------------------------------+
// | Author     | Bigotry <3162875@qq.com>                               |
// +---------------------------------------------------------------------+
// | Repository | https://gitee.com/Bigotry/OneBase                      |
// +---------------------------------------------------------------------+

// 前端配置文件

$frontend_theme = config('frontend_theme');

$module         = request()->module();

$static_domain = config('static_domain');

empty($static_domain) ? $static = [] :  $static['__STATIC__'] = $static_domain . SYS_DS_PROS . SYS_STATIC_DIR_NAME;

$view_path = ROOT_PATH . SYS_APP_NAMESPACE . SYS_DS_PROS . $module. SYS_DS_PROS . LAYER_VIEW_NAME . SYS_DS_PROS . $frontend_theme . SYS_DS_PROS;

return [
    
    // 视图输出字符串内容替换
    'view_replace_str' => $static,
    
    'template' => ['view_path' => $view_path, 'layout_on' =>  true, 'layout_name' => 'layout'],
];
