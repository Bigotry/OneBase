<?php

use \Firebase\JWT\JWT;

// 获取访问token
function get_access_token()
{

    return md5('OneBase' . date("YmdHi") . API_KEY);
}

// 解密user_token
function decoded_user_token($token = '')
{
    
    $decoded = JWT::decode($token, API_KEY . '_onebase', array('HS256'));

    return (array) $decoded;
}

// 获取解密信息中的data
function get_member_by_token($token = '')
{
    
    $result = decoded_user_token($token);

    return $result['data'];
}