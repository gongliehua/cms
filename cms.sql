﻿# Host: localhost  (Version: 5.7.17)
# Date: 2019-04-24 09:21:13
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='等级表';

#
# Data for table "cms_level"
#

/*!40000 ALTER TABLE `cms_level` DISABLE KEYS */;
INSERT INTO `cms_level` VALUES (1,'后台游客','仅有访问后台权限'),(2,'会员专员','仅有管理会员权限'),(3,'评论专员','仅有评论权限'),(4,'发帖专员','仅有发帖权限'),(5,'普通管理员','暂无描述'),(6,'超级管理员','暂无描述');
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='管理员表';

#
# Data for table "cms_manage"
#

/*!40000 ALTER TABLE `cms_manage` DISABLE KEYS */;
INSERT INTO `cms_manage` VALUES (1,'admin','7c4a8d09ca3762af61e59520943dc26494f8941b',6,0,'000.000.000.000',NULL,NULL),(2,'user','7c4a8d09ca3762af61e59520943dc26494f8941b',5,0,'000.000.000.000',NULL,NULL),(3,'guest','7c4a8d09ca3762af61e59520943dc26494f8941b',1,0,'000.000.000.000',NULL,NULL);
/*!40000 ALTER TABLE `cms_manage` ENABLE KEYS */;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='导航表';

#
# Data for table "cms_nav"
#

/*!40000 ALTER TABLE `cms_nav` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_nav` ENABLE KEYS */;