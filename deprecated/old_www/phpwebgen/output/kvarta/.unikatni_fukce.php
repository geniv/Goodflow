<?php

  $result = array("admin_menu" => array(array("main_href" => "",
                                              "odkaz" => "Úvodní strana",
                                              "title" => "Úvodní strana",
                                              "id" => "",
                                              "class" => "uvodni_strana_menu",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%1%%",
                                              "odkaz" => "Kontrola aktualizací",
                                              "title" => "Kontrola aktualizací",
                                              "id" => "",
                                              "class" => "kontrola_aktualizaci_menu",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%2%%",
                                              "odkaz" => "Manuální záloha databáze",
                                              "title" => "Záloha databáze",
                                              "id" => "",
                                              "class" => "zaloha_databaze_menu",
                                              "akce" => " onclick=\"return confirm('Opravdu chcete zálohovat aktuální databázi ?');\"",
                                              "zobrazit" => true),
                                        ),

                  "tvar_admin_menu" => "
<li>
  <a href=\"?%%1%%=%%2%%\" title=\"%%3%%\"%%4%%%%5%%%%6%%>
    %%7%%%%3%%%%8%%
  </a>
</li>
    ",

                  "tvar_admin_logoff" => "
<li>
  <a href=\"?%%1%%=logoff\" title=\"Odhlásit se\" class=\"odhlasit_se_menu\" onclick=\"return confirm('Opravdu se chcete odhlásit??');\">Odhlásit se</a>
</li>
<li>
  <a href=\"./\" title=\"\" class=\"odhlasit_se_menu\">Přejdi na stránky bez odhlášení</a>
</li>
  ",

                  "uvod_admin_text" => "
<h2>Vítejte v administraci %%1%%</h2>
%%2%%
<h2>Výpis všech záloh databáze</h2>
%%3%%
        ",

                  "info_admin_uvod_text" => "
<dl>
  <dt>Celkový počet modulů:</dt>
  <dd>%%1%%</dd>
  <dt>Celkový počet databází:</dt>
  <dd>%%2%%</dd>
  <dt>Celková velikost všech modulů</dt>
  <dd>%%3%%</dd>
  <dt>Celková velikost všech databází:</dt>
  <dd>%%4%%</dd>
  <dt>Celková velikost záloh:</dt>
  <dd>%%5%%</dd>
  <dt>Velikost celého webu:</dt>
  <dd>%%6%%</dd>
  <dt>Celková velikost stylů:</dt>
  <dd>%%7%%</dd>
  <dt>Celková velikost skriptů:</dt>
  <dd>%%8%%</dd>
  <dt>Celková velikost obrázků:</dt>
  <dd>%%9%%</dd>
  <dt>Celková velikost sekcí:</dt>
  <dd>%%10%%</dd>
</dl>
",

                  "aktualizace_notexists" => "Chybná cesta v konfiguraci modulu  - spatna cesta",

                  "aktualizace_aktualni_hlaska" => "aktuální verze",

                  "aktualizace_aktualni_datum_hlaska" => "aktuální verze - nesedí velikost <a href=\"%%1%%\" title=\"sosnout\">sosnout</a> <a href=\"%%2%%\" title=\"upnout\">upnout</a>",

                  "aktualizace_aktualni_novejsi_hlaska" => "aktuálni verze - novější datum na tomto webu",

                  "aktualizace_novejsi_hlaska" => "novější datum na tomto webu",

                  "aktualizace_aktualni_depozit_hlaska" => "aktuálni verze - aktualni datum na depozitu",

                  "aktualizace_novejsi_depozit_hlaska" => "novější datum na depozitu - nesedí velikost <a href=\"%%1%%\" title=\"sosnout\">sosnout</a> <a href=\"%%2%%\" title=\"upnout\">upnout</a>",

                  "aktualizace_null_soubor" => "Dotyčná verze neni na depozitu prozatím vložena",

                  "aktualizace_admin_vypis" => "<p>
  %%1%% ([%%2%%] - %%3%%) -<br /><strong>%%4%% (%%5%%)</strong> || depozit: <strong>%%6%% %%7%%</strong> -<br />%%8%%
  <br />
  <br />
</p>",

                  "upload_admin_form" => "
  <form method=\"post\" enctype=\"multipart/form-data\" onsubmit=\"return confirm('Opravdu aktualizovat tento modul: \'%%1%%\' ??');\">
    <fieldset>
      modul (jen php): <input type=\"file\" name=\"modul\" /> <br />
      <input type=\"submit\" name=\"tlacitko\" value=\"Upgradovat\" />
    </fieldset>
  </form>
",

                  "admin_menu_prvni" => "_prvni",

                  "admin_menu_posledni" => "_posledni",

                  "admin_menu_ente" => "_ente",

                  "aktualizace_datum" => "Datum aktualizace: %%1%%",

                  "upload_admin_finish" => "modul: <strong>%%1%%</strong> uspěšne aktualizován",

                  "vypis_zaloha_null" => "složka záloh je prázdná",

                  "vypis_zaloha_hlavicka" => "
<ul>
  <li class=\"nazev_databaze\">Název databáze</li>
  <li class=\"datum-cas\">Datum / Čas</li>
  <li class=\"velikost\">Velikost</li>
  <li class=\"smazat posledni-right\">Smazat</li>
</ul>
        ",

                  "vypis_zaloha_telicko" => "
<ul%%1%%>
  <li class=\"nazev_databaze\"><a href=\"%%2%%\" title=\"%%3%%\">%%3%%</a></li>
  <li class=\"datum-cas\">%%4%%</li>
  <li class=\"velikost\">%%5%%</li>
  <li class=\"smazat posledni-right\"><a href=\"?%%6%%&amp;file=%%3%%\" onclick=\"return confirm('Opravdu chcete smazat tuto zálohu: &quot;%%3%%&quot; ?');\" title=\"Smazat\">Smazat</a></li>
</ul>
          ",

                  "vypis_zaloha_del" => "
<div class=\"centralni_blok central_info\">
  <span></span>
  <p>
    Soubor: \"%%1%%\" byl automaticky smazán !
  </p>
</div>
            ",

                  "vypis_zaloha_notexists" => "
<div class=\"centralni_blok central_error\">
  <span></span>
  <p>
    Složka \"%%1%%\" neexistuje. Musí se vytvořit záloha databáze, nebo samotná složka.
  </p>
</div>
      ",

                  "zaloha_smazano_true" => "
<div class=\"centralni_blok central_info\">
  <span></span>
  <p>
    Soubor: \"%%1%%\" byl smazán !
  </p>
</div>
      ",

                  "zaloha_smazano_false" => "
<div class=\"centralni_blok central_warning\">
  <span></span>
  <p>
    Nastala chyba, soubor %%1%% nebyl smazán !
  </p>
</div>
      ",

                  "zaloha_dir_notexists" => "
<div class=\"centralni_blok central_error\">
  <span></span>
  <p>
    Cesta %%1%% neexistuje !
  </p>
</div>
      ",

                  "text_cas_aktualizace" => "
    poslední aktualizace: %%1%%, auto logoff nastavena na
   %%2%%:%%3%%:%%4%% hod
    ",

                  "text_autorizace_logon" => "vychozi layout :D on",

                  "text_autorizace_logoff" => "<meta http-equiv=\"refresh\" content=\"0;URL=%%1%%\" /> automaticky odhlášeno!",

                  "text_odkaz_zpet" => "<a href=\"javascript:history.back(-%%1%%);\">%%2%%</a>",

                  "text_chyba" => "
<div id=\"centralni_chyba\">
  <p>
    Vyskytla se chyba:
  </p>
  <p>
    <strong>%%1%%</strong>
  </p>
  %%2%%
</div>
    ",

                  "text_error_page" => array (array("kod" => 400,
                                                    "popiskod" => "Špatná žádost",
                                                    "popis" => "Žádost obsahuje buď špatné syntaxe nebo syntaxe, které nemohou být splněny."),

                                              array("kod" => 401,
                                                    "popiskod" => "Neoprávněný přístup",
                                                    "popis" => "Žádost byla povolena, ale server odmítl oprávnění."),

                                              array("kod" => 403,
                                                    "popiskod" => "Zakázáno",
                                                    "popis" => "Žádost byla povolena, ale server odmítl reagovat."),

                                              array("kod" => 404,
                                                    "popiskod" => "Nenalezeno",
                                                    "popis" => "Požadovaná stránka nebyla nalezena, ale je možné, že bude v budoucnu fungovat."),

                                              array("kod" => 500,
                                                    "popiskod" => "Vnitřní chyba serveru",
                                                    "popis" => "Všeobecná chybová zpráva. Vyskytla se, protože není k dispozici žádná konkrétnější zpráva."),

                                              array("kod" => 503,
                                                    "popiskod" => "Služba není k dispozici",
                                                    "popis" => "Server je dočasně nedostupný. Důvodem může být přetížení, nebo údržba serveru. Jedná se o dočasný stav"),
                                                    ),

                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
