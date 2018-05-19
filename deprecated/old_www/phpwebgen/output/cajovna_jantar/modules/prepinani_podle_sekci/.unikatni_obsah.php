<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Přepínání podle sekcí",
                                              "title" => "Přepínání podle sekcí",
                                              "id" => "",
                                              "class" => "prepinani_sekci_menu",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "admin_obsah" => "administrace přepínání podle sekcí<br />
    <a href=\"%%1%%\" title=\"\">přidat sekci</a><br />
    %%2%%
    <br />
    ",

                  "admin_add" => "
          <form method=\"post\">
            <fieldset>
              adresa:<input type=\"text\" name=\"adresa\" /><br />
              kod:<textarea name=\"kod\"></textarea><br />
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
                  adresa:<input type=\"text\" name=\"adresa\" value=\"%%1%%\" /><br />
                  kod:<textarea name=\"kod\">%%2%%</textarea><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ",

                  "admin_edit_hlaska" => "
                    upravena: %%1%%
                  ",

                  "admin_del_hlaska" => "
                  smazána: '%%1%%'
                ",

                  "admin_vypis_obsah" => "<p>
          <strong>'%%2%%'</strong> (%%1%%)<br />
          <pre>%%3%%</pre>
          <a href=\"%%4%%\" title=\"\">upravit sekci</a>
          <a href=\"%%5%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%2%%\' ?');\">smazat sekci</a> <br />
          <br />
          </p>",

                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
