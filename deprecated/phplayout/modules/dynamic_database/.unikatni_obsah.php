<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Administrace databází",
                                              "title" => "Administrace databází",),
                                        ),

                  "admin_permit" => array("%%1%%" => array("" => "Výpis databází", "info" => "Výpis tabulek", "show" => "Zobrazit obsah", "struct" => "Zobrazit strukturu", "sqlquery" => "SQL Dotaz", "clearhist" => "Promazání historie SQL",
                                                          "export" => "Exportovat databázi", "import" => "Importovat databázi"),
                                          ),

                  "name_module" => array ("Administrace databází",
                                          "Administrace databází"),

                  "admin_obsah" => "
<div class=\"obal_admindb\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Administrace databází</h3>
  </div>
  %%1%%
</div>\n",

                  "admin_vypis_obsah" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l ow-h\"><a href=\"%%1%%\" title=\"%%2%%\" class=\"block fl-l no-u odkaz-4 barva-1\">%%2%%</a></span><span class=\"fl-r\">%%5%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Velikost:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas poslední změny:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
</ul>\n",

                  "admin_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_info_hlavicka_begin" => "
<div class=\"obal_admindb\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%2%% - Výpis tabulek</h3>
  </div>
  <a href=\"%%1%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <div class=\"cl-b ow-h m-b-15\">
    <a href=\"%%6%%\" title=\"Importovat databázi\" class=\"import tlacitko-8 m-r-12 m-l-2 fl-l odkaz-20\">
      <span class=\"tlacitko-left\"><!-- --></span>
      <span class=\"tlacitko-right\"><!-- --></span>
      <span class=\"tlacitko-text\">Importovat databázi</span>
    </a>
    <a href=\"%%4%%\" title=\"Exportovat databázi do SQLite\" class=\"export tlacitko-8 m-r-12 fl-l odkaz-19\">
      <span class=\"tlacitko-left\"><!-- --></span>
      <span class=\"tlacitko-right\"><!-- --></span>
      <span class=\"tlacitko-text\">Exportovat do SQLite</span>
    </a>
    <a href=\"%%5%%\" title=\"Exportovat databázi do MySQLi\" class=\"export tlacitko-8 m-r-12 fl-l odkaz-19\">
      <span class=\"tlacitko-left\"><!-- --></span>
      <span class=\"tlacitko-right\"><!-- --></span>
      <span class=\"tlacitko-text\">Exportovat do MySQLi</span>
    </a>
    <a href=\"%%3%%\" title=\"SQL dotaz\" class=\"sqlquery tlacitko-8 fl-l odkaz-12\">
      <span class=\"tlacitko-left\"><!-- --></span>
      <span class=\"tlacitko-right\"><!-- --></span>
      <span class=\"tlacitko-text\">SQL dotaz</span>
    </a>
  </div>\n",

                  "admin_info_hlavicka" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15 cl-b\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%3%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%1%%\" title=\"Zobrazit obsah\" class=\"show block fl-l m-r-5 m-l-5 no-u odkaz-4\">Zobrazit obsah</a><a href=\"%%2%%\" title=\"Zobrazit strukturu\" class=\"struct block fl-l m-r-5 m-l-5 no-u odkaz-4\">Zobrazit strukturu</a></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Počet záznamů:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
</ul>\n",

                  "admin_info_hlavicka_end" => "</div>",

                  "admin_import" => "
<div class=\"obal_admindb\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%3%% - Importovat databázi</h3>
  </div>
  <a href=\"%%2%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-textarea w-700\">
        <textarea name=\"dotaz\" rows=\"60\" cols=\"60\" class=\"f-s-14-i f-f-web-pro-i\">%%4%%</textarea>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko_import\" value=\"Importovat databázi\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_export" => "
<div class=\"obal_admindb\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%3%% - Exportovat do %%4%%</h3>
  </div>
  <a href=\"%%2%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-textarea w-700\">
        <textarea rows=\"60\" cols=\"60\" class=\"f-s-14-i f-f-web-pro-i\">%%5%%</textarea>
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_sqlquery" => "
<script type=\"text/javascript\">
  function VlozHistorii(hash)
  {
    $.post(\"%%1%%/ajax_form.php\",
      \"action=inserthistory&hash=\"+hash,
        function(theResponse)
        {
          $('#dotaz_textarea').html(theResponse);
        }
      );
  }
</script>
<div class=\"obal_admindb\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%4%% - SQL dotaz</h3>
  </div>
  <a href=\"%%3%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <ul class=\"obal_funkce_error f-s-14 f-f-web-pro m-b-15 cl-b\">
    <li class=\"nadpis-6 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l f-s-16\">Historie dotazů</span><span class=\"block fl-r m-t-1 ow-h\"><a href=\"%%8%%\" title=\"Opravdu chceš smazat historii dotazů ?\" class=\"clearhist confirm block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat historii dotazů</a></span></li>
    <li class=\"polozka-4-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Zobrazit zkrácenou historii dotazů:</span><span class=\"fl-r barva-5\"><input type=\"checkbox\" onclick=\"document.location.href='%%5%%'\"%%6%% class=\"block m-t-2 cur-poi\" /></span></li>
%%7%%
    <li class=\"nadpis-6 m-t-25 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l f-s-16\">Dostupné tabulky</span></li>
%%9%%
  </ul>
  <form method=\"post\" action=\"\" class=\"m-t-25 cl-b formular\">
    <fieldset>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"small\"%%11%% />
        <span class=\"nazev-elementu\">Zkracovat výpis</span>
      </label>
      <label class=\"f-textarea w-700\">
        <span class=\"nazev-elementu\">Dotaz:</span>
        <textarea name=\"dotaz\" rows=\"30\" cols=\"60\" class=\"f-s-14-i f-f-web-pro-i\" id=\"dotaz_textarea\">%%10%%</textarea>
      </label>
      <label class=\"f-submit m-r-3-i fl-l\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"Vykonat SQL dotaz\" />
      </label>
      <label class=\"f-submit m-l-240-i no-cl-i fl-l-i\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"null_tlacitko\" value=\"Reset SQL dotazu\" />
      </label>
    </fieldset>
  </form>
%%12%%
</div>\n",

                  "admin_vypis_small_history" => "
<li class=\"nadpis-2 f-s-16 m-t-2 m-r-10 m-l-10 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l\"><a href=\"#\" onclick=\"VlozHistorii('%%2%%'); return false;\" title=\"%%1%%\" class=\"block no-u odkaz-10\">%%1%%</a></span><span class=\"block fl-r\">%%3%%x</span></li>\n",

                  "admin_vypis_full_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_full_history" => "
<li class=\"nadpis-2 f-s-16 m-t-2 m-r-10 m-l-10 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l\"><a href=\"#\" onclick=\"VlozHistorii('%%3%%'); return false;\" title=\"%%2%%\" class=\"block no-u odkaz-10\">%%2%%</a></span><span class=\"block fl-r\">#%%4%%</span></li>
<li class=\"polozka-4-lichy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas:</span><span class=\"fl-r barva-5\">%%1%%</span></li>\n",

                  "admin_vypis_history_null" => "<div class=\"nadpis-2 f-s-16 m-t-2 p-t-10 p-b-10 t-a-c f-f-web-pro\">Historie dotazů je prázdná</div>",

                  "admin_sqlquery_available_table" => "
<li class=\"nadpis-2 f-s-16 m-t-2 m-r-10 m-l-10 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block cur-poi odkaz-10\" onclick=\"$('#dotaz_textarea').val($('#dotaz_textarea').val()+'%%1%%').focus();\">%%1%%</span></li>\n",

                  "admin_sqlquery_ret" => "",

                  "admin_sqlquery_ret_table_begin" => "
<ul class=\"f-f-web-pro f-s-14 m-t-15 cl-b\">
  <li class=\"nadpis-4 f-s-16 m-t-2 m-r-10 m-l-10 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l\">%%1%%</span></li>
  <li class=\"polozka-3-lichy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Vypsáno řádků:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-3-sudy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Ovlivněno řádků:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
</ul>
<table summary=\"\" class=\"m-t-15 m-l-10 nadpis-1 f-f-web-pro f-s-14 t-a-c\">
  <tr>\n",

                  "admin_sqlquery_ret_hlavicka" => "<th class=\"nadpis-6 no-b p-t-5 p-r-5 p-b-5 p-l-5\">%%1%%</th>\n",

                  "admin_sqlquery_ret_hlavicka_end" => "</tr>\n",

                  "admin_sqlquery_ret_telicko" => "<td class=\"nadpis-2 p-t-5 p-r-5 p-b-5 p-l-5\">%%1%%</td>\n",

                  "admin_sqlquery_ret_telicko_begin" => "<tr>",

                  "admin_sqlquery_ret_telicko_end" => "</tr>\n",

                  "admin_sqlquery_ret_table_end" => "</table>\n",

                  "admin_sqlquery_ret_error" => "
<ul class=\"f-f-web-pro f-s-14 m-t-15 m-b-15 cl-b\">
  <li class=\"nadpis-4 f-s-16 m-t-2 m-r-10 m-l-10 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l\">Error</span></li>
  <li class=\"polozka-3-sudy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">%%1%%</span></li>
</ul>\n",

                  "admin_sqlquery_ret_null" => "
<ul class=\"f-f-web-pro f-s-14 m-t-15 cl-b\">
  <li class=\"nadpis-4 f-s-16 m-t-2 m-r-10 m-l-10 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l\">Žádný výsledek</span></li>
  <li class=\"polozka-3-sudy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Ovlivněno řádků:</span><span class=\"fl-r barva-5\">%%1%%</span></li>
</ul>\n",

                  "admin_sqlquery_small_count" => 20,

                  "admin_sqlquery_small_char" => "...",

                  "admin_show_hlavicka" => "
<div class=\"obal_admindb ow-h\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%4%% - Zobrazit obsah - %%5%%</h3>
  </div>
  <a href=\"%%2%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <a href=\"%%3%%\" title=\"Zobrazit strukturu\" class=\"tlacitko-2 fl-r m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zobrazit strukturu</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" onclick=\"document.location.href='%%6%%'\"%%7%% />
        <span class=\"nazev-elementu\">Zkracovat výpis</span>
      </label>
    </fieldset>
  </form>
  <script type=\"text/javascript\">
    function EditCell(index, table, id, bunka, stav, lastval, ret)
    {
      $.post(\"%%8%%/ajax_form.php\",
        \"action=geteditcell&index=\"+index+\"&table=\"+table+\"&id=\"+id+\"&bunka=\"+bunka+\"&stav=\"+stav+\"&lastval=\"+lastval+\"&ret=\"+ret,
          function(theResponse)
          {
            $(ret).html(theResponse);
          }
        );
    }

    function SaveEditCell(index, table, id, bunka, value, stav, ret)
    {
%%9%%

      $.post(\"%%8%%/ajax_form.php\",
        \"action=seteditcell&index=\"+index+\"&table=\"+table+\"&id=\"+id+\"&bunka=\"+bunka+\"&value=\"+roz+\"&stav=\"+stav+\"&ret=\"+ret,
          function(theResponse)
          {
            $(ret).html(theResponse);
            $('#status_drag').html('Uloženo ID: '+id+', hodnota: '+theResponse);
            ZpracujHlasku('#status_drag');
          }
        );
    }

    function CancelEditCell(value, ret)
    {
      $(ret).html(value);
    }

    function ZpracujHlasku(ret)
    {
      $(ret).fadeIn('slow').delay(2000).fadeOut('slow');
    }
  </script>
</div>\n",

                  "admin_show_begin_table" => "\n<table summary=\"\" class=\"m-t-15 m-l-10 nadpis-1 f-f-web-pro f-s-14 t-a-c\">\n  <tr>\n",

                  "admin_show_header" => "    <th class=\"nadpis-6 no-b p-t-5 p-r-5 p-b-5 p-l-5\">%%1%%</th>\n",

                  "admin_show_end_header" => "  </tr>\n",

                  "admin_show_begin_body" => "  <tr>\n",

                  "admin_show_body" => "    <td title=\"%%4%%\" id=\"%%3%%\"%%2%% class=\"nadpis-2 p-t-5 p-r-5 p-b-5 p-l-5\">%%1%%</td>\n",

                  "admin_show_end_body" => "  </tr>\n",

                  "admin_show_end_table" => "</table>\n<div id=\"status_drag\"></div>\n",

                  "admin_show_small_count" => 20,

                  "admin_show_small_char" => "...",

                  "admin_show_begin_empty_table" => "\n<table summary=\"\" class=\"m-t-15 m-l-10 nadpis-1 f-f-web-pro f-s-14 t-a-c\">\n  <tr>\n",

                  "admin_show_empty_header" => "    <th class=\"nadpis-6 no-b p-t-5 p-r-5 p-b-5 p-l-5\">%%1%%</th>\n",

                  "admin_show_end_empty_table" => "\n</tr>\n<tr>\n<th colspan=\"%%1%%\" class=\"nadpis-2 p-t-5 p-r-5 p-b-5 p-l-5 no-b\">Prázdná tabulka</th>\n</tr>\n</table>\n</div>\n",

                  "ajax_get_edit_cell" => "
<form method=\"post\" action=\"\" class=\"formular w-500 m-auto p-r-7\">
  <fieldset>
    <label class=\"f-textarea w-500 m-b-5-i\">
      <textarea rows=\"20\" cols=\"60\" class=\"f-s-14-i f-f-web-pro-i\" id=\"%%2%%-textarea\">%%3%%</textarea>
    </label>
    <label class=\"f-submit m-r-17-i fl-l\">
      <span class=\"f-submit-pattern\"><!-- --></span>
      <input type=\"button\" value=\"Uložit\" onclick=\"%%1%%\" />
    </label>
    <label class=\"f-submit m-l-300-i no-cl-i fl-l-i\">
      <span class=\"f-submit-pattern\"><!-- --></span>
      <input type=\"button\" value=\"Zrušit\" onclick=\"%%4%%\" />
    </label>
  </fieldset>
</form>\n",

                  "admin_struct_hlavicka" => "
<div class=\"obal_admindb ow-h\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%4%% - Zobrazit strukturu - %%5%%</h3>
  </div>
  <a href=\"%%2%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <a href=\"%%3%%\" title=\"Zobrazit obsah\" class=\"tlacitko-2 fl-r m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zobrazit obsah</span>
  </a>
</div>\n",

                  "admin_struct_begin" => "
<table summary=\"\" class=\"w-100-p m-t-15 nadpis-1 f-f-web-pro f-s-14 t-a-c\">
<tr>
  <th class=\"nadpis-6 no-b p-t-5 p-r-5 p-b-5 p-l-5\">name</th>
  <th class=\"nadpis-6 no-b p-t-5 p-r-5 p-b-5 p-l-5\">typ</th>
  <th class=\"nadpis-6 no-b p-t-5 p-r-5 p-b-5 p-l-5\">vlastnosti</th>
  <th class=\"nadpis-6 no-b p-t-5 p-r-5 p-b-5 p-l-5\">pk</th>
  <th class=\"nadpis-6 no-b p-t-5 p-r-5 p-b-5 p-l-5\">ai</th>
</tr>\n",

                  "admin_struct_flags" => "%%1%%%%2%%%%3%%",

                  "admin_struct_flags_unsigned" => "<span class=\"block\">unsigned</span>",

                  "admin_struct_flags_zerofill" => "<span class=\"block\">zerofill</span>",

                  "admin_struct_flags_binary" => "<span class=\"block\">binary</span>",

                  "admin_struct" => "
<tr>
  <td class=\"nadpis-2 p-t-5 p-r-5 p-b-5 p-l-5\">%%1%%</td>
  <td class=\"nadpis-2 p-t-5 p-r-5 p-b-5 p-l-5\">%%2%%</td>
  <td class=\"nadpis-2 p-t-5 p-r-5 p-b-5 p-l-5\">%%3%%</td>
  <td class=\"nadpis-2 p-t-5 p-r-5 p-b-5 p-l-5\"><input type=\"checkbox\" disabled=\"disabled\"%%4%% /></td>
  <td class=\"nadpis-2 p-t-5 p-r-5 p-b-5 p-l-5\"><input type=\"checkbox\" disabled=\"disabled\"%%5%% /></td>
</tr>\n",

                  "admin_struct_end" => "\n</table>\n",

                  );

  return $result;
?>
