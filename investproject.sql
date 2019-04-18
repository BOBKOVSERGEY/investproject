-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 18 2019 г., 09:42
-- Версия сервера: 5.7.23
-- Версия PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `investproject`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(60) NOT NULL,
  `login` varchar(60) NOT NULL,
  `wallet` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ref` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `login`, `wallet`, `password`, `ref`, `token`, `status`) VALUES
(1, 'sergey_bobkov@inbox.ru', 'sergeybobkov', '9266668737', '$2y$10$paz426g1mwaWYTJpAiycYerdG8R8LJJGMhzkjqPkCNegggFvHKEfe', 0, '', 1),
(2, 'esdicompany@yandex.ru', 'esdicompany', 'U84956643815', '$2y$10$JUYJ7At0LV/i0YRlkJfaIuhBsX47tqlBATHA/BR16MbkBmTkGQpPG', 0, '3x75gvb9gjkt8v8wfixcj8j02ibai3', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tariffs`
--

CREATE TABLE `tariffs` (
  `id` int(11) UNSIGNED NOT NULL,
  `uid` int(11) NOT NULL,
  `sumin` float NOT NULL,
  `sumout` float NOT NULL,
  `percent` float NOT NULL,
  `unixTimeStart` int(11) NOT NULL,
  `unixTimeFinish` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tariffs`
--
ALTER TABLE `tariffs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `tariffs`
--
ALTER TABLE `tariffs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
