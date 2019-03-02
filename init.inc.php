<?php

// 设置utf-8编码
header('Content-Type:text/html;charset=utf-8');
// 网站根目录
define('ROOT_PATH',dirname(__FILE__));
// 引入配置
require ROOT_PATH.'/config/profile.inc.php';
// 引入缓存配置
require 'cache.inc.php';
// 引入数据库
require ROOT_PATH.'/includes/DB.class.php';
// 引入模板类
require ROOT_PATH.'/includes/Templates.class.php';
// 实例化模板类
$_tpl = new Templates();
