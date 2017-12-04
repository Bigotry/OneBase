<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

use app\admin\logic\Log as LogicLog;

/**
 * 记录行为日志
 */
function action_log($name = '', $describe = '')
{

    $logLogic = get_sington_object('logLogic', LogicLog::class);
    
    $logLogic->logAdd($name, $describe);
}

/**
 * 记录URL
 */
function tag($is_set = true)
{
    
    return $is_set ? cookie('__forward__', URL_TRUE) : cookie('__forward__');
}