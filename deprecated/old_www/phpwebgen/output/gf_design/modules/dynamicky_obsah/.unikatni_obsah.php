<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamický obsah",
                                              "title" => "Dynamický obsah",
                                              "id" => "",
                                              "class" => "dynamicky_obsah_menu",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "admin_tvar_menu_odkaz" => "%%1%%",

                  "admin_tvar_menu_title" => "%%1%%",

                  "admin_vypis_edit_link_skupina" => "
          <a href=\"%%1%%\" title=\"%%2%%\">%%2%%</a><br />
          ",

                  "admin_vypis_obsahu_skupiny" => "<br />
        %%1%%<br />
        %%2%%<br />
        %%3%%
        ",

                  "normal_vypis_null" => "zadaná adresa neexistuje",

                  "admin_seznam_skupin_begin" => "<select name=\"skupina\">",

                  "admin_seznam_skupin" => "
          <option value=\"%%1%%\"%%2%%>%%3%%</option>
          ",

                  "admin_seznam_skupin_end" => "</select>",

                  "admin_seznam_skupin_null" => "zadaná skupina neexistuje",

                  "admin_obsah_add_link" => "
                  <a href=\"%%1%%\" title=\"\">přidej obsah</a><br />
                  <a href=\"%%2%%\" title=\"\">přidej skupinu</a><br />
                  ",

                  "admin_obsah" => "administrace dynamickeho obsahu<br />
    %%1%%
    %%2%%<br />",

                  "admin_addobsah" => "
          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" /><br />
              obsah: <textarea name=\"text\"></textarea><br />
              skupina: %%2%%<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ",

                  "admin_addobsah_hlaska" => "
                přídána: %%1%%
              ",

                  "admin_editobsah" => "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" /><br />
                  obsah: <textarea name=\"text\">%%2%%</textarea><br />
                  %%3%%<br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ",

                  "admin_editobsah_hlaska" => "
                    upravena: %%1%%
                  ",

                  "admin_delobsah_hlaska" => "
                  smazána adresa: %%1%%
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

                  "admin_vypis_del_link" => "<a href=\"%%1%%\" title=\"\" onclick=\"return confirm('Opravdu smazat adresu: \'%%2%%\' ?');\">smazat sekci</a>",

                  "admin_vypis_skupina" => "
          skupina: %%1%%, nazev: %%2%%, popis: %%3%%<br />
          <a href=\"%%4%%\" title=\"\">uprav skupinu</a>
          %%5%%
          <a href=\"%%6%%\" title=\"\">přidej obsah do této skupiny</a>
          <br />",

                  "admin_vypis_skupina_end" => "end skup.<br /><br />",

                  "admin_vypis_obsah" => "
<pre id=\"vypis_admin\">
%%1%%
</pre>
<p>
adresa: (%%2%%)
<a href=\"%%3%%\" title=\"\">uprav sekci</a>
%%4%%
</p>
          ",

                  "set_povolit_pridani" => true,

                  "set_vypis_chybu" => false,

                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
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
