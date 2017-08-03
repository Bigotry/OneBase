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
    
    // 会员模型
    public static $memberModel = null;
    
    /**
     * 构造方法
     */
    public function __construct()
    {
        
        parent::__construct();
        
        self::$memberModel = model($this->name);
    }
    
    /**
     * 获取会员信息
     */
    public function getMemberInfo($where = [], $field = true)
    {
        
        return self::$memberModel->getInfo($where, $field);
    }
    
    /**
     * 获取会员列表
     */
    public function getMemberList($where = [], $field = true, $order = '', $is_paginate = true)
    {
        
        $paginate_data = $is_paginate ? ['rows' => DB_LIST_ROWS] : false;
        
        return self::$memberModel->getList($where, $field, $order, $paginate_data);
    }
    
    /**
     * 会员添加到用户组
     */
    public function addToGroup($data = [])
    {
        
        if (SYS_ADMINISTRATOR_ID == $data['id']) {
            
            return [RESULT_ERROR, '天神不能授权哦~'];
        }
        
        $model = model('AuthGroupAccess');
        
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
        
        return $model->setList($add_data) ? [RESULT_SUCCESS, '会员授权成功', $url] : [RESULT_ERROR, $model->getError()];
    }
    
    /**
     * 会员添加
     */
    public function memberAdd($data = [])
    {
        
        $validate = validate($this->name);
        
        $validate_result = $validate->scene('add')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $validate->getError()];
        }
        
        $url = url('memberList');
        
        $data['nickname'] = $data['username'];
        
        return self::$memberModel->setInfo($data) ? [RESULT_SUCCESS, '会员添加成功', $url] : [RESULT_ERROR, self::$memberModel->getError()];
    }
    
    /**
     * 会员删除
     */
    public function memberDel($where = [])
    {
        
        if (SYS_ADMINISTRATOR_ID == $where['id'] || MEMBER_ID == $where['id']) {
            
            return [RESULT_ERROR, '天神和自己不能删除哦~'];
        }
        
        return self::$memberModel->deleteInfo($where) ? [RESULT_SUCCESS, '会员删除成功'] : [RESULT_ERROR, self::$memberModel->getError()];
    }
}
