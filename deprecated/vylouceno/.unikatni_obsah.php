<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamické přihlašování",
                                              "title" => "%%2%%",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%1%%%%3%%",
                                              "odkaz" => "Řazení menu (DP)",
                                              "title" => "Řazení menu (DP)",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => false),
                                        ),

                  "admin_tvar_menu_odkaz" => "%%1%%",

                  "admin_tvar_menu_title" => "%%1%%",

                  "admin_default_title" => "Dynamické přihlašování",



                  "normal_ajax_tvar_datum_1" => "j.n.Y H:i:s",

                  "normal_ajax_currcap_1" => "

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


kapacita: <strong>%%1%%</strong> míst<br />
rezerva kapacity: <strong>%%2%%</strong> míst<br />
celkově: <strong>%%3%%</strong> míst<br />
aktivních: <strong>%%4%%</strong> míst<br />
zbývá volných míst: <strong>%%5%%</strong> míst<br />
čas aktualizace: <strong>%%6%%</strong><br />



                  ",


                  "normal_tvar_datum_1" => "j.n.Y H:i:s",

                  "normal_vypis_vsechny_registrace_reg_on_1" => "Registrace otevřena",

                  "normal_vypis_vsechny_registrace_reg_off_1" => "Registrace uzavřena",

                  "normal_vypis_vsechny_registrace_open_1" => "volné místa",

                  "normal_vypis_vsechny_registrace_close_1" => "plno..",

                  "normal_vypis_vsechny_registrace_css_skryvani_1" => "!!!skryt!!!",

                  "normal_vypis_vsechny_registrace_1" => "






%%1%% - 1<br />
%%2%% - 2<br />
%%3%% - 3<br />
%%4%% - 4<br />
%%5%% - 5<br />
%%6%% - 6<br />
%%7%% - 7<br />
%%8%% - 8<br />
%%9%% - 9<br />
%%10%% - 10<br />
%%11%% - 11<br />
%%12%% - 12<br />
%%13%% - 13<br />
%%14%% - 14<br />
%%15%% - 15<br />
%%16%% - 16<br />
%%17%% - 17<br />
%%18%% - 18<br />
%%19%% - 19<br />
<a href=\"%%1%%registrace/%%3%%\">akce: %%15%%</a><br />
<br />

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


                  ",


//  <script type=\"text/javascript\" src=\"%%1%%%%2%%/script/jquery-1.3.2.min.js\"></script>
                  "normal_vypis_registrace_1" => "





  <script type=\"text/javascript\" src=\"%%1%%%%2%%/script/ajax.js\"></script>
  <script type=\"text/javascript\">
    window.setInterval(\"Kontrola()\", 5000);
    function Kontrola()
    {
      AktualniKapacita(%%3%%, %%6%%, 1, '.aktkap');
    }
    Kontrola();
  </script>

(%%8%%)
  <form method=\"post\">
    <fieldset>
      <label>
        email: <input type=\"text\"%%10%%%%9%% />
      </label>
      <label>
        jmeno: <input type=\"text\"%%11%%%%9%% />
      </label>
      <label>
        prijmeni: <input type=\"text\"%%12%%%%9%% />
      </label>
      <br />
      <label>
        %%16%%
        captcha: <input type=\"text\"%%13%%%%9%% value=\"%%17%%\" />
      </label>
      <input type=\"submit\"%%14%%%%9%% value=\"registrovat se\" />
    </fieldset>
  </form>
  <span class=\"aktkap\"></span>

%%1%% - 1<br />
%%2%% - 2<br />
%%3%% - 3<br />
%%4%% - 4<br />
%%5%% - 5<br />
%%6%% - 6<br />
%%7%% - 7<br />
%%8%% - 8<br />
%%9%% - 9<br />
%%10%% - 10<br />
%%11%% - 11<br />
%%12%% - 12<br />
%%13%% - 13<br />
%%14%% - 14<br />
%%15%% - 15<br />
%% 16 %% - 16<br />
%%17%% - 17<br />
%%18%% - 18<br />
%%19%% - 19<br />
%%20%% - 20<br />
%%21%% - 21<br />
%%22%% - 22<br />
%%23%% - 23<br />
%%24%% - 24<br />


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
                  ",

                  "normal_registrace_email_header_1" => "%%1%%\nFrom: prednasky@kavarnajantar.cz",

                  "normal_registrace_email_subject_1" => "p&#345;edm&#283;t zpr&aacute;vy",

                  "normal_registrace_email_text_1" => "


text zpravy:<br />
%%1%% - 1<br />
%%2%% - 2<br />
email: %%3%% - 3<br />
jmeno: %%4%% - 4<br />
prijmeni: %%5%% - 5<br />
zadano: %%6%% - 6<br />
expirace: %%7%% - 7<br />
aktivace na: <a href=\"%%1%%%%8%%\">potvrzovací link</a> - 18<br />
%%9%% - 9<br />
%%10%% - 10<br />
prokazovací kod vám bude vygenerován a zaslan (on už vygenerovany je ale uživatel to vedět nemusi ;) ) až po ověření a aktivaci 'učtu'



                  ",

                  "normal_registrace_true_1" => "
                  uspěšně registrováno, odesláno na email: %%1%%,
                  pod jménem %%2%% %%3%%,
                  a máte čas na potvrzení do: %%4%%, pak emailu vypřší platnost
                  ",

                  "normal_registrace_autoclick_1" => false,

                  "normal_registrace_autoclick_time_1" => 5,  //s

                  "normal_registrace_email_send_error_1" => "email se neporařilo odeslat",

                  "normal_registrace_false_1" => "registrace se nezdarila<br />",

                  "normal_error_email_1" => "špatně email<br />",

                  "normal_error_jmeno_1" => "žádné jmeno<br />",

                  "normal_error_prijmeni_1" => "žádné příjmení<br />",

                  "normal_error_captcha_1" => "špatně captcha kod<br />",

                  "normal_error_duplikace_1" => "duplikátní registrace z jednoho mista je zakazana<br />",

                  "normal_error_duplikace_user_1" => "duplikátní registrace uživatele je zakazana<br />",

                  "normal_registrace_full_kapacita_1" => "kapacita je plná! i rezervní",

                  "normal_registrace_reg_datum_1" => "registrace uzavřena",

                  "normal_registrace_css_skryvani_1" => "deaktivní",



                  "normal_autorizace_autoclick_1" => false,

                  "normal_autorizace_autoclick_time_1" => 5,  //s

                  "normal_error_autorizace_1" => "zadaný učet vyexpiroval, aktivován, nebo byl smazán a nebo taky prostě neexistuje",

                  "normal_autorizace_true_1" => "hura, autorizovano, váš kód je: %%1%%, právě teď je ještě simultálně posálaný na váš email i s hroumadou spamu :D",

                  "normal_autorizace_full_kapacita_1" => "plná kapacita, i rezervní",

                  "normal_autorizace_reg_datum_1" => "registrace uzavřena",

                  "normal_autorizace_email_header_1" => "%%1%%\nFrom: email@email.cz",

                  "normal_autorizace_email_subject_1" => "předmět zprávy dokončení autorizace",

                  "normal_autorizace_email_text_1" => "
text zpravy:<br />
%%1%% - 1<br />
%%2%% - 2<br />
info na: <a href=\"%%1%%%%2%%\">info link</a> - 12<br />
%%3%% - 3<br />
%%4%% - 4<br />
%%5%% - 5<br />
%%6%% - 6<br />
%%7%% - 7<br />
%%8%% - 8<br />
%%9%% - 9<br />
%%10%% - 10<br />
                  ",

                  "normal_autorizace_email_send_error_1" => "neporařilo se odeslat email",


                  "normal_status_registrace_1" => "Váš kod je: %%1%%",












                  "admin_vypis_obsah_tvar_datum" => "d.m.Y H:i:s",

                  "admin_vypis_obsah_skupiny_open" => "Registrace otevřena",

                  "admin_vypis_obsah_skupiny_close" => "Registrace uzavřena",

                  "admin_vypis_obsah_skupiny_begin" => "
<div class=\"dynamicke_prihlasovani_vypis_uzivatelu\">
  <h3>%%3%%</h3>
  <p class=\"odkazy_registrace_uzivatele\">
    <a href=\"%%12%%\" title=\"Vytisknout PDF\">Vytisknout PDF</a>
    <span>
      <a href=\"%%13%%\" title=\"Smazat všechny uživatele\" onclick=\"return confirm('Opravdu chceš smazat všechny uživatele: &quot;%%3%%&quot; ?');\">Smazat všechny uživatele</a>
    </span>
  </p>
<script type=\"text/javascript\" src=\"%%2%%/script/jquery-1.3.2.min.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/jquery.listnav.min-2.1.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/ajax.js\"></script>
<script type=\"text/javascript\">
  $(function(){
    $('#sortovani').listnav();
  });
</script>
<ul class=\"zahlavi_registrace\">
  <li>Nastavený typ kontroly: <strong>%%4%%</strong></li>
  <li>Kapacita lidí: <strong>%%5%%</strong></li>
  <li>Rezerva v kapacitě: <strong>%%6%%</strong></li>
  <li>Celková kapacita (kapacita lidí s rezervou v kapacitě): <strong>%%7%%</strong></li>
  <li>Počet volných míst: <strong>%%10%%</strong></li>
  <li>Počet zaregistrovaných lidí: <strong>%%9%%</strong></li>
  <li>Počet potvrzených lidí: <strong>%%8%%</strong></li>
  <li>Stav registrace: <strong>%%11%%</strong></li>
</ul>
<div id=\"sortovani-nav\">
<ul id=\"sortovani\">\n",

                  "admin_vypis_obsah_skupiny" => "
<li><span class=\"urceni_sortovani\">%%20%% %%19%%</span>
  <ul class=\"registrovani_uzivatele%%14%%\" id=\"registrovani_uzivatele_id_%%1%%\">
    <li>Uživatel: <strong>%%4%% %%3%%</strong></li>
    <li>Uživatelův kód: <strong>%%5%%</strong></li>
    <li>Uživatelův email: <strong>%%2%%</strong></li>
    <li>Datum registrace uživatele: <strong>%%7%%</strong></li>
    <li>Datum vypršení uživatele, pokud není potvrzený: <strong>%%8%%</strong></li>
    <li>Datum potvrzení uživatele: <strong>%%9%%</strong></li>
    <li class=\"input_checkbox\"><em>Uživatel se zůčastnil:</em><span><input type=\"checkbox\"%%12%%%%13%% onclick=\"NastavHodnotu(%%1%%, this.checked, '.infospan%%1%%');\" /></span></li>
    <li class=\"input_checkbox\"><em>Potvrzený uživatel:</em><span><input type=\"checkbox\" disabled=\"disabled\"%%10%% /></span></li>
    <li class=\"odkazy_uzivatel\"><a href=\"%%16%%\" title=\"Informace o uživateli\">Informace o uživateli</a> - <a href=\"%%17%%\" title=\"Upravit uživatele\">Upravit uživatele</a> - <a href=\"%%18%%\" onclick=\"return confirm('Opravdu chceš smazat uživatele: \'%%3%% %%4%%\' ?');\" title=\"Smazat uživatele\">Smazat uživatele</a></li>
    <li class=\"info_zucastnil_se infospan%%1%%\"><!-- --></li>
    %%11%%
  </ul>
</li>\n",

                  "admin_vypis_obsah_aktivni_true" => "<li class=\"info_potvrzeny_uzivatel\" title=\"Uživatel je potvrzený\"><!-- --></li>",

                  "admin_vypis_obsah_aktivni_false" => "<li class=\"info_nepotvrzeny_uzivatel\" title=\"Uživatel není potvrzený\"><!-- --></li>",

                  "admin_vypis_obsah_ucast" => " zucastneny_uzivatel",

                  "admin_vypis_obsah_noexpire" => "Uživatel nebyl zatím potvrzen",

                  "ajax_update_setvalue" => "<strong>%%2%%</strong>",

                  "ajax_update_setvalue_true" => "Uživatel byl označen, že se zůčastnil",

                  "ajax_update_setvalue_false" => "Uživatel byl označen, že se nezůčastnil",

                  "admin_vypis_obsah_skupiny_null" => "<strong class=\"zadny_uzivatel\">Není registrovaný žádný uživatel</strong>",

                  "admin_vypis_obsah_skupiny_end" => "\n</ul>\n</div>\n</div>\n",


                  //zjistovani zeme
                  "ajax_zeme_notfound_1" => "<strong>Nebyla nalezena země</strong>",

                  "ajax_zeme_local_1" => "localhost",

                  "ajax_get_zeme_1" => "%%2%%",



                  "admin_vyber_prihlasovani_begin" => "        <select name=\"prihlasovani\">\n",

                  "admin_vyber_prihlasovani" => "          <option value=\"%%1%%\"%%2%%>%%3%% [%%4%%]</option>\n",

                  "admin_vyber_prihlasovani_end" => "        </select>",

                  "admin_vyber_prihlasovani_null" => "zadané prihlašování neexistuje",



                  "admin_seznam_trid_begin" => "<select name=\"trida\">\n  <option value=\"\">-- vyber --</option>\n",

                  "admin_seznam_trid_skupina_begin" => "<optgroup label=\"%%1%%\">\n",

                  "admin_seznam_trid" => "  <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_seznam_trid_skupina_end" => "</optgroup>\n\n",

                  "admin_seznam_trid_end" => "</select>\n",

                  //blokovane funkce, hlavne ty zdedene
                  "admin_seznam_trid_blokfunkce" => array("__construct",
                                                          "AdminObsah",
                                                          "AdminTitle",
                                                          "AdminMenu",
                                                          "InstalaceDatabaze",
                                                          "ExistujeTabulka",
                                                          "ChangeWrongChar",
                                                          "BackChangeChar",
                                                          "NastavKomunikaci",
                                                          "PripojeniDatabaze",
                                                          "ZavritDatabaze",
                                                          "ZjistiTypDB",
                                                          "queryExec",
                                                          "query",
                                                          "querySingle",
                                                          "numRows",
                                                          "fetch",
                                                          "fetchObject",
                                                          "fetchFields",
                                                          "lastInsertRowid",
                                                          "AktualniKodovani",
                                                          "beginTransaction",
                                                          "endTransaction",
                                                          "AktualniStatusDB",
                                                          "ZakodujText",
                                                          "DekodujText",
                                                          "NactiObsahSouboru",
                                                          "NactiUnikatniObsah",
                                                          "PrevodUnikatnihoTextu",
                                                          "NastavitAdresuMenu",
                                                          ),



                  "admin_vypis_tridy_begin" => "<select name=\"akceid\" onchange=\"document.location.href='%%1%%&amp;akceid='+this.value\">\n  <option value=\"\">-- vyber --</option>\n",

                  "admin_vypis_tridy" => "  <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_vypis_tridy_end" => "</select>\n",

                  "admin_vypis_tridy_error" => "<strong>špatná funkce!!</strong>",


                  //dane
                  "set_vyhodnoceni" => array ("Kontrola na aktivované uživatele",
                                              "Kontrola na přidané uživatele"
                                              ),

                  "admin_typvyhodnoceni_begin" => "        <select name=\"typ_kontroly\">\n",

                  "admin_typvyhodnoceni" => "          <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_typvyhodnoceni_end" => "        </select>",


                  //rozsiritelne
                  "set_expirace" => array("+5 minutes" => "5 minut",
                                          "+10 minutes" => "10 minut",
                                          "+15 minutes" => "15 minut",
                                          "+20 minutes" => "20 minut",
                                          "+25 minutes" => "25 minut",
                                          "+30 minutes" => "30 minut",
                                          "+35 minutes" => "35 minut",
                                          "+40 minutes" => "40 minut",
                                          "+45 minutes" => "45 minut",
                                          "+50 minutes" => "50 minut",
                                          "+55 minutes" => "55 minut",
                                          "+1 hour" => "1 hodina",
                                          "+2 hour" => "2 hodiny",
                                          "+3 hour" => "3 hodiny",
                                          "+4 hour" => "4 hodiny",
                                          "+5 hour" => "5 hodin",
                                          "+6 hour" => "6 hodin",
                                          "+7 hour" => "7 hodin",
                                          "+8 hour" => "8 hodin",
                                          "+9 hour" => "9 hodin",
                                          "+10 hour" => "10 hodin",
                                          "+11 hour" => "11 hodin",
                                          "+12 hour" => "12 hodin",
                                          "+13 hour" => "13 hodin",
                                          "+14 hour" => "14 hodin",
                                          "+15 hour" => "15 hodin",
                                          "+16 hour" => "16 hodin",
                                          "+17 hour" => "17 hodin",
                                          "+18 hour" => "18 hodin",
                                          "+19 hour" => "19 hodin",
                                          "+20 hour" => "20 hodin",
                                          "+21 hour" => "21 hodin",
                                          "+22 hour" => "22 hodin",
                                          "+23 hour" => "23 hodin",
                                          "+24 hour" => "24 hodin",
                                          "+1 day" => "1 den",
                                          "+2 day" => "2 dny",
                                          "+3 day" => "3 dny",
                                          "+4 day" => "4 dny",
                                          "+5 day" => "5 dní",
                                          "+6 day" => "6 dní",
                                          "+7 day" => "7 dní"
                                          ),

                  "admin_delkaexpirace_begin" => "        <select name=\"expirace\">\n",

                  "admin_delkaexpirace" => "          <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_delkaexpirace_end" => "        </select>",



                  "admin_obsah" => "
<div class=\"dynamicke_prihlasovani_hlavni_vypis\">
  <h3>Výpis přihlašování</h3>
  <p class=\"odkazy_pridat_nastavit\"><a href=\"%%1%%\" title=\"Přidat přihlašování\">Přidat přihlašování</a></p>
%%2%%
</div>\n",

                  "admin_addprih" => "
<div class=\"pridat_upravit_dynamicke_prihlasovani\">
  <h3>Přidat přihlašování</h3>
  <p class=\"backlink_prihlasovani\">
    <a href=\"%%2%%\" title=\"Zpět na výpis přihlašování\">Zpět na výpis přihlašování</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Název přihlašování:</span>
        <input type=\"text\" name=\"nazev\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Adresa přihlašování:</span>
        <input type=\"text\" name=\"adresa\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_select\">
        <span>Modul na propojení:</span>
%%1%%
      </label>
      <label class=\"input_text\">
        <span>Adresa zobrazování:</span>
        <input type=\"text\" name=\"adresa_funkce\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Index pro název:</span>
        <input type=\"text\" name=\"index_nazev\" />
      </label>
      <label class=\"input_text\">
        <span>Index pro datum:</span>
        <input type=\"text\" name=\"index_datum\" />
      </label>
      <label class=\"input_text\">
        <span>Index pro popis:</span>
        <input type=\"text\" name=\"index_popis\" />
      </label>
      <label class=\"input_text\">
        <span>ID pro captcha kód:</span>
        <input type=\"text\" name=\"idcaptcha\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_textarea\">
        <span>Popis přihlašování:</span>
        <textarea name=\"popis\" rows=\"30\" cols=\"80\"></textarea>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat přihlašování\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_addprih_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Bylo přidáno přihlašování: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editprih" => "
<div class=\"pridat_upravit_dynamicke_prihlasovani\">
  <h3>Upravit přihlašování</h3>
  <p class=\"backlink_prihlasovani\">
    <a href=\"%%10%%\" title=\"Zpět na výpis přihlašování\">Zpět na výpis přihlašování</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Název přihlašování:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%1%%\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Adresa přihlašování:</span>
        <input type=\"text\" name=\"adresa\" value=\"%%2%%\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_select\">
        <span>Modul na propojení:</span>
%%3%%
      </label>
      <label class=\"input_text\">
        <span>Adresa zobrazování:</span>
        <input type=\"text\" name=\"adresa_funkce\" value=\"%%4%%\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Index pro název:</span>
        <input type=\"text\" name=\"index_nazev\" value=\"%%5%%\" />
      </label>
      <label class=\"input_text\">
        <span>Index pro datum:</span>
        <input type=\"text\" name=\"index_datum\" value=\"%%6%%\" />
      </label>
      <label class=\"input_text\">
        <span>Index pro popis:</span>
        <input type=\"text\" name=\"index_popis\" value=\"%%7%%\" />
      </label>
      <label class=\"input_text\">
        <span>ID pro captcha kód:</span>
        <input type=\"text\" name=\"idcaptcha\" value=\"%%8%%\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_textarea\">
        <span>Popis přihlašování:</span>
        <textarea name=\"popis\" rows=\"30\" cols=\"80\">%%9%%</textarea>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit přihlašování\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_editprih_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Bylo upraveno přihlašování: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delprih_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Bylo smazáno přihlašování: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",


                  "admin_addedit_tvar_datum" => "j.n.Y",

                  "admin_defposun_datum_end" => "+3 day", //X dni od begin(now), pro reg_end

                  "admin_defposun_datum_autodel" => "+1 day", //X dni od data poradani, pro autodel

                  "admin_deftvar_prefix" => "0->20|text1|50->80|text2|10->100",

                  "admin_addakce" => "
<script type=\"text/javascript\" src=\"%%1%%/script/jquery-1.3.2.min.js\"></script>

<script type=\"text/javascript\" src=\"%%1%%/script/ajax.js\"></script>
<div class=\"pridat_upravit_dynamicke_prihlasovani\">
  <h3>Přidat registraci do přihlašování <strong>%%2%%</strong></h3>
  <p class=\"backlink_prihlasovani\">
    <a href=\"%%14%%\" title=\"Zpět na výpis přihlašování\">Zpět na výpis přihlašování</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_select\">
        <span>Vyber přihlašování:</span>
%%3%%
      </label>
      <label class=\"input_select\">
        <span>Vyber akci:</span>
%%4%%
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Název akce:</span>
        <em>%%5%%</em>
      </label>
      <label class=\"input_text\">
        <span>Datum akce:</span>
        <em>%%6%%</em>
      </label>
      <label class=\"input_text\">
        <span>Popis akce:</span>
        <em>%%7%%</em>
      </label>
      <label class=\"input_text\">
        <span>Datum začátku registrace:</span>
        <input type=\"text\" name=\"reg_begin\" value=\"%%8%%\" class=\"class_datum_cas\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Datum konce registrace:</span>
        <input type=\"text\" name=\"reg_end\" value=\"%%9%%\" class=\"class_datum_cas\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_textarea\">
        <span>Styl vygenerovaného kódu:</span>
        <textarea name=\"prefix\" rows=\"30\" cols=\"80\" onkeyup=\"PreviewPrefix(this.value, '.navratprefix')\"  onclick=\"PreviewPrefix(this.value, '.navratprefix')\">%%10%%</textarea>
        <span class=\"prihlasovani_dodatek navratprefix\"></span>
        <span class=\"prihlasovani_dodatek\">Povinná položka. X -> XX = rozsah náhodného čísla, oddělovač textu nebo náhodného čísla = |</span>
      </label>
      <label class=\"input_select\">
        <span>Typ kontroly:</span>
%%11%%
      </label>
      <label class=\"input_text\">
        <span>Kapacita lidí:</span>
        <input type=\"text\" name=\"kapacita\" value=\"100\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Rezerva v kapacitě:</span>
        <input type=\"text\" name=\"rezerva\" value=\"0\" />
      </label>
      <label class=\"input_select\">
        <span>Doba platnosti potvrzovacího emailu:</span>
%%12%%
      </label>
      <label class=\"input_text\">
        <span>Datum auto-smazání registrace:</span>
        <input type=\"text\" name=\"autodel\" value=\"%%13%%\" class=\"class_datum_cas\" />
        <span class=\"prihlasovani_dodatek\">Je-li prázdné, tak se registrace nesmaže.</span>
      </label>
      <label class=\"input_text\">
        <span>Název v menu:</span>
        <input type=\"text\" name=\"nazev\" value=\"Registrace [%%5%%]\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_textarea\">
        <span>Popis registrace:</span>
        <textarea name=\"popis\" rows=\"30\" cols=\"80\">%%7%%</textarea>
      </label>
      <label class=\"input_text neaktivni_polozka\">
        <span>id:</span>
        <input type=\"text\" name=\"href_id\" />
      </label>
      <label class=\"input_text neaktivni_polozka\">
        <span>class:</span>
        <input type=\"text\" name=\"href_class\" />
      </label>
      <label class=\"input_text neaktivni_polozka\">
        <span>akce:</span>
        <input type=\"text\" name=\"href_akce\" />
      </label>
      <label class=\"input_checkbox neaktivni_polozka\">
        <span>Zobrazit v menu:</span>
        <input type=\"checkbox\" name=\"zobrazit\" checked=\"checked\" />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat registraci\" />
      </label>
    </fieldset>
  </form>
<script src=\"%%1%%/script/datetimepicker/jquery_datepicker.js\" type=\"text/javascript\"></script>
<script src=\"%%1%%/script/datetimepicker/timepicker_plug/timepicker.js\" type=\"text/javascript\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"%%1%%/script/datetimepicker/timepicker_plug/css/style.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"%%1%%/script/datetimepicker/smothness/jquery_ui_datepicker.css\" />
<script type=\"text/javascript\">
  $(function() {
    $('.class_datum_cas').datetime({
      userLang  : 'en',
      americanMode: false
    });
  });
</script>
</div>\n",

                  "admin_addakce_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla přidána registrace: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editakce" => "
<script type=\"text/javascript\" src=\"%%1%%/script/jquery-1.3.2.min.js\"></script>
<script src=\"%%1%%/script/datetimepicker/jquery_datepicker.js\" type=\"text/javascript\"></script>
<script src=\"%%1%%/script/datetimepicker/timepicker_plug/timepicker.js\" type=\"text/javascript\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"%%1%%/script/datetimepicker/timepicker_plug/css/style.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"%%1%%/script/datetimepicker/smothness/jquery_ui_datepicker.css\" />
<script type=\"text/javascript\">
  $(function() {
	  $('.class_datum_cas').datetime({
			userLang	: 'en',
			americanMode: false
		});
	});
</script>
<script type=\"text/javascript\" src=\"%%1%%/script/ajax.js\"></script>
<div class=\"pridat_upravit_dynamicke_prihlasovani\">
  <h3>Upravit registraci v přihlašování <strong>%%2%%</strong></h3>
  <p class=\"backlink_prihlasovani\">
    <a href=\"%%22%%\" title=\"Zpět na výpis přihlašování\">Zpět na výpis přihlašování</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_select\">
        <span>Vyber přihlašování:</span>
%%3%%
      </label>
      <label class=\"input_select\">
        <span>Vyber akci:</span>
%%4%%
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Název akce:</span>
        <em>%%5%%</em>
      </label>
      <label class=\"input_text\">
        <span>Datum akce:</span>
        <em>%%6%%</em>
      </label>
      <label class=\"input_text\">
        <span>Popis akce:</span>
        <em>%%7%%</em>
      </label>
      <label class=\"input_text\">
        <span>Datum začátku registrace:</span>
        <input type=\"text\" name=\"reg_begin\" value=\"%%8%%\" class=\"class_datum_cas\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Datum konce registrace:</span>
        <input type=\"text\" name=\"reg_end\" value=\"%%9%%\" class=\"class_datum_cas\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_textarea\">
        <span>Styl vygenerovaného kódu:</span>
        <textarea name=\"prefix\" rows=\"30\" cols=\"80\" onkeyup=\"PreviewPrefix(this.value, '.navratprefix')\"  onclick=\"PreviewPrefix(this.value, '.navratprefix')\">%%10%%</textarea>
        <span class=\"prihlasovani_dodatek navratprefix\"></span>
        <span class=\"prihlasovani_dodatek\">Povinná položka. X -> XX = rozsah náhodného čísla, oddělovač textu nebo náhodného čísla = |</span>
      </label>
      <label class=\"input_select\">
        <span>Typ kontroly:</span>
%%11%%
      </label>
      <label class=\"input_text\">
        <span>Kapacita lidí:</span>
        <input type=\"text\" name=\"kapacita\" value=\"%%12%%\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Rezerva v kapacitě:</span>
        <input type=\"text\" name=\"rezerva\" value=\"%%13%%\" />
      </label>
      <label class=\"input_select\">
        <span>Doba platnosti potvrzovacího emailu:</span>
%%14%%
      </label>
      <label class=\"input_text\">
        <span>Datum auto-smazání registrace:</span>
        <input type=\"text\" name=\"autodel\" value=\"%%15%%\" class=\"class_datum_cas\" />
        <span class=\"prihlasovani_dodatek\">Je-li prázdné, tak se registrace nesmaže.</span>
      </label>
      <label class=\"input_text\">
        <span>Název v menu:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%16%%\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_textarea\">
        <span>Popis registrace:</span>
        <textarea name=\"popis\" rows=\"30\" cols=\"80\">%%17%%</textarea>
      </label>
      <label class=\"input_text neaktivni_polozka\">
        <span>id:</span>
        <input type=\"text\" name=\"href_id\" value=\"%%18%%\" />
      </label>
      <label class=\"input_text neaktivni_polozka\">
        <span>class:</span>
        <input type=\"text\" name=\"href_class\" value=\"%%19%%\" />
      </label>
      <label class=\"input_text neaktivni_polozka\">
        <span>akce:</span>
        <input type=\"text\" name=\"href_akce\" value=\"%%20%%\" />
      </label>
      <label class=\"input_checkbox neaktivni_polozka\">
        <span>Zobrazit v menu:</span>
        <input type=\"checkbox\" name=\"zobrazit\"%%21%% />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit registraci\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_editakce_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla upravena registrace: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delakce_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla smazána registrace: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_pdf_tvar_datum" => "d.m.Y H:i:s",

                  "admin_pdf_vypis_open" => "otevřená",

                  "admin_pdf_vypis_close" => "uzavřená",

                  "admin_pdf_vypis_begin" => "
<h1>Registrace na přednášku: <strong>%%3%%</strong></h1>
<div class=\"zahlavi_registrace\">
  <ul>
    <li>Kapacita lidí: <strong>%%5%%</strong></li>
    <li>Rezerva v kapacitě: <strong>%%6%%</strong></li>
    <li>Celková kapacita (kapacita lidí s rezervou v kapacitě): <strong>%%7%%</strong></li>
    <li>Počet volných míst: <strong>%%11%%</strong></li>
    <li>Počet zaregistrovaných lidí: <strong>%%9%%</strong></li>
    <li>Počet lidí, kteří potvrdily registraci: <strong>%%8%%</strong></li>
    <li>Stav registrace: <strong>%%10%%</strong></li>
  </ul>
</div>
<table class=\"hlavni_vypis\">
  <tr>
    <th class=\"ucast_td\">Účast</th>
    <th class=\"jmeno_td\">Příjmení & jméno</th>
    <th class=\"regkod_td\">Registrační kód</th>
    <th class=\"email_td\">E-mail</th>
    <th class=\"potvrzeni_td\">Potvrzená<br />registrace</th>
  </tr>",

                  "admin_pdf_vypis" => "
  <tr>
    <td class=\"ucast_td\"><input type=\"checkbox\"%%10%% /></td>
    <td class=\"jmeno_td\">%%3%% %%2%%</td>
    <td class=\"regkod_td\">%%4%%</td>
    <td class=\"email_td\">%%1%%</td>
    <td class=\"potvrzeni_td\"><input type=\"checkbox\"%%9%% /></td>
  </tr>",

                  "admin_pdf_vypis_end" => "</table>",

                  "admin_pdf_vypis_header" => "",

                  "admin_pdf_vypis_footer" => "
<table class=\"urceni_strany\" width=\"100%\" style=\"font-size: 9px;\">
  <tr>
    <td width=\"100%\" style=\"text-align: right;\">Strana {PAGENO} z {nb}</td>
  </tr>
</table>",
                  //bez *.pdf, koncovka se doplni sama
                  "admin_pdf_vypis_cesta" => "prednaska_cislo_%%2%%",

                  //bez *.css, koncovka se doplni sama, cesta musi existovat!
                  "admin_pdf_vypis_cssfile" => "%%2%%/mpdf",

                  "admin_pdf_vypis_title" => "Výpis uživatelů na přednášce",

                  "admin_pdf_vypis_author" => "GF Design - Tvorba webových stránek a systémů",

                  "admin_pdf_vypis_subject" => "Přednáška číslo: %%2%%",

                  "admin_pdf_vypis_creator" => "Created by GFdesign",

                  "admin_pdf_vypis_keywords" => "---",

                  //true = save as, false = force
                  "admin_pdf_vypis_save_style" => true,

                  "admin_pdf_browseros" => false,

                  "admin_pdf_page_pagebreak" => "<pagebreak />",

                  "admin_pdf_page_first" => 20,

                  "admin_pdf_page_other" => 25,

                  "set_idget" => "login",

                  "admin_infoedituser_tvar_datum" => "d.m.Y H:i:s",

                  "admin_infouser" => "
<script type=\"text/javascript\" src=\"%%1%%/script/jquery-1.3.2.min.js\"></script>
<script type=\"text/javascript\" src=\"%%1%%/script/ajax.js\"></script>
<script type=\"text/JavaScript\">
  function zmenodkaz(typ, input, output)
  {
    if (typ)
    {
      GetZeme('%%13%%', 1, input)
    }
      else
    {
      GetHostName('%%13%%', input)
    }
    $(input).addClass(output);
  }
</script>
<div class=\"pridat_upravit_dynamicke_prihlasovani\">
  <h3>Informace o uživateli</h3>
  <p class=\"backlink_prihlasovani\">
    <a href=\"%%17%%\" title=\"Zpět na výpis přihlašování\">Zpět na výpis přihlašování</a>
  </p>
  <ul>
    <li>Registrován na: <strong>%%2%%</strong></li>
    <li>Uživatelův email: <strong>%%3%%</strong></li>
    <li>Uživatel: <strong>%%4%% %%5%%</strong></li>
    <li>Uživatelův kód: <strong>%%6%%</strong></li>
    <li>Datum registrace uživatele: <strong>%%8%%</strong></li>
    <li>Datum vypršení uživatele, pokud není potvrzený: <strong>%%9%%</strong></li>
    <li>Datum potvrzení uživatele: <strong>%%10%%</strong></li>
    <li>Potvrzený uživatel: <span><input type=\"checkbox\" disabled=\"disabled\"%%11%% /></li>
    <li>Uživatel se zůčastnil: <span><input type=\"checkbox\" disabled=\"disabled\"%%12%% /></li>
    <li>Uživatelovo IP: <strong>%%13%%</strong></li>
    <li>Země původu uživatele: <strong><a href=\"#\" onclick=\"zmenodkaz(true, '.userzemepuvodu', 'userzemepuvodustyl'); return false;\" title=\"Zjistit zemi původu\" class=\"userzemepuvodu\">Zjistit zemi původu</a></strong></li>
    <li>Hostitel uživatele: <strong><a href=\"#\" onclick=\"zmenodkaz(false, '.userhostitel', 'userhostitelstyl'); return false;\" title=\"Zjistit hostitele\" class=\"userhostitel\">Zjistit hostitele</a></strong></li>
    <li>Uživatelův prohlížeč: <strong>%%14%%</strong></li>
    <li>Uživatelův operační systém: <strong>%%15%%</strong></li>
  </ul>
</div>\n",

                  "admin_edituser" => "
<div class=\"pridat_upravit_dynamicke_prihlasovani\">
  <h3>Upravit uživatele</h3>
  <p class=\"backlink_prihlasovani\">
    <a href=\"%%15%%\" title=\"Zpět na výpis přihlašování\">Zpět na výpis přihlašování</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Uživatelův email:</span>
        <input type=\"text\" name=\"email\" value=\"%%3%%\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Uživatelovo jméno:</span>
        <input type=\"text\" name=\"jmeno\" value=\"%%4%%\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Uživatelovo příjmení:</span>
        <input type=\"text\" name=\"prijmeni\" value=\"%%5%%\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Uživatelův kód:</span>
        <input type=\"text\" name=\"identifikace\" value=\"%%6%%\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Datum registrace uživatele:</span>
        <input type=\"text\" name=\"zadano\" value=\"%%8%%\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Datum vypršení:</span>
        <input type=\"text\" name=\"expirace\" value=\"%%9%%\" />
        <span class=\"prihlasovani_dodatek\">Povinná položka. Datum vypršení uživatele, pokud není potvrzený.</span>
      </label>
      <label class=\"input_text\">
        <span>Datum potvrzení uživatele:</span>
        <input type=\"text\" name=\"potvrzeno\" value=\"%%10%%\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Potvrzený uživatel:</span>
        <input type=\"checkbox\" name=\"aktivni\"%%11%%%%14%% />
      </label>
      <label class=\"input_checkbox\">
        <span>Uživatel se zůčastnil:</span>
        <input type=\"checkbox\" name=\"ucast\"%%12%%%%13%% />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit uživatele\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_edituser_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl upraven uživatel: \"<strong>%%1%%, %%2%%, %%3%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_deluser_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl smazán uživatel: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delalluser_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byly smazáni uživatele ze skupiny: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",



                  "admin_vypis_prihlasovani_begin" => "
<div class=\"dynamicke_prihlasovani_vypis_prihlasovani\">
<ul class=\"vypis_prihlasovani_zahlavi\">
  <li>%%2%%</li>
  <li class=\"adresy_prihlasovani_zobrazeni\">[%%3%%] - [%%6%%]</li>
  <li class=\"odkazy_pridat_upravit_smazat\"><p><a href=\"%%8%%\" title=\"Přidat registraci\">Přidat registraci</a> - <a href=\"%%9%%\" title=\"Upravit přihlašování\">Upravit přihlašování</a> - <a href=\"%%10%%\" onclick=\"return confirm('Opravdu chceš smazat přihlašování: &quot;%%2%%&quot; ?');\" title=\"Smazat přihlašování\">Smazat přihlašování</a></p></li>
</ul>\n",

                  "admin_vypis_prihlasovani_end" => "\n</div>\n",

                  "admin_vypis_prihlasovani_akce" => "
<div class=\"dynamicke_prihlasovani_vypis_registrace\">
<ul>
  <li><strong>%%11%%</strong></li>
  <li>Platnost od: <strong>%%3%%</strong> do: <strong>%%4%%</strong></li>
  <li>Datum auto-smazání registrace: <strong>%%10%%</strong></li>
  <li>%%5%%</li>
  <li>Doba platnosti potvrzovacího emailu: <strong>%%9%%</strong></li>
  <li class=\"odkazy_upravit_smazat\"><p><a href=\"%%13%%\" title=\"Upravit registraci\">Upravit registraci</a> - <a href=\"%%14%%\" onclick=\"return confirm('Opravdu chceš smazat registraci: &quot;%%11%%&quot; ?');\" title=\"Smazat registraci\">Smazat registraci</a></p></li>
</ul>
</div>\n",

                  "admin_vypis_razeni_menu_begin" => "
<div class=\"dynamicky_obsah_hlavni_razeni\">
  <h3>Řazení položek menu v dynamickém přihlašování</h3>
<script type=\"text/javascript\" src=\"%%2%%/script/jquery-1.3.2.min.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/jquery-ui-1.7.2.custom.min.js\"></script>
<script type=\"text/javascript\">
  $(function() {
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
                          update: function() {
        var order = $(this).sortable(\"serialize\") + '&action=updateRecordsListingsMenu';
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
    $(function() {
      $(\"#status_drag\").fadeIn(\"slow\");
    });
  }

  function SchovejHlasku()
  {
    $(function() {
      $(\"#status_drag\").fadeOut(\"slow\");
    });
  }
</script>
<div id=\"obal_razeni\">\n",

                  "admin_vypis_razeni_menu" => "
<ul class=\"vypis_sablon_zahlavi\" id=\"recordsArray_%%1%%\">
  <li><strong>%%4%%</strong></li>
  <li class=\"razeni_menu\">[%%2%%] - [%%1%%]</li>
</ul>\n",

                  "admin_vypis_razeni_menu_end" => "\n</div>\n</div>\n<div id=\"status_drag\"></div>\n",

                  "admin_vypis_razeni_menu_null" => "<strong>Prázdná skupina přihlašování</strong>",

                  "ajax_update_records_listings_menu" => "Byl proveden přesun mezi položkami",



                  "set_hlavicka" => "Content-type: text/html; charset=UTF-8",

                  "set_idautorizace" => "autoriz",

                  "set_idreg" => "idr",

                  "set_idstatus" => "stats",

                  "ajaxscript" => "
  function PreviewPrefix(text, ret)
  {
    $.post(\"%%1%%%%2%%/ajax_form.php\",
      \"action=testprefix&text=\"+text,
        function(theResponse)
        {
          $(ret).html(theResponse);
        }
      );
  }

  function AktualniKapacita(id, typ, tvar, ret)
  {
    $.post(\"%%1%%%%2%%/ajax_form.php\",
      \"action=currcap&id=\"+id+\"&typ=\"+typ+\"&tvar=\"+tvar,
        function(theResponse)
        {
          $(ret).html(theResponse);
        }
      );
  }

  function GetZeme(ip, tvar, ret)
  {
    $.post(\"%%1%%%%2%%/ajax_form.php\",
          \"action=getzeme&ip=\"+ip+\"&tvar=\"+tvar,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  function GetHostName(ip, ret)
  {
    $.post(\"%%1%%%%2%%/ajax_form.php\",
          \"action=gethostname&ip=\"+ip,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  var globret;
  function NastavHodnotu(id, val, ret)
  {
    $.post(\"%%1%%%%2%%/ajax_form.php\",
          \"action=setvalue&id=\"+id+\"&val=\"+val,
            function(theResponse)
            {
              $(ret).html(theResponse);
              globret = ret;
              setTimeout(\"SchovejHlasku()\", 3000);
              if (val)
              {
                $('#registrovani_uzivatele_id_'+id).addClass('%%3%%');
              }
                else
              {
                $('#registrovani_uzivatele_id_'+id).removeClass('%%3%%');
              }
            }
          );
          ZobrazHlasku(ret);
  }

  function ZobrazHlasku(ret)
  {
    $(function() {
      $(ret).fadeIn('slow');
    });
  }

  function SchovejHlasku(ret)
  {
    if (ret == null)
    {
      ret = globret;
    }

    $(function() {
      $(ret).fadeOut('slow');
    });
  }
",

                  "set_prepis" => array("\xc3\xa1" => "a",
                                        "\xc3\xa4" => "a",
                                        "\xc4\x8d" => "c",
                                        "\xc4\x8f" => "d",
                                        "\xc3\xa9" => "e",
                                        "\xc4\x9b" => "e",
                                        "\xc3\xad" => "i",
                                        "\xc4\xbe" => "l",
                                        "\xc4\xba" => "l",
                                        "\xc5\x88" => "n",
                                        "\xc3\xb3" => "o",
                                        "\xc3\xb6" => "o",
                                        "\xc5\x91" => "o",
                                        "\xc3\xb4" => "o",
                                        "\xc5\x99" => "r",
                                        "\xc5\x95" => "r",
                                        "\xc5\xa1" => "s",
                                        "\xc5\xa5" => "t",
                                        "\xc3\xba" => "u",
                                        "\xc5\xaf" => "u",
                                        "\xc3\xbc" => "u",
                                        "\xc5\xb1" => "u",
                                        "\xc3\xbd" => "y",
                                        "\xc5\xbe" => "z",
                                        "\xc3\x81" => "A",
                                        "\xc3\x84" => "A",
                                        "\xc4\x8c" => "C",
                                        "\xc4\x8e" => "D",
                                        "\xc3\x89" => "E",
                                        "\xc4\x9a" => "E",
                                        "\xc3\x8d" => "I",
                                        "\xc4\xbd" => "L",
                                        "\xc4\xb9" => "L",
                                        "\xc5\x87" => "N",
                                        "\xc3\x93" => "O",
                                        "\xc3\x96" => "O",
                                        "\xc5\x90" => "O",
                                        "\xc3\x94" => "O",
                                        "\xc5\x98" => "R",
                                        "\xc5\x94" => "R",
                                        "\xc5\xa0" => "S",
                                        "\xc5\xa4" => "T",
                                        "\xc3\x9a" => "U",
                                        "\xc5\xae" => "U",
                                        "\xc3\x9c" => "U",
                                        "\xc5\xb0" => "U",
                                        "\xc3\x9d" => "Y",
                                        "\xc5\xbd" => "Z",
                                        " " => "-",
                                        "." => "-",
                                        "(" => "-",
                                        ")" => "-",
                                        "[" => "-",
                                        "]" => "-",
                                        "{" => "-",
                                        "}" => "-",
                                        "ˇ" => "-",
                                        "´" => "-",
                                        //"-" => "_",
                                        "+" => "-",
                                        ";" => "-",
                                        ":" => "-",
                                        "," => "-",
                                        "'" => "-",
                                        "?" => "-",
                                        "<" => "-",
                                        ">" => "-",
                                        "\x5c" => "-",  // /
                                        "\x2f" => "-",  // \
                                        "|" => "-",
                                        "=" => "-",
                                        "!" => "-",
                                        "*" => "-",
                                        "@" => "-",
                                        "%" => "-",
                                        "&" => "-",
                                        "§" => "-",
                                        "#" => "-",
                                        "$" => "-",
                                        "\"" => "-",
                                        "˚" => "-",
                                        "`" => "-",
                                        "~" => "-",
                                        "^" => "-",
                                        "€" => "-",
                                        "¶" => "-",
                                        "¨" => "-",
                                        "ŧ" => "-",
                                        "¯" => "-",
                                        "←" => "-",
                                        "→" => "-",
                                        "↓" => "-",
                                        "ø" => "-",
                                        "þ" => "-",
                                        "Đ" => "d",
                                        "đ" => "d"),
                  );

  return $result;
?>
