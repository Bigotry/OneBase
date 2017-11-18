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
        
        if (data_md5_key($data['password']) !== $member['password']) : return CommonError::$passwordError; endif;
        
        $jwt_data = static::tokenSign($member);
        
        return [$jwt_data];
    }
    
    /**
     * 注册方法
     */
    public static function register($data)
    {
        
        $data['nickname']  = $data['username'];
        $data['password']  = data_md5_key($data['password']);

        $memberLogic = get_sington_object('memberLogic', LogicMember::class);
        
        return $memberLogic->setInfo($data);
    }
    
    /**
     * JWT验签方法
     */
    public static function tokenSign($member)
    {
        
        $key = API_KEY . JWT_KEY;
        
        $jwt_data = ['member_id' => $member['id'], 'nickname' => $member['nickname'], 'username' => $member['username'], 'create_time' => $member['create_time']];
        
        $token = [
            "iss"   => "OneBase JWT",         // 签发者
            "iat"   => TIME_NOW,              // 签发时间
            "exp"   => TIME_NOW + TIME_NOW,   // 过期时间
            "aud"   => 'OneBase',             // 接收方
            "sub"   => 'OneBase',             // 面向的用户
            "data"  => $jwt_data
        ];
        
        $jwt = JWT::encode($token, $key);
        
        $jwt_data['user_token'] = $jwt;
        
        return $jwt_data;
    }
    
    /**
     * 修改密码
     */
    public static function changePassword($data)
    {
        
        $member = get_member_by_token($data['user_token']);
        
        $memberLogic = get_sington_object('memberLogic', LogicMember::class);
        
        $member_info = $memberLogic->getMemberInfo(['id' => $member->member_id]);
        
        if (empty($data['old_password']) || empty($data['new_password'])) : return CommonError::$oldOrNewPassword; endif;
        
        if (data_md5_key($data['old_password']) !== $member_info['password']) : return CommonError::$passwordError; endif;

        $member_info['password'] = $data['new_password'];
        
        $result = $memberLogic->setInfo($member_info);
        
        return $result ? CodeBase::$success : CommonError::$changePasswordFail;
    }
    
    /**
     * 友情链接
     */
    public static function getBlogrollList()
    {
        
        $list = model('Blogroll')->getList([DATA_STATUS_NAME => DATA_NORMAL], true, 'sort desc,id asc', false);
        
        return [$list];
    }
}
