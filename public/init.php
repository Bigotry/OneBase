<?php

// 定义应用目录
define('APP_PATH', __DIR__ . '/../app/');

// 解决跨域问题
header("Access-Control-Allow-Origin: *");

// 框架引导文件路径
define('FRAMEWORK_START_PATH', __DIR__ . '/../thinkphp/start.php');