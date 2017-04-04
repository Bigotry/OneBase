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
 * 检测验证码
 * @param  integer $id 验证码ID
 * @return boolean     检测结果
 */
function check_verify($code, $id = 1)
{
    $verify = new \org\Verify();
    return $verify->check($code, $id);
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
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv 是否进行高级模式获取（有可能被伪装） 
 * @return mixed
 */
//function get_client_ip($type = 0,$adv=false)
//{
//    $type       =  $type ? 1 : 0;
//    static $ip  =   NULL;
//
//    if ($ip !== NULL) {
//        return $ip[$type];   
//    }
//
//    if ($adv) {
//
//        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
//            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
//            $pos    =   array_search('unknown',$arr);
//            if(false !== $pos) unset($arr[$pos]);
//            $ip     =   trim($arr[0]);
//        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
//            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
//        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
//            $ip     =   $_SERVER['REMOTE_ADDR'];
//        }
//    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
//        $ip     =   $_SERVER['REMOTE_ADDR'];
//    }
//    // IP地址合法验证
//    $long = sprintf("%u",ip2long($ip));
//
//    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
//
//    return $ip[$type];
//}


/**
 * 数据签名认证
 * @param  array  $data 被认证的数据
 * @return string       签名
 */
function data_auth_sign($data)
{
    //数据类型检测
    if (!is_array($data)) {
        $data = (array)$data;
    }
    
    ksort($data); //排序
    $code = http_build_query($data); //url编码并生成query字符串
    $sign = sha1($code); //生成签名
    
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
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId =  $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    
                    if(is_object($parent)) {
                        
                        $parent = $parent->toArray();
                    }
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    
    return $tree;
}

/**
 * 动态扩展左侧菜单,base.html里用到
 */
function extra_menu($extra_menu,&$base_menu)
{
    foreach ($extra_menu as $key=>$group) {
        if (isset($base_menu['child'][$key])) {
            $base_menu['child'][$key] = array_merge( $base_menu['child'][$key], $group);
        } else {
            $base_menu['child'][$key] = $group;
        }
    }
}


/**
 * 处理插件钩子
 * @param string $hook   钩子名称
 * @param mixed $params 传入参数
 * @return void
 */
function hook($hook,$params=array())
{
    \Think\Hook::listen($hook,$params);
}


/**
 * 获取插件类的类名
 * @param strng $name 插件名
 */
function get_addon_class($name)
{
    $class = "\\addons\\" . strtolower($name) . "\\{$name}";
    
    return $class;
}

/**
 * 获取插件类的配置文件数组
 * @param string $name 插件名
 */
function get_addon_config($name)
{
    $class = get_addon_class($name);
    
    if (class_exists($class)) {
        $addon = new $class();
        return $addon->getConfig();
    } else {
        return array();
    }
}

/**
 * 时间戳格式化
 * @param int $time
 * @return string 完整的时间显示
 */
function time_format($time = NULL, $format='Y-m-d H:i')
{
    $time = $time === NULL ? NOW_TIME : intval($time);
    
    return date($format, $time);
}

/**
 * 根据配置类型解析配置
 * @param  integer $type  配置类型
 * @param  string  $value 配置值
 */
function parse_config ($type, $value)
{
    switch ($type)
    {
        
        case 3: //解析数组
            
            $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
            
            if (strpos($value, ':')) {
                
                $value  = array();
                
                foreach ($array as $val) {
                    
                    list($k, $v) = explode(':', $val);
                    
                    $value[$k] = $v;
                }
            } else {
                $value = $array;
            }
            break;
    }
    
    return $value;
}

 // 分析枚举类型配置值 格式 a:名称1,b:名称2
function parse_config_attr($string)
{
    
    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
    
    if (strpos($string, ':')) {
        
        $value  =   array();
        
        foreach ($array as $val) {
            
            list($k, $v) = explode(':', $val);
            
            $value[$k]   = $v;
        }
        
    } else {
        $value  =   $array;
    }
    
    return $value;
}

/**
 * 获取配置的分组
 * @param string $group 配置分组
 * @return string
 */
function get_config_group($group = 0)
{
    
    $config_group_list = parse_config(3, config('config_group_list'));
    
    return $group ? $config_group_list[$group] : '';
}

/**
 * 获取配置的类型
 * @param string $type 配置类型
 * @return string
 */
function get_config_type($type = 0)
{
    
    $config_type_list = parse_config(3, config('config_type_list'));
    
    return $config_type_list[$type];
}



/**
 * 根据函数名称生成闭包函数
 * @param string $func_name 函数名称
 * @param array $parameter 参数数组
 * @return object closure 返回闭包函数
 */
function createClosureFunc( $func_name = '' , $parameter = array() )
{
    
    $func = function() use($func_name, $parameter)
            {
        
                if (empty($parameter)) {
                    
                    return call_user_func($func_name);
                } else {
                    
                    return call_user_func_array($func_name, $parameter);
                }
            };
            
    return $func;
}




/**
 * 创建跳转处理
 * $jump_method : success error redirect
 */
function createJump($jump_method  = '', $msg = '', $url = '', $data = '', $wait = 0)
{
    
    $exe_string = 'return $this->'.$jump_method.'(\''.$msg.'\'';
    
    if (!empty($url)) {
        
        $exe_string .= ', \''.$url.'\'';
    }
    
    $original_data = $data;
    
    if (!empty($data)) {
        
        if (is_array($data) || is_object($data)) {
            
            $data = serialize($data);
        }
       
        $exe_string .= ', \''.$data.'\'';
    }
    
    if (!empty($wait)) {
        
        $exe_string .= ', '.$wait;
    }
    
    config('after_operate', $exe_string .= ');');
    
    return $original_data;
}


/**
 * 加载模型
 * 若在控制器层则加载逻辑层
 * 若在逻辑层则加载数据层
 */
function load_model($name = '')
{

    //回溯跟踪
    $backtrace_array = debug_backtrace(false, 1);
    
    //调用者目录名称
    $current_directory_name = basename(dirname($backtrace_array[0]['file']));
    
    //返回的对象
    $return_object = null;
    
    //加载模型规则
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
function array_extract( $array, $key = 'id' )
{
    $count 	= count($array);
    $new_arr 	= array();
     
    for($i=0;$i<$count;$i++)
    {
        if(!empty($array) && !empty($array[$i][$key])){
            
            $new_arr[] = $array[$i][$key];
        }
    }
    
    return $new_arr;
}
