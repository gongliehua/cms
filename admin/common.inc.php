<?php

// 后台缓存开关
define('IS_CACHE',false);

// 判断是否开启缓冲区
IS_CACHE ? ob_start() : null;
