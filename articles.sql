-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 01, 2019 at 10:12 AM
-- Server version: 5.7.21
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cradle_dev_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

CREATE TABLE `app` (
  `app_id` int(10) UNSIGNED NOT NULL,
  `app_title` varchar(255) DEFAULT NULL,
  `app_domain` varchar(255) DEFAULT NULL,
  `app_website` varchar(255) DEFAULT NULL,
  `app_webhook` varchar(255) DEFAULT NULL,
  `app_token` varchar(255) DEFAULT '1',
  `app_secret` varchar(255) DEFAULT '1',
  `app_active` int(1) UNSIGNED DEFAULT '1',
  `app_created` datetime DEFAULT NULL,
  `app_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app`
--

INSERT INTO `app` (`app_id`, `app_title`, `app_domain`, `app_website`, `app_webhook`, `app_token`, `app_secret`, `app_active`, `app_created`, `app_updated`) VALUES
(1, 'Sample App', 'dev.cradle.local', 'http://dev.cradle.local', NULL, '94341e9d0776b73cc7142cc161faf0e688fdbfb2', 'd490f575cd1c48e1b970bb0427ae4ec2b2636403', 1, '2019-01-25 05:44:09', '2019-01-30 08:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `app_profile`
--

CREATE TABLE `app_profile` (
  `app_id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_profile`
--

INSERT INTO `app_profile` (`app_id`, `profile_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_scope`
--

CREATE TABLE `app_scope` (
  `app_id` int(10) UNSIGNED NOT NULL,
  `scope_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_scope`
--

INSERT INTO `app_scope` (`app_id`, `scope_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `app_webhook`
--

CREATE TABLE `app_webhook` (
  `app_id` int(10) UNSIGNED NOT NULL,
  `webhook_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(10) UNSIGNED NOT NULL,
  `article_title` varchar(255) DEFAULT NULL,
  `article_detail` text,
  `article_status` varchar(255) DEFAULT 'pending',
  `article_published` datetime DEFAULT NULL,
  `article_active` int(1) UNSIGNED DEFAULT '1',
  `article_created` datetime DEFAULT NULL,
  `article_updated` datetime DEFAULT NULL,
  `article_references` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `article_title`, `article_detail`, `article_status`, `article_published`, `article_active`, `article_created`, `article_updated`, `article_references`) VALUES
(1, 'What is the Fate of the Furious?', 'I don\'t understand if <b>Jason Stathom</b> killed <b>Sung Kang</b>, <i>(<b>Vin Desiel\'s</b> asian friend).&nbsp;</i>How could they be cool with each other in future \"<b>Fast and Furious\"</b> films?', 'published', '2019-01-30 14:00:00', 1, '2019-01-25 13:27:18', '2019-01-28 07:11:57', '{\"reference_link\": \"https://ew.com/movies/2017/04/15/fate-furious-han-shaw-chris-morgan/\", \"reference_quote\": \"Statham actually joined the franchise at the end of Fast & Furious 6, when it was revealed that he killed longtime Toretto crew member Han (Sung Kang) as the first step of his vengeance mission.\", \"reference_title\": \"The Fate of the Furious: Screenwriter Chris Morgan talks Shaw... and Han\", \"reference_publication\": \"Entertainment Weekly\"}'),
(2, 'Entrepreneur Lessons from Thanos of Infinity Wars', 'Thanos is the villain from <b>Avengers: Infinity Wars&nbsp;</b>that beat the Avengers in the final scenes. Here are the top 5 lessons entrepreneurs should take away from this film.<br><ol><li>Don\'t let anyone stop you from your goals including your loved ones.</li><li>Be ready to sacrifice what you hold dear in this World.</li><li>Nobody will understand your vision until you succeed, ignore the haters.</li><li>Hire people that share your vision and is willing to die for it</li><li>People will try to set you back all the time. It\'s important to be one step ahead</li></ol>', 'published', '2019-01-31 16:00:00', 1, '2019-01-25 13:35:21', '2019-01-25 14:01:43', NULL),
(3, 'What is the Fate of the Furious?', 'I don\'t understand if <b>Jason Stathom</b> killed <b>Sung Kang</b>, <i>(<b>Vin Desiel\'s</b> asian friend). </i>How could they be cool with each other in future \"<b>Fast and Furious\"</b> films?', 'published', '2019-01-30 14:00:00', 0, '2019-01-25 13:59:05', '2019-01-25 13:59:17', NULL),
(4, 'Entrepreneur Lessons from Thanos of Infinity Wars', 'Thanos is the villain from <b>Avengers: Infinity Wars </b>that beat the Avengers in the final scenes. Here are the top 5 lessons entrepreneurs should take away from this film.<br><ol><li>Don\'t let anyone stop you from your goals including your loved ones.</li><li>Be ready to sacrifice what you hold dear in this World.</li><li>Nobody will understand your vision until you succeed, ignore the haters.</li><li>Hire people that share your vision and is willing to die for it</li><li>People will try to set you back all the time. It\'s important to be one step ahead</li></ol><br>', 'published', '2019-01-31 16:00:00', 0, '2019-01-25 14:02:47', '2019-01-25 14:02:51', NULL),
(5, 'Another Article 3', 'This would be the 3rd article in the series.', 'pending', NULL, 1, '2019-01-25 14:22:33', '2019-01-25 14:22:33', NULL),
(6, 'Yet Another Article', 'This would be the 4th article in the series.', 'pending', NULL, 1, '2019-01-25 14:22:33', '2019-01-25 14:22:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article_comment`
--

CREATE TABLE `article_comment` (
  `article_id` int(10) UNSIGNED NOT NULL,
  `comment_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article_comment`
--

INSERT INTO `article_comment` (`article_id`, `comment_id`) VALUES
(1, 1),
(1, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `article_profile`
--

CREATE TABLE `article_profile` (
  `article_id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article_profile`
--

INSERT INTO `article_profile` (`article_id`, `profile_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `auth_id` int(10) UNSIGNED NOT NULL,
  `auth_slug` varchar(255) DEFAULT NULL,
  `auth_password` varchar(255) DEFAULT NULL,
  `auth_type` varchar(255) DEFAULT NULL,
  `auth_active` int(1) UNSIGNED DEFAULT '1',
  `auth_created` datetime DEFAULT NULL,
  `auth_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`auth_id`, `auth_slug`, `auth_password`, `auth_type`, `auth_active`, `auth_created`, `auth_updated`) VALUES
(1, 'john@doe.com', '$2y$10$Qth9i/GcqLUMgmy42Ul82uhi45.n1Ok0Z.EXFwrentE0Pe7TANbsS', 'developer', 1, '2019-01-20 06:43:42', '2019-01-20 06:43:42'),
(2, 'jane@doe.com', '$2y$10$L.9b58SxAFq0wJrABCSDfeLO7jo8p8TXQaf2kLZistHZYW1usgybi', 'admin', 1, '2019-01-26 11:58:48', '2019-01-26 11:58:48'),
(3, 'cblanquera@sterlingtech.ph', '$2y$10$7m.LMLxew3vtMKWGIYJacek33PXTGVdY8dbGRvUZUhsNLk9PpxPlm', NULL, 0, '2019-01-28 12:36:47', '2019-01-28 12:55:30'),
(4, 'cblanquera+1@sterlingtech.ph', '$2y$10$QrgbDLqcVkAb979lmOmh5ODL9GYMCSX4llQArzkERGy/9Xs5Jn9Ya', NULL, 1, '2019-01-28 12:38:51', '2019-01-28 12:39:10'),
(5, 'cblanquera+3@sterlingtech.ph', '$2y$10$jZUhiGyYiy9jid68hcSWCemX.ZdbWZBN7T418fPYj2papMf89IUFK', NULL, 0, '2019-01-28 12:51:45', '2019-01-28 12:51:45'),
(6, 'janet@doe.com', '$2y$10$imUhiCeEenBPHWBxHjgXsehtP/30BLpIAjGoqXpK6N//z6ytpJPDC', NULL, 1, '2019-01-30 06:08:01', '2019-01-30 06:08:01'),
(7, 'janet+2@doe.com', '$2y$10$Xmc7JDgfTdWMGY9v8SH7DexuIUOpUzusc4bjsn/DD1li2BsB5LCWK', NULL, 1, '2019-01-30 08:02:40', '2019-01-30 08:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `auth_profile`
--

CREATE TABLE `auth_profile` (
  `auth_id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_profile`
--

INSERT INTO `auth_profile` (`auth_id`, `profile_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(10) UNSIGNED NOT NULL,
  `comment_detail` text,
  `comment_active` int(1) UNSIGNED DEFAULT '1',
  `comment_created` datetime DEFAULT NULL,
  `comment_updated` datetime DEFAULT NULL,
  `comment_rating` float(10,1) DEFAULT '0.0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_detail`, `comment_active`, `comment_created`, `comment_updated`, `comment_rating`) VALUES
(1, 'But Vin Diesel killed his brother so fair is square?', 1, '2019-01-26 10:35:30', '2019-01-26 10:52:08', 3.0),
(2, 'Oh that\'s right.', 1, '2019-01-26 10:46:26', '2019-01-26 10:52:16', 2.5),
(3, 'I think so', 1, '2019-01-30 09:14:24', '2019-01-30 09:14:24', 0.0),
(4, 'I think it\'s more of a circle', 1, '2019-01-30 09:14:56', '2019-01-30 09:14:56', 0.0);

-- --------------------------------------------------------

--
-- Table structure for table `comment_comment`
--

CREATE TABLE `comment_comment` (
  `comment_id_1` int(10) UNSIGNED NOT NULL,
  `comment_id_2` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment_comment`
--

INSERT INTO `comment_comment` (`comment_id_1`, `comment_id_2`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `comment_profile`
--

CREATE TABLE `comment_profile` (
  `comment_id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment_profile`
--

INSERT INTO `comment_profile` (`comment_id`, `profile_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(10) UNSIGNED NOT NULL,
  `history_activity` text,
  `history_page` text,
  `history_path` varchar(255) DEFAULT NULL,
  `history_type` varchar(255) DEFAULT NULL,
  `history_table_name` varchar(255) DEFAULT NULL,
  `history_table_id` varchar(255) DEFAULT NULL,
  `history_flag` int(1) UNSIGNED DEFAULT '0',
  `history_active` int(1) UNSIGNED DEFAULT '1',
  `history_created` datetime DEFAULT NULL,
  `history_updated` datetime DEFAULT NULL,
  `history_remote_address` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `history_activity`, `history_page`, `history_path`, `history_type`, `history_table_name`, `history_table_id`, `history_flag`, `history_active`, `history_created`, `history_updated`, `history_remote_address`) VALUES
(1, 'updated schema: Application', '/admin/system/schema/update/app?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', 'a60979f20c13e96fac108a720c324ca3.json', 'update', 'schema', 'app', 1, 1, '2019-01-23 04:16:49', '2019-01-23 04:16:49', '127.0.0.1'),
(2, 'updated schema: REST Call', '/admin/system/schema/update/rest?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '72d67b4b16948fd436d37a4fbf013f02.json', 'update', 'schema', 'rest', 1, 1, '2019-01-23 04:16:58', '2019-01-23 04:16:58', '127.0.0.1'),
(3, 'updated schema: Scope', '/admin/system/schema/update/scope?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '78195a242b2ed2ddce36c634ab7cc1e4.json', 'update', 'schema', 'scope', 1, 1, '2019-01-23 04:17:07', '2019-01-23 04:17:07', '127.0.0.1'),
(4, 'updated schema: Session', '/admin/system/schema/update/session?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '30e253b6b48ab7cae749defe4dd1f10e.json', 'update', 'schema', 'session', 1, 1, '2019-01-23 04:17:15', '2019-01-23 04:17:15', '127.0.0.1'),
(5, 'updated schema: Webhook', '/admin/system/schema/update/webhook?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '67455b787ed5b1897834f6a53ef2608f.json', 'update', 'schema', 'webhook', 1, 1, '2019-01-23 04:17:24', '2019-01-23 04:17:24', '127.0.0.1'),
(6, 'updated schema: Profile', '/admin/system/schema/update/profile?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '9d01ca83e019e5c1823ec6cbcd1ae7d7.json', 'update', 'schema', 'profile', 1, 1, '2019-01-23 04:17:35', '2019-01-23 04:17:35', '127.0.0.1'),
(7, 'updated schema: Role', '/admin/system/schema/update/role?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '8808d5adcaa8a4306099b0353a6af8dd.json', 'update', 'schema', 'role', 1, 1, '2019-01-23 04:17:43', '2019-01-23 04:17:43', '127.0.0.1'),
(8, 'updated schema: Authentication', '/admin/system/schema/update/auth?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '87526165159dfda5e63b390466bfb327.json', 'update', 'schema', 'auth', 1, 1, '2019-01-23 04:17:51', '2019-01-23 04:17:51', '127.0.0.1'),
(9, 'updated schema: History', '/admin/system/schema/update/history?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', 'a43689cb81c1089f15be68ae255253fa.json', 'update', 'schema', 'history', 1, 1, '2019-01-23 04:19:14', '2019-01-23 04:19:14', '127.0.0.1'),
(10, 'created new Scope', '/admin/system/model/scope/create?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fscope%2Fsearch', '4237fa3865f04153f682ebc2698197ec.json', 'create', 'scope', '1', 1, 1, '2019-01-25 05:39:26', '2019-01-25 05:39:26', '127.0.0.1'),
(11, 'created new REST Call', '/admin/system/model/scope/1/create/rest?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fscope%2F1%2Fsearch%2Frest', 'efbe0f2e83b039bcb1b78569c161e2dc.json', 'create', 'rest', '1', 1, 1, '2019-01-25 05:43:27', '2019-01-25 05:43:27', '127.0.0.1'),
(12, 'created new Application', '/admin/system/model/app/create?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fapp%2Fsearch', 'dfaaf9e5f8ba10260dea84d235e41dd2.json', 'create', 'app', '1', 1, 1, '2019-01-25 05:44:09', '2019-01-25 05:44:09', '127.0.0.1'),
(13, 'created new REST Call', '/admin/system/model/scope/1/create/rest?copy=1&redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fscope%2F1%2Fsearch%2Frest', 'db3ff68399addabe0b7217b9e7327c89.json', 'create', 'rest', '2', 1, 1, '2019-01-25 05:46:22', '2019-01-25 05:46:22', '127.0.0.1'),
(14, 'created new REST Call', '/admin/system/model/rest/create?copy=1&redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Frest%2Fsearch', '6613966b8e8cd6c6db9c3f75a1bedd11.json', 'create', 'rest', '3', 1, 1, '2019-01-25 05:49:43', '2019-01-25 05:49:43', '127.0.0.1'),
(15, 'created new Webhook', '/admin/system/model/webhook/create?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fwebhook%2Fsearch', '3290f077b8614876856585564a314d18.json', 'create', 'webhook', '1', 1, 1, '2019-01-25 05:51:10', '2019-01-25 05:51:10', '127.0.0.1'),
(16, 'updated Application #1', '/admin/system/model/app/update/1?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fapp%2Fsearch', 'ebb4e23103e9891c998f02994c6f0be1.json', 'update', 'app', '1', 1, 1, '2019-01-25 05:51:49', '2019-01-25 05:51:49', '127.0.0.1'),
(17, 'updated Session #1', '/admin/system/model/session/update/1?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fsession%2Fsearch', '6ce70a4e9cff2283217161526b7654eb.json', 'update', 'session', '1', 1, 1, '2019-01-25 05:52:34', '2019-01-25 05:52:34', '127.0.0.1'),
(18, 'created schema: Article', '/admin/system/schema/create?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '8770ee9c1f6799f43c64f705ff876990.json', 'create', 'schema', 'article', 1, 1, '2019-01-25 13:20:57', '2019-01-25 13:20:57', '127.0.0.1'),
(19, 'created new Article', '/admin/system/model/article/create?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2Fsearch', 'c695b4bfc06d4ae28c8a74e036401e7f.json', 'create', 'article', '1', 1, 1, '2019-01-25 13:27:18', '2019-01-25 13:27:18', '127.0.0.1'),
(20, 'created new Article', '/admin/system/model/article/create?copy=1&redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2Fsearch', '59651638274d8e25f188d64b498467ba.json', 'create', 'article', '2', 1, 1, '2019-01-25 13:35:21', '2019-01-25 13:35:21', '127.0.0.1'),
(21, 'removed Article #2', '/admin/system/model/article/remove/2?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2Fsearch', '28997505f4d6af580098fc4b5756539d.json', 'remove', 'article', '2', 1, 1, '2019-01-25 13:38:37', '2019-01-25 13:38:37', '127.0.0.1'),
(22, 'restored Article #2', '/admin/system/model/article/restore/2?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2Fsearch%3Ffilter%5Barticle_active%5D%3D0', '885324efbdb541f199e3948d4a8038d8.json', 'restore', 'article', '2', 1, 1, '2019-01-25 13:39:45', '2019-01-25 13:39:45', '127.0.0.1'),
(23, 'updated schema: Article', '/admin/system/schema/update/article?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '790ff3d4b550a0c6609245f5d799abc9.json', 'update', 'schema', 'article', 1, 1, '2019-01-25 13:40:37', '2019-01-25 13:40:37', '127.0.0.1'),
(24, 'updated schema: Article', '/admin/system/schema/update/article?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '23a3330c523447081196aa2c56c19c8e.json', 'update', 'schema', 'article', 1, 1, '2019-01-25 13:41:04', '2019-01-25 13:41:04', '127.0.0.1'),
(25, 'updated schema: Article', '/admin/system/schema/update/article?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', 'a2fe2151424709c1fe09d167b7d445bf.json', 'update', 'schema', 'article', 1, 1, '2019-01-25 13:46:07', '2019-01-25 13:46:07', '127.0.0.1'),
(26, 'updated schema: Article', '/admin/system/schema/update/article?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '118fa363b746e0e711ff0b9606a66122.json', 'update', 'schema', 'article', 1, 1, '2019-01-25 13:46:17', '2019-01-25 13:46:17', '127.0.0.1'),
(27, 'updated schema: Article', '/admin/system/schema/update/article?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '7f86e14b671649f33ee17b1ba2474615.json', 'update', 'schema', 'article', 1, 1, '2019-01-25 13:55:49', '2019-01-25 13:55:49', '127.0.0.1'),
(28, 'updated schema: Article', '/admin/system/schema/update/article?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', 'a12031ac288601509be6675e591c0e2e.json', 'update', 'schema', 'article', 1, 1, '2019-01-25 13:56:15', '2019-01-25 13:56:15', '127.0.0.1'),
(29, 'updated Article #1', '/admin/system/model/article/update/1?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2Fsearch', '8e6eb952a61dbd771a68f984056ea29b.json', 'update', 'article', '1', 1, 1, '2019-01-25 13:56:27', '2019-01-25 13:56:27', '127.0.0.1'),
(30, 'updated Article #2', '/admin/system/model/article/update/2?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2Fsearch', 'b6c22873ead1476008803dd2474945f7.json', 'update', 'article', '2', 1, 1, '2019-01-25 13:56:34', '2019-01-25 13:56:34', '127.0.0.1'),
(31, 'updated schema: Article', '/admin/system/schema/update/article?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '04a12657ebf870cb9d7dc15dcf30f916.json', 'update', 'schema', 'article', 1, 1, '2019-01-25 13:56:48', '2019-01-25 13:56:48', '127.0.0.1'),
(32, 'created new Article', '/admin/system/model/article/create?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2Fsearch', '6277ea52648dd313aab7d2a5267cefe2.json', 'create', 'article', '3', 1, 1, '2019-01-25 13:59:05', '2019-01-25 13:59:05', '127.0.0.1'),
(33, 'removed Article #3', '/admin/system/model/article/remove/3?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2Fsearch', 'd7d2793787406dfb6915d75728b24207.json', 'remove', 'article', '3', 1, 1, '2019-01-25 13:59:17', '2019-01-25 13:59:17', '127.0.0.1'),
(34, 'removed Article #2', '/admin/system/model/article/remove/2?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2Fsearch', '93cfa384376bd0a4860dade78d9c2d58.json', 'remove', 'article', '2', 1, 1, '2019-01-25 13:59:25', '2019-01-25 13:59:25', '127.0.0.1'),
(35, 'restored Article #2', '/admin/system/model/article/restore/2?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2Fsearch%3Ffilter%5Barticle_active%5D%3D0', '43a6bdf6e13f80330bca7b3285e6a4b5.json', 'restore', 'article', '2', 1, 1, '2019-01-25 14:01:43', '2019-01-25 14:01:43', '127.0.0.1'),
(36, 'created new Article', '/admin/system/model/article/create?copy=1&redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2Fsearch', '27d7cd4738e1ca48c3f5b3f8ae54c865.json', 'create', 'article', '4', 1, 1, '2019-01-25 14:02:47', '2019-01-25 14:02:47', '127.0.0.1'),
(37, 'removed Article #4', '/admin/system/model/article/remove/4?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2Fsearch', 'e5db895758dabbe95ccc31beabb6935c.json', 'remove', 'article', '4', 1, 1, '2019-01-25 14:02:51', '2019-01-25 14:02:51', '127.0.0.1'),
(38, 'imported Articles', '/admin/system/model/article/import', 'fd1c3cd539eca83f0b03229777e9936a.json', 'import', NULL, NULL, 1, 1, '2019-01-25 14:22:33', '2019-01-25 14:22:33', '127.0.0.1'),
(39, 'created schema: Comment', '/admin/system/schema/create?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '5001ebedc091f1586b41124536bfea19.json', 'create', 'schema', 'comment', 1, 1, '2019-01-25 17:29:27', '2019-01-25 17:29:27', '127.0.0.1'),
(40, 'updated schema: Article', '/admin/system/schema/update/article?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '0a71e40b6598d9bcd3bc17efba5633aa.json', 'update', 'schema', 'article', 1, 1, '2019-01-25 17:29:44', '2019-01-25 17:29:44', '127.0.0.1'),
(41, 'updated schema: Comment', '/admin/system/schema/update/comment?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '9a32495e65fab7f79d7a789324917cde.json', 'update', 'schema', 'comment', 1, 1, '2019-01-25 17:30:17', '2019-01-25 17:30:17', '127.0.0.1'),
(42, 'updated schema: Comment', '/admin/system/schema/update/comment?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '19ca8cf5efe8e1be65e56326b6b86445.json', 'update', 'schema', 'comment', 1, 1, '2019-01-25 17:30:36', '2019-01-25 17:30:36', '127.0.0.1'),
(43, 'updated schema: Comment', '/admin/system/schema/update/comment?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '5f061e404b6974c65b5033347f272867.json', 'update', 'schema', 'comment', 1, 1, '2019-01-25 17:47:15', '2019-01-25 17:47:15', '127.0.0.1'),
(44, 'created new Comment', '/admin/system/model/article/1/create/comment?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2F1%2Fsearch%2Fcomment', 'e8d137ec911f43fd1ff8890e564b740d.json', 'create', 'comment', '1', 1, 1, '2019-01-26 10:35:30', '2019-01-26 10:35:30', '127.0.0.1'),
(45, 'Article #1 unlinked from Comment #1', '/admin/system/model/article/1/unlink/comment/1?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2F1%2Fsearch%2Fcomment', 'e26cd71dee2ac91eaf80ee2156aee9cb.json', NULL, NULL, NULL, 1, 1, '2019-01-26 10:37:17', '2019-01-26 10:37:17', '127.0.0.1'),
(46, 'Article #1 linked to Comment #1', '/admin/system/model/article/1/link/comment?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2F1%2Fsearch%2Fcomment', '62db21be884bd3d90adc5c96f689da0d.json', NULL, NULL, NULL, 1, 1, '2019-01-26 10:40:28', '2019-01-26 10:40:28', '127.0.0.1'),
(47, 'updated schema: Comment', '/admin/system/schema/update/comment?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', 'ab3c21fee04325b3c8208efa215026db.json', 'update', 'schema', 'comment', 1, 1, '2019-01-26 10:42:10', '2019-01-26 10:42:10', '127.0.0.1'),
(48, 'created new Comment', '/admin/system/model/comment/1/create/comment?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fcomment%2F1%2Fsearch%2Fcomment', '645c9d712123cf3cf77f0723b2b5bedc.json', 'create', 'comment', '2', 1, 1, '2019-01-26 10:46:26', '2019-01-26 10:46:26', '127.0.0.1'),
(49, 'updated schema: Comment', '/admin/system/schema/update/comment?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '144bab62190d27a39d644f61effef5f1.json', 'update', 'schema', 'comment', 1, 1, '2019-01-26 10:49:32', '2019-01-26 10:49:32', '127.0.0.1'),
(50, 'updated schema: Comment', '/admin/system/schema/update/comment?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', 'b0eb8d8121910847b9cf07b45ad035ad.json', 'update', 'schema', 'comment', 1, 1, '2019-01-26 10:51:57', '2019-01-26 10:51:57', '127.0.0.1'),
(51, 'updated Comment #1', '/admin/system/model/comment/update/1?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fcomment%2Fsearch', '25c4e54adaf82a36ce8cf2f1f15eebb3.json', 'update', 'comment', '1', 1, 1, '2019-01-26 10:52:08', '2019-01-26 10:52:08', '127.0.0.1'),
(52, 'updated Comment #2', '/admin/system/model/comment/update/2?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fcomment%2Fsearch', 'e01414703b07015d1b17a3f7fb33c4cb.json', 'update', 'comment', '2', 1, 1, '2019-01-26 10:52:16', '2019-01-26 10:52:16', '127.0.0.1'),
(53, 'updated schema: Comment', '/admin/system/schema/update/comment?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '2a95196db2e0538bf7e6648e1b81f8b4.json', 'update', 'schema', 'comment', 1, 1, '2019-01-26 10:52:36', '2019-01-26 10:52:36', '127.0.0.1'),
(54, 'updated schema: Comment', '/admin/system/schema/update/comment?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '3a83f9e3490707de3256dbec846b3493.json', 'update', 'schema', 'comment', 1, 1, '2019-01-26 10:55:17', '2019-01-26 10:55:17', '127.0.0.1'),
(55, 'Comment #1 linked to Comment #2', '/admin/system/model/comment/1/link/comment?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fcomment%2F1%2Fsearch%2Fcomment', '2643b2488b18de6cd22bd324fedee6a7.json', NULL, NULL, NULL, 1, 1, '2019-01-26 10:58:03', '2019-01-26 10:58:03', '127.0.0.1'),
(56, 'updated Role #1', '/admin/system/model/role/update/1?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Frole%2Fsearch', '6b8a74e8d555573bb1a408441b917123.json', 'update', 'role', '1', 1, 1, '2019-01-26 11:41:19', '2019-01-26 11:41:19', '127.0.0.1'),
(57, 'updated Role #1', '/admin/system/model/role/update/1?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Frole%2Fsearch', '2a914f85c8c31fe9f0791cdd0aac033d.json', 'update', 'role', '1', 1, 1, '2019-01-26 11:52:25', '2019-01-26 11:52:25', '127.0.0.1'),
(58, 'created new Profile', '/admin/system/model/profile/create?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fprofile%2Fsearch', '2cf9898f49991f4d5e8da97e5d622fc3.json', 'create', 'profile', '2', 1, 1, '2019-01-26 11:55:03', '2019-01-26 11:55:03', '127.0.0.1'),
(59, 'created new Authentication', '/admin/system/model/auth/create?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fauth%2Fsearch', '6e135effc7534845cef4a1e07516a1ad.json', 'create', 'auth', '2', 1, 1, '2019-01-26 11:58:48', '2019-01-26 11:58:48', '127.0.0.1'),
(60, 'updated Role #2', '/admin/system/model/role/update/2?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Frole%2Fsearch', '47a6b59ade88f8e3c849fbc8a922f7d0.json', 'update', 'role', '2', 1, 1, '2019-01-26 12:04:58', '2019-01-26 12:04:58', '127.0.0.1'),
(61, 'updated Role #2', '/admin/system/model/role/update/2?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Frole%2Fsearch', 'e2900c85d032fefcb67833c3dbfabeb4.json', 'update', 'role', '2', 1, 1, '2019-01-26 12:07:45', '2019-01-26 12:07:45', '127.0.0.1'),
(62, 'created fieldset: Reference', '/admin/system/fieldset/create?redirect_uri=%2Fadmin%2Fsystem%2Ffieldset%2Fsearch', 'e0f7ba3ac8a676c6dcf2225cf4bca84f.json', 'create', 'fieldset', 'reference', 1, 1, '2019-01-28 03:48:35', '2019-01-28 03:48:35', '127.0.0.1'),
(63, 'updated schema: Article', '/admin/system/schema/update/article?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', 'dfc392c2a96896e9c4f7ea8c21964586.json', 'update', 'schema', 'article', 1, 1, '2019-01-28 04:01:54', '2019-01-28 04:01:54', '127.0.0.1'),
(64, 'updated Article #1', '/admin/system/model/article/update/1?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2Fsearch', '26c1389a0d5638fdf5d912889b5a3355.json', 'update', 'article', '1', 1, 1, '2019-01-28 04:06:48', '2019-01-28 04:06:48', '127.0.0.1'),
(65, 'updated schema: Article', '/admin/system/schema/update/article?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '1181b036906d0fadaf112548d70e2051.json', 'update', 'schema', 'article', 1, 1, '2019-01-28 04:26:00', '2019-01-28 04:26:00', '127.0.0.1'),
(66, 'updated schema: Article', '/admin/system/schema/update/article?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '296df147c247960842488eb4ca6fcd09.json', 'update', 'schema', 'article', 1, 1, '2019-01-28 04:26:40', '2019-01-28 04:26:40', '127.0.0.1'),
(67, 'updated schema: Article', '/admin/system/schema/update/article?redirect_uri=%2Fadmin%2Fsystem%2Fschema%2Fsearch', '608da7f8795224c718a461127486658d.json', 'update', 'schema', 'article', 1, 1, '2019-01-28 04:26:53', '2019-01-28 04:26:53', '127.0.0.1'),
(68, 'updated Article #1', '/admin/system/model/article/update/1?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2Fsearch', 'e704ee6e15bad8477614591b638fe835.json', 'update', 'article', '1', 1, 1, '2019-01-28 04:32:46', '2019-01-28 04:32:46', '127.0.0.1'),
(69, 'updated Article #1', '/admin/system/model/article/update/1?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Farticle%2Fsearch', '471017f3c3d9f4860cb17f5c3efca9ca.json', 'update', 'article', '1', 1, 1, '2019-01-28 07:09:12', '2019-01-28 07:09:12', '127.0.0.1'),
(70, 'reverted article #1', '/admin/history/model/revert/69', 'db08414de9f6f57774957db09cc50809.json', 'update', 'article', '1', 1, 1, '2019-01-28 07:11:57', '2019-01-28 07:11:57', '127.0.0.1'),
(71, 'created new Scope', '/admin/system/model/scope/create?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fscope%2Fsearch', '78602ca9acace7b5c69fdc1b65cf60f9.json', 'create', 'scope', '2', 1, 1, '2019-01-30 05:53:35', '2019-01-30 05:53:35', '127.0.0.1'),
(72, 'created new REST Call', '/admin/system/model/scope/2/create/rest?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fscope%2F2%2Fsearch%2Frest', '1e78992d9673eb0d7bbee040beebff14.json', 'create', 'rest', '4', 1, 1, '2019-01-30 05:59:43', '2019-01-30 05:59:43', '127.0.0.1'),
(73, 'updated Application #1', '/admin/system/model/app/update/1?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fapp%2Fsearch', '321b012d20f4263713873dff4e8639bf.json', 'update', 'app', '1', 1, 1, '2019-01-30 06:04:18', '2019-01-30 06:04:18', '127.0.0.1'),
(74, 'updated Application #1', '/admin/system/model/app/update/1?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fapp%2Fsearch%3Ffilter%255Bapp_token%255D%3D94341e9d0776b73cc7142cc161faf0e688fdbfb2', 'cd5830c3d96622192c2c6eb7080f7ddd.json', 'update', 'app', '1', 1, 1, '2019-01-30 08:09:55', '2019-01-30 08:09:55', '127.0.0.1'),
(75, 'updated Application #1', '/admin/system/model/app/update/1?redirect_uri=%2Fadmin%2Fsystem%2Fmodel%2Fapp%2Fsearch%3Ffilter%255Bapp_token%255D%3D94341e9d0776b73cc7142cc161faf0e688fdbfb2', '611ad7939e287573aca1f772bfbc643a.json', 'update', 'app', '1', 1, 1, '2019-01-30 08:10:05', '2019-01-30 08:10:05', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `history_profile`
--

CREATE TABLE `history_profile` (
  `history_id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history_profile`
--

INSERT INTO `history_profile` (`history_id`, `profile_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(10) UNSIGNED NOT NULL,
  `profile_name` varchar(255) DEFAULT NULL,
  `profile_active` int(1) UNSIGNED DEFAULT '1',
  `profile_created` datetime DEFAULT NULL,
  `profile_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `profile_name`, `profile_active`, `profile_created`, `profile_updated`) VALUES
(1, 'John Doe', 1, '2019-01-20 06:43:42', '2019-01-20 06:43:42'),
(2, 'Jane Doe', 1, '2019-01-26 11:54:58', '2019-01-26 11:54:58'),
(3, 'Chris Blanquera', 1, '2019-01-28 12:36:42', '2019-01-28 12:36:42'),
(4, 'Chris Blanquera', 1, '2019-01-28 12:38:46', '2019-01-28 12:38:46'),
(5, 'Christian Blanquera 3', 1, '2019-01-28 12:51:40', '2019-01-28 12:51:40'),
(6, 'Janet Doe', 1, '2019-01-30 06:08:01', '2019-01-30 06:08:01'),
(7, 'Janet Doe', 1, '2019-01-30 08:02:40', '2019-01-30 08:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `rest`
--

CREATE TABLE `rest` (
  `rest_id` int(10) UNSIGNED NOT NULL,
  `rest_title` varchar(255) DEFAULT NULL,
  `rest_type` varchar(255) DEFAULT 'public',
  `rest_method` varchar(255) DEFAULT 'all',
  `rest_path` varchar(255) DEFAULT NULL,
  `rest_event` varchar(255) DEFAULT NULL,
  `rest_parameters` json DEFAULT NULL,
  `rest_detail` text,
  `rest_sample_request` text,
  `rest_sample_response` text,
  `rest_active` int(1) UNSIGNED DEFAULT '1',
  `rest_created` datetime DEFAULT NULL,
  `rest_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rest`
--

INSERT INTO `rest` (`rest_id`, `rest_title`, `rest_type`, `rest_method`, `rest_path`, `rest_event`, `rest_parameters`, `rest_detail`, `rest_sample_request`, `rest_sample_response`, `rest_active`, `rest_created`, `rest_updated`) VALUES
(1, 'Profile Search', 'public', 'get', '/public/profile/search', 'system-model-search', '{\"schema\": \"profile\"}', 'This returns a list of profiles.\r\n\r\n### Parameters\r\n\r\n - `q` - Search Term\r\n - `start` - Pagination start\r\n - `range` - Pagination range\r\n - `filter` - Column filters like `filter[profile_name]=John+Doe`', '```\r\nGET /public/profile/search?q=John\r\n```', '```json\r\n{\r\n    \"error\": false,\r\n    \"results\": {\r\n        \"rows\": [\r\n            {\r\n                \"profile_id\": 1,\r\n                \"profile_name\": \"John Doe\"\r\n            }\r\n        ],\r\n        \"total\": 1\r\n    }\r\n}\r\n```', 1, '2019-01-25 05:43:27', '2019-01-25 05:43:27'),
(2, 'Profile Detail', 'app', 'get', '/public/profile/detail/:profile_id', 'system-model-detail', '{\"schema\": \"profile\"}', 'This returns a profile.\r\n\r\n### Parameters\r\n\r\n*No parameters*', '\r\nRequires an APP KEY\r\n\r\n```\r\nGET /public/profile/detail/1?client_id=[APP_KEY]\r\n```', '```json\r\n{\r\n    \"error\": false,\r\n    \"results\": {\r\n        {\r\n            \"profile_id\": 1,\r\n            \"profile_name\": \"John Doe\"\r\n        }\r\n    }\r\n}\r\n```', 1, '2019-01-25 05:46:22', '2019-01-25 05:46:22'),
(3, 'Application Search', 'public', 'get', '/user/app/search', 'system-model-search', '{\"schema\": \"app\"}', 'This returns a list of apps a user owns.\r\n\r\n### Parameters\r\n\r\n - `q` - Search Term\r\n - `start` - Pagination start\r\n - `range` - Pagination range\r\n - `filter` - Column filters like `filter[app_title]=Sample+App`', 'Requires a SESSION KEY\r\n\r\n```\r\nGET /user/app/search?session_token=[SESSION_KEY]\r\n```', '```json\r\n{\r\n    \"error\": false,\r\n    \"results\": {\r\n        \"rows\": [\r\n            {\r\n                \"app_id\": 1,\r\n                \"app_title\": \"Sample App\"\r\n            }\r\n        ],\r\n        \"total\": 1\r\n    }\r\n}\r\n```', 1, '2019-01-25 05:49:43', '2019-01-25 05:49:43'),
(4, 'Sign Up', 'app', 'post', '/auth/signup', 'auth-create', '{\"auth_active\": 1}', 'Signs up a User via API\r\n\r\n## Parameters\r\n\r\n**profile_name**|required|ex. John Doe\r\n**auth_slug**|required|ex. john@doe.com\r\n**auth_password**|required|ex. 123\r\n**confirm**|required|ex. 123', '```bash\r\nPOST /rest/auth/signup\r\n\r\nprofile_name=John+Doe&auth_slug=john@doe.com&auth_password=123&confirm=123\r\n```', '```json\r\n{\r\n    \"error\": false,\r\n    \"results\": {\r\n        \"auth_id\": 1,\r\n        \"profile_id\": 1\r\n    }\r\n}\r\n```', 1, '2019-01-30 05:59:43', '2019-01-30 05:59:43');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `role_slug` varchar(255) DEFAULT NULL,
  `role_locked` int(1) UNSIGNED DEFAULT '0',
  `role_permissions` json DEFAULT NULL,
  `role_admin_menu` json DEFAULT NULL,
  `role_active` int(1) UNSIGNED DEFAULT '1',
  `role_created` datetime DEFAULT NULL,
  `role_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_slug`, `role_locked`, `role_permissions`, `role_admin_menu`, `role_active`, `role_created`, `role_updated`) VALUES
(1, 'Developer', 'developer', 1, '[{\"path\": \"**\", \"label\": \"All Access\", \"method\": \"all\"}]', '[{\"icon\": \"fas fa-tachometer-alt\", \"path\": \"/admin/dashboard\", \"label\": \"Dashboard\"}, {\"icon\": \"fas fa-newspaper\", \"path\": \"/admin/system/model/article/search\", \"label\": \"Articles\"}, {\"icon\": \"fas fa-coffee\", \"path\": \"#menu-admin\", \"label\": \"Admin\", \"children\": [{\"icon\": \"fas fa-user\", \"path\": \"/admin/system/model/profile/search\", \"label\": \"Profiles\"}, {\"icon\": \"fas fa-lock\", \"path\": \"/admin/system/model/auth/search\", \"label\": \"Auth\"}, {\"icon\": \"fas fa-key\", \"path\": \"/admin/system/model/role/search\", \"label\": \"Roles\"}]}, {\"icon\": \"fas fa-code\", \"path\": \"#menu-api\", \"label\": \"API\", \"children\": [{\"icon\": \"fas fa-mobile-alt\", \"path\": \"/admin/system/model/app/search\", \"label\": \"Applications\"}, {\"icon\": \"fas fa-address-card\", \"path\": \"/admin/system/model/session/search\", \"label\": \"Sessions\"}, {\"icon\": \"fas fa-crosshairs\", \"path\": \"/admin/system/model/scope/search\", \"label\": \"Scopes\"}, {\"icon\": \"fas fa-phone\", \"path\": \"/admin/system/model/rest/search\", \"label\": \"REST Calls\"}, {\"icon\": \"fas fa-comments\", \"path\": \"/admin/system/model/webhook/search\", \"label\": \"Webhooks\"}]}, {\"icon\": \"fas fa-server\", \"path\": \"#menu-system\", \"label\": \"System\", \"children\": [{\"icon\": \"fas fa-database\", \"path\": \"/admin/system/schema/search\", \"label\": \"Schemas\"}, {\"icon\": \"fas fa-sliders-h\", \"path\": \"/admin/system/fieldset/search\", \"label\": \"Fieldsets\"}, {\"icon\": \"fas fa-cogs\", \"path\": \"/admin/configuration\", \"label\": \"Configuration\"}, {\"icon\": \"fas fa-plug\", \"path\": \"/admin/package/search\", \"label\": \"Packages\"}]}, {\"icon\": \"fas fa-columns\", \"path\": \"#menu-templates\", \"label\": \"Templates\", \"children\": [{\"icon\": \"fas fa-puzzle-piece\", \"path\": \"/admin/template/ui\", \"label\": \"UI\"}, {\"icon\": \"fas fa-search\", \"path\": \"/admin/template/search\", \"label\": \"Search\"}, {\"icon\": \"fas fa-sliders-h\", \"path\": \"/admin/template/form\", \"label\": \"Form\"}]}]', 1, '2019-01-20 06:43:42', '2019-01-26 11:52:25'),
(2, 'Admin', 'admin', 1, '[{\"path\": \"/admin\", \"label\": \"Admin Dashboard\", \"method\": \"all\"}, {\"path\": \"(?!/(admin))/**\", \"label\": \"All Front End Access\", \"method\": \"all\"}, {\"path\": \"/admin/system/model/article/**\", \"label\": \"Admin Articles\", \"method\": \"all\"}, {\"path\": \"/admin/system/model/comment/**\", \"label\": \"Admin Comments\", \"method\": \"all\"}]', '[{\"icon\": \"fas fa-tachometer-alt\", \"path\": \"/admin/dashboard\", \"label\": \"Dashboard\"}, {\"icon\": \"fas fa-newspaper\", \"path\": \"/admin/system/model/article/search\", \"label\": \"Articles\"}, {\"icon\": \"fas fa-coffee\", \"path\": \"#menu-admin\", \"label\": \"Admin\", \"children\": [{\"icon\": \"fas fa-user\", \"path\": \"/admin/system/model/profile/search\", \"label\": \"Profiles\"}, {\"icon\": \"fas fa-lock\", \"path\": \"/admin/system/model/auth/search\", \"label\": \"Auth\"}, {\"icon\": \"fas fa-key\", \"path\": \"/admin/system/model/role/search\", \"label\": \"Roles\"}]}]', 1, '2019-01-20 06:43:42', '2019-01-26 12:07:45'),
(3, 'Guest', 'guest', 1, '[{\"path\": \"(?!/(admin))/**\", \"label\": \"All Front End Access\", \"method\": \"all\"}]', '[]', 1, '2019-01-20 06:43:42', '2019-01-20 06:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `scope`
--

CREATE TABLE `scope` (
  `scope_id` int(10) UNSIGNED NOT NULL,
  `scope_name` varchar(255) DEFAULT NULL,
  `scope_slug` varchar(255) DEFAULT NULL,
  `scope_type` varchar(255) DEFAULT 'app',
  `scope_detail` text,
  `scope_special_approval` int(1) UNSIGNED DEFAULT '0',
  `scope_active` int(1) UNSIGNED DEFAULT '1',
  `scope_created` datetime DEFAULT NULL,
  `scope_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scope`
--

INSERT INTO `scope` (`scope_id`, `scope_name`, `scope_slug`, `scope_type`, `scope_detail`, `scope_special_approval`, `scope_active`, `scope_created`, `scope_updated`) VALUES
(1, 'Read Profiles', 'read_profiles', 'app', 'This reads profile data', NULL, 1, '2019-01-25 05:39:25', '2019-01-25 05:39:25'),
(2, 'Authentication', 'authentication', 'app', 'Allows for mobile authentication management.', NULL, 1, '2019-01-30 05:53:35', '2019-01-30 05:53:35');

-- --------------------------------------------------------

--
-- Table structure for table `scope_rest`
--

CREATE TABLE `scope_rest` (
  `scope_id` int(10) UNSIGNED NOT NULL,
  `rest_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scope_rest`
--

INSERT INTO `scope_rest` (`scope_id`, `rest_id`) VALUES
(1, 1),
(1, 2),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` int(10) UNSIGNED NOT NULL,
  `session_token` varchar(255) DEFAULT '1',
  `session_secret` varchar(255) DEFAULT '1',
  `session_status` varchar(255) DEFAULT 'pending',
  `session_active` int(1) UNSIGNED DEFAULT '1',
  `session_created` datetime DEFAULT NULL,
  `session_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `session_token`, `session_secret`, `session_status`, `session_active`, `session_created`, `session_updated`) VALUES
(1, '8cddabc765dbba7cccaa156105af08c04455775c', 'ccbd225171af0c8ea679ab4859b4754b22a34cf4', 'access', 1, '2019-01-25 05:52:13', '2019-01-25 05:52:34'),
(2, 'f7b9427a17ad4f083fb109ba382a99ca', '9d5b6d575f13f2c14c5fa8cc843c07fd', 'access', 1, '2019-01-25 08:41:20', '2019-01-25 08:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `session_app`
--

CREATE TABLE `session_app` (
  `session_id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session_app`
--

INSERT INTO `session_app` (`session_id`, `app_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `session_profile`
--

CREATE TABLE `session_profile` (
  `session_id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session_profile`
--

INSERT INTO `session_profile` (`session_id`, `profile_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `session_scope`
--

CREATE TABLE `session_scope` (
  `session_id` int(10) UNSIGNED NOT NULL,
  `scope_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session_scope`
--

INSERT INTO `session_scope` (`session_id`, `scope_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `webhook`
--

CREATE TABLE `webhook` (
  `webhook_id` int(10) UNSIGNED NOT NULL,
  `webhook_title` varchar(255) DEFAULT NULL,
  `webhook_type` varchar(255) DEFAULT 'app',
  `webhook_detail` text,
  `webhook_event` varchar(255) DEFAULT NULL,
  `webhook_parameters` json DEFAULT NULL,
  `webhook_method` varchar(255) DEFAULT 'all',
  `webhook_action` varchar(255) DEFAULT NULL,
  `webhook_sample_response` text,
  `webhook_active` int(1) UNSIGNED DEFAULT '1',
  `webhook_created` datetime DEFAULT NULL,
  `webhook_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `webhook`
--

INSERT INTO `webhook` (`webhook_id`, `webhook_title`, `webhook_type`, `webhook_detail`, `webhook_event`, `webhook_parameters`, `webhook_method`, `webhook_action`, `webhook_sample_response`, `webhook_active`, `webhook_created`, `webhook_updated`) VALUES
(1, 'Profile Create', 'app', 'Calls when a profile is created in general', 'system-model-create', '{\"schema\": \"profile\"}', 'post', 'profile-create', '{\r\n    \"profile_id\": 1,\r\n    \"profile_name\": \"John Doe\"\r\n}', 1, '2019-01-25 05:51:10', '2019-01-25 05:51:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `app_title` (`app_title`),
  ADD KEY `app_domain` (`app_domain`),
  ADD KEY `app_website` (`app_website`),
  ADD KEY `app_token` (`app_token`),
  ADD KEY `app_secret` (`app_secret`),
  ADD KEY `app_active` (`app_active`),
  ADD KEY `app_created` (`app_created`),
  ADD KEY `app_updated` (`app_updated`);

--
-- Indexes for table `app_profile`
--
ALTER TABLE `app_profile`
  ADD PRIMARY KEY (`app_id`,`profile_id`);

--
-- Indexes for table `app_scope`
--
ALTER TABLE `app_scope`
  ADD PRIMARY KEY (`app_id`,`scope_id`);

--
-- Indexes for table `app_webhook`
--
ALTER TABLE `app_webhook`
  ADD PRIMARY KEY (`app_id`,`webhook_id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `article_title` (`article_title`),
  ADD KEY `article_status` (`article_status`),
  ADD KEY `article_published` (`article_published`),
  ADD KEY `article_active` (`article_active`),
  ADD KEY `article_created` (`article_created`),
  ADD KEY `article_updated` (`article_updated`);

--
-- Indexes for table `article_comment`
--
ALTER TABLE `article_comment`
  ADD PRIMARY KEY (`article_id`,`comment_id`);

--
-- Indexes for table `article_profile`
--
ALTER TABLE `article_profile`
  ADD PRIMARY KEY (`article_id`,`profile_id`);

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`auth_id`),
  ADD KEY `auth_slug` (`auth_slug`),
  ADD KEY `auth_password` (`auth_password`),
  ADD KEY `auth_type` (`auth_type`),
  ADD KEY `auth_active` (`auth_active`),
  ADD KEY `auth_created` (`auth_created`),
  ADD KEY `auth_updated` (`auth_updated`);

--
-- Indexes for table `auth_profile`
--
ALTER TABLE `auth_profile`
  ADD PRIMARY KEY (`auth_id`,`profile_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_active` (`comment_active`),
  ADD KEY `comment_created` (`comment_created`),
  ADD KEY `comment_updated` (`comment_updated`),
  ADD KEY `comment_rating` (`comment_rating`);

--
-- Indexes for table `comment_comment`
--
ALTER TABLE `comment_comment`
  ADD PRIMARY KEY (`comment_id_1`,`comment_id_2`);

--
-- Indexes for table `comment_profile`
--
ALTER TABLE `comment_profile`
  ADD PRIMARY KEY (`comment_id`,`profile_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `history_table_name` (`history_table_name`),
  ADD KEY `history_table_id` (`history_table_id`),
  ADD KEY `history_active` (`history_active`),
  ADD KEY `history_created` (`history_created`),
  ADD KEY `history_updated` (`history_updated`);

--
-- Indexes for table `history_profile`
--
ALTER TABLE `history_profile`
  ADD PRIMARY KEY (`history_id`,`profile_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `profile_name` (`profile_name`),
  ADD KEY `profile_active` (`profile_active`),
  ADD KEY `profile_created` (`profile_created`),
  ADD KEY `profile_updated` (`profile_updated`);

--
-- Indexes for table `rest`
--
ALTER TABLE `rest`
  ADD PRIMARY KEY (`rest_id`),
  ADD KEY `rest_title` (`rest_title`),
  ADD KEY `rest_type` (`rest_type`),
  ADD KEY `rest_method` (`rest_method`),
  ADD KEY `rest_path` (`rest_path`),
  ADD KEY `rest_event` (`rest_event`),
  ADD KEY `rest_active` (`rest_active`),
  ADD KEY `rest_created` (`rest_created`),
  ADD KEY `rest_updated` (`rest_updated`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `role_name` (`role_name`),
  ADD KEY `role_slug` (`role_slug`),
  ADD KEY `role_locked` (`role_locked`),
  ADD KEY `role_active` (`role_active`),
  ADD KEY `role_created` (`role_created`),
  ADD KEY `role_updated` (`role_updated`);

--
-- Indexes for table `scope`
--
ALTER TABLE `scope`
  ADD PRIMARY KEY (`scope_id`),
  ADD KEY `scope_name` (`scope_name`),
  ADD KEY `scope_slug` (`scope_slug`),
  ADD KEY `scope_type` (`scope_type`),
  ADD KEY `scope_special_approval` (`scope_special_approval`),
  ADD KEY `scope_active` (`scope_active`),
  ADD KEY `scope_created` (`scope_created`),
  ADD KEY `scope_updated` (`scope_updated`);

--
-- Indexes for table `scope_rest`
--
ALTER TABLE `scope_rest`
  ADD PRIMARY KEY (`scope_id`,`rest_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `session_token` (`session_token`),
  ADD KEY `session_secret` (`session_secret`),
  ADD KEY `session_status` (`session_status`),
  ADD KEY `session_active` (`session_active`),
  ADD KEY `session_created` (`session_created`),
  ADD KEY `session_updated` (`session_updated`);

--
-- Indexes for table `session_app`
--
ALTER TABLE `session_app`
  ADD PRIMARY KEY (`session_id`,`app_id`);

--
-- Indexes for table `session_profile`
--
ALTER TABLE `session_profile`
  ADD PRIMARY KEY (`session_id`,`profile_id`);

--
-- Indexes for table `session_scope`
--
ALTER TABLE `session_scope`
  ADD PRIMARY KEY (`session_id`,`scope_id`);

--
-- Indexes for table `webhook`
--
ALTER TABLE `webhook`
  ADD PRIMARY KEY (`webhook_id`),
  ADD KEY `webhook_title` (`webhook_title`),
  ADD KEY `webhook_type` (`webhook_type`),
  ADD KEY `webhook_event` (`webhook_event`),
  ADD KEY `webhook_method` (`webhook_method`),
  ADD KEY `webhook_action` (`webhook_action`),
  ADD KEY `webhook_active` (`webhook_active`),
  ADD KEY `webhook_created` (`webhook_created`),
  ADD KEY `webhook_updated` (`webhook_updated`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app`
--
ALTER TABLE `app`
  MODIFY `app_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `auth_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rest`
--
ALTER TABLE `rest`
  MODIFY `rest_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scope`
--
ALTER TABLE `scope`
  MODIFY `scope_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `session_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `webhook`
--
ALTER TABLE `webhook`
  MODIFY `webhook_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
