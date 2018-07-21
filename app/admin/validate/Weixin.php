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

namespace app\admin\validate;

/**
 * 友情链接验证器
 */
class Weixin extends AdminBase
{
    
    // 验证规则
    protected $rule =   [
        
        'wxh'              => 'require|unique:weixin',
    ];

    // 验证提示
    protected $message  =   [
        
        'wxh.require'              => '微信号不能为空',
        'wxh.unique'               => '微信号已存在',
    ];

    // 应用场景
    protected $scene = [
        
        'edit' =>  ['wxh'],
    ];
    
}
