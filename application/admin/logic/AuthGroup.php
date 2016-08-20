<?php

namespace app\admin\logic;

/**
* 权限分组模型
*/
class AuthGroup extends AdminBase
{
    
    /**
     * 获取权限分组信息
     */
    public function getAuthGroupList($data = [], $field = true, $order = '', $listRows = 15, $simple = false, $config = [])
    {
        
        return $this->getListPage($data, $field, $order, $listRows, $simple, $config);
    }
    
    /**
     * 编辑权限组
     */
    public function editGroup($data = [])
    {
        
        if (IS_POST) {
            
            $validate = validate('AuthGroup');
            $validate_result = $validate->check($data);
            
            if (!$validate_result) {
                $this->error($validate->getError());
            }
            
            $auth_group_model = model('AuthGroup');
            
            if ($data['id']) {
                
                $res = $auth_group_model->allowField(true)->save($data, array('id' => $data['id']));
            } else {
                
                $res = $auth_group_model->allowField(true)->save($data);
            }
            
            if ($res) {
                
                $this->success('操作成功!', url('index'));
            } else {
                
                $this->error('操作失败!');
            }
            
            
        } else {
        
            if (!empty($data['id'])) {
                
                $auth_group_model = model('AuthGroup');
                
                $info = $auth_group_model->get($data['id']);
                
                $this->assign('meta_title', '编辑权限组');
                
                $this->assign('info', $info);
                
            }
        }
        
    }
    
    
}
