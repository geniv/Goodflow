<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Administrace dynamického nápojového lístku",
                                              "title" => "administrace dynamického nápojového lístku",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "normal_vypis_sekce_prvni_1" => "prvni",

                  "normal_vypis_sekce_posledni_1" => "posledni",

                  "normal_vypis_sekce_ente_def_array_1" => array(1, 2, 5),

                  "normal_vypis_sekce_ente_def_1" => "aktivni",

                  "normal_vypis_sekce_ente_od_1" => 0,

                  "normal_vypis_sekce_ente_po_1" => 2,

                  "normal_vypis_sekce_ente_1" => "ente",


                  "normal_vypis_polozka_prvni_1" => "prvni",

                  "normal_vypis_polozka_posledni_1" => "posledni",

                  "normal_vypis_polozka_ente_def_array_1" => array(1, 2, 5),

                  "normal_vypis_polozka_ente_def_1" => "aktivni",

                  "normal_vypis_polozka_ente_od_1" => 0,

                  "normal_vypis_polozka_ente_po_1" => 2,

                  "normal_vypis_polozka_ente_1" => "ente v:%%1%%",


                  "normal_vypis_table_begin_1" => "%%1%%
                  %%2%%
          <table border=\"1\"%%3%%%%4%%%%5%%>
          i: (%%10%%)>%%6%% %%7%% %%8%% %%9%%<
          ",

                  "normal_vypis_table_row_bunka_1" => "
                  <td>%%1%%
                  i: (%%14%%)>%%2%% %%3%% %%4%% %%5%%<
                  j: (%%15%%)>%%6%% %%7%% %%8%% %%9%%<
                  k: (%%16%%)>%%10%% %%11%% %%12%% %%13%%<
                  </td>
                  ",

                  "normal_vypis_table_row_bunka_empty_1" => "<!-- -->",

                  "normal_vypis_table_row_1" => "
                <tr%%1%%%%2%%%%3%%>
                  %%4%%
                  i: (%%13%%)>%%5%% %%6%% %%7%% %%8%%<
                  j: (%%14%%)>%%9%% %%10%% %%11%% %%12%%<
                </tr>
                ",

                  "normal_vypis_table_null_1" => "<th>žádný řádek</th>",

                  "normal_vypis_table_end_1" => "
          </table>
          %%1%%",

                  "normal_vypis_empty_1" => "žádná položka",

                  "admin_vyber_tabulky_begin" => "<select name=\"sekce\">",

                  "admin_vyber_tabulky" => "
            <option value=\"%%1%%\"%%2%%>adresa: %%3%%</option>
          ",

                  "admin_vyber_tabulky_end" => "</select>",

                  "admin_vyber_tabulky_null" => "žádný formulář",

                  "admin_obsah" => "administrace dynamickych nápojů
    <br />
    <a href=\"%%1%%\" title=\"\">přidat sekci</a><br />
    <br />
    %%2%%
    ",

                  "admin_addtab_input_sloupce" => "<input type=\"text\" name=\"sloupce[]\" size=\"10\" />",

                  "admin_addtab_input_defaultni" => "<input type=\"text\" name=\"defaultni[]\" size=\"10\" />",

                  "admin_addtab" => "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" />*<br />
              nadpis: <input type=\"text\" name=\"nadpis\" /><br />
              obr nadpis: <input type=\"file\" name=\"obr_nadpis\" /><br />
              <input type=\"radio\" name=\"mini\" onclick=\"mini_1();\">dopocitat vysku<br />
              <input type=\"radio\" checked=\"checked\" name=\"mini\" onclick=\"mini_2();\">dopocitat sirku<br />
              <input type=\"radio\" name=\"mini\" onclick=\"mini_3();\">nastaveno napevno<br />
              <input type=\"radio\" name=\"mini\" onclick=\"mini_4();\">nedělat nic<br />
              w_mini: <input type=\"text\" name=\"w_mini\"id=\"mini_p1\" value=\"0\" /><br />
              h_mini: <input type=\"text\" name=\"h_mini\"id=\"mini_p2\" value=\"135\" /><br />
              <a href=\"%%1%%\" title=\"\">++ přidat sloupec</a>
              <a href=\"%%2%%\" title=\"\">-- odebrat sloupec</a><br />
              sloupce: %%3%%<br />
              defaultni: %%4%%<br />
              poznamka: <input type=\"text\" name=\"poznamka\" /><br />
              sekce_id: <input type=\"text\" name=\"sekce_id\" /><br />
              sekce_class: <input type=\"text\" name=\"sekce_class\" /><br />
              sekce_akce: <input type=\"text\" name=\"sekce_akce\" /><br />
              poradi: <input type=\"text\" name=\"poradi\" value=\"%%5%%\" />* >0<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat sekci\" />
            </fieldset>
          </form>

          <script type=\"text/javascript\">
            function mini_1()
            {
              document.getElementById('mini_p1').disabled = false;
              document.getElementById('mini_p2').disabled = true;
            }

            function mini_2()
            {
              document.getElementById('mini_p1').disabled = true;
              document.getElementById('mini_p2').disabled = false;

            }

            function mini_3()
            {
              document.getElementById('mini_p1').disabled = false;
              document.getElementById('mini_p2').disabled = false;
            }

            function mini_4()
            {
              document.getElementById('mini_p1').disabled = true;
              document.getElementById('mini_p2').disabled = true;
            }

            mini_2();
          </script>
          ",

                  "admin_addtab_hlaska" => "
                přídána sekce s adresou: %%1%%, navic: %%2%%
              ",

                  "admin_edittab_input_sloupce" => "<input type=\"text\" name=\"sloupce[]\" size=\"10\" value=\"%%1%%\" />",

                  "admin_edittab_input_defaultni" => "<input type=\"text\" name=\"defaultni[]\" size=\"10\" value=\"%%1%%\" />",

                  "admin_edittab" => "
              <form method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" /><br />
                  nadpis: <input type=\"text\" name=\"nadpis\" value=\"%%2%%\" /><br />
                  obr nadpis: <input type=\"file\" name=\"obr_nadpis\" /><br />
                  <img src=\"%%3%%\" /><br />
                  <input type=\"radio\"%%6%% name=\"mini\" onclick=\"mini_1();\">dopocitat vysku<br />
                  <input type=\"radio\"%%7%% name=\"mini\" onclick=\"mini_2();\">dopocitat sirku<br />
                  <input type=\"radio\"%%8%% name=\"mini\" onclick=\"mini_3();\">nastaveno napevno<br />
                  <input type=\"radio\"%%9%% name=\"mini\" onclick=\"mini_4();\">nedělat nic<br />
                  w_mini: <input type=\"text\" name=\"w_mini\"id=\"mini_p1\" value=\"%%4%%\" /><br />
                  h_mini: <input type=\"text\" name=\"h_mini\"id=\"mini_p2\" value=\"%%5%%\" /><br />
                  <a href=\"%%10%%\" title=\"\">++ přidat sloupec</a>
                  <a href=\"%%11%%\" title=\"\">-- odebrat sloupec</a><br />
                  sloupce: %%12%%<br />
                  defaultni: %%13%%<br />
                  poznamka: <input type=\"text\" name=\"poznamka\" value=\"%%14%%\" /><br />
                  sekce_id: <input type=\"text\" name=\"sekce_id\" value=\"%%15%%\" /><br />
                  sekce_class: <input type=\"text\" name=\"sekce_class\" value=\"%%16%%\" /><br />
                  sekce_akce: <input type=\"text\" name=\"sekce_akce\" value=\"%%17%%\" /><br />
                  poradi: <input type=\"text\" name=\"poradi\" value=\"%%18%%\" />* >0<br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit sekci\" />
                </fieldset>
              </form>

              <script type=\"text/javascript\">
                function mini_1()
                {
                  document.getElementById('mini_p1').disabled = false;
                  document.getElementById('mini_p2').disabled = true;
                }

                function mini_2()
                {
                  document.getElementById('mini_p1').disabled = true;
                  document.getElementById('mini_p2').disabled = false;

                }

                function mini_3()
                {
                  document.getElementById('mini_p1').disabled = false;
                  document.getElementById('mini_p2').disabled = false;
                }

                function mini_4()
                {
                  document.getElementById('mini_p1').disabled = true;
                  document.getElementById('mini_p2').disabled = true;
                }

                %%19%%
              </script>
              ",

                  "admin_edittab_hlaska" => "
                    upravena tabulka s adresou: %%1%%, navic: %%2%%
                  ",

                  "admin_deltab_hlaska" => "
                  smazana tabulka s adresou: %%1%% a její buňky také, navic: %%2%%
                ",

                  "admin_addrow_table_begin" => "<table border=\"1\"><tr>",

                  "admin_addrow_table_header" => "<th>%%1%%</th>",

                  "admin_addrow_table_newrow" => "</tr><tr>",

                  "admin_addrow_table" => "<td><input type=\"text\" name=\"radek[]\" size=\"10\" value=\"%%1%%\" /></td>",

                  "admin_addrow_table_end" => "</tr></table>",

                  "admin_addrow" => "
              <form method=\"post\">
                <fieldset>
                  %%1%%<br />
                  sloupce: %%2%%
                  poradi: <input type=\"text\" name=\"poradi\" value=\"%%3%%\" /><br />
                  polozka_id: <input type=\"text\" name=\"polozka_id\" /><br />
                  polozka_class: <input type=\"text\" name=\"polozka_class\" /><br />
                  polozka_akce: <input type=\"text\" name=\"polozka_akce\" /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Přidat řádek\" />
                </fieldset>
              </form>
              ",

                  "admin_addrow_hlaska" => "
                přídán radek: %%1%%
              ",

                  "admin_editrow_table_begin" => "<table border=\"1\"><tr>",

                  "admin_editrow_table_header" => "<th>%%1%%</th>",

                  "admin_editrow_table_newrow" => "</tr><tr>",

                  "admin_editrow_table" => "<td><input type=\"text\" name=\"radek[]\" size=\"10\" value=\"%%1%%\" /></td>",

                  "admin_editrow_table_end" => "</tr></table>",

                  "admin_editrow" => "
              <form method=\"post\">
                <fieldset>
                  %%1%%<br />
                  sloupce: %%2%%
                  poradi: <input type=\"text\" name=\"poradi\" value=\"%%3%%\" /><br />
                  polozka_id: <input type=\"text\" name=\"polozka_id\" value=\"%%4%%\" /><br />
                  polozka_class: <input type=\"text\" name=\"polozka_class\" value=\"%%5%%\" /><br />
                  polozka_akce: <input type=\"text\" name=\"polozka_akce\" value=\"%%6%%\" /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit řádek\" />
                </fieldset>
              </form>
              ",

                  "admin_editrow_hlaska" => "
                upraven radek: %%1%%
              ",

                  "admin_delrow_hlaska" => "
                  smazan radek: %%1%%, pořadí: %%2%%
                ",

                  "admin_vypis_obsah_hlavicka" => "(%%1%%) '%%2%%', '%%3%%'
          <p>
            adresa: %%2%%<br />
            '%%4%%'<br />
            '%%5%%',
            pořadí: %%6%% <br />
          </p>
          <a href=\"%%7%%\" title=\"\">přidat řádek</a>
          <a href=\"%%8%%\" title=\"\">upravit sekci</a>
          <a href=\"%%9%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%2%%, %%3%%\' ?');\">smazat sekci</a> <br />
          <br />
          ",

                  "admin_vypis_obsah_bunka" => "
                %%1%% - %%2%%<br />
                <a href=\"%%3%%\" title=\"\">upravit řádek</a>
                <a href=\"%%4%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%1%%, pořadí: %%2%%\' ?');\">smazat řádek</a><br />
                <br />
                ",

                  "set_min_col" => 2,

                  "set_max_col" => 0,

                  "set_pathpicture" => "obrazky",

                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
