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
        case LAYER_MODEL_NAME      : $return_object = model($name, LAYER_MODEL_NAME); break;
        default                    : $return_object = model($name, LAYER_LOGIC_NAME); break;
    }
    
    return $return_object;
}

/**
 * 将二维数组数组按某个键提取出来组成新的索引数组
 */
function array_extract($array = [], $key = 'id')
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
 * 根据某个字段获取关联数组
 */
function array_extract_map($array = [], $key = 'id'){
    
    
    $count = count($array);
    
    $new_arr = [];
     
    for($i = 0; $i < $count; $i++) {
        
        $new_arr[$array[$i][$key]] = $array[$i];
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

/**
 * 获取目录下所有文件
 */
function file_list($path = '')
{
    
    $file = scandir($path);
    
    foreach ($file as $k => $v) {
        
        if (is_dir($path . '/' . $v)) {

            unset($file[$k]);
        }
    }
    
    return array_values($file);
}

/**
 * 获取插件类的类名
 * @param strng $name 插件名
 */
function get_addon_class($name = '')
{
    
    $lower_name = strtolower($name);
    
    $class = ADDON_DIR_NAME."\\{$lower_name}\\{$name}";
    
    return $class;
}

/**
 * 钩子
 */
function hook($tag = '', $params = [])
{
    
    \think\Hook::listen($tag, $params);
}

/**
 * 保存文件
 */
function sf($arr = [], $fpath = 'D:\test.php')
{
    
    $data = "<?php\nreturn ".var_export($arr, true).";\n?>";
    
    file_put_contents($fpath, $data);
}

/**
 * 插件显示内容里生成访问插件的url
 * @param string $url url
 * @param array $param 参数
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function addons_url($url, $param = array())
{

    $url        =  parse_url($url);
    $addons     =  $url['scheme'];
    $controller =  $url['host'];
    $action     =  $url['path'];

    /* 基础参数 */
    $params_array = array(
        'addon_name'      => $addons,
        'controller_name' => $controller,
        'action_name'     => substr($action, 1),
    );

    $params = array_merge($params_array, $param); //添加额外参数
    
    return url('addon/execute', $params);
}


/**
 * 字符串命名风格转换
 * type 0 将Java风格转换为C的风格 1 将C风格转换为Java的风格
 * @param string $name 字符串
 * @param integer $type 转换类型
 * @return string
 */
function parse_name($name, $type=0)
{
    
    if ($type) {
        
        return ucfirst(preg_replace_callback('/_([a-zA-Z])/', function($match){return strtoupper($match[1]);}, $name));
    } else {
        
        return strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $name), "_"));
    }
}


/**
 * 获取目录列表
 */
function get_dir($dir_name)
{
    
    $dir_array = [];
    
    if (false != ($handle = opendir($dir_name))) {
        
        $i = 0;
        
        while (false !== ($file = readdir($handle))) {
            
            if ($file != "." && $file != ".."&&!strpos($file,".")) {
                
                $dir_array[$i] = $file;
                
                $i++;
            }
        }
        
        closedir($handle);
    }
    
    return $dir_array;
}


/**
 * 获取缓存标签
 */
function get_cache_tag($name, $join = null)
{
    
    $table_string = '';
    
    if (!empty($join['join'])) {
        
        foreach ($join['join'] as $v) {
            
            $names = explode(' ', $v[0]);
            
            $table_name = str_replace('_', '', str_replace(DB_PREFIX, '', $names[0]));
            
            $table_string .= $table_name;
        }
    } else {
        
        $table_string .= $name;
    }
    
    $auto_cache_info = cache(AUTO_CACHE_KEY);
    
    empty($auto_cache_info[CACHE_TABLE_KEY][$table_string]) && $auto_cache_info[CACHE_TABLE_KEY][$table_string][CACHE_VERSION_KEY] = DATA_DISABLE;
    
    cache(AUTO_CACHE_KEY, $auto_cache_info, DATA_DISABLE);
    
    return $table_string;
}

/**
 * 获取缓存key
 */
function get_cache_key($name, $where, $field, $order, $paginate, $join, $group, $limit, $data)
{
    
    $page = input('page', '');
    
    $version = '';
    
    $auto_cache_info = cache(AUTO_CACHE_KEY);
    
    if (!empty($join['join'])) {
        
        foreach ($join['join'] as $v) {
            
            $names = explode(' ', $v[0]);
            
            $table_name = strtolower(str_replace('_', '', str_replace(DB_PREFIX, '', $names[0])));
            
            $version .= $auto_cache_info[CACHE_TABLE_KEY][$table_name][CACHE_VERSION_KEY];
        }
    } else {
        
        $strtolower_name = strtolower($name);
        
        $version .= $auto_cache_info[CACHE_TABLE_KEY][$strtolower_name][CACHE_VERSION_KEY];
    }
    
    $serialize_data = compact('name', 'where', 'field', 'order', 'paginate', 'join', 'group', 'limit', 'data', 'page', 'version');
    
    $key = md5(serialize($serialize_data));
    
    if (count($auto_cache_info[CACHE_CACHE_KEY]) >= $auto_cache_info[CACHE_MAX_NUMBER_KEY]) {
        
        unset($auto_cache_info[CACHE_CACHE_KEY][DATA_DISABLE]);
        
        $auto_cache_info[CACHE_CACHE_KEY] = array_values($auto_cache_info[CACHE_CACHE_KEY]);
    }
    
    !in_array($key, $auto_cache_info[CACHE_CACHE_KEY]) && $auto_cache_info[CACHE_CACHE_KEY][] = $key;
    
    cache(AUTO_CACHE_KEY, $auto_cache_info, DATA_DISABLE);
    
    return $key;
}

/**
 * 设置缓存版本
 */
function set_cache_version($name = '')
{
    $auto_cache_info = cache(AUTO_CACHE_KEY);
    
    $strtolower_name = strtolower($name);
            
    ++$auto_cache_info[CACHE_TABLE_KEY][$strtolower_name][CACHE_VERSION_KEY];
    
    cache(AUTO_CACHE_KEY, $auto_cache_info, DATA_DISABLE);
}

/**
 * 设置缓存统计数量
 */
function set_cache_statistics_number($key = '')
{
    $auto_cache_info = cache(AUTO_CACHE_KEY);
    
    !empty($key) && ++$auto_cache_info[$key];
    
    cache(AUTO_CACHE_KEY, $auto_cache_info, DATA_DISABLE);
}