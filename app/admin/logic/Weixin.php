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

namespace app\admin\logic;

/**
 * 微信逻辑
 */
class Weixin extends AdminBase
{
    
    /**
     * 获取友情链接列表
     */
    public function getWxList($where = [], $field = true, $order = '', $paginate = 0)
    {
        
        return $this->modelWeixin->getList($where, $field, $order, $paginate);
    }
    
    /**
     * 友情链接信息编辑
     */
    public function wxEdit($data = [])
    {
        
        $validate_result = $this->validateWeixin->scene('edit')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $this->validateWeixin->getError()];
        }
        
        $url = url('wxList');
        
        $result = $this->modelWeixin->setInfo($data);
        
        $handle_text = empty($data['id']) ? '新增' : '编辑';
        
        $result && action_log($handle_text, '微信' . $handle_text . '，wxh：' . $data['wxh']);
        
        return $result ? [RESULT_SUCCESS, '操作成功', $url] : [RESULT_ERROR, $this->modelWeixin->getError()];
    }

    /**
     * 获取友情链接信息
     */
    public function getWxInfo($where = [], $field = true)
    {
        
        return $this->modelWeixin->getInfo($where, $field);
    }
    
    /**
     * 友情链接删除
     */
    public function blogrollDel($where = [])
    {
        
        $result = $this->modelWeixin->deleteInfo($where);
        
        $result && action_log('删除', '微信删除' . '，where：' . http_build_query($where));
        
        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelWeixin->getError()];
    }
}
