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

namespace app\common\service;

/**
 * 短信服务
 */
class Sms extends ServiceBase implements BaseInterface
{
    
    /**
     * 服务基本信息
     */
    public function serviceInfo()
    {
        
        return ['service_name' => '短信服务', 'service_class' => 'Sms', 'service_describe' => '系统短信服务，用于整合多个短信平台', 'author' => 'Bigotry', 'version' => '1.0'];
    }
    
    /**
     *  检查验证码
        $parameter['phone_number']   = '18555550710';
        $parameter['code']           = '123456';
     */
    public function checkSmsCode($parameter = [])
    {
        
        $code = cache('send_sms_code_'.$parameter['phone_number']);
        
        if (empty($code) || empty($parameter['code'])) {
            
            return false;
        }
        
        if ($parameter['code'] == $code) {
            
           return true;
        }

        return false;
    }
}
