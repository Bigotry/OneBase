<?php

//配置文件

$module_name = request()->module();

return [
    
    /* 模板常量替换配置 */
    'view_replace_str' => array(
        
        '__STATIC__' =>  '/public/static',
    ),
    
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
