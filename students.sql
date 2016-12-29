-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 29 2016 г., 18:21
-- Версия сервера: 5.5.50
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `students`
--

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `second_name` text NOT NULL,
  `gender` enum('Мужской','Женский') NOT NULL,
  `group_number` text NOT NULL,
  `birth_year` int(5) NOT NULL,
  `summary` int(5) NOT NULL,
  `email` varchar(20) NOT NULL,
  `local` enum('Да','Нет') NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `name`, `second_name`, `gender`, `group_number`, `birth_year`, `summary`, `email`, `local`, `password`) VALUES
(1, 'Иерондий', 'Пархатий', 'Мужской', '156', 1992, 55, 'ieron@ii.t', 'Да', 'cf638062'),
(2, 'Пахом', 'Пахоменко', 'Мужской', '123', 1937, 1, 'asd@sad.cd', 'Да', '8e95d537'),
(3, 'Наталья', 'Иванова', 'Женский', '555', 1999, 2, 'nnn@nnn.nn', 'Нет', '44176a5c'),
(4, 'Пахом', 'Поехавший', 'Мужской', '1', 1999, 22, 'massn@ukr.', 'Да', 'e0ae56ee'),
(5, 'Созонтий', 'Парахом', 'Мужской', '1б', 1937, 5, 'onslaut@ma', 'Да', '04eb3acf'),
(6, 'Филатий', 'Кузьменко', 'Мужской', '5', 1986, 66, 'fff@ff.ff', 'Нет', '4e5fc6gw'),
(7, 'Владимир', 'Горячевский', 'Мужской', '111', 1992, 1, 'sss@ss.ss', 'Да', '$1$gX1.p'),
(8, 'Василий', 'Сигизмунд', 'Мужской', '5', 1988, 5, 'vv@vv.qw', 'Да', '$1$xr0.m'),
(9, 'Созонт', 'Пхпович', 'Мужской', '1', 2222, 55, 'asw@qwe.se', 'Да', '$1$014.H'),
(10, 'Няша', 'Стесняша', 'Женский', '66', 2017, 5, 'nya@nya.nya', 'Да', '9exhsdx7');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
