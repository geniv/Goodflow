<?php

/* -------------------------------------------------------------------------- */

  $result = array(
                  //toto se bude jen nacitat
                  //tvar main_href odkazu
                  "array_tvar_main_href" => array("", //zamerne prazdne pole
                                                  "%%1%%",
                                                  "%%1%%%%3%%",
                                                  "%%3%%",
                                                  "%%1%%%%2%%/%%3%%"),

                  //tvar vypisu menu
                  "array_tvar_vypis_menu" => array ("", //zamerne prazdne pole

                                                    "          <li class=\"%%3%%\">
            <span class=\"podklad%%4%%\"><!-- --></span>
            <a href=\"%%1%%\" title=\"%%2%%\">
              <span class=\"alternativa\">%%2%%</span>
            </a>
          </li>\n",

                                                    "            <li class=\"%%3%%\">
              <a href=\"%%1%%\" title=\"%%2%%\"%%6%%>
                <span class=\"alternativa\">%%2%%</span>
              </a>
            </li>\n",
                                                    "další tvar menu...",
                                                    ),

                  //tvar get_kam adresy
                  "array_tvar_get_kam" => array("", //zamerne prazdne pole
                                                "action",
                                                "sub",
                                                "podsub",
                                                ),


                  "array_tvar_spojeni_sub" => array("", //zamerne prazdne pole
                                                    "%%1%%%%2%%",
                                                    "%%1%%/%%2%%",
                                                    ),

                  //pole konfiguraci, nacita se vzdy na zacatku noveho zanoreni v 0.indexu
                  "array_menu_config" => array( array(),  //zamerne prazdne pole
                                                array("tvar_aktivity_prvni" => "_prvni",  //oznaceni prvniho
                                                      "tvar_aktivity_posledni" => "_posledni", //oznaceni posledniho

                                                      "tvar_aktivity_global_prvni" => "_prvni blobal",  //oznaceni prvniho
                                                      "tvar_aktivity_global_posledni" => "_posledni global", //oznaceni posledniho

                                                        //ente vycet pole
                                                      "tvar_ente_array" => array(1, 2, 5), //array vycet entych
                                                      "tvar_aktivity_ente_array" => "_aktivniarray (1,2,5)",  //oznaceni ente pro definovane array

                                                        //ente vycet pole globalni
                                                      "tvar_ente_global_array" => array(1, 3, 4), //array vycet entych
                                                      "tvar_aktivity_ente_global_array" => "_aktivniarray global (1,3,4)",  //oznaceni ente pro definovane array

                                                        //ente linearni od-po
                                                      "tvar_ente_od" => 0,  //pocatek
                                                      "tvar_ente_po" => 2,  //krok
                                                      "tvar_aktivity_ente_odpo" => "_aktivniodpo",  //oznaceni ente pro od-po

                                                        //ente linearni od-po globalni
                                                      "tvar_ente_global_od" => 0,  //pocatek
                                                      "tvar_ente_global_po" => 2,  //krok
                                                      "tvar_aktivity_ente_global_odpo" => "_aktivniodpo global",  //oznaceni ente pro od-po

                                                      "tvar_aktivity_id" => " aktivni_podklad", //oznaceni id
                                                      "tvar_aktivity_class" => " class=\"aktivni\"",  //oznaceni class

                                                      "tvar_aktivity_odkazu_LP" => array("[ ", " ]"), //pole 0 L, 1 P

                                                      "tvar_aktivity_volitelny_text" => "<span></span>",  //nejaky navoleny prvek co se ma vkladat

                                                      //nacita jen n 0.indexu
                                                      "tvar_oddeleni_sub_souboru" => "_", //oddeleni subsouboru soubor_podsoubor

                                                      //nacita jen n 0.indexu
                                                      "tvar_oddeleni_sub_title" => " - ",  //oddeleni subttile title - subtitle

                                                      "zruseni_aktivity" => array(),
                                                      ),

                                                //array(...),  //dalsi volba konfigurace
                                              ),

                  //toto se bude nacitat a prepisovat
                  "normal_menu_1" => array( array("main_href" => "uvod",  //oznacovaci odkaz
                                                  "odkaz" => "Index",      //text odkazu
                                                  "title" => "",      //do title
                                                  "id" => "sekce_index",
                                                  "class" => "",
                                                  "akce" => "",

                                                  //toto je 0.index!!!
                                                  //na kazde urovni menu 1x! jinak bude uplatnovana specifikace
                                                  "menu_config" => 1, //cislo pole potrebne konfigurace

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => true,  //kdyz bude true tak main_href bude ""

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 1,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 1, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),

                                            array("main_href" => "salon",  //oznacovaci odkaz
                                                  "odkaz" => "Salon",      //text odkazu
                                                  "title" => " - Salon",      //do title
                                                  "id" => "sekce_salony",
                                                  "class" => "",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 1, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu



                                                  "subsekcemenu" => array(array("main_href" => "studio-puls",  //oznacovaci odkaz
                                                                                "odkaz" => "STUDIO PULS",      //text odkazu
                                                                                "title" => "STUDIO PULS",      //do title
                                                                                "id" => "sekce_salony",
                                                                                "class" => "",
                                                                                "akce" => "",

                                                                                //na kazde urovni menu 1x! jinak bude uplatnovana specifikace
                                                                                "menu_config" => 1, //cislo pole potrebne konfigurace

                                                                                //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                                                "defaultni" => true,

                                                                                //zapinani zobrazerni polozek
                                                                                "zobrazit_obsah" => true,
                                                                                "zobrazit_title" => true,
                                                                                "zobrazit_menu" => false,

                                                                                "tvar_main_href" => 4,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                                                "tvar_vypis_menu" => 0, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                                                "tvar_get_kam" => 2,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                                                "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                                                "subsekcemenu" => NULL,
                                                                                ),
/*
                                                                          array("main_href" => "salon-puls",  //oznacovaci odkaz
                                                                                "odkaz" => "SALON PULS",      //text odkazu
                                                                                "title" => "SALON PULS",      //do title
                                                                                "id" => "sekce_salony",
                                                                                "class" => "",
                                                                                "akce" => "",

                                                                                //na kazde urovni menu 1x! jinak bude uplatnovana specifikace
                                                                                //"menu_config" => 1, //cislo pole potrebne konfigurace

                                                                                //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                                                "defaultni" => false,

                                                                                //zapinani zobrazerni polozek
                                                                                "zobrazit_obsah" => true,
                                                                                "zobrazit_title" => true,
                                                                                "zobrazit_menu" => false,

                                                                                "tvar_main_href" => 4,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                                                "tvar_vypis_menu" => 0, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                                                "tvar_get_kam" => 2,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                                                "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                                                "subsekcemenu" => NULL,
                                                                                ),

                                                                          array("main_href" => "salon-pulsline",  //oznacovaci odkaz
                                                                                "odkaz" => "SALON PULSLINE",      //text odkazu
                                                                                "title" => "SALON PULSLINE",      //do title
                                                                                "id" => "sekce_salony",
                                                                                "class" => "",
                                                                                "akce" => "",

                                                                                //na kazde urovni menu 1x! jinak bude uplatnovana specifikace
                                                                                //"menu_config" => 1, //cislo pole potrebne konfigurace

                                                                                //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                                                "defaultni" => false,

                                                                                //zapinani zobrazerni polozek
                                                                                "zobrazit_obsah" => true,
                                                                                "zobrazit_title" => true,
                                                                                "zobrazit_menu" => false,

                                                                                "tvar_main_href" => 4,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                                                "tvar_vypis_menu" => 0, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                                                "tvar_get_kam" => 2,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                                                "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                                                "subsekcemenu" => NULL,
                                                                                ),*/
                                                                         ),
                                                  ),

                                            array("main_href" => "galerie-ucesu",  //oznacovaci odkaz
                                                  "odkaz" => "Galerie účesů",      //text odkazu
                                                  "title" => " - Galerie účesů",      //do title
                                                  "id" => "sekce_galerie_ucesu",
                                                  "class" => "",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 1, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),

                                            array("main_href" => "aktuality",  //oznacovaci odkaz
                                                  "odkaz" => "Aktuality",      //text odkazu
                                                  "title" => " - Aktuality",      //do title
                                                  "id" => "sekce_aktuality",
                                                  "class" => "",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 1, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),

                                            array("main_href" => "kontakt",  //oznacovaci odkaz
                                                  "odkaz" => "Kontakt",      //text odkazu
                                                  "title" => " - Kontakt",      //do title
                                                  "id" => "sekce_kontakt",
                                                  "class" => "",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 1, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),

                                            array("main_href" => "pulsteam",  //oznacovaci odkaz
                                                  "odkaz" => "Pulsteam",      //text odkazu
                                                  "title" => " - Pulsteam",      //do title
                                                  "id" => "sekce_pulsteam",
                                                  "class" => "",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 1, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),
                                          ),














                  "normal_menu_2" => array( array("main_href" => "uvod",  //oznacovaci odkaz
                                                  "odkaz" => "Index",      //text odkazu
                                                  "title" => "",      //do title
                                                  "id" => "sekce_index",
                                                  "class" => "",
                                                  "akce" => "",

                                                  //toto je 0.index!!!
                                                  //na kazde urovni menu 1x! jinak bude uplatnovana specifikace
                                                  "menu_config" => 1, //cislo pole potrebne konfigurace

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => true,  //kdyz bude true tak main_href bude ""

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 1,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 2, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),

                                            array("main_href" => "salon",  //oznacovaci odkaz
                                                  "odkaz" => "Salon",      //text odkazu
                                                  "title" => " - Salon",      //do title
                                                  "id" => "sekce_salony",
                                                  "class" => "",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 2, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),

                                            array("main_href" => "galerie-ucesu",  //oznacovaci odkaz
                                                  "odkaz" => "Galerie účesů",      //text odkazu
                                                  "title" => " - Galerie účesů",      //do title
                                                  "id" => "sekce_galerie_ucesu",
                                                  "class" => "",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 2, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),

                                            array("main_href" => "aktuality",  //oznacovaci odkaz
                                                  "odkaz" => "Aktuality",      //text odkazu
                                                  "title" => " - Aktuality",      //do title
                                                  "id" => "sekce_aktuality",
                                                  "class" => "",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 2, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),

                                            array("main_href" => "kontakt",  //oznacovaci odkaz
                                                  "odkaz" => "Kontakt",      //text odkazu
                                                  "title" => " - Kontakt",      //do title
                                                  "id" => "sekce_kontakt",
                                                  "class" => "",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 2, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),

                                            array("main_href" => "pulsteam",  //oznacovaci odkaz
                                                  "odkaz" => "Pulsteam",      //text odkazu
                                                  "title" => " - Pulsteam",      //do title
                                                  "id" => "sekce_pulsteam",
                                                  "class" => "",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 2, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),
                                          ),

/* -------------------------------------------------------------------------- */

                  );

/* -------------------------------------------------------------------------- */

  return $result;
?>
