<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

/**
 * 执行记录逻辑
 */
class ExeLog extends AdminBase
{
    
    /**
     * 获取记录列表
     */
    public function getLogList($where = [], $field = true, $order = '')
    {
        
        return $this->ExeLog->getList($where, $field, $order);
    }
  
    /**
     * 日志入库
     */
    public function logImport()
    {
        
        $exe_log_path = "../runtime/log/exe_log.php";
        
        $exe_log_array = require $exe_log_path;
        
        if (empty($exe_log_array) || DATA_NORMAL == $exe_log_array) : return [RESULT_ERROR, '日志文件为空']; endif;
        
        $this->ExeLog->setList($exe_log_array) && file_put_contents($exe_log_path, '');
        
        return [RESULT_SUCCESS, '日志已入库'];
    }
  
    /**
     * 记录删除
     */
    public function logDel($where = [])
    {
        
        return $this->ExeLog->deleteInfo($where) ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->ExeLog->getError()];
    }
}
