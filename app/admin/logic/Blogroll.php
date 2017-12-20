<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

/**
 * 友情链接逻辑
 */
class Blogroll extends AdminBase
{
    
    /**
     * 获取友情链接列表
     */
    public function getBlogrollList($where = [], $field = true, $order = '', $paginate = 0)
    {
        
        return $this->Blogroll->getList($where, $field, $order, $paginate);
    }
    
    /**
     * 友情链接信息编辑
     */
    public function blogrollEdit($data = [])
    {
        
        $validate = validate('Blogroll');
        
        $validate_result = $validate->scene('edit')->check($data);
        
        if (!$validate_result) : return [RESULT_ERROR, $validate->getError()]; endif;
        
        $url = url('blogrollList');
        
        $result = $this->Blogroll->setInfo($data);
        
        $handle_text = empty($data['id']) ? '新增' : '编辑';
        
        $result && action_log($handle_text, '友情链接' . $handle_text . '，name：' . $data['name']);
        
        return $result ? [RESULT_SUCCESS, '操作成功', $url] : [RESULT_ERROR, $this->Blogroll->getError()];
    }

    /**
     * 获取友情链接信息
     */
    public function getBlogrollInfo($where = [], $field = true)
    {
        
        return $this->Blogroll->getInfo($where, $field);
    }
    
    /**
     * 友情链接删除
     */
    public function blogrollDel($where = [])
    {
        
        $result = $this->Blogroll->deleteInfo($where);
        
        $result && action_log('删除', '友情链接删除' . '，where：' . http_build_query($where));
        
        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->Blogroll->getError()];
    }
}
