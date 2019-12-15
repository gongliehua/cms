<?php

// 是否开启缓冲区
define('IS_CACHE',true);
// 判断是否开启缓冲区
if (IS_CACHE) ob_start();

// 模板句柄
$_nav = new NavAction($_tpl);
$_nav->showFront();
