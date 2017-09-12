<?php

use \Firebase\JWT\JWT;

function decoded_user_token($token = '')
{
    $key = SYS_ENCRYPT_KEY . "_onebase";

    $decoded = JWT::decode($token, $key, array('HS256'));

    return (array) $decoded;
}

function get_member_by_token($token = '')
{
    
    $result = decoded_user_token($token);

    return $result['data'];
}