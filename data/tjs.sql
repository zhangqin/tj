/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : tj

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2013-04-28 14:12:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tj_2013tc`
-- ----------------------------
DROP TABLE IF EXISTS `tj_2013tc`;
CREATE TABLE `tj_2013tc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fc` varchar(30) DEFAULT NULL,
  `sss` varchar(30) DEFAULT NULL,
  `ss` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tj_2013tc
-- ----------------------------
INSERT INTO `tj_2013tc` VALUES ('1', '1', '1', '1');
INSERT INTO `tj_2013tc` VALUES ('2', 'ss66', '33', 'ff');
INSERT INTO `tj_2013tc` VALUES ('3', 'ff', 'ff', 'ff');

-- ----------------------------
-- Table structure for `tj_2014tc`
-- ----------------------------
DROP TABLE IF EXISTS `tj_2014tc`;
CREATE TABLE `tj_2014tc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tj_2014tc
-- ----------------------------

-- ----------------------------
-- Table structure for `tj_admin`
-- ----------------------------
DROP TABLE IF EXISTS `tj_admin`;
CREATE TABLE `tj_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(30) DEFAULT NULL,
  `admin_pwd` varchar(30) DEFAULT NULL,
  `admin_sex` int(1) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='体检管理者：1、老师  2、医生 3、管理者admin';

-- ----------------------------
-- Records of tj_admin
-- ----------------------------

-- ----------------------------
-- Table structure for `tj_backup`
-- ----------------------------
DROP TABLE IF EXISTS `tj_backup`;
CREATE TABLE `tj_backup` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_name` varchar(30) DEFAULT NULL,
  `b_path` varchar(30) DEFAULT NULL,
  `b_time` int(11) DEFAULT NULL,
  `b_comment` text,
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='体检系统的备份';

-- ----------------------------
-- Records of tj_backup
-- ----------------------------

-- ----------------------------
-- Table structure for `tj_backup_category`
-- ----------------------------
DROP TABLE IF EXISTS `tj_backup_category`;
CREATE TABLE `tj_backup_category` (
  `b_c_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_c_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`b_c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='体检系统的备份的分类';

-- ----------------------------
-- Records of tj_backup_category
-- ----------------------------

-- ----------------------------
-- Table structure for `tj_log`
-- ----------------------------
DROP TABLE IF EXISTS `tj_log`;
CREATE TABLE `tj_log` (
  `log_id` int(11) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='体检操作日志';

-- ----------------------------
-- Records of tj_log
-- ----------------------------

-- ----------------------------
-- Table structure for `tj_log_category`
-- ----------------------------
DROP TABLE IF EXISTS `tj_log_category`;
CREATE TABLE `tj_log_category` (
  `log_c_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`log_c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='体检日志的分类';

-- ----------------------------
-- Records of tj_log_category
-- ----------------------------

-- ----------------------------
-- Table structure for `tj_menu`
-- ----------------------------
DROP TABLE IF EXISTS `tj_menu`;
CREATE TABLE `tj_menu` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `m_name` varchar(20) NOT NULL COMMENT '菜单名字',
  `m_href` varchar(50) NOT NULL COMMENT '菜单链接',
  `m_parent_id` int(11) DEFAULT NULL COMMENT '菜单父分类id',
  `m_role_id` int(11) DEFAULT NULL COMMENT '菜单权限',
  `m_create_u_id` int(11) DEFAULT NULL,
  `m_create_time` int(11) DEFAULT NULL,
  `m_update_u_id` int(11) DEFAULT NULL,
  `m_update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tj_menu
-- ----------------------------
INSERT INTO `tj_menu` VALUES ('1', '体检管理', '', '0', '2', null, null, null, null);
INSERT INTO `tj_menu` VALUES ('2', '用户管理', '', '0', '2', null, null, null, null);
INSERT INTO `tj_menu` VALUES ('3', '系统管理', '', '0', '2', null, null, null, null);
INSERT INTO `tj_menu` VALUES ('4', '体检人', 'index.php/user/index', '2', '2', null, null, null, null);
INSERT INTO `tj_menu` VALUES ('5', '管理者', 'index.php/admin/index', '2', '2', null, null, null, null);
INSERT INTO `tj_menu` VALUES ('6', '数据库管理', 'index.php/data/index', '3', '2', null, null, null, null);
INSERT INTO `tj_menu` VALUES ('15', 'sdfsfsd', '', '0', '2', null, null, null, null);
INSERT INTO `tj_menu` VALUES ('7', '菜单管理', 'index.php/menu/index', '3', '2', null, null, null, null);
INSERT INTO `tj_menu` VALUES ('8', '日志管理', 'index.php/log/index', '3', '2', null, null, null, null);
INSERT INTO `tj_menu` VALUES ('9', '权限管理', 'index.php/admin/role', '2', '2', null, null, null, null);
INSERT INTO `tj_menu` VALUES ('10', '模板管理', 'index.php', '3', '2', null, null, null, null);
INSERT INTO `tj_menu` VALUES ('11', '体检项目', 'index.php/ctj/project', '1', '2', null, null, null, null);
INSERT INTO `tj_menu` VALUES ('12', '体检分类', 'index.php/ctj/tsort', '1', '2', null, null, null, null);
INSERT INTO `tj_menu` VALUES ('13', '体检结果', 'index.php/ctj/tresult', '1', '2', null, null, null, null);
INSERT INTO `tj_menu` VALUES ('14', '体检套餐', 'index.php/ctj/package', '1', '2', null, null, null, null);

-- ----------------------------
-- Table structure for `tj_package`
-- ----------------------------
DROP TABLE IF EXISTS `tj_package`;
CREATE TABLE `tj_package` (
  `pack_id` int(11) NOT NULL AUTO_INCREMENT,
  `pack_name` varchar(30) DEFAULT NULL,
  `pack_database` varchar(30) DEFAULT NULL,
  `pack_create_time` int(11) DEFAULT NULL,
  `pack_create_uid` int(11) DEFAULT NULL,
  `pack_update_uid` int(11) DEFAULT NULL,
  `pack_update_time` int(11) DEFAULT NULL,
  `pack_comment` text,
  PRIMARY KEY (`pack_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='体检套餐：选择体验内容构成体检表即为体检套餐';

-- ----------------------------
-- Records of tj_package
-- ----------------------------
INSERT INTO `tj_package` VALUES ('7', '2014', '2014tc', null, null, null, null, '2014套餐');
INSERT INTO `tj_package` VALUES ('6', '2013', '2013tc', null, null, null, null, '2013套餐');

-- ----------------------------
-- Table structure for `tj_project`
-- ----------------------------
DROP TABLE IF EXISTS `tj_project`;
CREATE TABLE `tj_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_id` int(11) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `unique` varchar(30) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='体检项目';

-- ----------------------------
-- Records of tj_project
-- ----------------------------
INSERT INTO `tj_project` VALUES ('1', '5', 'sss', 'sss', 'ssssss');
INSERT INTO `tj_project` VALUES ('2', '5', 'sssssssssss', 'sssf', 'ffffffffffff');
INSERT INTO `tj_project` VALUES ('3', '5', '我们', 'ff', 'fffffffff');
INSERT INTO `tj_project` VALUES ('4', '2', 'adf', 'aa', 'ff');
INSERT INTO `tj_project` VALUES ('9', '1', '早', 'ss', '昌');
INSERT INTO `tj_project` VALUES ('10', '1', '目上', 'fc', '要');

-- ----------------------------
-- Table structure for `tj_result`
-- ----------------------------
DROP TABLE IF EXISTS `tj_result`;
CREATE TABLE `tj_result` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `res_u_id` int(11) DEFAULT NULL COMMENT '体检结果用户id',
  `res_a_id` int(11) DEFAULT NULL COMMENT '体检医生id',
  `res_data` text COMMENT '体检结果',
  `res_comment` text COMMENT '体检结果注释',
  PRIMARY KEY (`res_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='体检结果';

-- ----------------------------
-- Records of tj_result
-- ----------------------------

-- ----------------------------
-- Table structure for `tj_role`
-- ----------------------------
DROP TABLE IF EXISTS `tj_role`;
CREATE TABLE `tj_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) DEFAULT NULL,
  `role_weight` int(10) DEFAULT NULL,
  `role_comment` text,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of tj_role
-- ----------------------------
INSERT INTO `tj_role` VALUES ('1', '医生', '101', '校医生的医生');
INSERT INTO `tj_role` VALUES ('2', '老师', '10', '华科的老师');

-- ----------------------------
-- Table structure for `tj_sort`
-- ----------------------------
DROP TABLE IF EXISTS `tj_sort`;
CREATE TABLE `tj_sort` (
  `sort_id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_name` varchar(30) DEFAULT NULL,
  `sort_desc` text,
  PRIMARY KEY (`sort_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='体检分类';

-- ----------------------------
-- Records of tj_sort
-- ----------------------------
INSERT INTO `tj_sort` VALUES ('1', 'skeletonsss', 'assssssssssssssssssssssss');
INSERT INTO `tj_sort` VALUES ('2', 'www', 'fdsf');
INSERT INTO `tj_sort` VALUES ('3', 'sssssssssssf', 'ffsfsadsfdsa');
INSERT INTO `tj_sort` VALUES ('5', '林', '要');

-- ----------------------------
-- Table structure for `tj_user`
-- ----------------------------
DROP TABLE IF EXISTS `tj_user`;
CREATE TABLE `tj_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tj_user
-- ----------------------------
