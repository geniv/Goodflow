-- phpMyAdmin SQL Dump
-- version 3.1.2deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Pondělí 28. září 2009, 15:38
-- Verze MySQL: 5.0.75
-- Verze PHP: 5.2.6-3ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Databáze: `phplayout`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `dynamicuser_gui_element`
--

CREATE TABLE IF NOT EXISTS `dynamicuser_gui_element` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nazev` varchar(200) collate utf8_czech_ci default NULL,
  `typ` int(10) unsigned default NULL,
  `value` varchar(200) collate utf8_czech_ci default NULL,
  `registrace` tinyint(1) default NULL,
  `profil` tinyint(1) default NULL,
  `readonly` tinyint(1) default NULL,
  `disabled` tinyint(1) default NULL,
  `povinne` tinyint(1) default NULL,
  `vstupni_typ` int(10) unsigned default NULL,
  `reg_exp` varchar(500) collate utf8_czech_ci default NULL,
  `format` varchar(200) collate utf8_czech_ci default NULL,
  `min_val` int(10) unsigned default NULL,
  `max_val` int(10) unsigned default NULL,
  `poradi` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=11 ;

--
-- Vypisuji data pro tabulku `dynamicuser_gui_element`
--

INSERT INTO `dynamicuser_gui_element` (`id`, `nazev`, `typ`, `value`, `registrace`, `profil`, `readonly`, `disabled`, `povinne`, `vstupni_typ`, `reg_exp`, `format`, `min_val`, `max_val`, `poradi`) VALUES
(1, 'jméno', 0, '', 0, 1, 0, 0, 1, 0, '', '', 0, 0, 1),
(2, 'příjmení', 0, '', 0, 1, 0, 0, 1, 0, '', '', 0, 0, 2),
(3, 'muž', 6, 'pohlavi', 1, 1, 0, 0, 1, 0, '', '', 0, 0, 3),
(4, 'žena', 6, 'pohlavi', 1, 1, 0, 0, 1, 0, '', '', 0, 0, 4),
(5, 'hermafrodit', 6, 'pohlavi', 1, 1, 0, 0, 1, 0, '', '', 0, 0, 5),
(6, 'suene', 6, 'pohlavi', 1, 1, 0, 0, 1, 0, '', '', 0, 0, 6),
(7, 'něco o sobě', 1, '', 0, 1, 0, 0, 0, 0, '', '', 0, 0, 7),
(8, 'něaký povinný checkbox', 5, 'povny check', 1, 1, 0, 0, 1, 0, '', '', 0, 0, 8),
(9, 'a naše captcha', 7, '3', 1, 0, 0, 0, 1, 0, '', '', 0, 0, 9),
(10, 'datm narození', 2, '', 0, 1, 0, 0, 0, 0, '', 'j.n.Y', 0, 0, 10);

-- --------------------------------------------------------

--
-- Struktura tabulky `dynamicuser_uzivatele`
--

CREATE TABLE IF NOT EXISTS `dynamicuser_uzivatele` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `login` varchar(100) collate utf8_czech_ci default NULL,
  `heslo` varchar(100) collate utf8_czech_ci default NULL,
  `email` varchar(100) collate utf8_czech_ci default NULL,
  `pridano` datetime default NULL,
  `upraveno` datetime default NULL,
  `aktivni` tinyint(1) default NULL,
  `last_login` datetime default NULL,
  `last_ip` varchar(50) collate utf8_czech_ci default NULL,
  `last_agent` varchar(300) collate utf8_czech_ci default NULL,
  `polozky` text collate utf8_czech_ci,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=11 ;

--
-- Vypisuji data pro tabulku `dynamicuser_uzivatele`
--

INSERT INTO `dynamicuser_uzivatele` (`id`, `login`, `heslo`, `email`, `pridano`, `upraveno`, `aktivni`, `last_login`, `last_ip`, `last_agent`, `polozky`) VALUES
(9, 'genva', 'ad79e2cd5fd5ae53547d991007344847', 'kokot@email.cz', '2009-09-17 15:51:39', '2009-09-27 00:51:06', 1, '2009-09-28 15:15:21', '127.0.1.1', 'Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/532.1 (KHTML, like Gecko) Chrome/4.0.213.1 Safari/532.1', 'dfujnhbjhbcvxcyqj|-x-|dsfd f|-x-|muž|-x-|muž|-x-|muž|-x-|muž|-x-|dfdfsdf hveee|-x-|povny check|-x-||-x-|17.9.2009');
