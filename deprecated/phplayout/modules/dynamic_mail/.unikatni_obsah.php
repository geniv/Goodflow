<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamický mailing - zpravy",
                                              "title" => "Dynamicky mailing - zpravy",),

                                        array("main_href" => "%%1%%%%2%%",
                                              "odkaz" => "Výpis mailu",
                                              "title" => "Výpis mailu",),
                                        ),


                  "admin_permit" => array("%%1%%" => array("" => "Výpis zpráv", "addmsg" => "Přidat zprávu", "editmsg" => "Upravit zprávu", "delmsg" => "Smazat zprávu"),
                                          "%%1%%%%2%%" => array("" => "Výpis mailu", "addmail" => "Přidat mail", "editmail" => "Edit mail", "delmail" => "Smazat mail"),
                                          ),

                  "name_module" => array ("Administrace mailu",
                                          "Mailing"),


                  "normal_odhlaseni" => "vas email: <strong>%%1%%</strong> bylo odebran.",


                  "normal_na_strankach" => "
                  <form method=\"post\">
                    <input type=\"text\" name=\"%%1%%\" value=\"@\" />
                    <input type=\"submit\" name=\"%%2%%\" value=\"Přidat svůj email\" />
                  </form>",

                  "normal_na_strankach_pridano" => "uspesne pridano... %%1%% ted by mel byt vam odeslat emaily do vas email schranka",

                  "normal_na_strankach_duplicita" => "voe mas duplicitni mail... tak jakoze smola...",

                  "normal_na_strankach_header" => "",

                  "normal_na_strankach_predmet" => "predmet emailu",

                  "normal_na_strankach_email" => "email: %%1%%
                  link: %%2%%
                  sem chodit bude email spam
                  dik
                  a cece paraci
                  ",



                  "normal_na_registraci" => "zachycena podivna duplicita",



                  "normal_cron_email_header" => "",

                  "normal_cron_email" => "
                  zprava: %%1%%
                  %%2%% <--oddlasovaci link
                  ",





                  "admin_obsah" => "
<div class=\"obal_dynrss\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Dynamický mailing - Přehled zpráv</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat zprávu\" class=\"addmsg tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat zprávu</span>
  </a>
  <div class=\"cl-b\">
    %%2%%
  </div>
</div>\n",

                  "admin_email" => "
<div class=\"obal_dynrss\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Dynamický mailing - Přehled emailu</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat email\" class=\"addmail tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat ručně email</span>
  </a>
  <div class=\"cl-b\">
    %%2%%
  </div>
</div>\n",


                  "admin_addeditmsg_add" => "Přidat zprávu",

                  "admin_addeditmsg_edit" => "Upravit zprávu",

                  "admin_addeditmsg" => "
<div class=\"obal_dyncron\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%%</h3>
  </div>
  %%2%%
  <a href=\"%%6%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Předmět:</span>
        <input type=\"text\" name=\"predmet\" value=\"%%3%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Zpráva:</span>
        <input type=\"text\" name=\"zprava\" value=\"%%4%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
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

                  "admin_vypis_obsah_edit" => "<a href=\"%%1%%\" class=\"editmsg block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit zprávu\">Upravit zprávu</a>",

                  "admin_vypis_obsah" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%1%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%8%%<a href=\"%%9%%\" title=\"Opravdu chceš smazat zprávu: &quot;%%1%%&quot; ?\" class=\"delmsg confirm block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat zprávu</a></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">%%2%%</span><span class=\"fl-r barva-5\"><!-- --></span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Zámek:</span><span class=\"fl-r barva-5\"><input type=\"checkbox\" disabled=\"disabled\"%%6%% class=\"block m-t-2\" /></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Aktivní:</span><span class=\"fl-r barva-5\"><input type=\"checkbox\" disabled=\"disabled\"%%7%% class=\"block m-t-2\" /></span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas vytvoření:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas upravení:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas odeslání:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
</ul>\n",

                  "admin_vypis_obsah_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro cl-b\">žádná zpráva</div>",



                  "admin_addeditmail_add" => "Přidat email",

                  "admin_addeditmail_edit" => "Upravit email",

                  "admin_addeditmail" => "
<div class=\"obal_dyncron\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%%</h3>
  </div>
  <a href=\"%%3%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Email:</span>
        <input type=\"text\" name=\"email\" value=\"%%2%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",


                  "admin_vypis_email_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_email" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%1%%</span><span class=\"fl-r\"><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%6%%\" class=\"editmail block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit email\">Upravit email</a><a href=\"%%7%%\" title=\"Opravdu chceš smazat email: &quot;%%1%%&quot; ?\" class=\"delmail confirm block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat email</a></span></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas přidání:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum / čas upraveni:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">IP serveru:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">typ registrace:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
</ul>\n",

                  "admin_vypis_email_null" => "žádný email",

                  "name_typ" => array("dir" => "příme vložení",
                                      "web" => "vložení přes pole na stránkách",
                                      "reg" => "vložení při registraci",
                                      ),


                  );

  return $result;
?>
