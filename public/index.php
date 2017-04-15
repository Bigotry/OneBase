<?php

// 定义应用目录
define('APP_PATH', __DIR__ . '/../app/');

// 绑定当前访问到index模块的index控制器
define('BIND_MODULE','admin');

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
