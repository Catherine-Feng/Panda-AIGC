-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2024-01-15 08:48:50
-- 服务器版本： 5.7.26
-- PHP 版本： 5.6.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `misscms`
--

-- --------------------------------------------------------

--
-- 表的结构 `admins`
--

CREATE TABLE `admins` (
  `AdminID` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Position` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `categories`
--

INSERT INTO `categories` (`CategoryID`, `Name`, `Description`) VALUES
(1, '图标', NULL),
(2, '场景', NULL),
(3, '背景', NULL),
(4, '人物', NULL),
(5, '插画', NULL),
(6, '科技', NULL),
(7, '界面', NULL),
(8, '国风', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `comments`
--

INSERT INTO `comments` (`comment_id`, `content_id`, `user_id`, `comment_text`, `created_at`) VALUES
(1, 21, NULL, '三大', '2024-01-14 08:07:49'),
(2, 21, NULL, '测试', '2024-01-14 08:09:06'),
(3, 21, NULL, '撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达撒旦法萨达', '2024-01-14 08:09:36'),
(18, 23, NULL, '图片真漂亮啊。怎么做的', '2024-01-14 13:52:20'),
(6, 9, NULL, '好', '2024-01-14 12:25:59'),
(15, 29, NULL, '555', '2024-01-14 13:35:58'),
(17, 23, NULL, '这个很好看\n', '2024-01-14 13:52:15'),
(14, 29, NULL, '55', '2024-01-14 13:35:57'),
(19, 20, NULL, '这个风格很好', '2024-01-14 13:54:03'),
(20, 20, NULL, '咒语很灵', '2024-01-14 13:54:11'),
(21, 20, NULL, '好漂亮', '2024-01-14 13:54:15');

-- --------------------------------------------------------

--
-- 表的结构 `images`
--

CREATE TABLE `images` (
  `ImageID` int(11) NOT NULL,
  `ImageAddr` varchar(1000) DEFAULT NULL,
  `InfoID` int(11) DEFAULT NULL,
  `Type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `images`
--

INSERT INTO `images` (`ImageID`, `ImageAddr`, `InfoID`, `Type`) VALUES
(28, 'uploads/2023/11/24/656032c6e2911.png', 10, 1),
(29, 'uploads/2023/11/24/656032c6e2cf2.png', 10, 2),
(30, 'uploads/2023/11/24/656032c6e309b.png', 10, 2),
(31, 'uploads/2023/11/24/656032c6e3438.png', 10, 2),
(32, 'uploads/2023/11/24/656032d8193fc.png', 11, 1),
(33, 'uploads/2023/11/24/656032d819823.png', 11, 2),
(34, 'uploads/2023/11/24/656032d81a19b.png', 11, 2),
(35, 'uploads/2023/11/24/656032d81a53f.png', 11, 2),
(36, 'uploads/2023/11/24/656032e4d057b.png', 12, 1),
(37, 'uploads/2023/11/24/656032e4d0981.png', 12, 2),
(38, 'uploads/2023/11/24/656032e4d0d4c.png', 12, 2),
(39, 'uploads/2023/11/24/656032e4d10d5.png', 12, 2),
(40, 'uploads/2023/11/24/656032f1612ff.png', 13, 1),
(41, 'uploads/2023/11/24/656032f1617f1.png', 13, 2),
(42, 'uploads/2023/11/24/656032f161e72.png', 13, 2),
(43, 'uploads/2023/11/24/656032f162296.png', 13, 2),
(20, 'uploads/2023/11/24/65603239db2d4.png', 8, 1),
(21, 'uploads/2023/11/24/65603239db890.png', 8, 2),
(22, 'uploads/2023/11/24/65603239dbfc8.png', 8, 2),
(23, 'uploads/2023/11/24/65603239dc394.png', 8, 2),
(24, 'uploads/2023/11/24/6560324fd9075.png', 9, 1),
(25, 'uploads/2023/11/24/6560324fd94e3.png', 9, 2),
(26, 'uploads/2023/11/24/6560324fd9882.png', 9, 2),
(27, 'uploads/2023/11/24/6560324fd9c52.png', 9, 2),
(44, 'uploads/2023/11/24/656032fe78e00.png', 14, 1),
(45, 'uploads/2023/11/24/656032fe791b2.png', 14, 2),
(46, 'uploads/2023/11/24/656032fe7953d.png', 14, 2),
(47, 'uploads/2023/11/24/656032fe798cc.png', 14, 2),
(48, 'uploads/2023/11/24/6560330acac58.png', 15, 1),
(49, 'uploads/2023/11/24/6560330acb020.png', 15, 2),
(50, 'uploads/2023/11/24/6560330acb6dc.png', 15, 2),
(51, 'uploads/2023/11/24/6560330acbbaf.png', 15, 2),
(52, 'uploads/2023/11/24/65603316887f2.png', 16, 1),
(53, 'uploads/2023/11/24/6560331688be3.png', 16, 2),
(54, 'uploads/2023/11/24/6560331688fa7.png', 16, 2),
(55, 'uploads/2023/11/24/656033168935f.png', 16, 2),
(56, 'uploads/2023/11/24/6560332524615.png', 17, 1),
(57, 'uploads/2023/11/24/6560332524af6.png', 17, 2),
(58, 'uploads/2023/11/24/6560332524f6f.png', 17, 2),
(59, 'uploads/2023/11/24/65603325253ab.png', 17, 2),
(60, 'uploads/2023/11/24/656033336ce8c.png', 18, 1),
(61, 'uploads/2023/11/24/656033336d2a4.png', 18, 2),
(62, 'uploads/2023/11/24/656033336d683.png', 18, 2),
(63, 'uploads/2023/11/24/656033336da3e.png', 18, 2),
(64, 'uploads/2023/11/24/6560333f037f2.png', 19, 1),
(65, 'uploads/2023/11/24/6560333f03bb4.png', 19, 2),
(66, 'uploads/2023/11/24/6560333f03ffc.png', 19, 2),
(67, 'uploads/2023/11/24/6560333f047a8.png', 19, 2),
(68, 'uploads/2023/11/24/65603349e466c.png', 20, 1),
(69, 'uploads/2023/11/24/65603349e4aee.png', 20, 2),
(70, 'uploads/2023/11/24/65603349e4ecc.png', 20, 2),
(71, 'uploads/2023/11/24/65603349e5282.png', 20, 2),
(72, 'uploads/2023/11/24/6560334ee3758.png', 21, 1),
(73, 'uploads/2023/11/24/6560334ee3b7e.png', 21, 2),
(74, 'uploads/2023/11/24/6560334ee4081.png', 21, 2),
(75, 'uploads/2023/11/24/6560334ee44b0.png', 21, 2),
(76, 'uploads/2023/11/24/6560360c5f5cc.png', 22, 1),
(77, 'uploads/2023/11/24/6560360c5f9ad.png', 22, 2),
(78, 'uploads/2023/11/24/6560360c5fd99.png', 22, 2),
(79, 'uploads/2023/11/24/6560360c6014d.png', 22, 2),
(80, 'uploads/2023/11/24/6560363248374.png', 23, 1),
(81, 'uploads/2023/11/24/6560363248763.png', 23, 2),
(82, 'uploads/2023/11/24/6560363248b12.png', 23, 2),
(83, 'uploads/2023/11/24/6560363248eaf.png', 23, 2),
(84, 'uploads/2024/01/11/659f7ae477ef0.jpg', 24, 1),
(85, '', 24, 2),
(86, '', 24, 2),
(87, '', 24, 2),
(88, 'uploads/2024/01/11/659f7af30704f.jpg', 25, 1),
(89, 'uploads/2024/01/11/659f7af3074b1.jpg', 25, 2),
(90, 'uploads/2024/01/11/659f7af3078ad.jpg', 25, 2),
(91, 'uploads/2024/01/11/659f7af307ca0.jpg', 25, 2),
(92, '65a285c49972b.jpg', 26, 1),
(93, '65a285bb19d62.jpg', 26, 2),
(94, '65a2848c737ef.jpg', 26, 2),
(95, 'uploads/2024/01/13/65a27cf2bff32.jpg', 26, 2),
(96, 'uploads/2024/01/13/65a28934d220d.jpg', 27, 1),
(97, 'uploads/2024/01/13/65a28929c9656.jpg', 27, 2),
(98, 'uploads/2024/01/13/65a28929c9ed0.jpg', 27, 2),
(99, 'uploads/2024/01/13/65a28929ca325.jpg', 27, 2),
(100, 'uploads/2024/01/13/65a28d0c93221.jpg', 28, 1),
(101, '', 28, 2),
(102, '', 28, 2),
(103, '', 28, 2),
(104, 'uploads/2024/01/13/65a28e5ad635a.jpg', 29, 1),
(105, 'uploads/2024/01/13/65a28e5ad6bb2.jpg', 29, 2),
(106, 'uploads/2024/01/13/65a28e5ad7381.jpg', 29, 2),
(107, 'uploads/2024/01/13/65a28e5ad77ae.jpg', 29, 2),
(108, 'uploads/2024/01/13/65a28e7bd4b35.jpg', 30, 1),
(109, 'uploads/2024/01/13/65a28e7bd52a8.jpg', 30, 2),
(110, 'uploads/2024/01/13/65a28e7bd5965.jpg', 30, 2),
(111, 'uploads/2024/01/13/65a28e7bd5d76.jpg', 30, 2),
(112, 'uploads/2024/01/13/65a28e88b56f9.jpg', 31, 1),
(113, 'uploads/2024/01/13/65a28e88b5efc.jpg', 31, 2),
(114, 'uploads/2024/01/13/65a28e88b66b2.jpg', 31, 2),
(115, 'uploads/2024/01/13/65a28e88b6e9a.jpg', 31, 2);

-- --------------------------------------------------------

--
-- 表的结构 `info`
--

CREATE TABLE `info` (
  `InfoID` int(11) NOT NULL,
  `Spell` varchar(1000) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `likes_count` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `info`
--

INSERT INTO `info` (`InfoID`, `Spell`, `UserID`, `CategoryID`, `is_deleted`, `likes_count`) VALUES
(10, 'create a picture realistic frame mock up for a luxury cottage wall art standing on a kitchen counter, leaning against the white tiled backsplash beside a window, the frame should be slightly golden and the kitchen interior design style is transitional modern cottage style', 2, 3, 0, 0),
(8, 'beautiful modern cottage stands near the forest winter time graphic drawing', 2, 5, 0, 0),
(9, 'a cinematic photo of a kind Chinese old Taoist priest with a little smile. and a dog', 2, 8, 0, 1),
(11, '小男孩 create a picture realistic frame mock up for a luxury cottage wall art standing on a kitchen counter, leaning against the white tiled backsplash beside a window, the frame should be slightly golden and the kitchen interior design style is transitional modern cottage style', 2, 3, 0, 0),
(12, '小女孩create a picture realistic frame mock up for a luxury cottage wall art standing on a kitchen counter, leaning against the white tiled backsplash beside a window, the frame should be slightly golden and the kitchen interior design style is transitional modern cottage style', 2, 3, 0, 0),
(13, '写作业create a picture realistic frame mock up for a luxury cottage wall art standing on a kitchen counter, leaning against the white tiled backsplash beside a window, the frame should be slightly golden and the kitchen interior design style is transitional modern cottage style', 2, 3, 0, 0),
(14, '女人连create a picture realistic frame mock up for a luxury cottage wall art standing on a kitchen counter, leaning against the white tiled backsplash beside a window, the frame should be slightly golden and the kitchen interior design style is transitional modern cottage style', 2, 3, 0, 0),
(15, '龙create a picture realistic frame mock up for a luxury cottage wall art standing on a kitchen counter, leaning against the white tiled backsplash beside a window, the frame should be slightly golden and the kitchen interior design style is transitional modern cottage style', 2, 3, 0, 0),
(16, '路 reate a picture realistic frame mock up for a luxury cottage wall art standing on a kitchen counter, leaning against the white tiled backsplash beside a window, the frame should be slightly golden and the kitchen interior design style is transitional modern cottage style', 2, 3, 0, 0),
(17, 'face reate a picture realistic frame mock up for a luxury cottage wall art standing on a kitchen counter, leaning against the white tiled backsplash beside a window, the frame should be slightly golden and the kitchen interior design style is transitional modern cottage style', 2, 3, 0, 0),
(18, 'aswae reate a picture realistic frame mock up for a luxury cottage wall art standing on a kitchen counter, leaning against the white tiled backsplash beside a window, the frame should be slightly golden and the kitchen interior design style is transitional modern cottage style', 2, 3, 0, 0),
(19, 'fcccswae reate a picture realistic frame mock up for a luxury cottage wall art standing on a kitchen counter, leaning against the white tiled backsplash beside a window, the frame should be slightly golden and the kitchen interior design style is transitional modern cottage style', 2, 3, 0, 0),
(20, 'fcccswae reate a picture realistic frame mock up for a luxury cottage wall art standing on a kitchen counter, leaning against the white tiled backsplash beside sfad a window, the frame should be slightly golden and the kitchen interior design style is transitional modern cottage style', 2, 3, 0, 2),
(21, 'fcccswae reate a picture realistic frame mock up for a luxury cottage wall art standing on a kitchen counter, leaning against the white tiled backsplash beside sfad a window, the frame should be slightly golden and the kitchen interior design style is transitional modern cottage style', 2, 3, 0, 2),
(24, '', 6, 1, 1, 0),
(25, '了y333334y78434343', 6, 1, 1, 0),
(26, '34443343443', 6, 1, 1, 0),
(23, 'Phoenix element, jewelry, white model, metal, transparent material, surrealism, photography, fashion poster, exaggerated and bold earrings, virtual, abstract, yellow gradient to red, with bead chains, bells, necklaces hanging around, standing posture, studio, reality model, high ponytail, bold fashion statement', 5, 3, 0, 0),
(27, '888999', 6, 1, 1, 0),
(28, '9', 6, 1, 1, 1),
(29, '萨芬的', 6, 4, 1, 1),
(30, '萨芬的', 6, 4, 1, 0),
(31, '啊发生的', 6, 1, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Password`, `Email`) VALUES
(1, 'test1', 'test1', 'test1@test.com'),
(2, 'test1', 'test1', 'test1@test.com'),
(3, 'test2', 'test2', 'test1@test.com'),
(4, 'test2', 'test2', 'test1@test.com'),
(5, 'woaiff', 'woaiff123', 'fasd@f.com'),
(6, 'fuhengkuan001', 'fuhengkuan001', 'sdf@fd.com'),
(7, 'adminmiss', 'adminmiss@123', 'adminmiss@adminmiss.com'),
(8, '3333', '3333', '3333@fa.com');

--
-- 转储表的索引
--

--
-- 表的索引 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminID`);

--
-- 表的索引 `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- 表的索引 `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `content_id` (`content_id`);

--
-- 表的索引 `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `InfoID` (`InfoID`);

--
-- 表的索引 `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`InfoID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用表AUTO_INCREMENT `images`
--
ALTER TABLE `images`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- 使用表AUTO_INCREMENT `info`
--
ALTER TABLE `info`
  MODIFY `InfoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
