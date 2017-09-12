<?php

// 初始化系统
require  './init.php';

// 绑定操作到api模块
define('BIND_MODULE', 'api');

// 加载框架引导文件
require FRAMEWORK_START_PATH;