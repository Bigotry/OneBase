<?php
// +---------------------------------------------------------------------+
// | OneBase    | [ WE CAN DO IT JUST THINK ]                            |
// +---------------------------------------------------------------------+
// | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )           |
// +---------------------------------------------------------------------+
// | Author     | Bigotry <3162875@qq.com>                               |
// +---------------------------------------------------------------------+
// | Repository | https://gitee.com/Bigotry/OneBase                      |
// +---------------------------------------------------------------------+

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
