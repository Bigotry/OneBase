<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\logic;

/**
 * 会员逻辑
 */
class Member extends LogicBase
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
    public function getMemberList($where = [], $field = true, $order = '', $is_paginate = true)
    {
        
        $paginate_data = $is_paginate ? ['rows' => DB_LIST_ROWS] : false;
        
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
     * 获得会员信息
     */
    public function memberGet($id="")
    {
        if(!empty($id)){
            return db($this->name)->find($id['id']);
        }


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
     * 会员修改
     */
    public function memberMod($data = [])
    {


        if(empty($data['password'])){
            unset($data['password']);
            unset($data['password_confirm']);
        }
        else{

            $data['password_confirm']=data_md5($data['password_confirm'],DATA_ENCRYPT_KEY);
//            $data['password']=md5(sha1($data['password']). 'OneBase');
            $data['password']=data_md5($data['password'],DATA_ENCRYPT_KEY);
        }
        unset($data['username']);

        $validate = validate($this->name);

        empty($data['password']) ? $scen='modnopwd':$scen='mod';

        $validate_result = $validate->scene($scen)->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $validate->getError(), null];
        }

        $model = load_model($this->name);

        $url = url('memberList');

//        dump($data);


        return $model->setInfo($data) ? [RESULT_SUCCESS, '修改成功', $url] : [RESULT_ERROR, $model->getError(), null];
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
