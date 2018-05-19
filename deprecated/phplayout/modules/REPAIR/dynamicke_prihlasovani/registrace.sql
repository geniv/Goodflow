-------------------- table:dynamiclogin_prihlasovani

CREATE TABLE dynamiclogin_prihlasovani (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    nazev VARCHAR(200),
                                    adresa TEXT,
                                    modul INTEGER UNSIGNED,
                                    funkce VARCHAR(200),
                                    adresa_funkce TEXT,
                                    index_nazev INTEGER UNSIGNED,
                                    index_datum INTEGER UNSIGNED,
                                    index_popis INTEGER UNSIGNED,
                                    popis TEXT,
                                    idcaptcha INTEGER UNSIGNED);

INSERT INTO dynamiclogin_prihlasovani (id, nazev, adresa, modul, funkce, adresa_funkce, index_nazev, index_datum, index_popis, popis, idcaptcha) VALUES ('1', 'prihlasovani na prednasky', 'prihlasovani-prednasky', '21', 'ArrayVystupObsahu', 'akce-kavarny', '0', '1', '2', 'nejaky popis pro prihlasovani', '1');

-------------------- table:dynamiclogin_akce

CREATE TABLE dynamiclogin_akce (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    prihlasovani INTEGER UNSIGNED,
                                    akceid INTEGER UNSIGNED,
                                    reg_begin DATETIME,
                                    reg_end DATETIME,
                                    prefix TEXT,
                                    typ_kontroly INTEGER UNSIGNED,
                                    kapacita INTEGER UNSIGNED,
                                    rezerva INTEGER UNSIGNED,
                                    expirace VARCHAR(50),
                                    autodel DATETIME,
                                    nazev VARCHAR(200),
                                    popis TEXT,
                                    href_id VARCHAR(200),
                                    href_class VARCHAR(200),
                                    href_akce VARCHAR(500),
                                    zobrazit BOOL,
                                    poradi INTEGER UNSIGNED);

INSERT INTO dynamiclogin_akce (id, prihlasovani, akceid, reg_begin, reg_end, prefix, typ_kontroly, kapacita, rezerva, expirace, autodel, nazev, popis, href_id, href_class, href_akce, zobrazit, poradi) VALUES ('1', '1', '12', '2010-01-22 00:00:00', '2010-01-25 00:00:00', '0->20|text1|50->80|text2|10->100', '0', '100', '0', '+1 day', '2010-01-31 00:00:00', 'Registrace [totalni akce]', 'popis totalni akce', '', '', '', '1', '1');
INSERT INTO dynamiclogin_akce (id, prihlasovani, akceid, reg_begin, reg_end, prefix, typ_kontroly, kapacita, rezerva, expirace, autodel, nazev, popis, href_id, href_class, href_akce, zobrazit, poradi) VALUES ('2', '1', '13', '2010-01-23 00:00:00', '2010-01-26 00:00:00', '0->20|text1|50->80|text2|10->100', '0', '100', '0', '+5 minutes', '2010-01-27 00:00:00', 'Registrace [asdsadsadsadsadas]', 'sdagdsgsdgfdfdhjfdhrs', '', '', '', '1', '2');

-------------------- table:dynamiclogin_registrace

CREATE TABLE dynamiclogin_registrace (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    akce INTEGER UNSIGNED,
                                    email VARCHAR(200),
                                    jmeno VARCHAR(100),
                                    prijmeni VARCHAR(100),
                                    identifikace TEXT,
                                    kontakt TEXT,
                                    zadano DATETIME,
                                    expirace DATETIME,
                                    potvrzeno DATETIME,
                                    aktivni BOOL,
                                    ucast BOOL,
                                    ip VARCHAR(50),
                                    agent VARCHAR(300),
                                    session VARCHAR(100));

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('1', '1', 'muj@mail.cz', 'jmeno', 'prijmeni', '14text152text240', '', '2010-01-23 23:02:44', '2010-01-23 23:12:44', '2010-01-24 00:37:42', '1', '0', '127.0.0.1', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; SLCC1; .NET CLR 2.0.50727; Media Center PC 5.0; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Tablet PC 2.0; FDM; Creative AutoUpdate v1.10.10)', '9727b6b934213713df11f24a476afb58');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('2', '1', 'mail@nejaky.cz', 'jmeeeno', 'priiiijmeni', '12text161text297', '', '2010-01-23 23:38:09', '2010-01-23 23:48:09', '2010-01-24 14:38:40', '1', '0', '127.0.0.1', 'Opera/9.80 (Windows NT 6.0; U; cs) Presto/2.2.15 Version/10.10', '73900070b2f807524d083332c1a21960');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('3', '2', 'email@email.cz', 'radek', 'kedar', '0text153text265', '', '2010-01-24 14:34:21', '2010-01-24 14:39:21', '', '0', '0', '192.168.2.100', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('4', '1', 'email@email.cz', 'efdf', 'dfdf', '8text174text264', '', '2010-01-24 14:34:44', '2010-01-25 14:34:44', '2010-01-24 14:38:47', '1', '0', '192.168.2.100', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('5', '1', 'jan@novak.cz', 'Jan', 'Novák', '10text172text274', '', '2010-01-24 14:36:45', '2010-01-25 14:36:45', '', '0', '0', '127.0.0.1', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; SLCC1; .NET CLR 2.0.50727; Media Center PC 5.0; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Tablet PC 2.0; FDM; Creative AutoUpdate v1.10.10)', '6fe7ebac1801f5555779578df2dd4fad');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('6', '1', 'email@email.cz', 'fkjdsh', 'hdkjfsdkjhf', '7text164text253', '', '2010-01-24 14:36:47', '2010-01-25 14:36:47', '', '0', '0', '192.168.2.100', 'Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/532.5 (KHTML, like Gecko) Chrome/4.0.249.30 Safari/532.5', '1838956bccaf294353a7725076798a8b');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('7', '1', 'lada@kul.cz', 'Ladislav', 'Kůl', '7text178text236', '', '2010-01-24 14:37:18', '2010-01-25 14:37:18', '', '0', '0', '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; cs-CZ) AppleWebKit/531.9 (KHTML, like Gecko) Version/4.0.3 Safari/531.9.1', '6497e41a39cd7d69549f9b5bb820dff2');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('8', '1', 'jan@nohavica.cz', 'Jan', 'Nohavica', '4text174text213', '', '2010-01-24 14:37:45', '2010-01-25 14:37:45', '', '0', '0', '127.0.0.1', 'Opera/9.80 (Windows NT 6.0; U; cs) Presto/2.2.15 Version/10.10', '5bc9135af21475ceba26d0c8012429b5');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('9', '1', 'zdenek@stena.cz', 'Zdeněk', 'Stěna', '7text162text241', '', '2010-01-24 14:38:13', '2010-01-25 14:38:13', '', '0', '0', '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) AppleWebKit/532.5 (KHTML, like Gecko) Chrome/4.0.249.78 Safari/532.5', 'bf89844de1ba3be3b886e4e0044cecf8');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('10', '1', 'email@email.cz', 'fkgjbdfjkgb', 'jhgbkjhfgb', '1text166text227', '', '2010-01-24 14:41:59', '2010-01-25 14:41:59', '', '0', '0', '192.168.2.100', 'Opera/9.80 (X11; Linux i686; U; cs) Presto/2.2.15 Version/10.10', '88aeb85e6488027fa65703259b52c61a');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('11', '1', 'ales@voda.cz', 'Ales', 'Voda', '0text172text286', '', '2010-01-24 14:44:10', '2010-01-25 14:44:10', '', '0', '0', '192.168.2.102', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', '8ec8151bb6f01aadea9d3b471f0c9cf0');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('12', '1', 'aaa@ccc.cz', 'bbbb', 'cccc', '20text178text278', '', '2010-01-24 14:47:07', '2010-01-25 14:47:07', '', '0', '0', '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; cs; rv:1.9.1.7) Gecko/20091221 Firefox/3.5.7 (.NET CLR 3.5.30729)', '224cdeaab793819674a82fce6feb7d7b');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('13', '1', 'email@email.cz', 'jmen', 'prim', '7text158text215', '', '2010-01-24 16:24:30', '2010-01-25 16:24:30', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('14', '1', 'email@email.cz', 'fgmndfnmb', 'jfbg', '9text159text219', '', '2010-01-24 16:25:30', '2010-01-25 16:25:30', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('15', '1', 'email@email.cz', 'sdbhv', 'dhgff', '2text163text275', '', '2010-01-24 16:26:12', '2010-01-25 16:26:12', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('16', '1', 'email@email.cz', 'fjdhf', 'djdhfjd', '6text167text215', '', '2010-01-24 16:26:37', '2010-01-25 16:26:37', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('17', '1', 'djfhjhd@jdsjd.sd', 'fjdfjhj', 'djfhdjhf', '6text163text292', '', '2010-01-24 16:31:16', '2010-01-25 16:31:16', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('18', '1', 'dgfhhj@ddfdfg.fd', 'djhfj', 'jdfjhd', '4text155text240', '', '2010-01-24 16:32:53', '2010-01-25 16:32:53', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('19', '1', 'skdjsdk@dkfjdkf.df', 'jdfjhjkjllj', 'dkfdfhfg', '7text150text223', '', '2010-01-24 16:36:11', '2010-01-25 16:36:11', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('20', '1', 'email@email.cz', 'sdghjg', 'Šhfgdhfg', '9text161text270', '', '2010-01-24 16:40:04', '2010-01-25 16:40:04', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('21', '1', 'email@email.cz', 'dfndfk', 'kfhgjfgfg', '16text176text215', '', '2010-01-24 16:42:21', '2010-01-25 16:42:21', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('22', '1', 'email@email.cz', 'fkjghdjkh', 'bjjdhf', '12text158text256', '', '2010-01-24 16:43:09', '2010-01-25 16:43:09', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('23', '1', 'email@email.cz', 'dgfjksbj', 'hjjfkghgf', '8text162text219', '', '2010-01-24 16:43:30', '2010-01-25 16:43:30', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('24', '1', 'email@email.cz', 'fkgjhdjh', 'jksqcvfb', '9text169text252', '', '2010-01-24 16:43:52', '2010-01-25 16:43:52', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('25', '1', 'email@email.cz', 'hdfjk', 'fghdjf', '10text166text263', '', '2010-01-24 16:44:30', '2010-01-25 16:44:30', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('26', '1', 'email@email.cz', 'qurtihgnu', 'yxcgjkhf', '0text162text280', '', '2010-01-24 16:45:00', '2010-01-25 16:45:00', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('27', '1', 'email@email.cz', 'dfjfj', 'xykjh', '12text165text276', '', '2010-01-24 16:46:55', '2010-01-25 16:46:55', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('28', '1', 'email@email.cz', 'toz ja', 'toz prijmeni', '4text159text218', '', '2010-01-24 16:48:55', '2010-01-25 16:48:55', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('29', '1', 'mail@mail.cz', 'jmeeeeno', 'priiiiiijmeni', '15text158text282', '', '2010-01-24 16:49:38', '2010-01-25 16:49:38', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');

INSERT INTO dynamiclogin_registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, expirace, potvrzeno, aktivni, ucast, ip, agent, session) VALUES ('30', '1', 'nejaky@maaail.cz', 'totalni', 'úcastnik', '12text178text294', '', '2010-01-24 16:50:37', '2010-01-25 16:50:37', '', '0', '0', '192.168.2.151', 'Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7', 'f0b2152af5add61dec04ed651a6bb751');
