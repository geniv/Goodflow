<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamický htaccess",
                                              "title" => "Dynamický htaccess",
                                              "id" => "",
                                              "class" => "dynamicky_htaccess_menu",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "admin_generovani_htaccess" => "#%%1%%\n%%2%%\n\n",

                  "admin_generovani_htaccess_complet" => "kompilováno",

                  "admin_htaccess_exists" => "htaccess existuje <a href=\"%%1%%\" title=\"\">náhled</a>",

                  "admin_htaccess_not_exists" => "htaccess neexistuje",

                  "admin_obsah" => "administrace dynamickeho htaccess-u
    <br />
    <a href=\"%%1%%\" title=\"\">přidat položku</a><br />
    <a href=\"%%2%%\" title=\"\" onclick=\"return confirm('Opravdu vygenerovat soubor ?');\">vygenerovat htaccess</a>
    %%3%%
    <br />
    <br />
    %%4%%
    ",

                  "admin_add" => "
          <form method=\"post\">
            <fieldset>
              rewrite: <input type=\"text\" name=\"rewrite\" /><br />
              poznamka: <input type=\"text\" name=\"poznamka\" />(max 300 zn.)<br />
              poradi: <input type=\"text\" name=\"poradi\" value=\"%%1%%\" />>0<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat položku\" />
            </fieldset>
          </form>
          ",

                  "admin_add_hlaska" => "
                přídán: %%1%% do pořadí: %%2%%
              ",

                  "admin_edit" => "
              <form method=\"post\">
                <fieldset>
                  rewrite: <input type=\"text\" name=\"rewrite\" value=\"%%1%%\" /><br />
                  poznamka: <input type=\"text\" name=\"poznamka\" value=\"%%2%%\" />(max 300 zn.)<br />
                  poradi: <input type=\"text\" name=\"poradi\" value=\"%%3%%\" />>0<br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ",

                  "admin_edit_hlaska" => "
                    upraven: %%1%%
                  ",

                  "admin_del_hlaska" => "
                  smazáno: %%1%%
                ",

                  "admin_show" => "<br />
          <a href=\"%%1%%\" title=\"\">zavřít náhled [X]</a><br />
          <pre>%%2%%</pre>",

                  "admin_vypis_obsah" => "poradi: '%%1%%' (%%2%%) <strong>%%3%% #%%4%%</strong>
          <a href=\"%%5%%\" title=\"\">upravit položku</a>
          <a href=\"%%6%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%3%%\' ?');\">smazat položku</a> <br />
          ",

                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
