<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamický CRON",
                                              "title" => "Dynamický CRON",),

                                        array("main_href" => "%%1%%%%2%%",
                                              "odkaz" => "Výpis CRON logování",
                                              "title" => "Výpis CRON logování",),
                                        ),

                  "control_preinstall" => array("cron" => array(array("id" => 1,
                                                                      "modul" => "Funkce",
                                                                      "funkce" => "CronAdminClearLog",
                                                                      "parametry" => "",
                                                                      "popis" => "Promazávání admin logu",
                                                                      "pridano" => "%%1%%",
                                                                      "aktivni" => 1),

                                                                array("id" => 2,
                                                                      "modul" => "Funkce",
                                                                      "funkce" => "CronZalohovaniDatabaze",
                                                                      "parametry" => "",
                                                                      "popis" => "Zálohování databází",
                                                                      "pridano" => "%%1%%",
                                                                      "aktivni" => 1),

                                                                array("id" => 3,
                                                                      "modul" => "Funkce",
                                                                      "funkce" => "CronKontolaZalohyDatabaze",
                                                                      "parametry" => "",
                                                                      "popis" => "Promazávání databází",
                                                                      "pridano" => "%%1%%",
                                                                      "aktivni" => 1),

                                                                array("id" => 4,
                                                                      "modul" => "Funkce",
                                                                      "funkce" => "CronZalohovaniUnikatnich",
                                                                      "parametry" => "",
                                                                      "popis" => "Zálohování unikátních",
                                                                      "pridano" => "%%1%%",
                                                                      "aktivni" => 1),

                                                                array("id" => 5,
                                                                      "modul" => "Funkce",
                                                                      "funkce" => "CronKontrolaUnikatnich",
                                                                      "parametry" => "",
                                                                      "popis" => "Promazávání unikátních",
                                                                      "pridano" => "%%1%%",
                                                                      "aktivni" => 1),

                                                                array("id" => 6,
                                                                      "modul" => "Funkce",
                                                                      "funkce" => "CronKontrolaErrorLogu",
                                                                      "parametry" => "",
                                                                      "popis" => "Promazávání error logů",
                                                                      "pridano" => "%%1%%",
                                                                      "aktivni" => 1),

                                                                array("id" => 7,
                                                                      "modul" => "Funkce",
                                                                      "funkce" => "CronGenerovaniCacheGrafu",
                                                                      "parametry" => "",
                                                                      "popis" => "Generování cache pro grafy",
                                                                      "pridano" => "%%1%%",
                                                                      "aktivni" => 1),

                                                                array("id" => 8,
                                                                      "modul" => "Funkce",
                                                                      "funkce" => "CronKontrolaSessionLogu",
                                                                      "parametry" => "",
                                                                      "popis" => "Promazávání session logů",
                                                                      "pridano" => "%%1%%",
                                                                      "aktivni" => 1),

                                                                array("id" => 9,
                                                                      "modul" => "Funkce",
                                                                      "funkce" => "CronKontrolaActionLogu",
                                                                      "parametry" => "",
                                                                      "popis" => "Promazávání action logů",
                                                                      "pridano" => "%%1%%",
                                                                      "aktivni" => 1),
                                                                ),
                                                ),

                  "admin_permit" => array("%%1%%" => array("" => "Výpis dynamický CRON", "addcron" => "Přidat úlohu CRON", "editcron" => "Upravit úlohu CRON", "delcron" => "Smazat úlohu CRON"),
                                          "%%1%%%%2%%" => array("" => "Výpis CRON logování"),
                                          ),

                  "name_module" => array ("Administrace CRON",
                                          "Administrace CRON"),

                  "admin_seznam_trid_begin" => "<select name=\"trida\">\n  <option value=\"\" class=\"option_center\">--- Vyber Funkci ---</option>\n",

                  "admin_seznam_trid_skupina_begin" => "<optgroup label=\"%%1%%\">\n",

                  "admin_seznam_trid" => "  <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_seznam_trid_skupina_end" => "</optgroup>\n\n",

                  "admin_seznam_trid_end" => "</select>\n",

                  "admin_obsah" => "
<div class=\"obal_dyncron\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Dynamický CRON - Přehled úloh</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat úlohu CRON\" class=\"addcron tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat úlohu CRON</span>
  </a>
  <div class=\"cl-b\">
    %%2%%
  </div>
</div>\n",

                  "admin_vypis_logu_begin" => "
<div class=\"obal_dyncron\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Výpis CRON logování</h3>
  </div>
</div>\n",

                  "admin_addeditcron_add" => "Přidat úlohu CRON",

                  "admin_addeditcron_edit" => "Upravit úlohu CRON",

                  "admin_addeditcron" => "
<div class=\"obal_dyncron\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%%</h3>
  </div>
  <a href=\"%%6%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-select-optgroup f-povinny w-505\">
        <span class=\"nazev-elementu\">Modul &rsaquo;&rsaquo; Funkce:</span>
%%2%%
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Parametry:</span>
        <input type=\"text\" name=\"parametry\" value=\"%%3%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Popis:</span>
        <input type=\"text\" name=\"popis\" value=\"%%4%%\" />
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"aktivni\"%%5%% />
        <span class=\"nazev-elementu\">Aktivní</span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_vypis_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_obsah" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%2%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%8%%\" class=\"editcron block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit úlohu\">Upravit úlohu</a><a href=\"%%9%%\" title=\"Opravdu chceš smazat CRON úlohu: &quot;%%1%% - %%2%%&quot; ?\" class=\"delcron confirm block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat úlohu</a></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">%%1%%</span><span class=\"fl-r barva-5\">%%4%%<!-- --></span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Aktivní:</span><span class=\"fl-r barva-5\"><input type=\"checkbox\" disabled=\"disabled\"%%7%% class=\"block m-t-2\" /></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas vytvoření:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
</ul>\n",

                  "admin_vypis_obsah_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro cl-b\">Není vytvořena CRON úloha nebo nebyl CRON ještě spuštěn</div>",

                  "admin_vypis_logu_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_logu" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%1%%</span><span class=\"fl-r\">%%2%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas spuštění:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Operační systém:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">IP serveru:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Prohlížeč:</span><span class=\"fl-r barva-5\">%%6%%</span></li>
</ul>\n",

                  "set_expire_log" => "-5 day",

                  );

  return $result;
?>
