<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "administrace jazyků",
                                              "title" => "administrace jazyků",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "rewrite_url_seznam_jazyku_1" => "%%1%%zmena-jazyka-na-%%2%%",

                  "normal_sezam_jazyku_nohref_1" => "<br />---%%1%% --- %%2%%-- %%4%%%%3%%%%5%%--- %%6%%",

                  "normal_seznam_jazyku_1" => "<br /><a href=\"%%1%%\" title=\"%%2%%\"> %%4%%%%3%%%%5%%</a> %%6%%",

                  "normal_seznam_jazyku_null_1" => "žádný jazyk",

                  "normal_seznam_jazyku_changelang_1" => "probíhá změna jazyku",

                  "normal_vyber_jazyka_select_begin_1" => "<select name=\"jazyk\">",

                  "normal_vyber_jazyka_select_oznaceni_1" => " selected=\"selected\"",

                  "normal_vyber_jazyka_select_1" => "
            <option value=\"%%1%%\"%%4%%>%%2%% - %%3%%</option>
          ",

                  "normal_vyber_jazyka_select_end_1" => "</select>",

                  "normal_vyber_jazyka_select_null_1" => "žádný jazyk",

                  "normal_jazyk_podle_id_1" => "žádný název neexistuje",

                  "normal_zkratka_podle_id_1" => "žádný název neexistuje",

                  "admin_obsah" => "administrace jazyků
    <br />
    <a href=\"%%1%%\" title=\"\">přidat jazyk</a><br />
    <br />
    %%2%%
    ",

                  "admin_add" => "
          <form method=\"post\">
            <fieldset>
              jazyk: <input type=\"text\" name=\"jazyk\" /><br />
              zkratka: <input type=\"text\" name=\"zkratka\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ",

                  "admin_add_hlaska" => "
                přídán: %%1%% se zkratkou: %%2%%
              ",

                  "admin_edit" => "
              <form method=\"post\">
                <fieldset>
                  jazyk: <input type=\"text\" name=\"jazyk\" value=\"%%1%%\" /><br />
                  zkratka: <input type=\"text\" name=\"zkratka\" value=\"%%2%%\" /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ",

                  "admin_edit_hlaska" => "
                    upraven: %%1%%
                  ",

                  "admin_del_hlaska" => "
                  smazán: %%1%%
                ",

                  "admin_vypis_obsah" => "(%%1%%) %%2%% - %%3%%<br />
          <a href=\"%%4%%\" title=\"\">upravit jazyk</a>
          <a href=\"%%5%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%3%%\' ?');\">smazat jazyk</a><br />
          ",

                  "admin_vypis_obsah_null" => "žádný jazyk",

                  "set_ozn_jazyk_l" => "[",

                  "set_ozn_jazyk_r" => "]",

                  "set_ozn_jazyk_class" => "_aktivni",

                  "" => "",
                  );

  return $result;
?>
