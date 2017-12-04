<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

//配置文件

$static_domain = config('static_domain');

empty($static_domain) ? $static['__STATIC__'] = '/static' :  $static['__STATIC__'] = $static_domain . SYS_DS_PROS . 'static';

return [
    
    /* 模板常量替换配置 */
    'view_replace_str' => $static,
    
    /* 存储驱动,若无需使用云存储则为空 */
    'storage_driver' => '',
    
    /* 模板布局配置 */
    'template'  =>  [
        'layout_on'     =>  true,
        'layout_name'   =>  'layout',
        'tpl_cache'     =>  false,
    ],
];
