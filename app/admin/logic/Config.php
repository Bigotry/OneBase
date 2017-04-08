<?php

namespace app\admin\logic;

/**
* 配置模型
*/
class Config extends AdminBase
{
    
    
    //获取配置列表
    public function getConfigList($where = [], $field = true, $order = '', $paginate = 10)
    {
        
        return load_model($this->name)->getList($where, $field, $order, array('rows' => $paginate));
    }
    
    //获取配置信息
    public function getConfigInfo($where = [], $field = true)
    {
        
        return load_model($this->name)->getInfo($where, $field);
    }
    
    //配置添加
    public function configAdd($data = [])
    {
        
        $validate = validate($this->name);
        
        $validate_result = $validate->scene('add')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $validate->getError(), null];
        }
        
        $model = load_model($this->name);
        
        $url = url('configList', array('group' => $data['group'] ? $data['group'] : 0));
        
        return $model->setInfo($data) ? [RESULT_SUCCESS, '配置添加成功', $url] : [RESULT_ERROR, $model->getError(), null];
    }
    
    //配置编辑
    public function configEdit($data = [])
    {
        
        $validate = validate($this->name);
        
        $validate_result = $validate->scene('edit')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $validate->getError(), null];
        }
        
        $model = load_model($this->name);
        
        $url = url('configList', array('group' => $data['group'] ? $data['group'] : 0));
        
        return $model->setInfo($data) ? [RESULT_SUCCESS, '配置编辑成功', $url] : [RESULT_ERROR, $model->getError(), null];
    }
    
    //配置删除
    public function configDel($where = [])
    {
        
        $model = load_model($this->name);
        
        return $model->deleteInfo($where) ? [RESULT_SUCCESS, '菜单删除成功', null] : [RESULT_ERROR, $model->getError(), null];
    }
}
