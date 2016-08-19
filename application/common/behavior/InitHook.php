<?php

/**
 * 初始化行为
 */

namespace app\common\behavior;

class InitHook
{

    public function run(&$request)
    {
        
        //写入配置信息
        $config_list = model('common/Config')->all();
        
        foreach ($config_list as $info) {
            
           config($info['name'],$info['value']);
        }
    }

}