<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Multilanguage obsah",
                                              "title" => "multilanguage obsah",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "admin_tvar_menu_odkaz" => "%%1%%",

                  "admin_tvar_menu_title" => "%%1%%",

                  "normal_vypis_null" => "špatná adresa",

                  "admin_vypis_obsahu_skupiny" => "<br />
        %%1%%<br />
        %%2%%<br />
        %%3%%
        ",

                  "admin_vypis_edit_link_skupina" => "
          <a href=\"%%1%%\" title=\"%%2%%\">%%2%%</a><br />
          ",

                  "admin_seznam_skupin_begin" => "<select name=\"skupina\">",

                  "admin_seznam_skupin" => "
          <option value=\"%%1%%\"%%2%%>%%3%%</option>
          ",

                  "admin_seznam_skupin_end" => "</select>",

                  "admin_seznam_skupin_null" => "zadaná skupina neexistuje",

                  "admin_obsah_add_link" => "
                  <a href=\"%%1%%\" title=\"\">přidat obsah</a><br />
                  <a href=\"%%2%%\" title=\"\">přidat skupinu</a><br />
                  ",

                  "admin_obsah" => "administrace multilanguage obsahu
    <br />
    %%1%%
    <br />
    %%2%%
    ",

                  "admin_addobsah" => "
          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" value=\"%%2%%\" /><br />
              text: <textarea name=\"text\"></textarea><br />
              %%1%%<br />
              %%3%%<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ",

                  "admin_addobsah_hlaska" => "
                přídána: %%1%% do jazyku: %%2%%
              ",

                  "admin_editobsah" => "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" /><br />
                  text: <textarea name=\"text\">%%2%%</textarea><br />
                  %%3%%<br />
                  %%4%%<br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ",

                  "admin_editobsah_hlaska" => "
                    upravena: %%1%%
                  ",

                  "admin_delobsah_hlaska" => "
                  smazáno: '%%1%%'
                ",

                  "admin_addgroup" => "<form method=\"post\">
            <fieldset>
              nazev: <input type=\"text\" name=\"nazev\" />*<br />
              popisek: <textarea name=\"popisek\"></textarea><br />
              href_id: <input type=\"text\" name=\"href_id\" /><br />
              href_class: <input type=\"text\" name=\"href_class\" /><br />
              href_akce: <input type=\"text\" name=\"href_akce\" /><br />
              zobrazit: <input type=\"checkbox\" name=\"zobrazit\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>",

                  "admin_addgroup_hlaska" => "přidána skupna: %%1%%",

                  "admin_editgroup" => "
              <form method=\"post\">
                <fieldset>
                  nazev: <input type=\"text\" name=\"nazev\" value=\"%%1%%\" />*<br />
                  popisek: <textarea name=\"popisek\">%%2%%</textarea><br />
                  href_id: <input type=\"text\" name=\"href_id\" value=\"%%3%%\" /><br />
                  href_class: <input type=\"text\" name=\"href_class\" value=\"%%4%%\" /><br />
                  href_akce: <input type=\"text\" name=\"href_akce\" value=\"%%5%%\" /><br />
                  zobrazit: <input type=\"checkbox\" name=\"zobrazit\"%%6%% /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ",

                  "admin_editgroup_hlaska" => "upravena skupna: %%1%%",

                  "admin_delgroup_hlaska" => "smazána skupina: %%1%% a všechny záznamy v ní!",

                  "admin_vypis_skupina_del_link" => "<a href=\"%%1%%\" title=\"\" onclick=\"return confirm('Opravdu smazat nazev: \'%%2%%\' ?');\">smazat skupinu</a>",

                  "admin_vypis_del_link" => "<a href=\"%%1%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%2%%\' ?');\">smazat obsah</a>",

                  "admin_vypis_skupina" => "
          skupina: %%1%%, nazev: %%2%%, popis: %%3%%<br />
          <a href=\"%%4%%\" title=\"\">uprav skupinu</a>
          %%5%%
          <a href=\"%%6%%\" title=\"\">přidej obsah do této skupiny</a>
          <br />",

                  "admin_vypis_skupina_end" => "end skup.<br /><br />",

                  "admin_vypis_obsah" => "%%2%% (%%1%%) %%4%% <pre>%%3%%</pre>
          <a href=\"%%5%%\" title=\"\">upravit obsah</a>
          %%6%%
          <br />
          ",

                  "set_povolit_pridani" => true,

                  "set_vypis_chybu" => false,

                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
