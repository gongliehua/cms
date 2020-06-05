<?php

require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
// 入口
$_vote = new VoteAction($_tpl);
$_vote->_action();
$_tpl->display('vote.tpl');
