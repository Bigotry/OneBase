<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\model;

/**
 * 文章模型
 */
class Article extends ModelBase
{
    
    /**
     * 昵称获取器
     */
    public function getNicknameAttr()
    {
        
        $model = model('Member');
        
        return $model->getValue([$model->getPk() => $this->data['member_id']], 'nickname');
    }
    
    /**
     * 类别获取器
     */
    public function getCategoryNameAttr()
    {
        
        $model = model('ArticleCategory');
        
        return $model->getValue([$model->getPk() => $this->data['category_id']], 'name');
    }
}
