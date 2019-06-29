<?php

require dirname(__FILE__).'/init.inc.php';
// 载入tpl文件
$_list = new ListAction($_tpl);
$_list->getNav();
$_tpl->display('list.tpl');
