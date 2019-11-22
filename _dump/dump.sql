-- Adminer 4.3.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `date_hired` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `employees` (`id`, `name`, `email`, `position`, `phone`, `salary`, `date_hired`, `created`, `updated`) VALUES
(9,	'Henrique Orlandin',	'henrique.orlandin@gmail.com',	'Developer',	'(236) 833-6803',	2000.00,	'2019-11-15 08:00:00',	'2019-11-22 00:11:20',	'2019-11-22 14:07:22'),
(11,	'Henrique Orlandin',	'henrique.orlandin@gmail.com',	'Developer',	'54999642632',	2000.00,	'2019-11-27 08:00:00',	'2019-11-22 00:49:40',	'2019-11-22 13:34:46'),
(12,	'Henrique Orlandin',	'henrique.orlandin@gmail.com',	'Developer',	'54999642632',	423424.00,	'2019-11-27 08:00:00',	'2019-11-22 02:09:23',	'0000-00-00 00:00:00'),
(14,	'Henrique Orlandin',	'henrique.orlandin@gmail.com',	'Developer',	'54999642632',	235252.00,	'2019-11-18 08:00:00',	'2019-11-22 04:21:22',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT 0,
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('116bc37fa7e9c43c3ce88a3a653ba443',	'::1',	'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.3',	1574400867,	'');

-- 2019-11-22 05:35:38
