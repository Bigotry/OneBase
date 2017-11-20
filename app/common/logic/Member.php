<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\logic;

/**
 * 会员逻辑
 */
class Member extends LogicBase
{
    
    // 会员模型
    public static $memberModel = null;
    
    /**
     * 构造方法
     */
    public function __construct()
    {
        
        parent::__construct();
        
        self::$memberModel = model($this->name);
    }
    
    /**
     * 获取会员信息
     */
    public function getMemberInfo($where = [], $field = true)
    {
        
        return self::$memberModel->getInfo($where, $field);
    }
}
