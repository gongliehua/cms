# Host: localhost  (Version: 5.7.17)
# Date: 2020-05-03 01:37:11
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "cms_content"
#

DROP TABLE IF EXISTS `cms_content`;
CREATE TABLE `cms_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `nav` int(11) unsigned DEFAULT NULL COMMENT '栏目ID',
  `attr` varchar(20) DEFAULT NULL COMMENT '属性',
  `tag` varchar(30) DEFAULT NULL COMMENT '标签',
  `keyword` varchar(30) DEFAULT NULL COMMENT '关键字',
  `thumbnail` varchar(100) DEFAULT NULL COMMENT '缩略图',
  `source` varchar(20) DEFAULT NULL COMMENT '文章来源',
  `author` varchar(10) DEFAULT NULL COMMENT '作者',
  `info` varchar(200) DEFAULT NULL COMMENT '内容摘要',
  `content` text COMMENT '详细内容',
  `commend` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '允许评论，禁止评论',
  `count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `gold` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '消费金币',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `readlimit` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '阅读权限',
  `color` varchar(10) DEFAULT NULL COMMENT '颜色',
  `date` datetime DEFAULT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='内容表';

#
# Data for table "cms_content"
#


#
# Structure for table "cms_level"
#

DROP TABLE IF EXISTS `cms_level`;
CREATE TABLE `cms_level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `level_name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `level_info` varchar(255) DEFAULT '' COMMENT '说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='等级表';

#
# Data for table "cms_level"
#

INSERT INTO `cms_level` VALUES (1,'后台游客','仅有访问后台权限'),(2,'会员专员','仅有管理会员权限'),(3,'评论专员','仅有评论权限'),(4,'发帖专员','仅有发帖权限'),(5,'普通管理员','暂无描述'),(6,'超级管理员','暂无描述');

#
# Structure for table "cms_manage"
#

DROP TABLE IF EXISTS `cms_manage`;
CREATE TABLE `cms_manage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_user` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `admin_pass` char(40) NOT NULL DEFAULT '' COMMENT '密码',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '等级',
  `login_count` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `last_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '登录IP',
  `last_time` datetime DEFAULT NULL COMMENT '登录时间',
  `reg_time` datetime DEFAULT NULL COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='管理员表';

#
# Data for table "cms_manage"
#

INSERT INTO `cms_manage` VALUES (1,'admin','7c4a8d09ca3762af61e59520943dc26494f8941b',6,14,'127.0.0.1','2020-05-02 20:30:28',NULL),(2,'user','7c4a8d09ca3762af61e59520943dc26494f8941b',5,0,'',NULL,NULL),(3,'guest','7c4a8d09ca3762af61e59520943dc26494f8941b',1,0,'',NULL,NULL);

#
# Structure for table "cms_nav"
#

DROP TABLE IF EXISTS `cms_nav`;
CREATE TABLE `cms_nav` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nav_name` varchar(20) NOT NULL DEFAULT '' COMMENT '导航名',
  `nav_info` varchar(255) DEFAULT NULL COMMENT '导航说明',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `sort` int(11) unsigned DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='导航表';

#
# Data for table "cms_nav"
#

INSERT INTO `cms_nav` VALUES (1,'军事动态',NULL,0,NULL),(2,'八卦娱乐',NULL,0,NULL),(3,'时尚女人',NULL,0,NULL),(4,'科技频道',NULL,0,NULL),(5,'智能手机',NULL,0,NULL),(6,'美容护发',NULL,0,NULL),(7,'热门汽车',NULL,0,NULL),(8,'房产家居',NULL,0,NULL),(9,'读书教育',NULL,0,NULL),(10,'房产家居',NULL,0,NULL),(11,'股票基金',NULL,0,NULL),(12,'越南军事','',1,12);
