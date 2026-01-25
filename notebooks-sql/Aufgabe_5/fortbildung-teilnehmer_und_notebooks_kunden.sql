-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win64
-- HeidiSQL Version:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Exportiere Datenbank Struktur für fortbildung
CREATE DATABASE IF NOT EXISTS `fortbildung` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `fortbildung`;

-- Exportiere Struktur von Tabelle fortbildung.kunden
CREATE TABLE IF NOT EXISTS `kunden` (
  `KundenNr` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(30) COLLATE utf8_unicode_ci DEFAULT '0',
  `strasse` varchar(30) COLLATE utf8_unicode_ci DEFAULT '0',
  `plz` varchar(8) COLLATE utf8_unicode_ci DEFAULT '0',
  `ort` varchar(30) COLLATE utf8_unicode_ci DEFAULT '0',
  `telefon` varchar(15) COLLATE utf8_unicode_ci DEFAULT '0',
  `Passwort` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`KundenNr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle fortbildung.kunden: ~4 rows (ungefähr)
/*!40000 ALTER TABLE `kunden` DISABLE KEYS */;
INSERT IGNORE INTO `kunden` (`KundenNr`, `name`, `strasse`, `plz`, `ort`, `telefon`, `Passwort`) VALUES
	('1234', 'Sündermann AG', 'Husumer Str. 25', '49685', 'Bühren', '04447/85761', 'werder'),
	('1235', 'Bornhorst KG', 'Grüner Hof', '28776', 'Friesoythe', '04441/44777', 'schalke'),
	('1236', 'Espel GmbH', 'Husumer Str. 25', '49685', 'Bühren', '0160/96029333', 'bayern'),
	('7', 'Kruse Ltd.', 'Am Stadion', '89123', 'München', '089/22457', 'gladbach');
/*!40000 ALTER TABLE `kunden` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle fortbildung.notebooks
CREATE TABLE IF NOT EXISTS `notebooks` (
  `ArtikelNr` int(3) unsigned NOT NULL DEFAULT 0,
  `Bezeichnung` varchar(30) DEFAULT '0',
  `Hersteller` varchar(30) DEFAULT '0',
  `Preis` double unsigned DEFAULT 0,
  `Bestand` tinyint(3) unsigned DEFAULT 0,
  `Arbeitsspeicher` int(10) unsigned DEFAULT 0,
  `Webcam` varchar(10) DEFAULT '0',
  `WLAN` varchar(5) DEFAULT '0',
  `Bild` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ArtikelNr`),
  UNIQUE KEY `ArtikelNr` (`ArtikelNr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle fortbildung.notebooks: ~6 rows (ungefähr)
/*!40000 ALTER TABLE `notebooks` DISABLE KEYS */;
INSERT IGNORE INTO `notebooks` (`ArtikelNr`, `Bezeichnung`, `Hersteller`, `Preis`, `Bestand`, `Arbeitsspeicher`, `Webcam`, `WLAN`, `Bild`) VALUES
	(1001, 'Omnibook', 'HP', 859, 15, 2, 'Nein', 'Ja', 'N01.jpg'),
	(1002, 'Traveler', 'ECS', 799, 7, 2, 'Ja', 'Nein', 'N02.jpg'),
	(1003, 'Top Note', 'IPC', 599, 6, 1, 'Nein', 'Nein', 'N03.jpg'),
	(1004, 'Travelmate', 'ACER', 899, 9, 3, 'Ja', 'Ja', 'N04.jpg'),
	(1005, 'Thinkpad', 'IBM', 1299, 4, 4, 'Nein', 'Ja', 'N05.jpg'),
	(1006, 'Vaio', 'Sony', 999, 11, 4, 'Ja', 'Ja', 'N06.jpg');
/*!40000 ALTER TABLE `notebooks` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle fortbildung.teilnehmer
CREATE TABLE IF NOT EXISTS `teilnehmer` (
  `Nummer` tinyint(3) unsigned NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Vorname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Adresse` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `PLZ` smallint(5) unsigned DEFAULT NULL,
  `Ort` char(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`Nummer`),
  UNIQUE KEY `Nummer` (`Nummer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle fortbildung.teilnehmer: ~4 rows (ungefähr)
/*!40000 ALTER TABLE `teilnehmer` DISABLE KEYS */;
INSERT IGNORE INTO `teilnehmer` (`Nummer`, `Name`, `Vorname`, `Adresse`, `PLZ`, `Ort`) VALUES
	(1, 'Meyer', 'Herbert', 'Holzweg 7', 12345, 'Testburg'),
	(2, 'Müller', 'Sabine', 'Hauptstr. 32', 23456, 'Testhausen'),
	(3, 'Schulz', 'Willi', 'Lindenstr. 5', 34567, 'Teststadt'),
	(4, 'Möller', 'Meik', 'Hansestr. 3', 26458, 'Lübeck');
/*!40000 ALTER TABLE `teilnehmer` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
