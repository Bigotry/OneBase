<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\api\logic;

use app\api\error\CodeBase;
use app\api\error\Common as CommonError;
use app\common\logic\Member as LogicMember;
use \Firebase\JWT\JWT;

/**
 * 接口基础逻辑
 */
class Common extends ApiBase
{

    /**
     * 登录接口逻辑
     */
    public static function login($data = [])
    {
      
        $validate = validate('Member');
        
        $validate_result = $validate->scene('login')->check($data);
        
        if (!$validate_result) : return CommonError::$usernameOrPasswordEmpty; endif;
        
        $memberLogic = get_sington_object('memberLogic', LogicMember::class);
        
        begin:
        
        $member = $memberLogic->getMemberInfo(['username' => $data['username']]);

        // 若不存在用户则注册
        if (empty($member))
        {
            $register_result = static::register($data);
            
            if (!$register_result) : return CommonError::$registerFail; endif;
            
            goto begin;
        }
        
        if (data_md5($data['password'], SYS_ENCRYPT_KEY) !== $member['password']) : return CommonError::$passwordError; endif;
        
        $jwt_data = static::tokenSign($member);
        
        return [$jwt_data];
    }
    
    public static function register($data)
    {
        
        $data['nickname']  = $data['username'];
        $data['password']  = data_md5($data['password'], SYS_ENCRYPT_KEY);

        $memberLogic = get_sington_object('memberLogic', LogicMember::class);
        
        return $memberLogic->setInfo($data);
    }
    
    public static function tokenSign($member)
    {
        
        $key = SYS_ENCRYPT_KEY . "_onebase";
        
        $jwt_data = ['member_id' => $member['id'], 'nickname' => $member['nickname'], 'username' => $member['username'], 'create_time' => $member['create_time']];
        
        $time = time();
        
        $token = [
            "iss"   => "OneBase JWT",         // 签发者
            "iat"   => $time,                 // 签发时间
            "exp"   => $time + $time,         // 过期时间
            "aud"   => 'OneBase',             // 接收方
            "sub"   => 'OneBase',             // 面向的用户
            "data"  => $jwt_data
        ];
        
        $jwt = JWT::encode($token, $key);
        
        $jwt_data['user_token'] = $jwt;
        
        return $jwt_data;
    }
    
    
    public static function changePassword($data)
    {
        
        $member = get_member_by_token($data['user_token']);
        
        $memberLogic = get_sington_object('memberLogic', LogicMember::class);
        
        $member_info = $memberLogic->getMemberInfo(['id' => $member->member_id]);
        
        if (empty($data['old_password']) || empty($data['new_password'])) : return CommonError::$oldOrNewPassword; endif;
        
        $md5_password = data_md5($data['old_password'], SYS_ENCRYPT_KEY);
        
        if ($md5_password !== $member_info['password']) : return CommonError::$passwordError; endif;

        $member_info['password'] = $data['new_password'];
        
        $result = $memberLogic->setInfo($member_info);
        
        return $result ? CodeBase::$success : CommonError::$changePasswordFail;
    }
}
