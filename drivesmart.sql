-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 10 apr 2025 om 16:08
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

--
-- Gegevens worden geëxporteerd voor tabel `auto`
--

INSERT INTO `auto` (`auto_id`, `kenteken`, `merk`, `model`, `instructeur_id`, `onderhoud`, `mankement`, `km_stand_einde_dag`) VALUES
(1, '874289', 'mercedes', 'a klasse', 1, 0, NULL, NULL),
(2, '453', 'renault', 'a klasse', 2, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `eigenaar`
--

CREATE TABLE `eigenaar` (
  `eigenaar_id` int(11) NOT NULL,
  `gebruiker_id` int(11) DEFAULT NULL,
  `naam` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `eigenaar`
--

INSERT INTO `eigenaar` (`eigenaar_id`, `gebruiker_id`, `naam`) VALUES
(1, 15, 'maandag'),
(33, 66, 'eig'),
(34, 68, 'ik');

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

--
-- Gegevens worden geëxporteerd voor tabel `gebruiker`
--

INSERT INTO `gebruiker` (`gebruiker_id`, `email`, `wachtwoord`, `rol`) VALUES
(1, 'oompie2006@gmail.com', '$2y$10$KGem571D1HIpArju1Ozkz.7Vj7aFq/8thr6lF/Z6dU/29wHHhDfn2', 'leerling'),
(7, 'aboemaraomar2004@gmail.com', '$2y$10$RS7/NX/BEmqytklwUiuVn./aT9vLqinP3rT2e8axkQHsGlV2U/2KC', 'instructeur'),
(9, 'abmaraomar2004@gmail.com', '$2y$10$lhq5CsKpgbtYldY8D/6zP.VjH7LnC8wB8ufBq9zkke52u2z52TfzS', 'instructeur'),
(11, 'raomar2004@gmail.com', '$2y$10$9cWybsPTcV3qCLR.jvK4E.1oIcqO/AiTZJN9ufz84cpmT30Sddwv.', 'instructeur'),
(13, 'appel@gmail.com', '$2y$10$VWTtR8EQw3qxAmZFrPp0L.zSPf3CYNZ1/zALm65YQ/xeLxOLTANUG', 'instructeur'),
(15, 'maandag@gmail.com', '$2y$10$wr.7EYKxrsuk9zbmKU2ExeKgzNZXPDu96sxg7gSsXLz467ya739/u', 'instructeur'),
(18, 'ok@gmail.com', '$2y$10$54uUUpK.rspzcyCZTnJGEeFxuAkurbk/I4uidyuUPvtpWORcHXONm', 'leerling'),
(19, '123@gmail.com', '123', 'instructeur'),
(20, 'fiza@gmail.com', '$2y$10$6x5yU2H8dmx.rSbMpgpROuuStROcMf4QTg1adhoRaO0U1YH/QiOAy', 'leerling'),
(21, 'fiza7@gmail.com', '$2y$10$MMEi2G1CF2OzLFItnfN1aOniCvWJ8MbqaLTn3EI6PgxfKnPFhe8j2', 'instructeur'),
(66, 'eig@gmail.com', 'eig', 'eigenaar'),
(67, 'eigenaar@gmail.com', 'eigenaar', NULL),
(68, 'ik@gmail.com', '$2y$10$OFB/JqCemJKv8UO2MDekae6LIeQPMvD1us3qP7eUpl6z/mBEiSfZK', 'eigenaar'),
(69, 'klaar@gmail.com', '$2y$10$VjFjAo9KsQKQUOoY/UtMHe4dgVJCOC.JVtQwP7b4X9ctUdKQryDIq', 'leerling'),
(70, 'les@gmail.com', '$2y$10$POkFhEG1XctzCEBs/qZ38O6JrtoTD7WBJX/Fdkpte8xcCZJMPFTm6', 'instructeur'),
(71, 'osman@gmail.com', '$2y$10$GFhDSWL6uBE7NmszccmuweiXn247dhp9pgI.EBX//zHkgcJ3uNE4.', 'leerling');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `instructeur`
--

CREATE TABLE `instructeur` (
  `instructeur_id` int(11) NOT NULL,
  `gebruiker_id` int(11) DEFAULT NULL,
  `beschikbaarheid` text DEFAULT NULL,
  `naam` varchar(255) DEFAULT NULL,
  `telefoon` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `instructeur`
--

INSERT INTO `instructeur` (`instructeur_id`, `gebruiker_id`, `beschikbaarheid`, `naam`, `telefoon`, `email`) VALUES
(1, 15, 'maandag', 'omesh1', 696435368, 'maandag@gmail.com'),
(2, 19, 'maandag tot vrijdag', '123', 6535578, '123@gmail.com'),
(3, 21, 'maandag', 'fiza', 87643214, 'fiza7@gmail.com'),
(4, 70, 'oop', 'les', 978654325, 'les@gmail.com');

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
  `adres` text DEFAULT NULL,
  `telefoon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `leerling`
--

INSERT INTO `leerling` (`leerling_id`, `gebruiker_id`, `naam`, `achternaam`, `geboortedatum`, `adres`, `telefoon`) VALUES
(3, 18, 'omesh', 'soedhwa', '2025-04-10', 'ok', NULL),
(4, 20, 'fiza', 'amjid', '2025-04-03', 'amsterdam', NULL),
(5, 69, 'klaar', 'klaar', '2025-04-01', 'amsterdam', NULL),
(6, 71, 'osman', 'os', '2025-04-01', 'amsterdam', NULL);

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
  `pakket` tinyint(1) DEFAULT 0,
  `starttijd` time NOT NULL,
  `eindtijd` time NOT NULL,
  `pakket_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `les`
--

INSERT INTO `les` (`les_id`, `leerling_id`, `instructeur_id`, `auto_id`, `datum`, `ophaallocatie`, `geannuleerd`, `reden_annulering`, `leerling_opmerking`, `instructeur_opmerking`, `pakket`, `starttijd`, `eindtijd`, `pakket_id`) VALUES
(1, 4, 1, 1, NULL, 'hdlp', 0, NULL, '5 min EERDER', 'oooo', 2, '00:00:00', '00:00:00', 0),
(3, NULL, 1, 1, '2025-04-10 00:00:00', 'yo', 0, NULL, NULL, NULL, 0, '00:00:00', '00:00:00', 0),
(4, 3, 1, 1, '2025-04-11 15:00:00', 'k', 0, NULL, NULL, NULL, 0, '00:00:00', '00:00:00', 0),
(5, 3, 1, 1, NULL, '', 0, NULL, '5 min EERDER', '', 0, '00:00:00', '00:00:00', 0),
(6, 3, 1, 1, '2025-04-15 09:00:00', 'ok', 0, NULL, NULL, NULL, 0, '00:00:00', '00:00:00', 0),
(7, 3, 2, 2, '2025-04-17 09:00:00', 'ok', 0, NULL, NULL, NULL, 0, '00:00:00', '00:00:00', 0),
(14, 3, 1, NULL, '2025-04-11 00:00:00', 'amsterdam', 0, NULL, NULL, NULL, 2, '00:00:00', '00:00:00', 0),
(15, 4, 1, NULL, '2025-04-25 00:00:00', 'amsterdam', 0, NULL, NULL, NULL, 2, '00:00:00', '00:00:00', 0),
(16, 4, 1, NULL, '2025-04-11 00:00:00', 'amsterdam', 0, NULL, NULL, 'okok', 2, '00:00:00', '00:00:00', 0),
(17, 3, 1, NULL, '2025-04-24 00:00:00', 'amsterdam', 0, NULL, NULL, 'uuuu', 2, '00:00:00', '00:00:00', 0),
(18, NULL, 1, NULL, '2025-04-10 00:00:00', 'rotterdam', 0, NULL, NULL, NULL, 2, '00:00:00', '00:00:00', 0),
(19, 3, 1, NULL, '2025-04-18 00:00:00', 'rotterdam', 0, NULL, NULL, 'lasla', 2, '00:00:00', '00:00:00', 0),
(20, 5, 1, NULL, '2025-04-10 00:00:00', 'rotterdam', 0, NULL, NULL, 'appel', 2, '00:00:00', '00:00:00', 0),
(21, 3, 1, NULL, '2025-04-10 00:00:00', 'rotterdam', 0, NULL, NULL, 'appel', 2, '00:00:00', '00:00:00', NULL),
(22, 5, 1, NULL, '2025-04-10 00:00:00', 'rotterdam', 0, NULL, NULL, 'good', 1, '00:00:00', '00:00:00', NULL),
(23, 5, 1, NULL, '2025-04-10 00:00:00', 'rotterdam', 0, NULL, NULL, 'no good', 1, '00:00:00', '00:00:00', NULL),
(24, NULL, 1, NULL, '2025-04-10 00:00:00', 'rotterdam', 0, NULL, NULL, NULL, 1, '00:00:00', '00:00:00', NULL),
(27, 3, 1, NULL, '2025-04-10 00:00:00', 'rotterdam', 0, NULL, NULL, 'good', 1, '00:00:00', '00:00:00', NULL),
(34, 6, 1, NULL, NULL, 'Koppeling via dashboard', 0, NULL, 'okok', '', 0, '00:00:00', '00:00:00', 0),
(35, 6, 1, 2, NULL, 'rotterdam', 0, NULL, 'geeeen lesss', 'geen less', 1, '14:27:00', '15:27:00', 0),
(36, 6, 4, 1, NULL, 'bjhgfxv', 0, NULL, 'okokok', '', 0, '09:39:00', '11:39:00', 0),
(37, 6, 4, NULL, '2025-04-10 00:00:00', 'oopopop', 0, NULL, NULL, 'jaaa', 1, '00:00:00', '00:00:00', NULL),
(38, 6, 4, 1, NULL, 'rotterdam', 0, NULL, 'nmhwbdwkjhe', '', 0, '14:17:00', '15:19:00', 0),
(39, NULL, 1, 1, '2025-04-10 00:00:00', 'amsterdam', 0, NULL, 'gfjhht', NULL, 0, '09:44:00', '10:46:00', 0),
(40, NULL, 1, 1, '2025-04-10 00:00:00', 'rotterdam', 0, NULL, 'opop', NULL, 0, '10:51:00', '11:51:00', 0),
(41, NULL, 3, 1, '2025-04-10 00:00:00', 'rotterdam', 0, NULL, 'memd3l', NULL, 0, '11:53:00', '12:53:00', 0),
(42, NULL, 3, 2, '2025-04-10 00:00:00', 'rotterdam', 0, NULL, 'wmmslw', NULL, 0, '12:08:00', '13:08:00', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `mankementen`
--

CREATE TABLE `mankementen` (
  `mankement_id` int(11) NOT NULL,
  `auto_id` int(11) NOT NULL,
  `instructeur_id` int(11) NOT NULL,
  `beschrijving` text NOT NULL,
  `datum` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `mededeling`
--

CREATE TABLE `mededeling` (
  `mededeling_id` int(11) NOT NULL,
  `gebruiker_id` int(11) DEFAULT NULL,
  `inhoud` text DEFAULT NULL,
  `datum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `mededeling`
--

INSERT INTO `mededeling` (`mededeling_id`, `gebruiker_id`, `inhoud`, `datum`) VALUES
(1, 19, 'oh my goed', '2025-04-10'),
(2, 13, 'ik', '2025-04-10'),
(3, 1, 'ikkkkkk', '2025-04-10'),
(4, 20, 'okk', '2025-04-10'),
(5, 18, 'alles is doen', '2025-04-10'),
(6, 11, 'alles is done', '2025-04-10');

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

--
-- Gegevens worden geëxporteerd voor tabel `pakket`
--

INSERT INTO `pakket` (`pakket_id`, `naam`, `prijs`, `aantal_lessen`) VALUES
(0, 't', 1.00, 5);

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
-- Gegevens worden geëxporteerd voor tabel `rooster`
--

INSERT INTO `rooster` (`id`, `instructeur_id`, `datum`, `starttijd`, `eindtijd`, `printklaar`) VALUES
(1, 1, '2025-04-09', '09:00:00', '17:00:00', 0),
(3, 1, '2025-04-10', '09:00:00', '17:00:00', 0),
(4, 1, '2025-04-11', '09:00:00', '17:00:00', 0),
(8, 3, '2025-04-09', '09:00:00', '17:00:00', 0),
(9, 3, '2025-04-10', '09:00:00', '17:00:00', 0),
(10, 3, '2025-04-11', '09:00:00', '17:00:00', 0),
(11, 4, '2025-04-10', '09:00:00', '17:00:00', 0),
(12, 4, '2025-04-11', '09:00:00', '17:00:00', 0),
(13, 4, '2025-04-14', '09:00:00', '17:00:00', 0);

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
(6, 13, 'gwn'),
(7, 26, 'oo');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ziekmeldingen`
--

CREATE TABLE `ziekmeldingen` (
  `ziekmelding_id` int(11) NOT NULL,
  `instructeur_id` int(11) DEFAULT NULL,
  `reden` text DEFAULT NULL,
  `datum` datetime DEFAULT NULL
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
  ADD KEY `auto_id` (`auto_id`),
  ADD KEY `pakket_id` (`pakket_id`);

--
-- Indexen voor tabel `mankementen`
--
ALTER TABLE `mankementen`
  ADD PRIMARY KEY (`mankement_id`),
  ADD KEY `auto_id` (`auto_id`),
  ADD KEY `instructeur_id` (`instructeur_id`);

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
-- Indexen voor tabel `verwijderd_les`
--
ALTER TABLE `verwijderd_les`
  ADD PRIMARY KEY (`verwijderd_id`);

--
-- Indexen voor tabel `ziekmeldingen`
--
ALTER TABLE `ziekmeldingen`
  ADD PRIMARY KEY (`ziekmelding_id`),
  ADD KEY `instructeur_id` (`instructeur_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `auto`
--
ALTER TABLE `auto`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `eigenaar`
--
ALTER TABLE `eigenaar`
  MODIFY `eigenaar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT voor een tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `gebruiker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT voor een tabel `instructeur`
--
ALTER TABLE `instructeur`
  MODIFY `instructeur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `leerling`
--
ALTER TABLE `leerling`
  MODIFY `leerling_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `les`
--
ALTER TABLE `les`
  MODIFY `les_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT voor een tabel `mankementen`
--
ALTER TABLE `mankementen`
  MODIFY `mankement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `mededeling`
--
ALTER TABLE `mededeling`
  MODIFY `mededeling_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `pakket`
--
ALTER TABLE `pakket`
  MODIFY `pakket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `rooster`
--
ALTER TABLE `rooster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `verwijderd_les`
--
ALTER TABLE `verwijderd_les`
  MODIFY `verwijderd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `ziekmeldingen`
--
ALTER TABLE `ziekmeldingen`
  MODIFY `ziekmelding_id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `les_ibfk_3` FOREIGN KEY (`auto_id`) REFERENCES `auto` (`auto_id`),
  ADD CONSTRAINT `les_ibfk_4` FOREIGN KEY (`pakket_id`) REFERENCES `pakket` (`pakket_id`);

--
-- Beperkingen voor tabel `mankementen`
--
ALTER TABLE `mankementen`
  ADD CONSTRAINT `mankementen_ibfk_1` FOREIGN KEY (`auto_id`) REFERENCES `auto` (`auto_id`),
  ADD CONSTRAINT `mankementen_ibfk_2` FOREIGN KEY (`instructeur_id`) REFERENCES `instructeur` (`instructeur_id`);

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

--
-- Beperkingen voor tabel `ziekmeldingen`
--
ALTER TABLE `ziekmeldingen`
  ADD CONSTRAINT `ziekmeldingen_ibfk_1` FOREIGN KEY (`instructeur_id`) REFERENCES `instructeur` (`instructeur_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
