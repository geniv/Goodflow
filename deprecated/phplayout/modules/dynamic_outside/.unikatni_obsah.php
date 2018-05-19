<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Výpis stránek",
                                              "title" => "Výpis stránek",),

                                        array("main_href" => "%%1%%%%2%%",
                                              "odkaz" => "Hlavní texty",
                                              "title" => "Hlavní texty",),

                                        array("main_href" => "%%1%%%%3%%",
                                              "odkaz" => "FAQ",
                                              "title" => "FAQ",),

                                        array("main_href" => "%%1%%%%4%%",
                                              "odkaz" => "Výpis synchronizací",
                                              "title" => "Výpis synchronizací",),
                                        ),

                  "admin_menu_rozsireni_news" => "Novinky",

                  "admin_menu_rozsireni_report" => "Reporty",

                  "admin_permit_rozsireni_vypis" => "%%1%% - Výpis stránek",

                  "admin_permit_rozsireni_vypis_news" => "%%1%% - Výpis novinek",

                  "admin_permit_rozsireni_add_news" => "%%1%% - Přidat novinku",

                  "admin_permit_rozsireni_edit_news" => "%%1%% - Upravit novinku",

                  "admin_permit_rozsireni_del_news" => "%%1%% - Smazat novinku",

                  "admin_permit_rozsireni_vypis_report" => "%%1%% - Výpis reportů",

                  "admin_permit_rozsireni_showrep" => "%%1%% - Otevřít report",

                  "admin_permit_rozsireni_delrep" => "%%1%% - Smazat report",

                  "admin_permit" => array("%%1%%" => array("" => "Výpis stránek", "addweb" => "Přidat stránky", "editweb" => "Upravit stránky", "delweb" => "Smazat stránky"),
                                          "%%1%%%%2%%" => array("" => "Hlavní texty"),
                                          "%%1%%%%3%%" => array("" => "Výpis FAQ", "addfaqskup" => "Přidat FAQ skupinu", "editfaqskup" => "Upravit FAQ skupinu", "delfaqskup" => "Smazat FAQ skupinu", "addfaq" => "Přidat FAQ", "editfaq" => "Upravit FAQ", "delfaq" => "Smazat FAQ"),
                                          "%%1%%%%4%%" => array("" => "Výpis logování",),
                                          ),

                  "name_module" => array ("Externí Administrace",
                                          "Externí Administrace"),

                  "admin_obsah" => "
<div class=\"obal_dynoutside\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Externí Administrace - Výpis stránek</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat stránky\" class=\"addweb tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat stránky</span>
  </a>
  <div class=\"cl-b\">
    %%2%%
  </div>
</div>\n",

                  "admin_addeditweb_add" => "Přidat stránky",

                  "admin_addeditweb_edit" => "Upravit stránky",

                  "admin_addweb_default" => array("",
                                                  "",
                                                  "",
                                                  "",
                                                  "+1 year",
                                                  "",
                                                  "+1 year"),

                  "admin_addeditweb_tvar_datum" => "d.m.Y",

                  "admin_addeditweb" => "
<div class=\"obal_dynoutside\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%% %%2%%</h3>
  </div>
  <a href=\"%%9%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Název stránek:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%2%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">URL adresa:</span>
        <input type=\"text\" name=\"url\" value=\"%%3%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-textarea w-500\">
        <span class=\"nazev-elementu\">Popis stránek:</span>
        <textarea name=\"popis\" rows=\"10\" cols=\"60\">%%4%%</textarea>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Doména - poskytovatel:</span>
        <input type=\"text\" name=\"poskdomena\" value=\"%%5%%\" />
      </label>
      <label class=\"f-text f-datepicker w-500\">
        <span class=\"nazev-elementu\">Doména - datum expirace:</span>
        <input type=\"text\" name=\"expdomena\" value=\"%%6%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Hosting - poskytovatel:</span>
        <input type=\"text\" name=\"poskhosting\" value=\"%%7%%\" />
      </label>
      <label class=\"f-text f-datepicker w-500\">
        <span class=\"nazev-elementu\">Hosting - datum expirace:</span>
        <input type=\"text\" name=\"exphosting\" value=\"%%8%%\" />
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_vypis_obsah_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_obsah_neupraveno" => "Stránky nebyly zatím upraveny",

                  "admin_vypis_obsah" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%2%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%6%%\" class=\"editweb block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit stránky\">Upravit stránky</a><a href=\"%%7%%\" title=\"Opravdu chceš smazat stránky: &quot;%%2%%&quot; ?\" class=\"confirm delweb block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat stránky</a></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">URL adresa:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Stránky přidány:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Stránky upraveny:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
</ul>\n",

                  "admin_vypis_obsah_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Zatím nebyly žádné stránky přidány</div>",

                  "admin_settings" => "
<script type=\"text/javascript\" src=\"%%1%%/script/wymeditor/jquery.wymeditor.min.js\"></script>
<script type=\"text/javascript\" src=\"%%1%%/script/wymeditor/plugins/hovertools/jquery.wymeditor.hovertools.js\"></script>
<script type=\"text/javascript\">
  $(document).ready(function(){
    $('.wymeditor').wymeditor({
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
<div class=\"obal_dynoutside\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Externí Administrace - Hlavní texty</h3>
  </div>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Text v zápatí stránek:</span>
        <input type=\"text\" name=\"datumoddo\" value=\"%%2%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <div class=\"f-wysiwyg f-wysiwyg-povinny\">
        <span class=\"nazev-elementu\">Text v \"Jste zde poprvé ?\":</span>
        <textarea name=\"dialog\" rows=\"20\" cols=\"60\" class=\"wymeditor\">%%3%%</textarea>
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </div>
      <label class=\"f-textarea f-povinny w-500\">
        <span class=\"nazev-elementu\">FAQ popis:</span>
        <textarea name=\"popisfaq\" rows=\"10\" cols=\"60\">%%4%%</textarea>
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-textarea f-povinny w-500\">
        <span class=\"nazev-elementu\">Report popis:</span>
        <textarea name=\"popisreport\" rows=\"10\" cols=\"60\">%%5%%</textarea>
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" class=\"wymupdate\" value=\"Uložit texty\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_faq" => "
<div class=\"obal_dynoutside_faq\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Externí Administrace - FAQ</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat FAQ skupinu\" class=\"addfaqskup tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat FAQ skupinu</span>
  </a>
  <div class=\"cl-b\">
    %%2%%
  </div>
</div>\n",

                  "admin_addfaqskup_default" => array(""),

                  "admin_addeditfaqskup_add" => "Přidat FAQ skupinu",

                  "admin_addeditfaqskup_edit" => "Upravit FAQ skupinu",

                  "admin_addeditfaqskup" => "
<div class=\"obal_dynoutside_faq\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%% %%2%%</h3>
  </div>
  <a href=\"%%3%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Název FAQ skupiny:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%2%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_skupina_faq_row" => "<option value=\"%%1%%\"%%2%%>%%3%%</option>\n  ",

                  "admin_skupina_faq" => "
<select name=\"skupina\">
  %%1%%
</select>",

                  "admin_addfaq_default" => array("",
                                                  "",
                                                  ""),

                  "admin_addeditfaq_add" => "Přidat FAQ",

                  "admin_addeditfaq_edit" => "Upravit FAQ",

                  "admin_addeditfaq" => "
<div class=\"obal_dynoutside_faq\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%% %%3%%</h3>
  </div>
  <a href=\"%%6%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-select f-povinny w-705\">
        <span class=\"nazev-elementu\">FAQ skupina:</span>
%%2%%
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-700\">
        <span class=\"nazev-elementu\">Název FAQ:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%3%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-textarea f-povinny w-700\">
        <span class=\"nazev-elementu\">Otázka:</span>
        <textarea name=\"otazka\" rows=\"20\" cols=\"60\">%%4%%</textarea>
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-textarea f-povinny w-700\">
        <span class=\"nazev-elementu\">Odpověď:</span>
        <textarea name=\"odpoved\" rows=\"20\" cols=\"60\">%%5%%</textarea>
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_vypis_faq_skupina_aktivni" => " barva-14",

                  "admin_vypis_faq_skupina" => "
<ul class=\"f-s-14 f-f-web-pro cl-b\">
  <li class=\"nadpis-6 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l f-s-16\"><a href=\"%%1%%\" class=\"block no-u odkaz-14%%3%%\" title=\"%%2%%\">%%2%%</a></span><span class=\"block fl-r m-t-1 ow-h\"><a href=\"%%5%%\" class=\"addfaq block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Přidat FAQ\">Přidat FAQ</a><a href=\"%%6%%\" class=\"editfaqskup block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit FAQ skupinu\">Upravit FAQ skupinu</a><a href=\"%%7%%\" title=\"Opravdu chceš smazat FAQ skupinu: &quot;%%2%%&quot; ?\" class=\"delfaqskup confirm block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat FAQ skupinu</a></span></li>
%%4%%
</ul>\n",

                  "admin_vypis_faq_skupina_null" => "<div class=\"nadpis-2 f-s-16 m-t-2 p-t-10 p-b-10 t-a-c f-f-web-pro\">Zatím nebyla vytvořena FAQ skupina</div>",

                  "admin_vypis_faq_neupraveno" => "FAQ nebyl zatím upraven",

                  "admin_vypis_faq_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_faq_null" => "<div class=\"nadpis-2 f-s-16 m-t-2 p-t-10 p-b-10 t-a-c f-f-web-pro\">Zatím nebyl vytvořen FAQ</div>",

                  "admin_vypis_faq" => "
  <li class=\"nadpis-2 f-s-16 m-t-2 m-r-10 m-l-10 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l f-s-16\">%%1%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%6%%\" title=\"Upravit FAQ\" class=\"editfaq block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit FAQ</a><a href=\"%%7%%\" title=\"Opravdu chceš smazat FAQ: &quot;%%1%%&quot; ?\" class=\"delfaq confirm block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat FAQ</a></span></li>
  <li class=\"polozka-1-lichy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Otázka: <span class=\"barva-5\">%%2%%</span></span></li>
  <li class=\"polozka-1-sudy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Odpověď: <span class=\"barva-5\">%%3%%</span></span></li>
  <li class=\"polozka-1-lichy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">FAQ přidán:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
  <li class=\"polozka-1-sudy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">FAQ upraven:</span><span class=\"fl-r barva-5\">%%5%%</span></li>\n",

                  "admin_vypis_down_log_begin" => "
<div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
  <h3 class=\"nadpis-sekce upc f-s-30\">Výpis synchronizací</h3>
</div>\n",

                  "admin_vypis_down_log_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_down_log" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%1%%</span><span class=\"fl-r\">%%2%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas synchronizace:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">IP serveru:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Operační systém:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Prohlížeč:</span><span class=\"fl-r barva-5\">%%6%%</span></li>
</ul>\n",

                  "admin_vypis_down_log_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro cl-b\">Žádný záznam synchronizace</div>",

                  "set_down_log_expire" => "-7 day",

                  "admin_obsah_sablona_tvar_datum" => "d.m.Y",

                  "admin_obsah_sablona" => "
<div class=\"obal_dynoutside\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%2%%</h3>
    <h4 class=\"pod-nadpis-sekce f-s-17 f-f-web-pro\">%%4%%<!-- --></h4>
  </div>
  <a href=\"%%13%%\" title=\"Upravit stránky\" class=\"editweb tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Upravit stránky</span>
  </a>
  <div class=\"cl-b ow-h m-b-15\">
    <a href=\"%%9%%\" title=\"Novinky\" class=\"tlacitko-8 m-r-12 m-l-2 fl-l odkaz-20\">
      <span class=\"tlacitko-left\"><!-- --></span>
      <span class=\"tlacitko-right\"><!-- --></span>
      <span class=\"tlacitko-text\">Novinky</span>
    </a>
    <a href=\"%%11%%\" title=\"Reporty\" class=\"tlacitko-8 m-r-12 fl-l odkaz-19\">
      <span class=\"tlacitko-left\"><!-- --></span>
      <span class=\"tlacitko-right\"><!-- --></span>
      <span class=\"tlacitko-text\">Reporty</span>
    </a>
    <a href=\"%%3%%cron.php\" title=\"Spustit CRON manuálně\" class=\"tlacitko-8 m-r-12 fl-l odkaz-12\">
      <span class=\"tlacitko-left\"><!-- --></span>
      <span class=\"tlacitko-right\"><!-- --></span>
      <span class=\"tlacitko-text\">Spustit CRON manuálně</span>
    </a>
  </div>
  <div class=\"cl-b\">
    <ul class=\"f-s-14 f-f-web-pro cl-b\">
      <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l f-s-16\">%%3%%</span></li>
      <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Počet novinek:</span><span class=\"fl-r barva-5\">%%10%%</span></li>
      <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Počet reportů:</span><span class=\"fl-r barva-5\">%%12%%</span></li>
      <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Doména - poskytovatel:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
      <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Doména - datum expirace:</span><span class=\"fl-r barva-5\">%%6%%</span></li>
      <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Hosting - poskytovatel:</span><span class=\"fl-r barva-5\">%%7%%</span></li>
      <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Hosting - datum expirace:</span><span class=\"fl-r barva-5\">%%8%%</span></li>
    </ul>
  </div>
</div>\n",

                  "admin_novinky" => "
<div class=\"obal_dynoutside_news__%%1%%\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%2%% - Novinky</h3>
  </div>
  <a href=\"%%3%%\" title=\"Přidat novinku\" class=\"addnews tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat novinku</span>
  </a>
  <div class=\"cl-b\">
    %%4%%
  </div>
</div>\n",

                  "admin_addnews_default" => array("",
                                                   ""),

                  "admin_addeditnews_add" => "Přidat novinku",

                  "admin_addeditnews_edit" => "Upravit novinku",

                  "admin_addeditnews" => "
<div class=\"obal_dynoutside\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%% %%2%%</h3>
  </div>
  <a href=\"%%4%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-700\">
        <span class=\"nazev-elementu\">Nadpis novinky:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%2%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-textarea w-700\">
        <span class=\"nazev-elementu\">Text novinky:</span>
        <textarea name=\"popis\" rows=\"20\" cols=\"60\">%%3%%</textarea>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_vypis_novinky_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_novinky_neupraveno" => "Zatím nebyla novinka upravena",

                  "admin_vypis_novinky" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%2%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%6%%\" class=\"editnews block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit novinku\">Upravit novinku</a><a href=\"%%7%%\" title=\"Opravdu chceš smazat novinku: &quot;%%2%%&quot; ?\" class=\"confirm delnews block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat novinku</a></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas přidání novinky:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas upravení novinky:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Text novinky: <span class=\"barva-5\">%%5%%</span></span></li>
</ul>\n",

                  "admin_vypis_novinky_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro cl-b\">Zatím nebyla vytvořena novinka</div>",

                  "admin_reporty" => "
<div class=\"obal_dynoutside_repo__%%1%%\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%2%% - Reporty</h3>
  </div>
  <div class=\"cl-b\">
    %%3%%
  </div>
</div>\n",

                  "admin_vypis_reporty_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro cl-b\">Nebyl zaslán žádný report</div>",

                  "admin_vypis_reporty_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_reporty" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%3%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%10%%\" class=\"showrep block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Otevřít report\">Otevřít report</a><a href=\"%%11%%\" title=\"Opravdu chceš smazat report: &quot;%%3%%&quot; ?\" class=\"confirm delrep block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat report</a></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Od administrátora:</span><span class=\"fl-r barva-5\">%%1%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">E-mail, pokud vyplnil:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Zpráva: <span class=\"barva-5\">%%4%%</span></span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Report přečten:</span><span class=\"fl-r\"><input type=\"checkbox\" disabled=\"disabled\"%%5%% class=\"block m-t-2\" /></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas odeslání reportu:</span><span class=\"fl-r barva-5\">%%6%%</span></li>
</ul>\n",

                  "admin_showrep_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_showrep" => "
<div class=\"obal_dynoutside\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Report - %%3%%</h3>
  </div>
  <a href=\"%%10%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <div class=\"cl-b\">
    <ul class=\"f-f-web-pro f-s-14 m-b-15\">
      <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%3%%</span></li>
      <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Od administrátora:</span><span class=\"fl-r barva-5\">%%1%%</span></li>
      <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">E-mail, pokud vyplnil:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
      <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Zpráva: <span class=\"barva-5\">%%4%%</span></span></li>
      <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Report přečten:</span><span class=\"fl-r\"><input type=\"checkbox\" disabled=\"disabled\"%%5%% class=\"block m-t-2\" /></span></li>
      <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas odeslání reportu:</span><span class=\"fl-r barva-5\">%%6%%</span></li>
      <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">IP:</span><span class=\"fl-r barva-5\">%%7%%</span></li>
      <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Operační systém:</span><span class=\"fl-r barva-5\">%%8%%</span></li>
      <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Prohlížeč:</span><span class=\"fl-r barva-5\">%%9%%</span></li>
    </ul>
  </div>
</div>\n",

                  );

  return $result;
?>
