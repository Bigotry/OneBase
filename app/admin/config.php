<?php

//配置文件

$static_domain = config('static_domain');

empty($static_domain) ? $static['__STATIC__'] = '/static' :  $static['__STATIC__'] = $static_domain . SYS_DSS . 'static';

return [
    
    /* 模板常量替换配置 */
    'view_replace_str' => $static,
    
    /* 存储驱动,若无需使用云存储则为空 */
    'storage_driver' => '',
    
    /* 模板布局配置 */
    'template'  =>  [
        'layout_on'     =>  true,
        'layout_name'   =>  'layout',
    ],
    
    //验证码
    'captcha'  => [
        // 验证码字符集合
        'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY', 
        // 验证码字体大小(px)
        'fontSize' => 35, 
        // 是否画混淆曲线
        'useCurve' => true, 
         // 验证码图片高度
        'imageH'   => 80,
        // 验证码图片宽度
        'imageW'   => 320, 
        // 验证码位数
        'length'   => 5, 
        // 验证成功后是否重置        
        'reset'    => true
    ],
];
