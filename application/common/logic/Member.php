<?php

namespace app\common\logic;

/**
 * 会员模型
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
    
    /**
     * 用户登录认证
     */
    public function login($username = '', $password = '', $verify = '')
    {
        
        if (IS_POST) {
            
            if (empty($username) || empty($password)) {
                
                return createJump('error', '用户名或者密码不能为空！');
            }
            
            if (!check_verify($verify)) {
                
                return createJump('error', '验证码输入错误！');
            }
            
            $map = array();
            
            $email_pattern = "/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
            $mobile_pattern = "/^1[34578]{1}\d{9}$/";
            
            //检查登录类型
            if (is_numeric($username)) {
                
                $map['id'] = $username;
                
            } elseif (preg_match($email_pattern,$username)) {
            
                $map['email'] = $username;
                
            } elseif (preg_match($mobile_pattern,$username)) {
            
                $map['mobile'] = $username;
            } else {
                
                $map['username'] = $username;
            }
            
            $member = $this->getInfo($map);
            
            if (empty($member)) {
                
                return createJump('error', '用户不存在！');
            }
            
            //验证用户密码
            if (data_md5($password, DATA_ENCRYPT_KEY) === $member['password']) {

                $this->autoLogin($member); //更新用户登录信息

                return createJump('success', '登录成功！', url('Index/index'));

            } else {
                return createJump('error', '密码错误！');
            }
            
        } else {
            
            if (is_login()) {
               
                return createJump('redirect', 'Index/index');
            }
        }
        
    }


    /**
     * 自动登录用户
     * @param  integer $member 用户信息数组
     */
    private function autoLogin($member)
    {
        $data = array(
            'id'              => $member['id'],
            'last_login_time' => time(),
            'last_login_ip'   => get_client_ip(1),
        );
        
        $this->updateInfo($data);
        
        $auth = array(
            'member_id'       => $member['id'],
            'last_login_time' => $member['last_login_time'],
        );

        session('member_auth', $auth);
        session('member_auth_sign', data_auth_sign($auth));
    }

    
    /**
     * 注销当前用户
     * @return void
     */
    protected function logout()
    {
        if (is_login()) {
            
            session('member_auth', null);
            session('member_auth_sign', null);
            session('[destroy]');

            return createJump('success', '退出成功！', url('login'));
            
        } else {
            
            return createJump('redirect', url('login'));
        }
    }
    
}
