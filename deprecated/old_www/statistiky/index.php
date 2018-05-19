<?php
print "<img src=\"{$_SERVER['PHP_SELF']}?=".zend_logo_guid()."\" alt=\"Zend Logo !\" />";
print "<img src=\"{$_SERVER['PHP_SELF']}?=".php_logo_guid()."\" alt=\"PHP Logo !\" />";


//LAST_INSERT_ID(21)


/*
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1:3305
-- Vygenerováno: Pátek 30. května 2008, 18:51
-- Verze MySQL: 5.0.51
-- Verze PHP: 4.4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Databáze: `gfdesign-cz`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `dvd`
--

CREATE TABLE `dvd` (
  `iddvd` int(11) NOT NULL auto_increment,
  `idkategorie` int(11) default NULL,
  `idmedium` int(11) default NULL,
  `nazev` varchar(200) collate utf8_czech_ci default NULL,
  `komentar` varchar(300) collate utf8_czech_ci default NULL,
  `pocet` int(11) default NULL,
  `cas` int(11) default NULL,
  `datum` int(11) default NULL,
  PRIMARY KEY  (`iddvd`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=27 ;

--
-- Vypisuji data pro tabulku `dvd`
--

INSERT INTO `dvd` VALUES(1, 1, 1, 'Sherlock Holmes  5', 'Strakatý pás, Modrá karbunkule, s titulkama', 1, 1212086640, 1212079440);
INSERT INTO `dvd` VALUES(2, 2, 1, 'Báječní muži s klikou', 'počátky kinematografie', 1, 1212091744, 1212084544);
INSERT INTO `dvd` VALUES(3, 3, 1, 'Patrola prokletých', 'válka', 1, 1212091793, 1212084593);
INSERT INTO `dvd` VALUES(4, 2, 1, 'Smrt krásných srnců', 'smutná komedie', 1, 1212091840, 1212084640);
INSERT INTO `dvd` VALUES(5, 2, 1, 'Jak dostat tatínka do polepšovny', 'rodinná komedie', 1, 1212091940, 1212084740);
INSERT INTO `dvd` VALUES(6, 2, 1, 'Svatba jako řemen', 'komedie', 1, 1212092003, 1212084803);
INSERT INTO `dvd` VALUES(7, 2, 1, 'Jak vytrhnout velrybě stoličku', 'rodinná komedie', 1, 1212092064, 1212084864);
INSERT INTO `dvd` VALUES(8, 4, 1, 'Hrátky s čertem', 'pohádková komedie', 1, 1212092119, 1212084919);
INSERT INTO `dvd` VALUES(9, 3, 1, 'Kapitán Šťastné štiky', 'ponorková válka', 1, 1212092188, 1212084988);
INSERT INTO `dvd` VALUES(10, 3, 1, 'Konvoj PQ 17', 'osmidílný válečný epos', 4, 1212092264, 1212085064);
INSERT INTO `dvd` VALUES(11, 3, 1, 'Otevřená rána', 'válka', 1, 1212092352, 1212085152);
INSERT INTO `dvd` VALUES(12, 5, 1, 'Buddy míří na západ', 'western', 1, 1212092502, 1212085302);
INSERT INTO `dvd` VALUES(13, 6, 1, 'Princ a já', 'romance', 1, 1212092555, 1212085355);
INSERT INTO `dvd` VALUES(14, 2, 1, 'Kašpárek', 'zloděj agentem...', 1, 1212092780, 1212085580);
INSERT INTO `dvd` VALUES(15, 3, 1, 'K  19', 'stroj na smrt', 1, 1212092906, 1212085706);
INSERT INTO `dvd` VALUES(16, 3, 1, 'Leningradské nebe', 'blokáda Leningradu', 2, 1212092980, 1212085780);
INSERT INTO `dvd` VALUES(17, 2, 1, 'Čtyři vraždy stačí, drahoušku', 'česká komedie', 1, 1212093083, 1212085883);
INSERT INTO `dvd` VALUES(18, 2, 1, 'Marečku, podejte mi pero!', 'česká komedie', 1, 1212093155, 1212085955);
INSERT INTO `dvd` VALUES(19, 3, 1, '6. batalion', 'skutečný příběh', 1, 1212093261, 1212086061);
INSERT INTO `dvd` VALUES(20, 1, 1, 'Profesionál', 'nostalgie', 1, 1212093321, 1212086121);
INSERT INTO `dvd` VALUES(21, 2, 1, 'Tři tygři proti třem tygrům', 'komediální povídkový flim', 1, 1212093413, 1212086213);
INSERT INTO `dvd` VALUES(22, 4, 1, 'Asterix a Vikingové', ' komiksová pohádka', 1, 1212093476, 1212086276);
INSERT INTO `dvd` VALUES(23, 3, 1, 'Na konci všech válek ', 'skutečný příběh', 1, 1212093572, 1212086372);
INSERT INTO `dvd` VALUES(24, 7, 1, 'Spy kids 2', 'ostrov ztracených snů', 1, 1212093721, 1212086521);
INSERT INTO `dvd` VALUES(25, 7, 1, 'Borsalino a spol.', 'válka gangů', 1, 1212093855, 1212086655);
INSERT INTO `dvd` VALUES(26, 7, 1, 'Air  America', 'letadla', 1, 1212093949, 1212086749);

-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1:3305
-- Vygenerováno: Pátek 30. května 2008, 18:52
-- Verze MySQL: 5.0.51
-- Verze PHP: 4.4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Databáze: `gfdesign-cz`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `kategorie`
--

CREATE TABLE `kategorie` (
  `idkategorie` int(11) NOT NULL auto_increment,
  `nazev` varchar(30) collate utf8_czech_ci default NULL,
  PRIMARY KEY  (`idkategorie`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=8 ;

--
-- Vypisuji data pro tabulku `kategorie`
--

INSERT INTO `kategorie` VALUES(1, 'krimi');
INSERT INTO `kategorie` VALUES(2, 'komedie');
INSERT INTO `kategorie` VALUES(3, 'válečný film');
INSERT INTO `kategorie` VALUES(4, 'pohádky');
INSERT INTO `kategorie` VALUES(5, 'western');
INSERT INTO `kategorie` VALUES(6, 'romantika');
INSERT INTO `kategorie` VALUES(7, 'dobrodružství');

-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1:3305
-- Vygenerováno: Pátek 30. května 2008, 18:52
-- Verze MySQL: 5.0.51
-- Verze PHP: 4.4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Databáze: `gfdesign-cz`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `medium`
--

CREATE TABLE `medium` (
  `idmedium` int(11) NOT NULL auto_increment,
  `typ` varchar(10) collate utf8_czech_ci default NULL,
  PRIMARY KEY  (`idmedium`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=2 ;

--
-- Vypisuji data pro tabulku `medium`
--

INSERT INTO `medium` VALUES(1, 'DVD');

*/

?>