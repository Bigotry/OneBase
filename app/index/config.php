<?php

// 前端配置文件

$static_domain  = config('static_domain');
$frontend_theme = config('frontend_theme');
$module         = request()->module();

$view_path = ROOT_PATH . 'app/' .$module. '/view/'.$frontend_theme.'/';

empty($static_domain) ? $static['__STATIC__'] = '/static/'.$module.'/'.$frontend_theme :  $static['__STATIC__'] = $static_domain . '/' . 'static' . '/' . $module . '/' . $frontend_theme;

return [
    
    'template' => ['view_path' => $view_path, 'layout_on' =>  true, 'layout_name' => 'layout'],
    
    /* 模板常量替换配置 */
    'view_replace_str' => $static,
];
