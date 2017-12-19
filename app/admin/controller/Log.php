<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * 行为日志控制器
 */
class Log extends AdminBase
{
    
    /**
     * 日志列表
     */
    public function logList()
    {
        
        $this->assign('list', $this->request->logicLog->getLogList([], true, TIME_CT_NAME . ' desc'));
        
        return $this->fetch('log_list');
    }
  
    /**
     * 日志删除
     */
    public function logDel($id = 0)
    {
        
        $this->jump($this->request->logicLog->logDel(['id' => $id]));
    }
  
    /**
     * 日志清空
     */
    public function logClean()
    {
        
        $this->jump($this->request->logicLog->logDel([DATA_STATUS_NAME => DATA_NORMAL]));
    }
}
