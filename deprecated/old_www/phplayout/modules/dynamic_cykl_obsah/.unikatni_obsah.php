<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Administrace cyklického obsahu",
                                              "title" => "administrace cyklického obsahu",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "normal_vypis_tvar_datum_1" => "j.n. Y",

                  "normal_vypis_obsah_1" => "<p>%%1%% - %%2%%</p>",

                  "normal_vypis_null_1" => "žádná položka",

                  "normal_rss_link_1" => "<link type=\"application/rss+xml\" rel=\"alternate\" href=\"\" title=\"Novinky\" />",

                  "admin_obsah" => "administrace cyklického obsahu
    <br />
    <a href=\"%%1%%\" title=\"\">přidat položku</a><br />
    <br />
    %%2%%
    ",

                  "admin_add" => "
          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" /><br />
              datum: <input type=\"text\" name=\"datum\" value=\"%%1%%\" /><br />
              text: <input type=\"text\" name=\"text\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ",

                  "admin_add_hlaska" => "
                přídána: %%1%%
              ",

                  "admin_edit" => "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" /><br />
                  datum: <input type=\"text\" name=\"datum\" value=\"%%2%%\" /><br />
                  text: <input type=\"text\" name=\"text\" value=\"%%3%%\" /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ",

                  "admin_edit_hlaska" => "
                    upravena: %%1%%
                  ",

                  "admin_del_hlaska" => "
                  smazáno: %%1%%
                ",

                  "admin_vypis_obsah" => "
          %%1%% (%%2%%) '%%3%%' <p>%%4%%</p>
          <a href=\"%%5%%\" title=\"\">upravit obsah</a>
          <a href=\"%%6%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%3%%\' ?');\">smazat obsah</a><br />
          ",

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
