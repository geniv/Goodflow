<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Administrace databází",
                                              "title" => "Administrace databází",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => false),
                                        ),

                  "admin_info_hlavicka" => "
<div id=\"administrace_databazi_vypis\">
<h3>Výpis tabulek třídy <strong>%%2%%</strong></h3>
<p class=\"odkaz_zpatky\">
  <a href=\"%%1%%\" title=\"Zpět na výpis databází\">Zpět na výpis databází</a>
</p>\n",

                  "admin_info_vypis" => "
<p class=\"seznam_tabulek\">
  <a href=\"%%1%%\" title=\"%%2%%\">%%2%%</a>
</p>\n",

                  "admin_info_dodatek" => "
<p class=\"odkazy_import_export\">
  <a href=\"%%1%%\" title=\"Exportovat databázi\">Exportovat databázi</a> - <a href=\"%%2%%\" title=\"Importovat databázi\">Importovat databázi</a>
</p>
</div>\n",

                  "admin_show_hlavicka" => "
<div id=\"administrace_databazi_vypis_tabulky\">
<h3>Obsah tabulky <strong>%%3%%</strong></h3>
<p class=\"odkaz_zpatky\">
  <a href=\"%%1%%\" title=\"Zpět na výpis databází\">Zpět na výpis databází</a>
</p>
<p class=\"odkaz_zpatky odkaz_zpatky_vpravo\">
  <a href=\"%%2%%\" title=\"Zpět na výpis tabulek databáze\">Zpět na výpis tabulek databáze</a>
</p>\n",

                  "admin_show_begin_table" => "\n<table summary=\"Obsah tabulky databáze\">\n  <tr>\n",

                  "admin_show_header" => "    <th>%%1%%</th>\n",

                  "admin_show_end_header" => "  </tr>\n",

                  "admin_show_begin_body" => "  <tr>\n",

                  "admin_show_body" => "    <td>%%1%%</td>\n",

                  "admin_show_end_body" => "  </tr>\n",

                  "admin_show_end_table" => "</table>\n</div>\n",

                  "admin_show_empty_table" => "\n<table summary=\"Obsah tabulky databáze\" class=\"prazdna_tabulka\">\n  <tr>\n    <th>Prázdná tabulka</th>\n  </tr>\n</table>\n</div>\n",

                  "admin_export" => "
<div id=\"administrace_databazi_vypis_tabulky\">
  <h3>Export tabulek třídy <strong>%%3%%</strong></h3>
  <p class=\"odkaz_zpatky\">
    <a href=\"%%1%%\" title=\"Zpět na výpis databází\">Zpět na výpis databází</a>
  </p>
  <p class=\"odkaz_zpatky odkaz_zpatky_vpravo\">
    <a href=\"%%2%%\" title=\"Zpět na výpis tabulek databáze\">Zpět na výpis tabulek databáze</a>
  </p>\n
  <form method=\"post\" action=\"\">
    <fieldset>
      <textarea rows=\"30\" cols=\"80\">%%4%%</textarea>
    </fieldset>
  </form>
</div>\n",

                  "admin_import" => "
<div id=\"administrace_databazi_vypis_tabulky\">
  <h3>Import tabulek třídy <strong>%%3%%</strong></h3>
  <p class=\"odkaz_zpatky\">
    <a href=\"%%1%%\" title=\"Zpět na výpis databází\">Zpět na výpis databází</a>
  </p>
  <p class=\"odkaz_zpatky odkaz_zpatky_vpravo\">
    <a href=\"%%2%%\" title=\"Zpět na výpis tabulek databáze\">Zpět na výpis tabulek databáze</a>
  </p>\n
  <form method=\"post\" action=\"\">
    <fieldset>
      <textarea rows=\"30\" cols=\"80\" name=\"dotaz\">%%4%%</textarea>
      <input type=\"submit\" name=\"tlacitko_import\" value=\"Importovat\" />
    </fieldset>
  </form>
</div>\n",

                  "admin_import_exec" => "
<div class=\"central_absolutni central_info\">
  <p>
    Databáze byla importována.
  </p>
  <p class=\"odkaz_pokracovat\">
    <a href=\"%%1%%\">Pokračujte kliknutím zde</a>
  </p>
</div>\n",

                  "admin_obsah" => "
<div id=\"administrace_databazi\">
  <h3>Výpis databází</h3>
  <ul>
    <li class=\"nazev_databaze\">Název databáze</li>
    <li class=\"typ_db\">Databáze</li>
    <li class=\"velikost_databaze\">Velikost</li>
    <li class=\"datum_databaze\">Datum a čas poslední změny</li>
  </ul>
%%1%%
</div>\n",

                  "admin_vypis_obsah" => "
  <ul>
    <li class=\"nazev_databaze\"><a href=\"%%1%%\" title=\"%%2%%\">%%2%%</a></li>
    <li class=\"typ_db typ_db_%%5%%\"><!-- --></li>
    <li class=\"velikost_databaze\">%%3%%</li>
    <li class=\"datum_databaze\">%%4%%</li>
  </ul>\n",

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
