-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 06, 2023 alle 15:15
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

-- --------------------------------------------------------

--
-- Struttura della tabella `ingrediente`
--

CREATE TABLE `ingrediente` (
  `id` int(11) NOT NULL,
  `prezzo` float NOT NULL,
  `immagine` varchar(200) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `categoria` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `ordine` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `pagato` tinyint(1) NOT NULL,
  `consegnato` tinyint(1) NOT NULL,
  `prezzo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`id`, `id_utente`, `pagato`, `consegnato`, `prezzo`) VALUES
(1, 5, 0, 0, 22),
(2, 5, 0, 0, 12),
(3, 4, 0, 0, 25),
(4, 5, 1, 0, 44.3),
(5, 5, 0, 1, 65.53),
(6, 5, 1, 1, 77.7);

-- --------------------------------------------------------

--
-- Struttura della tabella `panino`
--

CREATE TABLE `panino` (
  `id` int(11) NOT NULL,
  `id_ordine` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `pronto` tinyint(1) NOT NULL,
  `prezzo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `panino`
--

INSERT INTO `panino` (`id`, `id_ordine`, `nome`, `pronto`, `prezzo`) VALUES
(1, 1, 'Panino1', 0, 5),
(2, 1, 'Panino2', 1, 17),
(3, 2, 'Panino3', 0, 12),
(4, 4, 'Panino4', 0, 44.3),
(5, 5, 'Panino5', 1, 65.53),
(6, 6, 'Panino6', 1, 70),
(7, 6, 'Panino7', 1, 7.7);

-- --------------------------------------------------------

--
-- Struttura della tabella `preparazione`
--

CREATE TABLE `preparazione` (
  `id_panino` int(11) NOT NULL,
  `id_ingrediente` int(11) NOT NULL,
  `id_ordine` int(11) NOT NULL,
  `quantità` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `preparazione`
--

INSERT INTO `preparazione` (`id_panino`, `id_ingrediente`, `id_ordine`, `quantità`) VALUES
(1, 3, 1, 2),
(1, 4, 1, 3),
(2, 6, 1, 12),
(2, 8, 1, 1),
(3, 1, 2, 2),
(4, 2, 4, 1),
(4, 6, 4, 3),
(5, 5, 5, 5),
(6, 6, 6, 6),
(7, 1, 6, 1),
(7, 4, 6, 1),
(7, 5, 6, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `saldo` double NOT NULL,
  `avatar` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `nome`, `password`, `saldo`, `avatar`) VALUES
(4, 'Prova', '1234', 0, 'https://cdn-icons-png.flaticon.com/512/236/236832.png'),
(5, 'Eros', '1234', 10000, 'https://e7.pngegg.com/pngimages/246/554\n        /png-clipart-computer-icons-user-avatar-avatar-heroes-black-thumbnail.png');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `panino`
--
ALTER TABLE `panino`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `panino`
--
ALTER TABLE `panino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
