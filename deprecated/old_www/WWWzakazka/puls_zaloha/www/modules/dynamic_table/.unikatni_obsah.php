<?php

/**
 *
 * =1
 * admin_obsah_tabulky
 * admin_obsah_tabulky_add
 * admin_addeditrow_head
 * admin_addrow_default
 * admin_addeditrow
 * admin_addeditrow_add
 * admin_addeditrow_edit
 * admin_vypis_obsah_tabulky_begin
 * admin_vypis_obsah_tabulky_tvar_datum
 * admin_vypis_obsah_tabulky_sep
 * admin_vypis_obsah_tabulky
 * admin_vypis_obsah_tabulky_del
 * admin_vypis_obsah_tabulky_null
 * admin_vypis_obsah_tabulky_end
 * admin_vypis_obsah_tabulky_neupraveno
 *
 * =adresa
 * normal_vypis_table_row_null_
 * normal_vypis_table_null_
 * normal_vypis_table_obal_begin_
 * normal_vypis_table_obal_end_
 * normal_vypis_table_row_begin_
 * normal_vypis_table_row_end_
 * normal_vypis_table_row_header_
 * normal_vypis_table_bunka_
 * normal_vypis_table_row_
 * normal_vypis_table_prvni_
 * normal_vypis_table_posledni_
 * normal_vypis_table_ente_def_array_
 * normal_vypis_table_ente_def_
 * normal_vypis_table_ente_od_
 * normal_vypis_table_ente_po_
 * normal_vypis_table_ente_break_
 * normal_vypis_table_begin_poc_
 * normal_vypis_table_ente_
 * normal_vypis_table_row_prvni_
 * normal_vypis_table_row_posledni_
 * normal_vypis_table_row_ente_def_array_
 * normal_vypis_table_row_ente_def_
 * normal_vypis_table_row_ente_od_
 * normal_vypis_table_row_ente_po_
 * normal_vypis_table_row_ente_break_
 * normal_vypis_table_row_begin_poc_
 * normal_vypis_table_row_ente_
 *
 */

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamické tabulky",
                                              "title" => "Dynamické tabulky",),
                                        ),

                  "admin_permit" => array("%%1%%" => array("" => "Výpis tabulek", "addtab" => "Přidat tabulku", "edittab" => "Upravit tabulku", "deltab" => "Smazat tabulku",
                                                           "updatehlavicka" => "Úprava pořadí"),
                                          ),

                  "admin_permit_rozsireni_vypis" => "%%1%% - Výpis tabulek",

                  "admin_permit_rozsireni_addrow" => "%%1%% - Přidat řádek",

                  "admin_permit_rozsireni_editrow" => "%%1%% - Upravit řádek",

                  "admin_permit_rozsireni_delrow" => "%%1%% - Smazat řádek",

                  "admin_permit_rozsireni_updateradek" => "%%1%% - Úprava pořadí řádků",

                  "name_module" => array ("Dynamické tabulky",
                                          "Tabulkové výpisy"),

/* - - - - - - - - - - Normal výpis - - - - - - - - - - */

                  "normal_vypis_table_prvni_1" => "prvni",

                  "normal_vypis_table_posledni_1" => "posledni",

                  "normal_vypis_table_ente_def_array_1" => array(1, 3, 4),

                  "normal_vypis_table_ente_def_1" => "ente",

                  "normal_vypis_table_ente_od_1" => 0,

                  "normal_vypis_table_ente_po_1" => 2,

                  "normal_vypis_table_ente_break_1" => 0,

                  "normal_vypis_table_begin_poc_1" => 1,

                  "normal_vypis_table_ente_1" => "enté lineární pocitani %%1%%",

                  "normal_vypis_table_row_prvni_1" => "prvni",

                  "normal_vypis_table_row_posledni_1" => "posledni",

                  "normal_vypis_table_row_ente_def_array_1" => array(1, 3, 4),

                  "normal_vypis_table_row_ente_def_1" => "ente",

                  "normal_vypis_table_row_ente_od_1" => 0,

                  "normal_vypis_table_row_ente_po_1" => 2,

                  "normal_vypis_table_row_ente_break_1" => 0,

                  "normal_vypis_table_row_begin_poc_1" => 1,

                  "normal_vypis_table_row_ente_1" => "enté lineární pocitani %%1%%",

                  "normal_vypis_table_obal_begin_1" => "begin obal<br />\n",

                  "normal_vypis_table_row_header_1" => "p: %%1%%, ",

                  "normal_vypis_table_row_begin_1" => "
obal radku, hlavicka,
%%1%%,
%%2%%
--%%3%%--
%%4%%
%%5%%
%%6%%,
----
ente<br />
",

                  "normal_vypis_table_bunka_1" => "b: %%1%%, ",

                  "normal_vypis_table_row_1" => "
bunky:
--%%1%%--
%%2%%
%%3%%
%%4%%
---
ente<br />
",

                  "normal_vypis_table_null_1" => "žádná tabulka<br />\n",

                  "normal_vypis_table_row_null_1" => "žádné řádky<br />\n",

                  "normal_vypis_table_row_end_1" => "end obal radkum<br />\n",

                  "normal_vypis_table_obal_end_1" => "end obal<br />\n",

/* - - - - - - - - - - /Normal výpis - - - - - - - - - - */

                  "admin_obsah" => "
<div class=\"obal_dyntab\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Dynamické tabulky</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat tabulku\" class=\"addtab tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat tabulku</span>
  </a>
  <div class=\"cl-b\">
    %%2%%
  </div>
</div>\n",

                  "admin_addedittab_add" => "Přidat tabulku",

                  "admin_addedittab_edit" => "Upravit tabulku",

                  "admin_addtab_default" => array(2,
                                                  array("", "", ),
                                                  array("", "", ),
                                                  array("", "", ),
                                                  "",
                                                  "",
                                                  "",
                                                  0,
                                                  false,
                                                  false,
                                                  "",  //9
                                                  "",
                                                  "",
                                                  ""),

                  "admin_addedittab" => "
<script type=\"text/javascript\">
  var poc = %%2%%;
  function Pridej()
  {
    poc++;

    Vykresli();
  }

  function Odeber()
  {
    poc--;

    Vykresli();
  }

  var slo = ['|%%3%%|'];  //r+w
  var def = ['|%%4%%|'];  //r+w
  var pop = ['|%%5%%|'];  //r+w
  function PosliData(row, polozka, hodnota)
  {
%%6%%
    switch (polozka)
    {
      case 0:
        slo[row] = '|'+roz+'|';
        Vykresli();
      break;

      case 1:
        def[row] = '|'+roz+'|';
        Vykresli();
      break;

      case 2:
        pop[row] = '|'+roz+'|';
        Vykresli();
      break;
    }
  }

  function Vykresli()
  {
    $(function() {
      $.post(\"%%1%%/ajax_form.php\",
            \"action=listsloup&pocet=\"+poc+\"&sloupec=\"+slo+\"&default=\"+def+\"&popis=\"+pop,
              function(theResponse)
              {
                $('#sloupce').html(theResponse);
              }
            );
      $('.pocetprvku').val(poc);
      $('#pocet_sloupcu').html(poc);
    });
  }
  window.setTimeout(\"Vykresli();\", 10);
</script>
<div class=\"obal_dyntab\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%7%% %%9%%</h3>
  </div>
  <a href=\"%%17%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Adresa tabulky:</span>
        <input type=\"text\" name=\"adresa\" value=\"%%8%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Název tabulky:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%9%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-textarea w-500\">
        <span class=\"nazev-elementu\">Popis tabulky:</span>
        <textarea name=\"popis\" rows=\"7\" cols=\"60\">%%10%%</textarea>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximum řádků:</span>
        <input type=\"text\" name=\"max_row\" value=\"%%11%%\" />
        <span class=\"popis-elementu\">0 = neomezeně</span>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"zamek\"%%12%% />
        <span class=\"nazev-elementu\">Zamknout přidávání řádků</span>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"uradku\"%%13%% />
        <span class=\"nazev-elementu\">Zobrazit u řádků ID, Class, Akce JS tabulky</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">ID tabulky:</span>
        <input type=\"text\" name=\"table_id\" value=\"%%14%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Class tabulky:</span>
        <input type=\"text\" name=\"table_class\" value=\"%%15%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Akce JS tabulky:</span>
        <input type=\"text\" name=\"table_akce\" value=\"%%16%%\" />
      </label>
      <p class=\"ow-h\">
        <span class=\"block f-f-web-pro m-b-6\">Počet sloupců: <strong id=\"pocet_sloupcu\" class=\"no-b u\"></strong></span>
        <a href=\"#\" onclick=\"Pridej(); return false;\" title=\"Přidat sloupec\" class=\"block fl-l odkaz-1 m-b-4 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Přidat sloupec</a>
        <input type=\"hidden\" class=\"pocetprvku\" name=\"pocet\" />
      </p>
      <div id=\"sloupce\" class=\"f-text w-500 pos-rel obal-odkazy-pridat-odebrat m-b-0-i\"></div>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%7%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "ajax_listsloup" => "
<div class=\"m-b-5-i f-wysiwyg\">
  <span class=\"nazev-elementu\">Název sloupce [%%2%%]:</span>
  <input type=\"text\" name=\"sloupce[%%1%%]\" value=\"%%3%%\" onchange=\"PosliData(%%1%%, 0, this.value);\" />
</div>
<div class=\"m-b-5-i f-wysiwyg\">
  <span class=\"nazev-elementu\">Výchozí obsah [%%2%%]:</span>
  <input type=\"text\" name=\"defaultni[%%1%%]\" value=\"%%4%%\" onchange=\"PosliData(%%1%%, 1, this.value);\" />
</div>
<div class=\"m-b-20-i f-wysiwyg\">
  <span class=\"nazev-elementu\">Popis sloupce [%%2%%]:</span>
  <input type=\"text\" name=\"popisy[%%1%%]\" value=\"%%5%%\" onchange=\"PosliData(%%1%%, 2, this.value);\" />
</div>
%%6%%",

                  "ajax_listsloup_del" => "<a href=\"#\" onclick=\"Odeber(); return false\" title=\"Odebrat sloupec\" class=\"odkaz-odebrat odkaz-1 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Odebrat sloupec</a>",

                  "admin_vypis_obsah_begin" => "
<script type=\"text/javascript\">
    $(function() {
      $(\".obal_razeni\").sortable({
                          tolerance: 'pointer',
                          scroll: true,
                          scrollSensitivity: 40,
                          scrollSpeed: 30,
                          revert: 300,
                          opacity: 0.6,
                          cursor: 'move',
                          delay: 150,
                          update: function() {
        var order = $(this).sortable(\"serialize\") + '&action=updatehlavicka';
        $.post(\"%%1%%/ajax_form.php\", order, function(theResponse){
          $('#status_drag').html(theResponse);
        });
        ZpracujHlasku('#status_drag');
      }
      });
    });

  function ZpracujHlasku(ret)
  {
    $(ret).fadeIn('slow').delay(2000).fadeOut('slow');
  }
</script>
<div class=\"obal_razeni\">\n",

                  "admin_vypis_obsah_sep" => ", ",

                  "admin_vypis_obsah" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h cur-move\"><span class=\"fl-l\">%%3%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%10%%\" class=\"edittab block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit tabulku\">Upravit tabulku</a><a href=\"%%11%%\" title=\"Opravdu chceš smazat tabulku: &quot;%%3%%&quot; ?\" class=\"confirm deltab block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat tabulku</a></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Adresa tabulky:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Maximum řádků:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Zámek na přidávání řádků:</span><span class=\"fl-r\"><input type=\"checkbox\" disabled=\"disabled\"%%5%% class=\"block m-t-2\" /></span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Popis tabulky:</span><span class=\"fl-r barva-5\">%%6%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Názvy sloupců:</span><span class=\"fl-r barva-5\">%%7%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Výchozí obsahy sloupců:</span><span class=\"fl-r barva-5\">%%8%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Popisy sloupců:</span><span class=\"fl-r barva-5\">%%9%%</span></li>
</ul>\n",

                  "admin_vypis_obsah_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Nejsou vytvořeny žádné tabulky</div>",

                  "admin_vypis_obsah_end" => "</div>\n<div id=\"status_drag\"></div>\n",

                  "ajax_updatehlavicka" => "Bylo změněno pořadí tabulek",

                  "ajax_updatehlavicka_not_permit" => "Nemáte oprávnění",

                  "admin_obsah_tabulky_add" => "
  <a href=\"%%1%%\" title=\"Přidat řádek\" class=\"addrow tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat řádek</span>
  </a>\n",

                  "admin_obsah_tabulky" => "
<div class=\"obal_dyntab__%%1%%\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%3%%</h3>
    <h4 class=\"pod-nadpis-sekce f-s-17 f-f-web-pro\">%%4%%<!-- --></h4>
  </div>
%%2%%
  <div class=\"cl-b\">
    %%5%%
  </div>
</div>\n",

                  "admin_addeditrow_add" => "Přidat řádek",

                  "admin_addeditrow_edit" => "Upravit řádek",

                  "admin_addeditrow_head" => "
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">%%2%%:</span>
        <input type=\"text\" name=\"radek[%%1%%]\" value=\"%%3%%\" />
        <span class=\"popis-elementu\">%%4%%</span>
      </label>\n",

                  "admin_addrow_default" => array("",
                                                  "",
                                                  "",
                                                  true),

                  "admin_addeditrow" => "
<div class=\"obal_dyntab\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%2%% - %%1%%</h3>
  </div>
  <a href=\"%%9%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
%%3%%
      <label class=\"f-text w-500%%4%%\">
        <span class=\"nazev-elementu\">ID řádku:</span>
        <input type=\"text\" name=\"bunka_id\" value=\"%%5%%\" />
        <span class=\"popis-elementu\">Zde nevyplňuj žádný text, pokud není určeno jinak.</span>
      </label>
      <label class=\"f-text w-500%%4%%\">
        <span class=\"nazev-elementu\">Class řádku:</span>
        <input type=\"text\" name=\"bunka_class\" value=\"%%6%%\" />
        <span class=\"popis-elementu\">Zde nevyplňuj žádný text, pokud není určeno jinak.</span>
      </label>
      <label class=\"f-text w-500%%4%%\">
        <span class=\"nazev-elementu\">Akce JS řádku:</span>
        <input type=\"text\" name=\"bunka_akce\" value=\"%%7%%\" />
        <span class=\"popis-elementu\">Zde nevyplňuj žádný text, pokud není určeno jinak.</span>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"aktivni\"%%8%% />
        <span class=\"nazev-elementu\">Aktivní řádek</span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_vypis_obsah_tabulky_begin" => "
<script type=\"text/javascript\">
  $(document).ready(function(){
    $(function() {
      $(\".obal_razeni\").sortable({
                          tolerance: 'pointer',
                          scroll: true,
                          scrollSensitivity: 40,
                          scrollSpeed: 30,
                          revert: 300,
                          opacity: 0.6,
                          cursor: 'move',
                          delay: 150,
                          update: function() {
        var order = $(this).sortable(\"serialize\") + '&action=updateradek';
        $.post(\"%%1%%/ajax_form.php\", order, function(theResponse){
          $('#status_drag').html(theResponse);
        });
        ZpracujHlasku('#status_drag');
      }
      });
    });
  });

  function ZpracujHlasku(ret)
  {
    $(ret).fadeIn('slow').delay(2000).fadeOut('slow');
  }
</script>
<div class=\"obal_razeni\">\n",

                  "admin_vypis_obsah_tabulky_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_obsah_tabulky_sep" => ", ",

                  "admin_vypis_obsah_tabulky_del" => "<a href=\"%%2%%\" title=\"Opravdu chceš smazat řádek s ID: &quot;%%1%%&quot; ?\" class=\"confirm delrow block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat řádek</a>",

                  "admin_vypis_obsah_tabulky" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h cur-move\"><span class=\"fl-l\">%%2%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%6%%\" class=\"editrow block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit řádek\">Upravit řádek</a>%%7%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">ID řádku:</span><span class=\"fl-r barva-5\">%%1%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Aktivní řádek:</span><span class=\"fl-r\"><input type=\"checkbox\" disabled=\"disabled\"%%5%% class=\"block m-t-2\" /></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas přidání řádku:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas upravení řádku:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
</ul>\n",

                  "admin_vypis_obsah_tabulky_neupraveno" => "Řádek nebyl zatím upraven",

                  "admin_vypis_obsah_tabulky_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Nejsou vytvořeny žádné řádky</div>",

                  "admin_vypis_obsah_tabulky_end" => "</div>\n<div id=\"status_drag\"></div>\n",

                  "ajax_updateradek" => "Bylo změněno pořadí řádků",

                  "ajax_updateradek_not_permit" => "Nemáte oprávnění",

                  );

  return $result;
?>
