<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Status projektů",
                                              "title" => "Status projektů",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => false),

                                        array("main_href" => "%%1%%%%2%%",
                                              "odkaz" => "Status projektů - statistiky",
                                              "title" => "Status projektů - statistiky",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => false),
                                        ),

                  "normal_stat_login_1" => "

<form method=\"post\" action=\"\">
<fieldset>
<label class=\"input_text\">
<span>Login:</span>
<input type=\"text\" name=\"%%1%%\" />
</label>
<label class=\"input_text\">
<span>Heslo:</span>
<input type=\"password\" name=\"%%2%%\" />
</label>
<label class=\"submit\">
<input type=\"submit\" name=\"%%3%%\" value=\"prihlasit se\" />
</label>
</fieldset>
</form>

                  ",

                  "normal_stat_class_true_1" => "prihlaseno",

                  "normal_stat_class_false_1" => "neprihlaseno",

                  "normal_stat_wrong_login_1" => "špatne udaje",

                  "normal_stat_grafika_null_1" => "žádný záznam u grafika",

                  "normal_stat_kod_null_1" => "žádný záznam u kodu",

                  "normal_stat_program_null_1" => "žádný záznam u programu",

                  "normal_stat_tvar_datum_1" => "d.m.Y",

                  "normal_stat_vypis_1" => "

%%1%% - (1)<br />
%%2%% - (2)<br />
%%3%% - (3)<br />
%%4%% - (4)<br />
%%5%% - (5)<br />
%%6%% - (6)<br />
%%7%% - (7)<br />
%%8%% - (8)<br />
%%9%% - (9)<br />
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

                  ",

                  "admin_obsah" => "
<div class=\"status_projektu_vypis_projektu\">
  <h3>Status projektů</h3>
  <p class=\"odkaz_pridat\">
    <a href=\"%%1%%\" title=\"Přidat projekt\">Přidat projekt</a>
  </p>
%%2%%
</div>\n",

                  "admin_proj_tvar_datum" => "d.m.Y",

                  "admin_addproj_default" => array ("",
                                                    "",
                                                    "",
                                                    "",
                                                    "",
                                                    "",
                                                    "1",
                                                    "",
                                                    "",
                                                    "",
                                                    "1",
                                                    ),

                  "admin_addproj_name" => "Přidat projekt",

                  "admin_editproj_name" => "Upravit projekt",

                  "admin_addeditproj" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\" src=\"%%2%%\"></script>
<script type=\"text/javascript\">
  $(function() {
    $('#iddatezac').datepicker({
      dateFormat: 'dd.mm.yy',
      altField: '#iddodzac',
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
  $(function() {
    $('#iddatekon').datepicker({
      dateFormat: 'dd.mm.yy',
      altField: '#iddodkon',
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
  function AutoRun()
  {
    $('#iddatekon').attr('disabled', '%%10%%');
  }
  window.setTimeout(\"AutoRun();\", 10);
</script>
<div class=\"status_projektu_add_edit\">
  <h3>%%15%%</h3>
  <p class=\"backlink_status\">
    <a href=\"%%16%%\" title=\"Zpět na výpis projektů\">Zpět na výpis projektů</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Název projektu:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%3%%\" />
        <span class=\"status_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_textarea\">
        <span>Popis projektu:</span>
        <textarea name=\"popis\" rows=\"30\" cols=\"80\">%%4%%</textarea>
      </label>
      <label class=\"input_text\">
        <span>Login:</span>
        <input type=\"text\" name=\"login\" value=\"%%5%%\" />
        <span class=\"status_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Heslo:</span>
        <input type=\"text\" name=\"heslo\" value=\"%%6%%\" />
        <span class=\"status_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Cena projektu:</span>
        <input type=\"text\" name=\"cena\" value=\"%%7%%\" />
        <span class=\"status_dodatek\">,- Kč se doplní - zadávej jen číslo.</span>
      </label>
      <label class=\"input_text datepicker\">
        <span>Datum zadání projektu:</span>
        <input type=\"text\" name=\"zacatek\" value=\"%%8%%\" id=\"iddatezac\" />
        <input type=\"text\" id=\"iddodzac\" class=\"dateinputpicker\" />
        <span class=\"status_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text datepicker\">
        <span>Datum dokončení projektu:</span>
        <input type=\"text\" name=\"konec\" value=\"%%9%%\" id=\"iddatekon\" />
        <input type=\"text\" id=\"iddodkon\" class=\"dateinputpicker\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Pracuje se na projektu:</span>
        <input type=\"checkbox\" name=\"aktivni\"%%10%% onclick=\"$('#iddatekon').attr('disabled', this.checked);\" />
        <span class=\"status_dodatek\">Jestliže se na projektu nepracuje, tak se zákazníkův login zablokuje.</span>
      </label>
      <label class=\"input_text skryty_element\">
        <span>id:</span>
        <input type=\"text\" name=\"href_id\" value=\"%%11%%\" />
      </label>
      <label class=\"input_text skryty_element\">
        <span>class:</span>
        <input type=\"text\" name=\"href_class\" value=\"%%12%%\" />
      </label>
      <label class=\"input_text skryty_element\">
        <span>akce:</span>
        <input type=\"text\" name=\"href_akce\" value=\"%%13%%\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Zobrazit v menu:</span>
        <input type=\"checkbox\" name=\"zobrazit\"%%14%% />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"%%15%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_addproj_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl přidán projekt: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editproj_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl upraven projekt: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delproj_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl smazán projekt: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_vypis_obsah_begin" => "
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
        var order = $(this).sortable(\"serialize\") + '&action=updateprojekt';
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
<div class=\"obal_vypis_projektu\">
<div class=\"obal_razeni\">\n",

                  "admin_vypis_obsah" => "
<ul id=\"arrayprojekts_%%1%%\">
  <li>[%%15%%] - [%%1%%] - <strong>%%2%%</strong></li>
  <li class=\"podrobnosti_projektu\">
    Stav projektu: <em>%%8%%</em>
  </li>
  <li class=\"podrobnosti_projektu\">
    Datum zadání projektu: <em>%%6%%</em>
  </li>
  <li class=\"podrobnosti_projektu\">
    Cena projektu: <em>%%5%%,- Kč</em>
  </li>
  <li class=\"podrobnosti_projektu\">
    <em class=\"em_input\">Pracuje se na projektu:</em><input type=\"checkbox\" disabled=\"disabled\"%%13%% />
  </li>
  <li class=\"podrobnosti_projektu\">
    <em class=\"em_input\">Zobrazit v menu:</em><input type=\"checkbox\" disabled=\"disabled\"%%14%% />
  </li>
  <li class=\"odkazy_vypis_projektu\">
    <a href=\"%%16%%\" title=\"Upravit projekt\">Upravit projekt</a> - <a href=\"%%17%%\" title=\"Smazat projekt\" onclick=\"return confirm('Opravdu chceš smazat projekt: &quot;%%2%%&quot; ?');\">Smazat projekt</a>
  </li>
</ul>\n",

                  "admin_vypis_obsah_end" => "<div id=\"status_drag\"></div></div></div>\n",

                  "admin_vypis_obsah_null" => "<strong class=\"zadna_polozka\">Není vytvořena žádná šablona</strong>",

                  "ajax_update_projekts" => "Byl proveden přesun mezi položkami.",

                  "admin_obsah_projekt" => "
<div class=\"status_projektu_samotny_projekt\">
  <h3>%%1%%</h3>
  <p class=\"popis_projektu\">
    %%2%%
  </p>
  <div class=\"status_informace\">
    <p>Stav projektu: <strong>%%7%%</strong></p>
    <p>Datum zadání projektu: <strong>%%5%%</strong></p>
    <p>Datum dokončení projektu: <strong>%%6%%</strong></p>
    <p>Cena projektu: <strong>%%4%%,- Kč</strong></p>
    <p class=\"posledni_informace\">Kolik dní se na projektu pracuje: <strong>%%8%%</strong></p>
    <p>• <a href=\"%%18%%\" title=\"Logování zákazníků\">Logování zákazníků</a></p>
    <p>• <a href=\"%%19%%\" title=\"Statistiky projektu\">Statistiky projektu</a></p>
  </div>
  <div class=\"ovladaci_panel\">
    <p>
      <a href=\"%%9%%\" title=\"Grafik\">Grafik</a>
      <span class=\"status_progress\">
        <span style=\"width: %%12%%%;\"><!-- --></span>
        <em>%%12%%%</em>
      </span>
      <span class=\"status_zaznam\">
        • %%13%%
      </span>
    </p>
    <p>
      <a href=\"%%10%%\" title=\"Webmaster\">Webmaster</a>
      <span class=\"status_progress\">
        <span style=\"width: %%14%%%;\"><!-- --></span>
        <em>%%14%%%</em>
      </span>
      <span class=\"status_zaznam\">
        • %%15%%
      </span>
    </p>
    <p>
      <a href=\"%%11%%\" title=\"Programátor\">Programátor</a>
      <span class=\"status_progress\">
        <span style=\"width: %%16%%%;\"><!-- --></span>
        <em>%%16%%%</em>
      </span>
      <span class=\"status_zaznam\">
        • %%17%%
      </span>
    </p>
  </div>
</div>\n",

                  "admin_obsah_projekt_konec_null" => "•• •• ••••",

                  "admin_obsah_projekt_run" => "Pracuje se na projektu",

                  "admin_obsah_projekt_pauze" => "Projekt pozastaven",

                  "admin_obsah_projekt_finish" => "Projekt dokončen",

                  "admin_obsah_projekt_grafika_null" => "Žádný záznam",

                  "admin_obsah_projekt_kod_null" => "Žádný záznam",

                  "admin_obsah_projekt_program_null" => "Žádný záznam",

                  "admin_obsah_projekt_grafika" => "grafika",

                  "admin_obsah_projekt_kod" => "webmastera",

                  "admin_obsah_projekt_program" => "programátora",

                  "admin_obsah_projekt_choice" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\" src=\"%%2%%\"></script>
<script type=\"text/javascript\" src=\"%%3%%/script/jslider/jquery.dependClass.js\"></script>
<script type=\"text/javascript\" src=\"%%3%%/script/jslider/jquery.slider-min.js\"></script>
<script type=\"text/javascript\" src=\"%%3%%/script/wymeditor/jquery.wymeditor.min.js\"></script>
<script type=\"text/javascript\" src=\"%%3%%/script/wymeditor/plugins/fullscreen/jquery.wymeditor.fullscreen.js\"></script>
<script type=\"text/javascript\" src=\"%%3%%/script/wymeditor/plugins/hovertools/jquery.wymeditor.hovertools.js\"></script>
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
    $(\".wym_classes, .wym_tools_ordered_list, .wym_tools_unordered_list, .wym_tools_indent, .wym_tools_outdent, .wym_tools_table, .wym_tools_paste, .wym_containers_h1, .wym_containers_h2, .wym_containers_h3, .wym_containers_h4, .wym_containers_h5, .wym_containers_h6, .wym_containers_pre, .wym_containers_blockquote, .wym_containers_th\").css({
      'display': 'none'
    });
  });
  $(function() {
    $('.jslider').slider2({
      from: 0,
      to: 100,
      step: 1,
      round: 0,
      dimension: ' %',
      limits: false,
      scale: [0, '10', '20', '30', '40', '50', '60', '70', '80', '90', 100]
    });
  });
</script>
<div class=\"status_projektu_cinnost\">
  <h3>Práce %%4%% na projektu %%9%%</h3>
  <p class=\"backlink_status\">
    <a href=\"%%10%%\" title=\"Zpět na projekt %%9%%\">Zpět na projekt %%9%%</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <div class=\"input_jslider\">
        <span class=\"status_nadpis_input\">Postup práce %%4%% v procentech:</span>
        <input type=\"text\" name=\"%%5%%\" class=\"jslider\" value=\"%%7%%\" />
      </div>
      <div class=\"input_wymeditor\">
        <span class=\"status_nadpis_input\">Momentální práce %%4%%:</span>
        <textarea name=\"%%6%%\" class=\"wymeditor\">%%8%%</textarea>
      </div>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" class=\"wymupdate\" value=\"Uložit práci %%4%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_obsah_projekt_null" => "Špatná volba projektu",

                  "admin_obsah_projekt_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla uložena práce: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_clearlog_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Bylo promazáno logování zákazníků, smazáno řádků: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_log_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_log_begin_clear" => "<a href=\"%%2%%\" title=\"Promazat logování zákazníků na projektu %%1%%\" onclick=\"return confirm('Opravdu chceš promazat logování zákazníků na projektu: &quot;%%1%%&quot; ?');\" class=\"odkaz_vpravo\">Promazat logování zákazníků</a>",

                  "admin_vypis_log_begin" => "
<div class=\"status_projektu_logovani_zakazniku\">
  <h3>Logování zákazníků na projektu %%1%%</h3>
  <p class=\"backlink_status\">
    <a href=\"%%2%%\" title=\"Zpět na projekt %%1%%\">Zpět na projekt %%1%%</a>
    %%3%%
  </p>\n",

                  "admin_vypis_log" => "
<p class=\"zakaznik_log\">
  [%%1%%] - %%2%%
  <span>%%3%% • %%4%% • %%5%%</span>
</p>\n",

                  "admin_vypis_log_null" => "<p class=\"samotna_statistika\"><strong>Žádné statistiky</strong></p>",

                  "admin_vypis_log_end" => "</div>",

                  "admin_stat_log_count_ip" => "<p class=\"zanorena_statistika\">Z IP: <strong>%%1%%</strong> byl počet vstupů: <strong>%%2%%</strong></p>",

                  "admin_stat_log_count_ip_null" => "<p class=\"zanorena_statistika\">Žádné IP</p>",

                  "admin_stat_log_count_brow" => "<p class=\"zanorena_statistika\">Z prohlížeče: <strong>%%1%%</strong> byl počet vstupů: <strong>%%2%%</strong></p>",

                  "admin_stat_log_count_brow_null" => "<p class=\"zanorena_statistika\">Žádný prohlížeč</p>",

                  "admin_stat_log_count_os" => "<p class=\"zanorena_statistika\">Z operačního systému: <strong>%%1%%</strong> byl počet vstupů: <strong>%%2%%</strong></p>",

                  "admin_stat_log_count_os_null" => "<p class=\"zanorena_statistika\">Žádný operační systém</p>",

                  "admin_stat_log_count_osbrow" => "<p class=\"zanorena_statistika\">Z operačního systému: <strong>%%2%%</strong> a prohlížeče <strong>%%1%%</strong> byl počet vstupů: <strong>%%3%%</strong></p>",

                  "admin_stat_log_count_osbrow_null" => "<p class=\"zanorena_statistika\">Žádný operační systém s prohlížečem</p>",

                  "admin_stat_log_count_datum" => "<p class=\"zanorena_statistika\">Za den <strong>%%1%%</strong> byl počet vstupů: <strong>%%2%%</strong></p>",

                  "admin_stat_log_count_datum_tvar" => "d.m.Y",

                  "admin_stat_log_count_datum_null" => "<p class=\"zanorena_statistika\">Žádné datum</p>",

                  "admin_stat_log_projekt" => "
<div class=\"status_projektu_statistiky_projektu\">
  <h3>Statistika projektu %%1%%</h3>
  <p class=\"backlink_status\">
    <a href=\"%%17%%\" title=\"Zpět na projekt %%1%%\">Zpět na projekt %%1%%</a>
  </p>
  <p class=\"samotna_statistika\">Počet přihlášení zákazníka: <strong>%%2%%</strong></p>
  <p class=\"samotna_statistika\">První přihlášení zákazníka: <strong>%%15%%</strong></p>
  <p class=\"samotna_statistika\">Poslední přihlášení zákazníka: <strong>%%16%%</strong></p>
  <p class=\"samotna_statistika\">Seznam zalogovaných IP:</p>
  %%3%%
  <p class=\"samotna_statistika\">Seznam zalogovaných Prohlížečů:</p>
  %%4%%
  <p class=\"samotna_statistika\">Seznam zalogovaných operačních systémů:</p>
  %%5%%
  <p class=\"samotna_statistika\">Seznam zalogovaných operačních systémů s prohlížeči:</p>
  %%6%%
  <p class=\"samotna_statistika\">Počet přihlášení zákazníka za den:</p>
  %%7%%
  <p class=\"samotna_statistika\">Počet fází práce grafika: <strong>%%8%%</strong></p>
  <p class=\"samotna_statistika\">Poměr popisků vůči postupu práce grafika: <strong>%%9%%</strong></p>
  <p class=\"samotna_statistika\">Počet fází práce webmastera: <strong>%%10%%</strong></p>
  <p class=\"samotna_statistika\">Poměr popisků vůči postupu práce webmastera: <strong>%%11%%</strong></p>
  <p class=\"samotna_statistika\">Počet fází práce programátora: <strong>%%12%%</strong></p>
  <p class=\"samotna_statistika\">Poměr popisků vůči postupu práce programátora: <strong>%%13%%</strong></p>
  <p class=\"samotna_statistika\">Celkový průběh projektu: <strong>%%14%%%</strong></p>
</div>\n",

                  "admin_stat_log" => "
<div class=\"status_projektu_statistiky_projektu\">
  <h3>Status projektů - statistiky</h3>
  <p class=\"samotna_statistika\">Počet projektů: <strong>%%1%%</strong></p>
  <p class=\"samotna_statistika\">Počet rozpracovaných projektů: <strong>%%3%%</strong></p>
  <p class=\"samotna_statistika\">Počet pozastavených projektů: <strong>%%2%%</strong></p>
  <p class=\"samotna_statistika\">Počet dokončených projektů: <strong>%%4%%</strong></p>
  <p class=\"samotna_statistika\">Seznam zalogovaných IP:</p>
  %%5%%
  <p class=\"samotna_statistika\">Seznam zalogovaných Prohlížečů:</p>
  %%6%%
  <p class=\"samotna_statistika\">Seznam zalogovaných operačních systémů:</p>
  %%7%%
  <p class=\"samotna_statistika\">Seznam zalogovaných operačních systémů s prohlížeči:</p>
  %%8%%
  <p class=\"samotna_statistika\">Počet přihlášených zákazníků za den:</p>
  %%9%%
  <p class=\"samotna_statistika\">Počet zalogovaných zákazníků na projektech:</p>
  %%10%%
  <p class=\"samotna_statistika\">Datum zadání prvního projektu: <strong>%%11%%</strong></p>
  <p class=\"samotna_statistika\">Datum zadání posledního projektu: <strong>%%12%%</strong></p>
  <p class=\"samotna_statistika\">Nejmenší cena projektu: <strong>%%13%%,- Kč</strong></p>
  <p class=\"samotna_statistika\">Největší cena projektu: <strong>%%14%%,- Kč</strong></p>
  <p class=\"samotna_statistika\">Průměrná cena projektu: <strong>%%15%%,- Kč</strong></p>
  <p class=\"samotna_statistika\">Celková cena všech projektu: <strong>%%16%%,- Kč</strong></p>
</div>\n",

                  "admin_stat_log_datum_tvar" => "d.m.Y",

                  "admin_stat_log_count_log" => "<p class=\"zanorena_statistika\">Na projektu <strong>%%1%%</strong> bylo zalogováno vstupů: <strong>%%2%%</strong></p>",

                  "admin_stat_log_count_log_null" => "<p class=\"zanorena_statistika\">Žádné zalogované vstupy</p>",

                  );

  return $result;
?>
