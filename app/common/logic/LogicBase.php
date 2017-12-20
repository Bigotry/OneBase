<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\logic;

use app\common\model\ModelBase;

/**
 * 系统通用逻辑模型
 */
class LogicBase extends ModelBase
{
    
    // 绑定
    protected $bind = [];
    
    /**
     * 赋值
     */
    public function __set($name, $value)
    {
        
        $this->bind[$name] = $value;
    }

    /**
     * 读取
     */
    public function __get($name)
    {
        
        return isset($this->bind[$name]) ? $this->bind[$name] : model($name);
    }
}
