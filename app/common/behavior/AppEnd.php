<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\behavior;

/**
 * 应用结束行为
 */
class AppEnd
{

    /**
     * 行为入口
     */
    public function run()
    {

        debug('app_end');
        
        BIND_MODULE != 'install' && write_exe_log('app_begin', 'app_end');
    }
}
