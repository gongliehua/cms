<?php

require dirname(__FILE__).'/init.inc.php';
// 载入tpl文件
$_cast = new CastAction($_tpl);
$_cast->_action();
$_tpl->display('cast.tpl');
