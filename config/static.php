<?php

// 设置utf-8编码
header('Content-Type: text/html; charset=UTF-8');
// 网站根目录
define('ROOT_PATH',dirname(__DIR__));
// 引入配置
require ROOT_PATH.'/config/profile.inc.php';
// 自动加载
spl_autoload_register(function($_className){
    if (substr($_className,-6) == 'Action') {
        require ROOT_PATH.'/action/'.$_className.'.class.php';
    } elseif (substr($_className,-5) == 'Model') {
        require ROOT_PATH.'/model/'.$_className.'.class.php';
    } else {
        require ROOT_PATH.'/includes/'.$_className.'.class.php';
    }
});

$_id = $_GET['id'];
$_content = new ContentModel();
$_content->id = $_id;
$_count = $_content->getOneContent()->count;
echo "function get(){
	document.write('$_count');
	}";
