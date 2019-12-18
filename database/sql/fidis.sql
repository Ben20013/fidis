-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2019-12-02 10:06:10
-- 服务器版本： 5.7.21
-- PHP Version: 7.2.4

-- ------------------------------------------------------
-- Database: fidis
-- Version: v2.0.0
-- Date: 2019-11-22 13:38:40
-- Author: qinguoqing
-- Description: fidis系统数据库
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fidis`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_job`
--

DROP TABLE IF EXISTS `admin_job`;
CREATE TABLE IF NOT EXISTS `admin_job` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '运行编号',
  `job_name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '运行名称',
  `description` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '描述',
  `openframe_id` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL COMMENT '工程编号',
  `cycle` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '运行周期',
  `reference` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '参考号',
  `created` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='D&C模型运行表';

-- --------------------------------------------------------

--
-- 表的结构 `admin_menu`
--

DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE IF NOT EXISTS `admin_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL COMMENT '菜单ID',
  `parentid` varchar(255) DEFAULT NULL COMMENT '父ID',
  `name` varchar(255) DEFAULT NULL COMMENT '菜单名称',
  `module_id` varchar(255) DEFAULT NULL COMMENT '对应模块ID',
  `module_name` varchar(255) DEFAULT NULL COMMENT '对应模块名称',
  `route` varchar(255) DEFAULT NULL COMMENT '路径',
  `params` varchar(255) DEFAULT NULL COMMENT '附加参数',
  `display` tinyint(11) DEFAULT NULL COMMENT '是否显示',
  `is_enable` tinyint(11) DEFAULT NULL COMMENT '启用状态,（0：禁用；1：启用；）',
  `display_system` varchar(30) DEFAULT NULL COMMENT '在哪些系统中显示',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标地址',
  `listorder` int(11) DEFAULT NULL COMMENT '排序',
  `description` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='菜单管理表';

--
-- 转存表中的数据 `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `uid`, `parentid`, `name`, `module_id`, `module_name`, `route`, `params`, `display`, `is_enable`, `display_system`, `icon`, `listorder`, `description`) VALUES
(1, 'FGZD72S8EK0T5UAB', '0', '模块管理', 'YNUS6PV1CHQ0JFB5', 'Admin', '/module', NULL, 1, 1, '[\"Fidis admin\"]', 'fas fa-cubes fa-1x', 0, '模块管理'),
(2, 'N1KGRTF9XLYB04EJ', '0', '菜单管理', 'YNUS6PV1CHQ0JFB5', 'Admin', '/menu', NULL, 1, 1, '[\"Fidis admin\"]', 'fas fa-list fa-1x', 10, '菜单管理'),
(3, 'L6G4TK0UBNYX2137', '0', '系统设置', 'YNUS6PV1CHQ0JFB5', 'Admin', '/setting', NULL, 0, 1, '[\"Fidis admin\"]', 'fas fa-cog fa-1x', 30, NULL),
(4, 'V415KXDCSEGA2ZLB', '0', '门户中心', 'SBX9C5KVHPFLYNU3', 'Portal', '/portal', NULL, 1, 1, '[\"Fidis admin\"]', 'fas fa-th fa-1x', 20, '门户中心设置'),
(23, '6QHBZR9F7JMYPEVL', 'YLV30HG76XRE25B8', '结果列表', 'PT4GJ1KM5AEDB9N6', 'Openframe', '/openframe/result', '/result', 1, 1, '[\"Fidis admin\"]', 'fas fa-file fa-1x', 100, '结果列表'),
(22, 'JW3LTH6KC07BEUGD', 'YLV30HG76XRE25B8', '项目列表', 'PT4GJ1KM5AEDB9N6', 'Openframe', '/openframe/project', '/project', 1, 1, '[\"Fidis admin\"]', 'fas fa-file fa-1x', 100, '项目列表'),
(21, 'YLV30HG76XRE25B8', '0', 'Openframe', 'PT4GJ1KM5AEDB9N6', 'Openframe', '/openframe', '1', 0, 1, '[\"Fidis admin\"]', 'fas fa-file fa-1x', 100, 'OpenFrame基础模块'),
(24, 'ER1TLQSPAWGKUJ29', '0', 'Diag', 'DSK7BEM491CW5FNZ', 'Diag', '/diag', '1', 0, 1, '[\"Fidis admin\"]', 'fas fa-file fa-1x', 100, 'Diag模块'),
(25, 'BA1JRZLN7W0Q94KV', 'ER1TLQSPAWGKUJ29', '项目列表', 'DSK7BEM491CW5FNZ', 'Diag', '/diag/project', '/project', 1, 1, '[\"Fidis admin\"]', 'fas fa-file fa-1x', 100, '项目列表'),
(26, 'AS3FB5PJKQ2NGD68', 'ER1TLQSPAWGKUJ29', '结果列表', 'DSK7BEM491CW5FNZ', 'Diag', '/diag/result', '/result', 1, 1, '[\"Fidis admin\"]', 'fas fa-file fa-1x', 100, '结果列表'),
(33, 'YWFXBRGV2HTEQCN6', 'K706HRD3BWZLXUN1', '适配器', 'LF86YT3XRMCHADN5', 'Aplec', '/aplec/aprus', '/aprus', 1, 1, '[\"Fidis admin\"]', 'fas fa-microchip fa-1x', 100, '适配器管理'),
(32, 'K706HRD3BWZLXUN1', '0', 'Aplec', 'LF86YT3XRMCHADN5', 'Aplec', '/aplec', '1', 0, 1, '[\"Fidis admin\"]', 'fas fa-file fa-1x', 100, 'Aplec模块'),
(35, '6G024W3K9NPEX1MT', 'V415KXDCSEGA2ZLB', '门户设置', 'SBX9C5KVHPFLYNU3', 'Portal', '/portal/setting', '/setting', 1, 1, '[\"Fidis admin\"]', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_module`
--

DROP TABLE IF EXISTS `admin_module`;
CREATE TABLE IF NOT EXISTS `admin_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL COMMENT '模块ID',
  `name` varchar(255) DEFAULT NULL COMMENT '模块名称',
  `is_system` tinyint(11) DEFAULT '0' COMMENT '是否系统模块（0:否；1：是；）',
  `status` tinyint(11) DEFAULT '0' COMMENT '模块状态,（-1：禁用；0：未安装；1：已安装；）',
  `is_enable` tinyint(11) DEFAULT NULL COMMENT '启用状态,（0：禁用；1：启用；）',
  `version` varchar(255) DEFAULT NULL COMMENT '版本号',
  `upgrade_time` datetime DEFAULT NULL COMMENT '更新时间',
  `description` varchar(255) DEFAULT NULL COMMENT '模块描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='模块管理表';

--
-- 转存表中的数据 `admin_module`
--

INSERT INTO `admin_module` (`id`, `uid`, `name`, `is_system`, `status`, `is_enable`, `version`, `upgrade_time`, `description`) VALUES
(1, 'YNUS6PV1CHQ0JFB5', 'Admin', 1, 1, 1, 'V1.0.0', '2019-05-10 00:00:00', '系统管理模块，不可卸载！'),
(2, 'HTZP13B4J5LDQ076', 'Api', 0, 1, 1, 'V1.0.0', '2019-05-17 10:27:07', ''),
(3, '4AEUCLQF9TR7GJVY', 'App', 0, 1, 1, 'V1.2.0', '2019-05-17 10:27:18', ''),
(4, 'SBX9C5KVHPFLYNU3', 'Portal', 0, 1, 1, '', '2019-05-17 10:27:23', ''),
(5, 'CTZ6HJNAB8K014FX', 'Pro', 0, 1, 1, '', '2019-05-17 10:27:27', ''),
(23, 'QYVXH35ZUFC42E7T', 'Test', 0, 1, 0, '', '2019-08-05 09:00:24', ''),
(22, 'LF86YT3XRMCHADN5', 'Aplec', 0, 1, NULL, 'V1.0.0', '2019-05-24 00:00:00', 'OpenFrame基础模块'),
(19, 'DSK7BEM491CW5FNZ', 'Diag', 0, 1, NULL, 'V1.0.0', '2019-05-24 00:00:00', 'Diag'),
(18, 'PT4GJ1KM5AEDB9N6', 'Openframe', 0, 1, NULL, 'V1.0.0', '2019-05-24 00:00:00', 'OpenFrame基础模块');

-- --------------------------------------------------------

--
-- 表的结构 `diag_project`
--

DROP TABLE IF EXISTS `diag_project`;
CREATE TABLE IF NOT EXISTS `diag_project` (
  `project_id` int(11) NOT NULL COMMENT '项目编号',
  `project_name` varchar(32) DEFAULT NULL COMMENT '项目名称',
  `description` varchar(128) DEFAULT NULL COMMENT '描述',
  `class` varchar(16) DEFAULT 'customization' COMMENT '项目类型： standard/customization',
  `environment` varchar(16) DEFAULT 'php' COMMENT '运行环境： php/python/go/java',
  `cycle` varchar(64) DEFAULT NULL COMMENT '运行周期',
  `result_key` varchar(64) DEFAULT NULL COMMENT '结果标识',
  `program` varchar(128) DEFAULT NULL COMMENT '程序路径',
  `active` tinyint(1) DEFAULT '0' COMMENT '是否启用：1 是、0 否',
  `template` text COMMENT '模板：结果字段说明',
  `script` text COMMENT '脚本：参数',
  `reference` varchar(64) DEFAULT NULL COMMENT '参考号',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `is_available` tinyint(1) DEFAULT '1' COMMENT '是否有效：1 是、0 否',
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `diag_project`
--

INSERT INTO `diag_project` (`project_id`, `project_name`, `description`, `class`, `environment`, `cycle`, `result_key`, `program`, `active`, `template`, `script`, `reference`, `created`, `is_available`) VALUES
(1002, 'test', 's', 'customization', 'php', '* * * * *', 'sss', '1', 0, 's', 's', NULL, NULL, 1),
(1003, 'ssssss', 's', 'customization', 'php', '*/1 * * * *', 'sss', '1', 0, 's', 's', NULL, NULL, 1),
(1004, 'test', 'd', 'customization', 'php', '* * * * *', 'dd', '1', 1, 'd', 'd', NULL, '2019-06-01 09:40:09', 1);

-- --------------------------------------------------------

--
-- 表的结构 `diag_result`
--

DROP TABLE IF EXISTS `diag_result`;
CREATE TABLE IF NOT EXISTS `diag_result` (
  `result_id` int(11) NOT NULL COMMENT '结果编号',
  `result_key` varchar(64) DEFAULT NULL COMMENT '结果标识',
  `result_name` varchar(64) DEFAULT NULL COMMENT '结果名称',
  `description` varchar(128) DEFAULT NULL COMMENT '描述',
  `project_id` int(11) DEFAULT NULL COMMENT '项目编号',
  `relation_key` varchar(64) DEFAULT NULL COMMENT '关联标识',
  `relation_value` varchar(64) DEFAULT NULL COMMENT '关联值',
  `category` varchar(16) DEFAULT NULL COMMENT '数据类型',
  `value` text COMMENT '数据值',
  `filepath` varchar(128) DEFAULT NULL COMMENT '附件路径',
  `reference` varchar(64) DEFAULT NULL COMMENT '参考号',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `is_available` tinyint(1) DEFAULT '1' COMMENT '是否有效：1 是、0 否',
  PRIMARY KEY (`result_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `diag_result`
--

INSERT INTO `diag_result` (`result_id`, `result_key`, `result_name`, `description`, `project_id`, `relation_key`, `relation_value`, `category`, `value`, `filepath`, `reference`, `created`, `is_available`) VALUES
(1001, 'gas', '排气量', 'tEST', 1001, 'equipment_id', '1002', 'init', '25000', NULL, NULL, '2019-06-02 00:00:00', 1);

-- --------------------------------------------------------

--
-- 表的结构 `messenger_migrations`
--

DROP TABLE IF EXISTS `messenger_migrations`;
CREATE TABLE IF NOT EXISTS `messenger_migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `messenger_msg_read_history`
--

DROP TABLE IF EXISTS `messenger_msg_read_history`;
CREATE TABLE IF NOT EXISTS `messenger_msg_read_history` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL COMMENT '消息类型： fault 、alert 、report、task、care',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '未读',
  `msg_id` varchar(128) NOT NULL COMMENT '消息id',
  `updated` datetime DEFAULT NULL COMMENT '更新时间',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='已读未读历史记录表';

-- --------------------------------------------------------

--
-- 表的结构 `messenger_pass`
--

DROP TABLE IF EXISTS `messenger_pass`;
CREATE TABLE IF NOT EXISTS `messenger_pass` (
  `pass_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pass_name` varchar(32) DEFAULT NULL COMMENT '名称',
  `type` varchar(16) DEFAULT NULL COMMENT '类型  app,sms,email,wechat',
  `url` varchar(128) DEFAULT '' COMMENT '地址',
  `username` varchar(64) NOT NULL DEFAULT '' COMMENT '用户名称',
  `password` varchar(128) NOT NULL DEFAULT '' COMMENT '密码',
  `description` text COMMENT '描述',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否生效。0表示未生效，1表示已生效',
  `updated` datetime DEFAULT NULL COMMENT '更新时间',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`pass_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='通道表';

--
-- 转存表中的数据 `messenger_pass`
--

INSERT INTO `messenger_pass` (`pass_id`, `pass_name`, `type`, `url`, `username`, `password`, `description`, `is_available`, `updated`, `created`) VALUES
(10, '微信公众号', 'WECHAT', '', '', '', '微信公众号推送服务', 1, '2019-05-19 09:09:25', '2019-05-19 09:09:25'),
(8, 'rnd腾讯邮箱', 'EMAIL', 'smtp.exmail.qq.com', 'rnd_sender@mixlinker.com', 'Ddd123', '用户为rnd 的腾讯邮箱', 1, '2019-05-19 09:08:15', '2019-05-19 09:08:15'),
(9, '友盟推送', 'APP', '', '', '', 'APP使用的是友盟推服务', 1, '2019-05-19 09:08:58', '2019-05-19 09:08:58'),
(6, '深海捷短信通道', 'SMS', 'http://www.mixcall.cn/singheadsms/?m=smsserver&c=api&a=sms', 'zwl', 'zwl16888', '配置数据勿动', 1, '2019-05-18 15:41:34', '2019-05-18 15:25:56');

-- --------------------------------------------------------

--
-- 表的结构 `messenger_route`
--

DROP TABLE IF EXISTS `messenger_route`;
CREATE TABLE IF NOT EXISTS `messenger_route` (
  `route_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `route_name` varchar(32) NOT NULL DEFAULT '' COMMENT '名称',
  `type` varchar(16) NOT NULL DEFAULT '' COMMENT '推送事件',
  `pass_id` int(11) NOT NULL DEFAULT '0' COMMENT '通道地址',
  `tpl_id` int(11) NOT NULL COMMENT '模板id',
  `strategy` tinyint(1) NOT NULL DEFAULT '1' COMMENT '策略 1：立即 2：定时',
  `schedule` varchar(32) DEFAULT NULL COMMENT '推送时间',
  `people` varchar(256) DEFAULT NULL COMMENT '人员id',
  `description` text COMMENT '描述',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否生效。0表示未生效，1表示已生效',
  `updated` datetime DEFAULT NULL COMMENT '更新时间',
  `created` datetime DEFAULT NULL COMMENT '信使信使创建时间',
  PRIMARY KEY (`route_id`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=utf8 COMMENT='路由表';

--
-- 转存表中的数据 `messenger_route`
--

INSERT INTO `messenger_route` (`route_id`, `route_name`, `type`, `pass_id`, `tpl_id`, `strategy`, `schedule`, `people`, `description`, `is_available`, `updated`, `created`) VALUES
(116, '报表服务', 'report', 9, 1062, 1, NULL, '', '报表服务路由', 1, '2019-06-14 18:36:53', '2019-05-19 09:22:55'),
(117, '故障路由', 'fault', 9, 1064, 1, NULL, '', '这里修改 只需要修改  推送通道 、 模板、 人员 、策略', 1, '2019-06-14 18:36:46', '2019-05-19 09:26:13'),
(118, '报警路由', 'alert', 9, 1065, 1, NULL, '', '与推送任务里面的告警服务相绑定', 1, '2019-06-14 18:36:40', '2019-05-19 09:28:08'),
(119, '维保服务', 'task', 9, 1063, 1, NULL, '', '该路由用于维保推送路由,勿删!', 1, '2019-06-13 14:53:11', '2019-05-19 09:28:34');

-- --------------------------------------------------------

--
-- 表的结构 `messenger_send_history`
--

DROP TABLE IF EXISTS `messenger_send_history`;
CREATE TABLE IF NOT EXISTS `messenger_send_history` (
  `history_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '唯一标识',
  `type` varchar(32) DEFAULT NULL,
  `task_id` int(11) DEFAULT '0' COMMENT '告警,报警,维保,报表id',
  `data` longtext,
  `error` text COMMENT '错误详情',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `updated` datetime DEFAULT NULL COMMENT '更新时间',
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='发送历史表';

-- --------------------------------------------------------

--
-- 表的结构 `messenger_task`
--

DROP TABLE IF EXISTS `messenger_task`;
CREATE TABLE IF NOT EXISTS `messenger_task` (
  `task_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `task_name` varchar(32) DEFAULT NULL COMMENT '名称',
  `route_id` varchar(16) DEFAULT NULL COMMENT '路由标识',
  `run_status` tinyint(1) DEFAULT '0' COMMENT '是否正在运行 1：是 ,0：否',
  `agent_id` int(11) DEFAULT NULL COMMENT '代理id',
  `agent_script` text COMMENT '代理脚本',
  `description` text COMMENT '描述',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否生效，0表示未生效，1表示已生效',
  `updated` datetime DEFAULT NULL COMMENT '更新时间',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='任务表';

-- --------------------------------------------------------

--
-- 表的结构 `messenger_tpl`
--

DROP TABLE IF EXISTS `messenger_tpl`;
CREATE TABLE IF NOT EXISTS `messenger_tpl` (
  `tpl_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `tpl_name` varchar(64) NOT NULL DEFAULT '' COMMENT '名称',
  `description` text COMMENT '描述',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '内容',
  `type` varchar(16) DEFAULT NULL COMMENT '类型',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否生效，0表示未生效，1表示已生效',
  `updated` datetime DEFAULT NULL COMMENT '更新时间',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`tpl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1066 DEFAULT CHARSET=utf8 COMMENT='模板表';

--
-- 转存表中的数据 `messenger_tpl`
--

INSERT INTO `messenger_tpl` (`tpl_id`, `tpl_name`, `description`, `content`, `type`, `is_available`, `updated`, `created`) VALUES
(1062, '报表类型模板', '您好,在2019-01-01产生了一份全国运行时间的报表,请注意查收', '您好,在${created}产生了一份${output_name}的报表,请注意查收', 'EMAIL', 1, '2019-05-20 16:43:11', '2019-04-21 10:49:53'),
(1063, '维保类型模板', '你的设备#1在2019-01-01到了维保时间,请及时维保。', '你的设备${equipment_name}在${closing_date}到了维保时间,请及时处理', 'SMS', 1, '2019-06-12 10:32:47', '2019-04-21 10:50:33'),
(1064, '故障类型模板', '你的设备#1在2019-01-01发生压力过大的故障,请知晓!', '你的设备${equipment_name}在${created}发生${fault_name}故障,请知晓!', 'APP', 1, '2019-05-20 16:44:07', '2019-04-21 11:23:59'),
(1065, '告警类型模板', '你的设备#1在2019-01-01发生压力过大的报警,请知晓!', '你的设备${equipment_name}在${created}发生${alert_name}报警,请知晓!', 'WECHAT', 1, '2019-06-03 10:46:30', '2019-04-21 11:26:43');

-- --------------------------------------------------------

--
-- 表的结构 `messenger_user`
--

DROP TABLE IF EXISTS `messenger_user`;
CREATE TABLE IF NOT EXISTS `messenger_user` (
  `user_id` int(11) NOT NULL,
  `username` char(32) DEFAULT '' COMMENT '用户名称',
  `description` text COMMENT '描述',
  `email` char(64) DEFAULT NULL COMMENT '邮箱',
  `device_token` varchar(64) NOT NULL DEFAULT '' COMMENT '设备号（Android 44 位长度、ios 64 位长度）',
  `mobile` varchar(32) NOT NULL DEFAULT '' COMMENT '手机号',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0/1',
  `updated` datetime DEFAULT NULL COMMENT '更新时间',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表-用于对接存储用户中心的用户，其中用于 友盟信息的推送等提供数据';

-- --------------------------------------------------------

--
-- 表的结构 `mix_admin_setting`
--

DROP TABLE IF EXISTS `mix_admin_setting`;
CREATE TABLE IF NOT EXISTS `mix_admin_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uid` varchar(32) NOT NULL COMMENT 'UID',
  `module` varchar(255) NOT NULL COMMENT '关联模块',
  `alias` varchar(255) DEFAULT NULL COMMENT '别名',
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `userid` varchar(255) DEFAULT NULL COMMENT '关联用户',
  `variable` varchar(255) DEFAULT NULL COMMENT '变量名',
  `value` varchar(255) DEFAULT NULL COMMENT '变量值',
  `setting` mediumtext COMMENT '附加设置',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除掉（1：已删除；0：未删除）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='通用设置';

--
-- 转存表中的数据 `mix_admin_setting`
--

INSERT INTO `mix_admin_setting` (`id`, `uid`, `module`, `alias`, `name`, `userid`, `variable`, `value`, `setting`, `is_deleted`) VALUES
(13, '3b2819470f143e55', 'Pro', NULL, 'FIDIS-Pro模块配置信息', NULL, 'caches_data', NULL, 'array (\r\n  \\\'name\\\' => \\\'Pro\\\',\r\n  \\\'industry\\\' => \r\n  array (\r\n    \\\'gas\\\' => \r\n    array (\r\n      \\\'industry_name\\\' => \\\'气站\\\',\r\n      \\\'name\\\' => \\\'气站\\\',\r\n      \\\'hasStatus\\\' => \\\'1\\\',\r\n      \\\'header\\\' => \r\n      array (\r\n        0 => \r\n        array (\r\n          \\\'key\\\' => \\\'\\\',\r\n          \\\'name\\\' => \\\'气电比\\\',\r\n        ),\r\n        1 => \r\n        array (\r\n          \\\'key\\\' => \\\'\\\',\r\n          \\\'name\\\' => \\\'供气压力/Mpa\\\',\r\n        ),\r\n        2 => \r\n        array (\r\n          \\\'key\\\' => \\\'\\\',\r\n          \\\'name\\\' => \\\'累计用气量/Nm³\\\',\r\n        ),\r\n      ),\r\n    ),\r\n    \\\'electricity\\\' => \r\n    array (\r\n      \\\'industry_name\\\' => \\\'发电机组\\\',\r\n      \\\'name\\\' => \\\'电站\\\',\r\n      \\\'hasStatus\\\' => \\\'1\\\',\r\n      \\\'header\\\' => \r\n      array (\r\n        0 => \r\n        array (\r\n          \\\'key\\\' => \\\'\\\',\r\n          \\\'name\\\' => \\\'当前总功率/MW\\\',\r\n        ),\r\n        1 => \r\n        array (\r\n          \\\'key\\\' => \\\'\\\',\r\n          \\\'name\\\' => \\\'装机容量/MW\\\',\r\n        ),\r\n        2 => \r\n        array (\r\n          \\\'key\\\' => \\\'\\\',\r\n          \\\'name\\\' => \\\'开机率\\\',\r\n        ),\r\n      ),\r\n    ),\r\n    \\\'boiler\\\' => \r\n    array (\r\n      \\\'industry_name\\\' => \\\'锅炉\\\',\r\n      \\\'name\\\' => \\\'项目\\\',\r\n      \\\'hasStatus\\\' => \\\'0\\\',\r\n      \\\'header\\\' => \r\n      array (\r\n        0 => \r\n        array (\r\n          \\\'key\\\' => \\\'\\\',\r\n          \\\'name\\\' => \\\'热效率/%\\\',\r\n        ),\r\n        1 => \r\n        array (\r\n          \\\'key\\\' => \\\'\\\',\r\n          \\\'name\\\' => \\\'累计流量/T\\\',\r\n        ),\r\n        2 => \r\n        array (\r\n          \\\'key\\\' => \\\'\\\',\r\n          \\\'name\\\' => \\\'累计耗电量/kW·h\\\',\r\n        ),\r\n        3 => \r\n        array (\r\n          \\\'key\\\' => \\\'\\\',\r\n          \\\'name\\\' => \\\'累计耗水量/T\\\',\r\n        ),\r\n      ),\r\n    ),\r\n    \\\'pumping\\\' => \r\n    array (\r\n      \\\'industry_name\\\' => \\\'泵站\\\',\r\n      \\\'name\\\' => \\\'泵站\\\',\r\n      \\\'hasStatus\\\' => \\\'1\\\',\r\n      \\\'header\\\' => \r\n      array (\r\n        0 => \r\n        array (\r\n          \\\'key\\\' => \\\'\\\',\r\n          \\\'name\\\' => \\\'累计流量/m³\\\',\r\n        ),\r\n        1 => \r\n        array (\r\n          \\\'key\\\' => \\\'\\\',\r\n          \\\'name\\\' => \\\'耗能/kW·h\\\',\r\n        ),\r\n        2 => \r\n        array (\r\n          \\\'key\\\' => \\\'\\\',\r\n          \\\'name\\\' => \\\'运行时间/H\\\',\r\n        ),\r\n      ),\r\n    ),\r\n    \\\'normal\\\' => \r\n    array (\r\n      \\\'industry_name\\\' => \\\'通用\\\',\r\n      \\\'name\\\' => \\\'项目\\\',\r\n      \\\'header\\\' => \r\n      array (\r\n      ),\r\n    ),\r\n  ),\r\n  \\\'setting\\\' => \r\n  array (\r\n    \\\'common\\\' => \r\n    array (\r\n      \\\'product_name\\\' => \\\'Mixlinker FIDIS Pro\\\',\r\n      \\\'website_title\\\' => \\\'Fidis物联网平台\\\',\r\n      \\\'copyright\\\' => \\\'CopyRight 2014-2018 <a href=\\\"http://www.mixlinker.com\\\" target=\\\"_blank\\\">深圳市智物联网络有限公司</a>\\\',\r\n      \\\'app_url\\\' => \\\'\\\',\r\n      \\\'logo_path\\\' => \\\'http://localhost/000/fidis.pro/trunk/modules/pro/static/images/login/logo.png\\\',\r\n      \\\'icon_path\\\' => \\\'http://dev.fidis.com/favicon.ico\\\',\r\n      \\\'help_url\\\' => \\\'\\\',\r\n    ),\r\n    \\\'system\\\' => \r\n    array (\r\n      \\\'industry\\\' => \\\'boiler\\\',\r\n      \\\'hasStatus\\\' => \\\'1\\\',\r\n      \\\'name\\\' => \\\'项目\\\',\r\n      \\\'header\\\' => \r\n      array (\r\n        0 => \r\n        array (\r\n          \\\'name\\\' => \\\'吨汽耗燃料(Nm³)\\\',\r\n          \\\'key\\\' => \\\'0\\\',\r\n        ),\r\n        1 => \r\n        array (\r\n          \\\'name\\\' => \\\'吨汽耗电(kW·h)\\\',\r\n          \\\'key\\\' => \\\'1\\\',\r\n        ),\r\n        2 => \r\n        array (\r\n          \\\'name\\\' => \\\'吨汽耗水(T)\\\',\r\n          \\\'key\\\' => \\\'2\\\',\r\n        ),\r\n        3 => \r\n        array (\r\n          \\\'name\\\' => \\\'产汽量(T)\\\',\r\n          \\\'key\\\' => \\\'3\\\',\r\n        ),\r\n        4 => \r\n        array (\r\n          \\\'name\\\' => \\\'耗燃料(Nm³)\\\',\r\n          \\\'key\\\' => \\\'4\\\',\r\n        ),\r\n        5 => \r\n        array (\r\n          \\\'name\\\' => \\\'总耗电量(kW·h)\\\',\r\n          \\\'key\\\' => \\\'5\\\',\r\n        ),\r\n      ),\r\n      \\\'status\\\' => \r\n      array (\r\n        \\\'key\\\' => \\\'Z\\\',\r\n        \\\'name\\\' => \\\'项目状态\\\',\r\n      ),\r\n      \\\'equipment\\\' => \r\n      array (\r\n        0 => \r\n        array (\r\n          \\\'id\\\' => \\\'equipment_image\\\',\r\n          \\\'listorder\\\' => \\\'10\\\',\r\n          \\\'name\\\' => \\\'设备图片\\\',\r\n          \\\'show\\\' => \\\'1\\\',\r\n          \\\'search\\\' => \\\'0\\\',\r\n          \\\'width\\\' => \\\'150\\\',\r\n        ),\r\n        1 => \r\n        array (\r\n          \\\'id\\\' => \\\'equipment_name\\\',\r\n          \\\'listorder\\\' => \\\'20\\\',\r\n          \\\'name\\\' => \\\'设备名称\\\',\r\n          \\\'show\\\' => \\\'1\\\',\r\n          \\\'search\\\' => \\\'1\\\',\r\n          \\\'width\\\' => \\\'150\\\',\r\n        ),\r\n        2 => \r\n        array (\r\n          \\\'id\\\' => \\\'model\\\',\r\n          \\\'listorder\\\' => \\\'30\\\',\r\n          \\\'name\\\' => \\\'设备型号\\\',\r\n          \\\'show\\\' => \\\'1\\\',\r\n          \\\'search\\\' => \\\'1\\\',\r\n          \\\'width\\\' => \\\'150\\\',\r\n        ),\r\n        3 => \r\n        array (\r\n          \\\'id\\\' => \\\'status_name\\\',\r\n          \\\'listorder\\\' => \\\'40\\\',\r\n          \\\'name\\\' => \\\'设备状态\\\',\r\n          \\\'show\\\' => \\\'1\\\',\r\n          \\\'search\\\' => \\\'0\\\',\r\n          \\\'width\\\' => \\\'150\\\',\r\n        ),\r\n        4 => \r\n        array (\r\n          \\\'id\\\' => \\\'customer_name\\\',\r\n          \\\'listorder\\\' => \\\'50\\\',\r\n          \\\'name\\\' => \\\'客户名称\\\',\r\n          \\\'show\\\' => \\\'1\\\',\r\n          \\\'search\\\' => \\\'1\\\',\r\n          \\\'width\\\' => \\\'200\\\',\r\n        ),\r\n        5 => \r\n        array (\r\n          \\\'id\\\' => \\\'created\\\',\r\n          \\\'listorder\\\' => \\\'60\\\',\r\n          \\\'name\\\' => \\\'设备创建时间\\\',\r\n          \\\'show\\\' => \\\'1\\\',\r\n          \\\'search\\\' => \\\'1\\\',\r\n          \\\'width\\\' => \\\'100\\\',\r\n        ),\r\n        6 => \r\n        array (\r\n          \\\'id\\\' => \\\'equipment_id\\\',\r\n          \\\'listorder\\\' => \\\'70\\\',\r\n          \\\'name\\\' => \\\'设备编号\\\',\r\n          \\\'show\\\' => \\\'0\\\',\r\n          \\\'search\\\' => \\\'0\\\',\r\n          \\\'width\\\' => \\\'100\\\',\r\n        ),\r\n        7 => \r\n        array (\r\n          \\\'id\\\' => \\\'customer_id\\\',\r\n          \\\'listorder\\\' => \\\'80\\\',\r\n          \\\'name\\\' => \\\'客户编号\\\',\r\n          \\\'show\\\' => \\\'0\\\',\r\n          \\\'search\\\' => \\\'0\\\',\r\n          \\\'width\\\' => \\\'100\\\',\r\n        ),\r\n        8 => \r\n        array (\r\n          \\\'id\\\' => \\\'aprus_list\\\',\r\n          \\\'listorder\\\' => \\\'90\\\',\r\n          \\\'name\\\' => \\\'适配器列表\\\',\r\n          \\\'show\\\' => \\\'0\\\',\r\n          \\\'search\\\' => \\\'0\\\',\r\n          \\\'width\\\' => \\\'100\\\',\r\n        ),\r\n        9 => \r\n        array (\r\n          \\\'id\\\' => \\\'description\\\',\r\n          \\\'listorder\\\' => \\\'100\\\',\r\n          \\\'name\\\' => \\\'描述\\\',\r\n          \\\'show\\\' => \\\'0\\\',\r\n          \\\'search\\\' => \\\'0\\\',\r\n          \\\'width\\\' => \\\'100\\\',\r\n        ),\r\n        10 => \r\n        array (\r\n          \\\'id\\\' => \\\'gis\\\',\r\n          \\\'listorder\\\' => \\\'110\\\',\r\n          \\\'name\\\' => \\\'设备地理信息\\\',\r\n          \\\'show\\\' => \\\'0\\\',\r\n          \\\'search\\\' => \\\'0\\\',\r\n          \\\'width\\\' => \\\'100\\\',\r\n        ),\r\n        11 => \r\n        array (\r\n          \\\'id\\\' => \\\'equipment_sn\\\',\r\n          \\\'listorder\\\' => \\\'120\\\',\r\n          \\\'name\\\' => \\\'序列号\\\',\r\n          \\\'show\\\' => \\\'1\\\',\r\n          \\\'search\\\' => \\\'0\\\',\r\n          \\\'width\\\' => \\\'100\\\',\r\n        ),\r\n        12 => \r\n        array (\r\n          \\\'id\\\' => \\\'last_time\\\',\r\n          \\\'listorder\\\' => \\\'130\\\',\r\n          \\\'name\\\' => \\\'最后一次上线时间\\\',\r\n          \\\'show\\\' => \\\'1\\\',\r\n          \\\'search\\\' => \\\'0\\\',\r\n          \\\'width\\\' => \\\'100\\\',\r\n        ),\r\n      ),\r\n    ),\r\n  ),\r\n)', 0),
(20, '1af72dcdde88ab1a', 'Pro', NULL, '方案1', '1000', 'history_scheme', '1036', '[\"S01\",\"S02\",\"S03\",\"S04\",\"S08\"]', 0),
(21, '2f6ff0e3f1b932a3', 'Pro', NULL, '方案2', '1000', 'history_scheme', '1036', '[\"S13\",\"S17\",\"S18\",\"S14\"]', 0),
(30, '1356c4da28385c6e', 'Pro', NULL, '@#%￥%%', '1000', 'history_scheme', '1036', '[\"S18\",\"S14\",\"S10\",\"S06\"]', 0),
(31, 'b43ffa794fda467f', 'Pro', NULL, '&11', '1000', 'history_scheme', '1036', '[]', 0),
(35, '77033b2272be989a', 'Pro', NULL, '新方案6', '1000', 'history_scheme', '1036', '[]', 0),
(40, '977a03f44539781f', 'Pro', NULL, '新方案1', '1000', 'history_scheme', '1001', '[\"S01\",\"S02\",\"S03\"]', 0),
(41, '926164e32fc27d9f', 'Pro', NULL, '新方案2', '1000', 'history_scheme', '1001', '[]', 0),
(42, 'd8f80a4fa8e92693', 'Pro', NULL, '新方案3', '1000', 'history_scheme', '1001', '[\"S01\",\"S02\",\"S09\",\"S05\",\"S10\",\"S06\",\"S13\",\"S17\",\"S21\",\"S16\",\"S12\",\"S08\"]', 0);

-- --------------------------------------------------------

--
-- 表的结构 `openframe_project`
--

DROP TABLE IF EXISTS `openframe_project`;
CREATE TABLE IF NOT EXISTS `openframe_project` (
  `project_id` int(11) NOT NULL COMMENT '项目编号',
  `project_name` varchar(32) DEFAULT NULL COMMENT '项目名称',
  `description` varchar(128) DEFAULT NULL COMMENT '描述',
  `class` varchar(16) DEFAULT 'customization' COMMENT '项目类型： standard/customization',
  `environment` varchar(16) DEFAULT 'php' COMMENT '运行环境： php/python/go/java',
  `cycle` varchar(64) DEFAULT NULL COMMENT '运行周期',
  `result_key` varchar(64) DEFAULT NULL COMMENT '结果标识',
  `program` varchar(128) DEFAULT NULL COMMENT '程序路径',
  `active` tinyint(1) DEFAULT '0' COMMENT '是否启用：1 是、0 否',
  `template` text COMMENT '模板：结果字段说明',
  `script` text COMMENT '脚本：参数',
  `reference` varchar(64) DEFAULT NULL COMMENT '参考号',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `is_available` tinyint(1) DEFAULT '1' COMMENT '是否有效：1 是、0 否',
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `openframe_project`
--

INSERT INTO `openframe_project` (`project_id`, `project_name`, `description`, `class`, `environment`, `cycle`, `result_key`, `program`, `active`, `template`, `script`, `reference`, `created`, `is_available`) VALUES
(1002, 'test', 's', 'customization', 'php', '* * * * *', 'sss', '1', 0, 's', 's', NULL, NULL, 1),
(1003, 'ssssss', 's', 'customization', 'php', '*/1 * * * *', 'sss', '1', 0, 's', 's', NULL, NULL, 1),
(1004, 'test', 'd', 'customization', 'php', '* * * * *', 'dd', '1', 1, 'd', 'd', NULL, '2019-06-01 09:40:09', 1);

-- --------------------------------------------------------

--
-- 表的结构 `openframe_result`
--

DROP TABLE IF EXISTS `openframe_result`;
CREATE TABLE IF NOT EXISTS `openframe_result` (
  `result_id` int(11) NOT NULL COMMENT '结果编号',
  `result_key` varchar(64) DEFAULT NULL COMMENT '结果标识',
  `result_name` varchar(64) DEFAULT NULL COMMENT '结果名称',
  `description` varchar(128) DEFAULT NULL COMMENT '描述',
  `project_id` int(11) DEFAULT NULL COMMENT '项目编号',
  `relation_key` varchar(64) DEFAULT NULL COMMENT '关联标识',
  `relation_value` varchar(64) DEFAULT NULL COMMENT '关联值',
  `category` varchar(16) DEFAULT NULL COMMENT '数据类型',
  `value` text COMMENT '数据值',
  `filepath` varchar(128) DEFAULT NULL COMMENT '附件路径',
  `reference` varchar(64) DEFAULT NULL COMMENT '参考号',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `is_available` tinyint(1) DEFAULT '1' COMMENT '是否有效：1 是、0 否',
  PRIMARY KEY (`result_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `openframe_result`
--

INSERT INTO `openframe_result` (`result_id`, `result_key`, `result_name`, `description`, `project_id`, `relation_key`, `relation_value`, `category`, `value`, `filepath`, `reference`, `created`, `is_available`) VALUES
(1001, 'gas', '产气量', 'tEST', 1001, 'equipment_id', '1002', 'init', '25000', NULL, NULL, '2019-06-02 00:00:00', 1);

-- --------------------------------------------------------

--
-- 表的结构 `pro_app_gps_data`
--

DROP TABLE IF EXISTS `pro_app_gps_data`;
CREATE TABLE IF NOT EXISTS `pro_app_gps_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `lon_lat` varchar(255) NOT NULL COMMENT '经纬度',
  `address` text NOT NULL COMMENT '详细地址',
  `inputtime` datetime NOT NULL COMMENT '上报时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `report_email`
--

DROP TABLE IF EXISTS `report_email`;
CREATE TABLE IF NOT EXISTS `report_email` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `to` text NOT NULL COMMENT '收件人（存在多个通过逗号分隔 ）',
  `send_status` varchar(64) NOT NULL COMMENT '发送状态，与 收件人一一对应 形如{1,0,1,1} 1:发送成功 0:发送失败',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `report_migrations`
--

DROP TABLE IF EXISTS `report_migrations`;
CREATE TABLE IF NOT EXISTS `report_migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `report_output`
--

DROP TABLE IF EXISTS `report_output`;
CREATE TABLE IF NOT EXISTS `report_output` (
  `output_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '结果标识',
  `output_name` varchar(255) DEFAULT '' COMMENT '结果名称',
  `description` text COMMENT '描述',
  `project_id` char(16) DEFAULT '' COMMENT '项目标识',
  `user_id` text,
  `equipment_id` text,
  `customer_id` text,
  `file` char(128) DEFAULT '' COMMENT '结果文件路径',
  `template` text COMMENT '模板/样式',
  `script` text COMMENT '脚本',
  `reference` mediumtext COMMENT '参考号',
  `created` datetime DEFAULT NULL COMMENT '记录创建时间',
  `is_available` tinyint(1) DEFAULT '1' COMMENT '是否有效：1是、0否',
  PRIMARY KEY (`output_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `report_output`
--

INSERT INTO `report_output` (`output_id`, `output_name`, `description`, `project_id`, `user_id`, `equipment_id`, `customer_id`, `file`, `template`, `script`, `reference`, `created`, `is_available`) VALUES
(12, '河南霸州3号锅炉月运行报表2019-09-07.xlsx', '加班', '2', '1026', NULL, NULL, 'excel\\201909071109河南霸州3号锅炉月运行报表2019-09-07.xlsx', NULL, NULL, NULL, '2019-09-07 11:11:10', 1),
(13, '河南霸州3号锅炉月运行报表2019-09-20.xlsx', '加班', '2', '1026', NULL, NULL, 'excel\\201909201409河南霸州3号锅炉月运行报表2019-09-20.xlsx', NULL, NULL, NULL, '2019-09-20 14:43:57', 1);

-- --------------------------------------------------------

--
-- 表的结构 `report_project`
--

DROP TABLE IF EXISTS `report_project`;
CREATE TABLE IF NOT EXISTS `report_project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '项目标识',
  `project_name` char(32) DEFAULT '' COMMENT '项目名称',
  `schedule` varchar(64) DEFAULT '' COMMENT '执行周期计划',
  `type` tinyint(1) DEFAULT '1' COMMENT '1:手动执行 、2:定时执行 默认手动执行',
  `user_id` text COMMENT '用户id,支持多用户，通过 , 分割',
  `template` text COMMENT '模板/样式',
  `script` text COMMENT '脚本',
  `reference` char(64) DEFAULT '' COMMENT '参考号',
  `run_status` varchar(11) DEFAULT '0' COMMENT '周期运行状态；0表示未开启，1表示开启',
  `description` text COMMENT '描述',
  `is_available` tinyint(1) DEFAULT '1' COMMENT '是否有效：1是、0否',
  `created` datetime DEFAULT NULL COMMENT '记录创建时间',
  `to` text COMMENT '收件人（存在多个通过逗号分隔 ）',
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `report_project`
--

INSERT INTO `report_project` (`project_id`, `project_name`, `schedule`, `type`, `user_id`, `template`, `script`, `reference`, `run_status`, `description`, `is_available`, `created`, `to`) VALUES
(2, '测试', NULL, 1, '1026', 'app\\template\\631f1db9e220dcca7b7b8769e8af7a66.xlsx', '{\"prefix\":\"河南霸州3号锅炉月运行报表\",\"suffix_type\":\"date\",\"suffix_format\":\"Y-m-d\",\"pre_request\":[{\"name\":\"EQ_ProduceSteam_1019\",\"description\":\"1019上月每天产汽量\",\"data_source\":\"apis\",\"interface\":\"/api/apis/getStatisticByPeriod\",\"method\":\"post\",\"content-type\":\"x-www-form-urlencode\",\"param\":{\"mapping\":{\"equipment_id\":\"1019\",\"statistics_id\":\"EQ_ProduceSteam_type\",\"timeFlag\":\"month\"}}},{\"name\":\"EQ_FuelConsumption_1019\",\"description\":\"1019上月每天耗燃料\",\"data_source\":\"apis\",\"interface\":\"/api/apis/getStatisticByPeriod\",\"method\":\"post\",\"content-type\":\"x-www-form-urlencode\",\"param\":{\"mapping\":{\"equipment_id\":\"1019\",\"statistics_id\":\"EQ_FuelConsumption_type\",\"timeFlag\":\"month\"}}},{\"name\":\"EQ_PowerConsumption_1019\",\"description\":\"1019上月每天耗电量\",\"data_source\":\"apis\",\"interface\":\"/api/apis/getStatisticByPeriod\",\"method\":\"post\",\"content-type\":\"x-www-form-urlencode\",\"param\":{\"mapping\":{\"equipment_id\":\"1019\",\"statistics_id\":\"EQ_PowerConsumption_type\",\"timeFlag\":\"month\"}}},{\"name\":\"EQ_FeedWater_1019\",\"description\":\"1019上月每天耗水量\",\"data_source\":\"apis\",\"interface\":\"/api/apis/getStatisticByPeriod\",\"method\":\"post\",\"content-type\":\"x-www-form-urlencode\",\"param\":{\"mapping\":{\"equipment_id\":\"1019\",\"statistics_id\":\"EQ_FeedWater_type\",\"timeFlag\":\"month\"}}},{\"name\":\"EQ_TonsFuelConsumption_1019\",\"description\":\"1019上月每天吨汽耗燃料\",\"data_source\":\"apis\",\"interface\":\"/api/apis/getStatisticByPeriod\",\"method\":\"post\",\"content-type\":\"x-www-form-urlencode\",\"param\":{\"mapping\":{\"equipment_id\":\"1019\",\"statistics_id\":\"EQ_TonsFuelConsumption_hcmdemd\",\"timeFlag\":\"month\"}}},{\"name\":\"EQ_TonsPowerConsumption_1019\",\"description\":\"1019上月每天吨汽耗电\",\"data_source\":\"apis\",\"interface\":\"/api/apis/getStatisticByPeriod\",\"method\":\"post\",\"content-type\":\"x-www-form-urlencode\",\"param\":{\"mapping\":{\"equipment_id\":\"1019\",\"statistics_id\":\"EQ_TonsPowerConsumption_hcmdemd\",\"timeFlag\":\"month\"}}},{\"name\":\"EQ_TonsFeedWater_1019\",\"description\":\"1019上月每天吨汽耗水\",\"data_source\":\"apis\",\"interface\":\"/api/apis/getStatisticByPeriod\",\"method\":\"post\",\"content-type\":\"x-www-form-urlencode\",\"param\":{\"mapping\":{\"equipment_id\":\"1019\",\"statistics_id\":\"EQ_TonsFeedWater_hcmdemd\",\"timeFlag\":\"month\"}}},{\"name\":\"GasPrice_1019\",\"description\":\"天然气单价\",\"data_source\":\"apis\",\"interface\":\"/api/apis/getCollect\",\"method\":\"post\",\"content-type\":\"x-www-form-urlencode\",\"param\":{\"mapping\":{\"collect_id\":\"GasPrice\",\"equipment_id\":\"1019\"}}},{\"name\":\"Electrovalence_1019\",\"description\":\"电费单价\",\"data_source\":\"apis\",\"interface\":\"/api/apis/getCollect\",\"method\":\"post\",\"content-type\":\"x-www-form-urlencode\",\"param\":{\"mapping\":{\"collect_id\":\"Electrovalence\",\"equipment_id\":\"1019\"}}},{\"name\":\"WaterPrice_1019\",\"description\":\"软化水单价\",\"data_source\":\"apis\",\"interface\":\"/api/apis/getCollect\",\"method\":\"post\",\"content-type\":\"x-www-form-urlencode\",\"param\":{\"mapping\":{\"collect_id\":\"WaterPrice\",\"equipment_id\":\"1019\"}}},{\"name\":\"TonsChemicalPrice_1019\",\"description\":\"吨汽耗药单价\",\"data_source\":\"apis\",\"interface\":\"/api/apis/getCollect\",\"method\":\"post\",\"content-type\":\"x-www-form-urlencode\",\"param\":{\"mapping\":{\"collect_id\":\"TonsChemicalPrice\",\"equipment_id\":\"1019\"}}}],\"content\":[{\"sheetname\":\"上月每日运行报表\",\"content\":[{\"type\":\"line_chart\",\"data_type\":\"row\",\"mapping\":{\"EQ_ProduceSteam_1019\":\"current\"},\"data\":[{\"position\":\"B5\",\"result\":\"data\",\"description\":\"1019上月每天产汽量\"}]},{\"type\":\"table\",\"data_type\":\"row\",\"mapping\":{\"EQ_FuelConsumption_1019\":\"current\"},\"data\":[{\"position\":\"C5\",\"result\":\"data\",\"description\":\"1019上月每天耗燃料\"}]},{\"type\":\"table\",\"data_type\":\"row\",\"mapping\":{\"EQ_PowerConsumption_1019\":\"current\"},\"data\":[{\"position\":\"D5\",\"result\":\"data\",\"description\":\"1019上月每天耗电量\"}]},{\"type\":\"line_chart\",\"data_type\":\"row\",\"mapping\":{\"EQ_FeedWater_1019\":\"current\"},\"data\":[{\"position\":\"E5\",\"result\":\"data\",\"description\":\"1019上月每天耗水量\"}]},{\"type\":\"line_chart\",\"data_type\":\"row\",\"mapping\":{\"EQ_TonsFuelConsumption_1019\":\"current\"},\"data\":[{\"position\":\"F5\",\"result\":\"data\",\"description\":\"1019上月每天吨汽耗燃料\"}]},{\"type\":\"line_chart\",\"data_type\":\"row\",\"mapping\":{\"EQ_TonsPowerConsumption_1019\":\"current\"},\"data\":[{\"position\":\"I5\",\"result\":\"data\",\"description\":\"1019上月每天吨汽耗电\"}]},{\"type\":\"line_chart\",\"data_type\":\"row\",\"mapping\":{\"EQ_TonsFeedWater_1019\":\"current\"},\"data\":[{\"position\":\"L5\",\"result\":\"data\",\"description\":\"1019上月每天吨汽耗水\"}]},{\"type\":\"table\",\"data_type\":\"row\",\"mapping\":{\"GasPrice_1019\":\"GasPrice\"},\"data\":[{\"position\":\"G4\",\"result\":\"data\",\"description\":\"天然气单价\"}]},{\"type\":\"table\",\"data_type\":\"row\",\"mapping\":{\"Electrovalence_1019\":\"Electrovalence\"},\"data\":[{\"position\":\"J4\",\"result\":\"data\",\"description\":\"电费单价\"}]},{\"type\":\"table\",\"data_type\":\"row\",\"mapping\":{\"WaterPrice_1019\":\"WaterPrice\"},\"data\":[{\"position\":\"M4\",\"result\":\"data\",\"description\":\"软化水单价\"}]},{\"type\":\"table\",\"data_type\":\"row\",\"mapping\":{\"TonsChemicalPrice_1019\":\"TonsChemicalPrice\"},\"data\":[{\"position\":\"O4\",\"result\":\"data\",\"description\":\"吨汽耗药单价\"}]}]}]}', '', '0', '加班', 1, '2019-09-07 11:10:54', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `work_application`
--

DROP TABLE IF EXISTS `work_application`;
CREATE TABLE IF NOT EXISTS `work_application` (
  `app_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '应用id',
  `mapping_id` varchar(255) DEFAULT NULL COMMENT '设备类型id',
  `app_name` char(32) DEFAULT NULL,
  `description` text COMMENT '描述',
  `equipment_ids` text COMMENT '设备id集合通过“，”分割',
  `rule_ids` text COMMENT '规则id集合',
  `group_ids` varchar(255) DEFAULT NULL COMMENT '规则组id集合',
  `updated` datetime DEFAULT NULL COMMENT '更新时间',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效：1是、0否',
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='维保应用';

-- --------------------------------------------------------

--
-- 表的结构 `work_equipment_rule`
--

DROP TABLE IF EXISTS `work_equipment_rule`;
CREATE TABLE IF NOT EXISTS `work_equipment_rule` (
  `mix_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) NOT NULL COMMENT '设备id',
  `rule_id` int(11) NOT NULL COMMENT '规则id',
  `msg_id` int(11) NOT NULL DEFAULT '0' COMMENT '信使规则标识',
  `have_produced` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否生成了维保数据，是：1 否：0 ，default 0',
  `updated` datetime DEFAULT NULL COMMENT '更新时间',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效：1是、0否'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='设备规则表';

-- --------------------------------------------------------

--
-- 表的结构 `work_maintenance_data`
--

DROP TABLE IF EXISTS `work_maintenance_data`;
CREATE TABLE IF NOT EXISTS `work_maintenance_data` (
  `maintenance_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment_id` int(11) DEFAULT NULL,
  `rule_id` int(11) NOT NULL COMMENT '规则id',
  `rule_name` char(32) NOT NULL DEFAULT '' COMMENT '维保点',
  `description` text COMMENT '操作指导',
  `cycle_type` tinyint(1) DEFAULT '1' COMMENT '周期类型',
  `period` int(11) DEFAULT NULL COMMENT '维保周期',
  `start_date` datetime DEFAULT NULL COMMENT '开始维保时间',
  `closing_date` datetime DEFAULT NULL COMMENT '截止时间',
  `remaining` int(11) DEFAULT NULL COMMENT '剩余',
  `unit` varchar(16) NOT NULL DEFAULT 'hour' COMMENT '时间单位：year,month,day,hour',
  `time_type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '维保时间类型：1、自然时间2、设备运行时间',
  `last_maintenance_time` datetime DEFAULT NULL COMMENT '上次维保时间',
  `agent_id` int(11) DEFAULT '0' COMMENT '填充代理id',
  `updated` datetime DEFAULT NULL COMMENT '更新时间',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效：1是、0否',
  `maintenance_num` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '维保次数',
  `is_send` tinyint(1) DEFAULT '0' COMMENT '1: 已发送, 0: 未发送',
  PRIMARY KEY (`maintenance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='维保数据';

-- --------------------------------------------------------

--
-- 表的结构 `work_mapping_rules`
--

DROP TABLE IF EXISTS `work_mapping_rules`;
CREATE TABLE IF NOT EXISTS `work_mapping_rules` (
  `mapping_id` int(11) UNSIGNED NOT NULL COMMENT '设备类型id',
  `rule_ids` text NOT NULL COMMENT '规则id集合',
  `updated` datetime DEFAULT NULL COMMENT '更新时间',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`mapping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='设备类型-规则表';

-- --------------------------------------------------------

--
-- 表的结构 `work_rule`
--

DROP TABLE IF EXISTS `work_rule`;
CREATE TABLE IF NOT EXISTS `work_rule` (
  `rule_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '维保id/规则id',
  `rule_name` varchar(32) NOT NULL DEFAULT '' COMMENT '规则名称，维保点',
  `msg_id` int(11) NOT NULL DEFAULT '0' COMMENT '信使任务id',
  `description` text COMMENT '操作指导',
  `cycle_type` tinyint(3) DEFAULT '1' COMMENT '周期类型',
  `unit` varchar(16) NOT NULL DEFAULT 'hour' COMMENT '时间单位：year,month,day,hour',
  `period` int(11) NOT NULL DEFAULT '0' COMMENT '维保周期',
  `time_type` tinyint(3) NOT NULL DEFAULT '2' COMMENT '维保时间类型：1、自然时间2、设备运行时间',
  `updated` datetime DEFAULT NULL COMMENT '更新时间',
  `created` datetime DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效：1是、0否',
  `statistics_id` varchar(50) DEFAULT NULL COMMENT '统计计算编号',
  PRIMARY KEY (`rule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='维保规则表';

-- --------------------------------------------------------

--
-- 表的结构 `work_rule_group`
--

DROP TABLE IF EXISTS `work_rule_group`;
CREATE TABLE IF NOT EXISTS `work_rule_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '组id',
  `group_name` char(32) DEFAULT NULL COMMENT '组名称',
  `description` text COMMENT '操作指导',
  `rule_ids` text COMMENT '规则id集合通过“，”分割',
  `updated` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效：1是、0否',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='维保规则组';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
