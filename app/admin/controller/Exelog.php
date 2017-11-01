<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\logic\ExeLog as LogicExeLog;

/**
 * 执行记录控制器
 */
class Exelog extends AdminBase
{
    
    // 执行记录逻辑
    private static $exeLogLogic = null;
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        
        parent::_initialize();
        
        self::$exeLogLogic = get_sington_object('exeLogLogic', LogicExeLog::class);
    }
    
    /**
     * 全局范围列表
     */
    public function appList()
    {
        
        $this->assign('list', self::$exeLogLogic->getLogList(['type' => DATA_DISABLE], true, TIME_CT_NAME . ' desc'));
        
        return $this->fetch('app_list');
    }
    
    /**
     * 接口范围列表
     */
    public function apiList()
    {
        
        $this->assign('list', self::$exeLogLogic->getLogList(['type' => DATA_NORMAL], true, TIME_CT_NAME . ' desc'));
        
        return $this->fetch('api_list');
    }
  
    /**
     * 日志入库
     */
    public function logImport()
    {
        
        $this->jump(self::$exeLogLogic->logImport());
    }
  
    /**
     * 日志清空
     */
    public function logClean()
    {
        
        $this->jump(self::$exeLogLogic->logDel([DATA_STATUS_NAME => DATA_NORMAL]));
    }
}
