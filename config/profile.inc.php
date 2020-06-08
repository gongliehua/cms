<?php

// 可配置项
define('WEBNAME', '飘城Web俱乐部');
define('PAGE_SIZE', 10);
define('ARTICLE_SIZE', 8);
define('NAV_SIZE', 10);
define('UPDIR', '/uploads/');
define('RO_TIME', 3);
define('RO_NUM', 3);
define('ADVER_TEXT_NUM', 5);
define('ADVER_PIC_NUM', 3);

// 固定配置
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'cms');
define('GPC', get_magic_quotes_gpc());
define('PREV_URL', isset($_SEREVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/');
define('MARK', ROOT_PATH.'/images/yc.png');
define('TPL_DIR', ROOT_PATH.'/templates/');
define('TPL_C_DIR', ROOT_PATH.'/templates_c/');
define('CACHE_DIR', ROOT_PATH.'/cache/');
