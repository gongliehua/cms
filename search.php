<?php

require dirname(__FILE__).'/init.inc.php';
// 载入tpl文件
$_search = new SearchAction($_tpl);
$_search->_action();
$_tpl->display('search.tpl');
