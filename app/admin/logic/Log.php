<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

/**
 * 行为日志逻辑
 */
class Log extends AdminBase
{
    
    // 行为日志模型
    public static $logModel    = null;
    
    /**
     * 构造方法
     */
    public function __construct()
    {
        
        parent::__construct();
        
        self::$logModel = model('ActionLog');
    }
    
    /**
     * 获取日志列表
     */
    public function getLogList($where = [], $field = true, $order = '')
    {
        
        return self::$logModel->getList($where, $field, $order);
    }
  
    /**
     * 日志删除
     */
    public function logDel($where = [])
    {
        
        return self::$logModel->deleteInfo($where) ? [RESULT_SUCCESS, '日志删除成功'] : [RESULT_ERROR, self::$logModel->getError()];
    }
    
    /**
     * 日志添加
     */
    public function logAdd($name = '', $describe = '')
    {
        
        $member_info = session('member_info');
        
        $request = request();
        
        $data['member_id'] = $member_info['id'];
        $data['username']  = $member_info['username'];
        $data['ip']        = $request->ip();
        $data['url']       = $request->url();
        $data['status']    = DATA_NORMAL;
        $data['name']      = $name;
        $data['describe']  = $describe;
        
        $url = url('logList');
        
        return self::$logModel->setInfo($data) ? [RESULT_SUCCESS, '日志添加成功', $url] : [RESULT_ERROR, self::$logModel->getError()];
    }
}
