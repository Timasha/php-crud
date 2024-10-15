-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 02 2024 г., 12:17
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Battery_Tables`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Batteries`
--

CREATE TABLE `Batteries` (
  `battery_id` int NOT NULL,
  `manufacturer_id` int DEFAULT NULL,
  `battery_type_id` int DEFAULT NULL,
  `model` varchar(100) NOT NULL,
  `release_year` year DEFAULT NULL,
  `capacity_mAh` int DEFAULT NULL,
  `voltage` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Batteries`
--

INSERT INTO `Batteries` (`battery_id`, `manufacturer_id`, `battery_type_id`, `model`, `release_year`, `capacity_mAh`, `voltage`) VALUES
(1, 1, 1, 'fgdfgfdgdgdfgfd', 2024, 100000, '24.00');

-- --------------------------------------------------------

--
-- Структура таблицы `BatteryModels`
--

CREATE TABLE `BatteryModels` (
  `model_id` int NOT NULL,
  `battery_id` int DEFAULT NULL,
  `model_name` varchar(100) NOT NULL,
  `production_start` date DEFAULT NULL,
  `production_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `BatteryModels`
--

INSERT INTO `BatteryModels` (`model_id`, `battery_id`, `model_name`, `production_start`, `production_end`) VALUES
(1, 1, 'fyhgfhgfv', '2024-09-01', '2024-10-04'),
(2, 1, 'ппкуукп', '2024-09-25', '2024-09-25'),
(5, 1, 'dgsfgdfgdfg', '2024-09-30', '2024-09-01');

-- --------------------------------------------------------

--
-- Структура таблицы `BatteryTypes`
--

CREATE TABLE `BatteryTypes` (
  `battery_type_id` int NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `BatteryTypes`
--

INSERT INTO `BatteryTypes` (`battery_type_id`, `type_name`, `description`) VALUES
(1, 'Li-Ion', 'sghkjnghkrbkbrk');

-- --------------------------------------------------------

--
-- Структура таблицы `Manufacturers`
--

CREATE TABLE `Manufacturers` (
  `manufacturer_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Manufacturers`
--

INSERT INTO `Manufacturers` (`manufacturer_id`, `name`, `country`) VALUES
(1, 'uber10000', 'USA');

-- --------------------------------------------------------

--
-- Структура таблицы `Specifications`
--

CREATE TABLE `Specifications` (
  `specification_id` int NOT NULL,
  `battery_id` int DEFAULT NULL,
  `weight_grams` decimal(10,2) DEFAULT NULL,
  `dimensions` varchar(100) DEFAULT NULL,
  `operating_temperature_min` decimal(5,2) DEFAULT NULL,
  `operating_temperature_max` decimal(5,2) DEFAULT NULL,
  `cycle_life` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Specifications`
--

INSERT INTO `Specifications` (`specification_id`, `battery_id`, `weight_grams`, `dimensions`, `operating_temperature_min`, `operating_temperature_max`, `cycle_life`) VALUES
(1, 1, '50.00', '100', '-20.00', '100.00', 1000);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` char(255) NOT NULL,
  `salt_password` char(255) NOT NULL,
  `acces_lvl` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `salt_password`, `acces_lvl`) VALUES
(1, 'divaniyvoin1337@gmail.com', '$2y$10$jpi93eCYYhP87NhcNTJF2eZiRynP2ubuSqALMKD2Y8iT9FpzTFsbu', 0),
(2, 'divaniyvoin1337@gmail.com', '$2y$10$HD0SNn/O5mFJOw361YUFzet1Vfm3WZ5WygNAXJ2cjlpW50BxEPGjC', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Batteries`
--
ALTER TABLE `Batteries`
  ADD PRIMARY KEY (`battery_id`),
  ADD KEY `manufacturer_id` (`manufacturer_id`),
  ADD KEY `battery_type_id` (`battery_type_id`);

--
-- Индексы таблицы `BatteryModels`
--
ALTER TABLE `BatteryModels`
  ADD PRIMARY KEY (`model_id`),
  ADD KEY `battery_id` (`battery_id`);

--
-- Индексы таблицы `BatteryTypes`
--
ALTER TABLE `BatteryTypes`
  ADD PRIMARY KEY (`battery_type_id`);

--
-- Индексы таблицы `Manufacturers`
--
ALTER TABLE `Manufacturers`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Индексы таблицы `Specifications`
--
ALTER TABLE `Specifications`
  ADD PRIMARY KEY (`specification_id`),
  ADD KEY `battery_id` (`battery_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Batteries`
--
ALTER TABLE `Batteries`
  MODIFY `battery_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `BatteryModels`
--
ALTER TABLE `BatteryModels`
  MODIFY `model_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `BatteryTypes`
--
ALTER TABLE `BatteryTypes`
  MODIFY `battery_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `Manufacturers`
--
ALTER TABLE `Manufacturers`
  MODIFY `manufacturer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `Specifications`
--
ALTER TABLE `Specifications`
  MODIFY `specification_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Batteries`
--
ALTER TABLE `Batteries`
  ADD CONSTRAINT `batteries_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `Manufacturers` (`manufacturer_id`),
  ADD CONSTRAINT `batteries_ibfk_2` FOREIGN KEY (`battery_type_id`) REFERENCES `BatteryTypes` (`battery_type_id`);

--
-- Ограничения внешнего ключа таблицы `BatteryModels`
--
ALTER TABLE `BatteryModels`
  ADD CONSTRAINT `batterymodels_ibfk_1` FOREIGN KEY (`battery_id`) REFERENCES `Batteries` (`battery_id`);

--
-- Ограничения внешнего ключа таблицы `Specifications`
--
ALTER TABLE `Specifications`
  ADD CONSTRAINT `specifications_ibfk_1` FOREIGN KEY (`battery_id`) REFERENCES `Batteries` (`battery_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
