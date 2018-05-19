<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Administrace dynamickych tabulek",
                                              "title" => "administrace dynamickych tabulek",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "normal_vypis_table_header_1" => "<th>%%1%%</th>",

                  "normal_vypis_table_begin_1" => "%%1%%
          <table border=\"1\"%%2%%%%3%%%%4%%>
          <tr>
          %%5%%
          </tr>
          ",

                  "normal_vypis_table_row_bunka_1" => "<td>%%1%%</td>",

                  "normal_vypis_table_row_bunka_empty_1" => "<!-- -->",

                  "normal_vypis_table_row_1" => "
                <tr%%1%%%%2%%%%3%%>
                  %%4%%, (%%5%% %%6%% %%7%% %%8%%)
                </tr>
                ",

                  "normal_table_prvni_1" => "prvni",

                  "normal_table_posledni_1" => "posledni",

                  "normal_table_ente_def_array_1" => array(1, 2, 5),

                  "normal_table_ente_def_1" => "aktivni",

                  "normal_table_ente_od_1" => 0,

                  "normal_table_ente_po_1" => 2,

                  "normal_table_ente_1" => "ente",


                  "normal_vypis_table_null_1" => "<th colspan=\"%%1%%\">žádný řádek</th>",

                  "normal_vypis_table_end_1" => "
          </table>
          %%1%%",

                  "normal_vypis_empty_1" => "žádná položka",

                  "admin_vyber_tabulky_begin" => "<select name=\"hlavicka\">",

                  "admin_vyber_tabulky" => "
            <option value=\"%%1%%\"%%2%%>adresa: %%3%%</option>
          ",

                  "admin_vyber_tabulky_end" => "</select>",

                  "admin_vyber_tabulky_null" => "žádný formulář",

                  "admin_obsah_addlink" => "<a href=\"%%1%%\" title=\"\">přidat tabulku</a><br />",

                  "admin_obsah" => "administrace dynamickych tabulek
    <br />
    %%1%%
    <br />
    %%2%%
    ",

                  "admin_addtab_input_sloupce" => "<input type=\"text\" name=\"sloupce[]\" size=\"10\" />",

                  "admin_addtab_input_defaultni" => "<input type=\"text\" name=\"defaultni[]\" size=\"10\" />",

                  "admin_addtab" => "
          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" />*<br />
              nadpis: <input type=\"text\" name=\"nadpis\" /><br />
              <a href=\"%%1%%\" title=\"\">++ přidat sloupec</a>
              <a href=\"%%2%%\" title=\"\">-- odebrat sloupec</a><br />
              sloupce: %%3%%<br />
              defaultni: %%4%%<br />
              poznamka: <input type=\"text\" name=\"poznamka\" /><br />
              table_id: <input type=\"text\" name=\"table_id\" /><br />
              table_class: <input type=\"text\" name=\"table_class\" /><br />
              table_akce: <input type=\"text\" name=\"table_akce\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat tabulku\" />
            </fieldset>
          </form>
          ",

                  "admin_addtab_hlaska" => "
                přídána tabulka s adresou: %%1%%
              ",

                  "admin_edittab_input_sloupce" => "<input type=\"text\" name=\"sloupce[]\" size=\"10\" value=\"%%1%%\" />",

                  "admin_edittab_input_defaultni" => "<input type=\"text\" name=\"defaultni[]\" size=\"10\" value=\"%%1%%\" />",

                  "admin_edittab" => "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" /><br />
                  nadpis: <input type=\"text\" name=\"nadpis\" value=\"%%2%%\" /><br />
                  <a href=\"%%3%%\" title=\"\">++ přidat sloupec</a>
                  <a href=\"%%4%%\" title=\"\">-- odebrat sloupec</a><br />
                  sloupce: %%5%%<br />
                  defaultni: %%6%%<br />
                  poznamka: <input type=\"text\" name=\"poznamka\" value=\"%%7%%\" /><br />
                  table_id: <input type=\"text\" name=\"table_id\" value=\"%%8%%\" /><br />
                  table_class: <input type=\"text\" name=\"table_class\" value=\"%%9%%\" /><br />
                  table_akce: <input type=\"text\" name=\"table_akce\" value=\"%%10%%\" /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit tabulku\" />
                </fieldset>
              </form>
              ",

                  "admin_edittab_hlaska" => "
                    upravena tabulka s adresou: %%1%%
                  ",

                  "admin_deltab_hlaska" => "
                  smazana tabulka s adresou: %%1%% a její buňky také
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
                  bunka_id: <input type=\"text\" name=\"bunka_id\" /><br />
                  bunka_class: <input type=\"text\" name=\"bunka_class\" /><br />
                  bunka_akce: <input type=\"text\" name=\"bunka_akce\" /><br />
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
                  bunka_id: <input type=\"text\" name=\"bunka_id\" value=\"%%4%%\" /><br />
                  bunka_class: <input type=\"text\" name=\"bunka_class\" value=\"%%5%%\" /><br />
                  bunka_akce: <input type=\"text\" name=\"bunka_akce\" value=\"%%6%%\" /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit řádek\" />
                </fieldset>
              </form>
              ",

                  "admin_editrow_hlaska" => "
                upraven radek:%%1%%
              ",

                  "admin_delrow_hlaska" => "
                  smazan radek: %%1%%, pořadí: %%2%%
                ",


                  "admin_vypis_begin" => "
<script type=\"text/javascript\" src=\"%%1%%%%2%%/jquery-1.3.2.min.js\"></script>
<script type=\"text/javascript\" src=\"%%1%%%%2%%/jquery-ui-1.7.1.custom.min.js\"></script>
<div class=\"razeni_galerie_bez_sekci\">
  <h3>Řazení řádků metodou <strong>drag and drop</strong></h3>

  <p class=\"odkaz_vpravo\">???</p>

<script type=\"text/javascript\">
  $(document).ready(function(){
    $(function() {
      $(\"#obal_razeni ul\").sortable({ opacity: 0.6, cursor: 'move', update: function() {
        var order = $(this).sortable(\"serialize\") + '&action=updateRecordsListings';
        $.post(\"%%1%%%%2%%/ajax_form.php\", order, function(theResponse){
          $(\"#status_drag\").html(theResponse);
          setTimeout(\"SchovejHlasku()\", 2000);
        });
        ZobrazHlasku();
      }
      });
    });
  });

  function ZobrazHlasku()
  {
    $(document).ready(function(){
      $(\"#status_drag\").fadeIn(\"slow\");
    });
  }

  function SchovejHlasku()
  {
    $(document).ready(function(){
      $(\"#status_drag\").fadeOut(\"slow\");
    });
  }
</script>
<div id=\"obal_razeni\">
<ul>\n",

                  "admin_vypis_obsah_adddel_link" => "
            <a href=\"%%3%%\" title=\"\">upravit tabulku</a>
            <a href=\"%%4%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%1%%, %%2%%\' ?');\">smazat tabulku</a>
                  ",

                  "admin_vypis_obsah_hlavicka" => "
                  <br />
                  id: %%1%%<br /> '
                  adresa: %%2%%<br />
                  nadpis: %%3%%<br />
                  poznamka: %%4%%<br />
                [%%8%% %%9%% %%10%%]<br />
          <a href=\"%%5%%\" title=\"\">přidat řádek</a>
          %%6%%<br />
          ---<br />
          %%7%%
          ---<br />
          <br /><br />
          ",

                  "admin_vypis_obsah_bunka_null" => "žádná buňka...<br />",

                  "admin_vypis_obsah_bunka" => "
              <li class=\"obrazek_razeni\" id=\"recordsArray_%%1%%\">
                id: %%1%%,<br />
                [0] => %%2%%<br />
                pořadí: %%3%%,<br />
                [%%6%% %%7%% %%8%%]<br />
                <a href=\"%%4%%\" title=\"\">upravit řádek</a>
                <a href=\"%%5%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%1%%, %%2%%, %%3%%\' ?');\">smazat řádek</a><br />
              </li>
                ",

                  "admin_vypis_end" => "
</ul>
</div>
<div id=\"status_drag\"></div>
</div>\n",

                  "ajax_update_records_listings" => "Byl proveden přesun mezi položkami: %%1%% a %%2%%",

                  "set_min_col" => 1,

                  "set_max_col" => 0,

                  "set_povolit_pridani" => true,

                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
