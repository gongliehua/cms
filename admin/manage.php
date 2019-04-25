<?php

require substr(dirname(__FILE__),0,-6).'/init.inc.php';

// 入口
$_manage = new ManageAction($_tpl);
$_manage->_action();
$_tpl->display('manage.tpl');
