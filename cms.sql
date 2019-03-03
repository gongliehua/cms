# Host: localhost  (Version: 5.7.17)
# Date: 2019-03-03 16:55:32
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "cms_level"
#

DROP TABLE IF EXISTS `cms_level`;
CREATE TABLE `cms_level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `level_name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `level_info` varchar(255) DEFAULT '' COMMENT '说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='等级';

#
# Data for table "cms_level"
#

/*!40000 ALTER TABLE `cms_level` DISABLE KEYS */;
INSERT INTO `cms_level` VALUES (1,'后台游客','只有访问后台的权限'),(2,'会员专员','只有管理会员的权限\r\n'),(3,'评论专员',''),(4,'发帖专员',''),(5,'普通管理员',''),(6,'超级管理员','administrator');
/*!40000 ALTER TABLE `cms_level` ENABLE KEYS */;

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
  `last_ip` varchar(20) NOT NULL DEFAULT '000.000.000.000' COMMENT '登录IP',
  `last_time` datetime DEFAULT NULL COMMENT '登录时间',
  `reg_time` datetime DEFAULT NULL COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='管理员';

#
# Data for table "cms_manage"
#

/*!40000 ALTER TABLE `cms_manage` DISABLE KEYS */;
INSERT INTO `cms_manage` VALUES (1,'admin','da39a3ee5e6b4b0d3255bfef95601890afd80709',1,0,'000.000.000.000',NULL,'2019-03-03 13:48:13'),(2,'user','7c4a8d09ca3762af61e59520943dc26494f8941b',5,0,'000.000.000.000',NULL,'2019-03-03 13:48:22'),(4,'aaa','b6fe850602bd67665c1cb19f6fc4e0ecf46c9e2e',2,0,'000.000.000.000',NULL,'2019-03-03 16:23:36');
/*!40000 ALTER TABLE `cms_manage` ENABLE KEYS */;
