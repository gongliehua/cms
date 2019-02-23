<?php

require dirname(__FILE__).'/template.inc.php';
// 注入变量
$_tpl->assign('name','hello,world!');
// 载入tpl文件
$_tpl->display('index.tpl');
