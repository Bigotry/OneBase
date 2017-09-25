<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\logic;

/**
 * SEO逻辑
 */
class Seo extends LogicBase
{
    
    // SEO模型
    public static $seoModel = null;
    
    /**
     * 构造方法
     */
    public function __construct()
    {
        
        parent::__construct();
        
        self::$seoModel  = model('Seo');
    }
    
    /**
     * 获取SEO列表
     */
    public function getSeoList($where = [], $field = true, $order = '', $paginate = 0)
    {
        
        return self::$seoModel->getList($where, $field, $order, $paginate);
    }
    
    /**
     * SEO信息编辑
     */
    public function seoEdit($data = [])
    {
        
        $validate = validate('Seo');
        
        $validate_result = $validate->scene('edit')->check($data);
        
        if (!$validate_result) : return [RESULT_ERROR, $validate->getError()]; endif;
        
        $url = url('seoList');
        
        return self::$seoModel->setInfo($data) ? [RESULT_SUCCESS, '操作成功', $url] : [RESULT_ERROR, self::$seoModel->getError()];
    }

    /**
     * 获取SEO信息
     */
    public function getSeoInfo($where = [], $field = true)
    {
        
        return self::$seoModel->getInfo($where, $field);
    }
    
    /**
     * SEO删除
     */
    public function seoDel($where = [])
    {
        
        return self::$seoModel->deleteInfo($where) ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, self::$seoModel->getError()];
    }
}
