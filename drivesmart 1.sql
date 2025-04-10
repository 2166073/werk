-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 10 apr 2025 om 13:41
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
(1, 20, 'ok2006');

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
(20, 'ok2006@gmail.com', '$2y$10$mBVtjwnlANvOeMV/4KR6N.9kv2xO1f/SNMgEz9JF.N3aa1u.E5Ebm', 'eigenaar');

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
(2, 19, 'maandag tot vrijdag', '123', 6535578, '123@gmail.com');

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
  `telefoon` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `leerling`
--

INSERT INTO `leerling` (`leerling_id`, `gebruiker_id`, `naam`, `achternaam`, `geboortedatum`, `adres`, `telefoon`) VALUES
(3, 18, 'omesh', 'soedhwa', '2025-04-10', 'ok', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `les`
--

CREATE TABLE `les` (
  `les_id` int(11) NOT NULL,
  `leerling_id` int(11) DEFAULT NULL,
  `instructeur_id` int(11) DEFAULT NULL,
  `pakket_id` int(11) DEFAULT NULL,
  `auto_id` int(11) DEFAULT NULL,
  `datum` datetime DEFAULT NULL,
  `ophaallocatie` varchar(255) DEFAULT NULL,
  `geannuleerd` tinyint(1) DEFAULT 0,
  `reden_annulering` text DEFAULT NULL,
  `leerling_opmerking` text DEFAULT NULL,
  `instructeur_opmerking` text DEFAULT NULL,
  `pakket` tinyint(1) DEFAULT 0,
  `starttijd` time NOT NULL,
  `eindtijd` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `les`
--

INSERT INTO `les` (`les_id`, `leerling_id`, `instructeur_id`, `pakket_id`, `auto_id`, `datum`, `ophaallocatie`, `geannuleerd`, `reden_annulering`, `leerling_opmerking`, `instructeur_opmerking`, `pakket`, `starttijd`, `eindtijd`) VALUES
(1, 3, 1, 1, NULL, '2025-04-10 13:27:21', 'Koppeling via dashboard', 0, NULL, NULL, NULL, 0, '00:00:00', '00:00:00'),
(2, 3, 1, 1, 1, '2025-04-22 00:00:00', 'hd', 0, NULL, 'sii', 'ik', 0, '12:00:00', '13:00:00'),
(4, 3, 1, NULL, NULL, '2025-04-10 00:00:00', 'ok', 0, NULL, NULL, 'ok', 2, '00:00:00', '00:00:00');

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
  `inhoud` text DEFAULT NULL,
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

--
-- Gegevens worden geëxporteerd voor tabel `pakket`
--

INSERT INTO `pakket` (`pakket_id`, `naam`, `prijs`, `aantal_lessen`) VALUES
(1, 'RIJLESPAKKET A', 2375.00, 30),
(2, 'RIJLESPAKKET B', 3000.00, 40),
(3, 'RIJLESPAKKET C', 3800.00, 51);

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
(4, 1, '2025-04-11', '09:00:00', '17:00:00', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verwijderd_les`
--

CREATE TABLE `verwijderd_les` (
  `verwijderd_id` int(11) NOT NULL,
  `les_id` int(11) DEFAULT NULL,
  `reden` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD PRIMARY KEY (`les_id`);

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
  ADD PRIMARY KEY (`verwijderd_id`),
  ADD KEY `les_id` (`les_id`);

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
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `eigenaar`
--
ALTER TABLE `eigenaar`
  MODIFY `eigenaar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `gebruiker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT voor een tabel `instructeur`
--
ALTER TABLE `instructeur`
  MODIFY `instructeur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `leerling`
--
ALTER TABLE `leerling`
  MODIFY `leerling_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `les`
--
ALTER TABLE `les`
  MODIFY `les_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `mankementen`
--
ALTER TABLE `mankementen`
  MODIFY `mankement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `mededeling`
--
ALTER TABLE `mededeling`
  MODIFY `mededeling_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `pakket`
--
ALTER TABLE `pakket`
  MODIFY `pakket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `rooster`
--
ALTER TABLE `rooster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- Beperkingen voor tabel `verwijderd_les`
--
ALTER TABLE `verwijderd_les`
  ADD CONSTRAINT `verwijderd_les_ibfk_1` FOREIGN KEY (`les_id`) REFERENCES `les` (`les_id`);

--
-- Beperkingen voor tabel `ziekmeldingen`
--
ALTER TABLE `ziekmeldingen`
  ADD CONSTRAINT `ziekmeldingen_ibfk_1` FOREIGN KEY (`instructeur_id`) REFERENCES `instructeur` (`instructeur_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
