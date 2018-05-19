-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-7
-- http://www.phpmyadmin.net
-- 
-- Poèítaè: mysql.ic.cz
-- Vygenerováno: Nedìle 13. èervence 2008, 18:06
-- Verze MySQL: 4.10.0
-- Verze PHP: 5.2.0-8+etch11
-- 
-- Databáze: `ic_tsqm`
-- 

-- --------------------------------------------------------

-- 
-- Struktura tabulky `adamec`
-- 

CREATE TABLE `adamec` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `adamec`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `antosovska`
-- 

CREATE TABLE `antosovska` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `antosovska`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `babikova`
-- 

CREATE TABLE `babikova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `babikova`
-- 

INSERT INTO `babikova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('-', '-', '-', '-', 'Montag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('19.3.2008', '08:30', '14:30', '6', 'Mittwoch', '0', 'Babikova Katerina', 'babikova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('7.4.2008', '10:00', '15:00', '5', 'Montag', '0', 'Babikova Katerina', 'babikova', 'Sortieren', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('9.4.2008', '08:30', '14:30', '6', 'Mittwoch', '0', 'Babikova Katerina', 'babikova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('16.4.2008', '08:30', '14:30', '6', 'Mittwoch', '0', 'Babikova Katerina', 'babikova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('12.5.2008', '10:00', '13:00', '3', 'Montag', '0', 'Babikova Katerina', 'babikova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('21.5.2008', '07:00', '15:00', '8', 'Mittwoch', '0', 'Babikova Katerina', 'babikova', '', '5', '2008', '-', '-', ''),
('22.5.2008', '07:00', '15:00', '8', 'Donnerstag', '0', 'Babikova Katerina', 'babikova', '', '5', '2008', '-', '-', ''),
('23.5.2008', '07:00', '15:00', '8', 'Freitag', '0', 'Babikova Katerina', 'babikova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Babikova Katerina', 'babikova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `bartonikova`
-- 

CREATE TABLE `bartonikova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `bartonikova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `bazalova`
-- 

CREATE TABLE `bazalova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `bazalova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `bednarova`
-- 

CREATE TABLE `bednarova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `bednarova`
-- 

INSERT INTO `bednarova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '16:30', '20:00', '3.5', 'Montag', '0', 'Bednarova Tereza', 'bednarova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Dienstag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Mittwoch', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', NULL),
('13.3.2008', '14:00', '20:00', '6', 'Donnerstag', '0', 'Bednarova Tereza', 'bednarova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Freitag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('3.4.2008', '14:00', '20:00', '6', 'Donnerstag', '0', 'Bednarova Tereza', 'bednarova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('17.3.2008', '16:30', '21:30', '5', 'Montag', '0', 'Bednarova Tereza', 'bednarova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('19.3.2008', '16:30', '21:30', '5', 'Mittwoch', '0', 'Bednarova Tereza', 'bednarova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('31.3.2008', '16:30', '21:00', '4.5', 'Montag', '0', 'Bednarova Tereza', 'bednarova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('14.4.2008', '16:30', '21:00', '4.5', 'Montag', '0', 'Bednarova Tereza', 'bednarova', 'of eingabe', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('17.4.2008', '14:00', '20:30', '6.5', 'Donnerstag', '0', 'Bednarova Tereza', 'bednarova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('21.4.2008', '10:00', '20:00', '10', 'Montag', '0', 'Bednarova Tereza', 'bednarova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('24.4.2008', '14:00', '20:00', '6', 'Donnerstag', '0', 'Bednarova Tereza', 'bednarova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('28.4.2008', '16:30', '19:00', '2.5', 'Montag', '0', 'Bednarova Tereza', 'bednarova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('30.4.2008', '14:00', '17:30', '3.5', 'Mittwoch', '0', 'Bednarova Tereza', 'bednarova', '', '4', '2008', '-', '-', ''),
('1.5.2008', '10:00', '20:00', '10', 'Donnerstag', '0', 'Bednarova Tereza', 'bednarova', '', '5', '2008', '-', '-', ''),
('2.5.2008', '10:00', '20:00', '10', 'Freitag', '0', 'Bednarova Tereza', 'bednarova', '', '5', '2008', '-', '-', ''),
('3.5.2008', '10:00', '20:00', '10', 'Samstag', '0', 'Bednarova Tereza', 'bednarova', '', '5', '2008', '-', '-', ''),
('4.5.2008', '10:00', '20:00', '10', 'Sonntag', '0', 'Bednarova Tereza', 'bednarova', '', '5', '2008', '-', '-', ''),
('12.5.2008', '16:30', '20:00', '3.5', 'Montag', '0', 'Bednarova Tereza', 'bednarova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('16.5.2008', '14:00', '19:00', '5', 'Freitag', '0', 'Bednarova Tereza', 'bednarova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Bednarova Tereza', 'bednarova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `benesova`
-- 

CREATE TABLE `benesova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `benesova`
-- 

INSERT INTO `benesova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '16:15', '18:15', '2', 'Montag', '0', 'Benesova Kristyna', 'benesova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Dienstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', NULL),
('12.3.2008', '14:00', '16:30', '2.5', 'Mittwoch', '0', 'Benesova Kristyna', 'benesova', '', '3', '2008', '-', '-', NULL),
('13.3.2008', '14:00', '20:00', '6', 'Donnerstag', '0', 'Benesova Kristyna', 'benesova', '', '3', '2008', '-', '-', NULL),
('14.3.2008', '13:00', '17:00', '4', 'Freitag', '0', 'Benesova Kristyna', 'benesova', '', '3', '2008', '-', '-', NULL),
('15.3.2008', '10:00', '18:00', '8', 'Samstag', '0', 'Benesova Kristyna', 'benesova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', NULL),
('17.3.2008', '13:45', '18:00', '4.25', 'Montag', '0', 'Benesova Kristyna', 'benesova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('19.3.2008', '12:00', '16:45', '4.75', 'Mittwoch', '0', 'Benesova Kristyna', 'benesova', '', '3', '2008', '-', '-', ''),
('20.3.2008', '08:00', '13:00', '5', 'Donnerstag', '0', 'Benesova Kristyna', 'benesova', '', '3', '2008', '-', '-', ''),
('21.3.2008', '09:00', '17:00', '8', 'Freitag', '0', 'Benesova Kristyna', 'benesova', '', '3', '2008', '-', '-', ''),
('22.3.2008', '09:00', '17:00', '8', 'Samstag', '0', 'Benesova Kristyna', 'benesova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('27.3.2008', '14:00', '19:00', '5', 'Donnerstag', '0', 'Benesova Kristyna', 'benesova', '', '3', '2008', '-', '-', ''),
('28.3.2008', '10:00', '17:00', '7', 'Freitag', '0', 'Benesova Kristyna', 'benesova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('31.3.2008', '16:15', '18:45', '2.5', 'Montag', '0', 'Benesova Kristyna', 'benesova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('3.4.2008', '14:00', '19:00', '5', 'Donnerstag', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('4.4.2008', '14:00', '19:00', '5', 'Freitag', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('7.4.2008', '16:15', '18:45', '2.5', 'Montag', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('10.4.2008', '14:00', '20:00', '6', 'Donnerstag', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('11.4.2008', '14:00', '18:00', '4', 'Freitag', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('12.4.2008', '14:00', '18:00', '4', 'Samstag', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('14.4.2008', '14:45', '18:15', '3.5', 'Montag', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('16.4.2008', '14:00', '18:00', '4', 'Mittwoch', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('17.4.2008', '14:00', '19:00', '5', 'Donnerstag', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('18.4.2008', '14:00', '18:00', '4', 'Freitag', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('21.4.2008', '10:00', '17:00', '7', 'Montag', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('23.4.2008', '14:00', '17:45', '3.75', 'Mittwoch', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('24.4.2008', '08:00', '16:00', '8', 'Donnerstag', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('25.4.2008', '08:00', '17:45', '9.75', 'Freitag', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('29.4.2008', '15:30', '19:30', '4', 'Dienstag', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('30.4.2008', '12:30', '16:30', '4', 'Mittwoch', '0', 'Benesova Kristyna', 'benesova', '', '4', '2008', '-', '-', ''),
('1.5.2008', '13:30', '17:30', '4', 'Donnerstag', '0', 'Benesova Kristyna', 'benesova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('3.5.2008', '09:00', '17:00', '8', 'Samstag', '0', 'Benesova Kristyna', 'benesova', '', '5', '2008', '-', '-', ''),
('-', '09:00', '13:00', '4', 'Sonntag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('8.5.2008', '09:00', '17:00', '8', 'Donnerstag', '0', 'Benesova Kristyna', 'benesova', '', '5', '2008', '-', '-', ''),
('9.5.2008', '08:00', '17:00', '9', 'Freitag', '0', 'Benesova Kristyna', 'benesova', '', '5', '2008', '-', '-', ''),
('10.5.2008', '10:00', '17:00', '7', 'Samstag', '0', 'Benesova Kristyna', 'benesova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('17.5.2008', '08:00', '17:00', '9', 'Samstag', '0', 'Benesova Kristyna', 'benesova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('21.5.2008', '13:00', '19:00', '6', 'Mittwoch', '0', 'Benesova Kristyna', 'benesova', '', '5', '2008', '-', '-', ''),
('22.5.2008', '13:00', '20:00', '7', 'Donnerstag', '0', 'Benesova Kristyna', 'benesova', '', '5', '2008', '-', '-', ''),
('23.5.2008', '14:00', '19:00', '5', 'Freitag', '0', 'Benesova Kristyna', 'benesova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('26.5.2008', '13:00', '20:00', '7', 'Montag', '0', 'Benesova Kristyna', 'benesova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('28.5.2008', '08:00', '17:00', '9', 'Mittwoch', '0', 'Benesova Kristyna', 'benesova', '', '5', '2008', '-', '-', ''),
('29.5.2008', '08:00', '17:00', '9', 'Donnerstag', '0', 'Benesova Kristyna', 'benesova', '', '5', '2008', '-', '-', ''),
('30.5.2008', '14:00', '18:00', '4', 'Freitag', '0', 'Benesova Kristyna', 'benesova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Kristyna', 'benesova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `benesovapetra`
-- 

CREATE TABLE `benesovapetra` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `benesovapetra`
-- 

INSERT INTO `benesovapetra` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('-', '-', '-', '-', 'Montag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('1.4.2008', '14:00', '19:00', '5', 'Dienstag', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('3.4.2008', '16:00', '20:00', '4', 'Donnerstag', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('4.4.2008', '14:00', '19:00', '5', 'Freitag', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('8.4.2008', '14:00', '19:00', '5', 'Dienstag', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('9.4.2008', '14:30', '17:30', '3', 'Mittwoch', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('10.4.2008', '16:00', '19:00', '3', 'Donnerstag', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('11.4.2008', '13:00', '17:00', '4', 'Freitag', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('15.4.2008', '14:00', '17:00', '3', 'Dienstag', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('16.4.2008', '14:40', '17:40', '3', 'Mittwoch', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('17.4.2008', '16:00', '19:00', '3', 'Donnerstag', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('18.4.2008', '13:00', '18:00', '5', 'Freitag', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('21.4.2008', '10:00', '17:00', '7', 'Montag', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('22.4.2008', '14:00', '19:00', '5', 'Dienstag', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('23.4.2008', '14:40', '17:40', '3', 'Mittwoch', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('24.4.2008', '12:00', '14:00', '2', 'Donnerstag', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('25.4.2008', '12:45', '17:45', '5', 'Freitag', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('29.4.2008', '14:00', '19:00', '5', 'Dienstag', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('30.4.2008', '12:30', '16:30', '4', 'Mittwoch', '0', 'Benesova Petra', 'benesovapetra', '', '4', '2008', '-', '-', ''),
('1.5.2008', '09:15', '15:15', '6', 'Donnerstag', '0', 'Benesova Petra', 'benesovapetra', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('6.5.2008', '14:45', '18:45', '4', 'Dienstag', '0', 'Benesova Petra', 'benesovapetra', '', '5', '2008', '-', '-', ''),
('7.5.2008', '09:00', '16:00', '7', 'Mittwoch', '0', 'Benesova Petra', 'benesovapetra', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('20.05.2008', '13:00', '18:00', '5', 'Dienstag', '0', 'Benesova Petra', 'benesovapetra', '', '05', '2008', '-', '-', ''),
('21.05.2008', '13:00', '18:00', '5', 'Mittwoch', '0', 'Benesova Petra', 'benesovapetra', '', '05', '2008', '-', '-', ''),
('22.05.2008', '13:00', '18:00', '5', 'Donnerstag', '0', 'Benesova Petra', 'benesovapetra', '', '05', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('26.5.2008', '13:00', '18:00', '5', 'Montag', '0', 'Benesova Petra', 'benesovapetra', '', '5', '2008', '-', '-', ''),
('27.5.2008', '13:00', '18:00', '5', 'Dienstag', '0', 'Benesova Petra', 'benesovapetra', '', '5', '2008', '-', '-', ''),
('28.5.2008', '12:30', '17:30', '5', 'Mittwoch', '0', 'Benesova Petra', 'benesovapetra', '', '5', '2008', '-', '-', ''),
('29.5.2008', '13:00', '15:00', '2', 'Donnerstag', '0', 'Benesova Petra', 'benesovapetra', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '1', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('3.6.2008', '14:00', '19:00', '5', 'Dienstag', '1', 'Benesova Petra', 'benesovapetra', '', '6', '2008', '-', '-', ''),
('4.6.2008', '14:30', '17:30', '3', 'Mittwoch', '1', 'Benesova Petra', 'benesovapetra', '', '6', '2008', '-', '-', ''),
('5.6.2008', '11:00', '17:30', '6.5', 'Donnerstag', '1', 'Benesova Petra', 'benesovapetra', '', '6', '2008', '-', '-', ''),
('6.6.2008', '09:00', '16:00', '7', 'Freitag', '1', 'Benesova Petra', 'benesovapetra', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '1', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', 'Benesova Petra', 'benesovapetra', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `beusikova`
-- 

CREATE TABLE `beusikova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `beusikova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `bilkova`
-- 

CREATE TABLE `bilkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `bilkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `bilova`
-- 

CREATE TABLE `bilova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `bilova`
-- 

INSERT INTO `bilova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('-', '-', '-', '-', 'Montag', '0', 'Bilova Martina', 'bilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Bilova Martina', 'bilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Bilova Martina', 'bilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Bilova Martina', 'bilova', '', '', '', '-', '-', ''),
('28.3.2008', '13:00', '15:00', '2', 'Freitag', '0', 'Bilova Martina', 'bilova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Bilova Martina', 'bilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Bilova Martina', 'bilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Bilova Martina', 'bilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Bilova Martina', 'bilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Bilova Martina', 'bilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Bilova Martina', 'bilova', '', '', '', '-', '-', ''),
('9.5.2008', '07:30', '15:00', '7.5', 'Freitag', '0', 'Bilova Martina', 'bilova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Bilova Martina', 'bilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Bilova Martina', 'bilova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `bimova`
-- 

CREATE TABLE `bimova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `bimova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `blahoudkova`
-- 

CREATE TABLE `blahoudkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `blahoudkova`
-- 

INSERT INTO `blahoudkova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.03.2008', '08:00', '16:00', '8', 'Montag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '03', '2008', '-', '-', ''),
('11.03.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '03', '2008', '-', '-', ''),
('12.03.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '03', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '', '', '-', '-', ''),
('15.03.2008', '08:00', '16:00', '8', 'Samstag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '03', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '', '', '-', '-', ''),
('17.3.2008', '08:00', '16:00', '8', 'Montag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '3', '2008', '-', '-', ''),
('18.3.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '3', '2008', '-', '-', ''),
('19.3.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '3', '2008', '-', '-', ''),
('20.3.2008', '08:00', '16:00', '8', 'Donnerstag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '3', '2008', '-', '-', ''),
('21.3.2008', '08:00', '16:00', '8', 'Freitag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '3', '2008', '-', '-', ''),
('22.3.2008', '08:00', '16:00', '8', 'Samstag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '', '', '-', '-', ''),
('25.3.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '3', '2008', '-', '-', ''),
('26.3.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '3', '2008', '-', '-', ''),
('27.3.2008', '08:00', '16:00', '8', 'Donnerstag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '3', '2008', '-', '-', ''),
('28.3.2008', '08:00', '16:00', '8', 'Freitag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '3', '2008', '-', '-', ''),
('29.3.2008', '08:00', '16:00', '8', 'Samstag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '', '', '-', '-', ''),
('31.3.2008', '08:00', '16:00', '8', 'Montag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '', '', '-', '-', ''),
('2.4.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '', '', '-', '-', ''),
('5.4.2008', '08:00', '16:00', '8', 'Samstag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '', '', '-', '-', ''),
('28.4.2008', '08:00', '16:00', '8', 'Montag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '4', '2008', '-', '-', ''),
('29.4.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '4', '2008', '-', '-', ''),
('30.4.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Blahoudkova Sarka', 'blahoudkova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `brabencova`
-- 

CREATE TABLE `brabencova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `brabencova`
-- 

INSERT INTO `brabencova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('7.4.2008', '14:00', '18:00', '4', 'Montag', '0', 'Brabencova Klara', 'brabencova', '', '4', '2008', '-', '-', ''),
('8.4.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Brabencova Klara', 'brabencova', '', '4', '2008', '-', '-', ''),
('9.4.2008', '14:00', '18:00', '4', 'Mittwoch', '0', 'Brabencova Klara', 'brabencova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('14.4.2008', '14:00', '18:00', '4', 'Montag', '0', 'Brabencova Klara', 'brabencova', '', '4', '2008', '-', '-', ''),
('15.4.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Brabencova Klara', 'brabencova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('17.4.2008', '14:00', '18:00', '4', 'Donnerstag', '0', 'Brabencova Klara', 'brabencova', '', '4', '2008', '-', '-', ''),
('18.4.2008', '14:00', '18:00', '4', 'Freitag', '0', 'Brabencova Klara', 'brabencova', '', '4', '2008', '-', '-', ''),
('19.4.2008', '11:00', '18:00', '7', 'Samstag', '0', 'Brabencova Klara', 'brabencova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('21.4.2008', '14:00', '18:00', '4', 'Montag', '0', 'Brabencova Klara', 'brabencova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('24.4.2008', '14:00', '18:00', '4', 'Donnerstag', '0', 'Brabencova Klara', 'brabencova', '', '4', '2008', '-', '-', ''),
('25.4.2008', '14:00', '18:00', '4', 'Freitag', '0', 'Brabencova Klara', 'brabencova', '', '4', '2008', '-', '-', ''),
('26.4.2008', '09:00', '14:00', '5', 'Samstag', '0', 'Brabencova Klara', 'brabencova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('28.4.2008', '14:00', '18:00', '4', 'Montag', '0', 'Brabencova Klara', 'brabencova', '', '4', '2008', '-', '-', ''),
('29.4.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Brabencova Klara', 'brabencova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('1.5.2008', '09:00', '14:00', '5', 'Donnerstag', '0', 'Brabencova Klara', 'brabencova', '', '5', '2008', '-', '-', ''),
('2.5.2008', '14:00', '18:00', '4', 'Freitag', '0', 'Brabencova Klara', 'brabencova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('20.5.2008', '09:00', '17:00', '8', 'Dienstag', '0', 'Brabencova Klara', 'brabencova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('22.5.2008', '14:00', '18:00', '4', 'Donnerstag', '0', 'Brabencova Klara', 'brabencova', '', '5', '2008', '-', '-', ''),
('23.5.2008', '14:00', '18:00', '4', 'Freitag', '0', 'Brabencova Klara', 'brabencova', '', '5', '2008', '-', '-', ''),
('24.5.2008', '09:00', '15:00', '6', 'Samstag', '0', 'Brabencova Klara', 'brabencova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('26.5.2008', '14:00', '18:00', '4', 'Montag', '0', 'Brabencova Klara', 'brabencova', '', '5', '2008', '-', '-', ''),
('27.5.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Brabencova Klara', 'brabencova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', ''),
('29.5.2008', '14:00', '18:00', '4', 'Donnerstag', '0', 'Brabencova Klara', 'brabencova', '', '5', '2008', '-', '-', ''),
('30.5.2008', '14:00', '18:00', '4', 'Freitag', '0', 'Brabencova Klara', 'brabencova', '', '5', '2008', '-', '-', ''),
('31.5.2008', '09:00', '15:00', '6', 'Samstag', '0', 'Brabencova Klara', 'brabencova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brabencova Klara', 'brabencova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `bradlova`
-- 

CREATE TABLE `bradlova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `bradlova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `brakora`
-- 

CREATE TABLE `brakora` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `brakora`
-- 

INSERT INTO `brakora` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '15:00', '18:30', '3.5', 'Montag', '0', 'Brakora Marek', 'brakora', '', '3', '2008', '-', '-', NULL),
('11.3.2008', '14:00', '18:30', '4.5', 'Dienstag', '0', 'Brakora Marek', 'brakora', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Mittwoch', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', NULL),
('14.3.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Brakora Marek', 'brakora', '', '3', '2008', '-', '-', NULL),
('15.3.2008', '08:00', '18:00', '10', 'Samstag', '0', 'Brakora Marek', 'brakora', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', NULL),
('17.3.2008', '15:00', '18:30', '3.5', 'Montag', '0', 'Brakora Marek', 'brakora', '', '3', '2008', '-', '-', ''),
('18.3.2008', '14:00', '18:30', '4.5', 'Dienstag', '0', 'Brakora Marek', 'brakora', '', '3', '2008', '-', '-', ''),
('19.3.2008', '14:00', '16:30', '2.5', 'Mittwoch', '0', 'Brakora Marek', 'brakora', '', '3', '2008', '-', '-', ''),
('20.3.2008', '07:30', '16:30', '9', 'Donnerstag', '0', 'Brakora Marek', 'brakora', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('25.3.2008', '14:00', '16:30', '2.5', 'Dienstag', '0', 'Brakora Marek', 'brakora', '', '3', '2008', '-', '-', ''),
('26.3.2008', '14:00', '18:30', '4.5', 'Mittwoch', '0', 'Brakora Marek', 'brakora', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('28.3.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Brakora Marek', 'brakora', '', '3', '2008', '-', '-', ''),
('29.3.2008', '08:00', '14:30', '6.5', 'Samstag', '0', 'Brakora Marek', 'brakora', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('31.3.2008', '15:00', '18:30', '3.5', 'Montag', '0', 'Brakora Marek', 'brakora', '', '3', '2008', '-', '-', ''),
('1.4.2008', '14:00', '16:30', '2.5', 'Dienstag', '0', 'Brakora Marek', 'brakora', '', '4', '2008', '-', '-', ''),
('2.4.2008', '14:00', '18:30', '4.5', 'Mittwoch', '0', 'Brakora Marek', 'brakora', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('4.4.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Brakora Marek', 'brakora', '', '4', '2008', '-', '-', ''),
('5.4.2008', '08:00', '14:30', '6.5', 'Samstag', '0', 'Brakora Marek', 'brakora', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('7.4.2008', '15:00', '18:30', '3.5', 'Montag', '0', 'Brakora Marek', 'brakora', '', '4', '2008', '-', '-', ''),
('8.4.2008', '14:00', '16:30', '2.5', 'Dienstag', '0', 'Brakora Marek', 'brakora', '', '4', '2008', '-', '-', ''),
('9.4.2008', '14:00', '18:30', '4.5', 'Mittwoch', '0', 'Brakora Marek', 'brakora', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('11.4.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Brakora Marek', 'brakora', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('14.4.2008', '15:00', '18:30', '3.5', 'Montag', '0', 'Brakora Marek', 'brakora', '', '4', '2008', '-', '-', ''),
('15.4.2008', '14:00', '16:30', '2.5', 'Dienstag', '0', 'Brakora Marek', 'brakora', '', '4', '2008', '-', '-', ''),
('16.4.2008', '14:00', '16:30', '2.5', 'Mittwoch', '0', 'Brakora Marek', 'brakora', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('18.4.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Brakora Marek', 'brakora', '', '4', '2008', '-', '-', ''),
('19.4.2008', '08:00', '14:30', '6.5', 'Samstag', '0', 'Brakora Marek', 'brakora', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('29.4.2008', '14:00', '16:30', '2.5', 'Dienstag', '0', 'Brakora Marek', 'brakora', '', '4', '2008', '-', '-', ''),
('30.4.2008', '14:00', '16:30', '2.5', 'Mittwoch', '0', 'Brakora Marek', 'brakora', '', '4', '2008', '-', '-', ''),
('1.5.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('2.5.2008', '08:00', '18:30', '10.5', 'Freitag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('3.5.2008', '08:00', '14:30', '6.5', 'Samstag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('5.5.2008', '15:00', '16:30', '1.5', 'Montag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('8.5.2008', '07:30', '16:30', '9', 'Donnerstag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('9.5.2008', '07:30', '16:30', '9', 'Freitag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('10.5.2008', '08:00', '14:30', '6.5', 'Samstag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('12.5.2008', '15:00', '16:30', '1.5', 'Montag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('13.5.2008', '14:00', '16:30', '2.5', 'Dienstag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('14.5.2008', '14:00', '16:30', '2.5', 'Mittwoch', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('16.5.2008', '14:00', '16:30', '2.5', 'Freitag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('19.5.2008', '13:00', '16:30', '3.5', 'Montag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('20.5.2008', '13:00', '16:30', '3.5', 'Dienstag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('21.5.2008', '13:00', '16:30', '3.5', 'Mittwoch', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('22.5.2008', '13:00', '16:30', '3.5', 'Donnerstag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('23.5.2008', '13:00', '16:30', '3.5', 'Freitag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('24.5.2008', '08:00', '14:30', '6.5', 'Samstag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('26.5.2008', '13:00', '16:30', '3.5', 'Montag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('27.5.2008', '13:00', '16:30', '3.5', 'Dienstag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('28.5.2008', '13:00', '16:30', '3.5', 'Mittwoch', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('29.5.2008', '13:00', '16:30', '3.5', 'Donnerstag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('30.5.2008', '13:00', '16:30', '3.5', 'Freitag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('31.5.2008', '08:30', '14:30', '6', 'Samstag', '0', 'Brakora Marek', 'brakora', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '1', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('3.6.2008', '14:00', '16:30', '2.5', 'Dienstag', '1', 'Brakora Marek', 'brakora', '', '6', '2008', '-', '-', ''),
('4.6.2008', '14:00', '16:30', '2.5', 'Mittwoch', '1', 'Brakora Marek', 'brakora', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '1', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '1', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '1', 'Brakora Marek', 'brakora', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', 'Brakora Marek', 'brakora', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `brezinova`
-- 

CREATE TABLE `brezinova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `brezinova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `brychtova`
-- 

CREATE TABLE `brychtova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `brychtova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `budaiova`
-- 

CREATE TABLE `budaiova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `budaiova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `bystricka`
-- 

CREATE TABLE `bystricka` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `bystricka`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `camkala`
-- 

CREATE TABLE `camkala` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `camkala`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `cenovska`
-- 

CREATE TABLE `cenovska` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `cenovska`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `cerny`
-- 

CREATE TABLE `cerny` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `cerny`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `certkova`
-- 

CREATE TABLE `certkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `certkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `collak`
-- 

CREATE TABLE `collak` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `collak`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `ctibor`
-- 

CREATE TABLE `ctibor` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `ctibor`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `dedinska`
-- 

CREATE TABLE `dedinska` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `dedinska`
-- 

INSERT INTO `dedinska` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '08:00', '16:30', '8.5', 'Montag', '0', 'Dedinska Lucie', 'dedinska', '', '3', '2008', '-', '-', NULL),
('11.3.2008', '08:00', '16:30', '8.5', 'Dienstag', '0', 'Dedinska Lucie', 'dedinska', '', '3', '2008', '-', '-', NULL),
('12.3.2008', '08:00', '16:30', '8.5', 'Mittwoch', '0', 'Dedinska Lucie', 'dedinska', '', '3', '2008', '-', '-', NULL),
('13.3.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Dedinska Lucie', 'dedinska', '', '3', '2008', '-', '-', NULL),
('21.3.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Dedinska Lucie', 'dedinska', '', '3', '2008', '-', '-', ''),
('20.3.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Dedinska Lucie', 'dedinska', '', '3', '2008', '-', '-', ''),
('19.3.2008', '08:00', '16:30', '8.5', 'Mittwoch', '0', 'Dedinska Lucie', 'dedinska', '', '3', '2008', '-', '-', ''),
('18.3.2008', '08:00', '16:30', '8.5', 'Dienstag', '0', 'Dedinska Lucie', 'dedinska', '', '3', '2008', '-', '-', ''),
('14.3.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Dedinska Lucie', 'dedinska', '', '3', '2008', '-', '-', NULL),
('17.3.2008', '08:00', '16:30', '8.5', 'Montag', '0', 'Dedinska Lucie', 'dedinska', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('31.3.2008', '08:00', '16:30', '8.5', 'Montag', '0', 'Dedinska Lucie', 'dedinska', '', '3', '2008', '-', '-', ''),
('1.4.2008', '08:00', '16:30', '8.5', 'Dienstag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('2.4.2008', '08:00', '16:30', '8.5', 'Mittwoch', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('3.4.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('4.4.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('7.4.2008', '08:00', '16:30', '8.5', 'Montag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('8.4.2008', '08:00', '16:30', '8.5', 'Dienstag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('9.4.2008', '08:00', '16:30', '8.5', 'Mittwoch', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('10.4.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('11.4.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('14.4.2008', '08:00', '16:30', '8.5', 'Montag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('15.4.2008', '08:00', '16:30', '8.5', 'Dienstag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('16.4.2008', '08:00', '16:30', '8.5', 'Mittwoch', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('17.4.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('18.4.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('22.4.2008', '08:00', '16:30', '8.5', 'Dienstag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('23.4.2008', '08:00', '16:30', '8.5', 'Mittwoch', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('24.4.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('25.4.2008', '06:45', '14:45', '8', 'Freitag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('28.4.2008', '08:00', '16:30', '8.5', 'Montag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('29.4.2008', '08:00', '16:30', '8.5', 'Dienstag', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('30.4.2008', '08:00', '16:30', '8.5', 'Mittwoch', '0', 'Dedinska Lucie', 'dedinska', '', '4', '2008', '-', '-', ''),
('1.5.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('2.5.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('5.5.2008', '08:00', '16:30', '8.5', 'Montag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('6.5.2008', '08:00', '16:30', '8.5', 'Dienstag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('7.5.2008', '08:00', '16:30', '8.5', 'Mittwoch', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('8.5.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('9.5.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('13.5.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('14.5.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('16.5.2008', '08:00', '15:00', '7', 'Freitag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('19.5.2008', '08:00', '16:30', '8.5', 'Montag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('20.5.2008', '08:00', '16:30', '8.5', 'Dienstag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('21.5.2008', '08:00', '16:30', '8.5', 'Mittwoch', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('22.5.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('23.5.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('26.5.2008', '08:00', '16:30', '8.5', 'Montag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('27.5.2008', '08:00', '16:30', '8.5', 'Dienstag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('28.5.2008', '08:00', '16:30', '8.5', 'Mittwoch', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('29.5.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('30.5.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Dedinska Lucie', 'dedinska', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('2.6.2008', '08:00', '16:30', '8.5', 'Montag', '1', 'Dedinska Lucie', 'dedinska', '', '6', '2008', '-', '-', ''),
('3.6.2008', '08:00', '16:30', '8.5', 'Dienstag', '1', 'Dedinska Lucie', 'dedinska', '', '6', '2008', '-', '-', ''),
('4.6.2008', '08:00', '16:30', '8.5', 'Mittwoch', '1', 'Dedinska Lucie', 'dedinska', '', '6', '2008', '-', '-', ''),
('5.6.2008', '08:00', '16:30', '8.5', 'Donnerstag', '1', 'Dedinska Lucie', 'dedinska', '', '6', '2008', '-', '-', ''),
('6.6.2008', '08:00', '16:30', '8.5', 'Freitag', '1', 'Dedinska Lucie', 'dedinska', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '1', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', 'Dedinska Lucie', 'dedinska', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `devecka`
-- 

CREATE TABLE `devecka` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `devecka`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `dittrich`
-- 

CREATE TABLE `dittrich` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `dittrich`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `dlouha`
-- 

CREATE TABLE `dlouha` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `dlouha`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `dobesova`
-- 

CREATE TABLE `dobesova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `dobesova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `dokulilova`
-- 

CREATE TABLE `dokulilova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `dokulilova`
-- 

INSERT INTO `dokulilova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '15:00', '21:00', '6', 'Montag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '3', '2008', '-', '-', NULL),
('11.3.2008', '16:00', '20:00', '4', 'Dienstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '3', '2008', '-', '-', NULL),
('12.3.2008', '14:00', '17:30', '3.5', 'Mittwoch', '0', 'Dokulilova Vlasta', 'dokulilova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', NULL),
('14.3.2008', '10:00', '17:00', '7', 'Freitag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', NULL),
('17.3.2008', '15:00', '20:00', '5', 'Montag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('31.3.2008', '15:00', '20:00', '5', 'Montag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '3', '2008', '-', '-', ''),
('1.4.2008', '16:00', '18:00', '2', 'Dienstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '4', '2008', '-', '-', ''),
('2.4.2008', '14:00', '17:30', '3.5', 'Mittwoch', '0', 'Dokulilova Vlasta', 'dokulilova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('7.4.2008', '15:00', '20:00', '5', 'Montag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('9.4.2008', '14:00', '17:30', '3.5', 'Mittwoch', '0', 'Dokulilova Vlasta', 'dokulilova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('11.4.2008', '14:00', '18:00', '4', 'Freitag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('14.4.2008', '15:00', '20:00', '5', 'Montag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '4', '2008', '-', '-', ''),
('15.4.2008', '16:00', '20:00', '4', 'Dienstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '4', '2008', '-', '-', ''),
('16.4.2008', '14:00', '17:30', '3.5', 'Mittwoch', '0', 'Dokulilova Vlasta', 'dokulilova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('21.4.2008', '09:00', '17:00', '8', 'Montag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('23.4.2008', '14:00', '17:30', '3.5', 'Mittwoch', '0', 'Dokulilova Vlasta', 'dokulilova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('29.4.2008', '16:00', '20:00', '4', 'Dienstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('2.5.2008', '08:00', '16:00', '8', 'Freitag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('5.5.2008', '15:00', '18:00', '3', 'Montag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('20.5.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('22.5.2008', '16:00', '21:00', '5', 'Donnerstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('26.5.2008', '13:30', '19:30', '6', 'Montag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dokulilova Vlasta', 'dokulilova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `dubnicka`
-- 

CREATE TABLE `dubnicka` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `dubnicka`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `durda`
-- 

CREATE TABLE `durda` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `durda`
-- 

INSERT INTO `durda` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '16:15', '18:15', '2', 'Montag', '0', 'Durda Ondrej', 'durda', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Durda Ondrej', 'durda', '', '', '', '-', '-', ''),
('12.3.2008', '14:00', '17:00', '3', 'Mittwoch', '0', 'Durda Ondrej', 'durda', '', '3', '2008', '-', '-', ''),
('14.3.2008', '14:45', '16:45', '2', 'Donnerstag', '0', 'Durda Ondrej', 'durda', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Durda Ondrej', 'durda', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Durda Ondrej', 'durda', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Durda Ondrej', 'durda', '', '', '', '-', '-', ''),
('17.3.2008', '16:15', '18:15', '2', 'Montag', '0', 'Durda Ondrej', 'durda', '', '3', '2008', '-', '-', ''),
('18.3.2008', '14:00', '17:00', '3', 'Dienstag', '0', 'Durda Ondrej', 'durda', '', '3', '2008', '-', '-', ''),
('19.3.2008', '14:00', '16:30', '2.5', 'Mittwoch', '0', 'Durda Ondrej', 'durda', '', '3', '2008', '-', '-', ''),
('20.3.2008', '08:00', '12:00', '4', 'Donnerstag', '0', 'Durda Ondrej', 'durda', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Durda Ondrej', 'durda', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Durda Ondrej', 'durda', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Durda Ondrej', 'durda', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Durda Ondrej', 'durda', '', '', '', '-', '-', ''),
('25.3.2008', '14:00', '17:00', '3', 'Dienstag', '0', 'Durda Ondrej', 'durda', '', '3', '2008', '-', '-', ''),
('26.3.2008', '14:00', '17:00', '3', 'Mittwoch', '0', 'Durda Ondrej', 'durda', '', '3', '2008', '-', '-', ''),
('27.3.2008', '15:30', '17:30', '2', 'Donnerstag', '0', 'Durda Ondrej', 'durda', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Durda Ondrej', 'durda', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Durda Ondrej', 'durda', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Durda Ondrej', 'durda', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `dvorakova`
-- 

CREATE TABLE `dvorakova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `dvorakova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `feldova`
-- 

CREATE TABLE `feldova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `feldova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `fialova`
-- 

CREATE TABLE `fialova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `fialova`
-- 

INSERT INTO `fialova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('17.3.2008', '16:00', '20:00', '4', 'Montag', '0', 'Fialova Zuzana', 'fialova', '', '3', '2008', '-', '-', ''),
('18.3.2008', '16:00', '18:00', '2', 'Dienstag', '0', 'Fialova Zuzana', 'fialova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Fialova Zuzana', 'fialova', '', '', '', '-', '-', ''),
('20.3.2008', '16:00', '19:00', '3', 'Donnerstag', '0', 'Fialova Zuzana', 'fialova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Fialova Zuzana', 'fialova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Fialova Zuzana', 'fialova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Fialova Zuzana', 'fialova', '', '', '', '-', '-', ''),
('14.4.2008', '16:00', '20:00', '4', 'Montag', '0', 'Fialova Zuzana', 'fialova', '', '4', '2008', '-', '-', ''),
('15.4.2008', '14:00', '16:00', '2', 'Dienstag', '0', 'Fialova Zuzana', 'fialova', '', '4', '2008', '-', '-', ''),
('16.4.2008', '14:00', '15:00', '1', 'Mittwoch', '0', 'Fialova Zuzana', 'fialova', '', '4', '2008', '-', '-', ''),
('17.4.2008', '18:00', '20:00', '2', 'Donnerstag', '0', 'Fialova Zuzana', 'fialova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Fialova Zuzana', 'fialova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Fialova Zuzana', 'fialova', '', '', '', '-', '-', ''),
('20.4.2008', '08:00', '11:00', '3', 'Sonntag', '0', 'Fialova Zuzana', 'fialova', '', '4', '2008', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `filipova`
-- 

CREATE TABLE `filipova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `filipova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `flachvartova`
-- 

CREATE TABLE `flachvartova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `flachvartova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `florianova`
-- 

CREATE TABLE `florianova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `florianova`
-- 

INSERT INTO `florianova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('2.6.2008', '08:00', '16:00', '8', 'Montag', '1', 'Florianova Alena', 'florianova', '', '6', '2008', '-', '-', ''),
('3.6.2008', '08:00', '16:00', '8', 'Dienstag', '1', 'Florianova Alena', 'florianova', '', '6', '2008', '-', '-', ''),
('4.6.2008', '08:00', '16:00', '8', 'Mittwoch', '1', 'Florianova Alena', 'florianova', '', '6', '2008', '-', '-', ''),
('5.6.2008', '08:00', '16:00', '8', 'Donnerstag', '1', 'Florianova Alena', 'florianova', '', '6', '2008', '-', '-', ''),
('6.6.2008', '08:00', '16:00', '8', 'Freitag', '1', 'Florianova Alena', 'florianova', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '1', 'Florianova Alena', 'florianova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', 'Florianova Alena', 'florianova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `forman`
-- 

CREATE TABLE `forman` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `forman`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `frystak`
-- 

CREATE TABLE `frystak` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `frystak`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `fucikova`
-- 

CREATE TABLE `fucikova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `fucikova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `georgova`
-- 

CREATE TABLE `georgova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `georgova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `glac`
-- 

CREATE TABLE `glac` (
  `datum` varchar(10) collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) collate cp1250_czech_cs default NULL,
  `im` varchar(2) collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1250 COLLATE=cp1250_czech_cs;

-- 
-- Vypisuji data pro tabulku `glac`
-- 

INSERT INTO `glac` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '16:00', '20:00', '4', 'Montag', '0', 'Glac Martin', 'glac', '', '3', '2008', '-', '-', NULL),
('11.3.2008', '16:00', '20:00', '4', 'Dienstag', '0', 'Glac Martin', 'glac', '', '3', '2008', '-', '-', NULL),
('12.3.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Glac Martin', 'glac', '', '3', '2008', '-', '-', NULL),
('13.3.2008', '16:00', '20:00', '4', 'Donnerstag', '0', 'Glac Martin', 'glac', '', '3', '2008', '-', '-', NULL),
('14.3.2008', '13:00', '16:30', '3.5', 'Freitag', '0', 'Glac Martin', 'glac', '', '3', '2008', '-', '-', NULL),
('15.3.2008', '16:00', '20:00', '4', 'Samstag', '0', 'Glac Martin', 'glac', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', NULL),
('17.3.2008', '14:00', '16:30', '2.5', 'Montag', '0', 'Glac Martin', 'glac', '', '3', '2008', '-', '-', ''),
('18.3.2008', '16:00', '20:00', '4', 'Dienstag', '0', 'Glac Martin', 'glac', '', '3', '2008', '-', '-', ''),
('19.3.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Glac Martin', 'glac', '', '3', '2008', '-', '-', ''),
('20.3.2008', '7:30', '11:30', '4', 'Donnerstag', '0', 'Glac Martin', 'glac', '', '3', '2008', '-', '-', ''),
('21.3.2008', '16:00', '20:00', '4', 'Freitag', '0', 'Glac Martin', 'glac', '', '3', '2008', '-', '-', ''),
('22.3.2008', '16:00', '20:00', '4', 'Samstag', '0', 'Glac Martin', 'glac', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', ''),
('25.3.2008', '14:30', '16:30', '2', 'Dienstag', '0', 'Glac Martin', 'glac', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', ''),
('27.3.2008', '14:30', '16:30', '2', 'Donnerstag', '0', 'Glac Martin', 'glac', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', ''),
('7.4.2008', '14:00', '16:30', '2.5', 'Montag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('8.4.2008', '16:00', '20:00', '4', 'Dienstag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('9.4.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('10.4.2008', '14:00', '16:30', '2.5', 'Donnerstag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('11.4.2008', '16:00', '20:00', '4', 'Freitag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('12.4.2008', '16:00', '20:00', '4', 'Samstag', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', ''),
('31.3.2008', '14:00', '16:30', '2.5', 'Montag', '0', 'Glac Martin', 'glac', '', '3', '2008', '-', '-', ''),
('1.4.2008', '16:00', '20:00', '4', 'Dienstag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('2.4.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('3.4.2008', '14:00', '16:30', '2.5', 'Donnerstag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('4.4.2008', '16:00', '20:00', '4', 'Freitag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('5.4.2008', '16:00', '20:00', '4', 'Samstag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', ''),
('14.4.2008', '13:30', '14:30', '1', 'Montag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('15.4.2008', '18:00', '20:00', '2', 'Dienstag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('16.4.2008', '18:00', '20:00', '2', 'Mittwoch', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('17.4.2008', '14:30', '16:30', '2', 'Donnerstag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('18.4.2008', '18:00', '20:00', '2', 'Freitag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('19.4.2008', '18:00', '20:00', '2', 'Samstag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', ''),
('21.4.2008', '16:00', '20:00', '4', 'Montag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('22.4.2008', '14:30', '16:30', '2', 'Dienstag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('23.4.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('24.4.2008', '14:30', '16:30', '2', 'Donnerstag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('25.4.2008', '16:00', '20:00', '4', 'Freitag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('26.4.2008', '16:00', '20:00', '4', 'Samstag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', ''),
('28.4.2008', '13:30', '16:30', '2', 'Montag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('29.4.2008', '16:00', '20:00', '4', 'Dienstag', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('30.4.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Glac Martin', 'glac', '', '4', '2008', '-', '-', ''),
('1.5.2008', '07:30', '11:30', '4', 'Donnerstag', '0', 'Glac Martin', 'glac', '', '5', '2008', '-', '-', ''),
('2.5.2008', '16:00', '20:00', '4', 'Freitag', '0', 'Glac Martin', 'glac', '', '5', '2008', '-', '-', ''),
('3.5.2008', '16:00', '20:00', '4', 'Samstag', '0', 'Glac Martin', 'glac', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', ''),
('5.5.2008', '16:00', '20:00', '4', 'Montag', '0', 'Glac Martin', 'glac', '', '5', '2008', '-', '-', ''),
('6.5.2008', '13:30', '16:30', '3', 'Dienstag', '0', 'Glac Martin', 'glac', '', '5', '2008', '-', '-', ''),
('7.5.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Glac Martin', 'glac', '', '5', '2008', '-', '-', ''),
('8.5.2008', '16:00', '20:00', '4', 'Donnerstag', '0', 'Glac Martin', 'glac', '', '5', '2008', '-', '-', ''),
('9.5.2008', '16:00', '20:00', '4', 'Freitag', '0', 'Glac Martin', 'glac', '', '5', '2008', '-', '-', ''),
('10.5.2008', '16:00', '20:00', '4', 'Samstag', '0', 'Glac Martin', 'glac', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', ''),
('12.5.2008', '16:00', '20:00', '4', 'Montag', '0', 'Glac Martin', 'glac', '', '5', '2008', '-', '-', ''),
('13.5.2008', '14:30', '16:30', '2', 'Dienstag', '0', 'Glac Martin', 'glac', '', '5', '2008', '-', '-', ''),
('14.5.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Glac Martin', 'glac', '', '5', '2008', '-', '-', ''),
('15.5.2008', '14:30', '16:30', '2', 'Donnerstag', '0', 'Glac Martin', 'glac', '', '5', '2008', '-', '-', ''),
('16.5.2008', '16:00', '20:00', '4', 'Freitag', '0', 'Glac Martin', 'glac', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Glac Martin', 'glac', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `gyarfasova`
-- 

CREATE TABLE `gyarfasova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `gyarfasova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `hamor`
-- 

CREATE TABLE `hamor` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `hamor`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `hapova`
-- 

CREATE TABLE `hapova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `hapova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `havelka`
-- 

CREATE TABLE `havelka` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `havelka`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `havran`
-- 

CREATE TABLE `havran` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `havran`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `hayek`
-- 

CREATE TABLE `hayek` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `hayek`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `helova`
-- 

CREATE TABLE `helova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `helova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `herout`
-- 

CREATE TABLE `herout` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `herout`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `holcova`
-- 

CREATE TABLE `holcova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `holcova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `holeckova`
-- 

CREATE TABLE `holeckova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `holeckova`
-- 

INSERT INTO `holeckova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '14:45', '17:45', '3', 'Montag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', NULL),
('11.3.2008', '13:45', '18:45', '5', 'Dienstag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Mittwoch', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', NULL),
('14.3.2008', '13:00', '17:30', '4.5', 'Freitag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', NULL),
('15.3.2008', '08:00', '18:00', '10', 'Samstag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', NULL),
('16.3.2008', '09:00', '14:00', '5', 'Sonntag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', NULL),
('17.3.2008', '13:00', '17:30', '4.5', 'Montag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', ''),
('18.3.2008', '14:00', '17:30', '3.5', 'Dienstag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('20.3.2008', '09:00', '17:00', '8', 'Donnerstag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', ''),
('21.3.2008', '09:00', '17:00', '8', 'Freitag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', ''),
('22.3.2008', '10:00', '16:00', '6', 'Samstag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('24.3.2008', '08:00', '16:00', '8', 'Montag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', ''),
('25.3.2008', '14:00', '17:30', '3.5', 'Dienstag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('27.3.2008', '16:00', '18:30', '2.5', 'Donnerstag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('29.3.2008', '08:00', '16:00', '8', 'Samstag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', ''),
('30.3.2008', '09:00', '14:00', '5', 'Sonntag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', ''),
('31.3.2008', '13:00', '17:30', '4.5', 'Montag', '0', 'Holeckova Veronika', 'holeckova', '', '3', '2008', '-', '-', ''),
('1.4.2008', '14:00', '17:30', '3.5', 'Dienstag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('4.4.2008', '13:00', '17:30', '4.5', 'Freitag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('5.4.2008', '08:00', '17:00', '9', 'Samstag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('6.4.2008', '09:00', '14:00', '5', 'Sonntag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('7.4.2008', '13:00', '17:30', '4.5', 'Montag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('8.4.2008', '14:00', '17:30', '3.5', 'Dienstag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('12.4.2008', '10:00', '17:00', '7', 'Samstag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('13.4.2008', '09:00', '14:00', '5', 'Sonntag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('14.4.2008', '14:30', '17:30', '3', 'Montag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('15.4.2008', '14:00', '17:30', '3.5', 'Dienstag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('18.4.2008', '10:00', '17:00', '7', 'Freitag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('19.4.2008', '09:00', '16:00', '7', 'Samstag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('21.4.2008', '08:00', '17:30', '9.5', 'Montag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('24.4.2008', '16:00', '18:30', '2.5', 'Donnerstag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('25.4.2008', '13:00', '17:00', '4', 'Freitag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('26.4.2008', '08:00', '13:00', '5', 'Samstag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('29.4.2008', '14:00', '18:30', '4.5', 'Dienstag', '0', 'Holeckova Veronika', 'holeckova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('2.5.2008', '08:00', '17:00', '9', 'Freitag', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('3.5.2008', '08:00', '16:00', '8', 'Samstag', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('5.5.2008', '13:00', '18:00', '5', 'Montag', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('6.5.2008', '08:00', '14:00', '6', 'Dienstag', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('7.5.2008', '08:00', '14:00', '6', 'Mittwoch', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('11.5.2008', '09:00', '13:00', '4', 'Sonntag', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('17.5.2008', '08:00', '16:00', '8', 'Samstag', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('18.5.2008', '09:00', '13:00', '4', 'Sonntag', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('19.5.2008', '13:00', '18:00', '5', 'Montag', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('20.5.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('21.5.2008', '13:00', '16:30', '3.5', 'Mittwoch', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('22.5.2008', '13:00', '16:00', '3', 'Donnerstag', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('23.5.2008', '13:00', '17:00', '4', 'Freitag', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('26.5.2008', '13:00', '18:00', '5', 'Montag', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('28.5.2008', '13:00', '18:00', '5', 'Mittwoch', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('29.5.2008', '13:00', '18:00', '5', 'Donnerstag', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('30.5.2008', '-', '-', '-', 'Freitag', '0', 'Holeckova Veronika', 'holeckova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '1', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '1', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '1', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '1', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('6.6.2008', '13:00', '16:00', '3', 'Freitag', '1', 'Holeckova Veronika', 'holeckova', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '1', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', 'Holeckova Veronika', 'holeckova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `homolkova`
-- 

CREATE TABLE `homolkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `homolkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `horacek`
-- 

CREATE TABLE `horacek` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `horacek`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `hudakova`
-- 

CREATE TABLE `hudakova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `hudakova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `hyblerova`
-- 

CREATE TABLE `hyblerova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `hyblerova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `janickova`
-- 

CREATE TABLE `janickova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `janickova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `janosikova`
-- 

CREATE TABLE `janosikova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `janosikova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `jelinkova`
-- 

CREATE TABLE `jelinkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `jelinkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `jezkova`
-- 

CREATE TABLE `jezkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `jezkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `jirikovsky`
-- 

CREATE TABLE `jirikovsky` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `jirikovsky`
-- 

INSERT INTO `jirikovsky` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('19.5.2008', '14:00', '18:00', '4', 'Montag', '0', 'Jirikovsky Lukas', 'jirikovsky', '', '5', '2008', '-', '-', ''),
('20.5.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Jirikovsky Lukas', 'jirikovsky', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Jirikovsky Lukas', 'jirikovsky', '', '', '', '-', '-', ''),
('22.5.2008', '15:00', '18:00', '3', 'Donnerstag', '0', 'Jirikovsky Lukas', 'jirikovsky', '', '5', '2008', '-', '-', ''),
('23.5.2008', '14:00', '18:00', '4', 'Freitag', '0', 'Jirikovsky Lukas', 'jirikovsky', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Jirikovsky Lukas', 'jirikovsky', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Jirikovsky Lukas', 'jirikovsky', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `jouklova`
-- 

CREATE TABLE `jouklova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `jouklova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `juhanakova`
-- 

CREATE TABLE `juhanakova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `juhanakova`
-- 

INSERT INTO `juhanakova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('-', '-', '-', '-', 'Montag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('19.3.2008', '14:30', '18:30', '4', 'Mittwoch', '0', 'Juhanakova Eva', 'juhanakova', '', '3', '2008', '-', '-', ''),
('20.3.2008', '09:00', '16:30', '7.5', 'Donnerstag', '0', 'Juhanakova Eva', 'juhanakova', '', '3', '2008', '-', '-', ''),
('21.3.2008', '09:00', '16:30', '7.5', 'Freitag', '0', 'Juhanakova Eva', 'juhanakova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('24.3.2008', '16:00', '18:30', '2.5', 'Montag', '0', 'Juhanakova Eva', 'juhanakova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Juhanakova Eva', 'juhanakova', '', '-', '-', '-', '-', ''),
('28.3.2008', '13:00', '18:30', '5.5', 'Freitag', '0', 'Juhanakova Eva', 'juhanakova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('3.4.2008', '16:00', '18:30', '2.5', 'Donnerstag', '0', 'Juhanakova Eva', 'juhanakova', '', '4', '2008', '-', '-', ''),
('4.4.2008', '13:00', '18:30', '5.5', 'Freitag', '0', 'Juhanakova Eva', 'juhanakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('10.4.2008', '14:00', '18:30', '4.5', 'Donnerstag', '0', 'Juhanakova Eva', 'juhanakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('14.4.2008', '16:00', '18:30', '2.5', 'Montag', '0', 'Juhanakova Eva', 'juhanakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('16.4.2008', '14:30', '16:30', '2', 'Mittwoch', '0', 'Juhanakova Eva', 'juhanakova', '', '4', '2008', '-', '-', ''),
('17.4.2008', '16:00', '18:30', '2.5', 'Donnerstag', '0', 'Juhanakova Eva', 'juhanakova', '', '4', '2008', '-', '-', ''),
('18.4.2008', '10:00', '18:30', '8.5', 'Freitag', '0', 'Juhanakova Eva', 'juhanakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('21.4.2008', '10:15', '16:30', '6.25', 'Montag', '0', 'Juhanakova Eva', 'juhanakova', '', '4', '2008', '-', '-', ''),
('22.4.2008', '13:30', '17:30', '4', 'Dienstag', '0', 'Juhanakova Eva', 'juhanakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('24.4.2008', '12:00', '18:30', '6.5', 'Donnerstag', '0', 'Juhanakova Eva', 'juhanakova', '', '4', '2008', '-', '-', ''),
('25.4.2008', '12:45', '16:30', '3.75', 'Freitag', '0', 'Juhanakova Eva', 'juhanakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('30.4.2008', '14:30', '16:30', '2', 'Mittwoch', '0', 'Juhanakova Eva', 'juhanakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('2.5.2008', '09:00', '16:30', '7.5', 'Freitag', '0', 'Juhanakova Eva', 'juhanakova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('5.5.2008', '16:00', '18:30', '2.5', 'Montag', '0', 'Juhanakova Eva', 'juhanakova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('9.5.2008', '09:00', '16:30', '7.5', 'Freitag', '0', 'Juhanakova Eva', 'juhanakova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('26.5.2008', '13:00', '16:30', '3.5', 'Montag', '0', 'Juhanakova Eva', 'juhanakova', '', '5', '2008', '-', '-', ''),
('27.5.2008', '13:00', '01:00', '-336539', 'Dienstag', '0', 'Juhanakova Eva', 'juhanakova', '', '5', '2008', '-', '-', ''),
('28.5.2008', '13:00', '16:30', '3.5', 'Mittwoch', '0', 'Juhanakova Eva', 'juhanakova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('30.5.2008', '13:00', '18:30', '5.5', 'Freitag', '0', 'Juhanakova Eva', 'juhanakova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '1', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '1', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '1', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('5.6.2008', '13:00', '18:30', '5.5', 'Donnerstag', '1', 'Juhanakova Eva', 'juhanakova', '', '6', '2008', '-', '-', ''),
('6.6.2008', '13:00', '14:00', '1', 'Freitag', '1', 'Juhanakova Eva', 'juhanakova', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '1', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', 'Juhanakova Eva', 'juhanakova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `jurankova`
-- 

CREATE TABLE `jurankova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `jurankova`
-- 

INSERT INTO `jurankova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('-', '-', '-', '-', 'Montag', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', ''),
('28.3.2008', '13:00', '17:30', '4.5', 'Freitag', '0', 'Jurankova Zaneta', 'jurankova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', ''),
('9.5.2008', '10:00', '18:00', '8', 'Freitag', '0', 'Jurankova Zaneta', 'jurankova', '', '5', '2008', '-', '-', ''),
('10.5.2008', '10:00', '18:00', '8', 'Samstag', '0', 'Jurankova Zaneta', 'jurankova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', ''),
('23.5.2008', '13:00', '19:00', '6', 'Freitag', '0', 'Jurankova Zaneta', 'jurankova', '', '5', '2008', '-', '-', ''),
('24.5.2008', '10:00', '18:00', '8', 'Samstag', '0', 'Jurankova Zaneta', 'jurankova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Jurankova Zaneta', 'jurankova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `jurkova`
-- 

CREATE TABLE `jurkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `jurkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `kachynova`
-- 

CREATE TABLE `kachynova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kachynova`
-- 

INSERT INTO `kachynova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '16:30', '18:30', '2', 'Montag', '0', 'Kachynova Katerina', 'kachynova', '', '3', '2008', '-', '-', NULL),
('11.3.2008', '14:30', '17:30', '3', 'Dienstag', '0', 'Kachynova Katerina', 'kachynova', '', '3', '2008', '-', '-', NULL),
('12.3.2008', '15:00', '17:30', '2.5', 'Mittwoch', '0', 'Kachynova Katerina', 'kachynova', '', '3', '2008', '-', '-', NULL),
('13.3.2008', '14:30', '17:30', '3', 'Donnerstag', '0', 'Kachynova Katerina', 'kachynova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Freitag', '0', 'Kachynova Katerina', 'kachynova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Kachynova Katerina', 'kachynova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Kachynova Katerina', 'kachynova', '', '', '', '-', '-', NULL),
('17.3.2008', '16:30', '19:00', '2.5', 'Montag', '0', 'Kachynova Katerina', 'kachynova', '', '3', '2008', '-', '-', ''),
('18.3.2008', '16:00', '19:00', '3', 'Dienstag', '0', 'Kachynova Katerina', 'kachynova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Kachynova Katerina', 'kachynova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Kachynova Katerina', 'kachynova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Kachynova Katerina', 'kachynova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kachynova Katerina', 'kachynova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kachynova Katerina', 'kachynova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `karalupova`
-- 

CREATE TABLE `karalupova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `karalupova`
-- 

INSERT INTO `karalupova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '06:45', '14:45', '8', 'Montag', '0', 'Karalupova Jana', 'karalupova', '', '3', '2008', '-', '-', ''),
('11.3.2008', '06:45', '14:45', '8', 'Dienstag', '0', 'Karalupova Jana', 'karalupova', '', '3', '2008', '-', '-', NULL),
('12.3.2008', '06:45', '14:45', '8', 'Mittwoch', '0', 'Karalupova Jana', 'karalupova', '', '3', '2008', '-', '-', NULL),
('13.3.2008', '06:45', '14:45', '8', 'Donnerstag', '0', 'Karalupova Jana', 'karalupova', '', '3', '2008', '-', '-', NULL),
('14.3.2008', '06:45', '14:45', '8', 'Freitag', '0', 'Karalupova Jana', 'karalupova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', NULL),
('17.3.2008', '06:45', '15:45', '9', 'Montag', '0', 'Karalupova Jana', 'karalupova', '', '3', '2008', '-', '-', ''),
('18.3.2008', '06:45', '15:45', '9', 'Dienstag', '0', 'Karalupova Jana', 'karalupova', '', '3', '2008', '-', '-', ''),
('19.3.2008', '06:45', '14:45', '8', 'Mittwoch', '0', 'Karalupova Jana', 'karalupova', '', '3', '2008', '-', '-', ''),
('20.3.2008', '06:45', '14:45', '8', 'Donnerstag', '0', 'Karalupova Jana', 'karalupova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('31.3.2008', '06:45', '14:45', '8', 'Montag', '0', 'Karalupova Jana', 'karalupova', '', '3', '2008', '-', '-', ''),
('1.4.2008', '06:45', '14:45', '8', 'Dienstag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('2.4.2008', '06:45', '14:45', '8', 'Mittwoch', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('3.4.2008', '06:45', '14:45', '8', 'Donnerstag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('4.4.2008', '06:45', '14:45', '8', 'Freitag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('7.4.2008', '06:45', '14:45', '8', 'Montag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('8.4.2008', '06:45', '14:45', '8', 'Dienstag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('9.4.2008', '06:45', '14:45', '8', 'Mittwoch', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('10.4.2008', '06:45', '14:45', '8', 'Donnerstag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('11.4.2008', '06:45', '14:45', '8', 'Freitag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('14.4.2008', '06:45', '14:45', '8', 'Montag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('15.4.2008', '06:45', '14:45', '8', 'Dienstag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('16.4.2008', '06:45', '14:45', '8', 'Mittwoch', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('17.4.2008', '06:45', '14:45', '8', 'Donnerstag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('18.4.2008', '06:45', '14:45', '8', 'Freitag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('21.4.2008', '06:45', '14:45', '8', 'Montag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('22.4.2008', '06:45', '14:45', '8', 'Dienstag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('23.4.2008', '06:45', '14:45', '8', 'Mittwoch', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('24.4.2008', '06:45', '14:45', '8', 'Donnerstag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('25.4.2008', '06:45', '14:45', '8', 'Freitag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('28.4.2008', '06:45', '13:45', '7', 'Montag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('29.4.2008', '06:45', '14:45', '8', 'Dienstag', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('30.4.2008', '06:45', '14:45', '8', 'Mittwoch', '0', 'Karalupova Jana', 'karalupova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('5.5.2008', '06:45', '14:45', '8', 'Montag', '0', 'Karalupova Jana', 'karalupova', '', '5', '2008', '-', '-', ''),
('6.5.2008', '06:45', '14:45', '8', 'Dienstag', '0', 'Karalupova Jana', 'karalupova', '', '5', '2008', '-', '-', ''),
('7.5.2008', '06:45', '14:45', '8', 'Mittwoch', '0', 'Karalupova Jana', 'karalupova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('12.5.2008', '06:45', '14:45', '8', 'Montag', '0', 'Karalupova Jana', 'karalupova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('14.5.2008', '06:45', '07:45', '6.25', 'Mittwoch', '0', 'Karalupova Jana', 'karalupova', '', '5', '2008', '10:30', '15:45', ''),
('15.5.2008', '06:45', '14:45', '8', 'Donnerstag', '0', 'Karalupova Jana', 'karalupova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('19.5.2008', '06:45', '14:45', '8', 'Montag', '0', 'Karalupova Jana', 'karalupova', '', '5', '2008', '-', '-', ''),
('20.5.2008', '06:45', '14:45', '8', 'Dienstag', '0', 'Karalupova Jana', 'karalupova', '', '5', '2008', '-', '-', ''),
('21.5.2008', '06:45', '14:45', '8', 'Mittwoch', '0', 'Karalupova Jana', 'karalupova', '', '5', '2008', '-', '-', ''),
('22.5.2008', '06:45', '14:45', '8', 'Donnerstag', '0', 'Karalupova Jana', 'karalupova', '', '5', '2008', '-', '-', ''),
('23.5.2008', '06:45', '14:45', '8', 'Freitag', '0', 'Karalupova Jana', 'karalupova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('27.5.2008', '06:45', '14:45', '8', 'Dienstag', '0', 'Karalupova Jana', 'karalupova', '', '5', '2008', '-', '-', ''),
('28.5.2008', '06:45', '14:45', '8', 'Mittwoch', '0', 'Karalupova Jana', 'karalupova', '', '5', '2008', '-', '-', ''),
('29.5.2008', '06:45', '14:45', '8', 'Donnerstag', '0', 'Karalupova Jana', 'karalupova', '', '5', '2008', '-', '-', ''),
('30.5.2008', '06:45', '14:45', '8', 'Freitag', '0', 'Karalupova Jana', 'karalupova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('2.6.2008', '06:45', '14:45', '8', 'Montag', '1', 'Karalupova Jana', 'karalupova', '', '6', '2008', '-', '-', ''),
('3.6.2008', '06:45', '14:45', '8', 'Dienstag', '1', 'Karalupova Jana', 'karalupova', '', '6', '2008', '-', '-', ''),
('4.6.2008', '06:45', '14:45', '8', 'Mittwoch', '1', 'Karalupova Jana', 'karalupova', '', '6', '2008', '-', '-', ''),
('5.6.2008', '06:45', '14:45', '8', 'Donnerstag', '1', 'Karalupova Jana', 'karalupova', '', '6', '2008', '-', '-', ''),
('6.6.2008', '06:45', '14:45', '8', 'Freitag', '1', 'Karalupova Jana', 'karalupova', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '1', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', 'Karalupova Jana', 'karalupova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `kasalovaiveta`
-- 

CREATE TABLE `kasalovaiveta` (
  `datum` varchar(10) collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) collate cp1250_czech_cs NOT NULL,
  `den` varchar(30) collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) collate cp1250_czech_cs default NULL,
  `im` varchar(2) collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1250 COLLATE=cp1250_czech_cs;

-- 
-- Vypisuji data pro tabulku `kasalovaiveta`
-- 

INSERT INTO `kasalovaiveta` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '08:00', '16:00', '8', 'Montag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Mittwoch', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Freitag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '', '', '-', '-', NULL),
('17.3.2008', '08:00', '16:00', '8', 'Montag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '', '', '-', '-', NULL),
('21.3.2008', '08:00', '16:00', '8', 'Freitag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '3', '2008', '-', '-', ''),
('11.3.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '3', '2008', '-', '-', NULL),
('20.3.2008', '08:00', '16:00', '8', 'Donnerstag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '3', '2008', '-', '-', ''),
('15.3.2008', '08:00', '16:00', '8', 'Samstag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '3', '2008', '-', '-', NULL),
('19.3.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '3', '2008', '-', '-', ''),
('18.3.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '', '', '-', '-', ''),
('24.3.2008', '08:00', '16:00', '8', 'Montag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '3', '2008', '-', '-', ''),
('25.3.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '3', '2008', '-', '-', ''),
('26.3.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '3', '2008', '-', '-', ''),
('27.3.2008', '08:00', '16:00', '8', 'Donnerstag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '3', '2008', '-', '-', ''),
('28.3.2008', '08:00', '16:00', '8', 'Freitag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '', '', '-', '-', ''),
('14.4.2008', '08:00', '16:00', '8', 'Montag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '4', '2008', '-', '-', ''),
('15.4.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '4', '2008', '-', '-', ''),
('16.4.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '', '', '-', '-', ''),
('19.4.2008', '08:00', '16:00', '8', 'Samstag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kasalova Iveta', 'kasalovaiveta', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `kasalovazuzana`
-- 

CREATE TABLE `kasalovazuzana` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kasalovazuzana`
-- 

INSERT INTO `kasalovazuzana` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '16:15', '18:00', '1.75', 'Montag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '3', '2008', '-', '-', NULL),
('11.3.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '3', '2008', '-', '-', NULL),
('12.3.2008', '16:30', '18:00', '1.5', 'Mittwoch', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', NULL),
('14.3.2008', '13:00', '18:00', '5', 'Freitag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', NULL),
('17.3.2008', '16:30', '18:00', '1.5', 'Montag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '3', '2008', '-', '-', ''),
('18.3.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '3', '2008', '-', '-', ''),
('19.3.2008', '16:30', '18:00', '1.5', 'Mittwoch', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '3', '2008', '-', '-', ''),
('20.3.2008', '09:00', '18:00', '9', 'Donnerstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '3', '2008', '-', '-', ''),
('21.3.2008', '09:00', '18:00', '9', 'Freitag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('27.3.2008', '13:00', '18:00', '5', 'Donnerstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '3', '2008', '-', '-', ''),
('28.3.2008', '13:00', '18:00', '5', 'Freitag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('3.4.2008', '13:00', '18:00', '5', 'Donnerstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('4.4.2008', '13:00', '18:00', '5', 'Freitag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('5.4.2008', '09:00', '15:00', '6', 'Samstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('7.4.2008', '16:15', '18:00', '1.75', 'Montag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('8.4.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('9.4.2008', '16:30', '18:00', '1.5', 'Mittwoch', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('11.4.2008', '13:00', '18:00', '5', 'Freitag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('12.4.2008', '08:00', '16:00', '8', 'Samstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('14.4.2008', '16:15', '18:00', '1.75', 'Montag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('15.4.2008', '14:00', '17:30', '3.5', 'Dienstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('17.4.2008', '13:00', '18:00', '5', 'Donnerstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('18.4.2008', '14:00', '18:00', '4', 'Freitag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('21.4.2008', '09:00', '18:00', '9', 'Montag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('22.4.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('23.4.2008', '16:30', '18:00', '1.5', 'Mittwoch', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('24.4.2008', '13:00', '18:00', '5', 'Donnerstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('25.4.2008', '14:00', '17:30', '3.5', 'Freitag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('30.4.2008', '14:00', '18:00', '4', 'Mittwoch', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('2.5.2008', '09:00', '18:00', '9', 'Freitag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('5.5.2008', '16:15', '18:00', '1.75', 'Montag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('9.5.2008', '09:00', '18:00', '9', 'Freitag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kasalova Zuzana', 'kasalovazuzana', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `klicnar`
-- 

CREATE TABLE `klicnar` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `klicnar`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `klimes`
-- 

CREATE TABLE `klimes` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `klimes`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `klincova`
-- 

CREATE TABLE `klincova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `klincova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `kmoscak`
-- 

CREATE TABLE `kmoscak` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kmoscak`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `knobot`
-- 

CREATE TABLE `knobot` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `knobot`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `kochova`
-- 

CREATE TABLE `kochova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kochova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `kocourkova`
-- 

CREATE TABLE `kocourkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kocourkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `kolcunova`
-- 

CREATE TABLE `kolcunova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kolcunova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `kolmanova`
-- 

CREATE TABLE `kolmanova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kolmanova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `komarkova`
-- 

CREATE TABLE `komarkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `komarkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `konecna`
-- 

CREATE TABLE `konecna` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `konecna`
-- 

INSERT INTO `konecna` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('21.4.2008', '13:30', '16:45', '3.25', 'Montag', '0', 'Konecna Denisa ', 'konecna', '', '4', '2008', '-', '-', ''),
('22.4.2008', '13:45', '18:30', '4.75', 'Dienstag', '0', 'Konecna Denisa ', 'konecna', '', '4', '2008', '-', '-', ''),
('23.4.2008', '13:30', '18:30', '5', 'Mittwoch', '0', 'Konecna Denisa ', 'konecna', '', '4', '2008', '-', '-', ''),
('24.4.2008', '13:00', '16:45', '3.75', 'Donnerstag', '0', 'Konecna Denisa ', 'konecna', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Konecna Denisa ', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Konecna Denisa ', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Konecna Denisa ', 'konecna', '', '', '', '-', '-', ''),
('28.4.2008', '13:30', '16:45', '3.25', 'Montag', '0', 'Konecna Denisa', 'konecna', '', '4', '2008', '-', '-', ''),
('29.4.2008', '13:45', '18:30', '4.75', 'Dienstag', '0', 'Konecna Denisa', 'konecna', '', '4', '2008', '-', '-', ''),
('30.4.2008', '13:30', '16:45', '3.25', 'Mittwoch', '0', 'Konecna Denisa', 'konecna', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('5.5.2008', '13:30', '16:30', '3', 'Montag', '0', 'Konecna Denisa', 'konecna', '', '5', '2008', '-', '-', ''),
('6.5.2008', '13:45', '18:30', '4.75', 'Dienstag', '0', 'Konecna Denisa', 'konecna', '', '5', '2008', '-', '-', ''),
('7.5.2008', '13:30', '16:30', '3', 'Mittwoch', '0', 'Konecna Denisa', 'konecna', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('20.5.2008', '13:45', '18:30', '4.75', 'Dienstag', '0', 'Konecna Denisa', 'konecna', '', '5', '2008', '-', '-', ''),
('21.52008', '13:30', '18:30', '5', 'Mittwoch', '0', 'Konecna Denisa', 'konecna', '', '52', '', '-', '-', ''),
('22.5.2008', '12:45', '16:45', '4', 'Donnerstag', '0', 'Konecna Denisa', 'konecna', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('21.5.2008', '13:30', '18:30', '5', 'Mittwoch', '0', 'Konecna Denisa', 'konecna', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('26.5.2008', '13:30', '16:45', '3.25', 'Montag', '0', 'Konecna Denisa', 'konecna', '', '5', '2008', '-', '-', ''),
('27.5.2008', '13:45', '16:45', '3', 'Dienstag', '0', 'Konecna Denisa', 'konecna', '', '5', '2008', '-', '-', ''),
('28.5.2008', '13:30', '16:45', '3.25', 'Mittwoch', '0', 'Konecna Denisa', 'konecna', '', '5', '2008', '-', '-', ''),
('29.5.2008', '12:45', '15:00', '2.25', 'Donnerstag', '0', 'Konecna Denisa', 'konecna', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Konecna Denisa', 'konecna', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `kopecka`
-- 

CREATE TABLE `kopecka` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kopecka`
-- 

INSERT INTO `kopecka` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '14:00', '16:00', '2', 'Montag', '0', 'Kopecka Pavla', 'kopecka', 'of eingeben', '3', '2008', '-', '-', ''),
('11.3.2008', '14:00', '16:00', '2', 'Dienstag', '0', 'Kopecka Pavla', 'kopecka', '', '3', '2008', '-', '-', NULL),
('12.3.2008', '14:00', '17:00', '3', 'Mittwoch', '0', 'Kopecka Pavla', 'kopecka', '', '3', '2008', '-', '-', NULL),
('13.3.2008', '14:00', '18:00', '4', 'Donnerstag', '0', 'Kopecka Pavla', 'kopecka', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Freitag', '0', 'Kopecka Pavla', 'kopecka', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Kopecka Pavla', 'kopecka', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Kopecka Pavla', 'kopecka', '', '', '', '-', '-', NULL);

-- --------------------------------------------------------

-- 
-- Struktura tabulky `kounkova`
-- 

CREATE TABLE `kounkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kounkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `kratka`
-- 

CREATE TABLE `kratka` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kratka`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `kratochvilova`
-- 

CREATE TABLE `kratochvilova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kratochvilova`
-- 

INSERT INTO `kratochvilova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '16:15', '18:15', '2', 'Montag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Dienstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', NULL),
('12.3.2008', '14:30', '16:30', '2', 'Mittwoch', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', NULL),
('14.3.2008', '13:00', '15:00', '2', 'Freitag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', NULL),
('17.3.2008', '16:15', '18:15', '2', 'Montag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '3', '2008', '-', '-', ''),
('18.3.2008', '14:15', '16:15', '2', 'Dienstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '3', '2008', '-', '-', ''),
('19.3.2008', '14:45', '16:15', '1.5', 'Mittwoch', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '3', '2008', '-', '-', ''),
('20.3.2008', '08:30', '16:30', '8', 'Donnerstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '3', '2008', '-', '-', ''),
('21.3.2008', '07:30', '15:30', '8', 'Freitag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('3.4.2008', '16:30', '18:30', '2', 'Donnerstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '4', '2008', '-', '-', ''),
('4.4.2008', '13:00', '15:00', '2', 'Freitag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('7.4.2008', '16:15', '18:15', '2', 'Montag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('9.4.2008', '14:45', '18:45', '4', 'Mittwoch', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '4', '2008', '-', '-', ''),
('10.4.2008', '16:15', '18:15', '2', 'Donnerstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('14.4.2008', '16:00', '19:00', '3', 'Montag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('16.4.2008', '14:30', '17:30', '3', 'Mittwoch', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '4', '2008', '-', '-', ''),
('17.4.2008', '16:00', '19:00', '3', 'Donnerstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('21.4.2008', '08:00', '15:00', '7', 'Montag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('24.4.2008', '16:15', '18:15', '2', 'Donnerstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '4', '2008', '-', '-', ''),
('25.4.2008', '13:00', '15:00', '2', 'Freitag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('30.4.2008', '13:00', '16:00', '3', 'Mittwoch', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '4', '2008', '-', '-', ''),
('1.5.2008', '10:00', '18:00', '8', 'Donnerstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '5', '2008', '-', '-', ''),
('2.5.2008', '08:00', '12:00', '4', 'Freitag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('5.5.2008', '16:15', '18:15', '2', 'Montag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '5', '2008', '-', '-', ''),
('6.5.2008', '14:15', '17:15', '3', 'Dienstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Kratochvilova Pavla', 'kratochvilova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `kratochvilovavendula`
-- 

CREATE TABLE `kratochvilovavendula` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kratochvilovavendula`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `krkavec`
-- 

CREATE TABLE `krkavec` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `krkavec`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `kubaska`
-- 

CREATE TABLE `kubaska` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kubaska`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `kubica`
-- 

CREATE TABLE `kubica` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kubica`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `kubickova`
-- 

CREATE TABLE `kubickova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kubickova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `kubik`
-- 

CREATE TABLE `kubik` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kubik`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `kucinek`
-- 

CREATE TABLE `kucinek` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kucinek`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `kudrnova`
-- 

CREATE TABLE `kudrnova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kudrnova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `kvardova`
-- 

CREATE TABLE `kvardova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `kvardova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `lassanova`
-- 

CREATE TABLE `lassanova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `lassanova`
-- 

INSERT INTO `lassanova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('21.04.2008', '15:00', '18:30', '3.5', 'Montag', '0', 'Dagmar Lassanova', 'Lassanova', '', '04', '2008', '-', '-', ''),
('22.04.2008', '14:00', '17:00', '3', 'Dienstag', '0', 'Dagmar Lassanova', 'Lassanova', '', '04', '2008', '-', '-', ''),
('23.04.2008', '16:30', '19:30', '3', 'Mittwoch', '0', 'Dagmar Lassanova', 'Lassanova', '', '04', '2008', '-', '-', ''),
('24.04.2008', '13:00', '18:30', '5.5', 'Donnerstag', '0', 'Dagmar Lassanova', 'Lassanova', '', '04', '2008', '-', '-', ''),
('25.04.2008', '13:00', '23:00', '10', 'Freitag', '0', 'Dagmar Lassanova', 'Lassanova', '', '04', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dagmar Lassanova', 'Lassanova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dagmar Lassanova', 'Lassanova', '', '', '', '-', '-', ''),
('28.4.2008', '13:00', '18:30', '5.5', 'Montag', '0', 'Dagmar Lassanova', 'Lassanova', '', '4', '2008', '-', '-', ''),
('29.4.2008', '16:00', '18:30', '2.5', 'Dienstag', '0', 'Dagmar Lassanova', 'Lassanova', '', '4', '2008', '-', '-', ''),
('30.4.2008', '14:30', '18:30', '4', 'Mittwoch', '0', 'Dagmar Lassanova', 'Lassanova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Dagmar Lassanova', 'Lassanova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Dagmar Lassanova', 'Lassanova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Dagmar Lassanova', 'Lassanova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Dagmar Lassanova', 'Lassanova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', ' ', 'lassanova', '', '', '', '-', '-', ''),
('20.05.2008', '14:00', '18:30', '4.5', 'Dienstag', '0', ' ', 'lassanova', '', '05', '2008', '-', '-', ''),
('21.05.2008', '13:00', '19:00', '6', 'Mittwoch', '0', ' ', 'lassanova', '', '05', '2008', '-', '-', ''),
('22.05.2008', '13:00', '19:00', '6', 'Donnerstag', '0', ' ', 'lassanova', '', '05', '2008', '-', '-', ''),
('23.05.2008', '13:00', '19:00', '6', 'Freitag', '0', ' ', 'lassanova', '', '05', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', ' ', 'lassanova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', ' ', 'lassanova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '1', ' ', 'lassanova', '', '', '', '-', '-', ''),
('3.6.2008', '16:00', '18:30', '2.5', 'Dienstag', '1', ' ', 'lassanova', '', '6', '2008', '-', '-', ''),
('4.6.2008', '16:00', '18:30', '2.5', 'Mittwoch', '1', ' ', 'lassanova', '', '6', '2008', '-', '-', ''),
('5.6.2008', '13:00', '18:30', '5.5', 'Donnerstag', '1', ' ', 'lassanova', '', '6', '2008', '-', '-', ''),
('6.6.2008', '13:00', '18:00', '5', 'Freitag', '1', ' ', 'lassanova', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '1', ' ', 'lassanova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', ' ', 'lassanova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `lendlerova`
-- 

CREATE TABLE `lendlerova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `lendlerova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `login`
-- 

CREATE TABLE `login` (
  `jmeno` varchar(30) collate cp1250_czech_cs NOT NULL default '',
  `heslo` varchar(10) collate cp1250_czech_cs NOT NULL default '',
  `prijmeni` varchar(50) collate cp1250_czech_cs NOT NULL,
  `krestni` varchar(50) collate cp1250_czech_cs NOT NULL,
  `skupina` varchar(20) collate cp1250_czech_cs NOT NULL,
  `ulice` varchar(50) collate cp1250_czech_cs NOT NULL,
  `cp` varchar(20) collate cp1250_czech_cs NOT NULL,
  `psc` varchar(10) collate cp1250_czech_cs NOT NULL,
  `mesto` varchar(50) collate cp1250_czech_cs NOT NULL,
  `stat` varchar(50) collate cp1250_czech_cs NOT NULL,
  `telefon` varchar(50) collate cp1250_czech_cs NOT NULL,
  `mail` varchar(50) collate cp1250_czech_cs NOT NULL,
  `datum_narozeni` varchar(50) collate cp1250_czech_cs NOT NULL,
  `jazyky` varchar(50) collate cp1250_czech_cs NOT NULL,
  `ridicak` varchar(50) collate cp1250_czech_cs NOT NULL,
  `pohlavi` varchar(10) collate cp1250_czech_cs NOT NULL,
  `datum_pohovoru` varchar(30) collate cp1250_czech_cs NOT NULL,
  `datum_nastupu` varchar(30) collate cp1250_czech_cs NOT NULL,
  `datum_poslani` varchar(30) collate cp1250_czech_cs NOT NULL,
  `datum_konce` varchar(30) collate cp1250_czech_cs NOT NULL,
  `pracuje` varchar(10) collate cp1250_czech_cs NOT NULL,
  `vzdelani` varchar(255) collate cp1250_czech_cs NOT NULL,
  `vztah` varchar(50) collate cp1250_czech_cs NOT NULL,
  `zivotopisy` varchar(50) collate cp1250_czech_cs NOT NULL,
  `posledni_prihlaseni` varchar(30) collate cp1250_czech_cs NOT NULL,
  `foto` longblob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1250 COLLATE=cp1250_czech_cs;

-- 
-- Vypisuji data pro tabulku `login`
-- 

INSERT INTO `login` (`jmeno`, `heslo`, `prijmeni`, `krestni`, `skupina`, `ulice`, `cp`, `psc`, `mesto`, `stat`, `telefon`, `mail`, `datum_narozeni`, `jazyky`, `ridicak`, `pohlavi`, `datum_pohovoru`, `datum_nastupu`, `datum_poslani`, `datum_konce`, `pracuje`, `vzdelani`, `vztah`, `zivotopisy`, `posledni_prihlaseni`, `foto`) VALUES 
('rydval', 'asdf', 'Rydval', 'Tomas', 'user', '-', '389', '671 64', 'Bozice', 'Tschechische Republik', '775617127', 'T.R.B@seznam.cz', '15.1.1991', 'Tschechisch,Deutsch,Englisch,Franzosisch,Spanisch', 'Nein', 'Mann', '', '', '', '', 'Ja', '', '', '', '27.03.2008-15:02', ''),
('trupp', 'tsqm', 'Trupp', 'Andreas', 'su', '-', '-', '-', 'Wien', 'Österreich', '-', '-', '-', '-', 'Ja', 'Mann', '', '', '', '', 'Ja', '', '', '', '28.06.2008-13:11', ''),
('tomkova', 'blondi', 'Tomkova', 'Michaela', 'su', '-', '212', '67181', 'Znojmo-Novy Saldorf', 'Tschechische Republik', '724209471', 'm-tomkova@seznam.cz', '9.11.1990', 'Tschechisch,Deutsch,Englisch', 'Nein', 'Frau', '', '', '', '', 'Ja', '', '', '', '08.07.2008-12:32', ''),
('pechacek', 'nevim', 'Pechacek', 'Radek', 'su', '-', '', '', '', 'Tschechische Republik', '775311477', '11Freeman11@seznam.cz', '', 'Tschechisch,Deutsch,Englisch', 'Nein', 'männlich', '', '', '', '', 'Nein', 'Mittlere Schule, Fachschule', 'Mitarbeiter', 'Termin stattgefunden', '06.06.2008-11:34', ''),
('kasalovaiveta', 'mqst', 'Kasalova', 'Iveta', 'su', '', '', '', '', 'Tschechische Republik', '', '', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', '', '', '', '10.07.2008-15:39', '');
INSERT INTO `login` (`jmeno`, `heslo`, `prijmeni`, `krestni`, `skupina`, `ulice`, `cp`, `psc`, `mesto`, `stat`, `telefon`, `mail`, `datum_narozeni`, `jazyky`, `ridicak`, `pohlavi`, `datum_pohovoru`, `datum_nastupu`, `datum_poslani`, `datum_konce`, `pracuje`, `vzdelani`, `vztah`, `zivotopisy`, `posledni_prihlaseni`, `foto`) VALUES 
('glac', 'acer', 'Glac', 'Martin', 'su', '-', '', '', '', 'Tschechische Republik', '728067705', 'martingl@centrum.cz', '', 'Tschechisch,Deutsch,Englisch', 'Ja', 'männlich', '', '', '', '', 'Nein', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '03.06.2008-22:10', 0xffd8ffe000104a46494600010101004800480000ffe136bc4578696600004d4d002a00000008000b010f00020000000a0000009201100002000000080000009c011200030000000100010000011a000500000001000000a4011b000500000001000000ac012800030000000100020000013100020000000a000000b40132000200000014000000be0213000300000001000200008769000400000001000000d2c4a50007000000d00000195600001a2650616e61736f6e696300444d432d4c533100000000480000000100000048000000015665722e312e30202000323030383a30313a31382031353a33313a3234000023829a0005000000010000027c829d0005000000010000028488220003000000010002000088270003000000010064000090000007000000043032323090030002000000140000028c9004000200000014000002a09101000700000004010203009102000500000001000002b49204000a00000001000002bc9205000500000001000002c4920700030000000100050000920800030000000100000000920900030000000100180000920a000500000001000002cc927c00070000165c000002d4a00000070000000430313030a00100030000000100010000a00200040000000100000500a003000400000001000003c0a00500040000000100001930a21700030000000100020000a30000070000000103000000a30100070000000101000000a40100030000000100000000a40200030000000100000000a40300030000000100000000a4040005000000010000194ea40500030000000100230000a40600030000000100000000a40700030000000100000000a40800030000000100000000a40900030000000100000000a40a00030000000100000000ea1d00090000000100000000000000000000000a000003e80000001c0000000a323030383a30313a31382031353a33313a323400323030383a30313a31382031353a33313a323400000000040000000100000000000000640000001e0000000a0000003a0000000a50616e61736f6e69630000001b000100030001000000020000000200070004000000000100030300030001000000010000000700030001000000010000000f00010002000000001000001a00030001000000040000001c00030001000000020000001f000300010000000100000020000300010000000200000021000700fa140000ea0400002200030001000000000000002300030001000000000000002400030001000000000000002500070010000000e41900002600070004000000303130302700030001000000000000002800030001000000010000002900040001000000461000002a00030001000000000000002b00040001000000000000002c00030001000000000000002d00030001000000000000002e00030001000000010000002f00030001000000010000003000030001000000010000003100030001000000040000003200030001000000000000004456010245500000f03f44423004f03f41468e00604720a06247110164471000664700004e473e0072470300744700007a472c007c47ffff7e47000040479d034247413f4c47409c5c4700007647800078470000524789005647280054473e006c47c00070473e006e47480058470e019e47a0009c47c8008c4701008e4701008a47413f90470200924702009447000096470000984788089a470000f03f53544600a4460000a6460000a8460000aa460000ac460000ae460000b0460000b6460000b8460000ba460000f4470000f6470000b2460000b4460000b0440000b2440000f03f4145c2003c45740014456c01ea46780128456c012c456c0124456a0510450b051245ea042045650236456502224508023a4501003b45010026450d012a451d00c8596e03c6597c012e4500003045000032450000404500004145000042450000ce590000d0590000d2590000434500003e4500001c454f0044452700224a2b01c0590000c1590100e846c72acc460000d4468100ce467002d0462202d646720050580000da460000c5590000ef460100d4590000d6590b3cd859b17bda594b84f03f57420e0100441902024408015c440901044453010644f4001245ea041a442e005e444a005f4406001244e9001444d20016445b011844f400cc440501ce44c101d0447d01d2441f01dc44c601de441d01b4440008b64400003044600038448b00324470003a4484003444e8ff3c441800364428003e4460004c4455014e44fc00c0445301c244fb00ea440000804548008245aa0083457e00844500008645000087450000884500008a4500008b4500008c4502008e458f008f4571009045000092450000934500005244c6005444d2005644d2005844d200d444c600d644d200d844c600da44d200d45d000000587101025832010458ff000658d20036587101385832013a58ff003c58d200f03f59435e01a0450000a2450000a4450000a6450000a8450000aa450000ac450000ae450000b0450000b2450000b4450000b6450000b8450000ba450000bc450000be450000c0450000c2450000c4450000c6450000c8450000ca450000cc4537006045030062450100644504006645070068450f006a450f006c450c006e450c0070450c0072450c0074450c0076450300784503007a4503007c450300d0450000d2452000d4452000d6452000f0450300f2450300f4450000f0460000f2460000f4460000f6460000f8460000fa460000fc460000fe46000000470000024700000447000006470000084700000a4700000c4700000e47000010470000124700001447000016470000184700001a4700001c4700001e47000020470000224700002447000026470000284700002a4700002c4700002e47000030470000324700003447000036470000384700003a4700003c4700003e470000ce450000f03f434d0a00fc4505f0f03f49531e00944652049646770398469d039a46d9036046ff016246fe0100000000000000000000000000000000000000000000000000000000000000000000000000000000000000004145424d030d1a0df30c190d1a0d1a0d1a0d0d0dd40cf20c360852025303e507940ae10b8b0cd50cf30c1d0b14097a07ae02fa01ef02270345043b05c40445057504e904c403cc076002fb01fa011903f3024002ce013703db01e801ca019703e00431027a012502d4012a02b6010402d2013b027a025a018f019501ff001d014d039a03f602cf02c902c40200036501d3009100f1000401fc01e8013902dd010e02f5011f02170267011d01c300f0002b04d2036f0178014c01ea029a067b026f014801a700e3002e02e801d800e400e8004401800147013b013501b200a200b500c8006f01350231024101bc00ce0004010701c100a4008d009d003b019b015301c7009b00d400e400dd00b800a80076005b00510053005a0061007600c500d400ca0050525354000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000004643435606000200413f0000413f000000000000000000000000000001007d42613de33f0740fd3fff3ff53ffe3ff93f000000000000000000000000d43dc7005401ec00020002000000000000000000f100cf029702020002000000000000000000000000000000000000000000000000000000543ee9001f025a01020002000000000000000000200148031103020002000000000000000000000000000000000000000000000000000000d43e2d01130338020200020000000000000000005901cb03a703020002000000000000000000000000000000000000000000000000000000543f6a019d0302030200020000000000000000007f0109042504020002000000000000000000000000000000000000000000000000000000d43f6e0113034e030200020000000000000000007f01cc035604020002000000000000000000000000000000000000000000000000000000544046013d02c00202000200000000000000000068016d030e04020002000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000005742435a0e0e0e0e0e0e0e0e0e0e0e0e0e0e0e0e0e0e0e0e0e0e090e0505090e0e0e0e090a0e00030505050f0f050f00090e0f050505050f0000000005050f050505000e0e0e0e0e0e05050506050e0e0e0e0e0e0e0005050605050e0e0e0e0e05000505050e0e0e0e0e0e0e0e0e050506050e0e0e0e000e0e0e050506050e0e00000e0e0e0e05050605050e0e0e0e0e0e050505270000201303000023010000000040200040061000000000000000000c830354000011000161000058830354000000002700002000010000000000000000000000c0bd1d040000000001000200000000588303540000000013090000c00600000000300000000050005006100100030000090000c0060000010000000000000000010000004006100700060005700000a8650254000000000700060005700000c4650254000000000700060005700000e0650254000000000000203013030000230100000000000000000000ff01000102010c000000202013030000230100000000000000000000ff01000102010d0000004b303130353131323430303537000000000200010002000000045239380000020007000000043031303000000000000000000000000a5072696e74494d003032353000000e000100160016000200000000000300640000000700000000000800000000000900000000000a00000000000b00ac0000000c00000000000d00000000000e00c400000000010500000001010100000010018000000009110000102700000b0f0000102700009705000010270000b008000010270000011c0000102700005e020000102700008b00000010270000cb03000010270000e51b0000102700000000000000000000000000000000000000000000000000000000000000000000000000000008010300030000000100060000011200030000000100010000011a00050000000100001a8c011b00050000000100001a94012800030000000100020000020100040000000100001a9c020200040000000100001c170213000300000001000200000000000000000048000000010000004800000001ffd8ffdb0084000404040404040404040408040408080b08080808080f0b0b080b130f1313130f131317171e1a17171a1717131a221a1a1e1e222222131a26262622261e222222010408080808080f08080f221713172222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222ffc0001108007800a003012100021101031101ffc401a20000010501010101010100000000000000000102030405060708090a0b100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9fa0100030101010101010101010000000000000102030405060708090a0b1100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00fbe3ecf00ce20419ebf28e78c7f2a77930e73e52e7ae768a776b625a4f7427910654f92990001f28e00e949f67b71d204e807dd1d38ff01f90a9b2dcb7aee28b7807021403fdd1f4a436f6ec08681181eb951cd526d6c4b49ee288205c958514f5e147ae7f9d020806310a0e31f7474e38fd07e4292d361bd7713ecf073fb84e7afca39ef4be44008221407d768f5cff0041f952693dca4dad987d9e0c01e4a600c7dd1d318fe5486dedc9dc6042d9273b45310e10c43a44a3fe0229a208171885171d3e51c743fd07e543d75625a2b2d88ded2de41b1a04f2ba11b47cc318c1f6c607e9d2a4fb3db824f9099ff7450f5dc168ee877931641f29720e47ca3834dfb35b81810263a7dd1eff00e27f3a4b4d10ac9bbbdc3ecf6fde04ff00be47bff89fce9c6184e73129faa8a652ba5644945020a2800a2800a2800a2800a280109c7bd0467ef73de97510b453185713aff8ef46d16e8e97138d4f5ac64dbc6c008063ef4afd117381ddbe618539143d136fa1718b949456ecf3ebdf889e219e743650dba246c1d41471e7718c3618f04f619fc7ad624ff1bf5cd3e429aa786122407e6922667403d73c11f88af2218894ddb45fd77bfe87d1cb0118ae64dbee77ba3fc61f06ea7225bcd7474d98c65c9971b370eaa0e7713e9f28ce0d7a0586b7a5ea7b4595ea4ccc0b28ce0b01dc03d474e9eb5ecd99f2aa49ee6ad15268306ff31b3feaf031f5e73fd29f529eac028aa00a2800a28018eea88d231c28049a72b0619539153757b00b5872f893458f505d2fede936a05820862fde3eee7821724631924e00ef4376572926dd91f3efc56f8a9a8ff68d8f84fc1f34897328db72c81a09e3972404c91950b8dcd81c8ef8cd79f697a0ea3a0c526ad7376278fca58de3b7e5646dd80e727048c9e98e09ae5ab552828dbe23ba9a74a7cedec7544c8c0aa44d8edfb85271ff00eadbf99acf96da27b396e25c437092ec31cbc79833c3ae0e718238c71d067ad7ce5926d49ebfaf63eda53972a9415d3b7dc685b78762589847712ac6e738670e10e3b6f0f8e7b0fc6b9283c2122eb17f0699746c986d036031ef27043315c75e9c01d735f4f19f2bd0fce1c533d274dd5fc7da2fc96daacba83b30531dd6db8445030a4126361ef8cfe7c57476bf1435ab5bbd41755d3219f1b04712ce205438e7e6719391ce0fd071cd6aa4a4f4159a3a9d23e28787756bc92179a4d2f6e38b94001ec70ca4af5f535da699a9c17d75aac51de47722396368c23a9fdd3448c1b8ec496c1fafa573d25514e7cfdf4346d69634fcf8f7942e37f1c679e69c6455ddbcec03bb1c66ba8cee40da85827dfbe857eb2a8feb5036b3a42fded56dd7eb3aff008d5f2cbb1a59f6106b7a39e9ab5b1ffb6ebfe352c1aa69d733fd9adefa19e7dbb82248a58afae33d287192e84bd3739df125dcaf0436b1ce6d448577b6d3f30eb8fa1c62a4b7d5a1d234b69af0c936dc0548d4bc8e7b003dfd4e00ee457ce54a92faf421d3fccf4e305f566edadcf16b8d47c5ff00127559b4fb37167a74658491a487c98973d5d87df391c7d09000e6bb08f57f077c2f9eef4496377d6174b6d49ee5f62fdac072a22539cee2c3850318e724e6bdea92b7b91f999bf762a10ddff5f89f245bf88f50fedbd5bc577d08b8d6a76674693eec058e59b1f4e00e303d738accd2bc55796fac1bbbcbc92e6d27091cebe66711ab82a40e47ca72718e8580c66a9515aca7b93371bd91ed177e73c864b48cbe792a9cb6f2548c0f7e3fc9a24b1d5a32caba7dfc64103fe3ce51c1ce0e36fa01ff007cd7c7d49420973eff00d7fc03e9f0d5e2e9a8cd9b70ea17891d9c85e291d9b6a9f25e319efea71c73d05436125fdc6a1a85c5ad9d939f90b0fb496d9f7b83888e0f7c1f6afa951566ee7c61b569a86bd3450c9269168aacaa4e2f5c751e8223fa7e754acaf266d735469ac9567289bd627dc130abd0b05cf51d87f5a5b3dc5bee6ed9ea291789f4892f3450d2798a1415898ac8dbb1b4eee3a13ed8aa769e2b6d1b57bbbeb6b2129b8b6b5b6019c22c588436f3d738dbc28e4e703d2aa316ea2f47fa049e8636b5e28d4b51bf92e5efe5b47231b229d9557db82327d49ebec3007313de34c499e769cfac8dbbf9d7de53a14e3149f43e4675eab7eebb266ad8c52cda6cb35bda4724ab3244816c44cd2ee0c49cfb61474fe215d0e89e13d4b5b7b88755593c3f0840e246d376ab1c81b41e3ebc7a1ae3a9354e525dbcfc8e8a7094d27dcf28bcd4611348b6724b25b8276bcb85661eea09c7e66af69da84913add2b94951810ca70c87b303d88ed8ae84f4bb4296fa33d7e7f19a6a1a7e9b71731b34d03a472945662188c0900031b4804f2739047419385f107c451ea3a2fd9f4f32c11c724734ac2227cc4ce0a0cf00e3079fff0057e678dc3548e3a328ad135f76e7de616b465865cd2b3b3fbcd8f86ff11b4e5817494d2134e88176695ae63504f279ce3a0ce072703924e4d3fc636de12f1feb7ab691a55adceabe268ed61905e47724d9c718704a061260123231b71924f5c9aae5aff58718bf3bebdf6ec6551c57ef6fd35f958e72efe1969ba368fa8dedd4914902a4972f9b2579954019dac5fd0123a7279c6315e41141e1ab392eae5b43b964fe0637f10c64e410be59c1f6c9ef5f511c2a77739bd4f07eb7ab5189da689abdbc9a8dbcaec52da310c6d138466600825b202e49000f418af734f1f689e16f095aea3adb179ccce86181d65966cc87120c91f2b0c1c9c633b4fcdc57cd66796cdc232a1aeb6f4becce8a3898d47c9256678c6bbb25d2a6792d9672aa8e79f46e39c83ce4f23d2b91f0ededd69d3c29038449522dfb86591d89f9b1b7b9c1ea31c75cd7a90d5d8d4f5bd16e6e1f4fd2cc92b6fd8aa9f2b61709c673c138c54111957c5f7477852c9952548ddf228e73d79159b8fbd61df439df18f891a19ed2cf4b32412c5312f3ec28e48181b5ba91cb8fc4d431dcc9142d97da5d519d47eec703e45238ff007b9c839420d7ab86a4d558b92f3fd4f3eb4ff772b6fb7dfa1cdde4ecc555df1904e793cd6396249cccbf937f857d2b3c54bb2d0eb6d7c55a9082d6da1bc54312a08d0c649720600e05767378f3c476455ae0c715aa865b78dac5d54aaf5ee9d38e074af32a508cdf349e876c6a4e0ed05aff005fd6c78fac9a546804b70f73764f288422a8f5c9c93dbb0a96d66877c7b6f63897f8c3b01ebc0fc3bf15d9cd17757399a92362d6f6cc7eee79d6e2207648a8d9263c8395e46482010338ca8ce4122b1fc4a6db12e916ab2bdacb30ba5b93955e13610b95018701b20e39f7cd71568a9b8bfeb43ba9c9c535f3fbc66806d61bf86deff57934fb2fb7446dee2380c9f69dbbfe50060fccbdce06339afa1340d57c39a25c6a32da6a779347751c6b32ccb185dcbbb95c2e40e4f03dfaf6f2972f333aea5dc7437cf88bc3fa95adec773791dc472660961661200bcf0463f8948241ff00ebd78aebba7785f4dbc31da784e6bbb2c6e133dece8b9ce0e17278f7c8f6e39af4e357922ecae70c68f3cecdd84b7d5f478cc70d978403458f9c3df4c36f3feeb67f21f8d5dd4b59d167b13a55ff0083d66b076dec3ed92e03052430fdda9073c6723863d466b9658994a36763aa342319de2f539f92f9e18afadeea22f0f96177700443e6f95864f007f163b7381cd79dc5aa42a44702a6d30a9766272a54024e083c95ddc81c6daf2568ced675fe1cf1b5b21b133ccb661220b21688ef94aa9008e9fe7ae40ab9278a7fb43529f53b61f6399226da091ce03f240e39040fc293569683bdd18ba1e8badf8bbc42bf676ddba512b1f33c9f2867248906483d4fdd2475e4035eabac7c2bd70b0687c4acb1862cab6c4c5b4fa93904fb72718af66954f715cc3d8a93d7b9cc37c36d4a3fdf4de25d4659b010fef640700e7a963c671c7b5449f0de28e4698de5e999892cc5fef67ae78e735a5d5cf56185a4d7bcc9a4f86da74e02ce279173b9bf7a1431f7c62ad1f877a318cc674d05718ff5a467f5a972bb3b2385a0b7201f0d3435248d2d4753feb4f7fc6aec5f0f74094ecbdd384f11fe16b97033ebc1a14ac53c3e1ded1fcce8b4df87be138181960dab9cec49a46e739eaec71f402ad789fc09a36a36b14fa632c06dd3f7304cfe6459c8eec4ed27fbc73db240e4449b92b1c12a308bbc51e07aa6a1fd9572ed796f2472dbb97313a12448a08da463239e307a66b995f8a4a14b5ed8b42436dda1dc3edf5c1007e19cd712872688f3dde4f51ba6f89b4ed0a1fed749711decf23cb22302fb99dd9778ebc0e013ea6b73fe1722b85823d65c2a63666dbcc007a7029b6d6c67ca9eac41f152654693fb6e7543ce56c5f1fc8566dd7c5e96466846b77534db8a98c41b1b3e9cb8e6b0bcfb9af2c6fb0f935ad4e56741732449b7614207033fad66461dfeccb24de76d3c975c1c8038c67af1d0ff00faf8b9fdeba32e665db7b78c805a60225397c7438ebffebad2d3eda79669a312999a5cc606deb9e31c7f9f5a6a577604ddcfa5b45b9b3f0ae9a9a5da302e8489642306497a3b74070480076daabdf34b71e2867ce65c9fad7b89248fa1a1876e29994fe212e797aa9278833901bf5a97248f723872ab6ba58f2e4fe351ff006d29240639fad66e68ee54341bfdb84038ebf5a41ae3b1399081fce8f6887f57ea33fb7a519fde74e2a55f124ea413254fb5571bc327d0c7d7ed6d75e824d577017d1148ae17782d22107649d739e0a74fe0c9e6bccaf7c3b652072f08c9c9e456b7baba3e17134fd9567139abff0008d9dd5bc56af2491db47b99555b804927fad72937822c11bf77249d3232e067d3b564d5ce24245e15488e17539a13d30091fae69478322139b95bef3a50dbb2dc927eb9e4d734949166dc53cb0cbb05a1e80ee7e8879e55bfc7a55f0d389e59048224c1f94e4fcbebfe4638f7e7cd3ceb03deaee9238dc1c391819ce4019ff1f6e4d75be1c9c4770dab8b59279204774455e0385dc0b7600f4c9aeca6b9a6b43b29a5ceafb1d62ea6de5a431298d140554fee81d0535ef6545691d8a28e72dc0aee7ccf5b1fa2c2ae121eefb45f7a2ddbc7f6945924d4a0b5cb3a9593cc25405ce7e553c1e83dfae073562deced666226d760b640c80968a63904649184fe1e8738c907191cd73e8d5db3b6555c24e31a6ddbd3f0d4af790c4b78b6da7df0bf8c90a2564f254b1ff78f03dce2acea9a77f662da7fa534970ea4cb1bc0d1988e703af5079c1f6a5cba369ec43c572ca9d39c6ce57ebb5bf3e9a0d8d34862a25beba53b5776db7423760e40f9c700e31ebed56e34f0d79b0ef92ffcaf2f3280b19224ddd073f742f73c93d852f71eed94ea626feec636f5649a57872f35fbdbc8f4a18b48fe62f29e5549c2e71dcfb0c7e95d22fc2cf10dca96b7d4ad6020818915d89ff80f1fce850bbbdf43c7af99ca8cbd9f25e56d7b5c7c9e0bd4744b9974e3ad6e925b498c8a21da9291b0a8e49c724f6cfa60f35e6b22a4871b87f87d2bb2092d11f295ebcf12fdacd256ec65cd08cb023900fafe959d3dac24b39524e7a03d4e303f5ad59c08cb9ac8150081bd89ced3df1db359735aed72c17683fc408ea2a0af533a5b88e0fdd86f2a461c00fca9e33c77ac86d49af223f679d9c10d97ced00f040627e9d3debc48ddb6df439d46cb42b596efb5ba8ba59988f9649972a1883f372307d39e3ebdbd5fc316925869dab3dc4fb2268c4ac58e7cc4da4f1fcbf0ae9a6e5cf6e88e9496a8fb32dd63b6f0f42abb2191647523cc1182c58fcdefc63152dadae87750b7f68cb025d92b196130f994e3a8cf5ce7a57a8dbd7538b67b1f2678d647f0c6a17423432d9b10c8b1c418aab679fbca319040fc2b81ff0084bef0972a366393bed5723d8fefc579d28fbccfbca38a50c3d373babab7dda77117c5b7bbb32636100e3eca0103d0feff008a99bc585c6dfb2cca5baba2280bfa9e7afe5458d3ebf4ef769fddff0004cf7f12ea9e605867b900e71f3c0a31f8c26a7baf115f456c923c924eeec14219954f4f548d7fcfe5536d2e62b1dcd35c916efe7ff00fabbe17f88fc35e17f0f97d4fc476515cc8c5e58a5be4699083b7182771e99c1f5addbff883e0e9ee1ee0f89a255660c238a29db763381948cff5ad535d0f02ad2ad3a92934f738cd73e2169a27827b3b5b8d60e5f7c91dab463e6d99c799b381b73f527f1f36d66489ee45d5aaf931c89928319041eb81d33c74f435ba92bd90beaf5234a5526b4309a6dcc630c011df0698ecc0b639fe95b9e714dc2b2c991c75618eb55df180bb7710c08e338e68624790db8dcab25d46656246e0dc96049f4ebefe9d3a7356bece6f1d2251f668d587c8385fbb9073ebf53c7eb5e0f32521fe648d8f25eda464f20905760dbb8f1918e73d49c83e95db26a31dfc2b04a2487cb4118f2a4752531dd40231d473f90e8378bb3f53d8c1c233a8d4d5d5bfc8e924f18eaec06ff13ea471eb704e3afa8a9878c75175c49e21d4d8f4cfdad871f8575fb47dcfa0583c2ffcfbfebef30353d516e7ccb8bbbbbbd50b2156fb45d1638ce7ab903f5ae6a3bed34234490c9b793f3dcc040c727187f6ae4e7d5b3baa50a538469f2d95ff00aebf90e4d66c1cac71c4ad31dcd9fb641c9c1e0282481c74e477a99757df22634583c8242e1ae616c027da3fd2b473e5dce38e0e94eee114fe7ff04b0baa4d2054934d8625dca3699a4f5ea30807e6475ac64d4d25b888dae9f6c19640dc4172c5391df000ff00817e353cee4692a34a93e89fdffa1e816fa8cac04cd0c3023e086da371ff003f4a967d66688a95bf30b770e5403f45c67d2a799d8f41a5f0b572adc6b31b3465ef64df9ea85896fc0640fcff000a21bf69be789764059b20b1eb8ea07e1d7834e12e6a88f3f18b97092bab6df9922dd19954a9181c1038e3e94bf6865521a4efd78e2bd2ea7c23182747c904753d3fcfb5359c65403927afb5697336793da9b80449e418634cb6e766183ed91f4271cf71e82e2cb330036bcdf300ccbbd8608f5209e393d735f3b6e6d992f5dc64d70ea250d04974013f2c6480bd0b1272318e3af6cf4aa91deb5bb90bbe21fc4adf3ecc938c123be3b7b76ad56d74cf57092e4af16cd15d51d71b6f5ff03ffd6ab6bacca7adf4abf88ff0a8e667e82943b915c6ab882579ee1e70a8c70c148e9cf18ef5eb5e18f87fa7ea9a65ddf1d2ee2fae15a08c2dbb4708daeadbdb3e4be71c741fc55eae168c2b42aca6f58a4d7de97ea7cde698aa9869d0542def369bb5f657febd4b36fe0ff0739ba9574ed492ca099bccba8ae626db02c9768d330f257e502d8b10b93f38032460f75ae7c30f09787ed61ba37575745e46511cf75b3cd0b1492145d814ee21081d719ce0f4aaf650ec784b30c527f17e0bfc8c4b2f0ef870da69ff006eb6b7bcd49b504b2b9b686eae59ce4425c47b6edcb7961d8b1da49c7288016ae7fe20d8e8569f0e741f12e93a1b68daa497eb6d72ae65dd1b0122c898739c6f5e3201e0640e450e10b369043135fda46f376bad3a35e878bc1a895182a848ea768e6a66d4a7724451331f65cd788f4d0fd214b99292409fda92b00207419eac31cd748b14eb0224772c85300827009cf5aebc3fc6df91e1e66dfb08f6bfe8cbd146a88581cb673f2f23a7eb48d3c72170cd8dbd08e715ead8f84dc916719196271c1cfe74be60c1031e80fa8aa5a92ee71f1ddc0b148a1c44a899f98fcc54e79f5c75ebc0efeecb896d1271e6b334cdb7ca0ca40dd90738c903f2ed5f2f152be824aeeeca935fbcc1e0998a4012468c84c3b750b9f6ff000f7ac55ba8e38dc5d30b956c6e58940008271dff00403b835db08a4add4e9a6f96a29bdaebfe092c7a87865d72d72f6c7b868dcff206a5179e1d0c5bfb430982398a4e73f51fe7155caee7d7cb1387942d19d9fa0935ef85e489e24d4d9770209dadfe15d141f11b53b6b2b8d363f144371a7c8b1c6f14fa789919506141565238e31c761e82bae94a74949456fa3d8e3c4fd5715c8e73b72eab718ff1135369263ff0968b7696717127916022f366ce448db5465b3cee3cd3dbe23eb8186ff887a91ea30b24ab8ab756a3d2c8e1f63825bcdfddff0000ad37c4cd6998893c6baddc8c630972ca0fe048acbbbf16e95760c974b7da95c13bb37326edcdea7e6a873aad5ae545e0a93e6826caf0f8bada32a13440d8ee66c13ff8ed367f186a93bffa359c16f1e7a1dcc7f3c8fe55cbc91ea77cb1f27f047ef2ce9da8eb17b7886e2e765b93ca440281c7a9c91f81cfa5772b33328753b50ff101d3f1cd7652491e2d7af56b7c6f422799e36731aee0d856c81cd31a2061dea3174013b411927d3f95759e78e49b7839428ddc1ebed4dfb548647570be5e3706cf27d8023f5f7a44599cbd9c12473cb2c9183918caed503000f9474ea33e9c55b11c570d95844b2a951fbdc657a6460f7efdfafbd7817f7ee849df523cbabef08f38c85210105723eef4c1e33ef596580664dc8143f2a382401f9f393d78f96ba628db630e4d3c2dbc9314c80c095fee8c73eb8aac9692ca64508a7770bf293dc6307b0e57af1c8f5aecb6857528b5a6d7742b86e06791edfaf5a67d91802bd7fa54ec50a6cdb04e302a4168410719f5e3d6a2e55897ec2ddfe6e3ad385972011c1e2a6e24594b3ea3b0e99e956a0b5c9dac383ef48b3a3d3e309b58ae47bfad7516e087e47b827bf6fc7a7e95d51d0c98b3c5bb2029476e723a1f5a8a3631808cb960705890491e9f4c9ae8ea63d08d983a305212604b1eff0098e6b3fedaca065cb360f20f07fcfe7ed4981976e1d24092cacb1f5da146d27b7191fcbb1cd5c8dedfcef2e4bf6665193cac658f1c640cf5e98ce38af9f4aed02d516efe47ba9a249d22445042952bbcff0016e6c71d8f381d7d39ac25843bc71898c8e768064c602fb1ec3b77fa74af461ab2fd4bf750c2e96b6b23b36e6f90aa81e639ec73d390b9edcfb7144444072b14780cd1985806206dc018c75e5803d78cf18e3aec0535846f0e3fd1d4afde19c28cf6c73d7fa649a7fd91002c172c7ae3b54346bb8e365939099c75f6a9058831e4a7ca5b19ac5a18a2d47cd85e339c11cff9e829ff006419195cb7a9e86a5a18f16e076245396100e18647a1aa484695ba6c21b3839c900f1ffd6ad4f9f66d0ec8e49c15c11d727fad742464c9e32d2fcb3a2975c95e41f51554c60649676c9c9dc7d3dab6f520a522a9216450c54655db04f3597767cc62dd01e40eb9ff00eb52607fffd900ffdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffdb0043010909090c0b0c180d0d1832211c213232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232ffc000110803c0050003012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00f7e2a0f519a5a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a2b31e692fa6686dd8a42876cb30ea4f755fea7b7d7a34ae26ec2cd23dec8d6d6ec4440ed9a6538c7fb2a7d7d4f6fad5d8618ede248a24091a0c2a8e80511431c1188e24088bd1546054949be8812168a28a06145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001494b45021b452d14c561b8a4a75211412d0fa28a291a051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145674dbef9fca8dcadb0ff0058e3ac9fec83e9ea684ae00cef7b23450165847124ca7aff00b2bfd4ff005e976289218d638d42a28c003a0a54458d151142aa8c003a0a7d36c560a28a290c28a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a00292968a0425252d14c42d145148a0a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a4240049e05324912242eec1547526ab6d6bb20c80ac1da32397f73ededf9d348571b97bd27aadafe465ff05fe7f4eb71555142a80140c003b53b18a5a1b0b051451486145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001514b2a42b963d4e001c927d05249285608a3748790bfd4fb524719dde64841908c64745f6140ae3161695d6498703958fb0f73ea6ad5145030a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a280109c52d145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514d660a324d003aa067672cb1632382c4703fc6970f212186d4ed83c9a94000600a05b8c8e358f38ea7924f53525145030a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a28029dd5e25b3842a59882dc1c62b361d4e459be662c84f20f351ea0c24b89d8f6381f8715989275ad541194e4d1d982080452f6aad62dbeca163dd055aac99a2774145145030a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28aa37d2c7e5f91e71491cafdc386009fff005d005ea2a3450881464803b9c9a7119eb496a0213ce00cff004a0273b8f2d4ec629698ac145145030a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a280128aa97da8d9e9d6e67bcb88e08c7776c67e9eb5c0eabe3b93599ce99a116811f87bd7c8207fb2074fa9a761a4dbb23b6d475982c0f96019ae0fdd863396fa9f415453c45e4ba0bd114624e536920f1d78358b6565168f66d2b4e5d986497033237d7d4d63dc5cc37ceb34f732057e31b3fe3ddffc2b86a576dda1b1e852c245af78ed8f8af4c183e70c138cee5ff1a9ff00e123d37b5c29fa579a5cdd69f6cac6599c9ce254584fcdfed0ec28b6582ed19d6455942e712210644f7f7a3dacd2bdff0002de0e9ed73b0bebd4b84bb36ce3cc707cbce0f27bd65d825dc56eab752f9b2ff13600cfe5586d668fe5182f2000e444cca415f553c5635e7da6dc32064650fcec1f74fb55c2b5593b292fb853c152b6a8f68b5bfb386d624370a0aa006a51aa59bb6d138fa9040fcebc14df5d216fdf3ae7ef00c467dc521d52e55909b990301c1dfd7eb5b5aaf91cfec29aee7bf9d42d075b98bfefa14e1796ccbb84f1e3d770af9f9759bc2842deca406ebe61241f4a9a3d72f11db7dc4c50fdec39cafb8a5fbdf217b083ea7bdfdb6d7207da22c9ff006c53ccd10eae9ff7d5787c1accb7122225c4e65e817710241ebec6b437ea984db2ce431f91cf7ff65bfc6b39569c77468b06a5b48f6059637cec914e3ae0e69c5d07561f9d78d35eea70062d3cf1a96da430c98cfd31c8a56bdd5816f9e5dca3e650a0e47f7978e7e94bdbbedf88fea2efb9ecb91eb46e15e38357d670aa667638ca92b8de3fa1f6a6a6bfabc472b39018ed0c50800ff75b078a7f58f20fa84bb9ecf45145749c01451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014540d36c6219187a1ec69e928738dac08f5140588af6e859d9cb72c32b1aee2338cd5682e1eeec60b89136348e1954af20678fc7156e58a1ba88c7222c899e41e79155ef66923f296189647de1882e176af7345f40ea5f145028a4b600a28a2980514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514573be21f16e9fe1d01262d2dcb2ee5823c67f1f4142d40df7758919dd82aa8cb3138005713ae7c47d3f4f2d069cbf6db81fc59c463f1eff00e79ae235df196adae131b38b6b527fd4447ef7fbc7bd60c30bdc4a218232cec78039ad143ac8b8c6e684f7da9f8a75259273e64d20c6070a83d00f4aef741d18693698758cb9196651824fa726ab787b41b7d3adfcdbab751391967621bffd5497f7f6d79222179d2d8ffab718f9241ebffd7af3b1388737c90d8f42850e5f516faeaeaf46ed9125b920213b4b42e3d7eb55d96f449248f6b01902e27882afce3fbf501368033bacd9fbb730803a7f7fff00d5498b5de02cb334a833149b41f357fbbd79fc6b9d2b6876a56d11318ae5d23436b04840cc52320c48bfdd3ef48cb21dc7ec31aab9c03b4e626f43cf4a87659154db3cc90c872a4aff00a87f4ebc50c20c48c669339c4f1f97f7c766eb5450f60c0bb49a770789d06ee7fda5a615dacb9b22f2819072712a7a7d7eb4f0079a047a83199573139538913fbbef4d50bb22dba894898e632776627f4353fd7502a4d6b612804d9c815bfd5397236b7f75b8e2b02f7466919dd536a21c32e7943fe15d5179764ccd7ab8cedb84dcc3e8cbc52eebcf3b6adf4524aa991961b654f7f7ad215a51d98a508cb73805d39ad1d8047e4ee61d73ee28e79ee7b1f5fad771224f2c31c62ea231484f94fb9721bba9f515913787c323c819570712af98a761f5fa574c3129fc473cb0ebec9ceab94604311e847634e1773aa14123ed272cbbb8cfad5fbcd12eacb734be5920670ae0ee5f515944631fa1f5ae85284f6d4c250941972ca485ef1e6bc9df705f94b65b71adf8ee6d2448045aa3a803f7721520c6d9fbadf5ae44f009ed9e7da909209183c8e40ee2b2a9414ddee542ab89d834882161f6e90206cca803651bfbc3da9c5df3283a88672b975e712afaafbfd2b98b4d524b408c238e465fba64c9e3b8fa56826bb6a4156b38d63272a149cc4dea39e95cd3a125b1d11af17b9f43514515dc786145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001d4546116304a8033dbdea4a6f56cf6ed40814607f3aa1a8dac7732d9b4809d93820678e84f3f90ad1aaf75f7edff00eba8fe468bd8658a28145240145145300a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a8e5963863692575445192cc7007e34012551d4354b2d2ad8cf7b7090c63bb1e4fd07535c7788be21410235b68ae269f3869cafc8bf4cf53fa579c5ddedd5fdc35c5edc497131fe273c0fa7b55c60d8d2b9d46b9f10f53d40b43a6ff00a15b9fe31cc8c3ebdbf0ae3de4672ceeccec4f2ee724fe34d66ebcfe54d1ba4902281927bd6a925b1a28a43915e695634059d8e00519af40f0f786e0b287ed52c9279d8dcd9ca85c7b547e19d0db4f84dddc3c7d37312a3007d6aeea37f0dd3986279414c3c4540c4c31c8af331589727c903ba851b6af71f7d793dcbc31db4b1a40e03432871976f423d2a9b1bb7591d961da7e59906cfdd9fef0aab8b0c05dd30b798f5c0c4327f4a5dd6ff33b098cc9f2cb1ed1fbc4fef1e6b9146c76a491676dff0098998e279e3191c2e274a679570c8104118899b31bec53e537f76a3f2ed77222dd4c32375bcbb3ff001cebfce9b8b268f7b4b2ac4e71347b3fd5bff7baf14ca266fb4e5ddf4e4208db3c423ebfed0f5a6edba0c83ec31b4d18ca49b0e244feefd698447bdf176e678d79250fefa3fcf9a684831122df958d8e6ddf04794dfdd27fa51fd75014ae53fe3c36c321ca1dac0c4fefcf4a42c32ed269d8c0db7318ddf37a32d27eef64b235e7ca4edb98f0c093fde029f8984e02ea486645cc6e4b6244f43eff004a3faea045b9772afd933328cc4db9b1227a1f7a8cbd9edc0b7952066ca36fe637f43c702a6cb989026a204123e5097398dfd0fb7d6867bb1e6b9bc8cb8016e230fdbfbcb4ae515d9ed32de65acc0f4b88c30e3d1d4639a69fb3061b5666900c464b0c4c9e84e3ad5a1f6e1246a2ee179546e849753e6afa353375d345b84f08819fefee4cc2fe9f4a7702a15d3d9400d70919ff0056f804c6dfdd3ed55a6b5d366c9749d08ff5d1aa8caffb63dbe95a6df6ff00325dd140cc17f7d17c9823fbe3dfeb4dc5f662082dddf1fb9970bfbd1fdd3ffd6a6a4d6cc4ce6afb4b84384b33248c7952f80245f6ac996da48f04a617d7d0fa576cc972623fe8b1ac65b90146e81ffc2864bb323f99610b3edfdec7b3fd60fef2fbd6f0c4ca3bea653a3191c0b023191df91e94c6cf27033fcebabbcd1e7bc78cf945323f76e8980dfec9f4359736837ab1b32c1210a79f97953fe15d31af07bb30961e4b6d4fa3e90a8db8ec7d29d456879014514dc9dd8c718eb400ea6a8da319279ef4ea2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a4a000fa0a00c50296810555bcfbf6dff005d87f2356aab4f8f3edf8fe33fc8d032c8a28a29200a28a29805145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005159bab6b565a25afda2f65d8a785503258fb579bebbe3dbed5227b6b15fb2db38c161cc8c3ebd0669a8b60b53b4d6bc6ba4e8fba2593ed5723fe59447a1f73d057986bbe21bfd7ee4c975294833f24084ed5ff00ebd6577f95793dfa9a6b809ccb2a47fefb7f415ac6091564b7118e060600a63139f987e7514da85942080ed2b7b0da2a18ee351bc216cacd87fb407f535772b9afb168a305cb9dabeac76d569ef45a0530c90b827e6ce7356e1f09ea977fbdbfba8eda32792c79fd6a5974bf0e6976d2379c6f2e829da31b97776fc2a1c92dd85e476961ad4f7fa5c125ac21a28d764f16ddc5b3de9fb6f1408157907cc825d83a7f74ff00f5ab0b4d68edf4b82fed595a275db72abc0f7e3b56b8b74263b717ca030f32d5f27287d335e656a0a0eeb667ab86aaa71b75458f3676dd2b59af9527cb2c66104a37f7bdff001a43f6c1b54daa35c43c87f2b8953d33daa00144725c1b98f6336cbb8f2c327a6714ff00b3ca254845fa19631bed9cb9e57d0d73bb1d02e5ca95fb0a0825394fdc9fdd3fb8a0c9307323e9e85d06d9d361fde2fa834c215a1693eda9f6699b6ccbbcfcafea29fb2e84bb57508cdd40bf29de70e9e868d0633e701625b34c8f9eda4dadc7fb279a6bc9191248da6e217389d3e6cab7a8f6fa53f63344805fa8b59db2844a72927f87d69dbaf44924a6f6333c436ce9e6f0cbea3d3f0a2ffd6a041bcee506c81b98c704336254f4fafd699e65a140bf656581ce626de731bfa1f415600ba023853505da4efb693cd1927fba7d7f1a42f79b2593ed09b1be4b84f387eecfa83da95ca2032dbef73259b87c62e630f9e3fbca3bd3775b0dbb6390c8bcc0fe67122ff749c55cdbaa0745f391a68c663cb291327b8feb51817cd1fde1e448d957ca9313fa67d28d3bfe2055ff00897b0fbb3a5bb1c9391981ff00a53585a7cccc93f9a38963f97122ff007bdff0ab8e7510eeed6a8ce06d9a108a778fef0ffebd3365f0f2d16042cbf34337943e61fdc3e947f5b81544767f2aa4f3e719826da3e61fdc3cff003a8f161b72cd3ac44fef1367fa86f5eb56c9b828e5ac104321f993c9e627f5f71485aef7ee6d3e269d170e3cb38993dbde9dff00ab858a863b6064ccd21980cb2f97c4e9ebd7ad376591f2ca5f48b19ff512953fbb3fdc273fcea73bf6a20b38c2139b790c447967fba46698f230691df4b4da7e5b98829e4ff78517feb402031da946dd70e141fdf42108da7fbebe9418d37b01a86e9b6e55b042ce9e87dea5df2031a8b18ccc066193071227f77af5a8d9e131b13a76db72dc7decc327f87d28bbfeac2b1edf4567c1ad69d3a8297518ce0fce76f5fad5e0c18020820f715ea9f383a8a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a002a9df3158a32091fbc50706ae553bf1fba4ffaea9fcea65b02278f3b45494d4e829f59d25ee8dee1451456c20a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a4eb4b45020a28a28185579bfe3eadc7bb1fd2ac55697fe3f2dfe8ffc85080b345145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145002573de29f113e8902476d0f9b732825777dd403b9ad8bd8679ed5e3b7b936f29e92040d8fc0d788f8dadaeadfc44b6235292fae180dcec30549fe1ea6b4a7052dd8243756d4defee4dc6a97eb2c9d803bb6fb01d0563beab0eec5bc0d29edbb9fd0557074eb4320bd8e6b8955b01508dbf9d2bf8aa4854a58d8db5a83d091bdbf5e3f4abbf44572bea5b8ed75dbf1b6281a28cfafca29e3c3d676f96d4f56407fb919dc7f4ae7aeb5dbfbb3fe917733a9fe12d81f974aaf1cd2c92855e33d693e6e80944eb56e741d3ce6d6c1a761fc529c0a8ae3c577240483cbb74f48939fcfad62a5a349cb1639ab71e9a49c85c1efc5734aa7766ca372bcfa85cdd36e6692427bb1cff003a87cb9e4eadc7a7ad6dc5a5b1ea2adc7a4fa8ac5d68ad8b51ee41e19bc6d3a736f312d6d370e0f63eb5d342b15bcef6974aed6f27cd03ab630de99acc4d35547ddad54805c591b6909dcbfeadbd0d28568c9f2cba82fddcb9a24fe741feb4c12fda23f9678f78f997d7a73462c7020026f298efb79778c86feee71c536daf6ee62a23890dd5b2ed91360ccab539fb46d2a2dc79139dd1b7920985bdc561520e2ecff33d584d4d5d11196cf99cc13eff00b97516e1c7fb58ef462d32221e7ee5f9ad64de3e61fddcd4bbef8379cd66a66846d994c5c4abea0d26db965f245b0f2e43be093c9ff567d08ed59dff00ab9445e658106568a711c876dc202311b7ae293fd1b76d1f6837110cc4db86664f4cd4de75eee339b05dca365c4422fbe3fbc0f7a3fd2f02016a9c9df6f2f91f73fd93e947f5b815f3a615c0fb40b690f278fdcbff004a09b542cc44e6e138923c2fef93d7d2a7335c65e76d390a1f92e21f27927fbc3d69a3ed594885a46654f9e197cae0aff74fa5177fd3021f2ec4ec45b99d636e609b60f90ff7739a6116655dd9e5009c4f0f95c83fdfc678fc2a66918a3bb69ca2de538923f2ce637f5f7a648f72ac145a47f6988677796712a7e74b5feac034243bc05bc632a8cc5218ce244fee9f5a679769e5ae2f36c0e7e5054e617faf61589776fa9da18afeca491e0de58c2508da7b8af43f0dcda778874ef316d15264f96643277ad1d376ba7730ab88f66ed25a1ccec00cae6f10cabc4e986c4a9ebd2811f30aa6a8a075b590b371fec935df7f605a960df65c91c021d6b235ad32daced4a47a79676391965da3df8142a536ec47d720728c098a4637cbe596c5c441dbe56fef0a76cbb13055d4a3370abfbb6f30e254f43db34e962862d8cd148f723ee92f8120fee9e3ad56c69cc8731ce90139560dcc2fe9ec294a0e0ecce884e338f34476243003fda4a2d59faf9c73149fe14eff004df3a5cdf446e15712a8978913d7d8d405ecb2ccd0ce660313c208c48bfde1ebf8534ff67fca81e7d879b69c91c1fee1f4fc6a6dfd58b33ed740d66c9765b6acf1c67aa3fccbf4239fe5572cdfc55a3b036f771eccf3b2628bf88231fa557b6d7cdc646ec614b671e9cd5d3aca5c5bb47bf05979db5ee5d5b53e5799ad91d2e99e39d7630ab7da68b940399212ae7ff1c27f956e58fc42d1ee9b64e26b6933821d7207e5cfe95c169d2dbdba1259773f7f4a7a5a5a5d4af2b1f99df390c4567248b52d753d6ed355b0bec7d96f21949fe15719fcbad5daf11d5ad60b1b313c3348d2170aaa581ebfad75fa6c97b6b0a797a8dc83b4654b6f51ec0366a795bd4be65dcefe8c572e9afdfc23f7904372bfec1f2dbf5c8fe55693c5963b73710dd5bfaef88b0fcd7349e9b8277d8dfa2b9cbff13d81b5db67a842277e0311f747ae0d665a5edcb48d37f6a4b239396008dbff007cf6a16a173b6a2b9d8755b839db306c7f7c0ab9637d34d725656428df7428c6d3405cd6a28a281851451400514514005145140051451400514514005145140051451400514514005145140051451400554d478b3271d1d0ff00e3c2add54bff00f8f36faa9ffc78527b01614e40c53e989c28a7d674b61b0a28a2b510514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005151c6e5d738c73eb9a92800a28a2800a28a2800aab29ff4fb71fecb9fe5566b344b21d52312a04f9182f3d79ffeb526eda8d2b9a745266915830c83c52e6421d4514550051451400514514005145140051451400514514005145140051451400954a0b8792eaea3620ac6e02f1fec83fd6aed66599cdedf1ffa6c07fe3a2b3aaed06d15157b9a2a734ea88ba4519791951475663802b1ef3c5ba4da123ed06661da11b87e7d3f5a549b705715b5d0dda427032781ef5c25d78ea79dbcbb0b30a4f00b9de4fe038fe75734fd3352d40fda35891e653cac05b0a3eaa38fc2ae52e55a96a937abd0ea16eedd99556542cdf770739fa558cd79b6af75a8fdb12f2c66402dd8a88900da71d47d6babd0bc456babc215245f3d40f3101e54fa573c6bebaec69530ee2aeb534356d462d274cb8bd9ce12242df53d8578035dc935c5dead3b1696463b093d58f7fc05771f1435f5b89e1d0ed5f73290f3107b9e82bceaf640196042364231f53dcd7745da1a75221128c9cf5249ef503aafe26a766ebfceaa4c70a738cfd684ddcd3948369965d8a3249e98ae8f4ed10021d979c541e1dd3bed121b865e14e16bb7b5b4000e2b9f115b97dd44c56b733edf4c03f86afa580007cbcd6ac566e7a21a90c2637d8c39c66bcf6e4f52f9919ab6800e9532db0f4abc23f6a708ff002acee55ca5e4018e2ac4766cc038207bd4a539ac8f1247ba1b788b36c2092031157463cd2b3224ec876a1ba09c5e5a4a0cf1f0fb1b391e8715244b1c96c8ff006945b3ba3f759ce6393d457196d76744d5632373412a91227b7ad74f1886d6e556425b4eba1c951c29f5af42a53738f9a35c3d6e4972bd99a262ba12b30bd88de5baf27cc3f3c7ef4c302989505ea7d8ee1b31fef0e51fdbf1a68101cc61e7fb4c03744d819957d2909d3f6872d37d9ae0e245da3113ff00315c16feac7a89a240973e63b8bc885dc036c83cc3874f7a6fd9c794918be8c5a4cdba13e69dc8fedffd7a6ecb6dc504b71f6ab7198d828cca9f9e0d347f66950f99fec97070ebb46227fe628feb6026d9702592537b0fdaa21b675f34e1d3d7eb4df2182450adfa7d9e43baddfcd3946f4fa7d69bb6df714125c7daadc6518aae654a611a6ec0dbe736931f9c6d1885ff00a52feb61e84c45d06964fb647e6afc9731f9c4061ebec68115d288a15d4176fdfb57f3b93fec91dea2db6c188f32e0dd41f74ed5fdf27e7cd34a69a54625996da63c1d83f72ffd28feb60d0730bcdb2cad70a6363b2ea3fb401b4fa839e2b09ede7f0a6a0b771cc8f6929fb9e603b81f6adb296d976324a67886255310fdf27ae33504969a6bc62d9ee5dada619898c7c467d339fd2ae9cf95ff00c033ab4e3523cacd4b5bd4729711c9bede4e87d3daba38a359621d0a915e656172da46acfa7b8964b690e012bce7d4577fa5cef0298e664f2faa92dc8aee9548f2a6d9e24a94e9cec477f60636dc3a7638e9ff00d7ac691af4cb23adba4a00c4a8b10c38fef0f7f6aeba49eda58ca99a3fceb0750851626916648caf470dc7e3ed5954942a477d4e9a15654e5e463b0bf511aa5ba7983e686530f51fdd3e950bbdcf97239b05f25cfef62f2798dbfbc3d6a57b748a21baf112dd8fcebb8e627ec47b535e1bb370ecb7f135ca2fcc0c842ca9fe35c3a23d64d3574739aa697069722cc2d2327ee858498db70ebd38c639e9deb3e348e49bce496e600a72c8e81c607b8c63bf6aeb752b360bbc81e575553cf41fa5528ed20961478f8f3368c67ae79ff0af65547d4f9ae5ea6106d49b2f6a91cf09276f90407fc54fcd52d8eab702e1d5e3912444276c808c9ec3eb5b2da1050485041e48c539b4e91e15457de839c483783ff7d535522f56274fa1836fa9bde5ec4d3c80b237c9131c73ef5d141e276cf39e3be6a9ff006429bb599ad41941ddb91880703d0e6b366f0e27985e1b86424e4868c8c1faae7f9555e2d68c9707b1d8dbf88c39fbfefc9abb1eb51b8e5866b85b6d36fede29d4bac9e600176b6e3d7d3ae3d6a0b47bf86fa38ae519577724ae3a516b8b96c7a7c3a8c0f83907eb5a105c5bb7242fe22bc89f59b8b6918481d7073935a27c492594aa92b953b558e7b646684277ee7aa7d9ed2e0e7001f543b73f95565b2bb82eff0075a94cb0edca92a1990ff515c4db78bc2aa97618619073d6b4edfc590cad9693681ea7149d813923b0b5d4a6b39228750d47cc9a790ac2e1700f19008f5adb8ef188041571ea2bcc0eb106a5add9946cc7684c8efdb3d00adafed4977978a420e78c1a764d5c7ccfa9dec570246dbb48353571165e269e197370a2441e8306ba1b6f11e9d7181e7796de8e31512562e32d3535e8a8d258e4198dd587aa9cd4952585145140051451400514514005145140051451400514514005145140051451400555bf19b19b1fddcd5aaab7c76d84e7d109fd293d809d4f029f51447283e952d6549dd0d8514515b0828a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a002908a5a280238462141ed525323ff0056bf4a7d240145145300a29314ce58e0700753eb49b0158ed19cd6748de6dfc78c3855e703a1cd4f7d2245012c01e7804e3358f6173e65d1577dafd467818ae4c45471d0de942e9c8dc3285976943d339a48be567c649cf4ed54659dfcddcac7038183c1abb6f209146594b0f435952aca52e562941c6372756dcb919fa1a92a30801cf434e24038f5aed8bb6e64c7514515a0828a28a0028a28a0028a28a0028a28a00292a85deb3a7d8ffc7c5dc6adfdd0727f215cf5df8f6d5322d6d64971fc4ec147f5a16bb0d26f63b0aaf757b6b651efb99e3897d5db15e737de30d52ec158e51021ed10c1fcfafeb5cf4b7124ee5e4919d8f72d926a945b34549bdcf46bbf1b59acbe4d85bcb7929e9b46d07fafe9587a9ebd2d85c4863b9496e6525da385cf9711f7f535cd5bdfdcda433470bb46271b5f18048faf5aaa8085031f90c53e556d4d214eccbb75a95ddf3efb9b8794ff00b47207d2a3b7866bb9c450c4f239e800cd58d2b489b54b8f2a1da075676e71ff00d7af49d1b42874b836afccc796623927fc3dab294d47dd8ee6927182bb33b41f0b41691a5c5c6e7b8c672dfc27dbfc6ba2b981e5b668e190c6c4704558e8296b3e5efb9cd2a8e4ee79e5d69d369d74ef1e727efc6dd1ab9ebd0ba7de2eb7a74cb1ed244f1b3118383dbbd7ad5dd9457719591467b37a578c78f418354fecb8940738de4771dab28d0b4ced8e214e367b9cd7daa4966b8d4a56cc8ec7664773fe159eedc73ce7d6acddb2865893ee47f2e7d4f7aaadd6baee96c6566c89c9fc45568e36b8b858d016666c0a9276dabc75adbf0b69de6cc6e9870bc2e7d6aa53e58b91323a7d234f4b6b78e351c28e4fa9ada96e1ec2cbcd8a1491cb6007381d292d60da071526a6a059c63d5c9fd2bcc8cb9ea5d912d11c8eabe2dd7636f2c795006e9e52ff00539aecacf7bda5b3c8c59da046663dc9ae2758891ef2dd19770dae79aef2dd76c30afa4283f4adebc528684add122a75a368151ddde5b584265b995635ec09e4fd0561685e264d56f6e2da4215f7168874cafa571a849a724b445b66fe39ac8f100f9adc7fb1fd6b6b02b1f5e189e21ff4cc56986f88537a1c3ea6bbb518d71c0435d8d9dba4ba1db42c3efa939fc6b90d449fed51b50b623f5f7aee2c17fe25d63b860f944e3f1aed9c9c637443dd14edee1953ec524311bc858b42ef93b87a5593790166b8fb0a792e36dcc633b95bd699a9dab3aacf09db3444329f5f6a741a85ddd837b0ab38fb93c21471ee2b0ab1525cf1ea7a586ab7f71ee279cac041f6587ce4f9ad9f2d865f4ebd694de4019a71631f92ff002dd273b94faf5e952e35108b6cacfcfcf04e1073fec9a779faa06fb5790f9c6c9e0f2c7fdf438ae6feb73b0afe72e16dfecb079ca775ac996dac3d3af5a3edb065a7fecf8cc67e5ba8b272a7d7e95304d536fd98b49b58ef827d838ff64d3fced5cb7da042fe627c9341b46187f7851fd6e055f3d4ed83ec907980eeb5946eda47a75ce68fb6dbe2494e9f188dbe5ba8f9dca7d6ac14d4f6f91ba5f2a43be19801946fee9f6a469359dc6611389a31b658768c3aff007852feb702bf9d18d91fd922f397e6b6937b6d75f4fad31a7b160ecd63fe8efc4e81ce637f5c55ad9a99511665f29cef8a6da3319fee9a3cdd5f2d2b5b9f313e5961118c483fbc38a3fadc0acb3c68f1edb443770f303b3ee5917f1ea6ac1f11dc03e6111790dc64c033137a11e9ef4d6fed10ab16d3b58ee866312e50ff0074f1c534c9a812f3b588c8f96787c9186ff6871cd1a75fcc99d38cb71e75fbb2850c16cd3af253cbc075f5539a636bbbbe6305a9864e0398db0adfdd61baa326ef2911b74ddf7ade7300e07f74f1c546d713e6491b4f8fcb3f2dc4222eff00de07bd165d88f61133a1464d42e2e9dc92dc4966a300afaaf622ad0fecf2150493888f304dc7c87fbbedf8d4a64994c718b587cd1f35bcde59c11fdd23b534dc8fdeca74c8fc96e2e620872adfde1eb54e57348c147619e29d427b1b5b6681461dcabe577678c8fe55963c4f0c778b14d6cb8d815d57e5fa0008edf5ae8aeedfed511825f99d1811ee0e707f9fe558b75e1e8e5972c0ee6ce09f5af415ada9f3dadcbb69aed85c5b92d3347b4e0b4ab8ebd338abf6d25b332a433c72c6ff0074ab8620ff00f5eb969f40db088402aeef92f8c678e39f5eb5464d1aeacdc379e130782fc5572ad931dddcefe6b72d808a37021bae28168936180c1f5e841ae29af355b6b83e45cc89128daa177303ebdb1d6aedb7896fe059da642e02e72d1e327a0e94723d82fa5ce81ad12752191495254f1c5322b0114be5ee60a4647271efc74fff005d62c5e2f96e2645fb343183f2f058e7f3c55f4d4ece790bcbaa3c4ea36ed116c07e879a5aa77016f745899b6cb0a3a9f41b4fd38e2b2353d122b942583c6c46158aee1f4e39fd2ba0b83a6c8418ae5e6dc771324ccc5bd873c1aaf3c16a912b46f2e7ef0ccac7f4269a9b5d4564ce3f50d267962822b768a69605f2d9627f99bb9e0f3fa5529209a0d33e75912759492aea410b8ed9ed935d15c584b9f3576be64da7201c13556eafa6126c89818c1da22601940fa115b2aba6a43819565793ad9dcca0b6210a5769c72481cd5db4d7ee591ce4808bb9b3d87f934fb896d6d8ac66c51b7ae6431931f5e831d3a7b54b6fa7d9adbc9b249d12e136ed750c719c83918fe556dc191665cb5f12b15ce1580ea41e95a706bf03a8573826b998b497862ba093472178ca26d72b93c123071d71554595cdada5cb4e93452460140eb8efcf07dbf9d2e54f6633d16d75631e0c33b03e80f5ae96c3c4776aa03c8ae3fdaaf1287519e0557e0e5b07070456dd86bd71b5f602db17790c40e054b8b4347b249e2cb6b5895eea2650cc141439c935a96bacd85e7115ca6efeeb7ca7f5af0ffedf7be9237948291f288bcf3ea6afd8ea8cf74b96da33c93c567ca5a67b852d70f67af14e56e3e5cf4278adab3d7bce855d9918b138edc501737a8aa51ea513f5047d39a9e3b98653849149f4ef40c9a8a28a0028a88cf0a921a54047505871409e23d2543ff0214012d14808238a5a0028a28a0028a28a004aaba8ff00c836e7feb937f2ab2580ea7154eff13d95c408c03bc6c809ec48ace752315ab1a4c92ddb744a7d45591d2a859ac915ba2ca416c72455b59508eb5c946a454acd95244b45341a7577269ec4051451da980515c35bebda925c98dae778dd801907f857676f234b6f1c8d8cb28271459dae2b935145140c28a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a290f4340091ff00ab5fa53a991ffab5fa53e800a28a62beedd81d0e28012424fcabd4f7f4a8e4c8e1491b7d3bd306d5b9e01ced3dc9c9ff003fcea95e6a6b0423395761825b8fcab29c925765c62dbb232356d49a4956db1b7fbe7ae4553b733cb785b7615380c7a9aa26e59eeb7960d19393bb86c1ad6b6847980f3d32493d335e6569bbdcf4e9c5244a97523dd38380bc6dc1e83ffd79ad4b79b68c60f07bd652e0c92a81bca0e3d73fe7f955a8e42e1403df04d7237677429c5346dc372b280475f7a94805864e7159e9b954316e170063deae80bf2b0e39e6bd3a355c9599e7ce293d0b028a414b5deb6320a28a298051451400541717305a42d35c4ab1c6bd598e0555d4f57b3d220f36e64e4fdc8d7966fa0af36d675fbbd5e60646d90a9ca44bd07f89f7a695ca8c1c8dfd4bc712f9ac96112ac638124a396f7c76ae72ef5fd46f7227bc9597ba86da3f218159449cee3dff000a4c8ce7bf7e2b4e447428244864ddcfeb4cdcc47279f6e69b907a73f4e6827b13f8134cbb00f427f334b9c0c6303f2a4ea3b81f953d50bb0006493d864d26ca486aa927fc2ba0d13c3575a94892c91ecb6ce4963cb7d3fc6b47c3fe14fb4627d423703aac6ddc7bff00857776f6f15bc6238d42a8e805734ea393b449a951434ea4363a741630ac70c4a807602ae76a5a2928a8ec7239393bb0a297b5255324a3aadfa697a65c5ec98db0a16e4e327b0af9f6eb529af6f2ef549d8b4d331d849e84ff0080af40f8a5ad9736fa25bbe4b1df305ede82bccee9fe6112e36c6303dcf73423aa9479637ee5663eff005e6a163dff001a7b9fceaa4f27181569ea68f412247bab948635cb33003dbdebd2f49b15b5b68e241c281dbf3ae5fc25a696cde3af5f953fad77d6d16d038ae5c554d795195eeee5889428e699a9e3ecb0ff00bc6a761f2a8f5205676bda8dadac70a3caa5c6728a7247d7d2b9e82bcc99ec72bac3aa6a50ee38cc4dfad6d6ade2bb6b388c566de6ca63550e3eea9c7eb5c9ea5a81bc9bcc8c04c0c67a9c55372cb1ef3b463a679af4fd92925cc42436faf66b8777b991a591bbb7ff005ea85a5d4b6b7d1ddc2ec1e33c01de890b4a467249e7342a9087902b4e556b5819ebfa46a71ea96115cc671b87cca7b1f4aafae737607a20e6b85f0b6b2da66a02299bf71310ac31d0f635db6af206ba27390147f2ae1547d9d47d84e5d0e46e5776b121ff00600aeeadd716f68be908fe75c05d5d4706ab379879217000e6bbfb69a392384a303b6150707383e9555fe01fda43dc6e2462b0aef769b74f3a02609789d09e0d6f6719f5aab3c427560ca083c107bd72d0a8a2f965b3364da7cc8856d31e5db35da79720df6afe67cca7d2810cdba5b8173009a3f96e54c9c3afa9acfb48a3174da6de48cb1905e193ba9f6abc042e8d3f9d27da6dced94797cc8bee334eac391ebf91ea52a8aa46e2b58aec8a0fb6c5f6794eeb76f33e646f41ed4bf6798c924a2eedfed708db38de76ba7bfbd345be9c02c26e9cdadc7cd19f2f88dbeb9e28f2adc9763732fdaed7a910f32afd33cfd6b2bff56340fb1c22344fb641f639ce62fde731b9f4ff00ebd3bec93995dbed96ff006e807ce77f1227bd44534d52a7ed0ff63baeabe5f11bfa939e29de55b1262fb64bf6cb6e6393cae645f41cf34ffad82e843690f94b8bc83ec539e06f3fbb7f6fc7d6a4fb24e2661f6db7fb742383bcfef23f7a6634ef2fed22793ecd39db343e5f08dea79e28fb3da1905b1bd97ce8c6f826f2fef2fa0e79a96ffab009f664f214fdb22fb14adc8121cc527b53cdbde99d80bd88dec2bc666ff5a9ef51634ff29aebcd9444e76dc43e5743fde233c529b6b5de2dfedcde628df04de5f51e99ef43feb41886097ece00bb53672b769ffd53fb7e35218b5313122e54ddc6bf77cd18953e99e2a00969e4b5c1b8f918ecb887ca3c1f5c76a7fd8e12eb07dbd44a06fb79b69e9e99ef45ff00ab00df26efc8005c37d8e46c86f386617fae7914f31eb1f682c246fb5c6bf77cc18993d71eb50b456bb5e6fb4c7e513b6e62d8dd7fbc0638a46b341711c1fda319931bada5e791fdd27bd2bdff00e181d892e6f6e6da449674b7870a430790900751d075a4fb66a7776ccf1e98b8072ae64dbbbd080c01ab16fa74122acedba4b8da36cb21c9523dbb5682b19d70782721c7a7a8af4dd8f9e5a23202fdaf11de5dc90248728821f2c1f6de720fe06acd9d84513bc2f6eab3a9cb48792ebd88279fff0055682a227fa3b283038da14f207b1f635564b1923fded848d094040887ccac3a9001e9ed8a398059eca342242bf274618e9ef51cba3c73c648451e9c75fad4e93dd1803cb124b13aff00cb318719f55c9cfe073ed5369b7b6f2c29179e9e681b7631dadedc1a5aa57031e1d0e127291287271b4f63504be14865425372c8bc36de39ae94612fe45f5507e87fcff2a9ae942c91b8e379d8e47a76fd7f9d3bbb583cce2dbc3866753e7488570aa4a83c7ffaf350dd5b5fe9d19d90c3758e5836471f4fad7673c79532e30621b8fb8ee2b3aea3219a40016ebc771e9473dddd8b94e2e3d66682ce6f3ada450a40f2c1ce49f7c76c55386e2dafe72f1b796c8373975c617d4fd2b76ec426e4c607ca54be3b555834b859663b142b8c6ec56aac46bb94d228f509f7a18ddc8c7cadbbe871daadaa5cdbde078d0b42176b21527a753f4eb490686b04e2782461b41ed9cd58b5b3d5ed1908d4267813aab1ce07b668bdc6ae55d420320846e63180782b9ce7fc2a4f3658608522919588dcd83907ea3a74a9e06d599d967b7b79221f31ca0f94138edfe78aad2c826bcf28dac919070bcf5fc685e43f265a822495ae606855113637ee9421cb75c76fd2a69b4689222ef014f3546e607771c7d3fc9aacb7605d5d1c48c65508181c86f735b906b3a649a3ac324e1648c05c14383d3a1aa736b527951cd9f0e3b3b1b7752bb8e149e47e740b0bbb5b59772b6fe36e474c64f19fc2bb3d31609e49024d19ddf3290defe95745824b1ba32ed2a7040f7a4e60a279f1bab9b68202779de0ee03231c9ad3875f92d6e4c0d236e56dbd383f8d6f4da6c7240aef1a300707231df15467f0f40d3ac9b595fa82307247e5473458f95a2c5af8bdc360f63ce0e6b6e0f16da6dccce001d6b89b9f0d82d234676cac7259d8803bf1c7f3aaafa4dfc16c02aee757de1861c6318c7b51ca9ecc9b33d5745d74b5a179266569246754639daa7a0ff3eb5b4355c46cf8470013c715e24f7f7d691c5f2b6e03e719c106af47e299edd6212332ef4ddcf3dcd0e2fa06a6adc6a124b2191dcef73966cf3cf3435d8760a0e0766039cd50500c433f38c7193cff00f5a9e1963038018f4522a2d61a67a4f84eecdc594d164911b82b9f43ff00eaae8ebc9b4fbab9b4ba85ed2e5e00ed9936bf18c7a1e0d76567af5d088199e29bf0da4fe238fd29b651d3d15cdc3e34d25a7782e247b69518a9deb9527ea3fae2b6adafad2ed775b5cc330ffa66e1bf952ba02d514514c0ab72fb5d47b542d26472054b7271329ff66ab3367073d6bc8c53b5467453574588a40dc62895c00074a890ede7344df375358a9683e55cc5a89b2ab538aaf064c6b9ab02bd3c2fc2613dc2834515d449e6aa36de907aeefeb5e83647363011fdc1fcabcf1db6ea327b48dfcebbfd2ceed2ed8ffb02adfc28845da28a2a0b0a28a2800a28a2801b919c77a14e4670473de91c9041c714d80968118904919e28112d252d341049c76eb40c7514d52186474a75001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145274a646c591589073cf1401251451400535fee37d29d4c93889ff00dd34011dac824b68d87f7466a7aa5a59cd921abb45802a3ca95dca703d453c9c0cd439564233c71c0a96c0ced42e42c9e4e587ca188438279e33dc57397574d7702008819f0aadc8da40393cfd6b6f50264be58d39500990f4e9fd7a7eb58f359b4f23999408882170d962be9f89ae4ad3476d08e88cbb12b2dcacadb76b1ca30e857b715bd030323228562a46ec1e99ff00eb54105bc70289514e776001fc3c741f90abb0208c30545ce4b103bf15e6549f333ade88864611dc48d182ee13b7439e79fd7f3ab391b5f83c7231515c165b8e000ac70588ce78a9a35c82b9cf3c7d2b296e4f4b96e294c9108c039538cd5d8810a55ba9ef542d90a3b0ce5739ad1e37ed1d08cd7550d56bd0e3ab64ec8b02969ab4faf5e9bbc4e561451484e073d2b400ae775ff13dbe948f04244b778fbb8caa7bb7f85657883c62006b5d31981ce1a7edf45ff1fcab8792469199d98b31ea4f24d5463735853beacb17ba85c5fdc34d73334b237524f4f603b0aa85bb74a463dbfae69b9ff3d2b5db63a121738c9c7e3d2933939ebfad274e9827d86694fbfea68b956173ebc7b1340ce38fd06290649e3f1c0c568e99a45d6a736c8231818dcec785ace524b5634ae558207b899628d773b1c003935e81e1ff000aa5915b9b87df376c741f4ff1ad2d1340834b80008a653f79f1cb7f87d2b6b80302b9a5373f25f998d4add2242048b32aaaa8882f273ce7e9538a323bd1c54c524f73985c500526451915a73210b55751be874db09ef276db1c2858d58ef5e6bf1475b0d1c3a1dbb66476124c41e83b0fd68b9708f34ac79e5eea135fde5d6a933b192563b327fcf41592e481ebef562edc061129caa0c67d4f73555db903bd348ec64323f07b7150db44d7d7b1c099cb9c7ff5e92790e081d4d751e11d336a1bb71cb7ca9f4ef4dc9423ccc893b23a9d32cd6de18e28c7ca80015ae5e3b685e595b6a20c926b0efb5a834a408a16598ff0e7eefd6b98d4355bbd45b74d29db9e235e07e55c70a13aaf99ec41bfa978b43868ec536edff968c327f015ca9b8967b87925767762492690678f94027f0a455cc80120fd2bd1a74a34d7ba4323607396c85cf3819aaf752077c8240e9c9eb56677312145ee7e63dea881bc9250920e726b40198500e09cf5fad290980b9ebc9e7a53d81c2e1793d39a4724927076fd68158849456041f981fcebb0d02e5f5c6912eb509bcf5c6154000afe55c97cc070a738e706a7b2ba9b4e9d2e2204367201fe551563cd1b2dc967a6c3a2d9c2de6012339eacce727f2ab8b0c70208e250a376702aa586a116a164b3c47871923d0f71565096909cf18e2bc8939bd24cd131e99691cf6ce29b18f9739ce4f5a23e138ea7a5229223503afad66d0ee636aa6179d6dcb959d81788007b549697514b66972d0c9f6cb7f9655560372fb8ef52ea1a5c17d7314ecf2c73407e5746c7d41acfbb492cef23bd886f018798a4e32b5d9071a9050bea6b4aa7b395fa1a4dfd9c1b012536375ceedc308ffd298cd0312862996eedbee0de3322fd714cfb5da2e545aa1b2b9e9863f2b7bd0678ca146b641796e7287cc6c327b573f2b5dcf514935a0a64d2a364b810486dee32b282c308df4c5266d4116ad0cfe6c6775bbf9a3e71e99c524b71665d6e56d545bca36ccbb8e41fa533cd008b46b68bcd4f9ad5f73608fae69d9f98ae59173658fb62dacb86f92ee3127ddf7c639a6816076dab452843f3dacbe68e4fa671c546fa844cc2e23b2412afc9731927711ea39a517568b1980dac3f6594ee824cb615bd0f35367d995724135ae4dc8b59bcf8fe4b98b78e47ae31cd34ff00678021d92fd9a5f9a094483e56f4e9c522de866128b38bed90f12ae4fce9ea39a46b9b3c716917d8673c618e51fdf9e296bd99571a66b732198db4c2e231b658f78f9d7d7a734a0e9c1443fbff00b34a774726e1fbb6f4f6a6c9390e10da442e61fba7270ebedcd245736843bb598fb1cc7122863946f53ed4da64df524636db8c852e3ed50f1247f2fef53d7dea155d30a0569265b498928c003e537f4a74b346ca909b551711730bf987122fa6691eeacd51e44b13f67906db852e728deb8a493f31b35ed3f74e60249e372b1fe21dff001a91331dd3c8c008a4c2eeff006bde9b28fdd33af0e9f32fd7d2ae22a4b08e328c3bf715defb9f3c88ae5336d2724103208ec7b5490932428eb8048071e94c8412e61739311ea7f881e86a46c5bc9e67fcb37387f63d8ff4a3c87d6e430af9578d0972c0832ae7b64f23fafe26a5bc44688492c692aa0f995d720af7ebe9d7f0a6cf03794d346abf6951b909ff00d04fb1e9f8d3d64fb65b2ae0aef1f36d39dbfa5310c7b19522ff00459cab0c10927ce99f6ee3d3d3da8374268125b9b59e255e4141bc2b0e3f879fcc5598dfcb468dfac60638ea3b53ad54c2a637e19d8ba91efd47d7bfe345c1904128b804248adb86d2ca723eb55e5842075c82d0f073dc76229cf6e535432dbb985a41863b728cddb23d7dc60fbd4d2480dd46b327972b37cdce51c11d8fd70707078a2d7038dbc4f26fa3cc7f7895e79c67a7f3a92d90ab3a06f957ff00d75a1af5bc71dfc240c8424904fb0acc4caea6f82482bb9be9deae2ee8934add02314238ea3e9522c418bc2df74f4f61fe7346c287701c6327dc54e222ae24dd91c2f4e83d6a19416589e395376587c8495f6eb52ff6747306431a9900c0c8fc8d36ce16b691d98ee4566c9fae31fd2b4a1ff8fc4247552a4f61e9fe7de819933e8d6c602c23dae38ca8e41acf9fc3d6d6fb8480aa91f2bf456f627b1fe75d50005e95fef26efc477fd7f4a408be6340e0346464061904771fe7d6a94d8ac72175e199bce69a39339fe123231e9504126ada7dc33c4d22438e8add874ebc57630c7f677166cd946cf95b8f3b7bafbe3b7b7d291acd198db8c818c823d3d28e6ee2b239487c477f15ac91dd5a6e5c8c60609c9f5e9fa5687fc25764f1c0f2c32c7ce48186fafa63ad6b49a7c722eed83087e75c6726abc9a15bccfb9d14a1e1481de8f758ec11ea5a6dcdc3c62e630580003707d7fad585b58ee602fc31c7254e7f2ac97f0c41979b05641d001ebd2aa9f0d4b6ab9b6b974320c0209e28697461a9b52d987b7f324c1c0e430cfe154aef4582545692dd4af75538c67bd67edf1058a18d6f1e57dd91bceee31eff0085489af6a704512ddd9249d7381f7474078a6b996c262cb12c4022075c1e0820e47e54cf39785552f8008078a491c4e0b04652cfcaf26963452769192bc739e3dab5f53327bc18b42c8a73c38d8791ce08c1eb5586a371109845791f0328af953d477200fd6b52dd5665895f2f91f366ad9d2e075841407cc0724f5e2a64d2dc6a3738e91ee23db24aa7121fbfd413f5e94f177e5cb9c94743f787041fad743268488ab2c05a12ad82636dbed546e7429007668e3949c16206c3f98fea0d1cd1b15aa25b0f166b16abfbbd42529d965c38c7e35d159fc44b95c0bbb38a51dda26287f239ae2a6b060653b648c9002ee01d54e7d460f6f4aaed1dd413c6ab11963380ce873827ae4751472a7b0735b747a849e32d2ef361ccb012083e62f1f98cd6ac1750ddc0ad6f3472823394606bc625bf62183fc8b1becdac0822b5ecf50b637108914c7e4a6deb8249ae4ad84e7d59ac2aa4ac7acc71beef9bb54a465b06b83b5d7aee3ff8f7d459867849be71faf3fad6b278a2f1a59a216d6f37941497562bdb24639e7a77ae478592d8b73bea75f1801462a6ed58963af59cf0234c4dbb9ea24181f9f4ad78e449103a30653c82a720d76d04e2accc65b92514515d049e6175c6a53803a48dfcebbfd19b76936c7fd8af3ebe60351baedfbe71ff008f1aef3c3afe668368dfec7f5357f60946ad1451505051451400537214807bf4a534840618a04324200ea0739e7f5fd2a3b4c2d9c6143150a31918269b731b496cf12900b295195c8e4771d6a3b39966b2b5d8ac9b94718fbb8ea0d005b42c50175dac7b67a524792b9231927bfbd399822966e83ad4162e1ad2318c71d2802cd2d579e558632cc719214103b9381538e940c5a293b500f19a00696c3600c9a6a9265603a28009f7a8d7fd61988393f263f1e29f00528594f0ec5a811351494b4005145140c28a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a2a378c373b981f66228019242923c6ed9cc6db873c6718e699a7b996ca363e981f4a7ba24913c25c90cbb4fcdcf355f49b67b3d320b7933b91704939268e805fa28a2800a8a738b694ff00b07f954b505d1c5a4e7fe99b7f2a00834a39b143daaf0aa1a491f615c76ab6e09230d8cf5a25b890d73918c0f308e066a9f9a618242a773a1e4e3ef7d3f3a95a78d652438c11c9f6159924e5d253976504fdd1dcf407f3aca6f436846e3635315b87dc0024e5c9cf27bfd066a8b70aa8cc1ceee581c67f0a9a590c712c7f36075507dfbfa1eb5465df1ba2aee6329c9da3a673fe15e6d7ec77525d4bb1be62491c02157a01458979061e2da0f231d7279e7f314aabf2285ec792dd8559824008607183b6b83a972d1682cb08c060ca31d88a86dddd9b1b557d2a7da158fccc4124f2734c2844bc1f93820d5a57213d2ccb51232c9ea2ae22e429dc78355e16c2f5cfa1ab11b63231c0f5aeaa29239aa36cb0a7071fc853ea34cf5c63354755d5e0d2adc49286776e1235eac7fa0f7af4e96c73b5ad8b775750d95b3dc5c4812241924d79cf883c5336aac60837c16c3f84b60bfbb63b7b566eb1af5ceb176cd33e154fcb0ab6553f0f5f7a874ed32e75291844a561419965380a83dcd75460dee6b1828abc8a64f1fe031fce984e78ce4fe75a565a47f69cd2cd6f32c7a541feb2fa71b41c75dbcd56bc30dfdeadb6976efe403b55c643ce7d70492056bca57b58b7a1509edcfe27152dcdb4f651a3dc42d187fb808f98fe1d6b71adec3c2d123ea1125deaae331598e5631eae6b02e279eeee1ee2e4ee91fb28d88a3d140e82a74ea353727688c1b88190477c31c539793c7e83fad0abd8639e9819aebf40f0a1bb097178cc133c47d3f3ac6a5450dcded657667687e1db8d4e557962916db3cb7193f4af47d3b49b5d3e25482254c7a55a8204b740883a0a96b0e5737797dc72d4ace5a2d85a4a5a3a5535dcc0c5d77c4563e1f585af9a40262426c4cf4c67f9d642fc48f0c91f35e489f581ff00a0ac3f8b4c4269633de53ffa0d7935cb61d597a373594a8f33ba674c611e44d9ef09f107c3f33848ae65763d0085bfa8ae96de4f3e14940215d43007a8cd7ceba112da9c20fa1ebf4afa2ac415b2801ea235fe558aa76a966c2ac2318a684bebc8ec2c67bb9b88e142edf857cf7a96ab2eaba8ddead393be66213fd91dbf215e85f1535b74860d1ede4f9a6f9a60a7a0ec0d795ce0b9112e022fca067dbad75c5154a3cb1bf72a890349b7773514930f35b9f5e2a5b6b56f333825bd01a9a3d302bb4970c3049fddaf248f73dab6514372d4a3676cf7d72a0e4440fcef8e00ae9e6d4e445fb35a6638146d07b9154c82542a80883a228c2d09c7cec7e51db3d4d5ba69ee66ddd8854aa64e598f3cd34fdce4e39f5a71f9b712d9f534cc8036e0d56c2b0d5c673bb3ef52a911a3ca4e081c60f351a0f9b247d71493b29b47c71f30c0a626573fbc593049e8734c456c364fe94f8d5444413cf7f6a8c145c63d7a5204c7153b17e6c60e7eb516d3b739ebd6a670a63ebc9279cd44554a923a7d6815c4547dca7238f6ed4932b14080f5c1e94e508178f5c139a262a6e31bf008e39e94075357c2fa9b585e79533b18a4215bd8d77b1cb8fb41ddc29e3f2af281b13257d7919aec748d59e5b76b566fdec6a00ff681ae4c451bfbc89bd99d5c27e4e7b2ff003a60388c9ddf74e00f5a8c4bf2040df310327d29650235dd9c295e49ef5c16d4d1327070a49e0f26a9bc2268981c1e2833b343e5c79de4019c703dea76511daec524edeb4aee2ee877b9816f28d3de5b59115a1987ca586429ab3e74f240b6ed1442e61f99494fbebf5a5d5ad0c90208c65d874ab91fd8ce91671de5ddefdb81258c1c0551d01f96ba2728c973753aa856e5f7594e4bf4675b8586116eff0024b188fee9f534f5b9930d69b60f373bade6f28631e98ed46cd3f779c67be2d90bb4b2edfae36d3a36d2846606bdbe186dc1f7a6f1f8e2b0738f63a155421d4679265b94b58bcd8462e232806ef7a4fb7385d81226b49cee8d8443f76def529b8d366bc131bdbe5741fc2eb86faf1cd4ef73a5bdb7d996eaea366c967471b8e7f4a9e78f62bdaa2b35f5d12a0c712ddc03b463f7a9f5a77f682aef984311b4986d74f286627f7f5a7ffc4a96384c9aaea2ab0e369322f27df8e6af5969d0dcf99343a85d79529c6084217dc0c62a1d48f61aaa8c8babcba0b0c0d121b988ee8640830eb4eb7d41bcd9aebec919818ed9e2d832a7d6afdd595aada241fdb17a5a33f7da35dc7f1a4b1b6b758fcd6d56e77489b593c852b9feb47b4872b0f68ae6719e42e9095b753f7ede5dbc63d29ffda01a6f38d9c6ce83fd263db827dc5593616a4881b5bbac80595cdba123d87a55a8adad86a66e24d599a38d42ecfb328dfc77352ea46c57b543a0ccaed0cb86207cff00ed0edf9ff8d5b53f677543feadb853fdd3e9f4aa91b6dbe3291888aed2c3d7fc3dfdeadde2eeb471824f18c0c9ce7b7bd7ab2dcf0ba0796eac6e464b1fbc9fecfb7bd493113db6c8c83e68f94f6fad3e07f32357e3246481d8d456e556ee7881e17040f4cf51f9ff003a5d43c89e1932855f89130187afbfd0d53b06f2ae278586de4053d8f5c0cfd38fc2ac5d1f2c24c30083b49ff64f5fcbafe14cbd616e91c87fd512237c0c91fdd23dc1fe74f4dc092e5824f6cc7a97da7dc1ff00ebe0d59941fb3b91c328dca4f623a54101f3d18c9b58f31b0edc75fcfafe34f8b2ec6ddce42f527f894f4ff0fc28f2010aacb029fe175c9fc79a8e2712cc5665561cc4e0f7f5fcf834e98fd9dbcb1feadbee7b1feeff009f7aad8304a4924ac87249ecdfe14ba8181a9db882efc91bdd51f0075201e78fad538f125d33893000c640f5f6ad6d5d0b5ea4e4e15f00564dc031dd27dd04f2c5875f4feb5a45e849b5170a41ea00e3d6ae69eb889d5fef2c78209fcb1f85508245796238646c6d746edfe4e2b45542cf0e7f88ed23d47ffaea5a282d54181948e09da41e3b77abba7289ad58313c92a48ef8ef55640239c6380e429fe9fe1f8d5f8d7eceaacab812610fb13d0ff4a5b80c01a587cc0079a09fcc718fa1feb49f7d45ca02491903d57d3eb4e0a2d984633b5c9db9fef77fcfafe74b129817c927760654faff009cd0088e6892e144c46f44e5403d7dc1ec7d2991338b9fde387da31bc0c6e53d1bfa1ab307eea3f29cfcca33c7704d42f0eeb22982b3461b6fae0e78fa11c7ff00aa8192c5949242dd1cee5e7ae3ad3003f6168c83bd4600c64f5e294c9bec639304382bb971cab03c8fe752cb85b884e786c8e0f5ee2868431dd7ce85b8f9f238fcff00cfd695114cb2c47918071f5eb4a88ad34d11e8403d7a67ff00afcd22b1fb389ff8d7249c75c70450322fb3895181c798ad8dd8ee2a16b48da1136c1938c823d7fc2af488232857eeb9dadef9effe7d69be4ae5adfa26ddc003d067a7e7480e46f02a5d3aa82bb64618f70719a6a9cf998efdfa73eb525f02350b86653f2cadb9bdf3dbf4a823242956dbc1e769ebc56d17a1935a9780335b60024152b807b8e6b2e19efa068c437d2a8dd9209c8ad6891bc908154ee638c75ed9e6a71e1fb360f299e756880c8dcb819fc3f5a6edd4697629c3ae5f223f9eb0caa7fd9dbfcaa71aeab21dd6cdb9a3c121f23a71daa71e1f809788cd38014b2b1dbf3fe9436816eb2848a49983a67195057f4e95168dcad4aa75284b479b7c92b8237d5696f6d8825ed0e71b73b8735a4fe1f85635952e2562cbf2e7183edd2ab49a079aa17cd7500f46c641f7a1dba30d4ccfdc346a86362a17203f3f85569ac2d64984df3248a43875393d7241c9ad09348bd62fe5328de76ab30c7f9ffebd5192dafe1660214705b0bb7b81d7f5aa4dad989ab8c8b4f93cc558af72cd26fdbb7e6c771ffeaabd0473db294699937364fc98fad653ddbc6eef35bc88a84461b00e7356e0bfdc193ed4c9b4ed209c0cfd0d3be9a88db8b539e38d54b2bae0f1f4ad05f12ca891040f184752c51ba8ce48fc6b2c59ab3440f08f8f9d703ae73c74aec6dfc1560f1a399eeb2c15b865c7f2a87ca8ad48e1f1ca900359b13eee07f4addd1f584d5a291d6231ec2060b67ad713af6811696ca6dee649016dbb5d7e653d739ee3a76a9742bbd52c639a6b2b037a700488ac011e98cfe359276d56a55932beab81a9de0feeccf91f89ff001ad9d1fc5ba658e9705ac9e7991723e44c8ea7bd60dddd35c5e3cae8c9e6b33946eaa4f507e95cc23317392461b8c7d6ba2ef90cb667b4699ad5beabe6790922ecea1c019fd6b4eb85f02ca3ed53a127718f3d3dc576ea72b9e3f0a94ca63b2338cf34b504d32c5cb12368dc7d315223ac8a194820f34c07d376e3a714c70c08653d3a83e94c99a5111f2d15db8eff009d0219339f2d97cc183f286c720fd2b3ac2fe34b5669645c44ce8485c03863961d78e9f4a91eec8ba48c3a82412a1f86dcbc9e7b823f956734ced7d73671c2c64129910a803686419e7a60b67f3a12b85cd9bc9c9d325923ddb9a3257b13ff00d7aaf2cd343776f180440f0b0f9b83bf803dbbd2432db41670c5220255002a3a03df1f8d46ba9c97b7a6d6ce355083334cc32173d87a9abe464f3a6ec896e1fccd28a966764c1f94e37106b46ddbf77866f987079a6111796125225f5de01cd2fda218d70b803d052b1572576654255771f4a626ff0031c301b32361079f7cfe350b6a112f7a85b568c7a51c8c3564ef6cf2aa0638c162467eb8fe753c48228950003680381c565beb2a2a16d6c0ff00f5d3e463e597637a8c8ae6a4d7703ef01f8d567f10803fd6afe74fd98f924758580ee3f3a43228fe215c63f88d0759d3f3a81fc49177b85fce9fb31f2776773e6c63f88534dc443f885702fe2687bdc7e950b789a2ed239fc29fb21597f31e866ee21fc5486fa11fc55e727c4c98eaf519f128ecaff9d3f641ee7591e8e7508477a69d4a11debcdcf88d8f1b1bf3a637889f3feadb34fd8f90af4ff98f493aa443b8a67f6b47ed5e6c7c4331e91feb4c3afdc67fd58fceabd8f907352ee7a51d6107a530eb29ed5e6c75db9ea157f3a6ff006e5d9e8a94fd8bec2e7a5dcf493ad2fa8a6ff6e2e38615e6c75abc3d93f2a69d62f08eabff007cd1ec5f60f6b48f4a3ae28ef4dfedd1ea2bcd4eab7a7f8c7fdf347f69de1ff969fa0a7ec5f617b6a3e67a4ff6f0f5a4fede1d8d79b1d4af3b4a47e029bfda37993fbe23f0a3d8bec3f6d4bb1e97fdbdef47f6ef1d6bcccea1787fe5bb527dbef3fe7bbd1ec5f617b6a7d8f4dfedc3eb4bfdb87d6bcc7edd79ff003de4cfd6817d7b8ff8f897f3a7ec18bdbd3ec7a70d73de9c35caf30fb7df0ff97897f3a3fb4aff00fe7e64a5ec5f61fb6a7d8f501ad8f5a78d694f715e5bfda5a8007fd264fc45386aba80ff009786fc547f851ec1f617b5a7d8f541ac21ee29ebab467b8af2afed8d407fcb7ffc707f8528d6f511ff002d50fd5052741f60f6b4d9e9d792db5f425198a38fb9229c321f506b02df5eba86592d2f65c5c427ef038122f6615c98f105faff00cf33f81aad77a84d7cc8f320574180d1b10714d526ba0a52a6d5ae7a769daf473482299c7cdf75b35b692248328c0fd2bc4a29a58db2b2cb9f7c1fe95d2d8f8bfc8282656523ab0359ce8bdd215392d9b3d32abde9c58dc7fd736fe555349d62db558774322971d40ab37c716171ff005ccff2ae7b59d8d590e91ff1e2b56a752572b8c807ad55d20e6c56ac5ceed8a8870ce7683e9dff00a5396e28ec52d9bad7cd75cb3f5c76a6c36f8fde2b00adfc4c6ac11b21080b6d076e0f247f8d37cbfb382cdf3003a1f5ac25b9bc5e8655ee226672c32704e4f51595752f9579bd54f95b074193b8ff004eb5a5213737043c9b4127938c1ef8fa018ac382e2492ee60198c4ee496008daab81fae2bcfad17772477527a24cd78a566899a221c10786fe5c55a839951173b40efd8d67c52c32db0304813703c91c839ab9148cb3315184dbd7a1cd705f52e4b42cec2d3b15c0038152fccae380474355e190619958b7383ed5309954163920734e3249ea62d3261b778db900f6a7f9c101cf38ec3d6a9a4e2527692b91dc50a876fccc4e090c4f4ad1d4bbf77721c3b961eea671b633b0fd3a5735aecbf6589feced2bdcca36bdc062580f45e6b7a4936a7ca3771d33d6b9d9ae214b79efef819cc47725ac6c40ce71f31e98fcebab0939b9dae3e48a5768c2b3d1628ad5aff5294d969c879727e690ff007547726b4ae445269f1cfaaab699a129ff0047d3a3ff005d767a82feb9f4fcea843af473cf26a7a9442eaf622459c05808211c630bd73ef58d797975a8dd35e5ec8f34edc64f0147a28ec2bdcb9c6d4aa3ec8d6925d4fc597715a5bdbf93691e3cbb54388e21eae4753fe454d3ea967e1f47b3d11a39f513f2cf7ec372c7ea10773fa7d6b29357ba8b486d36294c31484efd9852c3d090327f3aa0a022ed5c81d828c0a772e349bd3a0a4333bc8ed249239cbbb9f998fa93535bdbcb713a450a06918f03a9a96c74eb9bf94470425f9f9998f0bf535dbe8ba25ba4663b58ff00798c4970c3a1f635cb5f10a1a2d59d70828abbd112786fc2a2d409eeb63c8791c7ddfa57608811700600a86d2dfecb6b1425da428a177b756c773562b3827f14b738ead4737e4029d494568b43214525028a7d00f2df8b4f99f4c8fb8491bff41ff0af2a9486b507ba3e3f0af4ef8b3b8eaba7f3955818e3d3e6af3a86d7cc5943829131186c6727d877a504f73ad7f0d173410bfda3196e9b4f1f857b46a5e32d2b4ab6548e74b9b9d9f2c71302071dcf415e2d0a08c6511978c6e63f37ff005a8b83e55b2c71ff00ad9c1007538f5a8742f2e6b8e4e2d24c7eababdc6a9a9dcea53b12d2be13fd907803f015956b6f2347e63c8b1a2bf73d7157d6dbeee6373b0615369fc4d4af6f2336f64fba30371000fc2ba611444e6ba10a46b082137027f889e685508b85cfb92724d3d82a866774539edcd46f35b2267cd2c4f4017afeb5a688cf990e085c1008e7927d05239de7033b0741514faa59da810ec91dd8fcc37e39f4e955e6d57cb9711da2923a8c16fe668b8b9cb3bc1042f3daa54b69db2046fd3b8c7f3acc5d5f517398e258947f776ae2aa3ddde4d2169664e3ae5a9361cedec8de7654952218ff0068fad532e376c2092c0ff8d560d8b8819a4e4c641e699e530bb405c9523827bd1727565813a9b76902b1c1e00a679aa32483ef8a83ca75b278cb7218f4fad5731966c86382475349c869b2fcb32a8191cf6a634e9b17e53b5b249a86e54bb3724e0e0539e15063404920738a5ce1a8f499551323049c7e1524cca8c8cdce79aaac83cd4f6ef53bc3bedd189c9562318e80f22973ea1a88ef1891cedc6e357f4f627544541f32918e6a88b4691f18cb673f5addd2ec92dd85c370700126a5d4d04d33ad40336e8c473f330e9c0ab7740496ee08e36d66dbe65785b7163d091c605695c11f649b7fca369c1af325b9a228da1678a3eb9c679abc1808986724f354ec4116f09fe3dbc8ce7029eae160f33270adc9f5a535763438a1927e7b1a590040cb9c6075a5b7cc81a4fef1c8a65e3057d99ea339a9b6b62914a58be445cf38c9a916d62742d278424b824ffac2f28ddefc71569e22cfe60e36e057a3e9323dc6976f2c8db9d939206335856959245a9f2ea7979b3b35ceff00073ab11c0f3a51fd2b3aef467b8286d3459ed474206f7dc7f115edef8159f7facd8699196ba9d5580cecce58fe1587372ced7fc59a4712de8a27955b6996d6f6bb6efc3d773bf4673332e7f00b5aba4e6cbc2867fb2dc4bbe76896246da40ff7b07a7d2ba39354d7b5bf9749b35b4b73ff002f373d4fd056ee9365269ba6456d24c679412cf21fe224e49aa524aed953ad64aeb5ed73c926834de73a35f2ca79dcd739ff00d92a2920d3dedc1874ebe57da7e6371919f5fbb5ed802331e871c1a1634191b4601e00159466eda7e62facaec7cfa965289d4cab314cf214904fd0d698b7d34a92b67ab03ff5f2bcff00e3b5ed8a81802500e738c0a788d0ff0000c7d293ace76e8358a4ba1c0c6809c7504631ea296dc9ded139c9870064f507a1fe951c3218a768dce7e52558f71efee29eaaf1bb5c727206e4c745f6f7afa27bdcf3c95d84127998f91ce1bd01ec7f1e9f953cc27ca52a7120f9837bfbfb53275fb443e5a30f9c7deea00f5a9a3937021861d7ef0ff3da974018765e200cbf20fbcbefe9f85249968658189f336e636f5f4fc41c7e94901293be461256053dce39fa74a8af6f218aeed9038332c832a0670083d7d07ff5a9f5b0162d8989559d8bacc412d8c618ff004a79056e4dc8ff0056abb58639ebd7f0a80110db3c12940ac18c643707bfe7dead59c825b68dc1ce57939ea7bd1e6161ba8062b1f96373060c307b0ef556eb6bda3b29c861c11cfe556edf04cc99cf96db47b2f503f9d557016ecc7fc0c0b81fed77fe79fce80286a0826b481f9058e31fcc562b0f36ee36392bf758fd3bd6eea398de1c1f95d8939fef7afe55957110175e81b038e2aa3b12f73460823ba87cb906e2a4ae73823d083f4ab36e48611ddf556d825e809ebd7b1ff2296d2216d1a48170ac02b8f427bff4ab9283026e6e56538903741e9f87f8d27b94b6228e13713147621a37c161dcf63fd6af3069e111f08cac0b719c11dab3edfccb39f2913490ca7844e4a103f5cf3f962afc320795e4520c736369f520739f43fe143d8064ccd288dd14ee47dccbdc638229666ff52ebc80c18903a0f5fd69d1b017330ecd82091d481838fd292d88cce0720487f01d71f9e7f3a4013902580ffb7827d88ff1c7e5524a00b883d58953cf518cd3200196443c85629cff0077d3f5a7403cd8595c9dc18a86efc74340119758b52087204ab907b6f1c7ea3f954912026588f40703d81e7f9ff2a63462eacd9987ce41e470411ffeaa6c537ee3cfe0483025cf7cf43fc8d1601e5b1009f1fbc07e62075e707fc69ed1aa3ac381e5499047bfff005e91a25461063f772027af423afe74e0ad23609c3447e53ebe99a00529bc98492366194e7f2fcb069acdf21b83c14cab0ce7a75a76ee3ed5c8006d2a7b0079fd694c6763c249cca49071d0f7140ce47508e3fb55fc52101cc9bb3f5c553444dd1f1c0ea48e2aeea9b5352b85907cc586475cf039fd2aab314dd820ae77023f2ab83d0ce4b52edb6046046a02a3eedc0faff315b76e2594c4eeca10398c103e63df07dba1ac2b365292105b632f19ee7fce6ba747793c828137bc3b640dc74c75f7ff001aa90e2465919248781223ed71d70bfe4f14ee2d431724f9470a49ce475c1f7f7f6a7058dede0247df241e392dcfeb9a742a58666037b9f2df1d08ec47f9ef59942bd84b0c6b2a966da4beccf1b7dbdfad40f1fda54ec3c31dd1b0e33ed56adaeaea1744676fb3c7fbbe7938cf19f6e473493c5243398e1c131125b3c02bc807ebd7f2a1d81329cacb248d104f9ca0f971e9e9fa532ea28a1f372495da1d5db920fa67f2ab8c008d48dd9126f53dfdff00faff005a61255f74cbf36fcf03e52a7b8f6a4331ae34c8e681d946c65657c0e9b7b8c74cfbd46da25ade327eed446adf390305b9e3b7bd69c78f30f0a2dcc8540f6edf854837492622751238e73c8c03c7f2a6a4d016345f0ae96d10dd0cab3a3925d246018e73f4efd2ba58ec6ead62096f7accabd04e9bff00518355f426dd0b8ce79df93d89edfa56d62a395b6ee0e4711e2fb7bb305bdd4de5fc8db14c6c46723b83f4a7f84aec882ee4114b2038c945c9079fc4d5df1aef1a4c2571b7cf05be9b4d33c1a0086e82f4caf23e86a631b5d0ef757399d41966d42e1d9981321e4ae3f31d4735cfadbbbb958b120c9cb0e73cfa7515d2f8957cbd7aec0eec0ffe3a0ff5ae754e5861576f2a48efc9ae982f7523193d4ec3c1bb4dd4c5b18285719c1ed5dd2a8540a83681d0579d787238a6bb58ae2169431e4724e307f2af445738c282c36e41f5a6d590ef71b285dbf33301e8bd4ff5aa3712496401485994f1cb75fc7f84fe95a237672eaa31dc1aa735e46af2c32236d033bb191cfafe348078b90d6c2543943d5ba94fa8f6a595e48e1c471193076ed27ef0fad63cc6e14b1b3188dc7cc36f2bd3a038dddce3afa1a8f42b8b97b7b969eeb11c721dca54e307fba4e08efc638a76b88d26b7b69ad3f7d17948ce2504377ce78ff3deb2b5df10c5a75aac50200f271c10303deb175af15f9d3b4564be66de3767e41fe35cc4c2e6f24f3266cbe3f85715d14e8ca4673a914ad7355bc46ce48c13ee09c0fd2af5a7892df4fb458518b1eacc07de3dcd7382c5c9e41fc4d385900792a2ba7d8f4b9942aa86c8de93c62adf751dbf1aaefe2b9dc612dc7e26b30db20fe33f952f9318ee7142a311bc4be8597f11df3f4551f8540dad6a0e4fef76fd05376423f868cc6bd10557b2892f1137d489afef5fadcb9fc6a3325c37de9a423ea6acf988390ab49e77a63f2a7ece3d8875a4f7655d92b1e4b9a516f27a13560ce7b669a6663d33f9d572aec2f68fa917d964e3087afad2fd91c9e83f134ff31cf1cfe749bd8d3e517b41059b753b71f5a70b43fde5a6967a32d9e4d1cac39c9d34d91f041073dea55d1e523a9cfd2b6ad48fb3c7818f9455a575ddc93d2a1b279cc05d1243fdec7d297fb0dbfdaae8157e6c8271e94fca834b9c3999803423eff5cd3bfb07a127f5add79147f10155dee23ce0ca3f3a5ce1cc660d0e3ff268fec68876fd6af8bdb753832523df5b63fd7281dfe6a39d85d99eda5440e36d3974a88f252ad7dbecbfe7ba7e74e1a85a76b88f3f5a3982ecaa34c8871b00fc298fa7c63a28fcaad9d4ecf9fdfc7fad40fa95a769d4fe07fc28e60d4c47902bb2ed1c1239a619ff00d914b772acb712b27dd63c7155cd5ab31a27fb40c0c01f9521b8f618fa5407ad19a7643d5139b9f41fa529b839ed55cf4a6938345905cb3f68ff0038a3ed07be2abe693345905d96bed3ec3f114bf681fdd5fcaaa6722941a2c857b16bed008fb8bf952f9ea7f857f2aa818934efc3af7a764172cf9a87aa2fe229c1a339f916a9e483522bf1ebcd005b548587dc23e941b646e01fcf9a8925c75a9d1b73641aa8ee4c9bb0db79aeb48ba5b8b4728ea73807822bd174fd721d734499d3e59d531247e87d47b570476ca9b1bf03e86abd95fdc689a9adcc27186c3a9e8c2b0c461d4973235a15fecb3d434394340e06700803f2ab8ee1a547236e09c7f2aa3a54d6b796b1ddd9604521cec1fc2d8e86adcf218e588e46369edd4f1fe26bcd9eecef8ebb0398d8f27e70719aa5a8b97431c6c5770c673f89156d9c3b3a26508c64fb9acfd4946e486393692d8e074e4679ae79337898f7f2985c4a0312b1602a9e41231fe1592f732caa233285ddc48fdc80381f4e6b4f5ab4ba7b49e282505bcc50a5c00547539fc40aa82d0c6caec3736eda5b93938ea2b9ebc6d1bb3aa8bbb2ddabac68db028f94703b0c1ff1ad7b305db03ee900118e0ff9e959c1143326e3b1c00368c1ff002735a7630ef2188240ea718cf35e5c97bd636a8d72dc1c6c96445006c3c0f7a781f21ca8fad47222b5ccaaab801bef75cf1523e23daa48cbe4ede9594afcc657d111a1dae001918c513bb0001dc573d8669642021cf00727148e3cd8f01b9ce411eb8a22575b95e7b848a239ed81cf4c135ca6b7750b472430c9f2eece14715d06a6b8b02c55995305b23271fe35c35f488f7b26e9446858fcf2b045af4f0349395cb9b518dcad9ff7b1f9537823a28fa9a526c8825b54b1c0ff00a68cdfc9694369f900eab6818f658ddbf9e2bda724ba9c7ed2237763f887fc056aee9fa71bd72d33bc500eae4633ec3deb4ac74bd2a185aef52d656058ce563961082500f55f989619c8e2b3b52d7a2bbdb05b6d7c7cca13ee28ec4ff857357afcba40de8b84b5675fa5d97da956d6d3cc86c872ef824b74e01f7aeced2086d2dd6185424683000aa1a0c6468565b8e58c0858fb915a7b40e95e7d3e752e77a9cd5eab9cadd10fdc3d69770f5a66da5db5d1ed2a7630b21723d69723d69bb0526d143a9516e90590fc8f5a8e49638a3692470a8a32589c00282bc67359faa696755b5fb3fdae7b753f7bcac7cc3d0e450aacef6b024afa9e7de34f11695ab621b4b459e64e05db8c6d1e8a3bfe35c6323e06413c75c57a65ff0080a28b4fb8922d4ae4ba46cc0385dbc0f61593a67c3e8b50d36d6eee2fe659658448c88a319238c647d2b6f6d1a6bde674a6ad68bd0e1594edce067a72c0541228926498ca81a31b00073c7ad7a61f859a6187fe3feffd48253fc2b1f5ff0087fa7e91a54f770dd5d3cd11558c385da4311d703dcd258ca6c9e5e6d13386565264c5d4923143cede9fad42eb1bc6ab1bb93b8b64fa62a7b5b278e62a382411d3fcfa53e1b071272bd3a1f6adfdaa466e1a956f1784208fbb8e957b45b08a7d4a38e74046c66009c74e73521b0deeaedd00e73fcaaf69b6a7edcd3107211b017b0a2757dd12898ba4584173e24820993745963b49eb804d77c9a168c42e74cb76f52c99ae4347858f89a3dbc11b893e8315dfc2b8523a679c57262272bab31a5a948e81a3296034bb307d7ca1518d1f4a318c69b67d31910ad68349f3edfe223f4a83ee0641c77ae7e79f72ac723abd9dac72b88ade3428dc14403158b3c0be4a8c72bdebabd4a2123b0e39ac59e305305700903a576d29b6b525ab331e5526ddf824900e6ab4506e5391c29cd6fde5bc6aeb12c606060b64e5beb59c61f28118fbcd5a5f61e96288552e063966e69eec048d9ea7807353888f99b87419a8c26485c658f5343b5ae1d46c36c659785c927a0abd1db3a2b46e083dc1ab7a5c489701e438553d71575a1479cb0e43739acefb837d0a505b0dc14f07b1abf668d379717dd05f93eb524564d36ec10a3b127157f4fd3cf99113202158a93d00a8576ae2934496388b6a9c0c926b42e9c7d89801c1e3278eb552388c779298dc308df07dbbd5a9f719edd77e50b827f0ac2716a4ae34d32ba13148b126060718a6cd98ece50ac0b67807be6a6fb569906a13b5eddc7115e0296acdbad67439678c4973ba35cf11ee393e86b4f64db2798d4b402381218c6587271dbeb4b79110b9623a600a92def2d2fe1867b45db09ce085db9c525d8dd192c78e31ed58548da65c5e82246d1da29077123257ff00af5bda3e8babff006747345ad3289172a982ca83b019359d1aef8c228eb5dae9f1f91a445195d8522c63d38ae6a8eeeccbbd95d1ca59deea12e93accb71792c8614da87818383935aba078734eb6b382eda37b8b99115ccb39dcc09e78ec2b989efa3b7d1f52b6138124cca1538cb7233ef5dfe9ca534eb6078c44bd7e95828da4db46951b8c74762e76a6c99c6475f4a5e4e0f6a53c8c537ef268e62188924f3907906a46e33db38a48c703db8a6cb20f3d63e738cd6515cb4db63dd8fea291405000a5fe138a00f9be9425b34079b5dee11870ac5958150073d7a7e2335a4a091b94641ef5e4124b32c30c56f05cbef1e63155638ce703f01fcea487cd66855fed88c14b3865653b4761eb5f4ae9bd8cfccf54b31b67b884027630db8ec08e9f9e7f3a75d031c91498c06611bfd0ff0081fe66bc8ffb42e8cc5d92e103f047ce38edf954b3df5c5b5b47fbeb83239de09763851d3f3347237a8afa1ec0f10950a32900f19f4aad690c7237da5a25f3f255980e73d0fe7815e596da8cd3481fed774883e69312b7ca0727bf434d3aece5d8457b3a1c92856565cfb7ff00ae9fb3921dcf51bc32439863899ffe5a200338ec411e9cfeb51d84d2c334a1cb32e550f20ed6c0f607a900d79dcdaf4d0b428d7f73e6040ccde736e527df3e9491eaf3ed9e692f256030a49949dec7a77f4fe5494181eb2f1f928665fbcbfeb31fc63bfe23ad55962de44ea72e3ee60f047ff5ebcd62f11ea0f70aa9ab5d3a37cdf34c7040eb9fa534f88ef48530ea774c84e0287fbbe829724834b9dfdfa09eda1923c80adbbe6f5f4359e00b998a03b5b3823d3d6b94b8d76f46e45d4a650a4798a181c3773f9d35b54bc58d274bf995ce59882b923a038f4aa516887a9e95913d998940126369527807fcf353dd1f3b4e71c96fbac3be6bcd53c43a9792675d4e6de0e09d8a78033e9ef52af89b566b6926fed32c432a92635e3af6c5270655cf4303ccd359ba36deb8e430ff00ebd25ca6eb76b880ac726d0c73f7588e79f71eb5e7f0f8a3568ed9a5fed156cb8f98c29c1c7a63d2a55f14ea62d99cdd2619f8630ae33d4ff9f7a4e120b9de1b856b60c11e39230ae15b1c83dc60f23922a69bf708b22ff090a73dc1e3ff00af5e792789b5092d46fb889b0ff27ee540f53fd38f7ab27c5da84b6db6496d89620005304e3af7a3958cee9c181976ff0019da7ebd8fe9fad380103009c2c871ff0002f5fc7fa570f278c2fde38d9c5a9f9f700148e9d73cfbd3dbc5f7c6346961b43fbc0cbb430c81f8d1cb203b555f24f9033b64ce0f5c1eff00e3f9d413a2c6f825c46170e47fcf3cf5fa83fa1ae5e4f195d6d8a492dad410f9500b7231827f5fe74b278c6e7cd8ddec6df2548dbe636083f87b52e597607a1d70df2b2907e788f7e8c48fea3f9d2a3e0fda33f23f041ed8e3f9f15c9c1e2e9617d86ce3762aaa7f7a4741f4fa52c7e31df6b2a0b152b862584b8c64fd3bff005a7cac2e75810aa3c0dff2d7241c7e629cbb9b6719784fcc3d78edf515cab78d437972369eca11b82271f37041edeffad48be358d6e4ff00c4ba5dd22afca251c75f6a5cb2ec1721d51449af5cb8e55d0753d46d1c8aa5f7510e5b03ab019ff3da982ed753bbfb6460c7130d8118f231f4ebc0a7e009190e36a80402719a70bdb52644d6c5c47343131f971907f3ebe99aea239161b7760ac449186e0670c33cfd2b99d3a43e60938236919cf6ae934f9123b05dd9564937293e99cf1fad5cb6045b29be53282bb9a2de39e38f4ff1a22f2eed22ca108e37608c10fd73fe7ad472029e79e044a4384c7ddf5fc3dbdea47cbccfe4ba868d43ab6323bf1f8e3f5acca1cb26e8e35977a4921f2d9c292a71dc63a1e3a7bd0ecb6f248ea0b46cc63c7539ec7d79fd28fddc88a8a19770f31541f995e9b1e495f35b0d37cc1b1c02319143771240232989b2a5d576b1ec73d3fa73581a9f881e1bbfb35ce9acf0c6a137072a7900e7a76e6b788790171858663f740c90477fa75e2b235485af2f1fcb754170bd77707031823bd22994adfc430dc6c5586605d762b28ddd3bd6d0f26cee081b54b468e8a0e49ce738f5e9595656f0dbdb222a3060570075f7adbbeb7636f0328ff4985d65538c6f4ea57f104d3d3a0337f468c46c4f76f941078c0e7fad6d8e6b9bb0631cb1ba9fdd63791df39c135d2534b5259cd78d6409a32291cb4ea17f2355fc1002db5d28e70ca73f9d3fc731c7fd8f1ca41deb285183ea0d67f82a730c577e61dcca8b93ea6b2bd9b652dac6678ab8f10ddf3dd4ff00e38bfe15cf47fc5c60863c7be6b4f5896e25d526966521a472d83d81e83f2c564c4ec5a4e00c48d9238ae9827c8ae64f5675de0f083540cdc64fca4f63b4d7766650a36b16c9e0a2961d7dabcd743b96b09c5d3221111e777e479aeb57c59a63e0331e791823fc6949ec346acf7a622a91a891d81c06f979ec39f5e6b12c64106ae53ed0b028077abfcacc7df3daa9dc6bad24eff65785edd976aa4f26e20fafeb8eb59319b85b912468858f0515be51ee339f4efeb4e29b6174760ad1cd7c61b758df9fdf10bf281c8eb9e0d72be27d65667fec9d3888ed633fbd287ef9f4abfabea2fa268a96dbcb5fcebf31e09407b0c0ae56ca02c77bf3ce49f535d3428f34b530ad554513416aa9182cbf4152000b7000c53ddaab49211900fd6bd26ac8f3b99b95d892b61b19e6a2e7ad37bd3c118c54c51a376184127ad041a71a438ab51239866de68c53cd213458571bb6936f34eef475e69f28730dc518a7678a4268b05c4c52628ce0d2139a7615c5a4e0521fd68a561dcb29a85c47184593007fb2293edd727fe5bbd56a3f1353c8869923dddc1ff96f2e3fde350b4b26725d893d4ee35bb6de0ed56ee08e7458552450cbb9f9c1a9dfc0f7d1732de5947fef4847f4ac1ce9a7ba3a234e76d8e64b9ee49a15cab83e86b79fc351c67f79ade98a7da52699fd87a7a1f9f5eb3f7d88cd4954a7dcaf6723305d03c60d572c49fc6ae25a598d58db35e8fb36706e56338c6339dbd7af15a8ba5681c6ed6a63f4b722973c50b959cff39a3254574eba57870f1fdaf73ff7eb1fd2a65d13c34dff003189bf118fe947b5877fc18fd9b3922c7d4d1cfad77d69e0ed16ea2f320bc9e65f55917fc2ada781f4a0a32d724e3fe7a0ff000a875e995ec99e6d83498e3a57a6ff00c215a47759cffdb5a4ff00842347feecff00f7f697d62987b2679911c7434ddbc75af501e0ad1c7f04e7feda9a82ebc2be1fb488c970a6241fc6f39514feb100f64cf3520feb4841ef5dbc96be0889b6b5e827fd8999bf955390f821548f3ae89f55de7fa557b68beff709d3672473499c75ae95a5f06150036a20fa806b3de5f0d82c17fb53fd92027f5aa5513eff00712e16328b63346f1eb4fbb7b3f30fd8de768fb79ca01fd0d56dddaad3b93627dd9a4dc49ef512b7614a4e298b72c06ca86fcea52b950e3e86aac4d9c8cf5e9566ddf9c11c7434862e476fc6a58a428c0f4e7ad44cbe5c9b48c83c827b8a092b91e9fca9a62b1a00f4a6cf089e33819703f3150c32e5706ac2b60d6d177460f47726f0d6bd2689a805724db4870ebe9eff00857a7931dcac72c6c1908241fad7906a16fb97ce4e013cfb1ae9bc19e21d8574dba3c67f7658f43e95e7e2a8dbde47a187abcc8ec9636926deadf78fcea79000e07e355e64796f36b2850a768047de5e33fcaae6e8ad21334f2f2dd58f1eb5ccdeebcc9713ada63258fcef9e07b0c63ad79551a47a14d396c6bdf4f6919944cc3792768e0f4c7f8573d732c8b06768cbae4007f8bb722a8dbbb4b7637b83b9c97249cb311d7f5fd6ae4e37b448b862f9f2f2bf77f2af3f1359ced1e87751a4a1a92d823cba72a3901cb1202f6e7bd6ce951ac68ca48dc4fcccbeb5cfd9cc6c516299d53cb8c6ee382d8e9fcff2adfd09101b89720ab1073e95caa379b2ab3b4196ae4379cf907d80fa5562dc06908040c13d38a7bb48d7771bf8f9c6d6c76c0a8dcac58420e189c1ac6a7c6cca0b44819a30acce4b2118e6a4691957e524ae460fb537e4118e46dee4d40255788ab92324e33e99e2a63a176b991abcb37d849903246a8c6420f183d0fd6bcb35369750bd2155dc1e703fa8ec38af48d6647bcd3e68a3978ce41c6076c7f3ae6a3d3e3b28c36079d2a912cbddbffad5ece0656570ae9f2d91c198d9f715015738c0e2b6e2d3bcdb7b70c7ef2f3f8d52085a364c0041ec39ae8a51e5db5a05383b40fd2bba726ce48ab3b1d95c41a3f8aed6d22b993ec57b6f108a2c91b1c7a7f9fd6b39bc30ba55c04b98ca927839c861ec6b137caab8ddef966ab90f886e058bd8cf72b243b784914b1423a6d3daa1c64d59ec352517a1eb9a6845d36d950fca22503f2ab24e2bca2cbc697914222507ca5f941e370ae861d79923b77bd523ed285d1760242f6249eb9ae2a8ea4747117b0e6774cecbed50eedbe6296f41cd4818119e7f2c5635bdfdb4917eea4dca57239cf3534b367682372b1e4560f16d6e84e83bd8d6e28c0ace336cc1576dbe9561260e061b35a2c6c5ee8cdd368b581498a8b71cf534bd7a569f598cb6445825892789e27e55d4a9fa1ae75fc333db228d335abdb6c70a926264031d307fc6ba300fad3644665201c7e34e72728eb12a2dc76673cabe2ab407234fbf50783968588fc88ae73c5daece349316a1a35eda3348a03fcaf1923a7cc0d7a0431bf95b646249ebcd707f122630e89059cbbdda49518303e879ac69c136bdd37a72bcba1c5c0b1c8cae80905b1d315663b6e50b83f3e4f02a16b836d691c4b0ae57e6c96c1e6a29759992dc16b54054600de4f1d39aeee493d8c9c8ba62e8d8ced1bba75e7156ed220acf965f923391fd3f3ac486ef54bebbf2ec6c4cfd14f968cfd3e9f5aec748f0b6b134724d736eb6f248a7292381c9e9c0c915a3a32e5bb25cec725a261bc44ad82786000ebd0d752f7da55b8569752b746c6086946455dd33c0373637e2ea5bf841c302a9196ce7df8a2e3e1c58dc67cfd426c9ebb2203f99aaf61ccf5339568df733cde59cf6c92d9dc24ea1ca9753919c74a65c5edb5ac7f68b9dc1186d00024e7f0adfd3fc19a669b68b6cb7774d1872fc851927ff00d5575bc3da2490f93379b2a673b59bff00ad43c2fbd7e84fb785b73cdef35ed35e4f31239ca8201ca6327f3aa338dd3e00e0b0239af574f0cf86500ff897c471c8ddcd5c5d3f438ce56c60fa95cd6dec229697fb85f588267924f12492a6339c73918c1aca9a19249b846e0f1c75af7409a4af4b383ebe58a6497da4db0f992d631fed6d142a296f717d663d0f0c1673957c432723fb879a20d32e5e519b79460ff70ff857b449e27d021fbd7760bf5912abb78dfc3687fe42163f83034fd8c5f41fd69763cd74fb1b86672f6eebb4e47c8466aecb6920753b5989efc9aee1bc7de1d1ff002fd6c7e884ff004a61f881e1eff9f88dbe9031ff00d96a1e15377d47f59e96387beb395a18d55641f2f3b33c1ae66fecae8a94c4e54a8eb9f5af5a3f107c3a7a306fa5b37f8531fc7fe1fef03b7d2d4d6b1a292b5993edd5ef6393f0cdbadb6968318cb10c0fb5583317be2bb804814edcff0078d742de39f0eb75b190ff00dbb1a85bc59e16933bf4e9bfefc37f8d672c2734b9b51ac4476393bdb74788bb805c9258fad721e434974db40daadd735eab26bbe0bb85db258dce3a7113d5264f00c9f712fa024e72b1b75fcab4542ddfee2a35e1d06e9ec22d1ec14f0aaa73525d3a359ca70d81fdd06aefda3c352db47045acbc41176af9b0374f7a8cd9da4d62f6f65aee9f233752efb49f6e6b8ea6126ddd151ab14b722b1d4adf6c45b76d18dd9eb815e870eefecc667e098c9c7a0c579c58e857b6d780de42925a853fbd49432fe95e8f3be74b958aed061271e9c579b89a2e9cd5d1ac65cd1d0f31bb8ed62b0bdb89021b8495563cb618773815e99a5a38d26d04a497f2d49e7db35e19ad4b245a8993cc2cbbf20135edba16a51ea9a55bdcc6c9864190a738acab53e449bd5334a93e676ec691c823d29d9fd68fbd509e79ea54f3cf4ae7949c36d999137b55495a36bd48c81bc2eecfb73561ced191c9247154c7cdab10d93b22c8e38193ebf854d4775ca547b9694ee507a0a971843ea6abc255ae2650ae36b0249e84e3b5593cb0e78aba50b26fe44b3c6b4f5bbb4bd575b70033606f9768e9c6719c76ad39c6a3717916e6b68648d599007793b83d703d2aa2dbdbc2556e2e6458db8cbdc30edf5a625fd919e002e6e659943ab2c0ceec7d0f19afa2beb733f236a39b5331ee13dab63aee47520ffdf469914da8426453042de692ebfbf2b9f5c7ca7d338acb696f64756b6b5bc45978ff004b982863d8e3923f1ab2d65adcea145d4110ea332172a7fef9152f40b1225ebc50d9bdcdab44b185ccab8917615ea48191f88ad666826b7778fca954a9e530d9fcab22c6cf537b58a48756d8a5402bf6656208e08ce7daa3974c912668e6d463898aef59c5b246c39e46411dcfad0fb0cd38d51cd8968937a96560c8339d87a8f5e054914301bcb88cc3111957505071c738e3fce6b2ee2c6f2d1ad6e20d62e2477942667457527047619ef8efd699249af5b71742df629cc72210a01f7241c7a7381ef47cc0bb3da5a2f892c775ac043c322e3cb1d7839231f5fce8974fb148e59459da831dc1e90a8c8e323a7bfe759b3df03ac584b792cd6f134520df244a50741c32f1d72335ab047712bdc4525cc6fb26c93e5021810083d7bf5a7af713425f68ba73d8ce574fb31205dc1bc85e71cf3c77ae7ef34cb09bec8e9650a190a80c1003b72063e9cd74a12e4192d1aed3057e5261e76ffdf5d8ff00315897d0dd2496f1f9b1ec8986c6f2b03ae71f7a85277dc4cd3b2d07489ad50be9b6d91b8602fdd3d0e3f2a747e1fd1e4b575fecdb653b8ab6c5c738c67f1ebf8d588a3bbb72a05c43b646c9dd09f9588cff007bbd388bb853ccf3a0292364e626f90ffdf5d0d1293b8ccfb4f0fe8d710de20d32dd1815523276ee03d3eb40f0de8925af9aba6462307718833638e1bbf5ff000ab507daedae2eb2d6fb6428db8ab7048381d7d8d4d08bc851e22d6f960587cac339ea073ebfce8e6977039fbdf0fe8b16a9a6466cf16b319328246c7dd18279cd5f6f0868859566b2263e8804ce367538ebce6997f15d1bdd2d5956431b491ec88e1b3b47a9e78e7b56c5cdc996d9b6dbdc65c650f97d4f51de9f34adb82b18d2f83f469982bc0e80e044c256cf1c9079effd2a0b6f0a68d72e62b88274656658b6ced8201e7071eb5bf3dd2c96cdb639f711f2e2073cfe5502dcc12d94e0ab93e6b150607c6e078fe1f5a9e790ec677fc217a3c8fb64fb52a8188b13ff000f53dbd4d413f82f4c1894b5e07574007980829903d2b7e5bdb416c044cc0a9040d8df88e9e99a6dfdfda9fb3ba5d2aed99093c8f973ce69f3c84cc36f06592b2ed7bb32b97dcacebf2b11db8e98cd07c0ba6ac4123bcbdf29f05dcb2e5476edebfcab727bdb6fed3b4613c45790c7774e0e3f9feb5620bcb433ce86e20c1604032019c8e7bff9cd3e79058e63fe106b1795a0fed0bc5488e03e14e491920f1e94eff841e025e45beb8f371811955208c601cd6e5bcf13db5d624466575c00e3270063bd681951a781d1d4a90724107ad2f6920b23869749fec7ba8aca1b8696245f303b2805b77623b60e687cab312318e981d39fff005d5ef109f2f5cdbb4fef172303f3c552c31656032a719edf5fd69424ddee12d892dd52dee7e50487078cfafa54b7371751bc6b1dd491855c2a8e31cf5faf029917332021982b8da320e07f875addb2b78ae4dc24a8ac857218819ce08e0ff9e9552d5096e736354d4cc8e9f6e9822f01b239f51513eafa9db486386f8edd870831fe15db2adb4924511b683cc788865f2c7e7d3d8fbd2476f670790d2c3032c808676404eec7d3daa52895738c8353d50149cdf13205396040257d3a74e29abab6ab710a46f72c46e3856da78fcbdebb55b1b53b2636b131126cd9b170464e0f4ebd290da59ceb98e084059361758d738f4faf34fdd038c1ae6b3f2aadf3e3770dc1dbf98ebcd35f53d41762fda5c8de580daa71ea7a576c2d6c93f746d6dbcd56f2f688c72bebd3dfad64eb56305a7d95ca260b34658a018c631f87353a0cc117d79f2cbf69c36720e0703b8e9528f106ab3a8125e9640bb48644e547ddedeb5befa64126244b78c07c8d8231838efd3bf34e86f3469aedad12d611748a586e8540242e768c8c1fc71549213664278a3595c28bccb8c726343cf4f4f4ad14f186b508f9ae9241cf5897271f41563c3b3e9baa589135869e974098d55554339cf0718e3d3ad76b65a6592db826cedb3ed0a8fc3a5128458291e697de21d43580ab7132bc4a438455039c7b7d6990ea7716560d736f6ef22b6d321c9da8a327e6c7635d1f8cecadadae6068208e10c87798d0296e7daaaf8795774f17c86278c2956190c338c566946f6456b6b993797bf6f912e80da25446da5b3b7e500f3f5154236dcf280a387ea3f3ad1d55638ee9fcb45553b4855180323a63ea2b3e11f3cb8eacd9f5eb8ff0ae8d396e8c7a971b71d2aed7fbf11c738c77cff3ae505c4e08fdec8013c7ce71ce3b7e35d6e54d85d1e9881fa7d0ff0088ae48a67193d3deaa16b89f90a9733f9a8a26939e7939faff00e843f2aef3c33a5bd85b36b1a9b9d908fdd46cb8ded8041e7b735cd786b4b6d4b5b8621cc6877b9201000e79f63c0ae8bc55a946f245a4d9011dbc231b57a0f6ad947b2d590f4576665c5dcdabea4f752124b1c2fb55f5511a045e82abd9c2238c391c9e9f4a9d8d7a54a9a844f36b54e6958648db7354d98939f5a7cd264f1d2a2ddd4d126108f561f79b038a9323f0a897805bd694364d28bd4a92ba1f9e7028ea69b9e78a335a990b9cd2134dddf9d213400ecf3c504d3338e9499c934090ecf7a09ffebd373d28cd318b9a4269339e2909f7a408766932293345030a96de2371711c2b92d230503ea7150923b56bf866357d7607760162cca73edffeba99bb45b1c15e563d2ee665d3749965ed04448cf7c0e2bca6e2e24ba99a69d8bc8c7259b9aed3c51ab093439634561e63229cf619cff4ae10b006bcca10d5c99dd565a248767d29849a37504e78aeb30ea403265c73d339ab2878a0a2801bfd83ff00a150a78f6a571d89037bd3f774a877628de31f787e7480ea3c297660d55137616652847a9ea3f97eb5df0fba3e95e4da54ce753b78e2059cc8a463eb5eb2481d4e2b8710ad24ceaa2fdd178a2a333c63ab8aaf75a8416d6d2cecdf2c685cf1e833589a9cc78b3c5eda74e6c2c361b803f7b2b0cf97e807bd79cdd5edc5e4c66b99a49a43fc4ed9a6dcdc49753c93cad992562ec7dc9c9a8335e852a518abbdce59d4bbb0e2c4f7a6e734da2b6331d9a4a4cfd69681317b51fd69b9e297209a00781934a4f3fe348a4529e4530053ce735647c9203d88cd5315787ef2c5481f34679fa1a1868cb0479b1607de5e45419ca83dc53ade4c8f714930d926e1f75b9fc692d02e0adb4823357239030154380d8ec79152c4f82066ae32b32671ba3415810548f948c1acbb989ed6e37a9391cab0ef57d5b2a0d2ca8278b67f10e54d6925ccac65097233b0d13574d7f476b79b0d7310ce3b9e3a8a92f747b78c06f3260a132760c9dc475e6bcf2cef67d23508ee613c83c83dc7706bd266d41350d04dddaaeff31429ee539c9af1f114795dcf668556d59183756a2cfecd2ab1f9c904b8eb8039fccfe950cd7883170adf2aa804019ddef4ed5ef94c56b0eeca274e84a8ee05604b743fd59f9b0707b62bc9a9454ddcf4a153956a6ada4a0f981e6656997383d97d8faf3fa575ba15df9f60d212470c482793f8d79d457be46f4c725b39ee01e3fa56ed95e2a69ef3798136b6d281c82c1bb7d2a5d0dc539a9248eafed24c93a91b2404e7272011fe7f4aaaf742674906170cc14752702b9e3ad33dccad1fcaadb936e720fe352c533b4cb104ea092c3818efcd714e8b4db368289bcd2865ca939c7ad67c37d0cb3cd99599c3794481807e9dc60d574bd31dc460296524e075e2b26dae036a45902e5ae15cb800f1b4f1f89a54a8ddbb8e52e53725ba8a291ad182b9d80955619ce79e6b26f842d26e7b7901e4f51fe34f9aea17d5f3f2b38871951d064f5fcea95ecd97043b7039e6bbf0b1b6e6559985345a5457051229a3f5279cfeb55e6bd593628caaa74cf5f6aab7722bdd3310c5b27be2a9ec62ca48c935e925dce16ddcd192f19b701c12c0004f22a9899a379148ebdcd0a84a92587249a55831965382783f4abba172ea5ab472f22afca8ac7963ce7daaeadd4fe6e1df764f46ed8e807e159d1ab44c55f70db8da71d39ab2a58dc10b927b1231c561249b368368e8acaf02618961b483f2b60806ba2b0d4258d4132b48a0f018e6b87b4f32de5cc8570cc14e3ae0f7aebec2c512e224672a2e006185e73dc7f9f5ae0c4460b73ae9bbad4e96cb538aedd90c45081f78366b4edbcb76ca3e474c29ce0f7ace8b45b54605c1298e7271c835a36691c3bd1140f9b8c77ae26a17d0e7a8e367ca5d0a3afad3b6e3a520619db417518c9c64e0575c153dce4d4f36f157c47d4740d7ee74e8adad5e3876e19c31241507b1f7ac47f8c5aaa3946b1b223a8601f91f9d617c4972fe35d4181042b229c75fb8bc5720cad2441093b97253dc77aed8d08c95f5fbce86a292d0f67d2be226a37b7b0472dada2c3230dcea1b2013d7afa553f885aa8d4458471a90a272339fbc335c67856e42ac2642701b193f5aee068f05edb417ba83b25aa4c5a38d07cf3fa01e833dff002e694685aa2e515e2a3cdd4c8974eb9bb9a38ed943108a199b85418e4b1e800f7ae9adf42d0ac7634f0b6a539e8663e5c64fb2f56fc8d6c5ae977377b65bec5b44398ed21e360f73d8febefdab5e1b486d94882248f3d4a8e4fd4f53f8d77c20a2923cd9d777d0cb171a9f9412d614b4840c858a0098fc5c8ffd06b02cd7c47a96bf7865bd9ce9b19d8034de5e0e3b7960127dbdeba4d52e24f92d6df06695b6afd7d4fb01c9ab36b691d9db25bc59217ab1eac4f527dc9ad92496c60ea48ccfec693bdd31facb31ff00d9ea44b0ba84831ddc831e92b9fd18915ac139a6b2819a135d88739320b795a78097037ab156c7a8a8a5ef535bae04c7d6427f41514c3ad691dc4ce67c45e24834184131b4d70ffeae2538cfb93e95c35e78bfc4375bf378968a7f8208c647e279abfe3f25359b77c02020201fad60248b24a03c51f3d302b79455916ac92b104f77753926e6fef2727aee98e3f2aaeb15b1c168c9f72735d0416d6d2cfb4dba807b9a8e4b382390a344a4024641358fb485ed62f964d5d332025b20fdd5b8cfa15e0feb52c77087eec11af3d302b5058da30ff578ff00811a54d26d725f6bf039c3d529a25ad6cca0b7586fb91e3d80ab42fa33f76d901f7626aec1a45abc41995c9ff7a8b8d12dd61692291d59464e79cd2f6d1b8b90abfda0401fb9887fc04ff8d386a4c33811f3fec0acb202ff00154d6d1ac992cc401d877ad6e4346926a2e3246d1ff0115226a2e38cafe2a2a08e28d7a2e4fa9e699320c6f008c75c535224beb7ec48c6dffbe6ac477929e4a29fc2b115f1c8cf15a76b36718e4d0dd876d0be2e98f5893fef9a99658dbef4319ff808a547049078c8aaec5776052552eec2e5ea6a5b7d901ff50ab9eebf29fd2ba786e9ee74f92da2b9c975da04fcfe19ebfceb88566423278ad2b5ba2a4104d4d5a30a8ad2438d59c1de2ce33c47a75d5a5e347771344c0e467907dc1ef5d27c3b9af64d545ba4edf6758f2e1718c575322d9eb7626cb518849191c37f121f506b9ab6d2dfc13ac25dce8f7362dc2cd1f18f63e86bcbc6e114a93515af6ff23d1a188551f99ea41b6e14726872c172ab93dc556b0b98efad62bc873b2550cb9eb8abe0715f3b4e129a69e963a1e8caedc2071c81cfaf158773ab69f637335d4f7d12a38dabb98fcb815a7a95e8d36c27b82a08850b00cc06702bc2356d49f52bb92ea4550d2b96214600fa0aaa386f6d271bdadb9ac2c93933d5adfc7da1450224d792171c33f94dc9f5e95a96fe2cd06746923d52df819218ed3f91e6bc291d7660f24f18a6c6cdb82af273d09e6bb560525a37a12dc5bb9d1d83d8ca77c162f7b705770919776efa17e3f2abaadaa24d6ec90db69d13b108a4f985723b8181fad11ea96012ce65b88b6a614907a0c722ae4da969b34f6e82f6d98166054c839f94d7a2cc5bd45161a94aa825d55731b93bd6d4673db1cd4a963339759b54bf6973c85755523d7017a7e3da8b2d56c4da26fbeb65651b4ee9541fe74f9752b34bdb47177010e4a6e1202307d4fd40a96f5b0ae456da5db88a06924b92920dbc5cbaed6cfb1039aa9ad6936a9a64d70be78f2c6e5dd333703af53ed5a71cb0be94d1f9a8db4329dac09e18d170eb75a63066525a320807daa64ddae339bd96ff00f08cfda6c924fb42b12c2399882064e719ee3f1a93c2d7b7378195b53bc8cc8be644032b0f75f981ff0022aaf87ae1ed26b6b4932d16f01811d3248fcb06a2b5867d127b9b4407ccb59888c1e3744dc8e7e95aab37a8afd4e88d9de586bb65e4dd412348b2941329550d8f9b85f5e2a35b89ad351b8f2ede4b4620131c08b2c2c40c9217218f5e76e08cd1717135cea1a619e20842ca55c3e4e760e7f3accf106b570bae47a7bfcb69711a48500c1df8c72783daa75d813356e75b8e641e717b5b94caec5dc19f381950c01f7c1f4a7a06bad350ba80eaca72cdc9e460fd4d66ead7af2f842ee2914c8d1e3c99b19604608c9f5f7f6fcf36c1ee6eb419194caf1a441c856070c0e7a11ce08ec411ef5496fe40f53d1a68f7d83468433b0daa7a723d7d318fd292e5bceb175453b986ddbd083e95ccf87356457c5ddcc612e06f8db7e503f01867b67d0fa574cff2ea0aa7a48878f71dff002cfe55335660432b79a97040258a4790bd4302dfae6a591c1fb3c9c643839edcf07e9dff002a8c8f2b56c630b2c5c9cff129e3f427f2a962005dcb191f2b2ee00faf46fe9fad4dc665df923c5fa6018c10f91efb4ff8fe95ad1e16e5e2ec06f5fc49cfebfceb22f1826ada4ee56664b89549eac576707f2fe55b1b44918915be66f995c73f4fc28e8084ff005778133c382c07fb43ff00adfcaa2b7252ee45c9db24ce719ee00fe9fcaa44c4e8c586d6ce3af2a47a5476aad22dc7984799e7300476381cff002349016518add94dc76b2ef03d0f4350cc7878cb121668f009e80b038fe74f8c99a1130004bdbdb1d47d2a1b921ac52e10ed62c8ec719c8dc091f87f4a018b3b9fecf9b2e498e503767a61863f218ab13b27d96394e38da79f7c67f9d47751900a47c6f561c7760320fe62a4460d305e363279807d7aff003fd69815962846af32b4719de46e1b473f2f1fd7f3a992dad4cb708f6d0ede08fdd8ee39ed4cb640d3dec6c3eeb2a86cf38c647e5fd29e1c7d9e194919dc371cf5c9c352039cf10a4492d9ba22c64c4376c5c64e706a96c2095195079ce38cf7ad0f17c78bdb5741f36d248edc565c73b4d1316dccd1b7427a8e9fe229d3ea825b0e89986c90a92c186ec1ae8ac4c891c9e58cb23ab00dd08cf7ac000b964c360af2319c73d6b734eb8d9790c8c18ab2630ab93fe735a3d8946abeddb718cee05581c73bbbff009f7a78cb5c4cb2e049e5ef400e47b9faf4a823427ecf30ff0059bcae0e71b79183fa734a1967841c111a4bd4f5c13dbdb07afb56650f520ba2ff00cb074c923b7f9f5a5ce4c3e58567910e549c02477fe7cd234bb1a7b7c1f3170ca42f1fe1f87bd2131db198a83b76ab0392483ededf4a007c6b14912b33153265dd8750e3bfe158fae2c971159a3322c8eccfb3a81d3e6fd3a56b3200d24aa0064daeab9e307d7fc6b36fc5adeea91c4b73e54b1aee8e3fba5867e61fce807a12473379055080883706cf2323a7f3fa563ea36b6f1f88604458a4461bb058649200fe7deb46f3ed165692431a89265fdd845fe2047618ae55fe48c3bc723b0c45286f9594924e7e9c55c6f7224d1d7ad959693a4325e6c0ae774647323b062190719ee39edcd755e1abc177a629064c29e04bf7c824e33fe7b5735a546d2697e76a31a4d144418dc30612239e4f23208fe95af6af0bc9e7585d73187dfb1b23033818e9cf5aa9f604ccbf1d5c7997b691a904052770f7aa1e1d8ca2cd144bbb3114e4f73c0fd715278b044a6de372c6705932070ebd73f5c9acfd1ae25b5dc5cb23ed246d39cf3900f1ed5825676345b1535277fb639639279ea3d2abda93e6cd91901ff4c0ff001a9f50189f0c850803703dfbe6abda91ba41cfcae01cfd2ba17c2652d646a4112b5bdc2b13830b8fd3ff00ac2b97d997450b9381f9f15d5dbab3dbceabf7da161f8e3ffac693c23a5a4f31d56e40fb35b00cb93f79b9c7f3cd5415d8ec68c691f853c3bbe4005f5d00cfc72bc70b5cdd944f71334b21cb31dcc4d4dac6a2fabeaaec49f2d4f00d5a82211438ee7935e8e1e17f799c389ab6d8989e2abcd2607b9a919bbe7154659373926ba66ec8e3847998d273f8d0792aa3bf5a603c93da96339cbfe02b2376ac3a460062a2ddb632dea695c166f6f534d9c08c0507383d7d690c90480f7eb4bb81ef5441239c9a5f3980c568a7dc874faa2e6690b71c1aa8676cd34ced8eb4f9d13ecd977233834dcf354fcf6f5a4f398fa668f6883d9b2eeefc68dddea9199c719a43331ee697b443e465ddd9efcd048aa3e6be7834798e7bfeb4fda20f6772f678ea3ad1bbdea8ef623af35da5be91a749044ff66c96456cb31e7207bd4cab25b95ec99cc1715d3787ec8dbc2f733ab0793841e8bffd7ab51e9b61036f8ed230c3a1393fceaf46031c1efc56156bf32b22e14acc8e68e3b885e29503230c106b11fc356e4fcb733afd706b7ee53c87d81c11d738aaa5fd0d73c66fa1bb56d198a7c3716f502fe619ebf203fd6b453c0e8f1a93a9ca33dbca07ff0066a9d4a99172c460f5c56ec52abc6a4123d334aa569c5685d2a6a4f53057c15194f2db5293078c8887ae7d7daac47f0f6d8f5d4ae187b20157a4be29abc306ef938561ee738fe9f9d6fdb49c106b2f6f53b9a7241b69743994f87da6e7e7bbbb6ff8128fe953c5e04d1540dcb70fcff14bd7f2ae951816269ace1403ee6a7db4df51f2aec50b2d0b4ed29647b3b558dcae376493f99a7ea333290809f53533ce182a0fe222aadd12d338273ce0566e4dbbb2d44ae1ce7bf3597e2198c5e1fbe39c7eef6fe640feb5aa001d79ac5f16023c377583d4a67dfe61549dd8dc6c8f352734dcd07bd34f7e2bd33cedc5e0e2928ed49d698682f3f5a07f5a4a4ec28131d9ef4719cd2718a074f7a0a1c0d49918ef51ff009e69c1883eb4312055ce48eb57ac2608707b0fcd4f5aa21b637f3a78631c8197ea3fc286b41265975fb3dc150723a83ea2ac951342477ea2a29b12db2b2f3b391feeff00f58d25b499a9bdc6c67de4f46148addfd4d4932ec9778e8dd7eb51b801c7a37354345b8a4f971d79f4a9d4f39e959f0bed700f4cf357241b1b00e548ca9f515a427d0ca74fa915fc01d4c8bd0f503b55df0aeb434ebd36975cda4ff2b06ec7d6a142194a30cab5655e40f1b9c72474f71535e9a922e854e5763a6d7b4eb8b2d45614124b0be5e2206720e07e758e746d576194594aaa0e7e618cd747a25e1f11686da719fcbd46dd775bcadc9fa73f4c1accd5adeeecf4e6692f27122b81c85eb9fa57973a68f51546d5cc6b7d27549fcc44b198c9bbe662b818fa9e2b4c6957d66e927d9db00ffab2c1811f9d52d127bebe92ee26bc70210186157b9fa547aafdae130bb5e3b131938da077f6151ca84e6d9b89a55cdcc104d146b11287cc12b84c1dc718079e98a94db5d5ba9579149209c2c99041f6ff003d6b174a17977a7bccf7d38c315017007007b7bd50d60dd412f37933622ddf363d4fb564f0f1968cd16267167550584f33993cc5418ca9770a3dfdeab1d39ed9cb25cda82652432bf24761d3eb58ba3b5cdeb98fedb70ab1a02763ed1c9f6156f53b4960b68c8bcb9c798072e4e38269430f1439e224cbb1e8d7c7516ba9eeace0800da079996233e8051a8d9b2a961756c3a850491bbf4aab656f7371a789dafae324b701876623d2b02e2e2f24bbb989aee6096ecc172dd3807d2b454d2d919bad27bb22b9d3a6b611c93b2012bb804306e0639e3eb55e550b24615c32fa818f5aaef753ce837ceed93900d2c99184691b2a7039feb5af28b9d96d91422fa16cf3f4a5866744981270e17f43f4aa6e1b6e1b77cbd7f1a9caa25be73cb81919276f4ff134581c996e6bb0d2120261b00e074f7aea6ca7d0ac4472cc1259c28c492ce0678ec07f5ae327861df10565cb2e481dba135bba040970f72ac8988f017073d4b567caba15294bb9af3eb5a23e40874f4ce3f8873f5a68f1546f7082378e46889f2b0471d7a01f414935ac2261b829c019c74ae77c958a5692380bfcec005eb83bf9fe54a504f464a9b4f467a1bf8b996dd6e241142a1b61dedd0f3f9743f95447c68a4029776e3d71201fceb0e16b89ad2385e20b6e4abf23e6dd86ea7e86a67b48c8f9500e3b8ace9d0515b22ea4d5d72b34ff00e1367dc317507fc0a71fe14eff0084cda44db25c4273cfcb2ad603d8c21d898d0803ae3ad44fa7405770863c1c0f71ef8a7eca24731a17171a25eccef7367632c929cc8cdb72c7b1dd5e7fe20b5b2b2bf2964c7c8650f82db8a1e7806ba6bdd220874cb93e4a8c4791903bf7ac8f0ef85ffb66f3cfba0c9a740479ce3ef487b46bee7f4ade174add02fbb6cd6f03e84668d751bc8d8d907fdcc6b90d7327a0ff0064773f857abd969ceb28bcbdd8d738c2228f9611e8befeff00e49a4694b6ca93c912c720409142a3e5813b28f7f5ff0039d8db8aa56472d4a8e4fc88b6e054373288622ddfa015688ac4d499aea74b48c90646d991d97ab1fcb8fa9ab86af531686e99099e49350939df94873d933c9fc48fc80ad35000fad015635088005500003b0a776a6ddc8dd8ce86a37618a7b1c5559e411a16efdaae284c7dbf306efef313fad4530e2a6b65db6308ff006727f1e6a39475aa8bd41a3cd3e22c07ceb49bd8ad7351ac602489863eb9ce2bbdf1dda99b461228cb44f9fc0d7036db7ecb8c77e7eb5d32d62994b58976ca68fed43cdc918e3eb5a43ec52bb3c91b124e4e09e6b3f4b7852e58ce76c601e4d444424124b127a75ae6b5e5b171ba8ee5cbc7b545fdca327bb3549672c0f12a3972e472474ac76466ef524619304315fa569ecdd8ce52bb3a189ede31e5ee3f2f7359f7facdbc61e184990904123a0acdbf9a5100311727f88e7b5662024f5fd6a5525bb2d325ddbce4faf356633f28038e6a055c1a980e063a569725a2eef2171d282c0a1073ef50824c7f4a447ce41fe74c8b598c070c4678ab36936c24648aa4e76923a0ce6a48773b865e3f1aa1b365673b79639f5a72ca49ce79aa8a001f7aa55c67ad251684684529231fcea6572873daa8c6e074ab492ab704d52ba25a352d6ef0472735d0da5ec7342d05c2ac90b8c3230c835c516303679da6afda5f10464d2945485aa7747753ea434cb2574b6f32d9001b95b1b47b8c5677fc271619c796d9f66ffeb545a6eab8f94f2a7820f7ac9f10f847ed41aff4996441d64b753d3dd7fc2bcbab8285efb1e851c429fbb2dc4f136bd06bd606c629a3b78c9cb1752c4e3d3a62bcd2fad1ed64d9232b0ea191b20d69ddda5e5ac6ee6ee60cbd980e7f4ae79ae6e6767f3e4df83b4103159d3a2a95d2474f34ad660b30f3826e56c1ea2acd9ed9aec73c86eb5951a6c9243918cf51eb5ade1c8924d5d0b26e4f3012077aa93b458b7676fa5c9b5228c330200ea7191ffd6356ed324ac321ca877923f6c31047ebfad5458cc29195393bf72b1ecc7b1f63c0ab5699b88a39d3236972a0f7c93d7f3a96eeee22e4e8c4074c6f4e467b8f4a858452a5aca11184926ee547753528943c7951f313b483d8f7cd43b0dbbdb43cb279b90c7d70dc1fcea2ec3a8b6d6d6f0cad6c218f6a0debf283904f4fc39fd2a3bcb4b64766fb2c05251b71e50e1bb76ef5636379a6e132c4020267a8eff8d32ec2dd401549dad86c8a4d8ce225b758e59a511a16865eeb9cafa1f6e95a1a9dbdb32e9d769046b6d705a0923031b5f1953f5e08a64881afae51c82198ee1f8559b1c6a7a15cd9963bf7e50e725641ca67eb8c569077426ca005b868e27b65f372e0b8070c98cf3ef9e2a5f156996b6b7d6d716b1ec8c2b363258311c81c9e3271552ee6115cdbb48bc386fbdfc248ad9d79fed3a64327de3d0f61fe78a72e8d0afa18e2249b4f243481e5037812360faf19accd3e69eee7bb8fcc9445b4ec44623e5040c0c1f4c55f51247831b614e5950e3ef608db9fd6b36c254b7d43ed4836470bbb4c84f45e8403fcaae366c57d4ea2cb4b0f04f6f6cd2acd146278944a42ca8720a91eb9cf3ef5ad6f651dc5a433e99717ebe48cb599b821c29fee93dc1e9d8e31c56567cbb5b4d420531cd1ee59b2480e87ef67e9d7ff00d55af67796cb148a64914a0335b5cc639e7ef2e0f0467a83c1a53d50d3b1369da7a6a1656f791ea7a8f988a572f36595b8c83919edd2aca69b3bc5f684d4af9660a579753d0f23a7a8acbd3ae45cd97da6cd8c5751ed469718df81c2b8eea4743d455ab6be2c67898957de58a9e1909edcf638e08eb51cb70722bdddbb5b6a1a4dd2ea33319e627322ab053b7faf435b623bab440a2e63310ea5a1fbbf9374ae7eec48d79a7458dc16677c9e472bc8c5746927996e616c6e280723ef0e99a6e368827711a3bab5dd209a0d8cd970d0b7ca7d7ef7d2a080de42d3c9badcab4e4302ac307803bfd055d3936ef6ec417d9b413fc43a67fc6aadb6e92da6b772de699183161d7dff004acc648ab7907eec0b765909c1dcdc1fcaa2b93751c02dcc50942ca4112b7dddc3233b7dff005ab4d99808cb6248d831c8cf4e87f1a86f8f990898673130ca01924ee19140c937ddc8c7fd1e132c2d807ce239ebfddee38fce996f25c1b7f363b504a921499864007eef4fc2ac230494ca0e566195fc3a7e7d69912fd96636e376d9b2ea7d1bf887f5fce811562b99d2e6e255b5765731ee2255e41ce0f5ab625905c143632ed233b7721e7fefaa8a048fedd716a7254246c01f419eff005a9f714579cf2f112adeea3fce680399f12f9b7125a10922089dd5c3e3e61c63a13d2a9ab2ed8f00fcc003efd4ff009fad6cf8a87956d6d24640cee567fcb9fd6b22350b0f96ce4f4209ce47e3fe7ad4c1fbcd0dad061242e727287827bd6ee92df33966c0787ae31838fe75831dd24ccc23911987cae8a7a1f7f4adcd2b613668ea1d3cdda430c823a73f98fcab6211acc4badcba93e5145250039ce3a8f6e9c54cee5a580c054178ce49195c76cfeb5123b4576d6e33b7cc2bbf1c0ee07d7afe94ae12dc5c247192ad82154739c7247e3d7eb59943c32adbc4cc0ee12156f5efff00d6e688b72baf9bf7d652071c63fcff002a4215e5171f2ee787861c8fa7e59a6215bb5512c4c17cadacae30777f9cd031c1995d41c791e6907ae403fd3a556d4b4bfb73d8c909659e2765560c54853d391c8ab419f688f6e58c5b37003a8edf5ebc55b52b6f0c8110ed9230085193bc0ec2aa2896ccb8b4a768f3737b78c1b25899df2197a77eb5c56a77f732cbb55f705420bc9966dc0f5248e335e837d320866b8e92b2ab47b79ce3dbbd79e5cc30112ccacfb9a7c32eefe13cff003cd57525ea5b875c7f27ecf26d113e149dbb54e7d703900fe59aeaf4296ce0b18beca9cbc889202dd4b64633e9c0fcebcf617529b022ef656ddb9b8e4f0c3d3a7eb5734d5417251ae7c9098f2d9ce532013b58e7819039e95423b2f16a2ad85adc81ba5c924f7dc323154b464595cbbc637228233db903fad65ea3a8df6a37123ce9145e6347234283e5c818dd91d722b4f40943c99f3510b47d5d720e78eff5158d9f31b27a32b7883325eabed1ca004f519c91fcab32df024989e0b10724f723ff00ad5b9afc8f6e0daf968430ddbc28518e3803eab58108669650980d818cfae0f5fcab65f098bd59bda629b895a288334aea42ed1dcff9356bc4373168da3dbe8b66d9d8803b7727d7f1ab3a1a7f6568f26a977b7ccda563f7f535c84d349a95fbcd21ce4f02ba29c2ef949a92e5458d3a0c7ccc3a727eb5a0cd4c45114413d3ad2330cd7ab14a28f2aa4b9a5a11cd2616a9b375e6a49df2f8f4a840dcfb7b7535937cccda11e5429ce0019c9a95b11a01d703a53118190ec1c0ea6992b7afae6a5b29210312fbb3d2a195f739f41c0a76ed9196c7d2a1e873405818e07069a49229493d699430404f349467de9b91d6818ecd266933d462827d69300278a3349d68a005f7cd1da938e68ef45c0703d2bbcd1e4f3749b4ca9e23009dde9c7f4ae08115d3e8da9c3069891c81b28587dd27be7fad6735743474580aa7ee8a7c6c3cc51918cd621d763030b167df69e69a35899a41b6de4ce7b29ac5c5b293d4debd38653eb9e7154449927daab5d6a52ed469e095001c12b8feb545751819c90c413eb4a11d0b9bd4d212ee6e3a55fb776d8dfbcdaa3ef71d3deb063b956701655cfbd5f56255d37821c85383dba9e9f4a26b417372ea48d1cee9fda001c19719c7463820e3db02bb1b79967b68e641f2ba861c572773737034f5d3d0c7e5ecf31f23920f38f5ff00f5559b1d5678ac0222a32afcc09ea01e7f9e6b8649cb62a84e319dafb9d500197951505c0da33d85612788e551995700752ca3fa54a35bb79b97947d3b5254aa2773b3da40d28987da23c8fe214e9f1e6ca73cef23f95538ef6cda74649d71bc1e7b0cd5961e7349e5488e0c9bb2a73c537a31dd3d866e5ce3233587e2e60de19b9c75dc87ff001e15b26228c589fcfebffd6ac5f15a13e18bc239c6ce7fe0429c774396a8f3463eb4dc8e69189cf1477af58f2c5a3f0cd25183e940013db34a29bc0a5fc680171cd2119e868e9d0d2e38a0764c0669f9ce29a293a1f6a0362571f2061447f3a95ce0f6a701ba13f4a8118ab7d0d6ad686516eecbd6b273b08e0e5b07f222917f7333276cf1ee2a2662ae1d7afde1f51d691a512ca58703b03d85646868b289612bebd0d56fbe98ee3f9d3ede42414279534920293e47471fad24321272030fa1ab70b19100079154c9c395ecdcd3e097ca9413d8d329eaae5d573ef8cf029664f3e1e07ce3f514c7c6ec827079a54721bad6f16a48e5945c1946cef65d2f508ee622432b74f5f515d8f8aede0d67c3ebad5bee2cbb4c8aa7a76dd8fd2b94bf801fde2f46ebec6b67c1facadb5d3e9d74435adc7c855ba64f1fad71d7a7caee8efa15149193e163235d6a6a5b8118c1ebcf38aadad5b0827460eeeed16496efc9ae9a3d0db42d6352b71cdbcaab240c47de539ee3b8e95cd6bec16f633b76b08b19db9ee7d6b96495f436d997bc38cc745bac95244a704f7e05636b4861ba775918bbc609ddd3a915b5e19ff917ee5b033e79fe4b589e2660d2fdd2310ae0824773492d40bde0d9a4967bc0f8e1506781dcd5bd6ad59e28a77b97c87da141e3047f3e2a9780c82f7ec78e13afe35abaee0d8c44171fbcce548e783eb49e82bdd93d83b47e1d8f68e46e18661cfce6b8e2cdf6bbf6cedc48d950460e00aed2c540f0fc23249da7bf3f78d7172707526dea0899faa93dbd47e34d6c0919cb740b8fdcc793dcd4ad2c7f6d09e52480be0381f7aa946c33f78061c834f89b1751fddc2b024138cf7a6c66c406d9ae52ddc18b781912019cf3dbd39ab0d0daec8c2ae2463827b7f2aa8b2c2d70f3aa85709b9998f5c1c71c7b0a62dd44b8caee23a7efbffad52dbe83dcb1b4071b7e6e0e70b9ce066b7bc34acdf6bf99480c3b81eb5cedacbe6b49f7115236232f924ec3ed5d07849c49637078c8900e0e7f873fd6a5bd41ec5cd4617ba79a05768d1c6d24119fc2b945b558b6a07933908086aeb6e14f9f232838f504f5ae1f506912da320e18b005964f6abdc2274ba1cacf706332cd2617905cb761ce3f1ae8fa840c8d818fe13d2b8bf0429379785fe63e52f7f7aeccefc2b2b3f1c9c1ff00ebd4d84f720b88a38ed8cf753791096daa361667e3b2d36d2686f51c58586ab78231f33470a003ff001faa9777b6fa96a7fbd9152289762abb601c76c9f7ad26f153e89a72da69cb0acb29dc65041007b0e9f8d6bc91e556dcc94df35994edad5fc4d6af6561be3329f2dde453ba2008dd91ed5d378520b47d56f2cace23fd9fa49586263821e53cb313dcff008fd31ca681e245d134bd76f1f7493cee5e12318dfb793f5c9addf0eebfa7681e16b3b3b6717ba8c80cb3843c091b93b9bdb38fc2938dae8a949347a1e3da822b91b0f14ea134ea27b68244638db112ac3f3383fa574b05ec374a4c4c432fdf461865fa8a9716b732d1ec3ae25f2e22475ed597a7a079e7ba6e71fb98cfb0fbc7f13c7e146ab78d121d832e3ee83dd8f03f53534517d9ada2b753c46bb73ea7b9fc4e4d5ad158864cce3b534c9c75a8cf1d3351306cf00d5a22c48d25675ecd93b4761cd5a70e14b1070066b10c864b8504f2ee07e66ad30e5bec74eabb6245feea81fa54520e2ac1e951362a62268c6d4ed16eed65b77fbb2291cd790dfd9dce8b76f14d1b6d27bf461ed5ed9347bab3ee2c61b94293c292afa3a835d70926acc4a5cba1e35f6e80e373943fdd23a54c2fad0702e23fc4d7a03782f4420f9d64e0e7aa48d83fad427c11e1d231f6594fb79ec29d97461789c28beb627fe3e23ffbe853bed906789a3e3fda15db1f04f87c1e34e91beb3b503c1da12f4d254ffbd339feb45bcc5789c49bfb72083347c7fb42a0373684e3ce8c11df775aefc784b445e9a3c1f8b39ffd9aa41e19d217eee9169f8a13fccd16f305248f3f13db0e7ed5163eb4bf69b5ef7517e75e86ba069a3a695663fed88a70d0ec07034cb41ff6c17fc28e45d47ce8e022d42c6339373137b75ab91eb9611b6e578ce3d5463f9576c346b4eda7da8fa40bfe14f5d1e0e82ce01ff6c17fc2ad3695933294612926d338a1e22b10c4fee493fece7fa53cf892d49c8310cf24797e9f8576cba3ae38b54fc221fe14f1a31ed6e3fefd8151a772bddec70c7c4b6bb8b654e460e23ffeb529f145b67855fc231fe15dd8d15bfe780ffbe454834563d20028baee3b47b1e7d26bf673e37c6c08eeab8fe94dfed7b3fe112fe478fd2bd1068927fcf303ea453d74390f5d83f114b9d7704a3d8f3b1ac5b150a4be3fdd3fe14f4d56d81e378f7c1af451a0b67efc63f1a99741f59a3153ed22ba95647076faec0846377d715d0e9be2986223e66fcaba05d1953a4c87f4a9069a47689fea47f85439c587226735e21d3a0f1058cb3e94c897a57e6899b024ff00ebd790dddaea1613c90dc5bf9722b72a5883f8715f40bd8dd67314166bee4293fcab36f3c367517cea1630dd2e7900aa9fc08ac25cb63d0a32d2d3678244f70a72235619fef56bf86ee6ea3be4f2aca3959c938336daf41bef867048c5ad7ed76c3b230128fcf835936df0f755d36e8cb1cf14abd4021948fcc5734e378bd0d9455ee996e06ba96150f1db904720b37f8549a5cf74d1bc7889c2b9da598a938383d179e7f9d675b6b96df676590386840dc5406ca9ff00749e79a847886c96456b412bc8b231ff0057b54a93d0938acec4f53a0324f1df2130c5971b48129c1c77fbbf87e34dd41a778103db851e62f2b2838eb83d2a359750b852e9616fe5b8c8692e3afe0a0d337ea8cc90ccd64acae87203367248079c77fe549a158d082ea678237fb23f2bfc2e9d7bf7aac2e2449a78fecb2e09dc0653bf5fe2fe5eb51bc3aa424cef7f6eaa480c22b63f4c9cb7bd3e4b3bf2083a9204072316a320e7d775276b5c673f74eff6c99cc32ab6ec60ede7206475aaba25e8b6d46685a290a4d9465039cf6ab5742e5a562d3a970c43feeb193c7bfa7f3aca52d04b2b900c80ed56e4673cd54103ee58d790a5c46af14814963965c7cd8fe7d0fe35ab6d702eb47962943ac9c1c08c9f9c0e7a0ff39aadaadd3ea16f61733da28e5b2f1c9bb70033c8c0f7a6697710477536e7312cff003333fca0483bf3ea2aeda344dba10b6d7b50577068cef1f2919c7e1ee6b9f8a3cc777b9f026214166c024f24575c1949917f8083c673f51f9d60ac493de8b3915b010b03d4124ff863f2a517a88d1d02f16eb41fb05df05331b1279eff00fd7a2c2e41b0bbb096653e56e504b01d38c83efc707f9d51b2ba9346d52d6064086e98b33ab60961c0fe5fad68dfce6df528ee94e1ae4e5df7756033fe7e95a36ae1e641e1fd4a5134d6db040eb1280c64063940c63fa115d1ea37315dac6f1a03711fdc7deabb1bd3af233dab334e863802b632b2286dc07dd38cfe5fe15bb72d079b6f72d14663b85db2e40f958746fa7afe153e4366348ed7773664b1e5cab056c146e98ce73ffebae8ece754905a445a4685bcc4e7f80e722b0355b75b6d52ce44b64756906f400738cfb56a35bd9c7a9dbca91446299412428c1f4e31df345ee8563a09b27c992205c03bb81fc38c1aab16ef30cc80b2899cb6067008a44b2b3fb5345f668b6b20751b7a1ef515a595b0b9bb88c000594b26372e06074f5e79fc6b1b59945f24adc8940fddecdacc3eb91fe7dea1b9252298b676c8e850fb823fc3f4a860b5b622585d5c1524afef1c6573f5edd29b340834b38699665dab8333f0d918e37530b97846c20fb36409010ca7b6339a273e6c96e57e4916439cf6383c7d0f14c7817cc8e4496e76f3b8f9cc703f1f7fe54c9ed8a486517171b54039f332770e83a7b9fce87b80f8d95f51b89e30fbd110321eff007b23eb53f01430398e720364e7af4c7f2fc6b3e08b17d72c2eae7f7a11932579e1873f2f5ab2b6afb85b9ba9c051b8602018cf6f97f0a00ccf154eb6f6f044ea4a127677ce78db58518222058fce83a56c78921696d22334cd23aca5002140040cf603ad62c2c5e12c57e42d804ff3ace16e7653d62451c404c76b2a0c6785e4f23dab674b3bda1e464901b8f71fd09acc552ae194e193a91dc1ff00f5d68d836db794e46e46dc33fe7ebf9d74199d40923730c6c373988a329fe220f5fcc7eb51094c28af33e5964c176e38cff873ef53b4692898ab10db04a8c460ab0ff2062a3cf9d3c6658d541420a1e40fa9fcc54356652635837ef9c6ef2c38758c0fa648fc41e3de9653e6c8e603cee0e1c7391dfebd0532291d7c8461b523250c87b03d01fd39a96126dde2d9116dbb8320ed9e87f1e29012fcbb4a95c9de24099e71dcfe95662dd19c4a4170e640c063e43d7150c6815239890254431993d49c607d3a504896126e23c2aa794637e7e6ec7e957b12ce7f55bc02f15770f2f73b819e769ee3db9ae5b51bd46bc6b660a022e41ce7af4a8aff005096e2f0b4ccfbe2040f971804e00cfad56b86dea18127e619e39cae49a515dc96fa0b26c670c1f1f3282547f7793fe7dea45760e3cb2013d38c7279fe55531e5b32272c3e70323196ed56ad879d23f38c9c8279ff006455d8a27b3b89259bcaf9f69058a9ec0fa55bb99560b68e442d8f336a95ed9e9fca9a919b5942f0c187ca403db8c1a7fd989b668c8df87dd81d88f4ac65f19a47e11bf6a7b888bc85d9831da58e71c93dead68962da96a82da30413b4bb7f7579c9fd0d51f21a042841233c657d38aec34785342d026d4a4e2e2e57080f6504ff00335d714ad731ea54f186a6a644b0b6c048c0000ac8d3e00abbfd0707d6a96f7bdbb69589259b8ad85511c6107615df87a7657670e22a76158f5ed51b30018d2bb718aaf33e108cf5adea4ba1cf4e377720272492781de985fe4f414313803d4d230c95515926743564912c60ac7ee6abb3ee76e78ab3210a84d5141bb2d9e296e24c566f976e78ce69a4f414d0738a527269ad46c77f0367ad424d5944055c1e7e518aa8dc7d69c975213d47134dcd213cd26702a4b1738e68269a4f6a43485b8f273d68dde8734cf4a4cfad053d07e79a5dd9a666807b5021f9e6b6f49b669ad8bf992a8de47c8d81dab07152ac9285daaee17d0310293b9563aa5b02464cf38ff818a0dac5b9435e48067926515ca1dcd8c963f5346c3e83f1a8b3ee559f63afbcb5d3a182311ea8cc79c832ab7f4acf29629ff2fa3f065ff0ac0087da976367b528c1a5b94eeddec6eacd668d9fb7b03d07ca0ff4abd617d6cd3044b9329cee3950b818c7b572be59e99ad2d223b613169de4128e50a903d7ff00ad4aa4538ea4b8392b1d42992dcb06da50a6d523d33df27de9ada9da6913a998bbc6f1ed0100627927fad5195a2427c92c3b3efc7b7031fe78ac4d522905dfef1f2a47cbfd6b9210bb49b1c70fcb153e6d4e8dfc51a51663f66b8dbd942aff003cd5597c41a4383b6c2604f7c807f9d735e58ce3753920f3182a659bd05742a51eecd5b97634a4d5d464c1e78f690834b0f88ef202193861d0eeaa02ca56c8f29f8eb918fe74efb030e5e48901f57cff002ad7911949a5bb48da1e35bd65db344b2e391f3631fa554d47c533dee9f2d9987cb4931921fa720f4c7b5528ece191c2a99a4f5745e0524fa4326712a6d3d37e54fe54bd8c16b617b6e9732cb7bf34679ffebd333c9cd2a82ec15416627802b42076ea01c56bd9f876e2701ae1842be9d5bffad5b76da1585be0f95e630ef21cfe9d2ab97b92ea2471a01638404fd066a75b4bb6fbb6d311ed19aeea49a1b685a43b511064ed18ae62e75ebb9e43b266863eca87f99a1d90a3272d919c6c6f5464da4c3dca1a85d648f874753eea455e1a8dd673f6b9b3ff005d0d48babde746b8671e8e030fd452baec5d9993bb2d49bcfe35aed776f3e45cd942d9ead17c87fc3f4a89b4cb7b819b3b8c3ffcf29be527d81e868d05b90c3f34233e86abbfc8d4f75b9b493ca951948ecc3ad2c837e4fa9ab6f44888c756223e50a83c83919a58d1a462131c0cf3c7150a314931ef52c4e61b857e7683823d8d66cd23a93425a2ba657c6e1c1157265df09c7de1c8aa73332deb640e3033eb57633b803ea290ca8e43441c76e690f67a9550a4af19e4751f4a85548df19ea3a50cd21abe56684016580124e4534e14d436536c9369fbadc1cd5d9e3e320723d3bd38cacccea46e86290ca518643565dc46d04e48c8653d735a0a7b8a6dcc7e7439032ca3f315bce3cc8c212e5676da55effc249e1a784106fe053b39fbdffebae2ae740d5aeaf0ccd1928400a5b8dbed4dd03559745d5229558ecce187a8aed3c430dc2345aa69b2a1b7b81f3291c2b7d41ef5e64a3caec7a71973239cd36d67d3b449a39e268dfcc662b9ebd39ae5b5bf3e592592e23611851b4af3f2ff008d7636f25ec56d24b2059a5672c016e31c7b50fad4b1afefed1f1df680e3fa545f5d4460f811a2115f98cee3f275f4e7d0d4faddf02b0c4b06464b6f5048fa56bd8ea314f2dd48b6eb144b81911f964f5ce6abdeebda35bc7b161fb43f50a0f1f9d1bbd0348962c940f0fdbfde2766eebea73e95c3c8fbe3d4c2ff00ac6924daa3a9f4ad46f11b0b74b78e144863002ae493c7a935041ab43093b6c6d0ee3b9b7c41b24fae6b58d276d4cdd448e656da70ea0c4f8c1ec40e94c21d64ddb5ba8ea315dda6ada6de00979a35991d37c00c2df9a914e5f0dda6a80b689a84a9718cfd96f5810fecae31cfd47e34dc11519a672164649e40a000cca40fcea2dd2920f94d8ff77deacced796f78d0cfba29518ab2370411eb4d9259e39591dd370241e3d0fad632567666bb12d86efb35ebb28cac4704f51c1ae8fc1449d32e416507cfc80703b0c573893b2412031b65b82c31b719e722ba8f07b799a55c315014cfd178fe1151a3149e85e94133cb95f989fbdb81feb5c4df1cc30e503004704f5f95335d56ae6e9da58addc4721cfce4e063dab94bb8de18a149e327d3b76156902373c2220596e5a2509f22e413d7a7ff005ebac0e02a9c90d9ec7aff008563780bc3da85c99ee2deda48a09000b34a36a9f5c1ea7f0af48b4f0b41110d753b4cddd42803fc693b7513dee7147494bf994436aef29fbc5320b7e22b561f02472da1f3c4b14ec32bc2b05faf1debbc86182d536411246be8a314edc3d6926d3d09949743c4f5df07eb5616fe535bf9d13ca09916418c01c281c629ba3e87aba365a0451d397524feb5ebda969f6ba8c68b71bbe4395da7159aba747a782d6f230fa641fd2ba14e32577b994db6ac61596837ccbb5936e7f8b35d2fd86733433b322cd17f129e5877078e869d0493b6d38942e339670d9fd6a712927ad294db3251b15df4f9249524795432b07002e46474a98c5707adc81f48c50d29cf5a412e475a929dc436d21eb7537e181fd2a3366a7ef4d337d6434f697d2a232c8df776019eacc7fa0aab8acc46d3ad98fccacdf591bfc6912c6d926531c08190e7763915306658b712a49381b4f5a942ed183d7a934ee2b31093519cd4b8a61c55226c44c3dea2201ab0714d2055a62b32b15c531803d7f5ab25698c80f6aa5225c4a8563eea3f0e2a32557eeb11faff003a9ee1e1b788cb3cb1c51f7791828fccd605cf8bb40b6623edbe730ed0c6cffaf4fd6ab9d2dc6a9ce5b2357ce941e1124faae0d3a2ba32e40895581c104722b9b6f1ee9c07eeacaf24fa855feb5427f1b4a275b9834cdaa06d7124dd47e02b29555d0da386a9d51db99cafde7850fb902813312144d1e4f200c66bcfe4d7a69646616512b373feb09fe94f835dbc8240f1416ea40fe2dc7fad66eb3e868b0acf40dd2ffcf43f951997fe7ab7e75c3b78b3572788ed47fdb33fe3519f14eac5c2b340a09e4ac5d3f5a9f6ccafaab3bc3bfbcaff00f7d50377fcf47fcea842b2cb1ab9be970c01e235ff000ac0d57c6fa3e9176f68f77a9cf347f7fc9863da3f12292aad90a8a7b1d808c9fe36ff00bea9c20cff00137fdf55e79ff0b3f495ced4d71b1d7e4847f4a3fe169e9b8e2d35a6fabc23fa51ed995ec0f4516ca7d7f3a1ed82afcbd7eb5e707e2c582f4b0d60e7d6e221ff00b2d28f8ad64dff0030ed57f1ba8fff0089a3db483d89e8f1699700798ecac87b6d208a77d9a31dbf5af356f8a9663a697aa37d6f17fc2987e2a444e06917e47fd7f8ff000a5eda43f627a61b74f4a3ecebd857979f8a25beee8d79f437e7fc2a33f14181e745bbfc2fdbfc297b590fd89ea460039a614c7735e5ff00f0b3037fcc22eff1bf7ae8f46d76d758b5337d9eea1707057ed2edf91cd2f6cfa89d2b1d7046eccc3f1a09917a48e3fe046b81d5f52bcb6be02daf2e6388a6769958e0fe75045abea320e750b9ff00bf868751a355876d5d16e38ca25b98630ab19c908b8c0f6156a07592de6ced7432be32339aa5696f135ba300c411dddb23f5a7416e91dcba664f29e4600798df29c03ebdeb9def62c75b69b1dbb8450f1392594c3295c67d3b1c7a1145caddc32a4e596e6346009c6c73c8e3d0f3f4ab7259c4d112af3ab2f2a44cff0029fcea192257b28e4f36e14965dcbe6b70770cf7fad2b87912b5da5c279124725bbc8005f37055b3e841c1fa54bbc8530bf0e8bf98f5aacb65148f35a4924cd11018297cf07a8fcf9a86ead27b5891e1bb99e28f8f2e520939f46c7e8693b6c0bb99b7cbb2e2776e85d727d38ac9ba0a9305dbbb3f3119e87dab567ccb24e3ed1367e5251d173d3e9fcab22e2393cd0de612390320741d29c41ae84b6f26e8e3818bfcb2b7978e339439ff003ef4ff00276dc3c183e6236ec0eccbc8ebebd3f1aa97692a496d2ac98519dc4803048ebf9569ea913c6f05c79c82495576b05c6d239e79effd2b424b571696d75670de40be534986f323e1813d41f519f5f4ae5de664d4b0bb55d1fe427b0fad6fe9b733c86eb4f1e56d70254f948186eb839e3045625c4135beb6fe6007cb2598f206051af3261d4d0d6ede0d4b457bab7d8d2db387057a800f38f70454b315d434edc30cf8c820e46e1e87eb9a66966439481a347ee58751dc118e6a1b4866b4bfb9b32bf7cf9abb9b181ea3d41fe954c68d3d0e4568e1881c379630e3a83fe7b57416090c8b3593a6d5752c83d08e180fa75fa57116f34ab7eaab9f31ff007a996fbc3bf6e0fb5753e7dc2c51dcac27fd606570e0ed278e9e94a4fa879152f165177a74649cc771b7cc0dc8c7183fa63d456c2266dded986039262600fc920e76fe3d47d7158fac492fdaecc2a3c4e6e43e4ba9e48e31ce718ad8597740e1ada731c84ac832b957ce07f16473fd297411a7a7ca2eec8163b65ee47f0b0ff3fad36d99a6b3b897912095d867f85801fa7f4acad3af24b6b9781e297716dae00070c7a1ebdffad5e82e16192587c8b811c93b003c93c1c038e3d706a65abba1a65c9d94416f32f0a0838cf507a8a66a585d87fbdf29f7e463fcfbd345ca24c13cbb80846e553038c1ee3a74a8ae2ea1fb35cc4c651ca852227040247b7639fd2a0669a102fa741d0e1bfc6a2cff00a05c464636abe01f439c7f9f6a80dfc0f644f9d89549392a46581e7b77feb45e5fda794ae971183b48c138e083d7f43f850c10b19696660b8f37cb84b0cf423767fcfbd5b2dba559d4e55010477c1ebf963f4ac6d2f558a4b9dd752410bbdba8ff0058083b4e393d8f3d2b4e1beb549a51f68830c7728122f3c734d819be258126d351d8928f286c83d0e0ed22b9eb53ba1f2f037a37071c6315bdafcf136882cd2689e60c31b5fa8c1ae7ad3fd4e769edbb3dfd6b35f195f64997972d80371c60f6ff0038abf6240df9392aea0fb8f7fd3f2aa04e0ec000cf23daae696ffe924b60890723f5cd7419a3ab03fe5bed63b1d1bcbddc10719ff1a49956ede758d98295cee5e0eec741515bc8c2d6dc8395572ae473c1f4fd3f2a9a46648f16ea0bac80a0ec57fc07349a0b8cdc24dd06d512c91797b01e370cff00f5ea5cac08449296128003c87baf507fa534bed89e42707cdf3777d3ae3f963dfdea9cfa9259a19ee58620dcfb13b8653d28b581c8d36572e65424ac844de5fb0c7ebd2b3f55bc492ce478265c1fde87420918c7cb8fae2bcdf52d62f35a31473dc388906e58d4e15403d318e7a77a2da768123509c6d2dd7d6ad41c912e44724cb287fbccccd83cf3f2f27f1a8374ad08668f69600e09eacdff00d6a96e77c5f3a6d08cbbc86ecc4e0fe9492f9a4ee5700a12463af0303fc68e571d023a8d57f9a538040e808e4e0038fccd685b31470a31c37a0f4cd67a4370adf3124129c9e036325bfa7e556219648c82d106206482defcfe9cd3451d013fba19eb9f98e31db34fb3f3360f371e611c91f4acbb5bb86e9b68522441bb27918cd5e8aee368848c7602768247539cff004ac64bf785c57ba695869edaaeaf04247eeb01e46f451d7fcfbd2f8bf5413dd2d9c3c220da003c00056c5ab2e8de1c7bc90fefee87c99ecbdbf3ebf9570ca5aeee9a56e598f15db08de5ca73ce5cb13434f8422efc7418157198d355446800e80504d7a8928a3cb9c9ca4318e4fb55595b7be075f4a99dbe535046096793a0419fe82b9e52d6e755386c88cf321f41c52a7cd2161d05314e14b1ef52443083dcd38ad826f56c6ca4d427942a31cf7a9a4e4e31511c726b49232890740682714dce0669a0ee6a8bd8bdcd0857744bea7bd41756c508700fcc79a6bcec9b554f41d314d6ba959705b23e9549a71b19b5253b8c30bf5c7eb4b15a4b336d0a723a120d5864074dfb4f9dfbdf336f97fece3ad47f6e95401b636007195ace366f5359376d07269ae642924b1c5c75278a23d38b0399e1523b6ece7f2a69bc79461a08187bafff005e904cbdecedbaf7047f5ab6a3dccb9a7d8b49a30688b1bb84303c2839fd6ab8b380dfadbf9eaca472e3800fa51f6943d6dedc7fc0dbfc69a6684f58a1fa6f7ff1a9b2ee55e6f746aa68500c333ee5f4df8aa17f6715ace8abc2b2e796cd4297ab09cc5185ff0075dffc6997179f6920bc7c8ee09a4d9294f9937b162d4db2ce8645461bb906b5257d3b1ba4b51ee54631f962b22e6f61b89637db302b1843b9b3c8a85268d5b215867a8cf5a98b2ea41b69a35bcfd21b816aff00f7d1ff001ab0a9a3903202e7b3123fad6325dc2872b0f3ebd29c2ee20c7cd83783d83118a64b8cbbbfbcdd4b0d3e71fb88849ea031ff001a78d1ed88e6de443e81c9ac28ef2146dd1c7229ff00ae8454e75873d439fabe6a92466e357a499a526896fce0ce3e87ff00ad59575650457696e972e59c72cd8214f6143ea6ce369f331ed262a0492dbab5beeff79cd1ca5c1d55f1334ede1d4ad9362c892a0ecc338fd7355a7b1b9b99b75c4dc81d157803f0a8d3513e59186eb8ff0058dd291afdb380d37e329153ece37bd8779976d74bb54399c4d373c01c0fc6adb5bc68330db322ff00d334e4fe3d6b13eda79e1fea656ff1a5fb7ca07038f724ff00334f944d4dead9b91cb72a9b7cb3b4f4f324008fca92eee64b7877b796cdd970467f1ac4fb74fd41c7d05693e931db42973ac5dc91348b95b78b9908f72785a995a281517264abac214512208d871f236e06a27bbb27249982b1ebd49aa8d77a647fea34ec8fef4f3331fc860557935004111da5ac60fa440ff3a9bbe853a1015b4b17777bad64df131cbb152029f4f7adfb2d3e0b04f913e73d5c8e4d72bf69976e164755f453814c691dbef331fa9abbb1f2696b9da497a910e587d335467d4a6c7c85547a935cc024773f9d3b7b7af1487ca68dedecb340e8d26723a006b23cb738208fa66a5f318f7a6f3d7f2a7619194917a107d706937480e306a4e78c519a060aee3b7e752894f4231510cfe34f0077a405f8af19a210ce82783fb8e795ff0074f5151dc4112b036f36f423eeb70cbec6a0cfbf14e079e7bd34219f6590fcca1473eb521b49d8f084e7d2a646156a37f7fc69d9026d1462b4b9676df049caf04af71d3f95496cf95dbce47ad6bc176d19055eadcb6f6daa265424578a3e57c603fb37f8d2690736ba98170006497df07e951cbf2c8afd8d589e270b246ea55d72083d88aacc7ccb6cf71fd2a5169eb713eec9c77e456ac6fbe356ac80728ade9c1cd5c81ced651f8522e7bdfb924a9b18103e53cf1480e181068576910c6413dc6074a8813dfa8f5ada9cafa1cd38d9dcab7b0856dca383f30feb5d8783b544d42c24d1ee5f96198893d18573522f991953f506a8dadcc9a7df4732fcbf375f43596229df546f879d8ed258244251d19581208c7bd569514a329eb9e735af76d0ea56516a7f6886dd08fdfc92b61548e87f1ac3b8f107876c626dda8cd7eea33e5db444293fef35715ae74cd599575286f1b4d786c013348c3381c951c9c570d2970e41ea3ad74f7de30bf9e2962d3ed62d3a0618668fe69587a6f3d3f0c572d9df920ee038cd6f4d72994b5106ece7b54a83e603b5354e005eb52c679f7ad2e4b2540579e6b534d99a3995812083d4567a027dfd73576ce3224181d6a6e16373c69a4ff68e8d0ebb12e678808ee481f787f0b1fa74ae019be56c8dce496ce724f4af55b5bd86eb4bbdd18e0b490649f4391c5794ce5d18a6d63b78ce7a56137756ea8de9bf7752c24cad63346e634553e6a82c72492ab81f87ad753e0a93cbd1a662037fa41e0e7fba2b8eb7b5b9bd2de546e79e490001f5f5fa574d62af63a725bc3212a0ee9894e32c3d7f0e95849d9176b9d68d4acb92a900f52bd7f515a1e1ed3edfc43766792d623690367714077b7a722b86d8fe722a007cc2060773f4aded6fe22da782ed60d0f4fb637374aa1ae5c360231e71f5a4a5296c1ca91e977baa5bd827969b72a301474158edaf3c8c4eeae2ad3c44badd925ec4e4a3e720f553dc1a945c9e2ae36b686724dbd4ec97576db92d4c4d60b7e3cd72bf6c6da467af152a5d600e6a89e53a57d4893d78c565ead753dc40ab04ae8dbbaa360fe791548dd826abb5ce58d34ec2b1b9a45c4d05998a56919c9fbd249bd88fad6a457219b1d2b9b86ef6a0f7152477c549f9a811bf2cf8279a4f3c6dac1fb713c9269eb7fc73cd30b1ad3ca5e275c8048ef585a668861d4c5f98e1765ce19db3b73dc0c75a965becf153c174044003f331c0cfad3e6e82d8deb67f35bcc38d91fcaa3fdaff00eb54c589354a39d04691a11b5476fe75219955793f9509936277f986d0e57dd7ad40536b8db34a79fe26c8a85ee97939ea6ab8bb55724b555c56344b62985c7ad679bf52719a4fb5ab0ceea6a42691a01f26b1bc41af2e936e162daf74ff00754f451ea6ae25d26092df5af3ed56f5afb539a66495816c28084e00e954a5d4d68d25395999d7ef73a8ca66bb9de573dd8e71f4f4aa7e422f6cd5c7f39ba412e3dd0d576498b731381feee2b094a4cf7953a308da23a15556e82ac346b246c87b8e955d5240794352a961dab36d9cee692b0966d9431b7df8ced3ef5738c5679262be561f7655c74ee3ff00ad567ccc526cc6352c4a71dbf1a8dc00bd07e549e667a669acd907e94ae449dce9ecb53616b18dd9f90571935b24fa9de48ea18b499c9ad48252b12e0f4155600a6f2e3771f366aa12b3316b4d0b367a6d98b37792dd18ae79229d358c31db40e2ded119cfcc644e055cb68167b568d2555e7a934f16770235ded14e55f215a451c5397c425b148d82bd88b98adeca30339061ddbbe86afae97088613f62b7dec016c420f3fd2ac4567fba862926b754dfbdc09578f6abd39898288eee05f5fdf015370e6d4c7bed3c5b8f362b5b3489473ba304b1f414c9ad7ca9637fb2daac6c4011f960b1fc6afdf1692e2168a6b29638f92af701727d6a291d8dfacfe758b285c006e47cbeb4c772821537650c16ec32479423e571df345a79734e55e381c63242c4015f6ab6618bce3baf2cfcbdc583093e6e7b5471f9114bb9aeed76a820157e4fd6a58cc2d6ace259e52b1aafdd3c0abfa0e52ddc2e47cddb8aababc91cd3318645718192a7352d8bb456f804839a6f613d5a25d51c4da8679f9571d735129c74e94c725e7663cd2e0f4c54366a99b1016b3b656725a02739c64ae4f7f5157218966695c481b1212aca7ee9c0aceb1d521b8b65864866494ae1a364fcf1eb525848f14724891ccede600c9e5b1dcb8183d383f5a5615b5b1aab29753130025070d8e847afe3505d836f08f2c7eeb72e54744f9873f4f5a89af6233c53c625da015763037ca3df8f5a2f2eade4d3e54dc5b7a8e0a32e791dc8a9622e98cbaf99b82c9d438fe5f4f6a6a3f9b9246d64e197d1bfcff3aaf697b02c0166b81e602739cff3feb4c1796d1cd24a6e62d8f81f7b0463bd0c0cebc8d52ee6da00242946f4620f1f43e9593292cea0821c7df5c6723dab6ae9e1965948b88b69da47ce392335972b46f11955c6e5271823afa51160cab7aa6e440a8db4b48769ff00809ad7dbf6fd0b76009a2dae0673c819ff003f5ac924f9d68bd00933c0edb4e6b5ec95ad2e8c65dd6ddd55f031c03c75c7635a7417431639e4b29e09777eed64dc71dd0f047e19cd5bf14a868a0b94e4c80472301d403907fcfa555d453ecb7ed6bb4841c61bf894f356f4edb7b00d38ccbe6246c84b73b4f057fcfd6a96a89dca76db918bc65b761781d4e704d685ca8b9b28ef627226801008ee87a83f4aaf182b73142e81597ef8ed91c5685af9767a83d9c819a39c19232dc8e982bf4ff1a6063c9e57950dcf21ed86e391d0639cfb739fc2ba2d3a64b8b59ece36dc8c374473d8ff0087158125bb476e96fc2ee5dc84771e9fad4ba2cd259ec1bf22293040e7e5c77fc0fe8285aab14df536751669adecd1d55a582e3cbcb704641c0ad2cf9f6e6688b027e49d0af391df1ebfcc566eb30ffc4db4e910655a75f331df1d0feb5b08acb7c0a1da4aed24fdd3ce403fad25ac45b32aea277c71dec24b3afde29820af5fc7d47d6b46c251a844f346db713170474ce07e9557f769713a38f2a19530c188f91f3c7e079e69ba3dd2c171342eaa8b2b9d8c0f05c75079eb536d077d4d7204c3ed006254242827a10791fcea1bb286c7ed21b6870bb8e7a8247f2a7ae626d87fe5b1254fa1f4fc85457683ec6f68d929f2b64f52370fd726a065e6fdd5c220e11c9c8ed91fe3fd29636fdf491124a00300f4c1ea3fcfad3086999c9204b131507b67ae71ee314cde3c8fb5270fdfdd73823f0fe749ee055b00a25bf8c06c8555de0fdec6ec1faf4fcaaf3932da44caa0c80ab631dc75eb50fdcd51941f95d63047afdf20ff009f5a9c305bdc0e03a7ebff00eafe54c0cbd7e38ded04e8abb1480485e4e6b94b6851af6562a558afdfcf5aeb757609a45c86dab9943a67a104f3fd6b90b6954bac8acdb063381d73c564be3b96b62d8639dd804804639f4ab560479c62c0f994904751555d3e62c4120f1cf3f4a9ad5ca5d263008c64faad74a323acb4b9d905a3328612234671d8fbfb7bfbd3e3db69143390d9562253d783dff9557d3dd0a5c43c29642573fe7e9532c80ba3bfcd1c91151cfdc3d81fd7f953131ae0f971cdc650639e801e067fc7b62b95bd99aee2bbb705b2222368cf2403c7eb5d2dd79acafb71e5ba0470472586738e7ad79e6b93cabaa136f34ea272b18589b6fd48f7ed4d6f61333e34796668a089e59588856351963c7a0ebd2bacb6f0ac96e9bb54b98ec5000027fac971ee0703f1352e8e63d0747fb444a45fdde5e4909e5074dabe9ee6b1ef2fe4998967249aec842cac613a96d11b6ebe19b70cbe55ddc9cf0cf36cfc828accb9fec59176c705c463febb67f9d633ccc4f5a8fcc248e6ab9575239a5dcb820457f966dea3a798390739ebf4a747f26061b972071fdeff00eb553594e718352b35d5ba0b99377d959b68653c67df1594e9add1ac26f666c88b70dd92b9fe1e99e315a3a459c3ab5fc16c02b206cc9e8a17ad61db5d932b44b80464138e38ee2bb0d391342f0fcf77ff002dee0948c9eb8ee7f135cd6bcee74c74894bc5faa0babdfb2c271147f22a8f4fff005566d843b54b9fa0aa20b5cdd3499c92700d6c228440a074af4f0f4ecaecf3b115079e29aea42027a9e6940dec07e745c73201db15b5495b439a9c6eee559490b8a590795a6063d65938fa2fff005cd326ebf4e6a4d433baded9464c6806073927935cef5b23ba3a5df62a1ff578c75a9c703a74148b677524a8160931eeb8fe756ce9b74a4868f691c104e4fe42b68efa9cf25a58cf73c9e6a190e01ce39ada5d126fb33dccac160404be15b7607a0239ac498860446b95cf0646da7f219a9a95a31ea5d3a77443bce38c0fc29bb8e7ad468edc072bbb3820678fd2a6686ea678d6dad10a9382fe6138faf1fcab055a2de868e94ad71858f52690938eb4338b4ba2975134ab9c7ee9b07f91fe55605ce9fb4b49617e17d44bdffef8ab534c9e4655c73d3f1a5c7b55af3ac842667d3f505840c970f903ff0021d539355d248fddadd67fda61ff00c4d273486a0c08f6a02fbf34cb6ba8ef2631c0d1838ddfbd95538fab1157458cedc89ac07d6f63ff00e2a9a9a61cad15707bd2638e455c5d36f2498450fd96790a96c45728d81efcd3db44d61065ac24c77dbf37f2a1481a28ede38a00c52ba4f1b95788ab0e0827069bb9bd07fdf63fc68b8585c51b7d69a642bfc1ff008f0ff1a05cc44fceac3f0a14856255200cf7a6b124f3482e2d98e0393f88ab36d0c7733ac71b2066ff009e92041f99c5174056f7a7a924569cda65b59c5e65dea5a7c4808dc167f31f04e0e00eb4e12784a2fbdacdc4dff5cad987f3a39e29ee1cada32f6e2938ce335a575abf85e080bdaadfcf3ae0a8951555b9e87daa497c691d99516da359c1b86e5dca4923d78c50ebc107b3958cc8609e507cb8647c9ea109ab4ba55fb8245acc00ea586dc7e757f4ff001e41737661d5ee05bdb11f298600406ff6b39e3f0addb2bed3aeee3fd17c496cc8cd9f25444848f42700d2f6ebb03a4d6e72bfd997238610afb34e80ff003a7de69575a7c48f76ab1ac848521b767bf6aedae12167ca6bff00655c72a9771ff5351a4ba42c662bdd5ed2e8a9c879efd7273ec1b152ebab6961aa670b16eb5bb82e4da4b3aa386d870a3f1e6ac6a7772ea97c6e1d9433f2137fe82b66ef4df0ecf3c920f11d8c08c73e5adcc642feb55469be12b7037f89edb8feecaa4fe80d60e4dcafcc6dcb1b6c6079172f3ac49048ccdce510b01c67ad351e15b8315dbbda91dde3279aede3f10f842d2dd224d574f3b171b8c4ccc7dc9d9d6b9fb9d4bc1ab29906ad1b1ce7fd448dfcd6b45557721c13e8ca49169aeacc357846d19c342e09fa71447058ca4edd5ed863fbf1c8bffb2d32eb5ef09c6a3cb56ba607a25b14fd491585aa7892daee116f6ba7456d12904b900b9fc7b0aa75974fc84a9b66fb59c2bd354b16ff0081b0fe6b5526d90b153344fc6728d915ca0b9cb27185cf38eb8fce924ba0243e5e4276c9c9a5ed98fd8df66753e6a7f7973f5a707563f7d79f7ae4cde4a14e09fccd3e0be9a2fe25627fe7a60ff3a3dabec3f627540af5dcbff7d5195eecbf9d6243aedc46c01b2b0957b878f1fc88a9ef752b7bcb946b2d305a21401d7ed0586eee467b53f6c84e8b354320eacbd3d697cd8f1cb8fceb2327bb1fce8dc40fbc7eb57ccccd411ae268f27e75a779d103f7c67eb58f827f89853584b8f91c023fbcb9a3998f90dc5b9847fcb55fce9e2f61031e68fa573924b73147bfcb5931d42939fcaa05d5a26243ab21079cad2737d46a91d6fdbe0c0cc82a48b558a36044a322b968efede4e8cbcf6cff008d4de7273c9fcb34738bd99d5df6af6774b1cc24027c6d9063ef7a1acd8eee152c378da4e47158fbe33d245fc78a7839070c0fe34ae3e53552e60d8ca5c0cf4cd3edeee247197e3e9591938eb4e19cff004a7707b58ea2c352b4b7bc0ef22f96ca55f3e86abcb3405f7248ac33d41ac1539ebd3a54aa4e47ad117caee271e636048bd987e7556e95242403c9ee0f435594d4a323ad68e77d098c3975373c397ab2dbcfa5dcb663906de7f4ae4355d3f574be9b4fb3b0711c676bc81720fe38ad025eda74b88b82a79f715d7c774b3dbc57aac76380b2e3d4743fd3f2ae5a89c6f63ba8daa47959c05bf86f54973e78bb914ff044b8cfe26a1b8d35b4db9184923cfcae921c91c641cd7a43dd44c8c4c871eebb4fe46b2bc47a54d73a49d49622b0c58cc8e42efe78c67a9e7b5614e6dcb5138d91c67df3b71c7d3ad59480b600a2d6d8ca7701c7a9a7dc6a56d623629f324fd2bae4ec73a5a96e2b75893739c0ab31df59db445e46cb0e8a0735cb5ceab24ad8dd807fc6a30d3ce5540dc48c81d6b094cd23037a2d5d96fb744ccad231c95eb8a4b3b4ddbe5b88a2624e70e78fc699a5597d9a447950cb2b0cec193b79ee2b7a1447b79e4458d1fa65871faf735cf39eba1aa8f729476ecaa238a2e33fc0b9ebe94ddb9625fcc7e48e4e013ef914e4b99ade4568a4dace395073cfe58a706865666b99d9492400101f9ab32f62fe946da279ae632a52dd1a590e0fde1e8481c706bc8350b992f7509ee643b9e690b67d735ea5a85e2db7842f9b32f9ee4c64e7008c7a1cfe95c4787ed2242fa95caee0adb6153c027bb56f4f4810dea6bf82bed76667b6b989e38a50248f77a8ebfa575a9348f336e8c222e029cf5f5ae76cef499d1c942777040f5e2ba2d8c3246319f5a2c9326f7dc97ccf7a7ac9cd43b24041d8dcfb50339e86989967cc3d8d465f9a66ea66ea622e89301476c52f9b8ee6aa863d7da9777bd3b8accb465a512fbd54df8ef46ff9a8b88b2d2e5bad345e80e1cbe1470b8fd6a8cd36d5273c9e326b80f12f89ae249dad6d2431c2bc6e53cb7e340d46e7ad41aaa8c65f83ea6b452f3cc5c86e0f439af9be1d42f20984915d4eae0e721cd7a3f837c58d7e0d9ddb0172a3ef740e3d7eb53ccd3d41c2db1e82fa9c71fcaf0dc1c7740ad9fd7355bedc276665478d3a287ea7deaaccf93c532261b4fd6ac9d1a2e79a413cd3d26ed9aab9249f4a78c8aa24d04932307a56458decba479c9716576cacdf7d222c0fe22b4a0900eb5d0d9902d570719e783569f464b76386bbf1158b13b9665f67888c565cdabd8c8a7122f3ea2bd22e537f5c9ace78d7272944a17ea5c6aa5d0f3e37503f21d7a76a3ce88f21bf435dd342a5795ef4d3044171e58ac1d335f688e02ed94c3bd4e590ef5e29fe7c4ea1c370467806bb436d183c20fc6b2ae7437decf633ac5939314aa4a67d88e454b815cc9981e7460f2483fee9a7e438215598fb29abe74ed615bfe3dad5c7a8b923ff0065a79b7d5ba1d3223c7fcfd7ff006353c921dca2a85540a55b40d3b4be6c6370c6d7427f51560daeadff0040b8ff00f027ff00b1a72db6ac3fe6151e7febebff00b0a7c92e88399771ab6ec38dd627dcc2f435a3c854b3d880a73810b8cfd79a985b6ae073a5c19f7b93ff00c454c91eae073a4db1fadd37ff00115a2752d6327183772b8b1048c8d3ff00f01a43ff00b3d38d86e04092c5723b59b7f56ab78d5c8c0d22c47bfda1ff00f89a6ac1ae63fe41f620fa199cff004a39663f7460d3a50ab189ac8edee2c7afd7e6a0da4911ff005d67cfa588ff00e2aa55875fcf16960bff000373482d35fce7c9b0ebfed9feb472cc2e8a86cfe6ddf6840c0e72b6807fecd4a61247373dbb5aa7f8d5a6d3f5e6ea2c17e88e7ff66a4feccd6cf592c47fdb163ffb3527198ef13325b48d98179256c74011547e94e2a070abb47a55f6d27599171e7d88c7716ed9ff00d0a9a741d57a9bdb71f4b73ffc554384d8d4a265b452a3b111ee07b8205213363fd4e3fe062b54e81a9b72da9478f55b71fe3483c3d331c4da94cc3b85455fe42a7d948ae74448ca1025c28c100b13c2b8ecc3d0d5958eeeda49e5b7c5c04719490e1caed1c06e87d81fce9a91f99044e5328aa438ee41ed8fd7f0a668ba9452f9b6ecc44e186d56fe30001d7f0a87768aeacd2491762ddc4c4c52fdfc7e84fb8e86a2998221873942a248ff00efa191fae7ff00d548b6ef68730b0df23e5837dc94f704763e847e39a89889b4f77cb2c96e76ec63caf39c37e071485d0bb2b3ac3e7a9236f40075527041fe63e95689dc980495238f7155e32b71088d874243a9e7f0a56636e4264947e133fc27d293ec3ea66c487ceba42bb821555279e307ff00d55973c4a256185c37504771d3f99ad79d4a5c4ce9f79514fd47cd9159d36d90e472ac32292dee0cca78ca487622f5c03c75208ff1ad69a0b6486dae16188ec501b0bc15239cfe35937c01481187fcb71bbdf838ad654c22c32b131ca83693c73c64568f605b19fabd94324704a8a04a576b63bfa1fe7f955281e01aa432b8c898796c72463fba47a73fceb5883268f240e7f7d03328f7ec47e22b09a3097402160a137a30fe1fff0051aa8b27666d5dc11adfc72fcdb5c0e779c823d79e6afea960834837892b473db9de19a43cf4e327a66a84121bed351dd7e61f781fef0e0fe7d6aeccc6e3c352a6e5c9dabf3e700ee5a72d84995ae2dfcdd3619a1673244155b121395ee3afaf359ccafe7c26291823611d4b7af43ff7d71f8d5ad2ee1e32d04c844732b3267be09047e1514b6fb6691246ca3865727f3fe441a3adcabeba972fa46b8d3ec9d6e27f356e5119588f95b9f6eb5d15b892e6dd09ba9417043fca84023ae38f5ae2ad6669664495f1e5dc866c9e723207e75d540668ae9e0c30590ef453818e72475f4cfe54edf888d2fb3b5dd88696e0b0653b94c4a7d73838ac141736f1cb04920542fba3764e4302393cfcb838ae903aa5c2a8236499247fb43a7f9f6acab9da6ea465c95f3983afa8c2f23e9fe1509ea26699fb55d5b433477313e31263c8208c751f7b93d462997bf6936ff69fb45b945dbf37944705864fdefa547a65e791752db4e40329df1b85da1c81f37e3d0fe26ac33634c96192325b71050fa16e09f6a96accab96317b0ccc4b40de71c7dd61b4e3ebf5a688ee80368cb6eca57703bd8646791d3d4d3e4991923532c6af19048761d57b7e3eb4d7bb8b72dd2b332aa9180a4fcbdfa0ebc7e9475191c4d752dedcc6d6f01923445dfe730ebb8823e5ea29cf35dbd933f911ee3ce56639dc3db6d450dc32dfc9f2c8c650aadc1041f9b079f615655e45b92890ed50bbc0660307a76cd20296bad34da616302aa2618b0943601fc2b8f49021758d97059549cf0a33cff3aecaf4b49a26a28c630bd9482720e3bf1df35c13c6628846a4e48dd81d01ddce73f8d459735ca8be86ab5cc4623b5b730ec39e453adaf603710e1490f8c86e31938a44405598000924e076f4fd298a81140c6181caf19ae9ba4ccac75168d33c570b2470b4719ddfeb0eecf1edcf14f9ee656964b5689640c132e0fde23ae0fae304fd2aa47348be5857f2d9d806618e0f3cd35dd5ed5ace37026336720ff0f76e7f1a571d892f2eda0b70f143e64024f306d6c955e067e83f3ae5b5257835340b2b9401a62e18fcdc71fceb71bccb0964485801248099194101481d7a75c1ac3d4e336eb37185c1e0f6ef8ffeb52bea2b227bdba335adaed20e2251d7d2b21dbae6a8a6a8614092aee4ec73c815683a4a331b0619aef8c93472ca3adc638fad33a1a95971c8a898f3c7a550b41cd2041b98e055ed335abbd2a6792c6e231bd70cb90c1875c15359e2d1aed1b04158fb138e4f7fc306aaa68f04c8c6495a225be52b2718ef9ac653699aa8e8775a66b56bae5fa5a4fa05a19dcecf3eddcc58f721783f954be26bf12cc969031f26151147f41deb3fc27a647a369f75a879acef28f2e366eaa31cfe9fceaa97fb45c3ca79c92055249b56349fbb02ed84407cdfdde0568aab336d50598f602b9d9b52b9b220416e660dd7047159da978b75296775b60f6301e3cb865fe64727f3ae878850d2da9c2e8ca6ee775e4fd936497ae96b1b1c6f9db68f5fe9505deabe1ff30197588f20636c10337f4af306bab895b739c927ab9c9fd699fbe27fd6907d45612ab393b9bc28a4ad73bf9bc47a55adc83656cd7a19719ba1b406cf603ad41378fb5056611adb5bf38fddc201fccd70ff0067676e7cc6e3df14a6d3d412d59be77bb345089e93078af43bd8636b8d72f6d6e0e3ccdc3bfd55718abcdad785d6dc24be22473ff3d0cce5cfe42bca45913d571eb95e94bf6242d80c31ebb69de5d05c88f4c8fc4be0db56661a934c4f077c3249fcd6a9de78abc177120676ba63ff004cadca03fa8ae0bec1181c3649c76a74567001fbc2e5b8c628f798d451d7b78a7c1d1e7669fa8c9ff00033ff008fd48bf11346b688456ba45f08c7406455ff001ae3dada32df283f4a67909b77718e9d3ad1ef7706a36d4e8e7f1dd848fbd74090b1e7735de3f925569fc7b78cbb6d34e82dcff799cc9fe158ff00678b23839f7a6ac110dc707205167dc2d1ec4f79e25d6750468e7b86319eb1a0dabf881d7f1aa66eee1c60838fa9a9c47b7a1383df34a6272e54b1e07cdfce8512b445792e65936fcaaa5405f94633ee690cf3f2b8a996dc6dde4fca4802a516a0c889b7e6241c93eb4280b98a61e5dc0e067fcfbd4c2e6e637c24aca7d558f1fad5a58e2324b32c79451c64f73c0a0c6ab1a36c5cbe4818ea07f934f9077b134baeea77b6b0c171a83bc70f09ba304807dea543f2f52f81f788c669220a978b114caaf2fc7a0c9fe54e494fd9dd842371231c9e79e6aa29448934c5c9c0e38f5a5f9b76d039ec2896e182dba2c680b02d820f76c0fe54bf68905cdcec0008c48410bc8c71fd6aae4d8ab731128b2ac81483820c6181fc7ad5273716e018e666079019703f0ad4851e7b5c1191bf0303d07ff5ea692dc178a368b240001cfe3fd6a1c6eee55fa18a3559e172b34608a99752b59401244067b95c7f2ab7e4c7b5bf7232a33c8ebf4aa7369d03c62458da3dc480179e98ea29dbcc764cb2874f947cb1c79f50c49fe750dd5b40aa192403276aa08fff00af54db497fb6c51ac9fbb6db97c7ddc819a5b6b4bd4f31b07744328879dfce0fe9cd2b37b95cad6cc95ecb08b9ea4f50bda9a74d0d314cb118255b02b7b4f8bedd046b708d0ced2619c8c85518fd314fb8d3a34313c1334b1b921f2982b8f6f7a14505e4ba1cd0d373096c1dc0f4c76a9869d1068ced6c100b64f7ef5b89632104329dc7ee900f1f5a93fb36592250237ca67391d69f2a40b9fb188ba742af2a146dc8091cfa7f93518b78fcadc50e3763af7eb5d27f65ca66f3bc890eff00bc31ebc1a45d1e501d040fb4f4e3d3ff00d7fa52d0396a3e8cc092d22deb95daa71faf5a80d8c7fbe43c3479db9f5079fd335d1cba25d3b022ddc6176f4ebfe734f6d2262e6436ec1987cc3ea3068b21fb3a8fa1cb1b6896ce3915416dc55bf9ff005fd2a4f262172a8106d7036e47a8ada8f42bd16f2c4d12fcccaca73d30083fce89342bd68e03b115e350092dd704914685fb0a9d8c310ab24985c3a60f1e9fe714df2d5162988cae791f4ebfd2ba01a2ce2ea4902c7e5c8186dcf4cff81a1340b8303444a1f9f7023271c73fd3f2a3dd0542af630fecd99da0ef8254e3af714cfb3abda6f0089236c30c7507907f9fe95d19d02e83c1202bbe30a3a139c7ff005a95341b8592521942c830548c639c8a3dd1fd5eaf639d3120921661fbb940c9f4cf1fcea48a25532a95c3261867bf622b74f87666b71099630158953ec71c7e95336872f9c24f3e3ce006217ae3ff00d54d342786abd8c413edb68e5f2c9656c373e9edee2a612462e44622fddc8bf2e5ba9ed5ac341ff5a0dc0db2637009dfda91bc3c1a18e33727e4e842e0fad3e642faa54ec63fda336d2158ff007b19f5eddbf234ad708b24527943c9978273d0ff00f58d6d9d014dc3cc6e0e5c10c02707351ffc2391081a237121466ddf77a1a5cc87f54a9d8c98e542d2c13c7b0a82508cfe38fe755e436d2c4247547d8d825c72c6b7db4042f1c9e74a5e3c00428e71eb4d4f0e0fde05333093aae051cc53c2543959f4d8582347ba2593a00775536b2b8898f9522be064ed6c715dcaf862411aa793336cfba4af2294f86642e5bc8972c30df2f5a1b4c1616a2ea701f69bb806d666ff0081722a48f53983e1d11bd46315dbff00c2284c7b1ade62b9ce0ad22f8494caae6d642fd3ee75faf150d22d61a7e465daeab6f756f1c6aaa658c6d62792475fc6a46052dd4a6c65439dc33915bf69e00511ee11b4618e705f041ab4fe1686152ad264f4e1c13549dba993c2cafa1cec6ca505ced053ee4e83b7a1fd69e2d883f650df37facb794771d76e6ba11a34625320182c30c01c023dc5386891793e57cdb01caf3f77e957cc913f55a873a08ff8f91190a3e4b98b1f70fa8a9059dc6e4b51201301e65b484fcb32e3a66ba45d2e349fcdc10db769f461ef48ba4c0d125b80e555f7a2af5539cf145d07d5a673caa5a369d9d96da43b26c0cbdabf4048feed74da23c4229ac678c457c0166543fbbb843fc69fe02b56c7c1b2dccd24d3992059576b9206587d2b45bc1b1da9825b0bc632db8fddc770a1a361dd4f700fa8e95129476054e517b9cbeb1af5c787ededa5b6d2ace52c876debc8643bba7ddc7047a1ae4a6babff00105cf9f7d7924e47ccd24adf2a2fb0e807d2bb4d46dc5cc7711f93f229265b663cc44f7f753fde1f8d7303478c7ee256616d9c88d4633f53dea15a2af635a949cbde4645edd9b855b4d21269157efcb8e1be9ed59f0e85a84b330daa1c1f9c96076fd7d2bae610c044512ac7112771519c0f4c7f5a8e6ba56668e185625276958bf8bdf07a573caab64a8248c987c396f6e37dd5c3bbe3380a40ff00135b0b125b44b0450c7b73e60f970fb7dfbf38ef558951bd25804fc0da6427e4f71cf3d6acf9f301b6358c201c96eb8c76ac9c9bdcab6a44be73c0cf02e239180328930147f5fc2a64887d9b7c926f55c88e30df9e7ffafeb512dd4890cc1570edf20dd1e001fef77cfb534472a8deebe5c4f9c3f453dbebf9d4bd4a268e61140e1a00eac773e719da3fa0fd6abacf19713cd1795130fddb22e49f6ffebd34346ccd15c2b2a29e5c8c83d68329678c896416e00f99803d3b74e3d6848443a9c8d2784ef59e278cee180e41273f4aa16b6a238e08366e8e15556e382c7ae7f1cd6a6a88f268641ff5734e9b4e3008cf3fd69d604358dc2872a5a60cdee056f0f84ca4f521d4aeed175286ca250b3f97bb20600c73fa815aacae0807729c86c1ec6b12e5a3b233de4eea6473b63fa57517986b80fd99108fc855ee4ec55f3250786a72dc4ea386e3eb4bb45181487717ed537719a4fb51dc3318ff00be69368228dbeb42421c2f0094e625da17d0d29bb8bba7e19a8b6fcd485680d0b1f68808e841fad2892027ef3553294d31d1a858a9ae5ec705a4aa8cc5cae071dcd796cedba7639e33d6bbbf138d902e0e382c7df02b8ed26cc5eea51c6fca03bdfe82a9bd0ad2c6ce87e1b59edd6eaf1490dca464e063d4d6849a68d3de3b9b55092467385e01ab5e6492bfeed5be53d17a0ab1b8b21491486c742284fa11aeece8ed6e67b9b78e4f2e23bd430c4ebdfeb56879ea31f67279fe1950ff005ae574ab864df6cc31b0e57fdd35a5bdbae48a9db4158db06e7fe7ce73f4287ff66a78fb5631fd9f79f8479fe46b084ce3a1a905d4aa38761f8d5730b94da2f74a87163783fed8356b5a5fdcc4143c13631de36ff0ae4d751b81c89a4ffbe8d39754ba5e93be7fde34732138dcee0ea51b2e1a2981f789bfc2a096f6df1f76404fac6dfe15ca0d6aed71fe9129f62d4f3ae5d91c4eff009d69ed110a9bb9d035d4440c063ff013fe1513de440746fc54ff00856036af745799dcfb13559b54b8c713c9cffb5593a86aa07462ea3663bb3f91ff000a88de471f3876fa46dfe15829acdec7ca5d4c3fe066a693c47a9ca9b4de483e87151cddcbe56693ea2392209bfef83cfe940d4b0a7fd1e527d761ff000ac13a9dd93cdd4c7dcc8690ea5747fe5e653f5734730f94e922d570407b693ebb1bfc2ac8d5e02a316d303dfe43fe15c88d42e33febe4cfaee352aea77487fe3e24e7de929b42704ceb64d42df6e563909ffae6dfe151a6a687fe5de6fc233fe15ce0d6ee871e7c8463bb5427519d9b7199f3fef53f68c3d9a3b01a94471fe8f3ff00dfb3fe14f1a8a13c5ace7dfcb3fe15c6fdbe7ff9ef27fdf46817f30ff96cff00f7d1a5ed187b3476bf6f5238b3b83ff6ccff00850da8003fe3c6e33fee115c57f684f8e6693fefa3486fa53ff2d5b1fef53f68c5ecd1d9ff006839e9a7cfff007cd46fa84b8c8b097f315c87dba41d256fc4d44d76ee72cedf9d1ed01533ab3a85c6fc8b4207bba8feb51cba9dc67e5b78c0f7957fc6b9433e7a9a89e6e87353cecae44750daacfb794840ff00ae82aabdfcccdfeb61193fdfff00eb573e26cd2f9c7d697331f2a46cda8b86b752b75fbb6195fddad7397f0c9a64d70b3cc191e55d970ab8db9e70c3b76e6b76d196d02032fc92fdd04e70df4ed9a9a365b8bcb90616236aa9e87208ee0f51ed4bcd0dee6658ebd75222db6a0e3ca61813793b89f427079fa8abf3fda1ec1af2295246d9b64554237a83d7af5ee3a564b68ff669269f4d4925c658d991fc59ea84f4fa1aad05cc86da492d9a4543949637182a7b823a8343b3417773acb69ae1a413ac90321043b94231cf1919e08e6ac5d2dd4b118c8b7249e082dc7bf4aa7a56a30c974d6e092ce371561ce40e735a11e639de139db8cc64fa771f87f5a99203344b7325cdc7eee20db5558798720f3ed5424f3e37588c2a4819c893a8fcab4e562baabe3a322823df2706aa6a255487c80c9c80697543317502ca237689b894618303ebdab6b733dac64dbbe44636b065e0e3eb5917e5244401d47ef948ebfd055f8a731db2c2118e0700b0e9f5abb682ba1d0de187548e536f20698ed954edfbca3ebdc564eb31bc0f242b0483749b949033e5f5c75f522af6a8581170157782aca03775e79e3f0fc69754632dbdadd3e1f72942bb71818ce7ad3e82666e8f746337101dcc848da00c90dce463df15ab3156b1da1270242064447a821876ed83f9d733fda3f62d5a14f9225700bb6c03af4c9f6feb5d1fda90449221675624152f9519e0f3ed8aa7b5c4527f365b689a112065de53729ebbf90491dc7e556ee0adfd8328211d802771e411cff522b2ae6e1d6385bca4df01e09ef9cf3efc62ad0be314459d1538debf3e3273d31da95f41b28308a360ed7118f34852324e48e49ce3d315d347a9a186de612a334386566230c3a60e4e6b9ad464595e155c052e0e01e84e722b66cae0244d11910143b829e84e30c3f1155d01b37d35013a894b5bc4cdca6670db0fd3f0aae93fda85c324d044db8e501e4b0006319ef9f4a8b4ebd4680c21941de705b9f7c1aa33b2acf3a2818329c719c36067a8a893ea3b179ef2331472bc8d249190ca8081c1ebc8f6c569868e6899d903b20dbbd8eeddc820e7d71cfe26b9c0b1c5721278149072c768e40e9f5e2b46d9ac16c6e91e285a48640d13320f99011c03f43cd2bdc76d0eae20b0dc4cc230a9210c9b46376060d35237c3db39c33e4fd01393fceab4d6f64db1e3b58410e090100c01d7f0a478ac96f946c8c2842085272738e7e9d3f3a9ea03a35df7d727e6f32144c0fe1dc3773f963f3a7dd5c08e18a718064c06f5c37f9159ef6f6d06b1207f3019620c76c8c36e09c8e0d55b88eda78650b3cbb2238c095f38ea0f5ff38a4f606cb93cef359ddec5ca25bbef38e991ff00d6ae2657d9f6c772df2a1c107b63a0ad78ae14dace125903b2142a657c37af7fe7589704c96f3275565624773c714b77741166cc4e1ada199724320c9f5a562ab86ea0771e950e9ff2585bc44f3b396e99c718a9001b193bfb9cd6cc965e9a62963bc718084738ef83fce98b3461637ce5c0cb301d7b668701f4576da0b20cff00df3cff002ac45951977b004b027d48c0ebfad43dca46b1befbc67dbc284550d9000f5f7c1ac4d4a692f6ee731b328dadc31cf6c548ec26015c3104a9c838ce0738f5eb8a85c471b4841c96c6473d09fe74ee49cddc33468f1c8195ff008463f4a5b6bc788a7383d0e3a1ae8dace1b90c268d981663d3938e95953787d9630d15c00d8e51c1faf5ad233b104b0ea2927cb270ddcf6a9dc020303907b8358d26997f02f30861d328e1b39e952c12dd5a82258dd173ce578fc6ba61513dc874f5d0e86ded527b48eda00f73733b12218fef03d071dff0a96cb4ad49af0e9cb63399d46d70ca4119e7273d2a9da4d1c8aaea72bd4329f994fb7a57647c7972ba62471c1e5dca6156e1e52fc0ebc1cf34e518efb8733dac437e8f0d9fd91731c502ed92470408ff00bc4fbd63c738f2ededd510ef05ce50028b8fbcc7a8a7c7a93ea8f209a1bbbcf289936c711712487382e7d05491dab32c71b59deb24877ddb79615a43d9464f02ae3b5c734e6f6326e2517164fb50932b6c80742f8fe2fa55336d1ac8dfb94d910c3b364e5bd066ba46b2bc77925fb0ca931c2c64b281120ec3dfde93fb3ee329b2cd5618c708d37f17f78f1cd3d1b12a53e88e7059c8408fca8d6493e6185e5451e54a7f7c3eeaf01828f989ae8c69b7a55f77d9c4927de7dcc491e9f9714bfd99704e4bc031c0010e07e668ba2951a8fa1ce1b39cb79596cb8dcfce00147d8e56018ee28a708b9e4e7bff009ed5d19d26520ab5c70c727118e7f5a72e945893f689377afcabfd295d16b0d50e565b5659522cee965fbc49e83b502305e460df24638c7f176aeb3fb06393e6666727a92e29e34188754e9eb21a5cc8a5859f56720626112b672cec7207f08a95add0dc04f9bcb8c72c01f9cff9c0aec17448d39c46091fde2734f3a4dba37223ebd766697316b0afb9c4790c23766dde6938c11dbfce29e60c98d08f940cb1ee0f7fd2bb336502647a9eca05396da2feeb1c52e62fea9e6718b68e5e5728d9c7c8076ec3f4a5fece98c0aab0b677649238f6aed05b467958c927d49a516c31fea87e34733296123d59c88d367fb423080ec5030a4ff9ef447a45c795202aa59b8ce7b679aec05bff00b2a3e8297ecd9ce49fa0345d8d6169f567227449da28d48550b9fc49ab23469dee1a532c6a581fc38c715d30b55c7ddc9f539a9047ef8fc053e6657d5a99ca2682de5188cbc16072075c7ffacd4fff0008e9609995be4181c01df35d2f97c7de34795f5fce95d8fd853ec602f87937bc8d3bee6ceec77cf5a54f0edb04dacf275cf06b7bca5c74a51181da8bb1fb1a7d8c45d0acb2a4f98768007cde9d2a45d0ec4331f2d896eb963cd6cec1d69020eb4393295282e865c5a5dac3911db919ebcd3dac2363f2c2abf8d69ed149b690d538f63306971f076a8fc29eba743fdc5fc16b436f1405c9a4559744525b08173f20cfd2a45b48578db83eb9ab3b71d6976d03b1124118e7193e869762a9c803f002a40b4b8c9a4162324f62451b980f949cfa939a795a36ff00f5e8b21d88195df39734d111fef135676d215a2c864215f8f9f8f4a618371c9356714607534580ade42fa1cd1e42b763f9d58c66851f35302b790a0f03eb4be5f5c0ab2579c629bb483d2815d90f943d293ca50785153e3af14628190f963d28118a980a3140ae442319a0262a50282b40116cf6a5d86a40b834ec734c43aded0cc376405cf535ab1c6910c2285cf5c566c32344dc74f4ab9f684c753f95266734d96837bd3d549ea703eb545ae081f28fcea169656e0b1fa5162142e6a34d0c5cb3f3f5aad2ea2a33e5213eec7154425285c52e529410b2cd2cc7e663f4e82a3db9a9154b36d4058fa0156a1d32e26e5b6c4bee727f2abd10dd914b681d6a486196e0ed822673ea071f9d6e5b6956d0e19f32bfabf4fcab4570ab85c01e83a52e6339545d0c7b4f0fb361eee5da3fb88727f3addb6b6b7b45c4112a7b81cfe751ef23de9c253e950db665294a45bdf4d621bef006ab8978a5f32a6c676295fe8d05eb0951de1b94fb932f247d7d47a835ca5f696f24af1342b1dda02cd12fdd75fefc7ea3d47515dc6f06aadf59457f0847664910ee8a54e1a36f506ae326b72e3268f329a275276aa9e3aede6ab1725b04865edb862bb86d34df5d35acbe5dbea8bf30c7cb1dc0fefa7a1f51593aaf872e577ca2068ae1412f17671fde4ec7dc54ce2af729c14be1dce706e00ed255f18dca0014ddacc5fe7ebc8cf2453583c7c6327d314c2e549cf5f4cd47b34cc2eef62c88cc5119c4d33dc2b652361b93f1f4aaf9ba9a6517042a31264655e07d00ef4cf35907423dc51f6890000331fc7353ec439d84b04702bac7fbc690fdf61b58fbe6a185a499c27efe38d48e5d7e5fd3afd4d4ef7473f7509ec4af4a48dc6e0c4ed6ee3a8fc3d2a5d21f31037d9a21e4fefcb31215980dbc1f63c52d9a31538fb8dd47d0d5991f8e25603d31c7f2aab6f2c91155caf92a18b63a839ff0aa8c6c8993ea457da40d4ee2de4fb6a43e4b7faa954ed71ec7b1ad67bddd6d6d9eab185273d71591aadf5ee9b716fb7c892ca752312afdd71d403db822a11723c82a71f29238f4ad093705d671cd3c5c83deb91b8d41a20c639381c853d6963d618a86c6ec8ed59dc763b0f3fbe6944c2b944d7a1e033107ebfe35693558cf224a2e2b1d089416f6c52f98b9ac31a8ab6d7575651dc1cf153ade027af5a77035778ed4641359cb740f7a78b91eb4ee239ff16dc62410638284e6b2bc350edb7b99f1cb11183fcead78a983dc2b67f86a4d02165d2e040a4b3b33607d7ffad4e5d0a7b1d0dcc11dbe936ca13e791f6a9070771e49a8aeb6c6f1a8fbe07cc49ea2af3a0921b6de4e63f9b07e98ae5d669752d6e5923ddb22250019e7de9f4216a5bf3041abdb4831873e5b7d0d741b735ccea8cc9006070c8c180c67915d04172b342b203c3286fce94bb812629d8cad30c9d6944831d690c4238eb5116c0a90c8b81cd5776a4d8d21cd271cd3d5b804f4aa65b763dea72ac178cd2bea0d133ca98c1aab24814f5e0d232b8eb513a6474e6931a1c6e4502704541e5f1486338a929589fcf1f8d279f9a83cb23b1f5a361f438a4327138c7eb41b9c7f5a8446c7b7e141818e7838fa500c9bed3ef49f6af7a8becefc7ca6816d21fe16a2c04a6ef149f6bf43517d9643fc268fb2c87f84e68b0ae3cde1c75c537edadeff009d37ec72f3f29a4fb14a4e36d2b0c7b5e1349f6b6c1a69b397aeda4fb1ca07dc3ef4ec21ff006bc034c376c79e68fb24bdd7f0a4fb2c839dbfad0028b93e9d69df6823d6982d9fd3f5a7ada485ba6290ee6fc33db8b4f2ccd1c9138daca9202c0f62075cfd2a4d3aed76cf3c8e8b9da0bee1838079a6d9c0254e4e081caa80063d7d7f5a8cdb8b6b992748d58c654ba11d411ce29aec17bb2f437f6e66f3e23be3d9866519fa7f9f7a8b56b08f5089ee562f2270bccc2550cebe840c86fc6acc56f6cc526548ce4750a0ee06a3b88e28d2584c106dd85d098c71cf23f3a1d85a98770f35a6a443426197ef4339c85930307041c647a56bdaea5e7edfb4cce970c3e53c2a30cfdd38e84e3ad5896d2c9a2b8b596de37eb83b3904f71581a96953da18ee12192f20954e5500df17b103ef01cf4e714f9ae163a136f0dc4f21cb9528a7e662c54f3ebdeab4c14023cb4475fbc14633ef58f6179042efb4196138c85958152383ce79e73c568dcc713a99e39652bb70712b647d79a528b40675f3f9716f1c8dc31ecdd33fa9a7f99f246c3aa8079ef81d2a9ea84456dbc3312ecb90cd9047d285f96db7f9af938503703818cd3427a17e6984a141ce0d4564df68cdac8e7203b2313ea3ad523298d1f3239240009c1faf6f4a2c58c730944a412c23ce0719efd3da9a41731b5db532bc2d6e0ee918c657d0e78fe75d0d95c47776e429dea4f96c40c0dc383c7eb546f62904d2943b9c2f9b18283ef7e1df39acef0e5cca6496d95710edcee23a376ff3ed4e3aab01aad00940dca17122aae4f45edcd6adee9eb3d8f9c598794092a0f2ca3ebdfad67f96eb00915f21d70142f27af7cd4b7779711e9cc81c16fbbc8208cf73cd26f4039fb4964b8d40dcbe0bef67f9bbf702ada4f198e568db320071213c026a9090423726d124ce1703f840ce71fa7e74db994a5aa2301ba4669090df7b1c7f8d3e82b1b9a5decb25c2b48c163042671c9c75e9f956d3c65e59a769031570e00ea41007e78ae384f25bb41b4330d8b8ed9279ebebcd6a2ea737f6879a9222dbe433862396c018fc4fa7ad36ba0cd78d952f01cb6d5392739ce7ff00d75a91186e2c6e7615c2c4ae143609619071f518fceb9f794c1684f94d9036e01e4e7d69d6f74d968cc2e13011f91c0efdff00ce2b3db40bea779612c5ba608c5923c28670320601c1ef91d0fd2a1b7bb866d39e38244323165da4ed239ee3e95caaea53c5be58d0af3fde19209e4673f8fe14c1a818eefcc8e396379492431049f5efdf9a4f5d46cd1bcd74ff0068aaf258aed3919c13907f9d61bea4ef70ee704019f723a0cf35048cd25c49394908ec178ce4ff00faeab4f3476e177b6c3ce772f38ec33fad4dafb92d366844f846dadc161d4fad3a5512ced02019f2db20d528e54302aefd81487195273e83f5fd6b49c0f3bcece091820d44da5636a71d07e9f2f9962815b251ce47a73d2ad4876e1d4f5ea7dbbd67690f8b7443b7238f94e73d4d5ddf80c093cfa7bd749948beaffe82e83a3a39ebe8335ceee6700a9f942001b91c9ed9adfd3d43a390c55d4ed07d33fe35862672cb22a2c80b60a9e800cfb544b70412019c024bab3305db9c7007e59a8d1d63dc0fca402307af033c52c8ca5418d98b14c020752493d6aa08e420b02fe615ecb9fe2c7d7a5351b81695a440199bef2aa824f424f3c7f5a735cabb6ddd952339271f7b8fc4557740cfbc36143b3000f5e318e338a7f97890ed03728c12ddf68e38fa9a7ca2d81897c796494da4838c0cf40339f6fd6ac088094f38dc3f817a83c8e7e8290215930b8237639cf2077ad7d3f4a6bb9925f2cb315520727b601fcbb56908b7a21a5d8ccb3f0f8bb62eccd0ef193e51c77f4fa5751a7f828f9c96b126e94a876329cf96a7bb7a13d856eda69bfd9ad046225935098661858711af791fd8761dcd75d61689656fb14b3bb1dd248df7a463d49ad9b515646a9a8ec57d07458f45819171b8ff00103c91ef5a335bdbdc0c4d0a38f71fd69739ef485ab26db77666db6eecc9b9f0e5abe4c123c44f63f32d65cfa35e419fdd8913d539fd2ba9de2985f354a72452934714ca11b6ba6d6f423149e5a9e768fcabaf9963946244571e8c335425d2ad1c6550c67fd8357ce68a673c6318e00fca9a21407ee2fe2b5b12692cbcc7303ece2a94b6d3c5feb2138fef2f22ab9ae68a4468f0afdeb58587a85c54e92d9f7b755ff808355fe53c6690a516b8da2f2b5aff00088c7fc0453f2a7b0fcab3769a70674180c452b317297b647ff3cd3fef91552f120f2cfc8a1cf4c0c530cb21fe2350952c727934acc6a240528db5295a423daa8d5116da02d4bb68db48647b68c715262936d00336d18cd49b6936d0323c734b8a7eded415a0646071d29714fc734bb33da9011e38a08a93cb63d01fca94c4fd94d2b8c848a5c54be4bff74d2889cff0d17021228c1fa54e207f41f89a5fb33fb0fc680ba2b1a5fc2ac8b473fc4b4bf6361fc63f2a2e17455a3156c599fef8fca97ec5e920fca8d04e48a46971570d88c7327e94a2c948cf987fef9a340e6451c526dabff61527fd61fca8fb0a8e8edf953d03991436d016b43ec4bfdf3f951f625fef9fca9073233f1463deb40588e7e73f9520b103f8ff004a770e6450c51b4d5efb163f8f3f8502cb23effe945c3991476fad294aba2cbfdbfd28167eae3f2a2e1cc8a216976fb55e1663fe7a7e94bf6351d5cfe545c5cc8a1b714b8ad01691fab7e74f48224fe107dcf345c39d19c169e16b476467aaafe54a218bfb828e644f319f81c53950be36a31fa0ad15545e8a07e14eddcd1cc2e628ad9ce7b2a8f7356a3d3a253ba42643e9d054bb8d3839c60d2b92e4c9235445c22851e805481aa0dd4a1fd6910d1603e29de6541b852ee06825a27125383d57c8a706a2c2b1387a03d4408a70db408937d2efa66d146da2c1a10df59c77f0852c63950ee8a65fbd1b7a8fea2ace93aa1bd0f61a9468b7b0fdf53d1c7675f634cc1155351b26ba58e681c457b01cc32ff353fec9a2d7d192d143c55e115647d434e4278cc908e7f115e7ce538046403dabd9345d61752b63b97cab989b64f0b75561d7f0ae4fc6be1b11336a56518113ff00ad45fe16f5fc6a637bf2b25eba3dce0c30247201ed50b105b6f38fa7152ba8201271c63150b39c7233cfa9cd57532b58912192427cb8d9cfaf069a23994e4c6dd33822aa48a5d72bce3ae0d42ebf7b03db19a02c58fb6018ca2e3d734a4830b6390c38fcab35ddb77ca48dbc9da79a9adb50441fbd2db81ea0734342f42e46fe67877c8bf8c89908f2f7752c0e011f518fd6b9fb8ba48a478f7f39c815a97b7c8df3ee76c0c29739233e95c76a370649c9071cf6a9e961a45a9e567e477f7acf95a48c964247b8a83ed12f0039e3d6ac23a98c190963e99c0a82ae8b7a769d7ba9c72bc2c008f19321c024f6a9a4d2754b7396b6dd83d50e7f9532df5692d40589808f9f940c54c35b949cf9f27a8cf6fca989b211777101db3473afa8ebfcea5875150bc5c11ec4153f9d492eb134ca01789f23ab266aa1b88dce1e28b1df008a4d2034a3bfb81ca4db87a1c1a9935799786419cf39ac6db6fd5770ff0074e2937283859987aee5ce28b01a1aadcfdaa357c2865c83f3678ae8bc34a562b52acb9f28900f7f6ae444b328044914a3fdefe86baad346fb28081b098fa0edcd1aec2958d83bfcf725030ddb760e9f4a17c9d3e2319922b156ff0096502fcef9f5ef4abb4c2bd793c9f6ae4f51d3ae60d7dd2e2699a16fde42c4f0c33fd2ad5dec2d197b52da6d5c06182bf9d55d1f541f6258db21a225483e9daa6be60b68fce005ff0038ae4c5c3db4be6a3373d73de93d50d1dd8bd2c7a8fce9ff006ac83d857396b7d1189595f767d4d4e7505e4022a10cda37231d698d7239e78f53589fda0a7b9cd46f7cb8e1c7d49a18686c9bb0a7ef77abb6fa8c727cac7eb5c7c9767af98a73ef517f6832f3bc7e752cab267a16f81bf8873408226c61d6b825d648eaf8fa54835c4c7df3d79c6696ac4958ef92c9082cd3c407a03934c7b789390c08f526b86ff84857fbefd3d0d37fe1235031b9f1f434580ee7ca4ea08fce8022cf5cd70bff000918e7e6727e949ff09273c17fca9728ee7a022c3dd947d4d4a8b6fde44c7d6bce7fe1233c0f9bdb8a43e2360380c7da9a88ae7a566d3bc882832d98eaea6bccff00e1227c721e9bff00090bf647fcc53e516a7a7196cf19f3947bd34cf620f3367f4af316d7e6feeb63d0b530ebf3963f2f1ea4d161d99e9cd77600f128a88ea162bfc79af323ae4fb48c63f1a67f6bce7d3ad26901e94daa5a766c8a8db55b5ef5e72352b96c9cff003e29afa85c85e5a81d8f437d5edbd6a09759b4552c4e00e6bcff00edb3b0e5fb7515247bae0e25938f734ac1b1bd77e345462b6b6a1ffda738fd2a99f1aea4a7222b61f5527fad665d696c8a65832ea3ef01ce2a1b5d2af2f537c3102bea5b14ecac3ba3d9ad09011d47ca010c41ea3e9fad3f686bab8404957c6181ed8eb5434fb99e190b88a25b60428cb9017d0f4e054b14edf6e936430f9729dcbf3b75c7baff004a562776588505acde423f072532386f51f5ff003daa4b93bada570089154f1dcafa7d2a2ba599e0ff00531865c321594921874e36d172f3cd60ee6d131b370226048fa7149ec3340dc2bb44720a83c1f63fd41a65e4823556442db9812a3b30e87f1e9f88aa3e6cb6ee41818a4ad95db20246473d7ad59798dc22a3c13863cb6dda0e475e3750c0cdd474a8eeeee49ed24f2250ab21c28d92649ce47af02b2e3ba22eda32c23b8c9cc473c8f6c8f987d335b90cbb6f27578a60ec14ba6ccfaf2304f5aaba8456b232b4d0486207255a223611d1978fe54d36b406918daa1ff4570dc6d65c67b7343e3c98549da420247d71d6ab5c2dc23ada4927da51e41b2478ca375e8dc7ea2a791d655f3509c3f23e52463d8e2ab4b5c9f221bb3e5db0565dc09dcdec7b7e34d9dc410449bf1218cbb1c672704853ed4c99dcde3db1e4b9daa1f8dd8e9cfe14794935d3ec656460e1474e769140d1a57170975a75bdda8c6481271f51fcff009d664cbf65b09197ef39ca91df3dff000c37fdf552d95ec331b8d39b250a844973d71ffd7f4a5ba78ee20540df26e58885e781dff2a1b0668e95234b630b281b880f8c746f4acfd62e63bab98da36dac3975c9e7b74fceab695a838d6268327cb76cc47b2f602ac6a76aa75413a1212e40c0ea548fbc3fad37ad9832849b775bdab39f355f7038c7deedf977a492447bd5802ee8a2cf2bd703a9cfbd3f7bbde3348a0853bdff00971f9d57488c4d25c83b94feec0ecdbbafe9406836d659649ae240771505c9cf0ad82063e99ab1656e22b66079dee0156190eb827f139c54d085b3b5d91a796ecd923ae073c67f1fd2a6085e78558e046a1481dbbe7f5fd28626ecec396f4c605bc918000cb18c6170327233c6403c8a2c7538a532bb02adf7b078249c9fe59a8238035bcde603be4907cdd327a93ffd7a0d908ad5a372c0c9d31db3c7f2fe75224ee6cdb5cdbca6159f22271b8b2360e3a0fe47834f9a01b03fcec49cae4e5481c76e4566c2503e2367d902ec53b8639e377349119bca4e76e09ca8e871c03fa9fca975d07cc96e685db58492e21965886cc9f9f2549c75e2886492378a64906d923cb6f5073838c1cfae2a8c05b75d4a3694db8520720673fcaacc5279f6c5995328ec060e09534ad61f3bec4cd3828cd359c1bdb95744da41c71f74e2a0ba91e38777dd6236fd09e334491f970a1424329e87193f5f5ea29f7d0acf146c5b1b0ee03d78ef59bd1ab971774d0fb21b124dc15795f94755e3bd5d6fbc06dcf073f4ac3d11a44da93bbee70cc439ce4e4f39fa0adccf1863c83c9f5ae833658b0771b90e00771c8ea2b16667b5b878c28d996e71d0f3ff00d6ad8b21bae4865f940c7b8f7ac6bd3226a73aee21b700030e18753fe350f706c72ab603c8aa4f0c42838185ec69c18cac063803a723b0209e7dea34fde4ca1dca8decc319e01fe9c548e8d264c38c6305b3c0e71f874aa15c0319331901321436c24038e78353808a4e63e49048049ce79e7f2aa4d2f501db392c067819e3f1e6b7741d1e7d62f1604562858a920607071fc8554536ec3e64dd8769ba61f3fce9940185231dce327f0e6bb6d1ee3fb2ed9ef550b6e3e4c1028f9a790f419f6ee6b4751d020b3d3ed93cf586cedc17b873c1e9d41fc30052689686ea44d56784c4a176595bb7fcb18bfbc47f79ba9ad63649a468ad634f4cb27b757b8bb6125f4e774f20fd147fb22af1614cdd4c2dcd2b13b9216a617a696a616a2c3b0f2d4ddc7d699b8d377531d87b739a6e78a617f7a899f0739a0ab12b1a4c8a84c80d30bd31d87c91c327df8d18fb8a85acad4f48f69ff6588a5de690b9a2eca49903d8a672b230f63cd40d66ebc8656fd2ad190fa534c869dd97a944dbcbff003cf3f4229a6097fe799abbbc814858d172ae5068e456c796df80cd0b0cac7fd591f5aba5b0282c3d68b9572afd96403385fce8166e7ab2e2acb30c5287a2e176402cff00bd20fc1697ec4bfdf6fcaa62c68ddea695d8aec87ec683f898d27d9a3ee09fc6a6ddef4ddd46a526c8fc98c744a5f2d07455fca9734a0d03d46803d28f5c52e280290094629d818a4245017131411e946ea696f4a063a814c2d4df308a076271c51c543e651e613de80b326cd286155cc949e673d68172964be68de3a556df91416a0394b3bb9a40dcd570f4bbfde80e52c6fcd26ea80483ff00af4be6530b13efa37d41bc52efa05ca4dbff002a42fc545ba937501625df9a524545ba937734ec1625dd49baa3cd19c1a2c3b0fdf8ef46fa8fad2648a560b12870680f8351529a02c4e1f9eb4e0feb55431a76fa01a2c6fa37e2a0df9ef4bbb341362c6fe290486a0dc4d26e3407296bcda7092aa6fe6977e7bd02e52e79bef4a24f7aa8af4edf4c5ca5a12fbd3966aa5be977d02713444f8ef4f128359a243eb4be771412e069f980f146e159e2623bd3c4fef412e057d4926b3ba4d5ec4319a3189e25ff0096d1ff0088ff00eb5747657b6daae9e181125bce9c8f6358ab3f20f7acd82e3fb0b551b78d3ef1f81da294f6fa1ebf5a4d5d12e17473de28f0f49a45f174e6dd8e55c7a76fe75cd49f202d82d5edd756f06ad60d6b3052187c8c7b1af27d634d3a75ebdbcb1642b7cb93cfd2a93e6f53168c17670bf282cc4e793c8a859be6cf2debdeaf3c698057820e7afe951a8524879720678eb524ee66b0dc9d38078ef55e680ff113cf522b51e24298da318ec2a19202081d73d3345c0c29aca49010269067b139acf7d19893fbc638ea4815d3b438fbc76e7d475a89e053ced033c9c0a5a0ce61b49740086cfaf4e69ada7c8b80c38c77ae85a2193b463d062a1310ce48dc4f7f4a3945739e6b6651bbdfad46d03706b7dadd0f6393cd44d6a3270bc7523b7eb52d0187b64049e78a5f31f1825b15aaf6dec6a136c46481f9f7a7ca333cca48c1cfd2903363ad5a683d33c546d09cf1d2a5a16e4258f5c5771e1e9b7e8b6e4f254b21fceb8b0831cf4f522ba6f0bcb9b79610ff0075c31fa1ff00f552d983d8de8afe56b69a641bbca73f2fa8f4ad06bbb5bbd1ddb21a265f320723383e9ec6aaac5146ac23455f30fcca3d6b2adede5b1125abca4a33f9a133d172719f7ab5a6a88d195f55936dbb8dc01e838cd72b312c3924e7d6b7b579ff0073b431f99bfbf8ae79ce31fe349b2d0c059492a48feb48d733138dcdf9d3baa938aae482c6a410ff003e43c6f3486473cef3c533d41c52f1414282cddc9fad1b189fba4d37713f434e0c71914842f94f9fbb52c51c8ac4345bd4f6271fad344c474c74a7f9edd78c7b50d8d8e96162028899117db7547e43e785738ff66a4599b83b8e6a64b839e79cfeb49dd014644746c32b29f7153c5673cd187551b4f4c902aea4e40ebcfbd4e97326411b7f1143616280d2ee09c6e8fe9bbafe94bfd97719c6f5dde983c56afdb1b219910fa9da053bcf4727e5507ae695d8231bfb3a507fd628fc0f351c96932b95c1207524118ae844d138e115bfa52bc224cfcbdb39e79a77031e1d245c46196fed9588e558918a90f87af304a4b6f201e8e79fd2ad3d906e18607aeda72d9c710ca337b142453b85998575673d9bed9a265cf7ec7f1a83a7f3adcd462ba92d402d23a039e57fad61b293c50edd07601232f20d39a663c1c54678fa52807d79a9b087ee3b7045392778f051f69f514d6c01e94d38f4a06bb1605e5ce0e6e66c7a0622bb6d06df66971f991ee67e72f5c35ba7992aaed6209e715d7aeaf2410246a93aa81f749047f2a4ac99124dec7576322cf6f244fc236efa13ce71572db6c934de5906e22555070173d7afe9591a64fe7da490ec18c64107a5529eede2b9bb9248e52cc8a480bcf6048c75ea68656cec7651379832ca55d7875f43552776b48a64cb2a3ee208191cf3f9f6fcab995d57ecaeaa2e1bcd2a09c82320f233ef8a9ee35232da83249bc39c8566c703ebef49a03a59dd3251f9465ca9c75e0d456576ca48750e54e0b75271dc7e1588fab49716e5e69372aa8c7ca320e78e9502ea922e1249106f1f2718fe5de909e8ce8aeee07f6a472a0fbabb5bdd4fff005ea3bc9c491ba1e0118e6b11af84b712ca18302b824f39a82e6e428846e6c91f2e1b39ff00f56287b05ec2ddc8be4ccf8c9465554ce46eedfaf3f8557b4926837cc8e5d8a6421e85b1ebefcfe54cba064b2247cae5b3d7ef01dfeb9cd2c2e23b34665c2be06471d3a9a22ec82eac584996e0238508e308483d09feb50a472c524cc8e76283b48190c003c7d79a4448ad6312c2e77cbf3fcddf1fe4fe54e89ffd42ab0d849671e99c8c555c48a36d0082e7ed2a7f70158c831caf6c7e66b40c2ab3c8cb831b00c1b1d723d3f3a8a685deda48a35dad2b655b38c95fff005d3d0bb4112283900a119da3a707f5345f41b665c56cb03c97e55a448f1e5c61b96627033c74ebf956e338b9d29e58d46e29c6d1c820723df8cd5136bbacb6b128c49395e71d45496ab2d8c02340d26e3b88ebfe78fe74b9b4b32398cec3ad896e4ab4aaa783918e6ad59c2b2c6b173e628765527827b1fd0d4972aae90c7092cc00ced39049eb91ed52da222cd2ca1190818e4f031c0c534ee0e4574443222166631e149dc40c0ce71cfd6acbbc8b3c880151b822f3c918e7ebc52c40c42e09036f1b5873489e59044b2798461c32f41fe18153af5253ec57576dd1420c9865ce7278eb9a9e09c3312655da32e5d89e4f61ed4e7944b0473187130708e50e77af5cfe98a83ca97c8638daa5d7233edc7f5a2fa03935b0a8122589433ef9b939f4ec3a74cff2a9cb36c7fbe9b090a31903031fd4d483ca054a2b6635dae1be6c1ea307ea4d2f95288f61901e770c12723a60fe745d0eec60dd1488aaec6465e401d738a9371490461fe45c6f38ea7a9fe74c7f99e40a5caa11819ec3a0fe54d9a58e2600b0cb05c65b39c8c9e7f4a2e521257f34c685b93b8b939c0ab5100b237984112a8d9f4c0acef3e3455420ab329ddc70064ff3a9a295656588103c900153df03fc6a67768d21a0b6d6ecf79711f06265d832dc823dbf035af1e4c51b6ecf1f89e2b134e7d9711e14866958f3df3fe4d6dc000445dc08c1031c74ad63b13727b53b261280a7208639aa1ab5ba2eaff772af866c77c0eb8fc0d5db5da268d5c6549e33deabeb0acf7a18166c27041e7afad264bd8a76d1bfc8aca0865d9bb8e9927f5cd5850caff70beeea0f00753c7f9ef488cbbcc67b1c9c74200fff005539ff00d60542581dd8e704e4003ebd68dc94c92cf4f7babc8e3446cbe006238c0e7a7d6bd93c35a1c7a269c8bb733b0f989ea3ff00af587e0bd0040a6fe719390476cb631fa7f3ad6f126af2d9dac76966737f7ade5c20ff000e7ab1f602b6d958d12e855bf9cf88b58364a4ff006658b86b823a4d2f509f41d4d6d07159da6d945a658476b11dc139673d5d8f258fb93564bfa55dada176e889cca0537ccaac64cd31a4a0762c34b4c32d562f9a6efe682944b3e6e698642054064e69864f7a657293993de985f350192937e6914a24bbda937d405e937e7ad31d89f7d34bd4264a69738a0ab1296f7a42fdaa2dd4864e681f29316a6eefcea2de690b503e5242f499a8f70ef49bf9a0762563c52ee18a80be6937d03e52c6ea4dd50eff007a37501ca4bba90b0a88b629a5a81a8936e1417aae5e937d0528963ccf7a4f339155f7f149be90f94b065e293cca80bd1bb3df8a039490c99a379cd425851bfd682b9490b526ea8b7e0f4a52fcf4a43b126ea4dd51eecf6a4e483c74a07ca4a1a937545ba9775016250d49bcd301c1a4e49340ac4bb8e68ddcd46adcf5a42deb405893751bc5459a7530b126fcd287a8c52e28159126feb46e3eb51d049c531589379a371a889a4dfcd016260fc75a5ddef55cbfe146f39a0394b3ba8dd558b9079a4f33af34ae3e52deff007a4df557cce7bd1e67ad170e52cef1eb485eab7994be6645171f29637e39a5f32aaefc8a3cca2e1c85a1263bd2f9b9aa9bf8cd1e6f1d68b872168494a1f3557cce29dbf8a2e1ca5a0fef4e0f54c4b8cf3409a84c9e42eeef7a039aa826a512f34ee2e465adf4799ef5584b4865a05ca5bf33de9c24f7aa3e67bd384b8ef407217b7fa1a6dc431dddac96d364a483048ea0f623dc1e6ab09aa459b34112813787354941934ebb61f6ab63b49cfdf1d9bf11573c51a3c5ab69ff00690bfbd8c7cc40e703a37e1fcab9cd5f7db345abc19f36db8940fe38bbfe5d7f3aebb4bd463ba8126420abae48eb9a5b3ba39ea42da9e513db956747c82a48c62ab84f9b8076f4f7aec7c57a29b7ba32c2711b0c8279cafa7e1d3f2ae61924070bb403ce3b9a6fb9cf25629385ce31c8e0d42635c6ec1c03eb577cbce4004e0f18a8a48b0c3e463cf24f5fa71524154dbaca0e579ec7a523dbf7ce580c7352a0cb65942e38e4f5a511c919ca22aa91c83d7348a33e484f752467923afb543246a4940ac481cf3cf5ad575dcacc46081d4d406d959b71e493d45171198f6cdcfcbdb3804542c8410a48cfa1e78ad636fc90aec39e8475a6fd8b71fef0e38a2e80c9f2c163c91cff0076a368508620153e99c135a925ab06f76fcff2a88dab29cb2123a50332a68073c16c0ea0f5aae6dcf4edfad6b320c0fbd8eeb9a4f2d5872833efde988c578429e01fad58d3251657cacc30adf23fb035a26dd4853b0364fe06a07b3590955c29f4e3349d989ec74c278c151bd9189e18007f9d675d4b1c61c46cccce72cee7e66359ab25ec10ed18902faf5154eeaee750c045216e8085c814af6128bb95f54b82d36dc9dabea83f9d656ec9eb4ae25249313727938a8f6c81bee1a4ee592707a7e79a618fbe29e11b18d873f4eb46d3dd4d2b05ee43b7839cf5a0a9000e39a9f6139e3eb48508206083e8690c808e949d7af5f7a9cc679e2936f1d3ad004229738fe95298ce7a7e7479673f7680b9182452ee6a7f97ea7bd063e7afd6920b8d0ec2a45b970a06e38a6797c51b0e33dbf950c0945dc80e338e3b538de484f27393cd57d869db7dff000a00b097920e01db9e3ae2ac2ea2eb80588f7eb59e149038a0a360e296806aff006a393c367ea29c9ab3af185fc49ac82a40a511b11919a037349f5267e198e0f60d593215f34ecce0f4cf5a718cf638349b09c03ffeba2e31831c8efed4e50053bcbce7d697c927f8b03f3a2e088998648ed4df4c67ad58169b87de3534568d1b6edb93ef4ae809f4d85635f324077761deb4488c9f98b37b551124cb8f9722a41310324673d4034add4475da4409189663196c9d8abd7fcfff005eac32c36da8e14a6d4e4af5e3d6a2b39563504820b02cd9fe2ec0d4378e56e1e5c19111769dbce49f5fc3f9517d84e4ae6cb8b3da247891cb1e7e63cd665ffd91216f3228d9a2c6cc31cedebfe7e955229da7b8d8b2b46a3e77c36703be73ed55e4b93331c000b745ec01ff0022a5b26fd81adbfd11915fe60dc127ef6074fd47eb5343bd5924270a8a1865549ef900fb9aacd26cba58e2d924718119c9c923bff5ab0fbd608ed7ef24a59836ee428e99a1bb0db2257497088af1eeeaca723af7cf6eb51c978f90c3ee16e36f3c7415723505f7c58030c0b93c13d39f6a6ec49a54886c8b69cb104e3d739cf3f85473ded62362aea0ebe648859fc98c2f20727f0fad36f5e4592d630cbb123ce07bf20ff4ab135909ef09cb618939ea1877e7f3a8eddde4bd2cc098b76e008fba31d0552b0932624c8d1c48a378886e4f4623393560479b8f27783228192abc676f154c5b5cbea4b29919932240c795e067a7e1d0d4f0da493ddb5d2bfeed80638600c678246334f9932d3b6e3a799e3758c2e48ebce39cf34d665124b2486431afcb1edfbca3bb7eb559ada49ef9497dc01de78ee39a9415f3dd881b2304b03ea0f4fa66a53ee2bea4aad2bdc18522dc47cac4e36e3a77fce95a458a731404972f8321e78c7f4c1a862966b828501319caf240c3e78e3b0cd486d96d9a5912472b900f1923d7f9d36c18f89518c92bc7c3b173938c609e47e38a7f9d95e71b9f80e47a6091fcaa1b908912cd97c91b176e401f976a7f951b3451618a0fde73904038fe54d3b8363a767771188f8ff58a13d4f41f9d2ac41a79485e1b9c82070460e73f4a97821958ee6c9538ea0371c1f6eb4f781c796a1ced1950c581249e9fd68b8bc8aebccb142ac62241c93ce09e7bfe148c1a57fba37060e4b0e8aa71f86715622889bc77751b546431f6c607f9f4a6341985676dade602197a9519e7f90fce9361cb6218915ad4b851fbc3d4f5f5c9ab82562bf20c10392dc9c8eb51a45f719ce0a0f9d4738cf4c9a4490a16d84919391d49c7f3ea29dc6958ab2a2da2acc64396c600c8c601c8ea3af1492a34d142922bef1f32bb0c01939ff0ab6c0cef1c4cdb703a9e303ae39a682ab2b10c4a01b707fa509b6824ca970a9e63b90caaabf37a1c6303ebc52dbb6e843aa8576e0b0e9d727fa558bb6170af11c72c5bb0db8e3b5356dc210919ddb30704fdeee4f34b9aeb51c656dc82089c6b1bf7fc9160fb0e98fd4d7401f7aee2f962793e959fb02b2b88705cfcfcf5c7423dfad5e551e6e080431ef5707a5813bb27b7cb3c4c870437563d0fbd57d59830b72846e604b03e9e9fe7d29cb1a2c83083693e9de9755431f95b17e4e4707a639a72d86f628451853e61dcc81891838dbb8d751e17d19f51bf421403d15b1c2e09cb63e98ae6f4d85ae655443c305c9ec46735ecbe1ed3534bd3d5ca626940fc17b0feb5ac17514175351da1b2b4c0c25bc2bfa5725a4349a9de4faf5c03fbecc768bfdd887f17fc0bf952f8b6f1afeeedbc3f6ee54dc12d70cbfc118fbdfe1f8d68465228d638d422200aaa3a003a0ad23fcccda2ba96f7f151b4955da5a88cbc75a65a8968cb51b4bef554ca4f7a6197de82d44b264a6992ab799ef49be82f94b064f7a6192a02f8a4de281f2936fa52f55f7d217c5057293b3f4a69939a80bd30c9da82944b05fde90bf355f7d26fa07ca5832629bbea0dd417e290f949b7d05fdea0dd46ee682b949775293c543bf028df91d69872936fa4dd5086e68dfef40589b752193d2a1f300a699050572936fa4dfd6a1df93417c521f29296a4dd51eea697a571d8973ef4679a84bd26fa2e3b136ee7ad1bb350efe28df45c7625068cfbd45be8f329058941cd3b22a00ff85297c1a770b1306fce90b73d6a1dde949bf8a570b12e7d2806a21253b78a63b0fc9cd3b7e09f7a84c80fd697712991da825c4786e69bbb9a843e1b3433e0fe34ae57296323d7a501b9aac1b83cd2f98714262e52def03bd2f982a99933834092ab985c85bf3290c9c75aabe67bd37cca3987c85adf49e6556f3282f4ae3e42c1618a4df8a837f1d69371c64f4a2e3e52c17cf53484e6a1dc001de9378029072936ea0b0dbfce98a77739fc4d4f12412603dc08f9c64a9229364b69116ee29437e46a5bcb3fb294d9730ce8e320c4d923ea3b5532e79cd31c5a96a89b761b1fad26706a22dc0a37e4f5a4558977f6fe746fc54464c8c51ba80b126fa7ef355c9e7346fa07ca4fbe9377bd45bf1cd26ea2e162712714ef30e07355b70f5a5df9a2e2e52c79847e34799c541bbde937d3b89c4b064a5f33155b7d2eea2e1ca5b5929e241eb54b753838e945c9704680901e1b054f041ee2a8f87ee8e91aacda3c8dfb9ff596e49ea87a0fc0f14ab2e2b3b5c0c2d63d4611fbfb26dfc7f121fbc3f2e7f0a7be8633a773d06ea01a9e9e61e0c8bca67bfa8fc6bcdefad5ade678f6fc80f04f6f6aee743d4d2eeda19e36043004906a1d7ec60174b348bfe8d72087207dc6f5febf9d09dd1c3287d93cfb84270704fbd2b6ee3ef11d722af5ed9b59dccb04d1c65e339040ea3b11f51501618c050075e075a1a39d945a12df7b2508c7400814088ba9272b8ed9e6ac3a919645c9ec334a461771183d4d2115191c9da119718efc1a6797bb27f522ade46091e94cca74ce0f70050162b043b88c027a1f6a6ba2b29daa73eb9ab3d3a161df04e698ca0718f6c521908c310aa3a77030292552dd55481ea3ad3f04afca0119e7d29593006060fa520294ab9c61554f7dc3f9521b4de37222ee3d4005bfad5bc23fc815813d491cd022fde60145f7f514058cf6b7451b46739c9e31482db6005f05987a66b4883e66d67424ff00081cfe74cd81589d98fc7228b858ce68886cb2eef7c74a89e15663807df1ff00d7ad35738dad82dec698634c0c649ef4c0cb92d1593048eb9e4f06a33a5a840ee8769e840ce7f1ad76b75646e33cf5a60b37ce4647a9ce28b8cc26d390925410b8e87934dfecc4fbc718f406ba410ec003b07e7183daa1668826440b93c75e9f852b858e77fb347cdd571dfb530d86d19e49f535d19785be636cac0f5258e334d93c87fba8ca7b00d91fca92039d8ec017dbd5bbfd29efa64724798a39320fcdc83f8d6c3264e4312073da9924608c8efd4934c2c6236998fbac0b7a1e287d359065972338cae0d6b9895b3c79671818a62a18ce51d8b0e4f1c9a2c0621b461ffeaa69b620904574c7c99a4058ba8f601bf3a85ade00582b83cf048c66a6c073ff00632d8c1a67d998632335d17d8998e7cb2467b0ce2986d579cae3eb5371981f6627b0e3da816c777a76e4574674f4d81958b8f65e9518b2046704fbd170303c8e32453e3b52ec40c671deb7d6c404cfa9f4a4fb023364aed3feef5a4d858c7360cdd806fce986c2607942315b7f631d89fc6816786e4e33e8295c0e7dad4a920f2475cf14888f1e76e39f606ba092c5481b4b93ee2a11a79e4631ef814ee1a98851998ee1cd1e5b0e873f856dfd8c312339f51c5235a3f45c11db228ba068c6d87d48f6c54e8a59796e95a26cdb9cafe54cfb263e5da739a04520bc139353a26e1f37af75eb539b76407e5c91dc9a617600120fd4d16bec06d4c7cc9259158f03ee8e71e9dbe949234bb638b761b612738f9b3d0fe950c05eec2c4b290db81e723247afd39a937b5c3bc312178c8f97e5e463b8358bbd9dcc9e961d0f98c646dc776de241fc5db04d488abf6b21b287ef1257a63deaa4aeea9144ab92ff00bc719c1f6ff3ef52fef218a491d59f7e5319edd71f5e28b5f7e81bab8f682de690f96e51a43c91c673d7f3a92671991616544e140e7e603a9fae7bd416a2369028724820ae09257bff004a6c1e71ba1e648d83c850320fd296ad5c49f42410ff00c4bb607558c31ce0649e38047e751db2c915bca5999e02a0673ebc1fe46adce5232bbfe6c7002f438fff005d46ede5989230ca9b72c703bfafb7f8d09d9824ba92db0601d03fca0654e7a7a1ff003eb56427996bf37de52d8041e73c63e9591792816f1a2bec72f9720f403a7e19353c138fb1a3c4ece8796f3392a4607d70739143d01f62c40cb089038c2f081473d7ff00d552cb35bf9723c21be70aac5b1cb7f9155e4225822924c26189539c71fe7351ef2221e744ebe6e5cf4254763814813b32d3a284f3d705b3b5940c93d0e6a16d3e09ede48bcd68cb11f3b73b79cf4cf2298619decc6d9372e49dca7196ff00f57f3a5dac6631bafcea7b75cf524fe94dfe2575278616b7488a1dcd9073b7838c7f51fa53d9d2328c491ce180ee7d29e8154ba85ca90301fa83dffc69a5d04e7382b81f31e72474a1b7715ec08a1a429b15481b4b1c10dc67b8f7a699963474f2feefcbc0c753c7e94e0c7cc0e707f840c7009a63208990ecf3249725813c7b71dc75a771733b8e019e343b03139e4751e9fd695999e3912451b506011c7cc38cd312e4b331608a99e30b8c9f6a1637db8120219b70dd9e7b633f8d272e852b124400d815b0cc0b1c8c83d451138da5402723e600f39eff00d28822432b0e0376efdb9a9a34757f324388f9dce7afe40d263df51143cbb897014a94620f5ea33fa527292ae136a807702719e39cd4a405036ef652db72571f4feb4c97f76cc81be57033c704f4ededfca9dc96c863859b749866908046ce3f0fd6993215214f52720e73807b66a546107c81d9829ea472c7f9d465409a52ad95391c9e467fc9aaba275b8991b88326d048c21e39e83f954ca8a23218a92d9da0f1c0f7fc3f4a724702dc43b53af2cc7fafd29f3ca7cef37854236a8c7403ff00d752ca4888614bed2dc8da983fd6ac1df241f23479cff167155c471f9a8519be7e483cf23918ab211bce3f380a4f248f6ab86f61a25003c63a6f5ee0f4353dd667b2dd8e4918eff954010293183f78f19f5ab8d1b88e389015c9c05ce6b56aeac5ee6bf83b49179a965866253bd89f415e857b7696d0cb3b901235cfb563f87ad869da3ab63124fcf3d9474fea6b13c657925d25b6876ed896f6408c47f0a7563f903f9d6f6b251468a377ca47e1e125e35d6b73ff00acbd7fdd67aac20f1f99e6b6cbe3bd565d90c69144a1634015547600600a43262aed6d11b28dc999f35117e6a169454664cf4341ac624e5e90bd5732526ff5a45f293efa42f506fe690bd05289379949bf9a837d05f140f949fcca6192a12fef4ddf414a24ccfcd216a877d26fcf7a57294494b73d682e2a12f8a697f7a571a458ddc5217a837d26fe3ad171d89f7f3de94498eb55f79eb9a42f45c7ca4e5f9a03f079a8377e54e56e39345c2c4dbf0298d27a544cf924d319b9a06a24dbe937d425a93348ae527f33078a049c62abeea5ddef40f9498bd26fc5445e937d2b8f949777146efc2a2df81cd26ee3de8b8289307e682fcd41ba9777e74ae3e525df8a0bf150eec75a42dc5170512c07e9d282fc9a8776481417a2e1ca4a5cd217a84b51bb34ae3e5250f8a37f35096a4dd4730f951637f1d69dbff7600f5e6aaeea7870169dc4e23cb52b30f94fa8a80b7269cc479687b734ae0e249be80e01a841278149ba95c7ca4dbe8dc77543bc0a50f9eb4f98394989ef9a4dd4cdea7819fce9ac476345c5624ddcd1bbbd45938eb9a37034b987ca4bbbde80fce2a3ce07f3a6e7268e61f2a262fcd26fa8b71c529e80d1cc1cb6264739c6694b11d2a3042a63bfad06463d69dc871bb2533b31193d06060629a5b8e4d458c9e78a53ebe945c7ca8713c0c7349bf9c8a667834d196271f5a1b29224ddc669431a843807ad588bcb652a4727a1cd2b8356d44ddd69bbb9a56d8a71ce6a37c2f4e945c12449bc0a37fa5419cf34bbb9a2e3e527dd8149baa2ddff00eba3777a570e5250c69c09a80b66943e28b83892eee68dfe86a2dfcd19a7cc4f29387f7a5dfef55c3669e1851713893eec52abe7e5619523047a8a8377a5286e6aae4b8dc8fc297474dd46eb48918e236dd164f543caff0087e15e8411753d3a4b56c6e23284f66ed5e59ac31b3bbb2d5a3e3ca710ca7d558f07f03fcebd1349bc12c714c878619eb557d4e0af0b6a8c2bbb63a869cc8c3fd2ec471eaf16791f81ae78c448c1033dc9e2bb6d7636d3f558752857f77272e3b1ecc3f115ce6af6896d764a126090092323ba9aab9c7563a73232492bf361b3d319a617944c0e41527903b5586e0e71918a84600dc7a772d49a301080dce727bd3181278071f5a794064dd9c30e0e0f5a4e5548c6e5ed8eb483d08827524e587714d6048e8c4e7ba9e6a5db95dbc1c9ee79a4319c05c8007a034011139e3a1cf734d6217ae3239e4d4ac0ed1b570beb51156de4918f704e280b8d68d4be5b0aff00ce9a631b40462a49e879c7e75295008e41cf4cf146e50081c91ebda90c8dd108cf71d79ff0a6331c019033d40eff005a98ec4c80372bf51e868650bf75491d3228b010b296c2a80adfdec5460ec72ac11f8e4827afbd580a19b0091ec475fc6911155c0600e78fa52b015fce2a18e0633db34d324878cb2f3dea69113b00467802915dd15e46c601c633c5005798c9b30d9fa639a66d902e46e3ee4e31573ccf901dca73db3d29a76fde3f77a9e7a51a0151c617a3671ce79a8c705438c8eddeac3c68ec7a60ff0017ff005e8f272990dd3f5a008046d34c1228d9cb0e028248a8d914120eec8386cf0735384c65b71e79c819c530f11b64f0dfecd318c580156223760bd5ba01f8d426225738dcbeb9cfea2ac792a4291b81ef43a05cfc8ad9ea41fe940159624724118f434e48558fccff005e2a43082065ba73934d650a4e1ba9e9400c3188df8624f62063352efe700007afcdde9a7818e307d69377627a7ad2b00fcab9c82a0fd30454a2299d370da57d33557b7cc475f5a7c6ee0f058e3b0353ca17ea4c0043899703df8fd69f205f94ee18ec01a62ca18f2e48f4cd2aac6e4ac7267d79a4e2171a4e7381c7b1c531b05b087bff001558f25d013963fce93cb249e98efd89a9b0ee3060e58b13cf6e714c63b586d19cfbe0d4de502403823af3d4523265813cedfef0c1ff00ebd2b011ecde7918c77cd3da21c0009f71cd3582b9e855bd7a0353a271c36d3dc74a560b95f6fca46d7c1ee69860650188603dc55d085bb907bd298c85e7047518340198d0260be483f954660528581cfb1ad4fdcb60329cfb1a5d9176181e99a770b6a5789046fe72a3ef03e6fe5de964b64d84302589f5e39ec28132f9298fbcff003f4c903eb51a3193cc231e685c213deb069e88e6e7b6c21b7b695ca2e41c9c043c1c71f8f4a8e791ada38a15cc9bbe660e0003d8fa7151f972248a37ac6dbb92013fad5896e2649a6c95652c4602ff004a5ccfe21a96845e5c36b0cb36edaee026eeeb9e723f0a65adc2a4ccf042d2796acdbdc9f4eb5626cbc6a1dd3775d8c08f948e99fc3f5a8e38678a395870cbf2aa8906093ffd6cd55fde571ee25b4d34ae14a155c80460719fa9a9e698a85f2e18264271e6161d3d3d6b3620a1e7923091c9b36aeee464f7ab3a7d949e6ac8a15953962aa5558819c024e7b50926ac8a4b42dcab1f0850f991fcac1f9041eb838e4727ad32ea78ad5026cfb808053d71e9dea1b67c5c47891ccbb80f9f8dff005fc335342b04c5a3237464962ca7903934f57b11cc96e4075688de3dab44cacabb065be527f0f7ab8cea92a44e500e8876ee3efd3d3a53194097cf61c75236f43f8d430ba8732248de72296f9b8cf72286936573a689fce46d44100f072c39c71e9f95422efcdbbf31c8da4e4e073dfa531250d0ca338c2e036323dbb52c2cc61902c7cf41818c03907f0c50882666995a5c31057247d4f6a6c4fe6c6eaa5b2380d8f4e4f14f521d58ca026f24b139181dbfcfb5489198a2319963ce3e529c6413ce334582fd09248c4564ce5b7067c29f5ebc63d462ab1b9f3125fdd98e4886d0471d0638fc73571a1ff422c0f1bb7b29c9dd80071f89aa896e16da579e2944b210c140fbe3bfd0669c925b8f7428610c0ad203b5be650064f1ebfe7bd5b9184721982ee40aac3078c7a74f5acf8bcf173e4f26128324e0853dff009feb571dde388c4a19c9390187419e80d24ac85e84de72f94ad1a1f99b2086e40069ed244d86f2f272437cc7b715594b38485d19e356ea5b0477cfeb56164db2c9955018f2d8a971b157b8ff0035cb302a015520f19ed9cfeb512b9705a4c9627393eb4e126096565da4e081cf3ebfa5453c4b24a8ee06d5e57d8fbd31a10ca4862461d477e00614b1b890c3dcb13bb278a8f748a92078c61b8cfa9eb51ab49e5489b72153827900f6fd684ae0d5cd0428cb2005d59b201c820e79a1a38244456620af7dddfd2a92315923071cae58af61d87e9fad3a396488928373f271ea4d26982d372f000424ed656cee0c7b907b52b00541dc79039249cd40b3151b5d492f8c027a1a1324ed0d8e7ae7f3ada171db52c2b072339dc3915b9a3d9bddde43137aedfa64e49fc05645a440c8f29198d79c1ee7b0aeb7c37fe8f74094dcfb4807d09ea7f9fe75d14d5ddcde9aea7513ca918e388e35e07a015c369b2b6a7e27d47547e62800b583dc9e5cff00215b1e28d54699a2dcdc1601b042f3d4f6fd71597a2da9d3b44b5b76e2429e64a7d5db93fcff004ad23bdcd69c7a9b064a85e5cf4a80cbe94cdc4f5a773a630262fc706985ea3dd8e29a5ce2a6e68a24a64a697e6a12fc77a6efa2e5a8163ccc521933deab97e0f349bcd2b95ca4fe65217fcea0df49be95ca51272fef8a6efcf7a877f3406c8a2e3b136ea5dd8a87381416cd2b8ec485fb8a4dc0f7a8f753770cd171a89316ef9a42ddea2dd93ed49bf9a571f292eef7a37545bff0a4df4ee3b136fa5f330318ebef55b7f7a0352e61f293b3ed3cd34c99351349b8d3770cd2b8f94b1bfd69370a80bf7eb406f5a4e435126ddf9505f15096e7d28c8f5a1c87625ddef49baa22c3d690bf14ae3e526dd416a8437e74bb8679a2e1625dc319ef46eef5196a6e68b828936ea696a616e293233cd2b8ec59926f31d4840b80071dea327de9a5fbf4a616c52b8946c49ba90b0a8f773484f7a2e5589377149bb9a8f2734a7afbd171d8937f34e2c36d41da9ea734262685ddf5cd3c3130fd0d4780467a539492a57b5027600dcd19f5a69c03c521345c761f9cd1939a667b51bb9a2e3b0fdd4e07af193f4a889f5a50e547ca7eb45c4e23cb63ad37760fb1a4273c9a46e4020f028b85876eebef403938a6671de80dcff5a2e3b0f2d818a40df291934d279c5206e7345c2c4aae4af079a532544a7922941ce68b89c4937e7de919cd26f05471cd30924fbd3b8b949492064f7e94cdd81934d0d918a427a8cd26c6a2381e7da944855b22a1dc714a7da95cbb5cb527cca1877a8338ef4231da569adfad17252b683b70fca977678a88139a03608a572ac4bbbb1a7161c6335106ef4f32613038f5f7a2e4b42eef4e9416cf6a664e33ef4678eb4ee3b0ecf5a5cf1fe34ccf7a40d8c8a2e2687eefce9c1aa3ce466903f14ee2b1307a786cd56dd9ed4e57c1e68b92e24b776e97d652dab038950a939efd8fe1567c15a9bcda70826389e13b5c1f51c1aac1eb36ca6fecbf16119c4578be60ff007ba37f8fe357cda1cd521747a95c45fda3a44b0759146f4fa8ff001ae5271f68d11d48264b36ddee626ebf91ae8b4eba31c8a73546e6d869faf2ee19b6baca67fd96e31f81ad1bd2e79fcbbc59c9e3701f5cd35f2a791ce79cf7ab13dbb5b5ccd6ed9dc84afd4555707a9048c9c9cd55ce3a90e5623005be5383dcf7a63a03820b03ea3bd4aa87ee801bea69241c61b0327a1a0cee41e5ed604f0739c838a42406cb039f520f3530e78c93ec78a63463f8803cf6eb48111ed180074e9415dc76f9847b8ef430c03803f3a68084751cfbf4a06376b118c018ef4cd8158951873dcae7352990025548f7e69840241da31fc5c7f5a41b0c2582fcb9c8e9934e5e9f3118279cd294550bb73f2f4151ba48c3e571ed9e0500399d415cb6307a9268c03213b86dfa535948d8777cbfc4aa299b1b7e549049cee75e05003258df7131edc1f45c7eb4dc32aec7566cf7f5fc6ac12f923ca65f7ce7f5a082146f5cfa8cd0172a4a0b2ee0991e87a8a5676886595634fc3906a4658d548cede71f366a3913cc19c018f51d69586880c8841c7cfcff0008e94ad282463cc5c0fbb838a622107cc619c7dd56069ed2ca763300101385c74fc69d808d4ef38c607a1a93e6450a76b283c82bc914af20209748ce7beea6ac4b9fba0eee80f38a4035d91989456404f407245119703ef1207a8a6b214ce78e718a6b202a407d87b0a6d0120990b6d1c71c93c62a3901c0604313d4630694c526d38c8a421b90ad9fa8a56b05c408703713ea39a6727bee03a03532accd94c6e1d401c5307239e33d06734680425594e08217e98a40c6370555b39e0fad4fec093c770290a13c11c7ad302be71c107ebef4f4c3b055003139c938a7b2b0fbc322855239e3148062970780c7b919a99277505b271f5a70b7923dacc76ab720b02723db151bc91807c98c019e727703ee091c51a01712ee139043e7b600348d730b80a51c9ff68d528f6392032ae7ae5ba546f1320dc7e65f5cd2b202f08c6dca1181d57ad36391f9500291ebc0aa826531e3f881e327b54a648cae0ee3ecc6a5c42e5a5919739600fa9a6348ca41dcaca7b62988226da7cf4fa0193492dc2e36298c8cf53c54f2b1a6581e6907f77818fad3195f66edbdf1c0eb5584d2a478382a3ba9e28374a060ab0cf500f1472bea0529ade796f080ec422fcac171b8281d3df148a523b78d27eb21f332a7615f43900673cd584dac11901deae18339f98fbf02a230fdb6fa5212368b3c6c07e50381ec3a56574f5472a6993db2808d3ef936a0caacbc824f4e7ffadda98cdbdd04b81f382c579f97ad4ee520b7f9549527710cc323b03d3a75a45b8b65b73290f83fbb0bbb839ebc63d3f9d4f2aba41677ba1ab72b7049119de4e7e63803f0a7ce80c680be0365f8ec7a75ff003d69d693db3e02aaa84c92acc471ebc52cd2c922ee30c193d0a1cff4352d24bd47adc6ac20db7fabc927231c9e3bfeb525bc6d1c6197259f8049e829bf6c877edf310051821874ff00c77d7352851bf030700720f427ad1cad7c8a522b4f0cc6fa49e31200620a018c9dcf81ce7f33f85558048b04e8e816645076e7058646462b6a5669200a38901ca82706a1fb5111aa3a2bf197ddc15ff38aa5a21bb329c124a6de4628cb16cc7dfcf5fc2a659124467d872781bbafff005a9b3e248923e15546ff005ce7a7f2a80b089a2c9fde11f32b3e4827ae3f0c53d10ad7d47973122a8f9643b9c374e0f19faf06a4b77910c586fba4e727a86f5a86468de6559b0caa02337d393fad3e199a470c00da0ee0714ba8d6da96d94c732ed242ae016ddea7bd1b983195c4642939caf6fafb535f7346ec43e082a33eff00d69b132f912306c16e03679eb47515d1664062b485d36e77b365ba63bff3a8270e8ead26ef2d46e3cee63dc8ab05f7db42ae03e370707d0e0e714c6851e227e6321e09cfb7bfb55343445e719118a9db9c70179607d6a74265d5200e0ec1f788e9db20d43198be5565048f9483d327ff00ac696dcb47e638c33152abb87dec9c73f9d12d104771d34c5c4971b14c81b3b73d41edf862a18e47daecf8e78207a9a256f324554259fef36d1f2f35038632240af92796ddefff00d6a9439685a324463556660f9c90bd7fce288d55e3662e0163824f7cd43c2b34990c00da3b63b0cfe74e48f6b4719e0b7ab7e5fd6992932d3206550bb777539e70698f1abc836c9bb7e090a4e0714be7040c5b81d09e98ed4d12bed3f313b00d8474e9ff00ea14d2456a82de08d165dad90c48da7b0ed4a625e4afcafd71fcc7e9fad357e5652c1816e09273c9e94d91d51d8fde6c601fd28485744934bf32b2e005c15f634f87182fd09c60d5096425514649dd9007a9e83f0feb5a1a55b34d7e37e7ca5033d704f39c56914db2e2afb1b76f191e4c4dd71e63ff00415d1e9c26543344bc648cd615a832c8f2edcb48f851d78e82bad402d6cd636e368cb7d6ba29e8ae75b5cb1392f1448752d674bd298e43c9e6cc3fd95e4d6b3c85893ef5cfe9f27db7c4da9df9c958556dd0fb9f99bfa56cb3e3be69a7a7a9d54e0485ff002f7a4dd9ea71f5aaecfeb4d2f91d695cdd409d9e985f9cd45ba90b7e552d96a24a5e9a5875a88bf3485a95cb5125dd49baa2dd9e290bd171a5726dd49bc76a8777346ef5a572b949771a5ddc5440e7eb4bbb8a570b0fdc738a5dc7a5459a37e0d170b126ea4cf38cd47bb9a4df83914ae5a8923360633cd377715196cf24d19f7a2e351242c6827d298482303af7a6e79a0761e5b8fa51baa3278a37714ae3b1216e69b9149918e946ef6a571a438fd69477e6a3dd9fc29775171d8783934332e381dfad337639a320d2b8587671db3403da9b9a40698c931cfb52ee00f4a60c953e8290b52b8ac3f750cc3ad47ba93345c3947eeef4a0e7bd47914e031486d0ec8c52139a4c82a5b773e9eb4dddc51701f9c7346ea61347f2a007f7a3386a677cd1400f39ce3069ca79c91c533761b3cd296f4fd685610fe39f7a3200eb519639a39a771587311da9031a475c0041ea39f6a052285dd480e4f5a31cd2336300d003f1c1ef4dcf519a686c5191d68b8ec381e293773499e29327f0a2e3b013cd2e4d373499e695c6480e4f1467f3a6e69375003c1c1cd2ef3cd474f1c504b43836052679cd3587714f00601eb4d08075347407d68f5ed48dd78e7de988691c77eb4127a0a093d3b7a534d4b65a1c18839a7b75fad420f7a940f973da84c4c6720e2823d294fb5274a0001e714b91c537049cf6a3b726900e248ef464e69a7d4519f5340c764d04f269bbc7e1467903140addc71381499c77e29550b77cd3e44038c5321c927622de460678a52dd3ae7d6a36cf7a40d45d95b937998ef59badb1586d6ed73bade6073fecb707fa55ec8e4f4f5aad7d1fda34eb988778ce3f9ff4aa8bb3339a563b0d36f77c11383d56ba0ba51a8e8ac011e643f3a1ee2bcf7c3b77bf4c85b776e99aecf49bd11c986e5586181f4ab8bbab33cfaf4fed232bc431e6e63bb507f7b1abb73ea39fd456331277004e3d2ba1d7cc4b146b1ba3a479019581c827a5733b7f79e596c15f6ea3b55a76b1c552378b1ec98c60fd07a533901430639ea474a98a6d42c501dbc920f4a60560b872dc9ce4d6870ee3170b8c73f8d0c1839000008e0f6c53be603098c0a405b030c083df18a008ca2b2e1d5181ec4530c600ca2738c54ca719f941f6a8e608e7631ebd33eb4ac321c7383c3751ed4e6dc8b9c83c73cd3cae7dc8fc298501ed9f5a0060181b59339e726940013af4ec28c823bfe34bb4755efed9a006a86393b491f4a6947600f1e8c38c1a7147039f940fc7229ac98e8c40e3903f9d00432831b2b9f900ea0545f2ac8cab33ef6c70cb9fa55b54da708b9c924eee9cd376f9c815954b29ea57a50046bb492db812bde9094933fdd3c723ad39c6e6e246017ba8eb49124dbb707dea4639e0e686161b2b463682d96c700f35149fbc2bbb210fa0ab2c114e18f23b311d69003807823da8b0329f9688f261cf4fe2191f811422feec170c41e72c0f156d44241d92460f705803f8d3772019f2f8c60ed248348ab959602d216d81bddb23f234e31e000c01f72324d34e5a41e595c3e73cff002f5a558b276e58e3b05c7e22905c8becdbb2ca8411dc51b5f7852411efd6a7589c13f3b2e7b2934bb084dc448ede80e2986e56750a41405bd41241a081e5e392be85ba549b0be70a71fdeeb40886194b7279c15c500566629f2e323a7dda77cc17ee2f5cf3d6a4f28a9192b91d085c67ebc52b48d1901589c75e280442240dc6d201e9c70282a8cf83d31d5453c44c0b16ceef6351e0839f99bd49e714011b818042e40e9934f872fb826547b1e3f2a7042ea4040e9dc1a6312a005191e839a43246c8f910000f5238cfd6a16423a9247b738a7b4885430560ddfbd3412b21f2ce33d8927340b7201129e158e4f7c0e29f1164055ceec1ed9ab2a9095224658db1fc40f355648c20c6d209e410714ee161e594c9c0217e94090e0c5b4907fd8e6984ff00751c9ee6904ff305c303ead9a007abec53b199477c8e94edc31965520f7cf5a837ee2031da7fdaa7ee192372b01dd693b0b61f03c6564731b8317396e39ec2888adc6db7283cace4aa9c0faf1d6a28e661691239c6e2642c4e323a0fe46a48a65224c382aa3824e3693fe4f4ae4b6bcbd0c147a892869662c6dc7236a9ee00e077ff0039a469111d21920877c4b924a83c9e73f963f2a94405a52c0831fdf6c1cf1deab4ce2676678d792307b81db9ef8a9d767d47a1696f4e37a05521f6ab79406477ea2961bb98b390e78e013f2658f6e3155af5912531aa93b781ce41aaee5c45146b1aed7cbe00c7b7e98fd69a94765d06e2cd44bd9549f34a88c64f2dc1fce9ab2c17408571bcb76f9803ef5515f6db9672006385c0e72392714e82e8ac32cec3a70a4f73ed4c45f63bbe688853d31d87b629ce8924a559864e063b640f5acd82eda60ee9b888d49c63a9ed81e9c55482ecc9336f98e1573bcb63e6e83f326a2dae9d46af6d4b974ed1de050fb97390a3a8502a9444cb7c1c9232d927aed1d73fa51e7b452ddbb07214f007462ddbf2cd3adadf7db131b14df8cab7385efefcf1f953f3638ec3adb7abc93cc581031ecc4ff93560ca238005041cf39cf41fe7f4aab730c91c71221caf2cc48e87fc8ab1b1a468917ef6c000c751d79fc29d9bd0112a5c9558c364ab8242af1df1fd2a6fb3c72488199d010381dcf3fd2a2dc56400461e3cf000fe11d7bfb53bca72ced33b33638c1fba7b7e14ec37a968c81605f947cee5720f4c01c7e5528cf9ea4aae5972a48cf4feb8a84154b38542f98be7336d63d470294e248cbc7b867e656c8e01f434da6f563d111cc81d8b97037038d9f4c54b6c891c58766f9f1c7763e83d3a8a899c24401d9b9dbe5d833c536587ed2230bb53e4c8763d18f63fa54ab8c8e1b866976a2148cb1e18f4519f7fad485833e7a11d195b1cf6a800428de57738e38ebdcd2338f2c0c97c93c27e55444b426fbca36b8de5b8c1e68459249d83b392bc0c377147cb1cf9381b0639c67239e9f8fe94bf2b329dd8072ce73e9d281c5df72c49128b7daa18b337d33819a811e41942ad19623e51d71d68123c7b56363923273dcf27fc2921965f263128fde4458f3d719cf4a16ba15244916f1e6339ca0f9704f6a8532270091cb176cf3d3faf5ab33803cb3ca96f988ee49e94c836bf9c36eee7e4c8c723fc8aa5a684ad458e1324be606e437207bf4fe55b9a6c221b5720631f28cd56b783c9b7dcdcc8dc8c9ce3ff00af57632520451e99fafa5688eaa70d8d6d0e306f21eeb1fcc4fd2b4b57ba586ca6909c0da79aa3a229482495ba93b47f3359de2fb929a43c299df2e235c7ab1c56cf481d1cb7958a9e1e431e891ca41df72ed3b67afcc78fd00ad22d9a8502dbc51c2bf7635083e8063fa535a4c9e2893e877420ec4a5c7ad26e007bd405cd39581ef51735511e5c74a4278fe94c2c3d690b66a6e5288e2deb4678a617e280d45cab0fdd485bbd34b73ed4d2690d21f9a0b671cd3334038140ec3f34b9a6124f7a4ddd28b8ec499cf1485a999e32334d27079a571a449bb8a42699bb341247348ab0ecd29eb51eea0139a498ec499c5264d373f8527ae698589179a43d69bbb1dff1a01cb501a8f2338e79a298738cd20eb4310ecfbd1ba9b8fc282a476352c2e3c723ad14c008eb4e0a4f4068686daee2939a3ae79a42ac0e307f1a31b412c40fa9a2cc4e490e070291bda93208ea31f5a319ef9a7cafb07b48f703d3dcd19e290e07523df269c508e00a969873c5f51a703b51bb814d6f95b9a53824e3a5162ae28c919ed49923a8a324671c7b5229f98679f5a02e2e4934e2738c53e3b79ee9c8b6824948ea1067157ec7c3f7f7ae4bafd9e21f79a41cfe03bd52849ec653ad082bc9d8cccf6a5dd5a971a35e31d967a7cee9bb02691802ff0041d8535fc3d7f026eb8fb3c03193e64ea2a9d392328e328c95f98cccff003a706ff269668444fc4f0ca3d629030a8fdcd66d3474467192ba24c9c8cd206e699ceef6a701c7d295ca14e49c5182074a475664215994fa8aee3c29e1bd2f51d061babb89e698b32b319080704f61ed5a463739abe2551576b4388e682a719af41d4f48d234c78a38bc37757c2404930b12171d8e4d72de2a8613a644d6fe1fbad3009d434eedd41046de0d5fb3b9cd1cc94b68fe46385279c1a36374c735d3da786ecef7c3b61710b4b0dc3c7f3b03b9598123241fa76aa916897da76a968d71009a0f39773a7cc319ee3a8a5ec5ee68b1f1775b330b6b1381d680483838fc6ba3f16dba4705b4d1aa204b8f2c954db9c8ff00eb55dd234a8a3b1b49c431cb2ce9bcbbaeec73d053f65ad84b1e9c799a38eddc63228009240238f7ada9bc5baae1dad12d62452576490863c7afbf1599acddeb9770417ba9e9a904319c89e1842ee0c38ce3b53f62bb93f5e92b371d18cf25c26e742abd891815007889f96453cf63d6bd2a243a9f8411582491cb61f2fcbd085201fae4560f846d60bff0bc96b25a4732acd9c18f38dca3907a8e947b28b33598caef4d8e6780b9cd3ee2296d62df3c52c49d374919519f4e95d0de784c19648b4eb851709f31b695b3ee307aff003ad2f135b5c5c7872ede48d8322248723a10413fd69aa2af6639e61b729c7416577710a4d0db4d246c321d632411ec6acc7a4ea0c302cae79ffa646bacf09a3dd787200990a8ee98f4e73fd69faeceda535a99756b9b20e080238438620fe9d69aa516672cc2a5f97438abbb59ec1e317704d0f999d864420363d2a2c71bc74abbafea705fc36e06b5717af1cb911cd6fe585f520d52f99576e78ef5138729d587c44aa2d7722078e738a4cf7a7803f1a6ede2b167773210f4e2a443918a6628ce3a641fad20dc7904530f5a0927a9269298d46c00e294b13d6928a43b20a4233d6968a004c0a5a28a005048e848fa5251450160a28a2800aa7a95fc5a759b4f2903276a8209c9f4e31db3dc0f7ad1b6b69aeee12dede369257385551c9ad3b9f0a5e9b1b88aeed6160e982aed92bef815708f333931989851834deaf6389d0b5eb3b4b1f2dfccdc18edcae323b7ad6c5aea9a9eb92fd974eb778918e0bf7c7d7b5743e1ef09e9325bb4b716e5e58ce0f3c575f6d6b05a47e5da5ba4684608518ad547567872c6d46ac8e26ebc3b6fa0d80962b89e59dd4ace18e579ee0d5261bd239876e09aecb51b5f32de681b9c8ae2edc32ac901ea38e7da9c95874a6e717ccf51e0b6e23765bd69a7712cae391d0138a404648e3dc1e7f5a0fddc37d579e2b44f4391ab3056c80bb4834ddb8ce001de9ccb8e47e950b36769ee3b9e3f4a2e0483e5f98e149e993cd3490db8f5206011c67da876e7ee7439cd1bfe52d86c83de801854edcb018c7cc29a542c796181ee685912438ce77714f2c0ae06719c1cf3482c341129c1c1edd39a00391c8143128170323a6475a4272bf7493f4c51b058431fde0c0904f1ce69bb70dc0fccd49919c1dc33ef4c72ccd88ca8e392c09a00630551c1c107a9e453a39339e07b63bd30c4c47cccad8edb78fe74ac58f0138e86806b518ecc42b243b813ce4f22970558ee61827230064528c1253cc6561c92282bbe420e0a1ee3826801b2619467a1ecc32294ef462c4a9078c7f93412c27f27cbf97180720823f9d38203b864e47e940220552ce5c322b1e33b413526248132c4364e4f6a6842c700739eb4e2aae3055b703c9de6806575d8e4957da739215f38a618540cabab96e840191524b1120b79afb73d01e07e18ab315c496c0ec396c7a039fd290c852daecc0f2b46bb579c8c8cfd7351b94f2c373b97a8ef534ced738796e1989e99738fcaabcd130202c4ce08e4a9031f9d16040244753e58219b92483fad2b4adb4a8da4763bb350c6e3704c0590fa30e685b79bcc659115413f797934863df73633260f400f03f0a521b61121247a9c7149189b3e59dae01fbe3bd3585c46bb5d18b03c1ce281118054e72c53b114a7764840d8f5e94e7572a3cc76099eea33fa53954e303e67c71c6298d903c7b57e60a401cf3cd30c042075c60d4ee9b5be761bbd334c2245601256dbe84628b81598b0e8703d7ad3c3aae4a8073d3e6ffebd58da36ef56556fad3449b1fcb08189ebb85206427f7bb40f94f70c0e7f3cd2f95032ed64756cf2df787e94e65201c228e79c9e942c9716f11736ff0021f6e29d803ecc149752481dc6587ff5aabbab8253613cf07d3f3a9559a5058218f3d4a9a0f55cec3ef8a00afb9a32bbd4f0793c7f3a32acec338f707a55a78b736546e38ed8cd472c6d1ae5c707d81fe54bcc0a52057da887742800427ef01c83fae4d1336c090f9b88d0062c46e0c48ff0c54b146855638d42f272cc3000ea4ff3a8aed5a72a60e3d41f97084f079ae56eeae6371e26486dddd4e2366da4e31cf5a58668cb348388e35dce49e31fe3c8a86ef3032dac60fc9f7cb900393c9355a4289a784694e1db73b609e07007d3ad434af7ec34afb0e8a4135c00583443e6638c6001ce69e2ecdccac01ea7819c8f6150c102cd67398bf88aa8c7191dc73f4a96da0689cbcb110171b4061f33f61472f61ecb52d3b8924c16fdd2a84009ebfe79a57b731c510dc4a7deedd4f03f4a448ccc57214211b8ed38faf06a48ccacc5646c1246dcd0d6e46eec410ffa26d53b8b48e1f732e368078e9df34eb8b569197e51e64d366429ceec74e3d7fc2ad223c926f403712372b741daae412c5f6963bb080af20705b9e3f1fe9549f40bd8c99a292180319001bb70c71d78c7e5fceacc042f95b87cd8d85b3dcf3cfd33515cb1b8bb89a2c3c646f619c6e02a6b6943bcd210a23da5b613d09e147f9f4a9bb6ca4ae24d19f3c82c461b0a5b8c9fad3c40c5fce7cf72a148dc29232ac1ae65dc2343c263963d01fa559f38298f0a03b8f9779dc40ff3cd3b5812d4a4a36c7be76024ce1401c8cf3c8c7f9cd598b73db471b120e72bdb70f4a90c2703cb8d49249c927f9d27ceafe49646901dc06fce077a77ec2b6a4b80b66cca7615704fbfcbcfea2a0775588444952a9bb1b461f34e59ddede79235de11d581271d4e0ff3aaf25c32dc6edaa410142e01207b7e545ee68974156242c141f94615413f99fa77a74521327dc126e6fdd8ce40f727daa84776257670408d08009e3ae73fa1ad237421daa401c748ce428f6fad42dca4432955949e3615d848e30074cfe66a1921b85f2e645ca03839e807f5a7ccede588c282186e3f20c9ff003cd356e8c21959132181e07233d39aa224b5d47946f30a33921976e30073d7b7bd432965d89f2ee070c1bf5a7bcc1e62824c02777cbd8f7e69b3a9dd1b2104be47a63bf3f8534ae4ad191899e54248c31c9201effe455e825319547384618c93cf4aa7958b2bc00bd3273934d909dd1ee75e7ef122aa2ba9a1a17724020c8725978e0f209e949a48334f1471bf1c96f4c5574b663049e7b1f2782180209fa63afd306b574a486085de3460381963827f0ed56a36dcb846f2b22ec9f2b18d589f73eb56e560ac8a0f6159a5f7499ee4ef3ec2ac453c53dded5911a4e81734e3d8ec82bc99d0c33882ca28c72e46e2bf5ae5f5cb97b8d634e81b1c4be6301d82826b6d8f92b8272fdeb9c9035c78a17a663819b93ea715acdea8eaa34d39366a1973de8f3304531a2751d33f4a6678eb5173d2e556d09f7e69c0d570d83520c919cfe1410f4242d416a661bd0d069304d0b9a556ce2a3e7d28070738a06ec586600600a8e9a5c9e7149938148487fb77a338269bb8f5c501c8e8282893900119f7a3193d699b98ff00851bb045201f9c6477a613ce29371c526724f14ae521f9005358f4140f5f5a31819f5f5a4c7b0bc84271cf407b5745e1bf0bbeb76125ccd71f672b2940153767001cf5f7ae715c8e00e339af4df05848fc35092e80bc8ec72c3fbd8fe95b534acee79f8ea938439a0cc4d43c33a2692d17f68eb52c265cec1e58f9b1d7d7d6b1759b7d06df4c7934cd46e2e2e77aaaab47f2f279c9c7a5775aec5a8dc4b0b699a969d6c8aa7ccfb405624e78c75c570be25b8d4d745b5b8bdd5acaee29245ff448102b03c9c923d3fad5a49a3cda788aaf7932d587842f351d060bfb5b88ccefbb30c83682012386edf8d65ae9f7506a90d8dedb496f2c922ae1c70c09c641e86bbef0feb5a55bf872c126d42dd1c420b2171904f38c573fa578e2692244d56d12e115b72b8003af3c1fad0d2e635862310e4d2d509e30d174fd12c6d5ed5250f2ce532d216e319ef56b41f0841776697faa48db1d77a44adb46df563fd2a878f35ab6d52cb4cfb0179b64acf22ec20af0319fd6b47c37e32b55d322b3d4e29626897cb0fb32197dc524b7666a75f91a57b98f75adf876177fb0f8745cc2a48f364988ddee073c562ea5ade9d7a61169a4369f20933249e6b32b2e3a60d748fa5f840cccd06ad751464e7c908580f61919c52f8cf58b1d6b4db5b0b01210938919d93680a148feb5575d47efe9ca9dfccdfb0d2b4f5f074770f676ef29b3690c8f182c4952739ac0f05786ac353d0ee0de233c9bd76caac4321db9383f8d6849e28b01e156d3e24b833fd8fc81f200376dc75cd67f83fc476da268ef6b796f3f9a64ddfbb008c600f5f6a57d590e159ddd991ea5e0cd5acd1a6b62b7b1a9395438900edc77ae8f58b686dbe1f5c136f18916c5464a0dc090075f5e6b92bcf105eff6fde5f58dc4d6f0cecbb509ce4050391d3b5686abe2c3a9f872e34e92d76dc4aa17cc47f970083923f0a9bab68693a788941736a6cf802d224f0f48cd1212d39eaa0f615a5ae5ccf62b07d91b4c88b96ddf6c6099c63eed72de1bf14c5a2e90b673dac92c9e6331647001cd58d4bc4fa36abe59bdd15ee0459d81e41c67ad5732b98ce8d573bf2bb19de28bdbabad31de6bed21c05f2cc76b26e7605949c0fc0573c8ec573ebc9cd69eb53e8b75a6490e99a2476772c4159c3e4ae0f35896c971180b2b2b01dea66d3d8eec2a9434944988f9bae79a08e6a40060e7bd376fcd5858f4d496c21e4fb54f61a64da9dc98619238ce324b9c542c09e2b6b46f0e497f109e6768e26fba00e587f4aaa71bb32ad5d52a6e4dd89ed2d741d2ae105dea624b946c9018840df8568ddf8aac21658ed49b96753f3a024038e07be4d4c2c34ad0ed3f7eea91939c4a77927d854306bfa10cb2b796a3a7eef04fd0575deda5cf9b9c9d7973b4e46be9335c5dd9c12dd5bf933ba82f183d0d63f88ae10491c7706582de6388af2ddf2037a38aada9f886f2e2d1869d69345038c1b823248f6c74acd86e553c226ca47f31de7df18273b147ff005f35329a2a9e164fde7a6bb19b340d6f23c4ecaeca797539ddef50918c548598fdeeb498cd72b773e92945c2290808a701d69bd29eadcd49a36295760300d76fe0fd734fd3f467b7bdb9586459d885607904035c7175f2c7723bd407ef0cf4ab8b48e4ad4bdbc7965a1df6bb7ba06b5e46fd6aeadfcacffc7b061bb38ebc7b5727ad58e8434c94e9daa6a5737aa54a24c4946e79ce47a66b3739ff001a6f7c55fb56918c72f8afb4cecbc2fe26d3f4ff000fdb5a6a0927da2266c858f2305b239ac58bc417f67aaddcb6b217b592e19e38a71b805273f87e1593cedebd293268f685c7054d49b6ee745e22f1126b7a08b54b230dc89524c860538ce7dfbd57f0f789aff48416f730c7716c0e557760a67ae0e3f4ac857c2e3de9334bda3d83ea50d5743aabbd6fc3b7b399ee74273231cb3ab81b8fbe3ad57d6fc456fa9e86fa641a7f931305505e4c950a463b7b573c5b20519e71473b0583a7d6e749a4f8be4d2f478f4efb147288959558c84641c9e98f7acff0d6b971e1d4b8448a39e39882031236e33fe359473da9ca463ad2e763fa9d2d742f6adaa4baaeaffda0cab04823080464f18e873f8d5aff00849b53974c9ec2e2459e396329be45f9941f7cf3f8d6230dc78a55eb8a39ddcbfaad2e5b58d5d035ebdf0fda496b008658de4df9914e41c7d6b51fc71a83e336f6871eb193fd6b97208fa53863f0a39d90f0b49eb636356d7eeb57d39ece786d8472632522c11839e0d60db5b98338958a1fe120559cf181429d8a71939a1cd87b084758a11901e735031c281dea776c8181d47350498e00393dea5ea75526ee8651451507485145140051451400514f8a279e648a31b9dd82a8f527815d1e9fe08d4aed44970f15b464907277b74eb81c633c7245349b33a95a9d2579bb1ccd15dcff00c2ba3ff414edc7fa3fff00655a9078334ab0669363dcb76f3c8603af60003d7be6a9419c93cca8455e2ee79b416f3dcb94821925603256352c40f5e2ba7d37c173cc8935e4a22c365a1037657d3703c66bb282ce1b642b0411c484e4ac6a1467d78ab96fb429057ad5a82ea79d5f34a93d29fbbf9984be1fb286dc2a5940547768c31fcce4d402ca1b473e55bc71b1182c881491e9c574a06108c77e2aaea16c08575ee2ad2479eea4a5bb665c6587249e29a58b4aea79dca454eb082083545fe5bc51923de86458cdf0dcb9b9bf87d1b35d14601c8cd72fa0b795e20bd4f55ae8a16db33027af6a3ab286dec68a37053923af6ae1352885b6ae7030afc8af40ba5df0139e8735c7788adff7693004ed6c1fa1aadd1ad195a5632245219b6a807d71d6984b3123e6dbedda9ceec36b03c1f7a6492600001c0ef4e2ee889ab4878240e4f07a668740cc723e8314c0e848249181d8f07f0a5dc38c361ba0c77a64030c0041cf6a614c6194e48f7a90ba819279fa62942ab2fcac7814c5a91312df7b0c475ef4d604c657e6fc0d49b4ab73823b64631405dc0ee2320f18268b0c8b3b70ac4ed3eb8a607da9b4296faf1531c11b986093c7cdd699226e3c37ff005a90ee336f05b6f006796a6673c807a53f21a3ee42fa77a693945c9fcc62a462063c6303d694923391f91a4f2d89047217bd01c8249e3e94c570c154e84e7f1a6efe72001eb9a5dcc3ae3ae39a15081b9ca83de801a591cf519f5f7a1b795fbd9f5f7a52bbcf5f9bae477a770cdf77923a7ad0044670a447b8ef23b8c67f1e94b9752a9b5b9fe2639a695559154ee04f6c706a404af41c0e983d2801873bc80dd382315118d32c1924383918240cd4f9df283bced1d40ffebd2eecbed5233eb48642aa8abb9f78cf504e00a4442d92bb8f1c3751533929b8300d9ef9a83088a7e40541e0018a60470a46b311bbaf70b8fe94d6b742e1d7783d8919fd2a576672b84040e8c4d3831df861818e08e6810d8df78f2f19247240c1a41b124318320c0e03b139a7956c8d87e6ee700d472b48c0862807ae6868131b221319d814763be88d422832e197d428e297ccc8d86546ff0074735112f0a79602b96390767cd4864ae000c554920700639aae92890fcc9327b3558085c60be081d31d2a2713a48002ac3d0f19fce90d0d71b863e75f5039cd460bc28725b6f62393fcea75f981046c6eeb9ce686ce36c6db4ff7877a60544c4c18eecfa9e9f98a9a2882a1532b9f45dc7149240bbb715f9cff001f5a6340cc98f2d31e80641a5601ef118ce237ebc95602a3588329054641e94c11edfde2a60fa66a41213192ca037bd3b00896aa007dc067a860463f1a8de654e4b0e0e08e48a4f31fcc56645cf7201a2468e53b48009ff67ad0316462d6924676abbb053b3fbbff00d7fe9556de090dd8d92051c90aded535d891444ea0b00080a0f504e7f3a74064742c632b2c9ce02fcca83ef1ff00ebd71a8eb7392e42917dac2c571102dd893c80692f2cd19f319f9157667760e3dc7d7d2ac4c82de43388c91b4aa37a13fe4d3bc9123a48a77871920630beb93537e852d3629cf6122a2c61510228e719f9b8c9fc6ac004058b8dd8de0919cfff00ab152431b2c601908dbf7b8c647ffaa9f86965511c418b062149eb81dbdf8a2fa96aec8c42648dd99d0a6380074c1cd2a36d84b899083feaf27a1f4a74be5aa3344490c802e49000cf6a6c764ad32c772a7732b6d0adc06c6467ea38a17e40d3222cd1ab48c5b6e3629ff68d5d5b50d66aa43611b7b13c16720e07e14d31bef862540a8a818b1fef7a7e1d6ac4b7218885970214dcc0f76f5fca9a7644c959e851207d916188aa38fb85b271eb52909022c0c41e8c65dbc31c74fd78fad471421ae3e43b50e18f3c8c9e452bb99143345b8302c01c71edf9509b2d2ea4cdb6d11159327925718e3b6715125c4f391211c64638f941208007e5fad473334b31e51a160140ce36f18e9e952c51a453ecf38948806e172074ee695b70e6bb1f1379b2399796cedd85b3c01cfb5566940809450d247bb69efd7a1ff0a49ae4c71cac7ae3963ce327ff00af54d232c176c99cb60e0fa0fa52567b037a93c0e1ad2784280cd1e47fb5d4ff00ecb559cf94d2c8d2b0091ef41efd3f4c55b85c1bc52aaac4aedf97ab0c1c9fa7355c2048254970ccbd5c60a81c93823f2ad0a455b522048a5623049936f4cfae7fcf7ab96a84832b6719dc4b71bbfc6a8dcbab29c820295e83ee8c7dd15684f233ec21428c20249c11edf89a4d5f61928b8323b0d853230ac4f207a0aaeccc933205c28e48dd92d8effad244e044fe7c6c02104e09fbc4f6a4fb4c46f20015541f94e41c9cfd6851b84b52cdbdbcad206dad1e016c823939fe5533c19ced0f96e49656e4fe55963506b8256391a305f18048240abab0a7c8d713cf11ce1a259393df9f4ff3c55a8b6ac251ee2c3110f850adb464f208ab2a80062a3e71ddfa55750c4337caaa5bf8391f8d282c858a15f308db9e4f156ac864b2869db12bfcc7b29247e1cd695b0f2edd634f5acf793e5c36ddc78e9d455d46d90e411d001f53fe4d26cde8ef72f69882eb540ac3721c923d87f9fd6ba2d4f42d3f5d026b482dac6f506d2238c2abfd71deb07c3ca7ed534b8e15768adb512025d588e738ada9fc3666555bbe8ce3b50b2f10689232bace13aef1f32d50b0d42f93584b996dccfe6a88703e5239ce7a60f43c715e9f6dab491911cc0b2fe63f5aa1e218a3fb6d9048910b4b8250633c66a9c623862ab45ee522aca3e61b4e338279a418285832e075f985694ba7c2ea1fcbc71838279f7a69d2adc206f2c93cf39343a2bb9d31cd6a2f89233b0187a8a7678030303dab46df4a4b9902a47963dc92715b11f83669000ae411c90c393ed9edf91a89526ba9d50cca9cfe2563953c8c5193eb5bf7fe11d52ce3322db34a99c9111dd81d876627d70b8fd7184e8d1bb23a9575386561820fa1acced84e9d4578d98da4da339e73f5a5a295cd395761492c41249c52125baf4f4a28a03957613031dff3a500039a28a03957600718c638f6a6950c73de9d45016426df734d2a73c63f1a7d140c8892a79a19f2a0014f71914cc0fcaa595cc845271fe152280579e4fa547f31a90709ef4d36b6266931bc77519fa528c60fca3f2a0018ff001a00e3ad3bb21c63d890729f4f6a44fbdc8e29571838a4dc73f852bb0db61c492b8cd47c8e735215e831f5a6b6281a100e873d4d3877ee69aadc014e6387e28b8f7628e075a4c72282fd3028192695c018723340c6286eb4ec60026815c677a5f5fad0e46ee33487a1340c5638071d6a3c50093c53e31b79e33e946e0f40e36fad047340c014a06e2074cd3b937076c74ec2bb8d0756b5b982daca36fdfa5bab30f4c1c11fa67f1ae1882054b677a6c1677854fda655f2d5cf4453d48f7ad29cf959c98cc3aad0d373acd6f4496f984be6bc81492aa141233d4039e959763e1a9cdceebb8556d70410e70fec462b22df54d4ed6d7ecf05f4ab1fa1e71f426a7feddb8b88c5b6a7fe956e4fde1f2c89ee08ef56e506ce28d0c4d1838c5e86f2d969fe188d6796e2e14bb10bb32777b11d2a545d0fc43b92d9fcabbc67ee6c63f51deb02f755b9987d92e8a5cc71f0921ca961db383cd6606992e55ed1bca973842a718278ef49cd5ec4d1c3d497bf26efdcb37f673585e3dbccbb645e87b11d88aaca0851b8e4f73eb5b9e27ba8ae2e6d151c3bc30849241d18d61eece0d632d1e87af869ca54d396e1fc74720fbd283cf5a4350745c5078a5039a41d39a09a6896c7e40523bfad347342e7ad2f7eb4c4809c8a4e694fa8a38eb4813d0173cd29069cab85dc7a7d291bb53173010318a5046450bd4e45340dac7eb409315b2493da998a713c9a06314149e82814630734a87b734ecfb7146e4b95856394ce2a35231c9a563c71d29073475122453d8521c834e8f19e69add69dc9bea3243c75a8695892c73d692a4ec82b20a2b4b4ed1a4d4a16923bbb646562044c58c8d800e422a927af61d8d6a5af81f559dc997cb862c8c3b139707b85ea3e8d83cfd7059994f134a0da94b639eb7b5b8bb90c76d04b338192b1a1638f5c0ab4fa35eaa26222f33025add4132c607764ea07bfb8f5af47d2bc2b0d84722c8cc5643968909546faff001118e08248393c74c6ac1631c2a238a058e3038540001ce7a0fad528f73cdab9a34ff76b43cba2f0a6af24815add2353d5de55c0fc89adfb2f0c59da1066433cc00ddbf95071f3607a7a6476aedda058e13b80f7acf90812938c55452392b63eb5456bdbd0a2916c45445c050000060015a36b294b42b8e431a633a85ce2a4864568cfa8ab6ce027499f6818a1252c0861de915805ce298586c340cb48a18629e91007a5675bce55f04f19ad249d58e2a7540c63458a8275c4449ec6adc8ca072c0553b8991a3740c338ab8b25a32dfe53c74acabc7cceb8ed5a32487a0ed5972a31264238cd1d4a31f4b6dbe28973fc40d6a5c4ce93820f43cd62dab6cf132fb9c135b9770ee7c8f5a5d468b224675193c1eb597aa41e6dac89ea0e2afc7c20f6a86e8654d52657538943987e6ea3de8057702718029f3c661b89e2f738fe7541d9d82ed03767e6e71427636acaeee5c2c19b1c63eb9a6486456402257e7e66ce31508249fba33ef52090a82475cfd69dee6161fb50c99c0dd8e09a18ede73f86714dc7218ed1df9a5690aa1dc0373d48a698b5250d804939fa531df3cedc8ef8a883160709c7638239a51275cae09ed4ee2b0fde300007eb4c3183bb8233d4814ef30b31d858e3b138a37124fcd81da8b81098f6e01623b938146d6ddc36463a81d6a52c31c1c1a8c8f5fa9cd2191e3e604a9dc78ef4d6247cad1919ef9cd4c422af01831a6923196dc3f1c5001b588c96383d091481006c023af5a405d3206e652780474a76d3c9181400d70a7ab1f4cd28008277647bf34e0323a8539ef513ae0e4707dbbd342770c2f50481480a9675dc41edbbbd3c2e7273cfbf7a61396f9f8f7c5260355e40f92432f4e452b9c03fc39f5eff008d3d761dcac4e4f4e714ce13025d8093818ef4862471ece100e4751de94ee000c30e294e5570a171fecd237dc059fa1e0f5340c8733f0422b8cf273c8a7b04381820b0ce40e2a48ce1598eef5071d7f2a4522419404a8ef401095280908c1b3c0ce734a25638124623fa2e09fad48ebb4648a154b67046d3ebcd003382e4aaee61d724d40c5e166fdd6d27a9539a98a15623cd3b08c15201aafcc53852331f5040cfff00aa8113b3220c1e09ef8cd217f2b0002ca793ce7141638caa9c9f4a84bb31da4ba7a9dc052b0c1e20d2ee03f0a4455da4c8cc847d4e69ec4b2e50ee1dc11422a83b77e49e483d68018b710ab8dfb8fa6e1c54bb19ceee147a06e0d2b044ee01f563c5330c495eade809a06452c3b4b16976213d00e950940d270ea5c7af43534aeea3011b9ea0f3558796d32848a44e793ffd6a77d009089147f771d454013cc07e69377620d5d5dff751b703dfd29a7f75f2f046793b71fa8a4981458399fcd2239622d9099ce47418fc287baf29705f01e3da030c654f38cfd6a7d3a2b3d8f37931ac712e5400727df9fa55794b5ccb205c30638538ce4f7cd7137639ed62777636ca1d236c8dd8276807b63d4d2b4cad668530a1fef0ddcf04ff00f5aab79b99711e001c0247ddc7181f955d9ae6de36f2a43be528a1c28cedc93cff009f4a6f6760d0af82d1bba83e6065071cef53562141696ff6a7df1ec3c738e7e954f52695becd144876293f3faf4ff134f633b451911b144527e500b10781c7e07f3a4b45aa1b5add17262d05c150a0438c839ebfc43f9fe955e17579be62de612083bb819cf3fa52ca07d8932fb415da467a153c7f3c551498adb994af2d945e39c7f9fe74add424cd233bbaa06dc1dd89c0ee07f4e2a1792292f1a6c9c38f2f7718ff003c540d2ed691c1da8882218e00cf534e82e62923d925b2aae367983e5ebc7d3d3b538ad7d472bdaec772eece5d5548fbc78ebdbd8549e736e5884457736ddf8073cf383e9c544b6c62964844a59d09dc08dadc7e879efc544af736f73f67583cb8de32cd91f36eeb9cff008714d7663511d2487ed06620889a5396c756ebcff8548b7416d18b2b2b484b8079c01cf03dce4fe14c90c5140aa64d91b30386eac7a0f94d47745cdd18e3661136307a67a8c7a9fa51b951b2235b9212796511c5032f01919722a33331b112db23ee8fac7cb1c13c9fa74a6cf259c5b63d82672f8dab9396f7f41cd417c662214898f952ae76a30c06e73f962b47149680b52e58cce9224ce98919c2f3c055cfcd9fc063155649863ece8182464a84eb9c75fd6a2bab83981602b8072cd8c65f8c9c7f9ef49720c57f3317e376e03ae723352969a6c55896450e0b2e3e620b06e29623246089792067ee9c0fa66a389d64819914248791b8e781f4e9519b88dd8c6add3d493934d8996a2bb8e4255519586490bdfd4fd69ef6ac42dc3491c11a8e5a65e7f0c673f85411491c0c7e43b72386e57f115b96968b79209189280ffb3803b014e114894937732ad6e6d219a35801386cbb85dace3be38f97f9fbd490dacad26e82d2e65c3e464607e3c735d5456d67129220c2e79618e6a8ea3ae790be5445f1d8a1ff00ebd5bb7734e62a4f6ced2ab5c44b69c7dc51fad675cddc51965b772ec0fdf3d2abddde4939624b6186483f5e7355042ce85b78c938033fe7d2a034ea5a86669264264dc5ce7aff004add6621225cf27e63583a65b113093729c7f0f39535b4ff00eb58fa0c7e941b53d8e9b408f6d83487a3b715b1f285e98fc6b3ed145b69d0c6bc61454c64661c1ae85a18cf5916176eec8e79a8b5d72b7da5f00ee98e49edf2f5a811995972f9abbaf27fa469a7d25fe9557d8896e6dada83611363923355e4870ad81eb5a6a47f6743f4a6c70891f91dc8ad3a98b46878774a042b9e00c163fc85756be5c40aa0007ad52b28c5ad924600dcd82714f94bb0daa08cf7ac66f999aad07dc4f18072ebdf3cd625ec36d76d99608a6dbf777a06c7ae33f4a9668c2311d4d465495e077eb4e3142726b6316e7c3ba64d922268989dc4c4d8fc307200fc2b2ae3c2e30cd6f738ce36a483f9b0ff000aebd606643f2e6aa344e0818c63d4d538c59ac3195e1b4befd4e31fc3f7f1c84145283fe5a292c3f20377e950be937218ac3e5dc30196585b2cbce3057ef67f0aee554ab9e475f5f7ad186d2daf5313c514a01c94740c01f5e7eb512a692d0eb866751bf791e5935adc5b63cf8258b7671bd0ae71f5a8abd69b4584716f35c5b9c1188e4dca067a056ca81f403f2ac3d4bc226555112db9da7e5289e4b639fbc46413c7f747b63a1c4ec866117f11c0d15d15c785e48d88db7310030098fcd566f629f363dcaff8564dd69d2da82c648a50a3e7f2df2539c6194e08fc47703ad3b1d50c4539ecca7451452360a8d800e3dea4a64871193409e8ae1c006909c0eb482942e47b54937173c629474a42768eb4aa0ed048a43ba1e080a7351f7cd3ba601e9de98ed8a1b05b92924e29b91ce7b545b8f7a5434ae16b1228e68229178a3713814d05c701e94a18a9cd228c2e7de90f5e9405eec5dd96f4a7725b04f14d20d049a61714e370fad35892283c1a50415228dc2f62215264804d4740248a3607aea3cb0c7ad00e7bd467a50ad483a0fdc71ed49c66853cd2b0c74ef4c5cd6020934dd996cd38127b519c9c5057320624b533243673cf6a73640ce2a12db8e2805cbb164b1900e72714c24a8e7ad49144db77535a338f7a42524b4445b8e7eb464b1a76ca42aa0f2403ef48a7243b9c52f5e69a6588000ba0c7fb5486e6d57acf18ff00815322f7275dc066909e7d6a2fed4d3d17e6bb871fef5576d6b4c1cfdad29893d4bc4641a4c1ebdab3dbc49a520ff8f807d70a6a03e2ad2c03fbc73f45a10b98db4fba452119233581ff0009969e8701243f4a8a5f1a5a0fb96f213eec28239d2674e179f5a4284b715c8378df27e4b51f8b543378e6e483e55920c7539268b12eac7b9daf97f9d30aede3bd7027c6baab676c08a3fdda63789f5c93eeb01f4514ecc6aa2ee7a1a0c75a189f4e2bce0eb7af3e40b8719ec0544d75adca466e253ec7340dd4bbbd99e93b803c903eb4f0d1aa925d01f7615e56f16acce374b30c9f53533d9ea1fc7e7138eb934ac44aabd923d305e5b8ce678ff1714dfb7db48d84955cff00b1cd79e26857d3a2c86362a464126babf0c6953dbef8e300923386ed4cca7526b548d78ff7d300a0fccdc03c576165e18b3648e5b8059b1f7149553f5c9ce7e847d2b9bd1ed5a5d4951872a791ef5e8b6f81807b554628e1ab8bace5bb46be8b676f6565e55b42b1203d001c9c0e7deaf9c3b907f86ab59c81a0080f38a990146dc4fdec66868e672727763db21b3ed5251452191cb1f98304f159d3daec21b19c2ff2ad5acebd98a8efd0d3426674d13a923fdac7e99a6d9b6e46cfd6a29af0e475ea39a5b3941de31d735a5b433bea682ca8179703f1aa9717312860b2afe754648266248438154cf13ba9e48e7140cb31dcb020ee35a56f3b31055f07d6b1d119b1c56adac6554122931175c16c65aa2dabbb25b9a259c205e7a93fa5539e7f2edd9cb738a680a525c169580c750a4fd6b6a7d363874f3b865b6f5ae621932c58fdd0d9fcabafbf93fd0d0faaff004a97b948f3076f2fc4519ff6abab900619ae37527d9af467beeaede121e2e687a486915d63e0d24c99435608f9b1daa29c051c1aa28e37548f65f86fef2ff2aa7369f736f1f992a661382acbce3eb5adae2711b8ecff00ceb46cd77e8e8580618c1047514753751e68238c2db8fdd65c0f5a40cc000bb8f7c939ab3a85a0b6ba72859a361900f6aa41dd23f9186eec241c0a7631945c5d89bc924efda0f1c9cf4a7a9653f36dc0f407351233392c4a8cf75a79909c163c7f3a6991be848583019e87a9eb419141c7f3ef500638215b2dd704d22234849dc3a7dd3da9dc562ce14e08fc49e7348df2e037427a8a873b014c8e3df069ed8910670463839a62ea03872006c7ad2ff0f24b37ae314d249ea71c727d69bb5f24a93f5cf5a5718e5207dec03eb4b852308578ec4d2052ac4e7073d339a6f970893ccd9f3e3190698b6159d41001c1fa530b392791ed4a7a9600e690953853907db8a96c68064306319c8ef8eb43336385e0f714ac3747f2b107d0d22b646d241c75a576568c8a4728a586dc8eccd8a9376f50d8ce07407343a8391800f638a8f2c170a4063df6d3b92480803827f1ed48c55936e7afaf1487279233ee29771c72b4c4232e46371c9ef919a0b3a90303a75cff004a403231bbdf18a0e412c0673cd034c6b19598fcd91e8314c45645c60e18e4f3d2a43b73cb609ee47151a873ec7b91d0d003b01599836c5c7f741ffebd355a5db8dc76f50452aa633bce4750734b8c0daa590f5e7906903143166ea4fbe2a3704f58c1c1e3e6c54328018289a4193d3a81522ef888f3255c1e36b0ff00ebd0dd80568d178c854ea71daa2117ca1930d19391d0fe58ab07041c939c75a8d46d50038383c6051a00c94911e7040ee40e7f2a706460af8c1ebef4e79016da464d350b07c9e57b0c7228013cc0edc0c9f434c742c536f0d9fe1e2a6073923e6fd714bf39c138cd00d8a50152738f538aabf67fde1612313dfb55977dabfc5bbf9d478280c862505baf3d68e80888c2524f9186ef6c8cd411cabe73828588ea55bf98ab8ad861b55947719e295f9259946e3dc1a4518b089840cd23017039552300a923ff00d7535bdc3302f7291c5b3ef103073eb81d6886ea536683e50c7380de83818fd69f6ed88bccf313cb91f683b4b61876e7ad70bbad0c577444a13ed0b2f98648db2cb85c64fb8eb5284115fafcb2189a30b8c73c8c9c9a81ae83a1444761238886d001c8ea7db15705c28394cb2f4218f6031c8a51bdaec695f52081d3c8689a02c392ceef9cfae306977bc8a1adb7a3a124aaf036fa1a7ca16d583c11006418da8dc28eb9e738a48672d05c5c0766ea91ee39ed46ef463d3662adc452473c438523e50c381ee2aa48811bcb663bd768c633839e7f9544b2a23862a9c4659b07db8fd695a367679a45da5dc3018e7eb5496a16d07b8b548563952e1dddf9f2b68ce7af27b54c96b6736d449eea0fde6f3e6c6194f5c723a0aad3486190648f30267079c13cd35e57f264603748a04782771e4f5ebed549825745cbd8f176cb206df3305575190ca393c8aaf0dc6f98805cc6a1b196ca2f60714b737042c92220302b2e51b9dcd8ebedf5a82ded5e291e491894273d704f390b8a4a3ad995b0a9e65bba96dbe62a199cb76c7ddc0f5e9f98aa8ed34a81a04761e5125df24e48eed57710c114d25e7ced2b005506791ce3af1db8a984be4c65248a685f1f2467dbd40e82aecec1a5f6339f4fba1122aaa461400d23fc9b8e38c679c541324705b6c8ce549c330e0e7dbf2ab0d24fe4059231e73e492c0e3d303ebcd53b7581a36568594be09ded91f9641a5b968641023e9f7572f232857544c0c92c7ffad53cea9218dbe6c84520900e7e51ed4a2cee15047080c83912336107ae475ed5234e779f2a4fde00159c8c03818ca8ec7f5aa4886fa2181220a59f7a489f30d8413f8835516e6ce73f29d8c3fbfc54d169f24a1d836e0f9cb1e3269c3476863667c0dc3838c8a5cc8762347cbed90fcc0e492dd6b421bb92df046f50790c790452a15d362b6756197898498e43f5eddf8f5aad75232c0c533e516214faae7fc3149cbb0cd896e9a48b74e4c68c32b2824ae0562dcba4933b228c1fb8e3d3eb5ab7703c661830369b48f87e412179feb54058a4d0bf953140bf7e375c98cf4cf1d47bd67cfdcbb6ba04519741bfbf2b93edcd0f6db23019f1f316dabd47a66a4b4b6b9b58d8c722dc293f757b7aff009f6ab4d0cb90d716e0ab7f092303f01cd2e6d7433920b6b788448e37994f06427865fa7a83fceaedaa89270a3a1719aaed11b7897831ab9e2300003e9566c39b98fd7756f137a7f0dcea5dce147603bd56333f63561c1200c74150a405ce071ef5bdcc56a10bb348013c66b6b5eeb623d26ff0acc8ed1964539cd68ebadc5a9ffa6a3fa53be829a3a0839b18493fc22addaccb14c81949258631efc56659a96b48b9fe106af0216eed3dc27fe846b5ea73f9a3aeb56fb444b30ced3c0cfb715609046de9d2a0d2f1f620b8c61dc63fe046a561f3e7fda07f2ac5ef6355b117908e46307b8fa52496eaa178c75a62c9e510c3aac6c39ff7a9b797a8991b8fcae471e9b73fcea5b60a223ed4539e0035933b8690e3a545777528b7694b9e0669bce0e79e6b58c5ad590dad90aa7e604f5a9ede431cab86c7ae2a01c004f0299f3173b771e78c7d2ac93a68a50cc0673c75fc6ae2a065e47615c799dc491ac6dfbc2c0e33c9c574ba6ac91dac6b2e7760e73d7a93584e16d4da32b961ed958e78eb9aa3369d14e812e208e64073b6440c33cf3cfd6b5aa362338ef5298de9aa394b9f0969b396555922321cbb060ccc739fbce091f8633df35564f07450283f64b39f3d7f7b2c3b7f57cfe98f7edd64b86381c1f5a635a9f2cfce4824b103bfa0aab2ea5ac4d54adcccf2dbfd0a4b47957170aca7e54788313ed942c3f956310194a9e8460d7a56a43329e849ebedc573b77a7dbcecf2347fbd61f7b27b0f4a1c3b1db4332b69515ce3a17ce509c94254d58e0d53bdb531bdc298d0ccb92a48ebe95cdc9a46a72f3f6a2b9f43fd2a2d63ae8d7f6ab44f43af2067ae6a51cf1cfe55c6af87b53902917f8cfab1a0f87b5255ff00908367fdf3d6a6d634e6be891dabafa8ed4cf2d493923f3ae38681a867e7bf931ece4d09e1bbd70cc75064c772c49346972ad35d0eb6488275e9ea6a35dbbbef0fceb937f0e5e3120df3b0ed963cd27fc22d37fcfd1a9b22973db54760cf105cb4c8bff0214c1716fcff00a447c7fb42b923e156dbcdc313f5a3fe1146c7fc7c73df2334c694fb1d69bcb455f9ae62ff00bec547fda560339bc847fc0ab981e111b54b4f93dc0a3fe1100c5c9bac607191d68d05ef763a46d5f4e1cfdb22ff00bea906b5a610737d10c7bd73d178395dd435c8009c124f02964f082a4cc9f685214e3239cd1a03e7d9237cebda40196bc5fc8d42fe22d1d7245e023d31599ff08cc4d18124a481d80a8c785ed81e5988ec2992e352e680f14690a799646fa2d44de2ed3037cbe61ff80d403c3166463903d8d4abe1db08c0cc64fd4d1a0ed5069f17d80ced8e56f622a37f19da03c5ac9f9d4e341b043bbc9cfd6a4fec8b42a185ba7d319a7613525b940f8d149f92c987d4d0de32765c2d80cfa96ad14d32d51b9b75047b5585b18368c44807fbb487cadf530c78b6f070b64bcf426987c4fa9b7296ca3e8b9ae8c5bc20e44683b70280a89c0551f414ee3e577dce65bc43ad483fd4a8fa2547fda5af4a7e5439f65aeaf6a9ec29e884a960a4aaf538e052b8f91a5b9ca35ff88d94a6f907d074a85a4d79f3ba597eb9aedd02fa814aca8011919cf4a0496bb9c21835a9382f3fd3269ada66ae7a994e79ea6bbf52d3bfde05b18eb8e29640517b60724d3339b4b46ff13cf8e89aa6ddc524e7d4d0340d45faa3577be606e841ee4d30c918eaea3ea714ae5282eace217c377e782a47d4d397c2f78c4e71c7a9aed44d087e65403dda924bab54e0cf18fc6840e303918fc2b316cb3a7ae09ab12f85fcc652b84e30406cd6ff00f68589ff009784f7e6a33ace988fb7ed4a4fb517b92e10b98f1f84531f34e06067a75f6a90785612799081e95a2fe20d355bfd77e38a61f11e9ffc059c7aa8cd03bd3891c7e19b253931ee1e99a98787ec539f2ff0cd46be2ab1e0c6aee0f1d87f3a865f14a727ecec8a0e32fc734589f6b493dcb5fd8b62a46221fcea55d3edd4e444bf9565b6bd390f8b5230010dd78fa0e6a26d62f5a508a8a3233807e6fc8d2b17f59a4ba9d02db5bae0f9499f5c53bca8c6708bf9572f3eaba946caad208b233b5d704f1ebd2a97f6aea92e76bb00a707cb01bf3345990f1948ed9e347c0600f7e69ebb4285e303a0af3b9b56bedb917249cff01e7f1cd442ff005099be6ba94fbeea2cd11f5884f647a48da4e14d5cb3b87b0984f185f300214b0ce32319ae4bc3a67c1324ace0ff0078e6ba62492a9f89a19a42778bba3a2f0e44c6692e1ce49ef5d743ce2b0b43b730d92e472dcd6f41d3a568b63c29be69366c69f8cf5ad06019483d0d645949b1f93572fa6f2e0cab61b3c53688bd89d1d93e57e9d9aa60722a052b3c08c3f886690ef40006e295ae3bd899dc20c9acab86139f94f073cfd6a69a40cbf3c9cf50076aa4d3296f94f6e942560bb294d6f81d6a38e53131c0ce6acb80fd49a8fc84cfdee7deaae2b0a6ee5dbc3003e955921f32567fe23deac18c6dc52c1b636395fca9363b0f8add81ce01fa55a0eb128dc36fd78aadf6e8e0e5c363b0c66a19753826e3763d88a16a0d105d5d65c2a8fba3f526aa5fce7c9e0f05bf955931433b7c8c371f4ef4d9ecfccbe8ad769c601357b0ae548a3616237f05fafe35d2ea327fa04447423fa565ea502c516c5180bdaaac3a98974c8ed98932a330fc3b542dee37b1c76b9f26b11f38f9bad76104c160439eaa0fe95c5f895f6eab193ed5d3db48b25942c3ba0a72f887d0b6f73f30c1a8a59f2319a83746d2152c01c74f5a5d8587029db51b665ea64496b2f1d3e6fcab4ac401a5a2e7076d53d410436b233900118a912658e0450c080a07069a5a9d141dd58c9d622cc41fa6dea7dab0434527309dc3d41cd755768b3c2ca39c8ae41498cbc0e55361eabdff00c3e955b8f111d993a0c3ed2402738e3148f23a15d806d3d703bd0b1071f3156c720fd7eb4d3bc618851bb8f949e9e87de91ca3f6b64b7cc38e73daa05760c5cb3b67daa6f318a8520e4f427bd33cc4126d77393ea3d6840c542b22e03024fa9a71c20006463b53b384dd9e7b1c75a1882c00c13dc1383405c683bc641e7d319cd28907241c63b77a376e407201ef81d29c58f20fcc3eb4c434cc473c907bd465965ddc67079a90afeec0ce31d0f5a6451b6e3bceef43b714ae3b0c572a0fcc4f1d1b34a0f7c2834fc7a8e7d4d4413370b273c0c60375a2c81364a7a76c1f5a5031d028f7a525d718c11e94d2e149dea79f41c51615c4036b64818a6e32e1be61cfaf1f9538f20ed247d7b534127e5cf1ebd29d80539ce1483ee6940dbc900e7ae0e6853b5f28e723b834c2584846e2a7d4d2024fe23d85446642c719cfd29de6673c64d315d779db807ba8a6343c6e65ed9f5346fda3e66c8f4a6904a8c023f1a4248555c7cde940ac3d1919fb818e46294853920f1f4a8fef0c32f5f4a4c39230d85079c83cd2602b6d675ca29207523914c6890e412197ae08a90e402557349d40206d27b1a2c03630d8e8a47625a94c681833ae483c107a52b842cbd463f234edc1b382bd3a6290c8dc072570707be696352060e48ec4f7a085207cc3a74a427671b80e7d698ae2305898e0e33d698c59df6e645c7461d0d3b02424e7a538290dbbb7a503b88aee508620b7f7a9ca4ec2ac549a82e04a5488e42b93d0ae4531629bca259d58e3e94012a861ce471c504b679420fb739a6c72129e5c830c4743cd0afb4797b1830e841e0d00625d4be5c51a20f970083d4ae73c7ea2af2298acd9d376f0b9cb13d4f5e3fcf5acf9b325d2855f9d8e03b0e40ffeb5598ae655ba0c4865cbac8adcf278c63f2ae19772232436de5df3242aa10c4036179c9233fae4548631f680f22908739f573e9fa8a645b12f249c8cee1b4e3a03dbf1e298acc259c33337cdb971d47d2a1db99798d6c2dc30ddb42990f1b4038e7d334f67fb346b14a9e5ece30bce49ea47e95148adb636d807cd9f71f8524851ee492c1994867cf600e71f4aa495ca7a0f786dd7ccb867ca6dee3938eded9ab0651e5f9a5002e36807f840f5f7a6ce4472000932ce72147000cf5c7e3c7d3354269c9b836e9f337dd623804fb7e7459ec85a21b2cd219e5ba1160e33f313851ebef4cb7b66f3636575083e673b79269b764c7b6367e3ab8f5a625dac682042370e33f535a25a0d22e79819a41165948c3100f3dc7f2a956e2372d6491e1f672c1b3fbcf4cfe955dae7cb2b0c6a42601f94f04e3daa8b4cd6e58c720187c2903924f269f2df70d2e5b9ee4db4f6eb6d19023e4e3ab355676393bae18123e646ea4e7b9fc2997481e467076977385ec79ffebd588ade3f90cf1a2ee0583ca7e5207a0e334ecc15ba8c32ca8f196642c4008339c9f6f5a9a768eda691d95657c86f2d00f41f79bb7d05354c71e52d164190774bfc47db8e83d85594b7b79ede14750ad1b1e3041c11df1d7a54dac1b94def9e54511c4c067808071f4156a096f1a20b1c386ce77c9182c3f3abd0fd9adf0aa178e9f2f5a86f358896228b1ee3d803d3eb4f912d5811b44db0cb72e1877dfebec01aa8668a56112bba9624a9ed8eff00e7daaa3dc4b30dcee739e99a20b69a67594111c7160b3b7dd033dffcf7a9696c32edc2aa4b0073958f3d47ca7a9e7f134c81be45887219894ddf74f20e3dbbd585b9b70ac2d40923924f9998e4020f4c76ab72f972b34810c12eece01055c7a8f4acfe1766277e82bdc096484ec66f2e350a54e482320e7f4fd6892dbccb81716e1772918c3056e7b60d28790a3b2b15f97180dc31a11eea40c240ce88bb986781ce0f07de84ac2727b086de470655430cdb8646de9ea714f5924703e552463273b73ef51b8b98e54c5aaec3860c18e307dfb1f6ad3b04374e5646caab7270327dbfc8ad524f41c536cce96178adc3e18c4cdf29639e7bf5ab9a5a8374bc739feb5a9adc3bec61eca8dd07b8acfd20037c83df26b58c796563a547960d1d4f95b9b8fd6a48e1da7a0fc2915be6f6ab1190300d68cc17986de460f3506b52affa2ee3cf9cbc7d48abcc57038e7d6b9cd7a62b730aff00d378bf5614afb0a47a269b6f19b05c2f2063279f6a86ec88ae613d02631f9d59d1d71a6ae4e48247ea6ab6a4a1f7a83f3ac7bbf5ada6acee62b7b1d469172246b88f3f766908fcff00faf5a5804572be1ef37ed7713f1e4bbb953bbae707a574eae703a5652dcb23788107e845665c44249f69e14eee7e9c56d004ad569edc7240c9f9b8f5ddd6a4471f7aecef3c7d42c0c3f2da7f91ab22643232c8a4742bf98ab371a75c166914060e854f19c02a07f4aaff006699b1ba33bb183c1ad94ae676b092445ede5742542b01e99ce6ae5bc4df6746276b150703deab325c08cc6a0856fbdc7b55f82491906e808c007207b53b8588534b105cc774262ea091b48e49f5ae82da40557d7bfe359cae3cbc376191f8d4e8a08041382718a892bee38cac6934a8a704f3e951eec92c6a04c0c77ab08a0a06f519acec917cdcc44cbcee353a7282aade4e9044ceed802a3d22e5aeacda46181bd82fd29b5eedc98ee65eaf0af9cec0e0e3247f9fad73f322ab9f9f38e2ba0d49c349290d9ce71fa0fe958730cf1b327a7e357162b1ca6bd008ee926030ae304d63464ed284f2a715d5eab10bab39171c81915c996d9303fdf1dfd475ace68f472fa96a9cafa8db89d6d2333481b66719033548ebfa7291ba7c60fa1abee8275785beeb8239f5ae3ef6cf6bb075f981c118e959397467b13e7b5d1d12f88b4c209fb4703da9c9e28d35166557565906dcb2f4f71ef5c68b4025180083c648c91f4ed9a63dbb46b1175f9c9c02ebbd89f6dbd3f1aa567a9c353135212b491d79f1169be513e6b6e0781b719a8ffe125b1504b3381ea462b97fb3b282d270430ea3ce239f41d3f1a7b5b2b19447c3e32029f318ff00c03b52b0bebd2ec750be24b00a59cb05eb9a51e23b0650db9b681c102b95fb2af9f86651294c94dd893fef9e952476e3f76cea048c38df19321fa11c0fc68485f5e93e874c3c476054307623e94f3e21d3b667cc65ff007862b986b5e13f76c5836395f35bf4fbb44b6ccb6f9504b6fe42e253f976a7ca84f1b26744fe23b00b9dec39ea4629bff092da229203edc64923b573de4af98eaa7f7847dd46dcfd3b83c0a416fbee718218a9e181dff9fdd14b950d63a7b58e807896d4a8daaed9e98ef4cff848e260088982938c938fe758cb02218890b9da72c4798e07fbc3814e5857ca46505b12007630988cfd7eed2b09e366cd5ff84a23524f90c8338cc9c66a36f139c92d6ec140eb9cd669800138842f98181c44773fe4781f850f0b7da645451e61504951b5ff0013d29d8978b9974f896463816f9c8e39e7f2a913c552c4aa16d9067a6f6209fa0aa1e4fdcca12c508621779fc641c0fe94cb68c4a176acbc31044589077ea4f4aa4653c44e6accb93789ef1865a158c1fe261fcb150b6bba8aa1395451dc727f2a82287e76581816dfc881f047d4b71f954925b02b328d81ce33f294fcdfbd3628d79c168c5fed8d40b95f37040ce3f88fe151b6a9a8860af315cf38239353245d558b11b3b00c9ff7d75348b1aaf96501da7aac4df2f4ef9e69590de26a77209353d4485c4ccbd800339fca989ab6a651a35b89369c6e0873fa55930465131b31bf9033081f527ad44f020491bef203d641b107d08eb4584ebd47a5cacfa85eb395334808fce9c2eef9db67da240319e7fc47152496a8419003f77209c143f875a2da33b23f9f726de7e6d833fee9e4d01eda7dc6a4d7fb1192798e4e0ec3bb1f53da94cb7d22fcb77239ce088e4cfe79a9b60db16f2a3e6e3cdcc59fa01d7f1a7bf309331242b8dbe7a640fc168b92e727ab65426e577832c840ea0395fd4f14e78a7dac4c926ddb9c9ced1ff03ab32a48dbc0dec9b7e550c1c7e09d69fb1167280e1bcb0402c55fe813a0fc69073cbb94618279bcb20b989811946dc33ef9e69a96cfb038398c3904abec1ff8f75fc2af20c4d6cd20f9fb0910ef3f4dbc546b32c8c230243224b9f9c79c71ed8e946a0e72ee567b5d892312154498cc8a6307e87bd4925a61642c8db0720901939e9d3e6ab465def70b183b83024c4fb98fe0dc0fc29ec76cd3bf47d9d402aff8bfdda7627999485b2b3ec5618dbc8071f8796793525bdba19214711aca4e17cc0c8e4fb01c7e757137ed57f9dbf77f31da1d71df3275a645b945b3c63f70e48cc127cb9e7aeee4fe140ae471425e64dfe61db2edc3c6b31f7e9c0abf044cde68b54f9d6405bcb932dc7b37154947084f951812e3e6cc03ff00b2ad228220eadb991b1ccb1ee527db6f3f8d2016582312dc6e558d8a839da63607ddfa7e55218bcc525833a88b38203a7d4b753448c259264c92360c056ce3e886a7dc8b242ad8593cb201236b9fc0702868467cb6acdb163da136e7e47c29fc1b93594f6c914b9631a027832031e4f7c01d6b6e79d5bcb3216c8ce19d3cc3ff007d0e958f75334287cb76da4e7f752798067d73d2a920d5e867cc0c931cb48db49e1c8e3f2a916309246bc82e9ba91572a38fae6af2849a5b6217f7811633f81acdbbb3d1852708251dce8b4480a5bc608e7bd6f5945f69d4113a86703f0aa36aa22b7cf602ba5f0b5979fa8a3b384555ddb88ee687b95567c949f99d9a5a858d02f000ab96f06071fad02c0ede660c3b107ad5b82d3cbc6d6c8f7ad3a1e38c10f273d4d36e226619278cd688b5dc3249a9521441d33ee68bd82c64c332db8f94b123d7a54725e3c8482e4fd2b6cc50f744fc8531becca793083e87145cab18cb305e48c934c48b272a84fd39ad837164879b8b753fef2d42dabe9918c35f423e8c29587a9485ab1ff96727e54a6c256e9137e352bf89b468b19bd53f4c9aab278d3468c1c4cedf45a767d85cac9c69d707f831f53522e9b3a9c809f89aca7f1f69abc2452b7e955a5f885028ca5ab7e2d4598ec744fa634b1ec93cac7d0d53ff008466166cb4c73fecae2b024f88e07ddb641fef355297e26c8bc05b65fab52516b61f2b676f168f6b6a0944766c7527355e658ade6690c3fbdc70c4e315e7f37c53b800e27857fdd4cd63dffc4896effd6cecc40c0d898ab4ecf560e8c9ec8f47bab992e148c2e3dce6b0fc94824791ca2f3c61abcfdfc673b8f956623eb8aa72f88aeee3a46fff007d134e55225470955f4373c53768fa946c8415dc07e95ad6fab5bc5a7c4be6a06518233d2bcdef62bcd4250f209542f40ad802a26d3a66e2591987a1909ac65515f43aa381a8f73bc9fc51a7da4be63dc4791fed5447e215bcf98ace1699f1f7ba2fe75c4c3a3db67e6084fa05c935b16f6c9111b6038ec4d353bec86f0493b499a926a77fa8ed9261fbb07276f4c56edb10f0aca84956e84d645a866232c7a63d2b4a1252231a1f949ce3d2aa2deecda34b93e145e40594906b0ef2348eedf76cdafd54f735b10332f7accd6ed9662255518ddf3293f2b7e1569ea4578de2ca12a796db93a01c807ad09ba54656fddb0190c0e7351a33ac98d9f263d39a7918dac0346b9e411c536798c448dc280f2862464e78cd2ecd8a4b062de80e69aae4b01bd739e8a791484b973c381eb8eb420639c941f70907ae4d35e346c31f6e73de9cd2143b77139ed432860a096c7714c426dc29da71e993c1a6ed700a808a7a9c9e0d3818c6e42e001fde38c52a6ec36f2028eec383f8d0029538e0fd45001030188e69525caf0c1d7d50e7069af8c6f1919ee453603406e438e0f707ad3bbe1783da86f9c707231d053371c6e25c1f7a0371c19be662bb7dbb1a648fb632cd1c99f4539cd48a7df39e7ad0c58839c01edd68019180060b331ebbba6298c770daa594ff007876a93cbc83fbc63e9c628fe208509e3ef0c0c501723ded900e188e0eda56daca49f95b3d01a7323f1c9208ea290ab01c31c1ec68b026247863b783d39a702a060e491405ee39c8a520ba9d85491d78e9480889dad9dd85346f5dff007883ea053822b60e47a9a38edc1f5068b81197cca14e7079ce29e4b71803d33480124ae437a1a509b4e0e3eb4ee2d066e6f33871eebdc53db38f9867dc504e5b8c9c77c6294303c1383d8f6a0637e5201ce47638a8b73193ee9dbed4f66db8dd8c1f4e94c0e1652986208f4c8a431c62cb03b8e3fba690ec56dac71bba7352a9f994a727d3151c9187392d8c1ed4312d4082a0ed008f6a633328520e3d9875a97865c1ea3be739a47c94e0803da90c6acae532e31f4ef51ee51210411df24d3d1d1832060c47a0e69301572df4c1e698302e4e76c59f7e950f96ece448a541e41cd491a0032bc0f4148e0b0c8c15cf3da815ccab72c51de45c796bb9b271fe724d3627649599bbae4edc71effad2fef2d6da59446db080304f5e7b544651f679e6f28294451f7890727bfe55c8a24a48b5b4436ec8390ea720638cf7ff003eb55ade5daab3156dd9c0c1eb4d372ab148a463637191d40e9cf7e4fe954fcf2aca472a72a403fe7b1aca7a348b5b93c93e70646270dbcfb7d2a782457135c3e5b61e9d016ed54408b723163e5e3e5e323f1a43247b42ec9644ce703804ff00f5a922668b325c34be63965dcbc0c9e4e6a188db9b84424b4af81f2e70001c9f6e94aeae06121b742ad921986e19fad325b99d2da57f3a621bf728a836827f88e3d8719f7ab8dee2b5d6e53b89d2e2462432a93b8051c9aaeaff00bc75079f52338a6bc53a90c54819c804e33d6925b72d2b6d75ec71eb9c1ff1ad4d516629e5f276798c3712af8f6ed56d95da28f7302aa30571d7a55586c0215f35b6293b82007737f87d6ad4b23a2958cb0c74453919f73deadad05b92473204467cc85864295f9547f5a9331ceccd20de3b63238f6aad6925d92c0bba0cf1838cd6806b88944acff2f62fb6b395d8586453ac476e4ed1c06c7f3a99af0ae19093c71c75aab7ba82b284500fa91cd57578e648b7921b770fdbaf2a7d29297460c92eef6572c8ae77301927031ed54700a0dbd86e34e999da46693fd63392707839a6c64a4bd7041ec7afad17d03625b6b67bc6288d838ce7fa7e344b6ceab8967ddb4ec5456e037a67a55db640892cd013be5ce1473b4938c8f5ab5259b95dcec891c44942c40cfa9c0ef914afa037a94e3d38dba4d26d2d04a00d84e486fc3b8ce6916dcc4c836896565f955beeaf383f8d5f90a4cc23b78cb3750a38e4e39fad44d1bc73c70ca366189d8e300fb67de96ad92dd8b774de55fb46b8c2205c3f424281fd688a499b7950a04802808a46ef61eb54a4b8b4e5a791a36563b9b7e467d306ac41f668af44d2ce24454dd9da07ebdbad0a0fa93bea2b3c87685691813f329900079f6e95bda406f29cba6d3bb005734b1cd1ac724411524e509e7033e95d558809080a780064f4ad29269ea6f45372d4b9a8406e34e922e0160307f5ac3d28edbf6078d82ba31f3c4a7a9ac4309b6d567c7dd701c7f5ade4b54cd67a268da49aacace300d64452feb56c1e01141ce99a22e148eb5cd788e5ff004981bfe9ac27ff001fad5de17a7e7581e277c794e781ba3ffd0e93dd09bbb3d73493b6d191bb39cfe7ff00d7a96d6dfcef10465d330bc5b1b3dfad57d206f8663c91b8ff00215ada746cda9c240c6c899b9eff0030ff001adaa6e6497bc476568ba7ead776877246ecbe4b7be323f3c115b8ac319a7df5b0b98729b44aacacac47a1ff00027f3acab8b8b992cf30656e51489159b0770ee3d738fd6b05768d2563595cedc75e2a2777049721467b9c57157779aa066566bb0370181bba119a5b486fae5374d24eabdb20935a723dc8ba674536ad6b027cd329f606a9b78820e42153f8d241a3e95126e96da5b8939fbf9ff1c50f1f416fa72a81dca01fd695df61f2c50835a6084ac7fa534eb92e305314ad6d7122e1a309f4c0a61b22148cae73ddc5525dc9765b1646a30845f94938a6c9ab90b98a228c39ce73fa5546b2900ca853f46155bfb3af0063e5b29208f9be9eb9a182b1b11ebec8a3cc851ce7a8cad5b8fc436ea02b452c600f4c8ac55b498c2c926ee8769caf5eddeab1b3bd463868f1cff1f5a8b36f62ee8d4d4e74d5a206da5c303f71b8dd56f4cba167a64c927cbe4a0041fef92491fa8ac18f4d99e45f9d43770a6ad3db48502124a8f5355676b13a6e8867ba26404673c55691a590b1de491cf26b4d74f7751f77d7351c96a612d95c83df342b05b431847bb21ba1eb5c56a909b7b99531f71b70fa1af4392d9d7242f7e99ae5fc4b67b5e0b823e573b1a94d685d1a9cb24ce78cbd197eb54755b5dceb305c061827dea4858ab3a375438356e6027b1c752172335cb25789f534e69a4fb9c94d194257b76f7a6c516201e5ae30e370b77f2b19fef13d7f0abd731e4703f1aa246e46465848c839953701f414a12b3b339b1585738b7d50d962256758d5061b2485300fc5ff008aa568caa3e43184c7962576464ffd751c9a7c9922562711900aef6f314fd22ea294902e02eddb298c725cac87dc4278fc2b7b1e28cda3ca8c2976836748886847d58fcd496c0cd6d1888613760fd9e4d89f8eee4fe153bc6a64b669da38e50bc1b95d929ff75578fa6694a9f2636994e449f7aea3129fc36f4a40578e348e321595807e4ae601f99eb52dc20368accdfba077618ec46e3bb7534f9a1223773b89de3ef1f3c91eca3ee8a9d94fd958076ddd7e41ba4f7f90ff002a188a9826163b58c0b1f38c1873fccd3613ba088a6ef2883bbcb6db18ff00809e4d3ca91788339999060b9db37e09d053db1e7dbf9fb449d07da53f79f86de05032aadb45324401deaac436c3e4afe47ad4af1048b0c1446b261566530a0fa11f7aa48d4ac4b946dc25eb2a0b86fc36f4fc69240b2a5caa6edeafc08e432b75e7e53d2801d2c6ef1ccb2b30806194c98f2bf0c7269a54871e582f118c743fbb3ff00fbd52c91a0b8957e559ca0242b1137ff1228116c9a22062464e0b26f71ff031c0fe9405c863dbe540c546587cb96308fc13bd3248556353301b0390bf685f2bbf60bd7f1a9a2f37cb884619d95b92989fbf727eefe14d570b24be4920abf26de4dcc7ea5b8fc0530d88b854998a9650d9ff004840ebc8eca39fc6a5642599b711f20c7cd9cfd22a11009ae0295121c1f90947fc5fa7e54f0aed290d8ff57c964ce7eb28fe94086285373165806d9c338d8e7e89d053e7f98c4cecdb812019977b7e1b7a53a003f76a84946041581b7a7e2c79a8e351b4344572adb5bc97f2fd7a96fe94c0ab3b4c18ec05be6e013e6e3f0ed49160b4dd04980485397ffbe4f02aeb20292e557606190ca61523ddfbd128902bb10c6d8af5650621ff0002eb4ac034a248ccacb866507e653bcffc0ba54296fb444c770249fe1f34ff00df5fc356e15926814c59f28af3b5f09ff7c9e4d5752a0421950e09e4e601f82ff153b05fa091c65171196c8721bc870e7f12dfd28541898c2555d5867ca6dadf8b1e3f0a7c8998b128c287e0dc47b57f02bcd3a42ca1d76b9538c0940913f041cfe74ac1716545cca37229651d536fe72f7a005dea119cc663f9b67ce99c742c79349bf7cc481b5f66d003e0e47a4678a1e16f360df88e5da7fd62e1f3ec178fce95802dd11a2b748f805ce4c3218d4fd7775a8cdac51c6cc4ae7ccff9680c03f4fbd5616291841e66e691641cc8a26623db1f769c209144ab11dcc1f91149e6b01f46e94c2e40f00f26691c1319ff009ec80c678edb7e6a90471a92a4b6d68c1c2b64723b4479a905b9334f80a92e067cb62927e24fcb48f03f9859f77faac9253763a759853b05c8d140780ca63498ae007cc6fd7b28e3f3a73a9436fe6248ccac42f9f1899c7e2bc2d2c29bb6188bb0e777912078c7fbc5b93f85471a84857ca78c7cf8cc4e6007eb9fbd480691208dde277775986562904ed8f707a5598a64cdca0645978ff56c51c7fbcc78aacdb522717423d9e60399a3f2d3f02bc9a74efb92e4b6e68ca803780f1fe0bd7f3a560346728cb21c1e23e58af1f8c829be6e5632a3e40bff002cdf7c67f3e4d514bd3e76470e63e36bed6fc23351497485a0690a2c98c11321127e18e05348341ae19940124623cf38262fd0f5acf645f38ed66207f790022a7b9b89bca52e58156c02c04c71cf71f76a08536e79ef4a6ec8e9c2c39a772658c9edc5696916e24b9dd8fbb93cd5053839cf51d2b7f4887640cc78cf19f5acd1e8d495a3766897db6a41efd735a76fe224b5dbe4cc85401ce2b227cb43b17deb9f5d2eee47fbaa79ebba8ba4ee655a97b4a71b33d313c6b39036c8303d16ac278f6e221cdc1ffbe457987f67cc990f7289edbb34e1a7a67e7ba6207a2e69fb46cc56063bf37e07a54bf116e0a9ff004a2bf95664fe3d9e4241bb94e7fdaae34585b9c9df3373d80152259444604531f7269f3b2d60e1dd9bb2f8c6473932ca7f1354dbc4e5f3fbc739ee735516ca2dbff1ec4fa92e6a68f4f88e088231ec450a521cb0b05d191bf889f9c21e7d4fff005ea26f10cec7013f335a4b61c82b1c40ff00d7314f6b0990b0ca83feca0aaf79994a14d7431db5abf7fb8873feee6916f35690676498ff007315b4b693918f34e29cba548ca73293ebcd1cb2257b3be91311d350946647907d5aa26b59f387b851eb990e6ba65d163e3796233eb52ff65da051b50e7b934283bea6bed6db44e50d80c8dd70cc3fd904d4a9a7c0c70c276fc300d7522d2255002f352a40981f28a7ecc5ed1ef63941a7202365a3b7bb1a9174b998645b44a3df39aeabcb45a7a2a632d9147b341eda5d8e6d34b9f183e5a7b84ab4ba5498f9a5639e3a62b664c2b1523eefad47bd40e7a83d28e4894a5564658d1a2661bb2c49c0e69dfd9b047f2ecfae7b55c697a91c77c8ed50962cd9dd9fc693e547442137bb152d618c670054bb21c0db8a8e10af305909da7ad493c2909cc6c4fa83da9731aaa0adab141407f1a954e0e7b553f3235196707f1a865d4638d72873429a0f676d8d769d624249aae1fcfb19646e5739c7d2b0cdfc974db3b7b56ec901b6d21016db23f03d7355195dd91cf5a3656664a6e6918aab10471ce6a50ee10e7071f79739c535039c2bc9bce39603193f4a1c36edde6956f71cd6878af712112163b996443f73e55c8fc452aee0c4ae307d074a8f0640774997fbc0818148c0a61dcee61d4e703eb40879dcc72467f0a1194120b8e7b54426421955c31c704714a14478caf0ddd8d171d87aaaab9603ef0c11d454460877e37e518731e32323b8a7852a490bc1f4a6ba9dc085719fe21834ee2152248b2538c1e76f1fa53dcee460aa73d73eb4ddaac321d59bf5a6a6e2707723019c9e94013a3a950a00c7714e930178fcb155c280d93b7246491d29c5c1c1e869dc5b0edbcf1c67a8ef4d219467bfb0a648ca46e2391eb4884326fc804f51d2818f5660c5b771e99a62f00e6476c9e013d29e30c48dbcf720d34872df20423386c9e7140893ef655581f6a605900008e7eb4ac08038271f9d0ecb9084a863db75084232ed5186c62936ff0010fc69541185048fa9a613b70c4ee1ea280164c0504a923da9bb5368607683d8714e2c5972463fdd3c1a03286c10c7eb45c643e5ca91b6d7dc739049ede953060ca38231fad0a0303818cf623a5336329c8908cfb6452bb1d9121185ee0534f0376377d29997cf24647af152027001c03ea0e451710c789a55f95f6b54661c608393df06a67519dd8e7d41a8c32a31c8241ea714c0785fafe34c4277947208fd695df0386e4f6c66970a403c64f5e6801ae360e3bf714e5c88f6ba8cfae2914afcc14e79e4668271c0269582e26d5e4ed008a8a45909dc5063b8dd5613032083edc5464e5baf04f422980d8f39c29007719a798a407284328ea3a54795e586e0c3b0ef53a9564ceec13eb480e5a3914aa4a18246df2a83ce1072703d7a55db8ba896d122982ab48092b9fbcbd891ebed5cfbdeed36cbf26157e605777539e99f7e9ed4fb9432c16f2b9331327dfce08c91818ae7682ddcbb73089655605fe5c02c38e09ea6ab32222925f3cf03a76f4abd2ccb1dbcc48e6493c90b9e800fd6b2412c3cbea738273d4e324d62f7d0a5a3d45491c962c19a10db4e3b6695216cc888e5581c163d47d29b6c1c398e36dae18e307a55968e32cc4c9991465c46ddbf966876225793d08fcd42e6358f2aad8937375f7fd2967513a03e695441903ad4c652dba086d59c3e338c1e7df19fe7562281a0de8e17923e51ce6924c7ca66c6af72a105bc8e8b93bbccdbb7f4a9196049985b44db8f3bdf9c1f61fd4d68dc464945c6213c9c71cfff005a97c948b6f96aac7ae5bbe6b6ba4c13b914563344e0cf92dd490c79cf3d7f1a9e38624e8a07a54f7129fb430d99000191df8aa1717891a30c3991b8ea063eb4b987b979ae62b24de891cb2918daddbdeb0ee6ee4ba94904a01c60b703f3a86493cc23272d8e71dce69a0601ddced3d0d1b8ec81e3f971b813df3c7eb5a16525bca8d6cc08dfff002d5791baa05818b07fe1dbd0f7cf7a68b50640c5fcb556c9058f5f6a1c7b8a57b171eda686690a4514880654b73cfb0eb4c78adaee6223260bcc6e28cd94e3a807b54f2cd05ba8de58bb3677a12003f5ab56737dadde1bb11c658fee9d80c13efdfb7ad16d2c4a77d48208e50770846e400649f947f9f6a967767022dedba41cb8ec739e9f5a915a192cc99653bf95d88dd0d45029de42cea1739249c1c7a56524c39bc87dba5cb46d02412c31a9e5df866f7269c66431bc24bedc6f080e7381db3d2a493c828b9336c638c16da3f2ea6abdec9e5c01c3b2b1385279249ed42d015dbb95af120dea60215645e1a4e7ebdb231c55367b498a798cee0a649c900b02401923a74a64af330705b76d3f20c6307b9fe5568a4621b72d0e2603e6c3705b3c71e95b6cae5a1da7b4f2850abb0b1e180ce07e35dd5ba058ce7d715cfdb5b0b59220d0b6e98ffad20ed3fec8fd6b6e27cbc83d1cd5d3ea7461f7b1a914882029fad62eb2c22549f9c83b57079e6ae2b30c0145e40264f2e742ae3901856b2d8e8952e639d5d6bcb3fbc8c91ea0e0fe556a3d622958149b681d43553bbd264427cb6247a119aca92ce48c9dd0e71fdd18ac5c9adc3ea49ea8eb135285fe533a66935216d73a785692367ce4e0e71835c6b4054fdc9071fdecd187236f992e3d292911f5291edda5f88ecedb4ef2e4661e61deaebc820a81fd29b36bd64655649a7070412bc7a7bd78e5b4d776e8238277451d171c558fed0d4437fc7cfe607f856fed137731961277dcf6883c516b1e774d7039edcd4d3f8b74d914031cee40e09033fcebc586a7a8938375ff008e8a77f68dff0003ed673ee83fc2a9d644fd4a4cf5b3e2bb451944b803d430140f1459ed52f0cacd9c92587e55e45fda37c7fe5f4f1fec0a68bebd3c1bec7b95ff00eb51ed90fea133d6a7f14da39cac13ae7b0917fc2a31e28b507fd44a73fed8af2afb7df1ff0097e3f4007f8521bdbd38cdfbff0085275920fa8cef63d6bfe12cb71d6dd8f3dd87f8548be2fb6dbc5a9ffbf9ff00d6af215babc7ce7506e3fdaa9236bb27fe3fa423be58e297b643fa84cf58ff0084c63ddc5a703d64a89fc5499c8b6c63a0dfc579687ba43ff1fcfd3fbc4d3f7dc63fe3f9ff003347b643fecf91e98de32900e2d53fefa34cff0084b643c9b68ff124ff005af3625cbed6be67e7823268116e049ba90f1d81a3db151cbddf53d23fe12c9c72890a9fa531bc5d79b721a1fa102bcdbc819ff5d29f5eb41b68fbc929a9758d3fb3bccf481e32bb4529e74033ee38aa171e2cbb66cfdad40fc2b8236b1671e649d3d290db4640cccf8f75ff00ebd47b6d6f636fecdd3e23ae97c533b0ff008fb1f5acabef1035ca9592e37e0e40cd619b35753b24623bfc94d7d2a429b96e139e40cd3f6adee8caa601415ee68da5d7da662cadbcb1393ea6b5637e3685e53922b9eb081edb6027e6073d315bca368571f788e47ad4753be95e34d1427842bba8070391ec2b3648ca72077adabb5caa480727e5359d711803d735cd2d19e947de8dca8361326551999492110a37e32e78a9a3dc51768382982235f357df74bd56a1380ac0b617e991f88ef4e89049f67937a306042999fc8f5e88bc7e75d5097323e7f1d43d9d4bad98fb772d0c22d8b6dde438b59048bff022fcd16ee11245870a3ccc1168fe564ffb4cdc1fc2891310c5f6b299573b0dea76ff006427f5a95d9fc97374efe49236bdc2ace9ff000145e57a77ab38acd86d8d0cc995c920fcaa60e7de5ef53cb1eeb3918ed65c724b7c83eb20e6a192001249cb8f23cbdc1c3eecfd223d3e957a111358abacb1925720b61243feeafdd1f8d161d999b08deb03a6e640a54f9243c7f8b37cd50a465a28de350a8b2619617f2d3f1ddd7f0abf10b69fc8b99245c8279bb4cc8319fba1381f8d4b34902dbee9588db2e57ed256e588cff0e3eefe340f9657d8cf789a38a46daa8be60f9b61b607fe05fc5566e2290c13b94fdc6d0433a8111ff818f98d68bc96b15bc92b4c115c831ba4867627feb9b8dab4f3269db65b932a6d78f195045c93f4fb829583926fa19a8af2ecc126230f4041847b6cfbc7ff00af4d8a128b6cca51036ec2973028ff00801fbd5a505cd8b882e1a50ac88ca7ce8b7ce7d30e3819a2cef2cda189a479edcac878913ed0edefb9beefe14ec3f6553b192f015895a4db1812803ce4300e4f603afe3524d66e23944c1bca5208370a190fd02f3f89abb6b7f6c0cfba2b8b42650ca606dece3be77e703e94d5bb816eeee4fb34891b10525801495feadd07e54683f6353b152485dbcc43bd9760c02772ff00c061eb4f581bcc809081d90855763137b6d8ba7e7533dfc5f6a2eb6c5a031156665fde96ec0c9d7f2a06aaa1e1f2639228954868d88919f8fef9e68ba1ac3d57f64acf6654599b9508e18aa8b88f6b1f6509c1fc6a496c18c05a457c79995f3544e4fd157a7e35620d4e1450a96f2da057df8b69787fa9604fe551a6a8a0488d6a912bb6e26dcf96e7ea475e94eebb95f55abd84362e64982f5007ca8fe6bffdfb3d29ad620dc9425166d990092273ff0001fb82a55d52676983dbc2d6ec3e641c3e3ddc7cc6a26d56e2370b16d4b4c60dbfde0477c93cf349b41f54ab7d87c566449134aa448411fbd8bcc6ff00bed785a22b371b5b1217f3086f2b1727f1feed43fdad36625b73f6485060c500c237d477a7cb2bdf42238d9220afbf1026ce7d0e3ad2e6457d4eaa2486d70d30b7c1941f985acbfbcc7fb45f81f414f16719b8989dbe6040597618d87fbd2f4fcaa3b9925bab67b79a526324108a800047eb481e77b4585a790c3b4a14c64628728dc3ea953ab2d7f67e5b680e418c97c20953fe052f5fcaa4b6b6df05b7d940688b10e6d241e5ff00c08bfcc7f0aa512cb1ac412e658d231840a7005171117f2d4cd24bb3eef38c7d28e6895f5396d72e259c26dbe4f25809fe6dbbad57af727ef54b736ca60b91305f2430da6e536447e8ebf331ace92da5ba4449a56654e81d89c5365b575508c0b28e80b647e142921fd49bd2e684821114a5a426dbcb521d983dbf3c711fde355e28e0d8b347244f1a47feb16431118f48b906a18a08c10ad0f1ea09a91f4e99b9f211703afa8a39903c228bb36535682efcb99a58e4d9c66e93630ff742703f1a8f7c7392d24af1ec9319b80272df41d00ab9159e2401d5767752b5621d3a59219366170dca918a5ccd8de1a9a7ab32dfcadd3150d092c3e789cb33fe0dc0fc29af1c61a578db3bc6384c4a7eae3fa0ad4934c75232bb73ea47349e490b82031f7a399971c3527b3b996763aee5594614af94c036efabf5a8a340b12a8b79202bd16293e56ff7b393fad6cada16380793ef4f162c9cb027b52e6669f55a4ba1cd35bb3a15658626ddbb318db9fae3ad3163d9f2b0c37bf7ae85b4dde4feedb0392719a54d359e2286366840cee2b8c0f6a4eef7294234b589831444cdbcf6e057596f12c5691213f7803590ba6c914a87964ce49c74fad6db6dda9df1428d995294651d0743097c1c719a7c90264e054d11fdd0ec4d38c47696638a396eee6919a51b48cf1671eec9504fa9a9d2da31d1055c48900c9e7df3d297f764e16438f5238a6a04bc44368a201028fe00334ed8055953181d7f4cd30b2004a0f9b3df9a7ca0aba6ec90c58467b6075a97ca5038e79e6a3121e49ea693cf20e32a33de96869ef3252067a9a6b3ede07eb4c173182434808fad473dcc2ef90c147a0e69b922552d7525328c67d7f4a9126c0e0f15563bf8a02db643f30c74cd45f6f813200639f7a4a637462f6344ccbb32482c79231d29a2eb39c8e6b2c6a716f0047df1cf343ea61090aaa47ad1ed06a8c569635d2e0f50011409f9c74fa561ff006ab1040e1b1c60546750b83c61bebd293a9a0bd8c11d0fda082572761ee45279aa00dd807bf3d6b9f596f24384473cf24f4a8ca5cee2a401ee5c51cd2647eee26eb4ea724ca07e39a85ae62c9cc809eb81597e44ccbcc8809ed9cd225b90c03c8579ebb7ff00af49f30e328f44689bc8949193cd30df2e400147b9aa9f65ce46f63ef4bf63873979327d0d0d3ea5293e887bea063720b2e47a5452ea8d30ff005649f5eb52882cd3059d7f039a91a6b243fbb4793ea3151a5cb5cfd8a6b2cd27dd8803eb8a9a3b1b8b86c31183d7b0a7b5f3748e055c719350b497b73c671fee0a49c4b7095b565dff0045d30e5995d874c1cd44fa84b7d387949da0f18ed557ec422c34f2004f45272c6a69336f625e355de4f01ba01ef5a2974473d58c541bea584b856b9645d8c4f4c11b89f4c512158804dac093d08cd536b44986fd91c72fab0dd9efd45588570a6305415e4ec7e95ba6cf05dae48412e496030380178fc7d298d1a5c6d2c03607507a1a65c09a20a62281988199391cd4b16ed9b1d634703e629c027e940117d9e454c045c67d739fd2a5918fcb98faf0c0d3c0651c303f43d298598025ca28ee49a035ea325f95800188ee14f2295986186e24af3d3143dd6c50cebc670187f8d364c95055b258f271d280182632607cc793db14be62ed2086db9e4819c5282368c807f0a5f3163423803d7ad0001832001f38e80f7a03ae08182476cd57fb5132855886dcf248273f4a71656ff7bd7a1a62ea4aefc29076faf34ddf96cfcb8ef8e69a8cdb47cd9a786046081f8501b6e4a24727e519fc293e604e57f134d0ea06029e3f4a7f981800467eb4c437e773c118ef8350aa321da4efc7761cd4c4aa82d803fdacd2e4b2ee0032919c839a62d8405b71c8cfbfa51bd803d0fb531d9509729f37af5350a5c99811e5918fad2289cedfeeed27a8a403048c8c7ad206071b9483f8d38aa83d867d6810dc3c63a0393d852b92c9d4723a1a029236e76fd39a09c3619bdfeb4c5718bc47c73f4a728c8c73c76229880a3b3094b0f46e452bb8037676f3de9075172c0e02903d49a6940090324139eb42c8a5f20ba93d076a19b0f93d71d681ee28001fbbc7ae69e0ae718cfa0a67079cfe22a32406039e4f24714c122478d37640dac7af3d697ee0e5723da9a5d8600f9beb430298f9b83da905862f9884fcfbd4ff0009ed5333a6d0c11b1dc0150a601cf7f535216e320fe74d8584e082cbd3da9ae827419dbec48a40c549dcbd7ad3c61573b6901c45c43148a49f3079abb97e51c0fcf3da9f3ca892451452b37971c615193041c039cf439a596693ca564b7caede094e9f89e82a399c1ba0ce079c40e767cb903f2ae66f4262493b13332a7fac65cb1cf1923afe551aa145f37e60a5b1851863fe1f5abab15bdcdb1923c35c0197c0c0719eb819e6a25b99a240924601ddf2af960718fc78acaed960e3cc818a031a95dee54751df9a65a4d133e2dc4ac338c9f9403f953cdc3248922b97383b8eecfa8fc69984b89156546079dad93ce7daaed61286b74cb3f6af294e2d631e67de3903f5156639c6e890411e320f0c4e73dea8223461136ab16f9475f7ab768aaad1bb2b7ee8b640e8a0d4dfa8e4ae5f4be58d82490420743905bfad2cda842a5b36d68db101dc10fe3deb08b492bccaa4ef1b9d0f7ebc8a7a4f346d1c876b44c0e4771ce38f5a8d513ca5dbad4606709344eaae33be290806a94f62ab1f9eab23c2727cc8cefc7d470692e550a6c8f395f98a75db4c0cd1dc2b5bbb22edc9f9b3c7a1a1ddeda151b5ac47f64590fee6e11f1d01054e2a0786712089d012e428dae1b9cf7c56834a6e2dbe6290339e88b807df1f8d24962d1188c9b551460367bf3cf3fa55730477290baf290a2fcdc90ac452c33492ab9545c63961deac416df342ab7851a127e5446241fa815af756f1b5a44b2a832cdb99d91024840e07b9ad374126b628594899912778cc271c725891db1fa511491c4c7cb446046497e474f4ff003d29afa542b9f2dc4981c221c6318ce7d4f5ef4d5b2844fe5244acbd5b786c8f5e41a64d96e8b12ddc61ccab244c323202f52073cd2c5736a65e44ac7236ae31d4fb75fc691ad22ba5024731a27cb1a2b00463bf4e7eb4c8d2dece391f2c3ddc1dd9cfa7a7e151a5c5a17e7be81228e3800209deedd5ba7406b219e4bcb933039319c91d70339e9dfeb5225c3248449b18be40dbdb8e31daa484b062d0c691cca3fe5ac9c93f81e455dae3d7a15d6ed1679666873290065c74f7c0ab41cf945c1569082492b8607f3a69827741b9e3941e42c2a140e7b9eb55985cf9ab989e3889c90cd9c0e8707fa566df429235f4a999f5348dc9621b7372703d38e95b7349f63d56789c6d5621d7f1ac359da191658e61e5b103cbdbfae6b535e8deeecadf53b752c5136cbb7afb715b424ed73ae87baee6924cadc834edc09c927f1ae4e0d4e4420673ed5ab16a6aca09ce6ab9d33d48c2faa35d806e719a89a2520f02a04bf52054bf69423069e85f2b116d6dcbaf9a84af7dbd697ec160dbb113a900ed39073f514be7252aca849e79a5643e52236106d508b8f524d1fd9f00e360fae2a612a7ad3fce0d8e680e52116701c6e8d7f2149f6084f58d09fc2a732afad21753de8b217210ff0067c1d0c4a71ec298da7dbb7fcb251ce7a559f3063ad2798bd8fe34348ae42aff0065db13c20e7ad29d1ac8e3861ff02ab5e68c75a37a8e4d2b21f2b201a3d946709f8d3c585b0c0f2d48ef52871eb4e320a341723ee3059da22edf2a3724e7760f147d8ad83655131feee2a4497638604020e466ae9bd98afdabcc566ced750b803d29e84b8d99496d61420ec0c3b8c75a9992dd80c5a44a47704ff8d12dd35c3ee91fa0e8074a8c4885bbd30e4ee5a896c5b70934f4e9d509ce7f3aacc9012585bc6011d31561e7b64da3616604ee27806a212c613dfd71432546dad8805b47f7bca523dc537ec70f2648b231c76a9fcc576daa47d4f148d32e769238f4a965dca6f6f1ee2510203d85406d50367183eb57e49060020723229bfbb68b25c020e71b79a437b6c674b6c3706392739cd4d1a6ee5bf0a909572467a531be55233c1a9eb71dbddb0e9155edd97ba904567b40f348e80aaa22ee676e83ff00af57639231c3e58f4dbeb523953160fca8082aaa38fc7d6a5c39b52655dc63cab7324e9e6e9404448e35e773f2cc7dea57d3d6408bf2ee51d76e2b455900ea31e98a5ca11c552491128393bc8ce1a60046421f7a9458c6187eec0faf7abeaebcf0297cc51cfa75aad07ecd99bf630a4e563c1e871cd2a44ab27cabf40056a031040e64cbeec6cf4f7a6f99175232dda96c0a0fb1942201c9dc3279029e6053c9ab9776d6cf3b796180f5e45422de11f74907d8d208c6eb528a182163bd031f4619cd4c91433460c4983df357858d96d69ccf219300ec2b9f9bdcd471a428dbc04cfd05161c927b11258492f1146ec4752aa6aca697730b664cafb6455b6bf76401a4f94544d74a4e449fad568886a4c8cd89471920b1e840e99a83ec2c65656cb372b83fcea73386390d961cf5a4176a0962eb91eb45d0d45a19269d6d105293b3123e60c3bd575b44048d8723b1ed56a4b989f2ee1093dfa534dfa070fbc647439a1d8718cfed0d4b61d40e697ec664e4464fd054c35f68df799d4f6c31eb5586b91c58093818f46a2e8a49dc963b4239d8481c1c7a52c9a5c12162d110d9c019ed549f5c8973fbe5c1ebcf5a8cebf6f9c99d6a6e86d6bb979744881ff58a17ae09a94d9c7020556439fee76acb7f115aece2619aacfe24b7ff009eb9fc28d3b0bd6474496d122094c6bd78c9e6a4921b558b11743c8523a7e35cb2f896d9dd5048c49381c559bed692cf66e2dc8e29dfc8cdc2327cdcc6eed88107683ebc5382da0e58367e95c81f1445fc28e4d31bc50a7fe594946bd87cd4ff0098ecb36bbf211be9514a6220855e7dcd71ff00f093b9e901fc69a7c49704f16f9fa9a350e7a4b5b9d6c132c326586e1ec6ae35e238cae41038c818ae08f892efb41183ea6a17f11ea0338d833c74a71e64635674a67746ff0069206cc7aecc52ade8660d181f43debcf3fb7750381bd33ebb6b66e6fa78b46496362272472074a1b7714674dad16a75eda916e385f6ee2abb3a3f24fe3eb5e7ff006ebf249372f4d37d7e47fc7cc9f852777bb2a15630f8627a1ab46a320647ad3cdf40a9b59b0eadc127802bce3ed178e08373363fdea8cacad92cf213ebba97cca75dcbec9e8efac42010675e7dea0935ab765c1b88c2fbbe2bcf4c0e791b8fe351b5b381f773f8d3d3b994ea3b6913bc7d7acd580fb42671eb9a9edee927f9c36475041af36f21b760af03ad75da5315b28c6714a6ec3a3273959ab1d23dd609d8781eb4c7be90039ef549a609827a54b011749bf68c0f5a94db3a748bb5893fb4dc70029a6b6a7213c1039f4a718605e7e41f4a953c8c67cc8c11cf3557653b6f6203a84ee7866ebe9435d4eca0ed9323a9f5a9f7403387c93d702944b00936ef629fde0b498ae55135c1fe1273eb4335d3051e5a2903ae7afd6a6334791b558f3d48a73dd26dc2c0fbb1f7b23140aed95bcab83d582f3da9c6de524664cfd052f9d31c7ca07e3522cf72b1945f2f939c95c9fce95d1776b422fb26ee0b12697ec5d01ddc7a9c55fbad4750bd451234602f0047085aa861ba931bddc90319e946824df514588520ecc03d0d39add630376d1df9a4369349c48ee40e065a8160a33b9d011eafcd004815143379d18217772c3915099e0c105891e805060b54fbd3a534c9649cf9bbbf0a776248517080fca8dc8cf4a69b976e90e31ea6956eadf3f2c32b9fa54c92b330dba7cbb73c9fff005d2bb15da22fb55cba852a001d38ce2a549eec46f1820ab8c11b33fad284bfcf10c683d588a90c776aa43ddc11e7d39a3981d8ac2dae0f277e31c91c50b6bce491f52d4f658c0fdeea44fb28eb5093a7292374f29f638a9b8ee4a62b78f979a31f419a70b8b11f73cc94fb0c5363961c7ee34c673eae09ab2ada8b2828b15b8f4c60d45ae6ca714b7104b3ca316fa701eee29ae9758cdc5d4702ff00753ad4729627373aa051fdd539a8035906c5bc135cca7f89ba55455899c93d892310ef3f67469187595fa0a66a8d9b10a8188077000fde34e633657ed1b507f0c49fd69d71ff001ee5b059863200278ad61ac8e4c4c9469b65282ebcd48a1de89283d1f23f0f634f9d2f7ed8af13c417a3127e61efef504d696f3b433ab1dd19c8c707d7a1fe55736a19d77dc379a470770fc38ae8d8f13a93c067540971279871825474a94aa4986f309dbc64f155bc99158947de4919dcbfa669e816289824526727287d7eb45843fe4680962739c6718348f82a373121860707354a7fb47d9fccb484a3f531b1c11ebc51613cb28065767917aee8b691fe343761d8b91e33b0beeed86a64916f0556578dbae50d4e9865273c83e982681d3e75208e87da930189132920b71db918a8da470fe5edc9edc6289633bc6c0a73c924e29e88c7ef9008ed400c52e4e769c743cf4a4cb4dbb6bab107bf5a9258957381b8f5e05451c9bd54f94406fe2ed400b1a9c306f5ec28631c636039cf23238a690637396600f6ea29e626f289cfca78029a0632472c3182b8efcff3a5595b2a776e1f5a119a3f94a861fad29d85802bd79a043db8259738ee3ad1bf0028f97d28ddc60e7eb47dddb9ce7dbbd0980e720a8e187b83c54519da0aef2413c7b54bb80e4f4a612464ae39f5a621c5d9573d40f7a438994648c0e46453524f9712107e8299b320e240cbfa8a06898c6c3a15e7afbd3595b6f7201ea3a8a6e48500127d39eb46eda72739cf5a49812e3a02c06781914c3dd5c023da9e7e651914d601860f031d69dc4d08cf1a61936823a8db46fdebb8600f5349b71821981f507ad0a57186391d79a6263f0010c1548fad0cb96e3f234d0c338f94e7b629e18e3e61f9500444a83834bd53a1c0eb415477ca9dac3f0a617646e4363d7ad01614fcc318231d0d2aaee438e4f7c5377e3079fca9c581e47e940df906d1b01393ec69a5db3b401ed4a1d071bb9f4351b92b207dc47b7ad311c33dcce0ac9303e5919da0f1c7a0155a4792e950152c3764f381f9568cf6ab70f2451ed85c7ccd1139cafb7f87e3507d95a2502ccf9cc4659c72cbec07f0ff009e6b8d5ba82e5e858b232dac68ae638779daa01f99b3e95a7a7dd5b4969e5ceb2e0fcb957e075ea0fd2b15207f2db21b706f9c30e47bd4f02ac4c158b056e187a0f5a52572d3ea6dfd96dc14dd1a82a72a42e323af354de23e60db28249e558ec61f4ed5722568acbc8b99c3b312f191d93ffd7fcaa9dcc1e6ceca24026006377dd90ff8d67ccd3b313ee533c5cc7b99c393820f3b87ad4b613cd24ecc8c420215875dd9e001fceab25c4f0a48b3fcde5291e5b8ce0f6fa558b792d627b4b60ad13bb09ca7507ae067f0fd6aafa59029172e820b91b382c70707a1231c8acc78ee6d62858386c1da1873b875e38e2a66826bbd4dda38b08bb434a7800851dcf6a7c62499ff00712c67270f101957fa0acf55a845db72291a1b28c3bc98927396da77640ea727e9daaf456a9756d1dd798218947de753923ae063af7aaef656914a2678f7ca07cb086f917d33fe142ea13cb70659a38c24630149efd80f41f8534f4eec2fccf42cc223bc914c3b6219c069ce09ff0074546e8d1484b9f3c8e8eca571ebf4a48f537997eeae41c1206171f5ab33bc134414aaed2bc704903da8f516898d8b65ca23c7b41dfb4fa22fa903e9534f7627999c2b10836ee0b96fa66aa8696de3f2ede104677caeabc11d80a9dedefa68e30b08756209e5719f715aa7a6889b2dcad3de3c1be40ca85f8298c923be4fad68e9d324f61234a0153f2a3679031eb8a4fec7bb5b579ae1620cbcaa040c40aa5f6891a3f20bf24705bb11d7e83daa64eda334835d481ed41904f210f20036b1190783cd3b6ef8d92493cc767c862a7e518e00e314eb491122786457396c9018f39f7278fa0a74a8628523889f246e6292f2416f7a1ad01ad74d8a2b0a99cc72ab6f3ce48e3039cd6a402686c9de429340376d45e3923d7a8aa42342449e5a8665dbcb7ca454f1ee81b7c7f31da17e43c0e39a14b948e8055a2bab3ba892396255384964655fa9ee7e9533431ddf9a9f7647ff0057b19c0538c76e79aae8e866fde2ef90f572376df7c9a499e3f3c3194aa9e324633f5a6e574388e311b69446f221942e3631c9c7ae6aed96b3269ee63701e26eaa4706aa41708881573b47f7db7119e3a52dcc20a9c8dcabd4a8e45119496a76e15abd8bd258e95a8319a0730c8dc950d8151ae932c790b296f4247f8566a5bbeddd0bee1ec69eb737709003b01e8455f3c7aa3d38d3d34d0d24b5bb4c9501b839c1a025d039f2d8fb823fc6abaeab7213f9f3d6a44d4643d63fc8d1ee94a335d49f75caff00cb2939efb69c269c6331c9ff007c9a8c6a1c7287a5584d423dabc4a1b3d876a15bb83e74b7240e027ccec3ea87fc29be6631b64cfd4114c6bf4603058d496f776eef8965312e396da5bf9556ec9bd4dee356e38f9dc2fb014f1708d9225c63fbd4f96ee1550a272e1864f0463daa3fb5418e5bf4a3412f6addf9863de6d23e60c0fa53fed07192e01c74269a2ee2e99c0a70bb8d9776e040e28468fda79111bc2b9c30cfd6952e8b9c332fd734efb6c58c6467e94ffb4dbb7564cfd297cc779dba086e597f8948f6341ba900ce38cfa8a5fb4c1f77e5f4e8293ce8318f94fb9a2cfb894a7e437ed8d9e9d39a5178c78c93ef9a7799013fc23f0a7878738263e99cd16f31b94860bc907438f6cd396f6456cab61a812c3c8f94e3bd48ac864f2c150738ea28f989b9110be6e72793dc9a88dfb67ef6076ab42ea1cf55c1f514a268704865a56f31a94d74298bd933f7b1f5a1af26e39356fed1183c32ff00df228fb4c78fbca07d050d798f9e7d9153edb267ad37ed726472476abe2f234e4cea08fa734e8de1ba0c3ed43206e2073c7ad2e57dc6e725ab46734cfd7a7d69a6e9b91927dcd58be021936a9dd81d7159ee383593ba37a7252dca97fac4f653e628c1db83cd547f15ddb67fd1a31b87a9ad0bfd2e4b8dad1c66505016dbcd667f634c58058189f4c5691959599e6e262ea4ee9ec27fc2477e71854fca94788aff001908bf975a6b68f70990f0c8bf506906933ffcf3714f990d2acfa8f1e21d4323e45148de21d431f7173df341d3271d5187a669069b213f74e69f3446e15edf10835fd4b39f971de9f06bb7de7aef28413cd28d1ae1cfcb0b9fa0a55d2265902ba15ee734268971acb791a3ac6a57902c6f0b72c39245637f6bea27a4b8fa0ae827b07bab741fdc1cfbd659d35b27e423da927dcb9c27297baca7fdada91057ed0403d47ad30ea1a81e9391eb578698d81853f954b168d2c870aa07d69f38bd855b5f98ca6bcd4187375c7b1a8fed379dee1aba06f0edc2ae48423d88cd42747909e118fe147312a94dfda30cddde83ff001f3263d9a9a6e6e8e3f7f27e66ba21a139032b8fc29dff0008ebe32197afa5352225427dc843c93f87c1dc7ccf5cf358a5652465e4fcebaeb3d3bcb4fb24a4707ef03d6a2bad23f7a4260a9e9cf4a94ecd9b4e0e4a28e50a3f39673ee4d2f944e3ef1ae8d7477ce78c7d6a71a28d809280fd69f38feacce57ecf93d0faf5a516c48e53f3aea3fb1c03f7929ffd931ff7d47e353cecafaa1ca9b53fddebeb4d36ee0702bb01a4c007fad19a46d32d8e01900c7a0a39d87d522d9c7c36ec2e1188e873c56f6ab6ad74b0b2ff000af24d5ffecfb3427e663e9daaddbbdaa42639919c7b1c5272b951c372c6492dce4059383cd482d0af515d49fb0a138b7cfa679eb50b0b32d930038f5349c8ba7868add1cfadaf381924f6a78b36cf4615d02c96f126521c3e79e78c62964ba438cc4831df14aefb9afb28a7648c21a5c8c07eedc8c71c5364d2dd480d1907deb78ea4e10202981d0527db7772197345c5ecd7548c04d1e47936a21c9ad48ec6592d7c8707728c9153b6a1b46d330029cf7021f9fcdf97fbf9c034db27d8c14af7333fb2e6c7fab3f4c528d26623fd511f5abc755b7cf372bff7d533fb4ed73f35e27b75a566573d35d5102e8f37f7319ab31685bd497206de4f3513eb360a3fe3eb771d306ab9d7ad413cb1a6a2c8955a4d7c45d7d131f72453f5e29ada4228f99d7df9aa83c456aa7a484e3a815149e248483b627fa9a7c8c8f6b4968e4691d26c095df2301d1b147951411ac513165518c91d6b17fe12356c2f92793d41ad54937c2920e8e33f850d3b13095294ef164b70dfb860739c706ae698b9836e783eb59d70dfbafc2aed81436b893214724834476b0eaaf78bf258463969107e3491416d1e4f9c94c56d33bf9d21fa9a48dec37656c646fa834d22968ac596166bf7ae7df814c69ec80e2466fc2944c0f116920e39f9969fe6dee3e4b08907ba8a09b8c173678e2199cfb502e32408ec6523b704d3f76aa73fea533d3e614d65bf07f797d12fa8e78a4171caf7647cba7e3d0b714a06a241fdd451fd58542c8e46e935138f61ff00d7a6f916cd82d78ec09c72c053b01602deeef9af604f70734c7520fef354e7bec1513a6991264bbc8d9395dc4d3165b4cfeeec5dfeb93406ac71fb08fbf7933fd314d0fa703c473ca7d4b7f854a1e627f73a6003b12a05481f5123688a28f3ee050c2e448f6ed8f2f4d7607b904ff3a955eeb388ec2351d89001a465bd6fbf7b0a546f10cfefb5324f5f96842b264e5b52c7fad8a31fef5318dcb6165d4907d2ab11a720f9ae6690fa66847d3c709672487fdac9a43b5898a5baff00aed4198f7c5441f4e0d80b3cbf89a9e273d63d2b00753b40fe741b9bf001db0423dd80a02fd05468db7793a4b1f761fe353a9d40fdc821801eed8154a5bb9ffe5aea512e7b2f38aad25d59e4f9b7d7129f4518a40693adce7f7ba9c71f3d1698c6d98f9935ecb3127231c565b5cd92e592d647e7ac8f9fd290ea72edc4102c7ff0114ae36b4ba2f6f8118fd974f790e7ef39e29b2dcdc0044b3c36ebfdc8c7359725c5dca4f9933007a807151220ddcf27d695cd145b3516e214f986fda7ef48dc93533ee994ac0e931e8c8df291ee08e6a2b3678932a5307821c75f6ab6cced920f9673c145038f4cd74d15a5cf1b1951b9dbb15ede07f2de368cb2163c6fdc33eb550e922277916760072431076d696c9044f1ef75e321f3939f5f6aab00b98c3798de680063230df8f635ad91c572dc71b4b1c6f33949319003f0d4e6b87694dba07de31f3f1c546e25211364663fa608a492dd6e2d5a2740f9e465a9811acb3c4e22b8d8771c0ddf293f4f7ab3e4c4f974243f4c8620815522b8f322104a06e43b76b7cdc8fad48b1f9c5e559594fdc3820e297a816115fcb218636ff106e6849123276ef539e73c86a45565c363771cb63934aff3e19181246082693016582395325148273ea0d556b6b74955963446c638e3353a8cb63946f5c75a494e1703ee9ea734ae324694a8dec1863b834c79a17c8249cffb5d6a31c6761208ea0d422395d46fe0eeeab4c0b99511fcbc9c753d69a83838762bd7696e2a25570a41248ebb4f3f88a40d271e59dc33d1bd2921344c5c0206dc13d877fc696438049419c7193d2aafceb26773004f2adce0fb54be6cab36d5daeb8fba4550ac2a36410720f6239152127a8233ef50efc27cc0a1cf41cd391d2488e508607bd170b0fd9211c30ddf4a68dc8df38201ea7d29173193bb2c3eb9a7ef046573c7ad02680eddc318c538796c3eef3eb8a85e575c8c707da9431da006e4f34c097014e3391ed4108ca79e7b8a4cef1ca8faad343e41239fad01b8e182383fad2a95e9d3d69b91c6e079e84fad230180549047a1a00937003fad31f67defd453502ee24e0be3bf04d39e4503e6f928b8ec0328a4e33e94234873bd071d0d0ac3254e3db3c531a43c0c64fb1a62b0e0cdbfe6e47a53e4384e1377d2a3dce5b95c7be7ad026dc7057f11de8b810bce038011b9ec45498e0145233d81a73b4646190e3d719a452a7e5538f6cd260354302783cf7cd07700481f37d7ad296da3f780fe149f7ba641f5cd30d4e0024a489d59e4f98057e8c87d08ad2568e53e685314aa795e849c0fd335298ec3eedbc336e63f36549e3db9ff001a8666964725911594e778033f8d70b9580d481d6e00fb494e87f7fd08ff0011eb59f70105c1b631807ee920f5f4ec7b73525aba34e269e33bdba80980bf5e7d2acb44be7ab98c4e81946470063d6a5d4b3d4a7a6b6249799b6878c2db158d3d460720fe26a0711c2810e2493fbcc3207ff5eabde5e06b85dc8abbd896083afcc00fc6ac148362870acc0f2092063deb253d6ecc66dd88e4f2ee62c5ca118fbce3baf5ab3f66b52567cf9b8e7ccc9c927b0f41fe14cbabb8e3b70a96d19d8bcedfd7ad4160a6f19826e13152dd782073d0d6919042ef6197065ba90396222539543c01e9f8fd68b4114504c96f1481d71b9dc6d2c3bedab7e44e1c936cd2798bc120f1eff535369d63e6df88e5668d101764618254724771446f7d763476b14a08f31b492b0080641271f9934c678eed1d61812416fd18127f1ff229f201233dccf04a107022322ecf6c8c719a7279486316f66624073bf6e700f5c9a7a6e85cd67a90d85bfcafbde29198fdc0b8e2aea3dac9294f2959d571b7d57ffd7419aedd255b448df716da0a8e9ce05557b39bce476cc2dc310074352f57a8eeb72fc132cc8b1c0904310fbc3ffd63152c0f2daccc03c6c0f04e7247f9f6aca99a447730147208c871c39ef577cd92e0032e1081d07415574904ac5bbfd52dd606b713091dce186fc7e02b205bc6ec48970d8f94672001560d8ac7b25b853181cee0a0ee1eb4b3262006268195b03280965fa8c6686f9b515d7419040492d290c88725b3c13d29b336c3e5c61c0392e58fdea67d9677f94c91b63a247c827d4f4e9f8d4910b982e144adb4e3a1fbae39cff4abf76da1a110b848edcca98f290619dd7afb01fcaa94173223332031cbbb8ea420ce7a7bd68bc4190861e6aef0c840e839edf8d453c2aca182af2a32b8e4fd6a93424d0e9d5e59fe52d18c65891f8e78a1e7dd2e13ce703e5dec81b3effcfb516d06193ac611b2486ea3f2f7ab71dac8204748587ce7e58c819fae7a5164348a819e692355866764e876f191d3f5aba82731037398666e41718e4f63ec69b34d28c03c2818da8c081f91a6865c04c12cd9ce471f4ce29d8de9492922195625908955ede4ecc9f74fbd4d1c73b0fdcddc722fa39c53124953e48cacb1f7865edf4a8e43680e66b49616cf3b0e054b3d483b6c5a2978bcbda2be3aed20d2890ae77d8b83ed9a8a116edcc5a8cb193fc2fcd598c5c8e23d4a220fa9c1a122dc98cfb4400736b229efd69c97569ce52451deac83a9e3fd7c2df47ffeb53b76a380a6385bbe43550739079f6183fbc6cd3927b12a3f7ad52e7501d6da261e99069acd787a58467ea14d02bb1a26b4247ef49cfa0a7efb465044bc67a114d26ebbe9c87e8829435c31ff0090629c9c9ca51640ee5ab7b082ea16952e204519cf98cab8efd335454da13feb47e546e63cb696a3fed91a532a9ff9868faf9668d3a0d3d4762d73812a9cfb5288adc8cf9a800f5151878c1c1d30673cfc8694b40a013a78e4760dc54e836f426f2adc9c79883d7029e2de05e92260fe95577dbf436273f46a3ccb52bff1e5d7fdea62516cb6f6b1c6eaaef18c8cf1834dfb3db807f7a98a83ccb3cf163f89dd479b6bd3ec47ff001ea3d06ae89da080100b2e78e687821562ad228c76faf35019ad01c7d849fc5bfc6832da027164dfad162aec9fca831feb13f2a0dbc24ffaf8f38a87cdb3c7165fce9a66b4c8ff0041e3f1a56432c1b785085f3e33c76a9059c4c523f3e32ce70076fcea9f9969d0d973f56a513da679b13fad1602d7d82072e3cf8f29d70c3f4f5a56b58a1812749e3eb91c827f2a8da6b1fb3a05d3e4f3371cf5c15c7f3eb5119ad194e2c9e371c06e78a9d0a4e5b05c4a6566724658f5a8588f2c7b5190c3dc8a8c939c01d7bd496d5b624b7be9edfe556daa6acadfb2724ae6b1b514636795c805b6ee15ce38ba5241673f89aa8a6fa98d7af0834b94ee9efcbe795ebde9a6f49033b381d6b8422e3b97c1f7a5c4d9e59bf3355c8fb98fd763d22773f6b0c472a4d4a2490c4640abb14e0b62b822b3633bdff3a50b3e31b9fe9934d43cca78ed3489dd0d436f1b9413de9a6f73fc6b5c398a5ea598fe348165fef37e74f93a5c978d5fca76df6b31a9fde610f7a67f68a8eb3281f5acb915a6d163049df800d609b4943e1b822a62ba1a55c538a4d4773b33a84614913a7fdf5487538940ccea3d706b8bfb2b60f34bf667c671c62ab957731fae4ff94ec1b578fa0b85e7a734dfed7817adc8e99e0d7202d9d8e36f5a90d8bf3d3e868e54fa83c5cd7d93aa3ad5b6706e47d68fedbb51c7da4631eb5c9ad948c7814358c8b8250807be29a8a21e2ea763b18af239d0bc326e51dc5447534c601359de1f468d258d870791c55c366170599467d6b292b3b23ae15db8293d077f68a0ecc697fb4c01c29ce6a316d103cc8a3f5a78b68b7637e79ecb53636559db4146a00e3e463c73486fcf184fd6a436d1a757620fa2d0521040018e4e7a62958a555c88fedf2f0153afad31efa5193b00ab46389403e59e7d4d42e8ac0e22fccd1660ea3e8551a84de62828307d2ae5c1970be59fad5610173858ceec8c62b45622f1ff00ab6620e3e5aae5215496b72804b863cb9fc29c6297fbcdcfad6ba5a4ae09fb3950a392d9e287b393a796011d7ad1ca67edba190207eee68f258ff11fceb605930c70bf5db4d3692a1dc0a1f50571472b05539ba195f650475a735ae07715aab0cbbba4607b814925b4afdd0d1ca5b6fb1cfdd42841c0e7bd3b51865934b8635438ddd7e82b625d3d09f9dbf2ef560c36f2011487fd5f4c8e95691c9352bbd0e15ace42d8a4fb138e0f4fe75d9bda5b95203019f6a83fb3a0cfcd2f1f4aa72b19d3c237b9ca0b339eff005cd396c89e9d4d757f60b41c1727f0a7c515a427eeeefa8a5ced9abc25968725f62e76914e6d358286c1e7b57648f6eac36c6a0d39ae50e7f76bc55732337869be8715fd93308cb85c63904f7add8176da44ac7e60bc8f4ad4b99648caabc5b7804061daaa4afb94703a638a86ee10a7ece69905c91e4e476c568694d30b76f2a1f34020b0db9fa5665c1fdd63dbf3ad8d0aec436333adcc71966546ddce07d2a56c74d4d19a092ea3b3f7762807a9c5006aa5890d0c7f561c556377122b2b6b3261860854eb558cfa767e7baba7fa0157615cbe62bf3cc97d0a7d0e6a368719f3753007b0aa0d75a60e3c9b9908f57c534dfd8827669a5bdd9a81a2decb156064d425247231c52b3e9658932cd231ebf35541a981feaf4e841f7e69c355bd7c98e081303b2521ee585974fce12c647fae6a4576ff00965a5e3d095aa0751d44e7f7e17e8298f2dec98dd72e73d30714ae82c6b2bea18f96ce28fea40c5216d431f34f0463fdfac5649187cf3c84ff00bd49f665607ef13d4f347320e566a348dc997538c103b542d7169d64bf9dcffb2b8aa6b6d1f652063a1a7792993c52e62b95961ae74c00154b990ffb4d4c37f68abf269eb9f5639a8fcb51d81a369ec052e61f221e354b80311db4283b7cb4d6d46fdf1fbddbec294a7ca1b3d6a36201fe747330504c4692e58e1e6739ff006aa168dc9e598fe353efebc501496c92003d3352db2d4122b7903bf27dea45b71b77638f5a936f6ce47bd03eee3a8cd2f52ac81235c1c8a711b3f871cd3908de314b3e3207f4a87b9b2b58aec4924f6a545e7a508a58e011ef9ab21223b554976ea4d5c6ecc2acd4516d19156305b7151ca83ebea2a75bcb431e438041c6d3c11f8511a5bc8328aebb47de3ce7bf5a505760707703f7588fbc3eb5df056563e66a4b9a4d927eed9304ed1d411dc52dbae198accaeac301491c5406499495f2015c1e49e0fd6a3fb2c6db1d418c8e768e6a8825bdba82d5943ed4ddc6e07f422980427211f07ae54f23e99aaf34924eb85313271cbfde53e983513497055502f96ddd979e686ec16b8b3456b2a79325cb07cfde51824fbf6a23d96d860de663866c64b0f7e2872a48729ba4c6485fe2c534df80016dc883aaec21854bd4658696363ce432f38208cd4865120cae3af526ab45730a30632eefee16f94807d7d6ac1758f0e14b2b7461cd1e804e24560460e7b82294f4dc39f6eb555a676976a2ac807380db5854808daad964607233da8b089d950e39383e86a14930e42b82bd0e7a834e660fb93956ebbb14f0ad91bc7fc087434c2e21de0e72b81eb4d694280df2f069eca1b3b720d43b4865cb1627b6318a043e52adb73f78f7045223338cee46038240c5472215dcdc86eccbdaa40e0c5e6c99dd8f9b6ff51498d1215dc7749863eb9a814465d9439ca9e98c535654750c8e3613c313fa539db070c573d29d842f18c82d91ea29c5d7660ae3fda14d5453c3607e3d29cabb571fc2dfc4391fa50c631806520374ee292109202564dc47504608a91edc311c8c7a8a8a28fcb2570a076e28137a033488719e0f7c74a5326dc062704f5c54a22daa5b279ed4ff0028ed215baf6a770230df2630707b52b60001781ef4881d5489321b3dba1a69c83df9f4a4818a70491d29392b8c93f519a15b0493927d6955f249da14fd298091bbb861244076cfad2ac08cdbc821beb52160579c9fa5180470722815fb0c7752d8ded9079a4119196c9e7ae3bd2b2226588ce7af3460ac442120faf5a006e56239f9b27d6856dc32178a474670ac47cc3b8a151d723248f5f4a2e1d0748bc06e79e94d1ce430fc6992caf0b0ce71d8e297ef11823ebeb4058c2b2b4711bb4aea50a9fdd30c927d2a192c22b3b820ba5abeec3203bd481cf4ec6a49edad55112fafb37109f9840bbf1ec4f4cd26a1a6eeb349e23232cd8da4a83f4240fad71f22dc9e6d752f38b47b769a08d67f3176c72b311b71e8338cd66c12049404770c48da1b9dc3e9f8d3e4d19ecade0559977b360b3361738380054ad3c0f68bf6e95bed5b461235c6dfc7d6b3946fe855d74621860762b3045931c804138f6355c2c6ac70dbb1ebd6ab25b1f38b33c8ace000aa3731fa54c9318dd0c76ca1471995812d4b952b19c926ac8b874f92e5fcd865f2a2539919feea8faff4e6a9c17f1437125ac123c498c79ea3123faf5e82a659e49434ad3c9b98e4a03c7e18e957164f36dda26b75767cfce7ef01df9fc6ab9a2d847dd43622d66434b7065b76e44aef9e0f041cd54805d69b7d78ad297509840e321b71c039f439a75e5ac73c0f60ad245cafde6dc3d47bd489a75d5c889183b246060b2b724018e71ed4dc934545db5b97ede7b694490dec2914b1f1be304f1ef9eded50ea6f0db108b072e0346140c00475a8d204867d97d3c719707e576c03f981ebdeacc908b48d5fecd24d1af11f96fb801f9d4dd2437ef32841779b7252d487fef3274ad27316cdb249fbd0339daa067eb59b75afa46e623630a0ff00698ee23f0a725e5bccb1b4b18fb3baf0779196ee0d26eeb4138b7a32f048ae7e5995d59867e5e84f1c8f7a268b4c8a450e6557914b60be00ff00f5d674a244666865845a0e43a31f947a153fcaaa5dc62472d1dd19369248190173d7f0e29c5bea24acf536e2b9b7949b6997e5fe1756c94f4fc2a0702d6e0abbec7ce15c11f30ec47ae45675a5d471f9aad07da3cc5f979d807a9200e6a44999cac53aa950db54b1c6d07b7d2a9ddfa976b3ba2d488abb9cccc15d78001c2e4fb5491cd33cef0862630db41ddc67b534f9091615e38d012303963f8fbd456f223845df32aef2c0838fff005d4a4ee1cdd099de343bae6476918f0a01eb4d9a75528015763d997ae3b03f8d24914325ceff0030a46000188e9fe7fad4d0e9d2dd2a2c4f1649219c73b79e48a2d77a0f99345795a4681580d8ae71b493c60fad42ca194798372e78daf920fad4fac892754b608c608d86cdfc74e324feb542ea358311c25b78eadb48ebe9fe4d6911c762c98add63ea1423672075ce304d452dcc70ab0f3370e8006031f53f5a8bc98a28446b0c81987cd2336d05bebf9d24b64aa640b0348c32463a01f8d69d464e2e5268c348b920f0ebc30ff1a9e196518105ec6e0ff04bc1ff000aa50ab853e605563fc2181e9ed50ca9f367a543d19e8e1aa36ac6dfef4ffaed3524ff006931fd298df630c4bd94d167d0915908f346a0c72b83ec6acc7aaea319c0b86c7fb5cd09a3aeccbc3fb3ff00bf3a7e3d69ca2c89ff008fb9d7f2aac357be272de5b7d5053d356900c3da40ff00f00145d016825b9e06a1281ee334f585474d44e3dc5511aa0c73a75b1cff00b14efed083f8b4d881f6269dc13340c4493b751181d8af26985251c0bf4fc7354fedf699c369f8e7a6f341beb039ff0040933ed29a2e5265e586e99942df46738fe223ad2ecbb1ff002f71f07aee359e6ef4fe9f66987d1cd1f6ad388c08a75e7fbf45c6d9a216f71c5dc5f42f4a45f638b88b27d1eb3fed3a763eedc0f6dd4a6e34eebfe903fe040d315d1a23fb4319324441ee5fad2837c0603c7ff7dd67fdaac4fdd96eb1e84e697ed1a7edc79b759f7c7f8526173473a81ff96919f63252e750e4068c9f5f32a8892c3696f3e7ea063233d0ff0085279f619ff8f8b81f80ff000a43b9a18d4c7f147cf7f30527fc4c871ba33ff6d05523369dff003f573c74e949e7580e0dd5c1c7a0a0aba2f93a8aa925623918197e86959f522aa1420c0e7f7bf78fad67f9f60cdf35d5c7e9479ba76d0c2f26c93ca951437a022f6752cff01fab8a5cea471fea863bef1cd67f99a7e7fe3ee7c7d052b4ba77005ddc11d4e540a02e9b3455f52c11ba2ebcfce29d1cbaa24a1c79276ff7c823f2acb3369c3817371f90a707d359b6fdae727df029169a5b8e7919ee1cb8018924ede066a2e33cf03d6a213225c14425d41e0d3cb007ebce2b3b9b5af6b171ada29adcdb97c464862e3079fcea8be8c4e0f989b7d734a1b27da86bd4452324b01d29f318ba0a2db6c73e8b0ed51e612de9918a6a680acb932c498ea0b75a8e3bf661c46c79c74a5fb5c873884e3be58552e6667254568e4249a422b603a9c77a46d1d14e04a869ff006a940ff5239f575ff1a84dec809c46bff7daff008d55a5d05cd41754397485e332ad48ba1c6c71e7a81dcd356e24d9b9d1707bf98bfe34a6fc2ee0429f4f9c7f8d1cb225d6c3f72f369f6f0c6f02dc3bc4a70d22a7cb9ea39fcea83e971eff00f59ff7d0a8a5d4e2f2f646efce0b062319a62ea68ab87049ec030a6a0c5f58a296e583a6c207fad5fa6da7ae9f030c175e99ce31549f578770f9481d3ef0e6a27d500c05f4e72451c921ac4e1dee684761660fccf91ec314a6c6dc701ce3e95971ea80361803ec1b1521d4c93c46473dce73fa52e490de270e99ad6d6b691cbb99891fdddb561a2b0073b19bea0560bea2fbcb2a6d5f43938a69be98e33d7e94e319132c461dbbdcde636d130f262dbea7d4548df6699f76c3f4cf4ae785cddb90006c9e802934f59750030239bebe59a39642fad504ac8dff002ad719f2cf1eadd69cad6e87e58bbfad6086d48f1e5cc71fec629c17536e76499ef918a5c8c6b1947ab3719e2070d081df93481a1ed127d6b0fecfa83124abf4e0170291a0bcdc376df7fdf28a392457d7e8a3a05b88d40211063d6a36bb4dc4e23049f4ac416d2e4ee9a203de614ab60ecd83756dff007f09fe42874e42fafd14f635e4bf5dbfeb47a600a8e2d412324acbb4e6b3ff00b2ceccadcc6cde8a8e7fa537fb227639f9c83fddb67342a6f7b99cb31a6ee944d41aaa80c44fc127233d68fed88947fad39aad0f876ee420186f0a67194b63fd6ae2784ae1b27ec1aa3ae7b44a2adc6fd4c29e3a30d2c576d66207eff3de98dac29c804d6b2f82aedcfcba3ea27fde9516a54f01ea6f8c689264f5f36eba7e54940d1e6696d1301b5800ff0017e14ffeda4520fcd8f615d2a7c3bd4fa1d32dd7d0b5c31ab49f0e3512062cf4e507bb166feb47224653cce52d923946d6acbcb391719eb8c0e2a31acd93659d6e1d8f24ee15d98f86f7fb7733e9d1b67a0b7cff005ab90fc3a9d48f3351853270025aad351898bc6d4ee79d1d4d32c163908c6579a87fb42e24242c0c48ec0135eb51fc3c75041d626c1e3091a8fe95341f0eada224bea97c73e8fb7f9557227d05fda155753ca203a9bb2ecd3e6660780633835a7f64f10b03ff001275507b18d457a68f00e9e08df797f27d67352c5e01d1183175b97c71f3cec69a82ec672c6d596ad9e48be1ef1148c7659ee6ecab32ee3f866b2e3698ccd1c8648a58ced647182ade8457b74fe09d0dade51040e938076c8ae5594e38c1af21d4a796eaee2b8b8e6e76b452c871990a31504fbe314a71566cdb0d8aa92a8949e854bab8bb7944d2cad21180777a54e1d5e31c678ce73519c3022a189f0a17d2b9d36cf56708c5a48b1b401eb9f5a45b740460629aafcd4824fd2a5b67528add92adb288cb14cae704fbd382a74007b9a68762b8c9c139c50adf95171722ea48540edc50554f4146ee33403d38a64d90850eec76a7aaeda40e0679ff00ebd2365719fe745c2c89182ec0073f8734dce40eb4d0c7a7bd3f0ce4331ea70077340b442a2176da14927a014dc05a616da7afe14ddc4f539a1813160006070476f5a030dbb81c37423d7350eef7a4f300ebfa521927538ebee29d8c038cee5e48c55779ba63200a8d9cb2eeddd0f3405993b3fcbc1c9cf351974cf00e3b83cd32491721518b28c1e46307bd465b3c9fc78a45244d9191926a684bb65700a93ce6a9eece69cb96203123dfd2806586931b949e9c1c5024527190b9e6ab77e0f4fd6999c1eb49b045a12624057ad24b21663506e23a139a4673c1e2915cda1217db9f5abb6c83c932b4a63ec085079ace5219b24fd6b52d73369e30542ee392573c56d4d5d9e763aada3645bfb5c71b6c6911c91c6d61f8f4a6dd91e58910edfee93c8fc6b32e9522da4a47961f2b11839ab11dc10814a02700fc8e05765ec78b6ec4f1dd6576caeaa7b329e95079b397316e6620f23a0355e7785df7cbb5377756ebfe14e69f638f2cee2578cb75fa50c45cfb3bcdd581503eea90707f1a7bce1311f90f20ef8e3154e12b200d80b2b7dee369356419a24018acca3d08cfb73486462229219a0560c064a39c8229c773032a97181f32e01fcaabccf141379ced3aeee07d0fd2a48ae521f98c9c3740c38a18872152acf6f1abfafcbcd3dd949dec8cce17b1033f514f8eee113ffaa68e5c6728339f7a995a253b812def8cf345b50be854dc0c4af3a98c93c10ddbf0a90ac0ca0acaca4753fe348924a58ec88b267eeb76a7931b6e222745fe20c307e9c53b0890ec932aff007718dc0f5f6e2856fb32019664ec7924530145750a232add01eb43aaca48598a386f947bd17024898c61c31c8ce724e2a47f982b0c71df762a02198e65c9603aaf434f4e23fbc1867d2907992b38001ce327f0a8f686977e00ed8cfdeaaed23abf111d9ed4e397427904741d334790589c5b83b8646df4c5441a30c48233dc11d69c5c1404c79cf54269bbd6363880ec63d33d2840249107077673db079a11d63508f919ee075a7cb0c520c8c83d41cf3500063dce24257bab1e2985cb0afb58a805c7622955c91f3ae0d44b37cdb97695eb907ad231121046406342b835a12baee3c020375a472e8982d9c773463181dbd4d33e632100aba1eb93c8a0489a1652010ccc3bf39a562598051915043088656231f354ec49208c0c75a684c45d8707a1ef4d9233f7ba7b8e2918b31c2f39e99a0af988636c8cfbd016ea35524572cce4a76e3a54a003ca9ebe95144182ed0d95f7a7a808703033ef40c702318da4367ae68da841dca0fa9a70504e7bd1d33f2f4a05b88a15576a9fcea224a3e3341dff00780fc09a7ef0d827afa7a50047e7649c8c91444eadc805483c83de91d407de3209fc4528ea4d307dce560b76b7bb9622a248e48ced20ff0010e473ef8a49efee99e348a4d823c380a32db8818fcaa9d95e4cc7284010904b374033ff00d7a59947dbe2904b9cb2e3674ebeb5c3aa63774ec6b5ccb3dcc688e2494c43cd3232fcaac074e2925beb758ad70fe6157dd2c4c9c91f5f4a735c9b64ba8b7b246cc523007dfddfc44f72076aa9e5592832470cd339c86333607fdf239a727d02c59b7d484d791c8e732bb1191c05041e31d8541bede451194902a020045c67f1c7355e2baccb6ef2e442bf7d63217bfa76a4b9d45ee25cd9d9948d4f0dbc963ce6a391d85245a8a5b781da54b79323f81d4f4fa9a9d264ba85258f6db33120064c648f5c5450497a230a6724fcd8561f973eb562da5bf309fb46194646d9406cff00f5aa796c8cdb8ad99225fbc5fb9b8888b853b4b019041fe9c53a17b7b890a1dec4f501cf7f4e6aacbe548af08767f4191853fe1cf4a81ad85b4844cf18e9d1b24ff5153cb6364d32cdd0556680cd3aae7e5dc3703ed9269d1a138169208655e8622c01ff007971fca8b699038597f7887a2bf39fc7ad58b9b801555774608dbb43114d3e8473aee560b2ab0926487cc5c9dbb376327d7b53e4f225816365501d7276f41d466a3695a35445f9541270c739fcead99cb4496c36f037e49c026869dc1c96c8486da0b7b59046c1f7f0c370c66a38ed0c3007da143b630ddc77a80e11c452a10e5b7053c127fc38edd6a6b99ef4911cfb5d98e32ab8083b003b0a2ccab1248f75b491705d0e07de0401e98ed50f9cd0dd90fb9724105941c8c7a62a686ce3ba88adb3866739da5c723e99e2a57b3b98d45bcd6e2683781e5939643f5ed5577d44d24412244cad334506c700b346a40600e3a7ad445d0a902708918232a4648249c55ad57c9b542aff003410a7ef083cbb96e00ff3dab9e4792e6e1cc31490a95f9431fe2e3af1f5ab777a1091b2b24042aed925dbd4631c7d0d5a96e5de0f22dcec0d8cb14c003d2b2e3b799950c866c93822d90b67f4e3f1ad9b5d30401da78c200380d2977c7bf61f852516524efa141edaf15bcd3e5cb1ff00d32e76fb906996d712c5991c10ca30013904f3d79ed525d5c3b176b74291a71bc100115592f56db74db370ed9e003f85527676439735ec2b86bc766b7cb4d9fdeb0e59893ebdb8a040227717055439c905b2579f4fc3bd44badcf2b36e6ca31c9283007e1501b8f2cb480ab1e42b2f03154ef71a45e3036cc05c2a93b649580cd557180723da9c6f2e5dd634f2906ec1c0f9bf334ddfe75cdcae772ac870c3a62a5aba3a284f96431302a620647a5560c564ab28428f9973f5a83d884ae380039f7eb4fda171804827a9a8d5b35392eca149c007807b506c204038e29c110720f3ed42f0c00e9de9c40c7ca41c9e9de81590dd996cf524f5a6941b87f5a793c0e307bd191c9ea68292421836e094c03d334a2150a49ef4be6120024e339c52efcf391f80a62e51a2251db9a53100791834e2d8271cd1bb8fe9483950d110e697c953fc3f5a70618f6a5127a1c7d681a8219e4ae060629c2250338e69e5c05c0039a52c3700d8191da81f2aea47e529ea0fe140810e7814f2c00ce7927a629492003eb431a8a23f2148e9f8527d94127e5ffeb54e0f34f0c8092db8fd0f3481a45668232157681ef4c16ebe82a562320e383d6957e6e839033c52dcb8c12446235c0c20cfae286b75232074a9540d98cfd68c8cf1de80695c22840f41c719a7343b980e3d334d47201c1208c8a58db73f39c52b0db237185ea7ae3e955a5c220e807738abd228c38ebc66a8dc8261070791fad524673a8ac6e585868da6d9db9bfb49754d4ae144a60f30a47046795c91d588e6ae0b9d29805ff843ad76ff00d77623f9d57b33baea52cbf3182ddb9ebf7318fcd6b455104797030c08c0ec7d6be9f0b97d19d15396ecf83c663eac310e9c52b2ea5295ec59be4f06e9f81cf33bf3fad301859c2a783f4c058e32656ff1ad1f31415322021452b298f610d9079fa5742cba8ad1a68e4fed2aaf58b4d2f53663f06ea489f2f87b4151d064b9fc7ad4c3c17a931da74af0f47d39f298e7f5af40898bc11b6786407f4ae6bc61e2b9fc2e6cbc8b28ee7ed2581dc483c015e04e36958f6e1272499843c15a9b607d87405046726d4f1edd694781b542338d12307b0b2ce3f5ac93f18ee58b05d22d860e3e673501f8c7a93b1dba7d9019f56ff1a7ecfcd17691bdff000826a44ffc7c692b91d458afbd3c780b50ea751b21c745b14e0fe55bbe0df114fe26d09afae228a2916568cac79c63008fe75c36b3f13f5cd335cbeb158acf65bcce8a4c5c9009c679f4c52e457b5c4b9af63a05f015e6c19d5d14e3a25a20fe9f5a77fc20370dc1d726ff0080c283b7d3d6b8f8fe2c7891087920b631af5060201fc6bbdf09f8ff004ff14edb5923169a8f5081b2b27fbbefed4fd9f660d49149be1d2ca8525d72f5d4f50028fe94c4f85da72f5bebc3edbeb63c6daa5ee85e17b8beb07f2e7899304a83c1600ff3af2e83e2078c2f242b05e4b2051f3795006233ec054a8a7bb12e67d4ef93e17e9092175b8bddd9c83e6918a99be1b68c41cbdf13db74ec40ae08f893c78ec409350e9c111607f2aec3e1fea1e21babdbe4d6cdd15f2c3279d9c673da9f2c2da31b524b73413e1bf87801be19dc81ce666e7f5ab0bf0f7c328b93620fbb3935d36704523fcb19627071d4d4b4894df73053c0be1a1829a5c07073cd4bff00088e810a9234bb603af2838ad92370c6ee4f7a065c61c83eb9a5643bb32d340d1c60a6996a39c8fdd8eb561b4fd2ecd3cc920b3810777555a35cd5e0d0b47b8d4661b9605c85fef37403f3af1978b5cf1e5fa949732005a42e7e441d8014d25d4695fa9ed36c9a75d8c5a4969373f7632a4fe552ac0919388d3f115e1daa786f5ef074915eb5c029b80f3e0246d27d6bd3fc0be2693c47a33fda8e6f2d982c8dfdf53d0d3b45ea81c7b176ff00c59a06977725ade5f08a78c0dca109c6466a93fc46f0ac633f6f95ff00dd84d797fc44491fc737cb1b61ca232e7803e5e6baeb4f851a74b6d1492dedc333c619b69c03903b534e2ba05a295d9aeff147c3287086f24fa47d6bb08e449e349a3cec9143ae7ae08c8ae123f851a2a10de7dc961fedf15d84ed25869128b64691e0871128e4b1038a1b4f644be5e865f883c65a5f878b452eeb8ba1d608bf87ea7b57356bf172cde665b9d35e38bfbc8f922b0b41f09ea5adebccfae5b4a903e5e4766e5cfa75aea3c4de01d14e857335ac02da68232e8ea78e0679f6a3996d62b45a1d7e9f7f63abd9aded85c2cd039ea3a83e847635680cf3fcebc8be116a539d62eecba432c0642bd830239fd4d7af9cfa52b2b8a4ac721e3cf154fe1cb1b65b19516ea7723e65ce140e78fa91567c0fa8eabac683fda1aa4e5da773e50d8176a8e3f535e63e3cbf7d7fc6a6d6dfe6489d6da35c679fe23f9e7f2af69d36c934dd36dece2e1218d507e02a9bb680d5a25be48a72708dcf279cd34e767cad81eb4dce181ec78349920fbb61c1e7d6be79d665586e9f27813cc01ffb686be845248618cb02411eb5f38f8887fa4cca463175381c7fb669495e2cdb0ef96699025f465fa814e8cef87703cf7ac07193f4f4ae834d917c855c751d2b979523d59d79377b02bfcc38a9c1ce4e719aaaabfbd27a283521203614e6b268f429e21492459de063bff5a709304b29c022aae78521b271f953a33f367d291b6b62c0918b6d539fad29949032dd3b1ed51928f20cfca318c81fe79a61c0279cff005a645ee4e24ed4f525d828e4f5e0553e09f70739a9ade678184aa583a9cab03409ed724320c920e79eb486438e4e68baba3752f98d1c68c7aec18c9f5a8431f5a6f4126eda936f2d927f3346f1b4003e6ee73d6a06727393cd26f039cd219364f7a633e0e41c1a61999f934d77c0e1b934312648594a8ce724f34ddc0375fc698d855539073e94e89adc8944c5c7cbf215f5f7a455f414b7cc7a7d680c33eb51725770e71ce6901ea7f2a01ec4a5c7b7a534c9ea79cfad42cf8ce0e29a18e681226dd93ed9a716a854e0f3fad05b279a41725dd9fad26727834c072314f5049c0a06de8398e23c671bb8adab20b158c0220db48e4e6b06fd1b6c4003f3646077ad9b706dadedd59240fb7860381f5ae982d8f0f193729924d70e136f96cce3f8597355a178e48c398463be3820d68c52ef8c9f2d98e70463f5a4644652ca30ddc11c8ae8b5ce3d8a1079503c8c19be639c15feb4b2c49248cceaa40391918c7e3564be3276649ec0f5a8240b247fbc88a11dd1e90104a91b315612a8cf0d9c03f88a759279739da6405b87c8250fbfb511cf12ee5dece1ff00848c8153348225055241eea32281b2e2dbb07f98a48b8e06413514d6ef0bb34732229c1db21f97e94d82787cb49586e63c64800fe356559262ca1703fba57a1f5cd344f52279e3951234db91c1dbce29e2d96166d923306e4ab1fe54ff00236ed10c6a09ceeed9a42970194ed5603ae4f22817421c3ab1c5c063fc3dd80f4a542ee489890b9eb9c63f1ab30a2ba162bf31ee78a83cb963b808d2011370a09e94c77b8f2ca46dc02e31827bd2f981096ce7079cf4fce842ab215da01cf5ec6aabac2b77c931cc7ee90df7bebeb4809a39272c4b8017f84f5352c413737724e0f6e6a19e45897714259474519e6a18aed6fa36051481d4138a181764dae30a3071d7d6aa887cb18595f39cf5cd4aa36444c6777b3738f6a6ccff0070a041cf2314087801f208247e74f8f69183c0cf19a48e5c90080bef9a6317f377c720dbd0a11919a486c02450b3926423ae40ce2a4f91a3f9183823934df29a5c866ebe9c6299e57d94e001ea09a18112a83f2290d1f6607a54d02ec2ca7667d41a649b890e8003d4e3bd01b2c588c9c7245313bb1e433bf03e5f6a5200ead9f622988ae5fe662add786a9490a4720fa9340088b9c8e73d79eff8d3b68ddd483e99a626133b48c1ea01e9433614e19bea2988602e8cd1b6e700e54f4352c4c24c6edc1bd7d2a164dd870cc5874cd234c00e73b89fa503f526c1524b052b9ea294a2b7279f634d12ed43b80c8efeb4060e7da815877caad924814e7c0c367daa26e64dbebeb4bb401c820500481c74eff5a848c3315e1b34b228fe11518750e15b863d0d302559723e618a404eeddd0f43e869381f8d46922ee2a7a8f6a2e0fc8e3ade116da7a0e7cc918c9213d80e00fe7f9d48fe5c040755739f923ea4e715146266413484e586d04f4c7d69c2558d995db9dbc90bed5c2eeddc7b92cf20d41c6d88c417811ab6ec67be6a12f2aa3451ab4b246400e1338c7bfb53d59e18fcd8a03123ae4cad93ff00d61f953227174ac8d313cf576c2d16d412e858fb1c974f6ed37951bb01b831ddc67191838ef4e96d2282f859a46d201c9c36d183dfdeace9c634b7767550a095326783f4a0dbbdddf14864c48719e3a2f009fcb9a24ec4b959f29525ba999a45b5806106d5283764ff007bf0a8dadafeeae42895fc90a33b8f19c73c7d6a64c091a3863ddb4e0b118c0f5fad4d25ff00d9a1db046e1b3feb255247e9468912dae9b94d74fb8f38f948d21076b2c7d47b9ad63a6dcdcb7c903aaae103bfca0e3ae3be2b2ed5e609e61b928b2bf010942f9e6ae42d390dbd54004e1771240faf7a525eeea68f6b363ae34ad455b71103007841228a997cdd89f6b3079a790448b91fafa54124fba4264656c6368cf4a84347249fbd58f69e176ae4e7f1ed59a7d109a86c87259cb24cca97b6924792dc4c32066ac7d99ee65610cd094030c77839ff001a2de0b012aac7308e4ce0168f0391d09cd675c9741b77ac9b0e032703a93fd6b67d18a3e46cbc910b7892748e46031f29c95ff749a8803244be56fb8009dae3aafd71dea3cc7269eb23ed960c960aebbf823eefae41a9e699cc096d66e211b46f45215df3c919eb8f61438a092d74218e0b7b86122c6495ed8fba7df15a304f2a95133f9a232194b2fccbcf4cfa56279f05a8cf90f0856dc65476ce3d3d3b55b4b937303949a3dee1400548239ee688ad089464886f2117332c4f97dbf3248e78dd9279a891e592fa3b7fb31124adb413d3ebfad49742782695cc23c93f286043295e8338a8e3ba58e137317df88103bf24019a56572d3d2ccb16da8c9a7dd3fcccd1b927cb538210640627b67b0aa1aa6a37776eabf3242ffc1fdefa9aa851a79d406393f7896edefed57b52436fa9031f31c28a5bd0b1e99ad52d12345b6a437f2358da45680a8965c4b231fe11fc283f53f88a89085b199d86e4dc006c9f5ab12da4e0462f64026b9064418c91d319e3bff8510da49731a79886388363638039ee4f143b2d582654b83b952dedcee000dc40e393d3dea70be44480fcec176804f739ed5a77912b451189048df770ab818fa55691bcae19548cf52307d6a14efb09bb925ac496e9f379734e4720f45e7be3934fb89e43395201018a958d7007e02a1b57816369109576cf43c60fa54534ec8b23c72aa3e382a091f9d538f51a7663a652af9ef9a456249e739a455636ea5983919048ef516ec62b36ac7a742a5d1651883e98a9f71e71d3d7d6a96fc1073c1a983e0f348ec4ee5a57ce0fa7b52ee030dbb06ab07ea335224cc887190586d3ee3bd05dc973ea79a50e406518009fad405f238e6904840619e948ab93824fde3827b9a6f4079e4d46ac49e5a919fe703a7ad017270dc633d7ad26ecf5a8b77ffaa8de03632681dc98b0f5eb4bbf22a0de09e694be31edde863b964f20127af3f4a52c9b14721b3c93557cd3d01e3da9c1b205302c93b4e0823eb480e7bf02a1ddbc75e68df91824f14ae34cb1bf8e7afb52a86704805b1ffeaaac24a0ca71807ad0172c30c27cc086272a4fa5373818079ef5126f949551bb009fa014ddc78f6a43e627dfda827231daab87cc84f4cd4892ec7dc38e681730bf36e61da9d196cf079a883e64639ebda955bf79c9e33938a0abb68b5b9096123b8033caf24d73d3ea72313185e01ad4924214e3a573ce0f9cf9f5ab859b38b12dc62ac779a6b932db1c8cbd844dee70ee2b5d8130abe00c71f5c77ac2d25f77f66b83f7ac9d327da5cff5adb8dca10d8008fc6becb2c4e5874d6e99f9fe6b251c4b52d9a100391c7e552b1c42ab853924fbd4625c050a0020e73de8df9393dfad7a328caa3575648f2e32a7493b3bb67aee9f207d36d5b05b7449d3b715e7ff0018079761a54f9276dc11807b15ff00eb5773a0c81f43b23cff00aa031f4e2b8cf8c11e7c2f6b2609f2eed738ec369af8cc42b5492f33ebf0eef08b2bfc3ad0f4ad4fc3d73777b610493fdadd59a400ed18181fcebb44f0b68d82c9a55b151dc229af02d2ac357d5e56b4d284ceb8dceaafb557dd8d6ab378a7c0f74923cf3db890e036f2c8fec474a9b41eef53771bbdcf73b6b1b5b088c56b0a428dd422e066bc1fc4a8abf11aed1d01537cacc1ba1c906bd8fc2de268bc4fa28ba1184b846f2e78d7b37a8f635e37f100987c7ba8302c0ee46183823e45a4d72cb5263a3b1ef13697672ab44f6b1b29c8c6ded5e0baa5b268fe3cb88f4a7c456d76bb0a1fb878240fc722b4dfc55e30934f01ef2f7c964c6e58cfa75c8159fe0d6d3e4f16da3ea0d980c809c9c0dffc3bbdb34592778b292e5773d63e22a87f045fe54e3084e3b7cc2b88f859aae99a7dd6a5f6fbb82dc3c69b4c8700e09cff003aefbc769bfc17aaa771093f9735e1be1ed0aefc47aa2d9db0c0e5a473d140ef4ae93d451d533e80b2f11787efe7f2ad754b47958e02b1db9fceb59a2f2dc82bb4e2bc3f5df86b7ba1698fa85ade7da7c905dd76e0851d48fa574bf0c3c5f77a9f99a35f48d298a3f32ddd8e4803a8cf7155ee3d84e29abc4f493c0cf614ecee8830048cf6a66ec6466951580dc1b6fe3d69344263b61cf348319e3a5213b9b05f3f4a01cfd45494729f125b67832772b90258f23b7deac3f85051935223afeeff00f66addf88a81fc1978ae3e50d19ce7fdb15cefc250449aba6ef94942a7d8122994be13a6f8811a4be0cbe5907c83631f6f98572ff0970b75ab28c6d2b1b0c7a64d753e3b5dfe0cd4f9f97cbe7f315c77c2638d435150c486b746ff00c7a902d8cdf882153c657926d50c204218fae3ff00ad4b6ff133c4af1c50daec09122a6e583774f5357fc7ba06a5a9f89de5b2b595d0c08be62af1919aeefc3ba0c1a5683676c2d911bca53302b962e47393f5a14f95e83d9183e1ff008982f2e23b5d6e08a2321dab731f183fed0aef1829e579f43eb5e2ff00112c6df4ef112882311a4d18760bfdee47f857ab787e77b9f0e69b33b659edd093dcf18aae6b932b5ae5edaa0e7001ce6bcb7e26f8ab50b7bd934389912d24895dca8f9981ec4fa715ead81e99f5f6ae73c53e1ad3b59d36e9ee2dd7ce1192b281f32e01230692f775428bd75397f847a65a0b0bcd4d2457b977f25901e517a8fcebb9d73534d2343bcbf271e44648ff007ba01f9d791fc28bb960f160b60c424f0b8917b64723f97eb5d3fc5bd45e1d36cf4f46c0b872f21f50bd07eb4e25495d9cbfc34d31b53f1735fcc0bada869598f20bb703fa9af6c1345e608ccf1076380bbc649af21f0078b343f0f68f771df0956ee49370d8b90c31c0fe75cb5aebbf65f1647ab61de15b969844cddb39c534afab1b8b6cfa2720e47a7ad35b9e0f0bd01aa5a26b106bfa545a8dac6f1c523300ae72460e2afe091ed41935d08a4f981ee7a3738fa1af9e3c4c317f74a73f2de4ff00fa157d10eaaca770c8c57cf5e2741fda97e076bd979efd6a5ad19b50f8d1cb498fd6b5ec031452a402074cd63c87e61cf35afa697e02c41ce3a1e95cacf5236e66c940dd2f3c1279cd2be03900e71de9660e927cc8133d1735113b9b2b9c5448eba3afa0f5c9a915bffaf50ab153c5389cbfa0ef508ea6cb0fb085f2f238f981f5a8f71c807a8a6b37381c8a371c639c75a64263f770739f6e68dd82335197c81406e79e680648ce78ce314dddcf278a4246739a4dedb86073ef400ac79a6127b5231c71e949d79e940ee49b8edc1fce987b534b7cc3814e246dc01f8e69096829255c67a8f4a4ce4d33273467dfeb4143f3e9403f2d37d3b5293c500d813eb8a69c0e694034a63dc780680ea008c63afad2814e587daac7d949c1f5e680b3b95c0cf6ab50c5cf3d7f9d3e3b5ec7af6f4ab49095346e57295750fdd5bc2c0725f193dab496397f71940f1ed0783ce7fad437912c96f1ee3d2414e579a2061561229391919fc8d75533c1c62b542da283271946f43c538f9ac4ed6643feee73505b4b2333b96465cf28e30c0d49e63a36634f97b81d41adce2b11144738906e607af714a4ac4b87c8ff006c27f3a4124bb8efec7231d87bd2c77196923923e9d0fa8a4ca2a8b6cb821848b9ea38a9e0527cc5329207054632b4fda262a616c6debfde1fe352b44b2283921fd47534584519eda32a1bca79093d73cfd6ae5b98828c170c38dbe9414942ec2c7ae72bc1a73c4cc73bce41c8279c5160b8efddceeb8660cbd579a98b6dc0f9b81d3d6aba96ce54c723f43b4e09a91983b15920240a621877ed26267e4e76b1cf34d04ce0a4d1927af23a548c89b3cb40707f841e950302910b7dcceb8c673f30ff001a631fe6a400230603b134e6c170180e4704f354a56b97b768815de3ee93cf1ee0d161234aa62ba088eb8232704fd2a76027690970b9d8fd06738342b48830d06fc1fbc30334b2db891d43e4af51ed4c96d652fc374e8334dd85b8e5b88c3e0864279ebfa54a19251938c7a30ac4bbb466937acee48eaac3356d6493626d6424750d906a5b1d8bee2369368239e7069970b28c36d2c7b61b14c8f71ff585140efce453c484e4385603beee68404b1c8719e437e751389321c904f6c536790ac60f98108e4e79a1b12211bd806f7fe54d20244793009f981ea0f045292a8415ea7f435044ecc0a48ca597db19a712226240604faf20d0c098b8c1ddd47208a8c4847cc49c67038a8a395fcc6da9951d79e95333b150f8181f7948c8fd295c07ed18072781d052aed2339ebdcd11153c9e07d6a29ad5249036f65f4c1a62bf71eaf872ac334f6dc40dbdbbd3843851d71eb9cd33cc559391cf4a6213687c798bd3f5a8d5d50942ac067839eb561be751f29fcea12724e1b3f5a006ab2b36c57c9eb8ef4b82181ddf5a66e8a5073c48be831513453170164c8eb9345c2c8b6ae49c6727bd3f62919e79a8431cf272475c75a915b38392680b11c91b02191f233c8eb4a0f3cf7ebc53980ddf2b609e71eb4d218e41e9e940ce6aded3cfb37599582c0d905b8e7bafbd4bf6389a5dcc18ac98c29ebef4f7bb8fcd49046be528c04619fc73561520b8749e32f0bab6e20f22bcf4dab92e495ae36511dca3c1f7940c3865e9f8e6a3974eb39c1063912275decead91c7538edd055898b5c0f970a19b390bc354a93ada4db4001001ce7b91d284e56bb0ba4f4335b4d9ed70ac54c247c8ebc861f4f5ab36d035a413483e69661b54fa2e31fad3d660d2488bb8db38dca4f6ed8fa8a5483cc924128601bee166c0e9c63f953b6b662726d5d1423b86864917cbc499000c02307faf5a52aa8ab713485633f723e9b8fb8ec056a2dac298df18242e4e5f18fc2a95d2fc9324a54c8cca15517a2fbfe74b955ee885a14ae62125d27932302fd0498209ff00648fe4694f9b6f09dc0066cee566e95a36d6cb2a24cc15933c3723353ce96f20569236f39472636c647e22b571d4b5268ca58e28ee101b559998659f1b47e5534ead34ab24691a827a20c71ee6a74b382e2206391e45270c08c1151857822e2160b9f951792001eb4b44ac127d6267adbdcbcd247e53aa1c82546723eb57934db40818c2e00ea0be7b7a523ea53421caaed9506109fef1e9f95456f71a9ba2885de698824a9c6dc7be693d15822dc916a3585edded1d15801bd4afe447e5cd515d284b712cb995547cdb95b21bbe3f2fe552c1343be26731c179d328df23ff004073f5157da50261b5427cdfbc8d475a4db4b42a29df52ac449511344ac8d9c895b38f6aad235bd827c91c318724b02b919adaf30190a204237e090b4cbb49e085992d23b8cf629b81fad4c249ea535dd99d6f7ba5be2393f74cdd1a353df8ff0039ab326990dac9bd6ed8a3e082d102a7f1ac492c6fe599e6162f6e3fd88d8a9fc6afe9b3dfb1f2f747f6540432b0ce79f4eb9ad6cb725f90e974bc9fdc36d5e38001a8ff00b299e6569e5790ee04e4633ed560d800fba33225b9c9dae7907db8cd5852d0a00ac42f5dee7fc6b2726b6635a11df59df5fde4722ca80280a36ae08c9fa52ca96b03667cbfcdf7cc8793532c8462449863be09cd51b811de4fb5e4d91a200a8172147f89cd3e66f70bea0f720b3b42ec0a8c823a73dab3ef239a5613f2e98c11bb27fcf4a9e58922936b1fdc30f310a8c820773ef5225c92a4c6de6b13c2887193ec41aa8aea3d0ac8c8f1aa3c21485e4edc60f614c96ce1797f7972c58e36aae38fc0d5a11b4a1a1d844870032c9bb6b1e4e7f5a98db452ca59dd542ff011f3363f8aadc83a915bdb08ad98ef66dd213823a67ffd550c91150081c13c5682b99249e368c2aa80540390074aa730c0c0f4a97a9d547c8ad919c66973907279ef51c808ff0039a40c435267a1077270f823d29fbbbd460a91efef4bc0e07e748d398783c900d191b8e3a547d39fcf2697934157242f8c51b816f6cd464f07bfa629411819a434ec3cb67a526ee2908c9386c8140662bb70393934c77d07ee2dc0e949bf18cfe7480f5ed8eb4d27de8dc57b32552bc64f00f34b9cb7078a8f39504e41f5a40d9c521dc9b705041ce73c52ef24e49e6a30e4723f5141391d680b92c7869554b85c9c6e3d051c0936e41e719cf06a22a7ef019dbd69a1bf4ef9eb45869b2757da0f239e334646075c9a841e4fad3b39e39fca82931f9c37f3a713ff00d7a8b3c7ea680c3bf4fad206ae3d0e59b34f3f2b0e78350f265e3269cc7819a0398495b0a7e9588fc4edee6b626ce703a7ad64ca0acc6ae1a339f12ef13add19bfd1b4b63e9709c7fc00d6f805b8ae7744f9b4fd35867e4ba957fefa43ff00c4d7a368af1d8787afb51486392e6391506f19da0fff00aebeb32dc47b2c2b95afa9f079b50f6b898c53b68ce6f6ee6c014bb08e4838cd6edc6aa5f52b4bfb5b058a765dac0ae5643d320569f88efda1d223b29d6137d300d22a2802319047e35dd2c64d72ae5dfccf3e9e0a0f99f36de46ff875bcef0ddaaf4c0c63f1a8bc5de1a3e29d17fb3d6e3ecffbd590be33d3b51e1262de1f839fbacc3f5ad3d50df8d26e8e9acab7aa84c45977024738c57cce317efa5ea7d1e15feea36ec73de0ef068f09a5d27da7ed0672a7715c118cf1fad56f89d0097c0f78db4178de36071d3e619fd2b98d33e2aea565aa9835eb75922fb924714611d0f623d6a1f1b7c44b4d6f446d334cb79156661e6cb371c039c01ebc0ac5c3ddbad4ea7077b96be0ecc776a909e8551b93ee47f5ae6be24c613c7776d81ca46d9ff80fff005abb1f84da3dc59d95e6a3382ab7055625231951ce6b95f8ac9b7c64188fbd6cad9fa330a993d87a731ed168b1c9a6dab18d4ab4119e467aa8af16f883a645a6f8be592d50451bc692b053fc44907f90ae8ac3e2c5bc1a4dadbbe972bcd144b1e44a304a80335cacd36a7e38f1117118592565da14711a0f53edcd54a36d4951b3b9ecb0daa6b9e15b782ef732ddda209307939519e6abe87e08d33c3f7ad75610ca923a14259c904707fa56a4766b169b1d9464aa2c422041c11818eb5e33a96a3e28f086b68f2de5cc8b13e63794968e45f43f852f75bd5896add99ec1ae26fd0f50400736efff00a09af1af852c57c636e0f4682407fef9cd5ad7be286a9ad69d2d85bdac36c271b5da2cb3329ea07d6b6fe17f85aeac657d66f6231164290a30e707a9a1ab3dca4b953b9e9f9c1cfe94a06e396a69e47bfb548bf32647e3ed433340466998653d7229f83da9a393c74a451cdf8fd0c9e0ad48609c206e39e8c09fe55c6fc24bd8cead7968582bbc0bb14ff1ed3cfe38af52bab78eeadde195728ea548fa8c578f6b1f0ef57d2af9ee747dd2c60e63d8db5d3fc695ecf52a2fa33d0fc7d2476fe0bd484adb7cc8b6203dc935c47c21573aa6a2d90634802eec772dd3f4acc87c2fe2ed7888afd2e3606ff597326428fa57a8f85fc376de19d285a404bc8c774b21eacdfe143b5fdd1e890cf1078bf4cf0d4f0457d0dc13302559172a71db35674bf1468fad591bbb7bd8e3551f3c52b80ca69be21f0e59f88f4f6b4bb07d51c7543ea2bce27f855aa432325bdec2f13742c31ef4ef1ea851e5b6a50f885adda6ade2345b075b8448c46581eaf9edebd6bd6745b59ed3c2f656acdb2e23b60b9feeb63fa572de19f86d6da55cc579a8482e6e22398c018507d7eb5dee303146fb0a4d5ac8f1bb0f883af693e23116b73c92c10c85278828e472370fe62baad7be24e88ba4dc2e9b2bdc5c488551593685cf735b1e20f05e93e21225b888a4e07134670d5856bf0a3498650f3dc5c4ea0e76938154e7dd0f9a2f739df853a44d2eb926aceb88228d954818dcc6bbdf157846dfc50f6ad713c912dbee002639ce3afe55bb65616fa7db25bdac2b1c2830aaa3156369e700fe553b93295d9e790fc26d2638ff007b75732b73f36ec579bdbe9313f8be2d1a5919a117bf672ddca86c7f4afa2f6311f7185640f0a69105efdb52c225b80fe61908e776739a5cbd814fb96749d2adb45d3a3b0b352b0c649009cf5e6ae93ec73eb4d69a2560af346a5b900b819aaf2ea7a7c2cab35fdb21627199455a8b27565863c1fa74af9f7c58806b3a911d3ed9273f957b74de23d1218d99b53b638c8203e4f15e19e20bb8efb50be923523ccb8794027a0278fd05134d45b36a0bdf472f20f9ab5f4d9da0c91b4e5790c3359322932f35a16db576970d8cf2475ae33d570bdd22cb4be6cc0c87bf34d56f2ce54b023a1269268f329319c83d33d714817b1eb512dceaa0b4d070f98925b24f534ee3914d09d33fa53c46777538cf06a2e6ec4ddce4505f2318c7f5a7f927a52884919340244209ebda9492460d4fe571ef4e16c4f6a0762ae3af38fad1939c9e455d166c509f4f5a5fb1b038231ef40d2451c1cf426808c462b496cc8c6781eb530b355f9b3d68b03b2323ca603814ab0b646722b6d6d5028724124671e94f30478071ce7907b51617323156d5ce700e3d71522d9fe38adcb69d6dfcd210112c650d3635490b06654c0cf23a9a7ca473774637d89f1d38cd4aba792b9ee2b409edc1e7b52e739ec28b17729c5a78e84fbe6a61620293d4d4e1cb328271ef4b9704f3cf5a340bea57fb3041d3f4a50b8a98c98c7f5a8cb71414872805f1802a41c8a20b779b942b81c92580c55896dd634cfda2367ecabcd34bb039c6f621758dadc87071d78a6244d12078d81ff648fe74f76db1631907b5226d242866575e1589cab0f435d14b63c5c7e950102efcba08cf6dbcd13486370e543c64f0ea79a49230c43a90a54fca41348a4e4aed080f503915b1c0084cd73821815e849eb52cc06dceece3a13da9857185fe2ec40c1a2465249239fe203ad08056cc89920673c11d698b3372b8f980c10c28471bcae18771c1e690b01364370dc1278229879082f4392c49f947f09cfd7eb532cde7fcae800ecc2ab2a46f21c3a92bc8ed8a420890b1ce01c9c74a571d8b0f6ce0065f2d874240c123d734b1dac9049949a464279576c91f434c4d42247642fdb3daac25cc4df2e79c6739ea2817407768d41f2d9a9a8e2756dbc38e30c2a42cbb7686c7d280841cefc9ef9eb4c467cb1cf1bab8dd23af05738c8ab0238e588128539c827b548d3468e14b73f91cd01d1c6fdc08ce7038340f5646c00015cee43d1bd0d466794f4472a0fdf4c7ea0d0e9f310b2751d3d7eb55fcb960dc43aec3d7b11406a3a7591b98c49b81e54f14fb6d923e66409274f9ba5311c8c1321381fc22a4530b26edc194f5a4f5024ba0c9fbc51918c654f5a89e15640fe4fd067a53a29a3f264445da739475391f434d96725017c1038071fe14ac31436f93cb601703a3d3d91413819c75507a7e150158e4908270c7ee9ce7353c1102393f38ee38a2e02ae598f96a09c678eb417c8cedcff4a709769e0e1877c530333364942a7a8a771752354613f9a8dd78c1a7412b095bcc001ed8ef53448b83938e7ad37cb2b2938dc0fb5201d90e768053f0e0d3f7aa654f5c54529254e4e7e9daa28d9d7a90e01e942b86e4ee091fbb6c027a1351f4387e48eb9a7488264c6703b60d46b88994b820f42dd734ee2b161665da30c39a46209254e0f7e3ad33ca4f3b7af19fd69eca01cede7da9a07e4465806dc71cf7c6315237cb1e5464fa1a6339c708493c60d3c7fb3fce8b750d4095c876186f4142ba33e0719e6a0910c8c1f25587707ad0edc0db824f5068b8899e3123e09381d0fbd2a962b9ce7151c4db549c1f5eb4e32061951d3bd00ae6541a63b37992caa9df2c7e51f41577cab008ecd7ca3601f36315816f1dcea12a0663e50392c0e07d2acc90fd9a5dd210229061848724fd2bcbe597706e3d4d4836c61a52eb244f8c80dfad35ad3edf2c6d102e8edb5811e9dcfe5542ce39259dc43182546edee3008f6f5356eceea58a0b87dac3171e5f0319054e7f953e56b51595b412375585d554cbfc58f438fce9904b299d2195d513cbf9940fe32723fa54e2286d228dadb3e61ebb8f5ff3c55576336fc8cb6fc1dbc1c7f7b34026f62d0b83148a64815d7387f970c3df34e91487578558071d09e4633c8c53c488d33b1c800609cee25b38a6dd4afe5c5105218bf0dd30a7b7d7352b441be8c6dd4ac2da295233b48202e7907352cd003711db221dca837f392ce7924fb0e07e15134b125c2c6acb98d55791ea7fa9a75e1528e236da64386917ab5536f71593d8cf9a7905c889254dabd769c08fea6ad0bc09fbc941e99f30ae01a867b5892da268a5f3234277bb7250fa103f9d52bccdb8845c348fe69dca1a33839e9c678aadf4057d8b1fda56b0cd1b5c5bf9c92360fc99c0c727f97156af566b9558631691dbf0304ecdca7d39fd2a8068593114aca777cdb46467d2b46dece13225c4b6ea709b3073d33d855595813b68cce9f48292accf1af948c0279437123b0ebfad68476b236c649211c61be7c1fa53a6b88e4429047e575eab86a881468c349b566c631bbf5c76a8bdf42ec4ad6e4bca7cd0ca7ee85e80f7e692282e560511cd1aec6e1558a823dfb93491a2888e42172dce793c9c547258dc2ca1a2ba843120e0c806285a3d0ab772fc7f6b5955f0080324abf3f955a37293e3ed16f1caa0f2eabf3afd6a00d7d8024d8e7b1085bf514c71243fbc5cc6fdf3b803f98a4a724ecc9705d04bd89370b8825661f5e9fe1545a46323abb96de3e5a966bc0f26d89374ac3e7d87e523deab4eb6d3d96f8c48859f664b6003cf438e6ab7215d6c4333c84fcab96c6cdb8e031ffeb5437b2fcc912491ee440a76f7fad5d58d1a52f166597a3373c0c0e7f9541e6a877f37cb85830e180391fcc53456db8b01176a200a1cc7965ec81bd0fd71f9d466d6e657659992d23e8638f049f6e29ffda1288cbed09b09c11c923d6a98bdc4de76264e7ef7a93f5abb94687d861b584a297058e305b04fa7e02a27c2c78949525b036af2a33d3deab4911b88898e3d80b7de23afad4b752ac968b24d8dd8d8aeb81bb1c671ebfe14d6bb8afa9660bbb5b8bb78a086452a854cb21cb363a66992a72c7b51637eeb08b6786328cd859370ddf5e393524a9f39c7d6ae691d7867dccf9231b4e3f3aac5086ef835a72201d4f15118f77001db9e2b27a1e9c22995a24cfde902e3d4139a7613613bceeec36ff5ab2b0701b8cd48d6d9c1a06e2510c186319269448393b17e86ad2daaf42703e9486d86d1f2d016654dc0a018e68278c62ad0b74c13ce49e94cf28818ebf8503b32b86e29ca4938ef5279273d38f434be4371eb48ab0dc80a3ae7b9cd3777cb5288c838fe7435b36ddfdb3e9c5325f990eecd38303c0ef520b52c8cd8c01dea0b36372efb600510edc96c16a695cc6ad65101210067ae6ae790e07419c03fd69c91d9301f3ac4c4e0876e453257812332097e440493bc7f2abe4399e264dfba3adeddae33b70aa3ef3b1c0151bc70a4686398c8e41de36e02fe3de8825b9b8b6f3d2291170704b7247d3f1a8b6fcd807352e363a28d7e77d85f7a01c1a5119a3cb6dc78a83b2c21393f768527819e9526d3e488f60c862c5fbf3daa32847ad2048724851f209048c673eb4a49dbb7f1a688d891d07b9a570db473f4a684d91cc4a9c0c806b32e3ef820568c8ac573fad50ba538cfa5547730abac0e8b487dba5db1f4bf4f6ea187f5aeeb4ad664d312585e04960971e644e3824579ae9b249f66d91953963f2138cf4c1cfa8233f85745f6fd4d91034f1060d92c54166faf35efe0715469d374eaaba67ca66583ab56a46749d9a3af9bc4324ba85adcadbc71c76bfeaa1038153dff00895efe09637b1b6569460c807cc3f1ae2fedda803cde403fe00bfe341bcd4c0e2f62233d9578aeb78cc1e9eebd0e2580c5ebef2d4f59f053eed11c7271311fa0ae9941c1201fcabc262f136b7a6dabc56bab0196ddb542f26a097c71e249dd1defa7dc8723071ffebaf2f112854aae69e8cf4f0d4254e92849ea8f5bd6fc1da3ebcc64bcb5c4dff3d53e563f8d65587c33f0fd8cab234325c329ca895b201fa579f49f113c529c8bb930c73d07f85431fc42f11cee564d4e48811f7f38fe95cfece3bdcdd45ed73dde38447188d102a28c0551c015cf6b5e08d27c41a82df6a104b24aa81061b031927a7e35e54fe2bd5dc331d6eef07b873fe1519f126a1bb2dad5db13c0fde3669b8c7b8b93ccf4f8be19787623f2d8c9bbd4b9aded3743b3d263f2ac6d1215e870bfcebc4dfc49778c36b17a71dbcc7ff1aacfaecf2313fda578e7ae7cc7e7f5a14603717d59f41950002594023839eb504f6d6d77118e748a446e70d835f3eb6a6ac70f3dcbe07037b71fad27f68a0cfcf71f42c7fc69b51ea2e447bac3e1fd1aca533476769138e7710bc55f6b8b5880df736e9e99900af9e5afd5c8015cfd5a9ad70ad187f28907d48a4a3041c8bb9f4049ac69709c49a8da29f4f3454475fd114b13aa5ae57aed90126bc0fed7001cc0091ea7ff00ad51bceae7288626c7f09aa7ca0a28fa024f10e8a80eed5a1618ce14e7f9544de2cf0fa707514c633f74ff00857cfc6e186332bfd0b53566e325891ee6a7dc1f2a3dedfc71e1d40bbafdb71fe111b1fe951b78f3c3ca3227b8624f681abc360be114d90a0b6782dce2a57d4ee1f246c1dba50dc7b072a3da65f885a046463ed8c0fa458feb55dfe2568ebd2d2f5bf051fd6bc5cea170c71b979ebc52b5dcaa71e6673da8bc7b0ec8f616f8996272534cb861db3228a8dbe2482418b47623fdb9bfc0578f7dbae071e6b01f5a6b5fdc118f3dff00efa228e65d8395763d6e5f8937996d9a540a33919918e07a74aab27c49d61d94c567668a0608218ff5af2f17326dc999bfefba6f9e30dbdff1269b920b791e923e23eba063fd1060f531ff00f5eab9f883afac4105ec591dfcb5cd79db5e479031d46322986e50704e40a5ce35e876d2f8ff00c444b037cc7e6dc0ae07f2154a6f1c7885c9cea1363fdfc57302e94e08fd476a1ee4390707af1c53f68167d8e81bc55ae3a80351b823ae0b9ff1a67f6d5c4819a7bcb9676ea7cc63fd6b15a6207dc39ec3d6a312c9b71e5b7e54bda3ee572cba236daee365dcc5d8fbd316fa2247eec8cfd2b30198e02c4fef5279374dc88981fad4ba9dd8fd9d47d197cde20fe0c1f51c55570b23ed8c60373d7a9a8bec978c7fd576ee71572cac25136f9b80070a2b39cd5b735a346a73a6d18d770b473ae4739e6b4608d4a26e07e953ea36a0ba05033deae2c710b62a570eb82081d6b999e97c32b9552dbcc9309803dfb53cda94386009eb4fd9f30fe1a9514b138cf1d6a19d30bd8ae2004771c53841c9cfaf6abb0d9cd72c238617773c8503ad24b13db831cd1b472673865c71458d7995edd4afe48247ca01c638ef4791803ad5952a62076e0e7ae69dced233804f4a057e8224280100649efe9ed4f58914838a923898f41c91daa570338030477a763272e84215b698c7dc3c914cd9d8d58030738e3bd23803f873c53b0b9adb108f90824d0cfbb2b8da3d85285e41039f4c548cb88b76c5dc0639ebd6921b92ea56180793f8d3b3ba4c961cf6a1995973b70d8eddfde99f339c8039f418a0bb9316051d72485f98714c8db04fcb9f4a4071bca13b7a734d2e000093ea6812ec1bb7c9855e4f4e7a5290cc4ecfba0faf35133a104b1c37f09038a7b46cdb592375523a9e94c7cc908ac58ee3ce29ca79c86e47418ce6a93de468c4492286ef935049ab59c6195656663d82d249b095582dd9a5bce76b9e3a7348792554f158e7c42a0605aef3dcb354126bd74e0a288e207a6d5abf66ce79e320b4474ab11d85d8ec00679ef4925f421638542997eb9cd726d7d7739c4b3c8c4f626b6f4ad3e48d7ce914f9847009e954a0734f1cfa2351ff00d417eae3a8a48b12aef47c1cf18e083efed4a10b29007cdee734dcc9b3900907040ee3d6ba12b23cf9cdcddd8ffde23e4059233d540c1fad236c8f6b231f2cf504138a919910704853ce3d0d46191d77ed7cf5c7ad5198af1fda5098a52ae31d7a52451967cc8195d3ab0a6b398e40fbdbcbc63046714d9b748376e23031e62834bd4372cc8dbb7609539c648c734ccb4b19fbac4f63eb4d4042162fbf8eb517dae35215c1e0fa501a2d87bc0de515c0121fbae879142a4bb172a0b0e09a95648d88da064f43d6a013b0c82acaf9e4ad3b026491c29282582020f04553208b96588046ea30383f853cfcaed2c6bb9bfbaddea787cbba5db2c655c0ce7a52d063943394dee3ccff007719a7812ee0ae85b1fc6b4c282151fbe24f6dc29825995b1b4ba9e480dc8a7a8892e61491d43b007f873de9a9004568805d84f6a7bec9555c8ce3f85bad31b698fefb20ec4d0172a4d098c0314ce707b8071f9d3a16909293743d78eb53c96c24520484fbd44f6b3451e518927d7a52682e46e9e430688a1207284e3229c258981de9b243ce3af1f5a52f204ddf6706453ce0f5a9648d0db872369c64fa8a04d950cab036513727723a9a72ba3a19225c64f23dfe94e52767418f553906a02c22994b15c671926819229370863b840083c106a41190ea1a67241e0b7f8d38a866f91d403db349e549ca06ce7b8a434c73c8e2528b8dc3bd471b34cdfbe8d55c77069e0cb12046e71c83ed52060f8242f5e78eb408117612594a9e879eb4e4458cb3213cf5069864c9dabc11d8f22a7da178e87d28018640a39049f4eb4d4314ae4608c5295c370467dea1174518ac913103b8e6988b091aa46c067e87914e0481c36715187494028594fd319a70551b593ae79ed4681715598921c601e8c0537f79093b7e618ce29647555e5b693d69ca1591645604fafa530d88edee925f95c153db23a54cd08fbcb8ebd41a880049c707e94f8db820d0b427a810769383cf514df2f7274e4d3965cb104838e94bbc0c92703d68b5ca643b0a8ea73fcaa34dc73bc63d08ef5247b8ca5836e42286014f5c834c5e4453c6ab889c3c6a3f890607e38e9510b374711b206858f4739fc7eb56259927dd0bb3678c93d31492cf2428133b074e3b8af1dc9dc2cac0b64ea631e608a2c1dca064f231d692330f99380cfe5b0dca18771c64d5791c2dc87323a17c2919e09e08a594a887e57752a48da3f88e7bfb55fc5121b6b525f2808f7483383b8127eb814e8a392283ccc19381bf3ced04d51172f21894a1752d93c9c01d6b55a5096cab32145930c53a1006700fe74afa0d3d0ac1e32c5feeafdf651edcd579666baf9b27327232718a7a88ccd290cad198dbe5ee4608ff003f5a6d9adbc72242ff0030901dac4e4a1a1a069bd86dcc12452a130ee91cee8db3c103bfe1fa558b480c2402cd3b1e463ee01db9a98a490d9c9661d8ccc8d2a0ec83d3f1e6b2e08ee2ec243f3b8249c293c0edfca88cb9b4438ab1a82ced2395ae9a74752486873c13e87d877a88169ee659f70550e7748dfc23ea7fa54f2db2dac51099621b01db18e7683eb55ee674fb22795146b6a392026ef9bbe4569a1ab565a93dbc96d34f234513796390d90158fbfbd3feccd708e52155dc307648189fc80acd60258963488000e576fcb83eb4ad0cb1cab229788632dc60e7a7eb4aeac44a289da21148401b99323939ed555e360e8ea80000ee04f27e952adc5c4853cf53275c971c803bd32520160012a47049c8a857dc1ad342484ac9b98b2838c12bdc673588c2de3b8767592491d99b81c7af5ad48cc8479aaab841873c018f7aab35a224cf28dc55cef039ad14aceec13258ae252b19593ca6008017f3ab03509cc603de0607ba8e07e27a9fa55097ed18f9644e47209ce2a25b5b6fb379f71e6dc48afb026fda87ff00ad4f979f565256341671f67932c9b41c6e900f9c9ed8cd3245695a392493ed3b176808b854fa0ce05316e96de2513c36bb070b124432a0f7c9e7fad4d6b6ef74b14b98a042db1b6804804f5f5ef571a22934910b5e04451e7088b0c8c0fba33df14b7474cbd1e5db8943a827cdfe195b19ef5d8496f63a7e9862b08e36323aa4b2b005ce4e4e7f2e958979a5d9e15c661c1f9806c29fc3fc2bad61ac8e575d295ada1cf33585a265a42d70bd1101239eb93c54114f1bc520f30866c13919c1a92e25fb44acbf670fb7844420155ed93eb55890fb6016ac8e1be50383f89ac9a573aa25886e1606ca4b995c63047033d69f349208515e3b73927e731e09f61dbffd754c46f1ca731310393ffeba64ad2b3a215325b83b946786cff2a4d260d22cfdb6488ab7d9d000720839cf3d7e95bd3281f329e0f7acc996531db4715bb61633f280401c9e39abd1193ecc8271b5f1eb9a2c9236c3c9735ae34852d8a718c6cc8fff005d35793d71f5a978dbd79a86cf6a0ac8121cc6e481f28cf2714b819eff00434e24a8254e48e3229dc64f3d6a4a232a39e38f7a529800e3a8a70c13ce7df14fd8760383b7182681f290088330033923a502350db87eb5363e6ce33f85237dd03148ae4640f10639dbc7b52f94bf4c5580bf27b9a36503e42a792324e29d81b76f6f4ab90471bca1643b549e4f5c53aeecd106533f7b191f74f14eda5ccdd93b32910366dc8c7b5578d52d4ecda02b12c0fd6acb479cf7f7f5a61872b861919ef549ab1855a1cda89f63b595cb2819739381c9a97fb3f4f8865903b7fb4781f85305ba9c850473c734e5b179182fccc4f38a6d9c8f0f2b92cf701a3d96ca0f18cf41542ded7693b873ea6ada421768f9b18e474ab091704019fc7a54a66f4a8a8bbb2b8b5039f5e68fb3672719ee6ae854f2cf1cf6a43b703008607d78a563ad4d950db0ea050d6836e7181d7a75ab638f94f0339c8a7395038cb0c1e0f18a560726517b7ca9c2e78e83b0a88db3300474abe1731b02c572a6a30bf273e99068b213d0cf96dcaae31c9acdbd80ac4081d6b7d8152091f9d529edcce8c1467bd3f325c6eac6346e6000e38c633567fb4804ebf36302b4a1d391a0c48b9047434a74bb411b7eeb0f9e0e6ba633d0e0ab846e574cc7fb6ae4303c77a77db7e727a03e86af3e9f12f48c7d314cfb1a0270828f6a47d467dc885f22a8dabb88f5a97fb541fe03f853bec60007cbfa537ece01c85e6a5d6452c04bb887525ddc062735464b9064ca827272722af7d931dbdf8a56b318ce33cfa52f6cbb07d425dca6d79851b50e4547f6b7273b4e735a06db0a485cd3cd8146c10a7a1e0e7b50eb7914b2fb75282ddcd23e7cadd8ef8a679d3e4feebf01574daf5c2f3de816a47e547b607805dca2d71280498f07342dc3f0761cd5efb29009db4e5b4620fcbee68f6cc4b03e65013cadcedfa734e5b89f695edee6affd889edda956c9b19d84e297b663fa8c7b99a2598e7201a40d30e9fad6b2d975daa7f2a923d399d8285258f418eb4fdab657d4a3dcc63e6b751481661d0d6e9d3d9246475e47079ef4a34ff91ce47cb8c0f5a9f68c3ea90473e6da6272d9e99e6a4582623ef91f4adbfb139c06208031d7b558b7d383eef9906d52dc9f4a1d4916b074d6ace7c5acbf78b3629ff666607716ae805baecd808218f201ef48b6513900baa9f7fad4f3c8a585a5d8c116831c82476e686b503b1393eb5bed690ab329607191c7434cfb3c28d86c8e6973c8b586a7d8c65b451d13eb9a3ec40f55add31c479c1fae29ea218c025371ed9a39a4c7ec20ba1cf8b053fc3527d857aec15b5b62feef4ec69c64500010282beb49c9f72fd94574320590519dbc52a59f5e2b619b8ced009f6a8fcc6ecaa07b51763508f44544b5620617240f4a9e3b327f80fa9ab31999a36953855c0381d334e06465dea582ae01c76cd03e54844b27f2b7e06d0718a9160fa0a6a8721f249c7be29d0c124ae14301952dc9f4cd1a06db9288533c903d4d384717f7ff001a83670492697e519a64dee4775144c78e71d2923bf920b56b68e3401fab95c923d29599003b88c7b9aac5e35e4b0f7f6a5704a2f4628525158f4ed4aa02b1c1edd4531ae2dd621991430e7af5a60bfb5e732a8c0cf5eb4acf7367248d5b0bbb8b1769a15049528188c85ef55ef279ef6e5a599ccac470ded59efaadb28e26f97b8cd35b5eb24b731805a4ce448a4f03d2a9296c64ea538cb9f4b9ad1dba987aa9c1ebdfe94a132422e324e3ad612f88a050465f19e8075a88f8914c80ac4d8f72051c8cce58885eee474c4344ec81b041c641a72a965c80723ae6b99ff84aa50bb459c67dcb9a81bc4f784300b1283dc2e6a940c1e2607609b5a4c37af3514ee073c6df5ae31b5fd448f967d99ebb540cd5496feea43879e46ee72d4f93cc9facc6e770d731c442bb8e7be6a39b52b44c06b98c0c719615c133b37de627ea6a3c761f9d1c88978abec8ece6d574a5466fb66e901e8aa4823eb59a7c430c6df2076ebc91c573fd071d7bd34ae3b0a39624fd6ea1d0af88b6ab6c8f8718605bad55935d999be44551d7d6b2761c0e71cd288db1cd16443c4546f73464d66f255c19001e8145567bdba906c799881fed74a8369e82829dfa53d119ba927bb1c4e79349d7af5a0c752a44c79c7e34ae436224648057bd5eb5d34dced779542938c8e714d48976fdde40e2af59baab2c49bbcc63ca819fce802f45a6c364430dceff00dec7157a39d77a29660ee3baf1f4a88cd2246081f281820d384b1bc2b332e57ba7715aa4882cf945ce5864fa838a67cc19b049ee79a48ae83c8aa36988f20e706a692187975cab119e6a84c6aca2438edfc40f5a915486e262303827bd5329b24f336e73c065f4a7850e9e599b6b7606986e4aeeb32b02aa0eee78e0d4693304c200a9ee7914c68fcb914a4b8cfde523834e789b665115973ca370286c43fed0c936c2bc30e79e291611b4919193da9c8e42957520763d71f5a158aa104f7e193bd1b87a0b889491820f7c8eb4cdc43e060a91c13d69926f132c8cdbb1dbd7ff00af4e66f34290f8e73d7041a7e416185a452c47dcf6feb4f5c85243292470334e91c091558119efe954ee2295dbe4da307231dea6c31b3cef6d20e993ef56acee5ae158b1e7f953122498032a6e60314aa52dc1f2fd79cf38a1dd832c30c46dbbb7a540d704820af980f518e4539642d087030bfde5e4547e626778033d09c53d7a089ad6e6dd9b6a385f553daa6743b0149383d8f4aa2b15bcd862bf37aaff005a96146b67dbcb467a1273403b0f267de7e4523fd934f57f3769ea9d1d48c11530452d9e33ed50bc2c6532a9dae7a9f5a61ea457405a1f915dd187551f74d461c3c477053f855cf35d506e50c7d4714d68e3953691b777707a5260531116886d200eeac3afd2a5822f29811c63f4a8a50612c859880382783496e5ae22dc8e48f523a50162e912ee072ac9df8e45432655be5e17e9d2a0fb4f93388e46c83c823ad5b1748a5549dc1ba10334806850dd1bf0f5a164218a3138ec1bb53da14f303e594f4f634d95700f391dc7a5310c0a4b3720e0e403daa4c02413d477a8a268d88c12580ea6a6322038279f4a43155704eec1149f2c6dbb775347ca40c9c544f2297d850b0eb9ed4c43cbb3b6d78c107f8bd69193f727c97dbfd2901529bd4743c8cf4aab2bb443729c67b1ef48372c282546e621877ec6a6ddd8f5159af74c538c0cfa50b7a3215c907a668bea36b4343a499039f4a71638c7afad429282bf33fe748cb21858c6d9f4cd55c9449b995484ef4d42e1c9273ec6910b0450fc377a520c9c83b4e7bd08657df14ee42480b8ec7834d676542b70a7ca048ce39cfa0a6dc25bdb2931cdf38e1a5001207a2feb5585eb3cb89a226dfa29fbd8af2dc53314dad1133dc798616545cb0ca9c74c1e9fcaa696547b847001478c6481df183556e16486dbcc500b452065d83aa9ff00f5535264b5bc6858130aed04e3a1201fe752af62d7bccb166a5625c065c64b05ea40e807d73576586eee5f7448ac4afcc37818f6eb55bc8769c6d456800caba8c8c7ad4bfbb58db62e64603733f7038c0aa8ab9695b416285a17759e1643e5f71d4e477fc3f5a685b78e72641b950ee0878c9aa62e5d1a592595f731c08cf41492dd4b3c91c11ab607dec7007d7da9b5740e2dbd0d15bb88c866972ce4e59946d07daa63a8ec9021da908076a20c06e33cf7acc591edc664543bbee90bb820f7a4b517a974a9318e48c925700153c1c566a9d8ab3be84fa85d3cab22c7b4b71bc28e9ed55ed25df6b3c4588931bc0e98239c8fad36e25906e608b83d4228382696d1112213cab8284ecf520f5cfb56b4d5857e82adf3c250e06c7cf2bcf381fad4d35c5e2b868cbb6dea01ea0f7aab9822f2f6e0c632db4fbfb7e14e37be64d1a9f92419da73807eb54d79027d499ef5da42bf2c8c7b38ce3a71f4eb559ee52e2e7ca8e32e73d13a1f6a65ece64596461b5dbf76768e071c9fd4d45a75dc10cab014914b372fb7a8f73e869285ca46ac524768c22587cd2bf34cc06513f1ee738acfba694a99da40bb8e37c87924e7a0f4f6156b57bf8eda331c6cce5bfe59e381f856138bc790cc776f3ce580000ec2a946e292b9326f4ca24f92df23498e3e953da01034904cc0b01d4f41c8a6dbc5711fef2f2450808c2377cfd055e30c5e76f2b1beee03739031d2afe1571233ae62445924425a32dcb31e4e6afd94f2341e5a92a9dc6d3cfe35099618a368990151c9cf393ef52b4d260a9188ce081d314f9da571ab35a9a4f24cbd678c1e0f23ff00af59ba84723c6259279082704819e0f5c63a535816424dcb205ee781f5cd248984649268963c600049626875652ea2718ad522a258c5220953e5524125bb638ab26de30374258bf795fe50a3d39f6a9523c90fbfe45f9b613d7fc055896e2196d156609e7201f70f5efc5537d8762808d995915e3d8919c6325b18eb490cd269db638e50dbf070402467b54b6f24690cc7ec6e4ed0b92e32413ce29a90c6c0fee1a3e720bb8f94535a099309ee198f993a47c704818eb59d35e471cee63964988e15cf4356ae2da6936c4e6dd51790449ebd3fcfbd5292d1449b3cc50179243641a7ea3565aa2787534257cc041f5c706ac0bb859b689147fbc6b2fcf894316dee492003c003b5569d08cc80107bd2703b29e2e71df53a512c4065650c31cf6a9e1940d855c16cf71d2b8b0ec0f5c5392e678ced599fdb9a9e4f33758ed354770aa40c7191ce4d48a70a413c66b885d52f4103ed121e3b9e94e4d5af57a4cc7eb4b90b8e361b34772d32bc7b44499fef639ebd69863f941dbd7a1ae4175ebc5032cadec45591e2abb4503c880afb834f91b2feb94d2f74e9803b69001f8d73a3c55381836d1f1dc1c66a51e2c4e37590c0ee1fff00ad47b363fae419beb1965dd8c2fad2b86655524e07404f4ac31e2a84f1f66900ec03034e5f12dab1cb4528a4e0cafadd37d4d631e4e40cf34dd9c74aa0de23b0c0dab37e2b4abaf5930fbcc0fbad1cad14b114deecd054031dbf1a90a82a319de73ce7a8f4acbfeddb2dc31293ebc74a9e2d734edad99d0311c6ec8c53e56652ab0dee5d21041ca92fb863d854432a2a15d56c5e4656b945c75cf514e37f6233baee252081824fe74b958e3560ba96d90e101c73c6734121b8e831cf3dea05d4aca465dd730900f42dd47f914d6d42ccb902e2220f5dad438b1aa916f72764e066a37048c2fe59a6c97b6a3e513c249c721f81c543fda3022ee5993729ce7239ed4accd2338bea4e4e63c9031429ca0523e98aaab7d6fe5e3ce507eb4915fdb86ff5c9f9d2b17eeb4f52f39f294f0adb860e692d982a30daa72b8f98671f4a825bd8188dd22827de9b6f750027e75ffbeba5349929c6ceecb4b966c246588ea07351b3e5b1b3af6a3ed500248b85cf4f95c535ee205da0cb1e49e9bc555e48519c470f2fcc05e3257b80d8a85b6162426076a9f7c4630e258f07a65c546d7766e84078d4eeebbfb52d594aa42e12040c5029280f1934d11aec66106e1eb9e948d3dba00c678fa7f7c534ea76c9c79e002bb783d6a6cc6a70ee38043d2314f014ff0000fc6a01a8d908d98dca06c8f97b9ff38a70d56c0210278cb763bbbe68b481d48772724001768c0e99a72ed2ac4a0cf51c77aaa350b26eb7518c7a9a06aba72139b81f419eb472c9f425d582ea4a0fef0e4281edde9df74642a90477159dfdb365bffd61fca9efaf591550a5942f1d2ab924672ab4fb9773d0e07af4a73191481f7491c71dab38f882cc22ed0c0ae41c8eb4d93c4903b0cab1e83818e94f9593ede9f734b2c0fad3cc79899cc8170a4818ea7d2b14f886dce088df2298fe21520ed88ed27a668e46275e9f736220cca724e33d4d4cea54ae0e70326b9fff00848be6052db68f40d487c4927687f12685162962695ee99d01c972718c9cd2b45b501cab6e53c03c8e71f9d738de229f922250187ad47fdbf74a490aa063eb4dc593f59a7dce88284607f5352dbb15721588c8233f5ed5ca1d72ed9bf87f115136b3799255c063d302a79194b194ada9d9152a78e0f4a50a0b601c92783ef5c6ff006d5e953ba4c923afa535754bc621bcf7caf51d29fb3ee43c6c3a23b692dcc25c4876ba91953d4e6a370377e1ce6b8b9350bb914b3dd484b1e858934c69ae3004934b9c64658d1ecfcc9faeaec76c3cbd849603033d6a17b885464c8a3f1ae33cc72982ec589f5a66493c93f9d3f6685f5ef23b849ed8ba97b98d109e4971903e94d92f2c54b1fb6c0406c03bbafbe2b87ea738cf34ec1c1ed47244978e9be8758dad5a26ec480f6e066a2fedcb3ec5ff002ae5f9dbc7e940073e87bd1c9127ebb53a1d4c7e22b54474649886c7dd1c714a9e27b6895c25b4922b2e086602b97ce57fa9a0fca3a5528c4878aa92bea74d278b18ca1a3b445453bb6b1cf3f97b545278a672a425ac0acc793cd73ec39c50a06e1b86571da8b2ec67eda7dcd66f12ea0405cc78ff0076abb6b37cc7fd7e3e8b59f9f97de97393863d3a501ed67dcb326a1732fde9989ee735179f31c92ec4fd6a3031463e6c63ff00af4ae27397715d8900924fe34a4eee339a695ce3d05389e3a608a2e2e66f7138200e734639cf714739049c63d29d82338ed4009c14e9df39a02127239a760f71d69475c77a04203c11ed4814b1e3a9a70c838f5a00dac3920668b80c61db34a4641f5c734f600be450dce72314b71919524e7140c83ee2a40402307a528e4e71cfb50223db9193d4f34763c54d1ae719cf1ebcd28452d8e07b7ad2b85881578ce3da9e1493d29ebf7718f7a916163863c03c669811797cf269c115b3eb9e6a60a01e7d3a53954751902806c8194a9c01f5a9820e1471df06a58d38e0e4fbd3cc033cf27d2900cc1328da41fef0e86ac46561bfdae8c42fccac3a8a8d63c8231c10467bd4f0c4accac8c43a8c5508b4d78866922219e26c9058f2b56a02187c9861d0fb5402db2c0b30770be9826ae2179a12bf2ab2c78fbb83f8fafd6ad3258a06cc640561ce4746a7a3895c1db82bd89c543691cbe59dcc083cf5cd3584ce46e8cf97d08c7dd3ea0d52132f380cd9650303a540f2053f32b3027838cd21461164b03ce39a8196547478b82a79e7ad53605b05080a430039526a21b83baac81811ca1e38a53205505b70f5e29cd10014ae4e46370f4a5b888e2794c254f0c0f1bbfc6a525890b32a827d0f07dc54204fb0a2e38ec7bd3848e542210841e548e29dc07b798caaac7763d7b8a618cb3646d2474fa53c18958b386f438151cc8f912c7bb0bfa8a010f6877264b6c65f7c83493440400ef23dc7355a68b700c4b03db9eb535b46c3e53ca9ed9e9486451cc6260cdb9fd48ff0a99c24c9fbada189ea0f5a6cb6ff003b216557e70471c541b7cb037361b3c9ed400ab98e72a8b90c72486c63f0a6ce922c85a29194f753d0d5968fcc50e319c7de1de918f9acbb7e575ea4f7a008a269a34dcc99ed9e2ad5b4a187e841ed4cd8554281c13f363bd3625532ba8621bafe14c372e05dac5b6f27dfad3d1783d783d0d46accbf23267dc54991b4f18cf7a627a8a01c92ca0ad4720009273fcaa28e49239f69c3427bfa539e4d9c96cab7622907a1526f2c8397248e70c78a816616c4b15c21c6429e0d5f96d6299467a9f7aacb60b0e503b73d41e452687b9189e29882222e3b7a8a9e2b88d7b153e84706a236623e55883d69bb3cc4da4fe3fd281685f59d251b4fe06902317e572beb54fcaf2db76fe3d33562332024eee0fad1b2018db5ae3cb8c10e3f0a9303f8fb7b52ac841cc89f30ef51c84677e58fb502dc948253a641ee0d22c58e43700f7a11d76654fe7514f2154c7233de90c710a9295dbf7fd29ceabb307af6c8a9622a501233fe34d9191012c3a75a61b98d340a59954ed6ce704d40b6b2b3e0e456ccd1472bf001434c16de5b6f88e07a1a1a0bbd88ed23700acbd7b1c75abb9545214633de98ed83c2f5f6a91480a78fc734d225919660738e9d699e6a1278cd4cc4024e383d455711468c4ae79e7145c69196f6ea938692e59cff00753814f51773cbb2d90b11c76c0cd65dc3b25f3b1fba093b50e38ab90ea7717174aaede5c5b801127031efea6bcfe49741a82b1a31911136d35c6f67fe08c1e0fd6aa6a3791dbac7fb8120724b31ee7b0fc0628695e3666729b44bb805ea31daa085a37b9b886652c19c92ade9d411f9d4a8b40a3d4d2b1d6e1745fdce1876cf1f80abe25fb426ed902b86dc131d47a8f7ae78c096cc6477cc6a3707c633ce001ef445335dcac1d59546163dbdba77a7caa4f429b4f634af123465796076576c6517a13eb50cd736f04eea6454206093edeb5a57770b63604076964032ec790a2b12e74e8ee317288b2672c54b60e4f356958c95dbd4ba273246426d9108c82a738ff3fd692da2b8dec8f6f20b71c8724139fa01496a8d030090c70a63efb8ce47b64d5e9b5279237f20b018da723191eb44e4f634b90b5b496ea9346c2380b050d83c81c7ebcd51d467786026320ae40254e71fe4d5ccdc9822563900f209c8033dbf01546e9a562231b04208673fdf6ffeb0a51d448a113be5667195ec71c7538fd69f747cb8a3773c302db47563939fc3a568dd98608a00b1ab6e8c0c9e406ebfc8d6793bc019e3b66b7b5c65f12c292a46610cde4a3c6cedc162391e99a91ad6e21324904ccc7d18729f4ace9d215815582acdb7d49e3f90a22be68e579a46c86c038e73fe703f2a76482ecb5158cef1a8f3feff0072724fd697cab6b62af30f315704fa13daa771f6c888598ac658e5f6f45079c7d6adc0d6b93002ad005216343fafd6a39eeec429dd9426b8bcbd9a562aca410327000cf5a2e1f85f318068dca8f9724f4c55c96268172ad0c48c58f0b966c77a82ea3f3206506460c77960b8fa0fd3f5a437765496e446ca922bc68c338007cdee6919279d936cc8cbbb32647a9cf7a88db18d9b66d9b8fbde95723b696524bbedc8c6d41c93f5e955a169227d911f31d982166f94819da3b0a60b2d3b0d348f24a57827a8cd3e5d35a68c6fbbd923fde55f9b6e7b13eb52dcda298842194c71a7233824e3927f2acf975158ce9a7b60cd19b70c1ba6ee73f955632c4d2977b78cb7b0ab5771c096dba389803c67a73f4acb759c8fb8557d4f02b48a43b96c5cc31aca264243215014e307b7f2aad6d2fdaae47755cf24f5e3d298b0ace0c72bbc72eec0c8e08ab8c20686286d9550c449624125b8e7355701b2224c0956dce4ed233819a836c71c4d003c7f111d09a5f2e77471e633a8236f0072692087328b7c6f95bdf0a38c924d2d43d469f2fe4932aaa49da807403b9fad26328e4b679ea79c935b4ba2da81ba7bb724e388d78cf5acc678cefb7c38580b61c1f7e2ab61942486311ab6ef99bd2aa32fcc028c9ebc56cac304d092240b20e065706aaa2c49210c85fe5c00a7a9fad2ea17283295eb418e4db90303deacccbb6de107ef64ee5c74a60562371190dfa0a60421491c0c82680b9427207b54ab18e0aeee0fe14f0d9180307a9f7a40541c2e067279a72a92790d8f502a5501e5fbd8fc2964ce70465b776ef45c1808c04f95707d09a6e18363907af34f442e705b181902ac450b3b8cf19e3713de8b08aa508fad18cfcb9e3b915398f1314dd9524f23ad0a9f37cc4055180077a761917d9d99942658b0e31d452bc2d96201dea76ed15286f2705df68fee8ee3deaa177672e32a49cfd29a024e8bb994e5863e94d24cd9c02cd8fca9e3e670a18ed3d588a8ca904b27186c7bd201a1d95872411c53d984ca89b4060725bb9a73c41d0ba924e7918a8e30012dbb0c3a0c669dc771186d663c7073cf14f902b2eec8258f403a51bf73f98e18e7ef6695a1c4a41caa85c8f7a5704c88303c743e94e27ee64b6d07e6f7a6e39ce3a0cd2a7cccaadf7723a9a02ec91e5408e235e1b079e48a8c74ce720f6a5923dd960a768e0b638269f1889606dc0962dc7b0a617647b86e3b69db82bee048c74fad2311bc9503ae4814e68994ae573b864629dc5718704e40c13cf4a55c7ffae9705c33004851cfb50092a179da28b8360781d29338fa52f4078eb4841c0ebcd2b85c4c023a0a72e01c9148783c5183d7d680d87bb91edeb51aa971c0269fd3b6453d24288400334ae3b9176c6067d69c00ce33fa520c9ce4fd6838ea39a2e48be5b2b104608a69c6475cd3c02c4ee27eb4c00f14c6c3033cf152321450587cadc8a685cb1039a199b0149381405c33dc1a3f0a706c47b48e339c7bd3738248e9e94210a09c01dbe94df6cf1d69dd73cd21f5a2fdc2c2003d79ef499c03cd3946771edef467a5201d16c2db8fa7183d29bb8952a7a139269c36950724b67e618e8287553236dceccf19eb40c4c2ae1b92734e67dcddcf3de9d39fdd43bf69017b751f5a42ad1a8c8c061d4d170437059891dbaf14dce0e3bd3d4b460b236dcf19069a071bf9009c508031903de9406cfd68652a71dfde9471ec4d201bd071f9fad0abf2eef7e734ec13f5a4ebc669dc0368ea29491c1edde8001edcd3c7427d6818c3eb9eb4107d681c37ad2e481e99a4210819fc693f952f43c0e7d6948c0e0739e6818dc67a1e0f434a0639cf2294a918c0a770718e723a50210e3b9ea290af1d3229d8ed9e694e7b1a0634a8c020f7c629064103f9d4840d8081d6931f364faf14ae1614925491c9c62900c9f4cfad3d87008ea69a0123a8c9a2e362e064e7a7634a7a75cd2f25704703d6942824a83c119e68019b413c67da9cb8c9a70c8183f81c74a42a09041ebda818d201603f953b036e383e94bc02319c8a68523209e09ce2815c73965206dc1f5a771823d3b914a572b93d6a44550096383dbde903447b5768519a746779208db81c538a82c71d3ae69c8372e37007d4d0170c06248e05211b47cbc8ddcf7a5505a444cfccdf953826d0d838c1c74a61b8b1baa2313819e062a611cc53711ee39a6247b989db818ce2a4cbf1c9e78c50038a72b8237e724763561a3523284aedef55e1506521ced3fc27fa559dec8ec8c39c702a9215f524911e4da63f94823be455a172d132055e72466aa2cf8055f2a57ee91cd5b01648464ee20e7247e9577131ef22ab7da1220379e429e377738a9c3e70fb828fe21e9544472440f97c8072509eb52f287cd8c738e54ff10f4a6992cb6630b23385193d452f97c860a318aae971e622e372eee083c62a6662a1b6c9c0e4a914d3023d8527cb6413c7a8352210c19509420f2b8c83409848ca171d3a7519a913fd596c64934c4c844a3e6650081eff00a8a8b734a439dacb9e71c1a73e0310aa47f7876fad42fbe2701c8643f7580e6802691be7186c11d8d46eb27ccc24fbdd3d8d12a9215c39df9e4af7a64970db061b703c74e6906e2bc7b60298e7a8c1e9447bd483c86ed9ef50a48ee990b86f4e99a7eff323f99b61070c31d29dc09da67933e6008e0f7e8699b195806c329ea48e949292aaa039604f1b866956373952738e949b18b1aa44acaa3e5ce4fb53cc31bfcca595bb1aaad215705f2ae0e0107ad4d04accc707807a517b0343d525ddc3f3fce956e143159080e3be7ad49f2120f422925b68a5f98804ff003a6b5112ab820e1bf2a45955988c7d6b3da09226cc6cc001c026a68d84f16e6f9241c1229dc2c5a01029707e5a70d922023e65350a131a100e477cd2a3ec042ae06381da95c561ef0203b8a8fc298c9f290ac73d89e69e1814ddbba75cf6a8c304724b02bedda9810c28648cb6307b8aa8eef0b1288c483c8c7515a1231fe020a9f4eb5566ba11160c5b2072c074fad2b0d0af1c37203c7bb0cbf3022ab28b9b76081b2b9e8455b8e4f3d30a464fa52f96cdf2c8db87af434bc80707dc8091c1a78d857249cd47828bf781f726990cbe64853041ef406a4c62dc770e87b8a6c88c07b54a1bcb8f1c63d4d47991c9dc303f9d0300ebb3696eb4c8c292d1bb3107f4a64d16d5dc01383dbad3a2944a33b59580e868112208d728a78144855177646def5166459810b914332cc591938a6843a39149c160d9e9530dbc0cd545b7f217318c9eb826a6237a2923e6ef45c5a0b348b110334ddbf26e273dc532481242a1c74e41a914edf90f40383487e86345a0cb70b24ed2012063fbb073f419a6d95b4acbe71cac88fc7183c1a4b56d46da67bc7e37361816032b56edee96e03301c96390a73e95cfbc7cc4f993d0cfbd464b9b88777df958afb0cf14672f6d70a43165da4e783838a5bebc2b751c7380a85414900e7d39a1fcafb07de3849072a39c375ac9e962b99d8959bcd2be622b217ca9cf4c77c558b38fce943c0cde5c60b3a81d4e38cfe344f12fd920bf8a3568a31d33ca1e8323bd37ed17b79677099d80aaaab05c7539278f61fad16e8479969dbcbb7322c6cc7cccb01fc47a73ed53222fd9da78e2008cb49103d4fa8a8f4eb62b125b197723c7b95b39c9c9e69ba84f259e21f306f6cb608e8bf41c01f5a95bb894926392558d10df30666076f1c0ff000a8dd848f10b76c8273b71ef48f2cb2db99034600e1805ebdfad4492cf24a4c2cb1b2a8054f231dea9f983d3443e0616d35c4cccdf7b2430fa91542498cb106071ce1c63ad6d5c1b79208d1484999ba38e1ff1edc7f3a8f4db32cf22bfcb1afca41e013dcfd29295973304ba9993ce1a01106396187627a90327f2feb55ad375ecab0aae43119627802af6a4ab14a9f65b7774e76b95f5ebc7e1562c2da444dec58348a58e41c007851fa938fa55aa8ad71dccd9ed27967dc89991d89da6ad5ae8f22334b705cab1db81cf07a93e82af4ee175768ad590cc8a119586320735646a4246681a106403950fcd25276b8aefa1518da885526b62f0a0e3cb9486fc40aaf0dc45f6a7f250450469b986df9cf1c0fc4e054e2c5daf3ed168c2346e2688f047bd35e5b78dfcc525a4623cc04633f850a425a30b59646b6d8d396dfb8ab9eaa4543b61130fb4cec1b1caa924b7e3567204641007272107af2299247ba250cdf391c13c7e78a2f663772176579425aa489174258fdefc692691ad597e5567dc4658ee031dfde92deda6b7bb2db995188c275fad4e96c9246cad23f98783295c9039381f5aae6ec545d9e85b82fcbc7e6ba14450115c8c1673e83f3a882179cce6362a18f2c08cd4c974b0441562cb20e0b8dc47ff005eb3af9ae23b9dccaec472bb9bef13ed52aee434c965990ac995e7b17c7d38aa574ae64851573bbf84e7033fd2af5c42a1ade2758dae14177c1fe2ce707d854d6d828ef70ccc48058a745fa569143650f2c4eca49983b2e0c800e00e9c7e15098e68fe72e8f18382e87f5ab77d3c1348a96903820fccec319f6a6a2416e023310d2b84215b803bfd4d558457569e789d2de3dc40dbc1009e79fd3bfbd358cb00445dbb98e4e39db5a512e6de65898c6911e0632ce7d4d652bf94f216936b75195c96a16e0d13a5dc51db88963937a2f0c3f8bbe4d57b686497cddc53e64c9c0e87d3eb519592e30d1c5238e876827356a323cb319de92b1cecd9c7d2a9bb86a51758c83c142bea72c6abb043c07ed9e98ab72da6c973237ca1b0d8e48a60823132aab6ec7f3a9b80d8d06e05f258ae107d7a93503ab4259154e0300493eb53c8479c8c30bb78e7ad3e68d1e52500dbdd89ce4d0b5029c6ad2e5546d55c92c7a5448f95620e0e71f4ab5b1e606384161d4e3a0f7343ee11246b82848f99463f5a7643624b12381b739ed8ea6a158dd8ab1c85dd8dc4d5bdaab958dba29ea738348fb5e14891f92c72687e4244127cd3bb42c4aa8c027de9023c049de4f70075357a18635882e7773f31ed9a8a665326c724649dc40a76b008c3f7abcf2579039fc292544c468f28214ee2318c53dc2862e176b4614e40ceecd38945b760d129ded92c4f3c76a1815bf74e44b287d9bb04af3c54cb14d23308d1551db209ea41eb51acb2aaec1176cb023de9cef72f0f98079684e411c7b51a0157e5892419049fbbcf4a7aa2cb928b907ef7a8f7a966847d9db0b909c0c77f7a63fee63401d471cec3d7eb4bd4636e0ac488a9c7520a9e73ef4c7b678991c8c86e4e0fe74f4589c82c5895209f71e956162333cef080772e01e807afe34c0a6e5dee3608c29cfdd2718a0c88593721241e49f4a19c1c313963f7877a4902a9e03648c8245201d32940ab80b1b1dc0f7c53fc85f2d630c0b39f947f8d30ee6b60ce18a81843db14db728270642db71938ebed400289653f6700b152783da9982acd1707271eb4e63824a03b431c31ee29ed0b4688ec570e738079a04f41d1c2a80acbf2be78cd428c51830c8619efd39a09246e279f7e6971c9354022fdeea46e3cd4d3c6a8e36b0607aeded50a8249a7af008ec47e4690c424e40c6066932c40c93b474f6a91b6893a1641d89a511999d844a0679c6781480871cd3801d49c53a489a397638e475c504eee48fce801aaa588551cd21c67934f01554329c36718a4db91ce39a0621232700e29f1840afbb21ff831d293215b9191e86940048fef74cd003307771c51cef0b9c669cc492493df9cf7a1402d8270bf4a040e3c99461f711c823bd34e093eb9a7053f31046052019e80fad0200001cd3b6e3a0a40a0b1c9c6d19c7ad282718ce05031b8f6e7eb487b1f5a9300734830413e9d05201833b73efcd19cf03b7434ec7cf803209e33463e5e9ce69dc04556c1db9c77a551f363f9d6ad96a3058acb0f97e64720e4e393ed596b1969b62ff11f9451a8305019b6faf193da9002c0027a76cf4a704d929470781f363d6958aee200e334810c2b8434a530000734bfc269c81370de1b1df140c8f27767dfd6942f5e3f3a70501b3ef4e2327dfd28111f5c9038a3a9031d78a785f98e0f1f5a3a1e39a0637b9e29460818ce7bd1b70e73dfb1a520838c7340ac37bfbfa74cd21c803029e791ef4e030075c1eb45c0605c9faf34ec6464d1838f6a400e7a74a4342004f4e3d694019e3209a7b61c96200c9cf029a1323a7e146c0c403046718efeb46338c53b209c52e4e0e6804183819ed4e23007e7c50572318a6e7af5f5340c5032a78391d3142a966e7393c53872991c0efcd2ab739e983c8a018d00f279eb4aa84e0fe7473c13d3f5a7609c91d334086b1f4e4d04fcbc1e694105f9fce94a10c0e78fe745860001d4671eb4fc670bfed71c7228032368cf029554f703afad2014232ee07ef1a61e581cf43cd4bb769073cf4ce690ae320e370eb400a31d860114e89409b006413cf3d69000a3b834b1a307c1e0119cd315c7a2a7da144a1bcacf3b7a81ed4aeabe6304dc573f293e9ef4c66f2864f273c9069cceab824ee0e33f28a6171eaec15867af1c54ab9930bb7f76c08cf7534d55e41c7ca4f07fad48ca54b60f1e94087a95503fbe3b9ef4f48f7ed7619c1e4f5c511a02b96cee1cf14c8e4704f40a393ef54819699558061182d9e4e69ab21488931ed04e300d3d949453905bafd41a908e10b0c1e841ef4c4c42f1b4492163dbebf8d4e54b2ed2481d464719aacb1e49e3e53dc74a9e07711156008539073d4530b8b648a0c88ca319c8f506a6f9524391b9718e6a144632929b5643d09efed5209409b69e3773cff2a648d631c6e4a2fca7be2a5560c8581ebc3007bd2150c02e148ed8a6bdba36e6462a4f51d33ef5402c604b96c107be0f34ecb270ed9e7ae3f9d2425540c12493dfb1f7ab12025c371cd084d95999b76e55f9bb7bd44638dd99994a11c9c7f3a9de5f2e41b4060dc1c1e9432057e4120fad00994ce55c0dc1c1ef4a8b925b6e1bd7d7eb533db06c81f2fa11dea255de369720e7191d69318aff00343f2905bd1aab4734fe66d75c1ed835238603667271c9c53232d1b0042b679068631648bcd4255b27342b7eec2ba9420e370a8c480cb8656504fad24b23213b7919f5a561924a581caca7711cf3c1ab56c498c007703e95463998a1053f1a9218a48183c5df964269925e9632072c71d6a281506e03b9e7f1a9a291a463b9703b53ca29206dda47714ee22111957255bea0f7a7c6ac013b4e7d0f7a539de778c77c8ef4c3315e872075a06383ab9c743ee2a3f2be6271c1a76e8a5018637f5c8352ff0008a00aed1ba11b49c0a885c2b49b76fcdd0e475abac015c03ce3a1aacb6a8a4b0e4e738a6d05c6ba32ff00ab210fae3ad10b3e4875c30fc8d4e1437f091f8524bb9705406c75a9190cb2ab29509f3fa1ef50a24830cbf2e7b1a91a247cee386ea79a86398893cb6c301d32791408b0b1bba7cfc8cf634c91a5880113e573d0d2ce6423f767a77cf351234cfc4aaa33de986a581bb9c8ebcf14aadce18727a542b2766e39e291e4e703e6fe9480b196cf1cfae6ab4b26c6de5b3ea3d69c124c82cf807b53a445d99c03cd02424329e011d7a1a9d8679c907a73cd548e5dc4633ec454e6528a32bbbfad03b6a29277900820fbd341e707ad30ca3270b9a721575c8e0fad00fb1cf5c6f93cc85906d0d8e0e7a54ba496b79ca3a9d8fd31ed4972d282acabb4cc8ae4e3a7ad06e363ed032e31b4fbd73a490ae58b9459610b2aab75fc393458b45b4c29b791f283cf207f9fcea0b959668c491022404ab0f519eb4f82d1618a398ce81f24f97d4b74152d29445b6e5bb1f9663b8ef49815c63823dea7b86304d1dbc1c8562246c7a0e73f89c512344243fbd40554322a8e073ebf5cd4523a8b5663b8b311b1b3ea7249acf99ab229ad8b2d77bb50b78e2898b04043118eb9c8fd6acea0913c6252bb884dadc7279aad6134475878b0842fcab9ea31c55b31ab4d0ac8c56398677038c1cd16bbba14ae8cc8844aceb97605725376471d462a5b780c724d96011908523beee9576eb4986dc35e072c438c83c6013ffd7a8c0892db92c44476e78cfb0fd689abb0dfe467dcdb7da6e577cab126ee18727a60e3f4ab003c09f65891bcb65285f77229eb288658e50d9054e108c827dfe9d6a252918664396c132aa9cf23d3eb50d36ac525a0b696d7315d1675731eece3771f4ab0f249670cd75708ef22b7c8807538c0e9db27f4aab35cc8f6a8abb83b824b27a75e9ef529b465b2852591d8a14638382c46e27f53fa53b7462e5573049ba3742edb8981dedc1e09ab97374d36a901801f365008523041ff00ebd242f3a3217eaf9037b63dce7e95bb63731db233dcc6d32a02c2431e083d8277fc6b671562b432e79af6f2531c39dc8f866881c123393e98e2a0b920958a67134a0f2231f313573519276b78d124115a327c88a0824fa37d2a8dadbc914aa849c00c5ca719f400febc54c6283d49fec5728a5df1012c1806605b8e3f0e2a65132c8e4040fb71f7b3cd437220bb858dab10cb3166c64965ec07e74bfd9d23ab6f963855f2c501cb1e3d7d6895ba86e3ae6e9e2c18c6dcf001c9249a7c08f1316ba93cb2dd558648e78ff3ef4d1358c570312cccf8dbb8201b7d6a6b98a25678c33b19007049ceff004e7d2849a12f223587cb7520a3b96e095207d48a93c899279ae254320cb1572c4b727a0f4ab4915bd85ae6520b8982bb751b88fba0fb719a68bf57bb8d212576e576ff000fbff2aaea52465c4f1cb36cf9141fc7776c53e7805bdaf99713488ef26521031c7ae29b7329d3ee598c0be71638c7f00f6f534cba321ba8d7cc32332ee627b1f4cd5af216e3d8db46e1e36778c9da598f3f87f9e2aa10867f3a5da79ddf20c6dc1ed4c66917cc0e00451b719ea7b54d6f1ef5924953023192d9207d2abcc092e2768ee42c4bbbcd259f1dc5453dbc522f9ace4075e3b8cfa52fdb1648c88c307031c8a633831471856dbd49f53529dd89798915cdc5b42238672919e785ebf8d3e062a1d8237043163c963db351476ab305469c98c1ce00c1cfbd4ff6b586192d6065911883b89e47e555a2d477e84574eb35bee8f0b70ffeb17a061df15515248e3791864f001fafa548d8121dee0bf6f615634e93c9125fdc16629f2dbc58eae7f8be83ad4b608a5790797702dc90d28c07f66ee3f0a92d6244c472100104377a2ee27b69897da5db9041cfd7f1a6bf9c90445d3686f99588eb46b61b659558e3b075400293dfbfad4463867471e6be54740dc0f6a2d22f38159b95278c76f7a926b258e32e197cb27e5c0fca9f2b15ca691796015dc59ce32471525ac51b30924fbe33c13c014dcb42cabe6600cf39e7dea512c64c9b982a01c8273907a5357b832190b2feee32c4365b39fcaa08d44ac4393903963ce4d59322edc0001036ae476a8d363ca885b6a9e49029dc6859cc62c2308a15ba9f526ab191360cee040e08eed4fdc9e6c8397400ededcd0d11451e62a92c41e0e68b80fb795c33658ef3818fef0ef48d3b2a00fb8c0b91b45471f98252c8b92a7ad588a15921caab164e64c9e39ed430d42292580b20d80b72ccdce075c5366b4e03bcb1e5b9c0ed8f5a58e0338dc8a5b1938a8c33344a8e3693c7ebde8dc06b5b4aadbf6678078e7ad396490c62346daa496257a8a796dc8ced2b6f2fd00e08f5a8cb3ae5380c5b9a00647103708923614b75ab4fb36b2a853b4773d7e955cc6641202e80a0e0eec64fb52472120065c9eb9cf5a96ae03b73fd9cc40fc87d6921b4966de2300845c927b5217231d893e94fdecaefe5b93bf19238fc2980c594dbee4640cbfdd278a465723738f99b81f5a96484f944b47b0a9c1cf5ff00f5522c276237981998e428ea2980c92168a08df2a15b8c03c8f5cd229410b673e66783daa49fcb5606262f9ebb862a308429eb90680b08bc0c76cd2f5f5e0f4a40bd0839cf3521cc9233638c6e6dbda86171b8f94e39a528369656c8efc77a4c0040eff5a711d3de900cce4f7e6803e5ce79069d8da54f07fc68dbb474e4f4a5701a412a3a83dfde80ccabb013c9ce31521dcd8f5a3730cfa0e09a2e31aca80f049c8ea7d6856d841c6720f068da5980f7a1d7e6f94607b9a6020008dc78c526391ef4fc7a0a55f9531fc5bb383d29098c201603b63b51c0c91c1f5a5ee091ef8a76d078e9fd6818cc6723da948e7807ad29e067f9d4af1f9785ce5b2391d3140884639ce32681c29cf34f39ce40ca838ce29a71b724671d4034021a5491c1c714bb7a027b53c2e0838cf34794551643c03d39a360b1181b8fa606726a5457d8250b85071bbf5a1972b8ce462914e1081ea3346e311034936d0725f9e6851b8e00e7a8069ea9b5d5ff00e5983827d3f0a714f2e50c8ca46ecae7fad0044471b87e34ac0fcb91f7b9ebd69e11d9d8aab3364f00524caca4823dc7d0d2023dbf3648c8a7120f27bfa75c52b6436314e0323d80ed400c20e01c7cb9a1c02cdb0614f4cf514e0bdff3cd18cae307767ad0034019c646474a5653c0ed4e0acac5bdbd281c839a6037683c9e077a556dbc800f3d0f7a523238ec79a06327e5e0d024340c7007534e5505b0300934b8208a1464fb548c36601c93907d6900c67b1ec4f6a5232318cf3d69ca807df19cfa5500c238c814806e2066a4c7ae7934eda17a13edf5a431a17249c1c03d693680723f1143823079ebd29480db97a714805087612391dfda9b8e01ec4549d1723b534a1c124e01e94008572bcb7539c53d8e301062940e3071c77f6a461f36073e94c040b8393ce0f34b83b73b47e34e650c7af38eb8a4278ce381c734084008c63a1a7a72492720f41460e4a834f0aa5c85f9471f9d03b8cddf380d818a9428da643cb67f3a8c2e5c0cf39cfe152b9e383cfbd0215597731740d918c7a50a4ab1c1247bd22966501b3d783522c6636e71c75346e01105da4b01cf4a1501938ee3a531880e0f2c33c559d995f403d0e29d806366401467e5e99a96101ced3d738cd3590841200707ae3a5470caeae415cf38a6059491e190c6bebd4d4b247851d3713920f1f5a8464c9cf27d7d2a524cb0857393d33de9d85d47a0c46a8064a9c100f414f2ce11d1db39fba4f24546a4c6cd95008ef8a92325c00eb8c1f94f6a62f5248f88c864c1c7cc7d7de88f684253e56cf2a6a457660a7a92381eb8a4f959be6439ea0fad500a8a031209fce9b2a2ef0edf781efc529c240db32c31c0ef4c81967c3927a60ab76a009163f3003921872074a720933f3007d181a7940172bfa1e94dcf9848c807bf6a689d771e4f627041ce6a4c094fca4608ec6a3da091bf3d319a8998c6db413907823bd30d18ff00289ce48273c83cd35a491546e04ae76961daa459239dd583f96c3ef13d29d244f1be5986186481d3eb4011f9df214dd827bd1b0b282705b1d8e334af08d8195be6f5a8b79276900b03c8a03c90b2c5d1b183ee6a3f2f78590c7c8ebeb9ab25e26889c9207041ea2a28d4c6ed83f2b7ad16ec09f72a98f1923e743cf079150ed22662395e0904722af3aae395e3b9079a8d6161925f729e54e39c5017d4a32c536c250e7b8e6a6b5964f282c84861c73daa5203b0538c76c52cd18071d89ed52f71b44b1caf0cbe5cb13213cae7a1ab0adce79c9154d24924508d20609d14f6fa548ce7909d7ae49fd29a6264ef30eae081d3350855f3328e0a9ede86a5470e30c307b8a8d61447254e0fb530d00a3a36576806a4f33e5f9ba77e7a505558727dfad3001f32f7c502249258d02b12318c039a68c13f7baf4155dadd197660f3d41a9621b5428e83d68b8c94311903ae38cd451cd233159136f3d453c10db8670475a4621b0a4939e868018d6e719383cd549515247674209e8c2aeb31d98db8aaf248428dcbb8770690d15de19426e53b49fd69526c2aa1c1f5cd0f3ec0ab9250f6cf4a511c4ce338ebd714316bd4699562daa1f009e41ef52c588fe76c6d3d29973142a846467f9525bee30e3391fce8d03a16642245e471ea2a246382aa778f7a4f35d319191e94e47017781cfa50c3a09228f28e06d27d296252620acdb88ee78a03b3afcdc1229b1070c07183d685713ec3c208c9206334d676dc368c8efcd4d2608f9b8c74aadf6c857761b38fe74c65abfb78a57560fb14938c7b8cd640b7303899d8160e028c75a9ed6e56f2c4c44966421bf0cd35a75bd954db9513a3111ab701f1fd735c5a90a3ef591467df00591f7ae491823a9e0d30b4a6449a0e064641eddeb4e39e43066e2d8022421d187006339e7a77a511d94f1892d40db8c100f4a7769036e2577f21ad8c0db95377f09e809c815b2cc92e931c631be372727fbbcd667906373e5c71be1080c4f040e47eb56ac771b62663f31253d473d3f9d4dd3455d48a5105b6ba5742146796eb9cd5f374924255dcfeebae3b0c5519219a370638d4a6487e7906acdaf952460e0ab38f9a361dab35276b313d111dcebad750470a292adb1d8e3ef60d5a12299bc908543672c47cbb8e39aa50c71433173b4a469b4f6e7a01f9d4c973290aceff00bb2e540078ea0827fc2a93b8f9988e4aa9572a769fbebc8cf4e2884a8f3485d837e327aedfad422e36dd7979dc3072a075c724d58bddf11c32a825be607b7ad1676d049e84b1cd6f34abb11c83df38fc7f4a59990077944a559b747175cfaff3aad04c8d3b12accc149dec303278e3f3ab76b03cdf3a8de4139278a352af6d8cfba91a28924b8552c5cf96a1785e075a860bc2c4c8669a594b7249c281e9f4ad85b089d5c4ad8e72dbbb9a6f916f6d019101007cbf228e6b54ecb504ec2a3a35b812aee9073b738dbfe735095691d6369604888c6157903d85324b8b58ecd9e283cc2b205c3b77233fd29f0dc348ce2236e93ee2146cce573496f72ec5831da451aac68c133c8419247f4ace9a457973109383c638ab10df23c916f6eecb2305ea463a7e7504fac431cd2c45c00bf2f231f9d349bd58243fcbb662cd3472ac98209500a9cfae2a0b2b8c2cd6792668c130330e7e9531ba3748644f9937602c63a5579a29f7c528411146255dd803c62b4b242b08b72ed0a1638113f08dcb163d5aa45dab6e85a52d23317200cedffebd3a74b6bc747331475196099e69be40815bcbb696527a65c63ebc7352d21bb938c087329121c7dec7e7555a3dd71b0ca1d5d718c1e47d6996d75732a4f108d126500c631efce73f5ab578e6cec6396e32d2484a1650474eb8f6e7f4a949dc482ea247963df06d8d4803240fd7bd4932bc3b3ec922f9593b971c13ea4d432a48c90477854c517cc5cf2460e00f7e054377327de86494c6c7aa2e07e5542ea45bcf9f1998a6e249620e7249ff000abd756de79548776f6e5429e0fd6a8247be432c2480aa00cf5cf7a92089a093ed492b6e236a863dcf6a6f50b11476ef0cb22492aa1424301cd4b05bc5146ee65814be541dd9207d29b1dc4d1dda4020450ec32cca4934e71049a90444e0120f943258fa51abd01958dcdbfccfe53156390c462ac453466585a2dde6aae31db14fb4d25afe4b80afe44719c2ab904934cbbd226b090069048d21f936fdea7604557699a59e7f3518671c7bf602a7b5329656950940a15777f0135182c645876a2aa7573c13daba97d26cae3c2315f444453280cc55ba9079cd68969706ec7311c86056b6b550e76e1d9877a89e50618226567955882aa781e9fcab4e348c45b548f399726563804d54bf58211e5c67e79932587f0e48e7f9d268082d93fd2a2918076739453f740c536410cb77be62a2339f95475c1e055d0b69729046a1d047c673dbebef55278235ba10c2bb210769627209cf5a2d61ee568d1a747558c7ccf9041e40a89b033b4edc93827d2b56c61b786e936ceaceecc0e79181fd7a545ab12675529b727017b1f7a2da86a56b6856692248d401b4890938a925b5852d9a57cc79188941c93f5aaf170c8c370c1e307bd58bf8f6ec762e0e009158f3bbd87a50ec012dacf670b72bb49187c7009ed9a5bdb468e6189cb238e64518526a7d4d0882d823e6361b82f24927bd406f02d99b59407017e427f84d2b0c82295eda2dea460e40e7f0a8618de4b9385dcdd48c7514e491c42d1a2e430e78ad18504aaf7774182e022b4670548fff005d09032adf4a9b8c1085108da4151c8aacc632aa14b6eefbbb56bbdcd9b69ed6c625520615cafccc73d4d67436fe7204551bb76083c134fa811050f1c876b332e391d31ef4d77662b9c6541031e956e531dac7240b1b0981019f3d4d41244f6cfba48b0586541a9b80c3b5ad972e7703c2e29bc9c003dc8152b43244914ac080e09563ed5247beda52571e6118208c822980cbb82e2219b94652c3033cd259a2cb7088ccc0336d247614e7b869e61e6b99140c004d3ad26f22567fb82538dabce38e3ad34024d6bf6790a30e33857ed8a247436cb10450c8c4eecf241ed56ed963bc5965ba980618403a7000e6abde476d1caa96cccc36e493d8fa545f5b0cadb4a8cf201f6e2ac4e60f315edb7a295c383eb51a97930a5b28a3ee934de1bb700f34c04c71ebcf7a06303d7da9f8dc074e9de855dac18f27d2a4445dc7f5a7b659b0cc0803191fe7de9f6e8b2ce2366d80e72c452cd0ac739457dc077c75a616222303dbb5371d703153ac639dcc077fad35463bf3486210477f7ebde854da072093cfd28031ea7ebde9e149340118f949ef4981d7273d8d4e4167181d4fe82a3200ebd09f4a018c2a58918f7cd0460d3c70ded8a31b850022866f7c7ad3914eee46680bc9ea39a706feef7e0d3019b4f38181dc526de71fceaedcdbc114b1f9171e7065c9e3183554ae1cf53cd2b8c8c86ce33c66865c9c73d3b1a994f270071ed42654e40e7dfe945c4460ed994853c75e2a570891ee43939e49ff000a6aee660d1a92579e0669c5438073927ae29d8085d89079e7a9f7a96189a7895630cef9c6050d186238c0da73cd4f6f7335b79a62213ccea40e949811799b995e3022655084038c9e99a496368e5232377e7f85290aacace0b03f780f4cd267322975239e94c060e3be4e734a48ce0640ed9a76cc11c72dd3de9c78001fba3d69011639e0e7d69caa3248ea4d38c795ca9e3a71460e430382bce280b864e0a95e3dea255cb03dbd4d4a7e63c1e076a4da7f1a100601e7b9ed8a15483cf6f5a91d31b40e7039c77a50dc7ddce4f39a0642c3f5ebcd038e1b1cd38af19cd2637753f3678a042904b608c60d38839c63a75cd1c93963dea475fde9f9860fcd91ef48642b938fd68e833fa9a9839d8032f7e4d4607cdcf20f414c4301f949a7856788b28c8ce09f4a14724609c8cd00618e0f1e940c50a36e09ddfd28e658f2d8007414f54528a17839a3a703a01d2810c1feaf3fa52042406f7a915777273834f07684042e13f1a4045b70fc91ea685c8e878f5c52f6ce3193d334a38c8f5a61a005428e598860781eb518e739e39e9eb528030491408c9033c66801001e6678f6e6a411aedc13939e29082140ea40c1f7a7a80814b1c8e87340002aa843719cd3fe72a003f2e3afad2e115883cfe3d69f123332857eabfe451aa0f3238917cc5424919ce6a4c0249ce39edd2a108db99906507504f4ab1111c8eb4c2c1e61dbb17208183ef486308149c83ed4991e6e01e4f5e7ad399f91c71d0d310ef9d6452a075ea0ff003a937e18a609573819ec68f2826df33e653d1bd29616c388d978ec4d35a089632241e531f994f53de91331aec2703766a385713b171c1e33e9533fcdfbb7f994fcc0f7aa4ae03812186091839c66a47731bacaa32bd1d4fe84547182f95604607def514e7563bc673ed8a00570b239c3147ec477a583881f237480e79e2abac4e931576cff0012f6357012080c7af4346e0c2321dbe524363953dc539142310c7393d0f6aaa46c247230720fa558dcc11727eeff002fad31128277603601e306a39a16d995e9e94e9009546e07ea2a4e0c6b9278ef557b8995842b8218633f854f0b3c59494ef5e833d453ced972adc647514863c8fbd9c1eb4584d913ee3bd636caf6cf63502cc03813a6d278353f95b1dd9594ab763d8fad3186082dd0fb50c64ec23c31e1b3dfbd41be25608e4ae7804f4a6a36de3612a7bf6a6cb9e38cfb1a604a721786cfafbd247f29c01807a73d299bcae15e3201ef4e181818e33c520206532b1da4aba1cfd686e086ec7a83d0d4cca59c820ad3513ca5209df9f5e68f31dc81630640fb873dea52190fc9c8f4a4480ab124f079c03d0d298da56209c303c11de97518f240404f14c96e59543a027d48e314d9109564c0ce7a1a6451c892293f77bae68112c530b8e7a3e3f3a8c4b2452e65048e9c9a98c2c1f2ad8f6a6c9009d70dd3da815c70662c2404820e707bd1e602094e71dbbd3a388a26d272bf5aa1346e6e40e47b8ef42f302dc7296e4fcb9ab1181c03d3daabc7950031c9eb934f3232be46303d280dcb21838fa7ad5668c86639257d0d3fcccf6c134c915ce30c78ee29e82d885a05908e39f6a6164f30237fac07a1e2a76678c82dce3bd55731cb2e64043aff0010a43f31d1cfb3242ab003a13cd462f2273ba2c024e08f4a91a2e46d6dfcf27d68f2a2660446030e09149bd42c31a6de72530ddc5582014c7afa542eeb17e580714893038de4291e8681d9ee40f335b9200dd9ee6a7865de0381ec454573b645f91fe6f4a486160324e0934ee2636e259cc9f2fdc1db348a8857781863fc39ab2ea1465bb8a8701988030474a1bb812c70c569784c2bb61906d527d4f38a6bdb59dac81a41f29c918fcfd2a459a286d8a890c847419c814c9ae037967cbfdde37ee3cf3e95c0e443493b972696deeadb70c8d8a0b0eec09ef4cb68a02c64dbb171d76e334cb2bdb6dcf1c98dc78f4278a73472cc9b219bcd24676bf18f5a1b1d90ad046a4ec7f958e72a7919a1e185223046c5d5b19c9c138fff005567dbfda1267495141efeb48f29de421392dd4d269a5a09ab1715a7642555006918b64f4f7a0c989807519e9bc5322dcb1b03c260aff5e95554ac1284607713f78d1d0997293dec6ed27c903087ef161d09ff003fceaa0c3bb6159951b246303fcf4abd6d3335cbc26e1901fb801c73de9d21b9cc8658f702dc8231f8d34f4ba29349105c4c21b87518123614e7ea07f5a459c5dc2f1c6d8914965cf24f3cd4e52d6e645170aeaddd94f53dbfad5f834db58555addc103b9e695f4292b99105c48982433b39c01e8077fd6aec12ca9c9c228fbc9d0935218e12e64795b69618c1ed51492dbadb151cb990e18f2dd7fc292a9a8ecdea0fa8c713af9ac8c01fba993f855ab89af0c8a96b6e0a9192cd8007d69b62f0857b99102ac79dbb97ef11d3f5a8a15bab9f30ec9252d96c28c73f5ad63272d914911fd9fcc630de5ec7b9dc32c31f3c8abb1416702190a37036ee76c66ab790fa7a289adbc9dc492ea3afb66925b6b7ba29b1cb45bb255fa818c1fad36bbb1df4b89746c2325fca042f6038cd5732c77d3652d15777f198c1cd4e6cecd64c45705493c0ea31daac6c30cf1c8f23346bcf20006ab9406ad95e23020a3c58e0ae131f8523246026e758ca965076e704e2a79eea18f7cedc20033c67d8550fb65ac83725d265491e5c898ebdaa1a6b70bb7b0f1a0c4270c6e645693050839ddffd6ab975a4db9412dbb0f314753ffd6ef59d35e622594fdf0362153dc7b5561a8cf6b3156fde9201076e3ad34e4d02d372e4b22a03248b920637e39fc6a0bfbb1298e149036c846148e0f3fcf3514974f031dc763339e48ee7ad3e185ee22965421c138c15e0f1d7e94ecec4a44772eb711440ca519942ba9079a725c5b5bd84e9003be5601a461d00e714d16de6c6261f831e71515c2fda6342854ec1811838233dcd3d5a1d891ee08b26753991d7838fbbef50b432db4110b8668e6fbc369e4fd7fc2a4b69e199edd6789b617daeabdf1fd2a6d4595ee5f09b028f9377a1156a3602a473ce2433bc8ccfd4eefa63814e86658c111290ceb803b86ce7f954fa7c713cc5e670a8832db8e037b7e62925ba82ee78c5bc11c2c1b86f414daee212e5e4ba99155555d07546ebf8d3657b88d836e791a25da392793d727d053e68a1b42de42bb40847defbce483fe14b6e6391e196eae55216cb3469f330f4068e61dc8ad224b8dc030dc06ec1ebf5a91617e2c524fddbaf5ddc67d71eb502169925911943ab1daa170769ab16760f3a89983f9441f9d700003dea9b626c86e24566015c0c654e3be2836d35c1fdddb97f3173bcb003815a36b04160f34720c92db559b8ca914e8d1d24695658becabf2ed07b0c5249f50bbdccc44d9a66e629190db95b3f331e2904715f42126b829293f2838033ff00eaaaf3b472de6d556fb30703af2077c53afa486e651e4a148d06067ad5741ea38cbf65d4032c6a8ebf2fcbd3a1a97ecd71733a836eb23330c173eb59bbceedcc3a74ad4297b2a5b805c798c4e4f1f43f8034581b2a34515b37df3e7a310cbd8f3d7353fdaae2f1833050dce428fb8bdce69f756f1d84fe6733145c18dc72c4f7c7a52c4812c67b6631f98464b06fbb9e71ef458082fee647b884aa948a31888918cfbfe94f6d3a24b23713c8fe7618ed0bc6ecf7342a4fa8ec91e7891615014b60607d3f0ab10df13049692ce5cbb9c328ce727934b7032d0ac321649b1270071c1cd5db48a77d36e8805949c003aeee3b7e549776b1d8b2ec31cf9f51d0d5ababeb579562b0b7488bb725ba50865695239dda04511edc6e793b63d2a0923877298d65f388ea87a11d0d36e6e1f3247b172a705b6fad4d6f3c96624f37e57db81f8d2048a41c39691c9320e98ee7dea7b9ff005aa5e3605a3e371c8a892079a58e384659988da78c54b716d7104a219c3655768c9e31d78fce8b85cad866fddf38c1e2ad47750a58b47e40fb41c00e4f41ff00eaa89df133ba82a0f02a73a7ca20f38005426f719fbbec7de8110cb1dac6ca623239084b9238273d052472c96ede6c6bce319c6688dd4ed59173196c923a9a92ee5f35da4883ac390bc8c74a2c8640a0f96cddb3d7dcf5a5dc7380067b9a9222339c107a919eb4e20799f2a823ad27a0c80263b1191d69ca00cae38352c681a6652df301dba535235ce00f9b93927ea6906c370536ae06e07ad34c64b63be79c54afb776141c1ef4e79018510228dbfc43a9a6c08768c8cf5073f5a5c73d3e5a715720b7f08e32294264003a0231482e348c0193de9b85660a38f5a95800dd7a7a53701587719cd002f964a6fc8fbd8db9e690a1ff00f571f9d3c83b98f2168c72076ed48061f9474edc526d2514f407f5a94e09fbd9cf03b64d2321c104fdded4fa85c8a155120dc484c1c91cd22ae060f5ef9a7fddc8c1e28f2c0d849fa8a007dab471cf1c9346258c1394ce33c5236d32b18d0ac6cc7683ce07d688f21d988079ef52ab6d591644562e3683dd7de90103f0fb3b8ee3bd01360c7af3533a2a28e7e6c67eb48103042a4eec1c83da80ea42380481cf4a66d62a33c0dd9ce6ae885bc9b82cc15d31f29ea73e955d5039f97b00714201064fdde0afa77a2189949f971dfafe14f00060dd383c8a919cb3290305546da77022543ca91cf6ab09745620822504a90c71f7bdfeb4d89f74acd32eec92d91c75a62f43c743c1cd2683a911f9b9ce07734a077ce429e29e235117239ce73eb52f9244418720e3247bd0222da37024b01d88a0f3819c8cd4bb404c2be4fd3a530727a9e3a6290c8d432ee5efdcf5a508405f53e9dc54bd0123a9a4030a0f3c74a776047b7a11da9586e258e4e6a455240c9ea0f3eb4e545247395c77a408876e58ecce28193f29e9eb531f9391dfd4534119e3f5a02c46ff00315c0191fad34464f38ef8a918648feb4a89c11d73cd30102e391d31c0a08f9327a1f7a0fdf0bf4cd057f84e40cf1487b08ca7a03c0f4a52818f27a77cd3e25f2b2a39ddc1e3a53704953c7b8cd31084ae480b823f5a7c48af22872429ea475a5280e31c1f53499c11e8b4003ae148e7daa35cb1040c30e0d4c41ddd0faf3411fbe523fbd9cfad0026768dbd475c50101e4743e9da9ecbf30208f7a690771ee0f19f4a008f3f2f3c734edbf2ef63b4fa53801b0f5c8ef9a100190c46319c500331c150324fa5498263073f514b1a924903f1cd2ba15c964e08e32680223f310d9cfb1a913e4c93d0f3422e178e33da9db7a64f1e94021ae007523906a6dc47054e7b1151e403d3ea695640ce140c5307a8e0369ceec8ee334b17048eb91919a8a5deb26f1d29610fbd71f749c1e298ae4c232c5b18c8fd29f100132e08e339a68602421b3c77cff3a99ce7827e523e520d30104a194364a902801fe5271ee3b1a2255030e3e56efe94a4b27c8067238a62266da7ee8dacbc918eb4e2a3874e381f87ad3718601c8f986013fcaa3398c088648fe13dc534265c907c8594ed0075a4809e437df23f3a189541bfa363e6151b6085789c80a79a631f300b2056ce08efda9843f2c87764739a9cb3c910048703a71ce0d288c04c0e0e31c520230580563f88a796c3ecea0f38a7c43ef23807078c8ed51b9644185ce0f14d6a2278942a142df81a448da31c36e5ddd09e45312412a82701bd33de9406272a4e57a834d00c977248a791cf4ab319009c1e0f3512b8909571d293c96461b09c034ee21ef182d9c0e78eb48c02c6549e17bf4a4771173ea7a1a3702403c03ebde98101431ffab39cf34b22eee80e2a295c5ab9c16dbd4548240eab344f953d48f5f4a41611d1d8601c8c743daa455dea0771d6a312ed60cf82a4f27d2a5211e4de3a63aa9ea290c25c08f0c08cf71da9823120196fa134e9e3740195f8f5f5a685dcb92c01c734d8af62350eccca4e083eb4e665560718653d4531a32b2061e9c9cd3d627989df8e7a1a57188b969090783f8e69ccfd032e3d0d20b7319254e08a6ca80a17e723ad342d091586482f961de9859d890ac3e86ab2ed12075efe956378dbb8e08f6a076d40bb0072a41a62b646f24fe352fc8e307f115148030f2c0c0a05a0dfb48c9054123b1ef4c59a39095c146cf5a568c6ddb9191dcd52732c2d975257b102907a1a863675f5fa53e38d9491bb3df9ac98aff64a42b1208e0355b4bd3c123a77cd2ba60d1665c84e473554c916429600fbd483508ce449f2fa67bd12451c8bb8a804d3d00ae5a259032c9823a8f5a46badd282b9e7b814ad6e4e79fd2940654da0024fb521f415d239460360d41b5776c6a7c892ac6597afa524339e03af5ef8ff003eb46e17b0ff00214618639a8d11d24dc1f75492ae4308c9ddeb54419510a939e739a7d0562d9ba52c5590839e38a7e4000e39fa5550ff0028248dc3d69c1de3e0b0653c82280dcbbf67d3e7221590c5cf6e99a867b6963b5188f7c63ae3bd538e230b35ccafff00d735627d6105bf93123863cefed5e63bbd37336faa2a97917738db81f34671d47a7d6a7b4b996789e467282305893d720fff005ea38b64929defc3292d81dfdbd292d905babab38659091cfe556a5a5996f52cc1ab2895dc9cb907e6c753daa67d4c4a4a496a9bd8122451d2b2cc3e4c4ea8aa6e24f979fe05f5fad4d02b08542b83273dba52b3dc7177d11a66f6c162595a07fbb9231839ef566382c275915ad24668db950dc83ed5956d1ed8fcb69039c0ddfef7afebfad68898472f98cdb189ddd7bd2e5be86978adc9218f4213b3f9338909c963ce29d26a7652ce62331403f8c0e48a6ccf6f1af9d71f28938c13b73c564cd3456cd9b6485c13c1237114e34e5b5c9728bd522ddc5bfefc3dbb97886086233df1f8d5397ce9efda3f3d9a18b07e418cfd7f95588ae2f65456693647ce588c0a59e6782d4ad9c2243b83bbeee738e38fc6b48d36b71268860912488aaab808782dc66ae43703ec71c6b106b8794c5bb38e7af3f9d62de5d4d1b79400ce7e671cf39ad5b0f257f7aeceb087322e7b13806a791a7715fa8fbffb4ec592d56358a01b77c871b9bb902aa5b6b4c15e29643b81386071cd3b5169af656b98c39b75202a6ee1b914db3b05bcbcba9c440246d804f7231fa56b11c66d3d4dab5d4679ad42dc969148c6f0b92d4d5863595921899998e421f5a75b5cdb437b1c1e6299252dd0e7155ad8dd5aebb0dcaa7988494653fc218fdeaae4bb2e4d5ce86c34a488b5d5c469e71fba08fbbffd7accd7a1f2edd08ce5588e0e3d6ba11708cdb063e5e6b1f57cdcd9cb227011fe5c0eb8ea7e9d6868939382fae247590a29456c28c64ff9e053da38aeee42281148583480af2a0f51f5c50209d258dba6dc2a606493eb4b197b5d4920757033bd8e7e673cf53fd286ee17d4735b24515c22c6bbcb96421b0231d867d6abdbdd4be64632afb79c919e28ba6db6d18cb6c64df91ea58ff854322dc5aac2e0864917a818c7b7e5425a6a09934a88c5fba7f0e4e71dff00ad3adc8b5824460cc246c673d3d7fa553f31924c9efd723ad482e154a104820f1fcea92b0cb2b2ba02aa70106ec93d7e950cc8a7121c9f331865e314dbab8135c190a850070071403e69544dccb1af43dcfa0a6808e3825f30c916ec4646187ae6a792397686995f71e496ef8a98cb2db6c8d404279da3914db895a49465860ae186720d508643147288de4de5075edfe78fe7561acd05a99485525f6ac7dc669267b84d819822b81c2ff081d0530cf24d203233101bd78152da60362baf2309146c5bee8e339356de55bbb5927901b7767c2a247f78d4314be5988f98095ce1547f3ab87ed175245218808377049e83a74a7149abb033a6b6b98dcb043b987cc3381f9d6ad9dc2adbb066096f80307907d6ab5c09a10cd1b195e57daa31f75bae7f4a92162f6e614c48ee59a40bd89a692ea2bf61b359ff006a4f1bf99e5201f28ebb875ac99926b6f31237dd18631f3ebc64d6bc97905bd9c567229478d40c28e84fa9acff00b31692233cfe6421fb7bfafe954f7d05af4282ba856424123a9f4a7f94d2972913bc519fbc454932410de3bc519789890809ebc6339fad4a811219565b895d1d73b633c138eff951b944b7696b7aaa62805b44a76f9a46771fad24b1bc565186b96662772ae0e71eb9a945bcf7fa6da86b94f2d1bfd4a8c9183d4fe1fcea492d64b7923b694ef59df3163d081d4fd295ac1d4cfb5b6b8bd9f7052411cbb1ec3a8a6cb1b47232801431c2a83deb49a592d2f96cc49108803b7b6ccfafad4576b6970a3cb3e514901cf5de075feb4f715db216852cb4f9977c72bee0a5b19c67b034fd365b5b7883fef05c3601246411d40a79d4e34333471e7732ac71b0c800753f8d5783732c722ba360ef718c6de7d28ea33526d0ae6ee0fb52449848f7390719e7271ef8358f141bee24689445e57ef02c9d78add8b549a3d1e7537019c480ac6c30706b9f90c92b1986e2c492ec074cd4eb71891812bbcb38de0b067c1c134ef21ae351db107f27700bb87419ab363a6bde44489523f94f07ef103ffaf4a6393cf8e15b804b7196e00c7ad1a20b8fbc5fecd68e18761656f3164efee0d52bcb89af6e3cd9093f370a38c559b9bbf36468c4119646f94af3c0ff001aa67e55790fcbb46718ebed43d00896339da726ac5cec5863f2ae5dda45fde0cf7f4ad04b2b27b3138b8206325871f862a08e7b48ad111ad164948397271dcf3fa524ddec3b10cb3cf3118555242a6d51e9cff5a6c65628c452a19143ef68c9c0c9040a42af82c77633c9f7a47c365b24b1e9f5a62d09164b74b6955a0ccacc36ca4e30bec29b0a46d22890b15efb6a54b7696359581d84ede298311e6364395a96323c6d404139e73c62904606d24649e9ef520cb020e39ee7d29fe52a83cf7e28d808d41c631d6a3287d7ea71560a8206dcf229235c02589c670051a0047186b6691ce01e17df9a8948cb76f6ab042940bb78072413488aa1f2cbd8f03d68021382878046691e30c31b886ead52afcdd463827a75a6b0263c93d4d2dc2c398f9a446080a5464fad44c80e403d0e338a902156f9cfe38a561839039268018b133380abb8fa014145e4f393d4e6a688bc2e2747c383f9fad37059cb1380589e3fcfbd0c087764b60600a4c0271826a42a0671ebc1f5a9d153ecf39de55d40da08e18fd697a015d4fcd9208f4c77a710320b1c9ea69e393cf41cfd697ca0d19299c8ea4f4a6c688776e2411cf6a5185f707af14e28cac48208238a408630063a1e78a4161cd8392578f7f4a60600315e07d2a571850befc114d20041c0c1e99a0561b184d8cced82074a622fef7390460e09ef53a8f3240485201e4546400cee14f0dc7b5301adf39f4f523eb5280321780bdda940c3062061892727a50c0264823d2802265db2e1c7538e0d3c928a5083d334f9232a70dd7be289082aa07ccdea695c2c311586182e7d7be29855b3c0c015615963b592368d8cb9c860dc51941b5826595bb9e1a8b3022507249c9eff00850578f5f5a7b7df6f942824923d3da8dbd70723a8cd2d03a8d2a72a0ff78647b529037100703a7b50b92a718a77041ce01c669a01b963bb7f071c0a691d71d7b53c2f4269700718e739e29011055c673cfad2a28c673f37a549b1464b74a4c8c1c74ed9a6030a61c363eb4b200181edfca9e46471d48e0539c798106146d5dbc77c7ad004439cfa9e41a3036607419eb4ed87af4cfad2b36f518c05ef40ec350fee80db9e3ad1b738c703be69ea1761e33484918c2e7d41a0570c336558927b1a6925728dd7de9c656cab7626890395c80091cfd6801ecaaa0003902a3e482491927a539f223c11f31e45055976f18e2800280a8ea0d331c67b8a931d58649f7a4386001fd2801198818f5a5fbc4fcdf740007ad0509c0e704706947eec9cf3ef40028ca90476e94a49f4cfbd3b69652401cf50694a6ddc474cf229d82e336eef9bb3501407e7ef66a6519002afe54f551b7701f37bf6a0447b015e9c9e69f18cc638f989e48a72905f701c0f5f7a3ca7080c6c0377534c0670b293d78c13eb4a577200a7bf0476a62c80161b3073922a48f11e587f1f4cd3b00e11bb47f32e76f53ea293e62dc7200f979a9b731fde44c4766142801488c673e94c426f0ca99e181fd69ed860a78183f74d36307c80cc3907193dfeb52b2ab290e31db34c19223abb94e848e4377a646823c88f81dc50412849ce077f4a616c4a9ce0fad1b81662db26548c1fa546e5c3f96c79fe171de9fb8a9dc31df205425cac264ebb5b9aab0161082bb89c91dffc6a32e03aab1caf623b537cdce6445fae3bd4067915ca00aca79e692d10b52cdc246c9e606f98771d696295da40e1810475a8a3d8f087638e71c1e94e468d5be56cf382280260333e78c7d6a7047186e3d3354ae5766c7562334ede5501c67bab0ef557158b6ea927cb9fa8355fcb54caefc73c034f6daf8901c37a53593cc5daf1fd0d0035a3ca156c1c723dea38224490943b41ea0d4823c9c03f32f507b8a1c6060633fca80b8a223b99597231904739a62188232152a47420d3a366914056f981a5950ba9c8c36680657fb41198e43f8fad3d087565e840e09ef55e5b57742d1b06c763d698be679581953e87b526c76260f860e1b247148b3fcf8c1f2dbbfa1aa0d0488fb95bef7bd588c480af3c13cd2e60b17fcf0d1648ce3f3aabf6976c88f24679cd5844c8dc3907ad536f32dee7703f293c822ab5b01661f2f00b2006a292491270546633526148193ef504b3000a82508a011387556241201ed5148f399014c103b1ef502b1619c81ea6a7850b7cc5ba52b80e422420b290c38ebc1a4b8b70e30bd0f3d39156a319036f5f7a8e5c29c3647a1a64fa14c59c417e75f7cd4c96236928783db3d454922165da3a1aa5e4cf1ca0ab9dbd719a2c507d9d95f0464771569431050673d85452c9b71c1cf73522a863bf2777ad242f51aeef06edc08603bd34dca38ddb707bd2c8a6472598923a66a02ae1d7cb51d3d681b2759a328577649ea0d4476f96db41150c90ca5cb0e1b3d0546d71206e54023a8f5a2c1b92c539457c1c9f7ed5599cc8e4aae067383529c93954c13d6a390b6083c90727140ae4a363478e99efd2a4863f2d3079151c570810ab20f41ef5209422e0824374a571752a5ccecd379288582fa7ad42d05ca4a772614f3563cc48b76cc34c0124af41ff00d7a861bf33db34726403c23f704f635e7a4eda0e30490d5758b7900be7e5c0fa669f0b89dc07711e3b019a75b40604fde91b558e463a9c7f2a64f0b4811ca958d8e000796ffeb55b8d84ad72eca609ac64ba899b8223048c6e6aa30c399904cec01e481fe357aeee614b68ed16127cb009d83001a8d6293c8f386fda0f1f2f27f0fcaaadd46b72e3c490b22c6c549ee17a8fafe54f9027d9dcb00d302406f6a4b54bab870f20f2e2036ae4724d4f35b489208f6a2a1180ee70589f4151268d1c5233eef12dadb4723b6ed8ce09ea496eff00954369070c3602a84b1e3ad6acd61149711c933b33a8c7963db3c9a96c624860bb744240859bd79cd25534d0c9dcc2bacdd59c53ab92aae43a03d31fe452470b945fbcac8b838cf2392056a4c8e96b973e493c8c2f5e3b0a862f361894be5e66fbab8e9ee7d29c5b40df291fd9523b64debfbd6190be9d3ad56fb3dc5ddeb42788108dc7d856adedc43f698d5a327f72b954eb9c558b13988cb258f9708191bdc966fc2b4bf56349956460f0c780de4c6d8554e012691e3bbbc8da389bcb5076b84e38ebd6b4e59e031c45edc293cf19e2a07bf6b69fce8c288f3ce7a351aa1c6e62496335bdc79eb1c9e6290c02f1cff91561358bedc41b402451f3312466b5c6b52cd3a8580138eaabbb14db8d4c794e2771148080aac00ce7daaa3392e8392285e6a7358ccb2c39fb3cebbd501efc673f8935ad26bf13e8f24c60d8061064f5ed802b365ba659615b953289632d11099da324552b897cb8e0b468c7968a59b1dc927fa536f4b06a4e8612c93bdc480b80db7b0c0c13f8906ae477b68d8c0623382c4e40fad50b9b58e3741745a34da0a2a364b83d053a74682d8dbdbc26de3c64b9192df5346e84985d4724a2368bca68949c1cf1c9e69da6efbb49e2b89409147ca23e08c536d6da482cb7160d14e31b3d08a6c4b15bbbcae2e308372320c67ea4d38a0ba3365591cb49397c96da47a638a64b69b7a4dd57238efe95a56b6ef1bac85d4c672ce8de9dea64b3557064914c672428e7f3a0653861b7fb0b99f63c818631c9c77a92cadd2727cb3b06ec8edcf4cd2a4b126d48a32777de27ad5ab486c05ab493c844bce5013c7a552132b5e4525b32a336fec0e2aac85a2e1f209209cf18ab56c66bc2624255fef287e9eb52b6e67f2ae426f8c60baf3be9d985ca570554c3bae8056fbd1a72507b9f5ad516565770eff319117e6073543ece58c9722287cb4e0a93cfd71576dc5a4913094955e88a0e377a5348372a5c4f0dcdd45044bf203cb63b7ad695cba595b4515b93339180b9fd6aa4d622e2466446851109cff7f14db788d94c2590b31555601b80dd8d35d81ea4986fb28f333bb76707920f7a92da099926780aa08c9c330c6e1fe71561678ae6539dbe681c9cf1f8566cf70d7edcb322449fbc19201a5ca2b0d676bab08d1e65f2801e7391cd54966b77774895fca206d39e7f2fc2b45f4f78ac557cd00329668d53d067ad563b5ad522f23e52e0e5179029c9263ea25c595c2c16cd307d8ab80714cba7592211dc2856c011aa0c6d5e783fa56a4d1cb2e99e7c6cde5e3250b676e0ff00f5aab3dd431dacb0ed17134a38908c00d8fcf140c7e962ddad27222f32638553d38c5375296558bcbf2951a12877a1c9ce3a54123c765045f63ba924320fdf9db8c1c76aadba64990e18990e016e473dea80d5bbb584cf13df2b45e728e48e981cd51834f7ba1220602377ca39feed696acf613dc2a4cf299b673839c70302a1d2f65b9f2d8b0690962d9e88071fe7de95b50b697329d8c37984218ab039038c0e3fa55db08268cc77db6266977058dfb91deab4d3b4a550c24e64c46a473b7faf353fcd15e2c3106f978031927d6902b316f2491f5071721620ee37aa0ce140ed4c65f2ac8b440fd99e5da49237377e69d77ba7b9563feb6518283aad549372aed01802df749e87e940752d457891c263b70c2670048dede80553943a46cce0870c7218743525c42b148a541cae1b23ae6ad2ea2f6b1ca8d124aeef92cfd471ff00d6a6f5195ad6dc3c4d23b150aa15597ae4d47718dfb2324a29c64f534f11b499d87600a095cf5ee2af4fa743fd8c2f22983cb91be23d4678c0f7a87dc3633a09d6193749179b1a9fb9f4a7ceb0cd23c908288df363d074a8f016300e4ee03b74ee6af5a4d6aba6cd0cc8a242c4a3773e82a80866b8792d2dadc305543b87a93ef51dc3c2d122c306d900f99b39de69ab1ef5ea03019269f141e73a44084241dcc4f02900a18476ff002310cc7a7bd36d944d3626976a93f31f4eb4f2889308f21954e32bcd2b04573807d0d1d464f736d6f1b249693095188521bb35572a41652a739a06e65daa76a97ddb71fc4055cb99ccf2eff29546cc301dff00ce69481158a9c70b8a638d832413ef9e9521c0c60f279a6b3ee05589c633ff00d6a5605e63597e51bba9eb4e5ca92d8e7e94632a3703c8a42bb1391c819e3bd0c07166552d8cf6c7619a012c0800609fd4526d562067af4a710aa7e53dfafa520232b90030e7be28fbdc11c53c82b19e783ef4444a5c4521406307254f1bbda802394b293f2f38ce31eb4d49032ae3961d4135a17f711de491b450f9384c383ed542240b22b601c8e94580541f2c80a9623b8fe1a520841d483c53914a33b0206eec29d9010f4ce79a02c44c0f201e734aa194705b0dd453e3dacec246da7f878eb4c2a4e1492327934008148edd3ad4abb8a9ce0114ec6e3f3633df1de94aa0c739cf5cf14022339f2c4679c1ce4f5a6003a63383dea507208078c75a06d054329c1e481d6900d4c248ae1727d0f4a18fcaab8e493562ecdb3244d685c71f306ec6a151be3270778e7819a761dc586da49e3628a4a270d93eb511566728bce054b1abaa19031284f214fdea4750a49c60e718a36109b495c0e87f3a6a11bc8207a5485486079db42a217c91c11c9a03a8d187f94f1cf534d74c11eb4f08493d80e413de8893cd5f332460e2905d0cda49e739ea295f20e0818a5cf5c76e0d2b0c85e724f5f6a3d47718f1b019c103ad2c6aac4b367a74a76d214f39e3bd3d559808e34cb376f7a04351c853c743d0f43470dcfa7a54823200078e3a77a4906d202e08c50088581c818c8a500138c548a33186278f4a648a54719e9de800eadf32e40ec29772eefbb8f6341041c2fcc48048ef4bb4e013cf1ce68b05c6b825071ce691a3da369e3d694212c7af1f8d39c0c063963f5a004d81546d3d7f4a5da587a679fad28230bcf152123392bcfa6280b908d9f271f3679c9a5c1280a9f614ae0b118c75a4e80a827ad1b008aaa1486273d067b530e4953b88f9b15390426e2474c9068401ba8a02e0f1008fdb1c8a8c2e2450c06dc548c46483fad12e331ec39e29810b0e76825bdfa548801421bf2f4a6a8d92807a7734fd84127b67ad017d47065c8e33ea29a7fd59e7e6f41dc507f77315dbd077a7ba90c00eb9ce698862b0902f1b7919f6a7387dd8c93cf3cd3a353bd94f6e734e0a0b6e27a0c75a2e02c00e240c7e6e98f5a6ee3ca9ce475f6a639ee78c7434f88e59983124f534ec03a44593000dbc673418f03006463f3a519dc013d452a9656e738e783d0d30b8c407a0e87834e8bcc5908ce71f9d38e08cb0f97d7d28e0313b49c9eb4089b01be43c034f65ce55b95f5a88361c7cdf2e38cd2b6e2ac471df8e68131e8cc8a101dc0763dc5426411cc0c609888e41ed53c6f941900907208a48d0b163b467a835560242aace855b6e7919a458cc619bd4f2299bd48da79c71c76352f2cb83c8c7e34ec2d6e4680c73edcfca464668950348432f2bdfd454ab0858c2336ec72a4f51515ebb88b217e7c633eb40cae90792eef13e6263cafa1a56308da4128d91934cb49252850027350dcc53381201f3742a7bd20348e083b8e0e7047634c8700ed3f2ff002aaf1de21b75562777bd3d24470594e0a9e71da8b858b0b2618ae0823b5590e1863a7b0aaaeeb9565c1c8e6a6420f2a72c3a534c4d0c90235c2b7231dc1a5916391f60cab0e41c53930d9322f39ed4064321551f30e99ef54161811a061b8f07ad25d34919055720f5f7153332cf111f3211d8d34a9d9b33b852db6029b5b3f985d5d8293900d48d1305ce334e8cbab14218fb8a90c82260189c1ef8a0640a885b00f3e948623148467e53d0fad231c4de99e8c054cd10740598e7d68b0af6235dc878009f4a74a57009fbdee29f245b829cf23a1aac55d9b6b1c1cf5a010fe38de319f4a468773fce0103a1ab11303104703238cd32546c71914d20bea57fb3e17850050bb971fdd3d47a54e58f90149fa9c540a08f95ce476614ac90d920ca1cafccb9e47a549e76f5c3af4ec6ab10c99193827834fd99c166cd0209e748c2ed3c1edda95643b738ea38e7350bc4b9190c475e690c4ee4346c723b1a01be84ce118066e33d69046147eef814c01f61591413eb4b1caa8e179c7ae68025500af4c1cf3513018e3f3a73ce992a698258f61f9f81db3cd2f4029892e119895c81d0d4524e5d46f4557079abbb801e9c542628e573b977351706caf05c0236b1c303c1a779aab2ed61c11d4d25c5a146dd1a903d29614690fef474a02c0e5301fa0f43416f3063b0ee69ce30d82b814cc1db90314868b90d833fcc4055da41cfb8a8ed34bb6b29434b38761ced1d29fe74f22f99286111cae076aa777e64419b3fbb046587e58ae1575a222f27bb2fcb79a794c188c84fa9a64baaaa18d56d031edc74c7ad50b6004a777de3d80e829a64682e7cc3c963bb155af727916e49ff00090dccae047044ac4fcc71d2ad417f25c125a40ceaa7e51fa5517d2d8ddc814858b1e603f88e3f5a9adf4c963ba595771278f418a6d27a16acd68496f7f72f26eb87c73f2a47d456bce1e0b98102195c8323bbf1b0761f5aad6369059dd492c92296e481d47d734dbeb932b88d79576f99c77a5cb1e857339058ced3dc3b36154b9524f7f4a95a77b59de348f6e7ef27627071f5eb559d658eda18785072d81c7b0a95159ad627572fcb6e63db9007f5a89249dcad16e363918b1bab872f211820f41ec05355a79b12b66385492c09e5b14fb6bc595a4cc41950e0861ce738cd24d736de5bb33120020ed39ebc7f5a7ca64f57a9545e62f23f2a3126f0a54f7adf52f1c26494166007cbd7158f035ada8f33cb3955f978c900d595dda8acac124555dab86e86b5b28f4294ac4f35cf936cf72b0f9b23f424703fc298823bad3ae1e7f2f747b64cf5033c1a7ac62dd021b855e08209e1bf0aaf752016e6de0440b38e5c0ec0e6936997a3d8ad0cab693c71c318676382c1fd7d68255de40d6e84a31f980ddf5ab09692476be6b2abcdd100e993fcea186daf639bc9f2760237b386cfe154dc45657d4ae279155c6e04b602fa01ce6a29d7c83248b96127caa0ff000f1c9ad236824bc8e3f29fca0c4b3e383806a6364f1abba286723214d3725707b19f6e679cc25e30c89c82c3a8fad696a7750aa24322b9b7907cec8791ed556c2e0c6651365b3f32f1c0a86468ee5511a6f95642ccaa7aff00934ee25ab2f5d5ba45108ed25c075df19feed67c9617ff00646532c8720657ad3e495a5b54f2102c437216cf3f5350d9dd4ad711c11cd2000e339ce28dca56b909765f94860704306153e9f702dae14105d5c7cc7d0e78a9aeee9ee728cb13b03f23a0c1fc6a92c9246e00e0b64e719c7a552d41b369df4f914abbf952ae49c8c1ff003c5538208ef2132acaa3392abdf8ee6abc56c86562cdbe42b8e79c9ef562d64b6b2d4638e751b645655e38ea3fc29ab084378f7d3f96d2843d0848f1922a2448e1859cb6416fdd86fe238a91a05459fcd91e2dadb540ee3ebf8d556ba513acc42f0bb546784149b6d80d660fb976ed12302cdd80ef530b56c89a3cbac4e3682b804d312d65ba97cb1fc4c4b1f415a71b5c6c310286076032bfc23bff002ab480759cb76d2c4d2c6a776e3b4f1daad5e5a4f7b6de76e03209c63ae3a0a82e5e14d4209a4622355620e7824f03fad3ede58cab3bcb3796a4b019eb9ff0cd68ed625dcad636a200ae46e999f3bfa8551cf4a864be8649c5a6cdf6e580e7839f5fd6a4b3d403ddbc10cceaacd925876a8a68bed5792cf0133792c154e303ee8cfd79a9ecc1f99a3240d6ceab3c8059900039cb1cf5cfe95466bc4b59e35b6526343f79b9cafb54d3bc735ac70cb24925cbb80c3a6063903f9564dd4f29ba94cc36ba928ab8c61474fc28ea1a12e9f7ad1fda228977861c127a139ff1a7497c6206ddad615c28d8739c7a9fa9aab0b34113a1e3790dd3fad58b7d3ae2f43bc68bb3a963d28d4ae9a94114e7ca5242b1ebe9567ed3288507023462403ce2a46b478dd8b2f4423776fc2ab6d2eacbb776de71e8295c3413cc8d254976ee392493df8ad0d3924264bdf985b22105f19e7d00aa92a4416e1c312c02855edcd5f867b9d353ece844b6ab862cabc64f247d29a0644b0dd5ecc9233abb4281db0dd01c7f855bd4ed92c2f9ae22976b10767b37a54c7ecb0bc777247b2191c8cc7c6e07a55260ba9caeb1a18edd09dacddc9a1a68488ace490cf35da6e96ea3194c0ce73c1fcb35099ccb35c33c61a4948d87fba73cfe3d29f1492d8192184a03b892e39cd42a8371ea4e719152da650d9a330caf1960fb4e091d0d59bab68619d7cb74994c459f69c6d3501c11818c7707bd23a136a67380a0edc7aff9cd003eda082549269d88218a2e3a9200c55f491defd24468888e3215c8da013fe18aced3a27959b1b49542793c1a6dbaa99d44ae5222c416c7407a9a774248b9736ee96d66f75b5848cc542f7181c9fceb34ee644768fa29040f63d6aeddf1394494ceb10f958f4e9d052966b982381205f39d81debd7033c52f41d8ae5f744474627181572e22b88f4e8cfd982190ee59073c7a530192c6292dda353e67f138e4535e791a086032164030067eef146e046ed2bb296037f4e829cf6f246ceaf8ce7ad34161e62b296c73815246f34a9e53ef62b9607b018c9a41b8a909dc373000679f5352a26e5f9880082724f6aaf1300e413b411c54bc942c38cf1d286302bbb6938017a9cd44ca855c0719278a780ac083c638a1a353185c007d6a4088a9551f36ee3e620d4d90e83200229046bbb76ec2e78f7fad30ab47911fccc477ef4dea03b6285c8f5ce7d4d231c39240cf4cd3d429e1b77cbcfd4d2e361e41e4679a3a80806e00753dfb50321891da8421907f7b3c822a560bcede39c50d0112725bcc53c8f947ad44148000fbc6a6240195c861d71eb4aa39271c74e697a011b21dc77e0739eb4aab9f971cf4e3bd298c105b764e064629c5f61c8e31d334806b02146e1c67f3a5d841cb1c7b50fb9998b7af3ed4830abc8e71c9a6022805fef139fd69c4804939da4f534e42a318e09f5a198962768e08dabdbf1fd68f515fa8c4640181e0e78f7a57912411f96304afccdea69db1deddd86140a3ec8cf0c8e9b76a72403cd1a21919c821546413cfbd3ecde48a40c3685279dc338151c2fb9c2e4f4ce4d4a806d2012077cf7a1e8c0545cb304601589e4544034424463bb77426a78a2f36610c670cdd3b5472677fcdc153b4f3481d88c06c649c8ee29ca018c81d3a1c518f98f1da9631c30ce0531db513206154ee51c73eb4105770e07b54b16c2c524054004a91dcd3142e723ae79148422fddce0609eb4d2015f4c73cf7a7b10ca5460629a518b600cb63a7ad02102b632075f5a9231f3066fbca7236fad4eef1c96ca16328ea7049ee2a0e430c0a1a631fc162c7393ea7351b1e07eb526d3bb681d79a89baed1f78763de8ea31db0671dbd683928095efc1a7290c8762118eb9a7270016038edeb40880643e7d31d29ccbb464924e3a9a5232c700706918b3e3b81e9400a1f8e78e293ef9ce70a78a7150db700e1874a6ec118ce783d39e943013215b81d0f5a9fcb2cbb8b7d2a2d8483f4a7a64020138e9cd0046e0a9e3b76a5c2f46386a5d993927a9e6964428c47a1a2c3b04872303b77a8d0f217df834f53953b7ad3a24510e5fef7f2a006321524e73eb9eb4df2c05dfce2a5c1c337afeb4d2c19307bd310ae0088363711d39a227023c0eadc804d2a018209ed4c53e5b29e3079c7a5016b0a597ce660383dbde9d9676c8a6bf2d91d08cf14f8b76d6e98edda8b00830fbb68c30fd69195c9248c669c47cdb88c6474142ee9570011838e698873a29dab91eb4d54081805ebcd349c390467f4cd49331560ea72a460fbd002aaef9b71fbbd88ea0d48a0b13cfd4d3846046241f74afe54c7668c138c9c530d0715dc3f0e948d88c293c03c119e868401a3c024679a615dec4e7231c83de811233e7e564c29e84528dca985392381da984334791c01447e6e0bb0e4f71d0d30b9201bd1867696ea7d3dea78958280fc9ef8ef516d2c324633d69e9be38caf503a1a603028326e079e87dea756dca081cf7c535530723a9a54da1c876db9a04c8e2b9591dbba83d7d0fbd3a49165c07047bfa5042c5b988e3a122906ccaba1df19ea3d29a0b9198cc7326c6f94f50454b28df0ef5f5c9c546ee0baed3f2e7193560461930bc6ea3a81993da79a3cd19e7d3b536d5bcb94c73139c60363b7bd6a00624d873f8d2451980bef01908cd2907423f21521ec476f71442a9181f31f6cd3c0dab8500a8ec282825e47047eb4012a039c7af4f7a691f30cae1c74cd465d8260927dc53d272ff002372c3b9aab8ac48d200c03707d71d69084dcccab9fa53b00fcb22fe751221494af4cf3f5a034188e1c12a3241fc45484895718e47506a09502b927e507de9d16dda3649f31e9cf5a07e63bca49061b019452a911b70c194f514d04f99cf0feb4d54f2c976c7f8d3112b918dc8db94d5501b7b22b654f233d8d4c1d55b0c30a7bfa53dd0293b4139ec28dc2e5745db26e3904f507bd4bb8fcc18fcbd41a87ce0a46f1f29e84d3f3d0a8c03d41a2c1a8edf907078359f2c8eac40047bf515a11a855e475a630264e47e3498233e7b87f2fa62a5b69d648cab70c3f5a9a5815813b700f6a896de38b6961c7d690cb03031b495c53db270578feb51636a61739edcd0a58ae0f27bf34c5611e46076edce4f51414c1c32f5ef4b903270011de8f99d492d40ba90f920f5e7bd44f02b64038ef8a74aeca72ab920d35079855b254d161dc45418d84938e39a9217682425070682db0800739e69acc37608fc295b401c666f986de33c66a11b95b2ad9f6ee29fc7707dc1a45e09e051b0c8e52c4824703b526f0c0639151cc1f3b95f81da86459142fdd279e3bd20b96c17ba0448402a414527d2ac2bc62511f97bb7360e4704d56694b22b02bb89ea69be6f97705f048ddf91af3db7725ab6e4b713e2e8a044541919c722a09e72082b1af98bc83ea3b629f22f9b70d267823e61ed4c9617531900e70307d3934d3bd86a165a131944a91b8e0919fa52dd4fb6cc43236d62034841e42f5c7d4d02039120e50f61d17d7f5a6cb1c53ee6cfc8a4b313dcd5b95a4428b4dd88d59658c2bf0643955f451914e4255d5948dc13383d3a536de30d7124db1f76df94f6f61f953e4b674430ef264660cd81d3da975358e84b04d234f6ed22e786670c3a2f51fcaa09ae5ee231b176459dc00e324f353ce911590b4bb1a6db91e83b8fc6a3f32dc12ad1384271ff00eaa1f90f5655bf65811e342556508db81f5e6aac2e01001c956c8e6b56e56de554db1b0561b48271c5655d69e6ca557462f13af041fba7be6b58f98ad665a5bbe725b2e7a03dea557996d895ba662f82474f7c5646fc83b8f4ab6b2158d1fb9fbab9efea69b487a16a39a58210898deedb7cc63922af32b285f35f8c0dd9fa0ff0acb8219636cdd7c9f38e1baf5a9e694a300c594e3f88f53dcfeb472a0bea5917776d71be21b6255da10f435225e5ec96e10c7199b07e72fc7e559f34d2c71288d80524f19fe62adc2c12d165841000e87fbde94f953d40b716a93243b6e444081f7877a7dcdf6c8844cdb5ca9c107395aa36d3186f1a4b8837b32e5413c0350bed0dbdf24fd3f1a4a9a135a962e676982a44dc14258f4e82a95b58ca1dda59786604283d47bd695e6972dbd80bb9e5088c07eed7ae0d654931923dce76a2f0083cb7b51cb67a0234268ded74c10b4048766ddb3d0f3505b98a3b477915d1e5c2f046700e7ad4b6f7539b539973181b4823907a544e8ac9d4b311d334ec0858bcb7b98d2090ab93852e334f4dd697999230e0365863effb7d33515c411c6d1ff0345fccf38a92595ae11595d895277151fa7e755e82b05b90d231fbbbb2411db39a59e046895e49177af73ce0546db5ad7727461c127a914e86cbceb7cca72c40c807a7b5172b408eea19bcb8b6eef3a4084b72547ad598ec2d6d6f4a92187f08273807359b258dd405e7da4a0e98ed4d5924c1c0c919ddcf2c6a95ac4eecd24b95b2803b2fcd33718eca334ecb19185bc59423ccda0f4e9ffd7fceaac56b2ea28adfeac29e4e7b6052193c81e4db3b700e5cf1557604e88f70238a5f97cb72ec0b753e9f4141b974963c238c97c3b0ebfe7148a25cbb4cca8a31d0f249ad20ab796eb132e4ab12996c646052bb6067cd6eed78a60c6378f97fdee49ad00dbdd238d06eb793e72bc0ebce7ea2b39267b491e4980675000c3704f4cd327d65e52862544dc7257df8e4fe02a9261e85cb9d82efce9640922e5a255193823bd635ddc9b9b82fc093ee92463bd3d43cf7aa818ef91f1bd8e6a49ec7ec774639d958e371da3834906832c9925d5563b9cb46410c18f5e3f956adf4f76eab6f68336d290a1d7bff00f5ab19a0dd1c8e232541dc5bd3fce2b4b49b9f3615b650449bb3b89e00ed8a6b51d8ad3cb732bfd85b24c677363938f4aa92959246f28b468c318cf3f8d7456816c6fee5a389ee0ecdd2498fbbe82b1628e19732cbb915d599540eadd71482e552a5d0b842a31f373d48abcb750ae810c084f9c5cefe7b1ce6aa5b4334f15c3a460aa47f3863fcbdf8a921b69ed1a3bbf255e2cf4278f6a7a75025ba8c9b38150b988af191f99a8e58ee56186d15d96395b214f009fad68d9497ba8de9464530bf55038551daa2d42d2e37acca4b5bc45b629fe1ebfd734d88ab796c96d1c31b12acb19cb2f4724d450da998a344c115bd7a0f5ad5fb48b585527559a38b63c6c474cf1d3be39a7b430dedabdbdbed49376e894f07681c9fd715361dd98cc9b240525494938214d18f9107dedc73827ad37cb9ad1dd1a164743b8f1c1c559302b22cd31c0dc3722f5c739a4326d2ec8c934b33384894364fb8f4aab0471cb24a659563010b60f5352cd6b2fd9de7b65716cdd413d31d69a91c92908005f397706c64e29dc4995f798c7dc271d093d475ab31fda61ff4c52634538c8f7ab726996eb610dcfda4727e753df9e82ab2c43735bf9acde72aba0070ab9cd21a62cc65bcbe103b6f90e0213de9b770182eca920b74c0ab173a79b0f2a667df3b139d8785f4aa4ac5da3cb13953924ff16696e1b9617eca6dd8ef633be06076150a1db8c93b41a4853e774039278f6a95bee042bc67d69f51a11541666c80a4607b521f949e0f269fb71d72452b3202074cff003a910d2549e857b5003326e500e78a244f9793826ac4b219a38992244d9c614ff3a76d06d94cc788fe639c1e80f3526ccaf7f94d3e340d70d8c6dc703d294e36b3819a0060246493f4140f986ecf4cf18eb4ae7730d8bf2951bbb53cb050c9b410c473dc75a40302ed3c7cc71ce78a5233caae31d69f80b8fa734bd4f3d7b9268d4066d6c6ecf538146c2147a134f690ac6c76e40e4014d570ff0077246de33c5161887919ef4328638206df5a3185c919cd0cff002f439f6a42dc4da0b1dc4aae320d3029280367fda15331e793d7d69b9f94827e6c70450026e1939cf4c62ac3c6d147ca364ae467b8aabb99b04fde1ce6a796f27982ee7fba385029d8435b12001b8029084085d41f73ef5123c863da067272c7f1ab31c7fe8aee5d57071827ef1ff26863200dbf920640e323b52be7685c7e229602c18fca0a10063d2a575d8558e42f63eb4b60447b0a4f1862413d1f34d9a30acc8a4b13c923bd065dfb3193b8e147a53801bc21c97279f7146a0ec3511be8075c9a0f0a028c914d2b2e412383d0e3b548339f4c0e9498790c320230572dda9a8e380157d8d3b2642cc54e47538ab6ea63823858a32901b703ce0d3d00a68a1646ddc927a54bce370c8142c601e48eb904d2e76900ff001734580528153712393c834dc6ec6063341c1c83d284c31c8181d6900ac9b633d72463e949b31866527239269ec09dd9e9ee6999e9c9c7f2a0630b6dce0f53c9a7ee0e768e5b0334d6db8e339f5a319ce0ed3d68b085202fcac3a76a1001b89c8017231eb4f6e467209c7434c50ee0bbe3af228b00e56c9049f949a63a8dd8f7cd4a8909b7959988983fca074606a075008249200eb9e94ec03c290369cf1dfd69391865e0669e8e0f04ee07bd3804fe2eff00a52191e016208e0f348ca43a9ddc71d0d4e0215c839cfad46f0e4264f0083d68106c0bf77238ea698fbb77ca0918ec69cedc91fc3fce9a597780a723d69a0240a090fbb83fa542f11233ea7a66a47240f94e4521e0f0738e79ed40586b2947504e72334f401be520600ea69b8058e4fcdd73523a2940402a3078a0068c6318e7f9d34b32918e87af14e89cacb8dbc1a73a6092780464500355d7773c29ebcf4a5c143c1e0d0a80aab0039e0d39b1e59c0c367bd317523603cdcf39cf7a91c67e5c63238a69ce338edc52330288e783df9e940c912760eaac3e51d69c595e4c13803a1a8b6e1b77507ad4a002303a7de14ee492796072a383da91102923a93eb490c803903a8a70cb9dca0020f4a6018f94ae78f634aa728aa4f1d8d3594ab6e20fcdc8f7a702b19e79cf268402abb4390ff3281f8d48a46d6ee3d0d412c853ee9c8238269d195605780472314c07be7e464ce3bf3daa3901941de36b0efda9f2168943467bf19fe54f8f13c2770da7f880e39a6208d774463273918209a6429e5c862ea01efd69e8988c6de71dfd29b28f9959436f07922802611a39319c2e7a1f53fd2ab6f688ecc1201fcaad01bcee0783d8fad1b55880df2e7a91fce980e122b0218707d6a22c555806ca9e9ed4d562cb22b0c953d6920c60e7a8f5e868b81203b62dc7ae3ad3540953393ea0f7a7ca53180a4293d0f6a6245b3011be53d413d2900aae00546e4f4a1a1f989ebdfdc525c4719da0643ff3a58db2412dc81cd301e59885218161c60f7a71949f95939ec69928dcc1860127afad3810176b83c77a1008a0b4451b0c0fad411daac6c4a0037751da9e54c459c92633d31da9e93ac81593048ea0f7a77115dd587cac4ee1ca1f4a512b30656e3239c8cd4b33293fbb2030ea1a98c36a07543ee3d281880031f04107b52249c9407803a1a746432e4800faf634d9015605537714842c91fc81baf73ef519c80197953daa5f37690bb48cfaf351cbc8da14a83dc718a60b7062eab98cf1dc1a40e5bef0c73d451c1408c7e87352fca1036e183d4d21b646e095c0381de985f7284619fc6a4c7cd82178e7eb55e4421f726541e7da9a0b8fc80318c63d298e029ca360fd69c8498ca9e79e0d4655fd338e79a4d01279824520f4f51dea39255503278142a80386eb4d9914f1904f7a2e08563be3cae777ad080e7eef3ddaa38632382c38e9ef52a160483827a0a02c31c0c7a13ef51a92a7e63963daa7623073dbd6abcea42e57d39a1b42b0d72f8257a9a642ee570e72d9c52a993693c03d852600c9ef9f5a91ee1b087e49a4287279e29fe61c1e49f5a405a42495e3b60d007fffd9);
INSERT INTO `login` (`jmeno`, `heslo`, `prijmeni`, `krestni`, `skupina`, `ulice`, `cp`, `psc`, `mesto`, `stat`, `telefon`, `mail`, `datum_narozeni`, `jazyky`, `ridicak`, `pohlavi`, `datum_pohovoru`, `datum_nastupu`, `datum_poslani`, `datum_konce`, `pracuje`, `vzdelani`, `vztah`, `zivotopisy`, `posledni_prihlaseni`, `foto`) VALUES 
('selecka', 'tsqm', 'Selecka', 'Martina', 'user', '', '', '', 'Brno/Znojmo', 'Tschechische Republik', '723120297', 'MartinaSelecka@seznam.cz', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', '', '', '', '', ''),
('zitkova', 'tsqm', 'Zitkova', 'Martina', 'user', 'Palackeho ', '1200/11', '669 02', 'Znojmo', 'Tschechische Republik', '724158749', 'martina.zitkova@centrum.cz', '16.4.1986', 'Tschechisch,Deutsch,Englisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Termin stattgefunden', '', ''),
('blahoudkova', 'tsqm', 'Blahoudkova', 'Sarka', 'user', '', '', '', 'Moravske Budejovice', 'Tschechische Republik', '777992853', 'sarinka-b@seznam.cz', '', '', 'Ja', 'Frau', '', '', '', '', 'Ja', '', '', '', '', ''),
('polakova', 'tsqm', 'Pollakova', 'Lenka', 'user', '', '', '', 'Vranov nad Dyji', 'Tschechische Republik', '720407204', 'Lenik.s.r.o@seznam.cz', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', '', '', '', '', ''),
('smejkalova', 'tsqm', 'Smejkalova', 'Eliska', 'user', '', '', '', '', 'Tschechische Republik', '724280618', 'eliska.smejkalova@centrum.cz', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', '', '', '', '06.03.2008-14:16', ''),
('pospichalova', 'tsqm', 'Pospichalova', 'Tereza', 'user', '', '5', '67151', 'Blizkovice', 'Tschechische Republik', '728457926', 'terka.posp@seznam.cz', '2.3.1988', 'Tschechisch,Deutsch,Englisch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Termin stattgefunden', '', ''),
('kasalovazuzana', 'tsqm', 'Kasalova', 'Zuzana', 'user', '', '', '', 'Blizkovice', 'Tschechische Republik', '775204197', 'kasalova4@seznam.cz', '', '', 'Nein', 'weiblich', '', '', '', '', 'Nein', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '', ''),
('masejova', 'tsqm', 'Masejova', 'Marcela', 'user', '', '', '', 'Kucharovice', 'Tschechische Republik', '721334338', 'Marse.Masejova@seznam.cz', '19.12.1989', 'Tschechisch, Deutsch, Englisch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '', ''),
('holeckova', 'tsqm', 'Holeckova', 'Veronika', 'user', '', '', '', '', 'Tschechische Republik', '605765579', 'Verca.Holeckova@seznam.cz', '', '', 'Ja', 'Frau', '', '', '', '', 'Ja', '', '', '', '06.03.2008-13:53', ''),
('zerzankova', 'tsqm', 'Zerzankova', 'Aneta', 'user', '', '33', '67525', 'Rokytnice nad Rokytnou', 'Tschechische Republik', '602843362', 'anetzer@seznam.cz', '27.8.1990', 'Tschechisch,Deutsch,Englisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '06.03.2008-14:08', ''),
('schmuttermeierova', 'tsqm', 'Schmutteremeierova', 'Karolina', 'user', 'Tasovice', '76', '67125', 'Znojmo', 'Tschechische Republik', '724918797', 'kajka.schm@seznam.cz', '22.12.1988', 'Tschechisch,Englisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '', ''),
('babikova', 'tsqm', 'Babikova', 'Katerina', 'user', '', '', '', 'Hodonice', 'Tschechische Republik', '739227801', 'babikovakatka@seznam.cz', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', '', '', '', '', ''),
('sladkova', 'tsqm', 'Sladkova', 'Michaela', 'user', '', '', '', 'Hodonice', 'Tschechische Republik', '728712672', 'MichaelaSladkova@seznam.cz', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '06.03.2008-14:03', ''),
('sykorova', 'tsqm', 'Sykorova', 'Katerina', 'user', '', '', '', 'Znojmo', 'Tschechische Republik', '737956695', 'katerinka.sykorova@centrum.cz', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', '', '', '', '', ''),
('florianova', 'tsqm', 'Florianova', 'Alena', 'user', '', '', '', 'Znojmo', 'Tschechische Republik', '773137704', 'alena.florianova@atlas.cz', '', 'Tschechisch,Deutsch,Englisch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Termin stattgefunden', '', ''),
('pechova', 'tsqm', 'Pechova', 'Sabina', 'user', '', '', '', '', 'Tschechische Republik', '', 'sabuskaa@centrum.cz', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', '', '', '', '', ''),
('brakora', 'tsqm', 'Brakora', 'Marek', 'user', '', '', '', 'Bozice', 'Tschechische Republik', '736151292', 'brakoramarek@centrum.cz', '', 'Tschechisch,Deutsch,Englisch,Spanisch,Franzözisch', 'Nein', 'Frau', '', '', '', '', 'Ja', '', '', '', '', ''),
('rihova', 'tsqm', 'Rihova', 'Silvie', 'user', '-', '285', '69121', 'Sedlec u Mikulova', 'Tschechische Republik', '721006028', 'rihovaSilvie@seznam.cz', '9.11.1989', 'Tschechisch,Deutsch,Englisch,Franzözisch', 'Nein', 'Frau', '', '', '', '', 'Ja', '', '', '', '', ''),
('benesova', 'tsqm', 'Benesova', 'Kristyna', 'su', 'Slovenska', '25', '66902', 'Znojmo', 'Tschechische Republik', '775256180', 'kikibenesova@centrum.cz', '28.12.1990', 'Tschechisch,Deutsch,Englisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '26.06.2008-12:52', ''),
('stavikova', 'tsqm', 'Stavikova', 'Svatava', 'user', 'Rudoleckeho', '10', '66902', 'Znojmo', 'Tschechische Republik', '724302354', 'stavikova.Svatava@seznam.cz', '7.5.1990', 'Tschechisch,Deutsch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '06.03.2008-13:59', ''),
('kratochvilova', 'tsqm', 'Kratochvilova', 'Pavla', 'user', '', '', '66902', 'Znojmo', 'Tschechische Republik', '', 'papule.k@centrum.cz', '4.2.1990', 'Tschechisch,Deutsch, Englisch', 'Nein', 'weiblich', '', '', '', '', 'Nein', 'Pflichtschule', 'Kunden', 'Termin stattgefunden', '', ''),
('walova', 'tsqm', 'Walova', 'Zuzana', 'user', 'Spojencu ', '973', '67401', 'Trebic', 'Tschechische Republik', '602833142', 'Susan89@seznam.cz', '6.1.1989', 'Tschechisch,Deutsch, Englisch', 'Ja', 'weiblich', '', '', '', '', 'Nein', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '06.03.2008-14:02', ''),
('kachynova', 'tsqm', 'Kachynova', 'Katerina', 'user', '', '', '', 'Breclav', 'Tschechische Republik', '', '', '3.8.1989', 'Tschechisch,Deutsch,Englisch', 'Nein', 'weiblich', '', '', '', '', 'Nein', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '06.03.2008-13:57', ''),
('juhanakova', 'tsqm', 'Juhanakova', 'Eva', 'user', 'Nova', '638', '67128', 'Jaroslavice', '', '721309662', 'benji90@seznam.cz', '8.2.1990', 'Tschechisch,Deutsch, Englisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '', ''),
('bednarova', 'tsqm', 'Bednarova', 'Tereza', 'user', 'K Vilkam 810', '810/III', '37701', 'Jindrichuv Hradec', 'Tschechische Republik', '722801894', 'tbednarova@seznam.cz', '25.6.1991', 'Tschechisch, Deutsch, Englisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '06.03.2008-13:51', ''),
('forman', 'tsqm', 'Forman', 'Zdenek', 'su', '', '', '', '', 'Tschechische Republik', '', '', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', '', '', '', '20.03.2008-12:43', ''),
('svabova', 'tsqm', 'Svabova', 'Putzfrau', 'user', '', '', '', '', 'Tschechische Republik', '', '', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', '', '', '', '', ''),
('selingerova', 'tsqm', 'Selingerova', 'Eva', 'user', 'Dyje', '3', '66902', 'Znojmo', 'Tschechische Republik', '775651103', 'frankie.xxx@seznam.cz', '2.3.1991', 'Tschechisch,Deutsch, Englisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '06.03.2008-13:58', ''),
('dokulilova', 'tsqm', 'Dokulilova', 'Vlasta', 'user', 'Bartosova', '32', '67401', 'Trebic', 'Tschechische Republik', '732175010', 'vlastulik.19@seznam.cz', '9.1.1990', 'Tschechisch,Deutsch,Englisch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '', ''),
('sofkova', 'tsqm', 'Sofkova', 'Gabriela', 'user', 'Lidicka', '5', '66902', 'Znojmo', 'Tschechische Republik', '776679010', '207090@mail.muni.cz', '24.6.1987', 'Tschechisch, Deutsch, ', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Termin stattgefunden', '', ''),
('karalupova', 'tsqm', 'Karalupova', 'Jana', 'user', '', '', '', 'Blizkovice', 'Tschechische Republik', '604940319', '', '29.9.1987', 'Tschechisch, Deutsch, Englisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Termin stattgefunden', '06.03.2008-13:27', ''),
('novotna', 'tsqm', 'Novotna', 'Aneta', 'user', 'Vojtecha Prochazky', '3', '68201', 'Vyskov', 'Tschechische Republik', '605755031', 'milacekanet@seznam.cz', '19.4.1990', 'Tschechisch, Deutsch, Englisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '06.03.2008-14:04', ''),
('slaba', 'tsqm', 'Slaba', 'Kamila', 'user', 'Policka', '1111', '67531', 'Jemnice', 'Tschechische Republik', '721675721', 'kamca.kam@seznam.cz', '19.6.1990', 'Tschechisch,Deutsch,Englisch,Spanisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '06.03.2008-14:12', ''),
('durda', 'tsqm', 'Durda', 'Ondrej', 'user', '', '', '', '', 'Tschechische Republik', '', '', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', '', '', '', '', ''),
('smejkalovasvetlana', 'tsqm', 'Smejkalova', 'Svetlana', 'user', '', '', '', '', 'Tschechische Republik', '', '', '', '', 'Nein', 'weiblich', '', '', '', '', 'Nein', 'Pflichtschule', 'Kunden', 'Termin stattgefunden', '', ''),
('jurankova', 'tsqm', 'Jurankova', 'Zaneta', 'user', '', '', '', 'Plenkovice', 'Tschechische Republik', '736615855', 'Jurankovazaneta@seznam.cz', '6.10.1991', 'Tschechisch,Deutsch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('bilova', 'tsqm', 'Bilova', 'Martina', 'user', 'Stitary', '185', '67102', 'Sumna', 'Tschechische Republik', '721182384', 'M.Bilova@seznam.cz', '24.11.1991 ', 'Tschechisch, Deutsch, Englisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '', ''),
('kopecka', 'tsqm', 'Kopecka', 'Pavla', 'user', '', '', '', '', 'Tschechische Republik', '', '', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', '', '', '', '', ''),
('klincova', 'tsqm', 'Klincova', 'Radka', 'user', 'Vetrna', '10566', '67531', 'Jemnice', 'Tschechische Republik', '774146606', 'klincova.radka@centrum.cz', '13.9.1989', 'Tschechisch,Deutsch,Englisch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '', ''),
('fialova', 'tsqm', 'Fialova', 'Zuzana', 'user', 'Bezrucova ', '2', '67401', 'Trebic', 'Tschechische Republik', '732866466', 'zuzfi@seznam.cz', '6.12.1990', 'Tschechisch,Deutsch,Englisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '', ''),
('michkova', 'tsqm', 'Michkova', 'Marketa', 'user', 'Na Kopci', '18', '58601', 'Jhlava', 'Tschechische Republik', '605831855', '180841@mail.muni.cz', '23.6.1986', 'Tschechisch,Deutsch, Englisch, Grundkenntnise von ', 'Nein', 'Frau', '', '', '', '', 'Ja', '', '', '', '', ''),
('schneiderova', 'tsqm', 'Schneiderova', 'Erika', 'user', '-', '528', '66904', 'Primetice', 'Tschechische Republik', '603512620', '', '6.4.1981', 'Tschechisch,Deutsch,Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('milerova', 'tsqm', 'Milerova', 'Katerina', 'user', '-', '563', '66902', 'Primetice', 'Tschechische Republik', '', '', '29.8.1989', 'Tschechisch,Deutsch,Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('herout', 'tsqm', 'Herout', 'Radim', 'user', 'Svobody', '91', '28571', 'Dolni Bucice', 'Tschechische Republik', '775682926', 'radim.herout@tiscali.cz', '12.7.1983', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Mann', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('podzemska', 'tsqm', 'Podzemska', 'Monika', 'user', 'Palliardiho', '51', '66902', 'Znojmo', 'Tschechische Republik', '737452725', 'ChickenGirl@seznam.cz', '17.11.1989', 'Tschechisch,Deutsch,Englisch,Franzözisch', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('vanickova', 'tsqm', 'Vanickova', 'Lucie', 'user', 'Babice', '51', '67544', 'Lesonice', 'Tschechische Republik', '728350696', 'luckav@centrum.cz', '20.4.1987', 'Tschechisch, Deutsch, Englisch, Russisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Mittlereschule, Fachschule', '', '', '', ''),
('mikulkova', 'tsqm', 'Mikulkova', 'Radka', 'user', 'Novodvorska', '1075', '67401', 'Trebic', 'Tschechische Republik', '724845356', 'xRadusch@seznam.cz', '26.11.1988', 'Tschechisch,Deutsch,Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('vesela', 'tsqm', 'Vesela', 'Martina', 'user', '', '228', '67181', 'Znojmo- Novy Saldorf', 'Tschechische Republik', '775110296', '', '11.2.1986', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('lendlerova', 'tsqm', 'Lendlerova', 'Lucie', 'user', '28. rijna', '24', '66902', 'Znojmo', 'Tschechische Republik', '774567082', 'lucyienka@seznam.cz', '', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '04.03.2008-22:51', ''),
('antosovska', 'tsqm', 'Antosovska', 'Alice', 'user', '', '', '', '', 'Tschechische Republik', '777277318', 'alishka@seznam.cz', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('fucikova', 'tsqm', 'Fucikova', 'Jaroslava', 'user', 'Coufalova', '14', '66902', 'Znojmo', 'Tschechische Republik', '739258124', '', '14.7.1990', '', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('kubaska', 'tsqm', 'Kubaska', 'Michala', 'user', 'Aninska', '1', '67181', 'Znojmo', 'Tschechische Republik', '607641826', 'KubaskaM@seznam.cz', '18.1.1988', 'Tschechisch,Deutsch,Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('certkova', 'tsqm', 'Certkova', 'Ludmila', 'user', 'U Brany', '4', '66902', 'Znojmo', 'Tschechische Republik', '604705867', '', '30.9.1990', 'Tschechisch,Deutsch,Englisch', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('feldova', 'tsqm', 'Feldova', 'Iva', 'user', 'Nezvalova', '1', '63800', 'Brno', 'Tschechische Republik', '737812398', 'ivafel@post.cz', '21.11.1979', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('jouklova', 'tsqm', 'Jouklova', 'Marketa', 'user', 'Prazska', '63K', '66902', 'Znojmo', 'Tschechische Republik', '728776555', '', '8.12.1989', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('svobodova', 'tsqm', 'Svobodova', 'Linda', 'user', 'Frani Kopecka', '18', '66902', 'Znojmo', 'Tschechische Republik', '732529411', 'sppb@seznam.cz', '29.3.1987', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('jelinkova', 'tsqm', 'Jelinkova', 'Lenka', 'user', 'Kucharovicka', '4', '66902', 'Znojmol', 'Tschechische Republik', '', '', '8.12.1988', 'Tschechisch,Deutsch,Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('novotnakaterina', 'tsqm', 'Novotna', 'Katerina', 'user', 'Erbenova', '11', '66902', 'Znojmo', 'Tschechische Republik', '731244177', '', '21.4.1992', 'Tschechisch, Deutsch, ', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('havelka', 'tsqm', 'Havelka', 'Jan', 'user', '', '539', '66902', 'Primetice', 'Tschechische Republik', '732289892', 'johnygavelk@centrum.cz', '', 'Tschechisch,Deutsch,Englisch', 'Ja', 'Mann', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('stetinova', 'tsqm', 'Stetinova', 'Jana', 'user', 'Rooseveltova', '41', '66902', 'Znojmo', 'Tschechische Republik', '605359233', '', '25.4.1990', '', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('mezerova', 'tsqm', 'Mezerova', 'Zuzana', 'user', 'Cejle', '156', '58851', 'Batelov', 'Tschechische Republik', '777891960', 'ZuzanaMezerova@seznam.cz', '12.2.1985', 'Tschechisch,Deutsch,Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('pelikanova', 'tsqm', 'Pelikanova', 'Irena', 'user', 'Masovice', '67', '66902', 'Znojmo', 'Tschechische Republik', '', '', '6.10.1990', '', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('kolmanova', 'tsqm', 'kolmanova', 'Dana', 'user', 'Kollarova', '20/378', '66902', 'Znojmo', 'Tschechische Republik', '776236976', 'hero@volny.cz', '26.10.1955', 'Tschechisch,Deutsch,Englisch,Russisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Mittlereschule, Fachschule', '', '', '', ''),
('kudrnova', 'tsqm', 'Kudrnova', 'Alena', 'user', 'Krepice', '28', '67140', 'Tavikovice', 'Tschechische Republik', '', 'slunicko.alka@seznam.cz', '30.9.1988', 'Tschechisch, Deutsch, Englisch, Latein', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('prchalova', 'tsqm', 'Prchalova', 'Marika', 'user', 'Rudeleckeho', '9', '66902', 'Znojmo', 'Tschechische Republik', '', '', '23.4.1987', 'Tschechisch,Deutsch,Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('pokornajitka', 'tsqm', 'Pokorna', 'Jitka', 'user', 'Prazska', '54', '66902', 'Znojmo', 'Tschechische Republik', '777971785', 'jitka.pokorna@gymzn.cz', '14.11.1991', 'Tschechisch, Deutsch, Englisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Kunden', 'Termin stattgefunden', '', ''),
('lukacova', 'tsqm', 'Lukacova', 'Veronika', 'user', '', '1201', '02601', 'Dolni Kubin', 'Tschechische Republik', '908664511', 'verluk@post.sk', '4.12.1981', 'Slowakisch,Deutsch,Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Mittlereschule, Fachschule', '', '', '', ''),
('pokornatereza', 'tsqm', 'Pokorna', 'Tereza', 'user', '', '', '', '', 'Tschechische Republik', '', '', '25.7.1990', 'Tschechisch, Deutsch, Englisch', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('prchalova', 'tsqm', 'Prchalova', 'Marika', 'user', 'Rudeleckeho', '9', '66902', 'Znojmo', 'Tschechische Republik', '', '', '23.4.1987', 'Tschechisch,Deutsch,Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('otypkova', 'tsqm', 'Otypkova', 'Petra', 'user', '', '70', '', 'Vrbovec', 'Tschechische Republik', '774377296', 'sweet.peta@centrum.cz', '10.12.1991', 'tschechisch, Englisch', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('nova', 'tsqm', 'Nova', 'Michaela', 'user', 'Prazska', '17', '66902', 'Znojmo', 'Tschechische Republik', '722606692', 'mispulka.blativa@seznam.cz', '13.8.1992', 'Tschechisch, Deutsch, ', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('kounkova', 'tsqm', 'Kounkova', 'Martina', 'user', 'Mlynska', '272', '69123', 'Pohorelice', 'Tschechische Republik', '776747417', 'martina.kounkova@seznam.cz', '26.8.1982', 'Tschechisch,Deutsch,Englisch,Russisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('kratka', 'tsqm', 'Kratka', 'Katerina', 'user', 'Zelenarska', '26/15', '66902', 'Znojmo', 'Tschechische Republik', '736657397', 'kratka.k@seznam.cz', '23.6.1991', 'Tschechisch, Deutsch, Englisch', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('dvorakova', 'tsqm', 'Dvorakova', 'Lenka', 'user', '', '345', '67131', 'Unanov', 'Tschechische Republik', '604219895', 'L.D.345@seznam.cz', '31.10.1987', 'Tschechisch,Deutsch,Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('sousedikova', 'tsqm', 'Sousedikova', 'Hana', 'user', 'Bolzanova', '17', '66902', 'Znojmo', 'Tschechische Republik', '735726526', 'HANULKA-happy@seznam.cz', '', 'Tschechisch, Deutsch, Englisch', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('otypka', 'tsqm', 'Otypka', 'Tomas', 'user', '', '70', '66902', 'Vrbovec', 'Tschechische Republik', '608983174', 'Helikoptera369@centrum.cz', '12.11.1992', '', 'Nein', 'Mann', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('budaiova', 'tsqm', 'Budaiova', 'Romana', 'user', 'Podmoli', '101', '66902', 'Znojmo', 'Tschechische Republik', '732466976', 'romana.budaiova@seznam.cz', '25.3.1991', '', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('bimova', 'tsqm', 'Bimova', 'Alice', 'user', 'Druzstevni', '379', '29441', 'Dobrovice', 'Tschechische Republik', '775609325', 'alicebimova@seznam.cz', '30.5.1985', '', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('subrt', 'tsqm', 'Subrt', 'Petr', 'user', 'Dr. Marese', '23', '66902', 'Znojmo', 'Tschechische Republik', '', 'petr.subrt@seznam.cz', '2.6.1982', 'Tschechisch, Deutsch, Englisch, Spanisch', 'Ja', 'Mann', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('vymola', 'tsqm', 'Vymola', 'Lukas', 'user', 'Lesni', '282', '66902', 'Suchohrdly, Znojmo', 'Tschechische Republik', '723852112', 'alicebimova@seznam.cz', '17.12.1987', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Mann', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('bilkova', 'tsqm', 'Bilkova', 'Klara', 'user', 'Novomestska', '3', '62100', 'Brno', 'Tschechische Republik', '608271122', 'prchalovak@seznam.cz', '21.5.1978', 'Tschechisch, Deutsch, Englisch, Spanisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('pytlik', 'tsqm', 'Pytlik', 'Petr', 'user', 'Strelecka', '568', '', 'Hradec Kralove', 'Tschechische Republik', '606586456', 'p.pytlik@centrum.cz', '18.6.1983', 'Tschechisch, Deutsch, Englisch, Französisch', 'Ja', 'Mann', '', '', '', '', 'Nein', 'Akademische Abschluss', '', '', '', ''),
('tomankova', 'tsqm', 'Tomankova', 'Eva', 'user', 'Bolzanova', '31/B', '66902', 'Znojmo', 'Tschechische Republik', '515224922', 'tomankovae@seznam.cz', '4.4.1982', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('plankova', 'tsqm', 'Plankova', 'Lucie', 'user', 'Prazska sidliste', '2403/2A', '66902', 'Znojmo', 'Tschechische Republik', '', '', '1.12.1981', 'Tschechisch, Deutsch, ', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Akademische Abschluss', '', '', '', ''),
('cerny', 'tsqm', 'Cerny', 'Michal', 'user', 'Za Sokolovnou', '492', '67182', 'Dobsice', 'Tschechische Republik', '737480244', '', '16.10.1987', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Mann', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('rysava', 'tsqm', 'Rysava', 'Lenka', 'user', 'Glasergasse', '19/17', '1090', 'Wien', 'Österreich', '', '', '11.5.1986', 'Tschechisch, Deutsch, Englisch', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Mittlereschule, Fachschule', '', '', '', ''),
('mravcova', 'tsqm', 'Mravcova', 'Janka', 'user', 'Medvedzie', '145', '02744', 'Tvrdosin', 'Tschechische Republik', '00421911958822', 'fibbi777@centrum.sk', '9.5.1984', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Berufsschule, Lehre', '', '', '', ''),
('skalska', 'tsqm', 'Skalska', 'Veronika', 'user', 'Polom', '48', '75364', 'Prerov', 'Tschechische Republik', '776023920', 'veronika.skalska@seznam.cz', '', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('motycka', 'tsqm', 'Motycka', 'Lukas', 'user', 'Krakovska', '14', '77200', 'Olomouc', 'Tschechische Republik', '737024393', 'lukas.motycka@email.cz', '9.10.1979', '', 'Ja', 'Mann', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('brychtova', 'tsqm', 'Brychtova', 'Eva', 'user', 'U Lesika', '16', '66902', 'Znojmo', 'Tschechische Republik', '608319785', '', '3.10.1984', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('mertens', 'tsqm', 'Mertens', 'Otto', 'user', 'Kerova', '1', '64100', 'Brno', 'Tschechische Republik', '777814827', 'mertens@volny.cz', '16.6.1982', 'Tschechisch, Deutsch, Englisch, Niederländisch', 'Ja', 'Mann', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('vankova', 'tsqm', 'Vankova', 'Marketa', 'user', 'Na Stepnici', '668', '37821', 'Kardasova Recice', 'Tschechische Republik', '604478699', 'mkytka@hotmail.com', '27.5.1980', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('stankova', 'tsqm', 'Stankova', 'Elena', 'user', 'Prazska', '39', '66902', 'Znojmo', 'Tschechische Republik', '602827279', 'stankovaelena@seznam.cz', '12.1.1982', 'Tschechisch, Deutsch, Englisch, Bulgarisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('trombik', 'tsqm', 'Trombik', 'Vojtech', 'user', 'Kubelikova', '1314/6', '73601', 'Havirov', 'Tschechische Republik', '606876540', 'trombikv@volny.cz', '4.6.1983', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Mann', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('pristlova', 'tsqm', 'Pristlova', 'Eliska', 'user', 'nam. Republiky', '17', '66902', 'Znojmo', 'Tschechische Republik', '605581770', '', '21.4.1981', 'Tschechisch, Deutsch, ', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Berufsschule, Lehre', '', '', '', ''),
('dubnicka', 'tsqm', 'Dubnicka', 'Petra', 'user', 'Sokolska', '1298/27', '66902', 'Znojmo', 'Tschechische Republik', '732811566', 'petra.dubnicka@seznam.cz', '20.4.1986', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('veselatereza', 'tsqm', 'Vesela', 'Tereza', 'user', '', '228', '67181', 'Znojmo- Novy Saldorf', 'Tschechische Republik', '604210816', '', '24.5.1991', 'Tschechisch, Deutsch, Englisch', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('filipova', 'tsqm', 'Filipova', 'Jana', 'user', 'Bratri Capku', '12', '66902', 'Znojmo', 'Tschechische Republik', '60723069', '', '18.9.1986', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('pospichalova', 'tsqm', 'Pospichalova', 'Tereza', 'user', '', '5', '67151', 'Blizkovice', 'Tschechische Republik', '728457926', 'terka.posp@seznam.cz', '2.3.1988', 'Tschechisch,Deutsch,Englisch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Termin stattgefunden', '', ''),
('bradlova', 'tsqm', 'Bradlova', 'Pavlina', 'user', 'Voletiny', '157', '54103', 'Trutnov', 'Tschechische Republik', '', '', '12.11.1980', 'Tschechisch, Deutsch, ', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('vasatkova', 'tsqm', 'Vasatkova', 'Hana', 'user', 'Pionyru', '1339', '56401', 'Zamberk', 'Tschechische Republik', '', '', '1.3.1984', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Matura', '', '', '', ''),
('kocourkova', 'tsqm', 'Kocourkova', 'Dana', 'user', 'O.Chlupa', '2', '66902', 'Znojmo', 'Tschechische Republik', '777985461', 'kocda@centrum.cz', '', 'Tschechisch, Deutsch, Englisch', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('ranochova', 'tsqm', 'Ranochova', 'Lenka', 'user', 'Rotalova', '34', '61400', 'Brno', 'Tschechische Republik', '774849629', 'lenkaranochova@seznam.cz', '5.1.1982', 'Tschechisch, Deutsch, Englisch, Holandstina', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Akademische Abschluss', '', '', '', ''),
('adamec', 'tsqm', 'Adamec', 'Radek', 'user', 'Pravcice', '147', '76824', 'Hulin', 'Tschechische Republik', '777005262', 'rad.adamec@seznam.cz', '26.10.1984', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Mann', '', '', '', '', 'Nein', 'Matura', '', '', '07.03.2008-16:37', ''),
('smrckova', 'tsqm', 'Smrckova', 'Svetlana', 'user', 'Prazska', '62', '66902', 'Znojmo', 'Tschechische Republik', '739420577', '', '25.21993', 'Tschechisch, Deutsch, Englisch', 'Nein', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('mrazova', 'tsqm', 'Mrazova', 'Jana', 'user', '', '', '', '', 'Tschechische Republik', '', '', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', 'Pflichtschule', '', '', '', ''),
('helova', 'tsqm', 'Helova', 'Veronika', 'user', 'Komenskeho', '321', '67168', 'Sanov', 'Tschechische Republik', '721707509', 'veronika.helova@seznam.cz', '8.6.1989', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('bystricka', 'tsqm', 'Bystricka', 'Lucie', 'user', 'Jindricha Horejsiho', '24', '66902', 'Znojmo', 'Tschechische Republik', '732869232', 'belle.amie@seznam.cz', '22.5.1988', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('kochova', 'tsqm', 'Kochova', 'Gabriela', 'user', '9. kvetna', '790', '67167', 'Hrusovany nad Jevisovkou', 'Tschechische Republik', '775955820', 'kochovag@seznam.cz', '13.5.1977', 'Tschechisch, Deutsch, Englisch', 'Ja', 'Frau', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('nerad', 'tsqm', 'Nerad', 'Jan', 'user', 'Panska', '391', '67125', 'Hodonice', 'Tschechische Republik', '721150548', 'johnyk11@seznam.cz', '14.5.1988', 'Tschechisch, Deutsch, Englisch', 'Nein', 'Mann', '', '', '', '', 'Nein', 'Pflichtschule', '', '', '', ''),
('marsounova', 'tsqm', 'Marsounova', 'Jana', 'user', '', '425', '67125', 'Hodonice', 'Tschechische Republik', '', '', '27.6.1988', 'Tschechisch,Deutsch,Englisch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Termin stattgefunden', '06.03.2008-14:12', ''),
('dedinska', 'tsqm', 'Dedinska', 'Lucie', 'user', '', '389', '67164', 'Bozice', 'Tschechische Republik', '721174139', 'lucka.dedinska@seznam.cz', '16.12.1991', 'Tschechisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Termin stattgefunden', '', ''),
('benesovapetra', 'tsqm', 'Benesova', 'Petra', 'user', 'Slovenska', '25', '66902', 'Znojmo', 'Tschechische Republik', '602480750', 'mariposa71@centrum.cz', '20.1.1989', 'Tschechisch, Deutsch, Enflisch', 'Ja', 'Frau', '', '', '', '', 'Ja', 'Pflichtschule', '', '', '', ''),
('brabencova', 'tsqm', 'Brabencova', 'Klara', 'user', 'Pavlice ', '30', '671 56 ', 'Grešlové Mýto', 'Tschechische Republik', '736212948', 'klara.brabencova@seznam.cz', ' 22.10.1989', 'Tschechisch, Deutsch, Englisch', 'Nein', 'Frau', '', '', '', '', 'Ja', 'Pflichtschule', '', '', '', ''),
('konecna', 'tsqm', 'Konecna', 'Denisa', 'user', '', '', '', '', 'Tschechische Republik', '', '', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', 'Pflichtschule', '', '', '', ''),
('Lassanova', 'tsqm', 'Lassanova', 'Dagmar', 'user', 'Modrinova', '186', '69142', 'Valtice', 'Tschechische Republik', '00420728161829', 'dagmi.l@seznam.cz', '10.11.1989', 'deutsch,tschechisch', 'Ja', 'Frau', '16.04.2008', '21.0.2008', '', '', 'Ja', 'Pflichtschule', 'Kunden', 'Termin stattgefunden', '08.05.2008-8:55', ''),
('matejka', 'tsqm', 'Matejka', 'Martin', 'user', '', '', '', '', 'Tschechische Republik', '607 853 604', 'Martin.Max@centrum.cz', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('jezkova', 'tsqm', 'Jezkova', 'Marie', 'user', '', '', '', '', 'Tschechische Republik', '736 445 819', 'MarieJezkova@seznam.cz', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('bazalova', 'tsqm', 'Bazalova', 'Katerina', 'user', '', '', '', '', 'Tschechische Republik', '737 300 424', 'KBazalova@seznam.cz', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('dlouha', 'tsqm', 'Dlouha', 'Marie', 'su', '', '', '', '', 'Tschechische Republik', '774 663 102', '', '', '', 'Ja', 'Frau', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('cenovska', 'tsqm', 'Cenovska', 'Vladimira', 'user', '', '', '', '', 'Tschechische Republik', '607 934 153', 'V.Cenovska@seznam.cz', '', '', 'Ja', 'Frau', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('collak', 'tsqm', 'Collak', 'Petr', 'user', 'Kollarova', '2', '', 'Havirov', 'Tschechische Republik', '773 458 227', '', '11.1.1980', 'Tschechisch,Deutsch,Englisch', 'Ja', 'männlich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('janosikova', 'tsqm', 'Janosikova', 'Petra', 'user', '', '', '', '', 'Tschechische Republik', '605 413 029', 'PJanosikova@seznam.cz', '', '', 'Ja', 'Frau', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('hamor', 'tsqm', 'Hamor', 'Gerhard', 'user', '', '', '', '', 'Tschechische Republik', '776 498 794', 'Gerhard.Hamor@gmail.com', '11.9.1987', 'Slowakisch,Deutsch,Englisch,Latein', 'Ja', 'männlich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('schnaber', 'tsqm', 'Schnaber', 'Ernst', 'user', '', '', '', '', 'Tschechische Republik', '733 215 888', '', '', '', 'Ja', 'Mann', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('brezinova', 'tsqm', 'Brezinova', 'Hana', 'user', '', '', '', '', 'Tschechische Republik', '776 577 629', 'Brezinovahanka@seznam.cz', '', '', 'Ja', 'Frau', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('sekaninova', 'tsqm', 'Sekaninova', 'Renata', 'user', '', '', '', '', 'Tschechische Republik', '605 171 459', 'Renorendis@centrum.cz', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('dobesova', 'tsqm', 'Dobesova', 'Veronika', 'user', '', '', '', '', 'Tschechische Republik', '608 807 961', 'VDobesova@email.cz', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('beusikova', 'tsqm', 'Beusikova', 'Katarina', 'user', '', '', '', '', 'Tschechische Republik', '608 256 028', 'Benutka@gmail.com', '', '', 'Ja', 'Frau', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('havran', 'tsqm', 'Havran', 'Jan', 'user', 'Kriva', '646', '50011', 'Hradec Kralove', 'Tschechische Republik', '737 141 874', 'havros216@email.cz', '13.3.1988', 'Tschechisch,Deutsch,Englisch', 'Ja', 'männlich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('komarkova', 'tsqm', 'Komarkova', 'Lida', 'user', '', '', '', '', 'Tschechische Republik', '', '', '', '', 'Ja', 'Frau', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('vlckova', 'tsqm', 'Vlckova', 'Sarka', 'user', '', '', '', '', 'Tschechische Republik', '602 341 883', 'Sar.Vlckova@seznam.cz', '', '', 'Ja', 'Frau', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('flachvartova', 'tsqm', 'Flachbartova', 'Darja', 'user', 'Kysucka', '6', '73701', 'Cesky Tesin', 'Tschechische Republik', '737 861 169', 'DarjaFlachbartova@seznam.cz', '28.10.1987', 'Tschechisch,Slowakisch,Deutsch,Englisch,Polnisch,S', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('holcova', 'tsqm', 'Holcova', 'Olga', 'user', '', '', '', '', 'Tschechische Republik', '723 119 313', 'Olga.Holcova@seznam.cz', '', '', 'Ja', 'Frau', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('malaskova', 'tsqm', 'Malaskova', 'Zuzana', 'user', '', '', '', '', 'Tschechische Republik', '777 597 092', 'Zuzka.Malaskova@seznam.cz', '28.4.1986', '', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('homolkova', 'tsqm', 'Homolkova', 'Ivana', 'user', '', '', '', '', 'Tschechische Republik', '602 169 679', 'Ivana.Homolkova@klikni.cz', '', '', 'Ja', 'Frau', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('varilova ', 'tsqm', 'Varilova', 'Zuzana', 'user', '', '', '', '', 'Tschechische Republik', '732 747 663', 'zuzka.varilova@post.cz', '', '', 'Ja', 'Frau', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('puceglova', 'tsqm', 'Puceglova', 'Magda', 'user', '', '', '', '', 'Tschechische Republik', '', 'LenaMagda@atlas.cz', '', '', 'Ja', 'Frau', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('klimes', 'tsqm', 'Klimes', 'Petr', 'user', 'Slavikova', '16', '13000', 'Praha', 'Tschechische Republik', '774 271 272', 'klimes.petr@gmail.cz', '3.3.1985', 'Tschechisch,Deutsch,Englisch', 'Ja', 'männlich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('hyblerova', 'tsqm', 'Hyblerova', 'Gabriela', 'user', '', '', '', '', 'Tschechische Republik', '728 921 566', 'hyblerova.g@seznam.cz', '', '', 'Ja', 'Frau', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('kubica', 'tsqm', 'Kubica', 'Jakub', 'user', '', '', '', '', 'Tschechische Republik', '776 460 757', '', '', '', 'Ja', 'Mann', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('krkavec', 'tsqm', 'Krkavec', 'Martin', 'user', 'Vondrakova', '23', '63500', 'Brno', 'Tschechische Republik', '608 126 455', 'raven@borg.cz', '26.7.1985', 'Tschechisch,Englisch,Spanisch', 'Ja', 'männlich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('kmoscak', 'tsqm', 'Kmoscak', 'Ondrej', 'user', '', '', '', '', 'Tschechische Republik', '', 'OKmoscak@gmail.com', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('kucinek', 'tsqm', 'Kucirek', 'Tomas', 'user', 'U Sokolovny', '137', '28571', 'Vrdy', 'Tschechische Republik', '737180410', 'xkucir00@stud.fit.vutbr.cz', '28.1.1987', 'Tschechisch,Englisch', 'Ja', 'männlich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('horacek', 'tsqm', 'Horacek', 'Tomas', 'user', '', '', '', '', 'Tschechische Republik', '732915331', 'ToHoracek@qmail.com', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('klicnar', 'tsqm', 'Klicnar', 'Lukas', 'user', '', '', '', '', 'Tschechische Republik', '776049850', 'Root@prishotice.cz', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('knobot', 'tsqm', 'Knobot', 'Ondrej', 'user', '', '', '', '', 'Tschechische Republik', '603244386', 'RobKnobot@seznam.cz', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('frystak', 'tsqm', 'Frystak', 'Radek', 'user', '', '', '', '', 'Tschechische Republik', '737484397', 'Geniv@centrum.cz', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('vytvar', 'tsqm', 'Vytvar', 'Jaromir', 'user', '', '', '', '', 'Tschechische Republik', '777588065', 'Mira.Poklad@centrum.cz', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('kubik', 'tsqm', 'Kubik', 'Tomas', 'user', '', '', '', '', 'Tschechische Republik', '605305808', 'Fidel@lit.cz', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('camkala', 'tsqm', 'Campala', 'Roman', 'user', '', '', '', '', 'Tschechische Republik', '603478963', 'roman.campala@seznam.cz', '', '', 'Ja', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('kratka', 'tsqm', 'Kratka', 'Martina', 'user', '', '', '', '', 'Tschechische Republik', '777697206', 'kratma@seznam.cz', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('svajda', 'tsqm', 'Svajda', 'Patrik', 'user', '', '', '', '', 'Tschechische Republik', '739772944', 'pa3k@itaxnet.sk', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('lopaskova', 'tsqm', 'Lopaskova', 'Kristyna', 'user', '', '', '', '', 'Tschechische Republik', '721699279', '', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('rusnak', 'tsqm', 'Rusnak', 'Jakub', 'user', '', '', '', '', 'Tschechische Republik', '737581239', 'jarusnak00@gmail.com', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('ctibor', 'tsqm', 'Ctibor', 'Jiri', 'user', '', '', '', '', 'Tschechische Republik', '723959527', 'j.ctibor@seznam.cz', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('pavlin', 'tsqm', 'Pavlin', 'Vaclav', 'user', '', '', '', '', 'Tschechische Republik', '739666824', 'fencer@seznam.cz', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('uhlir', 'tsqm', 'Uhlir', 'Vaclav', 'user', '', '', '', '', 'Tschechische Republik', '777889531', 'uhlir.v@gmail.com', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('suchannova', 'tsqm', 'Suchankova', 'Lucie', 'user', 'Hradecka', '59', '50011', 'Hradec Kralove', 'Tschechische Republik', '776681094', 'lucie.suchannova@centrum.cz', '6.5.1987', 'Tschechisch,Deutsch,Englisch,Schwedisch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Mature', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('trundova', 'tsqm', 'Trundova', 'Lenka', 'user', '', '', '', '', 'Tschechische Republik', '', 'trundova@seznam.cz', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('rosuchova', 'tsqm', 'Rosuchova', 'Lenka', 'user', '', '', '', '', 'Tschechische Republik', '739676045', 'lenka.rosuchova@seznam.cz', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('stepanek', 'tsqm', 'Stepanek', 'Tomas', 'user', '', '', '', '', 'Tschechische Republik', '606168965', 'thomas555@seznam.cz', '', '', 'Nein', 'Mann', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('zaverkova', 'tsqm', 'Zaverkova', 'Petra', 'user', '', '', '', '', 'Tschechische Republik', '602270415', 'petra.zaverkova@atlas.cz', '', '', 'Nein', 'Frau', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('jirikovsky', 'tsqm', 'Jirikovsky', 'Lukas', 'user', '', '', '', '', 'Tschechische Republik', '', '', '', '', 'Ja', 'männlich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('georgova', 'tsqm', 'Georgova', 'Nikola', 'user', 'Tasovice', '', '', 'Znojmo', 'Tschechische Republik', '728544440', '', '9.2.1991', 'Tschechisch,Deutsch,Englisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('veselasimona', 'tsqm', 'Vesela', 'Simona', 'user', 'kamenna', '307', '39001', 'Tabor', 'Tschechische Republik', '774701742', 'simonavesela@email,cz', '18.8.1991', 'Tschechisch,Deutsch,Englisch', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('pekovasara', 'tsqm', 'Pekova', 'Sara', 'user', '', '', '', '', 'Tschechische Republik', '775418754', '', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('kvardova', 'tsqm', 'Kvardova', 'Klara', 'user', '', '', '', '', 'Tschechische Republik', '739444729', 'k.lara90@seznam.cz', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('vankovakristyna', 'tsqm', 'Vankova', 'Kristyna', 'user', '', '', '', '', 'Tschechische Republik', '737754030', '', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('vachulova', 'tsqm', 'Vachulova', 'Klara', 'user', '', '', '', '', 'Tschechische Republik', '602186468', '', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('janickova', 'tsqm', 'Janickova', 'Simona', 'user', '', '', '', '', 'Tschechische Republik', '', 'simjanickova@seznam.cz', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('valentova', 'tsqm', 'Valentova', 'Sona', 'user', '', '', '', '', 'Tschechische Republik', '', 'valentova.so@seznam.cz', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('brezinova', 'tsqm', 'Brezinova', 'Vilma', 'user', '', '', '', '', 'Tschechische Republik', '605337882', 'vilmab@email.cz', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('pacherova', 'tsqm', 'Pacherova', 'Michaela', 'user', '', '', '', '', 'Tschechische Republik', '724355615', 'misa.pacherova@seznam.cz', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('urbankova', 'tsqm', 'Urbankova', 'Marika', 'user', '', '', '', '', 'Tschechische Republik', '602725728', '', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('devecka', 'tsqm', 'Devecka', 'Eduard', 'user', '', '', '', '', 'Tschechische Republik', '775047155', 'eduard.devecka@pobox.sk', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('valentovaeva', 'tsqm', 'Valentova', 'Eva', 'user', '', '', '', '', 'Tschechische Republik', '776129738', '', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('salabova', 'tsqm', 'Salabova', 'Marie', 'user', '', '', '', '', 'Tschechische Republik', '723999877', '', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('hudakova', 'tsqm', 'Hudakova', 'Nela', 'user', '', '', '', '', 'Tschechische Republik', '', 'nelahudakova@seznam.cz', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('zabranska', 'tsqm', 'Zabranska', 'Hana', 'user', '', '', '', '', 'Tschechische Republik', '', 'zabranska.h@seznam.cz', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('gyarfasova', 'tsqm', 'Gyarfasova', 'Tina', 'user', '', '', '', '', 'Tschechische Republik', '', '181710@mail.myni.cz', '', '', 'Nein', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', ''),
('slavikova', 'tsqm', 'Slavikova', 'Andrea', 'user', 'Zelnicky', '615', '69661', 'Vnorovy', 'Tschechische Republik', '777302232', 'pistalka.AK@seznam.cz', '', '', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('travnickova', 'tsqm', 'Travnickova', 'Lucie', 'user', 'Svazna', '8', '63400', 'Brno', 'Tschechische Republik', '732617330', '', '24.6.1988', 'Tschechisch,Deutsch,Englisch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('kratochvilovavendula', 'tsqm', 'Kratochvilova', 'Vendula', 'user', 'Dolni', '409', '67182', 'Dobsice', 'Tschechische Republik', '777119998', '', '25.10.1990', '', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('pospisilova', 'tsqm', 'Pospisilova', 'Hana', 'user', '', '609', '69606', 'Vacenovice', 'Tschechische Republik', '605784275', 'hana.pospisilova@seznam.cz', '18.8.1985', 'Tschechisch,Deutsch,Englisch,Schwedisch,Spanisch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('matouskova', 'tsqm', 'Matouskova', 'Petra', 'user', 'Srazna', '18', '58601', 'Jihlava', 'Tschechische Republik', '723698677', 'petruska.matouskova@seznam.cz', '15.6.1986', 'Tschechisch,Deutsch,Englisch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Akademische Abschluss', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('kubickova', 'tsqm', 'Kubickova', 'Ludmila', 'user', 'Nakladni', '356', '', 'Stity', 'Tschechische Republik', '776159145', '', '14.9.1983', '', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('hudakova', 'tsqm', 'Hudakova', 'Nela', 'user', 'Cerny Vrch', '434', '35604', 'Dolno Rychnov', 'Tschechische Republik', '775190487', 'nelahudakova@seznam.cz', '19.4.1987', '', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('sindelarova', 'tsqm', 'Sindelarova', 'Klara', 'user', 'Prazska ', '98', '66902', 'Znojmo', 'Tschechische Republik', '722656913', 'sindaklarka@seznam.cz', '8.3.1990', 'Tschechisch,Deutsch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('tunkova', 'tsqm', 'Tunkova', 'Jitka', 'user', '', '334', '67131', 'Unanov', 'Tschechische Republik', '732315755', '', '19.9.1964', 'Tschechisch,Deutsch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('hapova', 'tsqm', 'Hapova', 'Katerina', 'user', '', '219', '67155', 'Blizkovice', 'Tschechische Republik', '777630726', 'hapova.katerina@seznam.cz', '9.1.1985', 'Tschechisch,Deutsch,Englisch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('durda', 'tsqm', 'Durda', 'Ondrej', 'user', '', '', '', '', 'Tschechische Republik', '605586223', '', '5.12.1991', 'Tschechisch,Deutsch,Englisch', 'Ja', 'männlich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf noch nicht bekommen', '', '');
INSERT INTO `login` (`jmeno`, `heslo`, `prijmeni`, `krestni`, `skupina`, `ulice`, `cp`, `psc`, `mesto`, `stat`, `telefon`, `mail`, `datum_narozeni`, `jazyky`, `ridicak`, `pohlavi`, `datum_pohovoru`, `datum_nastupu`, `datum_poslani`, `datum_konce`, `pracuje`, `vzdelani`, `vztah`, `zivotopisy`, `posledni_prihlaseni`, `foto`) VALUES 
('venclikova', 'tsqm', 'Venclikova', 'Ludmila', 'user', '', '55', '67151', 'Olbramkostel', 'Tschechische Republik', '728551929', 'lida.venclikova@seznam.cz', '30.11.1982', 'Tschechisch,Deutsch,Englisch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('bartonikova', 'tsqm', 'Bartonikova', 'Jaroslava', 'user', 'Prace', '51', '67161', 'Prosimerice', 'Tschechische Republik', '723001331', 'jarka.kvetinka@seznam.cz', '15.11.1979', '', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('prochazkova', 'tsqm', 'Prochazkova', 'Marta', 'user', 'Dukelska', '144A', '67181', 'Znojmo', 'Tschechische Republik', '723320814', '', '18.2.1963', 'Tschechisch,Deutsch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('jurkova', 'tsqm', 'Jurkova', 'Iveta', 'user', 'Prostredni', '86', '66902', 'Kucharovice', 'Tschechische Republik', '723632343', 'jurkovaiveta@seznam.cz', '3.5.1969', 'Tschechisch,Deutsch,Englisch,Russisch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('kolcunova', 'tsqm', 'Kolcunova', 'Ivana', 'user', 'Zborovska', '5', '70200', 'Ostrava', 'Tschechische Republik', '774875304', 'ivana.kolcunova@seznam.cz', '4.3.1987', 'Tschechisch,Deutsch,Englisch,Russisch', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('stanicka', 'tsqm', 'Stanicka', 'Petra', 'user', 'Brezinova', '19', '60501', 'Hodonin', 'Tschechische Republik', '776645619', '', '11.7.1986', 'Tschechisch,Deutsch,Englisch,Polnisch,Italienisch,', 'Ja', 'weiblich', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('hayek', 'tsqm', 'Hayek', 'Adam', 'user', 'Mucednicka', '36', '61600', 'Brno', 'Tschechische Republik', '776727532', 'adamhayek@seznam.cz', '17.9.1991', 'Tschechisch,Englisch', 'Nein', 'männlich', '', '', '', '', 'Ja', 'Pflichtschule', 'Mitarbeiter', 'Lebenslauf eingegangen', '', ''),
('dittrich', 'tsqm', 'Dittrich', 'Milan', 'user', 'Raisova', '1816', '54701', 'Nachod', 'Tschechische Republik', '608022457', 'milan.dittrich@seznam.cz', '5.6.1979', 'Tschechisch,Deutsch,Englisch', 'Ja', 'männlich', '', '', '', '', 'Ja', 'Matura', 'Mitarbeiter', 'Lebenslauf eingegangen', '', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `lopaskova`
-- 

CREATE TABLE `lopaskova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `lopaskova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `lukacova`
-- 

CREATE TABLE `lukacova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `lukacova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `malaskova`
-- 

CREATE TABLE `malaskova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `malaskova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `marsounova`
-- 

CREATE TABLE `marsounova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `marsounova`
-- 

INSERT INTO `marsounova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('-', '-', '-', '-', 'Montag', '0', 'Marsounova Jana', 'marsounova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Dienstag', '0', 'Marsounova Jana', 'marsounova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Mittwoch', '0', 'Marsounova Jana', 'marsounova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Marsounova Jana', 'marsounova', '', '', '', '-', '-', NULL),
('14.3.2008', '07:00', '15:00', '8', 'Freitag', '0', 'Marsounova Jana', 'marsounova', '', '3', '2008', '-', '-', NULL),
('15.3.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Marsounova Jana', 'marsounova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Marsounova Jana', 'marsounova', '', '', '', '-', '-', NULL);

-- --------------------------------------------------------

-- 
-- Struktura tabulky `masejova`
-- 

CREATE TABLE `masejova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `masejova`
-- 

INSERT INTO `masejova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '16:00', '18:30', '2.5', 'Montag', '0', 'Masejova Marcela', 'masejova', '', '3', '2008', '-', '-', NULL),
('11.3.2008', '16:00', '18:30', '2.5', 'Dienstag', '0', 'Masejova Marcela', 'masejova', '', '3', '2008', '-', '-', NULL),
('12.3.2008', '15:00', '16:30', '1.5', 'Mittwoch', '0', 'Masejova Marcela', 'masejova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Freitag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Montag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('20.3.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Masejova Marcela', 'masejova', '', '3', '2008', '-', '-', ''),
('21.3.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Masejova Marcela', 'masejova', '', '3', '2008', '-', '-', ''),
('22.3.2008', '08:00', '16:30', '8.5', 'Samstag', '0', 'Masejova Marcela', 'masejova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('26.3.2008', '14:15', '16:30', '2.25', 'Mittwoch', '0', 'Masejova Marcela', 'masejova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('28.3.2008', '13:30', '16:30', '3', 'Freitag', '0', 'Masejova Marcela', 'masejova', '', '3', '2008', '-', '-', ''),
('29.3.2008', '08:00', '16:30', '8.5', 'Samstag', '0', 'Masejova Marcela', 'masejova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('9.4.2008', '14:30', '16:30', '2', 'Mittwoch', '0', 'Masejova Marcela', 'masejova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('11.4.2008', '14:00', '16:30', '2.5', 'Freitag', '0', 'Masejova Marcela', 'masejova', '', '4', '2008', '-', '-', ''),
('12.4.2008', '08:00', '16:30', '8.5', 'Samstag', '0', 'Masejova Marcela', 'masejova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('14.4.2008', '14:30', '18:30', '4', 'Montag', '0', 'Masejova Marcela', 'masejova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('19.4.2008', '13:30', '18:30', '5', 'Samstag', '0', 'Masejova Marcela', 'masejova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('24.4.2008', '16:00', '18:30', '2.5', 'Donnerstag', '0', 'Masejova Marcela', 'masejova', '', '4', '2008', '-', '-', ''),
('25.4.2008', '14:00', '16:30', '2.5', 'Freitag', '0', 'Masejova Marcela', 'masejova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('30.4.2008', '14:30', '16:30', '2', 'Mittwoch', '0', 'Masejova Marcela', 'masejova', '', '4', '2008', '-', '-', ''),
('1.5.2008', '13:30', '15:30', '2', 'Donnerstag', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('2.5.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('3.5.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('8.5.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('9.5.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('10.5.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('13.5.2008', '08:00', '16:30', '8.5', 'Dienstag', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('14.5.2008', '08:00', '16:30', '8.5', 'Mittwoch', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('15.5.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('16.5.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('19.5.2008', '13:30', '16:30', '3', 'Montag', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('22.5.2008', '13:30', '16:30', '3', 'Donnerstag', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('23.5.2008', '14:00', '16:30', '2.5', 'Freitag', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('26.5.2008', '13:30', '16:30', '3', 'Montag', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('28.5.2008', '13:30', '16:30', '3', 'Mittwoch', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('30.5.2008', '14:00', '16:30', '2.5', 'Freitag', '0', 'Masejova Marcela', 'masejova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '1', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '1', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '1', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '1', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', ''),
('6.6.2008', '14:00', '16:30', '2.5', 'Freitag', '1', 'Masejova Marcela', 'masejova', '', '6', '2008', '-', '-', ''),
('7.6.2008', '08:00', '12:00', '4', 'Samstag', '1', 'Masejova Marcela', 'masejova', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', 'Masejova Marcela', 'masejova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `matejka`
-- 

CREATE TABLE `matejka` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `matejka`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `matouskova`
-- 

CREATE TABLE `matouskova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `matouskova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `mertens`
-- 

CREATE TABLE `mertens` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `mertens`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `mezerova`
-- 

CREATE TABLE `mezerova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `mezerova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `michkova`
-- 

CREATE TABLE `michkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `michkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `mikulkova`
-- 

CREATE TABLE `mikulkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `mikulkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `milerova`
-- 

CREATE TABLE `milerova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `milerova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `motycka`
-- 

CREATE TABLE `motycka` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `motycka`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `mravcova`
-- 

CREATE TABLE `mravcova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `mravcova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `mrazova`
-- 

CREATE TABLE `mrazova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `mrazova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `neco`
-- 

CREATE TABLE `neco` (
  `asdf` varchar(255) collate latin2_czech_cs NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `neco`
-- 

INSERT INTO `neco` (`asdf`) VALUES 
('1');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `nerad`
-- 

CREATE TABLE `nerad` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `nerad`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `nova`
-- 

CREATE TABLE `nova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `nova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `novotna`
-- 

CREATE TABLE `novotna` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `novotna`
-- 

INSERT INTO `novotna` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '15:00', '21:00', '6', 'Montag', '0', 'Novotna Aneta', 'novotna', '', '3', '2008', '-', '-', NULL),
('11.3.2008', '14:00', '21:00', '7', 'Dienstag', '0', 'Novotna Aneta', 'novotna', '', '3', '2008', '-', '-', NULL),
('12.3.2008', '14:00', '18:00', '4', 'Mittwoch', '0', 'Novotna Aneta', 'novotna', '', '3', '2008', '-', '-', NULL),
('13.3.2008', '16:30', '19:30', '3', 'Donnerstag', '0', 'Novotna Aneta', 'novotna', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Freitag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Montag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('18:3.2008', '16:30', '21:30', '5', 'Dienstag', '0', 'Novotna Aneta', 'novotna', '', '20', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('17.3.2008', '15:00', '21:00', '6', 'Montag', '0', 'Novotna Aneta', 'novotna', '', '3', '2008', '-', '-', ''),
('-', '16:30', '21:00', '4.5', 'Dienstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '01:00', '01:00', '0', 'Mittwoch', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '01:00', '01:00', '0', 'Donnerstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '01:00', '01:00', '0', 'Freitag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '01:00', '01:00', '0', 'Samstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '01:00', '01:00', '0', 'Sonntag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('25.3.2008', '15:00', '21:00', '6', 'Dienstag', '0', 'Novotna Aneta', 'novotna', '', '3', '2008', '-', '-', ''),
('26.3.2008', '14:00', '19:00', '5', 'Mittwoch', '0', 'Novotna Aneta', 'novotna', '', '3', '2008', '-', '-', ''),
('27.3.2008', '16:30', '19:30', '3', 'Donnerstag', '0', 'Novotna Aneta', 'novotna', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('1.4.2008', '15:00', '20:00', '5', 'Dienstag', '0', 'Novotna Aneta', 'novotna', '', '4', '2008', '-', '-', ''),
('2.4.2008', '15:00', '20:00', '5', 'Mittwoch', '0', 'Novotna Aneta', 'novotna', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('15.4.2008', '14:00', '20:00', '6', 'Dienstag', '0', 'Novotna Aneta', 'novotna', '', '4', '2008', '-', '-', ''),
('16.4.2008', '14:00', '19:00', '5', 'Mittwoch', '0', 'Novotna Aneta', 'novotna', '', '4', '2008', '-', '-', ''),
('17.4.2008', '16:30', '19:30', '3', 'Donnerstag', '0', 'Novotna Aneta', 'novotna', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('23.4.2008', '14:00', '19:00', '5', 'Mittwoch', '0', 'Novotna Aneta', 'novotna', '', '4', '2008', '-', '-', ''),
('24.4.2008', '16:30', '19:30', '3', 'Donnerstag', '0', 'Novotna Aneta', 'novotna', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('28.4.2008', '15:00', '21:00', '6', 'Montag', '0', 'Novotna Aneta', 'novotna', '', '4', '2008', '-', '-', ''),
('29.4.2008', '14:00', '21:00', '7', 'Dienstag', '0', 'Novotna Aneta', 'novotna', '', '4', '2008', '-', '-', ''),
('30.4.2008', '14:00', '16:00', '2', 'Mittwoch', '0', 'Novotna Aneta', 'novotna', '', '4', '2008', '-', '-', ''),
('1.5.2008', '08:30', '16:30', '8', 'Donnerstag', '0', 'Novotna Aneta', 'novotna', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('5.5.2008', '15:00', '21:00', '6', 'Montag', '0', 'Novotna Aneta', 'novotna', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('12.5.2008', '15:00', '21:00', '6', 'Montag', '0', 'Novotna Aneta', 'novotna', '', '5', '2008', '-', '-', ''),
('13.5.2008', '14:00', '19:00', '5', 'Dienstag', '0', 'Novotna Aneta', 'novotna', '', '5', '2008', '-', '-', ''),
('14.5.2008', '14:00', '19:00', '5', 'Mittwoch', '0', 'Novotna Aneta', 'novotna', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('19.5.2008', '13:00', '20:00', '7', 'Montag', '0', 'Novotna Aneta', 'novotna', '', '5', '2008', '-', '-', ''),
('20.5.2008', '13:00', '20:00', '7', 'Dienstag', '0', 'Novotna Aneta', 'novotna', '', '5', '2008', '-', '-', ''),
('21.5.2008', '13:00', '20:00', '7', 'Mittwoch', '0', 'Novotna Aneta', 'novotna', '', '5', '2008', '-', '-', ''),
('22.5.2008', '13:00', '20:00', '7', 'Donnerstag', '0', 'Novotna Aneta', 'novotna', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('26.5.2008', '13:00', '21:00', '8', 'Montag', '0', 'Novotna Aneta', 'novotna', '', '5', '2008', '-', '-', ''),
('27.5.2008', '13:00', '21:00', '8', 'Dienstag', '0', 'Novotna Aneta', 'novotna', '', '5', '2008', '-', '-', ''),
('28.5.2008', '13:00', '16:00', '3', 'Mittwoch', '0', 'Novotna Aneta', 'novotna', '', '5', '2008', '-', '-', ''),
('29.5.2008', '13:00', '21:00', '8', 'Donnerstag', '0', 'Novotna Aneta', 'novotna', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('2.6.2008', '15:00', '18:00', '3', 'Montag', '1', 'Novotna Aneta', 'novotna', '', '6', '2008', '-', '-', ''),
('3.6.2008', '15:00', '20:00', '5', 'Dienstag', '1', 'Novotna Aneta', 'novotna', '', '6', '2008', '-', '-', ''),
('4.6.2008', '15:00', '19:00', '4', 'Mittwoch', '1', 'Novotna Aneta', 'novotna', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '1', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('6.6.2008', '09:00', '13:00', '4', 'Freitag', '1', 'Novotna Aneta', 'novotna', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '1', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', 'Novotna Aneta', 'novotna', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `novotnakaterina`
-- 

CREATE TABLE `novotnakaterina` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `novotnakaterina`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `otypka`
-- 

CREATE TABLE `otypka` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `otypka`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `otypkova`
-- 

CREATE TABLE `otypkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `otypkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `pacherova`
-- 

CREATE TABLE `pacherova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `pacherova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `pavlin`
-- 

CREATE TABLE `pavlin` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `pavlin`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `pechacek`
-- 

CREATE TABLE `pechacek` (
  `datum` varchar(10) collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) collate cp1250_czech_cs default NULL,
  `im` varchar(2) collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1250 COLLATE=cp1250_czech_cs;

-- 
-- Vypisuji data pro tabulku `pechacek`
-- 

INSERT INTO `pechacek` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '16:00', '20:00', '4', 'Montag', '0', 'Pechacek Radek', 'pechacek', '', '3', '2008', '-', '-', ''),
('11.3.2008', '16:00', '20:00', '4', 'Dienstag', '0', 'Pechacek Radek', 'pechacek', '', '3', '2008', '-', '-', ''),
('12.3.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Pechacek Radek', 'pechacek', '', '3', '2008', '-', '-', ''),
('13.3.2008', '16:00', '20:00', '4', 'Donnerstag', '0', 'Pechacek Radek', 'pechacek', '', '3', '2008', '-', '-', ''),
('14.3.2008', '13:00', '16:30', '3.5', 'Freitag', '0', 'Pechacek Radek', 'pechacek', '', '3', '2008', '-', '-', ''),
('15.3.2008', '16:00', '20:00', '4', 'Samstag', '0', 'Pechacek Radek', 'pechacek', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '0', 'Sonntag', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', ''),
('17.3.2008', '14:00', '16:30', '2.5', 'Montag', '0', 'Pechacek Radek', 'pechacek', '', '3', '2008', '-', '-', ''),
('18.3.2008', '16:00', '20:00', '4', 'Dienstag', '0', 'Pechacek Radek', 'pechacek', '', '3', '2008', '-', '-', ''),
('19.3.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Pechacek Radek', 'pechacek', '', '3', '2008', '-', '-', ''),
('20.3.2008', '07:30', '11:30', '4', 'Donnerstag', '0', 'Pechacek Radek', 'pechacek', '', '3', '2008', '-', '-', ''),
('21.3.2008', '16:00', '20:00', '4', 'Freitag', '0', 'Pechacek Radek', 'pechacek', '', '3', '2008', '-', '-', ''),
('22.3.2008', '16:00', '20:00', '4', 'Samstag', '0', 'Pechacek Radek', 'pechacek', '', '3', '2008', '-', '-', ''),
('-', '01:00', '01:00', '0', 'Sonntag', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', ''),
('25.3.2008', '14:30', '16:30', '2', 'Dienstag', '0', 'Pechacek Radek', 'pechacek', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', ''),
('27.3.2008', '14:30', '16:30', '2', 'Donnerstag', '0', 'Pechacek Radek', 'pechacek', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', ''),
('-', '16:00', '20:00', '4', 'Samstag', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', ''),
('7.4.2008', '14:00', '16:30', '2.5', 'Montag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('8.4.2008', '16:00', '20:00', '4', 'Dienstag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('9.4.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('10.4.2008', '14:00', '16:30', '2.5', 'Donnerstag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('11.4.2008', '16:00', '20:00', '4', 'Freitag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', ''),
('31.3.2008', '14:00', '16:30', '2.5', 'Montag', '0', 'Pechacek Radek', 'pechacek', '', '3', '2008', '-', '-', ''),
('1.4.2008', '16:00', '20:00', '4', 'Dienstag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('2.4.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('3.4.2008', '14:00', '16:30', '2.5', 'Donnerstag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('4.4.2008', '16:00', '20:00', '4', 'Freitag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('5.4.2008', '16:00', '20:00', '4', 'Samstag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', ''),
('14.4.2008', '13:30', '14:30', '1', 'Montag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('15.4.2008', '18:00', '20:00', '2', 'Dienstag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('16.4.2008', '18:00', '20:00', '2', 'Mittwoch', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('17.4.2008', '14:30', '16:30', '2', 'Donnerstag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('18.4.2008', '18:00', '20:00', '2', 'Freitag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('19.4.2008', '18:00', '20:00', '2', 'Samstag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', ''),
('21.4.2008', '16:00', '20:00', '4', 'Montag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('22.4.2008', '14:30', '16:30', '2', 'Dienstag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('23.4.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('24.4.2008', '14:30', '16:30', '2', 'Donnerstag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('25.4.2008', '16:00', '20:00', '4', 'Freitag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('26.4.2008', '16:00', '20:00', '4', 'Samstag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', ''),
('28.4.2008', '13:30', '16:30', '3', 'Montag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('29.4.2008', '16:00', '20:00', '4', 'Dienstag', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('30.4.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Pechacek Radek', 'pechacek', '', '4', '2008', '-', '-', ''),
('1.5.2008', '07:30', '11:30', '4', 'Donnerstag', '0', 'Pechacek Radek', 'pechacek', '', '5', '2008', '-', '-', ''),
('2.5.2008', '16:00', '20:00', '4', 'Freitag', '0', 'Pechacek Radek', 'pechacek', '', '5', '2008', '-', '-', ''),
('3.5.2008', '16:00', '20:00', '4', 'Samstag', '0', 'Pechacek Radek', 'pechacek', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', ''),
('5.5.2008', '16:00', '20:00', '4', 'Montag', '0', 'Pechacek Radek', 'pechacek', '', '5', '2008', '-', '-', ''),
('6.5.2008', '13:30', '16:30', '3', 'Dienstag', '0', 'Pechacek Radek', 'pechacek', '', '5', '2008', '-', '-', ''),
('7.5.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Pechacek Radek', 'pechacek', '', '5', '2008', '-', '-', ''),
('8.5.2008', '16:00', '20:00', '4', 'Donnerstag', '0', 'Pechacek Radek', 'pechacek', '', '5', '2008', '-', '-', ''),
('9.5.2008', '16:00', '20:00', '4', 'Freitag', '0', 'Pechacek Radek', 'pechacek', '', '5', '2008', '-', '-', ''),
('10.5.2008', '16:00', '20:00', '4', 'Samstag', '0', 'Pechacek Radek', 'pechacek', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', ''),
('12.5.2008', '16:00', '20:00', '4', 'Montag', '0', 'Pechacek Radek', 'pechacek', '', '5', '2008', '-', '-', ''),
('13.5.2008', '14:30', '16:30', '2', 'Dienstag', '0', 'Pechacek Radek', 'pechacek', '', '5', '2008', '-', '-', ''),
('14.5.2008', '16:00', '20:00', '4', 'Mittwoch', '0', 'Pechacek Radek', 'pechacek', '', '5', '2008', '-', '-', ''),
('15.5.2008', '14:30', '16:30', '2', 'Donnerstag', '0', 'Pechacek Radek', 'pechacek', '', '5', '2008', '-', '-', ''),
('16.5.2008', '16:00', '20:00', '4', 'Freitag', '0', 'Pechacek Radek', 'pechacek', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pechacek Radek', 'pechacek', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `pechova`
-- 

CREATE TABLE `pechova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `pechova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `pekovasara`
-- 

CREATE TABLE `pekovasara` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `pekovasara`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `pelikanova`
-- 

CREATE TABLE `pelikanova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `pelikanova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `plankova`
-- 

CREATE TABLE `plankova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `plankova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `podzemska`
-- 

CREATE TABLE `podzemska` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `podzemska`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `pokornajitka`
-- 

CREATE TABLE `pokornajitka` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `pokornajitka`
-- 

INSERT INTO `pokornajitka` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '07:00', '08:00', '1', 'Montag', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '-', '-', NULL),
('11.3.2008', '07:00', '08:00', '5', 'Dienstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '14:00', '18:00', NULL),
('12.3.2008', '07:00', '08:00', '1', 'Mittwoch', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '-', '-', NULL),
('13.3.2008', '07:00', '08:00', '5', 'Donnerstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '14:30', '18:30', NULL),
('14.3.2008', '07:00', '08:00', '1', 'Freitag', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', NULL),
('17.3.2008', '07:00', '08:00', '1', 'Montag', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '-', '-', ''),
('18.3.2008', '07:00', '08:00', '5', 'Dienstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '14:00', '18:00', ''),
('19.3.2008', '07:00', '08:00', '3', 'Mittwoch', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '13:00', '15:00', ''),
('20.3.2008', '08:00', '19:00', '11', 'Donnerstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '-', '-', ''),
('21.3.2008', '08:00', '19:00', '11', 'Freitag', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '-', '-', ''),
('22.3.2008', '08:00', '19:00', '11', 'Samstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('25.3.2008', '07:00', '08:00', '5', 'Dienstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '14:00', '18:00', ''),
('26.3.2008', '07:00', '08:00', '1', 'Mittwoch', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '-', '-', ''),
('27.3.2008', '07:00', '08:00', '4', 'Donnerstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '14:30', '17:30', ''),
('28.3.2008', '07:00', '08:00', '1', 'Freitag', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('31.3.2008', '07:00', '08:00', '1', 'Montag', '0', 'Pokorna Jitka', 'pokornajitka', '', '3', '2008', '-', '-', ''),
('1.4.2008', '07:00', '08:00', '5', 'Dienstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '4', '2008', '14:00', '18:00', ''),
('2.4.2008', '07:00', '08:00', '1', 'Mittwoch', '0', 'Pokorna Jitka', 'pokornajitka', '', '4', '2008', '-', '-', ''),
('3.4.2008', '07:00', '08:00', '6', 'Donnerstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '4', '2008', '13:30', '18:30', ''),
('4.4.2008', '07:00', '08:00', '7', 'Freitag', '0', 'Pokorna Jitka', 'pokornajitka', '', '4', '2008', '13:00', '19:00', ''),
('5.4.2008', '09:00', '13:00', '4', 'Samstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '4', '2008', '-', '-', ''),
('6.4.2008', '09:00', '13:00', '4', 'Sonntag', '0', 'Pokorna Jitka', 'pokornajitka', '', '4', '2008', '-', '-', ''),
('7.4.2008', '07:00', '08:00', '1', 'Montag', '0', 'Pokorna Jitka', 'pokornajitka', '', '4', '2008', '-', '-', ''),
('8.4.2008', '07:00', '08:00', '5', 'Dienstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '4', '2008', '14:00', '18:00', ''),
('9.4.2008', '07:00', '08:00', '1', 'Mittwoch', '0', 'Pokorna Jitka', 'pokornajitka', '', '4', '2008', '-', '-', ''),
('10.4.2008', '07:00', '08:00', '5', 'Donnerstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '4', '2008', '14:30', '18:30', ''),
('11.4.2008', '07:00', '08:00', '7', 'Freitag', '0', 'Pokorna Jitka', 'pokornajitka', '', '4', '2008', '13:00', '19:00', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('6.5.2008', '14:00', '17:00', '3', 'Dienstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('7.5.2008', '09:00', '17:00', '8', 'Mittwoch', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('8.5.2008', '09:00', '16:00', '7', 'Donnerstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('13.5.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('14.5.2008', '13:40', '15:40', '2', 'Mittwoch', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('15.5.2008', '14:30', '18:30', '4', 'Donnerstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('19.5.2008', '12:40', '17:40', '5', 'Montag', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('20.5.2008', '12:40', '17:40', '5', 'Dienstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('21.52008', '12:40', '17:40', '5', 'Mittwoch', '0', 'Pokorna Jitka', 'pokornajitka', '', '52', '', '-', '-', ''),
('22.5.2008', '12:40', '17:40', '5', 'Donnerstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('23.5.2008', '12:40', '17:40', '5', 'Freitag', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('24.5.2008', '09:00', '14:00', '5', 'Samstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('21.5.2008', '12:40', '17:40', '5', 'Mittwoch', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('26.5.2008', '12:40', '17:40', '5', 'Montag', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('27.5.2008', '12:40', '17:40', '5', 'Dienstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('28.5.2008', '12:40', '17:40', '5', 'Mittwoch', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('29.5.2008', '12:40', '17:40', '5', 'Donnerstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('30.5.2008', '12:40', '17:40', '5', 'Freitag', '0', 'Pokorna Jitka', 'pokornajitka', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pokorna Jitka', 'pokornajitka', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `pokornatereza`
-- 

CREATE TABLE `pokornatereza` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `pokornatereza`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `polakova`
-- 

CREATE TABLE `polakova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `polakova`
-- 

INSERT INTO `polakova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '16:00', '18:30', '2.5', 'Montag', '0', 'Pollakova Lenka', 'polakova', '', '3', '2008', '-', '-', NULL),
('11.3.2008', '16:00', '18:30', '2.5', 'Dienstag', '0', 'Pollakova Lenka', 'polakova', '', '3', '2008', '-', '-', NULL),
('12.3.2008', '13:30', '15:30', '2', 'Mittwoch', '0', 'Pollakova Lenka', 'polakova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Freitag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Montag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('20.3.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Pollakova Lenka', 'polakova', '', '3', '2008', '-', '-', ''),
('21.3.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Pollakova Lenka', 'polakova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('27.3.2008', '13:30', '18:30', '5', 'Donnerstag', '0', 'Pollakova Lenka', 'polakova', '', '3', '2008', '-', '-', ''),
('28.3.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Pollakova Lenka', 'polakova', '', '3', '2008', '-', '-', ''),
('29.3.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Pollakova Lenka', 'polakova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('4.4.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Pollakova Lenka', 'polakova', '', '4', '2008', '-', '-', ''),
('5.4.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Pollakova Lenka', 'polakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('10.4.2008', '13:30', '18:30', '5', 'Donnerstag', '0', 'Pollakova Lenka', 'polakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('11.4.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Pollakova Lenka', 'polakova', '', '4', '2008', '-', '-', ''),
('12.4.2008', '08:00', '13:00', '5', 'Samstag', '0', 'Pollakova Lenka', 'polakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('14.4.2008', '15:00', '18:30', '3.5', 'Montag', '0', 'Pollakova Lenka', 'polakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('16.4.2008', '16:00', '18:30', '2.5', 'Mittwoch', '0', 'Pollakova Lenka', 'polakova', '', '4', '2008', '-', '-', ''),
('17.4.2008', '13:30', '18:30', '5', 'Donnerstag', '0', 'Pollakova Lenka', 'polakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('19.4.2008', '08:00', '13:00', '5', 'Samstag', '0', 'Pollakova Lenka', 'polakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('21.4.2008', '08:00', '16:30', '8.5', 'Montag', '0', 'Pollakova Lenka', 'polakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('24.4.2008', '13:30', '18:30', '5', 'Donnerstag', '0', 'Pollakova Lenka', 'polakova', '', '4', '2008', '-', '-', ''),
('25.4.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Pollakova Lenka', 'polakova', '', '4', '2008', '-', '-', ''),
('26.4.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Pollakova Lenka', 'polakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('30.4.2008', '16:00', '18:30', '2.5', 'Mittwoch', '0', 'Pollakova Lenka', 'polakova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('2.5.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Pollakova Lenka', 'polakova', '', '5', '2008', '-', '-', ''),
('3.5.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Pollakova Lenka', 'polakova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('8.5.2008', '13:00', '18:30', '5.5', 'Donnerstag', '0', 'Pollakova Lenka', 'polakova', '', '5', '2008', '-', '-', ''),
('9.5.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Pollakova Lenka', 'polakova', '', '5', '2008', '-', '-', ''),
('10.5.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Pollakova Lenka', 'polakova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('28.5.2008', '14:00', '18:00', '4', 'Mittwoch', '0', 'Pollakova Lenka', 'polakova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('31.5.2008', '08:00', '16:00', '8', 'Samstag', '0', 'Pollakova Lenka', 'polakova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '1', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '1', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '1', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '1', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', ''),
('6.6.2008', '13:30', '18:00', '4.5', 'Freitag', '1', 'Pollakova Lenka', 'polakova', '', '6', '2008', '-', '-', ''),
('7.6.2008', '08:00', '16:00', '8', 'Samstag', '1', 'Pollakova Lenka', 'polakova', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', 'Pollakova Lenka', 'polakova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `pospichalova`
-- 

CREATE TABLE `pospichalova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `pospichalova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `pospisilova`
-- 

CREATE TABLE `pospisilova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `pospisilova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `prchalova`
-- 

CREATE TABLE `prchalova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `prchalova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `pristlova`
-- 

CREATE TABLE `pristlova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `pristlova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `prochazkova`
-- 

CREATE TABLE `prochazkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `prochazkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `puceglova`
-- 

CREATE TABLE `puceglova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `puceglova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `pytlik`
-- 

CREATE TABLE `pytlik` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `pytlik`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `ranochova`
-- 

CREATE TABLE `ranochova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `ranochova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `rihova`
-- 

CREATE TABLE `rihova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `rihova`
-- 

INSERT INTO `rihova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('-', '15:00', '20:00', '5', 'Montag', '0', 'Rihova Silvie', 'rihova', '', '03', '2008', '-', '-', ''),
('-', '14:00', '17:30', '3.5', 'Dienstag', '0', 'Rihova Silvie', 'rihova', '', '03', '2008', '-', '-', ''),
('-', '14:00', '17:00', '3', 'Mittwoch', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '16:30', '20:00', '3.5', 'Donnerstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '01:00', '01:00', '0', 'Freitag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '01:00', '01:00', '0', 'Samstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '01:00', '01:00', '0', 'Sonntag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('17.3.2008', '15:00', '21:00', '6', 'Montag', '0', 'Rihova Silvie', 'rihova', '', '3', '2008', '-', '-', ''),
('18.3.2008', '16:30', '21:45', '5.25', 'Dienstag', '0', 'Rihova Silvie', 'rihova', '', '3', '2008', '-', '-', ''),
('19.3.2008', '15:00', '21:00', '6', 'Mittwoch', '0', 'Rihova Silvie', 'rihova', '', '3', '2008', '-', '-', ''),
('20.3.2008', '07:30', '18:00', '10.5', 'Donnerstag', '0', 'Rihova Silvie', 'rihova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('28.3.2008', '14:00', '16:30', '2.5', 'Freitag', '0', 'Rihova Silvie', 'rihova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('31.3.2008', '15:00', '21:00', '6', 'Montag', '0', 'Rihova Silvie', 'rihova', '', '3', '2008', '-', '-', ''),
('1.4.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Rihova Silvie', 'rihova', '', '4', '2008', '-', '-', ''),
('2.4.2008', '14:00', '17:00', '3', 'Mittwoch', '0', 'Rihova Silvie', 'rihova', '', '4', '2008', '-', '-', ''),
('3.4.2008', '16:30', '20:00', '3.5', 'Donnerstag', '0', 'Rihova Silvie', 'rihova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('7.4.2008', '15:00', '20:00', '5', 'Montag', '0', 'Rihova Silvie', 'rihova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('10.4.2008', '16:30', '20:00', '3.5', 'Donnerstag', '0', 'Rihova Silvie', 'rihova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('14.4.2008', '15:00', '21:00', '6', 'Montag', '0', 'Rihova Silvie', 'rihova', '', '4', '2008', '-', '-', ''),
('15.4.2008', '14:00', '17:00', '3', 'Dienstag', '0', 'Rihova Silvie', 'rihova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('17.4.2008', '16:30', '20:30', '4', 'Donnerstag', '0', 'Rihova Silvie', 'rihova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('21.4.2008', '10:00', '20:00', '10', 'Montag', '0', 'Rihova Silvie', 'rihova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('25.4.2008', '16:30', '20:00', '3.5', 'Freitag', '0', 'Rihova Silvie', 'rihova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('2.5.2008', '10:00', '20:00', '10', 'Freitag', '0', 'Rihova Silvie', 'rihova', '', '5', '2008', '-', '-', ''),
('3.5.2008', '10:00', '20:00', '10', 'Samstag', '0', 'Rihova Silvie', 'rihova', '', '5', '2008', '-', '-', ''),
('4.5.2008', '10:00', '20:00', '10', 'Sonntag', '0', 'Rihova Silvie', 'rihova', '', '5', '2008', '-', '-', ''),
('19.5.2008', '13:00', '19:00', '6', 'Montag', '0', 'Rihova Silvie', 'rihova', '', '5', '2008', '-', '-', ''),
('20.5.2008', '13:00', '18:00', '5', 'Dienstag', '0', 'Rihova Silvie', 'rihova', '', '5', '2008', '-', '-', ''),
('21.5.2008', '13:00', '17:00', '4', 'Mittwoch', '0', 'Rihova Silvie', 'rihova', '', '5', '2008', '-', '-', ''),
('22.5.2008', '13:00', '18:00', '5', 'Donnerstag', '0', 'Rihova Silvie', 'rihova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('26.5.2008', '13:00', '19:00', '6', 'Montag', '0', 'Rihova Silvie', 'rihova', '', '5', '2008', '-', '-', ''),
('27.5.2008', '13:00', '18:00', '5', 'Dienstag', '0', 'Rihova Silvie', 'rihova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('29.5.2008', '13:00', '18:00', '5', 'Donnerstag', '0', 'Rihova Silvie', 'rihova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '1', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('3.6.2008', '14:00', '18:00', '4', 'Dienstag', '1', 'Rihova Silvie', 'rihova', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '1', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '1', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '1', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '1', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', 'Rihova Silvie', 'rihova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `rosuchova`
-- 

CREATE TABLE `rosuchova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `rosuchova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `rusnak`
-- 

CREATE TABLE `rusnak` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `rusnak`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `rydval`
-- 

CREATE TABLE `rydval` (
  `datum` varchar(10) collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) collate cp1250_czech_cs NOT NULL default '',
  `konec` varchar(20) collate cp1250_czech_cs NOT NULL default '',
  `pocet` varchar(20) collate cp1250_czech_cs NOT NULL default '',
  `den` varchar(30) collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) collate cp1250_czech_cs default NULL,
  `im` varchar(2) collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1250 COLLATE=cp1250_czech_cs;

-- 
-- Vypisuji data pro tabulku `rydval`
-- 

INSERT INTO `rydval` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('-', '-', '-', '-', 'Montag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', NULL),
('11.3.2008', '14:00', '18:30', '4.5', 'Dienstag', '0', 'Rydval Tomas', 'rydval', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Mittwoch', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', NULL),
('14.3.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Rydval Tomas', 'rydval', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Montag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('19.3.2008', '14:00', '18:30', '4.5', 'Mittwoch', '0', 'Rydval Tomas', 'rydval', '', '3', '2008', '-', '-', ''),
('20.3.2008', '07:30', '18:30', '11', 'Donnerstag', '0', 'Rydval Tomas', 'rydval', '', '3', '2008', '-', '-', ''),
('21.3.2008', '07:30', '18:30', '11', 'Freitag', '0', 'Rydval Tomas', 'rydval', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('25.3.2008', '14:00', '18:30', '4.5', 'Dienstag', '0', 'Rydval Tomas', 'rydval', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('28.3.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Rydval Tomas', 'rydval', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('7.4.2008', '15:00', '18:30', '3.5', 'Montag', '0', 'Rydval Tomas', 'rydval', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('9.4.2008', '14:00', '18:30', '4.5', 'Mittwoch', '0', 'Rydval Tomas', 'rydval', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('11.4.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Rydval Tomas', 'rydval', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('21.4.2008', '07:30', '18:30', '11', 'Montag', '0', 'Rydval Tomas', 'rydval', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('23.4.2008', '14:00', '18:30', '4.5', 'Mittwoch', '0', 'Rydval Tomas', 'rydval', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('25.4.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Rydval Tomas', 'rydval', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('30.4.2008', '14:00', '18:30', '4.5', 'Mittwoch', '0', 'Rydval Tomas', 'rydval', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('2.5.2008', '07:30', '18:30', '11', 'Freitag', '0', 'Rydval Tomas', 'rydval', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('7.5.2008', '07:30', '18:30', '11', 'Mittwoch', '0', 'Rydval Tomas', 'rydval', '', '5', '2008', '-', '-', ''),
('8.5.2008', '07:30', '18:30', '11', 'Donnerstag', '0', 'Rydval Tomas', 'rydval', '', '5', '2008', '-', '-', ''),
('9.5.2008', '07:30', '16:30', '9', 'Freitag', '0', 'Rydval Tomas', 'rydval', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('12.5.2008', '15:00', '18:30', '3.5', 'Montag', '0', 'Rydval Tomas', 'rydval', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('14.5.2008', '14:00', '18:30', '4.5', 'Mittwoch', '0', 'Rydval Tomas', 'rydval', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('16.5.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Rydval Tomas', 'rydval', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', ''),
('30.5.2008', '13:00', '18:30', '5.5', 'Freitag', '0', 'Rydval Tomas', 'rydval', '', '5', '2008', '-', '-', ''),
('31.5.2008', '08:00', '14:30', '6.5', 'Samstag', '0', 'Rydval Tomas', 'rydval', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Rydval Tomas', 'rydval', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `rysava`
-- 

CREATE TABLE `rysava` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `rysava`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `salabova`
-- 

CREATE TABLE `salabova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `salabova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `schmuttermeierova`
-- 

CREATE TABLE `schmuttermeierova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `schmuttermeierova`
-- 

INSERT INTO `schmuttermeierova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('-', '-', '-', '-', 'Montag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Dienstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Mittwoch', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', NULL),
('13.3.2008', '13:00', '15:30', '2.5', 'Donnerstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Freitag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', NULL),
('17.3.2008', '13:00', '16:30', '3.5', 'Montag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '3', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('20.3.2008', '07:00', '15:30', '8.5', 'Donnerstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '3', '', '-', '-', ''),
('21.3.2008', '07:00', '15:30', '8.5', 'Freitag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '3', '', '-', '-', ''),
('22.3.2008', '09:00', '16:30', '7.5', 'Samstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '3', '', '-', '-', ''),
('23.3.2008', '09:00', '16:30', '7.5', 'Sonntag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '3', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('27.3.2008', '13:00', '15:30', '2.5', 'Donnerstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '3', '2008', '-', '-', ''),
('28.3.2008', '13:00', '15:30', '2.5', 'Freitag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '3', '2008', '-', '-', ''),
('29.3.2008', '09:00', '16:30', '7.5', 'Samstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('31.3.2008', '13:00', '15:30', '2.5', 'Montag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '3', '2008', '-', '-', ''),
('1.4.2008', '13:00', '15:30', '2.5', 'Dienstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('2.4.2008', '13:00', '15:30', '2.5', 'Mittwoch', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('3.4.2008', '13:00', '15:30', '2.5', 'Donnerstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('4.4.2008', '12:00', '15:30', '3.5', 'Freitag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('5.4.2008', '09:00', '16:30', '7.5', 'Samstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('6.4.2008', '09:00', '16:30', '7.5', 'Sonntag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('10.4.2008', '13:00', '16:30', '3.5', 'Donnerstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('11.4.2008', '13:00', '16:30', '3.5', 'Freitag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('12.4.2008', '09:00', '16:30', '7.5', 'Samstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('13.4.2008', '09:00', '16:30', '7.5', 'Sonntag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('14.4.2008', '13:00', '16:30', '3.5', 'Montag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('17.4.2008', '13:00', '16:30', '3.5', 'Donnerstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('18.4.2008', '12:00', '15:30', '3.5', 'Freitag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('24.4.2008', '13:00', '16:30', '3.5', 'Donnerstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('25.4.2008', '13:00', '16:30', '3.5', 'Freitag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('27.4.2008', '09:00', '16:30', '7.5', 'Sonntag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('1.5.2008', '07:45', '15:45', '8', 'Donnerstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '5', '2008', '-', '-', ''),
('2.5.2008', '07:45', '15:45', '8', 'Freitag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('15.5.2008', '13:00', '16:30', '3.5', 'Donnerstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '5', '2008', '-', '-', ''),
('16.5.2008', '12:00', '16:30', '4.5', 'Freitag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '5', '2008', '-', '-', ''),
('17.5.2008', '09:00', '16:30', '7.5', 'Samstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '5', '2008', '-', '-', ''),
('18.5.2008', '09:00', '16:30', '7.5', 'Sonntag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('22.5.2008', '13:00', '16:30', '3.5', 'Donnerstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '5', '2008', '-', '-', ''),
('23.5.2008', '13:00', '16:30', '3.5', 'Freitag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('25.5.2008', '09:00', '16:30', '7.5', 'Sonntag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '5', '2008', '-', '-', ''),
('26.5.2008', '13:00', '16:30', '3.5', 'Montag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '5', '2008', '-', '-', ''),
('27.5.2008', '13:00', '16:30', '3.5', 'Dienstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '5', '2008', '-', '-', ''),
('28.5.2008', '13:00', '16:30', '3.5', 'Mittwoch', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('30.5.2008', '12:00', '16:30', '4.5', 'Freitag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Schmutteremeierova Karolina', 'schmuttermeierova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `schnaber`
-- 

CREATE TABLE `schnaber` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `schnaber`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `schneiderova`
-- 

CREATE TABLE `schneiderova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `schneiderova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `sekaninova`
-- 

CREATE TABLE `sekaninova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `sekaninova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `selecka`
-- 

CREATE TABLE `selecka` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `selecka`
-- 

INSERT INTO `selecka` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.03.2008', '08:00', '14:00', '6', 'Montag', '0', 'Selecka Martina', 'selecka', '', '03', '2008', '-', '-', ''),
('11.03.2008', '08:00', '14:00', '6', 'Dienstag', '0', 'Selecka Martina', 'selecka', '', '03', '2008', '-', '-', ''),
('12.03.2008', '08:00', '14:00', '6', 'Mittwoch', '0', 'Selecka Martina', 'selecka', '', '03', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('31.3.2008', '08:00', '16:00', '8', 'Montag', '0', 'Selecka Martina', 'selecka', '', '3', '2008', '-', '-', ''),
('1.4.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Selecka Martina', 'selecka', '', '4', '2008', '-', '-', ''),
('2.4.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Selecka Martina', 'selecka', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('7.4.2008', '08:00', '16:00', '8', 'Montag', '0', 'Selecka Martina', 'selecka', '', '4', '2008', '-', '-', ''),
('8.4.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Selecka Martina', 'selecka', '', '4', '2008', '-', '-', ''),
('9.4.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Selecka Martina', 'selecka', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('21.4.2008', '08:00', '16:00', '8', 'Montag', '0', 'Selecka Martina', 'selecka', '', '4', '2008', '-', '-', ''),
('22.4.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Selecka Martina', 'selecka', '', '4', '2008', '-', '-', ''),
('23.4.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Selecka Martina', 'selecka', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('5.5.2008', '08:00', '16:00', '8', 'Montag', '0', 'Selecka Martina', 'selecka', '', '5', '2008', '-', '-', ''),
('6.5.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Selecka Martina', 'selecka', '', '5', '2008', '-', '-', ''),
('7.5.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Selecka Martina', 'selecka', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('12.5.2008', '08:00', '16:00', '8', 'Montag', '0', 'Selecka Martina', 'selecka', '', '5', '2008', '-', '-', ''),
('13.5.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Selecka Martina', 'selecka', '', '5', '2008', '-', '-', ''),
('14.5.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Selecka Martina', 'selecka', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('19.5.2008', '08:00', '16:00', '8', 'Montag', '0', 'Selecka Martina', 'selecka', '', '5', '2008', '-', '-', ''),
('20.5.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Selecka Martina', 'selecka', '', '5', '2008', '-', '-', ''),
('21.5.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Selecka Martina', 'selecka', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('26.5.2008', '08:00', '18:00', '10', 'Montag', '0', 'Selecka Martina', 'selecka', '', '5', '2008', '-', '-', ''),
('27.5.2008', '08:00', '18:00', '10', 'Dienstag', '0', 'Selecka Martina', 'selecka', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('2.6.2008', '08:00', '16:00', '8', 'Montag', '1', 'Selecka Martina', 'selecka', '', '6', '2008', '-', '-', ''),
('3.6.2008', '08:00', '16:00', '8', 'Dienstag', '1', 'Selecka Martina', 'selecka', '', '6', '2008', '-', '-', ''),
('4.6.2008', '08:00', '16:00', '8', 'Mittwoch', '1', 'Selecka Martina', 'selecka', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '1', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '1', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '1', 'Selecka Martina', 'selecka', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', 'Selecka Martina', 'selecka', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `selingerova`
-- 

CREATE TABLE `selingerova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `selingerova`
-- 

INSERT INTO `selingerova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('-', '-', '-', '-', 'Montag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', NULL),
('11.3.2008', '14:00', '19:00', '5', 'Dienstag', '0', 'Selingerova Eva', 'selingerova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Mittwoch', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Freitag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', NULL),
('15.3.2008', '09:30', '14:30', '5', 'Samstag', '0', 'Selingerova Eva', 'selingerova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', NULL),
('17.3.2008', '14:00', '18:30', '4.5', 'Montag', '0', 'Selingerova Eva', 'selingerova', '', '3', '2008', '-', '-', ''),
('18.3.2008', '14:00', '19:30', '5.5', 'Dienstag', '0', 'Selingerova Eva', 'selingerova', '', '3', '2008', '-', '-', ''),
('19.3.2008', '14:00', '20:30', '6.5', 'Mittwoch', '0', 'Selingerova Eva', 'selingerova', '', '3', '2008', '-', '-', ''),
('20.3.2008', '06:30', '18:30', '12', 'Donnerstag', '0', 'Selingerova Eva', 'selingerova', '', '3', '2008', '-', '-', ''),
('21.3.2008', '08:00', '18:30', '10.5', 'Freitag', '0', 'Selingerova Eva', 'selingerova', '', '3', '2008', '-', '-', ''),
('22.3.2008', '09:30', '18:30', '9', 'Samstag', '0', 'Selingerova Eva', 'selingerova', '', '3', '2008', '-', '-', ''),
('23.3.2008', '09:30', '18:30', '9', 'Sonntag', '0', 'Selingerova Eva', 'selingerova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('25.3.2008', '14:00', '19:30', '5.5', 'Dienstag', '0', 'Selingerova Eva', 'selingerova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('14.4.2008', '15:30', '18:30', '3', 'Montag', '0', 'Selingerova Eva', 'selingerova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('16.4.2008', '14:00', '18:30', '4.5', 'Mittwoch', '0', 'Selingerova Eva', 'selingerova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('30.4.2008', '14:00', '18:30', '4.5', 'Mittwoch', '0', 'Selingerova Eva', 'selingerova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('2.5.2008', '07:00', '15:00', '8', 'Freitag', '0', 'Selingerova Eva', 'selingerova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('9.5.2008', '07:00', '17:30', '10.5', 'Freitag', '0', 'Selingerova Eva', 'selingerova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('13.5.2008', '14:00', '18:30', '4.5', 'Dienstag', '0', 'Selingerova Eva', 'selingerova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('16.5.2008', '14:00', '16:30', '2.5', 'Freitag', '0', 'Selingerova Eva', 'selingerova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('19.5.2008', '14:00', '18:30', '4.5', 'Montag', '0', 'Selingerova Eva', 'selingerova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('21.5.2008', '14:00', '18:30', '4.5', 'Mittwoch', '0', 'Selingerova Eva', 'selingerova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('23.5.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Selingerova Eva', 'selingerova', '', '5', '2008', '-', '-', ''),
('24.5.2008', '08:00', '14:30', '6.5', 'Samstag', '0', 'Selingerova Eva', 'selingerova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('26.5.2008', '13:00', '18:30', '5.5', 'Montag', '0', 'Selingerova Eva', 'selingerova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('29.5.2008', '13:00', '18:30', '5.5', 'Donnerstag', '0', 'Selingerova Eva', 'selingerova', '', '5', '2008', '-', '-', ''),
('30.5.2008', '14:00', '16:30', '2.5', 'Freitag', '0', 'Selingerova Eva', 'selingerova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('2.6.2008', '14:00', '18:30', '4.5', 'Montag', '1', 'Selingerova Eva', 'selingerova', '', '6', '2008', '-', '-', ''),
('3.6.2008', '14:00', '18:30', '4.5', 'Dienstag', '1', 'Selingerova Eva', 'selingerova', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '1', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('5.6.2008', '15:30', '18:30', '3', 'Donnerstag', '1', 'Selingerova Eva', 'selingerova', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '1', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '1', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', 'Selingerova Eva', 'selingerova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `sindelarova`
-- 

CREATE TABLE `sindelarova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `sindelarova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `skalska`
-- 

CREATE TABLE `skalska` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `skalska`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `slaba`
-- 

CREATE TABLE `slaba` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `slaba`
-- 

INSERT INTO `slaba` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '15:00', '21:00', '6', 'Montag', '0', 'Slaba Kamila', 'slaba', '', '3', '2008', '-', '-', NULL),
('11.3.2008', '14:00', '15:45', '1.75', 'Dienstag', '0', 'Slaba Kamila', 'slaba', '', '3', '2008', '-', '-', NULL),
('12.3.2008', '14:00', '19:00', '5', 'Mittwoch', '0', 'Slaba Kamila', 'slaba', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Freitag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', NULL),
('17.3.2008', '15:00', '20:00', '5', 'Montag', '0', 'Slaba Kamila', 'slaba', '', '3', '2008', '-', '-', ''),
('18.3.2008', '14:00', '19:00', '5', 'Dienstag', '0', 'Slaba Kamila', 'slaba', '', '3', '2008', '-', '-', ''),
('19.3.2008', '14:00', '15:45', '1.75', 'Mittwoch', '0', 'Slaba Kamila', 'slaba', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('25.3.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Slaba Kamila', 'slaba', '', '3', '2008', '-', '-', ''),
('26.3.2008', '14:00', '15:45', '1.75', 'Mittwoch', '0', 'Slaba Kamila', 'slaba', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('31.3.2008', '15:00', '20:00', '5', 'Montag', '0', 'Slaba Kamila', 'slaba', '', '3', '2008', '-', '-', ''),
('1.4.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Slaba Kamila', 'slaba', '', '4', '2008', '-', '-', ''),
('2.4.2008', '14:00', '15:45', '1.75', 'Mittwoch', '0', 'Slaba Kamila', 'slaba', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('7.4.2008', '15:00', '20:00', '5', 'Montag', '0', 'Slaba Kamila', 'slaba', '', '4', '2008', '-', '-', ''),
('8.4.2008', '14:00', '17:00', '3', 'Dienstag', '0', 'Slaba Kamila', 'slaba', '', '4', '2008', '-', '-', ''),
('9.4.2008', '13:45', '15:45', '2', 'Mittwoch', '0', 'Slaba Kamila', 'slaba', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('14.4.2008', '15:00', '20:00', '5', 'Montag', '0', 'Slaba Kamila', 'slaba', '', '4', '2008', '-', '-', ''),
('15.4.2008', '14:00', '20:00', '6', 'Dienstag', '0', 'Slaba Kamila', 'slaba', '', '4', '2008', '-', '-', ''),
('16.4.2008', '13:45', '15:45', '2', 'Mittwoch', '0', 'Slaba Kamila', 'slaba', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('22.4.2008', '14:00', '18:00', '4', 'Dienstag', '0', 'Slaba Kamila', 'slaba', '', '4', '2008', '-', '-', ''),
('23.4.2008', '14:00', '16:00', '2', 'Mittwoch', '0', 'Slaba Kamila', 'slaba', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('29.4.2008', '14:00', '20:00', '6', 'Dienstag', '0', 'Slaba Kamila', 'slaba', '', '4', '2008', '-', '-', ''),
('30.4.2008', '14:00', '18:00', '4', 'Mittwoch', '0', 'Slaba Kamila', 'slaba', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Slaba Kamila', 'slaba', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `sladkova`
-- 

CREATE TABLE `sladkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `sladkova`
-- 

INSERT INTO `sladkova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '10:00', '15:00', '5', 'Montag', '0', 'Sladkova Michaela', 'sladkova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Dienstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Mittwoch', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Freitag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Montag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('19.3.2008', '08:30', '14:30', '6', 'Mittwoch', '0', 'Sladkova Michaela', 'sladkova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('31.3.2008', '10:00', '15:00', '5', 'Montag', '0', 'Sladkova Michaela', 'sladkova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('7.4.2008', '10:00', '15:00', '5', 'Montag', '0', 'Sladkova Michaela', 'sladkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('9.4.2008', '08:30', '14:30', '6', 'Mittwoch', '0', 'Sladkova Michaela', 'sladkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('12.4.2008', '09:00', '17:00', '8', 'Samstag', '0', 'Sladkova Michaela', 'sladkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('16.4.2008', '08:30', '14:30', '6', 'Mittwoch', '0', 'Sladkova Michaela', 'sladkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('21.4.2008', '08:00', '16:00', '8', 'Montag', '0', 'Sladkova Michaela', 'sladkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('1.5.2008', '07:45', '15:45', '8', 'Donnerstag', '0', 'Sladkova Michaela', 'sladkova', '', '5', '2008', '-', '-', ''),
('2.5.2008', '07:45', '15:45', '8', 'Freitag', '0', 'Sladkova Michaela', 'sladkova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('12.5.2008', '10:00', '15:00', '5', 'Montag', '0', 'Sladkova Michaela', 'sladkova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('21.52008', '07:00', '15:00', '8', 'Mittwoch', '0', 'Sladkova Michaela', 'sladkova', '', '52', '', '-', '-', ''),
('22.5.2008', '07:00', '15:00', '8', 'Donnerstag', '0', 'Sladkova Michaela', 'sladkova', '', '5', '2008', '-', '-', ''),
('23.5.2008', '07:00', '15:00', '8', 'Freitag', '0', 'Sladkova Michaela', 'sladkova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('21.5.2008', '07:00', '15:00', '8', 'Mittwoch', '0', 'Sladkova Michaela', 'sladkova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sladkova Michaela', 'sladkova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `slavikova`
-- 

CREATE TABLE `slavikova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `slavikova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `smejkalova`
-- 

CREATE TABLE `smejkalova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `smejkalova`
-- 

INSERT INTO `smejkalova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '16:00', '18:30', '2.5', 'Montag', '0', 'Smejkalova Eliska', 'smejkalova', '', '3', '2008', '-', '-', NULL),
('11.3.2008', '16:00', '18:30', '2.5', 'Dienstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Mittwoch', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Freitag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', NULL),
('15.3.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '3', '2008', '-', '-', NULL),
('16.3.2008', '08:00', '16:00', '8', 'Sonntag', '0', 'Smejkalova Eliska', 'smejkalova', '', '3', '2008', '-', '-', NULL),
('17.3.2008', '16:00', '18:30', '2.5', 'Montag', '0', 'Smejkalova Eliska', 'smejkalova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('20.3.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '3', '2008', '-', '-', ''),
('21.3.2008', '08:00', '18:30', '10.5', 'Freitag', '0', 'Smejkalova Eliska', 'smejkalova', '', '3', '2008', '-', '-', ''),
('22.3.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('24.3.2008', '08:00', '16:00', '8', 'Montag', '0', 'Smejkalova Eliska', 'smejkalova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('27.3.2008', '13:30', '16:30', '3', 'Donnerstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '3', '2008', '-', '-', ''),
('28.3.2008', '14:00', '16:30', '2.5', 'Freitag', '0', 'Smejkalova Eliska', 'smejkalova', '', '3', '2008', '-', '-', ''),
('29.3.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '3', '2008', '-', '-', ''),
('30.3.2008', '08:00', '16:00', '8', 'Sonntag', '0', 'Smejkalova Eliska', 'smejkalova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('3.4.2008', '13:30', '16:30', '3', 'Donnerstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('4.4.2008', '13:00', '16:30', '3.5', 'Freitag', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('5.4.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('6.4.2008', '08:00', '15:00', '7', 'Sonntag', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('10.4.2008', '13:30', '17:00', '3.5', 'Donnerstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('11.4.2008', '14:00', '16:30', '2.5', 'Freitag', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('12.4.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('13.4.2008', '08:00', '15:00', '7', 'Sonntag', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('18.4.2008', '14:00', '16:30', '2.5', 'Freitag', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('19.4.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('20.4.2008', '08:00', '15:00', '7', 'Sonntag', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('21.4.2008', '08:00', '17:00', '9', 'Montag', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('23.4.2008', '16:00', '18:30', '2.5', 'Mittwoch', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('24.4.2008', '13:30', '17:00', '3.5', 'Donnerstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('25.4.2008', '14:00', '16:30', '2.5', 'Freitag', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('26.4.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('1.5.2008', '13:30', '18:30', '5', 'Donnerstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('2.5.2008', '12:30', '18:30', '6', 'Freitag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('3.5.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('4.5.2008', '08:00', '15:00', '7', 'Sonntag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('7.5.2008', '08:00', '14:00', '6', 'Mittwoch', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('8.5.2008', '08:00', '14:30', '6.5', 'Donnerstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('9.5.2008', '08:00', '17:00', '9', 'Freitag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('10.5.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('13.5.2008', '08:00', '15:30', '7.5', 'Dienstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('15.5.2008', '08:00', '17:00', '9', 'Donnerstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('16.5.2008', '08:00', '17:00', '9', 'Freitag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('17.5.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('22.5.2008', '13:30', '17:00', '3.5', 'Donnerstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('23.5.2008', '14:00', '18:30', '4.5', 'Freitag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('24.5.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('25.5.2008', '08:00', '15:00', '7', 'Sonntag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', ''),
('31.5.2008', '08:00', '15:00', '7', 'Samstag', '0', 'Smejkalova Eliska', 'smejkalova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Smejkalova Eliska', 'smejkalova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `smejkalovasvetlana`
-- 

CREATE TABLE `smejkalovasvetlana` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `smejkalovasvetlana`
-- 

INSERT INTO `smejkalovasvetlana` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '08:00', '15:00', '7', 'Montag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '3', '2008', '-', '-', NULL),
('11.3.2008', '08:00', '15:00', '7', 'Dienstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '3', '2008', '-', '-', NULL),
('12.3.2008', '08:00', '15:00', '7', 'Mittwoch', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '3', '2008', '-', '-', NULL),
('13.3.2008', '08:00', '15:00', '7', 'Donnerstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '3', '2008', '-', '-', NULL),
('14.3.2008', '08:00', '15:00', '7', 'Freitag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '', '', '-', '-', NULL),
('17.3.2008', '08:00', '15:00', '7', 'Montag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '3', '2008', '-', '-', ''),
('18.3.2008', '08:00', '15:00', '7', 'Dienstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '3', '2008', '-', '-', ''),
('19.3.2008', '08:00', '15:00', '7', 'Mittwoch', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '3', '2008', '-', '-', ''),
('20.3.2008', '08:00', '15:00', '7', 'Donnerstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '3', '2008', '-', '-', ''),
('21.3.2008', '08:00', '15:00', '7', 'Freitag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '', '', '-', '-', ''),
('25.3.2008', '08:00', '15:00', '7', 'Dienstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '3', '2008', '-', '-', ''),
('26.3.2008', '08:00', '15:00', '7', 'Mittwoch', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '3', '2008', '-', '-', ''),
('27.3.2008', '08:00', '15:00', '7', 'Donnerstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '3', '2008', '-', '-', ''),
('28.3.2008', '08:00', '15:00', '7', 'Freitag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '', '', '-', '-', ''),
('7.4.2008', '08:00', '15:00', '7', 'Montag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '4', '2008', '-', '-', ''),
('8.4.2008', '08:00', '15:00', '7', 'Dienstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '4', '2008', '-', '-', ''),
('9.4.2008', '08:00', '15:00', '7', 'Mittwoch', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '4', '2008', '-', '-', ''),
('10.4.2008', '08:00', '15:00', '7', 'Donnerstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '4', '2008', '-', '-', ''),
('11.4.2008', '08:00', '15:00', '7', 'Freitag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '', '', '-', '-', ''),
('14.4.2008', '08:00', '15:00', '7', 'Montag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '4', '2008', '-', '-', ''),
('15.4.2008', '08:00', '15:00', '7', 'Dienstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '4', '2008', '-', '-', ''),
('16.4.2008', '08:00', '15:00', '7', 'Mittwoch', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '4', '2008', '-', '-', ''),
('17.4.2008', '08:00', '15:00', '7', 'Donnerstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '4', '2008', '-', '-', ''),
('18.4.2008', '08:00', '15:00', '7', 'Freitag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '', '', '-', '-', ''),
('21.4.2008', '08:00', '15:00', '7', 'Montag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '4', '2008', '-', '-', ''),
('22.4.2008', '08:00', '15:00', '7', 'Dienstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '4', '2008', '-', '-', ''),
('23.4.2008', '08:00', '15:00', '7', 'Mittwoch', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '4', '2008', '-', '-', ''),
('24.4.2008', '08:00', '15:00', '7', 'Donnerstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '4', '2008', '-', '-', ''),
('25.4.2008', '08:00', '15:00', '7', 'Freitag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Smejkalova Svetlana', 'smejkalovasvetlana', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `smrckova`
-- 

CREATE TABLE `smrckova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `smrckova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `sofkova`
-- 

CREATE TABLE `sofkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `sofkova`
-- 

INSERT INTO `sofkova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.03.2008', '08:00', '12:00', '4', 'Montag', '0', 'Sofkova Gabriela', 'sofkova', '', '03', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Sofkova Gabriela', 'sofkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Sofkova Gabriela', 'sofkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Sofkova Gabriela', 'sofkova', '', '', '', '-', '-', ''),
('14.03.2008', '08:00', '12:00', '4', 'Freitag', '0', 'Sofkova Gabriela', 'sofkova', '', '03', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sofkova Gabriela', 'sofkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sofkova Gabriela', 'sofkova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `sousedikova`
-- 

CREATE TABLE `sousedikova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `sousedikova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `stanicka`
-- 

CREATE TABLE `stanicka` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `stanicka`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `stankova`
-- 

CREATE TABLE `stankova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `stankova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `stavikova`
-- 

CREATE TABLE `stavikova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `stavikova`
-- 

INSERT INTO `stavikova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('-', '-', '-', '-', 'Montag', '0', 'Stavikova Svatava', 'stavikova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Dienstag', '0', 'Stavikova Svatava', 'stavikova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Mittwoch', '0', 'Stavikova Svatava', 'stavikova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Stavikova Svatava', 'stavikova', '', '', '', '-', '-', NULL),
('14.3.2008', '16:00', '18:00', '2', 'Freitag', '0', 'Stavikova Svatava', 'stavikova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Samstag', '0', 'Stavikova Svatava', 'stavikova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Stavikova Svatava', 'stavikova', '', '', '', '-', '-', NULL),
('7.4.2008', '17:30', '18:30', '1', 'Montag', '0', 'Stavikova Svatava', 'stavikova', '', '4', '2008', '-', '-', ''),
('8.4.2008', '15:30', '17:30', '2', 'Dienstag', '0', 'Stavikova Svatava', 'stavikova', '', '4', '2008', '-', '-', ''),
('9.4.2008', '15:30', '17:30', '2', 'Mittwoch', '0', 'Stavikova Svatava', 'stavikova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Stavikova Svatava', 'stavikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Stavikova Svatava', 'stavikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Stavikova Svatava', 'stavikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Stavikova Svatava', 'stavikova', '', '', '', '-', '-', ''),
('14.4.2008', '17:30', '19:00', '1.5', 'Montag', '0', 'Stavikova Svatava', 'stavikova', '', '4', '2008', '-', '-', ''),
('15.4.2008', '18:00', '19:00', '1', 'Dienstag', '0', 'Stavikova Svatava', 'stavikova', '', '4', '2008', '-', '-', ''),
('16.4.2008', '16:30', '18:30', '2', 'Mittwoch', '0', 'Stavikova Svatava', 'stavikova', '', '4', '2008', '-', '-', ''),
('17.4.2008', '15:30', '17:30', '2', 'Donnerstag', '0', 'Stavikova Svatava', 'stavikova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Stavikova Svatava', 'stavikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Stavikova Svatava', 'stavikova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Stavikova Svatava', 'stavikova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `stepanek`
-- 

CREATE TABLE `stepanek` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `stepanek`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `stetinova`
-- 

CREATE TABLE `stetinova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `stetinova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `subrt`
-- 

CREATE TABLE `subrt` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `subrt`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `suchannova`
-- 

CREATE TABLE `suchannova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `suchannova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `svabova`
-- 

CREATE TABLE `svabova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `svabova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `svajda`
-- 

CREATE TABLE `svajda` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `svajda`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `svobodova`
-- 

CREATE TABLE `svobodova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `svobodova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `sykorova`
-- 

CREATE TABLE `sykorova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `sykorova`
-- 

INSERT INTO `sykorova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('-', '-', '-', '-', 'Montag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('27.3.2008', '13:30', '17:00', '3.5', 'Donnerstag', '0', 'Sykorova Katerina', 'sykorova', '', '3', '2008', '-', '-', ''),
('28.3.2008', '13:00', '17:00', '4', 'Freitag', '0', 'Sykorova Katerina', 'sykorova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('10.4.2008', '13:30', '17:00', '3.5', 'Donnerstag', '0', 'Sykorova Katerina', 'sykorova', '', '4', '2008', '-', '-', ''),
('11.4.2008', '13:00', '17:00', '4', 'Freitag', '0', 'Sykorova Katerina', 'sykorova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('17.4.2008', '13:30', '17:00', '3.5', 'Donnerstag', '0', 'Sykorova Katerina', 'sykorova', '', '4', '2008', '-', '-', ''),
('18.4.2008', '13:00', '17:00', '4', 'Freitag', '0', 'Sykorova Katerina', 'sykorova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('21.4.2008', '10:00', '14:00', '4', 'Montag', '0', 'Sykorova Katerina', 'sykorova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('24.4.2008', '13:30', '17:00', '3.5', 'Donnerstag', '0', 'Sykorova Katerina', 'sykorova', '', '4', '2008', '-', '-', ''),
('25.4.2008', '13:00', '17:00', '4', 'Freitag', '0', 'Sykorova Katerina', 'sykorova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('2.5.2008', '09:00', '17:00', '8', 'Freitag', '0', 'Sykorova Katerina', 'sykorova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('20.5.2008', '13:00', '17:00', '4', 'Dienstag', '0', 'Sykorova Katerina', 'sykorova', '', '5', '2008', '-', '-', ''),
('21.5.2008', '13:00', '17:00', '4', 'Mittwoch', '0', 'Sykorova Katerina', 'sykorova', '', '5', '2008', '-', '-', ''),
('22.5.2008', '13:00', '17:00', '4', 'Donnerstag', '0', 'Sykorova Katerina', 'sykorova', '', '5', '2008', '-', '-', ''),
('23.5.2008', '13:00', '17:00', '4', 'Freitag', '0', 'Sykorova Katerina', 'sykorova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('27.5.2008', '13:00', '17:00', '4', 'Dienstag', '0', 'Sykorova Katerina', 'sykorova', '', '5', '2008', '-', '-', ''),
('28.5.2008', '12:00', '17:00', '5', 'Mittwoch', '0', 'Sykorova Katerina', 'sykorova', '', '5', '2008', '-', '-', ''),
('29.5.2008', '13:00', '15:30', '2.5', 'Donnerstag', '0', 'Sykorova Katerina', 'sykorova', '', '5', '2008', '-', '-', ''),
('30.5.2008', '13:00', '17:00', '4', 'Freitag', '0', 'Sykorova Katerina', 'sykorova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '1', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '1', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '1', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('5.6.2008', '13:00', '17:00', '4', 'Donnerstag', '1', 'Sykorova Katerina', 'sykorova', '', '6', '2008', '-', '-', ''),
('6.6.2008', '13:00', '17:00', '4', 'Freitag', '1', 'Sykorova Katerina', 'sykorova', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '1', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', 'Sykorova Katerina', 'sykorova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `tomankova`
-- 

CREATE TABLE `tomankova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `tomankova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `tomkova`
-- 

CREATE TABLE `tomkova` (
  `datum` varchar(10) collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) collate cp1250_czech_cs default NULL,
  `im` varchar(2) collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1250 COLLATE=cp1250_czech_cs;

-- 
-- Vypisuji data pro tabulku `tomkova`
-- 

INSERT INTO `tomkova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('-', '-', '-', '-', 'Montag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Dienstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Mittwoch', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Freitag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', NULL),
('15.3.2008', '08:00', '18:00', '10', 'Samstag', '0', 'Tomkova Michaela', 'tomkova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', NULL),
('17.3.2008', '16:15', '19:00', '2.75', 'Montag', '0', 'Tomkova Michaela', 'tomkova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('20.3.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Tomkova Michaela', 'tomkova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('27.3.2008', '14:00', '17:30', '3.5', 'Donnerstag', '0', 'Tomkova Michaela', 'tomkova', '', '3', '2008', '-', '-', ''),
('28.3.2008', '14:00', '17:30', '3.5', 'Freitag', '0', 'Tomkova Michaela', 'tomkova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('31.3.2008', '16:15', '19:15', '3', 'Montag', '0', 'Tomkova Michaela', 'tomkova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('3.4.2008', '14:00', '16:30', '2.5', 'Donnerstag', '0', 'Tomkova Michaela', 'tomkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('5.4.2008', '08:00', '18:00', '10', 'Samstag', '0', 'Tomkova Michaela', 'tomkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('7.4.2008', '16:15', '19:15', '3', 'Montag', '0', 'Tomkova Michaela', 'tomkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('10.4.2008', '14:00', '16:30', '2.5', 'Donnerstag', '0', 'Tomkova Michaela', 'tomkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('12.4.2008', '08:00', '18:00', '10', 'Samstag', '0', 'Tomkova Michaela', 'tomkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('14.4.2008', '14:45', '17:30', '2.75', 'Montag', '0', 'Tomkova Michaela', 'tomkova', '', '4', '2008', '-', '-', ''),
('15.4.2008', '14:00', '17:30', '3.5', 'Dienstag', '0', 'Tomkova Michaela', 'tomkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('17.4.2008', '14:00', '16:30', '2.5', 'Donnerstag', '0', 'Tomkova Michaela', 'tomkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('21.4.2008', '8:00', '16:30', '8.5', 'Montag', '0', 'Tomkova Michaela', 'tomkova', '', '4', '2008', '-', '-', ''),
('22.4.2008', '14:00', '16:30', '2.5', 'Dienstag', '0', 'Tomkova Michaela', 'tomkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('24.4.2008', '14:00', '16:30', '2.5', 'Donnerstag', '0', 'Tomkova Michaela', 'tomkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('29.4.2008', '14:00', '16:30', '2.5', 'Dienstag', '0', 'Tomkova Michaela', 'tomkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('1.5.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Tomkova Michaela', 'tomkova', '', '5', '2008', '-', '-', ''),
('2.5.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Tomkova Michaela', 'tomkova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('5.5.2008', '16:15', '19:15', '3', 'Montag', '0', 'Tomkova Michaela', 'tomkova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('8.5.2008', '14:00', '16:00', '2', 'Donnerstag', '0', 'Tomkova Michaela', 'tomkova', '', '5', '2008', '-', '-', ''),
('9.5.2008', '08:00', '16:30', '8.5', 'Freitag', '0', 'Tomkova Michaela', 'tomkova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('16.5.2008', '18:00', '20:00', '2', 'Freitag', '0', 'Tomkova Michaela', 'tomkova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('19.5.2008', '13:00', '16:30', '3.5', 'Montag', '0', 'Tomkova Michaela', 'tomkova', '', '5', '2008', '-', '-', ''),
('20.5.2008', '13:00', '17:30', '4.5', 'Dienstag', '0', 'Tomkova Michaela', 'tomkova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('22.5.2008', '14:00', '16:00', '2', 'Donnerstag', '0', 'Tomkova Michaela', 'tomkova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('24.5.2008', '07:50', '14:50', '7', 'Samstag', '0', 'Tomkova Michaela', 'tomkova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('26.5.2008', '13:00', '16:30', '3.5', 'Montag', '0', 'Tomkova Michaela', 'tomkova', '', '5', '2008', '-', '-', ''),
('27.5.2008', '-', '-', '-', 'Dienstag', '0', 'Tomkova Michaela', 'tomkova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('29.5.2008', '13:00', '16:30', '5.5', 'Donnerstag', '0', 'Tomkova Michaela', 'tomkova', '', '5', '2008', '18:00', '20:00', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '1', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '1', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '1', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('5.6.2008', '14:00', '16:00', '2', 'Donnerstag', '1', 'Tomkova Michaela', 'tomkova', '', '6', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '1', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '1', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '1', 'Tomkova Michaela', 'tomkova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `travnickova`
-- 

CREATE TABLE `travnickova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `travnickova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `trombik`
-- 

CREATE TABLE `trombik` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `trombik`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `trundova`
-- 

CREATE TABLE `trundova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `trundova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `trupp`
-- 

CREATE TABLE `trupp` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `trupp`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `tunkova`
-- 

CREATE TABLE `tunkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `tunkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `uhlir`
-- 

CREATE TABLE `uhlir` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `uhlir`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `urbankova`
-- 

CREATE TABLE `urbankova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `urbankova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `vachulova`
-- 

CREATE TABLE `vachulova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `vachulova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `valentova`
-- 

CREATE TABLE `valentova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `valentova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `valentovaeva`
-- 

CREATE TABLE `valentovaeva` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `valentovaeva`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `vanickova`
-- 

CREATE TABLE `vanickova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `vanickova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `vankova`
-- 

CREATE TABLE `vankova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `vankova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `vankovakristyna`
-- 

CREATE TABLE `vankovakristyna` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `vankovakristyna`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `vasatkova`
-- 

CREATE TABLE `vasatkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `vasatkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `venclikova`
-- 

CREATE TABLE `venclikova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `venclikova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `vesela`
-- 

CREATE TABLE `vesela` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `vesela`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `veselasimona`
-- 

CREATE TABLE `veselasimona` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `veselasimona`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `veselatereza`
-- 

CREATE TABLE `veselatereza` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `veselatereza`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `vlckova`
-- 

CREATE TABLE `vlckova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `vlckova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `vymola`
-- 

CREATE TABLE `vymola` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `vymola`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `vytvar`
-- 

CREATE TABLE `vytvar` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `vytvar`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `vzkazy`
-- 

CREATE TABLE `vzkazy` (
  `datum` varchar(20) collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(50) collate cp1250_czech_cs NOT NULL,
  `vzkaz` varchar(255) collate cp1250_czech_cs NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `precteno` varchar(1) collate cp1250_czech_cs NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1250 COLLATE=cp1250_czech_cs AUTO_INCREMENT=2 ;

-- 
-- Vypisuji data pro tabulku `vzkazy`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `walova`
-- 

CREATE TABLE `walova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `walova`
-- 

INSERT INTO `walova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '15:00', '17:00', '2', 'Montag', '0', 'Walova Zuzana', 'walova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Dienstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Mittwoch', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', NULL),
('-', '-', '-', '-', 'Donnerstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', NULL),
('14.3.2008', '14:00', '20:00', '6', 'Freitag', '0', 'Walova Zuzana', 'walova', '', '3', '2008', '-', '-', NULL),
('15.3.2008', '09:00', '14:30', '5.5', 'Samstag', '0', 'Walova Zuzana', 'walova', '', '3', '2008', '-', '-', NULL),
('-', '-', '-', '-', 'Sonntag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', NULL),
('17.3.2008', '15:00', '19:00', '4', 'Montag', '0', 'Walova Zuzana', 'walova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('19.3.2008', '15:00', '21:00', '6', 'Mittwoch', '0', 'Walova Zuzana', 'walova', '', '3', '2008', '-', '-', ''),
('20.3.2008', '08:00', '20:00', '12', 'Donnerstag', '0', 'Walova Zuzana', 'walova', '', '3', '2008', '-', '-', ''),
('21.3.2008', '09:00', '18:30', '9.5', 'Freitag', '0', 'Walova Zuzana', 'walova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('26.3.2008', '15:00', '17:00', '2', 'Mittwoch', '0', 'Walova Zuzana', 'walova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('31.3.2008', '15:00', '17:00', '2', 'Montag', '0', 'Walova Zuzana', 'walova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('3.4.2008', '16:30', '18:30', '2', 'Donnerstag', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('7.4.2008', '15:00', '18:00', '3', 'Montag', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('9.4.2008', '15:00', '17:00', '2', 'Mittwoch', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('10.4.2008', '16:00', '19:00', '3', 'Donnerstag', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('11.4.2008', '14:00', '20:00', '6', 'Freitag', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('12.4.2008', '10:00', '18:30', '8.5', 'Samstag', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('14.4.2008', '15:00', '17:00', '2', 'Montag', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('16.4.2008', '15:00', '18:00', '3', 'Mittwoch', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('17.4.2008', '16:30', '18:30', '2', 'Donnerstag', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('18.4.2008', '14:00', '20:00', '6', 'Freitag', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('19.4.2008', '15:00', '20:00', '5', 'Samstag', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('20.4.2008', '10:00', '19:00', '9', 'Sonntag', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('21.4.2008', '09:00', '17:00', '8', 'Montag', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('23.4.2008', '15:00', '18:00', '3', 'Mittwoch', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('24.4.2008', '16:00', '17:30', '1.5', 'Donnerstag', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('30.4.2008', '15:00', '20:00', '5', 'Mittwoch', '0', 'Walova Zuzana', 'walova', '', '4', '2008', '-', '-', ''),
('1.5.2008', '10:00', '20:00', '10', 'Donnerstag', '0', 'Walova Zuzana', 'walova', '', '5', '2008', '-', '-', ''),
('2.5.2008', '10:00', '18:00', '8', 'Freitag', '0', 'Walova Zuzana', 'walova', '', '5', '2008', '-', '-', ''),
('3.5.2008', '12:00', '20:00', '8', 'Samstag', '0', 'Walova Zuzana', 'walova', '', '5', '2008', '-', '-', ''),
('4.5.2008', '10:00', '17:00', '7', 'Sonntag', '0', 'Walova Zuzana', 'walova', '', '5', '2008', '-', '-', ''),
('5.5.2008', '15:00', '17:00', '2', 'Montag', '0', 'Walova Zuzana', 'walova', '', '5', '2008', '-', '-', ''),
('6.5.2008', '13:00', '19:00', '6', 'Dienstag', '0', 'Walova Zuzana', 'walova', '', '5', '2008', '-', '-', ''),
('7.5.2008', '09:00', '19:00', '10', 'Mittwoch', '0', 'Walova Zuzana', 'walova', '', '5', '2008', '-', '-', ''),
('8.5.2008', '08:00', '16:30', '8.5', 'Donnerstag', '0', 'Walova Zuzana', 'walova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('12.5.2008', '15:00', '20:00', '5', 'Montag', '0', 'Walova Zuzana', 'walova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Walova Zuzana', 'walova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `zabranska`
-- 

CREATE TABLE `zabranska` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `zabranska`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `zaverkova`
-- 

CREATE TABLE `zaverkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs default NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs default NULL,
  `zacatek2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `zaverkova`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `zerzankova`
-- 

CREATE TABLE `zerzankova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `zerzankova`
-- 

INSERT INTO `zerzankova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('10.3.2008', '17:00', '21:00', '4', 'Montag', '0', 'Zerzankova Aneta', 'zerzankova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('15.3.2008', '15:00', '21:00', '6', 'Freitag', '0', 'Zerzankova Aneta', 'zerzankova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('31.3.2008', '17:00', '20:00', '3', 'Montag', '0', 'Zerzankova Aneta', 'zerzankova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('4.4.2008', '15:00', '21:00', '6', 'Freitag', '0', 'Zerzankova Aneta', 'zerzankova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('9.4.2008', '17:00', '21:00', '4', 'Mittwoch', '0', 'Zerzankova Aneta', 'zerzankova', '', '4', '2008', '-', '-', ''),
('10.4.2008', '15:00', '18:00', '3', 'Donnerstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('14.4.2008', '17:00', '19:00', '2', 'Montag', '0', 'Zerzankova Aneta', 'zerzankova', '', '4', '2008', '-', '-', ''),
('15.4.2008', '18:00', '19:00', '1', 'Dienstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '4', '2008', '-', '-', ''),
('16.4.2008', '16:30', '18:30', '2', 'Mittwoch', '0', 'Zerzankova Aneta', 'zerzankova', '', '4', '2008', '-', '-', ''),
('17.4.2008', '15:30', '17:30', '2', 'Donnerstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('21.4.2008', '17:00', '21:00', '4', 'Montag', '0', 'Zerzankova Aneta', 'zerzankova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('23.4.2008', '17:00', '21:00', '4', 'Mittwoch', '0', 'Zerzankova Aneta', 'zerzankova', '', '4', '2008', '-', '-', ''),
('24.4.2008', '15:00', '18:00', '3', 'Donnerstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('30.4.2008', '17:00', '21:00', '4', 'Mittwoch', '0', 'Zerzankova Aneta', 'zerzankova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Donnerstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Dienstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('15.5.2008', '17:00', '21:00', '4', 'Donnerstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Freitag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Zerzankova Aneta', 'zerzankova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `zitkova`
-- 

CREATE TABLE `zitkova` (
  `datum` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `pocet` varchar(20) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `den` varchar(10) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ia` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijmeni_jmeno` varchar(40) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `jmeno` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt` varchar(255) character set cp1250 collate cp1250_czech_cs default NULL,
  `im` varchar(2) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `ir` varchar(4) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `zacatek2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `konec2` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `projekt2` varchar(50) character set cp1250 collate cp1250_czech_cs default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `zitkova`
-- 

INSERT INTO `zitkova` (`datum`, `zacatek`, `konec`, `pocet`, `den`, `ia`, `prijmeni_jmeno`, `jmeno`, `projekt`, `im`, `ir`, `zacatek2`, `konec2`, `projekt2`) VALUES 
('21.3.2008', '08:00', '16:00', '8', 'Freitag', '0', 'Zitkova Martina', 'zitkova', '', '3', '2008', '-', '-', ''),
('20.3.2008', '08:00', '16:00', '8', 'Donnerstag', '0', 'Zitkova Martina', 'zitkova', '', '3', '2008', '-', '-', ''),
('19.3.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Zitkova Martina', 'zitkova', '', '3', '2008', '-', '-', ''),
('18.3.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Zitkova Martina', 'zitkova', '', '3', '2008', '-', '-', ''),
('17.3.2008', '08:00', '16:00', '8', 'Montag', '0', 'Zitkova Martina', 'zitkova', '', '3', '2008', '-', '-', ''),
('10.3.2008', '08:00', '16:00', '8', 'Montag', '0', 'Zitkova Martina', 'zitkova', '', '3', '2008', '-', '-', ''),
('11.3.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Zitkova Martina', 'zitkova', '', '3', '2008', '-', '-', ''),
('12.3.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Zitkova Martina', 'zitkova', '', '3', '2008', '-', '-', ''),
('13.3.2008', '08:00', '16:00', '8', 'Donnerstag', '0', 'Zitkova Martina', 'zitkova', '', '3', '2008', '-', '-', ''),
('14.3.2008', '08:00', '16:00', '8', 'Freitag', '0', 'Zitkova Martina', 'zitkova', '', '3', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Zitkova Martina', 'zitkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Zitkova Martina', 'zitkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Zitkova Martina', 'zitkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Zitkova Martina', 'zitkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Montag', '0', 'Zitkova Martina', 'zitkova', '', '', '', '-', '-', ''),
('22.4.2008', '08:00', '17:00', '9', 'Dienstag', '0', 'Zitkova Martina', 'zitkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Mittwoch', '0', 'Zitkova Martina', 'zitkova', '', '', '', '-', '-', ''),
('24.4.2008', '09:00', '17:00', '8', 'Donnerstag', '0', 'Zitkova Martina', 'zitkova', '', '4', '2008', '-', '-', ''),
('25.4.2008', '08:00', '16:00', '8', 'Freitag', '0', 'Zitkova Martina', 'zitkova', '', '4', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Zitkova Martina', 'zitkova', '', '', '', '-', '-', ''),
('27.4.2008', '08:00', '16:00', '8', 'Sonntag', '0', 'Zitkova Martina', 'zitkova', '', '4', '2008', '-', '-', ''),
('28.4.2008', '08:00', '16:00', '8', 'Montag', '0', 'Zitkova Martina', 'zitkova', '', '4', '2008', '-', '-', ''),
('29.4.2008', '08:00', '16:00', '8', 'Dienstag', '0', 'Zitkova Martina', 'zitkova', '', '4', '2008', '-', '-', ''),
('30.4.2008', '08:00', '16:00', '8', 'Mittwoch', '0', 'Zitkova Martina', 'zitkova', '', '4', '2008', '-', '-', ''),
('1.5.2008', '08:00', '16:00', '8', 'Donnerstag', '0', 'Zitkova Martina', 'zitkova', '', '5', '2008', '-', '-', ''),
('2.5.2008', '08:00', '16:00', '8', 'Freitag', '0', 'Zitkova Martina', 'zitkova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Zitkova Martina', 'zitkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Zitkova Martina', 'zitkova', '', '', '', '-', '-', ''),
('12.5.2008', '09:00', '17:00', '8', 'Montag', '0', 'Zitkova Martina', 'zitkova', '', '5', '2008', '-', '-', ''),
('13.5.2008', '09:00', '17:00', '8', 'Dienstag', '0', 'Zitkova Martina', 'zitkova', '', '5', '2008', '-', '-', ''),
('14.5.2008', '09:00', '17:00', '8', 'Mittwoch', '0', 'Zitkova Martina', 'zitkova', '', '5', '2008', '-', '-', ''),
('15.5.2008', '09:00', '17:00', '8', 'Donnerstag', '0', 'Zitkova Martina', 'zitkova', '', '5', '2008', '-', '-', ''),
('16.5.2008', '09:00', '17:00', '8', 'Freitag', '0', 'Zitkova Martina', 'zitkova', '', '5', '2008', '-', '-', ''),
('-', '-', '-', '-', 'Samstag', '0', 'Zitkova Martina', 'zitkova', '', '', '', '-', '-', ''),
('-', '-', '-', '-', 'Sonntag', '0', 'Zitkova Martina', 'zitkova', '', '', '', '-', '-', '');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `zpravy`
-- 

CREATE TABLE `zpravy` (
  `id` int(255) NOT NULL auto_increment,
  `datum` varchar(30) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `odesilatel` varchar(50) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `prijemce` varchar(50) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `text` varchar(255) character set cp1250 collate cp1250_czech_cs NOT NULL,
  `precteno` varchar(1) character set cp1250 collate cp1250_czech_cs NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=10 ;

-- 
-- Vypisuji data pro tabulku `zpravy`
-- 

INSERT INTO `zpravy` (`id`, `datum`, `odesilatel`, `prijemce`, `text`, `precteno`) VALUES 
(8, '12.03.2008-9:50', 'glac', 'benesova', 'Volany ucastnik je docasne nedostupny, volani prosim neopakujte...', '1'),
(9, '12.03.2008-9:50', 'glac', 'benesova', 'Volany ucastnik je docasne nedostupny, volani prosim neopakujte...', '1');
