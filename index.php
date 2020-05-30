<?php

require dirname(__FILE__).'/init.inc.php';
$_index = new IndexAction($_tpl);
$_index->_action();
// 载入tpl文件
$_tpl->display('index.tpl');

