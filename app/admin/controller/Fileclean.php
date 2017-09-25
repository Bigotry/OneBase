<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\logic\FileClean as LogicFileClean;

/**
 * 文件清理控制器
 */
class Fileclean extends AdminBase
{
    
    // 文件清理逻辑
    private static $fileCleanLogic = null;
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        
        parent::_initialize();
        
        self::$fileCleanLogic = get_sington_object('fileCleanLogic', LogicFileClean::class);
    }
    
    /**
     * 文件清理
     */
    public function cleanList()
    {

        IS_POST && $this->jump(self::$fileCleanLogic->fileClear());
        
        $list = self::$fileCleanLogic->getFileClearList();
        
        session('file_clear_list', $list);
        
        $this->assign('list', $list);
        
        return $this->fetch('file_clear');
    }
}
