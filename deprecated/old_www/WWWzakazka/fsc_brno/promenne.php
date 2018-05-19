<?php
class Promenne
{
  public $mysqli;  //objektová proměnná databáze
  public $chyba;   //globální chybová hláška

  public $login;  //trida login
  public $main; //trida hlavni funkce

  public $kam;  //globální aktuální cesta
  public $meta; //globální proměnná autokliku

  public $instalace = false; //true/false//povoleno/zakázáno/ instalace tabulek databaze
  public $form = "./form"; //cesta k souborům (formam) obsahů stránek

	public $temp = "/temp/fscbrno"; //na serveru prazdne!!    "/temp/fscbrno"
	public $web; //globalni aktualni adresa
	public $default = "uvod";
	public $email = "fsc@fscbrno.cz"; //email koncoveho zakaznika
	public $hlavicky = "Content-type: text/html; charset=UTF-8"; //hlavicka emailu

	public $docasny = "docasny_soubor";  //docasny soubor fotek

	public $sekce = array (1 => "uvod",  //adresa sekci v ajaxu
                              "historie",
                              "fotogalerie",
                              "rozvrh",
                              "kurzy",
                              "akce",
                              "sponzori",
                              "kontakt",
                              "aktuality",
                              "napiste",
                              "forum",
                              "team",
                              "solo",
                              "hokej");

  public $hkontakt = array ("team" => "TEAM MORAVIA B", //hlavicky do kontaktu
                            "solo" => "SÓLOVÉ BRUSLENÍ",
                            "kurzy" => "KURZY",
                            "hokej" => "HOKEJOVÁ ŠKOLA",
                            "vykon" => "VÝKONNÝ VÝBOR");

  public $nazevsekce = array(1 => "Hlavní strana",  //nazev sekci po stankach
                                  "Historie klubu",
                                  "Fotogalerie",
                                  "Rozvrh tréninků",
                                  "Kurzy bruslení",
                                  "Přehled akcí",
                                  "Sponzoři",
                                  "Kontakt",
                                  "Aktuality",
                                  "Napište nám",
                                  "Fórum",
                                  "Team moravia B",
                                  "Sólové bruslení",
                                  "Hokejová škola");

  public $den = array (1 => "Pondělí",
                            "Úterý",
                            "Středa",
                            "Čtvrtek",
                            "Pátek",
                            "Sobota",
                            "Neděle");

	public $short = array("[url=&quot;", //kratky nahrazovaci format
                        "&quot;]",
                        "[/url]",
                        "[b]",
                        "[/b]",
                        "[i]",
                        "[/i]",
                        "[u]",
                        "[/u]",
                        "\n",
                        "[email=&quot;",
                        "[/email]",
                        "[odstavec]",
                        "[/odstavec]");

  public $long = array ("<a href=\"", //dlouhy nahrazovaci fotmat
                        "\">",
                        "</a>",
                        "<strong>",
                        "</strong>",
                        "<em>",
                        "</em>",
                        "<span style=\"text-decoration: underline;\">",
                        "</span>",
                        "<span style=\"display: block;\"></span>",
                        "<a href=\"mailto:",
                        "</a>",
                        "<p>",
                        "</p>");
}
?>
