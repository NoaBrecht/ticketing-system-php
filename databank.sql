-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: ID201584_noa.db.webhosting.be
-- Gegenereerd op: 25 mei 2022 om 10:28
-- Serverversie: 5.7.35-38-log
-- PHP-versie: 7.1.25-1+0~20181207224605.11+jessie~1.gbpf65b84

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ID201584_noa`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `diensten`
--

CREATE TABLE `diensten` (
  `dienstID` int(11) NOT NULL,
  `dienst` varchar(150) NOT NULL,
  `dienst_time_aangemaakt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `diensten`
--

INSERT INTO `diensten` (`dienstID`, `dienst`, `dienst_time_aangemaakt`) VALUES
(1, 'Cultuurdienst', '2022-04-25 18:51:07'),
(2, 'Groendienst', '2022-04-25 18:51:07'),
(3, 'Omgeving', '2022-04-25 18:51:07'),
(4, 'vrije tijd', '2022-04-25 18:51:07'),
(7, 'Testdienst', '2022-04-25 18:51:07'),
(8, 'testdienst', '2022-05-16 15:48:37');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `prioriteiten`
--

CREATE TABLE `prioriteiten` (
  `prioriteitId` int(11) NOT NULL,
  `prioriteit` varchar(1000) NOT NULL,
  `prioriteit_kleur` varchar(100) NOT NULL COMMENT 'Hier kan je de kleur van een bootstrap button ingeven\r\nZie https://getbootstrap.com/docs/5.1/components/buttons/'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `prioriteiten`
--

INSERT INTO `prioriteiten` (`prioriteitId`, `prioriteit`, `prioriteit_kleur`) VALUES
(1, 'laag', 'success'),
(2, 'gemiddeld', 'warning'),
(3, 'hoog', 'danger'),
(4, 'afgerond', 'info');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rollen`
--

CREATE TABLE `rollen` (
  `rolId` int(11) NOT NULL,
  `rolnaam` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `rollen`
--

INSERT INTO `rollen` (`rolId`, `rolnaam`) VALUES
(1, 'Gebruiker'),
(2, 'Beheerder'),
(3, 'Super admin');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `ticket_korte_omschrijving` varchar(128) NOT NULL,
  `ticket_lange_omschrijving` varchar(1000) NOT NULL,
  `ticket_prioriteit` int(11) NOT NULL DEFAULT '1',
  `ticket_toestel` varchar(1000) NOT NULL,
  `ticket_dienst` int(11) DEFAULT '1',
  `ticket_datum_gemeld` date NOT NULL,
  `ticket_filepath` varchar(600) NOT NULL,
  `ticket_datum_aangemaakt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ticket_commentaar` varchar(1000) NOT NULL,
  `ticket_user` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `ticket_korte_omschrijving`, `ticket_lange_omschrijving`, `ticket_prioriteit`, `ticket_toestel`, `ticket_dienst`, `ticket_datum_gemeld`, `ticket_filepath`, `ticket_datum_aangemaakt`, `ticket_commentaar`, `ticket_user`) VALUES
(1, 'Printer werkt niet', 'Hoi,\r\n\r\nPrinter met sticker PR-1058 werkt niet. Het papier zit vast.', 1, 'Printer', 1, '2022-04-24', 'uploads/6262e0f20ded49.01611485.jpg', '2022-04-22 17:08:02', 'test1', 1),
(18, 'wifi school is stuk', 'het internet werkt niet meer', 3, 'test', 2, '2022-05-18', 'uploads/627cb8a6e9aa99.29834200.png', '2022-05-18 10:14:13', '', 2),
(19, 'korte omschrijving', 'test', 2, 'test', 3, '2022-05-18', 'uploads/627cb8a6e9aa99.29834200.png', '2022-05-18 18:03:21', '', 2),
(21, 'scherm stuk', 'rtesezr', 4, 'test', 4, '2022-05-25', 'uploads/628dd50e74eac4.84581566.pdf', '2022-05-25 07:04:46', '', 2),
(23, 'Scherm werkt niet', 'Hoi,\r\n\r\nScherm met sticker SC-1058 werkt niet. Het papier zit vast.', 3, 'scherm', 2, '2022-05-25', 'uploads/nofile.php', '2022-05-25 07:39:35', '', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersFname` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersRol` int(11) NOT NULL,
  `usersPwd` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersFname`, `usersEmail`, `usersUid`, `usersRol`, `usersPwd`) VALUES
(1, 'Van den Berghe', 'Noa', 'vandenberghenoa1@gmail.com', 'noa.vandenberghe', 3, '$2y$10$3CwALH30TTPKNz8MCrCR0uctPGRFw6SA9PfTabUFDpgK4MMIL1nMG'),
(2, 'admin', 'admin', 'admin@admin.com', 'admin', 2, '$2y$10$fuwKbpbqcC.ubi/6mhIrY.rz9ujCLz6O9V88w8B1Kfc/jm6aw9YUG'),
(3, 'Van Damme', 'Nick', 'nick.vandamme@brecht.be', 'nick.vandamme', 3, '$2y$10$t8OIkbniZEf0p5lsCTW7luQh2.c34jQTkxU74oWEWgmLGMzXwVnhm'),
(4, 'Van Oerle', 'Eva', 'eva.vanoerle@brecht.be', 'eva.vanoerle', 3, '$2y$10$xhcEO3qi786vH3fNfVfd1OvXoKxADnAnWjrGPAcbstqjDfOemzjca'),
(5, 'jonas', 'Jonas', 'jonas@gmail.com', 'Jonas', 1, '$2y$10$UivbNW1zQinhTND60AQcLOrQf0Ll1EDB7NN61U5ZDUiEqpflwdRka');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `diensten`
--
ALTER TABLE `diensten`
  ADD PRIMARY KEY (`dienstID`);

--
-- Indexen voor tabel `prioriteiten`
--
ALTER TABLE `prioriteiten`
  ADD PRIMARY KEY (`prioriteitId`);

--
-- Indexen voor tabel `rollen`
--
ALTER TABLE `rollen`
  ADD PRIMARY KEY (`rolId`);

--
-- Indexen voor tabel `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `ticket_prioriteit` (`ticket_prioriteit`),
  ADD KEY `ticket_user` (`ticket_user`),
  ADD KEY `ticket_dienst` (`ticket_dienst`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`),
  ADD KEY `usersRol` (`usersRol`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `diensten`
--
ALTER TABLE `diensten`
  MODIFY `dienstID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `prioriteiten`
--
ALTER TABLE `prioriteiten`
  MODIFY `prioriteitId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `rollen`
--
ALTER TABLE `rollen`
  MODIFY `rolId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`ticket_prioriteit`) REFERENCES `prioriteiten` (`prioriteitId`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`ticket_user`) REFERENCES `users` (`usersId`),
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`ticket_dienst`) REFERENCES `diensten` (`dienstID`);

--
-- Beperkingen voor tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`usersRol`) REFERENCES `rollen` (`rolId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
