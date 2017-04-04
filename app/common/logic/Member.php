<?php

namespace app\common\logic;

/**
* 系统通用会员逻辑
*/
class Member extends LogicBase
{

    /**
     * 获取会员信息
     */
    public function getMemberList($data = [], $field = true, $order = '', $listRows = 15, $simple = false, $config = [])
    {
        
        return $this->getListPage($data, $field, $order, $listRows, $simple, $config);
    }
    
    
    public function addMember($data = [])
    {
        
        if (IS_POST) {
            
            if ($data['password'] != $data['repassword']) {
                
                return createJump('error', '密码和重复密码不一致！');
            }
            
            $validate = validate('Member');
            
            $validate_result = $validate->scene('add')->check($data);
            
            if (!$validate_result) {
                
                return createJump('error', $validate->getError());
            }
            
            
            $member_id = $this->setInfo($data);
            
            if ($member_id) {
             
                $member_info['member_id'] = $member_id;
                $member_info['nickname']  = $data['username'];
                
                $member_info_model = model('MemberInfo', 'logic');
                $member_info_model->setInfo($member_info);
                
                return createJump('success', '添加会员成功！', url('index'));
            } else {
                
                return createJump('error', '添加会员失败！');
            }
            
        }
        
    }
    
}
