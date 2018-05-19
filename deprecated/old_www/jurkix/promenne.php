<?php
class Promenne
{
  public $kam;	//globalni kam
  public $main;

  public $nazevdbweb = ".jurkix_dat_web.gfdesign";
  public $nazevdbgra = ".jurkix_dat_grafika.gfdesign";
  public $pocnazev = ".pocitadlo_jurkix.huh";  //jmeno databaze pocitadla
  public $jurixweb;  //objekt webu
  public $jurixgra;  //objekt grafiky
  public $jurpoc;  //objekt pocitadla
  public $chyba; //cybova hlaska
  public $cislosekce; //cislo podsekce grafiky
  public $temp = "/temp/jurkix"; //na serveru prazdne!!    "/temp/jurkix"
  public $web; //globaln aktualni adresa
  public $meta;  //globalni meta tag
  public $default = "uvod";
  public $email= "jurkix@seznam.cz, info@gfdesign.cz";
  public $slozkafull = "./obr/grafika/obr_velke";
  public $slozkamini = "./obr/grafika/obr_male";
  public $maxsize = 1572864;  //1.5M
  public $maxwidth= 120; //px - velikost miniatury
  public $docasny = "docasny_soubor";  //docasny soubor
  public $hlavicky = "Content-type: text/html; charset=UTF-8";
  public $sekce = array (1 => "flashové animace",  //texty sekcí grafiky
                              "webová grafika",
                              "kresby");
  public $short = array ("[url=&quot;",
                        "&quot;]",
                        "[/url]",
                        "[b]",
                        "[/b]",
                        "[i]",
                        "[/i]",
                        "[u]",
                        "[/u]");

  public $long = array ("<a href=\"",
                        "\">",
                        "</a>",
                        "<strong>",
                        "</strong>",
                        "<em>",
                        "</em>",
                        "<span>",
                        "</span>");
}
?>
