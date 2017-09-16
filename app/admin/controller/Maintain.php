<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\logic\Maintain as LogicMaintain;

/**
 * 优化维护控制器
 */
class Maintain extends AdminBase
{
    
    // 优化维护逻辑
    private static $maintainLogic = null;
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        
        parent::_initialize();
        
        self::$maintainLogic = get_sington_object('maintainLogic', LogicMaintain::class);
    }
    
    /**
     * SEO列表
     */
    public function seoList()
    {
        
        $this->assign('list', self::$maintainLogic->getSeoList());
        
        return $this->fetch('seo_list');
    }
    
    /**
     * SEO添加
     */
    public function seoAdd()
    {
        
        IS_POST && $this->jump(self::$maintainLogic->seoEdit($this->param));
        
        return $this->fetch('seo_edit');
    }
    
    /**
     * SEO编辑
     */
    public function seoEdit()
    {
        
        IS_POST && $this->jump(self::$maintainLogic->seoEdit($this->param));
        
        $info = self::$maintainLogic->getSeoInfo(['id' => $this->param['id']]);
        
        $this->assign('info', $info);
        
        return $this->fetch('seo_edit');
    }
    
    /**
     * SEO删除
     */
    public function seoDel($id = 0)
    {
        
        $this->jump(self::$maintainLogic->seoDel(['id' => $id]));
    }
    
    /**
     * 优化表
     */
    public function optimize()
    {
        
        $this->jump(self::$maintainLogic->optimize());
    }
    
    /**
     * 修复表
     */
    public function repair()
    {
        
        $this->jump(self::$maintainLogic->optimize(false));
    }
    
    /**
     * 数据备份
     */
    public function dataBackup()
    {
        
        IS_POST && $this->jump(self::$maintainLogic->dataBackup());
        
        $this->assign('list', self::$maintainLogic->getTableList());
        
        return $this->fetch('data_backup');
    }
    
    /**
     * 数据还原
     */
    public function dataRestore()
    {

        $this->assign('list', self::$maintainLogic->getBackupList());
        
        return $this->fetch('data_restore');
    }
    
    /**
     * 数据还原处理
     */
    public function dataRestoreHandle($time = 0)
    {

       $this->jump(self::$maintainLogic->dataRestore($time));
    }
    
    /**
     * 备份删除
     */
    public function backupDel($time = 0)
    {

        $this->jump(self::$maintainLogic->backupDel($time));
    }
}
