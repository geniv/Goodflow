<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamic eshop (elementy)",
                                              "title" => "Dynamic eshop (elementy)",),

                                        array("main_href" => "%%1%%%%2%%",
                                              "odkaz" => "Nastavení eshopu",
                                              "title" => "Nastavení eshopu",),

                                        array("main_href" => "%%1%%%%3%%",
                                              "odkaz" => "Menu eshopu",
                                              "title" => "Menu eshopu",),

                                        array("main_href" => "%%1%%%%4%%",
                                              "odkaz" => "Obsah eshopu",
                                              "title" => "Obsah eshopu",),

                                        array("main_href" => "%%1%%%%9%%",
                                              "odkaz" => "Výrobci zboží",
                                              "title" => "Výrobci zboží",),

                                        array("main_href" => "%%1%%%%5%%",
                                              "odkaz" => "Košík eshopu",
                                              "title" => "Košík eshopu",),

                                        array("main_href" => "%%1%%%%6%%",
                                              "odkaz" => "Objednávky eshopu",
                                              "title" => "Objednávky eshopu",),

                                        array("main_href" => "%%1%%%%7%%",
                                              "odkaz" => "Statistiky eshopu",
                                              "title" => "Statistiky eshopu",),

                                        array("main_href" => "%%1%%%%8%%",
                                              "odkaz" => "Uživatelé eshopu",
                                              "title" => "Uživatelé eshopu",),
                                        ),

                  "admin_permit" => array("%%1%%" => array("" => "výpis", "addelemobsah" => "Add elem.", "editelemobsah" => "Edit elem.", "delelemobsah" => "Del elem."),
                                          "%%1%%%%2%%" => array("" => "výpis"),
                                          "%%1%%%%3%%" => array("" => "výpis", "addmenu" => "add menu", "editmenu" => "edit menu", "delmenu" => "del menu"),
                                          "%%1%%%%4%%" => array("" => "výpis", "addobsah" => "add obsah", "copyobsah" => "kopirovat obsah", "editobsah" => "edit obsah", "delobsah" => "del obsah"),
                                          //
                                          "%%1%%%%9%%" => array("" => "výpis", "addaut" => "add autorizace", "editaut" => "edit autorizace", "delaut" => "del autorizace"),
                                          ),

                  "name_module_admin" => "Administrace Eshopu",

                  "name_module_user" => "Eshop",


                  //administrace elementu
                  "admin_obsah" => "
<div class=\"galerie_bez_sekci\">
  <h3>Výpis elementů obsahů</h3>
  <p class=\"odkaz_pridat_skupinu\"><a href=\"%%1%%\" title=\"Přidat element obsahu\">Přidat element obsahu</a></p>
%%2%%
</div>
                  ",

                  "admin_addelemobsah" => "
<div class=\"pridat_upravit_element_dynamicke_zobrazeni\">
  <h3>Přidat element obsahu</h3>
  <p class=\"backlink_zobrazovani\"><a href=\"%%2%%\" title=\"Zpět na výpis elementu\">Zpět na výpis elementu</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
%%1%%
      <label class=\"input_text\">
        <span>Value:</span>
        <input type=\"text\" name=\"value\" class=\"hodnota\" />
        <span class=\"zobrazovani_dodatek\"></span>
      </label>
      <label class=\"input_text\">
        <span>Popis:</span>
        <input type=\"text\" name=\"popis\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Povinne:</span>
        <input type=\"checkbox\" name=\"povinne\" />
      </label>
      <label class=\"input_text\">
        <span>Vyhledavat podle tohoto pole:</span>
        <input type=\"checkbox\" name=\"vyhledavat\" />
      </label>
      <label class=\"input_text\">
        <span>Ovlivneni ceny:</span>
        <input type=\"text\" name=\"vlivcena\" value=\"0\" />
      </label>
      <label class=\"input_text\">
        <span>XML tag:</span>
        <input type=\"text\" name=\"xmltag\" value=\"\" />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat element\" />
      </label>
    </fieldset>
  </form>
</div>\n
                  ",

                  "admin_addelemobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl přidán element: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editelemobsah" => "
<div class=\"pridat_upravit_element_dynamicke_zobrazeni\">
  <h3>Upravit element obsahu</h3>
  <p class=\"backlink_zobrazovani\"><a href=\"%%8%%\" title=\"Zpět na výpis elementu\">Zpět na výpis elementu</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
%%1%%
      <label class=\"input_text\">
        <span>Value:</span>
        <input type=\"text\" name=\"value\" class=\"hodnota\" value=\"%%2%%\" />
        <span class=\"zobrazovani_dodatek\"></span>
      </label>
      <label class=\"input_text\">
        <span>Popis:</span>
        <input type=\"text\" name=\"popis\" value=\"%%3%%\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Povinne:</span>
        <input type=\"checkbox\" name=\"povinne\"%%4%% />
      </label>
      <label class=\"input_text\">
        <span>Vyhledavat podle tohoto pole:</span>
        <input type=\"checkbox\" name=\"vyhledavat\"%%5%% />
      </label>
      <label class=\"input_text\">
        <span>Ovlivneni ceny:</span>
        <input type=\"text\" name=\"vlivcena\" value=\"%%6%%\" />
      </label>
      <label class=\"input_text\">
        <span>XML tag:</span>
        <input type=\"text\" name=\"xmltag\" value=\"%%7%%\" />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit element\" />
      </label>
    </fieldset>
  </form>
</div>\n
                  ",

                  "admin_editelemobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl upraven element: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delelemobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl smazan element: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",




                  "admin_vypis_obsah_element_begin" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\" src=\"%%2%%\"></script>
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
                          update: function() {
        var order = $(this).sortable(\"serialize\") + '&action=updateelement';
        $.post(\"%%3%%/ajax_form.php\", order, function(theResponse){
          $(\"#status_drag\").html(theResponse);
          setTimeout(\"SchovejHlasku()\", 2000);
        });
        ZobrazHlasku();
      }
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

  function PosunNaPozici(id)
  {
    $.scrollTo('#scroll_sablony'+id, 1000, {easing: \"easeOutExpo\"});
  }

  $(function(){
    $('#scrolltoobal').hover(
      function(){
        $(this).stop().animate({width: '200px'}, {duration: 600, easing: 'easeOutExpo'})
      },
      function(){
        $(this).stop().animate({width: '10px'}, {duration: 600, easing: 'easeOutExpo'})
      }
    );
  });
</script>
<div class=\"obal_razeni\">
                  ",

                  "admin_vypis_obsah_element" => "
<ul class=\"vypis_sablon_polozka\" id=\"arrayelements_%%1%%\">
  <li title=\"[Pořadí: %%8%%] - [ID: %%1%%]\">[%%8%%] - [%%1%%] - <strong>%%4%%</strong></li>
  <li>Typ elementu: <strong>%%2%%</strong></li>
  <li>Výchozí value: <strong>%%3%%<!-- --></strong></li>
  <li>Indexy v unikátních od: <strong>%%9%%</strong> do: <strong>%%10%%</strong></li>
  <li class=\"povinna_polozka_checkbox\"><em>Povinná položka:</em><input type=\"checkbox\" disabled=\"disabled\"%%5%% />, vyhledavatelne: <input type=\"checkbox\" disabled=\"disabled\"%%6%% />, vliv na cenu: %%7%%</li>
  <li class=\"odkazy_element\">
    <a href=\"%%11%%\" title=\"Upravit element\">Upravit</a> - <a href=\"%%12%%\" title=\"Smazat element\" onclick=\"return confirm('Opravdu chceš smazat element: &quot;%%4%%&quot; ?');\">Smazat</a>
  </li>
</ul>\n",

                  "admin_vypis_obsah_element_null" => "<strong class=\"zadna_polozka\">Není vytvořen žádný element</strong>",

                  "admin_vypis_obsah_element_end" => "
</div><div id=\"status_drag\"></div>
                  ",

                  "ajax_update_elements" => "Byl proveden přesun mezi položkami.",



                  //typy elementu obsahu
                  "set_typ_elementu" => array("checkbox" => "Checkbox",
                                              "checkbox_user" => "uživatelský checkbox",
                                              "checkgroup" => "Skupina checkboxů",
                                              "checkgroup_user" => "uživatelská Skupina checkboxů",
                                              "radio" => "Radio buttony",
                                              "radio_user" => "uživatelský radio buttony",
                                              "colorradio" => "Radio buttony s barvičkama",
                                              "colorradio_user" => "uživatelský radio buttony s barvičkama",
                                              "select" => "Select",
                                              "select_user" => "uživatelský select",
                                              "minitext" => "Krátký text",
                                              "minitext_user" => "uživatelský krátký text",
                                              "fulltext" => "Dlouhý text",
                                              "fulltext_user" => "uživatelský dlouhý text",
                                              "wymeditor" => "WYM editor",
                                              "hiddentext" => "Skrytý text",
                                              "hiddentext_user" => "uživatelský skrytý text",
                                              "conectmodule" => "Připojení modulu",
                                              "conectmodule_user" => "uživatelský připojení modulu",
                                              "download_user" => "uživatelské stahování dokumentů",
                                              "pdf_user" => "uživatelský tisk produktu",
                                              "reviews_user" => "uživatelské hodnoceni",
                                              "url_user" => "uživatelský url odkaz",
                                              "datum" => "Datum",
                                              "datum_user" => "uživatelský datum",
                                              "cas" => "Čas",
                                              "cas_user" => "uživatelský čas",
                                              "datumcas" => "Datum a čas",
                                              "datumcas_user" => "uživatelský datum a čas",
                                              "foto" => "Fotka (jen jedna)",
                                              "seriefoto" => "Serie fotek (serie)",
                                              ),

                  "admin_vyber_typu_begin" => "      <label class=\"input_select\">
        <span>Typ elementu:</span>
        <select name=\"typ\" onchange=\"document.location.href='%%1%%&amp;typ='+this.value\">\n          <option value=\"\">--- Vyber element ---</option>\n",

                  "admin_vyber_typu" => "          <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_vyber_typu_end" => "        </select>
      </label>",

                  "admin_vyber_typu_null" => "
      <label class=\"input_text\">
        <span>Konfigurace:</span>
        <em>Není vybrán žádný element</em>
      </label>",


                  //checkbox admin
                  "admin_vyber_typu_checkbox_default" => "%%1%%",

                  "admin_vyber_typu_checkbox" => "
      <label class=\"input_text\">
        <span>True hodnota:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%1%%\" />
      </label>
      <label class=\"input_text\">
        <span>False hodnota:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
      </label>
      ",

                  //checkbox user
                  "admin_vyber_typu_checkbox_user_default" => "%%1%%%%1%%",

                  "admin_vyber_typu_checkbox_user" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <label class=\"input_text\">
        <span>True hodnota:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
      </label>
      <label class=\"input_text\">
        <span>False hodnota:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" />
      </label>
      <label class=\"input_text\">
        <span>Uživatelsky viditelné:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\"%%4%% onclick=\"$('#hide_conf').attr('disabled', this.checked);\" />
      </label>
        <input type=\"hidden\" id=\"hide_conf\" name=\"konfigurace[]\"%%5%% />
      ",

                  //checkgroup admin
                  "admin_vyber_typu_checkgroup" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <script type=\"text/javascript\">
        var poc = %%5%%;
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

        var pole_naz = ['|%%6%%|'];
        var pole_val = ['|%%7%%|'];
        function PosliData(row, polozka, hodnota)
        {
      %%3%%

          switch (polozka)
          {
            case 0:
              pole_naz[row] = '|'+roz+'|';
              VykresliElement();
            break;

            case 1:
              pole_val[row] = '|'+roz+'|';
              VykresliElement();
            break;
          }
        }

        function VykresliElement()
        {
          $(function() {
            $.post(\"%%2%%/ajax_form.php\",
                  \"action=listcheckgroup&pocet=\"+poc+\"&naz=\"+pole_naz+\"&val=\"+pole_val,
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
      <div class=\"radio_select\">
        <p>
          <em>Počet položek: <strong id=\"pocet_polozek\"></strong></em>
        </p>
        <a href=\"#\" onclick=\"PridejElement(); return false;\" title=\"Přidat položku\" class=\"odkaz_pridat_polozku\">Přidat položku</a>
        <input type=\"hidden\" class=\"pocetprvku\" name=\"konfigurace[]\" />
        <div id=\"polozky\"><!-- --></div>
      </div>\n",

                  "ajax_listcheckgroup" => "
      <label class=\"input_text\">
        <span>Název [%%2%%]:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" onchange=\"PosliData(%%1%%, 0, this.value);\" />
      </label>
      <label class=\"input_text\">
        <span>Hodnota [%%2%%]:</span>
        <input type=\"text\" name=\"konfigurace[]\" class=\"radiohodnota%%1%%\" value=\"%%4%%\" onchange=\"PosliData(%%1%%, 1, this.value);\" />
        %%7%%
      </label>
      ",

                  "ajax_listcheckgroup_del" => "<a href=\"#\" onclick=\"OdeberElement(); return false\" title=\"Odebrat položku\" class=\"odkaz_odebrat_polozku\">Odebrat položku</a>",


                  //checkgroup user
                  "admin_vyber_typu_checkgroup_user" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <script type=\"text/javascript\">
        var poc = %%5%%;
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

        var pole_naz = ['|%%6%%|'];
        var pole_val = ['|%%7%%|'];
        var pole_sho = ['%%8%%'];
        function PosliData(row, polozka, hodnota)
        {
          switch (polozka)
          {
            case 0:
%%3%%
              pole_naz[row] = '|'+roz+'|';
              VykresliElement();
            break;

            case 1:
%%3%%
              pole_val[row] = '|'+roz+'|';
              VykresliElement();
            break;

            case 2:
              pole_sho[row] = (hodnota ? 1 : 0);
              VykresliElement();
            break;
          }
        }

        function VykresliElement()
        {
          $(function() {
            $.post(\"%%2%%/ajax_form.php\",
                  \"action=listcheckgroup_user&pocet=\"+poc+\"&naz=\"+pole_naz+\"&val=\"+pole_val+\"&sho=\"+pole_sho,
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
      <div class=\"radio_select\">
        <p>
          <em>Počet položek: <strong id=\"pocet_polozek\"></strong></em>
        </p>
        <a href=\"#\" onclick=\"PridejElement(); return false;\" title=\"Přidat položku\" class=\"odkaz_pridat_polozku\">Přidat položku</a>
        <input type=\"hidden\" class=\"pocetprvku\" name=\"konfigurace[]\" />
        <div id=\"polozky\"><!-- --></div>
      </div>\n",

                  "ajax_listcheckgroup_user" => "
      <label class=\"input_text\">
        <span>Název [%%2%%]:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" onchange=\"PosliData(%%1%%, 0, this.value);\" />
      </label>
      <label class=\"input_text\">
        <span>Hodnota [%%2%%]:</span>
        <input type=\"text\" name=\"konfigurace[]\" class=\"radiohodnota%%1%%\" value=\"%%4%%\" onchange=\"PosliData(%%1%%, 1, this.value);\" />
        %%7%%
      </label>
      <label class=\"input_checkbox\">
        <span>Uživatelsky viditelné:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\"%%5%% onclick=\"$('#hide_conf%%2%%').attr('disabled', this.checked); PosliData(%%1%%, 2, this.checked);\" />
      </label>
        <input type=\"hidden\" id=\"hide_conf%%2%%\" name=\"konfigurace[]\"%%6%% />
      ",

                  "ajax_listcheckgroup_user_del" => "<a href=\"#\" onclick=\"OdeberElement(); return false\" title=\"Odebrat položku\" class=\"odkaz_odebrat_polozku\">Odebrat položku</a>",



                  //radio, color, select admin
                  "admin_vyber_typu_radio_color_select" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <script type=\"text/javascript\" src=\"%%2%%/script/farbtastic/farbtastic.js\"></script>
      <script type=\"text/javascript\">
        var poc = %%5%%;
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

        var pole_nazev = ['|%%6%%|'];
        var pole_hodnota = ['|%%7%%|'];
        function PosliData(row, polozka, hodnota)
        {
      %%3%%

          switch (polozka)
          {
            case 0:
              pole_nazev[row] = '|'+roz+'|';
              VykresliElement();
            break;

            case 1:
              pole_hodnota[row] = '|'+roz+'|';
              VykresliElement();
            break;
          }
        }

        function VykresliElement()
        {
          $(function() {
            $.post(\"%%2%%/ajax_form.php\",
                  \"action=listradcolsel&typ=%%4%%&pocet=\"+poc+\"&nazev=\"+pole_nazev+\"&hodnota=\"+pole_hodnota,
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
      <div class=\"radio_select\">
        <p>
          <em>Počet položek: <strong id=\"pocet_polozek\"></strong></em>
        </p>
        <a href=\"#\" onclick=\"PridejElement(); return false;\" title=\"Přidat položku\" class=\"odkaz_pridat_polozku\">Přidat položku</a>
        <input type=\"hidden\" class=\"pocetprvku\" name=\"konfigurace[]\" />
        <div id=\"polozky\"><!-- --></div>
      </div>\n",

                  "ajax_listradcolsel" => "
       <script type=\"text/javascript\">
        $(document).ready(function() {
          $('#picker%%1%%').farbtastic('.radiohodnota%%1%%');
        });
      </script>
      <label class=\"input_text\">
        <span>Popis [%%2%%]:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" onchange=\"PosliData(%%1%%, 0, this.value);\" />
      </label>
      <label class=\"input_text\">
        <span>Value [%%2%%]:</span>
        <input type=\"text\" name=\"konfigurace[]\" class=\"radiohodnota%%1%%\" value=\"%%4%%\" onchange=\"PosliData(%%1%%, 1, this.value);\" />
        %%8%%
        <span class=\"central_dodatek\"><a href=\"#\" onclick=\"OznacitDefault(%%1%%); return false;\" title=\"Výchozí - [%%2%%]\">Výchozí - [%%2%%]</a></span>
        %%7%%
      </label>",


                  "ajax_listradcolsel_picker" => "<span class=\"barvapicker\" id=\"picker%%1%%\" onmouseup=\"PosliData(%%1%%, 1, $('.radiohodnota%%1%%').val());\"></span>",

                  "ajax_listradcolsel_del" => "<a href=\"#\" onclick=\"OdeberElement(); return false\" title=\"Odebrat položku\" class=\"odkaz_odebrat_polozku\">Odebrat položku</a>",

                  "ajax_listradcolsel_defcolor" => "#123456",


                  //radio, color, select user
                  "admin_vyber_typu_radio_color_select_user" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <script type=\"text/javascript\" src=\"%%2%%/script/farbtastic/farbtastic.js\"></script>
      <script type=\"text/javascript\">
        var poc = %%5%%;
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

        var pole_nazev = ['|%%6%%|'];
        var pole_hodnota = ['|%%7%%|'];
        var pole_show = ['%%8%%'];
        function PosliData(row, polozka, hodnota)
        {
          switch (polozka)
          {
            case 0:
%%3%%
              pole_nazev[row] = '|'+roz+'|';
              VykresliElement();
            break;

            case 1:
%%3%%
              pole_hodnota[row] = '|'+roz+'|';
              VykresliElement();
            break;

            case 2:
              pole_show[row] = (hodnota ? 1 : 0);
              VykresliElement();
            break;
          }
        }

        function VykresliElement()
        {
          $(function() {
            $.post(\"%%2%%/ajax_form.php\",
                  \"action=listradcolsel_user&typ=%%4%%&pocet=\"+poc+\"&nazev=\"+pole_nazev+\"&hodnota=\"+pole_hodnota+\"&show=\"+pole_show,
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
      <div class=\"radio_select\">
        <p>
          <em>Počet položek: <strong id=\"pocet_polozek\"></strong></em>
        </p>
        <a href=\"#\" onclick=\"PridejElement(); return false;\" title=\"Přidat položku\" class=\"odkaz_pridat_polozku\">Přidat položku</a>
        <input type=\"hidden\" class=\"pocetprvku\" name=\"konfigurace[]\" />
        <div id=\"polozky\"><!-- --></div>
      </div>\n",

                  "ajax_listradcolsel_user" => "
       <script type=\"text/javascript\">
        $(document).ready(function() {
          $('#picker%%1%%').farbtastic('.radiohodnota%%1%%');
        });
      </script>
      <label class=\"input_text\">
        <span>Popis [%%2%%]:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" onchange=\"PosliData(%%1%%, 0, this.value);\" />
      </label>
      <label class=\"input_text\">
        <span>Value [%%2%%]:</span>
        <input type=\"text\" name=\"konfigurace[]\" class=\"radiohodnota%%1%%\" value=\"%%4%%\" onchange=\"PosliData(%%1%%, 1, this.value);\" />
        %%8%%
        <span class=\"central_dodatek\"><a href=\"#\" onclick=\"OznacitDefault(%%1%%); return false;\" title=\"Výchozí - [%%2%%]\">Výchozí - [%%2%%]</a></span>
        %%7%%
      </label>
      <label class=\"input_checkbox\">
        <span>Uživatelsky viditelné:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\"%%5%% onclick=\"$('#hide_conf%%2%%').attr('disabled', this.checked); PosliData(%%1%%, 2, this.checked);\" />
      </label>
        <input type=\"hidden\" id=\"hide_conf%%2%%\" name=\"konfigurace[]\"%%6%% />
        ",


                  "ajax_listradcolsel_user_picker" => "<span class=\"barvapicker\" id=\"picker%%1%%\" onmouseup=\"PosliData(%%1%%, 1, $('.radiohodnota%%1%%').val());\"></span>",

                  "ajax_listradcolsel_user_del" => "<a href=\"#\" onclick=\"OdeberElement(); return false\" title=\"Odebrat položku\" class=\"odkaz_odebrat_polozku\">Odebrat položku</a>",

                  "ajax_listradcolsel_user_defcolor" => "#123456",




                  "admin_vyber_typu_not" => "",

                  "admin_vyber_typu_conectmodule" => "
      <label class=\"input_select\">
        <span>Funkce modulu:</span>
%%1%%
      </label>
      <label class=\"input_text\">
        <span>Parametry funkce:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
        <span class=\"central_dodatek\">Parametry nastavuj dle funkce modulu, oddělovač: \"|\", volana metoda: @@1@@, id obsahu: @@2@@</span>
      </label>",


                  "admin_vyber_typu_conectmodule_user" => "
      <label class=\"input_select\">
        <span>Funkce modulu:</span>
%%1%%
      </label>
      <label class=\"input_text\">
        <span>Parametry funkce:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
        <span class=\"central_dodatek\">Parametry nastavuj dle funkce modulu, oddělovač: \"|\", volana metoda: @@1@@, id obsahu: @@2@@</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Uživatelsky viditelné:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\"%%3%% onclick=\"$('#hide_conf').attr('disabled', this.checked);\" />
      </label>
        <input type=\"hidden\" id=\"hide_conf\" name=\"konfigurace[]\"%%4%% />
        ",


                  "admin_seznam_trid_begin" => "<select name=\"konfigurace[]\">\n    <option value=\"\" class=\"option_center\">--- Vyber funkci modulu ---</option>\n",

                  "admin_seznam_trid_skupina_begin" => "  <optgroup label=\"%%1%%\">\n",

                  "admin_seznam_trid" => "    <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_seznam_trid_skupina_end" => "  </optgroup>\n\n",

                  "admin_seznam_trid_end" => "</select>\n",



                  "admin_vyber_typu_pdf_user_default" => "zbozi_@@1@@%%1%%css_mpdf%%1%%Zboží: @@1@@%%1%%GF design & mpdf%%1%%Předmět%%1%%Generator mpdf%%1%%Klíčové slova%%1%%1",

                  "admin_vyber_typu_pdf_user" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <label class=\"input_text\">
        <span>Název pdf:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
        <span class=\"central_dodatek\">nazev zbozi se nahrazuje za: @@1@@</span>
      </label>
      <label class=\"input_text\">
        <span>Cesta k css souboru:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" />
      </label>
      <label class=\"input_text\">
        <span>Titulek pdf:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" />
        <span class=\"central_dodatek\">nazev zbozi se nahrazuje za: @@1@@</span>
      </label>
      <label class=\"input_text\">
        <span>Autor:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%5%%\" />
      </label>
      <label class=\"input_text\">
        <span>Předmět:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%6%%\" />
      </label>
      <label class=\"input_text\">
        <span>Generátor (creator):</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%7%%\" />
      </label>
      <label class=\"input_text\">
        <span>Klíčové slova (keywords):</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%8%%\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Ptat se při ukládání:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\"%%9%% onclick=\"$('#hide_conf').attr('disabled', this.checked);\" />
      </label>
        <input type=\"hidden\" name=\"konfigurace[]\"%%10%% id=\"hide_conf\" />
      <label class=\"input_checkbox\">
        <span>Uživatelsky viditelné:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\"%%11%% onclick=\"$('#hide_conf1').attr('disabled', this.checked);\" />
      </label>
        <input type=\"hidden\" id=\"hide_conf1\" name=\"konfigurace[]\"%%12%% />
                  ",


                  "admin_vyber_typu_reviews_user_default" => "1%%1%%10%%1%%1%%1%%0",

                  "admin_vyber_typu_reviews_user" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <label class=\"input_text\">
        <span>Min hodnota:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
      </label>
      <label class=\"input_text\">
        <span>Max hodnota:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" />
      </label>
      <label class=\"input_text\">
        <span>Split hodnota:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Uživatelsky viditelné:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\"%%5%% onclick=\"$('#hide_conf').attr('disabled', this.checked);\" />
      </label>
        <input type=\"hidden\" id=\"hide_conf\" name=\"konfigurace[]\"%%6%% />
                  ",

                  "admin_vyber_typu_url_user_default" => "http://%%1%%0%%1%%0",

                  "admin_vyber_typu_url_user" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <label class=\"input_text\">
        <span>Href odkaz:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Do noveho okna:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\"%%3%% onclick=\"$('#hide_conf').attr('disabled', this.checked);\" />
      </label>
        <input type=\"hidden\" id=\"hide_conf\" name=\"konfigurace[]\"%%4%% />
      <label class=\"input_checkbox\">
        <span>Uživatelsky viditelné:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\"%%5%% onclick=\"$('#hide_conf1').attr('disabled', this.checked);\" />
      </label>
        <input type=\"hidden\" id=\"hide_conf1\" name=\"konfigurace[]\"%%6%% />
                  ",



                  //admin texty
                  "admin_vyber_typu_texty_default" => "0%%1%%...",

                  "admin_vyber_typu_texty" => "
      <label class=\"input_text\">
        <span>Zkracování textu po:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%1%%\" />
        <span class=\"central_dodatek\">0 = nezkracuje text</span>
      </label>
      <label class=\"input_text\">
        <span>Zakončení zkráceného textu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
      </label>\n",

                  //texty user
                  "admin_vyber_typu_texty_user_default" => "0%%1%%...%%1%%",

                  "admin_vyber_typu_texty_user" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <label class=\"input_text\">
        <span>Zkracování textu po:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
        <span class=\"central_dodatek\">0 = nezkracuje text</span>
      </label>
      <label class=\"input_text\">
        <span>Zakončení zkráceného textu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Uživatelsky viditelné:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\"%%4%% onclick=\"$('#hide_conf').attr('disabled', this.checked);\" />
      </label>
        <input type=\"hidden\" id=\"hide_conf\" name=\"konfigurace[]\"%%5%% />
        \n",

                  "admin_vyber_typu_hiddentext_user_default" => "",

                  "admin_vyber_typu_hiddentext_user" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <label class=\"input_checkbox\">
        <span>Uživatelsky viditelné:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\"%%2%% onclick=\"$('#hide_conf').attr('disabled', this.checked);\" />
      </label>
        <input type=\"hidden\" id=\"hide_conf\" name=\"konfigurace[]\"%%3%% />
                  ",



                  "admin_vyber_typu_datum_datumcas_default" => "d.m.Y H:i:s%%1%%Pondělí,Úterý,Středa,Čtvrtek,Pátek,Sobota,Neděle%%1%%Leden,Únor,Březen,Duben,Květen,Červen,Červenec,Srpen,Září,Říjen,Listopad,Prosinec%%1%%@datum@, @den@, @mesic@, @svatek@",

                  "admin_vyber_typu_datum_datumcas" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <script type=\"text/javascript\" src=\"%%2%%/script/ajax.js\"></script>
      <label class=\"input_text\">
        <span>Formát datumu a času:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" id=\"formdate\" />
        <span class=\"central_dodatek\">Formát datumu a času je podle PHP.</span>
      </label>
      <label class=\"input_text\">
        <span>Dny v týdnu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" id=\"daydate\" />
        <span class=\"central_dodatek\">Názvy dní jsou odděleny čárkou.</span>
      </label>
      <label class=\"input_text\">
        <span>Měsíce v roce:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%5%%\" id=\"monthdate\" />
        <span class=\"central_dodatek\">Názvy měsíců jsou odděleny čárkou.</span>
      </label>
      <label class=\"input_text\">
        <span>Výstupní tvar:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%6%%\" id=\"fintvar\" />
        <span class=\"central_dodatek\">Datum: @datum@, Dny: @den@, Měsíce: @mesic@, Svátek: @svatek@.</span>
      </label>
      <label class=\"input_text\">
        <span>Náhled výstupního tvaru:</span>
        <em id=\"nahled_datum\"><!-- --></em>
        <span class=\"central_dodatek\"><a href=\"#\" onclick=\"NahledData($('.hodnota').val(), $('#formdate').val(), $('#daydate').val(), $('#monthdate').val(), $('#fintvar').val(), '#nahled_datum'); return false;\" title=\"Náhled\">Náhled</a> - <a href=\"#\" onclick=\"$('.hodnota').val('now'); return false;\" title=\"Dnešní datum\">Dnešní datum</a></span>
      </label>",



                  "admin_vyber_typu_datum_datumcas_user_default" => "d.m.Y H:i:s%%1%%Pondělí,Úterý,Středa,Čtvrtek,Pátek,Sobota,Neděle%%1%%Leden,Únor,Březen,Duben,Květen,Červen,Červenec,Srpen,Září,Říjen,Listopad,Prosinec%%1%%@datum@, @den@, @mesic@, @svatek@%%1%%",

                  "admin_vyber_typu_datum_datumcas_user" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <script type=\"text/javascript\" src=\"%%2%%/script/ajax.js\"></script>
      <label class=\"input_text\">
        <span>Formát datumu a času:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" id=\"formdate\" />
        <span class=\"central_dodatek\">Formát datumu a času je podle PHP.</span>
      </label>
      <label class=\"input_text\">
        <span>Dny v týdnu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" id=\"daydate\" />
        <span class=\"central_dodatek\">Názvy dní jsou odděleny čárkou.</span>
      </label>
      <label class=\"input_text\">
        <span>Měsíce v roce:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%5%%\" id=\"monthdate\" />
        <span class=\"central_dodatek\">Názvy měsíců jsou odděleny čárkou.</span>
      </label>
      <label class=\"input_text\">
        <span>Výstupní tvar:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%6%%\" id=\"fintvar\" />
        <span class=\"central_dodatek\">Datum: @datum@, Dny: @den@, Měsíce: @mesic@, Svátek: @svatek@.</span>
      </label>
      <label class=\"input_text\">
        <span>Náhled výstupního tvaru:</span>
        <em id=\"nahled_datum\"><!-- --></em>
        <span class=\"central_dodatek\"><a href=\"#\" onclick=\"NahledData($('.hodnota').val(), $('#formdate').val(), $('#daydate').val(), $('#monthdate').val(), $('#fintvar').val(), '#nahled_datum'); return false;\" title=\"Náhled\">Náhled</a> - <a href=\"#\" onclick=\"$('.hodnota').val('now'); return false;\" title=\"Dnešní datum\">Dnešní datum</a></span>
      </label>
      <label class=\"input_checkbox\">
        <span>Uživatelsky viditelné:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\"%%7%% onclick=\"$('#hide_conf').attr('disabled', this.checked);\" />
      </label>
        <input type=\"hidden\" id=\"hide_conf\" name=\"konfigurace[]\"%%8%% />",




                  "admin_vyber_typu_cas_default" => "H:i:s",

                  "admin_vyber_typu_cas" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <script type=\"text/javascript\" src=\"%%2%%/script/ajax.js\"></script>
      <label class=\"input_text\">
        <span>Formát času:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" id=\"formtime\" />
        <span class=\"central_dodatek\">Formát času je podle PHP.</span>
      </label>
      <label class=\"input_text\">
        <span>Náhled výstupního tvaru:</span>
        <em id=\"nahled_cas\"><!-- --></em>
        <span class=\"central_dodatek\"><a href=\"#\" onclick=\"NahledCasu($('.hodnota').val(), $('#formtime').val(), '#nahled_cas'); return false;\" title=\"Náhled\">Náhled</a> - <a href=\"#\" onclick=\"$('.hodnota').val('now'); return false;\" title=\"Aktuální čas\">Aktuální čas</a></span>
      </label>",


                  "admin_vyber_typu_cas_user_default" => "H:i:s%%1%%",

                  "admin_vyber_typu_cas_user" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <script type=\"text/javascript\" src=\"%%2%%/script/ajax.js\"></script>
      <label class=\"input_text\">
        <span>Formát času:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" id=\"formtime\" />
        <span class=\"central_dodatek\">Formát času je podle PHP.</span>
      </label>
      <label class=\"input_text\">
        <span>Náhled výstupního tvaru:</span>
        <em id=\"nahled_cas\"><!-- --></em>
        <span class=\"central_dodatek\"><a href=\"#\" onclick=\"NahledCasu($('.hodnota').val(), $('#formtime').val(), '#nahled_cas'); return false;\" title=\"Náhled\">Náhled</a> - <a href=\"#\" onclick=\"$('.hodnota').val('now'); return false;\" title=\"Aktuální čas\">Aktuální čas</a></span>
      </label>
      <label class=\"input_checkbox\">
        <span>Uživatelsky viditelné:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\"%%4%% onclick=\"$('#hide_conf').attr('disabled', this.checked);\" />
      </label>
        <input type=\"hidden\" id=\"hide_conf\" name=\"konfigurace[]\"%%5%% />",



                  //fotka
                  "admin_vyber_typu_foto_default" => "200x0%%1%%800x0%%1%%1",

                  "admin_vyber_typu_foto" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <script type=\"text/javascript\" src=\"%%2%%/script/ajax.js\"></script>
      <script type=\"text/javascript\">
        TypeUpload('%%3%%', '', '<strong>Bude požadovat vlastní miniaturu</strong>', '#mini');
        TypeUpload('%%4%%', 'own', '', '#full');
      </script>
      <label class=\"input_text\">
        <span>Nastavení miniatury:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" onkeyup=\"TypeUpload(this.value, '', '<strong>Bude požadovat vlastní miniaturu</strong>', '#mini');\" />
        <span class=\"central_dodatek\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost, own = bude požadovat vlastní miniaturu.<br /><em id=\"mini\"><!-- --></em></span>
      </label>
      <label class=\"input_text input_text_nomargin\">
        <span>Nastavení plného náhledu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" onkeyup=\"TypeUpload(this.value, 'own', '', '#full');\" />
        <span class=\"central_dodatek\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost.<br /><em id=\"full\"><!-- --></em></span>
      </label>
      <label class=\"input_checkbox input_checkbox_margin\">
        <span>Měnit velikosti obrázku:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\" onclick=\"$('#hide_conf').attr('disabled', this.checked);\"%%5%% />
      </label>
        <input type=\"hidden\" name=\"konfigurace[]\" id=\"hide_conf\"%%6%% />
        \n",



                  "admin_vyber_typu_seriefoto_default" => "200x0%%1%%800x0%%1%%1%%1%%3%%1%%1",

                  "admin_vyber_typu_seriefoto" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <script type=\"text/javascript\" src=\"%%2%%/script/ajax.js\"></script>
      <script type=\"text/javascript\">
        TypeUpload('%%3%%', '', '<strong>Bude požadovat vlastní miniaturu</strong>', '#mini');
        TypeUpload('%%4%%', 'own', '', '#full');
      </script>
      <label class=\"input_text\">
        <span>Nastavení miniatury:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" onkeyup=\"TypeUpload(this.value, '', '<strong>Bude požadovat vlastní miniaturu</strong>', '#mini');\" />
        <span class=\"central_dodatek\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost.<br /><em id=\"mini\"><!-- --></em></span>
      </label>
      <label class=\"input_text input_text_nomargin\">
        <span>Nastavení plného náhledu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" onkeyup=\"TypeUpload(this.value, 'own', '', '#full');\" />
        <span class=\"central_dodatek\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost.<br /><em id=\"full\"><!-- --></em></span>
      </label>
      <label class=\"input_checkbox input_checkbox_margin\">
        <span>Měnit velikosti obrázku:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\" onclick=\"$('#hide_conf').attr('disabled', this.checked);\"%%5%% />
      </label>
        <input type=\"hidden\" name=\"konfigurace[]\" id=\"hide_conf\"%%6%% />
      <label class=\"input_text\">
        <span>Výchozí počet obrázků:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%7%%\" />
      </label>
      <label class=\"input_checkbox input_checkbox_margin\">
        <span>Měnit počet obrázků:</span>
        <input type=\"checkbox\" name=\"konfigurace[]\" onclick=\"$('#hide_poc').attr('disabled', this.checked);\"%%8%% />
      </label>
        <input type=\"hidden\" name=\"konfigurace[]\" id=\"hide_poc\"%%9%% />\n",







                  //administrace nastaveni
                  "admin_setting" => "
<div class=\"pridat_upravit_element_dynamicke_zobrazeni\">
  <h3>Konfigurace eshopu</h3>
  <p>...</p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Maximální zanoření:</span>
        <input type=\"text\" name=\"max_zanoreni\" value=\"%%1%%\" />
        <span class=\"zobrazovani_dodatek\">0 == vypnuto (nekonečně)</span>
      </label>
razeni menu
      <label class=\"input_radio\">
        <span>Řazení podle pořadí [0 -> 9]:</span>
        <input type=\"radio\" name=\"razeni_menu\" value=\"poradi ASC\"%%2%% />
      </label>
      <label class=\"input_radio\">
        <span>Řazení podle pořadí [9 -> 0]:</span>
        <input type=\"radio\" name=\"razeni_menu\" value=\"poradi DESC\"%%3%% />
      </label>
razeni obsahu
      <label class=\"input_radio\">
        <span>Řazení podle pořadí [0 -> 9]:</span>
        <input type=\"radio\" name=\"razeni_obsah\" value=\"poradi ASC\"%%4%% />
      </label>
      <label class=\"input_radio\">
        <span>Řazení podle pořadí [9 -> 0]:</span>
        <input type=\"radio\" name=\"razeni_obsah\" value=\"poradi DESC\"%%5%% />
      </label>
      <label class=\"input_radio\">
        <span>Řazení podle názvu [0 -> 9]:</span>
        <input type=\"radio\" name=\"razeni_obsah\" value=\"LOWER(nazev) ASC\"%%6%% />
      </label>
      <label class=\"input_radio\">
        <span>Řazení podle názvu [9 -> 0]:</span>
        <input type=\"radio\" name=\"razeni_obsah\" value=\"LOWER(nazev) DESC\"%%7%% />
      </label>
heldání podle
      <label class=\"input_checkbox\">
        <span>Hledat podle autora:</span>
        <input type=\"checkbox\" name=\"search_autor\"%%8%% />
      </label>
      <label class=\"input_checkbox\">
        <span>Hledat podle názvu:</span>
        <input type=\"checkbox\" name=\"search_name\"%%9%% />
      </label>
+++nastaveni z jakych polozek menu pujdou nahodne zbozi do hlavni strany<br />
naklikane elementy:
%%10%%
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Uložit konfiguraci\" />
      </label>
    </fieldset>
  </form>
</div>
                  ",

                  "vypis_vyhledavani_element" => "
      <label class=\"input_checkbox\">
        <span>Hledat podle %%1%%:</span>
        <input type=\"checkbox\"%%2%% disabled=\"disabled\" />
      </label>
                  ",

                  "vypis_vyhledavani_element_null" => "žádné položky",

                  "admin_setting_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla uložena konfigurace
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  //admistrace polozek menu
                  "admin_eshop_menu" => "
  <script type=\"text/javascript\" src=\"%%1%%\"></script>
  <script type=\"text/javascript\">
    function ZmenStav(koren, id, hodnota)
    {
      ZobrazHlasku();
      $.post(\"%%2%%/ajax_form.php\",
            \"action=changedefmenu&koren=\"+koren+\"&id=\"+id+\"&value=\"+hodnota,
              function(theResponse)
              {
                $('#status_change').html(theResponse);
                setTimeout(\"SchovejHlasku()\", 2000);
              }
            );
    }

    function ZobrazHlasku()
    {
      $(document).ready(function(){
        $(\"#status_change\").fadeIn(\"slow\");
      });
    }

    function SchovejHlasku()
    {
      $(document).ready(function(){
        $(\"#status_change\").fadeOut(\"slow\");
      });
    }
  </script>
<div class=\"galerie_bez_sekci\">
  <h3>Výpis eshop menu</h3>
  <p class=\"odkaz_pridat_skupinu\"><a href=\"%%3%%\" title=\"Přidat eshop menu\">Přidat eshop menu</a></p>
%%4%%
</div>
<span id=\"status_change\"></span>
                  ",

                  "ajax_update_change_defmenu" => "Byla provedena změna deaultní položka z: %%1%% na: %%2%%",

                  //skryta sekce v adminu pridavani/upravy menu
                  "admin_skryta_sekce_menu" => "
skryta sekce... ↓
      <label class=\"input_text\">
        <span>Zámek položky:</span>
        <input type=\"checkbox\" name=\"zamek\"%%1%% />
        <span class=\"zobrazovani_dodatek\"></span>
      </label>
      <label class=\"input_text\">
        <span>href id:</span>
        <input type=\"text\" name=\"href_id\" value=\"%%2%%\" />
        <span class=\"zobrazovani_dodatek\"></span>
      </label>
      <label class=\"input_text\">
        <span>href class:</span>
        <input type=\"text\" name=\"href_class\" value=\"%%3%%\" />
        <span class=\"zobrazovani_dodatek\"></span>
      </label>
      <label class=\"input_text\">
        <span>href akce:</span>
        <input type=\"text\" name=\"href_akce\" value=\"%%4%%\" />
        <span class=\"zobrazovani_dodatek\"></span>
      </label>
                  ",

                  "admin_addmenu" => "
  <script type=\"text/javascript\" src=\"%%1%%\"></script>
  <script type=\"text/javascript\" src=\"%%2%%\"></script>
<div class=\"pridat_upravit_element_dynamicke_zobrazeni\">
  <h3>Přidat položku menu</h3>
  <p class=\"backlink_zobrazovani\"><a href=\"%%6%%\" title=\"Zpět na výpis eshop menu\">Zpět na výpis eshop menu</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Číslo zanoření:</span>
        %%3%%
      </label>
      <label class=\"input_text\">
        <span>Nazev:</span>
        <input type=\"text\" name=\"nazev\" onchange=\"PrepisRewrite(this.value, '.rewrite');\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Rewrite:</span>
        <input type=\"text\" class=\"rewrite\" name=\"rewrite\" readonly=\"readonly\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka. + unikátní</span>
      </label>
%%4%%
      <label class=\"input_text\">
        <span>Výpis aktuální urovně zanoření:</span>
%%5%%
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat menu\" />
      </label>
    </fieldset>
  </form>
</div>\n
                  ",

                  "admin_addmenu_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla přidána položka menu: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",


                  "admin_editmenu" => "
  <script type=\"text/javascript\" src=\"%%1%%\"></script>
  <script type=\"text/javascript\" src=\"%%2%%\"></script>
<div class=\"pridat_upravit_element_dynamicke_zobrazeni\">
  <h3>Upravit položku menu</h3>
  <p class=\"backlink_zobrazovani\"><a href=\"%%8%%\" title=\"Zpět na výpis eshop menu\">Zpět na výpis eshop menu</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Číslo zanoření:</span>
        %%3%%
      </label>
      <label class=\"input_text\">
        <span>Nazev:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%4%%\" onchange=\"PrepisRewrite(this.value, '.rewrite');\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Rewrite:</span>
        <input type=\"text\" class=\"rewrite\" name=\"rewrite\" value=\"%%5%%\" readonly=\"readonly\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka. + unikátní</span>
      </label>
%%6%%
      <label class=\"input_text\">
        <span>Výpis aktuální urovně zanoření:</span>
%%7%%
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit menu\" />
      </label>
    </fieldset>
  </form>
</div>\n
                  ",

                  "admin_editmenu_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla upravena položka menu: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delmenu_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla smazána položka menu: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  //admin obsluha zanoreni v menu
                  "admin_vypis_zanoreni_menu_begin" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\" src=\"%%2%%\"></script>
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
                          update: function() {
        var order = $(this).sortable(\"serialize\") + '&action=updatezanmenu&direct=%%4%%';
        $.post(\"%%3%%/ajax_form.php\", order, function(theResponse){
          $(\"#status_drag\").html(theResponse);
          setTimeout(\"SchovejHlasku()\", 2000);
        });
        ZobrazHlasku();
      }
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
<div class=\"obal_razeni\">",

                  "admin_vypis_zanoreni_menu" => "
<ul id=\"arrayzanoreni_%%1%%\" class=\"vypis_sablon_zahlavi\">
  <li>[%%1%%] - [%%6%%] nazev: <strong>%%2%%</strong> (%%3%%), defaultní: <input type=\"checkbox\"%%4%% disabled=\"disabled\" /></li>
  <li>%%5%%</li>
</ul>
                  ",

                  "admin_vypis_zanoreni_menu_submenu" => "&nbsp;&nbsp;&nbsp;obsahuje další submenu...",

                  "admin_vypis_zanoreni_menu_null_submenu" => "",

                  "admin_vypis_zanoreni_menu_null" => "žádná položka pro toto zanoření",

                  "admin_vypis_zanoreni_menu_end" => "
</div>
<div id=\"status_drag\"></div>
konec šablony",

                  "ajax_update_menu_zanoreni" => "Byl proveden přesun mezi položkami",






//rewrite: %%2%%, id, nazev, zanoreni, default, lock
                  "admin_vypis_obsah_menu_addsub" => "<a href=\"%%2%%\" title=\"Přidat submenu do: %%1%%\">Přidat sub</a>",

                  "admin_vypis_obsah_menu_addsub_max" => "max zan!",

                  //rekurzivne vykreslovane %%13%% po nastylovani pujde do prdele
                  "admin_vypis_obsah_menu" => "
%%14%% (i:%%1%%), n: <strong>%%2%%</strong>,  z: %%4%%,
d:<input type=\"radio\" name=\"defz%%4%%k%%5%%\" onclick=\"ZmenStav(%%5%%, %%1%%, this.checked, '#status_change');\" %%6%%>,
l:<input type=\"checkbox\"%%7%% disabled=\"disabled\">
<a href=\"%%8%%\" title=\"Upravit menu\">Upr</a>
<a href=\"%%9%%\" title=\"Smazat menu\" onclick=\"return confirm('Opravdu chceš smazat menu: &quot;%%2%%&quot; ?');\">Smz</a>
<a href=\"%%10%%\" title=\"Přidat menu stejné urovně\">AdMnStU</a>
%%11%%
<a href=\"%%12%%\" title=\"Přidat obsah menu\">AdObs</a><br />
%%13%%
                  ",

                  "admin_vypis_obsah_menu_null" => "žádné položky menu",




                  //vypis menu v obsahu
                  "admin_vypis_menu_aktivni" => "aktivní",

                  "admin_vypis_menu_submenu" => "má submenu",

                  "admin_vypis_menu" => "
(i:%%1%%), n: <strong><a href=\"%%2%%\" title=\"%%3%%\">%%3%%</a></strong> (%%4%%)[%%5%%], z: %%6%%,
d:<input type=\"checkbox\"%%7%% disabled=\"disabled\" />,
[ %%8%%x ]
<a href=\"%%9%%\" title=\"Přidat obsah menu\">Add Obsah</a><br />
                  ",

                  "admin_vypis_menu_href_down" => "<a href=\"%%1%%\" title=\"%%2%%\">%%2%%</a>",

                  "admin_vypis_menu_href_up" => "<a href=\"%%1%%\" title=\"o uroven vys\">o uroven vys</a><br />",

                  "admin_vypis_menu_null" => "žádné položky menu",


                  //dorbekova navigace
                  "admin_vypis_drobek_root" => "<a href=\"%%1%%\">Kořen</a>",

                  "admin_vypis_drobek_href" => "<a href=\"%%2%%\">%%3%%</a>",

                  "admin_vypis_drobek_text" => "%%2%%",

                  "admin_vypis_drobek_sep" => " >> ",


                  //vypis polozek obsahu menu
                  "admin_vypis_polozky_obsah_begin" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\" src=\"%%2%%\"></script>
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
                          update: function() {
        var order = $(this).sortable(\"serialize\") + '&action=updateporobsah&direct=%%4%%';
        $.post(\"%%3%%/ajax_form.php\", order, function(theResponse){
          $(\"#status_drag\").html(theResponse);
          setTimeout(\"SchovejHlasku()\", 2000);
        });
        ZobrazHlasku();
      }
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
<h3>aktualni sekce: <strong>%%5%%</strong>, pocet položek: <strong>%%6%%</strong></h3>
<div class=\"obal_razeni\">",


                  "admin_vypis_polozky_obsah_tvar_datum" => "d.m.Y H:i:s",

                  "admin_vypis_polozky_obsah" => "
<ul id=\"arrayporadi_%%1%%\" class=\"vypis_sablon_zahlavi\">
  <li>%%2%% (%%3%%)</li>
  <li>%%4%% %%5%% %%6%%x</li>
  <li><a href=\"%%7%%\" title=\"copy\">copy</a> -
      <a href=\"%%8%%\" title=\"edit\">edit obsah</a> -
      <a href=\"%%9%%\" title=\"del\" onclick=\"return confirm('Opravdu chceš smazat obsah: &quot;%%2%%&quot; ?');\">del</a></li>
  <li>
    %%10%% - (10)<br />
    %%11%% - (11)<br />
    %%12%% - (12)<br />
    %%13%% - (13)<br />
    %%14%% - (14)<br />
    %%15%% - (15)<br />
    %%16%% - (16)<br />
    %%17%% - (17)<br />
    %%18%% - (18)<br />
    %%19%% - (19)<br />
    %%20%% - (20)<br />
    %%21%% - (21)<br />
    %%22%% - (22)<br />
    %%23%% - (23)<br />
    %%24%% - (24)<br />
    %%25%% - (25)<br />
    %%26%% - (26)<br />
    %%27%% - (27)<br />
    %%28%% - (28)<br />
    %%29%% - (29)<br />
    %%30%% - (30)<br />
    %%31%% - (31)<br />
    %%32%% - (32)<br />
    %%33%% - (33)<br />
    %%34%% - (34)<br />
    %%35%% - (35)<br />
    %%36%% - (36)<br />
    %%37%% - (37)<br />
    %%38%% - (38)<br />
    %%39%% - (39)<br />
    %%40%% - (40)<br />
    %%41%% - (41)<br />
    %%42%% - (42)<br />
    %%43%% - (43)<br />
    %%44%% - (44)<br />
    %%45%% - (45)<br />
    %%46%% - (46)<br />
    %%47%% - (47)<br />
    %%48%% - (48)<br />
    %%49%% - (49)<br />
    %%50%% - (50)<br />
    %%51%% - (51)<br />
    %%52%% - (52)<br />
    %%53%% - (53)<br />
    %%54%% - (54)<br />
    %%55%% - (55)<br />
    %%56%% - (56)<br />
    %%57%% - (57)<br />
    %%58%% - (58)<br />
    %%59%% - (59)<br />
    %%60%% - (60)<br />
    %%61%% - (61)<br />
    %%62%% - (62)<br />
    %%63%% - (63)<br />
    %%64%% - (64)<br />
    %%65%% - (65)<br />
    %%66%% - (66)<br />
    %%67%% - (67)<br />
    %%68%% - (68)<br />
    %%69%% - (69)<br />
    %%70%% - (70)<br />
    %%71%% - (71)<br />
    %%72%% - (72)<br />
    %%73%% - (73)<br />
    %%74%% - (74)<br />
    %%75%% - (75)<br />
    <br /><br />
  </li>
</ul>
                  ",

                  "ajax_update_polozky_obsah" => "Byl proveden přesun mezi položkami",

                  "admin_vypis_polozky_obsah_null" => "žádné položky",

                  "admin_vypis_polozky_obsah_sep" => ", ",

                  "admin_vypis_polozky_obsah_end" => "
</div>
<div id=\"status_drag\"></div>
konec...",




                  //elementy do obsahu
                  "set_znacka_povinne" => "Povinná položka.",

                  //checkbox pro adminy
                  "admin_addedit_checkbox" => "
      <label class=\"input_text\">
        <span>%%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[value]\" value=\"%%3%%\"%%4%% />
        <span class=\"zobrazovani_dodatek\">%%5%%</span>
      </label>
                  ",

                  //checkbox pro uzivatele
                  "admin_addedit_checkbox_user" => "
      <label class=\"input_text\">
        <span>%%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[value]\" value=\"%%3%%\"%%4%% />
        <span class=\"zobrazovani_dodatek\">%%6%%</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show]\"%%5%% />
      </label>
                  ",

                  //checkgroup pro adminy
                  "admin_addedit_checkgroup_row" => "
      <label class=\"input_checkbox\">
        <span>%%1%%:</span>
        <input type=\"checkbox\" name=\"%%2%%[value][%%3%%]\" value=\"%%4%%\"%%5%% />
        <span class=\"central_dodatek\">%%6%%</span>
      </label>
                  ",

                  "admin_addedit_checkgroup" => "
      <label class=\"input_checkbox\">
        <span>%%1%%:</span>
      </label>
%%2%%
      <label class=\"input_checkbox\">
        <span class=\"central_dodatek\">%%3%%</span>
      </label>
                  ",


                  //checkgroup pro uzivatele
                  "admin_addedit_checkgroup_user_row" => "
      <label class=\"input_checkbox\">
        <span>%%1%%:</span>
        <input type=\"checkbox\" name=\"%%2%%[value][%%3%%]\" value=\"%%4%%\"%%5%% />
        <span class=\"central_dodatek\">%%7%%</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show][%%3%%]\"%%6%% />
      </label>
                  ",

                  "admin_addedit_checkgroup_user" => "
      <label class=\"input_checkbox\">
        <span>%%1%%:</span>
      </label>
%%2%%
      <label class=\"input_checkbox\">
        <span class=\"central_dodatek\">%%3%%</span>
      </label>
                  ",

                  //radio pro adminy
                  "admin_addedit_radio_row" => "
      <label class=\"input_checkbox\">
        <span>%%1%%:</span>
        <input type=\"radio\" name=\"%%2%%[value]\" value=\"%%3%%\"%%4%% />
        <span class=\"central_dodatek\">%%5%%</span>
      </label>\n",

                  "admin_addedit_radio" => "
      <label class=\"input_checkbox\">
        <span>%%1%%:</span>
      </label>
%%2%%
      <label class=\"input_checkbox\">
        <span class=\"central_dodatek\">%%3%%</span>
      </label>
                  ",


                  //radio pro uzivatele
                  "admin_addedit_radio_user_row" => "
      <label class=\"input_checkbox\">
        <span>%%1%%:</span>
        <input type=\"radio\" name=\"%%2%%[value]\" value=\"%%4%%\"%%5%% />
        <span class=\"central_dodatek\">%%7%%</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show][%%3%%]\"%%6%% />
      </label>\n",

                  "admin_addedit_radio_user" => "
      <label class=\"input_checkbox\">
        <span>%%1%%:</span>
      </label>
%%2%%
      <label class=\"input_checkbox\">
        <span class=\"central_dodatek\">%%3%%</span>
      </label>
                  ",


                  //colorradio pro adminy
                  "admin_addedit_colorradio_row" => "
      <label class=\"input_checkbox\">
        <span>%%1%% (%%3%%):</span>
        <input type=\"radio\" name=\"%%2%%[value]\" value=\"%%3%%\"%%4%% />
        <span class=\"central_dodatek\">%%5%%</span>
      </label>\n",

                  "admin_addedit_colorradio" => "
      <label class=\"input_checkbox\">
        <span>%%1%%:</span>
      </label>
%%2%%
      <label class=\"input_checkbox\">
        <span class=\"central_dodatek\">%%3%%</span>
      </label>
                  ",


                  //colorradio pro uzivatele
                  "admin_addedit_colorradio_user_row" => "
      <label class=\"input_checkbox\">
        <span>%%1%% (%%4%%):</span>
        <input type=\"radio\" name=\"%%2%%[value]\" value=\"%%4%%\"%%5%% />
        <span class=\"central_dodatek\">%%7%%</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show][%%3%%]\"%%6%% />
      </label>\n",

                  "admin_addedit_colorradio_user" => "
      <label class=\"input_checkbox\">
        <span>%%1%%:</span>
      </label>
%%2%%
      <label class=\"input_checkbox\">
        <span class=\"central_dodatek\">%%3%%</span>
      </label>
                  ",


                  //select pro adminy
                  "admin_addedit_select_row" => "<option value=\"%%1%%\"%%2%%>%%3%%</option>",

                  "admin_addedit_select" => "
      <label class=\"input_select\">
        <span>%%1%%:</span>
          <select name=\"%%2%%[value]\">
            %%3%%
          </select>
        <span class=\"central_dodatek\">%%4%%</span>
      </label>",


                  //select pro uzivatele
                  "admin_addedit_select_user_row" => "
      <label class=\"input_checkbox\">
        <span>%%1%%:</span>
        <input type=\"radio\" name=\"%%2%%[value]\" value=\"%%4%%\"%%5%% />
        <span class=\"central_dodatek\">%%7%%</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show][%%3%%]\"%%6%% />
      </label>\n",

                  "admin_addedit_select_user" => "
      <label class=\"input_checkbox\">
        <span>%%1%%:</span>
      </label>
%%2%%
      <label class=\"input_checkbox\">
        <span class=\"central_dodatek\">%%3%%</span>
      </label>
                  ",

                  //minitext pro adminy
                  "admin_addedit_minitext" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\" class=\"hodnota%%2%%\" />
        <span class=\"central_dodatek\">
          %%6%%<br /><a href=\"#\" onclick=\"NahledTextu($('.hodnota%%2%%').val(), $('.delka%%2%%').val(), $('.zkrac%%2%%').val(), '#nahled_text%%2%%'); return false;\" title=\"Náhled\">Náhled</a>: <em id=\"nahled_text%%2%%\"></em>
        </span>
      </label>
      <label class=\"input_text\">
        <span>Zkracování textu po:</span>
        <input type=\"text\" name=\"%%2%%[delka]\" value=\"%%4%%\" class=\"delka%%2%%\" />
        <span class=\"central_dodatek\">0 = nezkracuje text</span>
      </label>
      <label class=\"input_text input_text_odsazeni\">
        <span>Zakončení zkráceného textu:</span>
        <input type=\"text\" name=\"%%2%%[zkrac]\" value=\"%%5%%\" class=\"zkrac%%2%%\" />
      </label>\n",


                  //minitext pro uzivatele
                  "admin_addedit_minitext_user" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\" class=\"hodnota%%2%%\" />
        <span class=\"central_dodatek\">
          %%7%%<br /><a href=\"#\" onclick=\"NahledTextu($('.hodnota%%2%%').val(), $('.delka%%2%%').val(), $('.zkrac%%2%%').val(), '#nahled_text%%2%%'); return false;\" title=\"Náhled\">Náhled</a>: <em id=\"nahled_text%%2%%\"></em>
        </span>
      </label>
      <label class=\"input_text\">
        <span>Zkracování textu po:</span>
        <input type=\"text\" name=\"%%2%%[delka]\" value=\"%%4%%\" class=\"delka%%2%%\" />
        <span class=\"central_dodatek\">0 = nezkracuje text</span>
      </label>
      <label class=\"input_text input_text_odsazeni\">
        <span>Zakončení zkráceného textu:</span>
        <input type=\"text\" name=\"%%2%%[zkrac]\" value=\"%%5%%\" class=\"zkrac%%2%%\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show]\"%%6%% />
      </label>\n",


                  //fulltext pro adminy
                  "admin_addedit_fulltext" => "
      <label class=\"input_textarea\">
        <span>%%1%%:</span>
        <textarea name=\"%%2%%[value]\" rows=\"30\" cols=\"80\" class=\"hodnota%%2%%\">%%3%%</textarea>
        <span class=\"central_dodatek\">
          %%6%%<br /><a href=\"#\" onclick=\"NahledTextu($('.hodnota%%2%%').val(), $('.delka%%2%%').val(), $('.zkrac%%2%%').val(), '#nahled_text%%2%%'); return false;\" title=\"Náhled\">Náhled</a>: <em id=\"nahled_text%%2%%\"></em>
        </span>
      </label>
      <label class=\"input_text\">
        <span>Zkracování textu po:</span>
        <input type=\"text\" name=\"%%2%%[delka]\" value=\"%%4%%\" class=\"delka%%2%%\" />
        <span class=\"central_dodatek\">0 = nezkracuje text</span>
      </label>
      <label class=\"input_text input_text_odsazeni\">
        <span>Zakončení zkráceného textu:</span>
        <input type=\"text\" name=\"%%2%%[zkrac]\" value=\"%%5%%\" class=\"zkrac%%2%%\" />
      </label>\n",

                  //fulltext pro uzivatele
                  "admin_addedit_fulltext_user" => "
      <label class=\"input_textarea\">
        <span>%%1%%:</span>
        <textarea name=\"%%2%%[value]\" rows=\"30\" cols=\"80\" class=\"hodnota%%2%%\">%%3%%</textarea>
        <span class=\"central_dodatek\">
          %%7%%<br /><a href=\"#\" onclick=\"NahledTextu($('.hodnota%%2%%').val(), $('.delka%%2%%').val(), $('.zkrac%%2%%').val(), '#nahled_text%%2%%'); return false;\" title=\"Náhled\">Náhled</a>: <em id=\"nahled_text%%2%%\"></em>
        </span>
      </label>
      <label class=\"input_text\">
        <span>Zkracování textu po:</span>
        <input type=\"text\" name=\"%%2%%[delka]\" value=\"%%4%%\" class=\"delka%%2%%\" />
        <span class=\"central_dodatek\">0 = nezkracuje text</span>
      </label>
      <label class=\"input_text input_text_odsazeni\">
        <span>Zakončení zkráceného textu:</span>
        <input type=\"text\" name=\"%%2%%[zkrac]\" value=\"%%5%%\" class=\"zkrac%%2%%\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show]\"%%6%% />
      </label>\n",

                  //wymeditor pro adminy
                  "admin_addedit_wymeditor" => "
      <div class=\"input_wymeditor\">
        <span class=\"central_nadpis_wym\">%%1%%</span>
        <textarea name=\"%%2%%[value]\" rows=\"30\" cols=\"80\" class=\"wymeditor\">%%3%%</textarea>
        <span class=\"central_dodatek\">
          %%6%%
        </span>
      </div>
      <input type=\"hidden\" name=\"%%2%%[delka]\" value=\"%%4%%\" />
      <input type=\"hidden\" name=\"%%2%%[zkrac]\" value=\"%%5%%\" />\n",

                  //hiddentext pro adminy
                  "admin_addedit_hiddentext" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"hidden\" name=\"%%2%%[value]\" value=\"%%3%%\" />
      </label>\n",

                  //hiddentext pro uzivatele
                  "admin_addedit_hiddentext_user" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\" />
        <span class=\"central_dodatek\">
          %%5%%
        </span>
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show]\"%%4%% />
      </label>\n",


                  //connectmodule pro adminy
                  "admin_addedit_conectmodule_null" => "Nepodařilo se najít modul !",

                  "admin_addedit_conectmodule" => "
      <label class=\"input_text input_file\">
        <span>%%1%%:</span>
        <em><strong>%%3%%</strong></em>
        <span class=\"central_dodatek\">%%5%%</span>
      </label>\n",


                  //connect module pro uzivatele
                  "admin_addedit_conectmodule_user_null" => "Nepodařilo se najít modul !",

                  "admin_addedit_conectmodule_user" => "
      <label class=\"input_text input_file\">
        <span>%%1%%:</span>
        <em><strong>%%3%%</strong></em>
        <span class=\"central_dodatek\">%%5%%</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show]\"%%4%% />
      </label>\n",

                  //download_user pro uzivatele
                  "admin_addedit_download_user" => "
      <label class=\"input_text\">
        <span>%%1%%</span>
        <span class=\"central_dodatek\">%%7%%</span>
      </label>
      <label class=\"input_text\">
        <span>Název dokumentu:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\"  />
      </label>
      <label class=\"input_text\">
        <span>Soubor pro uživatele:</span>
        <input type=\"file\" name=\"%%2%%[soubor]\" />
        <span class=\"central_dodatek\"><a href=\"%%4%%\">link</a>, staženo: %%5%%x</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show]\"%%6%% />
      </label>\n",

                  //pdf_user pro uzivatele
                  "admin_addedit_pdf_user" => "
      <label class=\"input_text\">
        <span>%%1%%</span>
        <span class=\"central_dodatek\">%%4%%</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show]\"%%3%% />
      </label>
                  ",

                  //reviews_user pro uzivatele
                  "admin_addedit_reviews_user" => "
      <label class=\"input_text\">
        <span>%%1%%</span>
        <span class=\"central_dodatek\">%%4%%</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show]\"%%3%% />
      </label>
                  ",

                  //url_user pro uzivatele
                  "admin_addedit_url_user" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\" />
        <span class=\"central_dodatek\">%%7%%</span>
      </label>
      <label class=\"input_text\">
        <span>URL link:</span>
        <input type=\"text\" name=\"%%2%%[link]\" value=\"%%4%%\" />
        <span class=\"central_dodatek\">s http://</span>
      </label>
      <label class=\"input_text input_text_odsazeni\">
        <span>Do nového okna:</span>
        <input type=\"checkbox\" name=\"%%2%%[nove]\"%%5%% />
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show]\"%%6%% />
      </label>\n",

                  //datum pro adminy
                  "admin_addedit_datum" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\" class=\"hodnota%%2%%\" />
        <span class=\"central_dodatek\">
          %%8%%<br /><a href=\"#\" onclick=\"NahledData($('.hodnota%%2%%').val(), '%%4%%', '%%5%%', '%%6%%', '%%7%%', '#nahled_datum%%2%%'); return false;\" title=\"Náhled\">Náhled</a>: <em id=\"nahled_datum%%2%%\"></em>
        </span>
      </label>\n",

                  //cas pro adminy
                  "admin_addedit_cas" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\" class=\"hodnota%%2%%\" />
        <span class=\"central_dodatek\">
          %%5%%<br /><a href=\"#\" onclick=\"NahledCasu($('.hodnota%%2%%').val(), '%%4%%', '#nahled_datum%%2%%'); return false;\" title=\"Náhled\">Náhled</a>: <em id=\"nahled_datum%%2%%\"></em>
        </span>
      </label>\n",

                  //datumcas pro adminy
                  "admin_addedit_datumcas" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\" class=\"hodnota%%2%%\" />
        <span class=\"central_dodatek\">
          %%8%%<br /><a href=\"#\" onclick=\"NahledData($('.hodnota%%2%%').val(), '%%4%%', '%%5%%', '%%6%%', '%%7%%', '#nahled_datum%%2%%'); return false;\" title=\"Náhled\">Náhled</a>: <em id=\"nahled_datum%%2%%\"></em>
        </span>
      </label>\n",


                  //datum_user pro uzivatele
                  "admin_addedit_datum_user" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\" class=\"hodnota%%2%%\" />
        <span class=\"central_dodatek\">
          %%9%%<br /><a href=\"#\" onclick=\"NahledData($('.hodnota%%2%%').val(), '%%4%%', '%%5%%', '%%6%%', '%%7%%', '#nahled_datum%%2%%'); return false;\" title=\"Náhled\">Náhled</a>: <em id=\"nahled_datum%%2%%\"></em>
        </span>
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show]\"%%8%% />
      </label>\n",

                  //cas_user pro uzivatele
                  "admin_addedit_cas_user" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\" class=\"hodnota%%2%%\" />
        <span class=\"central_dodatek\">
          %%6%%<br /><a href=\"#\" onclick=\"NahledCasu($('.hodnota%%2%%').val(), '%%4%%', '#nahled_datum%%2%%'); return false;\" title=\"Náhled\">Náhled</a>: <em id=\"nahled_datum%%2%%\"></em>
        </span>
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show]\"%%5%% />
      </label>\n",

                  //datumcas_user pro uzivatele
                  "admin_addedit_datumcas_user" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\" class=\"hodnota%%2%%\" />
        <span class=\"central_dodatek\">
          %%9%%<br /><a href=\"#\" onclick=\"NahledData($('.hodnota%%2%%').val(), '%%4%%', '%%5%%', '%%6%%', '%%7%%', '#nahled_datum%%2%%'); return false;\" title=\"Náhled\">Náhled</a>: <em id=\"nahled_datum%%2%%\"></em>
        </span>
      </label>
      <label class=\"input_checkbox\">
        <span>Dostupny (user viditelny): %%1%%</span>
        <input type=\"checkbox\" name=\"%%2%%[show]\"%%8%% />
      </label>\n",

                  //foto pro adminy
                  "admin_addedit_foto" => "
      <label class=\"input_file\">
        <span>%%1%%:</span>
        <input type=\"file\" name=\"%%2%%[main]\" />
        <span class=\"central_dodatek\">%%6%%<br /><a href=\"%%5%%\" title=\"\" onclick=\"return hs.expand(this)\" class=\"highslide_odkaz\"><img src=\"%%4%%\" alt=\"X\" /></a></span>
      </label>
%%3%%
                  ",

                  "admin_addedit_foto_set_enable" => "
      <script type=\"text/javascript\">
        TypeUpload('%%2%%', '', '<input type=\'file\' name=\'%%1%%[main_mini]\' ><em>Když se bude nahrávat miniatura znovu, tak je potřeba nahrát i obrázek v plné velikosti.</em>', '#mini%%1%%');
        TypeUpload('%%3%%', 'own', '', '#full%%1%%');
      </script>
      <label class=\"input_file\">
        <span>Nastavení miniatury [hlavní]:</span>
        <input type=\"text\" name=\"%%1%%[mini]\" value=\"%%2%%\" onkeyup=\"TypeUpload(this.value, '', '<input type=\'file\' name=\'%%1%%[main_mini]\' class=\'input_file\'><em>Když se bude nahrávat miniatura znovu, tak je potřeba nahrát i obrázek v plné velikosti.</em>', '#mini%%1%%');\" class=\"input_text\" />
        <span class=\"central_dodatek\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost, own = bude požadovat vlastní miniaturu.<br /><em id=\"mini%%1%%\"><!-- --></em></span>
      </label>
      <label class=\"input_text input_text_nomargin\">
        <span>Nastavení plného náhledu [hlavní]:</span>
        <input type=\"text\" name=\"%%1%%[full]\" value=\"%%3%%\" onkeyup=\"TypeUpload(this.value, 'own', '', '#full%%1%%');\" />
        <span class=\"central_dodatek\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost.<br /><em id=\"full%%1%%\"><!-- --></em></span>
      </label>\n
                  ",

                  //defaultni obrazek
                  "admin_addedit_foto_default_pic" => "",//"../def_pic.jpg",

                  "admin_addedit_foto_set_disable" => "
      <script type=\"text/javascript\">
        TypeUpload('%%2%%', '', '<input type=\'file\' name=\'%%1%%[main_mini]\' class=\'input_file_miniatura\' ><br /><em>Když se bude nahrávat miniatura znovu, tak je potřeba nahrát i obrázek v plné velikosti.</em>', '#mini%%1%%');
      </script>
      <label class=\"input_file\">
        <span>Miniatura:</span>
        <em id=\"mini%%1%%\"><!-- --></em>
      </label>
                  ",



                  //seriefoto pro adminy
                  "admin_addedit_seriefoto" => "
  <script type=\"text/javascript\">
    var poc%%2%% = %%5%%;
    function Pridej%%2%%()
    {
      poc%%2%%++;

      Vykresli%%2%%();
    }

    function Odeber%%2%%()
    {
      poc%%2%%--;

      Vykresli%%2%%();
    }

    var pic%%2%% = ['|%%6%%|']; //r
    var popis%%2%% = ['|%%7%%|'];  //r+w
    function PosliData%%2%%(row, polozka, hodnota)
    {
%%8%%
      switch (polozka)
      {
        case 0:
          popis%%2%%[row] = '|'+roz+'|';
          Vykresli%%2%%();
        break;
      }
    }

    function Vykresli%%2%%()
    {
      $(function() {
        $.post(\"%%4%%/ajax_form.php\",
              \"action=listseriefoto&pocet=\"+poc%%2%%+\"&name=%%2%%&pocser=%%9%%&mini=\"+$('.sourcemini%%2%%').val()+\"&pic=\"+pic%%2%%+\"&popis=\"+popis%%2%%,
                function(theResponse)
                {
                  $('#polozky%%2%%').html(theResponse);
                }
              );
        $('.pocetprvku%%2%%').val(poc%%2%%);
        $('#pocet_polozek%%2%%').html(poc%%2%%);
      });
    }

    window.setTimeout(\"Vykresli%%2%%();\", 10);
  </script>
      <label class=\"input_file\">
        <span>%%1%%:</span>
        <span class=\"central_dodatek\">%%11%%</span>
      </label>
%%3%%
      <div class=\"file_obrazky\">
        <p>
          %%10%%
          <em>Počet obrázků: <strong id=\"pocet_polozek%%2%%\"></strong></em>
        </p>
        <input type=\"hidden\" class=\"pocetprvku%%2%%\" name=\"%%2%%[poc]\" />
        <div id=\"polozky%%2%%\" class=\"polozky_obrazky\"><!-- --></div>
      </div>\n",

                  "admin_addedit_seriefoto_add" => "<em class=\"nadpis_dalsich_obrazku\">Další obrázky:</em><a href=\"#\" onclick=\"Pridej%%1%%(); return false;\" title=\"Přidat obrázek\" class=\"odkaz_pridat_polozku\">Přidat</a>",

                  "admin_addedit_seriefoto_set_enable" => "
      <script type=\"text/javascript\">
        TypeUpload('%%2%%', '', '<strong>Bude požadovat vlastní miniaturu</strong>', '#mini%%1%%');
        TypeUpload('%%3%%', 'own', '', '#full%%1%%');
      </script>
      <label class=\"input_file\">
        <span>Nastavení miniatury [hlavní]:</span>
        <input type=\"text\" name=\"%%1%%[mini]\" value=\"%%2%%\" onkeyup=\"TypeUpload(this.value, '', '<strong>Bude požadovat vlastní miniaturu</strong>', '#mini%%1%%'); Vykresli%%1%%();\" class=\"sourcemini%%1%% input_text\" />
        <span class=\"central_dodatek\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost, own = bude požadovat vlastní miniaturu.<br /><em id=\"mini%%1%%\"><!-- --></em></span>
      </label>
      <label class=\"input_text input_text_nomargin\">
        <span>Nastavení plného náhledu [hlavní]:</span>
        <input type=\"text\" name=\"%%1%%[full]\" value=\"%%3%%\" onkeyup=\"TypeUpload(this.value, 'own', '', '#full%%1%%');\" />
        <span class=\"central_dodatek\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost.<br /><em id=\"full%%1%%\"><!-- --></em></span>
      </label>\n
                  ",

                  "admin_addedit_seriefoto_set_disable" => "
      <script type=\"text/javascript\">
        TypeUpload('%%2%%', '', '<strong>Bude požadovat vlastní miniaturu</strong>', '#mini%%1%%');
      </script>
        <input type=\"hidden\" value=\"%%2%%\" class=\"sourcemini%%1%%\" />
      <label class=\"input_file\">
        <span>Miniatura:</span>
        <em id=\"mini%%1%%\"><!-- --></em>
      </label>
                  ",

                  //defaultni obrazek pro serii fotek
                  "admin_addedit_seriefoto_default_pic" => "",//"../def_pic.jpg",

                  "ajax_listseriefoto" => "
      <label class=\"input_file\">
        <span>Obrázek - [%%2%%]:</span>
        <input type=\"file\" name=\"%%3%%[main%%1%%]\" />
      </label>
      %%7%%
      <label class=\"input_text\">
        <span>Popis obrázku - [%%2%%]:</span>
        <input type=\"text\" name=\"%%3%%[popis%%1%%]\" value=\"%%4%%\" onchange=\"PosliData%%3%%(%%1%%, 0, this.value);\" />
        <span class=\"central_dodatek\">Více popisků odděluj čárkou.<br />Náhled miniatury, pokud existuje:<br /><a href=\"%%6%%\" onclick=\"return hs.expand(this)\" title=\"\" class=\"highslide_odkaz\"><img src=\"%%5%%\" alt=\"X\" /></a></span>
      </label>
      %%8%%",

                  "ajax_listseriefoto_own" => "
      <label class=\"input_file\">
        <span>Miniatura - [%%2%%]:</span>
        <input type=\"file\" name=\"%%3%%[main%%1%%_mini]\" />
      </label>
                  ",

                  "ajax_listseriefoto_del" => "<a href=\"#\" onclick=\"Odeber%%1%%(); return false\" title=\"Odebrat obrázek\" class=\"odkaz_odebrat_polozku\">Odebrat</a>",




                  //chybove hlasky elementu
                  "admin_kontrola_vstupu_checkbox" => "Tento checkbox je povinný.",

                  "admin_kontrola_vstupu_checkgroup" => "Tato skupina checkboxů je povinná.",

                  "admin_kontrola_vstupu_radio" => "Není označen povinný radio button.",

                  "admin_kontrola_vstupu_select" => "Není označen povinný select.",

                  "admin_kontrola_vstupu_texty" => "Tento textový element je povinný (nemůže být prázdný).",

                  "admin_kontrola_vstupu_datum" => "Špatně zadaný formát datumu.",

                  "admin_kontrola_vstupu_cas_datumcas" => "Špatně zadaný formát datumu a/nebo času.",

                  "admin_kontrola_vstupu_download" => "nezadaný soubor a nebo popis souboru.",

                  "admin_kontrola_vstupu_url" => "nezadán popis a nebo odkaz linku",

                  "admin_kontrola_vstupu_foto" => "Obrázek je povinný.",

                  "admin_kontrola_vstupu_foto_mini" => "Miniatura je povinná.",

                  "admin_kontrola_vstupu_foto_dim" => "Pole pro nastavení velikosti nesmí být prázdné.",

                  "admin_kontrola_vstupu_seriefoto" => "Obrázky jsou povinné.",

                  "admin_kontrola_vstupu_seriefoto_mini" => "Miniatury jsou povinné.",

                  "admin_kontrola_vstupu_seriefoto_dim" => "Pole pro nastavení velikosti nesmí být prázdné.",




                  //vlozeni textu chyby u kontroly
                  "admin_kontrola_vstupu_error" => "<p><strong>%%2%%</strong>: <strong>%%1%%</strong></p>\n",




                  //vkladani chybovych hlasek do addedit forumlare
                  "admin_addeditobsah_error" => "
<div class=\"chyby_add_edit_obsah\">
  <p class=\"nadpis_chyb\">Nastaly tyto chyby při ukládání:</p>
  %%1%%
</div>\n",






                  //admin eshop obsahu
                  "admin_obsah_tvar_datum" => "d.m.Y H:i:s",

                  "admin_eshop_obsah" => "
<div class=\"galerie_bez_sekci\">
  <h3>Výpis eshop obsahu</h3>
%%1%%
drobečky:<br />
%%2%%
<br />
%%3%%
</div>
                  ",


                  "admin_addobsah_default" => array("",
                                                    0,
                                                    "název",
                                                    "nazev"),

                  "admin_addeditobsah_add" => "Přidat obsah",

                  "admin_addeditobsah_edit" => "Upravit obsah",

                  "admin_addeditobsah_null" => "žádné elementy",

                  "admin_addeditobsah" => "
  <script type=\"text/javascript\" src=\"%%1%%\"></script>
  <script type=\"text/javascript\" src=\"%%2%%\"></script>
  <script type=\"text/javascript\" src=\"%%3%%\"></script>
  <script type=\"text/javascript\" src=\"%%4%%/script/wymeditor/jquery.wymeditor.min.js\"></script>
  <script type=\"text/javascript\" src=\"%%4%%/script/wymeditor/plugins/fullscreen/jquery.wymeditor.fullscreen.js\"></script>
  <script type=\"text/javascript\" src=\"%%4%%/script/wymeditor/plugins/hovertools/jquery.wymeditor.hovertools.js\"></script>
  <script type=\"text/javascript\">
    $(document).ready(function(){
      $('.wymeditor').wymeditor({
        skin: 'default',
        lang: 'cs',
        postInit: function(wym) {
          wym.fullscreen();
          wym.hovertools();
        },
        dialogFeatures: \"menubar=no,titlebar=no,toolbar=no,resizable=no\"
                      + \",width=700,height=300,top=100,left=100\",
        dialogFeaturesPreview: \"menubar=no,titlebar=no,toolbar=no,resizable=no\"
                             + \",scrollbars=yes,width=700,height=400,top=100,left=100\",
        logoHtml:  \"<a class='wym_wymeditor_link' href='http://www.wymeditor.org/'>WYMeditor</a>\",
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
<div class=\"pridat_upravit_element_dynamicke_zobrazeni\">
  <h3>%%11%% do menu <strong>%%5%%</strong></h3>
  <p class=\"backlink_zobrazovani\"><a href=\"%%13%%\" title=\"Zpět na výpis elementu\">Zpět na výpis elementu</a></p>
  <form method=\"post\" enctype=\"multipart/form-data\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Vyrobce (alias autor):</span>
%%6%% >bude select<
name=autor
<input type=\"hidden\" name=\"autor\" value=\"0\" />
        <span class=\"zobrazovani_dodatek\"></span>
      </label>
      <label class=\"input_text\">
        <span>Název:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%7%%\" onchange=\"PrepisRewrite(this.value, '.rewrite');\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Rewrite:</span>
        <input type=\"text\" class=\"rewrite\" name=\"rewrite\" value=\"%%8%%\" readonly=\"readonly\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
%%9%%
      <label class=\"submit\">
        <input type=\"submit\" name=\"%%11%%\" value=\"%%10%%\" class=\"wymupdate\" />
      </label>
    </fieldset>
%%12%%
  </form>
</div>\n
                  ",


                  "admin_addobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla přidána položka: \"<strong>%%1%%</strong>\", (navíc: <strong>%%2%%</strong>)
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_copyobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla duplikována položka: \"<strong>%%1%%</strong>\", (navíc: <strong>%%2%%</strong>)
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla upravena položka: \"<strong>%%1%%</strong>\", (navíc: <strong>%%2%%</strong>)
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla smazána položka: \"<strong>%%1%%</strong>\", (navíc: <strong>%%2%%</strong>)
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",


                  //administrace (autoru) vyrobcu
                  "admin_eshop_autor" => "
<div class=\"galerie_bez_sekci\">
  <h3>Výpis autorů</h3>
  <p class=\"odkaz_pridat_skupinu\"><a href=\"%%1%%\" title=\"Přidat autora\">Přidat autora</a></p>
%%2%%
</div>
                  ",

                  "admin_addeditaut_add" => "Přidat autora",

                  "admin_addeditaut_edit" => "Upravit autora",

                  "admin_addaut_default" => array("název",
                                                  "popis",
                                                  0,
                                                  true),

                  "admin_addeditaut" => "
<div class=\"pridat_upravit_element_dynamicke_zobrazeni\">
  <h3>%%1%% pro obsah</h3>
  <p class=\"backlink_zobrazovani\"><a href=\"%%7%%\" title=\"Zpět na výpis autoru\">Zpět na výpis autoru</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Připojený uživatel:</span>
%%2%%
name=uzivatel
        <span class=\"zobrazovani_dodatek\"></span>
      </label>
      <label class=\"input_text\">
        <span>Název:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%3%%\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Popis:</span>
        <input type=\"text\" name=\"popis\" value=\"%%4%%\" />
        <span class=\"zobrazovani_dodatek\"></span>
      </label>
      <label class=\"input_text\">
        <span>Podíl:</span>
        <input type=\"text\" name=\"podil\" value=\"%%5%%\" />
        <span class=\"zobrazovani_dodatek\">Desetinné číslo mezi 0 a 1 (0.10 == 10%).</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Aktivní:</span>
        <input type=\"checkbox\" name=\"aktivni\"%%6%% />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",








                  "set_maxsizepic" => 16,

                  "set_pathpicture" => "obrazky",

                  "set_minidir" => "mini",

                  "set_fulldir" => "full",

                  "set_pathfile" => "soubory",


                  "ajaxscript" => "
function PrepisRewrite(text, ret)
{
%%3%%
  $.post(\"%%2%%/ajax_form.php\",
        \"action=rewritename&text=\"+roz,
          function(theResponse)
          {
            $(ret).val(theResponse);
          }
        );
}

function NahledData(datum, format, dny, mesice, tvar, ret)
{
  $(function() {
    $.post(\"%%2%%/ajax_form.php\",
          \"action=gendate&datum=\"+datum+\"&format=\"+format+\"&dny=\"+dny+\"&mesice=\"+mesice+\"&tvar=\"+tvar,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  });
}

function NahledCasu(datum, format, ret)
{
  $(function() {
    $.post(\"%%2%%/ajax_form.php\",
          \"action=gentime&datum=\"+datum+\"&format=\"+format,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  });
}

function NahledTextu(text, delka, zkraceni, ret)
{
  $(function() {
    $.post(\"%%2%%/ajax_form.php\",
          \"action=gentext&text=\"+text+\"&delka=\"+delka+\"&zkraceni=\"+zkraceni,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  });
}

function TypeUpload(value, blok, input, ret)
{
  $(function() {
    if (value == 'own' && value != blok)
    {
      $(ret).html(input); //vlozeni upload inputu
    }
      else
    {
      $(ret).html('');
      roz = value.split('x');
      w = parseInt(roz[0]); //parsnuti velikosti
      h = parseInt(roz[1]);

      if (!isNaN(w) && !isNaN(h))
      {
        if (w == 0 && h == 0)
        {
          $(ret).html('<strong>Ponechá originální velikost</strong>');
          return;
        }

        if (w == 0)
        {
          $(ret).html('<strong>Délka se dopočítává, výška je nastavena</strong>');
          return;
        }

        if (h == 0)
        {
          $(ret).html('<strong>Délka je nastavena, výška se dopočítává</strong>');
          return;
        }

        if (w != 0 && h != 0)
        {
          $(ret).html('<strong>Délka je nastavena, výška je nastavena</strong>');
          return;
        }
      }
        else
      {
        if (value == 'own')
        {
          $(ret).html('<strong>Tato funkce je zakázána !</strong>');
          return;
        }
          else
        {
          $(ret).html('<strong>Špatný zápis !</strong>');
          return;
        }
      }
    }
  });
}
                  ",





                  );

  return $result;
?>
