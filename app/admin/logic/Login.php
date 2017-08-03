<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

use app\common\logic\Member as LogicMember;

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

            return [RESULT_ERROR, '账号或密码不能为空'];
            
        }elseif (empty($verify)) {
            
            return [RESULT_ERROR, '验证码不能为空'];
        }elseif (!captcha_check($verify)) {
            
            return [RESULT_ERROR, '验证码输入错误'];
        }
        
        $memberLogic = get_sington_object('memberLogic', LogicMember::class);
        
        $member = $memberLogic->getMemberInfo(['username' => $username]);

        if (empty($member)) {

            return [RESULT_ERROR, '用户不存在'];
        }
        
        // 验证用户密码
        if (data_md5($password, SYS_ENCRYPT_KEY) === $member['password']) {
            
            $auth = ['member_id' => $member['id'], TIME_UT_NAME => $member[TIME_UT_NAME]];

            session('member_auth', $auth);
            session('member_auth_sign', data_auth_sign($auth));

            return [RESULT_SUCCESS, '登录成功', url('Index/index')];

        } else {
            
            return [RESULT_ERROR, '密码输入错误'];
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
