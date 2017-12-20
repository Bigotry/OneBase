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
    
    /**
     * 读取
     */
    public function __get($name)
    {
        
        return model($name);
    }
}
