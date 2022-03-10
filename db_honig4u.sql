-- phpMyAdmin DB honig4u
-- Luca Roten

START TRANSACTION;

-- Create DB
CREATE DATABASE honig4u;
USE honig4u;

-- Tabelle für Kunden
CREATE TABLE `kunden` (
  `Kunden_ID` varchar(50) NOT NULL,
  `Kunden_Benutzername` varchar(50) NOT NULL,
  `Kunden_Passwort` varchar(255) NOT NULL,
  `Kunden_Name` varchar(50) DEFAULT NULL,
  `Kunden_Vorname` varchar(50) DEFAULT NULL,
  `IsAdmin` bit DEFAULT NULL
);

-- Testdaten für Kundentabelle
INSERT INTO `kunden` (`Kunden_ID`, `Kunden_Benutzername`, `Kunden_Passwort`, `Kunden_Name`, `Kunden_Vorname`, `IsAdmin`) VALUES
('1111', 'admin', '$2a$12$f2DnKctj7J2a1n0n9gGi1u0sgNrD/N0SlI7J3h7CgV77U0SadzXsC', 'Administrator', 'fred', 1), -- Password: admin
('2222', 'test', '$2a$12$wb94Styjq6tavhphZdyoKu9fYkYL5CH5i203bpxdswSpz7aoaAz5S', 'benu2', 'frodo', 0); -- Password: test

-- Tabelle für Produkte
CREATE TABLE `produkte` (
  `Produkt_ID` int(11) NOT NULL,
  `Produkt_Name` varchar(50) NOT NULL,
  `Produkt_Preis` double NOT NULL
);

-- Produkte 
INSERT INTO `produkte` (`Produkt_ID`, `Produkt_Name`, `Produkt_Preis`) VALUES
(1, 'Akazienhonig', 10),
(2, 'Heidehonig', 20),
(3, 'Kleehonig', 30),
(4, 'Tannenhonig', 40);

-- Tabelle für Bestellungen
CREATE TABLE `bestellungen` (
  `Bestell_ID` int(11) NOT NULL,
  `Bestell_Preis` double NOT NULL,
  `FK_Kunden_ID` varchar(50) NOT NULL
) ;

-- Testdaten für Bestelltabelle
INSERT INTO `bestellungen` (`Bestell_ID`, `Bestell_Preis`, `FK_Kunden_ID`) VALUES
(1, 10, '1111'),
(2, 20, '2222');

-- Tabelle für Bestellte Artikel
CREATE TABLE `bestellteArtikel` (
  `FK_Bestell_ID` int(11) NOT NULL,
  `FK_Produkt_ID` int(11) NOT NULL,
  `Anzahl` int NOT NULL
) ;


-- Keys

-- Kundentabelle
ALTER TABLE `kunden`
  ADD PRIMARY KEY (`Kunden_ID`);

-- Prouktetabelle
ALTER TABLE `produkte`
  ADD PRIMARY KEY (`Produkt_ID`);

-- Bestelltabelle
ALTER TABLE `bestellungen`
  ADD PRIMARY KEY (`Bestell_ID`),
  ADD KEY `FK_Kunden_ID` (`FK_Kunden_ID`);


-- Zufallszahlen generieren beim Einfügen von neuen Daten in die Tabellen:

-- "kunden" (Kunden_ID)
ALTER TABLE `kunden`
  MODIFY `Kunden_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- "bestellungen" (Bestell_ID)
ALTER TABLE `bestellungen`
  MODIFY `Bestell_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;