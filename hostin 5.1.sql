-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 29 2016 г., 14:23
-- Версия сервера: 5.5.47-0+deb7u1
-- Версия PHP: 5.4.45-0+deb7u2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `game`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authlog`
--

CREATE TABLE IF NOT EXISTS `authlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `ip` varchar(64) NOT NULL,
  `city` text NOT NULL,
  `country` text NOT NULL,
  `code` text NOT NULL,
  `datetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `game_id` int(10) NOT NULL AUTO_INCREMENT,
  `game_name` varchar(32) DEFAULT NULL,
  `game_code` varchar(8) DEFAULT NULL,
  `game_query` varchar(32) DEFAULT NULL,
  `image_url` text NOT NULL,
  `game_min_slots` int(8) DEFAULT NULL,
  `game_max_slots` int(8) DEFAULT NULL,
  `game_min_port` int(8) DEFAULT NULL,
  `game_max_port` int(8) DEFAULT NULL,
  `game_price` decimal(10,2) DEFAULT NULL,
  `game_status` int(1) DEFAULT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `games`
--

INSERT INTO `games` (`game_id`, `game_name`, `game_code`, `game_query`, `image_url`, `game_min_slots`, `game_max_slots`, `game_min_port`, `game_max_port`, `game_price`, `game_status`) VALUES
(1, 'SAMP 0.3.7', 'samp037', 'valve', 'http://f1304.hizliresim.com/18/4/lsltz.png', 10, 1000, 7777, 9999, 0.00, 1),
(2, 'SAMP 0.3z', 'sampz', 'valve', 'http://f1304.hizliresim.com/18/4/lsltz.png', 10, 500, 6666, 7776, 0.00, 1),
(3, 'SAMP 0.3x', 'sampx', 'valve', 'http://f1304.hizliresim.com/18/4/lsltz.png', 10, 500, 5555, 6665, 0.00, 1),
(4, 'SAMP 0.3e', 'sampe', 'valve', 'http://f1304.hizliresim.com/18/4/lsltz.png', 10, 500, 4444, 5554, 0.00, 1),
(5, 'CRMP 0.3e', 'crmp', 'valve', 'http://cs410129.userapi.com/v410129106/2571/yN0KS8tSmmI.jpg', 10, 5000, 2222, 3332, 0.00, 1),
(6, 'Minecraft', 'mine', 'mine', '', 10, 1000, 29000, 30000, 0.00, 1),
(7, 'Minecraft 1.6.4', 'mine64', 'mine', '', 10, 1000, 28000, 28999, 0.00, 1),
(8, 'Minecraft 1.7.2', 'mine72', 'mine', '', 10, 1000, 25565, 27000, 0.00, 1),
(9, 'MTA: SA', 'mtasa', 'samp', '', 10, 4000, 50000, 70000, 0.00, 1),
(10, 'Counter-Strike: 1.6', 'cs', 'valve', '', 1, 32, 27015, 30000, 0.00, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `invoice_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `invoice_ammount` decimal(10,2) DEFAULT NULL,
  `invoice_status` int(1) DEFAULT NULL,
  `invoice_date_add` datetime DEFAULT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(10) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(32) DEFAULT NULL,
  `location_ip` varchar(15) DEFAULT NULL,
  `location_ip2` varchar(15) DEFAULT NULL,
  `location_user` varchar(32) DEFAULT NULL,
  `location_password` varchar(32) DEFAULT NULL,
  `location_status` int(1) DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `location_ip`, `location_ip2`, `location_user`, `location_password`, `location_status`) VALUES
(1, 'Москва', '109.234.37.23', '109.234.37.23', 'root', 'vBw7y7XgRho7', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT '0',
  `news_title` varchar(32) DEFAULT NULL,
  `news_text` text,
  `news_date_add` datetime DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `podtver`
--

CREATE TABLE IF NOT EXISTS `podtver` (
  `code` int(5) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `promo`
--

CREATE TABLE IF NOT EXISTS `promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod` varchar(64) NOT NULL,
  `replace` int(11) NOT NULL,
  `used` int(11) NOT NULL,
  `skidka` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `servers`
--

CREATE TABLE IF NOT EXISTS `servers` (
  `server_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `game_id` int(10) DEFAULT NULL,
  `location_id` int(10) DEFAULT NULL,
  `database` int(11) NOT NULL,
  `server_slots` int(8) DEFAULT NULL,
  `server_port` int(8) DEFAULT NULL,
  `server_password` varchar(32) DEFAULT NULL,
  `server_status` int(1) DEFAULT NULL,
  `server_cpu_load` float NOT NULL DEFAULT '0',
  `server_ram_load` float NOT NULL DEFAULT '0',
  `server_date_reg` datetime DEFAULT NULL,
  `server_date_end` datetime DEFAULT NULL,
  `version` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`server_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `servers`
--

INSERT INTO `servers` (`server_id`, `user_id`, `game_id`, `location_id`, `database`, `server_slots`, `server_port`, `server_password`, `server_status`, `server_cpu_load`, `server_ram_load`, `server_date_reg`, `server_date_end`, `version`) VALUES
(1, 1, 1, 1, 1, 1000, 7777, 'samir1997', 2, 0, 0, '2016-02-29 14:08:17', '2017-02-28 14:08:17', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `servers_stats`
--

CREATE TABLE IF NOT EXISTS `servers_stats` (
  `server_id` int(11) DEFAULT NULL,
  `server_stats_date` datetime DEFAULT NULL,
  `server_stats_players` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `ticket_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `ticket_name` varchar(32) DEFAULT NULL,
  `ticket_status` int(1) DEFAULT NULL,
  `ticket_date_add` datetime DEFAULT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tickets_messages`
--

CREATE TABLE IF NOT EXISTS `tickets_messages` (
  `ticket_message_id` int(10) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `ticket_message` text,
  `ticket_message_date_add` datetime DEFAULT NULL,
  PRIMARY KEY (`ticket_message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(96) DEFAULT NULL,
  `user_password` varchar(32) DEFAULT NULL,
  `user_firstname` varchar(32) DEFAULT NULL,
  `user_lastname` varchar(32) DEFAULT NULL,
  `user_status` int(1) DEFAULT NULL,
  `user_balance` decimal(10,2) DEFAULT NULL,
  `user_restore_key` varchar(32) DEFAULT NULL,
  `user_access_level` int(1) DEFAULT NULL,
  `user_date_reg` datetime DEFAULT NULL,
  `user_img` varchar(100) NOT NULL DEFAULT '/application/public/img/user.png',
  `test_server` int(11) NOT NULL DEFAULT '0',
  `realpass` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_firstname`, `user_lastname`, `user_status`, `user_balance`, `user_restore_key`, `user_access_level`, `user_date_reg`, `user_img`, `test_server`, `realpass`) VALUES
(1, 'hosting-rus@mail.ru', 'samir1995', 'Хостинг', 'Рус', 1, 0.00, NULL, 3, '2016-02-29 14:04:03', '/application/public/img/user.png', 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `webhost`
--

CREATE TABLE IF NOT EXISTS `webhost` (
  `web_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `tarif_id` int(10) DEFAULT NULL,
  `location_id` int(10) DEFAULT NULL,
  `web_date_reg` datetime DEFAULT NULL,
  `web_date_end` datetime DEFAULT NULL,
  PRIMARY KEY (`web_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
