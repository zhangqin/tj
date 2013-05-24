-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 05 月 23 日 20:15
-- 服务器版本: 5.5.31
-- PHP 版本: 5.4.6-1ubuntu1.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `tj`
--

-- --------------------------------------------------------

--
-- 表的结构 `tj_2013tc`
--

CREATE TABLE IF NOT EXISTS `tj_2013tc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fc` varchar(30) DEFAULT NULL,
  `sss` varchar(30) DEFAULT NULL,
  `ss` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tj_2013tc`
--

INSERT INTO `tj_2013tc` (`id`, `fc`, `sss`, `ss`) VALUES
(1, '1', '1', '1'),
(2, 'ss66', '33', 'ff'),
(3, 'ff', 'ff', 'ff');

-- --------------------------------------------------------

--
-- 表的结构 `tj_2014tc`
--

CREATE TABLE IF NOT EXISTS `tj_2014tc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tj_2015tcc`
--

CREATE TABLE IF NOT EXISTS `tj_2015tcc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ss` varchar(30) DEFAULT NULL,
  `fc` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tj_aaa`
--

CREATE TABLE IF NOT EXISTS `tj_aaa` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `v` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tj_admin`
--

CREATE TABLE IF NOT EXISTS `tj_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `admin_name` varchar(30) DEFAULT NULL,
  `admin_pwd` varchar(30) DEFAULT NULL,
  `admin_xm` varchar(20) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='体检管理者：1、老师  2、医生 3、管理者admin' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tj_admin`
--

INSERT INTO `tj_admin` (`admin_id`, `role_id`, `admin_name`, `admin_pwd`, `admin_xm`) VALUES
(4, 2, 'admin', 'admin', '超级管理员'),
(5, 1, 'zq', 'zq', '张勤');

-- --------------------------------------------------------

--
-- 表的结构 `tj_asd`
--

CREATE TABLE IF NOT EXISTS `tj_asd` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tj_backup`
--

CREATE TABLE IF NOT EXISTS `tj_backup` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_name` varchar(30) DEFAULT NULL,
  `b_path` varchar(30) DEFAULT NULL,
  `b_time` int(11) DEFAULT NULL,
  `b_comment` text,
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='体检系统的备份' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tj_backup_category`
--

CREATE TABLE IF NOT EXISTS `tj_backup_category` (
  `b_c_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_c_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`b_c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='体检系统的备份的分类' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tj_log`
--

CREATE TABLE IF NOT EXISTS `tj_log` (
  `log_id` int(11) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='体检操作日志';

-- --------------------------------------------------------

--
-- 表的结构 `tj_log_category`
--

CREATE TABLE IF NOT EXISTS `tj_log_category` (
  `log_c_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`log_c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='体检日志的分类' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tj_menu`
--

CREATE TABLE IF NOT EXISTS `tj_menu` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `m_name` varchar(20) NOT NULL COMMENT '菜单名字',
  `m_href` varchar(50) NOT NULL COMMENT '菜单链接',
  `m_parent_id` int(11) DEFAULT NULL COMMENT '菜单父分类id',
  `m_weight` int(11) DEFAULT NULL COMMENT '菜单权限',
  `m_create_u_id` int(11) DEFAULT NULL,
  `m_create_time` int(11) DEFAULT NULL,
  `m_update_u_id` int(11) DEFAULT NULL,
  `m_update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `tj_menu`
--

INSERT INTO `tj_menu` (`m_id`, `m_name`, `m_href`, `m_parent_id`, `m_weight`, `m_create_u_id`, `m_create_time`, `m_update_u_id`, `m_update_time`) VALUES
(1, '体检管理', '', 0, 100, NULL, NULL, NULL, NULL),
(2, '用户管理', '', 0, 200, NULL, NULL, NULL, NULL),
(3, '系统管理', '', 0, 300, NULL, NULL, NULL, NULL),
(4, '体检对象', 'index.php/cuser/index', 2, 2, NULL, NULL, NULL, NULL),
(5, '管理者', 'index.php/admin/index', 3, 2, NULL, NULL, NULL, NULL),
(6, '数据库管理', 'index.php/data/index', 3, 2, NULL, NULL, NULL, NULL),
(7, '菜单管理', 'index.php/cmenu/index', 3, 2, NULL, NULL, NULL, NULL),
(8, '日志管理', 'index.php/log/log', 3, 2, NULL, NULL, NULL, NULL),
(9, '权限管理', 'index.php/admin/role', 3, 2, NULL, NULL, NULL, NULL),
(10, '模板管理', 'index.php', 3, 2, NULL, NULL, NULL, NULL),
(11, '体检项目', 'index.php/ctj/project', 1, 2, NULL, NULL, NULL, NULL),
(12, '体检分类', 'index.php/ctj/tsort', 1, 2, NULL, NULL, NULL, NULL),
(13, '体检结果', 'index.php/ctj/tresult', 1, 2, NULL, NULL, NULL, NULL),
(14, '体检套餐', 'index.php/ctj/package', 1, 2, NULL, NULL, NULL, NULL),
(18, '菜单分类管理', 'index.php/cmenu/menuCategory', 3, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tj_package`
--

CREATE TABLE IF NOT EXISTS `tj_package` (
  `pack_id` int(11) NOT NULL AUTO_INCREMENT,
  `pack_name` varchar(30) DEFAULT NULL,
  `pack_database` varchar(30) DEFAULT NULL,
  `pack_create_time` int(11) DEFAULT NULL,
  `pack_create_uid` int(11) DEFAULT NULL,
  `pack_update_uid` int(11) DEFAULT NULL,
  `pack_update_time` int(11) DEFAULT NULL,
  `pack_comment` text,
  PRIMARY KEY (`pack_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='体检套餐：选择体验内容构成体检表即为体检套餐' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `tj_package`
--

INSERT INTO `tj_package` (`pack_id`, `pack_name`, `pack_database`, `pack_create_time`, `pack_create_uid`, `pack_update_uid`, `pack_update_time`, `pack_comment`) VALUES
(7, '2014', '2014tc', NULL, NULL, NULL, NULL, '2014套餐'),
(6, '2013', '2013tc', NULL, NULL, NULL, NULL, '2013套餐'),
(8, '2015', '2015tcc', NULL, NULL, NULL, NULL, '2015套餐');

-- --------------------------------------------------------

--
-- 表的结构 `tj_project`
--

CREATE TABLE IF NOT EXISTS `tj_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_id` int(11) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `unique` varchar(30) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='体检项目' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `tj_project`
--

INSERT INTO `tj_project` (`id`, `sort_id`, `name`, `unique`, `comment`) VALUES
(1, 5, 'sss', 'sss1222', 'ssssss'),
(2, 5, 'sssssssssss', 'sssf', 'ffffffffffff'),
(3, 5, '我们', 'ff', 'fffffffff'),
(4, 2, 'adf', 'aa', 'ff'),
(9, 1, '早', 'ss', '昌'),
(10, 1, '目上', 'fc', '要');

-- --------------------------------------------------------

--
-- 表的结构 `tj_result`
--

CREATE TABLE IF NOT EXISTS `tj_result` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `res_u_id` int(11) DEFAULT NULL COMMENT '体检结果用户id',
  `res_a_id` int(11) DEFAULT NULL COMMENT '体检医生id',
  `res_data` text COMMENT '体检结果',
  `res_comment` text COMMENT '体检结果注释',
  PRIMARY KEY (`res_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='体检结果' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tj_role`
--

CREATE TABLE IF NOT EXISTS `tj_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) DEFAULT NULL,
  `role_weight` int(10) DEFAULT NULL,
  `role_comment` text,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='角色表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tj_role`
--

INSERT INTO `tj_role` (`role_id`, `role_name`, `role_weight`, `role_comment`) VALUES
(1, '医生', 250, '校医生的医生'),
(2, '管理员', 350, '华科的管理员');

-- --------------------------------------------------------

--
-- 表的结构 `tj_sort`
--

CREATE TABLE IF NOT EXISTS `tj_sort` (
  `sort_id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_name` varchar(30) DEFAULT NULL,
  `sort_desc` text,
  PRIMARY KEY (`sort_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='体检分类' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tj_sort`
--

INSERT INTO `tj_sort` (`sort_id`, `sort_name`, `sort_desc`) VALUES
(1, 'skeletonsss', 'assssssssssssssssssssssss'),
(2, 'www', 'fdsf'),
(3, 'sssssssssssf', 'ffsfsadsfdsa'),
(5, '林', '要');

-- --------------------------------------------------------

--
-- 表的结构 `tj_sss`
--

CREATE TABLE IF NOT EXISTS `tj_sss` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tj_student`
--

CREATE TABLE IF NOT EXISTS `tj_student` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tj_tables`
--

CREATE TABLE IF NOT EXISTS `tj_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table` varchar(20) NOT NULL,
  `field` varchar(15) NOT NULL,
  `desc` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tj_teacher`
--

CREATE TABLE IF NOT EXISTS `tj_teacher` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tj_test`
--

CREATE TABLE IF NOT EXISTS `tj_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `tj_test`
--

INSERT INTO `tj_test` (`id`, `test`) VALUES
(1, '2222'),
(2, '2222'),
(3, '2222'),
(4, '2222'),
(5, '2222'),
(6, '2222'),
(7, '2222'),
(8, '2222'),
(9, '2222'),
(10, '2222'),
(11, '2222'),
(12, '2222'),
(13, '2222'),
(14, '2222'),
(15, '2222'),
(16, '2222'),
(17, '2222'),
(18, '2222'),
(19, '2222'),
(20, '2222'),
(21, '2222');

-- --------------------------------------------------------

--
-- 表的结构 `tj_user`
--

CREATE TABLE IF NOT EXISTS `tj_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_desc` varchar(100) NOT NULL,
  `user_unique` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `tj_user`
--

INSERT INTO `tj_user` (`user_id`, `user_name`, `user_desc`, `user_unique`) VALUES
(10, '教师', '华科的教师', 'teacher'),
(9, '学生', '华科的学生', 'student');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
