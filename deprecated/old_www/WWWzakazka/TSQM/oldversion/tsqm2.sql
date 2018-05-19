-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-7
-- http://www.phpmyadmin.net
-- 
-- Poèítaè: mysql.ic.cz
-- Vygenerováno: Nedìle 13. èervence 2008, 18:04
-- Verze MySQL: 4.10.0
-- Verze PHP: 5.2.0-8+etch11
-- 
-- Databáze: `ic_tsqm2`
-- 

-- --------------------------------------------------------

-- 
-- Struktura tabulky `abteilung`
-- 

CREATE TABLE `abteilung` (
  `nazev` varchar(255) collate latin2_czech_cs NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `abteilung`
-- 

INSERT INTO `abteilung` (`nazev`) VALUES 
('Beschaffung'),
('Beschwerdemanagement'),
('Bodymanagement'),
('Buchhaltung'),
('CafeHistory'),
('Copyshop'),
('Controlling'),
('Facility Management'),
('Führung'),
('Investition und Finanzierung'),
('Kostenrechnung'),
('Lagerung'),
('Marketing'),
('Marktforschung'),
('Qualitätsmanagement'),
('Quantitative Methodik'),
('Qualitative Methodik (RGT Team)'),
('Personal'),
('Transport'),
('TSQMIT'),
('externe EDV');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `cards`
-- 

CREATE TABLE `cards` (
  `id` int(255) NOT NULL,
  `datum` varchar(20) collate latin2_czech_cs NOT NULL,
  `cas` varchar(20) collate latin2_czech_cs NOT NULL,
  `handlungstyp` varchar(255) collate latin2_czech_cs NOT NULL,
  `prioritat` varchar(20) collate latin2_czech_cs NOT NULL,
  `prioritat2` varchar(20) collate latin2_czech_cs NOT NULL,
  `sender` varchar(50) collate latin2_czech_cs NOT NULL,
  `empfanger` varchar(50) collate latin2_czech_cs NOT NULL,
  `medium` varchar(255) collate latin2_czech_cs NOT NULL,
  `prozess` varchar(255) collate latin2_czech_cs NOT NULL,
  `dadatum` varchar(20) collate latin2_czech_cs NOT NULL,
  `daod` varchar(20) collate latin2_czech_cs NOT NULL,
  `dado` varchar(20) collate latin2_czech_cs NOT NULL,
  `drdatum` varchar(20) collate latin2_czech_cs NOT NULL,
  `drod` varchar(20) collate latin2_czech_cs NOT NULL,
  `drdo` varchar(20) collate latin2_czech_cs NOT NULL,
  `projekt` varchar(50) collate latin2_czech_cs NOT NULL,
  `abteilung` varchar(50) collate latin2_czech_cs NOT NULL,
  `internkann` varchar(50) collate latin2_czech_cs NOT NULL,
  `internwird` varchar(50) collate latin2_czech_cs NOT NULL,
  `externkann` varchar(50) collate latin2_czech_cs NOT NULL,
  `externwird` varchar(50) collate latin2_czech_cs NOT NULL,
  `status` varchar(50) collate latin2_czech_cs NOT NULL,
  `fertigintagen` varchar(50) collate latin2_czech_cs NOT NULL,
  `weiterleitung` varchar(50) collate latin2_czech_cs NOT NULL,
  `projekttitel` varchar(50) collate latin2_czech_cs NOT NULL,
  `uberschrift` varchar(50) collate latin2_czech_cs NOT NULL,
  `text` longtext collate latin2_czech_cs NOT NULL,
  `iu` int(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `cards`
-- 

INSERT INTO `cards` (`id`, `datum`, `cas`, `handlungstyp`, `prioritat`, `prioritat2`, `sender`, `empfanger`, `medium`, `prozess`, `dadatum`, `daod`, `dado`, `drdatum`, `drod`, `drdo`, `projekt`, `abteilung`, `internkann`, `internwird`, `externkann`, `externwird`, `status`, `fertigintagen`, `weiterleitung`, `projekttitel`, `uberschrift`, `text`, `iu`) VALUES 
(1, '05.05.2008', '', '', '', '', 'Andreas Trupp', 'Andreas Trupp', 'Online Datebank', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'ferialjob - aufgaben - 2008', 'ferialjob - aufgaben - 2008', 1),
(2, '', '', '', '', '', 'Andreas Trupp', 'Martin Glac', 'Online Datebank', '', '', '', '', '', '', '', '', '', '', '', '', '', 'in Arbeit', '', '', '', 'aufgabendatenbank - korrekturen - 05052008', 'aufgabendatenbank - korrekturen - 05052008', 2),
(3, '', '', '', '', '', 'Andreas Trupp', 'Iveta Kasalova', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'in Arbeit', '', '', '', 'patientenbefragung - fragebogen fertigstellen für ', 'patientenbefragung - fragebogen fertigstellen für geburtshilfe - korrekturen einbauen', 3),
(4, '07.05.2008', '', '', '', '', 'Michaela Tomkova', 'Andreas Trupp', 'Online Datebank', '', '', '', '', '', '', '', '', '', '', '', '', '', 'in Arbeit', '', '', '', 'misa - mitteilung', 'Michaela Tomková <M-Tomkova@seznam.cz> an andreas trupp am 07052008 um 1528 uhr\r\n\r\nHallo Andreas,\r\nich habe Iveta angerufen, dass ich anstelle Freitag morgen in die Arbeit komme und sie hat mir gesagt, dass ich dir schreiben soll. Also ich schreibe es dir', 4),
(5, '', '', '', '', '', 'Michaela Tomkova', 'Andreas Trupp', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Meetings:\r\n14:00 ? Eliska Smejkalova\r\n14:30 ? Martina Zitkova\r\n15:00 ? Martin Glac\r\n15:30 ? Radek Pechacek\r\n16:00 - Modellbauer\r\n16:30 ? Pavla Kopecka\r\n', 5),
(6, '', '', '', '', '', 'Michaela Tomkova', 'Martin Glac', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Zmeny v databazi: www.tsqm.ic.cz\r\nOdkazy:\r\nDaten hinzufügen, Angebung der Prognosen: \r\n1.	Pridat nad tabulku se zadavanim calendar, se kterym by se dalo pracovat, Jestlize by se zmacklo na nejake datum, tak by se vyplnil cely tyden. \r\n2.	Pred datumem by m', 6),
(7, '10.05.2008', '', 'Aufgabe', '', '', 'Andreas Trupp', 'Iveta Kasalova', 'Online Datebank', '', '', '', '', '', '', '', '', '', '', '', '', '', 'in Arbeit', '', '', 'krankenpflegeschulen - korrekturen - webdatenbank ', 'krankenpflegeschulen - korrekturen - webdatenbank ', 'krankenpflegeschulen - korrekturen - webdatenbank - 10052008\r\n(die korrekturen wurden besprochen am 10052008 und an die edv weitergeleitet)\r\n\r\n\r\nUNTERRICHT\r\n-bei der suche nach den vortragenden ist das nicht alphabetisch geordnet (21042008 - 05052008üneg - 10052008üneg)\r\n-wenn man nach einer bestimmten schule sucht, dann sind die vortragenden der schulen nicht geordnet\r\n-ist mühsam da den richtigen lehrer zu finden\r\n-wenn man auf vortragende klickt, dann kommt gar nichts\r\nda sollen sich anzeigen die fallzahlen je schule\r\nje nachdem, welche schule man sucht\r\nwenn man gar nichts sucht, dann eben alle\r\ndas kann aber freigeschaltet werden für alle\r\noder wenn das programmiertechnisch ein problem darstellt,\r\ndann eben nur pro schulberechtigung\r\naber auf jeden fall soll sich etwas anzeigen !!!\r\n(21042008 - 05052008üneg - 10052008üneg - nächste woche soll es sicher drauf sein !!!!!!!!!)\r\n\r\n-klickt man auf unterrichtsfach bei suche nach einer schule, dann kommt nichts - wir brauchen aber auch hier die fallzahlen pro schule\r\nsonst weiss man ja nie, was jetzt eigentlich angezeigt wird\r\nund es kommen fragen, warum werte angezeigt werden zb für\r\nreligion oder so, obwohl das dort gar nicht unterrichtet wird\r\nbeim sphinx diagramm fach haben wir folgende fehler\r\n-fachspezifisches Englisch (statt faschspez ...)\r\n-fehler bei Konfliktbewältigung\r\n-fehler bei Palliativpflege\r\n-Katastrophen- und Strahlenschutz (bindestrich fehlt)\r\nwer hat den das schon wieder abgeschrieben ??? antwort: eliska\r\n(21042008 - 05052008üneg)\r\n\r\n-----------------------------------------------------------\r\n\r\nPRAKTIKUM\r\n-man kann beim suchformular keine praktikumsstelle auswählen\r\n-wozu dann das suchfeld?\r\n-erledigt, aber falsche variable\r\n-wir brauchen die allgemeinere variable\r\n\r\n-bei der frage "wo haben sie das praktikum absolviert?"\r\nsoll ein diagramm pro schule erstellt werden\r\njetzt weiss man nicht, wo zb die zwettler das praktikum absolviert haben\r\n-üneg funktioniert bisher nur bei scheibbs (10052008)\r\n\r\n-die diagramme gleiche abstände gleiche breite (üneg - die abstände sind immer noch ungleich)\r\n\r\n------------------------------------------------\r\n\r\n-organisation: abholung am ende des monats und den monaten zuordnen - monatsstempel besorgen und auf die fragebögen stempeln\r\n\r\n01052008 um 2305 uhr - mail - andreas trupp an iveta kasalova\r\nhallo iveta - es wurde der vorschlag 1 ausgewählt - der text ist aber falsch - er soll lauten\r\n"Befragung der Gesundheits- und KrankenpflegeschülerInnen" (01052008 - 05052008üneg)\r\n\r\n01052008 um 1610 - mail - andreas trupp an iveta kasalova\r\n-was nun die liste betrifft, die du mir gesendet hast ...\r\n-manche lehrer werden eben zwei schulen zugeordnet\r\n-ich sehe da überhaupt kein problem, da wir ja die variable schule haben\r\n-aber ich maile die liste an die holding und die sollen dann noch stellung dazu nehmen\r\n-aber zuerst brauche ich die antwort auf die anderen problemfälle\r\n(01052008 - 05052008üneg)\r\n\r\n-----------------------------------------------------\r\n\r\n-ich habe aber noch keine erklärung bekommen für einige fälle von zwettl:\r\n1) klein fehlt bei den zwettl lehrern und die unterrichtet in zwettl - klein sankt pölten werden 85 gefunden - sie ist aber aus zwettl - fehlt aber in den balkendiagrammen !?\r\n2) huber adelheid fehlt auch bei zwettl - checken\r\n3) steininger kein ausdruck vorhanden\r\n4) huber kein ausdruck vorhanden\r\n5) grubmüller kein ausdruck\r\n6) Herr Adelhofer ist auf unsere Fragen gut eingegangen - dieser lehrer ist aus horn? prüfen\r\n7) Frau Mag. Brunthaler hat den Unterricht verständlich vorgetragen - diese lehrerin gibt es gar nicht in zwettl - prüfen - ???\r\n-die ausdruckliste noch einmal überprüfen\r\n-die lehrer wollen ihre ergebnisse und ich muss die ausdrucke nachliefern\r\n-eines ist mir vollkommen unklar???????!!!!!!!!!!!!!\r\n-im zwettl diagramm sehe ich 20 lehrer\r\n-einen ausdruck habe ich gehabt von vielleicht 5 lehrern (iveta meint von 13 lehrern)\r\n-bitte um stellungnahme\r\n-erst eine einzige lehrerin hat ihre ergebnisse bekommen\r\n-wir machen dann einen ausdruck, wenn wir wenigstens 10 beobachtungen haben\r\n-ich brauche darauf antworten, bevor ich antworten kann\r\n-also am besten den ganzen zwettler lehrer ausdruck noch einmal !!!\r\n-einmal für die frau direktor\r\n-einmal für den jeweiligen lehrer\r\n-das ist klar, das das in der nächsten schule sehr viel besser werden muss !!!\r\n-und ...\r\n-nach der abholung nächste woche können ALLE schulen nach der verarbeitung schon fertig gemacht werden - sodass es schon viele wochen früher fertig ist und nicht erst in der nacht vor dem termin !!!\r\n(01052008 - 05052008üneg)\r\n\r\n--------------------------------------------------\r\n\r\n30042008 um 2111 uhr - mail - iveta kasalova an andreas trupp\r\ngrafik vorschläge für den text auf home\r\nexcel datei siehe 158\r\nder grafikvorschlag 1 wurde ausgewählt - mail wurde gesendet am 01052008 um 2305 uhr\r\n(01052008 - 05052008üneg)\r\n-----------------------------------------------------------------\r\n\r\nRÜCKLAUF\r\n-da ist einiges völlig falsch programmiert\r\n-sucht man den rücklauf aller schulen, dürften die werte korrekt sein\r\n-aber der holding wert soll rot sein\r\n-die balkenbeschriftung und wenn möglich auch der balken\r\n-die überschrift des rücklauf diagrammes passt überhaupt nicht\r\n-der rücklauf bezieht sich ja nicht auf die entlassungen !!! sondern auf die anzahl der schüler\r\n-überschrift soll heissen "Rücklauf bezogen auf die Gesamtanzahl der SchülerInnen"\r\n-die variable soll heissen "Schulen"\r\n-bei den merkmalsausprägungen soll oben stehen "alle Schulen" (statt "Alle Schule")\r\n-es sollen dazu kommen die ausprägungen "Wiener Neustadt" und "Neunkirchen"\r\n-bei der variable jahre sollen die ausprägungen "2008" und "2009" entfernt werden\r\n-man kann dort jetzt nichts finden und das nächste jahr soll erst raufkommen, wenn es sinnvoll ist\r\n-sonst versuchen sie immer dinge, die sinnlos sind\r\n-oben stehen die texte "Verwaltung" und "Rücklauf"\r\n-wozu gibt es den link rücklauf? das ist mit keiner funktion hinterlegt ?!\r\n(01052008 - 05052008üneg)\r\n\r\n------------------------------------------------------\r\n\r\nauf der registerkarte soll TSQM weg\r\nes soll stehen\r\nLKH SchülerInnenbefragung\r\n(01052008 - 05052008üneg)\r\n\r\n--------------------------------------------------\r\n\r\nUNTERRICHT\r\n-jeder direktor darf auf alle lehrer und daten seiner schule zugreifen\r\n-jeder lehrer darf nur auf seine eigenen ergebnisse zugreifen\r\n-und er darf die lehrer der eigenen schule im vergleich sein\r\n-also so etwa wie die stationen des krankenhauses im vergleich\r\n-sollen sich die lehrer der schule im vergleich darstellen der eigenen schule\r\n-diese diagramme sollen sich bei den geschlossenen anzeigen\r\n-die offenen fragen immer nur pro lehrer\r\n-nur die direktoren können auf alle offenen der schule zugreifen\r\n-also solange das nicht programmiert wurde, kann ich die schulen nicht freischalten\r\n-dann brauchen wir pro lehrer eine zusammenfassende darstellung\r\n-also alle fragen des lehrers aufsteigend geordnet\r\n-aber wohin damit?\r\n-ich würde sagen wir machen da einen eigenen link "Zusammenfassung der Ergebnisse pro LehrerIn"\r\n-dann kann man die jeweilige schule anklicken\r\n-und dann kann oben das diagramm für die schule insgesamt\r\n-und darunter die diagramme der einzelnen lehrer\r\n-das word dokument, das jetzt steht unter "qualität des unterrichts" kann dann weg\r\n(01052008 - 05052008üneg)\r\n\r\n---------------------------------------\r\n\r\ndie gesamte anordnung soll vom layout so gestaltet werden\r\nwie die patientenhomepage - also ich denke es wird\r\nam einfachsten sein die links und alles schon dementsprechend\r\numzugestalten - auf der patienten homepage sind ja schon\r\nalle felder programmiert - es geht ja nur um neue inhalte\r\nalso das kann man von dort 1:1 übernehmen - kann also\r\nnicht so viel programmieraufwand bedeuten\r\n(01052008 - 05052008üneg)\r\n\r\n--------------------------------------------------\r\n\r\njohann schalhas\r\nname ist falsch geschrieben bei scheibbs\r\n\r\n-Passwort für die psych. GuKPS Mauer: Dir. Bruckmüller ist als Lehrer angeführt ? Passwort funktioniert auch nicht bzw. man sieht keine Ergebnisse mit diesem Passwort (wurzenberger)\r\n\r\n-Passwort für die psych. GuKPS Tulln fehlt (Dir. Rosa Kuselbauer) ? kann man in Tulln die Unterrichtsevaluation trennen in psych und allg.? ? müsste mit den Lehrernamen funktionieren! (noch nicht dringend, da eh kein Rücklauf da ist!) (wurzenberger)\r\n\r\n-Die beiden psychiatrischen GuKPS findet man auf unserer Homepage unter nachstehendem Link:\r\nhttp://www.holding.lknoe.at/de/pGuKPS/\r\n\r\n-wenn man Fragebogen Praktika wählt, kommen bei der Auswahl alle Schulen und nicht nur diejenige, wo mit dem Passwort eingeloggt wurde!  Es kommt zwar bei den Diagrammen überall das gleiche, jedoch bei den offenen Fragen die jeweils für die gewählte Schule gehörenden Antworten! (wurzenberger)\r\n\r\nÞ       Wenn man bei der Unterrichtsevaluation bei der Schule keine Auswahl trifft scheinen bei der Auswahl der Lehrer ALLE in NÖ auf (aber anscheinend werden die Fragebögen ?fremder? Schulen nicht angezeigt)!!!!  Bitte überprüfen, ob auf diesem Weg sicher niemand bei den Ergebnissen der Unterrichtsevaluation anderer Schulen reinschauen? kann.\r\n\r\n\r\nÞ       Helga Gössl bitte in Hollabrunn zuordnen (in Mistelbach zugeordnet, weil sie auch auf der Mistelbach Liste aufscheint, jedoch nicht bzw. kaum mehr in Mistelbach unterrichtet)\r\n\r\nÞ       In Hollabrunn wirklich 0 Fragebögen (Unterricht) bei den Lehrern?\r\n\r\n\r\nÞ       Eleonore Kemetmüller und Dir. Mag. Dr. Eleonore Kemetmüller (Krems) sind eine Person ? scheinen zweimal auf ? kann man zusammenfassen!\r\n\r\n\r\nÞ       Mistelbach ? Günter Gasmugg und Günter Grasmugg sind dieselbe Person ? kann man zusammenfassen bzw. Gasmugg streichen!\r\n\r\nPS: Hast Du noch allgemeine Fragebögen auf Lager? In Krems möchten Sie 150 Stück davon!\r\n\r\n--------------------------------------\r\n\r\n-die symbole auf den links fehlen auf home\r\ndieselben verwenden wie auf patientenhomepage\r\n\r\n-die links auf home sollen nicht neue erfunden werden\r\nes sollen ganz genau dieselben links raufprogrammiert werden wie bei patientenhomepage\r\nund auch mit denselben symbolen\r\nwir brauchen nur nicht:\r\n-Dokublätter\r\n-Beschwerdemanagement\r\nansonsten genau die gleichen links und genau dieselbe darstellung\r\nwir haben ja so lange daran gearbeitet\r\nich möchte mir jetzt das alles nicht wieder neu ausdenken\r\n\r\n----------------------------------------', 7),
(8, '', '', '', '', '', 'Michaela Tomkova', 'Martin Glac', 'Online Datebank', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'zmeny v databazi tsqm2.ic.cz', 'zmeny v databazi tsqm2.ic.cz', 'Zmeny v databazi: www.tsqm.ic.cz\r\nOdkazy:\r\nDaten hinzufügen, Angebung der Prognosen: \r\n1.	Pridat nad tabulku se zadavanim calendar, se kterym by se dalo pracovat, Jestlize by se zmacklo na nejake datum, tak by se vyplnil cely tyden. \r\n2.	Pred datumem by mela byt polozka Arbeitstag, kde se bude vyplnovat JA/NEIN, jestli dany termin pracuje nebo ne.\r\n3.	Mely by se potom zobrazovat jen dny s JA (pracovni).\r\n4.	Jak je napsany Von-Bis, tak je potreba to zmenit na von-bis (male pismeno). Dale smazat z Von2 a Bis2 dvojku a zase zmenit na male pismeno.\r\n5.	Pri zadavani prognoz jsou ve sloupci vsichni zamestnanci, bylo by lepsi kdyby se u zadavani zobrazovali jen ti co stale pracuji. \r\n6.	U Dagmar Lassanove je poreba zmenit velikost uzivatelskeho jmena, ma tam velke L.\r\nNeuen Benutzer zugeben:\r\n1.	Gruppe ? prelozit ? Benutzer = uzivatel, Leitung = vedeni\r\n2.	Staat ? pridat Slowakei (Slovensko)\r\n3.	Udelat dalsi pole s vyberem ridicaku, jaky typ ridicaku dotycny ma\r\n4.	Geschlecht misto Frau/Mann zmenit na  weiblich/männlich\r\n5.	Bewerbung erfolgt ? Termin ausgemacht - je tam 2x\r\n6.	Besrechungsdatum je co? Datum prvniho pohovoru?\r\n7.	Moznost vyberu ? Lebenslauf ? JA/NEIN\r\nSuchen:\r\n1.	Je jeste nedodelane?\r\n2.	Pridat Drop-down na: \r\na.	 vyhledavani zamestnancu\r\nb.	Kdo pracuje podle dnu/mesicuroku\r\nc.	Vyhledavani jednotlivych prognoz zamestnancu, ukazat celkovy pocet hodin, ukazat poce hodin tydne atd.\r\n3.	Vyhedavani lidi kdo ne/maji ridicak, ne/poslali Lebenslauf, ne/pacuji, jazyky, podle statu\r\n4.	Vyhledavani lidi, kteri maji pres 80 hodin\r\nNebylo by spatne, kdyby zajemci o vyplatu meli odkaz kam by si o ni psali, pak by se to pouze zkontrolovalo jestli sedi hodiny a nemuselo by se to hlidat, kdo kdy ma presne tolik a tlik hodin. \r\n\r\n\r\n\r\n', 8),
(9, '21.01.2008', '16:28', 'Tagesprotokoll', '', '', 'Martina Zitkova', 'Martina Zitkova', 'Mail', '', '10.05.2008', '', '', '21.01.2008', '', '', '', '', '', '', '', '', 'abgeschlossen', '', '', 'Tagesprotokoll- Martina Zitkova- 21012008', 'Tagesprotokoll- Martina Zitkova- 21012008', 'Tagesprotokoll- Martina Zitkova- 21012008\r\n\r\nscanovani - kinderheilkunde eltern - Krems\r\n                    -  kinderheilkunde teenager - Krems\r\n                    - strahlentherapie - Krems\r\n                    - geburtshilfe - Baden\r\n                    - innere medizin\r\n                    - chirurgie\r\n\r\n', 9),
(10, '21.01.2008', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 10),
(11, '21.01.2008', '16.52', 'Tagesprotokoll', '', '', 'Martina Selecka', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '21.01.2008', '', '', '', '', '', '', '', '', 'abgeschlossen', '', '', 'Tagesprotokoll- Martina Selecka- 21012008', 'Tagesprotokoll- Martina Selecka- 21012008', 'Tagesprotokoll- Martina Selecka- 21012008\r\n  \r\nAhoj, dnes jsem vybalovala Waidhofen/Ybbs, pak jsem to èíslovala a pak\r\npøedzadávala do poèítaèe.', 11),
(12, '21.01.2008', '17:22', 'Tagesprotokoll', '', '', 'Veronika Holeckova', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '21.01.2008', '', '', '', '', '', '', '', '', 'abgeschlossen', '', '', 'Tagesprotokoll- Marek Brakora- 21012008', 'Tagesprotokoll- Marek Brakora- 21012008', 'Tagesprotokoll- Marek Brakora- 21012008\r\n   \r\nheute habe ich mistelbach innere medizin kontrolliert...marek', 12),
(13, '21.01.2008', '18:41', 'Tagesprotokoll', '', '1', 'Veronika Holeckova', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '21.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Verca Holeckova- 21012008', 'Tagesprotokoll- Verca Holeckova- 21012008', 'Tagesprotokoll- Verca Holeckova- 21012008\r\n\r\ndnes jsem predzadavala waidhofen/ybbs a urologii\r\n', 13),
(14, '21.01.2008', '19:12', 'Tagesprotokoll', '', '', 'Kristyna Benesova', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '21.01.2008', '', '', '', '', '', '', '', '', 'abgeschlossen', '', '', 'Tagesprotokoll- Kristyna Benesova- 21012008', 'Tagesprotokoll- Kristyna Benesova- 21012008', 'Tagesprotokoll- Kristyna Benesova- 21012008\r\n    \r\nich habe rechtsschreibkotrolle von Mistelbach gemacht\r\n', 14),
(15, '21.01.2008', '19:24', 'Tagesprotokoll', '', '', 'Pavla Kratochvilova', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '21.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Pavla Kratochvilova- 21012008', 'Tagesprotokoll- Pavla Kratochvilova- 21012008', 'Tagesprotokoll- Pavla Kratochvilova- 21012008\r\n \r\nkdyz jsem prisla, mela jsem meeting s holkama z gastroteamu. rekla jsem jim, co jsme rozebirali na meetingu s Andreasem a pod. potom jsem se snazila pripravit neco k jidelnickum, ale protoze jsem nemela vsechny podklady, neudelala jsem to vsechno. Potom jsem psala protokoly k meetingu z 19.01.2008 a dodatecny protokol k vanocni oslave. Taky jsem si pripravila presentaci, kterou mam na tuto stredu.\r\n\r\n\r\n', 15),
(16, '21.01.2008', '19:29', 'Tagesprotokoll', '', '', 'Tomas Rydval', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '21.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Tomas Rydval - 21012008', 'Tagesprotokoll- Tomas Rydval - 21012008', 'Tagesprotokoll- Tomas Rydval - 21012008\r\n   \r\nHeute habe ich Waidhofen/Ybbs sortiert und punktiert', 16),
(17, '21.01.2008', '19:50', 'Tagesprotokoll', '', '', 'Vlasta Dokulilova', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '21.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Vlasta Dokulilova- 21012008', 'Tagesprotokoll- Vlasta Dokulilova- 21012008', 'Tagesprotokoll- Vlasta Dokulilova- 21012008\r\n\r\nHeute habe ich Sortierung gemacht.\r\n', 17),
(18, '21.01.2008', '20:25', 'Tagesprotokoll', '', '', 'Tereza Bednarova', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '21.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Tereza Bednarova - 21012008', 'Tagesprotokoll- Tereza Bednarova - 21012008', 'Tagesprotokoll- Tereza Bednarova - 21012008\r\n \r\nam Montag 21. 1. habe ich Waidhofen/Ybbs sortiert.\r\n', 18),
(19, '21.01.2008', '20:27', 'Tagesprotokoll', '', '', 'Silvie Rihova', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '21.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Silvie Rihova- 21012008', 'Tagesprotokoll- Silvie Rihova- 21012008', 'Tagesprotokoll- Silvie Rihova- 21012008\r\n\r\nHeute habe ich OF Kontrolle: Baden . Innere Medizin - neu  und alt gemacht.\r\n', 19),
(20, '22.01.2008', '16:28', 'Tagesprotokoll', '', '', 'Martina Zitkova', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '22.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Martina Zitkova- 22012008', 'Tagesprotokoll- Martina Zitkova- 22012008', 'Tagesprotokoll- Martina Zitkova- 22012008\r\n->scanovani\r\n - chirurgie\r\n - Waidhofen Ybbs - augenheilkunde\r\n                                  - unfallchirurgie\r\n                                  - geburtshilfe\r\n                                  - urologie\r\n\r\n\r\n', 20),
(21, '23.01.2008', '19:40', 'Tagesprotokoll', '', '', 'Pavla Kratochvilova', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '23.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Pavla Kratochvilova- 23012008', 'Tagesprotokoll- Pavla Kratochvilova- 23012008', 'Tagesprotokoll- Pavla Kratochvilova- 23012008\r\n\r\ndneska jsem s holkama udelala meeting co se tyka gastra. Potom jsem zasla na pracovni urad kvuli nejakym kucharum. Dal jsem delala jeste nejake poznamky k jidelnickum a sepsala jsem protokol o praci v gastru. \r\n\r\n\r\n', 21),
(22, '23.01.2008', '18:28', 'Tagesprotokoll', '', '', 'Zuzana Walova', '', '', '', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 22),
(23, '23.01.2008', '18:28', 'Tagesprotokoll', '', '', 'Zuzana Walova', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '23.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Zuzana Walowa- 23012008', 'Tagesprotokoll- Zuzana Walowa- 23012008', 'Tagesprotokoll- Zuzana Walowa- 23012008\r\n\r\ndneska jsem kontrolovala Mistelbach- physikalische Medizin.\r\n\r\n', 23),
(24, '23.01.2008', '19:33', 'Tagesprotokoll', '', '', 'Marek Brakora', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '23.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Marek Brakora- 23012008', 'Tagesprotokoll- Marek Brakora- 23012008', 'Tagesprotokoll- Marek Brakora- 23012008\r\n\r\nheute gemacht innere medizin waidhofen ybbs eingegeben hab es angeschrieben und\r\nmorgen werde ich fortsetzen \r\n', 24),
(25, '22.01.2008', '16:54', 'Tagesprotokoll', '', '', 'Martina Selecka', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Martina Selecka- 22012008', 'Tagesprotokoll- Martina Selecka- 22012008', 'Tagesprotokoll- Martina Selecka- 22012008\r\n\r\nAhoj, dnes jsem èíslovala Baden, Korneuburg a Stockerau, pak jsem vše\r\nzadávala do poèítaèe a dala dál na zpracování...\r\n\r\n', 25),
(26, '22.01.2008', '19:29', 'Tagesprotokoll', '', '', 'Marek Brakora', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '22.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Marek Brakora- 22012008', 'Tagesprotokoll- Marek Brakora- 22012008', 'Tagesprotokoll- Marek Brakora- 22012008\r\n\r\nheute habe ich wieder kontrolliert laut alten Systems innere medizin mistelbach\r\n(fertiggemacht letzte station) und baden(ganze 4 stationen)...bis bald\r\n', 26),
(27, '22.01.2008', '20:01', 'Tagesprotokoll', '', '', 'Vlasta Dokulilova', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '22.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Vlasta Dokulilova- 22012008', 'Tagesprotokoll- Vlasta Dokulilova- 22012008', 'Tagesprotokoll- Vlasta Dokulilova- 22012008\r\n\r\nheute habe ich Sortierung gemacht.\r\n', 27),
(28, '23.01.2008', '16:25', 'Tagesprotokoll', '', '', 'Martina Zitkova', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '23.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Martina Zitkova- 23012008', 'Tagesprotokoll- Martina Zitkova- 23012008', 'Tagesprotokoll- Martina Zitkova- 23012008\r\n\r\nNapln prace 23.1.2008\r\n\r\nscanovani\r\n- physikalische ambulanz\r\n- Waidhofen Ybbs - augenheilkunde\r\n                                  - orthopädie\r\n                                  - gynäkologie\r\n                                  - innere medizin\r\n', 28),
(29, '23.01.2008', '16:46', '', '', '', 'Martina Selecka', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '23.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Martina Selecka- 23012008', 'Tagesprotokoll- Martina Selecka- 23012008', 'Tagesprotokoll- Martina Selecka- 23012008\r\n \r\nAhoj, dnes jsem se vìnovala copyshopu... Obvolávala firmy ohlednì\r\nkopírek..., pak jsem vyhledávala porcelánky, antikvariáty, bleší trhy,\r\nhistorické kavárny...\r\n', 29),
(30, '23.01.2008', '17:23', 'Tagesprotokoll', '', '', 'Kristyna Benesova', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '23.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Kristyna Benesova- 23012008', 'Tagesprotokoll- Kristyna Benesova- 23012008', 'Tagesprotokoll- Kristyna Benesova- 23012008\r\n   \r\nich habe rechtschreibkontolle mistelbach gemacht\r\n', 30),
(31, '23.01.2008', '19:33', 'Tagesprotokoll', '', '', 'Tomas Rydval', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '23.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Tomas Rydval - 23012008', 'Tagesprotokoll- Tomas Rydval - 23012008', 'Tagesprotokoll- Tomas Rydval - 23012008\r\n \r\nHeute habe ich ganze Stockerau und Korneuburg und noch etwas von St.Pölten\r\nsortiert\r\n\r\n', 31),
(32, '23.01.2008', '19:46', 'Tagesprotokoll', '', '', 'Silvie Rihova', 'Silvie Rihova', 'Mail', '', '10.05.2008', '', '', '23.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Silvie Rihova- 23012008', 'Tagesprotokoll- Silvie Rihova- 23012008', 'Tagesprotokoll- Silvie Rihova- 23012008\r\n\r\nDneska jsem kontrolovala Mistelbach - Innere Medizin - altes System, a\r\nMistelbach: Kinderheilkinde Jugentliche, Neurologie, Innere Medizin - neues\r\nSystem a Weidhofe/ Ybbs - Innere medizin.\r\n\r\n\r\n                                                      \r\n', 32),
(33, '23.01.2008', '19:48', 'Tagesprotokoll', '', '', 'Tereza Bednarova', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '23.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Tereza Bednarova - 23012008', 'Tagesprotokoll- Tereza Bednarova - 23012008', 'Tagesprotokoll- Tereza Bednarova - 23012008\r\n\r\ndneska jsem tridila Stockerau, Korneuburg a St. Pölten.\r\n', 33),
(34, '23.01.2008', '19:54', 'Tagesprotokoll', '', '', 'Vlasta Dokulilova', 'Andreas Trupp', 'Mail', '', '10.05.2008', '', '', '23.01.2008', '', '', '', '', '', '', '', '', '', '', '', 'Tagesprotokoll- Vlasta Dokulilova- 23012008', 'Tagesprotokoll- Vlasta Dokulilova- 23012008', 'Tagesprotokoll- Vlasta Dokulilova- 23012008\r\n\r\ndneska jsem tridila Stockerau, Korneuburg a St. Pölten\r\n\r\n', 34),
(35, '', '', 'Bewerbungsgespräch', '25', '5', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 35),
(36, '10.05.2008', '19:00', 'Aufgabe', '', '', 'Andreas Trupp', 'Iveta Kasalova', 'Online Datebank', '', '', '', '', '', '', '', '', '', '', '', '', '', 'in Arbeit', '', '', 'aufgabendatenbank - korrekturen - 10052008', 'aufgabendatenbank - korrekturen - 10052008', 'aufgabendatenbank - korrekturen - 10052008\r\n\r\nübersetzen und weiterleiten an glac edv\r\n\r\noben links das feld soll heissen "Eingabedatum" - hier soll sich automatisch beim neu anlegen eines datensatzes das datum eintragen - in das feld rechts davon die uhrzeit - und zwar automatisch - den text "Zeit" brauche ich nicht !!!\r\n\r\ndas feld "Datum Aufnahme" soll umbenannt werden in "Sendedatum" - hier wird eingetragen das datum des absendens und ebenso die uhrzeit - oder das datum eines termins - etc\r\n\r\ndas feld "datum ressourcen" und die dazugehörige zeit kann gelöscht werden', 36);

-- --------------------------------------------------------

-- 
-- Struktura tabulky `firmy`
-- 

CREATE TABLE `firmy` (
  `nazev` varchar(255) collate latin2_czech_cs NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `firmy`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `handlungstyp`
-- 

CREATE TABLE `handlungstyp` (
  `nazev` varchar(50) collate latin2_czech_cs NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `handlungstyp`
-- 

INSERT INTO `handlungstyp` (`nazev`) VALUES 
('Aufgabe'),
('Bewerbungsgespräch'),
('Expedition'),
('Frage'),
('Lob / Anerkennung'),
('Mitarbeitergespräch'),
('Mitteilung'),
('Problem/Fehler'),
('Tagesprotokoll');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `login`
-- 

CREATE TABLE `login` (
  `jmeno` varchar(30) collate cp1250_czech_cs NOT NULL default '',
  `heslo` varchar(10) collate cp1250_czech_cs NOT NULL default '',
  `prijmeni` varchar(50) collate cp1250_czech_cs NOT NULL,
  `krestni` varchar(50) collate cp1250_czech_cs NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1250 COLLATE=cp1250_czech_cs;

-- 
-- Vypisuji data pro tabulku `login`
-- 

INSERT INTO `login` (`jmeno`, `heslo`, `prijmeni`, `krestni`) VALUES 
('rydval', 'asdf', 'Rydval', 'Tomas'),
('trupp', 'tsqm', 'Trupp', 'Andreas'),
('tomkova', 'blondi', 'Tomkova', 'Michaela'),
('pechacek', 'nevim', 'Pechacek', 'Radek'),
('kasalovaiveta', 'tsqm', 'Kasalova', 'Iveta'),
('glac', 'acer', 'Glac', 'Martin'),
('selecka', 'tsqm', 'Selecka', 'Martina'),
('zitkova', 'tsqm', 'Zitkova', 'Martina'),
('blahoudkova', 'tsqm', 'Blahoudkova', 'Sarka'),
('polakova', 'tsqm', 'Pollakova', 'Lenka'),
('smejkalova', 'tsqm', 'Smejkalova', 'Eliska'),
('pospichalova', 'tsqm', 'Pospichalova', 'Tereza'),
('kasalovazuzana', 'tsqm', 'Kasalova', 'Zuzana'),
('masejova', 'tsqm', 'Masejova', 'Marcela'),
('holeckova', 'tsqm', 'Holeckova', 'Veronika'),
('zerzankova', 'tsqm', 'Zerzankova', 'Aneta'),
('schmuttermeierova', 'tsqm', 'Schmutteremeierova', 'Karolina'),
('babikova', 'tsqm', 'Babikova', 'Katerina'),
('sladkova', 'tsqm', 'Sladkova', 'Michaela'),
('sykorova', 'tsqm', 'Sykorova', 'Katerina'),
('florianova', 'tsqm', 'Florianova', 'Alena'),
('pechova', 'tsqm', 'Pechova', 'Sabina'),
('brakora', 'tsqm', 'Brakora', 'Marek'),
('rihova', 'tsqm', 'Rihova', 'Silvie'),
('benesova', 'tsqm', 'Benesova', 'Kristyna'),
('stavikova', 'tsqm', 'Stavikova', 'Svatava'),
('kratochvilova', 'tsqm', 'Kratochvilova', 'Pavla'),
('walova', 'tsqm', 'Walova', 'Zuzana'),
('kachynova', 'tsqm', 'Kachynova', 'Katerina'),
('juhanakova', 'tsqm', 'Juhanakova', 'Eva'),
('bednarova', 'tsqm', 'Bednarova', 'Tereza'),
('forman', 'tsqm', 'Forman', 'Zdenek'),
('svabova', 'tsqm', 'Svabova', 'Putzfrau'),
('selingerova', 'tsqm', 'Selingerova', 'Eva'),
('dokulilova', 'tsqm', 'Dokulilova', 'Vlasta'),
('vanova', 'tsqm', 'Vanova', 'Jana'),
('sofkova', 'tsqm', 'Sofkova', 'Gabriela'),
('karalupova', 'tsqm', 'Karalupova', 'Jana'),
('novotna', 'tsqm', 'Novotna', 'Aneta'),
('slaba', 'tsqm', 'Slaba', 'Kamila'),
('durda', 'tsqm', 'Durda', 'Ondrej'),
('smejkalovasvetlana', 'tsqm', 'Smejkalova', 'Svetlana'),
('jurankova', 'tsqm', 'Jurankova', 'Zaneta'),
('bilova', 'tsqm', 'Bilova', 'Martina'),
('kopecka', 'tsqm', 'Kopecka', 'Pavla'),
('klincova', 'tsqm', 'Klincova', 'Radka'),
('fialova', 'tsqm', 'Fialova', 'Zuzana'),
('michkova', 'tsqm', 'Michkova', 'Marketa'),
('schneiderova', 'tsqm', 'Schneiderova', 'Erika'),
('milerova', 'tsqm', 'Milerova', 'Katerina'),
('herout', 'tsqm', 'Herout', 'Radim'),
('podzemska', 'tsqm', 'Podzemska', 'Monika'),
('vanickova', 'tsqm', 'Vanickova', 'Lucie'),
('mikulkova', 'tsqm', 'Mikulkova', 'Radka'),
('vesela', 'tsqm', 'Vesela', 'Martina'),
('lendlerova', 'tsqm', 'Lendlerova', 'Lucie'),
('pekova', 'tsqm', 'Pekova', 'Pavla'),
('fucikova', 'tsqm', 'Fucikova', 'Jaroslava'),
('kubaska', 'tsqm', 'Kubaska', 'Michala'),
('certkova', 'tsqm', 'Certkova', 'Ludmila'),
('feldova', 'tsqm', 'Feldova', 'Iva'),
('jouklova', 'tsqm', 'Jouklova', 'Marketa'),
('svobodova', 'tsqm', 'Svobodova', 'Linda'),
('jelinkova', 'tsqm', 'Jelinkova', 'Lenka'),
('novotnakaterina', 'tsqm', 'Novotna', 'Katerina'),
('havelka', 'tsqm', 'Havelka', 'Jan'),
('stetinova', 'tsqm', 'Stetinova', 'Jana'),
('mezerova', 'tsqm', 'Mezerova', 'Zuzana'),
('pelikanova', 'tsqm', 'Pelikanova', 'Irena'),
('kolmanova', 'tsqm', 'kolmanova', 'Dana'),
('kudrnova', 'tsqm', 'Kudrnova', 'Alena'),
('prchalova', 'tsqm', 'Prchalova', 'Marika'),
('pokornajitka', 'tsqm', 'Pokorna', 'Jitka'),
('lukacova', 'tsqm', 'Lukacova', 'Veronika'),
('pokornatereza', 'tsqm', 'Pokorna', 'Tereza'),
('prchalova', 'tsqm', 'Prchalova', 'Marika'),
('otypkova', 'tsqm', 'Otypkova', 'Petra'),
('nova', 'tsqm', 'Nova', 'Michaela'),
('kounkova', 'tsqm', 'Kounkova', 'Martina'),
('kratka', 'tsqm', 'Kratka', 'Katerina'),
('dvorakova', 'tsqm', 'Dvorakova', 'Lenka'),
('sousedikova', 'tsqm', 'Sousedikova', 'Hana'),
('otypka', 'tsqm', 'Otypka', 'Tomas'),
('budaiova', 'tsqm', 'Budaiova', 'Romana'),
('bimova', 'tsqm', 'Bimova', 'Alice'),
('subrt', 'tsqm', 'Subrt', 'Petr'),
('vymola', 'tsqm', 'Vymola', 'Lukas'),
('bilkova', 'tsqm', 'Bilkova', 'Klara'),
('pytlik', 'tsqm', 'Pytlik', 'Petr'),
('tomankova', 'tsqm', 'Tomankova', 'Eva'),
('plankova', 'tsqm', 'Plankova', 'Lucie'),
('cerny', 'tsqm', 'Cerny', 'Michal'),
('rysava', 'tsqm', 'Rysava', 'Lenka'),
('mravcova', 'tsqm', 'Mravcova', 'Janka'),
('skalska', 'tsqm', 'Skalska', 'Veronika'),
('motycka', 'tsqm', 'Motycka', 'Lukas'),
('brychtova', 'tsqm', 'Brychtova', 'Eva'),
('mertens', 'tsqm', 'Mertens', 'Otto'),
('vankova', 'tsqm', 'Vankova', 'Marketa'),
('stankova', 'tsqm', 'Stankova', 'Elena'),
('trombik', 'tsqm', 'Trombik', 'Vojtech'),
('pristlova', 'tsqm', 'Pristlova', 'Eliska'),
('dubnicka', 'tsqm', 'Dubnicka', 'Petra'),
('veselatereza', 'tsqm', 'Vesela', 'Tereza'),
('filipova', 'tsqm', 'Filipova', 'Jana'),
('pospichalova', 'tsqm', 'Pospichalova', 'Tereza'),
('bradlova', 'tsqm', 'Bradlova', 'Pavlina'),
('vasatkova', 'tsqm', 'Vasatkova', 'Hana'),
('kocourkova', 'tsqm', 'Kocourkova', 'Dana'),
('ranochova', 'tsqm', 'Ranochova', 'Lenka'),
('adamec', 'tsqm', 'Adamec', 'Radek'),
('smrckova', 'tsqm', 'Smrckova', 'Svetlana'),
('mrazova', 'tsqm', 'Mrazova', 'Jana'),
('helova', 'tsqm', 'Helova', 'Veronika'),
('bystricka', 'tsqm', 'Bystricka', 'Lucie'),
('kochova', 'tsqm', 'Kochova', 'Gabriela'),
('nerad', 'tsqm', 'Nerad', 'Jan'),
('marsounova', 'tsqm', 'Marsounova', 'Jana'),
('dedinska', 'tsqm', 'Dedinska', 'Lucie'),
('benesovapetra', 'tsqm', 'Benesova', 'Petra'),
('brabencova', 'tsqm', 'Brabencova', 'Klara');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `medium`
-- 

CREATE TABLE `medium` (
  `nazev` varchar(50) character set cp1250 collate cp1250_czech_cs NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `medium`
-- 

INSERT INTO `medium` (`nazev`) VALUES 
('Mail'),
('Online Datebank'),
('persönliches Gespräch'),
('Post'),
('Telefon');

-- --------------------------------------------------------

-- 
-- Struktura tabulky `projekt`
-- 

CREATE TABLE `projekt` (
  `nazev` varchar(255) collate latin2_czech_cs NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `projekt`
-- 


-- --------------------------------------------------------

-- 
-- Struktura tabulky `prozess`
-- 

CREATE TABLE `prozess` (
  `nazev` varchar(50) character set cp1250 collate cp1250_czech_cs NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- 
-- Vypisuji data pro tabulku `prozess`
-- 

INSERT INTO `prozess` (`nazev`) VALUES 
('Auto reparieren'),
('Auto reinigen'),
('Boden verlegen'),
('Controlling'),
('Designer Fragebogen erstellen'),
('Energiemanagement'),
('Einkauf'),
('Elektrische Leitungen legen'),
('Heizung installieren'),
('Internetkabel verlegen, Router installieren'),
('kochen'),
('kopieren'),
('Kostenrechnung'),
('Mitarbeiterbetreuung'),
('Partnerrekrutierung'),
('Personalrekrutierung'),
('Fliesen kaufen'),
('Fliesen legen'),
('putzen'),
('Rechnung analysieren (Kostenrechnung)'),
('Rechnung erfassen'),
('Rechnung stellen'),
('scannen'),
('Schlüsselmanagement'),
('Webdatenbank Berechtigungen'),
('Sphinx Diagramme erstellen'),
('SPSS Bereinigung'),
('SPSS Dateien zusammenfassen'),
('SPSS Diagramme bilden'),
('SPSS Export nach Sphinx'),
('SPSS Tabellen benutzerdefinierte'),
('Webdatenbank Berechtigungen'),
('Webdatenbank Programmierung'),
('Webdatenbank Weiterentwicklung'),
('Transport'),
('Verträge verwalten'),
('Webdatenbank Berechtigungen'),
('Webdatenbank Programmierung'),
('Webdatenbank Weiterentwicklung');
