<?php

// 前台缓存开关
define('IS_CACHE',true);

if (IS_CACHE && !$_cache->noCache()) {
	ob_start();
	$_tpl->cache(Tool::tplName().'.tpl');
}

// 模板句柄
$_nav = new NavAction($_tpl);
$_nav->showFront();

$_cookie = new Cookie('user');
if (IS_CACHE) {
	$_tpl->assign('header','<script type="text/javascript">getHeader()</script>');
} else {
	if ($_cookie->getCookie()) {
		$_tpl->assign('header', $_cookie->getCookie().'，您好！<a href="register.php?action=logout">退出</a>');
	} else {
		$_tpl->assign('header', '<a href="register.php?action=reg" class="user">注册</a> <a href="register.php?action=login" class="user">登录</a>');
	}
}
