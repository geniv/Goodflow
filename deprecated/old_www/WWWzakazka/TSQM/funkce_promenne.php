<?php
class Promenne
{
  public $mysqli;  //objektová proměnná databáze
  public $chyba;   //globální chybová hláška

  public $pristup;  //programová databáze přístupů

  public $login;  //trida login
  public $main; //trida hlavni funkce
  public $zam;  //trida zamestnanec
  public $par;  //trida partneri
  public $zak;  //trida zakaznici
  public $man;  //trida managment
  public $pro;  //trida procesy
  public $ter;  //trida terminy
  public $arch; //trida archív
  public $admin;  //trida administrace

  public $kam;  //globální aktuální cesta
  public $meta; //globální proměnná autokliku
  public $jazyk;  //proměnná jazyka
  public $nowjazyk; //uchovava akualni jazyk nezavisle na cookie!
  public $loadingjazyk; //nahradni prenosna promenna pro jazyk
  public $instalace = false; //true/false//povoleno/zakázáno/ instalace tabulek databaze
  public $default = "uvod"; //dafaultní stránka při chybném zadání a nebo žádné cestě
  public $prava;  //práva zaměstnance - nastavení při logování
  public $idzam; //id zamestnace kvuli rozliseni
  public $superadmin = 1; //číslo super admina, musí být nesmazatelné a udaj "heslo" skryté
  public $web;  //absolutni cesta na serveru

  public $miniw = 128;  //velikost miniatury W - na vysku se dopocitava
  public $largw = 800;  //velikost full W - na vysku se dopocitavat
  public $maxsize = 1048576;  //max velikikost = 1M
  public $mysqlden = "%w";  //vrací číslo dne dle data, viz mysqlmynual
  public $mysqldatum = "%d.%m.%Y";  //vrací datum dle data, viz mysql manual
  public $datformat = "DD.MM.YYYY"; //ukazkovy format data - odpovida formatu: d.m.Y
  public $regdatum = "^[0-9]{2}\.[0-9]{2}\.[0-9]{4}\$";  //regularni vyraz kontroly datumu
  public $regemail = "^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}\$";  //regularni vyraz kontroly emailu
  public $regcislo= "^[0-9]*\$"; //regularn vyraz kontroly cisla
  public $regpsc = "^[0-9]{5}\$";  //regularn vyraz konroly PSC
  public $regrok = "^[0-9]{4}\$";  //regularni vyraz konroly roku
  public $regtelefon = "^[0-9]{9}\$";  //regularni vyraz kontroly telefonu
  public $emptypol = "———";  //je-li prazdna polozka

  public $dnzm = "docobrm"; //docasny soubor fotky zamestnanec mini
  public $dnzf = "docobrf"; //docasny soubor fotky zamestnanec full
  public $dnpm = "docobrmp";  //docasny soubor fotky partner mini
  public $dnpf = "docobrfp";  //docasny soubor fotky partner full
  public $dnzam = "docobrmz"; //docasny soubor fotky zakaznik mini
  public $dnzaf = "docobrfz"; //docasny soubor fotky zakaznik full

  public $procenta = array(0, 25, 50, 75, 100); //hodoty procent v urcenych selektech

  public $form = "./form"; //cesta k souborům (formam) obsahů stránek

  public $title = array("uvod" => array ("" => "uvod"), //hlavička: "adresa"=>"eqivalent"; pouze jazykové eqivalenty ne koncové hodnoty!!

                        "logoff" => array ("" => "log_off_titl"), //bez akce

                        "zamestnanci" => array ("" => "zamestnanci",  //bez akce
                                                "info" => "info",
                                                "all" => "all_zamestnanec", //sub menu (s akcí)
                                                "add" => "add_zamestnanec",
                                                "edit" => "edit_zamestnanec",
                                                "del" => "del_zamestnanec",
                                                "search" => "search_zamestnanec",
                                                "kompetence" => "kompetence_zamestnanec",
                                                "foto" => "fotografie_zamestnanec",
                                                "doba" => "doba_zamestnanec",
                                                "terminy" => "terminy_zamestnanec",
                                                "statistika" => "statistika_zamestnanec",
                                                "naklady" => "naklady_zamestnanec",
                                                "prava" => "prava_zamestnanec",
                                                "protokoly" => "protokoly_zamestnanec",
                                                "pdf" => "pdf_form",
                                                ),

                        "partneri" => array("" => "partneri", //sub menu
                                            "info" => "info",
                                            "all" => "all_partner",
                                            "add" => "add_partner",
                                            "edit" => "edit_partner",
                                            "del" => "del_partner",
                                            "search" => "search_partner",
                                            "hodnoceni" => "hodnoceni_partner",
                                            ),

                        "zakaznici" => array("" => "zakaznici",
                                             "info" => "info",
                                             "all" => "all_zakaznik",
                                             "add" => "add_zakaznik",
                                             "edit" => "edit_zakaznik",
                                             "del" => "del_zakaznik",
                                             "search" => "search_zakaznik",
                                             ),

                        "management" => array("" => "management",),

                        "procesy" => array("" => "procesy",),

                        "terminy" => array("" => "terminy",),

                        "archiv" => array("" => "archiv",),

                        "admin" => array ("" => "admin",
                                          "prava" => "pristup_admin",
                                          "zamprava" => "prava_admin",
                                          "zamzeme" => "zeme_admin",
                                          "zamvzde" => "vzde_admin",
                                          "zamstat" => "stat_admin",
                                          "zamjazyk" => "jazyk_admin",
                                          "zamhobby" => "hobby_admin",
                                          "zamsport" => "sport_admin",
                                          "zamvyska" => "vyska_admin",
                                          "strankovani" => "stran_admin",
                                          ),

                       );

  function __construct()
  {
    $this->pristup["zamestnanci"][""] = 1;  //nastdefinované cesty po stránkách
    $this->pristup["zamestnanci"]["all"] = 2;
    $this->pristup["zamestnanci"]["info"] = 3;
    $this->pristup["zamestnanci"]["add"] = 4;
    $this->pristup["zamestnanci"]["edit"] = 5;
    $this->pristup["zamestnanci"]["del"] = 6;
    $this->pristup["zamestnanci"]["search"] = 7;
    $this->pristup["zamestnanci"]["kompetence"] = 8;
    $this->pristup["zamestnanci"]["foto"] = 9;
    $this->pristup["zamestnanci"]["doba"] = 10;
    $this->pristup["zamestnanci"]["terminy"] = 11;
    $this->pristup["zamestnanci"]["statistika"] = 12;
    $this->pristup["zamestnanci"]["naklady"] = 13;
    $this->pristup["zamestnanci"]["prava"] = 14;
    $this->pristup["zamestnanci"]["protokoly"] = 15;
    $this->pristup["uvod"][""] = 16;
    $this->pristup["partneri"][""] = 17;
    $this->pristup["partneri"]["all"] = 18;
    $this->pristup["partneri"]["info"] = 19;
    $this->pristup["partneri"]["add"] = 20;
    $this->pristup["partneri"]["edit"] = 21;
    $this->pristup["partneri"]["del"] = 22;
    $this->pristup["partneri"]["search"] = 23;
    $this->pristup["logoff"][""] = 24;
      $this->pristup["izam"]["log"] = 25;
      $this->pristup["izam"]["hes"] = 26;
      $this->pristup["izam"]["jme"] = 27;
      $this->pristup["izam"]["pri"] = 28;
      $this->pristup["izam"]["pra"] = 29;
      $this->pristup["izam"]["uli"] = 30;
      $this->pristup["izam"]["cp"] = 31;
      $this->pristup["izam"]["psc"] = 32;
      $this->pristup["izam"]["mes"] = 33;
      $this->pristup["izam"]["zem"] = 34;
      $this->pristup["izam"]["te1"] = 35;
      $this->pristup["izam"]["te2"] = 36;
      $this->pristup["izam"]["ema"] = 37;
      $this->pristup["izam"]["dna"] = 38;
      $this->pristup["izam"]["jaz"] = 39;
      $this->pristup["izam"]["vzd"] = 40;
      $this->pristup["izam"]["rid"] = 41;
      $this->pristup["izam"]["poh"] = 42;
      $this->pristup["izam"]["dos"] = 43;
      $this->pristup["izam"]["dzi"] = 44;
      $this->pristup["izam"]["dpo"] = 45;
      $this->pristup["izam"]["dza"] = 46;
      $this->pristup["izam"]["dod"] = 47;
      $this->pristup["izam"]["dko"] = 48;
      $this->pristup["izam"]["sta"] = 49;
      $this->pristup["izam"]["exi"] = 50;
      $this->pristup["izam"]["hob"] = 51;
      $this->pristup["izam"]["spo"] = 52;
      $this->pristup["izam"]["rod"] = 53;
      $this->pristup["izam"]["mze"] = 54;
      $this->pristup["izam"]["mja"] = 55;
      $this->pristup["izam"]["jot"] = 56;
      $this->pristup["izam"]["pro"] = 57;
      $this->pristup["izam"]["pot"] = 58;
      $this->pristup["izam"]["jma"] = 59;
      $this->pristup["izam"]["prm"] = 60;
      $this->pristup["izam"]["pma"] = 61;
      $this->pristup["izam"]["pob"] = 62;
      $this->pristup["izam"]["pos"] = 63;
      $this->pristup["izam"]["sso"] = 64;
      $this->pristup["izam"]["mat"] = 65;
      $this->pristup["izam"]["str"] = 66;
      $this->pristup["izam"]["tst"] = 67;
      $this->pristup["izam"]["vys"] = 68;
      $this->pristup["izam"]["tvy"] = 69;
      $this->pristup["izam"]["obo"] = 70;
      $this->pristup["izam"]["tyt"] = 71;
    $this->pristup["azam"]["log"] = 72;
    $this->pristup["azam"]["hes"] = 73;
    $this->pristup["azam"]["hre"] = 74;
    $this->pristup["azam"]["jme"] = 75;
    $this->pristup["azam"]["pri"] = 76;
    $this->pristup["azam"]["pra"] = 77;
    $this->pristup["azam"]["uli"] = 78;
    $this->pristup["azam"]["cp"] = 79;
    $this->pristup["azam"]["psc"] = 80;
    $this->pristup["azam"]["mes"] = 81;
    $this->pristup["azam"]["zem"] = 82;
    $this->pristup["azam"]["te1"] = 83;
    $this->pristup["azam"]["te2"] = 84;
    $this->pristup["azam"]["ema"] = 85;
    $this->pristup["azam"]["dna"] = 86;
    $this->pristup["azam"]["jaz"] = 87;
    $this->pristup["azam"]["vzd"] = 88;
    $this->pristup["azam"]["rid"] = 89;
    $this->pristup["azam"]["poh"] = 90;
    $this->pristup["azam"]["dos"] = 91;
    $this->pristup["azam"]["dzi"] = 92;
    $this->pristup["azam"]["dpo"] = 93;
    $this->pristup["azam"]["dza"] = 94;
    $this->pristup["azam"]["dod"] = 95;
    $this->pristup["azam"]["dko"] = 96;
    $this->pristup["azam"]["sta"] = 97;
    $this->pristup["azam"]["exi"] = 98;
    $this->pristup["azam"]["hob"] = 99;
    $this->pristup["azam"]["spo"] = 100;
    $this->pristup["azam"]["rod"] = 101;
    $this->pristup["azam"]["mze"] = 102;
    $this->pristup["azam"]["mja"] = 103;
    $this->pristup["azam"]["jot"] = 104;
    $this->pristup["azam"]["pro"] = 105;
    $this->pristup["azam"]["pot"] = 106;
    $this->pristup["azam"]["jma"] = 107;
    $this->pristup["azam"]["prm"] = 108;
    $this->pristup["azam"]["pma"] = 109;
    $this->pristup["azam"]["pob"] = 110;
    $this->pristup["azam"]["pos"] = 111;
    $this->pristup["azam"]["sso"] = 112;
    $this->pristup["azam"]["mat"] = 113;
    $this->pristup["azam"]["str"] = 114;
    $this->pristup["azam"]["tst"] = 115;
    $this->pristup["azam"]["vys"] = 116;
    $this->pristup["azam"]["tvy"] = 117;
    $this->pristup["azam"]["obo"] = 118;
    $this->pristup["azam"]["tyt"] = 119;
      $this->pristup["ezam"]["log"] = 120;
      $this->pristup["ezam"]["hes"] = 121;
      $this->pristup["ezam"]["hre"] = 122;
      $this->pristup["ezam"]["jme"] = 123;
      $this->pristup["ezam"]["pri"] = 124;
      $this->pristup["ezam"]["pra"] = 125;
      $this->pristup["ezam"]["uli"] = 126;
      $this->pristup["ezam"]["cp"] = 127;
      $this->pristup["ezam"]["psc"] = 128;
      $this->pristup["ezam"]["mes"] = 129;
      $this->pristup["ezam"]["zem"] = 130;
      $this->pristup["ezam"]["te1"] = 131;
      $this->pristup["ezam"]["te2"] = 132;
      $this->pristup["ezam"]["ema"] = 133;
      $this->pristup["ezam"]["dna"] = 134;
      $this->pristup["ezam"]["jaz"] = 135;
      $this->pristup["ezam"]["vzd"] = 136;
      $this->pristup["ezam"]["rid"] = 137;
      $this->pristup["ezam"]["poh"] = 138;
      $this->pristup["ezam"]["dos"] = 139;
      $this->pristup["ezam"]["dzi"] = 140;
      $this->pristup["ezam"]["dpo"] = 141;
      $this->pristup["ezam"]["dza"] = 142;
      $this->pristup["ezam"]["dod"] = 143;
      $this->pristup["ezam"]["dko"] = 144;
      $this->pristup["ezam"]["sta"] = 145;
      $this->pristup["ezam"]["exi"] = 146;
      $this->pristup["ezam"]["hob"] = 147;
      $this->pristup["ezam"]["spo"] = 148;
      $this->pristup["ezam"]["rod"] = 149;
      $this->pristup["ezam"]["mze"] = 150;
      $this->pristup["ezam"]["mja"] = 151;
      $this->pristup["ezam"]["jot"] = 152;
      $this->pristup["ezam"]["pro"] = 153;
      $this->pristup["ezam"]["pot"] = 154;
      $this->pristup["ezam"]["jma"] = 155;
      $this->pristup["ezam"]["prm"] = 156;
      $this->pristup["ezam"]["pma"] = 157;
      $this->pristup["ezam"]["pob"] = 158;
      $this->pristup["ezam"]["pos"] = 159;
      $this->pristup["ezam"]["sso"] = 160;
      $this->pristup["ezam"]["mat"] = 161;
      $this->pristup["ezam"]["str"] = 162;
      $this->pristup["ezam"]["tst"] = 163;
      $this->pristup["ezam"]["vys"] = 164;
      $this->pristup["ezam"]["tvy"] = 165;
      $this->pristup["ezam"]["obo"] = 166;
      $this->pristup["ezam"]["tyt"] = 167;
    $this->pristup["zakaznici"][""] = 168;
    $this->pristup["management"][""] = 169;
    $this->pristup["procesy"][""] = 170;
    $this->pristup["terminy"][""] = 171;
    $this->pristup["archiv"][""] = 172;
    $this->pristup["admin"][""] = 173;
      $this->pristup["zakaznici"]["all"] = 174;
      $this->pristup["zakaznici"]["info"] = 175;
      $this->pristup["zakaznici"]["add"] = 176;
      $this->pristup["zakaznici"]["edit"] = 177;
      $this->pristup["zakaznici"]["del"] = 178;
      $this->pristup["zakaznici"]["search"] = 179;
    $this->pristup["ipar"]["naz"] = 180;  //zub
    $this->pristup["ipar"]["jme"] = 182;
    $this->pristup["ipar"]["pri"] = 183;
    $this->pristup["ipar"]["uli"] = 184;
    $this->pristup["ipar"]["cp"] = 185;
    $this->pristup["ipar"]["psc"] = 186;
    $this->pristup["ipar"]["mes"] = 187;
    $this->pristup["ipar"]["zem"] = 188;
    $this->pristup["ipar"]["te1"] = 189;
    $this->pristup["ipar"]["te2"] = 190;
    $this->pristup["ipar"]["ema"] = 191;
    $this->pristup["ipar"]["jaz"] = 192;
    $this->pristup["ipar"]["poh"] = 193;
    $this->pristup["ipar"]["dos"] = 194;
    $this->pristup["ipar"]["dka"] = 195;
    $this->pristup["ipar"]["dpo"] = 196;
    $this->pristup["ipar"]["dza"] = 197;
    $this->pristup["ipar"]["dod"] = 198;
    $this->pristup["ipar"]["dko"] = 199;
    $this->pristup["ipar"]["sta"] = 200;
    $this->pristup["ipar"]["csp"] = 201;
    $this->pristup["ipar"]["kom"] = 202;
    $this->pristup["ipar"]["exi"] = 203;
    $this->pristup["ipar"]["pra"] = 204;
    $this->pristup["ipar"]["pre"] = 205;
    $this->pristup["ipar"]["kpt"] = 206;
    $this->pristup["ipar"]["kmk"] = 207;
    $this->pristup["ipar"]["vys"] = 208;
    $this->pristup["ipar"]["ido"] = 209;
    $this->pristup["ipar"]["isr"] = 210;
    $this->pristup["ipar"]["ius"] = 211;
    $this->pristup["ipar"]["iho"] = 212;
    $this->pristup["ipar"]["tka"] = 213;
    $this->pristup["ipar"]["tdo"] = 214;
    $this->pristup["ipar"]["roz"] = 215;
    $this->pristup["ipar"]["odc"] = 216;
    $this->pristup["ipar"]["spo"] = 217;
      $this->pristup["apar"]["naz"] = 218;  //zub
      $this->pristup["apar"]["jme"] = 220;
      $this->pristup["apar"]["pri"] = 221;
      $this->pristup["apar"]["uli"] = 222;
      $this->pristup["apar"]["cp"] = 223;
      $this->pristup["apar"]["psc"] = 224;
      $this->pristup["apar"]["mes"] = 225;
      $this->pristup["apar"]["zem"] = 226;
      $this->pristup["apar"]["te1"] = 227;
      $this->pristup["apar"]["te2"] = 228;
      $this->pristup["apar"]["ema"] = 229;
      $this->pristup["apar"]["jaz"] = 230;
      $this->pristup["apar"]["poh"] = 231;
      $this->pristup["apar"]["dos"] = 232;
      $this->pristup["apar"]["dka"] = 233;
      $this->pristup["apar"]["dpo"] = 234;
      $this->pristup["apar"]["dza"] = 235;
      $this->pristup["apar"]["dod"] = 236;
      $this->pristup["apar"]["dko"] = 237;
      $this->pristup["apar"]["sta"] = 238;
      $this->pristup["apar"]["csp"] = 239;
      $this->pristup["apar"]["kom"] = 240;
      $this->pristup["apar"]["exi"] = 241;
      $this->pristup["apar"]["pra"] = 242;
      $this->pristup["apar"]["pre"] = 243;
      $this->pristup["apar"]["kpt"] = 244;
      $this->pristup["apar"]["kmk"] = 245;
      $this->pristup["apar"]["vys"] = 246;
      $this->pristup["apar"]["ido"] = 247;
      $this->pristup["apar"]["isr"] = 248;
      $this->pristup["apar"]["ius"] = 249;
      $this->pristup["apar"]["iho"] = 250;
      $this->pristup["apar"]["tka"] = 251;
      $this->pristup["apar"]["tdo"] = 252;
      $this->pristup["apar"]["roz"] = 253;
      $this->pristup["apar"]["odc"] = 254;
      $this->pristup["apar"]["spo"] = 255;
    $this->pristup["epar"]["naz"] = 256;  //zub
    $this->pristup["epar"]["jme"] = 258;
    $this->pristup["epar"]["pri"] = 259;
    $this->pristup["epar"]["uli"] = 260;
    $this->pristup["epar"]["cp"] = 261;
    $this->pristup["epar"]["psc"] = 262;
    $this->pristup["epar"]["mes"] = 263;
    $this->pristup["epar"]["zem"] = 264;
    $this->pristup["epar"]["te1"] = 265;
    $this->pristup["epar"]["te2"] = 266;
    $this->pristup["epar"]["ema"] = 267;
    $this->pristup["epar"]["jaz"] = 268;
    $this->pristup["epar"]["poh"] = 269;
    $this->pristup["epar"]["dos"] = 270;
    $this->pristup["epar"]["dka"] = 271;
    $this->pristup["epar"]["dpo"] = 272;
    $this->pristup["epar"]["dza"] = 273;
    $this->pristup["epar"]["dod"] = 274;
    $this->pristup["epar"]["dko"] = 275;
    $this->pristup["epar"]["sta"] = 276;
    $this->pristup["epar"]["csp"] = 277;
    $this->pristup["epar"]["kom"] = 278;
    $this->pristup["epar"]["exi"] = 279;
    $this->pristup["epar"]["pra"] = 280;
    $this->pristup["epar"]["pre"] = 281;
    $this->pristup["epar"]["kpt"] = 282;
    $this->pristup["epar"]["kmk"] = 283;
    $this->pristup["epar"]["vys"] = 284;
    $this->pristup["epar"]["ido"] = 285;
    $this->pristup["epar"]["isr"] = 286;
    $this->pristup["epar"]["ius"] = 287;
    $this->pristup["epar"]["iho"] = 288;
    $this->pristup["epar"]["tka"] = 289;
    $this->pristup["epar"]["tdo"] = 290;
    $this->pristup["epar"]["roz"] = 291;
    $this->pristup["epar"]["odc"] = 292;
    $this->pristup["epar"]["spo"] = 293;
      $this->pristup["izak"]["naz"] = 294;
      $this->pristup["izak"]["exi"] = 295;  //exst
      $this->pristup["izak"]["jme"] = 296;
      $this->pristup["izak"]["pri"] = 297;
      $this->pristup["izak"]["uli"] = 298;
      $this->pristup["izak"]["cp"] = 299;
      $this->pristup["izak"]["psc"] = 300;
      $this->pristup["izak"]["mes"] = 301;
      $this->pristup["izak"]["zem"] = 302;
      $this->pristup["izak"]["te1"] = 303;
      $this->pristup["izak"]["te2"] = 304;
      $this->pristup["izak"]["ema"] = 305;
      $this->pristup["izak"]["jaz"] = 306;
      $this->pristup["izak"]["poh"] = 307;
      $this->pristup["izak"]["dos"] = 308;
      $this->pristup["izak"]["dka"] = 309;
      $this->pristup["izak"]["dpo"] = 310;
      $this->pristup["izak"]["dza"] = 311;
      $this->pristup["izak"]["dod"] = 312;
      $this->pristup["izak"]["dko"] = 313;
      $this->pristup["izak"]["sta"] = 314;
      $this->pristup["izak"]["csp"] = 315;
      $this->pristup["izak"]["kom"] = 316;
    $this->pristup["azak"]["naz"] = 317;
    $this->pristup["azak"]["exi"] = 318;  //exist
    $this->pristup["azak"]["jme"] = 319;
    $this->pristup["azak"]["pri"] = 320;
    $this->pristup["azak"]["uli"] = 321;
    $this->pristup["azak"]["cp"] = 322;
    $this->pristup["azak"]["psc"] = 323;
    $this->pristup["azak"]["mes"] = 324;
    $this->pristup["azak"]["zem"] = 325;
    $this->pristup["azak"]["te1"] = 326;
    $this->pristup["azak"]["te2"] = 327;
    $this->pristup["azak"]["ema"] = 328;
    $this->pristup["azak"]["jaz"] = 329;
    $this->pristup["azak"]["poh"] = 330;
    $this->pristup["azak"]["dos"] = 331;
    $this->pristup["azak"]["dka"] = 332;
    $this->pristup["azak"]["dpo"] = 333;
    $this->pristup["azak"]["dza"] = 334;
    $this->pristup["azak"]["dod"] = 335;
    $this->pristup["azak"]["dko"] = 336;
    $this->pristup["azak"]["sta"] = 337;
    $this->pristup["azak"]["csp"] = 338;
    $this->pristup["azak"]["kom"] = 339;
      $this->pristup["ezak"]["naz"] = 340;
      $this->pristup["ezak"]["exi"] = 341;  //exist
      $this->pristup["ezak"]["jme"] = 342;
      $this->pristup["ezak"]["pri"] = 343;
      $this->pristup["ezak"]["uli"] = 344;
      $this->pristup["ezak"]["cp"] = 345;
      $this->pristup["ezak"]["psc"] = 346;
      $this->pristup["ezak"]["mes"] = 347;
      $this->pristup["ezak"]["zem"] = 348;
      $this->pristup["ezak"]["te1"] = 349;
      $this->pristup["ezak"]["te2"] = 350;
      $this->pristup["ezak"]["ema"] = 351;
      $this->pristup["ezak"]["jaz"] = 352;
      $this->pristup["ezak"]["poh"] = 353;
      $this->pristup["ezak"]["dos"] = 354;
      $this->pristup["ezak"]["dka"] = 355;
      $this->pristup["ezak"]["dpo"] = 356;
      $this->pristup["ezak"]["dza"] = 357;
      $this->pristup["ezak"]["dod"] = 358;
      $this->pristup["ezak"]["dko"] = 359;
      $this->pristup["ezak"]["sta"] = 360;
      $this->pristup["ezak"]["csp"] = 361;
      $this->pristup["ezak"]["kom"] = 362;
    $this->pristup["admin"]["prava"] = 181;  //premisteno
    $this->pristup["admin"]["zamprava"] = 219;  //premisteno
    $this->pristup["admin"]["zamzeme"] = 257;  //premisteno
    $this->pristup["admin"]["zamvzdela"] = 363;
    $this->pristup["admin"]["zamstatus"] = 364;
    $this->pristup["admin"]["zamjazyk"] = 365;
    $this->pristup["admin"]["zamhobby"] = 366;
    $this->pristup["admin"]["zamsport"] = 367;
    $this->pristup["admin"]["zamvyska"] = 368;
    $this->pristup["admin"]["strankovani"] = 369;
    /*
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    $this->pristup[""][""] = ;
    */
  }
}
?>