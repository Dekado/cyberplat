-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 17 2016 г., 14:33
-- Версия сервера: 5.5.35-1ubuntu1
-- Версия PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cyberplat`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL DEFAULT '1',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `alias` varchar(400) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `status`, `parent_id`, `name`, `alias`, `created`) VALUES
(1, 1, 0, 'Категория 1', 'kategoriya-1', 1460878833),
(2, 1, 0, 'Категория 2', 'kategoriya-2', 1460881201),
(3, 1, 0, 'Категория 3', 'kategoriya-3', 1460881212),
(4, 1, 0, 'Категория 4', 'kategoriya-4', 1460881221),
(5, 1, 0, 'Категория 5', 'kategoriya-5', 1460881230),
(6, 1, 1, 'Категория 1.1', 'kategoriya-11', 1460881348),
(7, 1, 1, 'Категория 1.2', 'kategoriya-12', 1460881372),
(8, 1, 1, 'Категория 1.3', 'kategoriya-13', 1460881393),
(9, 1, 2, 'Категория 2.1', 'kategoriya-21', 1460881409),
(10, 1, 2, 'Категория 2.2', 'kategoriya-22', 1460881433),
(11, 1, 3, 'Категория 3.1', 'kategoriya-31', 1460881465),
(12, 1, 5, 'Категория 5.1', 'kategoriya-51', 1460881483),
(13, 1, 6, 'Категория 1.1.1', 'kategoriya-111', 1460881502),
(14, 1, 11, 'Категория 3.1.1', 'kategoriya-311', 1460881528),
(15, 1, 2, 'Категория 2.3', 'kategoriya-23', 1460888704);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL DEFAULT '1',
  `name` varchar(255) NOT NULL,
  `alias` varchar(300) NOT NULL,
  `category` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `status`, `name`, `alias`, `category`, `created`) VALUES
(1, 1, 'Товар 1', 'tovar-1', 14, 1460885832),
(2, 1, 'Товар 2', 'tovar-2', 13, 1460885917),
(3, 1, 'Товар 3', 'tovar-3', 13, 1460887974),
(4, 1, 'Товар 4', 'tovar-4', 0, 1460887990),
(5, 1, 'Товар 5', 'tovar-5', 12, 1460888036),
(6, 1, 'Товар 6', 'tovar-6', 4, 1460888050);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
