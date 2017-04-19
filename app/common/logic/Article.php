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
    
    /**
     * 文章分类编辑
     */
    public function articleCategoryEdit($data = [])
    {
        
        $model_name = 'ArticleCategory';
        
        $validate = validate($model_name);
        
        $validate_result = $validate->scene('edit')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $validate->getError(), null];
        }
        
        $model = load_model($model_name);
        
        $url = url('articleCategoryList');
        
        return $model->setInfo($data) ? [RESULT_SUCCESS, '操作成功', $url] : [RESULT_ERROR, $model->getError(), null];
    }
    
    /**
     * 获取文章信息
     */
    public function getArticleInfo($where = [], $field = true)
    {
        
        return load_model($this->name)->getInfo($where, $field);
    }
    
    /**
     * 获取分类信息
     */
    public function getArticleCategoryInfo($where = [], $field = true)
    {
        
        return load_model('ArticleCategory')->getInfo($where, $field);
    }
    
    /**
     * 获取文章列表
     */
    public function getArticleList($where = [], $field = true, $order = '', $is_paginate = true)
    {
        
        $paginate_data = $is_paginate ? ['rows' => DB_LIST_ROWS] : false;
        
        return load_model($this->name)->getList($where, $field, $order, $paginate_data);
    }
    
    /**
     * 获取文章分类列表
     */
    public function getArticleCategoryList($where = [], $field = true, $order = '', $is_paginate = true)
    {
        
        $paginate_data = $is_paginate ? ['rows' => DB_LIST_ROWS] : false;
        
        return load_model('ArticleCategory')->getList($where, $field, $order, $paginate_data);
    }
    
    /**
     * 文章分类删除
     */
    public function articleCategoryDel($where = [])
    {
        
        $model = load_model('ArticleCategory');
        
        return $model->deleteInfo($where) ? [RESULT_SUCCESS, '文章分类删除成功', null] : [RESULT_ERROR, $model->getError(), null];
    }
    
    /**
     * 文章删除
     */
    public function articleDel($where = [])
    {
        
        $model = load_model($this->name);
        
        return $model->deleteInfo($where) ? [RESULT_SUCCESS, '文章删除成功', null] : [RESULT_ERROR, $model->getError(), null];
    }
}
