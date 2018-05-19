<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Faktury - Zákazníci",
                                              "title" => "Faktury - Zákazníci",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%1%%%%2%%",
                                              "odkaz" => "Faktury - Výpis",
                                              "title" => "Faktury - Výpis",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%1%%%%3%%",
                                              "odkaz" => "Faktury - Statistiky",
                                              "title" => "Faktury - Statistiky",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "admin_obsah" => "
<div id=\"dynamicke_faktury_vypis_zakazniku\">
  <h3>Výpis zákazníků</h3>
  <p class=\"odkaz_pridat_zakaznika\"><a href=\"%%1%%\" title=\"Přidat zákazníka\">Přidat zákazníka</a></p>
%%2%%
</div>\n",

                  "admin_vypis_obsah_jednatel_null" => "--- Jednatel není vyplněn ---",

                  "admin_addadr" => "
<div id=\"dynamicke_faktury_vypis_zakazniku_add_edit\">
  <h3>Přidat zákazníka</h3>
  <p class=\"backlink_faktury\">
    <a href=\"%%2%%\" title=\"Zpět na výpis zákazníků\">Zpět na výpis zákazníků</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Číslo zákazníka:</span>
        <input type=\"text\" name=\"cislo\" value=\"%%1%%\" />
        <span class=\"faktury_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Firma / Jméno zákazníka:</span>
        <input type=\"text\" name=\"firma\" />
        <span class=\"faktury_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Jednatel:</span>
        <input type=\"text\" name=\"jednatel\" />
      </label>
      <label class=\"input_text\">
        <span>IČ:</span>
        <input type=\"text\" name=\"ico\" />
      </label>
      <label class=\"input_text\">
        <span>DIČ:</span>
        <input type=\"text\" name=\"dic\" />
      </label>
      <label class=\"input_text\">
        <span>Ulice a číslo popisné:</span>
        <input type=\"text\" name=\"ulicecp\" />
        <span class=\"faktury_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Město:</span>
        <input type=\"text\" name=\"mesto\" />
        <span class=\"faktury_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>PSČ:</span>
        <input type=\"text\" name=\"psc\" />
        <span class=\"faktury_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat zákazníka\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_addadr_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl přidán zákazník: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editadr" => "
<div id=\"dynamicke_faktury_vypis_zakazniku_add_edit\">
  <h3>Upravit zákazníka</h3>
  <p class=\"backlink_faktury\">
    <a href=\"%%10%%\" title=\"Zpět na výpis zákazníků\">Zpět na výpis zákazníků</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Číslo zákazníka:</span>
        <input type=\"text\" name=\"cislo\" value=\"%%1%%\" />
        <span class=\"faktury_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Firma / Jméno zákazníka:</span>
        <input type=\"text\" name=\"firma\" value=\"%%2%%\" />
        <span class=\"faktury_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Jednatel:</span>
        <input type=\"text\" name=\"jednatel\" value=\"%%3%%\" />
      </label>
      <label class=\"input_text\">
        <span>IČ:</span>
        <input type=\"text\" name=\"ico\" value=\"%%5%%\" />
      </label>
      <label class=\"input_text\">
        <span>DIČ:</span>
        <input type=\"text\" name=\"dic\" value=\"%%4%%\" />
      </label>
      <label class=\"input_text\">
        <span>Ulice a číslo popisné:</span>
        <input type=\"text\" name=\"ulicecp\" value=\"%%6%%\" />
        <span class=\"faktury_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Město:</span>
        <input type=\"text\" name=\"mesto\" value=\"%%7%%\" />
        <span class=\"faktury_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>PSČ:</span>
        <input type=\"text\" name=\"psc\" value=\"%%8%%\" />
        <span class=\"faktury_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit zákazníka\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_editadr_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl upraven zákazník: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_deladr_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl smazán zákazník: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_vyber_zakaznik_begin" => "<select name=\"zakaznik\">\n",

                  "admin_vyber_zakaznik" => "  <option value=\"%%1%%\"%%2%%>[%%3%%], %%4%%, %%5%%</option>\n",

                  "admin_vyber_zakaznik_end" => "</select>",

                  "admin_vyber_zakaznik_null" => "Není vytvořený zákazník",

                  "set_stav" => array("Vystavená",
                                      "Uhrazená",
                                      "Stornovaná"
                                      ),

                  "admin_stav_begin" => "        <select name=\"stav\">\n",

                  "admin_stav" => "          <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_stav_end" => "        </select>",

                  "set_typplatby" => array ("Převodem na účet",
                                            "Hotově",
                                            ),

                  "admin_typplatby_begin" => "        <select name=\"typplatby\">\n",

                  "admin_typplatby" => "          <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_typplatby_end" => "        </select>",

                  "admin_addeditfac_tvar_datum" => "d.m.Y", //tvar datumu

                  "admin_addfac_plus_datum" => "+14 day", //+cas na splatnosti

                  "admin_addfac_def_konsym" => "0308",

                  "admin_addfac_def_nadpis" => "Fakturujeme Vám zpracování webových stránek",

                  "admin_addfac_nadpis" => "Vytvořit fakturu",

                  "admin_addfac_tlacitko" => "Vytvořit fakturu",

                  "admin_listelem" => "
                  <table summary=''>
                    <tr>
                      <td><textarea name=\"polozky_nazev[]\" class=\"nazevpolozkytextarea\" rows=\"30\" cols=\"80\" onchange=\"PosliData(%%1%%, 0, this.value);\">%%2%%</textarea></td>
                      <td><input type=\"text\" class=\"jencislapolozky\" name=\"polozky_mnozstvi[]\" value=\"%%3%%\" onchange=\"PosliData(%%1%%, 1, this.value);\" /></td>
                      <td><input type=\"text\" class=\"jencislapolozky\" name=\"polozky_cenajm[]\" value=\"%%4%%\" onchange=\"PosliData(%%1%%, 2, this.value);\" /></td>
                      <td><input type=\"text\" readonly=\"readonly\" value=\"%%5%%\" /></td>
                      <td><input type=\"text\" class=\"jencislapolozky\" name=\"polozky_sleva[]\" value=\"%%6%%\" onchange=\"PosliData(%%1%%, 3, this.value);\" /></td>
                      <td><input type=\"text\" readonly=\"readonly\" value=\"%%7%%\" /></td>
                      <td><input type=\"text\" readonly=\"readonly\" value=\"%%8%%\" /></td>
                    </tr>
                  </table>%%9%%
                  ",

                  "admin_listelem_del" => "<p class=\"odkaz_odebrat_polozku\"><a href=\"#\" onclick=\"OdeberElement(); return false\" title=\"Odebrat položku\">Odebrat položku</a></p>",

                  "admin_listelem_end" => "<p class=\"koncova_cena_celkem\">Koncová cena celkem: <strong>%%1%%</strong> Kč</p>",

                  "admin_addeditfac" => "
  <script type=\"text/javascript\" src=\"%%1%%\"></script>
  <script type=\"text/javascript\" src=\"%%2%%\"></script>
  <script type=\"text/javascript\" src=\"%%3%%/script/comments/prettyComments.js\"></script>
  <script type=\"text/javascript\" src=\"%%3%%/script/numeric/jquery.numeric.pack.js\"></script>
  <script type=\"text/javascript\">
    function ZmenDatum(datum)
    {
      $.post(\"%%3%%/ajax_form.php\",
            \"action=changedate&datum=\"+datum,
              function(theResponse)
              {
                $('#splatnostiddate').val(theResponse); //navrat do input
              }
            );
    }

    var poc = %%14%%;
    function PridejElement()
    {
      if (poc < 20)
      {
        poc++;
      }

      VykresliElement();
    }

    function OdeberElement()
    {
      if (poc > 1)
      {
        poc--;
      }

      VykresliElement();
    }

    var pole_nazev = ['|%%15%%|'];
    var pole_mnozstvi = ['%%16%%'];
    var pole_cenajm = ['%%17%%'];
    var pole_sleva = ['%%18%%'];
    function PosliData(row, polozka, hodnota)
    {
      switch (polozka)
      {
        case 0:
%%4%%
          pole_nazev[row] = '|'+roz+'|';
          //VykresliElement();
        break;

        case 1:
          pole_mnozstvi[row] = hodnota;
          VykresliElement();
        break;

        case 2:
          pole_cenajm[row] = hodnota;
          VykresliElement();
        break;

        case 3:
          pole_sleva[row] = hodnota;
          VykresliElement();
        break;
      }
    }

    function VykresliElement()
    {
      $(function() {
        $.post(\"%%3%%/ajax_form.php\",
              \"action=listelem&pocet=\"+poc+\"&nazev=\"+pole_nazev+\"&mnozstvi=\"+pole_mnozstvi+\"&cenajm=\"+pole_cenajm+\"&sleva=\"+pole_sleva,
                function(theResponse)
                {
                  $('#polozky').html(theResponse);
                  $('.nazevpolozkytextarea').prettyComments({
                    maxHeight: 300
                  });
                  $('.jencislapolozky').numeric();
                }
              );
        $('#pocetpolozek').html(poc);
      });
    }

    window.setTimeout(\"VykresliElement();\", 10);
  </script>
<div id=\"dynamicke_faktury_add_edit_faktury\">
  <h3>%%19%%</h3>
  <p class=\"backlink_faktury\">
    <a href=\"%%26%%\" title=\"Zpět na výpis\">Zpět na výpis</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Číslo faktury: [%%25%%]</span>
        <input type=\"text\" name=\"cislo\" value=\"%%5%%\" />
        <span class=\"faktury_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_select input_select_delsi\">
        <span>Zákazník:</span>
%%6%%
        <span class=\"faktury_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text datepicker\">
        <span>Datum vystavení:</span>
        <input type=\"text\" name=\"vystaveno\" value=\"%%7%%\" id=\"vystavenoiddate\" onchange=\"ZmenDatum(this.value);\" />
        <input type=\"text\" id=\"vystavenoiddod\" class=\"dateinputpicker\" />
        <span class=\"faktury_dodatek\">Povinná položka.</span>
      </label>
<link rel=\"stylesheet\" type=\"text/css\" href=\"%%3%%/script/datepicker/jquery_ui_datepicker.css\" media=\"screen\" />
<script type=\"text/javascript\">
  $(function() {
    $('#vystavenoiddate').datepicker({
      dateFormat: 'dd.mm.yy',
      altField: '#vystavenoiddod',
      altFormat: 'DD',
      changeMonth: true,
      changeYear: true,
      firstDay: 1,
      dayNames: ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'],
      dayNamesMin: ['Ne', 'Po', 'Út', 'St', 'Čt', 'Pá', 'So'],
      dayNamesShort: ['Ned', 'Pon', 'Úte', 'Stř', 'Čtv', 'Pát', 'Sob'],
      monthNames: ['Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec'],
      monthNamesShort: ['Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec'],
      nextText: 'Další měsíc',
      prevText: 'Předchozí měsíc',
      yearRange: '-1:+5',
      //duration: 'fast',
      //currentText: 'Dnes',
      //closeText: 'Zabalit',
      //showButtonPanel: true,
      //gotoCurrent: true,
      //buttonImageOnly: true,
      //numberOfMonths: 3,
    });
  });
</script>
      <label class=\"input_text datepicker\">
        <span>Datum splatnosti:</span>
        <input type=\"text\" name=\"splatnost\" value=\"%%8%%\" id=\"splatnostiddate\" />
        <input type=\"text\" id=\"splatnostiddod\" class=\"dateinputpicker\" />
        <span class=\"faktury_dodatek\">Povinná položka.</span>
      </label>
<script type=\"text/javascript\">
  $(function() {
    $('#splatnostiddate').datepicker({
      dateFormat: 'dd.mm.yy',
      altField: '#splatnostiddod',
      altFormat: 'DD',
      changeMonth: true,
      changeYear: true,
      firstDay: 1,
      dayNames: ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'],
      dayNamesMin: ['Ne', 'Po', 'Út', 'St', 'Čt', 'Pá', 'So'],
      dayNamesShort: ['Ned', 'Pon', 'Úte', 'Stř', 'Čtv', 'Pát', 'Sob'],
      monthNames: ['Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec'],
      monthNamesShort: ['Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec'],
      nextText: 'Další měsíc',
      prevText: 'Předchozí měsíc',
      yearRange: '-1:+5',
      //duration: 'fast',
      //currentText: 'Dnes',
      //closeText: 'Zabalit',
      //showButtonPanel: true,
      //gotoCurrent: true,
      //buttonImageOnly: true,
      //numberOfMonths: 3,
    });
  });
</script>
      <label class=\"input_select\">
        <span>Stav faktury:</span>
%%9%%
      </label>
      <label class=\"input_select\">
        <span>Typ platby:</span>
%%10%%
      </label>
      <label class=\"input_text\">
        <span>Variabilní symbol:</span>
        <input type=\"text\" name=\"varsym\" value=\"%%11%%\" readonly=\"readonly\" />
      </label>
      <label class=\"input_text\">
        <span>Konstantní symbol:</span>
        <input type=\"text\" name=\"konsym\" value=\"%%12%%\" readonly=\"readonly\" />
      </label>
      <label class=\"input_textarea\">
        <span>Nadpis položek:</span>
        <textarea name=\"nadpis\" rows=\"30\" cols=\"80\">%%13%%</textarea>
      </label>
      <label class=\"input_textarea\">
        <span>Poznámka [1]:</span>
        <textarea name=\"poznamka1\" rows=\"30\" cols=\"80\">%%21%%</textarea>
      </label>
      <label class=\"input_textarea\">
        <span>Poznámka [2]:</span>
        <textarea name=\"poznamka2\" rows=\"30\" cols=\"80\">%%22%%</textarea>
      </label>
      <label class=\"input_textarea\">
        <span>Poznámka [3]:</span>
        <textarea name=\"poznamka3\" rows=\"30\" cols=\"80\">%%23%%</textarea>
      </label>
      <label class=\"input_textarea\">
        <span>Poznámka [4]:</span>
        <textarea name=\"poznamka4\" rows=\"30\" cols=\"80\">%%24%%</textarea>
      </label>
      <div class=\"div_tabulka\">
        <p class=\"odkaz_pridat_polozku\">
          <a href=\"#\" onclick=\"PridejElement(); return false;\" title=\"Přidat položku\">Přidat položku</a>
        </p>
        <p class=\"celkem_polozek\">Celkem položek: <strong id=\"pocetpolozek\"></strong></p>
        <table summary=\"\" class=\"zahlavi_table\">
          <tr>
            <td title=\"Název položky\" class=\"delka_textarea\">Název položky</td>
            <td title=\"Množství [počet]\">Množství</td>
            <td title=\"J.cena [za 1 jednotku]\">J.cena</td>
            <td title=\"Cena celkem\">Cena celkem</td>
            <td title=\"J.sleva [za 1 jednotku]\">J.sleva</td>
            <td title=\"Sleva celkem\">Sleva celkem</td>
            <td title=\"Koncová cena\">Koncová cena</td>
          </tr>
        </table>
        <div id=\"polozky\"></div>
      </div>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"%%20%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_addfac_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla vytvořena faktura číslo: <strong>%%1%%</strong>
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editfac_nadpis" => "Upravit fakturu",

                  "admin_editfac_tlacitko" => "Upravit fakturu",

                  "admin_editfac_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla upravena faktura číslo: <strong>%%1%%</strong>
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delfac_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla smazána faktura číslo: <strong>%%1%%</strong>
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_addfac_poznamka1" => "Neplaťte, uhrazeno převodem na účet !",

                  "admin_addfac_poznamka2" => "",

                  "admin_addfac_poznamka3" => "Podnikatel zapsán v živnostenském rejstříku MÚ Břeclav",

                  "admin_addfac_poznamka4" => "",

                  "admin_vypis_tvar_datum" => "d.m.Y H:i:s",

                  "admin_vypis_obsah" => "
<ul>
  <li>Firma: <strong>%%2%%</strong></li>
  <li>Jednatel: <strong>%%3%%</strong></li>
  <li>Číslo zákazníka: <strong>%%1%%</strong></li>
  <li>Počet faktur: <strong>%%5%%</strong></li>
  <li>Datum a čas vytvoření: <strong>%%4%%</strong></li>
  <li class=\"odkaz_pridat_fakturu\"><a href=\"%%6%%\" title=\"Vytvořit fakturu\">Vytvořit fakturu</a></li>
  <li class=\"odkazy_upravit_smazat\"><a href=\"%%7%%\" title=\"Upravit zákazníka\">Upravit zákazníka</a> - <a href=\"%%8%%\" onclick=\"return confirm('Opravdu chceš smazat zákazníka: &quot;%%1%%, %%2%%&quot; ?');\" title=\"Smazat zákazníka\">Smazat zákazníka</a></li>
</ul>\n",

                  "admin_vypis_obsah_null" => "<strong id=\"strong_prazdny\">Není vytvořený zákazník</strong>",

                  "admin_vypis_faktur_tvar_datum" => "d.m.Y",

                  "admin_vypis_faktur_full_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_faktur_begin" => "
<div id=\"dynamicke_faktury_vypis_faktur\">
  <h3>Výpis faktur</h3>\n",

                  "admin_vypis_faktur" => "
<ul>
  <li>Číslo faktury: <strong>%%1%%</strong></li>
  <li>Firma, jednatel: <strong>%%2%%, %%3%%</strong></li>
  <li>Nadpis položek: <strong>%%8%%</strong></li>
  <li>Datum vystavení: <strong>%%4%%</strong></li>
  <li>Datum splatnosti: <strong>%%5%%</strong></li>
  <li>Koncová cena celkem: <strong>%%9%%</strong> Kč</li>
  <li>Stav faktury: <strong>%%6%%</strong></li>
  <li>Typ platby: <strong>%%7%%</strong></li>
  <li>Datum / čas vytvoření faktury: <strong>%%10%%</strong></li>
  <li>Datum / čas upravení faktury: <strong>%%11%%</strong></li>
  <li class=\"odkaz_vytisknout_pdf\"><a href=\"%%12%%\" title=\"Vytisknout PDF\">Vytisknout PDF</a></li>
  <li class=\"odkaz_informace_faktura\"><a href=\"%%13%%\" title=\"Informace o faktuře [%%1%%]\">Informace o faktuře <strong>%%1%%</strong></a></li>
  <li class=\"odkazy_upravit_smazat\">
    <a href=\"%%15%%\" title=\"Upravit fakturu\">Upravit fakturu</a> - %%16%%
  </li>
</ul>\n",

                  "admin_vypis_faktur_del_link_true" => "<a href=\"%%1%%\" onclick=\"return confirm('Opravdu chceš smazat fakturu číslo: &quot;%%2%%&quot; ?');\" title=\"Smazat fakturu\">Smazat fakturu</a>",

                  "admin_vypis_faktur_del_link_false" => "<strong>Nelze smazat !</strong>",

                  "admin_vypis_faktur_end" => "</div>\n",

                  "admin_vypis_faktur_null" => "<strong id=\"strong_prazdny\">Není vytvořený zákazník</strong>",

                  "admin_vypis_faktur_tvar_datum_null" => "Faktura nebyla zatím upravena",

                  "admin_infofac_tvar_datum" => "d.m.Y",

                  "admin_infofac_full_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_infofac_row" => "        <span class=\"informace_obal_polozek_faktury\">
          <span class=\"informace_polozka_faktury_nazev\">%%1%%</span>
          <span class=\"informace_polozka_faktury_mnozstvi\">%%2%%</span>
          <span class=\"informace_polozka_faktury_cenajm\">%%3%%</span>
          <span class=\"informace_polozka_faktury_slevajm\">%%4%%</span>
          <span class=\"informace_polozka_faktury_cenacelkem\">%%5%%</span>
          <span class=\"informace_polozka_faktury_slevacelkem\">%%6%%</span>
          <span class=\"informace_polozka_faktury_koncovacena\">%%7%% Kč</span>
        </span>\n",

                  "admin_infofac" => "
<div id=\"dynamicke_faktury_informace_faktura\">
  <h3>Informace o faktuře [<strong>%%1%%</strong>]</h3>
  <p class=\"backlink_faktury\">
    <a href=\"%%27%%\" title=\"Zpět na výpis faktur\">Zpět na výpis faktur</a>
  </p>
  <ul>
    <li class=\"informace_cislo_faktury\">FAKTURA č. %%1%%</li>
    <li class=\"informace_zakaznik\">
      <strong>Zákazník</strong>
      <p>%%2%%</p>
      <p>%%3%%</p>
      <p>IČ: %%5%%</p>
      <p>DIČ: %%4%%</p>
      <strong>Adresa zákazníka</strong>
      <p>%%6%%</p>
      <p>%%7%%</p>
      <p>%%8%%</p>
    </li>
    <li class=\"informace_zakladni_udaje\">
      <strong>Základní údaje</strong>
      <p>Datum vystavení: <em>%%9%%</em></p>
      <p>Datum splatnosti: <em>%%10%%</em></p>
      <p>Stav faktury: <em>%%11%%</em></p>
      <p>Typ platby: <em>%%12%%</em></p>
      <p>Variabilní symbol: <em>%%13%%</em></p>
      <p>Konstantní symbol: <em>%%14%%</em></p>
    </li>
    <li class=\"informace_polozky_faktury\">
      <strong>Položky faktury</strong>
      <p>Nadpis položek: <em>%%15%%</em></p>
      <p>
        <span class=\"informace_obal_polozek_faktury informace_obal_polozek_faktury_zahlavi\">
          <span class=\"informace_polozka_faktury_nazev\">Název položky</span>
          <span class=\"informace_polozka_faktury_mnozstvi\">Množství</span>
          <span class=\"informace_polozka_faktury_cenajm\">J.cena</span>
          <span class=\"informace_polozka_faktury_slevajm\">J.sleva</span>
          <span class=\"informace_polozka_faktury_cenacelkem\">Cena celkem</span>
          <span class=\"informace_polozka_faktury_slevacelkem\">Sleva celkem</span>
          <span class=\"informace_polozka_faktury_koncovacena\">Koncová cena</span>
        </span>
%%16%%      </p>
    </li>
    <li class=\"informace_souhrnne_informace\">
      <strong>Souhrnné informace</strong>
      <p>Koncová cena celkem bez slevy: <em>%%17%% Kč</em></p>
      <p>Sleva celkem: <em>%%18%% Kč</em></p>
      <p>Koncová cena celkem: <em>%%19%% Kč</em></p>
      <p>Poznámka [1]: <em>%%20%%</em></p>
      <p>Poznámka [2]: <em>%%21%%</em></p>
      <p>Poznámka [3]: <em>%%22%%</em></p>
      <p>Poznámka [4]: <em>%%23%%</em></p>
    </li>
    <li class=\"informace_souhrnne_informace\">
      <strong>Informace o vytvoření / upravení faktury</strong>
      <p>Datum / čas vytvoření faktury: <em>%%24%%</em></p>
      <p>Datum / čas upravení faktury: <em>%%25%%</em></p>
      <p>Datum / čas vytisknutí faktury: <em>%%26%%</em></p>
    </li>
  </ul>
</div>\n",

                  "admin_infofac_full_tvar_datum_null" => "Faktura nebyla zatím upravena",

                  "admin_infofac_vytisknuto_null" => "Faktura nebyla zatím vytisknuta",

                  "admin_pdf_tvar_datum" => "d.m.Y",

                  "admin_pdf_vypis" => "
<div id=\"obal_zakladni_udaje\"></div>
<div id=\"levy_zakladni_udaje\">
  <div id=\"dodavatel_udaje_div\">
    <p class=\"dodavatel_udaj_odstavec_nadpis\">Dodavatel:</p>
    <p class=\"dodavatel_udaj_dodavatel\">Martin Fryšták</p>
    <p class=\"dodavatel_udaj_dodavatel\">Na Valtické 31</p>
    <p class=\"dodavatel_udaj_dodavatel\">691 41&nbsp;&nbsp;Břeclav</p>
    <p class=\"dodavatel_udaj_ostatni dodavatel_udaj_ostatni_prvni\">IČ: 76376249</p>
    <p class=\"dodavatel_udaj_ostatni\">E-mail: gfdesign@gfdesign.cz</p>
    <p class=\"dodavatel_udaj_ostatni\">www.gfdesign.cz</p>
    <div class=\"dodavatel_udaj_forma_uhrady\">
      <table>
        <tr>
          <td id=\"dodavatel_udaj_forma_uhrady_nazev\">Forma úhrady:</td>
          <td id=\"dodavatel_udaj_forma_uhrady_hodnota\">%%13%%</td>
        </tr>
      </table>
    </div>
    <div class=\"dodavatel_udaj_datum_vystaveni\">
      <table>
        <tr>
          <td id=\"dodavatel_udaj_datum_vystaveni_nazev\">Datum vystavení:</td>
          <td id=\"dodavatel_udaj_datum_vystaveni_hodnota\">%%10%%</td>
        </tr>
      </table>
    </div>
    <div class=\"dodavatel_udaj_datum_splatnosti\">
      <table>
        <tr>
          <td id=\"dodavatel_udaj_datum_splatnosti_nazev\">Datum splatnosti:</td>
          <td id=\"dodavatel_udaj_datum_splatnosti_hodnota\">%%11%%</td>
        </tr>
      </table>
    </div>
    <p class=\"dodavatel_udaj_informace_dph\">Dodavatel není plátce DPH</p>
  </div>
</div>
<div id=\"dodavatel_cislo_uctu\">
  <table>
    <tr>
      <td id=\"dodavatel_cislo_uctu_nazev\">Číslo účtu:</td>
      <td id=\"dodavatel_cislo_uctu_cislo\">670100-2208162737&nbsp;&nbsp;6210</td>
    </tr>
  </table>
</div>
<div id=\"oddelovac_dodavatel_cislo_uctu\"></div>
<p id=\"gf_logo_faktura_perpetua\">GF</p>
<p id=\"gf_logo_faktura_dali\">design</p>
<div id=\"pravy_zakladni_udaje\">
  <div id=\"odberatel_udaje_div_symboly\">
    <div class=\"odberatel_udaj_variabilni_symbol\">
      <table>
        <tr>
          <td>Variabilní symbol:</td>
          <td class=\"odberatel_udaje_symboly_hodnota\">%%14%%</td>
        </tr>
      </table>
    </div>
    <div>
      <table>
        <tr>
          <td>Konstantní symbol:</td>
          <td class=\"odberatel_udaje_symboly_hodnota\">%%15%%</td>
        </tr>
      </table>
    </div>
  </div>
  <div id=\"odberatel_udaje_div\">
    <div id=\"odberatel_udaje_nazev_ic_dic\">
      <table>
        <tr>
          <td class=\"odberatel_udaje_nazev_ic_dic_nazev\">Odběratel:</td>
          <td>IČ:</td>
          <td class=\"odberatel_udaje_nazev_ic_hodnota\">%%6%%</td>
        </tr>
        <tr>
          <td class=\"odberatel_udaje_nazev_ic_dic_nazev\"></td>
          <td>DIČ:</td>
          <td class=\"odberatel_udaje_nazev_dic_hodnota\">%%5%%</td>
        </tr>
      </table>
    </div>
    <div id=\"odberatel_udaje_adresa\">
      <p class=\"odberatel_udaje_adresa_firma\">%%3%%</p>
      <p class=\"odberatel_udaje_adresa_jednatel\">%%4%%</p>
      <p class=\"odberatel_udaje_adresa_ulice_cp\">%%7%%</p>
      <p class=\"odberatel_udaje_adresa_psc_mesto\">%%9%%&nbsp;&nbsp;%%8%%</p>
    </div>
  </div>
</div>
<div id=\"zapati_vystavil_prevzal_informace_obal\"></div>
<div id=\"zapati_vystavil_informace\">
  <p class=\"zapati_vystavil_informace_tucne_upozorneni\">%%17%%</p>
  <p class=\"zapati_vystavil_informace_tucne_upozorneni\">%%18%%</p>
  <p class=\"zapati_vystavil_informace_male_informace\">%%19%%</p>
  <p class=\"zapati_vystavil_informace_male_informace\">%%20%%</p>
</div>
<div id=\"zapati_prevzal_obal\"></div>
<div id=\"zapati_prevzal\">Převzal:</div>
<div id=\"zapati_razitko\">Razítko:</div>
<div id=\"zahlavi_polozky\">
  <table id=\"zahlavi_polozky_table\">
    <tr>
      <td class=\"zahlavi_polozka_central polozka_oznaceni\">Označení položky</td>
      <td class=\"zahlavi_polozka_central polozka_mnozstvi\">Množství</td>
      <td class=\"zahlavi_polozka_central polozka_jcena\">J.cena</td>
      <td class=\"zahlavi_polozka_central polozka_sleva\">Sleva</td>
      <td class=\"zahlavi_polozka_central polozka_cena\">Cena</td>
      <td class=\"zahlavi_polozka_central polozka_celkemkc\">Kč Celkem</td>
    </tr>
  </table>
</div>
<div id=\"obsah_polozky\">
  <table id=\"obsah_polozky_table\">
    <tr>
      <td class=\"hlavni_nazev_polozek\" colspan=\"6\">%%16%%</td>
    </tr>\n",

                  "admin_pdf_vypis_row" => "
    <tr>
      <td class=\"obsah_polozky_central polozka_oznaceni\">%%1%%</td>
      <td class=\"obsah_polozky_central polozka_mnozstvi\">%%2%%</td>
      <td class=\"obsah_polozky_central polozka_jcena\">%%3%%,00</td>
      <td class=\"obsah_polozky_central polozka_sleva\">%%6%%,00</td>
      <td class=\"obsah_polozky_central polozka_cena\">%%5%%,00</td>
      <td class=\"obsah_polozky_central polozka_celkemkc\">%%7%%,00</td>
    </tr>\n",

                  "admin_pdf_vypis_end" => "
  </table>
  <table id=\"soucty_polozek_table\">
    <tr>
      <td class=\"obsah_polozky_central polozka_oznaceni\">Součet položek</td>
      <td class=\"obsah_polozky_central polozka_mnozstvi\"></td>
      <td class=\"obsah_polozky_central polozka_jcena\"></td>
      <td class=\"obsah_polozky_central polozka_sleva\">%%2%%,00</td>
      <td class=\"obsah_polozky_central polozka_cena\">%%1%%,00</td>
      <td class=\"obsah_polozky_central polozka_celkemkc\">%%3%%,00</td>
    </tr>
    <tr>
      <td class=\"celkem_k_uhrade_nazev\" colspan=\"5\">CELKEM K ÚHRADĚ</td>
      <td class=\"celkem_k_uhrade_hodnota\">%%3%%,00</td>
    </tr>
  </table>
  <p id=\"odstavec_vystavil\">Vystavil:</p>
</div>
<div id=\"hlavni_obal\">
  <h1 id=\"nadpis_cislo_h1\">FAKTURA č. %%4%%</h1>
</div>\n",

                  "admin_pdf_vypis_header" => "",

                  "admin_pdf_vypis_footer" => "",
                  //bez *.pdf, koncovka se doplni sama
                  "admin_pdf_vypis_cesta" => "Faktura_%%2%%",

                  //bez *.css, koncovka se doplni sama, cesta musi existovat!
                  "admin_pdf_vypis_cssfile" => "%%2%%/mpdf",

                  "admin_pdf_vypis_title" => "GF Design - Faktura",

                  "admin_pdf_vypis_author" => "GF Design - Tvorba webových stránek a systémů",

                  "admin_pdf_vypis_subject" => "Faktura číslo: %%2%%",

                  "admin_pdf_vypis_creator" => "Created by GFdesign",

                  "admin_pdf_vypis_keywords" => "---",

                  //true = save as, false = force
                  "admin_pdf_vypis_save_style" => true,

                  "admin_pdf_page_first" => 20,

                  "admin_pdf_page_other" => 25,

                  "admin_stat_faktur_tvar_datum" => "d.m.Y",

                  "admin_stat_faktur_mesicname" => array ("",
                                                          "Leden",
                                                          "Únor",
                                                          "Březen",
                                                          "Duben",
                                                          "Květen",
                                                          "Červen",
                                                          "Červenec",
                                                          "Srpen",
                                                          "Září",
                                                          "Říjen",
                                                          "Listopad",
                                                          "Prosinec"),

                  "admin_stat_faktur_start_year" => 2009, //pocetacni rok

                  "admin_stat_faktur_begin" => "
<div id=\"dynamicke_faktury_vypis_statistik\">
  <h3>Výpis statistik</h3>\n",

                  "admin_stat_faktur_rok_begin" => "
<div class=\"dynamicke_faktury_statistiky_rok_obal\">
  <p class=\"dynamicke_faktury_statistiky_rok\">Rok <strong>%%1%%</strong></p>\n",

                  "admin_stat_faktur_mesic_begin" => "
<ul class=\"vypis_mesicu_statistiky\">
  <li class=\"nazev_mesice_central nazev_mesice_cislo_%%1%%\">%%2%%</li>\n",

                  "admin_stat_faktur_row" => "
  <li class=\"statistika_faktura_polozka\">
    <p>Číslo faktury: <strong>%%1%%</strong></p>
    <p>Zákazník: <strong>%%2%%</strong></p>
    <p>Datum vystavení: <strong>%%3%%</strong></p>
    <p>Datum splatnosti: <strong>%%4%%</strong></p>
    <p>Stav faktury: <strong>%%5%%</strong></p>
    <p>Typ platby: <strong>%%6%%</strong></p>
    <p>Koncová cena celkem: <strong>%%9%%,00 Kč</strong></p>
    <a href=\"%%10%%\" title=\"Informace o faktuře [%%1%%]\">Informace o faktuře <strong>%%1%%</strong></a>
  </li>\n",

                  "admin_stat_faktur_row_null" => "
  <li class=\"mesicni_statistika_nula\">0,00 Kč</li>\n",

                  "admin_stat_faktur_mesic_end" => "
  <li class=\"mesicni_statistika\">%%3%%,00 Kč</li>
</ul>\n",

                  "admin_stat_faktur_rok_end" => "
  <p class=\"rocni_statistika\">%%2%%,00 Kč</p>
</div>\n",

                  "admin_stat_faktur_end" => "</div>",

                  "admin_stat_faktur_all" => "<p id=\"hlavni_statistika\">Od období <em>%%1%%</em> do <em>%%2%%</em> byl příjem <strong>%%3%%,00 Kč</strong></p>",
                  );

  return $result;
?>
