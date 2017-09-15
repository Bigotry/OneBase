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
}
