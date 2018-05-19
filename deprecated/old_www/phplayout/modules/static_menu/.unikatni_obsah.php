<?php

  $result = array("normal_menu_1" => array( array("main_href" => "", //bez "?action="
                                                  "href" => "",         //prvni sub odkaz bez &AMP, neplati pro htaccess
                                                  "odkaz" => "uvitaci list",
                                                  "title" => "",
                                                  "id" => "uvitaci-list",
                                                  "class" => "",
                                                  "akce" => ""),

                                            array("main_href" => "prvni-sekce",
                                                  "href" => "",
                                                  "odkaz" => "odkaz 2",
                                                  "title" => "",
                                                  "id" => "prvni-sekce",
                                                  "class" => "",
                                                  "akce" => ""),

                                            array("main_href" => "druha-sekce",
                                                  "href" => "",
                                                  "odkaz" => "Online nabídník",
                                                  "title" => "Online nabídník",
                                                  "id" => "online-nabidnik",
                                                  "class" => "",
                                                  "akce" => ""),

                                            array("main_href" => "http://kokot.cz",
                                                  "href" => "",
                                                  "odkaz" => "odkaz 4 +%%9%%",
                                                  "title" => "",
                                                  "id" => "",
                                                  "class" => "",
                                                  "akce" => ""),

                                            array("main_href" => "treti-sekce",
                                                  "href" => "",
                                                  "odkaz" => "uvod? kkt? +%%9%%",
                                                  "title" => "strašně dlouhý popisek",
                                                  "id" => "treti-sekce",
                                                  "class" => "",
                                                  "akce" => ""),
                                          ),

                  "normal_vypis_menu_prvni_1" => "_prvni",

                  "normal_vypis_menu_posledni_1" => "_posledni",

                  "normal_vypis_menu_ente_1" => "_ente",

                  "normal_vypis_menu_1" => "          <li>
            <a href=\"%%1%%\" title=\"%%2%%\"%%3%%%%4%%>
              %%2%%
              <span><!-- --></span>
            </a>
          </li>\n",

                  "set_oznacovat_1" => "oz_class",

                  "set_oznac_odkazu_L_1" => "[",

                  "set_oznac_odkazu_P_1" => "]",

                  "set_oznac_class_1" => "aktivni",

                  "set_oznac_id_1" => "-aktivni",

                  "set_oznac_id_span_1" => "<span></span>",

                  "set_go_default_1" => true,

                  "set_vypis_chybu_1" => false,

                  "set_ente_definovane_1" => "_aktivni",

                  "set_ente_ozn_def_1" => array(0, 2, 3),

                  "set_ente_ozn_od_1" => 0,

                  "set_ente_ozn_po_1" => 2,

                  "set_get_sekce_1" => "sekce",

                  "" => "",

                  "" => "",

                  "" => "",

                  "" => "",

                  "" => "",

                  "" => "",

                  "" => "",
                  );

  return $result;
?>
