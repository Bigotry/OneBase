<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service\sms;

use app\common\service\BaseInterface;

/**
 * 短信服务驱动
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
     * 发送短信
     */
    public function send();
    
}
