<?php

namespace app\api\controller;

use app\common\controller\ControllerBase;
use app\api\logic\ApiBase as LogicApiBase;

class ApiBase extends ControllerBase
{
    
    // API基础逻辑
    private static $apiBaseLogic = null;
    
    /**
     * 基类初始化
     */
    public function __construct()
    {
        
        parent::__construct();
        
        self::$apiBaseLogic = get_sington_object('apiBaseLogic', LogicApiBase::class);
        
        IS_POST && self::$apiBaseLogic->checkParam($this->param);
    }
    
    /**
     * API返回数据
     */
    public function apiReturn($code_data = [], $return_data = [], $return_type = 'json')
    {
        
        return self::$apiBaseLogic->apiReturn($code_data, $return_data, $return_type);
    }
}
