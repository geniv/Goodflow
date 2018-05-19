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

                                                    "          <li class=\"%%5%%\">
            <a href=\"%%1%%\" title=\"%%2%%\"%%6%%>
              <span class=\"alternativa\">%%2%%</span>
            </a>
          </li>\n",

                                                    "<a href=\"%%1%%\" title=\"%%2%%\" class=\"%%5%%%%4%%%%7%%\">
                  &raquo; %%2%%
                </a>\n%%17%%                ",

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
                                                      "tvar_ente_array" => array(5), //array vycet entych
                                                      "tvar_aktivity_ente_array" => "              </div>
              <div id=\"pravy_blok_navigace2\">\n",  //oznaceni ente pro definovane array

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

                                                      "tvar_aktivity_id" => " aktivni", //oznaceni id
                                                      "tvar_aktivity_class" => " class=\"aktivni\"",  //oznaceni class

                                                      "tvar_aktivity_odkazu_LP" => array("[ ", " ]"), //pole 0 L, 1 P

                                                      "tvar_aktivity_volitelny_text" => "",  //nejaky navoleny prvek co se ma vkladat

                                                      //nacita jen n 0.indexu
                                                      "tvar_oddeleni_sub_souboru" => "_", //oddeleni subsouboru soubor_podsoubor

                                                      //nacita jen n 0.indexu
                                                      "tvar_oddeleni_sub_title" => " - ",  //oddeleni subttile title - subtitle

                                                      "zruseni_aktivity" => array(),
                                                      ),

                                                //array(...),  //dalsi volba konfigurace
                                              ),

                  "normal_menu_1" => array( array("main_href" => "domu",  //oznacovaci odkaz
                                                  "odkaz" => "Domů",      //text odkazu
                                                  "title" => " - Plus pro Váš rozvoj",      //do title
                                                  "id" => "",
                                                  "class" => "domu",
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

                                            array("main_href" => "o-nas",  //oznacovaci odkaz
                                                  "odkaz" => "O nás",      //text odkazu
                                                  "title" => " - O nás",      //do title
                                                  "id" => "",
                                                  "class" => "o-nas",
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

                                            array("main_href" => "registrace",  //oznacovaci odkaz
                                                  "odkaz" => "Registrace",      //text odkazu
                                                  "title" => " - Registrace",      //do title
                                                  "id" => "",
                                                  "class" => "registrace",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 0, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),



                                            array("main_href" => "profil",  //oznacovaci odkaz
                                                  "odkaz" => "Profil",      //text odkazu
                                                  "title" => " - Profil",      //do title
                                                  "id" => "",
                                                  "class" => "profil",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 0, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),




                                            array("main_href" => "upravit-profil",  //oznacovaci odkaz
                                                  "odkaz" => "Upravit profil",      //text odkazu
                                                  "title" => " - Upravit profil",      //do title
                                                  "id" => "",
                                                  "class" => "upravit-profil",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 0, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),



                                            array("main_href" => "public-profile",  //oznacovaci odkaz
                                                  "odkaz" => "vešejny profil",      //text odkazu
                                                  "title" => " - Upravit profil",      //do title
                                                  "id" => "",
                                                  "class" => "upravit-profil",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 0, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),


                                            array("main_href" => "hledej",  //oznacovaci odkaz
                                                  "odkaz" => "hledani",      //text odkazu
                                                  "title" => " - Upravit profil",      //do title
                                                  "id" => "",
                                                  "class" => "upravit-profil",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 0, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),









                                            array("main_href" => "ke-stazeni",  //oznacovaci odkaz
                                                  "odkaz" => "Ke stažení",      //text odkazu
                                                  "title" => " - Ke stažení",      //do title
                                                  "id" => "",
                                                  "class" => "ke-stazeni",
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



















                                            array("main_href" => "akademie-mladych-podnikatelu",  //oznacovaci odkaz
                                                  "odkaz" => "AMP",      //text odkazu
                                                  "title" => " - Akademie mladých podnikatelů",      //do title
                                                  "id" => "",
                                                  "class" => "amp",
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

                                            array("main_href" => "tiskovy-servis",  //oznacovaci odkaz
                                                  "odkaz" => "Tiskový servis",      //text odkazu
                                                  "title" => " - Tiskový servis",      //do title
                                                  "id" => "",
                                                  "class" => "tiskovy-servis",
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

                                            array("main_href" => "pro-media",  //oznacovaci odkaz
                                                  "odkaz" => "Pro média",      //text odkazu
                                                  "title" => " - Pro média",      //do title
                                                  "id" => "",
                                                  "class" => "pro-media",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 0, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),

                                            array("main_href" => "podporuji-nas",  //oznacovaci odkaz
                                                  "odkaz" => "Podporují nás",      //text odkazu
                                                  "title" => " - Podporují nás",      //do title
                                                  "id" => "",
                                                  "class" => "podporuji-nas",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 0, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),







                                            array("main_href" => "pozvanky",  //oznacovaci odkaz
                                                  "odkaz" => "Pozvánky",      //text odkazu
                                                  "title" => " - Pozvánky",      //do title
                                                  "id" => "",
                                                  "class" => "pozvanky",
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























                                            array("main_href" => "obcasnik",  //oznacovaci odkaz
                                                  "odkaz" => "Občasník",      //text odkazu
                                                  "title" => " - Občasník",      //do title
                                                  "id" => "",
                                                  "class" => "obcasnik",
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


















                                            array("main_href" => "projekty",  //oznacovaci odkaz
                                                  "odkaz" => "Projekty",      //text odkazu
                                                  "title" => " - Projekty",      //do title
                                                  "id" => "",
                                                  "class" => "projekty",
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

/*
                                                array("main_href" => "dokoncene-projekty",  //oznacovaci odkaz
                                                      "odkaz" => "Dokončené projekty",      //text odkazu
                                                      "title" => " - Dokončené projekty",      //do title
                                                      "id" => "",
                                                      "class" => "projekty",
                                                      "akce" => "",

                                                      //"menu_config" => 1, //cislo pole potrebne konfigurace

                                                      //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                      "defaultni" => false,

                                                      //zapinani zobrazerni polozek
                                                      "zobrazit_obsah" => true,
                                                      "zobrazit_title" => true,
                                                      "zobrazit_menu" => true,

                                                      "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                      "tvar_vypis_menu" => 0, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                      "tvar_get_kam" => 2,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                      "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                      "subsekcemenu" => NULL,
                                                      ),
*/


/*
                                                  "subsekcemenu" => array(array("main_href" => "sub-sekce1",  //oznacovaci odkaz
                                                                                "odkaz" => "sub sekce prvni sekce",      //text odkazu
                                                                                "title" => "sub tit 1",      //do title
                                                                                "id" => "",
                                                                                "class" => "",
                                                                                "akce" => "",

                                                                                //na kazde urovni menu 1x! jinak bude uplatnovana specifikace
                                                                                "menu_config" => 1, //cislo pole potrebne konfigurace

                                                                                //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                                                "defaultni" => false,

                                                                                //zapinani zobrazerni polozek
                                                                                "zobrazit_obsah" => true,
                                                                                "zobrazit_title" => true,
                                                                                "zobrazit_menu" => true,

                                                                                "tvar_main_href" => 4,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                                                "tvar_vypis_menu" => 2, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                                                "tvar_get_kam" => 2,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                                                "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                                                "subsekcemenu" => NULL,
                                                                                ),

*/


                                            array("main_href" => "dokoncene-projekty",  //oznacovaci odkaz
                                                  "odkaz" => "Dokončené projekty",      //text odkazu
                                                  "title" => " - Dokončené projekty",      //do title
                                                  "id" => "",
                                                  "class" => "dokoncene-projekty",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 2,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 0, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),



















                                            array("main_href" => "tipy",  //oznacovaci odkaz
                                                  "odkaz" => "Tipy",      //text odkazu
                                                  "title" => " - Tipy",      //do title
                                                  "id" => "",
                                                  "class" => "tipy",
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


































                  "normal_menu_2" => array( array("main_href" => "domu",  //oznacovaci odkaz
                                                  "odkaz" => "Domů",      //text odkazu
                                                  "title" => " - Plus pro Váš rozvoj",      //do title
                                                  "id" => "",
                                                  "class" => "domu",
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

                                            array("main_href" => "o-nas",  //oznacovaci odkaz
                                                  "odkaz" => "O nás",      //text odkazu
                                                  "title" => " - O nás",      //do title
                                                  "id" => "",
                                                  "class" => "o-nas",
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

                                            array("main_href" => "ke-stazeni",  //oznacovaci odkaz
                                                  "odkaz" => "Ke stažení",      //text odkazu
                                                  "title" => " - Ke stažení",      //do title
                                                  "id" => "",
                                                  "class" => "ke-stazeni",
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

                                            array("main_href" => "akademie-mladych-podnikatelu",  //oznacovaci odkaz
                                                  "odkaz" => "AMP",      //text odkazu
                                                  "title" => " - Akademie mladých podnikatelů",      //do title
                                                  "id" => "",
                                                  "class" => "amp",
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

                                            array("main_href" => "tiskovy-servis",  //oznacovaci odkaz
                                                  "odkaz" => "Tiskový servis",      //text odkazu
                                                  "title" => " - Tiskový servis",      //do title
                                                  "id" => "",
                                                  "class" => "tiskovy-servis",
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

                                            array("main_href" => "pro-media",  //oznacovaci odkaz
                                                  "odkaz" => "Pro média",      //text odkazu
                                                  "title" => " - Pro média",      //do title
                                                  "id" => "",
                                                  "class" => "pro-media",
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

                                            array("main_href" => "pozvanky",  //oznacovaci odkaz
                                                  "odkaz" => "Pozvánky",      //text odkazu
                                                  "title" => " - Pozvánky",      //do title
                                                  "id" => "",
                                                  "class" => "pozvanky",
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

                                            array("main_href" => "obcasnik",  //oznacovaci odkaz
                                                  "odkaz" => "Občasník",      //text odkazu
                                                  "title" => " - Občasník",      //do title
                                                  "id" => "",
                                                  "class" => "obcasnik",
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

                                            array("main_href" => "projekty",  //oznacovaci odkaz
                                                  "odkaz" => "Projekty",      //text odkazu
                                                  "title" => " - Projekty",      //do title
                                                  "id" => "",
                                                  "class" => "projekty",
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

                                            array("main_href" => "tipy",  //oznacovaci odkaz
                                                  "odkaz" => "Tipy",      //text odkazu
                                                  "title" => " - Tipy",      //do title
                                                  "id" => "",
                                                  "class" => "tipy",
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

                                            array("main_href" => "podporuji-nas",  //oznacovaci odkaz
                                                  "odkaz" => "Podporují nás",      //text odkazu
                                                  "title" => " - Podporují nás",      //do title
                                                  "id" => "",
                                                  "class" => "podporuji-nas",
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
                                          )

/* -------------------------------------------------------------------------- */

                  );

/* -------------------------------------------------------------------------- */

  return $result;
?>
