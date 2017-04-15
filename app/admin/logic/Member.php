<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

/**
 * 会员逻辑
 */
class Member extends AdminBase
{
    
    /**
     * 获取会员信息
     */
    public function getMemberInfo($where = [], $field = true)
    {
        
        return load_model($this->name)->getInfo($where, $field);
    }
    
    /**
     * 获取会员列表
     */
    public function getMemberList($where = [], $field = true, $order = '', $paginate = 10)
    {
        
        $paginate_data = false === $paginate ? false : ['rows' => $paginate];
        
        return load_model($this->name)->getList($where, $field, $order, $paginate_data);
    }
    
    /**
     * 会员添加到用户组
     */
    public function addToGroup($data = [])
    {
        
        if (ADMINISTRATOR_ID == $data['id']) {
            
            return [RESULT_ERROR, '天神不能授权哦~', null];
        }
        
        $model = load_model('AuthGroupAccess');
        
        $where = ['member_id' => ['in', $data['id']]];
        
        $model->deleteInfo($where);
        
        $url = url('memberList');
        
        if (empty($data['group_id'])) {
            
            return [RESULT_SUCCESS, '会员授权成功', $url];
        }
        
        $add_data = [];
        
        foreach ($data['group_id'] as $group_id) {
            
            $add_data[] = ['member_id' => $data['id'], 'group_id' => $group_id];
        }
        
        return $model->setList($add_data) ? [RESULT_SUCCESS, '会员授权成功', $url] : [RESULT_ERROR, $model->getError(), null];
    }
    
    /**
     * 会员添加
     */
    public function memberAdd($data = [])
    {
        
        $validate = validate($this->name);
        
        $validate_result = $validate->scene('add')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $validate->getError(), null];
        }
        
        $model = load_model($this->name);
        
        $url = url('memberList');
        
        $data['nickname'] = $data['username'];
        
        return $model->setInfo($data) ? [RESULT_SUCCESS, '会员添加成功', $url] : [RESULT_ERROR, $model->getError(), null];
    }
    
    /**
     * 会员删除
     */
    public function memberDel($where = [])
    {
        
        $model = load_model($this->name);
        
        if (ADMINISTRATOR_ID == $where['id'] || MEMBER_ID == $where['id']) {
            
            return [RESULT_ERROR, '天神和自己不能删除哦~', null];
        }
        
        return $model->deleteInfo($where) ? [RESULT_SUCCESS, '会员删除成功', null] : [RESULT_ERROR, $model->getError(), null];
    }
}
