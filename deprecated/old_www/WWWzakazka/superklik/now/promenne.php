<?php
class Promenne
{
  public $mysqli;  //objektova promenna databaze
  public $chyba;   //globalni chybova hlaska

  public $login;  //promenna pro preneseni loginu
  public $main; //promenna pro preneseni hlavni funkce do podfunkci

  public $temp = "";   //na webu prazdne   /temp/superklik
  public $web;  //globalni adresa webu
  public $kam;  //globalni aktualni cesta
  public $meta; //globalni promenna autokliku
  public $instalace = false; //true/false //povoleno/zakazano/ instalace tabulek databaze
  public $default = "admin_uvod"; //defaultni stranka pri chybnem zadani a nebo zadne ceste
  public $form = "./form";  //cesta k souborum obsahu stranek
  public $cache = "./cache";  //cache slozka
  public $bubpic = "./valce_img"; //slozka obrazku bubnu
  public $vyhpic = "./obr/vyhry"; //slozka obrazku vyher

  public $timexprucet = 48; //hodin - vyprseni uctu
  public $expiracelogovani = 7; //dni - promazani zaznamu
  public $expiracepocitadla = 30; //minut - dalsi pripocteni pocitadla
  public $expiraceadresy = 5; //mesice - promazani zaznamu adres - tj i POCITADLA!!!!
  public $expiracelos = 7; //dni - expirace zaznamu losovani

  public $cachetimezpravy = 20; //minut obnoveni cache pameti

  public $hlavicky = "Content-type: text/html; charset=UTF-8\r\nFrom: Superklik.cz <info@superklik.cz>";

  public $blokzpravy = array ("VIDEO:",  //blokovane slova ve zpravach
                              "OBRAZEM:",
                              "STEM:",
                              "CVVM:");

  public $rimske = array (1 => "I",
                          2 => "II",
                          3 => "III",
                          4 => "IV",
                          5 => "V",
                          6 => "VI",
                          7 => "VII",
                          8 => "VIII",
                          9 => "IX",
                          10 => "X",
                          11 => "XI",
                          12 => "XII",
                          13 => "XIII",
                          14 => "XIV",
                          15 => "XV",
                          16 => "XVI",
                          17 => "XVII",
                          18 => "XVIII",
                          19 => "XIX",
                          20 => "XX",
                          );

  public $menu = array ("uvod" => "Úvod", //adresa => popisek
                        "bubny" => "Bubny",
                        "user" => "Uživatelé",
                        //"reg" => "Registrace", //prozatim vypusteno
                        //ankety
                        //kontakty
                        "vyhry" => "Listina výher",
                        "faq" => "FAQ",
                        "poc" => "Počítadla",
                        "stat" => "Logování",
                        //"rekl" => "Reklama",  //prozatim vypusteno
                        "los" => "Losování",
                        "bann" => "Banery",
                        "ceny" => "Ceník",
                        "prav" => "Pravidla",
                        "post" => "Pošta",
                        "hrom" => "Rozesílání e-mailů",
                        "vyh" => "Výherci",
                        "dot" => "Dotazník",
                        "logoff" => "Odhlásit se");

  public $textneuspechu = array("Litujeme, dnes není Váš štastný den. Zkuste to prosím jindy...",
                                "Bohužel dnes nemáte štěstí. Zkuste to prosím jindy...",
                                "Nevyhrál(a) jste. Zkuste to prosím jindy...",
                                );

  public $jazykinterpretu = "var interpretsada = new Array('[span]', '[/span]', '[b]', '[/b]', '[i]', '[/i]', '[u]', '[/u]', '[center]', '[/center]');";

  public $interet = array("span",
                          "b",
                          "i",
                          "u",
                          "center"
                          );

  public $interpret_hledat = array ("[span]",
                                    "[/span]",
                                    "\n",
                                    "[b]",
                                    "[/b]",
                                    "[i]",
                                    "[/i]",
                                    "[u]",
                                    "[/u]",
                                    "[center]",
                                    "[/center]"
                                    );

  public $interpret_nadradit = array ("<span>",
                                      "</span>",
                                      "<br>",
                                      "<b>",
                                      "</b>",
                                      "<i>",
                                      "</i>",
                                      "<u>",
                                      "</u>",
                                      "<span class=\"prazdny_text\">",
                                      "</span>"
                                      );

  public $interpret_empty = array("",
                                  "",
                                  "",
                                  "",
                                  "",
                                  "",
                                  "",
                                  "",
                                  "",
                                  "",
                                  "",);

  public $ipblok = array ("127.0.1.1",
                          "127.0.0.1",
                          "192.168.1.1",
                          "192.168.1.2",
                          "192.168.1.3",
                          "192.168.1.4",
                          "192.168.1.5",
                          "192.168.1.6",
                          "192.168.1.7",
                          "192.168.1.8",
                          "192.168.1.9",
                          "192.168.1.10",
                          "192.168.1.11",
                          "192.168.1.12",
                          "192.168.1.13",
                          "192.168.1.14",
                          "192.168.1.15",
                          "192.168.1.16",
                          "192.168.1.17",
                          "192.168.1.18",
                          "192.168.1.19",
                          "192.168.1.20",
                          "192.168.1.21",
                          "192.168.1.22",
                          "192.168.1.23",
                          "192.168.1.24",
                          "192.168.1.25",
                          "192.168.1.26",
                          "192.168.1.27",
                          "192.168.1.28",
                          "192.168.1.29",
                          "192.168.1.30",
                          "192.168.1.31",
                          "192.168.1.32",
                          "192.168.1.33",
                          "192.168.1.34",
                          "192.168.1.35",
                          "192.168.1.36",
                          "192.168.1.37",
                          "192.168.1.38",
                          "192.168.1.39",
                          "192.168.1.40",
                          "192.168.1.41",
                          "192.168.1.42",
                          "192.168.1.43",
                          "192.168.1.44",
                          "192.168.1.45",
                          "192.168.1.46",
                          "192.168.1.47",
                          "192.168.1.48",
                          "192.168.1.49",
                          "192.168.1.50",
                          "192.168.1.101",
                          "192.168.1.102",
                          "192.168.1.103",
                          "192.168.1.104",
                          "192.168.1.105");
}
?>
