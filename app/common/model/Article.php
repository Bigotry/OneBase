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
        
        return $this->modelMember->getValue([$this->modelMember->getPk() => $this->data['member_id']], 'nickname');
    }
    
    /**
     * 类别获取器
     */
    public function getCategoryNameAttr()
    {
        
        return $this->modelArticleCategory->getValue([$this->modelMember->getPk() => $this->data['category_id']], 'name');
    }
}
