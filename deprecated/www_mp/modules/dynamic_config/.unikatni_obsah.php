<?php

/**
 *
 *  =1
 * admin_obsah_sablona
 * admin_obsah_sablona_null
 * admin_obsah_element_null
 * admin_obsah_element_number
 * admin_obsah_element_alphanumeric
 * admin_obsah_element_minitext
 * admin_obsah_element_fulltext
 * admin_obsah_element_wymeditor
 * admin_obsah_element_tinymce
 * admin_obsah_element_color
 * admin_obsah_element_slider
 * admin_obsah_element_checkbox
 * admin_obsah_element_checkgroup_row
 * admin_obsah_element_checkgroup_zalomeni
 * admin_obsah_element_checkgroup
 * admin_obsah_element_radio_row
 * admin_obsah_element_radio_zalomeni
 * admin_obsah_element_radio
 * admin_obsah_element_select_row
 * admin_obsah_element_select
 * admin_obsah_element_stars_row
 * admin_obsah_element_stars
 * admin_obsah_element_stars2_row
 * admin_obsah_element_stars2
 * admin_obsah_element_header
 *
 * =adresa
 * normal_config_group_
 *
 **/

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Konfigurace - výpis šablon",
                                              "title" => "%%2%%",),

                                        array("main_href" => "%%1%%%%3%%",
                                              "odkaz" => "Řazení šablon",
                                              "title" => "Řazení šablon",),
                                        ),

                  "control_preinstall" => array ("sablona" => array(array("id" => 1,
                                                                          "adresa" => "meta-informace",
                                                                          "nazev" => "Meta informace",
                                                                          "popis" => "",
                                                                          "poradi" => 1),
                                                                    ),
                                                 "element" => array(array("sablona" => 1,
                                                                          "adresa" => "meta_author",
                                                                          "nazev" => "Meta author",
                                                                          "typ" => "fulltext",
                                                                          "konfigurace" => "100%%1%%200",
                                                                          "value" => "GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)",
                                                                          "zamek" => 0,
                                                                          "popis" => "",
                                                                          "pridano" => "%%2%%",
                                                                          "poradi" => 1),

                                                                    array("sablona" => 1,
                                                                          "adresa" => "meta_copyright",
                                                                          "nazev" => "Meta copyright",
                                                                          "typ" => "fulltext",
                                                                          "konfigurace" => "100%%1%%200",
                                                                          "value" => "Created by GoodFlow design",
                                                                          "zamek" => 0,
                                                                          "popis" => "",
                                                                          "pridano" => "%%2%%",
                                                                          "poradi" => 2),

                                                                    array("sablona" => 1,
                                                                          "adresa" => "meta_keywords",
                                                                          "nazev" => "Meta keywords",
                                                                          "typ" => "fulltext",
                                                                          "konfigurace" => "100%%1%%200",
                                                                          "value" => "",
                                                                          "zamek" => 0,
                                                                          "popis" => "",
                                                                          "pridano" => "%%2%%",
                                                                          "poradi" => 3),
                                                                    ),
                                                ),

                  "admin_permit" => array("%%1%%" => array("" => "Výpis šablon", "addsab" => "Přidat šablonu", "copysab" => "Duplikovat šablonu", "editsab" => "Upravit šablonu", "delsab" => "Smazat šablonu",
                                                           "copyelem" => "Duplikovat element", "addelem" => "Přidat element", "editelem" => "Upravit element", "delelem" => "Smazat element",
                                                           "updateelement" => "Úprava pořadí elementů", "changeactelem" => "Změna aktivity elementu"),
                                          "%%1%%%%2%%" => array("" => "Výpis řazení šablon", "updatesablona" => "Úprava pořadí šablon"),
                                          ),

                  "admin_permit_rozsireni_vypis" => "%%1%% - Výpis elementů",

                  "admin_permit_rozsireni_uprava_hodnot" => "%%1%% - Ukládání hodnot",

                  "admin_default_title" => "Konfigurace - výpis šablon",

                  "name_module" => array ("Administrace konfig",
                                          "Nastavení"),

/* - - - - - - - - - - Normal výpis - - - - - - - - - - */

                  "normal_config_group_1" => "
@@absolutni_url@@
@@adr1@@
                  ",

/* - - - - - - - - - - /Normal výpis - - - - - - - - - - */

                  "admin_obsah" => "
<div class=\"obal_pattern\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Konfigurace - výpis šablon</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat šablonu\" class=\"addsab tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat šablonu</span>
  </a>
  <div class=\"cl-b pos-rel\">
    %%2%%
  </div>
</div>\n",

                  "admin_addeditsab_add" => "Přidat šablonu",

                  "admin_addeditsab_edit" => "Upravit šablonu",

                  "admin_addeditsab" => "
<div class=\"obal_pattern\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%% %%3%%</h3>
  </div>
  <a href=\"%%5%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Adresa šablony:</span>
        <input type=\"text\" name=\"adresa\" value=\"%%2%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Název šablony:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%3%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-textarea w-500\">
        <span class=\"nazev-elementu\">Popis šablony:</span>
        <textarea name=\"popis\" rows=\"10\" cols=\"60\">%%4%%</textarea>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_addeditelem_add" => "Přidat element",

                  "admin_addeditelem_edit" => "Upravit element",

                  "admin_addeditelem" => "
<div class=\"obal_pattern\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%2%% - %%1%%</h3>
  </div>
  <a href=\"%%10%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-select f-obsah w-505\">
        <span class=\"nazev-elementu\">Šablona:</span>
%%3%%
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Adresa elementu:</span>
        <input type=\"text\" name=\"adresa\" value=\"%%4%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span> Vyplň jen v případě, jestliže je adresa implementována !</span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Název elementu:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%5%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
%%6%%
      <label class=\"f-textarea w-500\">
        <span class=\"nazev-elementu\">Výchozí obsah / hodnota:</span>
        <textarea class=\"hodnota\" name=\"value\" rows=\"10\" cols=\"60\">%%7%%</textarea>
      </label>
      <label class=\"f-textarea w-500\">
        <span class=\"nazev-elementu\">Popis elementu:</span>
        <textarea name=\"popis\" rows=\"10\" cols=\"60\">%%9%%</textarea>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"zamek\"%%8%% />
        <span class=\"nazev-elementu\">Skrýt element</span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_vyber_typu" => "
      <label class=\"f-select f-povinny w-505\">
        <span class=\"nazev-elementu\">Typ elementu:</span>
<select name=\"typ\" onchange=\"document.location.href='%%1%%&amp;typ='+this.value\">
%%2%%
</select>
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
%%5%%
        <img src=\"%%3%%/typ_%%4%%.png\" alt=\"\" class=\"block m-b-15\" />\n",

                  "admin_vyber_typu_row" => "  <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_vyber_sablony_begin" => "<select name=\"sablona\">\n",

                  "admin_vyber_sablony" => "  <option value=\"%%1%%\"%%2%%>%%3%% [%%4%%]</option>\n",

                  "admin_vyber_sablony_end" => "</select>",

                  "admin_vyber_sablony_null" => "<span class=\"block nadpis-2 w-505 f-s-17 p-t-10 p-b-10 t-a-c f-f-web-pro\">Šablona neexistuje !</span>",

                  "admin_vyber_typu_null" => "<span class=\"block nadpis-2 w-505 f-s-17 m-b-15 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vybrán žádný element</span>",

                  "admin_vyber_typu_empty" => "<span class=\"block nadpis-2 w-505 f-s-17 m-b-15 p-t-10 p-b-10 t-a-c f-f-web-pro\">Žádné nastavení</span>",

                  "admin_vyber_typu_number_default" => array("."),

                  "admin_vyber_typu_number" => "
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Oddělovač desetinné:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%1%%\" />
        <span class=\"popis-elementu\">V případě desetinných míst akceptuje tento oddělovač.</span>
      </label>\n",

                  "admin_vyber_typu_alphanumeric_default" => array ("alphanumeric",
                                                                    "",
                                                                    "",
                                                                    "false",
                                                                    "false"),

                  "admin_vyber_typu_alphanumeric" => "
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[function]\" value=\"alphanumeric\"%%1%% />
        <span class=\"nazev-elementu\">Alfanumerické znaky [0 - 9, a - z, A - Z]</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[function]\" value=\"alpha\"%%2%% />
        <span class=\"nazev-elementu\">Alfa znaky [a - z, A - Z]</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[function]\" value=\"numeric\"%%3%% />
        <span class=\"nazev-elementu\">Numerické znaky [0 - 9]</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Povolené znaky:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Zakázané znaky:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%5%%\" />
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[allcaps]\" value=\"true\"%%6%% />
        <span class=\"nazev-elementu\">Alfa znaky dovolí jen velké [A - Z]</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[allcaps]\" value=\"false\"%%7%% />
        <span class=\"nazev-elementu\">Neakceptuje předešlé nastavení</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[nocaps]\" value=\"true\"%%8%% />
        <span class=\"nazev-elementu\">Alfa znaky dovolí jen malé [a - z]</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[nocaps]\" value=\"false\"%%9%% />
        <span class=\"nazev-elementu\">Neakceptuje předešlé nastavení</span>
      </label>\n",

                  "admin_vyber_typu_fulltext_default" => array(100, 300),

                  "admin_vyber_typu_fulltext" => "
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Minimální výška v px:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%1%%\" />
        <span class=\"popis-elementu\">Rozsah od 30 do 710, Krok po 5.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximální výška v px:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
      </label>\n",

                  "admin_vyber_typu_slider_default" => array(0,
                                                              100,
                                                              10,
                                                              0,
                                                              " ms",
                                                              "false",
                                                              "0, 20, 40, 60, 80, 100",
                                                              "blue"),

                  "admin_vyber_typu_slider" => "
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Minimální rozsah:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%1%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximální rozsah:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Krok posuvníku po:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Počet desetinných míst:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Doplněk hodnoty:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%5%%\" />
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[limits]\" value=\"true\"%%6%% />
        <span class=\"nazev-elementu\">Zobrazit limit posuvníku</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[limits]\" value=\"false\"%%7%% />
        <span class=\"nazev-elementu\">Skrýt limit posuvníku</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Rozsah posuvníku:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%8%%\" />
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[skin]\" value=\"blue\"%%9%% />
        <span class=\"nazev-elementu\">Skin blue</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[skin]\" value=\"plastic\"%%10%% />
        <span class=\"nazev-elementu\">Skin plastic</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[skin]\" value=\"round\"%%11%% />
        <span class=\"nazev-elementu\">Skin round</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[skin]\" value=\"round_plastic\"%%12%% />
        <span class=\"nazev-elementu\">Skin round_plastic</span>
      </label>\n",

                  "admin_vyber_typu_checkbox_default" => array ("",
                                                                ""),

                  "admin_vyber_typu_checkbox" => "
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Value hodnota [on]:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%1%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Value hodnota [off]:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
      </label>\n",

                  "admin_checkgroup_sep" => "-;-",

                  "admin_vyber_typu_radio_default" => array(10, 3),

                  "admin_vyber_typu_radio" => "
<script type=\"text/javascript\">
  var poc = %%4%%;
  function PridejElement()
  {
    poc++;
    VykresliElement();
  }

  function OdeberElement()
  {
    poc--;
    VykresliElement();
  }

  function OznacitDefault(id)
  {
    $('.hodnota').val($('.radiohodnota'+id).val());
  }

  var pole_popis = ['|%%5%%|'];
  var pole_value = ['|%%6%%|'];
  function PosliData(row, polozka, hodnota)
  {
%%2%%

    switch (polozka)
    {
      case 0:
        pole_popis[row] = '|'+roz+'|';
        VykresliElement();
      break;

      case 1:
        pole_value[row] = '|'+roz+'|';
        VykresliElement();
      break;
    }
  }

  function VykresliElement()
  {
    $(function() {
      $.post(\"%%1%%/ajax_form.php\",
            \"action=listradio&typ=%%3%%&pocet=\"+poc+\"&popis=\"+pole_popis+\"&value=\"+pole_value,
              function(theResponse)
              {
                $('#polozky').html(theResponse);
              }
            );
      $('.pocetprvku').val(poc);
      $('#pocet_polozek').html(poc);
    });
  }
  window.setTimeout(\"VykresliElement();\", 10);
</script>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Zalomit po [X] položkách:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%7%%\" />
        <span class=\"popis-elementu\">V případě elementu \"Hodnoceni hvězdičkami [hodnoty]\" se zde nastavuje na kolik dílu rozdělit hvězdičku</span>
      </label>
      <p class=\"ow-h\">
        <span class=\"block f-f-web-pro m-b-6\">Počet položek: <strong id=\"pocet_polozek\" class=\"no-b u\"></strong></span>
        <a href=\"#\" onclick=\"PridejElement(); return false;\" title=\"Přidat položku\" class=\"block fl-l odkaz-1 m-b-4 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Přidat položku</a>
        <input type=\"hidden\" class=\"pocetprvku\" name=\"konfigurace[]\" />
      </p>
      <div id=\"polozky\" class=\"f-text w-500 pos-rel obal-odkazy-pridat-odebrat m-b-0-i\"></div>\n",

                  "ajax_listradio_del" => "<a href=\"#\" onclick=\"OdeberElement(); return false\" title=\"Odebrat položku\" class=\"odkaz-odebrat odkaz-1 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Odebrat položku</a>",

                  "ajax_listradio_radsel" => "<a href=\"#\" onclick=\"OznacitDefault(%%1%%); return false;\" title=\"Výchozí položka [%%2%%]\" class=\"block fl-l odkaz-1 p-t-2 p-r-3 p-b-2 p-l-3 no-u\">Výchozí položka [%%2%%]</a>",

                  "ajax_listradio" => "
%%6%%
      <label class=\"f-text w-500 m-b-5-i\">
        <span class=\"nazev-elementu\">Popis [%%2%%]:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" onchange=\"PosliData(%%1%%, 0, this.value);\" />
      </label>
      <label class=\"f-text w-500 m-b-20-i\">
        <span class=\"nazev-elementu\">Hodnota [%%2%%]:</span>
        <input type=\"text\" name=\"konfigurace[]\" class=\"radiohodnota%%1%%\" value=\"%%4%%\" onchange=\"PosliData(%%1%%, 1, this.value);\" />
        <span class=\"popis-elementu ow-h\">V případě elementu \"Skupina checkboxů\" je zápis hodnoty \"TRUE-;-FALSE\".</span>
        <span class=\"popis-elementu ow-h\">%%5%%<!-- --></span>
      </label>\n",

                  "admin_vyber_typu_stars_default" => array(1,
                                                            10,
                                                            1),

                  "admin_vyber_typu_stars" => "
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Minimum:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%1%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximum:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Na kolik dílů rozdělit hvězdičku:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" />
      </label>\n",

                  "set_typ_hodnot" => array("" => "--- Vyber element ---",
                                            "header" => "Nadpis oddílu",
                                            "specheader" => "Zvýrazněný popis",
                                            "number" => "Číslo",
                                            "alphanumeric" => "Alfanumericky nastavitelný text",
                                            "minitext" => "Libovolný krátký text",
                                            "fulltext" => "Libovolný dlouhý text",
                                            "wymeditor" => "WYM editor",
                                            "tinymce" => "TinyMCE editor",
                                            "color" => "Barva",
                                            "slider" => "Posuvník",
                                            "checkbox" => "Checkbox",
                                            "checkgroup" => "Skupina checkboxů",
                                            "radio" => "Radio buttony",
                                            "select" => "Select",
                                            "stars" => "Hodnoceni hvězdičkami [čísla]",
                                            "stars2" => "Hodnoceni hvězdičkami [hodnoty]",
                                            ),

                  "ajaxscript" => "
  function UlozitHodnotu(id, value, ret)
  {
%%3%%

    $.post(\"%%2%%/ajax_form.php\",
      \"action=savevalue&id=\"+id+\"&value=\"+roz,
        function(theResponse)
        {
          $(ret).html(theResponse);
        }
      );
      ZpracujHlasku(ret);
  }

  function ZpracujHlasku(ret)
  {
    $(ret).fadeIn('slow').delay(2000).fadeOut('slow');
  }",

                  "admin_vypis_obsah_begin" => "
<script type=\"text/javascript\" src=\"%%1%%/script/jquery.scrollTo-min.js\"></script>
<script type=\"text/javascript\">
  $(function(){
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
        var order = $(this).sortable(\"serialize\") + '&action=updateelement';
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

  function PosunNaPozici(id)
  {
    $.scrollTo('#scroll_sablony'+id, 1000, {easing: 'easeOutExpo'});
  }

  function ChangeActive(id, stav)
  {
    ZpracujHlasku('#status_drag');

    $.post(\"%%1%%/ajax_form.php\", \"action=changeactelem&id=\"+id+\"&stav=\"+stav,
            function(theResponse)
            {
              $('#status_drag').html(theResponse);
            }
          );
  }

  $(function(){
    $('#scrolltoobal').hover(
      function(){
        $(this).stop().animate({width: '200px'}, {duration: 600, easing: 'easeOutExpo'})
      },
      function(){
        $(this).stop().animate({width: '15px'}, {duration: 600, easing: 'easeOutExpo'})
      }
    );
  });
</script>
<div id=\"scrolltoobal\" class=\"nadpis-2\">
%%2%%
</div>\n",

                  "admin_vypis_scrollto" => "<a href=\"#\" onclick=\"PosunNaPozici(%%1%%); return false;\" title=\"Přesuň se na: %%2%%\" class=\"nadpis-6 odkaz-1 f-f-web-pro f-s-14 no-u\">%%2%%</a>\n",

                  "admin_vypis_scrollto_null" => "<p class=\"nadpis-6 cur-def f-f-web-pro f-s-14 no-u\">Žádné šablony</p>\n",

                  "admin_vypis_sablona" => "
<ul class=\"f-f-web-pro f-s-14 m-t-15\" id=\"scroll_sablony%%1%%\">
  <li class=\"nadpis-6 f-s-16 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%3%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%4%%\" title=\"Přidat element\" class=\"addelem block fl-l m-r-5 m-l-5 no-u odkaz-18\">Přidat element</a>
  <a href=\"%%5%%\" title=\"Duplikovat šablonu\" class=\"copysab block fl-l m-r-5 m-l-5 no-u odkaz-18\">Duplikovat šablonu</a><a href=\"%%6%%\" title=\"Upravit šablonu\" class=\"editsab block fl-l m-r-5 m-l-5 no-u odkaz-18\">Upravit šablonu</a><a href=\"%%7%%\" title=\"Opravdu chceš smazat šablonu: &quot;%%3%%&quot; ?\" class=\"confirm delsab block fl-l m-r-5 m-l-5 no-u odkaz-18\">Smazat šablonu</a><a href=\"#\" onclick=\"$.scrollTo('#zahlavi', 1000, {easing: 'easeOutExpo'}); return false;\" title=\"Nahoru\" class=\"block fl-l m-r-5 m-l-5 no-u odkaz-18\">Nahoru</a></span></li>
  <li class=\"polozka-4-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Adresa šablony:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
</ul>
<div class=\"obal_razeni\">
%%8%%
</div>\n",

                  "admin_vypis_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_element_zkraceni" => "50",

                  "admin_vypis_element_neupraveno" => "Element nebyl zatím upraven",

                  "admin_vypis_element" => "
<ul class=\"f-f-web-pro f-s-14 m-b-2\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 m-r-10 m-l-10 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%3%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%9%%\" title=\"Duplikovat element\" class=\"copyelem block fl-l m-r-5 m-l-5 no-u odkaz-4\">Duplikovat element</a><a href=\"%%10%%\" title=\"Upravit element\" class=\"editelem block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit element</a><a href=\"%%11%%\" title=\"Opravdu chceš smazat element: &quot;%%3%%&quot; ?\" class=\"confirm delelem block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat element</a></span></li>
  <li class=\"polozka-1-lichy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Adresa:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Typ:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
  <li class=\"polozka-1-lichy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Výchozí obsah / hodnota:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
  <li class=\"polozka-1-sudy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Skrytý element:</span><span class=\"fl-r\"><input type=\"checkbox\"%%6%% class=\"block m-t-2 cur-poi\" onclick=\"ChangeActive(%%1%%, this.checked);\" /></span></li>
  <li class=\"polozka-1-lichy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Element přidán:</span><span class=\"fl-r barva-5\">%%7%%</span></li>
  <li class=\"polozka-1-sudy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Element upraven:</span><span class=\"fl-r barva-5\">%%8%%</span></li>
</ul>\n",

                  "admin_vypis_element_null" => "<div class=\"nadpis-2 f-s-16 m-t-2 m-r-10 m-l-10 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vytvořen žádný element</div>",

                  "admin_vypis_sablona_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vytvořena žádná šablona</div>",

                  "admin_vypis_obsah_end" => "<div id=\"status_drag\"></div>\n",

                  "ajax_changeactelem_stav" => array("zobrazený", "skrytý"),

                  "ajax_changeactelem" => "Element \"%%1%%\" je nyní %%2%%.",

                  "ajax_changeactelem_not_permit" => "Nemáte oprávnění",

                  "ajax_updateelement" => "Bylo změněno pořadí elementů",

                  "ajax_updateelement_not_permit" => "Nemáte oprávnění",

                  "admin_vypis_razeni_menu_begin" => "
<script type=\"text/javascript\">
  $(function(){
    $('.vypis_sablon_zahlavi').css('cursor', 'move');
    $(function() {
      $(\"#obal_razeni\").sortable({
                          tolerance: 'pointer',
                          scroll: true,
                          scrollSensitivity: 40,
                          scrollSpeed: 30,
                          revert: 300,
                          opacity: 0.6,
                          cursor: 'move',
                          delay: 150,
                          update: function() {
        var order = $(this).sortable(\"serialize\") + '&action=updatesablona';
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
<div class=\"obal_pattern\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Řazení šablon</h3>
  </div>
</div>
<div id=\"obal_razeni\" class=\"cl-b\">\n",

                  "admin_vypis_razeni_menu" => "
<ul class=\"f-f-web-pro f-s-14 m-b-2\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h cur-move\"><span class=\"fl-l\">%%3%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">Pořadí: <span class=\"barva-14\">%%2%%</span> - ID: <span class=\"barva-14\">%%1%%</span></span></li>
</ul>\n",

                  "admin_vypis_razeni_menu_end" => "</div>\n<div id=\"status_drag\"></div>\n",

                  "admin_vypis_razeni_menu_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vytvořena žádná šablona</div>",

                  "ajax_updatesablona" => "Bylo změněno pořadí šablon",

                  "ajax_updatesablona_not_permit" => "Nemáte oprávnění",

                  "admin_obsah_sablona" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/number/jquery.numeric.pack.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/alphanumeric/jquery.alphanumeric.pack.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/fulltext/prettyComments.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/wymeditor/jquery.wymeditor.min.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/wymeditor/plugins/hovertools/jquery.wymeditor.hovertools.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/color/farbtastic.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/slider/jquery.dependClass.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/slider/jquery.slider-min.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/stars/jquery.MetaData.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/stars/jquery.rating.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/tiny_mce/jquery.tinymce.js\"></script>
<div class=\"obal_pattern\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%3%%</h3>
    <h4 class=\"pod-nadpis-sekce f-s-17 f-f-web-pro\">%%4%%<!-- --></h4>
  </div>
  <form method=\"post\" action=\"\" class=\"cl-b formular pos-rel\" onsubmit=\"return false;\">
    <fieldset>
%%5%%
    </fieldset>
  </form>
</div>\n",

                  "admin_obsah_element_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vytvořen žádný element</div>",

                  "admin_obsah_sablona_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Tato šablona neexistuje</div>",

                  "ajax_savevalue" => "Byla uložena hodnota: <span class=\"block u ow-h\">%%1%%</span>",

                  "ajax_savevalue_zkraceni" => "50",

                  "ajax_savevalue_not_permit" => "Nemáte oprávnění",

                  "admin_obsah_element_header" => "
<div class=\"nadpis-1 w-690 m-b-15 p-t-10 p-r-7 p-b-10 p-l-10 f-s-22 f-f-web-pro b ow-h\">
  <span class=\"block\">%%2%%</span>
  <span class=\"block fl-l barva-6 f-s-14 no-b m-t-2\">%%3%%<!-- --></span>
</div>\n",

                  "admin_obsah_element_specheader" => "
<div class=\"central_tip_specheader m-b-15\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>%%2%%</h3>
    <p>%%3%%<!-- --></p>
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>\n",

                  "admin_obsah_element_number" => "
<script type=\"text/javascript\">
  $(function() {
    $('.number%%1%%').numeric('%%2%%');
  });
</script>
<label class=\"f-text w-500\">
  <span class=\"nazev-elementu\">%%3%%:</span>
  <input type=\"text\" class=\"number%%1%%\" value=\"%%4%%\" onchange=\"UlozitHodnotu(%%1%%, this.value, '.navrat%%1%%');\" />
  <span class=\"popis-elementu\">%%5%%<!-- --></span>
  <span class=\"status_drag navrat%%1%%\"><!-- --></span>
</label>\n",

                  "admin_obsah_element_alphanumeric" => "
<script type=\"text/javascript\">
  $(function() {
    $('.alphanumeric%%1%%').%%2%%({
      allow: '%%3%%',
      ichars: '%%4%%',
      allcaps: %%5%%,
      nocaps: %%6%%
    });
  });
</script>
<label class=\"f-text w-500\">
  <span class=\"nazev-elementu\">%%7%%:</span>
  <input type=\"text\" class=\"alphanumeric%%1%%\" value=\"%%8%%\" onchange=\"UlozitHodnotu(%%1%%, this.value, '.navrat%%1%%');\" />
  <span class=\"popis-elementu\">%%9%%<!-- --></span>
  <span class=\"status_drag navrat%%1%%\"><!-- --></span>
</label>\n",

                  "admin_obsah_element_minitext" => "
<label class=\"f-text w-500\">
  <span class=\"nazev-elementu\">%%2%%:</span>
  <input type=\"text\" value=\"%%3%%\" onchange=\"UlozitHodnotu(%%1%%, this.value, '.navrat%%1%%');\" />
  <span class=\"popis-elementu\">%%4%%<!-- --></span>
  <span class=\"status_drag navrat%%1%%\"><!-- --></span>
</label>\n",

                  "admin_obsah_element_fulltext" => "
<script type=\"text/javascript\">
  $(function() {
    $('.fulltext%%1%%').prettyComments({
      maxHeight: %%3%%
    });
  });
</script>
<label class=\"f-textarea w-500\">
  <span class=\"nazev-elementu\">%%4%%:</span>
  <textarea class=\"fulltext%%1%% h-%%2%%\" onchange=\"UlozitHodnotu(%%1%%, this.value, '.navrat%%1%%');\" rows=\"20\" cols=\"60\">%%5%%</textarea>
  <span class=\"popis-elementu\">%%6%%<!-- --></span>
  <span class=\"status_drag navrat%%1%%\"><!-- --></span>
</label>",

                  "admin_obsah_element_wymeditor" => "
<script type=\"text/javascript\">
  $(document).ready(function(){
    $('.wymeditor%%1%%').wymeditor({
      skin: 'default',
      lang: 'cs',
      postInit: function(wym) {
        wym.hovertools();
      },
      dialogFeatures: \"menubar=no,titlebar=no,toolbar=no,resizable=no\"
                    + \",width=700,height=300,top=100,left=100\",
      dialogFeaturesPreview: \"menubar=no,titlebar=no,toolbar=no,resizable=no\"
                           + \",scrollbars=yes,width=700,height=400,top=100,left=100\",
      logoHtml:  \"\",
    });
    $(\".wym_status\").css({
      'height': '14px'
    });
    $(\".wym_skin_default .wym_iframe iframe\").css({
      'height': '600px'
    });
    $(\".wym_skin_default .wym_dropdown ul\").css({
      'display': 'block',
      'position': 'relative',
      'border-width': '0 0 1px 1px'
    });
    $(\".wym_skin_default .wym_section h2 span\").css({
      'display': 'none'
    });
    $(\".wym_skin_default .wym_dropdown ul\").css({
      'padding': '5px 5px 5px 3px'
    });
    $(\".wym_skin_default .wym_html textarea\").css({
      'height': '400px'
    });
    $(\".wym_classes\").css({
      'display': 'none'
    });
  });
</script>
<div class=\"f-wysiwyg m-b-3-i\">
  <span class=\"nazev-elementu\">%%2%%:</span>
  <textarea class=\"wymeditor%%1%%\" rows=\"20\" cols=\"60\">%%3%%</textarea>
  <span class=\"popis-elementu\">%%4%%<!-- --></span>
  <span class=\"status_drag navrat%%1%%\"><!-- --></span>
</div>
<label class=\"f-submit fl-r-i m-r-3-i m-b-15-i ow-h\">
  <span class=\"f-submit-pattern\"><!-- --></span>
  <input type=\"button\" class=\"wymupdate\" value=\"Uložit\" onclick=\"UlozitHodnotu(%%1%%, $('.wymeditor%%1%%').val(), '.navrat%%1%%');\" onmouseup=\"this.click();\" />
</label>\n",

                  "admin_obsah_element_tinymce" => "
<script type=\"text/javascript\">
  $(document).ready(function(){
    $('#tinymce%%1%%').tinymce({
      // Location of TinyMCE script
      script_url : '%%2%%/script/tiny_mce/tiny_mce.js',

      language : 'cs',

      // General options
      theme : \"advanced\",
      plugins : \"pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist,imagemanager\",

      // Theme options
      theme_advanced_buttons1 : \"newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect\",
      theme_advanced_buttons2 : \"cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor\",
      theme_advanced_buttons3 : \"tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen\",
      theme_advanced_buttons4 : \"insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak\",
      theme_advanced_toolbar_location : \"top\",
      theme_advanced_toolbar_align : \"left\",
      theme_advanced_statusbar_location : \"bottom\",
      theme_advanced_resizing : true,

      // Example content CSS (should be your site CSS)
      //content_css : \"css/content.css\",

      // Drop lists for link/image/media/template dialogs
      template_external_list_url : \"lists/template_list.js\",
      external_link_list_url : \"lists/link_list.js\",
      external_image_list_url : \"lists/image_list.js\",
      media_external_list_url : \"lists/media_list.js\",

      // Replace values for the template plugin
      template_replace_values : {
        username : \"Some User\",
        staffid : \"991234\"
      }
    });
  });
</script>
<div class=\"f-wysiwyg m-b-3-i\">
  <span class=\"nazev-elementu\">%%3%%:</span>
  <textarea id=\"tinymce%%1%%\" rows=\"20\" cols=\"60\">%%4%%</textarea>
  <span class=\"popis-elementu\">%%5%%<!-- --></span>
  <span class=\"status_drag navrat%%1%%\"><!-- --></span>
</div>
<label class=\"f-submit fl-r-i m-r-3-i m-b-15-i ow-h\">
  <span class=\"f-submit-pattern\"><!-- --></span>
  <input type=\"button\" value=\"Uložit\" onclick=\"UlozitHodnotu(%%1%%, $('#tinymce%%1%%').val(), '.navrat%%1%%');\" />
</label>\n",

                  "admin_obsah_element_color" => "
<script type=\"text/javascript\">
  $(function() {
    $('#picker%%1%%').farbtastic('#color%%1%%');
  });
</script>
<div class=\"w-700 cl-b\">
  <label class=\"f-text f-farbtastic w-195-i\">
    <span class=\"nazev-elementu\">%%2%%:</span>
    <span class=\"farbtastic\" id=\"picker%%1%%\" onmouseup=\"UlozitHodnotu(%%1%%, $('#color%%1%%').val(), '.navrat%%1%%');\"></span>
    <input type=\"text\" onchange=\"UlozitHodnotu(%%1%%, this.value, '.navrat%%1%%');\" id=\"color%%1%%\" value=\"%%3%%\" class=\"w-200-i\" />
    <span class=\"popis-elementu\">%%4%%<!-- --></span>
    <span class=\"status_drag navrat%%1%%\"><!-- --></span>
  </label>
</div>\n",

                  "admin_obsah_element_slider" => "
<script type=\"text/javascript\">
  $(function() {
    $('#jslider%%1%%').slider2({
      from: %%2%%,
      to: %%3%%,
      step: %%4%%,
      round: %%5%%,
      dimension: '%%6%%',
      limits: %%7%%,
      scale: [%%8%%],
      skin: '%%9%%'
    });
  });
</script>
<label class=\"f-text m-b-9-i\">
  <span class=\"nazev-elementu\">%%10%%:</span>
</label>
<div onmouseup=\"UlozitHodnotu(%%1%%, $('#jslider%%1%%').val(), '.navrat%%1%%');\" class=\"m-r-7 m-l-7\">
  <input type=\"text\" id=\"jslider%%1%%\" value=\"%%11%%\" />
</div>
<label class=\"f-text m-t-20-i\">
  <span class=\"popis-elementu cl-b\">%%12%%<!-- --></span>
<span class=\"status_drag navrat%%1%%\"><!-- --></span>
</label>\n",

                  "admin_obsah_element_checkbox" => "
<label class=\"f-checkbox w-500\">
  <input type=\"checkbox\" id=\"checkbox%%1%%\" value=\"%%6%%\"%%2%% onclick=\"UlozitHodnotu(%%1%%, (!this.checked ? '%%3%%' : '%%4%%'), '.navrat%%1%%');\" />
  <span class=\"nazev-elementu\">%%5%%</span>
  <span class=\"popis-elementu cl-b\">%%7%%<!-- --></span>
  <span class=\"status_drag navrat%%1%%\"><!-- --></span>
</label>\n",

                  "admin_obsah_element_checkgroup_zalomeni" => "
</div>
<div class=\"w-355 fl-r\">\n",

                  "admin_obsah_element_checkgroup_row" => "
<label class=\"f-checkbox w-355 m-b-3-i\">
  <input type=\"checkbox\" class=\"checkgroup%%2%%\" value=\"%%4%%\"%%5%% onclick=\"UlozitHodnotu(%%2%%, (!this.checked ? '%%1%%true' : '%%1%%false'), '.navrat%%2%%');\" />
  <span class=\"nazev-elementu\">%%3%%</span>
</label>
%%6%%\n",

                  "admin_obsah_element_checkgroup" => "
<div class=\"ow-h\">
  <label class=\"f-obsah w-710 m-b-3-i\">
    <span class=\"nazev-elementu m-b-5-i u\">%%3%%:</span>
  </label>
  <div class=\"w-355 fl-l\">
%%2%%
  </div>
  <label class=\"f-checkbox w-710\">
    <span class=\"popis-elementu cl-b\">%%4%%<!-- --></span>
    <span class=\"status_drag navrat%%1%%\"><!-- --></span>
  </label>
</div>\n",

                  "admin_obsah_element_radio_zalomeni" => "
</div>
<div class=\"w-355 fl-r\">\n",

                  "admin_obsah_element_radio_row" => "
<label class=\"f-radiobutton w-355 m-b-3-i\">
  <input type=\"radio\" name=\"radiobutton%%2%%\" value=\"%%4%%\"%%5%% onclick=\"UlozitHodnotu(%%2%%, this.value, '.navrat%%2%%');\" />
  <span class=\"nazev-elementu\">%%3%%</span>
</label>
%%6%%\n",

                  "admin_obsah_element_radio" => "
<div class=\"ow-h\">
  <label class=\"f-obsah w-710 m-b-3-i\">
    <span class=\"nazev-elementu m-b-5-i u\">%%3%%:</span>
  </label>
  <div class=\"w-355 fl-l\">
%%2%%
  </div>
  <label class=\"f-radiobutton w-710\">
    <span class=\"popis-elementu cl-b\">%%4%%<!-- --></span>
    <span class=\"status_drag navrat%%1%%\"><!-- --></span>
  </label>
</div>\n",

                  "admin_obsah_element_select_row" => "<option value=\"%%4%%\"%%5%%>%%3%%</option>\n",

                  "admin_obsah_element_select" => "
<label class=\"f-select w-505\">
  <span class=\"nazev-elementu\">%%3%%:</span>
  <select onchange=\"UlozitHodnotu(%%1%%, this.value, '.navrat%%1%%');\">
    %%2%%
  </select>
  <span class=\"popis-elementu\">%%4%%</span>
  <span class=\"status_drag navrat%%1%%\"><!-- --></span>
</label>\n",

                  "admin_obsah_element_stars_row" => "<input type=\"radio\" name=\"stars%%1%%\" title=\"%%2%%\" value=\"%%2%%\" class=\"star%%1%% {split:%%3%%}\"%%4%% />\n",

                  "admin_obsah_element_stars" => "
<script type=\"text/javascript\">
  $(function() {
    $('.star%%1%%').rating({
      callback: function(value, link){
        UlozitHodnotu(%%1%%, value, '.navrat%%1%%');
      }
    });
  });
</script>
<label class=\"f-radiobutton w-500 m-b-5-i\">
  <span class=\"nazev-elementu\">%%3%%:</span>
</label>
<div class=\"ow-h\">
%%2%%
</div>
<label class=\"f-radiobutton w-500 m-t-3-i\">
  <span class=\"popis-elementu cl-b\">%%4%%<!-- --></span>
  <span class=\"status_drag navrat%%1%%\"><!-- --></span>
</label>\n",

                  "admin_obsah_element_stars2_row" => "<input type=\"radio\" name=\"stars%%2%%\" title=\"%%3%%\" value=\"%%4%%\" class=\"star%%2%% {split:%%7%%}\"%%5%% />\n",

                  "admin_obsah_element_stars2" => "
<script type=\"text/javascript\">
  $(function() {
    $('.star%%1%%').rating({
      callback: function(value, link){
        UlozitHodnotu(%%1%%, value, '.navrat%%1%%');
      }
    });
  });
</script>
<label class=\"f-radiobutton w-500 m-b-5-i\">
  <span class=\"nazev-elementu\">%%3%%:</span>
</label>
<div class=\"ow-h\">
%%2%%
</div>
<label class=\"f-radiobutton w-500 m-t-3-i\">
  <span class=\"popis-elementu cl-b\">%%4%%<!-- --></span>
  <span class=\"status_drag navrat%%1%%\"><!-- --></span>
</label>\n",

                  );

  return $result;
?>
