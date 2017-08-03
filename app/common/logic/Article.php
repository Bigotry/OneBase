<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\logic;

/**
 * 文章逻辑
 */
class Article extends LogicBase
{
    
    // 文章模型
    public static $articleModel         = null;
    
    // 文章分类模型
    public static $articleCategoryModel = null;
    
    /**
     * 构造方法
     */
    public function __construct()
    {
        
        parent::__construct();
        
        self::$articleModel         = model($this->name);
        self::$articleCategoryModel = model('ArticleCategory');
    }
    
    
    /**
     * 文章分类编辑
     */
    public function articleCategoryEdit($data = [])
    {
        
        $validate = validate('ArticleCategory');
        
        $validate_result = $validate->scene('edit')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $validate->getError()];
        }
        
        $url = url('articleCategoryList');
        
        return self::$articleCategoryModel->setInfo($data) ? [RESULT_SUCCESS, '操作成功', $url] : [RESULT_ERROR, self::$articleCategoryModel->getError()];
    }
    
    /**
     * 获取文章列表
     */
    public function getArticleList($where = [], $field = true, $order = '', $is_paginate = true)
    {
        
        $paginate_data = $is_paginate ? ['rows' => DB_LIST_ROWS] : false;
        
        return self::$articleModel->getList($where, $field, $order, $paginate_data);
    }
    
    /**
     * 文章信息
     */
    public function articleEdit($data = [])
    {
        
        $validate = validate($this->name);
        
        $validate_result = $validate->scene('edit')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $validate->getError()];
        }
        
        $url = url('articleList');
        
        empty($data[self::$articleModel->getPk()]) && $data['member_id'] = MEMBER_ID;
        
        $data['content'] = html_entity_decode($data['content']);
        
        return self::$articleModel->setInfo($data) ? [RESULT_SUCCESS, '文章操作成功', $url] : [RESULT_ERROR, self::$articleModel->getError()];
    }

    /**
     * 获取文章信息
     */
    public function getArticleInfo($where = [], $field = true)
    {
        
        return self::$articleModel->getInfo($where, $field);
    }
    
    /**
     * 获取分类信息
     */
    public function getArticleCategoryInfo($where = [], $field = true)
    {
        
        return self::$articleCategoryModel->getInfo($where, $field);
    }
    
    /**
     * 获取文章分类列表
     */
    public function getArticleCategoryList($where = [], $field = true, $order = '', $is_paginate = true)
    {
        
        $paginate_data = $is_paginate ? ['rows' => DB_LIST_ROWS] : false;
        
        return self::$articleCategoryModel->getList($where, $field, $order, $paginate_data);
    }
    
    /**
     * 文章分类删除
     */
    public function articleCategoryDel($where = [])
    {
        
        return self::$articleCategoryModel->deleteInfo($where) ? [RESULT_SUCCESS, '文章分类删除成功'] : [RESULT_ERROR, self::$articleCategoryModel->getError()];
    }
    
    /**
     * 文章删除
     */
    public function articleDel($where = [])
    {
        
        return self::$articleModel->deleteInfo($where) ? [RESULT_SUCCESS, '文章删除成功'] : [RESULT_ERROR, self::$articleModel->getError()];
    }
}
