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
    
    /**
     * 封面获取器
     */
    public function getCoverPathAttr()
    {
        
        $model = model('Picture');
        
        $info = $model->getInfo([$model->getPk() => $this->data['cover_id']], 'path,url');
        
        if (!empty($info['url'])) {
            
            return $info['url'];
        } elseif (!empty($info['path'])){
            
            return '/upload/picture/'.$info['path'];
        }else{
            
            return $info['url'];
        }
    }
    
    
}
