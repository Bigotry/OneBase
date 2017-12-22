<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\demo\logic;

use app\common\logic\LogicBase;

/**
 * 演示逻辑
 */
class Demo extends LogicBase
{
    
    /**
     * 各层引用演示
     */
    public function demoExecute()
    {
        
        /**
         * 控制器层引用业务逻辑层
         * 控制器层只能使用此方式引用业务逻辑层 前缀 logic
         * 执行查询文章列表逻辑
         */
        $this->logicArticle->getArticleList();
        
        /**
         * 业务逻辑层引用模型层
         * 执行模型查询文章列表
         * 前缀 model
         */
        $this->modelArticle->getList();
        
        /**
         * 业务逻辑层引用验证层
         * 执行文章分类数据编辑场景验证
         * 前缀 validate
         */
        $this->validateArticleCategory->scene('edit')->check([]);
        
        /**
         * 业务逻辑层引用服务层
         * 执行存储服务下的七牛驱动进行文件上传
         * 前缀 service | driver
         */
        $this->serviceStorage->driverQiniu->uploadFile(130);
    }
    
    /**
     * 事务控制
     */
    public function demoTransaction()
    {
        
        $func1 = function() { $this->modelMember->setFieldValue(['username' => 'demo'], 'nickname', 'test_demo'); };
                
        $func2 = function() { $a = 1/0; [$a]; };
        
        closure_list_exe([$func1, $func2]);
    }

    /**
     * 云存储服务
     */
    public function demoStorage()
    {
        
        return $this->serviceStorage->driverQiniu->uploadFile(130);
    }
    
    /**
     * 支付服务
     */
    public function demoPay()
    {
        
        $test_order['order_sn']         =   date('ymdhis', time()) . rand(10000, 99999);
        $test_order['body']             =   '测试';
        $test_order['order_amount']     =   0.01;
        
        exit($this->servicePay->driverAlipay->pay($test_order));
    }
    
    /**
     * 短信服务
     */
    public function demoSendSms()
    {
        
        $parameter['sign_name']      = 'OneBase架构';
        $parameter['template_code']  = 'SMS_113455309';
        $parameter['phone_number']   = '18555550710';
        $parameter['template_param'] = ['code' => '123456'];
        
        return $this->serviceSms->driverAlidy->sendSms($parameter);
    }
}
