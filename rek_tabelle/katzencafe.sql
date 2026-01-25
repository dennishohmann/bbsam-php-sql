-- Datenbank erstellen
CREATE DATABASE IF NOT EXISTS katzencafe;
USE katzencafe;

-- Tabelle für die Café-Katzen
CREATE TABLE katzen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    spezialitaet VARCHAR(100),
    taeglicher_unfug VARCHAR(200),
    kaffee_konsum INT
);

-- Die chaotische Belegschaft
INSERT INTO katzen (name, spezialitaet, taeglicher_unfug, kaffee_konsum) VALUES
('Herr Schnurrbert', 'Stühle zerstören', 'Schläft im Brotkorb', 3),
('Gräfin Flauschine', 'Gäste ignorieren', 'Wirft Zuckerstreuer vom Tisch', 0),
('Professor Maunz', 'Tastatur besetzen', 'Tippt Bestellungen um', 7),
('Sir Pfötchen III', 'Milch stehlen', 'Leckt heimlich die Sahne', 1),
('DJ Katzenklo', 'Um 3 Uhr nachts singen', 'Rennt grundlos durch den Raum', 12),
('Ninja Fellknäuel', 'Unsichtbar sein', 'Niemand weiß wo er ist', NULL),
('Baronin Zickzack', 'Beine umschleichen', 'Stolperfallen bauen', 2);