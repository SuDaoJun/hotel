-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 06 月 11 日 15:47
-- 服务器版本: 5.0.96-community-nt
-- PHP 版本: 5.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `hb5272230`
--
CREATE DATABASE IF NOT EXISTS `hb5272230` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hb5272230`;

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(4) NOT NULL auto_increment COMMENT '管理员号',
  `name` varchar(10) collate utf8_bin NOT NULL COMMENT '管理员姓名',
  `passwd` varchar(20) collate utf8_bin NOT NULL COMMENT '密码',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='管理员表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `name`, `passwd`) VALUES
(1, 'admin', 'sdj'),
(3, 'sss', 'abc');

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `ms_id` int(4) NOT NULL auto_increment COMMENT '序号',
  `title` varchar(30) NOT NULL COMMENT '主题',
  `name` varchar(10) NOT NULL COMMENT '名字',
  `mailbox` varchar(50) NOT NULL COMMENT '邮箱',
  `phone` int(20) NOT NULL COMMENT '手机',
  `content` varchar(240) NOT NULL COMMENT '留言内容',
  PRIMARY KEY  (`ms_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`ms_id`, `title`, `name`, `mailbox`, `phone`, `content`) VALUES
(12, '搜索', '搜索', '1251662462@qq.com', 2147483647, 'ss'),
(13, '啊啊', '搜索', '1161942111@qq.com', 2147483647, 'ss'),
(14, '森森', '森森', '1251662462@qq.com', 2147483647, '试试'),
(15, '森森', '森森', '1251662462@qq.com', 2147483647, '试试');

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(4) NOT NULL auto_increment COMMENT '序号',
  `title` varchar(30) NOT NULL COMMENT '图片标题',
  `spic` varchar(100) NOT NULL COMMENT '小图片',
  `bpic` varchar(100) NOT NULL COMMENT '大图片',
  `describes` varchar(240) NOT NULL COMMENT '描述',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `news`
--

INSERT INTO `news` (`id`, `title`, `spic`, `bpic`, `describes`) VALUES
(1, '夜幕降临时的休闲厅', 's1.jpg', 'l1.jpg', '位于大厅中部的休闲是一个不错停驻休闲的好地方'),
(3, '宾馆休闲亭与湖', 's3.jpg', 'l3.jpg', '坐在休闲厅中观看湖中美景'),
(4, '舌尖上的美食', '20180425035522.jpg', '201804250355222.jpg', '美食不可辜负'),
(5, '宾馆休闲喝茶区', 's5.jpg', 'l5.jpg', '喝茶观景'),
(6, '干净整洁的卫生间', '20180425035622.jpg', '201804250356222.jpg', '美好体验无烦恼'),
(8, '便利的停车场', '20180425035714.jpg', '201804250357142.jpg', '给你的爱车一个更好的环境');

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `orderid` int(15) NOT NULL COMMENT '订单流水号',
  `roomid` varchar(4) collate utf8_bin NOT NULL COMMENT '房间编号',
  `cardid` varchar(25) collate utf8_bin NOT NULL COMMENT '客户身份证',
  `entertime` varchar(20) collate utf8_bin NOT NULL COMMENT '入住时间',
  `days` int(3) NOT NULL default '1' COMMENT '住宿天数',
  `typeid` int(4) NOT NULL COMMENT '房间类型',
  `linkman` varchar(10) collate utf8_bin NOT NULL COMMENT '客户姓名',
  `phone` varchar(11) collate utf8_bin NOT NULL COMMENT '联系电话',
  `ostatus` char(1) collate utf8_bin NOT NULL default '否' COMMENT '是否网上预订',
  `oremarks` char(1) collate utf8_bin NOT NULL default '否' COMMENT '订单是否完成',
  `monetary` decimal(8,2) NOT NULL COMMENT '消费金额',
  `messages` varchar(255) collate utf8_bin default '无备注信息' COMMENT '订单备注信息',
  PRIMARY KEY  (`orderid`),
  KEY `FK_ORDER` (`typeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='订单入住表';

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`orderid`, `roomid`, `cardid`, `entertime`, `days`, `typeid`, `linkman`, `phone`, `ostatus`, `oremarks`, `monetary`, `messages`) VALUES
(13351, '102', '430281188412150313', '2018-04-28', 1, 1001, '啊啊', '18473481958', '是', '是', '288.00', '22'),
(13502, '103', '430281199412150312', '2018-04-27', 2, 1005, '哦哦', '18419581245', '否', '是', '640.00', ''),
(94036, '104', '430281199412150111', '2018-05-15', 2, 1003, '森森', '18473481922', '否', '是', '540.00', '试试');

-- --------------------------------------------------------

--
-- 表的结构 `record`
--

CREATE TABLE IF NOT EXISTS `record` (
  `orderid` int(15) NOT NULL COMMENT '订单流水号',
  `roomid` varchar(4) collate utf8_bin NOT NULL COMMENT '房间编号',
  `cardid` varchar(25) collate utf8_bin NOT NULL COMMENT '客户身份证',
  `entertime` varchar(20) collate utf8_bin NOT NULL COMMENT '入住时间',
  `days` int(3) NOT NULL default '1' COMMENT '住宿天数',
  `typeid` int(4) NOT NULL COMMENT '房间类型',
  `linkman` varchar(10) collate utf8_bin NOT NULL COMMENT '客户姓名',
  `phone` varchar(11) collate utf8_bin NOT NULL COMMENT '联系电话',
  `ostatus` char(1) collate utf8_bin NOT NULL default '否' COMMENT '是否网上预订',
  `oremarks` char(1) collate utf8_bin NOT NULL default '否' COMMENT '订单是否完成',
  `monetary` decimal(8,2) NOT NULL COMMENT '消费金额',
  `messages` varchar(255) collate utf8_bin default '无备注信息' COMMENT '订单备注信息',
  PRIMARY KEY  (`orderid`),
  KEY `FK_ORDER` (`typeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='订单入住历史表';

--
-- 转存表中的数据 `record`
--

INSERT INTO `record` (`orderid`, `roomid`, `cardid`, `entertime`, `days`, `typeid`, `linkman`, `phone`, `ostatus`, `oremarks`, `monetary`, `messages`) VALUES
(31214, '102', '430281199412150313', '2018-04-25', 2, 1001, '森森', '18473481922', '否', '是', '576.00', '森森');

-- --------------------------------------------------------

--
-- 表的结构 `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `roomid` varchar(4) collate utf8_bin NOT NULL COMMENT '房间编号',
  `typeid` int(4) NOT NULL COMMENT '类型标识',
  `status` char(1) collate utf8_bin NOT NULL COMMENT '是否入住',
  `remarks` varchar(500) collate utf8_bin default NULL COMMENT '房间描述',
  `pic` varchar(100) collate utf8_bin NOT NULL COMMENT '房间图片',
  PRIMARY KEY  (`roomid`),
  UNIQUE KEY `roomid` (`roomid`),
  KEY `FK_ID` (`typeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `room`
--

INSERT INTO `room` (`roomid`, `typeid`, `status`, `remarks`, `pic`) VALUES
('101', 1000, '否', '一张床，房间配套设施——牙刷、牙膏、肥皂、梳子、一次性拖鞋等一套，风筒、空调、热水...', 'd1.jpg'),
('102', 1001, '是', '两张床，房间配套设施——牙刷、牙膏、肥皂、梳子、一次性拖鞋等一套，风筒、空调、热水...', 'a1.jpg'),
('103', 1005, '是', '商务两床房，房间配套设施——牙刷、牙膏、肥皂、梳子、一次性拖鞋等一套，风筒、空调、...', 'a3.jpg'),
('104', 1003, '是', '商务单床房，房间配套设施——牙刷、牙膏、肥皂、梳子、一次性拖鞋等一套，风筒、空调、...', 'd3.jpg'),
('105', 1000, '否', '一张床，房间配套设施——牙刷、牙膏、肥皂、梳子、一次性拖鞋等一套，风筒、空调、热水...', 'd2.jpg'),
('106', 1001, '否', '两张床，房间配套设施——牙刷、牙膏、肥皂、梳子、一次性拖鞋等一套，风筒、空调、热水...', 'a2.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `roomtype`
--

CREATE TABLE IF NOT EXISTS `roomtype` (
  `typeid` int(4) NOT NULL auto_increment COMMENT '类型标识',
  `typename` varchar(20) collate utf8_bin NOT NULL COMMENT '类型名称',
  `area` varchar(2) collate utf8_bin NOT NULL COMMENT '房间面积',
  `hasNet` char(1) collate utf8_bin NOT NULL default '有' COMMENT '网络',
  `hasTV` char(1) collate utf8_bin NOT NULL default '有' COMMENT '有线电视',
  `price` decimal(8,2) NOT NULL COMMENT '价格',
  `totalnum` int(4) NOT NULL COMMENT '房间数量',
  `leftnum` int(4) NOT NULL COMMENT '剩余数量',
  PRIMARY KEY  (`typeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='房间类型表' AUTO_INCREMENT=1006 ;

--
-- 转存表中的数据 `roomtype`
--

INSERT INTO `roomtype` (`typeid`, `typename`, `area`, `hasNet`, `hasTV`, `price`, `totalnum`, `leftnum`) VALUES
(1000, '标准间【单人】', '40', '有', '有', '188.00', 2, 2),
(1001, '标准间【双人】', '70', '有', '有', '288.00', 2, 1),
(1003, '商务间【单人】', '50', '有', '有', '270.00', 1, 0),
(1005, '商务间【双人】', '80', '有', '有', '320.00', 1, 0);

--
-- 限制导出的表
--

--
-- 限制表 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_ORDER` FOREIGN KEY (`typeid`) REFERENCES `roomtype` (`typeid`);

--
-- 限制表 `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `FK_ID` FOREIGN KEY (`typeid`) REFERENCES `roomtype` (`typeid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
