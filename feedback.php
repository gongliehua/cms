<?php

require dirname(__FILE__).'/init.inc.php';
// 载入tpl文件
$_feedback = new FeedBackAction($_tpl);
$_feedback->_action();
$_tpl->display('feedback.tpl');
