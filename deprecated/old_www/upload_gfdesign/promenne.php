<?php
class Promenne
{
  public $kam;  //globalni kam
  public $main; //trida funkce
  public $meta; //meta presmerovani
  public $sqlite; //trida databaze
  public $chyba;  //globalni hlaska chyby
  public $nazevdb = ".upload.upl";  //nazev databaze
  public $cachedir = "cache";  //slozka ceche souboru
  public $cachesize = ".sizeuser"; //cache soubor velikosti
  public $cachepocdir = ".pocdirfile";//cache soubor poctu slozek a suboru
  public $user = 0; //cislo prava uzivatel
  public $admin = 1;  //cislo prava admina
  public $moderator = 2;  //cislo prava moderatora
  public $pripona;  //globalni pole pripon
  public $priponapopis; //globalni pole popisu pripon
  public $web;  //nazev serveru pro absolutni cesty
  public $filedateformat = "d.m.Y H:i:s"; //globalni nastaveni formatu data posledni znemy,...
  public $cachedateformat = "d.m.Y H:i:s"; //globalni nastaveni foramtu data cache souboru

  public $exppoc = 15; //minut - kontrola zivosti dat prihlasenych uzivatelu
  public $exponline = 3; //minuty - kontola zivosti dat
  public $expliststat = 3;  //mesicu - vymazani dat ze statistiky - obsahuje pocitadlo webu! nemenit
  public $explog = 7;  //dni - vymazani dat z logovani
  public $expip = 30; //minut - limit pro dalsi zapocitani pocitadla do logovani ip
  public $explistvstup = 1; //mesicu - vymazani dat ze statistiky vstupu na stranky

  public $reloadcachesize = 6; //hodin obnova dat

  public $blok = array ("127.0.1.1",
                        "127.0.0.1",
                        "192.168.1.1",
                        "192.168.1.2",
                        "192.168.1.3",
                        "192.168.1.4",
                        "192.168.1.5",
                        "192.168.1.101",
                        "192.168.1.102",
                        "192.168.1.103",
                        "192.168.1.104",
                        "192.168.1.105");

  public $blokfile = array ("php",  //seznam nebezpecnych koncovek pro upload
                            "cgi");

  public $iduser; //globalni id prihlaseneho uzivatele
  public $pravo;  //globalni promenna prava
  public $jmeno;  //globalni jmeno uzivatele
  public $vytvoreno;  //globbalni datum vytvoreni
  public $prostor;  //globalni velikost disku uzivalele
  public $expiraceucet; //globalni cislo dni expirace uctu, 0 == neomezene
  public $expirace; //globalni cislo dni expirace, 0 == neozmezene
  public $style;  //globalni cislo grafckeho stylu uzivatele

  public $priponydir = "obr/pripony"; //slozka pripon obrazku
  public $vzhleddir = "obr/vzhled"; //slozka vzhledovych obrazku (podslozka stejna jako nazev stylu)
  public $stylesdir = "styles/vzhled"; //slozka css stylu (importu, podslozka se stajnym nazvem jako styl)

  public $default = "uvod"; //defaultni stranka
  public $userdir = "uzivatele";  //defaultni slozka uzivatelu

  public $prava = array("Uživatel", //text prava
                        "Administrátor",
                        "Moderátor");

  public $otherheader = array("addfile",  //v jakych strankach ma byt jina hlavicka(seznam jinych hlavicek)
                              "editfile");

  public $header = array ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">", //pole hlavicek ktere se dosazuji
                          "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">");

  public $prostorradio = array (3,  //hodnoty uploadu pro moderatory
                                5,
                                10,
                                15,
                                20,
                                25,
                                30);

  public $stranka = array("uvod" => "Hlavní stránka", //popisi sekci(title, odkazy)
                          "user" => "Uživatelé",
                          "adduser" => "Přidat uživatele",
                          "edituser" => "Upravit uživatele",
                          "deluser" => "Smazat uživatele",
                          "info" => "Informace o uživateli",
                          "dir" => "Složky",
                          "adddir" => "Přidat složku",
                          "editdir" => "Upravt složku",
                          "deldir" => "Smazat složku",
                          "addpwd" => "Přidat Zámek",
                          "editpwd" => "Upravit zámek",
                          "delpwd" => "Smazat zámek",
                          "file" => "Soubory",
                          "addfile" => "Přidat soubor",
                          "editfile" => "Upravit soubor",
                          "delfile" => "Smazat soubor",
                          "setright" => "Sdílení",
                          "loginaccess" => "Logovaní přístupů",
                          "counteraccess" => "Statistiky",
                          "suffix" => "Přípony",
                          "addsuffix" => "Přidat příponu",
                          "editsuffix" => "Upravit příponu",
                          "delsuffix" => "Smazat přípony",
                          "style" => "Administrace stylů",
                          "addstyle" => "Přidat styl",
                          "editstyle" => "Upravit styl",
                          "delstyle" => "Smazat styl",
                          "import" => "Administrace stylu",
                          "addimport" => "Přidat import",
                          "editimport" => "Upravit import",
                          "delimport" => "Smazat import",
                          "mainstatistic" => "Centrální statistiky",
                          "ipstatistic" => "Statistiky IP adres",
                          "instatistic" => "Statistiky příchozích lidí",
                          "logoff" => "Odhlásit"
                          );

  public $orientace = array("uvod" => "uvod", //pro orientaci v textu(zvyraznovani tlacitek)
                            "user" => "user",
                            "adduser" => "user",
                            "edituser" => "user",
                            "deluser" => "user",
                            "info" => "user",
                            "dir" => "dir",
                            "adddir" => "dir",
                            "editdir" => "dir",
                            "deldir" => "dir",
                            "addpwd" => "dir",
                            "editpwd" => "dir",
                            "delpwd" => "dir",
                            "file" => "file",
                            "addfile" => "file",
                            "editfile" => "file",
                            "delfile" => "file",
                            "setright" => "setright",
                            "loginaccess" => "loginaccess",
                            "counteraccess" => "counteraccess",
                            "mainstatistic" => "counteraccess",
                            "ipstatistic" => "counteraccess",
                            "instatistic" => "counteraccess",
                            "suffix" => "suffix",
                            "addsuffix" => "suffix",
                            "editsuffix" => "suffix",
                            "delsuffix" => "suffix",
                            "style" => "style",
                            "addstyle" => "style",
                            "editstyle" => "style",
                            "delstyle" => "style",
                            "import" => "style",
                            "addimport" => "style",
                            "editimport" => "style",
                            "delimport" => "style",
                            "logoff" => "logoff"
                            );

  public $mapa = array ("uvod" => "uvod", //mapa drobeckove navigace
                        "user" => "user",
                        "adduser" => array("user", "adduser"),
                        "edituser" => array("user", "edituser"),
                        "deluser" => array("user", "deluser"),
                        "info" => array("user", "info"),
                        "dir" => "dir",
                        "adddir" => array("dir", "adddir"),
                        "editdir" => array("dir", "editdir"),
                        "deldir" => array("dir", "deldir"),
                        "addpwd" => array("dir", "addpwd"),
                        "editpwd" => array("dir", "editpwd"),
                        "delpwd" => array("dir", "delpwd"),
                        "file" => "file",
                        "addfile" => array("file", "addfile"),
                        "editfile" => array("file", "editfile"),
                        "delfile" => array("file", "delfile"),
                        "setright" => "setright",
                        "loginaccess" => "loginaccess",
                        "counteraccess" => "counteraccess",
                        "mainstatistic" => array("counteraccess", "mainstatistic"),
                        "ipstatistic" => array("counteraccess", "ipstatistic"),
                        "instatistic" => array("counteraccess", "instatistic"),
                        "suffix" => "suffix",
                        "addsuffix" => array("suffix", "addsuffix"),
                        "editsuffix" => array("suffix", "editsuffix"),
                        "delsuffix" => array("suffix", "delsuffix"),
                        "style" => "style",
                        "addstyle" => array("style", "addstyle"),
                        "editstyle" => array("style", "editstyle"),
                        "delstyle" => array("style", "delstyle"),
                        "import" => array("style", "import"),
                        "addimport" => array("style", "import", "addimport"),
                        "editimport" => array("style", "import", "editimport"),
                        "delimport" => array("style", "import", "delimport"),
                        "logoff" => "logoff");

  public $menuuser = array ("uvod", //menu uzivatele
                            "dir",
                            "file",
                            "logoff");

  public $accesuser = array("uvod", //pristup uzivatele
                            "dir",
                            "adddir",
                            "editdir",
                            "deldir",
                            "addpwd",
                            "editpwd",
                            "delpwd",
                            "file",
                            "addfile",
                            "editfile",
                            "delfile",
                            "logoff");

  public $menumod = array("uvod", //menu moderatora
                          "user",
                          "dir",
                          "file",
                          "logoff");

  public $accesmod = array ("uvod", //pristup moderatora
                            "user",
                            "adduser",
                            "edituser",
                            "deluser",
                            "info",
                            "dir",
                            "adddir",
                            "editdir",
                            "deldir",
                            "addpwd",
                            "editpwd",
                            "delpwd",
                            "file",
                            "addfile",
                            "editfile",
                            "delfile",
                            "logoff");

  public $menuadmin = array("uvod", //menu admina
                            "user",
                            "dir",
                            "file",
                            "setright",
                            "loginaccess",
                            "counteraccess",
                            "suffix",
                            "logoff");

  public $prevod = array ("\xc3\xa1" => "a",
                          "\xc3\xa4" => "a",
                          "\xc4\x8d" => "c",
                          "\xc4\x8f" => "d",
                          "\xc3\xa9" => "e",
                          "\xc4\x9b" => "e",
                          "\xc3\xad" => "i",
                          "\xc4\xbe" => "l",
                          "\xc4\xba" => "l",
                          "\xc5\x88" => "n",
                          "\xc3\xb3" => "o",
                          "\xc3\xb6" => "o",
                          "\xc5\x91" => "o",
                          "\xc3\xb4" => "o",
                          "\xc5\x99" => "r",
                          "\xc5\x95" => "r",
                          "\xc5\xa1" => "s",
                          "\xc5\xa5" => "t",
                          "\xc3\xba" => "u",
                          "\xc5\xaf" => "u",
                          "\xc3\xbc" => "u",
                          "\xc5\xb1" => "u",
                          "\xc3\xbd" => "y",
                          "\xc5\xbe" => "z",
                          "\xc3\x81" => "A",
                          "\xc3\x84" => "A",
                          "\xc4\x8c" => "C",
                          "\xc4\x8e" => "D",
                          "\xc3\x89" => "E",
                          "\xc4\x9a" => "E",
                          "\xc3\x8d" => "I",
                          "\xc4\xbd" => "L",
                          "\xc4\xb9" => "L",
                          "\xc5\x87" => "N",
                          "\xc3\x93" => "O",
                          "\xc3\x96" => "O",
                          "\xc5\x90" => "O",
                          "\xc3\x94" => "O",
                          "\xc5\x98" => "R",
                          "\xc5\x94" => "R",
                          "\xc5\xa0" => "S",
                          "\xc5\xa4" => "T",
                          "\xc3\x9a" => "U",
                          "\xc5\xae" => "U",
                          "\xc3\x9c" => "U",
                          "\xc5\xb0" => "U",
                          "\xc3\x9d" => "Y",
                          "\xc5\xbd" => "Z",
                          " " => "_",
                          //"-" => "_",
                          "+" => "_",
                          ";" => "_",
                          ":" => "_",
                          "," => "_",
                          "'" => "_",
                          "?" => "_",
                          "<" => "_",
                          ">" => "_",
                          "\x5c" => "_",  // /
                          "\x2f" => "_",  // \
                          "|" => "_",
                          "=" => "_",
                          "!" => "_",
                          "*" => "_",
                          "@" => "_",
                          "%" => "_",
                          "&" => "_",
                          "§" => "_",
                          "#" => "_",
                          "$" => "_",
                          "\"" => "_",
                          "˚" => "_",
                          "`" => "_",
                          "~" => "_",
                          "^" => "_",
                          "€" => "_",
                          "¶" => "_",
                          "¨" => "_",
                          "ŧ" => "_",
                          "¯" => "_",
                          "←" => "_",
                          "→" => "_",
                          "↓" => "_",
                          "ø" => "_",
                          "þ" => "_",
                          "Đ" => "d",
                          "đ" => "d"
                          );
}
?>