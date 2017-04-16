<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service;

/**
 * 服务接口
 */
interface BaseInterface
{
    
    /**
     * 服务信息
     */
    public function serviceInfo();
    
    /**
     * 服务配置信息
     */
    public function serviceConfig();
}
