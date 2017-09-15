<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\logic\Statistic as LogicStatistic;

/**
 * 统计分析控制器
 */
class Statistic extends AdminBase
{
    
    // 统计分析逻辑
    private static $statisticLogic = null;
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        
        parent::_initialize();
        
        self::$statisticLogic = get_sington_object('statisticLogic', LogicStatistic::class);
    }
    
}
