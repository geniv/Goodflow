<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Administrace jazyků",
                                              "title" => "Administrace jazyků",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => false),
                                        ),

                  "rewrite_url_seznam_jazyku_1" => "%%1%%jazyk-%%2%%",

                  "normal_sezam_jazyku_nohref_1" => "          <span class=\"%%3%%%%6%%\"><span>%%2%%</span></span>\n",

                  "normal_seznam_jazyku_1" => "          <a href=\"%%1%%\" title=\"%%2%%\" class=\"%%3%%\"><span>%%2%%</span></a>\n",

                  "normal_seznam_jazyku_null_1" => "žádný jazyk",

                  "normal_seznam_jazyku_changelang_1" => "",

                  "normal_vyber_jazyka_select_begin_1" => "<select name=\"jazyk\">",

                  "normal_vyber_jazyka_select_oznaceni_1" => " selected=\"selected\"",

                  "normal_vyber_jazyka_select_1" => "\n  <option value=\"%%1%%\"%%4%%>%%2%% - %%3%%</option>",

                  "normal_vyber_jazyka_select_end_1" => "</select>",

                  "normal_vyber_jazyka_select_null_1" => "žádný jazyk",

                  "normal_jazyk_podle_id_1" => "žádný název neexistuje",

                  "normal_zkratka_podle_id_1" => "žádný název neexistuje",

                  "admin_obsah" => "
<div class=\"dynamicky_language_vypis\">
  <h3>Výpis jazyků</h3>
  <p class=\"odkaz_pridat\">
    <a href=\"%%1%%\" title=\"Přidat jazyk\">Přidat jazyk</a>
  </p>
%%2%%
</div>\n",

                  "admin_add" => "
<div class=\"pridat_upravit_jazyk\">
  <h3>Přidat jazyk</h3>
  <p class=\"backlink_jazyky\"><a href=\"%%1%%\" title=\"Zpět na výpis jazyků\">Zpět na výpis jazyků</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Název jazyka:</span>
        <input type=\"text\" name=\"jazyk\" />
      </label>
      <label class=\"input_text\">
        <span>Zkratka jazyka:</span>
        <input type=\"text\" name=\"zkratka\" />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat jazyk\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_add_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl přidán jazyk: \"<strong>%%1%% - %%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_edit" => "
<div class=\"pridat_upravit_jazyk\">
  <h3>Upravit jazyk</h3>
  <p class=\"backlink_jazyky\"><a href=\"%%3%%\" title=\"Zpět na výpis jazyků\">Zpět na výpis jazyků</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Název jazyka:</span>
        <input type=\"text\" name=\"jazyk\" value=\"%%1%%\" />
      </label>
      <label class=\"input_text\">
        <span>Zkratka jazyka:</span>
        <input type=\"text\" name=\"zkratka\" value=\"%%2%%\" />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit jazyk\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_edit_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl upraven jazyk: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_del_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl smazán jazyk: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_vypis_obsah" => "
<ul class=\"vypis_jazyku\">
  <li>[%%1%%] - <strong>%%3%%</strong></li>
  <li class=\"odsazeni_zkratky\">Zkratka: <strong>%%2%%</strong></li>
  <li class=\"odkazy_smazat_upravit\"><a href=\"%%4%%\" title=\"Upravit jazyk\">Upravit jazyk</a> - <a href=\"%%5%%\" title=\"Smazat jazyk\" onclick=\"return confirm('Opravdu chceš smazat jazyk: &quot;%%3%% [%%2%%]&quot; ?');\">Smazat jazyk</a></li>
</ul>\n",

                  "admin_vypis_obsah_null" => "žádný jazyk",

                  "set_ozn_jazyk_l" => "",

                  "set_ozn_jazyk_r" => "",

                  "set_ozn_jazyk_class" => " %%3%%_aktivni",

                  "set_cookie_name" => "LANG",

                  "set_adrname" => "sub",

                  "set_adrchange" => "changelang",

                  "" => "",
                  );

  return $result;
?>
