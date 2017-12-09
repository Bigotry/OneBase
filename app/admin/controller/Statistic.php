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
    
    /**
     * 后台会员权限等级树结构
     */
    public function memberTree()
    {
        
        $data = self::$statisticLogic->getMemberTree();
        
        $this->assign('data', json_encode($data));
        
        return $this->fetch('member_tree');
    }
    
    /**
     * 访客浏览器与操作系统统计
     */
    public function performerFacility()
    {
        
        $data = self::$statisticLogic->performerFacility();
        
        $this->assign('browser_list',       json_encode($data['browser_list']));
        $this->assign('browser_name_data',  json_encode($data['browser_name_data']));
        $this->assign('system_list',        json_encode($data['system_list']));
        $this->assign('system_name_data',   json_encode($data['system_name_data']));
        
        return $this->fetch('performer_facility');
    }
    
    /**
     * 执行速度
     */
    public function exeSpeed()
    {
        
        $data = self::$statisticLogic->exeSpeed();
        
        $this->assign('data', $data);
        
        return $this->fetch('exe_speed');
    }
}
