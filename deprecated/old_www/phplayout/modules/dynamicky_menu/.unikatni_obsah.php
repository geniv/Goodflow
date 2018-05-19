<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamické menu",
                                              "title" => "dynamické menu",
                                              "id" => "",
                                              "class" => "dynamicke_menu_menu",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),


                  "set_oznacovat_1" => "oz_class",

                  "set_oznac_odkazu_L_1" => "[ ",

                  "set_oznac_odkazu_P_1" => " ]",

                  "set_oznac_class_1" => " aktivni",

                  "set_oznac_id_1" => "_neco",

                  "set_ente_definovane_1" => false,

                  "set_ente_ozn_def_1" => array(0, 1, 4),

                  "set_ente_ozn_od_1" => 0,

                  "set_ente_ozn_po_1" => 2,

                  "normal_menu_prvni_1" => "_prvni",

                  "normal_menu_posledni_1" => "_posl",

                  "normal_menu_ente_1" => "_ente",

                  "normal_vypis_menu_nadpis_1" => "          <h2>%%1%%</h2>\n",

                  "normal_vypis_menu_1" => "          <p%%3%%>
            <a href=\"%%1%%\" title=\"%%2%%\"%%4%%%%5%%>
              %%6%%%%2%%%%7%%
            </a>, %%8%%, %%9%%, %%10%%, %%11%%
          </p>\n",

                  "normal_vypis_null_1" => "zadaná adresa neexistuje",

                  "admin_vyber_skupiny_begin" => "<select name=\"skupina\">",

                  "admin_vyber_skupiny" => "
            <option value=\"%%1%%\"%%2%%>%%3%% (%%4%%)</option>
          ",

                  "admin_vyber_skupiny_end" => "</select>",

                  "admin_vyber_skupiny_null" => "žádná skupina",

                  "admin_obsah_add" => "<a href=\"%%1%%\" title=\"\">přidej sekci</a><br />",

                  "admin_obsah" => "administrace dynamickeho obsahu<br />
    %%1%%
    %%2%%<br />",

                  "admin_addgrup" => "
          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" />*(url adresa v ktere se menu nachazi... z parametru a nebo \$_SERVER[\"QUERY_STRING\"])<br />
              nazev: <input type=\"text\" name=\"nazev\" />*<br />
              poradi: <input type=\"text\" name=\"poradi\" value=\"%%2%%\" />* >0<br />
              adr_obsahu: <input type=\"text\" name=\"adr_obsahu\" />*<br />
              razeni:<br />
              podle poradi: <input type=\"radio\" name=\"razeni\" value=\"true\" checked=\"checked\" /><br />
              podle abecedy: <input type=\"radio\" name=\"razeni\" value=\"false\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ",

                  "admin_addgrup_hlaska" => "
                přídána adresa: %%1%%
              ",

                  "admin_editgrup" => "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" />*(url adresa v ktere se menu nachazi... z parametru a nebo \$_SERVER[\"QUERY_STRING\"])<br />
                  nazev: <input type=\"text\" name=\"nazev\" value=\"%%2%%\" /><br />
                  poradi: <input type=\"text\" name=\"poradi\" value=\"%%3%%\" />*>0<br />
                  adr_obsahu: <input type=\"text\" name=\"adr_obsahu\" value=\"%%4%%\" />*<br />
                  razeni:<br />
                  podle poradi: <input type=\"radio\" name=\"razeni\" value=\"true\"%%5%% /><br />
                  podle abecedy: <input type=\"radio\" name=\"razeni\" value=\"false\"%%6%% /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ",

                  "admin_editgrup_hlaska" => "
                    upravena adresa: %%1%%
                  ",

                  "admin_delgrup_hlaska" => "
                  smazána adresa: '%%1%%', a všechny vnořené odkazy.
                ",

                  "admin_addmenu_poradi" => "poradi: <input type=\"text\" name=\"poradi\" value=\"%%1%%\" /><br />",

                  "admin_addmenu" => "
          <form method=\"post\">
            <fieldset>
              main_href: <input type=\"text\" name=\"main_href\" /><br />
              odkaz: <input type=\"text\" name=\"odkaz\" /><br />
              title: <input type=\"text\" name=\"title\" /><br />
              href_id: <input type=\"text\" name=\"href_id\" /><br />
              href_class: <input type=\"text\" name=\"href_class\" /><br />
              href_akce: <input type=\"text\" name=\"href_akce\" /><br />
              %%1%%<br />
              %%2%%
              defaultni: <input type=\"checkbox\" name=\"defaultni\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ",

                  "admin_addmenu_hlaska" => "
                přídán odkaz: %%1%%
              ",

                  "admin_editmenu_poradi" => "poradi: <input type=\"text\" name=\"poradi\" value=\"%%1%%\" /><br />",

                  "admin_editmenu" => "
              <form method=\"post\">
                <fieldset>
                  main_href: <input type=\"text\" name=\"main_href\" value=\"%%1%%\" /><br />
                  odkaz: <input type=\"text\" name=\"odkaz\" value=\"%%2%%\" /><br />
                  title: <input type=\"text\" name=\"title\" value=\"%%3%%\" /><br />
                  href_id: <input type=\"text\" name=\"href_id\" value=\"%%4%%\" /><br />
                  href_class: <input type=\"text\" name=\"href_class\" value=\"%%5%%\" /><br />
                  href_akce: <input type=\"text\" name=\"href_akce\" value=\"%%6%%\" /><br />
                  %%7%%<br />
                  %%8%%
                  defaultni: <input type=\"checkbox\" name=\"defaultni\"%%9%% /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ",

                  "admin_editmenu_hlaska" => "
                    upravena odkaz: %%1%%
                  ",

                  "admin_delmenu_hlaska" => "
                  smazána main_href: '%%1%%'.
                ",

                  "admin_vypis_skupina_poradi" => "pořadí",

                  "admin_vypis_skupina_nazev" => "názvu",

                  "admin_vypis_skupina_addmenu" => "<a href=\"%%1%%\" title=\"\">přidej položku</a>",

                  "admin_vypis_skupina_delgru" => "<a href=\"%%1%%\" title=\"\" onclick=\"return confirm('Opravdu smazat adresu: \'%%2%%\' ?');\">smazat sekci</a>",

                  "admin_vypis_skupina" => "<br />
            <p>
             <p>%%1%%</p>
              adresa: '%%2%%'<br />
              obsah: %%3%%<br />
              razeni podle: %%4%%<br />
              poradi: %%5%%<br />
              %%6%%
              <a href=\"%%7%%\" title=\"\">uprav sekci</a>
              %%8%%
            </p><br />
-------------------------------------------------------------------------------
          ",

                  "admin_vypis_obsah_del" => "<a href=\"%%1%%\" title=\"\" onclick=\"return confirm('Opravdu smazat menu: \'%%2%%\' ?');\">smazat menu</a>",

                  "admin_vypis_obsah" => "<br />
                  <p>
                    %%1%%<br />
                    %%2%%<br />
                    %%3%%<br />
                    %%4%%<br />
                    %%5%%<br />
                    %%6%%<br />
                    poradi: %%7%%<br />
                    def: <input type=\"checkbox\"%%8%% disabled /><br />
                    <a href=\"%%9%%\" title=\"\">uprav menu</a>
                    %%10%%
                    <a href=\"%%11%%\" title=\"\">přidat obsah</a>
                  </p>
                  <br />
*******************************************************************************
                ",

                  "set_defprvni" => false,

                  "set_get_sekce" => "sekce",

                  "set_vypis_chybu" => false,

                  "set_povolit_pridani" => true,

                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
