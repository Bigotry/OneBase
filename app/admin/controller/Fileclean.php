<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * 文件清理控制器
 */
class Fileclean extends AdminBase
{
    
    /**
     * 文件清理
     */
    public function cleanList()
    {

        IS_POST && $this->jump($this->logicFileClean->fileClear());
        
        $list = $this->logicFileClean->getFileClearList();
        
        session('file_clear_list', $list);
        
        $this->assign('list', $list);
        
        return $this->fetch('file_clear');
    }
}
