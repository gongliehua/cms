<?php

require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
// 入口
$_link = new LinkAction($_tpl);
$_link->_action();
$_tpl->display('link.tpl');
