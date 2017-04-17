<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

/**
 * 登录逻辑
 */
class Login extends AdminBase
{
    
    /**
     * 登录处理
     */
    public function loginHandle($username = '', $password = '', $verify = '')
    {

        if (empty($username) || empty($password)) {

            return [RESULT_ERROR, '账号或密码不能为空', null];
            
        }elseif (!captcha_check($verify)) {
            
            return [RESULT_ERROR, '验证码输入错误', null];
        }
            
        $model = model('Member', LAYER_LOGIC_NAME);
        
        $member = $model->getMemberInfo(['username' => $username]);

        if (empty($member)) {

            return [RESULT_ERROR, '用户不存在', null];
        }
        
        // 验证用户密码
        if (data_md5($password, DATA_ENCRYPT_KEY) === $member['password']) {
            
            $auth = ['member_id' => $member['id'], DATA_UPDATE_TIME => $member[DATA_UPDATE_TIME]];

            session('member_auth', $auth);
            session('member_auth_sign', data_auth_sign($auth));

            return [RESULT_SUCCESS, '登录成功', url('Index/index')];

        } else {
            
            return [RESULT_ERROR, '密码输入错误', null];
        }
    }
    
    /**
     * 注销当前用户
     */
    public function logout()
    {
        
        session('member_auth', null);
        session('member_auth_sign', null);
        session('[destroy]');
        
        return [RESULT_SUCCESS, '注销成功', url('Login/login')];
    }
}
