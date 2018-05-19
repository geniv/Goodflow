<?php

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

                                                    "          <li>
            <a href=\"%%1%%\" title=\"%%2%%\"%%3%%%%4%%>
              %%2%%  t1: class=\"%%6%%\"
              <span><!-- --></span>
            </a>
          <ul>
            (vnorene bude tak ze se udelaji pro ne dalsi tvary a ty se poprideluji)
          </ul>
          </li>\n",

                                                    "          <li>
              <a href=\"%%1%%\" title=\"%%2%%\"%%3%%%%4%%>
                %%2%%  t2: class=\"%%6%%\"
                <span><!-- --></span>
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

                                                      "tvar_aktivity_id" => "_aktivniid", //oznaceni id
                                                      "tvar_aktivity_class" => "_aktivniclass",  //oznaceni class

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
                  "normal_menu_1" => array( array("main_href" => "uvodni-sekce",  //oznacovaci odkaz
                                                  "odkaz" => "uvitaci list",      //text odkazu
                                                  "title" => "tit1",      //do title
                                                  "id" => "id1",
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

                                            array("main_href" => "prvni-sekce",  //oznacovaci odkaz
                                                  "odkaz" => "odkaz 2",      //text odkazu
                                                  "title" => "tit2",      //do title
                                                  "id" => "id2",
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

                                                                          array("main_href" => "sub-sekce2",  //oznacovaci odkaz
                                                                                "odkaz" => "sub sekce druha sekce",      //text odkazu
                                                                                "title" => "sub tit 2",      //do title
                                                                                "id" => "",
                                                                                "class" => "",
                                                                                "akce" => "",

                                                                                //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                                                "defaultni" => false,

                                                                                //zapinani zobrazerni polozek
                                                                                "zobrazit_obsah" => true,
                                                                                "zobrazit_title" => true,
                                                                                "zobrazit_menu" => true,

                                                                                "tvar_main_href" => 4,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                                                "tvar_vypis_menu" => 1, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                                                "tvar_get_kam" => 2,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                                                "tvar_spojeni_sub" => 2,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                                                "subsekcemenu" => array(array("main_href" => "sub-sub-sekce1",  //oznacovaci odkaz
                                                                                                              "odkaz" => "sub sekce prvni sub sekce",      //text odkazu
                                                                                                              "title" => "sub sub 1",      //do title
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
                                                                                                              "tvar_get_kam" => 3,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                                                                              "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                                                                              "subsekcemenu" => NULL,
                                                                                                              ),

                                                                                                        array("main_href" => "sub-sub-sekce2",  //oznacovaci odkaz
                                                                                                              "odkaz" => "sub sekce druha sub sekce",      //text odkazu
                                                                                                              "title" => "sub sub 2",      //do title
                                                                                                              "id" => "",
                                                                                                              "class" => "",
                                                                                                              "akce" => "",

                                                                                                              //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                                                                              "defaultni" => false,

                                                                                                              //zapinani zobrazerni polozek
                                                                                                              "zobrazit_obsah" => true,
                                                                                                              "zobrazit_title" => true,
                                                                                                              "zobrazit_menu" => true,

                                                                                                              "tvar_main_href" => 4,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                                                                              "tvar_vypis_menu" => 2, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                                                                              "tvar_get_kam" => 3,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                                                                              "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                                                                              "subsekcemenu" => NULL,
                                                                                                              ),

                                                                                                        array("main_href" => "sub-sub-sekce3",  //oznacovaci odkaz
                                                                                                              "odkaz" => "sub sekce druha sub sekce",      //text odkazu
                                                                                                              "title" => "sub sub 3",      //do title
                                                                                                              "id" => "",
                                                                                                              "class" => "",
                                                                                                              "akce" => "",

                                                                                                              //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                                                                              "defaultni" => false,

                                                                                                              //zapinani zobrazerni polozek
                                                                                                              "zobrazit_obsah" => true,
                                                                                                              "zobrazit_title" => true,
                                                                                                              "zobrazit_menu" => true,

                                                                                                              "tvar_main_href" => 4,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                                                                              "tvar_vypis_menu" => 2, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                                                                              "tvar_get_kam" => 3,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                                                                              "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                                                                              "subsekcemenu" => NULL,
                                                                                                              ),

                                                                                                        array("main_href" => "sub-sub-sekce4",  //oznacovaci odkaz
                                                                                                              "odkaz" => "sub sekce druha sub sekce",      //text odkazu
                                                                                                              "title" => "sub sub 4",      //do title
                                                                                                              "id" => "",
                                                                                                              "class" => "",
                                                                                                              "akce" => "",

                                                                                                              //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                                                                              "defaultni" => false,

                                                                                                              //zapinani zobrazerni polozek
                                                                                                              "zobrazit_obsah" => true,
                                                                                                              "zobrazit_title" => true,
                                                                                                              "zobrazit_menu" => true,

                                                                                                              "tvar_main_href" => 4,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                                                                              "tvar_vypis_menu" => 2, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                                                                              "tvar_get_kam" => 3,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                                                                              "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                                                                              "subsekcemenu" => NULL,
                                                                                                              ),
                                                                                                        ),
                                                                                ),
                                                                          ),
                                                  ),

                                            array("main_href" => "druha-sekce",  //oznacovaci odkaz
                                                  "odkaz" => "Online nabídník",      //text odkazu
                                                  "title" => "tit3",      //do title
                                                  "id" => "",
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

                                            array("main_href" => "http://superodkaz.cz",  //oznacovaci odkaz
                                                  "odkaz" => "odkaz 4",      //text odkazu
                                                  "title" => "tit4",      //do title
                                                  "id" => "",
                                                  "class" => "",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 3,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 1, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),
                                          ),

                  "normal_menu_2" => array( array("main_href" => "uvodni-sekce",  //oznacovaci odkaz
                                                  "odkaz" => "uvitaci list",      //text odkazu
                                                  "title" => "tit1",      //do title
                                                  "id" => "id1",
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

                                            array("main_href" => "prvni-sekce",  //oznacovaci odkaz
                                                  "odkaz" => "odkaz 2",      //text odkazu
                                                  "title" => "tit2",      //do title
                                                  "id" => "id2",
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

                                            array("main_href" => "druha-sekce",  //oznacovaci odkaz
                                                  "odkaz" => "Online nabídník",      //text odkazu
                                                  "title" => "tit3",      //do title
                                                  "id" => "",
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

                                            array("main_href" => "http://superodkaz.cz",  //oznacovaci odkaz
                                                  "odkaz" => "odkaz 4",      //text odkazu
                                                  "title" => "tit4",      //do title
                                                  "id" => "",
                                                  "class" => "",
                                                  "akce" => "",

                                                  //defaultni stranka pri prazdnem GET nebo neexistujici polozce
                                                  "defaultni" => false,

                                                  //zapinani zobrazerni polozek
                                                  "zobrazit_obsah" => true,
                                                  "zobrazit_title" => true,
                                                  "zobrazit_menu" => true,

                                                  "tvar_main_href" => 3,  //prirazeni: array_tvar_main_href, tvar odkazu
                                                  "tvar_vypis_menu" => 1, //prizateni: array_tvar_vypis_menu, forma vypisu
                                                  "tvar_get_kam" => 1,    //prirazeno: array_tvar_get_kam, promenna do GET
                                                  "tvar_spojeni_sub" => 1,//prirazeno: array_tvar_spojeni_sub, href oddeleni submenu od menu

                                                  "subsekcemenu" => NULL,
                                                  ),
                                          )
                  //"neco" => "dalsi menu",

                  );

  return $result;
?>
