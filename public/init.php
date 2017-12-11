<?php

// PHP版本验证需要大于5.6.0
if(version_compare(PHP_VERSION, '5.6.0', '<')) : die('OneBase Require PHP > 5.6.0 !'); endif;

// 定义应用目录
define('APP_PATH', __DIR__ . '/../app/');

// 框架引导文件路径
define('FRAMEWORK_START_PATH', __DIR__ . '/../thinkphp/start.php');