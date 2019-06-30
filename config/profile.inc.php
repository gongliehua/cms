<?php

// 数据库配置
define('DB_HOST','127.0.0.1');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','cms');

// 系统配置
define('GPC',get_magic_quotes_gpc());
define('PAGE_SIZE',10);
define('NAV_SIZE',10);
define('PREV_URL', isset($_SEREVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/');
define('UPDIR','/uploads/');

// 模板配置
define('TPL_DIR',ROOT_PATH.'/templates/');
define('TPL_C_DIR',ROOT_PATH.'/templates_c/');
define('CACHE_DIR',ROOT_PATH.'/cache/');
