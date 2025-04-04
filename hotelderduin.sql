-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3308
-- Gegenereerd op: 28 mrt 2025 om 09:19
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelderduin`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `boeking`
--

CREATE TABLE `boeking` (
  `ID` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `achternaam` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefoonnummer` int(11) NOT NULL,
  `aankomst` date NOT NULL,
  `vertrek` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `boeking`
--

INSERT INTO `boeking` (`ID`, `naam`, `achternaam`, `email`, `telefoonnummer`, `aankomst`, `vertrek`) VALUES
(1, 'safa', 'abattouy', 'marwa380@hotmail.com', 549302232, '2025-03-21', '2025-03-22'),
(2, 'safa', 'abattouy', 'marwa380@hotmail.com', 549302232, '2025-03-21', '2025-03-22'),
(3, 'pieter', 'vries', 'pieterdevries@hotmail.com', 6394024, '2025-03-23', '2025-03-23'),
(4, 'jesica', 'hallo', 'jesicahallo@hotmail.com', 549302232, '2025-03-22', '2025-03-23');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `login`
--

CREATE TABLE `login` (
  `inlogID` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `login`
--

INSERT INTO `login` (`inlogID`, `username`, `password`) VALUES
(1, 'Safae', '$2y$10$wlbGxR6XrjT.nQJM6d'),
(7, 'safae', '$2y$10$yjWIAXOnBuzzEbCa9Y'),
(8, 'safa', '$2y$10$WLw/EsDVq0dnYF8EP8');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `boeking`
--
ALTER TABLE `boeking`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`inlogID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `boeking`
--
ALTER TABLE `boeking`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `login`
--
ALTER TABLE `login`
  MODIFY `inlogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
