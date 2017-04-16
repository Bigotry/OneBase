<?php

/**
 * 应用公共（函数）文件
 */


/**
 * 检测用户是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 */
function is_login()
{
    
    $member = session('member_auth');
    
    if (empty($member)) {
        
        return 0;
    } else {
        
        return session('member_auth_sign') == data_auth_sign($member) ? $member['member_id'] : 0;
    }
}

/**
 * 系统非常规MD5加密方法
 * @param  string $str 要加密的字符串
 * @return string 
 */
function data_md5($str, $key = 'OneBase')
{
    
    return '' === $str ? '' : md5(sha1($str) . $key);
}

/**
 * 数据签名认证
 * @param  array  $data 被认证的数据
 * @return string       签名
 */
function data_auth_sign($data)
{
    
    // 数据类型检测
    if (!is_array($data)) {
        
        $data = (array)$data;
    }
    
    // 排序
    ksort($data);
    
    // url编码并生成query字符串
    $code = http_build_query($data);
    
    // 生成签名
    $sign = sha1($code);
    
    return $sign;
}

/**
 * 检测当前用户是否为管理员
 * @return boolean true-管理员，false-非管理员
 */
function is_administrator($member_id = null)
{
    
    $member_id = is_null($member_id) ? is_login() : $member_id;
    
    return $member_id && (intval($member_id) === ADMINISTRATOR_ID);
}

/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 */
function list_to_tree($list, $pk='id', $pid = 'pid', $child = '_child', $root = 0)
{
    
    // 创建Tree
    $tree = [];
    
    if (is_array($list)) {
        
        // 创建基于主键的数组引用
        $refer = [];
        
        foreach ($list as $key => $data) {
            
            $refer[$data[$pk]] =& $list[$key];
        }
        
        foreach ($list as $key => $data) {
            
            // 判断是否存在parent
            $parentId =  $data[$pid];
            
            if ($root == $parentId) {
                
                $tree[] =& $list[$key];
                
            } else if(isset($refer[$parentId])){
                
                    $parent =& $refer[$parentId];
                    
                    if(is_object($parent)) {
                        
                        $parent = $parent->toArray();
                    }
                    
                    $parent[$child][] =& $list[$key];
            }
        }
    }
    
    return $tree;
}

/**
 * 分析数组及枚举类型配置值 格式 a:名称1,b:名称2
 * @return array
 */
function parse_config_attr($string)
{
    
    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
    
    if (strpos($string, ':')) {
        
        $value = [];
        
        foreach ($array as $val) {
            
            list($k, $v) = explode(':', $val);
            
            $value[$k] = $v;
        }
        
    } else {
        
        $value = $array;
    }
    
    return $value;
}

/**
 * 解析数组配置
 */
function parse_config_array($name = '')
{
    
    return parse_config_attr(config($name));
}

/**
 * 加载模型
 */
function load_model($name = '', $module = '')
{

    // 回溯跟踪
    $backtrace_array = debug_backtrace(false, 1);

    // 调用者目录名称
    $current_directory_name = basename(dirname($backtrace_array[0]['file']));

    // 设置模块
    !empty($module) && $name = $module.'/'.$name;

    // 返回的对象
    $return_object = null;

    // 加载模型规则
    switch ($current_directory_name) {

        case LAYER_CONTROLLER_NAME : $return_object = model($name, LAYER_LOGIC_NAME); break;
        case LAYER_LOGIC_NAME      : $return_object = model($name, LAYER_MODEL_NAME); break;
        case LAYER_SERVICE_NAME    : $return_object = model($name, LAYER_MODEL_NAME); break;
        default                    : $return_object = model($name, LAYER_LOGIC_NAME); break;
    }
    
    return $return_object;
}

/**
 * 将二维数组数组按某个键提取出来组成新的索引数组
 */
function array_extract($array, $key = 'id')
{
    
    $count = count($array);
    
    $new_arr = [];
     
    for($i = 0; $i < $count; $i++) {
        
        if (!empty($array) && !empty($array[$i][$key])) {
            
            $new_arr[] = $array[$i][$key];
        }
    }
    
    return $new_arr;
}

/**
 * 字符串转换为数组，主要用于把分隔符调整到第二个参数
 * @param  string $str  要分割的字符串
 * @param  string $glue 分割符
 * @return array
 */
function str2arr($str, $glue = ',')
{
    
    return explode($glue, $str);
}

/**
 * 数组转换为字符串，主要用于把分隔符调整到第二个参数
 * @param  array  $arr  要连接的数组
 * @param  string $glue 分割符
 * @return string
 */
function arr2str($arr, $glue = ',')
{
    
    return implode($glue, $arr);
}
