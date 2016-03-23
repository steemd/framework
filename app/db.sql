-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 23 2016 г., 19:11
-- Версия сервера: 5.5.25
-- Версия PHP: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `education`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `name`, `date`) VALUES
(1, 'The Road to Monolog 2.0', '<p>Monolog''s first commit was on February 17th, 2011. That is almost 5 years ago! I have now been thinking for quite a while that it would be nice to start on a v2, and being able to drop some baggage.</p><p>\r\n\r\nOne of the main questions when doing a major release is which minimum PHP version to support going forward. Last summer I decided I wanted to do a big jump from 5.3 and directly target PHP 7. It provides a lot of nice features as well as performance improvements, and as Monolog is one of the most installed packages on Packagist I wanted to help nudge everyone towards PHP 7.</p>', 'steemd', '2016-03-08 00:00:00'),
(2, 'New Composer Patterns', '<p>Here is a short update on some nice little features that have become available in the last year in Composer.\r\n\r\n</p><p>Checking dependencies for bad patterns\r\n\r\n</p><p>You may know about the composer validate command, but did you know about its new --with-dependencies / -A flag? It lets you validate both your project and all your dependencies at once!</p>\r\n', 'steemd', '2016-03-09 00:00:00'),
(3, 'PHP Versions Stats - 2015 Edition', '<p>It''s that time of the year again, where I figure it''s time to update my yearly data on PHP version usage. Last year''s post showed 5.5 as the main winner and 5.3 declining rapidly. Let''s see what 2015 brought.</p><p>\r\n\r\nA quick note on methodology, because all these stats are imperfect as they just sample some subset of the PHP user base. I look in the packagist.org logs of the last 28 days for GET /packages.json which represents a composer update done by someone. Composer sends the PHP version it is running with in its User-Agent header, so I can use that to see which PHP versions people are using Composer with. Of course this data set is probably biased towards development machines and CI servers and as such it should also be taken with a grain of salt.</p>', 'steemd', '2016-03-10 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` char(100) NOT NULL,
  `password` char(250) NOT NULL,
  `role` char(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`) VALUES
(1, 'dima@mail.com', '123', 'ROLE_USER');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
