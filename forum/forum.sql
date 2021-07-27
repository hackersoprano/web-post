-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 27 2021 г., 17:25
-- Версия сервера: 8.0.19
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `forum`
--

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `ID` int NOT NULL,
  `user_ID` int NOT NULL,
  `topic_ID` int NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`ID`, `user_ID`, `topic_ID`, `message`, `date`) VALUES
(1, 1, 1, 'Привет', '2021-07-27 14:17:59'),
(2, 1, 1, 'В чем помочь???', '2021-07-27 15:31:02'),
(3, 5, 1, '???', '2021-07-27 15:32:05'),
(5, 13, 2, 'Сходи в караоке!!!', '2021-07-27 15:47:11');

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE `topics` (
  `ID` int NOT NULL,
  `user_ID` int NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Открытая',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`ID`, `user_ID`, `title`, `description`, `status`, `date`) VALUES
(1, 1, 'Помогите css', 'Помогите css', 'Открытая', '2021-07-26 23:26:06'),
(2, 5, 'Пение', 'Помогите пожалуйста, как научиться петь?', 'Открытая', '2021-07-27 15:33:49'),
(3, 13, 'Проверка 1', 'Проверка 1', 'Открытая', '2021-07-27 16:55:50'),
(4, 13, 'Проверка 2', 'Проверка 2', 'Открытая', '2021-07-27 17:04:17'),
(5, 13, 'проверка 3', 'проверка 3', 'Открытая', '2021-07-27 17:15:48'),
(6, 13, 'проверка 4', 'проверка 4', 'Открытая', '2021-07-27 17:15:54'),
(7, 13, 'проверка 5', 'проверка 5', 'Открытая', '2021-07-27 17:16:01'),
(8, 13, 'проверка 6', 'проверка 6', 'Открытая', '2021-07-27 17:16:09'),
(9, 13, 'проверка 7', 'проверка 7', 'Открытая', '2021-07-27 17:16:16'),
(10, 13, 'проверка 8', 'проверка 8', 'Открытая', '2021-07-27 17:16:22'),
(11, 13, 'проверка 9', 'проверка 9', 'Открытая', '2021-07-27 17:16:38');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `ID` int NOT NULL,
  `FIO` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Role` int NOT NULL DEFAULT '2',
  `dateregistr` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `FIO`, `Login`, `Email`, `Password`, `Role`, `dateregistr`) VALUES
(1, 'Берсенев Никита Сергеевич', 'admin', ' ', '$2y$10$4tEJD1yLutu.PlUn/v/cPuNqmbA70zcc9kTDHR4wusS/3WQpA5l/S', 3, '2021-07-26'),
(5, 'user1', 'user1', ' n.bersenyovn@gmail.com', '$2y$10$aVcp1BZ6wxdqaZ7DwGR5vuqv/VhVbrdFWTzP1GmhbC8u4b3ktLprG', 2, '2021-07-26'),
(12, 'user2', 'user2', ' user2@gmail.com', '$2y$10$XNQETxBWSemGJBt2ClK/deKJiaPPIih6wBuJ4IGKBeb2o1mxtyHLy', 2, '2021-07-26'),
(13, 'user4', 'user4', ' user4@gmail.com', '$2y$10$pNJEmCZjWnzt.8o1RNFCwujuAP8lsB2V/eNVU3bCWdX/Q0CqbbMTK', 2, '2021-07-26');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `topic_ID` (`topic_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`topic_ID`) REFERENCES `topics` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
