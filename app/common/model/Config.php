<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\model;

/**
 * 配置模型
 */
class Config extends ModelBase
{
    
    /**
     * 状态获取器
     */
    public function getStatusTextAttr()
    {
        
        $status = [-1 => '删除', 0 => '禁用', 1 => '启用'];
        
        return $status[$this->data['status']];
    }
}
