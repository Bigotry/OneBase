<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * SEO控制器
 */
class Seo extends AdminBase
{
    
    /**
     * SEO列表
     */
    public function seoList()
    {
        
        $this->assign('list', $this->logicSeo->getSeoList());
        
        return $this->fetch('seo_list');
    }
    
    /**
     * SEO添加
     */
    public function seoAdd()
    {
        
        IS_POST && $this->jump($this->logicSeo->seoEdit($this->param));
        
        return $this->fetch('seo_edit');
    }
    
    /**
     * SEO编辑
     */
    public function seoEdit()
    {
        
        IS_POST && $this->jump($this->logicSeo->seoEdit($this->param));
        
        $info = $this->logicSeo->getSeoInfo(['id' => $this->param['id']]);
        
        $this->assign('info', $info);
        
        return $this->fetch('seo_edit');
    }
    
    /**
     * SEO删除
     */
    public function seoDel($id = 0)
    {
        
        $this->jump($this->logicSeo->seoDel(['id' => $id]));
    }
}
