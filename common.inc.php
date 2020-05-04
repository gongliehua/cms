<?php

if (defined('FRONT_CACHE') && FRONT_CACHE) {
	ob_start();
	$_tpl->cache(Tool::tplName());
}

// 模板句柄
$_nav = new NavAction($_tpl);
$_nav->showFront();
