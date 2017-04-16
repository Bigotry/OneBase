<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service\pay;

use app\common\service\BaseInterface;

/**
 * 支付服务驱动
 */
interface Driver extends BaseInterface
{
    
    /**
     * 获取基本信息
     */
    public function driverInfo();
    
    /**
     * 获取配置信息
     */
    public function driverConfig();
    
    /**
     * 支付回调
     */
    public function callback();
    
}
