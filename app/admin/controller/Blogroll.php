<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\logic\Blogroll as LogicBlogroll;

/**
 * 友情链接控制器
 */
class Blogroll extends AdminBase
{
    
    // 友情链接逻辑
    private static $blogrollLogic = null;
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        
        parent::_initialize();
        
        self::$blogrollLogic = get_sington_object('blogrollLogic', LogicBlogroll::class);
    }
    
    /**
     * 友情链接列表
     */
    public function blogrollList()
    {
        
        $this->assign('list', self::$blogrollLogic->getBlogrollList());
        
        return $this->fetch('blogroll_list');
    }
    
    /**
     * 友情链接添加
     */
    public function blogrollAdd()
    {
        
        IS_POST && $this->jump(self::$blogrollLogic->blogrollEdit($this->param));
        
        return $this->fetch('blogroll_edit');
    }
    
    /**
     * 友情链接编辑
     */
    public function blogrollEdit()
    {
        
        IS_POST && $this->jump(self::$blogrollLogic->blogrollEdit($this->param));
        
        $info = self::$blogrollLogic->getBlogrollInfo(['id' => $this->param['id']]);
        
        $this->assign('info', $info);
        
        return $this->fetch('blogroll_edit');
    }
    
    /**
     * 友情链接删除
     */
    public function blogrollDel($id = 0)
    {
        
        $this->jump(self::$blogrollLogic->blogrollDel(['id' => $id]));
    }
}
