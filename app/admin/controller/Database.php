<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\logic\Database as LogicDatabase;

/**
 * 数据库备份控制器
 */
class Database extends AdminBase
{
    
    // 数据库备份逻辑
    private static $databaseLogic = null;
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        
        parent::_initialize();
        
        self::$databaseLogic = get_sington_object('databaseLogic', LogicDatabase::class);
    }
    
    /**
     * 优化表
     */
    public function optimize()
    {
        
        $this->jump(self::$databaseLogic->optimize());
    }
    
    /**
     * 修复表
     */
    public function repair()
    {
        
        $this->jump(self::$databaseLogic->optimize(false));
    }
    
    /**
     * 数据备份
     */
    public function dataBackup()
    {
        
        IS_POST && $this->jump(self::$databaseLogic->dataBackup());
        
        $this->assign('list', self::$databaseLogic->getTableList());
        
        return $this->fetch('data_backup');
    }
    
    /**
     * 数据还原
     */
    public function dataRestore()
    {

        $this->assign('list', self::$databaseLogic->getBackupList());
        
        return $this->fetch('data_restore');
    }
    
    /**
     * 数据还原处理
     */
    public function dataRestoreHandle($time = 0)
    {

       $this->jump(self::$databaseLogic->dataRestore($time));
    }
    
    /**
     * 备份删除
     */
    public function backupDel($time = 0)
    {

        $this->jump(self::$databaseLogic->backupDel($time));
    }
}
