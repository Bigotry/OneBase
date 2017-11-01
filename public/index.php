<?php

// 初始化系统
require  './init.php';

// 检测是否安装
file_exists(APP_PATH . 'database.php') ?  define('BIND_MODULE', 'index') : define('BIND_MODULE', 'install');

// 加载框架引导文件
require FRAMEWORK_START_PATH;
