<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\logic\Article as LogicArticle;

/**
 * 文章控制器
 */
class Article extends AdminBase
{
    
    // 文章逻辑
    private static $articleLogic = null;
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        
        parent::_initialize();
        
        self::$articleLogic = get_sington_object('articleLogic', LogicArticle::class);
    }
    
    /**
     * 文章列表
     */
    public function articleList()
    {
        
        $where = self::$articleLogic->getWhere($this->param);
        
        $this->assign('list', self::$articleLogic->getArticleList($where, true, 'create_time desc'));
        
        tag();
        
        return $this->fetch('article_list');
    }
    
    /**
     * 文章添加
     */
    public function articleAdd()
    {
        
        $this->articleCommon();
        
        return $this->fetch('article_edit');
    }
    
    /**
     * 文章编辑
     */
    public function articleEdit()
    {
        
        $this->articleCommon();
        
        $info = self::$articleLogic->getArticleInfo(['id' => $this->param['id']]);
        
        !empty($info) && $info['img_ids_array'] = str2arr($info['img_ids']);
        
        $this->assign('info', $info);
        
        return $this->fetch('article_edit');
    }
    
    /**
     * 文章添加与编辑通用方法
     */
    public function articleCommon()
    {
        
        IS_POST && $this->jump(self::$articleLogic->articleEdit($this->param));
        
        $this->assign('article_category_list', self::$articleLogic->getArticleCategoryList([], 'id,name', '', false));
    }
    
    /**
     * 文章分类添加
     */
    public function articleCategoryAdd()
    {
        
        IS_POST && $this->jump(self::$articleLogic->articleCategoryEdit($this->param));
        
        return $this->fetch('article_category_edit');
    }
    
    /**
     * 文章分类编辑
     */
    public function articleCategoryEdit()
    {
        
        IS_POST && $this->jump(self::$articleLogic->articleCategoryEdit($this->param));
        
        $info = self::$articleLogic->getArticleCategoryInfo(['id' => $this->param['id']]);
        
        $this->assign('info', $info);
        
        return $this->fetch('article_category_edit');
    }
    
    /**
     * 文章分类列表
     */
    public function articleCategoryList()
    {
        
        $this->assign('list', self::$articleLogic->getArticleCategoryList());
       
        tag();
        
        return $this->fetch('article_category_list');
    }
    
    /**
     * 文章删除
     */
    public function articleDel($id = 0)
    {
        
        $this->jump(self::$articleLogic->articleDel(['id' => $id]));
    }
    
    /**
     * 文章分类删除
     */
    public function articleCategoryDel($id = 0)
    {
        
        $this->jump(self::$articleLogic->articleCategoryDel(['id' => $id]));
    }
}
