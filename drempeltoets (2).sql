-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 21 mrt 2025 om 23:34
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
-- Database: `drempeltoets`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reservering`
--

CREATE TABLE `reservering` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefoon` varchar(255) NOT NULL,
  `aankomst` date DEFAULT NULL,
  `vertrek` date NOT NULL,
  `kamertype` varchar(255) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `reservering`
--

INSERT INTO `reservering` (`id`, `naam`, `email`, `telefoon`, `aankomst`, `vertrek`, `kamertype`, `room_id`) VALUES
(2, 'fizatesttttttttt', 'fiza@gmail.com', '064629254552', '2025-03-19', '2025-03-28', 'standaard', 0),
(16, 'fiza', 'fiza@gmail.com', '087654223679', '2025-03-22', '2025-03-30', 'standaard', 0),
(17, 'fiza', 'fiza@gmail.com', '087654223679', '2025-03-22', '2025-03-30', 'standaard', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `type` enum('single','double','suite') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('available','booked') DEFAULT 'available',
  `image` varchar(255) NOT NULL DEFAULT 'default-room.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `room`
--

INSERT INTO `room` (`id`, `room_number`, `type`, `price`, `status`, `image`) VALUES
(0, '101', 'single', 75.00, 'available', 'default-room.jpg'),
(0, '102', 'single', 75.00, 'available', 'default-room.jpg'),
(0, '103', 'double', 100.00, 'available', 'default-room.jpg'),
(0, '104', 'double', 100.00, 'available', 'default-room.jpg'),
(0, '105', 'suite', 150.00, 'available', 'default-room.jpg'),
(0, '106', 'suite', 150.00, 'available', 'default-room.jpg'),
(0, '107', 'single', 75.00, 'available', 'default-room.jpg'),
(0, '108', 'single', 75.00, 'available', 'default-room.jpg'),
(0, '109', 'double', 100.00, 'available', 'default-room.jpg'),
(0, '110', 'double', 100.00, 'available', 'default-room.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'gorav', '$2y$10$Oskd2DAKVlRf05.YheMeD.vjpKjbIDqbqs7YIDUwCkOBkdxJiEBWu'),
(2, 'gorav', '$2y$10$jwN.cyzNh21xM7U43vXg2eum4hr4p0DqOLkNSEtTceBYLMFKbky/O');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `reservering`
--
ALTER TABLE `reservering`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `reservering`
--
ALTER TABLE `reservering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
