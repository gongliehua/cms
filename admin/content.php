<?php

require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
// 入口
$_level = new ContentAction($_tpl);
$_level->_action();
$_tpl->display('content.tpl');
