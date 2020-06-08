<?php

// 数据库配置
define('DB_HOST','127.0.0.1');					//主机IP	
define('DB_USER','root');						//账号
define('DB_PASS','root');						//密码
define('DB_NAME','cms');						//数据库

// 系统配置
define('GPC',get_magic_quotes_gpc());			//sql转义功能是否打开
define('PREV_URL', isset($_SEREVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/');
define('MARK',ROOT_PATH.'/images/yc.png');		//水印图片
// 模板配置
define('TPL_DIR',ROOT_PATH.'/templates/');		//模板文件目录
define('TPL_C_DIR',ROOT_PATH.'/templates_c/');	//编译文件目录
define('CACHE_DIR',ROOT_PATH.'/cache/');		//缓存文件目录

// 网站配置
define('WEBNAME', '飘城Web俱乐部');
define('PAGE_SIZE',10);							//每页多少条
define('ARTICLE_SIZE',8);						//文档每页条数
define('NAV_SIZE',10);							//主导航在前台显示的个数
define('UPDIR','/uploads/');					//上传主目录
// 轮播器配置
define('RO_TIME', 3);							//轮播器的时间
define('RO_NUM', 3);							//轮播器的个数
// 广告服务
define('ADVER_TEXT_NUM', 5);					//最多文字广告数
define('ADVER_PIC_NUM', 3);						//最多图片广告数
