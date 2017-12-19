<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * 统计分析控制器
 */
class Statistic extends AdminBase
{
    
    /**
     * 后台会员权限等级树结构
     */
    public function memberTree()
    {
        
        $data = $this->request->logicStatistic->getMemberTree();
        
        $this->assign('data', json_encode($data));
        
        return $this->fetch('member_tree');
    }
    
    /**
     * 访客浏览器与操作系统统计
     */
    public function performerFacility()
    {
        
        $data = $this->request->logicStatistic->performerFacility();
        
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
        
        $data = $this->request->logicStatistic->exeSpeed();
        
        $this->assign('data', $data);
        
        return $this->fetch('exe_speed');
    }
    
    /**
     * 会员增长
     */
    public function memberGrowth()
    {
        
        $data = $this->request->logicStatistic->memberGrowth();
        
        $this->assign('data', json_encode($data));
        
        return $this->fetch('member_growth');
    }
}
