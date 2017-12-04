<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\logic\Seo as LogicSeo;

/**
 * SEO控制器
 */
class Seo extends AdminBase
{
    
    // SEO逻辑
    private static $seoLogic = null;
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        
        parent::_initialize();
        
        self::$seoLogic = get_sington_object('seoLogic', LogicSeo::class);
    }
    
    /**
     * SEO列表
     */
    public function seoList()
    {
        
        $this->assign('list', self::$seoLogic->getSeoList());
        
        tag();
        
        return $this->fetch('seo_list');
    }
    
    /**
     * SEO添加
     */
    public function seoAdd()
    {
        
        IS_POST && $this->jump(self::$seoLogic->seoEdit($this->param));
        
        return $this->fetch('seo_edit');
    }
    
    /**
     * SEO编辑
     */
    public function seoEdit()
    {
        
        IS_POST && $this->jump(self::$seoLogic->seoEdit($this->param));
        
        $info = self::$seoLogic->getSeoInfo(['id' => $this->param['id']]);
        
        $this->assign('info', $info);
        
        return $this->fetch('seo_edit');
    }
    
    /**
     * SEO删除
     */
    public function seoDel($id = 0)
    {
        
        $this->jump(self::$seoLogic->seoDel(['id' => $id]));
    }
}
