DROP TABLE sablona_kniha;
CREATE TABLE sablona_kniha (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      adresa TEXT,
                                      razeni VARCHAR(50),
                                      nove_rss INTEGER UNSIGNED,
                                      nazev VARCHAR(200),
                                      popisek TEXT,
                                      href_id VARCHAR(200),
                                      href_class VARCHAR(200),
                                      href_akce VARCHAR(500),
                                      zobrazit BOOL);
INSERT INTO sablona_kniha (id, adresa, razeni, nove_rss, nazev, popisek, href_id, href_class, href_akce, zobrazit) VALUES ('1', 'navstevni-kniha', 'DESC', '10', 'Návštěvní kniha', '', '', '', '', '1');
DROP TABLE obsah_sablony_kniha;
CREATE TABLE obsah_sablony_kniha (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      sablona INTEGER UNSIGNED,
                                      obsah TEXT,
                                      pridano DATETIME,
                                      zobrazit BOOL);
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('3', '1', '0||--x--||sdfsad|-x-|1||--x--||asd@sad.sad|-x-|1|-x-|dfhjklzdsdfg gsdfghkfshgf dshjklgfdss dfjhgkhgfds hgkjahdgkj h ghdghgh|-x-|', '2009-07-16 21:47:10', '1');
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('4', '1', '0||--x--||dsfghjklů|-x-|0||--x--||sad@sdfa.asd|-x-|1|-x-|saddgsds sdgs sdg |-x-|', '2009-07-16 21:56:57', '1');
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('5', '1', '0||--x--||aaaa|-x-|0||--x--||aa@aaa.aaa|-x-|1|-x-|assadf asadfas ds a a a as f a a a a a a a a a|-x-|22:04, 16.07.2009', '2009-07-16 21:59:10', '1');
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('6', '1', '0||--x--||pokus|-x-|0||--x--||email@email.cz|-x-|1|-x-|bleeeeeeeee|-x-|22:05, 16.07.2009', '2009-07-16 22:05:24', '1');
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('7', '1', '0||--x--||fdsfdf|-x-|0||--x--||email@email.cz|-x-|1|-x-|ddsfasdf  d s d sd sd sd sds|-x-|', '2009-07-16 22:06:29', '1');
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('8', '1', '0||--x--||asdfghj|-x-|0||--x--||sad@sdasd.asd|-x-|1|-x-|sadfsad sad sa dsa d sad sa dsa ds ad sad sa dsa d sa dsa d sa d sad sa d|-x-|', '2009-07-16 22:08:34', '1');
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('9', '1', '0||--x--||ddfdfdfdf|-x-|0||--x--||email@email.cz|-x-|1|-x-|fdfdsfdsf|-x-|22:21, 16.07.2009', '2009-07-16 22:21:34', '1');
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('10', '1', '0||--x--||dffxdf|-x-|0||--x--||email@email.cz|-x-|1|-x-|dsfdsff|-x-|22:22, 16.07.2009', '2009-07-16 22:22:26', '1');
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('11', '1', '0||--x--||dsfdsf|-x-|0||--x--||email@email.cz|-x-|1|-x-|asdsadsd|-x-|22:22, 16.07.2009', '2009-07-16 22:22:59', '1');
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('12', '1', '0||--x--||asdasd|-x-|0||--x--||sad@sad.asd|-x-|1|-x-|sadasdasdsadssadasdasdad|-x-|22:23, 16.07.2009', '2009-07-16 22:23:04', '1');
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('13', '1', '0||--x--||sadasdasd|-x-|0||--x--||sad@asd.sad|-x-|1|-x-|sadsdsasads ad sa ds d sad sa dsa d|-x-|22:25, 16.07.2009', '2009-07-16 22:26:04', '1');
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('14', '1', '0||--x--||jmenno|-x-|0||--x--||mail@pico.cz|-x-|1|-x-|kokooooooot kokooooooot kokooooooot kokooooooot kokooooooot |-x-|22:27, 16.07.2009', '2009-07-16 22:28:05', '1');
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('15', '1', '0||--x--||Šárka Hostinská|-x-|0||--x--||sarkahostinska@seznam.cz|-x-|1|-x-|Dobrý den ráda bych se zeptala jestli prodáváte vodní dýmky. Děkuji za brzskou odpověď na můj email s pozdravem Šárka Hostinská|-x-|22:51, 16.07.2009', '2009-07-16 22:54:48', '1');
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('16', '1', '0||--x--||Šárka Hostinská|-x-|1||--x--||sarkahostinska@seznam.cz|-x-|1|-x-|Dobrý den ráda bych se zeptala jestli prodáváte vodní dýmky. Děkuji za brzskou odpověď na můj email s pozdravem Šárka H
Dobrý den ráda bych se zeptala jestli prodáváte vodní dýmky. Děkuji za brzskou odpověď na můj email s pozdravem Šárka H|-x-|23:02, 16.07.2009', '2009-07-16 23:03:04', '1');
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('17', '1', '0||--x--||sadsad|-x-|0||--x--||sad@asd.sad|-x-|1|-x-|<">"><" zkouskaaaaa $ .... & ...|-x-|23:10, 16.07.2009', '2009-07-16 23:10:32', '1');
INSERT INTO obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit) VALUES ('18', '1', '0||--x--||meno admin|-x-|0||--x--||mail@pico.cz|-x-|1|-x-|frsadf sdf sdf sdf ds fsdf dsf dsfsdf sdg dfsgsdg sfrsadf sdf sdf sdf ds fsdf dsf dsfsdf sdg dfsgsdg sfrsadf sdf sdf sdf ds fsdf dsf dsfsdf sdg dfsgsdg sfrsadf sdf sdf sdf ds fsdf dsf dsfsdf sdg dfsgsdg s|-x-|23:49, 16.07.2009', '2009-07-16 23:49:42', '1');
DROP TABLE element_kniha;
CREATE TABLE element_kniha (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      sablona INTEGER UNSIGNED,
                                      typ INTEGER UNSIGNED,
                                      nazev VARCHAR(200),
                                      value VARCHAR(200),
                                      input_id VARCHAR(200),
                                      input_class VARCHAR(200),
                                      input_akce VARCHAR(200),
                                      povinne BOOL,
                                      skryt_obsah BOOL,
                                      vstupni_typ INTEGER UNSIGNED,
                                      reg_exp VARCHAR(500),
                                      vystupni_format VARCHAR(200),
                                      min_val INTEGER UNSIGNED,
                                      max_val INTEGER UNSIGNED,
                                      poradi INTEGER UNSIGNED);
INSERT INTO element_kniha (id, sablona, typ, nazev, value, input_id, input_class, input_akce, povinne, skryt_obsah, vstupni_typ, reg_exp, vystupni_format, min_val, max_val, poradi) VALUES ('1', '1', '1', 'Jméno:', '', '', '', '', '1', '0', '0', '', '', '0', '0', '1');
INSERT INTO element_kniha (id, sablona, typ, nazev, value, input_id, input_class, input_akce, povinne, skryt_obsah, vstupni_typ, reg_exp, vystupni_format, min_val, max_val, poradi) VALUES ('2', '1', '1', 'E-mail:', '@', '', '', '', '1', '1', '2', '/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/', '', '0', '0', '2');
INSERT INTO element_kniha (id, sablona, typ, nazev, value, input_id, input_class, input_akce, povinne, skryt_obsah, vstupni_typ, reg_exp, vystupni_format, min_val, max_val, poradi) VALUES ('3', '1', '3', 'Příklad:', '1', '', '', '', '1', '0', '0', '', '', '0', '0', '3');
INSERT INTO element_kniha (id, sablona, typ, nazev, value, input_id, input_class, input_akce, povinne, skryt_obsah, vstupni_typ, reg_exp, vystupni_format, min_val, max_val, poradi) VALUES ('4', '1', '2', 'Text:', '', '', '', '', '1', '0', '0', '', '', '0', '0', '4');
INSERT INTO element_kniha (id, sablona, typ, nazev, value, input_id, input_class, input_akce, povinne, skryt_obsah, vstupni_typ, reg_exp, vystupni_format, min_val, max_val, poradi) VALUES ('5', '1', '6', 'Datum a čas:', '', '', '', '', '0', '0', '0', '', 'H:i, d.m.Y', '0', '0', '5');

