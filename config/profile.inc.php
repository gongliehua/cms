<?php

// 数据库配置
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','cms');

// 系统配置
define('GPC',get_magic_quotes_gpc());
define('PAGE_SIZE',10);
define('NAV_SIZE',10);

// 模板配置
define('TPL_DIR',ROOT_PATH.'/templates/');
define('TPL_C_DIR',ROOT_PATH.'/templates_c/');
define('CACHE_DIR',ROOT_PATH.'/cache/');
