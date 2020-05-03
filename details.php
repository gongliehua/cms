<?php

require dirname(__FILE__).'/init.inc.php';
// 载入tpl文件
$_details = new DetailsAction($_tpl);
$_details->_action();
$_tpl->display('details.tpl');
