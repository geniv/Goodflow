<?php

  $result = array("normal_menu_1" => array( array("main_href" => "hu1", //bez "?action="
                                                  "href" => "",         //prvni sub odkaz bez &AMP, neplati pro htaccess
                                                  "odkaz" => "odkaz 1",
                                                  "title" => "titules",
                                                  "id" => "",
                                                  "class" => "",
                                                  "akce" => ""),

                                            array("main_href" => "hu2",
                                                  "href" => "",
                                                  "odkaz" => "odkaz 2",
                                                  "title" => "",
                                                  "id" => "",
                                                  "class" => "",
                                                  "akce" => ""),

                                            array("main_href" => "hu3",
                                                  "href" => "",
                                                  "odkaz" => "odkaz 3",
                                                  "title" => "",
                                                  "id" => "",
                                                  "class" => "",
                                                  "akce" => ""),

                                            array("main_href" => "hu4",
                                                  "href" => "",
                                                  "odkaz" => "odkaz 4 +%%9%%",
                                                  "title" => "",
                                                  "id" => "",
                                                  "class" => "",
                                                  "akce" => ""),

                                            array("main_href" => "",
                                                  "href" => "",
                                                  "odkaz" => "uvod? kkt? +%%9%%",
                                                  "title" => "strašně dlouhý popisek",
                                                  "id" => "",
                                                  "class" => "",
                                                  "akce" => ""),
                                          ),

                  "normal_vypis_menu_prvni_1" => "_prvni",

                  "normal_vypis_menu_posledni_1" => "_posledni",

                  "normal_vypis_menu_ente_1" => "_ente",

                  "normal_vypis_menu_1" => "\n          <p%%4%%> (%%6%%, %%9%%, %%10%%, %%11%%, %%12%%)
            <a href=\"%%1%%\" title=\"%%2%%\"%%3%%%%4%%%%5%%>
              <span>
                %%7%%%%2%%%%8%%
              </span>
            </a>
          </p>",

                  "set_oznacovat_1" => "oz_odkaz",

                  "set_oznac_odkazu_L_1" => "[",

                  "set_oznac_odkazu_P_1" => "]",

                  "set_oznac_class_1" => "aktivni",

                  "set_oznac_id_1" => "_neco2",

                  "set_oznac_id_span_1" => "<span></span>",

                  "set_go_default_1" => true,

                  "set_vypisovat_chybu_1" => false,

                  "set_ente_definovane_1" => true,

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
