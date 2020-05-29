<?php

require dirname(__FILE__).'/init.inc.php';
// 载入tpl文件
$_list = new RegisterAction($_tpl);
$_list->_action();
$_tpl->display('register.tpl');
