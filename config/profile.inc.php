<?php

// 数据库配置
define('DB_HOST','127.0.0.1');					//主机IP	
define('DB_USER','root');						//账号
define('DB_PASS','root');						//密码
define('DB_NAME','cms');						//数据库

// 系统配置
define('GPC',get_magic_quotes_gpc());			//sql转义功能是否打开
define('PAGE_SIZE',10);							//每页多少条
define('PREV_URL', isset($_SEREVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/');//上一页地址
define('NAV_SIZE',10);							//主导航在前台显示的个数
define('UPDIR','/uploads/');					//上传主目录
define('MARK',ROOT_PATH.'/images/yc.png');		//水印图片

// 模板配置
define('TPL_DIR',ROOT_PATH.'/templates/');		//模板文件目录
define('TPL_C_DIR',ROOT_PATH.'/templates_c/');	//编译文件目录
define('CACHE_DIR',ROOT_PATH.'/cache/');		//缓存文件目录
