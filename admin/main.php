<?php

require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
$_tpl->display('main.tpl');
