<?php

namespace app\admin\logic;

/**
* 权限分组模型
*/
class AuthGroup extends AdminBase
{
    
    /**
     * 获取权限分组列表
     */
    public function getAuthGroupList($where = [], $field = true, $order = '', $paginate = 10)
    {
        
        return load_model($this->name)->getList($where, $field, $order, array('rows' => $paginate));
    }
    
    /**
     * 权限组添加
     */
    public function groupAdd($data = [])
    {
        
        $validate = validate($this->name);
        
        $validate_result = $validate->scene('add')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $validate->getError(), null];
        }
        
        $model = load_model($this->name);
        
        $url = url('groupList');
        
        return $model->setInfo($data) ? [RESULT_SUCCESS, '权限组添加成功', $url] : [RESULT_ERROR, $model->getError(), null];
    }
    
    /**
     * 权限组编辑
     */
    public function groupEdit($data = [])
    {
        
        $validate = validate($this->name);
        
        $validate_result = $validate->scene('edit')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $validate->getError(), null];
        }
        
        $model = load_model($this->name);
        
        $url = url('groupList');
        
        return $model->setInfo($data) ? [RESULT_SUCCESS, '权限组编辑成功', $url] : [RESULT_ERROR, $model->getError(), null];
    }
    
    //权限组删除
    public function groupDel($where = [])
    {
        
        $model = load_model($this->name);
        
        return $model->deleteInfo($where) ? [RESULT_SUCCESS, '权限组删除成功', null] : [RESULT_ERROR, $model->getError(), null];
    }
    
    //获取权限组信息
    public function getGroupInfo($where = [], $field = true)
    {
        
        return load_model($this->name)->getInfo($where, $field);
    }

    //设置用户组权限节点
    public function setGroupRules($data = [])
    {
        
        $data['rules'] = !empty($data['rules']) ? implode(',', array_unique($data['rules'])) : '';
        
        $model = load_model($this->name);

        $url = url('groupList');
        
        return $model->setInfo($data) ? [RESULT_SUCCESS, '权限设置成功', $url] : [RESULT_ERROR, $model->getError(), null];
    }
    

    //选择权限组
    public function selectAuthGroupList($group_list = [], $member_group_list = [])
    {
        
        $member_group_ids = array_extract($member_group_list, 'group_id');
        
        foreach ($group_list as &$info) {
            
            in_array($info['id'], $member_group_ids) ? $info['tag'] = 'active' :  $info['tag'] = '';
        }
            
        return $group_list;
    }
    
}
