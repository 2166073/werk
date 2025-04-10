-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 10 apr 2025 om 12:04
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drivesmart`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verwijderd_les`
--

CREATE TABLE `verwijderd_les` (
  `verwijderd_id` int(11) NOT NULL,
  `les_id` int(11) DEFAULT NULL,
  `reden` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `verwijderd_les`
--

INSERT INTO `verwijderd_les` (`verwijderd_id`, `les_id`, `reden`) VALUES
(1, 8, 'jjjj'),
(2, 9, 'gwn'),
(3, 10, '9999'),
(4, 11, 'gwn'),
(5, 12, 'gh'),
(6, 13, 'gwn');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `verwijderd_les`
--
ALTER TABLE `verwijderd_les`
  ADD PRIMARY KEY (`verwijderd_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `verwijderd_les`
--
ALTER TABLE `verwijderd_les`
  MODIFY `verwijderd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
