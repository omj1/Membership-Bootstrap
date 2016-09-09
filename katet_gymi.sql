-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 18 Lut 2015, 16:33
-- Wersja serwera: 5.1.65rel14.0-log
-- Wersja PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `katet_gymi`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `privilages` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`, `privilages`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', ''),
(2, 'krzysiek', 'ac4f352566d26649578fb9202213e9e6cf800c73', ''),
(3, 'ulka', '782d09f433ac64d0412d471dd630a37ab19ff1e9', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` tinytext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` tinytext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` tinytext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lastname` tinytext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` tinytext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `phone` tinytext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `addedby` tinytext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `dayofadd` date NOT NULL,
  `modifyby` tinytext NOT NULL,
  `modifydate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Zrzut danych tabeli `members`
--

INSERT INTO `members` (`id`, `login`, `password`, `name`, `lastname`, `email`, `phone`, `addedby`, `dayofadd`, `modifyby`, `modifydate`) VALUES
(1, 'Adam', 'Kowalski', 'Marek ', 'Nowak', 'email@email.pl', '504266241', '', '0000-00-00', '', '0000-00-00'),
(2, 'Jan', 'Nowak', 'Tomek', 'Kowalski', 'email@email.com', '504266241', '', '0000-00-00', '', '0000-00-00'),
(15, 'Piotr', 'Piotras', 'Andrzej', 'Kamiński', 'email@domena.pl', '504266241', '', '0000-00-00', '', '0000-00-00'),
(16, 'Paweł', 'Pawlikowski', 'Paweł', 'Pawlikowski', 'omj@test2.pl', '504266241', '', '0000-00-00', '', '0000-00-00'),
(32, 'login', 'pass', 'Robert', 'Gawliński', 'email@jakis.pl', '504266241', '', '2013-10-23', '', '0000-00-00'),
(33, 'login', 'pass', 'Mariusz', 'Pędzikowski', 'email@email.com', '504266241', '', '2013-10-23', '', '0000-00-00'),
(34, 'login', 'pass', 'Mariusz1', 'Ostrowski1', 'email@email.com', '5042662411', '', '2013-10-23', 'admin', '2013-11-07'),
(39, 'login', 'pass', 'Jan', 'Kowalski', 'email@email.com', '504266241', '', '2013-11-06', '', '0000-00-00'),
(40, 'login', 'pass', 'Tomek', 'Paker', 'email@email.com', '504266241', '', '2013-11-06', '', '0000-00-00'),
(41, 'login', 'pass', 'adm', 'dsad', 'email@email.com', '504266241', 'admin', '2013-11-07', '', '0000-00-00'),
(42, 'login', 'pass', 'Andrzej', 'Biceps', 'email@email.com', '504266241', 'admin', '2013-11-14', '', '0000-00-00'),
(43, 'login', 'pass', 'Agnieszka', 'Wąska', 'email@email.com', '504266241', 'admin', '2013-11-14', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `begin_date` date NOT NULL,
  `finish_date` date NOT NULL,
  `price` int(11) NOT NULL,
  `moderator` tinytext COLLATE utf8_bin NOT NULL,
  `modifydate` date NOT NULL,
  `addedby` tinytext COLLATE utf8_bin NOT NULL,
  `dayofadd` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=44 ;

--
-- Zrzut danych tabeli `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `begin_date`, `finish_date`, `price`, `moderator`, `modifydate`, `addedby`, `dayofadd`) VALUES
(1, 1, '2013-09-03', '2013-10-03', 100, '', '0000-00-00', '', '0000-00-00'),
(2, 2, '2013-09-01', '2013-10-01', 80, '', '0000-00-00', '', '0000-00-00'),
(23, 15, '2013-10-15', '2013-11-08', 100, 'admin', '2013-11-07', '', '0000-00-00'),
(26, 16, '2013-10-16', '2093-11-16', 80, 'admin', '2013-11-14', '', '0000-00-00'),
(27, 2, '2013-09-21', '2013-10-21', 80, '', '0000-00-00', '', '0000-00-00'),
(28, 16, '2013-10-17', '2013-10-22', 80, '', '2013-10-22', '', '0000-00-00'),
(29, 16, '2013-10-01', '2013-11-01', 80, '', '0000-00-00', '', '0000-00-00'),
(30, 23, '2013-10-17', '2013-10-22', 100, '', '2013-10-22', 'admin', '2013-10-17'),
(31, 16, '2013-11-17', '2051-12-17', 90, 'admin', '2013-11-14', '', '0000-00-00'),
(32, 24, '2013-10-23', '2013-11-23', 100, '', '0000-00-00', '', '2013-10-23'),
(33, 24, '2013-10-23', '2013-11-23', 100, '', '0000-00-00', '', '2013-10-23'),
(34, 24, '2013-10-23', '2013-11-23', 100, '', '0000-00-00', '', '2013-10-23'),
(36, 38, '2013-11-06', '2013-12-06', 100, '', '0000-00-00', '', '2013-11-06'),
(37, 39, '2013-11-06', '2063-12-06', 100, 'admin', '2013-11-14', '', '2013-11-06'),
(38, 40, '2013-11-06', '2057-12-31', 100, 'admin', '2013-11-14', '', '2013-11-06'),
(39, 0, '2013-11-07', '2013-12-07', 100, '', '0000-00-00', 'admin', '2013-11-07'),
(40, 0, '2013-11-07', '2013-12-07', 100, '', '0000-00-00', 'admin', '2013-11-07'),
(42, 42, '2013-11-14', '2045-12-14', 170, '', '0000-00-00', 'admin', '2013-11-14'),
(43, 43, '2013-11-14', '2093-12-14', 200, '', '0000-00-00', 'admin', '2013-11-14');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
