<?php

namespace app\admin\logic;

/**
* 会员逻辑模型
*/
class Member extends AdminBase
{
    
    //获取会员列表
    public function getMemberList($where = [], $field = true, $order = '', $paginate = 10)
    {
        
        return load_model($this->name)->getList($where, $field, $order, array('rows' => $paginate));
    }
    
    //会员添加
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
    
    //会员删除
    public function memberDel($where = [])
    {
        
        $model = load_model($this->name);
        
        if (ADMINISTRATOR_ID == $where['id'] || MEMBER_ID == $where['id']) {
            
            return [RESULT_ERROR, '天神和自己不能删除哦~', null];
        }
        
        return $model->deleteInfo($where) ? [RESULT_SUCCESS, '会员删除成功', null] : [RESULT_ERROR, $model->getError(), null];
    }
}
