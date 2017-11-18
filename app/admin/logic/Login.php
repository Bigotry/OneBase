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

        if (empty($username) || empty($password)) : return [RESULT_ERROR, '账号或密码不能为空']; endif;
        
        $admin_allow_ip = parse_config_array('admin_allow_ip');
        
        $allow_ip = request()->ip();
        
        if (!empty($admin_allow_ip) && (string)$username == 'admin' && !in_array($allow_ip, $admin_allow_ip)) : return [RESULT_ERROR, '登录IP受限']; endif;
        
        if (empty($verify)) : return [RESULT_ERROR, '验证码不能为空']; endif;
       
        if (!captcha_check($verify)) : return [RESULT_ERROR, '验证码输入错误']; endif;
        
        $memberLogic = get_sington_object('memberLogic', LogicMember::class);
        
        $member = $memberLogic->getMemberInfo(['username' => $username]);

        if (empty($member)) : return [RESULT_ERROR, '用户不存在']; endif;
        
        // 验证用户密码
        if (data_md5_key($password) === $member['password']) {
            
            $memberLogic->setMemberValue(['id' => $member['id']], TIME_UT_NAME, TIME_NOW);
            
            $auth = ['member_id' => $member['id'], TIME_UT_NAME => TIME_NOW];
            
            session('member_info', $member);
            session('member_auth', $auth);
            session('member_auth_sign', data_auth_sign($auth));

            action_log('登录', '登录操作，username：'. $username);
            
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
        
        session('member_info', null);
        session('member_auth', null);
        session('member_auth_sign', null);
        session('[destroy]');
        
        return [RESULT_SUCCESS, '注销成功', url('Login/login')];
    }
    
    /**
     * 清理缓存
     */
    public function clearCache()
    {
        
        \think\Cache::clear();
        
        return [RESULT_SUCCESS, '清理成功', url('index/index')];
    }
}
