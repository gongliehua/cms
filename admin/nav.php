<?php

require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
// 入口
$_nav = new NavAction($_tpl);
$_nav->_action();
$_tpl->display('nav.tpl');
