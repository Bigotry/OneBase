<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * 友情链接控制器
 */
class Blogroll extends AdminBase
{
    
    /**
     * 友情链接列表
     */
    public function blogrollList()
    {
        
        $this->assign('list', $this->request->logicBlogroll->getBlogrollList());
        
        return $this->fetch('blogroll_list');
    }
    
    /**
     * 友情链接添加
     */
    public function blogrollAdd()
    {
        
        IS_POST && $this->jump($this->request->logicBlogroll->blogrollEdit($this->param));
        
        return $this->fetch('blogroll_edit');
    }
    
    /**
     * 友情链接编辑
     */
    public function blogrollEdit()
    {
        
        IS_POST && $this->jump($this->request->logicBlogroll->blogrollEdit($this->param));
        
        $info = $this->request->logicBlogroll->getBlogrollInfo(['id' => $this->param['id']]);
        
        $this->assign('info', $info);
        
        return $this->fetch('blogroll_edit');
    }
    
    /**
     * 友情链接删除
     */
    public function blogrollDel($id = 0)
    {
        
        $this->jump($this->request->logicBlogroll->blogrollDel(['id' => $id]));
    }
}
