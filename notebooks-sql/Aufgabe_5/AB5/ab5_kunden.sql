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
DELETE FROM `kunden`;
/*!40000 ALTER TABLE `kunden` DISABLE KEYS */;
INSERT INTO `kunden` (`KundenNr`, `name`, `strasse`, `plz`, `ort`, `telefon`, `Passwort`) VALUES
	('1234', 'Sündermann AG', 'Husumer Str. 25', '49685', 'Bühren', '04447/85761', 'werder'),
	('1235', 'Bornhorst KG', 'Grüner Hof', '28776', 'Friesoythe', '04441/44777', 'schalke'),
	('1236', 'Espel GmbH', 'Husumer Str. 25', '49685', 'Bühren', '0160/96029333', 'bayern'),
	('7', 'Kruse Ltd.', 'Am Stadion', '89123', 'München', '089/22457', 'gladbach');
/*!40000 ALTER TABLE `kunden` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
