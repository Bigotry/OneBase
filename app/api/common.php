<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

use \Firebase\JWT\JWT;

// 解密user_token
function decoded_user_token($token = '')
{
    
    $decoded = JWT::decode($token, API_KEY . JWT_KEY, array('HS256'));

    return (array) $decoded;
}

// 获取解密信息中的data
function get_member_by_token($token = '')
{
    
    $result = decoded_user_token($token);

    return $result['data'];
}