<?php

require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
// 入口
$_comment = new CommentAction($_tpl);
$_comment->_action();
$_tpl->display('comment.tpl');
