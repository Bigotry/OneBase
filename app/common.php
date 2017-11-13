<?php

/**
 * 应用公共（函数）文件
 */

use think\Db;

/**
 * 检测用户是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 */
function is_login()
{
    
    $member = session('member_auth');
    
    if (empty($member)) {
        
        return DATA_DISABLE;
    } else {
        
        return session('member_auth_sign') == data_auth_sign($member) ? $member['member_id'] : DATA_DISABLE;
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
 * 使用上面的函数与系统加密KEY完成字符串加密
 * @param  string $str 要加密的字符串
 * @return string 
 */
function data_md5_key($str, $key = '')
{
    
    return empty($key) ? data_md5($str, SYS_ENCRYPT_KEY) : data_md5($str, $key);
}

/**
 * 数据签名认证
 * @param  array  $data 被认证的数据
 * @return string       签名
 */
function data_auth_sign($data)
{
    
    // 数据类型检测
    if (!is_array($data)) : $data = (array)$data; endif;
    
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
    
    $return_id = is_null($member_id) ? is_login() : $member_id;
    
    return $return_id && (intval($return_id) === SYS_ADMINISTRATOR_ID);
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
    
    if (!is_array($list)):
    return false;
    endif;
    
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

            is_object($refer[$parentId]) && $refer[$parentId] = $refer[$parentId]->toArray();
            
            $parent =& $refer[$parentId];

            $parent[$child][] =& $list[$key];
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
 * 获取单例对象
 */
function get_sington_object($object_name = '', $class = null)
{

    $request = \think\Request::instance();
    
    $request->__isset($object_name) ?: $request->bind($object_name, new $class());
    
    return $request->__get($object_name);
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
        
        if (is_dir($path . SYS_DS_PROS . $v)) : unset($file[$k]); endif;
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
    
    $class = SYS_ADDON_DIR_NAME. SYS_DS_CONS . $lower_name . SYS_DS_CONS . $name;
    
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

    $parse_url  =  parse_url($url);
    $addons     =  $parse_url['scheme'];
    $controller =  $parse_url['host'];
    $action     =  $parse_url['path'];

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
    
    $table_string = strtolower($name);
    
    if (!empty($join)) {
        
        foreach ($join as $v) {
            
            $names = explode(' ', $v[0]);
            
            $table_name = str_replace('_', '', str_replace(SYS_DB_PREFIX, '', $names[0]));
            
            $table_string .= strtolower($table_name);
        }
    }
    
    $auto_cache_info = cache(AUTO_CACHE_KEY);
    
    empty($auto_cache_info[CACHE_TABLE_KEY][$table_string]) && $auto_cache_info[CACHE_TABLE_KEY][$table_string][CACHE_VERSION_KEY] = DATA_DISABLE;
    
    $auto_cache_info[CACHE_TABLE_KEY][$table_string][CACHE_LAST_GET_TIME_KEY] = TIME_NOW;
    
    cache(AUTO_CACHE_KEY, $auto_cache_info, DATA_DISABLE);
    
    return $table_string;
}

/**
 * 获取缓存key
 */
function get_cache_key($name, $where, $field, $order, $paginate, $join, $group, $limit, $data, $cache_tag)
{
    
    $auto_cache_info = cache(AUTO_CACHE_KEY);
    
    $version = '';
    
    if (!empty($join)) {
        
        foreach ($join as $v) {
            
            $names = explode(' ', $v[0]);
            
            $table_name = strtolower(str_replace('_', '', str_replace(SYS_DB_PREFIX, '', $names[0])));
            
            $version .= $auto_cache_info[CACHE_TABLE_KEY][$table_name][CACHE_VERSION_KEY];
        }
    } else {
        
        $version .= $auto_cache_info[CACHE_TABLE_KEY][strtolower($name)][CACHE_VERSION_KEY];
    }
    
    $param = request()->param();
    
    $key = md5(serialize(compact('name', 'where', 'field', 'order', 'paginate', 'join', 'group', 'limit', 'data', 'param', 'version')));
    
    $auto_cache = check_cache_key($key, $auto_cache_info, $cache_tag);
    
    cache(AUTO_CACHE_KEY, $auto_cache, DATA_DISABLE);
    
    return $key;
}

/**
 * 检查缓存key
 */
function check_cache_key($key = null, $auto_cache_info = null, $cache_tag = null)
{
    
    if (count($auto_cache_info[CACHE_CACHE_KEY]) >= $auto_cache_info[CACHE_MAX_NUMBER_KEY]) {
        
        unset($auto_cache_info[CACHE_CACHE_KEY][DATA_DISABLE]);
        
        $auto_cache_info[CACHE_CACHE_KEY] = array_values($auto_cache_info[CACHE_CACHE_KEY]);
    }
    
    if (!in_array($key, $auto_cache_info[CACHE_CACHE_KEY])) {
        
        $auto_cache_info[CACHE_CACHE_KEY][] = $key;
        
        isset($auto_cache_info[CACHE_TABLE_KEY][$cache_tag][CACHE_NUMBER_KEY]) ? $auto_cache_info[CACHE_TABLE_KEY][$cache_tag][CACHE_NUMBER_KEY]++ : $auto_cache_info[CACHE_TABLE_KEY][$cache_tag][CACHE_NUMBER_KEY] = DATA_NORMAL;
        isset($auto_cache_info[CACHE_NUMBER_KEY]) ? $auto_cache_info[CACHE_NUMBER_KEY]++ : $auto_cache_info[CACHE_NUMBER_KEY] = DATA_NORMAL;
    }
    
    return $auto_cache_info;
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

/**
 * 获取图片url
 */
function get_picture_url($id = 0)
{
    
    $info = model('Picture')->where(['id' => $id])->field('path,url')->find();

    if (!empty($info['url']))  : return config('static_domain') . SYS_DS_PROS . $info['url'];  endif;

    if (!empty($info['path'])) : return '/upload/picture/'.$info['path'];  endif;

    return '/static/admin/img/onimg.png';
}

/**
 * 获取文件url
 */
function get_file_url($id = 0)
{
    
    $info = model('File')->where(['id' => $id])->field('path,url')->find();

    if (!empty($info['url']))  : return config('static_domain') . SYS_DS_PROS . $info['url'];  endif;

    if (!empty($info['path'])) : return '/upload/file/'.$info['path'];  endif;

    return '暂无文件';
}

/**
 * 导出excel信息
 * @param string  $titles    导出的表格标题
 * @param string  $keys      需要导出的键名
 * @param array   $data      需要导出的数据
 * @param string  $file_name 导出的文件名称
 */
function export_excel($titles = '', $keys = '', $data = [], $file_name = '导出文件' )
{
    
    $objPHPExcel = get_excel_obj($file_name);
        
    $y = 1;
    $s = 0;

    $titles_arr = str2arr($titles);

    foreach ($titles_arr as $k => $v) : $objPHPExcel->setActiveSheetIndex($s)->setCellValue(string_from_column_index($k). $y, $v); endforeach;

    $keys_arr = str2arr($keys);

    foreach ($data as $k => $v)
    {

        is_object($v) && $v = $v->toArray();
        
        foreach ($v as $kk => $vv)
        {
            
            $num = array_search($kk, $keys_arr);
            
            false !== $num && $objPHPExcel->setActiveSheetIndex($s)->setCellValue(string_from_column_index($num) . ($y + $k + 1), $vv );
        }
    }

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    
    $objWriter->save('php://output'); exit;
}



/**
 * 获取excel
 */
function get_excel_obj($file_name = '导出文件')
{
    
    set_time_limit(0);

    vendor('phpoffice/phpexcel/Classes/PHPExcel');

    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
    header("Content-Type:application/force-download");
    header("Content-Type:application/vnd.ms-execl");
    header("Content-Type:application/octet-stream");
    header("Content-Type:application/download");
    header('Content-Disposition:attachment;filename='.iconv("utf-8", "gb2312", $file_name).'.xlsx');
    header("Content-Transfer-Encoding:binary");
    
    return new PHPExcel();
}

/**
 * 数字转字母
 */
function  string_from_column_index($pColumnIndex = 0)
{
    static $_indexCache = [];
    
    if(!isset($_indexCache[$pColumnIndex]))
    {
        
        if($pColumnIndex < 26){
            
            $_indexCache[$pColumnIndex] = chr(65 + $pColumnIndex);
        }elseif($pColumnIndex < 702){
            
            $_indexCache[$pColumnIndex] = chr(64 + ($pColumnIndex / 26)).chr(65 + $pColumnIndex % 26);
        }else{
            
            $_indexCache[$pColumnIndex] = chr(64 + (($pColumnIndex - 26) / 676 )).chr(65 + ((($pColumnIndex - 26) % 676) / 26 )).  chr( 65 + $pColumnIndex % 26);
        }
    }
    
    return $_indexCache[$pColumnIndex];
}

/**
 * 页面数组提交后格式转换 
 */
function transform_array($array)
{

    $new_array = array();
    $key_array = array();

    foreach ($array as $key=>$val) {

        $key_array[] = $key;
    }

    $key_count = count($key_array);

    foreach ($array[$key_array[0]] as $i => $val) {
        
        $temp_array = array();

        for( $j=0;$j<$key_count;$j++ ){

            $key = $key_array[$j];
            $temp_array[$key] = $array[$key][$i];
        }

        $new_array[] = $temp_array;
    }

    return $new_array;
}

/**
 * 页面数组转换后的数组转json
 */
function transform_array_to_json($array)
{
    
    return json_encode(transform_array($array));
}

/**
 * 关联数组转索引数组
 */
function relevance_arr_to_index_arr($array)
{
    
    $new_array = [];
    
    foreach ($array as $v)
    {
        
        $temp_array = [];
        
        foreach ($v as $vv)
        {
            $temp_array[] = $vv;
        }
        
        $new_array[] = $temp_array;
    }
    
    return $new_array;
}

/**
 * 获取页面范围
 */
function get_page_number_scope($current_page = 0, $last_page = 0, $offset = 3, $page_number = 7)
{
    
    $init = DATA_SUCCESS;

    $max = $last_page;

    if($last_page > $page_number)
    {
        if($current_page <= $offset){

            $max    = $page_number;
        }else if($current_page + $offset >= $last_page){

            $init   = $last_page - $page_number + $init;
            $max    = $last_page;
        } else {

            $init   = $current_page - $offset;
            $max    = $current_page + $offset;
        }
    }
    
    return ['init' => $init, 'max' => $max];
}

/**
 * 获取分页HTML
 */
function get_page_html($current_page = 0, $last_page = 0, $offset = 3, $page_number = 7)
{
    
    $data = get_page_number_scope($current_page, $last_page, $offset, $page_number);

    $spans  = '';

    for($i = $data['init']; $i <= $data['max']; $i++) :  $spans .= $i == $current_page ? "<span class='current'>".$i."</span>" : "<a href='?page=$i'><span>$i</span></a>"; endfor;

    $next   = '';
    $current_page_next = $current_page + DATA_SUCCESS;

    if ($current_page < $last_page) : $next =  "<a class='next' href='?page=$current_page_next'>下一页</a>"; endif;

    $prev = '';
    $current_page_prev = $current_page - DATA_SUCCESS;
    
    if ($current_page > DATA_SUCCESS) : $prev =  "<a class='prev' href='?page=$current_page_prev'>上一页</a>"; endif;

    $tmpl = "<div class='onebase pagination pagination-right pagination-large'>
                <div>
                    $prev
                    $spans
                    $next
                </div>
            </div>";
    
    return $tmpl;
}

// 获取访问token
function get_access_token()
{

    return md5('OneBase' . date("Ymd") . API_KEY);
}

/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function format_bytes($size, $delimiter = '')
{
    
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    
    for ($i = 0; $size >= 1024 && $i < 5; $i++) : $size /= 1024; endfor;
    
    return round($size, 2) . $delimiter . $units[$i];
}

/**
 * 时间戳格式化
 * @param int $time
 * @return string 完整的时间显示
 * @author huajie <banhuajie@163.com>
 */
function format_time($time = null, $format='Y-m-d H:i:s')
{
    
    if (null === $time) : $time = TIME_NOW; endif;
    
    return date($format, intval($time));
}

/**
 * 删除所有空目录 
 * @param String $path 目录路径 
 */
function rm_empty_dir($path)
{
    
    if (!(is_dir($path) && ($handle = opendir($path))!==false)) : return false; endif;
      
    while(($file = readdir($handle))!==false)
    {

        if(!($file != '.' && $file != '..')) : continue; endif;
        
        $curfile = $path . SYS_DS_PROS . $file;// 当前目录

        if(!is_dir($curfile)) : continue; endif;

        rm_empty_dir($curfile);

        if(count(scandir($curfile)) == 2) : rmdir($curfile); endif;
    }

    closedir($handle); 
}

/**
 * 通过类创建逻辑闭包
 */
function create_closure($class = null, $method_name = '', $parameter = [])
{
    
    $func = function() use($class, $method_name, $parameter)
            {
        
                $object = get_sington_object($class, $class);
        
                return call_user_func_array([$object, $method_name], $parameter);
            };
            
    return $func;
}

/**
 * 通过闭包列表控制事务
 */
function closure_list_exe($list = [])
{
    
    Db::startTrans();
    
    try {
        
        foreach ($list as $closure) : $closure(); endforeach;
        
        Db::commit();
        
        return true;
    } catch (\Exception $e) {
        
        Db::rollback();
        
        throw $e;
    }
}

/**
 * 写入执行信息记录
 */
function write_exe_log($begin = 'app_begin', $end = 'app_end', $type = 0)
{
    
    if(empty(config('is_write_exe_log'))) : return false; endif;
    
    $source_url = empty($_SERVER["HTTP_REFERER"]) ? '未知来源' : $_SERVER["HTTP_REFERER"];
    
    $exe_log['ip']              = request()->ip();
    $exe_log['exe_url']         = request()->url();
    $exe_log['exe_time']        = number_format((float)debug($begin, $end), 6);
    $exe_log['exe_memory']      = number_format((float)debug($begin, $end, 'm'), 2);
    $exe_log['exe_os']          = get_os();
    $exe_log['source_url']      = $source_url;
    $exe_log['session_id']      = session_id();
    $exe_log['browser']         = browser_info();
    $exe_log['status']          = DATA_NORMAL;
    $exe_log['create_time']     = TIME_NOW;
    $exe_log['update_time']     = TIME_NOW;
    $exe_log['type']            = $type;
    $exe_log['login_id']        = is_login();
    
    $exe_log_path = "../runtime/log/exe_log.php";
    
    file_exists($exe_log_path) && $now_contents = file_get_contents($exe_log_path);
    
    $arr = var_export($exe_log, true);
    
    empty($now_contents) ? $contents = "<?php\nreturn array (".$arr.");\n" : $contents = str_replace(');', ','. $arr . ');', $now_contents);
    
    file_put_contents($exe_log_path, $contents);
}

/**
 * 获得操作系统
 */
function get_os()
{
    if (!empty($_SERVER['HTTP_USER_AGENT'])) {
        $os = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/win/i', $os)) {
            $os = 'Windows';
        } else if (preg_match('/mac/i', $os)) {
            $os = 'MAC';
        } else if (preg_match('/linux/i', $os)) {
            $os = 'Linux';
        } else if (preg_match('/unix/i', $os)) {
            $os = 'Unix';
        } else if (preg_match('/bsd/i', $os)) {
            $os = 'BSD';
        } else {
            $os = 'Other';
        }
        return $os;
    } else {
        return 'unknow';
    }
}


/**
 * 获得浏览器
 */
function browser_info()
{
    if (!empty($_SERVER['HTTP_USER_AGENT'])) {
        $br = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/MSIE/i', $br)) {
            $br = 'MSIE';
        } else if (preg_match('/Firefox/i', $br)) {
            $br = 'Firefox';
        } else if (preg_match('/Chrome/i', $br)) {
            $br = 'Chrome';
        } else if (preg_match('/Safari/i', $br)) {
            $br = 'Safari';
        } else if (preg_match('/Opera/i', $br)) {
            $br = 'Opera';
        } else {
            $br = 'Other';
        }
        return $br;
    } else {
        return 'unknow';
    }
}
