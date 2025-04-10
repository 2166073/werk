-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 07 apr 2025 om 16:16
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

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
-- Tabelstructuur voor tabel `auto`
--

CREATE TABLE `auto` (
  `auto_id` int(11) NOT NULL,
  `kenteken` varchar(20) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `instructeur_id` int(11) DEFAULT NULL,
  `onderhoud` tinyint(1) DEFAULT 0,
  `mankement` text DEFAULT NULL,
  `km_stand_einde_dag` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `eigenaar`
--

CREATE TABLE `eigenaar` (
  `eigenaar_id` int(11) NOT NULL,
  `gebruiker_id` int(11) DEFAULT NULL,
  `bedrijfsnaam` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker`
--

CREATE TABLE `gebruiker` (
  `gebruiker_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `wachtwoord` varchar(255) DEFAULT NULL,
  `rol` enum('leerling','instructeur','eigenaar') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `instructeur`
--

CREATE TABLE `instructeur` (
  `instructeur_id` int(11) NOT NULL,
  `gebruiker_id` int(11) DEFAULT NULL,
  `beschikbaarheid` text DEFAULT NULL,
  `naam` varchar(255) DEFAULT NULL,
  `telefoonnummer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leerling`
--

CREATE TABLE `leerling` (
  `leerling_id` int(11) NOT NULL,
  `gebruiker_id` int(11) DEFAULT NULL,
  `naam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `geboortedatum` date DEFAULT NULL,
  `adres` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `les`
--

CREATE TABLE `les` (
  `les_id` int(11) NOT NULL,
  `leerling_id` int(11) DEFAULT NULL,
  `instructeur_id` int(11) DEFAULT NULL,
  `auto_id` int(11) DEFAULT NULL,
  `datum` datetime DEFAULT NULL,
  `ophaallocatie` varchar(255) DEFAULT NULL,
  `geannuleerd` tinyint(1) DEFAULT 0,
  `reden_annulering` text DEFAULT NULL,
  `leerling_opmerking` text DEFAULT NULL,
  `instructeur_opmerking` text DEFAULT NULL,
  `pakket` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `mededeling`
--

CREATE TABLE `mededeling` (
  `mededeling_id` int(11) NOT NULL,
  `titel` varchar(100) DEFAULT NULL,
  `inhoud` text DEFAULT NULL,
  `doelgroep` enum('leerlingen','instructeurs','allemaal') DEFAULT NULL,
  `gebruiker_id` int(11) DEFAULT NULL,
  `datum` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pakket`
--

CREATE TABLE `pakket` (
  `pakket_id` int(11) NOT NULL,
  `naam` varchar(100) DEFAULT NULL,
  `prijs` decimal(10,2) DEFAULT NULL,
  `aantal_lessen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rooster`
--

CREATE TABLE `rooster` (
  `id` int(11) NOT NULL,
  `instructeur_id` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `starttijd` time DEFAULT NULL,
  `eindtijd` time DEFAULT NULL,
  `printklaar` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`auto_id`),
  ADD KEY `instructeur_id` (`instructeur_id`);

--
-- Indexen voor tabel `eigenaar`
--
ALTER TABLE `eigenaar`
  ADD PRIMARY KEY (`eigenaar_id`),
  ADD KEY `gebruiker_id` (`gebruiker_id`);

--
-- Indexen voor tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD PRIMARY KEY (`gebruiker_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `instructeur`
--
ALTER TABLE `instructeur`
  ADD PRIMARY KEY (`instructeur_id`),
  ADD KEY `gebruiker_id` (`gebruiker_id`);

--
-- Indexen voor tabel `leerling`
--
ALTER TABLE `leerling`
  ADD PRIMARY KEY (`leerling_id`),
  ADD KEY `gebruiker_id` (`gebruiker_id`);

--
-- Indexen voor tabel `les`
--
ALTER TABLE `les`
  ADD PRIMARY KEY (`les_id`),
  ADD KEY `leerling_id` (`leerling_id`),
  ADD KEY `instructeur_id` (`instructeur_id`),
  ADD KEY `auto_id` (`auto_id`);

--
-- Indexen voor tabel `mededeling`
--
ALTER TABLE `mededeling`
  ADD PRIMARY KEY (`mededeling_id`),
  ADD KEY `gebruiker_id` (`gebruiker_id`);

--
-- Indexen voor tabel `pakket`
--
ALTER TABLE `pakket`
  ADD PRIMARY KEY (`pakket_id`);

--
-- Indexen voor tabel `rooster`
--
ALTER TABLE `rooster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructeur_id` (`instructeur_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `auto`
--
ALTER TABLE `auto`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `eigenaar`
--
ALTER TABLE `eigenaar`
  MODIFY `eigenaar_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `gebruiker_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `instructeur`
--
ALTER TABLE `instructeur`
  MODIFY `instructeur_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `leerling`
--
ALTER TABLE `leerling`
  MODIFY `leerling_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `les`
--
ALTER TABLE `les`
  MODIFY `les_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `mededeling`
--
ALTER TABLE `mededeling`
  MODIFY `mededeling_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `pakket`
--
ALTER TABLE `pakket`
  MODIFY `pakket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `rooster`
--
ALTER TABLE `rooster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `auto`
--
ALTER TABLE `auto`
  ADD CONSTRAINT `auto_ibfk_1` FOREIGN KEY (`instructeur_id`) REFERENCES `instructeur` (`instructeur_id`);

--
-- Beperkingen voor tabel `eigenaar`
--
ALTER TABLE `eigenaar`
  ADD CONSTRAINT `eigenaar_ibfk_1` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`gebruiker_id`);

--
-- Beperkingen voor tabel `instructeur`
--
ALTER TABLE `instructeur`
  ADD CONSTRAINT `instructeur_ibfk_1` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`gebruiker_id`);

--
-- Beperkingen voor tabel `leerling`
--
ALTER TABLE `leerling`
  ADD CONSTRAINT `leerling_ibfk_1` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`gebruiker_id`);

--
-- Beperkingen voor tabel `les`
--
ALTER TABLE `les`
  ADD CONSTRAINT `les_ibfk_1` FOREIGN KEY (`leerling_id`) REFERENCES `leerling` (`leerling_id`),
  ADD CONSTRAINT `les_ibfk_2` FOREIGN KEY (`instructeur_id`) REFERENCES `instructeur` (`instructeur_id`),
  ADD CONSTRAINT `les_ibfk_3` FOREIGN KEY (`auto_id`) REFERENCES `auto` (`auto_id`);

--
-- Beperkingen voor tabel `mededeling`
--
ALTER TABLE `mededeling`
  ADD CONSTRAINT `mededeling_ibfk_1` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`gebruiker_id`);

--
-- Beperkingen voor tabel `rooster`
--
ALTER TABLE `rooster`
  ADD CONSTRAINT `rooster_ibfk_1` FOREIGN KEY (`instructeur_id`) REFERENCES `instructeur` (`instructeur_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
