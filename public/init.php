<?php

// PHP版本验证需要大于7.0.0
if(version_compare(PHP_VERSION, '7.0.0', '<')) : die('OneBase Require PHP > 7.0.0 !'); endif;

// 定义应用目录
define('APP_PATH', __DIR__ . '/../app/');

// 框架引导文件路径
define('FRAMEWORK_START_PATH', __DIR__ . '/../thinkphp/start.php');