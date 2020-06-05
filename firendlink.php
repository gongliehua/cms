<?php

require dirname(__FILE__).'/init.inc.php';
// 载入tpl文件
$_firendlink = new FirendLinkAction($_tpl);
$_firendlink->_action();
$_tpl->display('firendlink.tpl');
