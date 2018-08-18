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

namespace app\admin\controller;
use app\common\controller\ControllerBase;

/**
 * Widget控制器
 */
class Widget extends ControllerBase
{
    
    /**
     * 获取区域选项信息
     */
    public function getRegionOptions($upid = 0, $level = 1, $select_id = 0)
    {
        
        return $this->logicRegion->getRegionOptions($upid, $level, $select_id);
    }
}
