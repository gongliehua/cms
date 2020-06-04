<?php

require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
// 入口
$_rotatain = new RotatainAction($_tpl);
$_rotatain->_action();
$_tpl->display('rotatain.tpl');
