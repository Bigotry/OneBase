<?php
// +---------------------------------------------------------------------+
// | OneBase    | [ WE CAN DO IT JUST THINK ]                            |
// +---------------------------------------------------------------------+
// | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )           |
// +---------------------------------------------------------------------+
// | Author     | Bigotry <3162875@qq.com>                               |
// +---------------------------------------------------------------------+
// | Repository | https://gitee.com/Bigotry/OneBase                      |
// +---------------------------------------------------------------------+

// 解析字符串中的{$变量}
function parse_string_val($string, $vars)
{
    
    $taglib_begin   = '{';
    $taglib_end     = '}';
    
    $pattern = '/('.$taglib_begin.').*?('.$taglib_end.')/is';
    
    $results = [];
    
    preg_match_all($pattern, $string, $results);
    
    foreach ($results[0] as $v)
    {
        
        $del_start = substr($v, 2);
        
        $del_end = substr($del_start, 0, strlen($del_start) - 1); 
        
        $string = isset($vars[$del_end]) ? str_replace($v, $vars[$del_end], $string) : sr($string, $v);
    }
    
    return $string;
}