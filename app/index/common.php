<?php

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
        
        if (isset($vars[$del_end])) {
            
            $string = str_replace($v, $vars[$del_end], $string);
        } else {
            
            $string = str_replace($v, '', $string);
        }
    }
    
    return $string;
}