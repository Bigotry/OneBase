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

// PHP版本验证需要大于5.6.0
if (version_compare(PHP_VERSION, '5.6.0', '<')) {
    
    die('OneBase Require PHP > 5.6.0 !');
}

// 设置跨域请求头
header("Access-Control-Allow-Origin: *");
// 如果需要自定义请求头时，直接把请求头添加到下面的参数里面即可
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
// 前端VUE框架自定义Header头请求API时，会发起一次预请求，thinkphp默认是拒绝OPTIONS类型的请求的
// 判断是否是OPTIONS请求，是的话直接exit结束，直接让浏览器返回200
if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
	exit;
}

// 定义应用目录
define('APP_PATH', __DIR__ . '/../app/');

// 检测是否安装
if (!file_exists(APP_PATH . 'database.php')) {
    
    header("location:./install.php");
    exit;
}

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
