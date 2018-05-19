<?php

/**
 *
 * Centralni promenne projektu, uzivatelsky definovane promenne se dedi 'extends UserPromenne'
 *
 */

  include_once "login_promenne.php";  //vlozeni unikatnich loginu
  class Promenne extends LoginMySQLi
  {
    public $main = array();   //hlavni pole tridy funkci
    public $chyba = "";  //globalni hlaska chyby
      public $preload;  //prednacteni funkci, do pole ????
    public $adminlogin;  //promenna pro predani prihlasovaciho formulare
    public $adminuser;  //prihlaseny uzivatel

    public $administrace = "http://admin.gfdesign.cz/"; //adresa adminu spravy webu (+depozit)

    public $admin_expire = "+2 hours"; //expirace z adminu, http://php.net/manual/en/function.strtotime.php
    public $nazevwebu = "PHPLayout";  //definuje nazev webu
    public $adresaadminu = "\$ad";    //text adresy do adminu
    public $admin_mod = false;  //bool aktivity adminu
    public $aktivniadmin = false; //je-li admin prihlasen bude true a aktvuje prvky s adminem
    public $waitindex = false;  //nastaveni wait indexu
    public $souborymenu = "sekce";  //umisteni souboru obsahu
    public $get_kam = "action";
    public $get_idmodul = "modul";
    public $admin_permit; //pole opravneni pro admin uzivatele
    public $permit_mod = false; //bool, permission opravneni v superglobalu
    public $browscap = array(); //pole pro preneseni nacteneho browscap-u
    public $useradmin_id = 0; //id cislo prihlaseneho uzivatele
    public $useradmin_permission = 0; //id cislo permission aktualniho uzivatele

    public $absolutni_url = "";  //url adresa layoutu

    public $dirmodule = "modules"; //slozka modulu, verejne dostupna

    public $phpmin = 50200;  //chranenna promena cisla minimalni verze php (5.2.0) - pro linux, win min 50300

    public $asocmoduly; //asociativni pole modulu, misto indexu je nazev tridy, hodnota je poradi
    public $moduly = array(); //hlavni promenna modulu
    public $ipblok = array(); //hlavni promenna ipbloku

    //napevno definovane cesty
    public $mpdfcore = "mpdf/mpdf.php"; //mpdf jadro

    //geoip prijde asi pryc?...
    public $geoipinc = "geoip/geoip.inc"; //trida geo ip
    public $geoipdat = "geoip/GeoIP.dat"; //datovy soubor pro geo ip

    //napevno pro web
    public $jquerycore_web = "script/jquery/jquery-1.4.4.min.js"; //jquery jadro pro web
    public $jqueryui_web = "script/jquery/jquery-ui-1.8.6.custom.min.js"; //jquery UI pro web
    //napevno definovane cesty js
    public $jquerycore = "script/jquery/admin/jquery-1.4.4.min.js"; //jquery jadro
    public $jqueryui = "script/jquery/admin/jquery-ui-1.8.6.custom.min.js"; //jquery UI

    public $highslide = "script/highslide/highslide-full.min.js"; //highslide script
    public $highcharts = "script/highcharts/highcharts.js"; //highcharts script
    //potrebne moduly pro spravnou funkci layoutu, poopravit na zaklade novych modulu
    public $needexmod = array("SQLite", "sqlite3", "mysqli",
                              "zip", "gd", "imagick", "hash",
                              "iconv", "date", "curl", "SimpleXML");
//?!! dodelat! oddelat?! asi prijde pryc...
    public $error_code = array ("crit" => "Kritická",
                                "info" => "Informační");

    //napevno napsane, debug neplati
    public $adminpristup = array ("6342fd9364b41005acce71e244849183" => array("93f9a5d3507bbd81db94663fd09dc866", "UmFkZWs="),
                                  "48acfd8edd4b6009c8257490df01c717" => array("7c8c47575b1ff8a0a34e871a33b5954f", "TWFydGlu"),
                                  );
  }


?>
