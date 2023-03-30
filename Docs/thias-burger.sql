-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 30, 2023 alle 08:28
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thias-burger`
--
CREATE DATABASE IF NOT EXISTS `thias-burger` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `thias-burger`;

-- --------------------------------------------------------

--
-- Struttura della tabella `ingrediente`
--

DROP TABLE IF EXISTS `ingrediente`;
CREATE TABLE IF NOT EXISTS `ingrediente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prezzo` float NOT NULL,
  `immagine` varchar(200) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `categoria` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ingrediente`
--

INSERT INTO `ingrediente` (`id`, `prezzo`, `immagine`, `nome`, `categoria`) VALUES
(1, 0.5, 'https://cdn-icons-png.flaticon.com/512/6775/6775833.png', 'pane_bianco', 'pane'),
(2, 0.75, 'https://cdn-icons-png.flaticon.com/512/3014/3014502.png', 'pane_integrale', 'pane'),
(3, 1.25, 'https://cdn-icons-png.flaticon.com/512/1202/1202125.png', 'pomodoro', 'verdure'),
(4, 1.27, 'https://cdn-icons-png.flaticon.com/512/135/135715.png', 'lattuga', 'verdure'),
(5, 2, 'https://cdn-icons-png.flaticon.com/512/2403/2403359.png', 'hamburger_classico', 'carne'),
(6, 1.9, 'https://cdn-icons-png.flaticon.com/512/8584/8584834.png', 'cheddar', 'formaggio'),
(7, 2.3, 'https://cdn-icons-png.flaticon.com/512/1582/1582138.png', 'pancetta', 'carne'),
(8, 0.25, 'https://cdn-icons-png.flaticon.com/512/877/877722.png', 'Ketchup', 'salse');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

DROP TABLE IF EXISTS `ordine`;
CREATE TABLE IF NOT EXISTS `ordine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utente` int(11) NOT NULL,
  `pagato` tinyint(1) NOT NULL,
  `consegnato` tinyint(1) NOT NULL,
  `prezzo` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `panino`
--

DROP TABLE IF EXISTS `panino`;
CREATE TABLE IF NOT EXISTS `panino` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ordine` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `pronto` tinyint(1) NOT NULL,
  `prezzo` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `preparazione`
--

DROP TABLE IF EXISTS `preparazione`;
CREATE TABLE IF NOT EXISTS `preparazione` (
  `id_panino` int(11) NOT NULL,
  `id_ingrediente` int(11) NOT NULL,
  `id_ordine` int(11) NOT NULL,
  `quantità` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

DROP TABLE IF EXISTS `utente`;
CREATE TABLE IF NOT EXISTS `utente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `saldo` double NOT NULL,
  `avatar` varchar(800) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `nome`, `password`, `saldo`, `avatar`) VALUES
(4, 'Prova', '1234', 0, 'https://cdn-icons-png.flaticon.com/512/236/236832.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
