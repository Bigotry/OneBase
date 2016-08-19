<?php

//配置文件

$module_name = request()->module();

return [
    
    'table_prefix' => 'onebase_', //默认表前缀
    
    /* 模板相关配置 */
    'view_replace_str' => array(
        
        '__STATIC__' =>  '/public/static',
        '__ADDONS__' =>  '/public/'.$module_name.'/addons',
        '__IMG__'    =>  '/public/'.$module_name.'/images',
        '__CSS__'    =>  '/public/'.$module_name.'/css',
        '__JS__'     =>  '/public/'.$module_name.'/js',
        
    ),
    
    
];
