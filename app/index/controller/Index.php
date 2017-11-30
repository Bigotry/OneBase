<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\index\controller;

use app\common\logic\Article as LogicArticle;

class Index extends IndexBase
{
    
    // 首页
    public function index()
    {
        
        empty(session('cid')) && session('cid', 0);
        
        !empty($this->param['cid']) && session('cid', $this->param['cid']);
        
        $this->assign('cid', session('cid'));
        
        // SEO信息
        $articleLogic = get_sington_object('articleLogic', LogicArticle::class);
        
        // 分类变量
        $category_info = $articleLogic->getArticleCategoryInfo(['id' => session('cid')]);
        
        $category_name = empty($category_info['name']) ? '所有分类' : $category_info['name'];
        
        $this->assign('category_name', '-'.$category_name);
        
        //文章变量
        if (!empty($this->param['id'])) :
            
            $article_info = $articleLogic->getArticleInfo(['id' => $this->param['id']]);

            $this->assign('article_title',      '-'.$article_info['name']);
            $this->assign('article_describe',   '-'.$article_info['describe']);
        endif;
        
        return empty($this->param['act']) ? $this->fetch('index') : $this->fetch('details');
    }
    
    // 登录
    public function login()
    {
        
        return $this->fetch();
    }
    
    // 修改密码
    public function changePassword()
    {
        
        return $this->fetch('change_password');
    }
}
