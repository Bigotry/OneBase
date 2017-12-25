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

namespace app\api\logic;

use app\common\logic\Article as CommonArticle;

/**
 * 文章接口逻辑
 */
class Article extends ApiBase
{
    
    public static $commonArticleLogic = null;
    
    /**
     * 基类初始化
     */
    public function __construct()
    {
        // 执行父类构造方法
        parent::__construct();
        
        empty(static::$commonArticleLogic) && static::$commonArticleLogic = get_sington_object('Article', CommonArticle::class);
    }
    
    /**
     * 获取文章分类列表
     */
    public function getArticleCategoryList()
    {
        
        $list = static::$commonArticleLogic->getArticleCategoryList([], 'id,name', 'id desc', false);
        
        return [$list];
    }
    
    /**
     * 获取文章列表
     */
    public function getArticleList($data = [])
    {
        
        $where = [];
        
        !empty($data['category_id']) && $where['category_id'] = $data['category_id'];
        
        $list = static::$commonArticleLogic->getArticleList($where, 'id,name,category_id,describe,create_time', 'create_time desc');
        
        return [$list];
    }
    
    /**
     * 获取文章信息
     */
    public function getArticleInfo($data = [])
    {
        
        $info = static::$commonArticleLogic->getArticleInfo(['id' => $data['article_id']], 'id,name,category_id,describe,content,create_time');
        
        $info['content'] = html_entity_decode($info['content'] );
        
        return [$info];
    }
}
